document.getElementById('form-enfermedad').addEventListener('submit', function (event) {
    const enfermedadInput = document.getElementById('enfermedad');
    const errorSpan = document.getElementById('error-enfermedad');

    // Expresión regular para validar solo letras y espacios
    const soloLetras = /^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/;

    // Validar la longitud mínima (mínimo 10 caracteres)
    if (enfermedadInput.value.trim().length < 10) {
        event.preventDefault(); // Detener el envío del formulario
        errorSpan.textContent = "La enfermedad debe tener al menos 10 caracteres."; // Mostrar el error
        return; // Detener la ejecución aquí
    }

    // Validar la longitud máxima (máximo 30 caracteres)
    if (enfermedadInput.value.trim().length > 30) {
        event.preventDefault(); // Detener el envío del formulario
        errorSpan.textContent = "La enfermedad no puede tener más de 30 caracteres."; // Mostrar el error
        return; // Detener la ejecución aquí
    }

    // Validar que no esté vacío o contenga solo espacios
    if (enfermedadInput.value.trim() === "") {
        event.preventDefault(); // Detener el envío del formulario
        errorSpan.textContent = "Por favor, ingrese una enfermedad válida."; // Mostrar el error
        return; // Detener la ejecución aquí
    }

    // Validar solo letras y espacios
    if (!soloLetras.test(enfermedadInput.value.trim())) {
        event.preventDefault(); // Detener el envío del formulario
        errorSpan.textContent = "Por favor, ingrese solo letras y espacios."; // Mostrar el error
        return; // Detener la ejecución aquí
    }

    // Validar que no haya caracteres repetidos más de dos veces consecutivas
    if (tieneCaracteresRepetidos(enfermedadInput.value.trim())) {
        event.preventDefault(); // Detener el envío del formulario
        errorSpan.textContent = "No se permiten caracteres repetidos más de dos veces consecutivas."; // Mostrar el error
        return; // Detener la ejecución aquí
    }

    // Validar que el texto no sea completamente aleatorio (debe contener al menos una vocal)
    if (!contieneVocal(enfermedadInput.value.trim())) {
        event.preventDefault(); // Detener el envío del formulario
        errorSpan.textContent = "Por favor, ingrese una enfermedad con al menos una vocal."; // Mostrar el error
        return; // Detener la ejecución aquí
    }

    // Si todo es válido, limpiar el error
    errorSpan.textContent = "";
});

// Función para verificar si hay caracteres repetidos más de dos veces consecutivas
function tieneCaracteresRepetidos(texto) {
    const regexRepetidos = /(.)\1\1/; // Verifica tres caracteres consecutivos iguales
    return regexRepetidos.test(texto);
}

// Función para verificar que el texto contiene al menos una vocal
function contieneVocal(texto) {
    const regexVocales = /[aeiouáéíóúAEIOUÁÉÍÓÚ]/; // Busca al menos una vocal en el texto
    return regexVocales.test(texto);
}
