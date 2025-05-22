document.querySelector('form').addEventListener('submit', function (event) {
    // Limpiar mensajes de error previos
    document.querySelectorAll('.error-msg').forEach(msg => msg.textContent = '');

    let isValid = true;

    // Obtener valores de los campos
    const nombreEvento = document.getElementById('evento').value.trim();
    const fechaEvento = document.getElementById('fecha').value;
    const descripcionEvento = document.getElementById('descripcion').value.trim();
    const imagenEvento = document.getElementById('imagen').value;

    // Validar el nombre del evento (solo letras, primera letra de cada palabra mayúscula, sin caracteres repetidos consecutivamente y longitud entre 10 y 40)
    const nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    const nombreConMayusculas = nombreEvento.replace(/\b\w/g, letter => letter.toUpperCase());
    const noRepetirConsecutivos = !(/([a-zA-ZáéíóúÁÉÍÓÚñÑ])\1/.test(nombreEvento)); // Validar que no haya caracteres repetidos consecutivamente
    if (!nombreRegex.test(nombreEvento)) {
        document.getElementById('error-evento').textContent = 'El nombre solo puede contener letras y espacios.';
        isValid = false;
    } else if (nombreEvento.length < 10 || nombreEvento.length > 40) {
        document.getElementById('error-evento').textContent = 'El nombre debe tener entre 10 y 40 caracteres.';
        isValid = false;
    } else if (!noRepetirConsecutivos) {
        document.getElementById('error-evento').textContent = 'No se permiten caracteres repetidos consecutivamente.';
        isValid = false;
    } else if (nombreEvento !== nombreConMayusculas) {
        document.getElementById('error-evento').textContent = 'La primera letra de cada palabra debe ser mayúscula.';
        isValid = false;
    }

    // Validar la fecha del evento (solo años a partir de 2024)
    const fechaMinima = new Date('2024-01-01');
    const fechaIngresada = new Date(fechaEvento);
    if (!fechaEvento || fechaIngresada < fechaMinima) {
        document.getElementById('error-fecha').textContent = 'La fecha debe ser igual o posterior al 1 de enero de 2024.';
        isValid = false;
    }

    // Validar la descripción (sin caracteres repetidos consecutivamente)
    const descripcionRegex = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s.,:;!?()@#$%&*-_]+$/;
    const noRepetirConsecutivosDescripcion = !(/([a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s.,:;!?()@#$%&*-_])\1/.test(descripcionEvento)); // Validar que no haya caracteres repetidos consecutivamente
    if (!descripcionRegex.test(descripcionEvento)) {
        document.getElementById('error-descripcion').textContent = 'La descripción solo puede contener letras, números y ciertos caracteres especiales.';
        isValid = false;
    } else if (!noRepetirConsecutivosDescripcion) {
        document.getElementById('error-descripcion').textContent = 'No se permiten caracteres repetidos consecutivamente.';
        isValid = false;
    }

    // Validar el formato de la imagen (png, jpg, gif)
    const imagenRegex = /\.(png|jpg|jpeg|gif)$/i;
    if (imagenEvento && !imagenRegex.test(imagenEvento)) {
        document.getElementById('error-imagen').textContent = 'Solo se permiten imágenes en formato PNG, JPG o GIF.';
        isValid = false;
    }

    // Prevenir el envío del formulario si hay errores
    if (!isValid) {
        event.preventDefault();
    }
});
