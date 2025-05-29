function validarFormulario() {
    var nombre = document.getElementById('nombre').value;
    var apellidoPaterno = document.getElementById('apellido_pat').value;
    var apellidoMaterno = document.getElementById('apellido_mat').value;
    var errorNombre = document.getElementById('error_nombre');
    var errorApellidoPaterno = document.getElementById('error_apellido_paterno');
    var errorApellidoMaterno = document.getElementById('error_apellido_materno');

    var regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    var regexSoloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/;

    var isValid = true;

    // Reset errores
    errorNombre.textContent = "";
    errorApellidoPaterno.textContent = "";
    errorApellidoMaterno.textContent = "";

    if (nombre.length < 3 || nombre.length > 50) {
        errorNombre.textContent = "El nombre debe tener entre 3 y 50 caracteres.";
        isValid = false;
    } else if (!regexLetras.test(nombre)) {
        errorNombre.textContent = "El nombre debe contener solo letras y espacios.";
        isValid = false;
    } else if (repetirCaracteres(nombre)) {
        errorNombre.textContent = "No se permiten caracteres repetidos más de dos veces consecutivas.";
        isValid = false;
    } else if (!validarPrimeraLetra(nombre)) {
        errorNombre.textContent = "La primera letra debe ser mayúscula y las demás minúsculas.";
        isValid = false;
    }

    if (apellidoPaterno.length < 3 || apellidoPaterno.length > 30) {
        errorApellidoPaterno.textContent = "El apellido paterno debe tener entre 3 y 30 caracteres.";
        isValid = false;
    } else if (!regexSoloLetras.test(apellidoPaterno)) {
        errorApellidoPaterno.textContent = "Debe contener solo letras.";
        isValid = false;
    } else if (repetirCaracteres(apellidoPaterno)) {
        errorApellidoPaterno.textContent = "No se permiten caracteres repetidos más de dos veces consecutivas.";
        isValid = false;
    } else if (!validarPrimeraLetra(apellidoPaterno)) {
        errorApellidoPaterno.textContent = "Debe comenzar con mayúscula y continuar en minúscula.";
        isValid = false;
    }

    if (apellidoMaterno.length < 3 || apellidoMaterno.length > 30) {
        errorApellidoMaterno.textContent = "El apellido materno debe tener entre 3 y 30 caracteres.";
        isValid = false;
    } else if (!regexSoloLetras.test(apellidoMaterno)) {
        errorApellidoMaterno.textContent = "Debe contener solo letras.";
        isValid = false;
    } else if (repetirCaracteres(apellidoMaterno)) {
        errorApellidoMaterno.textContent = "No se permiten caracteres repetidos más de dos veces consecutivas.";
        isValid = false;
    } else if (!validarPrimeraLetra(apellidoMaterno)) {
        errorApellidoMaterno.textContent = "Debe comenzar con mayúscula y continuar en minúscula.";
        isValid = false;
    }

    var telefono = document.getElementById('contacto').value;
    var errorTelefono = document.getElementById('error_telefono');
    errorTelefono.textContent = "";
    
    if (!/^[67][0-9]{7}$/.test(telefono)) {
        errorTelefono.textContent = "El número debe comenzar con 6 o 7 y tener 8 dígitos.";
        isValid = false;
    } else if (parseInt(telefono) < 60000000 || parseInt(telefono) > 79999999) {
        errorTelefono.textContent = "El número debe estar entre 60000000 y 79999999.";
        isValid = false;
    }
    
    return isValid;
}

function repetirCaracteres(texto) {
    return /(.)\1\1/.test(texto);
}

function validarPrimeraLetra(texto) {
    var textoFormateado = texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
    return texto === textoFormateado;
}
