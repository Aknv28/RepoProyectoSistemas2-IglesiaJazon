document.getElementById('form-notificacion').addEventListener('submit', function (event) {
    let valid = true; // Controlador de validación

    // Obtener elementos del formulario
    const contenidoInput = document.getElementById('contenido');
    
    // Limpiar errores previos
    const contenidoError = document.getElementById('error-contenido');
    contenidoError.textContent = '';

    // Validar longitud del contenido (máximo 50 caracteres)
    if (contenidoInput.value.length > 50) {
        contenidoError.textContent = 'El contenido no puede tener más de 50 caracteres.';
        valid = false;
    }

    // Validar que solo contenga letras, números, espacios y signos básicos
    const contenidoRegex = /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ,.!?]+$/;
    if (!contenidoRegex.test(contenidoInput.value)) {
        contenidoError.textContent = 'El contenido contiene caracteres no permitidos.';
        valid = false;
    }

    // Validar que no haya 3 o más letras consecutivas
    if (/([a-zA-Z])\1{2,}/.test(contenidoInput.value)) {
        contenidoError.textContent = 'El contenido no puede contener 3 o más letras consecutivas.';
        valid = false;
    }

    // Evitar el envío del formulario si hay errores
    if (!valid) {
        event.preventDefault();
    }
});
