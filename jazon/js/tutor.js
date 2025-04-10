function validarFormulario() {
    var nombre = document.getElementById('nombre').value;
    var apellidoPaterno = document.getElementById('ape_pat').value;
    var apellidoMaterno = document.getElementById('ape_mat').value;
    var telefono = document.getElementById('num_telefono').value;
    var correo = document.getElementById('correo').value;

    var errorNombre = document.getElementById('error_nombre');
    var errorApellidoPaterno = document.getElementById('error_ape_pat');
    var errorApellidoMaterno = document.getElementById('error_ape_mat');
    var errorTelefono = document.getElementById('error_num_telefono');
    var errorCorreo = document.getElementById('error_correo');

    // Expresiones regulares
    var regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Permite letras y espacios
    var regexSoloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/; // Solo letras sin espacios
    var regexTelefono = /^\d{8}$/; // Solo 8 dígitos
    var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // Formato de correo válido

    var isValid = true; // Bandera para determinar si el formulario es válido
    errorNombre.textContent = "";
    errorApellidoPaterno.textContent = "";
    errorApellidoMaterno.textContent = "";
    errorTelefono.textContent = "";
    errorCorreo.textContent = "";
    
    
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
      isValid =  false;
    } 

    // Validar apellido paterno
    if (apellidoPaterno.length < 5 || apellidoPaterno.length > 30) {
      errorApellidoPaterno.textContent = "El apellido paterno debe tener entre 5 y 30 caracteres.";
      isValid= false;
    } else if (!regexSoloLetras.test(apellidoPaterno)) {
      errorApellidoPaterno.textContent = "El apellido paterno debe contener solo letras.";
      isValid =  false;
    } else if (repetirCaracteres(apellidoPaterno)) {
      errorApellidoPaterno.textContent = "El apellido paterno no puede tener caracteres repetidos más de dos veces consecutivas.";
      isValid = false;
    } else if (!validarPrimeraLetra(apellidoPaterno)) {
      errorApellidoPaterno.textContent = "El apellido paterno debe comenzar con mayúscula.";
      isValid = false;
    } 

    // Validar apellido materno
    if (apellidoMaterno.length < 5 || apellidoMaterno.length > 30) {
      errorApellidoMaterno.textContent = "El apellido materno debe tener entre 5 y 30 caracteres.";
      isValid = false;
    } else if (!regexSoloLetras.test(apellidoMaterno)) {
      errorApellidoMaterno.textContent = "El apellido materno debe contener solo letras.";
      isValid =  false;
    } else if (repetirCaracteres(apellidoMaterno)) {
      errorApellidoMaterno.textContent = "El apellido materno no puede tener caracteres repetidos más de dos veces consecutivas.";
      isValid =  false;
    } else if (!validarPrimeraLetra(apellidoMaterno)) {
      errorApellidoMaterno.textContent = "El apellido materno debe comenzar con mayúscula.";
      isValid =  false;
    } 

    // Validar número de teléfono
    if (!regexTelefono.test(telefono)) {
      errorTelefono.textContent = "El número de teléfono debe tener exactamente 8 dígitos.";
      isValid =  false;
    } 

    // Validar correo electrónico
    if (!regexCorreo.test(correo)) {
      errorCorreo.textContent = "Por favor, ingresa un correo electrónico válido.";
      isValid =  false;
    } 

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
