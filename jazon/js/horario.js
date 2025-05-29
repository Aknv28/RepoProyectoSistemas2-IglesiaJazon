function validarHorario() {
    const horaInicio = parseInt(document.querySelector('input[name="hora_inicio"]').value);
    const horaFinal = parseInt(document.querySelector('input[name="hora_final"]').value);

    if (isNaN(horaInicio) || isNaN(horaFinal)) {
        alert("Ambas horas deben ser números.");
        return false;
    }

    if (horaInicio < 0 || horaInicio > 24 || horaFinal < 0 || horaFinal > 24) {
        alert("Las horas deben estar entre 0 y 24.");
        return false;
    }

    if (horaInicio >= horaFinal) {
        alert("La hora de inicio debe ser menor que la hora final.");
        return false;
    }

    return true;
}
