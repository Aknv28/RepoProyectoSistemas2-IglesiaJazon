<?php
require_once 'includes/bd.php';
require('fpdf/fpdf.php');

$conn = Database::getInstance();

// Inicializar PDF
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Reporte General - Iglesia Jazon',0,1,'C');
        $this->Ln(5);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// 1. Cantidad de eventos organizados
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'1. Eventos organizados:',0,1);

$stmt = $conn->prepare("SELECT Nombre_Actividad, Fecha FROM eventos WHERE habilitado = 1");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_eventos = count($eventos);

foreach ($eventos as $evento) {
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(0,8, "- {$evento['Nombre_Actividad']} ({$evento['Fecha']})", 0, 1);
}

$pdf->SetFont('Arial','I',11);
$pdf->Cell(0,10,"Total de eventos: $total_eventos",0,1);
$pdf->Ln(5);

// 2. Cantidad de integrantes (asociados)
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'2. Cantidad de integrantes registrados:',0,1);

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM asociados");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_asociados = $result['total'];

$pdf->SetFont('Arial','',11);
$pdf->Cell(0,10,"Total de asociados: $total_asociados",0,1);
$pdf->Ln(5);

// 3. Participantes y sugerencias
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'3. Participacion y sugerencias por evento:',0,1);

$sql = "SELECT e.Nombre_Actividad, r.Comentario
        FROM resultados r
        INNER JOIN eventos e ON r.Id_Eventos = e.Id_Eventos
        WHERE r.Comentario IS NOT NULL";
$stmt = $conn->prepare($sql);
$stmt->execute();
$sugerencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

$current_event = '';
foreach ($sugerencias as $s) {
    if ($current_event !== $s['Nombre_Actividad']) {
        $current_event = $s['Nombre_Actividad'];
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(0,8, "Evento: $current_event", 0, 1);
    }
    $pdf->SetFont('Arial','',11);
    $pdf->MultiCell(0, 8, "- Sugerencia: " . $s['Comentario'], 0);
}

$pdf->Output('D', 'reporte_jazon.pdf');
?>
