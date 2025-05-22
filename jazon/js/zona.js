function validarFormulario() {
    var nombre = document.getElementById('nombre_zona').value;

    var errorNombre = document.getElementById('error_nombre');

    // Expresiones regulares
    var regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Permite letras y espacios

    var isValid = true; // Bandera para determinar si el formulario es válido
    errorNombre.textContent = "";
    
    
    // Validar nombre
    if (nombre.length < 3 || nombre.length > 50) {
      errorNombre.textContent = "El nombre debe tener entre 5 y 50 caracteres.";
      isValid = false;
    } else if (!regexLetras.test(nombre)) {
      errorNombre.textContent = "El nombre debe contener solo letras y espacios.";
      isValid = false;
    } else if (repetirCaracteres(nombre)) {
      errorNombre.textContent = "El nombre no puede tener caracteres repetidos más de dos veces consecutivas.";
      isValid = false;
    } else if (!validarPrimeraLetra(nombre)) {
      errorNombre.textContent = "La primera letra del nombre debe ser mayúscula y las demás minúsculas.";
      isValid =  false;
    } 

    return isValid;
  }

  function repetirCaracteres(texto) {
    var regexRepetidos = /(.)\1\1/;
    return regexRepetidos.test(texto);
  }

  function validarPrimeraLetra(texto) {
    var textoFormateado = texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
    return texto === textoFormateado;
  }
