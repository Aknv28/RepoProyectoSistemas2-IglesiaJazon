document.getElementById('form-curso').addEventListener('submit', function(event) {
    let valid = true; // Controlador de validación

    // Obtener elementos del formulario
    const grupoInput = document.getElementById('grupo');
    const edadMinInput = document.getElementById('edadMin');
    const edadMaxInput = document.getElementById('edadMax');
    const cantInput = document.getElementById('cant');

    // Obtener spans de error
    const grupoError = document.getElementById('error-grupo');
    const edadMinError = document.getElementById('error-edadMin');
    const edadMaxError = document.getElementById('error-edadMax');
    const cantError = document.getElementById('error-cant');

    // Limpiar errores previos
    [grupoError, edadMinError, edadMaxError, cantError].forEach(span => span.textContent = '');

    // Validar campo "Grupo" (Solo una letra mayúscula, sin caracteres especiales)
    let grupoValue = grupoInput.value.trim().toUpperCase(); // Convertir a mayúscula
    grupoInput.value = grupoValue; // Actualizar el valor del input a mayúscula

    // Validar que el grupo solo contenga una letra mayúscula
    if (!/^[A-Z]$/.test(grupoValue)) {
        grupoError.textContent = 'El grupo debe ser una sola letra mayúscula.';
        valid = false;
    }

    // Validar campo "Edad mínima"
    const edadMinValue = edadMinInput.value.trim();
    if (!/^\d+$/.test(edadMinValue)) {
        edadMinError.textContent = 'La edad mínima debe ser un número válido.';
        valid = false;
    } else if (parseInt(edadMinValue) < 5) {
        edadMinError.textContent = 'La edad mínima no puede ser menor a 5 años.';
        valid = false;
    } else if (parseInt(edadMinValue) > 16) {
        edadMinError.textContent = 'La edad mínima no puede ser mayor a 16 años.';
        valid = false;
    }

    // Validar campo "Edad máxima"
    const edadMaxValue = edadMaxInput.value.trim();
    if (!/^\d+$/.test(edadMaxValue)) {
        edadMaxError.textContent = 'La edad máxima debe ser un número válido.';
        valid = false;
    }

    // Validar que la edad máxima sea mayor que la edad mínima
    if (parseInt(edadMaxValue) <= parseInt(edadMinValue)) {
        edadMaxError.textContent = 'La edad máxima debe ser mayor que la edad mínima.';
        valid = false;
    } 

    // Validar campo "Cantidad máxima de niños"
    const cantValue = cantInput.value.trim();
    if (!/^\d+$/.test(cantValue)) {
        cantError.textContent = 'La cantidad máxima debe ser un número válido.';
        valid = false;
    } else if (parseInt(cantValue) > 20) {
        cantError.textContent = 'La cantidad máxima no puede superar los 20 niños.';
        valid = false;
    }

    // Si hay errores, prevenir el envío del formulario
    if (!valid) {
        event.preventDefault();
    }
});
