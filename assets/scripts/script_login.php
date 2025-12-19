<script>
    // script_login.php

    const formAlumno = document.getElementById('formAlumno');
    const formProfesor = document.getElementById('formProfesor');
    const switchFormBtn = document.getElementById('switchFormBtn');

    let currentForm = 'alumno';

    switchFormBtn.addEventListener('click', () => {
        if (currentForm === 'alumno') {
            formAlumno.classList.remove('active-form');
            formAlumno.classList.add('out-left');
            formProfesor.classList.remove('out-right');
            formProfesor.classList.add('active-form');
            currentForm = 'profesor';
            switchFormBtn.textContent = '<?php echo $textos['login_alumno']; ?>';
        } else {
            formProfesor.classList.remove('active-form');
            formProfesor.classList.add('out-right');
            formAlumno.classList.remove('out-left');
            formAlumno.classList.add('active-form');
            currentForm = 'alumno';
            switchFormBtn.textContent = '<?php echo $textos['login_profesor']; ?>';
        }
    });
    function mostrarToast(mensaje, tipo = 'danger') {
        const toastEl = document.getElementById('liveToast');
        const toastMensaje = document.getElementById('toastMensaje');

        toastMensaje.textContent = mensaje;
        toastEl.className = `toast align-items-center text-white bg-${tipo} border-0`;

        const bsToast = new bootstrap.Toast(toastEl);
        bsToast.show();
    }
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('inputPassword5');
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });
    document.getElementById('togglePasswordProfesor').addEventListener('click', function () {
        const input = document.getElementById('inputPasswordProfesor');
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });
    document.getElementById('nocontrol').addEventListener('input', function () {
    this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); 
    });
    document.getElementById('loginBtn').addEventListener('click', function () {
    const nocontrol = document.getElementById('nocontrol').value.trim();
    const password = document.getElementById('inputPassword5').value.trim();
    if (!nocontrol || !password) {
        mostrarToast('<?php echo $textos['login_campos']; ?>', 'warning');
        return;
    }
    document.getElementById('loadingOverlay').style.display = 'flex';
    fetch('assets/modelo/no_login/login_conexion.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `nocontrol=${encodeURIComponent(nocontrol)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.text())
        .then(text => {
        console.log("Respuesta cruda:", text);
        try {
            const data = JSON.parse(text);
            document.getElementById('loadingOverlay').style.display = 'none';
            if (data.success) {
            mostrarToast('<?php echo $textos['login_exitoso']; ?>', 'success');
            setTimeout(() => {
                window.location.href = '/assets/code_alumnos/index_alumnos.php';
            }, 1500);
            } else {
            mostrarToast(data.message || '<?php echo $textos['login_error']; ?>', 'danger');
            }
        } catch(e) {
            document.getElementById('loadingOverlay').style.display = 'none';
            mostrarToast('<?php echo $textos['login_error_2']; ?>', 'danger');
            console.error("Error parseando JSON:", e);
        }
        })
        .catch(error => {
        console.error('Error en fetch login:', error);
        document.getElementById('loadingOverlay').style.display = 'none';
        mostrarToast('<?php echo $textos['login_error_2']; ?>', 'danger');
        });
    });
    document.getElementById('loginProfesorBtn').addEventListener('click', function () {
    const matricula = document.getElementById('matriculaProfesor').value.trim();
    const password = document.getElementById('inputPasswordProfesor').value.trim();
    if (!matricula || !password) {
        mostrarToast('<?php echo $textos['login_campos']; ?>', 'warning');
        return;
    }
    document.getElementById('loadingOverlay').style.display = 'flex';
    fetch('assets/modelo/no_login/login_conexion.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `matricula=${encodeURIComponent(matricula)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('loadingOverlay').style.display = 'none';
        if (data.success) {
        mostrarToast('<?php echo $textos['login_exitoso']; ?>', 'success');
        setTimeout(() => {
            window.location.href = '/assets/code_profesor/index_profesor.php';
        }, 1500);
        } else {
        mostrarToast(data.message || '<?php echo $textos['login_error_3']; ?>', 'danger');
        }
    })
    .catch(error => {
        document.getElementById('loadingOverlay').style.display = 'none';
        mostrarToast('<?php echo $textos['login_error_2']; ?>', 'danger');
    });
    });
    window.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('fade-in');
    });
    document.querySelectorAll('a[href]').forEach(link => {
        const url = new URL(link.href, window.location.href);
        if (url.hostname === window.location.hostname && !url.href.includes('#') && !link.target) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            document.body.classList.remove('fade-in');
            document.body.classList.add('fade-out');
            setTimeout(() => {
            window.location.href = this.href;
            }, 500); 
        });
        }
    });
</script>