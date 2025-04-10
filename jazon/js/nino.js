function validarFormulario() {
    var nombre = document.getElementById('nombre').value;
    var apellidoPaterno = document.getElementById('apellido_paterno').value;
    var apellidoMaterno = document.getElementById('apellido_materno').value;
    var errorNombre = document.getElementById('error_nombre');
    var errorApellidoPaterno = document.getElementById('error_apellido_paterno');
    var errorApellidoMaterno = document.getElementById('error_apellido_materno');

    // Expresiones regulares
    var regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Permite letras y espacios
    var regexSoloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/; // Solo letras sin espacios

    var isValid = true; // Bandera para determinar si el formulario es válido

    // Resetear mensajes de error
    errorNombre.textContent = "";
    errorApellidoPaterno.textContent = "";
    errorApellidoMaterno.textContent = "";

    // Validar nombre
    if (nombre.length < 3 || nombre.length > 50) {
        errorNombre.textContent = "El nombre debe tener entre 3 y 50 caracteres.";
        isValid = false;
    } else if (!regexLetras.test(nombre)) {
        errorNombre.textContent = "El nombre debe contener solo letras y espacios.";
        isValid = false;
    } else if (repetirCaracteres(nombre)) {
        errorNombre.textContent = "El nombre no puede tener caracteres repetidos más de dos veces consecutivas.";
        isValid = false;
    } else if (!validarPrimeraLetra(nombre)) {
        errorNombre.textContent = "La primera letra del nombre debe ser mayúscula y las demás minúsculas.";
        isValid = false;
    }

    // Validar apellido paterno
    if (apellidoPaterno.length < 5 || apellidoPaterno.length > 30) {
        errorApellidoPaterno.textContent = "El apellido paterno debe tener entre 5 y 30 caracteres.";
        isValid = false;
    } else if (!regexSoloLetras.test(apellidoPaterno)) {
        errorApellidoPaterno.textContent = "El apellido paterno debe contener solo letras.";
        isValid = false;
    } else if (repetirCaracteres(apellidoPaterno)) {
        errorApellidoPaterno.textContent = "El apellido paterno no puede tener caracteres repetidos más de dos veces consecutivas.";
        isValid = false;
    } else if (!validarPrimeraLetra(apellidoPaterno)) {
        errorApellidoPaterno.textContent = "El apellido paterno debe comenzar con mayúscula y las demás letras en minúsculas.";
        isValid = false;
    }

    // Validar apellido materno
    if (apellidoMaterno.length < 5 || apellidoMaterno.length > 30) {
        errorApellidoMaterno.textContent = "El apellido materno debe tener entre 5 y 30 caracteres.";
        isValid = false;
    } else if (!regexSoloLetras.test(apellidoMaterno)) {
        errorApellidoMaterno.textContent = "El apellido materno debe contener solo letras.";
        isValid = false;
    } else if (repetirCaracteres(apellidoMaterno)) {
        errorApellidoMaterno.textContent = "El apellido materno no puede tener caracteres repetidos más de dos veces consecutivas.";
        isValid = false;
    } else if (!validarPrimeraLetra(apellidoMaterno)) {
        errorApellidoMaterno.textContent = "El apellido materno debe comenzar con mayúscula y las demás letras en minúsculas.";
        isValid = false;
    }

    // Retornar el estado general después de evaluar todos los campos
    return isValid;
}

// Función para verificar si un texto tiene caracteres repetidos más de dos veces consecutivas
function repetirCaracteres(texto) {
    var regexRepetidos = /(.)\1\1/;
    return regexRepetidos.test(texto);
}

// Función para validar que la primera letra sea mayúscula y las demás minúsculas
function validarPrimeraLetra(texto) {
    var textoFormateado = texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
    return texto === textoFormateado;
}
