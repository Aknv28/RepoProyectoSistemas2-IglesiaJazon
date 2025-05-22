<script>
    function exportToPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Título del reporte
        doc.setFontSize(20);
        doc.text("Reporte de Actividad", 105, 20, null, null, 'center');

        // Sección de actividad
        doc.setFontSize(14);
        doc.setTextColor(40, 40, 40);
        doc.text("Actividad: <?php echo $actividad['actividad']; ?>", 20, 30);
        doc.text("Fecha: <?php echo date('d/m/Y', strtotime($actividad['fecha_act'])); ?>", 20, 40);

        // Agregar una línea separadora
        doc.setLineWidth(0.5);
        doc.line(20, 45, 190, 45);

        // Sección de grupo
        doc.text("Grupo: <?php echo $actividad['grupo']; ?>", 20, 55);

        // Sección de maestro
        doc.text("Maestro: <?php echo $actividad['maestro_nombre'] . ' ' . $actividad['ape_pat'] . ' ' . $actividad['ape_mat']; ?>", 20, 65);

        // Agregar una línea separadora
        doc.setLineWidth(0.5);
        doc.line(20, 80, 190, 80);

        // Información general en tabla
        doc.setFontSize(12);
        const startX = 20;
        const startY = 90;
        const rowHeight = 10;

        doc.text("INFORMACION GENERAL: ", startX, startY);

        // Crear la tabla con información
        doc.autoTable({
            startY: startY + 10,
            head: [
                ['Campo', 'Valor']
            ],
            body: [
                ['Actividad', '<?php echo $actividad['actividad']; ?>'],
                ['Descripción', '<?php echo $actividad['descripcion']; ?>'],
                ['Fecha', '<?php echo date('d/m/Y', strtotime($actividad['fecha_act'])); ?>'],
                ['Grupo', '<?php echo $actividad['grupo']; ?>'],
                ['Maestro', '<?php echo $actividad['maestro_nombre'] . ' ' . $actividad['ape_pat'] . ' ' . $actividad['ape_mat']; ?>'],
                ['Teléfono', '<?php echo $actividad['num_telefono']; ?>'],
                ['Cantidad de niños presentes', '<?php echo $actividad['cantidad_ninos_presentes']; ?>'],
                ['Niños presentes', '<?php echo $actividad['niños_presentes']; ?>']
            ],
            theme: 'grid',
            headStyles: {
                fillColor: [0, 102, 204],
                textColor: [255, 255, 255]
            },
            bodyStyles: {
                fontSize: 10
            },
            margin: {
                top: 100,
                bottom: 20
            }
        });

        // Descargar el archivo PDF
        doc.save('reporte_actividad.pdf');
    }
</script>