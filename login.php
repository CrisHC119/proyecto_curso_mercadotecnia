<?php
  session_start();

  if (isset($_SESSION['id_usuario'])) {
      session_unset(); 
      session_destroy(); 
      header("Location: login.php");
      exit;
  }
  $idioma = $_GET['lang'] ?? $_SESSION['lang'] ?? 'es';
  $_SESSION['lang'] = $idioma; 

  $rutaArchivo = __DIR__ . "/assets/lang/lang_{$idioma}.json";
  if (!file_exists($rutaArchivo)) {
      $rutaArchivo = __DIR__ . "/assets/lang/lang_es.json"; 
  }
  $json = file_get_contents($rutaArchivo);
  $textos = json_decode($json, true);
?>
<!DOCTYPE html>
  <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title><?php echo $textos['login']; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="icon" href="/assets/images/icons/icon_50_tecnm.jpg" type="image/jpg">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <style>
        body {
          opacity: 0;
          transition: opacity 0.5s ease-in-out;
        }

        body.fade-in {
          opacity: 1;
        }

        body.fade-out {
          opacity: 0;
        }
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
          background-image: url('/assets/images/background/background_login.jpg');
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
        }

        .center-container {
          min-height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 1rem;
        }

        .formulario {
          width: 100%;
          max-width: 460px;
          transition: all 0.4s ease-in-out;
          opacity: 0;
          transform: translateX(100%);
          z-index: 0;
          position: absolute;
        }

        .formulario.active-form {
          opacity: 1;
          transform: translateX(0);
          z-index: 1;
        }

        .formulario.out-left {
          transform: translateX(-100%);
        }

        .formulario.out-right {
          transform: translateX(100%);
        }

        .card {
          backdrop-filter: blur(10px);
          background-color: rgba(255, 255, 255, 0.85);
          border-radius: 16px;
          width: 100%;
        }

        .logo-container {
          display: flex;
          align-items: center;
          justify-content: center;
          margin-bottom: 20px;
        }

        .logo-container img {
          width: 40px;
          height: 40px;
          margin-right: 10px;
        }

        .logo-text {
          font-size: 1.5rem;
          font-weight: bold;
        }

        #loadingOverlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.6);
          z-index: 9999;
          display: none;
          align-items: center;
          justify-content: center;
        }

        #togglePassword i,
        #togglePasswordProfesor i {
          color: #555;
        }

        #togglePassword:hover i,
        #togglePasswordProfesor:hover i {
          color: #000;
        }

        #switchFormBtn {
          position: absolute;
          top: 15px;
          right: 15px;
          z-index: 100;
        }
       @media (max-width: 576px) {
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-image: url('/assets/images/background/background_login.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
  }

  .center-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 8px;
    box-sizing: border-box;
  }

  .formulario {
    max-width: 300px;
    padding: 0.8rem !important;
    transition: opacity 0.4s ease-in-out;
    position: absolute;
  }

  .formulario.active-form {
    opacity: 1;
    z-index: 1;
  }

  .formulario:not(.active-form) {
    opacity: 0;
    z-index: 0;
  }

  .card {
    padding: 0.8rem !important;
    border-radius: 10px;
    backdrop-filter: blur(6px);
    background-color: rgba(255, 255, 255, 0.88);
  }

  .logo-container img {
    width: 28px;
    height: 28px;
    margin-right: 6px;
  }

  .logo-text {
    font-size: 0.95rem;
  }

  .mensaje_1, .mensaje_2 {
    font-size: 0.65rem;
    text-align: center;
    margin-top: 8px;
  }

  .form-control {
    font-size: 0.75rem;
    padding: 0.4rem 0.6rem;
  }

  .form-floating label {
    font-size: 0.75rem;
  }

  .btn {
    font-size: 0.75rem;
    padding: 0.35rem 0.8rem;
  }

  #switchFormBtn {
    font-size: 0.65rem;
    padding: 2px 5px;
  }

  #loadingOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
  }
}

      </style>
    </head>
    <body>
    <button id="switchFormBtn" class="btn btn-outline-light"><?php echo $textos['login_profesor']; ?></button>
    <div id="loadingOverlay">
      <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden"><?php echo $textos['cargando']; ?></span>
      </div>
    </div>

    <div class="container center-container">
      <div id="formAlumno" class="formulario active-form">
        <div class="card shadow-lg p-4">
          <div class="card-body">
            <div class="logo-container">
              <img src="/assets/images/navbar/TecNM Gestion Empresarial.png" alt="Logo">
              <span class="logo-text"><?php echo $textos['titulo']; ?></span>
            </div>
            <h3 class="card-title mb-2 text-center"><?php echo $textos['login']; ?></h3>
            <p class="text-muted mensaje_1 mb-4 text-center"><?php echo $textos['login_frase']; ?></p>
          <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="nocontrol" name="nocontrol" placeholder="Número de Control" maxlength="8" required>
            <label for="nocontrol"><?php echo $textos['no_control']; ?></label>
          </div>
          <div class="form-floating mb-3 position-relative">
            <input type="password" class="form-control pe-5" id="inputPassword5" name="password" placeholder="Contraseña" maxlength="20" required>
            <label for="inputPassword5"><?php echo $textos['password']; ?></label>
            <button type="button" id="togglePassword" class="btn btn-outline-secondary border-0 rounded-circle position-absolute top-50 end-0 translate-middle-y me-2 p-2">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <div class="form-text mensaje_2 mb-3 text-center"><?php echo $textos['aviso_password']; ?></div>
          <button id="loginBtn" class="btn btn-primary w-100"><?php echo $textos['login']; ?></button>
          <div class="text-center mt-3">
            <span class="mensaje_1"><?php echo $textos['aviso_registrar_1']; ?></span>
            <a href="/register.php" class="text-primary mensaje_1 fw-bold text-decoration-none"><?php echo $textos['aviso_registrar_2']; ?></a>
          </div>
        </div>
      </div>
    </div>

    <div id="formProfesor" class="formulario out-right">
      <div class="card shadow-lg p-4">
        <div class="card-body">
          <div class="logo-container">
            <img src="/assets/images/navbar/TecNM Gestion Empresarial.png" alt="Logo">
            <span class="logo-text"><?php echo $textos['titulo']; ?></span>
          </div>
          <h3 class="card-title mb-2 text-center"><?php echo $textos['login_profesor']; ?></h3>
          <p class="text-muted mensaje_1 mb-4 text-center"><?php echo $textos['login_frase_profesor']; ?></p>
          <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="nocontrolProfesor" name="nocontrol" placeholder="Matrícula" maxlength="10" required>
            <label for="nocontrolProfesor"><?php echo $textos['login_matricula']; ?></label>
          </div>
          <div class="form-floating mb-3 position-relative">
            <input type="password" class="form-control pe-5" id="inputPasswordProfesor" name="password" placeholder="Contraseña" maxlength="20" required>
            <label for="inputPasswordProfesor"><?php echo $textos['password']; ?></label>
            <button type="button" id="togglePasswordProfesor" class="btn btn-outline-secondary border-0 rounded-circle position-absolute top-50 end-0 translate-middle-y me-2 p-2">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <div class="form-text mensaje_2 mb-3 text-center"><?php echo $textos['aviso_password']; ?></div>
          <button id="loginProfesorBtn" class="btn btn-primary w-100"><?php echo $textos['login']; ?></button>
        </div>
      </div>
    </div>
  </div>
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
    <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body" id="toastMensaje">
          <?php echo $textos['error_iniciar_sesion']; ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <script>
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

    document.querySelectorAll('#nocontrol, #nocontrolProfesor').forEach(input => {
      input.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
      });
    });

    document.getElementById('loginBtn').addEventListener('click', function () {
      const nocontrol = document.getElementById('nocontrol').value.trim();
      const password = document.getElementById('inputPassword5').value.trim();

      if (!nocontrol || !password) {
        mostrarToast('<?php echo $textos['login_campos']; ?>', 'warning');
        return;
      }

      document.getElementById('loadingOverlay').style.display = 'flex';

      fetch('assets/code/modelo/login_conexion.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `nocontrol=${encodeURIComponent(nocontrol)}&pass=${encodeURIComponent(password)}`
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
              window.location.href = '/assets/code/alumnos/temas/index_alumnos.php';
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
        const nocontrol = document.getElementById('nocontrolProfesor').value.trim();
        const password = document.getElementById('inputPasswordProfesor').value.trim();

        if (!nocontrol || !password) {
          mostrarToast('<?php echo $textos['login_campos']; ?>', 'warning');
          return;
        }

        document.getElementById('loadingOverlay').style.display = 'flex';

        fetch('assets/code/modelo/login_conexion.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `nocontrol=${encodeURIComponent(nocontrol)}&pass=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
          document.getElementById('loadingOverlay').style.display = 'none';
          if (data.success) {
            mostrarToast('<?php echo $textos['login_exitoso']; ?>', 'success');
            setTimeout(() => {
              window.location.href = '/assets/code/profesor/index_profesor.php';
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
  </script>
</body>
</html>
<script>
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
