<?php
// report_event.php
// Genera un PDF con reportes para un evento individual usando FPDF y PDO.

// 1. Inicialización
session_start();

// Ajusta la ruta a bd.php según dónde ubiques este archivo.
// Por ejemplo, si estás en views/reportes/report_event.php y bd.php está en includes/bd.php:
// require_once '../../includes/bd.php';
require_once '../../includes/bd.php';

require_once '../../fpdf/fpdf.php'; // Ajusta ruta si FPDF está en otra carpeta

// Obtener conexión PDO
try {
    $conn = Database::getInstance();
    // Opcionalmente, asegurar que el charset sea UTF8:
    $conn->exec("SET NAMES utf8mb4");
} catch (Exception $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// 2. Validar parámetro Id_Evento
$id_evento = filter_input(INPUT_GET, 'Id_Evento', FILTER_VALIDATE_INT);
if (!$id_evento) {
    die("Parámetro Id_Evento inválido.");
}

// 3. Consultas usando PDO

// 3.1 Sección 1: lista de todos los eventos organizados habilitados
$sql_events = "
    SELECT 
        e.Id_Eventos, e.Nombre AS Evento, e.Fecha,
        c.Nombre AS Categoria,
        u.Zona AS ZonaUbic, u.Calle, u.NroLugar,
        h.Hora_Inicio, h.Hora_Final
    FROM eventos e
    LEFT JOIN categoria c ON e.Id_Categoria = c.Id_Categoria
    LEFT JOIN ubicacion u ON e.Id_Ubicacion = u.Id_Ubicacion
    LEFT JOIN horarios h ON e.Id_Horario = h.Id_Horario
    WHERE e.habilitado = 1
    ORDER BY e.Fecha DESC, e.Nombre
";
try {
    $stmt_events = $conn->query($sql_events);
    $events = $stmt_events->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error al obtener lista de eventos: " . $e->getMessage());
}

// 3.2 Sección 2: cantidad total de asociados habilitados
$sql_count = "SELECT COUNT(*) AS total_asociados FROM asociados WHERE habilitado = 1";
try {
    $stmt_count = $conn->query($sql_count);
    $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $total_asociados = $row_count ? intval($row_count['total_asociados']) : 0;
} catch (Exception $e) {
    die("Error al contar asociados: " . $e->getMessage());
}

// 3.3 Sección 3: participantes que enviaron sugerencias para este evento
// Primero, obtener formularios habilitados del evento
$sql_formularios = "SELECT Id_Formulario, Actividad FROM formulario WHERE id_evento = :id_evento AND habilitado = 1";
try {
    $stmt_f = $conn->prepare($sql_formularios);
    $stmt_f->execute([':id_evento' => $id_evento]);
    $formularios = $stmt_f->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error al obtener formularios del evento: " . $e->getMessage());
}

$form_ids = [];
$form_actividades = [];
foreach ($formularios as $f) {
    $fid = intval($f['Id_Formulario']);
    $form_ids[] = $fid;
    $form_actividades[$fid] = $f['Actividad'];
}

$participants = []; // arreglo: [Id_Formulario => [ lista de participantes asociativos ]]
if (!empty($form_ids)) {
    // Consulta para cada formulario
    $sql_part = "
        SELECT 
            r.Id_Respuesta, r.Respuesta1, r.Respuesta2, r.Respuesta3, r.Respuesta4,
            a.Id_Asociado, a.Nombre, a.Apellido_Pat, a.Apellido_Mat, a.Fecha_Nacimiento,
            co.NumeroTelefono, co.Correo,
            z.NombreZona AS ZonaAsoc,
            u.Usuario AS UsuarioAsoc
        FROM respuestas r
        LEFT JOIN asociados a ON r.Id_Asociado = a.Id_Asociado
        LEFT JOIN contactos co ON a.Id_Contacto = co.Id_Contacto
        LEFT JOIN zona z ON a.Id_Zona = z.Id_Zona
        LEFT JOIN usuarios u ON a.Id_Usuario = u.Id_Usuario
        WHERE r.Id_Formulario = :id_formulario
          AND r.Id_Asociado IS NOT NULL
        ORDER BY a.Nombre, a.Apellido_Pat
    ";
    $stmt_part = $conn->prepare($sql_part);
    foreach ($form_ids as $fid) {
        $participants[$fid] = [];
        try {
            $stmt_part->execute([':id_formulario' => $fid]);
            $plist = $stmt_part->fetchAll(PDO::FETCH_ASSOC);
            if ($plist) {
                $participants[$fid] = $plist;
            }
        } catch (Exception $e) {
            // Opcional: registrar/loguear error pero continuar
            // error_log("Error al obtener participantes para formulario $fid: " . $e->getMessage());
        }
    }
}

// 4. Clase PDF extendida de FPDF
class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Logo
        $this->Image('../../img/logo/logoFinal2.png', 10, 6, 25);

        // Fecha y hora actual en esquina superior derecha
        $this->SetFont('Arial','',10);
        $this->SetXY(-60, 10); // Ajustar X e Y para alinearlo a la derecha
        $this->Cell(50, 6, 'Generado: ' . date("d/m/Y H:i:s"), 0, 0, 'R');

        // Título centrado
        $this->SetFont('Arial','B',14);
        $this->SetY(20); // bajamos para no pisar logo/fecha
        $this->Cell(0,10, utf8_decode('Reporte del Evento'), 0,1,'C');
        $this->Ln(2);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}


// 5. Crear PDF y agregar contenido
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// 5.1 Datos del evento seleccionado
$sql_evt = "
    SELECT 
      e.Nombre AS Evento, e.Fecha,
      c.Nombre AS Categoria,
      u.Zona AS ZonaUbic, u.Calle, u.NroLugar,
      h.Hora_Inicio, h.Hora_Final
    FROM eventos e
    LEFT JOIN categoria c ON e.Id_Categoria = c.Id_Categoria
    LEFT JOIN ubicacion u ON e.Id_Ubicacion = u.Id_Ubicacion
    LEFT JOIN horarios h ON e.Id_Horario = h.Id_Horario
    WHERE e.Id_Eventos = :id_evento
    LIMIT 1
";
try {
    $stmt_evt = $conn->prepare($sql_evt);
    $stmt_evt->execute([':id_evento' => $id_evento]);
    $evt = $stmt_evt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error al obtener datos del evento: " . $e->getMessage());
}

if ($evt) {
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,8, utf8_decode("Evento: {$evt['Evento']}"), 0,1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,6, utf8_decode("Fecha: {$evt['Fecha']}"), 0,1);
    $pdf->Cell(0,6, utf8_decode("Categoría: ".($evt['Categoria'] ?? 'N/A')), 0,1);
    $ubic_txt = trim((($evt['ZonaUbic'] ?? '') . " - " . ($evt['Calle'] ?? '') . " " . ($evt['NroLugar'] ?? '')));
    $pdf->Cell(0,6, utf8_decode("Ubicación: $ubic_txt"), 0,1);
    $hor_txt = "";
    if ($evt['Hora_Inicio'] !== null || $evt['Hora_Final'] !== null) {
        $hor_txt = trim((($evt['Hora_Inicio'] !== null ? $evt['Hora_Inicio'] : '') . " a " . ($evt['Hora_Final'] !== null ? $evt['Hora_Final'] : '')));
    }
    $pdf->Cell(0,6, utf8_decode("Horario: $hor_txt"), 0,1);
} else {
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,8, utf8_decode("Evento no encontrado (ID $id_evento)"), 0,1);
}
$pdf->Ln(4);

// 5.2 Sección 1: Lista de todos los eventos
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8, utf8_decode('1) Lista de eventos organizados:'), 0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,6, utf8_decode('Nombre'),1,0,'C');
$pdf->Cell(25,6, utf8_decode('Fecha'),1,0,'C');
$pdf->Cell(30,6, utf8_decode('Categoría'),1,0,'C');
$pdf->Cell(45,6, utf8_decode('Ubicación'),1,0,'C');
$pdf->Cell(30,6, utf8_decode('Horario'),1,1,'C');

$pdf->SetFont('Arial','',9);
foreach ($events as $ev) {
    $nombre = utf8_decode($ev['Evento']);
    $fecha = $ev['Fecha'];
    $cat = utf8_decode($ev['Categoria'] ?? '');
    $ubic = utf8_decode(trim(($ev['ZonaUbic'] ?? '') . " " . ($ev['Calle'] ?? '') . " " . ($ev['NroLugar'] ?? '')));

    $hor = "";
    if ($ev['Hora_Inicio'] !== null || $ev['Hora_Final'] !== null) {
        $hor = trim((($ev['Hora_Inicio'] !== null ? $ev['Hora_Inicio'] : '') . " - " . ($ev['Hora_Final'] !== null ? $ev['Hora_Final'] : '')));
    }
    $pdf->Cell(60,6, $nombre,1,0);
    $pdf->Cell(25,6, $fecha,1,0);
    $pdf->Cell(30,6, $cat,1,0);
    $pdf->Cell(45,6, $ubic,1,0);
    $pdf->Cell(30,6, $hor,1,1);
}
$pdf->Ln(4);

// 5.3 Sección 2: Cantidad total de asociados
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8, utf8_decode('2) Cantidad total de asociados habilitados:'), 0,1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,6, utf8_decode("Total de asociados: $total_asociados"), 0,1);
$pdf->Ln(4);

// 5.4 Sección 3: Participantes con sugerencias para este evento
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8, utf8_decode('3) Participantes con sugerencias en este evento:'), 0,1);

if (empty($form_ids) || count(array_filter($participants, fn($arr) => count($arr) > 0)) === 0) {
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,6, utf8_decode('No se encontraron participantes registrados con sugerencias para este evento.'), 0,1);
} else {
    foreach ($participants as $fid => $plist) {
        $actividad = $form_actividades[$fid] ?? '';
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(0,6, utf8_decode("Formulario ID $fid - Actividad: $actividad"), 0,1);
        // Encabezado de tabla interna
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,6, utf8_decode('ID'),1,0,'C');
        $pdf->Cell(40,6, utf8_decode('Nombre'),1,0,'C');
        $pdf->Cell(25,6, utf8_decode('Zona'),1,0,'C');
        $pdf->Cell(30,6, utf8_decode('Teléfono'),1,0,'C');
        $pdf->Cell(45,6, utf8_decode('Correo'),1,0,'C');
        $pdf->Cell(35,6, utf8_decode('Respuesta'),1,1,'C');


        // Filas de participantes
        $pdf->SetFont('Arial','',9);
        foreach ($plist as $p) {
            $id_as = $p['Id_Asociado'] !== null ? $p['Id_Asociado'] : '';
            $nom = utf8_decode(trim(($p['Nombre'] ?? '') . ' ' . ($p['Apellido_Pat'] ?? '') . ' ' . ($p['Apellido_Mat'] ?? '')));
            $zona_as = utf8_decode($p['ZonaAsoc'] ?? '');
            $contacto = utf8_decode(trim((($p['NumeroTelefono'] ?? '') . ' / ' . ($p['Correo'] ?? ''))));
            // Resumir respuestas
           $resp = '';
                if (!empty($p['Respuesta1'])) {
                    $resp = utf8_decode(mb_substr($p['Respuesta1'], 0, 35));
                    if (mb_strlen($p['Respuesta1']) > 35) {
                        $resp .= '...';
                    }
                }

            $resp = rtrim($resp, ' | ');
            // Celdas
            $pdf->Cell(15,6, $id_as,1,0,'C');
            $pdf->Cell(40,6, $nom,1,0);
            $pdf->Cell(25,6, $zona_as,1,0);
            $pdf->Cell(30,6, $p['NumeroTelefono'] ?? '',1,0);
            $pdf->Cell(45,6, $p['Correo'] ?? '',1,0);
            $pdf->Cell(35,6, $resp,1,1);

        }
        $pdf->Ln(3);
    }
}

// 6. Emitir PDF
$pdf->Output('I', utf8_decode("reporte_evento_{$id_evento}.pdf"));
exit;
