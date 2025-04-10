document.addEventListener("DOMContentLoaded", function () {
    const maxAttempts = 3;
    let failedAttempts = 0;
    const blockTimeInSeconds = 15;
    let blockTime = 0;

    const loginForm = document.getElementById('loginForm');
    const usernameField = document.getElementById("username");
    const passwordField = document.getElementById("password");
    const roleField = document.getElementById("rol");
    const usernameError = document.getElementById("username-error");
    const passwordError = document.getElementById("password-error");
    const generalError = document.getElementById("general-error");

    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }

    usernameField.addEventListener('input', () => {
        if (usernameField.value.length > 8) {
            usernameField.value = usernameField.value.slice(0, 8);
        }
        usernameError.innerText = ''; // Limpiar error al escribir
    });

    passwordField.addEventListener('input', () => {
        if (passwordField.value.length > 8) {
            passwordField.value = passwordField.value.slice(0, 8);
        }
        passwordError.innerText = ''; // Limpiar error al escribir
    });

    function handleLogin(event) {
        event.preventDefault(); // Evitar el envío del formulario para procesarlo manualmente

        if (failedAttempts >= maxAttempts && blockTime > 0) {
            generalError.innerText = `Acceso bloqueado. Intenta nuevamente en ${blockTime} segundos.`;
            return;
        }

        const username = usernameField.value;
        const password = passwordField.value;

        // Validaciones de campos
        let isValid = true;

        if (!validateUsername(username)) {
            usernameError.innerText = "El nombre de usuario debe tener entre 6 y 8 caracteres, con letras y números, y ningún carácter puede repetirse más de dos veces.";
            isValid = false;
        } else {
            usernameError.innerText = '';
        }

        if (!validatePassword(password)) {
            passwordError.innerText = "La contraseña debe tener hasta 8 caracteres, con letras, números, $ @ *, y ningún carácter puede repetirse más de dos veces.";
            isValid = false;
        } else {
            passwordError.innerText = '';
        }

        if (!isValid) return;

        // Si todo está bien, enviamos los datos al servidor
        submitLogin(username, password);
    }

    function submitLogin(username, password) {
        fetch('process_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}&rol=${encodeURIComponent(roleField.value)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = data.redirect_url || "index2.php"; // Redirigir según el servidor
            } else {
                failedAttempts += 1; // Incrementar intentos fallidos
                passwordError.innerText = data.message;

                if (failedAttempts >= maxAttempts) {
                    blockTime = blockTimeInSeconds;
                    usernameField.disabled = true;
                    passwordField.disabled = true;
                    roleField.disabled = true;
                    generalError.innerText = `Acceso bloqueado. Intenta nuevamente en ${blockTime} segundos.`;

                    let countdown = setInterval(() => {
                        if (blockTime > 0) {
                            blockTime--;
                            generalError.innerText = `Acceso bloqueado. Intenta nuevamente en ${blockTime} segundos.`;
                        } else {
                            clearInterval(countdown);
                            failedAttempts = 0;
                            blockTime = 0;
                            usernameField.disabled = false;
                            passwordField.disabled = false;
                            roleField.disabled = false;
                            usernameField.value = '';
                            passwordField.value = '';
                            roleField.value = '';
                            generalError.innerText = '';
                        }
                    }, 1000);
                }
            }
        })
        .catch(error => {
            generalError.innerText = "Error de conexión con el servidor...";
            console.error('Error:', error);
        });
    }

    function validateUsername(username) {
        // Entre 6 y 8 caracteres, letras y números, sin repetir más de dos veces un carácter
        const usernameRegex = /^[a-zA-Z0-9]{6,8}$/;
        const noRepeatedChars = !/(.).*?\1.*?\1/.test(username);
        return usernameRegex.test(username) && noRepeatedChars;
    }

    function validatePassword(password) {
        // Hasta 8 caracteres, letras, números, $ @ *, sin repetir más de dos veces un carácter
        const passwordRegex = /^[a-zA-Z0-9$@*]{1,8}$/;
        const noRepeatedChars = !/(.).*?\1.*?\1/.test(password);
        return passwordRegex.test(password) && noRepeatedChars;
    }
});
