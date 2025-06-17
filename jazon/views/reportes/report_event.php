<?php
session_start();
require_once '../../includes/bd.php';
require_once '../../fpdf/fpdf.php';

try {
    $conn = Database::getInstance();
    $conn->exec("SET NAMES utf8mb4");
} catch (Exception $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

$id_evento = filter_input(INPUT_GET, 'Id_Evento', FILTER_VALIDATE_INT);
if (!$id_evento) {
    die("Parámetro Id_Evento inválido.");
}

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
$stmt_events = $conn->query($sql_events);
$events = $stmt_events->fetchAll(PDO::FETCH_ASSOC);

// Asociados
$sql_asociados = "
    SELECT a.Id_Asociado, a.Nombre, a.Apellido_Pat, a.Apellido_Mat,
            z.NombreZona AS Zona, u.Calle, u.NroLugar,
            c.NumeroTelefono, c.Correo
    FROM asociados a
    LEFT JOIN zona z ON a.Id_Zona = z.Id_Zona
    LEFT JOIN contactos c ON a.Id_Contacto = c.Id_Contacto
    LEFT JOIN ubicacion u ON u.Id_Ubicacion = a.Id_Zona
    WHERE a.habilitado = 1
    ORDER BY a.Id_Asociado ASC
";
$stmt_aso = $conn->prepare($sql_asociados);
$stmt_aso->execute();
$asociados = $stmt_aso->fetchAll(PDO::FETCH_ASSOC);

// Formularios y preguntas
$sql_formularios = "SELECT Id_Formulario, Actividad, Pregunta1, Pregunta2, Pregunta3, Pregunta4 FROM formulario WHERE id_evento = :id_evento AND habilitado = 1";
$stmt_f = $conn->prepare($sql_formularios);
$stmt_f->execute([':id_evento' => $id_evento]);
$formularios = $stmt_f->fetchAll(PDO::FETCH_ASSOC);

$form_ids = [];
$preguntas_por_formulario = [];
foreach ($formularios as $f) {
    $form_ids[] = intval($f['Id_Formulario']);
    $preguntas_por_formulario[$f['Id_Formulario']] = [
        'Actividad' => $f['Actividad'],
        'Pregunta1' => $f['Pregunta1'],
        'Pregunta2' => $f['Pregunta2'],
        'Pregunta3' => $f['Pregunta3'],
        'Pregunta4' => $f['Pregunta4']
    ];
}

$participants = [];
if (!empty($form_ids)) {
    $sql_part = "
        SELECT
            r.Id_Respuesta, r.Id_Formulario, r.Respuesta1, r.Respuesta2, r.Respuesta3, r.Respuesta4,
            a.Id_Asociado, a.Nombre, a.Apellido_Pat, a.Apellido_Mat
        FROM respuestas r
        LEFT JOIN asociados a ON r.Id_Asociado = a.Id_Asociado
        WHERE r.Id_Formulario = :id_formulario AND r.Id_Asociado IS NOT NULL
    ";
    $stmt_part = $conn->prepare($sql_part);
    foreach ($form_ids as $fid) {
        $stmt_part->execute([':id_formulario' => $fid]);
        $participants[$fid] = $stmt_part->fetchAll(PDO::FETCH_ASSOC);
    }
}

class PDF extends FPDF {
    protected $preguntasData = [];

    function setPreguntasData($data) {
        $this->preguntasData = $data;
    }

    function Header() {
        $this->Image('../../img/logo/logoFinal2.png', 10, 6, 25);
        $this->SetFont('Arial','',10);
        $this->SetXY(-60, 10);
        $this->Cell(50, 6, 'Generado: ' . date("d/m/Y H:i:s"), 0, 0, 'R');
        $this->SetFont('Arial','B',14);
        $this->SetY(20);
        $this->Cell(0,10, utf8_decode('Reporte del Evento'), 0,1,'C');
        $this->Ln(2);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

    // Método mejorado para dibujar una fila de tabla con MultiCell y manejo de salto de página
    // Asegura que toda la fila (incluyendo el MultiCell) se mantenga junta y las celdas se alineen verticalmente.
    function RowMultiCell($data, $widths, $aligns, $cellHeightPerLine, $desiredLines = 4) {
        // Guarda la posición actual
        $x = $this->GetX();
        $y = $this->GetY();

        // Calcular la altura real que la MultiCell de respuestas necesitará
        // Asume que el último elemento en $data es el texto para MultiCell
        $multiCellText = $data[2]; // Ajusta el índice si la estructura de $data cambia
        $multiCellWidth = $widths[2]; // Ancho de la MultiCell de respuestas

        // Simula el MultiCell para obtener su altura.
        // GetStringWidth es útil para saber si el texto ocupará varias líneas
        // Puedes refinar esto para ser más preciso con el cálculo de MultiCell
        $nb = 0; // Número de líneas
        if (!empty($multiCellText)) {
            $textWidth = $this->GetStringWidth($multiCellText);
            // Calcula aproximadamente cuántas líneas el MultiCell ocupará
            $nb = ceil($textWidth / $multiCellWidth);
            if ($nb == 0) $nb = 1; // Si el texto es muy corto, al menos una línea
        } else {
            $nb = 1; // Si no hay texto, asume al menos una línea para la MultiCell
        }
        $actualMultiCellHeight = $nb * $cellHeightPerLine;

        // La altura final de la fila será el máximo entre la altura deseada y la altura real de MultiCell
        $rowHeight = max($desiredLines * $cellHeightPerLine, $actualMultiCellHeight);

        // Verifica si hay suficiente espacio para la fila completa
        // Si no, añade una nueva página
        if ($this->GetY() + $rowHeight > $this->PageBreakTrigger) {
            $this->AddPage();
            // Opcional: Redibuja los encabezados de la tabla en la nueva página
            $this->SetFont('Arial','B',10);
            $this->Cell($widths[0],$cellHeightPerLine, 'ID',1,0,'C');
            $this->Cell($widths[1],$cellHeightPerLine, 'Nombre',1,0,'C');
            $this->Cell($widths[2],$cellHeightPerLine, 'Respuestas',1,1,'C');
            $this->SetFont('Arial','',9);
            // Restablece el 'y' después de los encabezados de la nueva página
            $y = $this->GetY();
            $x = $this->GetX(); // Restablece x también
        }

        // Dibuja las celdas
        // Celda ID
        $this->Cell($widths[0], $rowHeight, $data[0], 1, 0, $aligns[0]);

        // Celda Nombre
        $this->Cell($widths[1], $rowHeight, $data[1], 1, 0, $aligns[1]);

        // Mueve el puntero para la MultiCell
        $this->SetXY($x + $widths[0] + $widths[1], $y);

        // MultiCell para Respuestas
        $this->MultiCell($widths[2], $cellHeightPerLine, $data[2], 1, $aligns[2]);

        // Asegura que el puntero Y esté al final de la fila dibujada
        $this->SetY($y + $rowHeight);

        // Restaura la posición X inicial para la siguiente fila
        $this->SetX(10); // Asumiendo un margen izquierdo de 10mm
    }

    // Helper para calcular el número de líneas que MultiCell ocupará
    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb == 0)
            return 1;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

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
$stmt_evt = $conn->prepare($sql_evt);
$stmt_evt->execute([':id_evento' => $id_evento]);
$evt = $stmt_evt->fetch(PDO::FETCH_ASSOC);

if ($evt) {
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,8, utf8_decode("Evento: {$evt['Evento']}"), 0,1);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,6, utf8_decode("Fecha: {$evt['Fecha']}"), 0,1);
    $pdf->Cell(0,6, utf8_decode("Categoría: ".($evt['Categoria'] ?? 'N/A')), 0,1);
    $ubic_txt = trim((($evt['ZonaUbic'] ?? '') . " - " . ($evt['Calle'] ?? '') . " " . ($evt['NroLugar'] ?? '')));
    $pdf->Cell(0,6, utf8_decode("Ubicación: $ubic_txt"), 0,1);
    $hor_txt = trim((($evt['Hora_Inicio'] ?? '') . " a " . ($evt['Hora_Final'] ?? '')));
    $pdf->Cell(0,6, utf8_decode("Horario: $hor_txt"), 0,1);
}
$pdf->Ln(4); // Espacio después de la información del evento



// Sección 3: Participantes con sugerencias
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8, utf8_decode('3) Participantes con sugerencias para este evento:'), 0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6, 'ID',1,0,'C');
$pdf->Cell(60,6, 'Nombre',1,0,'C');
$pdf->Cell(110,6, 'Respuestas',1,1,'C');
$pdf->SetFont('Arial','',9);

// Altura de línea estándar para FPDF (generalmente 6mm)
$singleLineHeight = 6;
// Altura deseada en número de líneas para la celda de respuestas
$desiredLinesForResponse = 4;

// Función anónima para redibujar los encabezados de la tabla de participantes
// cuando ocurre un salto de página.
$redrawParticipantsHeader = function() use ($pdf, $singleLineHeight) {
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20, $singleLineHeight, 'ID', 1, 0, 'C');
    $pdf->Cell(60, $singleLineHeight, 'Nombre', 1, 0, 'C');
    $pdf->Cell(110, $singleLineHeight, 'Respuestas', 1, 1, 'C');
    $pdf->SetFont('Arial','',9);
};


foreach ($participants as $form_id => $plist) {
    foreach ($plist as $p) {
        $nombre = utf8_decode($p['Nombre'] . ' ' . $p['Apellido_Pat'] . ' ' . $p['Apellido_Mat']);
        $respuestas = "";
        $current_form_preguntas = $preguntas_por_formulario[$p['Id_Formulario']] ?? null;

        for ($i = 1; $i <= 4; $i++) {
            $campoRespuesta = 'Respuesta' . $i;
            $campoPregunta = 'Pregunta' . $i;

            if (!empty($p[$campoRespuesta])) {
                $preguntaTexto = $current_form_preguntas[$campoPregunta] ?? "Rpta$i";
                // Limita la longitud de la pregunta para evitar que la línea de respuesta sea demasiado larga.
                // Ajusta este valor si es necesario, o incluso quítalo si las preguntas no son excesivamente largas
                // y el espacio en la celda de respuestas lo permite.
                $preguntaTexto_limitado = substr($preguntaTexto, 0, 40); // Ajustado a 40 para un ejemplo
                // Podrías añadir "..." si se corta
                if (strlen($preguntaTexto) > 40) {
                     $preguntaTexto_limitado .= "...";
                }
                $respuestas .= utf8_decode("{$preguntaTexto_limitado}: {$p[$campoRespuesta]}\n");
            }
        }

        // Datos para la fila
        $rowData = [
            $p['Id_Asociado'],
            $nombre,
            $respuestas
        ];
        // Anchos de las columnas
        $columnWidths = [20, 60, 110];
        // Alineación de las columnas
        $columnAligns = ['C', 'C', 'L']; // 'L' para las respuestas, ya que pueden ser largas

        // Llama al método RowMultiCell para dibujar la fila con manejo de salto de página
        $pdf->RowMultiCell($rowData, $columnWidths, $columnAligns, $singleLineHeight, $desiredLinesForResponse, $redrawParticipantsHeader);
    }
}
$pdf->Ln(4);

// Eventos organizados (sección 1)
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8, utf8_decode('1) Lista de eventos organizados:'), 0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,6, utf8_decode('Nombre'),1,0,'C');
$pdf->Cell(25,6, 'Fecha',1,0,'C');
$pdf->Cell(30,6, utf8_decode('Categoría'),1,0,'C');
$pdf->Cell(45,6, utf8_decode('Ubicación'),1,0,'C');
$pdf->Cell(30,6, 'Horario',1,1,'C');
$pdf->SetFont('Arial','',9);
foreach ($events as $ev) {
    $ubic = utf8_decode(trim(($ev['ZonaUbic'] ?? '') . " " . ($ev['Calle'] ?? '') . " " . ($ev['NroLugar'] ?? '')));
    $hor = trim((($ev['Hora_Inicio'] ?? '') . " - " . ($ev['Hora_Final'] ?? '')));
    $pdf->Cell(60,6, utf8_decode($ev['Evento']),1,0,'C');
    $pdf->Cell(25,6, $ev['Fecha'],1,0,'C');
    $pdf->Cell(30,6, utf8_decode($ev['Categoria']),1,0,'C');
    $pdf->Cell(45,6, $ubic,1,0,'C');
    $pdf->Cell(30,6, $hor,1,1,'C');
}
$pdf->Ln(4);

// Sección 2: Asociados habilitados (tu sección original 2)
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8, utf8_decode('2) Lista de asociados habilitados:'), 0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,6,'ID',1,0,'C');
$pdf->Cell(45,6,'Nombre',1,0,'C');
$pdf->Cell(50,6,utf8_decode('Ubicación'),1,0,'C');
$pdf->Cell(30,6,'Teléfono',1,0,'C');
$pdf->Cell(50,6,'Correo',1,1,'C');
$pdf->SetFont('Arial','',9);
foreach ($asociados as $a) {
    $nombre = utf8_decode($a['Nombre'] . ' ' . $a['Apellido_Pat'] . ' ' . $a['Apellido_Mat']);
    $ubic = utf8_decode(trim(($a['Zona'] ?? '') . ' ' . ($a['Calle'] ?? '') . ' ' . ($a['NroLugar'] ?? '')));
    $pdf->Cell(15,6, $a['Id_Asociado'],1,0,'C');
    $pdf->Cell(45,6, $nombre,1,0,'C');
    $pdf->Cell(50,6, $ubic,1,0,'C');
    $pdf->Cell(30,6, $a['NumeroTelefono'],1,0,'C');
    $pdf->Cell(50,6, utf8_decode($a['Correo']),1,1,'C');
}
$pdf->Ln(4);


$pdf->Output('I', utf8_decode("reporte_evento_{$id_evento}.pdf"));
exit;
?>