function solicitarPasswordProfesor(callback) {
    const modalEl = document.getElementById('modalPasswordProfesor');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();

    const form = document.getElementById('formVerificarPassword');
    const inputPassword = document.getElementById('passwordProfesor');
    const errorDiv = document.getElementById('errorPassword');

    errorDiv.textContent = '';

    form.onsubmit = function(e) {
        e.preventDefault(); 

        const password = inputPassword.value;

        fetch('/assets/modelo/login_profesor/verificar_password.php',{
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ password })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                modal.hide();
                inputPassword.value = '';
                callback(true);
            } else {
                errorDiv.textContent = data.message;
                callback(false);
            }
        })
        .catch(err => {
            console.error(err);
            errorDiv.textContent = 'Error al verificar contraseña.';
        });
    };
}
