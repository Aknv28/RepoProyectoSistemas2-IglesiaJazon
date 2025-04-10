document.getElementById('form-actividad').addEventListener('submit', function (event) {
    let valid = true; // Controlador de validación

    // Obtener elementos del formulario
    const actividadInput = document.getElementById('actividad');
    const descripcionInput = document.getElementById('descripcion');
    const fechaInput = document.getElementById('fecha_act');
    const idCursoInput = document.getElementById('id_curso');

    // Obtener spans de error
    const actividadError = document.getElementById('error-actividad');
    const descripcionError = document.getElementById('error-descripcion');
    const fechaError = document.getElementById('error-fecha');
    const idCursoError = document.getElementById('error-id_curso');

    // Limpiar errores previos
    [actividadError, descripcionError, fechaError, idCursoError].forEach(span => span.textContent = '');

    // Validar campo "Actividad" (Primera letra mayúscula y sin caracteres repetidos consecutivos)
    let actividadValue = actividadInput.value.trim();
    actividadValue = actividadValue.charAt(0).toUpperCase() + actividadValue.slice(1); // Primera letra mayúscula
    actividadInput.value = actividadValue; // Actualizar el valor del input con la primera letra en mayúscula

    const actividadRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!actividadRegex.test(actividadValue)) {
        actividadError.textContent = 'Solo se permiten letras y espacios.';
        valid = false;
    }

    // Verificar que no haya caracteres repetidos consecutivos
    if (/([a-zA-ZáéíóúÁÉÍÓÚñÑ])\1/.test(actividadValue)) {
        actividadError.textContent = 'No se permiten caracteres repetidos consecutivos.';
        valid = false;
    }

    // Validar campo "Descripción"
    const descripcionValue = descripcionInput.value.trim();
    const descripcionRegex = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ,.!?]+$/;
    const palabrasDescripcion = descripcionValue.split(/\s+/).length; // Contar palabras
    if (!descripcionRegex.test(descripcionValue)) {
        descripcionError.textContent = 'La descripción solo puede contener letras, números y signos básicos de puntuación.';
        valid = false;
    } else if (palabrasDescripcion < 25) {
        descripcionError.textContent = 'La descripción debe contener al menos 25 palabras.';
        valid = false;
    }

    // Verificar que no haya caracteres repetidos consecutivos en la descripción
    if (/([a-zA-Z0-9áéíóúÁÉÍÓÚñÑ])\1/.test(descripcionValue)) {
        descripcionError.textContent = 'No se permiten caracteres repetidos consecutivos.';
        valid = false;
    }

    // Validar campo "Fecha"
    const fechaSeleccionada = new Date(fechaInput.value);
    const fechaActual = new Date();
    fechaActual.setHours(0, 0, 0, 0); // Normalizar a medianoche para comparar solo la fecha
    if (!fechaInput.value || fechaSeleccionada < fechaActual) {
        fechaError.textContent = 'La fecha debe ser actual o futura.';
        valid = false;
    }

    // Validar campo "ID Curso" (Solo números)
    const idCursoValue = idCursoInput.value.trim();
    const idCursoRegex = /^[0-9]+$/;
    if (!idCursoRegex.test(idCursoValue)) {
        idCursoError.textContent = 'Solo se permiten números.';
        valid = false;
    }

    // Evitar el envío del formulario si hay errores
    if (!valid) {
        event.preventDefault();
    }
});
