function validarFormulario() {
    let isValid = true;

    const camposTexto = [
        { id: 'actividad', errorId: 'error_actividad' },
        { id: 'pregunta1', errorId: 'error_pregunta1' },
        { id: 'pregunta2', errorId: 'error_pregunta2' },
        { id: 'pregunta3', errorId: 'error_pregunta3' },
        { id: 'pregunta4', errorId: 'error_pregunta4' }
    ];

    const regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    camposTexto.forEach(campo => {
        const input = document.getElementById(campo.id);
        const valor = input.value.trim();
        const error = document.getElementById(campo.errorId);
        error.textContent = "";

        if (valor.length < 5 || valor.length > 50) {
            error.textContent = "Debe tener entre 5 y 50 caracteres.";
            isValid = false;
        } else if (!regexLetras.test(valor)) {
            error.textContent = "Debe contener solo letras y espacios.";
            isValid = false;
        } else if (repetirCaracteres(valor)) {
            error.textContent = "No puede tener caracteres repetidos más de dos veces consecutivas.";
            isValid = false;
        } else if (!validarPrimeraLetra(valor)) {
            error.textContent = "Debe comenzar con mayúscula y seguir con minúsculas.";
            isValid = false;
        }
    });

    const horario = document.getElementById('horario').value;
    const errorHorario = document.getElementById('error_horario');
    errorHorario.textContent = "";
    if (!horario) {
        errorHorario.textContent = "Debe seleccionar un horario.";
        isValid = false;
    }

    const ubicacion = document.getElementById('id_ubicacion').value;
    const errorUbicacion = document.getElementById('error_ubicacion');
    errorUbicacion.textContent = "";
    if (!ubicacion) {
        errorUbicacion.textContent = "Debe seleccionar una ubicación.";
        isValid = false;
    }

    const fecha = document.getElementById('fecha').value;
    const fechaFin = document.getElementById('fecha_fin').value;
    const errorFecha = document.getElementById('error_fecha');
    const errorFechaFin = document.getElementById('error_fecha_fin');
    errorFecha.textContent = "";
    errorFechaFin.textContent = "";

    if (!fecha) {
        errorFecha.textContent = "Debe seleccionar una fecha.";
        isValid = false;
    } else {
        const fechaSeleccionada = new Date(fecha);
        const hoy = new Date();
        hoy.setHours(0,0,0,0);
        fechaSeleccionada.setHours(0,0,0,0);

        if (fechaSeleccionada < hoy) {
            errorFecha.textContent = "La fecha debe ser hoy o una fecha futura.";
            isValid = false;
        }
    }

    if (!fechaFin) {
        errorFechaFin.textContent = "Debe seleccionar una fecha de finalización.";
        isValid = false;
    } else if (fecha && fechaFin && fechaFin < fecha) {
        errorFechaFin.textContent = "La fecha final no puede ser anterior a la fecha de inicio.";
        isValid = false;
    }

    return isValid;
}

function repetirCaracteres(texto) {
    return /(.)\1\1/.test(texto);
}

function validarPrimeraLetra(texto) {
    const formateado = texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
    return texto === formateado;
}
