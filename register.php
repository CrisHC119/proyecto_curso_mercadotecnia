<?php
  include_once __DIR__ . '/assets/code/navbar_index.php';
?>
<?php
session_start();

$institutos = json_decode(file_get_contents("assets/code/institutos.json"), true);

$clave_campus = $_SESSION['campus'] ?? 'itcv'; // predeterminado solo si no existe
$nombre_campus = $institutos[$clave_campus] ?? 'Campus no encontrado';
$idiomas = ['es' => 'Español', 'en' => 'English'];

// Si llega por GET
if (isset($_GET['lang']) && in_array($_GET['lang'], array_keys($idiomas))) {
    $_SESSION['idioma'] = $_GET['lang'];
}

// Si no hay idioma en sesión, establecer español por defecto
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}

?>
<style>
  .contenedor-central {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 40px;
    padding: 0 1rem;
  }
body {
  background-color: #121212;
  color: white;
}

/* Campos */
.form-control {
  background-color: rgba(255,255,255,0.1);
  color: white;
}

.form-control:focus {
  background-color: rgba(255,255,255,0.15);
  box-shadow: 0 0 0 0.2rem rgba(0,255,98,0.25);
}

/* Cards */
.card-perfil {
  background-color: rgba(255, 255, 255, 0.06);
  color: white;
}

/* Modal */
.modal-content {
  background-color: #222;
  color: white;
}
  .img-circular {
    width: 180px;
    height: 180px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid white;
    box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3);
    z-index: 2;
    position: relative;
    margin-bottom: 15px;
  }

  .btn-avatar_perfil {
    background: linear-gradient(135deg, #11cb14ff 0%, #049b25ff 100%);
    border: none;
    border-radius: 50px;
    padding: 10px 25px;
    font-weight: 600;
    margin-bottom: 20px;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(0, 241, 76, 0.4);
    transition: all 0.3s ease;
  }

  .btn-avatar_perfil:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(8, 178, 20, 0.6);
  }

  .card-perfil {
    width: 100%;
    max-width: 1400px;
    background-color: rgba(255, 255, 255, 0.06);
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    color: white;
    text-align: center;
    padding: 2rem;
  }

  .badge-estudiante {
    background: #0cc445;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 1.5rem;
  }

  .form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    text-align: left;
  }

  label {
    font-weight: 500;
    margin-bottom: 0.4rem;
  }

  .form-control {
    background-color: rgba(255,255,255,0.1);
    border: none;
    border-radius: 10px;
    color: white;
    padding: 10px 15px;
  }

  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,255,98,0.25);
    background-color: rgba(255,255,255,0.15);
  }

  .btn-actualizar {
    background: linear-gradient(135deg, #007bff 0%, #007bff 100%);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 25px;
    font-weight: 600;
    margin-top: 2rem;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
    transition: all 0.3s ease;
  }

  .btn-actualizar:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.6);
  }
  
  .btn-regresar {
    background: linear-gradient(135deg, #00ff22ff 0%, #00ff22ff 100%);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 25px;
    font-weight: 600;
    margin-top: 2rem;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(0, 255, 21, 0.4);
    transition: all 0.3s ease;
  }

  .btn-regresar:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 255, 55, 0.6);
  }
  


  .btn-borrar {
    background: linear-gradient(135deg, #cb1111ff 0%, #dd0c0cff 100%);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 12px 25px;
    font-weight: 600;
    margin-top: 2rem;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4);
    transition: all 0.3s ease;
  }

  .btn-borrar:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 0, 0, 0.6);
  }
  /* Modal */
  .modal-content {
    background-color: #222;
    color: white;
    border-radius: 15px;
  }

  .modal-header,
  .modal-footer {
    border: none;
  }
  /* Estilo para los resultados del autocompletado */
.ui-autocomplete {
  max-height: 200px;
  overflow-y: auto;
  background-color: #333;
  color: white;
  font-family: 'Segoe UI', sans-serif;
  border-radius: 10px;
  z-index: 1050;
  border: 1px solid #00ff73;
  box-shadow: 0 4px 12px rgba(0,255,98,0.3);
  box-sizing: border-box;
  /* No fijar width aquí */
}

/* Estilo para cada elemento */
.ui-menu-item-wrapper {
  padding: 10px;
  cursor: pointer;
}

/* Hover sobre ítems */
.ui-menu-item-wrapper:hover {
  background-color: #00ff73;
  color: #000;
  transition: 0.2s;
}
body.light-mode {
  background-color: #f8f9fa;
  color: #212529;
}

body.light-mode .form-control {
  background-color: #fff;
  color: #212529;
}

body.light-mode .form-control:focus {
  background-color: #f0f0f0;
  box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}

body.light-mode .card-perfil {
  background-color: #ffffff;
  color: #212529;
}

body.light-mode .modal-content {
  background-color: #f1f1f1;
  color: #212529;
}

body.light-mode .ui-autocomplete {
  background-color: #fff;
  color: #000;
  border-color: #0d6efd;
}
body.light-mode .form-control {
  background-color: #ffffff;
  color: #212529;
  border: 1px solid #ced4da; /* ✅ define el borde */
}

body.light-mode .form-control:focus {
  background-color: #f0f0f0;
  box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
  border-color: #80bdff; /* ✅ borde activo */
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<body class="bg-dark text-white">

<div class="contenedor-central">
  <!-- Avatar -->
<div class="text-center">
  <img id="previewAvatar" src="/assets/images/avatar/avatar_default.jpg" alt="Avatar" class="img-circular">
</div>
  <!-- Botón para cambiar avatar -->

  <!-- Card con formulario -->
  <div class="card card-perfil mt-4">
    <span class="badge-estudiante"><?php echo $textos['estudiante']; ?></span>
<!-- FORMULARIO -->
<!-- FORMULARIO 1: Datos personales -->
<form method="POST" action="/assets/code/modelo/registrar_alumno.php" enctype="multipart/form-data" onsubmit="return validarFormulario();">
  <input type="hidden" name="form_type" value="datos_personales">

  <div class="form-grid">
    <div>
      <label for="nombre"><?php echo $textos['nombre']; ?></label>
      <input type="text" id="nombre" name="nombres" class="form-control" required>
    </div>


    <div>
      <label for="apellido_p"><?php echo $textos['a_paterno']; ?></label>
        <input type="text" id="apellido_p" name="apellido_paterno" class="form-control" required>
    </div>

    <div>
      <label for="apellido_m"><?php echo $textos['a_materno']; ?></label>
<input type="text" id="apellido_m" name="apellido_materno" class="form-control">
    </div>

        <div>
      <label for="semestre"><?php echo $textos['semestre']; ?></label>
<input type="text" id="semestre" name="semestre" class="form-control" required>
    </div>
  </div>
  <!-- Buscador de Campus -->
  <div class="form-grid mt-4">
    <div>
      <label for="campus_autocompletado"><?php echo $textos['campus']; ?></label>
      <input type="text" id="campus_autocompletado" class="form-control" placeholder="Escribe tu campus..." required>
<input type="hidden" name="campus" id="campus_clave">
    </div>
    <div>
      <label for="no_control"><?php echo $textos['no_control']; ?>:</label>
<input type="text" id="no_control" name="nocontrol" class="form-control" required>
    </div>
  </div>
  <div class="form-grid mt-4">
    <div>
      <label for="pass"><?php echo $textos['pass']; ?></label>
<input type="password" name="pass" class="form-control" required>
    </div>
    <div>
      <label for="pass"><?php echo $textos['pass_confirm']; ?></label>
<input type="password" id="pass_confirm" name="pass_confirm" class="form-control" required>
    </div>
</div>
  <button type="submit" class="btn btn-actualizar"><?php echo $textos['registrar_datos']; ?></button>
</form>


<button type="button" onclick="history.back()" class="btn btn-regresar"><?php echo $textos['regresar']; ?></button>
  </div>
</div>

<?php
include_once __DIR__ . '/assets/code/footer.php';
?>

<!-- jQuery (necesario para jQuery UI) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI CSS + JS para autocompletado -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- Select2 (si todavía lo usas para otra parte) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  const pass = document.querySelector('input[name="pass"]').value;
  const passConfirm = document.querySelector('input[name="pass_confirm"]').value;

  const institutos = <?php echo json_encode($institutos); ?>;

  // Convierte a lista de objetos con clave y nombre
  const etiquetas = Object.keys(institutos).map(clave => ({
    label: institutos[clave],
    value: clave
  }));

  // Función para eliminar tildes (acentos)
  function sinTildes(texto) {
    return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
  }

  $(function () {
    $("#campus_autocompletado").autocomplete({
      source: function (request, response) {
        const termino = sinTildes(request.term);
        const resultados = etiquetas.filter(item => sinTildes(item.label).includes(termino));
        response(resultados);
      },
      minLength: 1,
      select: function (event, ui) {
        $("#campus_autocompletado").val(ui.item.label); // Mostrar nombre
        $("#campus_clave").val(ui.item.value); // Guardar clave
        return false;
      },
      open: function () {
        const $ul = $(this).autocomplete("widget");

        // Oculto para evitar flicker
        $ul.hide();

        // Medir el ancho necesario según contenido
        let maxWidth = 0;
        $ul.children('li').each(function () {
          const $temp = $('<span>').text($(this).text()).css({
            'font-family': 'Segoe UI, sans-serif',
            'font-size': $ul.css('font-size'),
            'font-weight': $ul.css('font-weight'),
            'visibility': 'hidden',
            'white-space': 'nowrap',
            'position': 'absolute'
          }).appendTo('body');

          const width = $temp.width();
          if (width > maxWidth) maxWidth = width;
          $temp.remove();
        });

        // Padding horizontal estimado dentro de li (10px izquierda + 10px derecha)
        const paddingH = 20;

        // Ancho del input
        const inputWidth = $(this).outerWidth();

        // Ancho máximo para que no se salga del viewport derecho
        const inputOffset = $(this).offset();
        const viewportWidth = $(window).width();
        const maxAllowedWidth = viewportWidth - inputOffset.left - 10; // margen de 10px

        // Determinar ancho final, mínimo el ancho del input
        let finalWidth = maxWidth + paddingH;
        if(finalWidth < inputWidth) finalWidth = inputWidth;
        if(finalWidth > maxAllowedWidth) finalWidth = maxAllowedWidth;

        // Aplicar el ancho calculado
        $ul.css({
          'width': finalWidth + 'px',
          'display': 'none' // Para luego animar
        });

        // Mostrar con slide down
        $ul.slideDown(150);
      }
    });

    // Mostrar el valor guardado en sesión como texto visible
    const claveActual = $("#campus_clave").val();
    if (claveActual && institutos[claveActual]) {
      $("#campus_autocompletado").val(institutos[claveActual]);
    }
  });
</script>
<script>
  const temaGuardado = localStorage.getItem('theme');
  if (temaGuardado === 'light') {
    document.body.classList.add('light-mode');
  }
</script>
<script>
  function confirmarActualizar() {
    return confirm("¿Estás seguro de que deseas actualizar tus datos?");
  }

  function confirmarContraseña() {
    return confirm("¿Estás seguro de que deseas cambiar tu contraseña? Se cerrará tu sesión actual.");
  }
</script>
<script>
// Validar todo antes de enviar
function validarFormulario() {
  const pass = document.querySelector('input[name="pass"]').value;
  const passConfirm = document.querySelector('input[name="pass_confirm"]').value;

  const similitud = porcentajeSimilitud(pass, passConfirm);

  if (similitud < 0.8) {
    alert("Las contraseñas no coinciden.");
    return false;
  }

  return confirm("¿Estás seguro de registrar tus datos?");
}

function porcentajeSimilitud(str1, str2) {
  const len = Math.max(str1.length, str2.length);
  let iguales = 0;
  for (let i = 0; i < Math.min(str1.length, str2.length); i++) {
    if (str1[i] === str2[i]) iguales++;
  }
  return (iguales / len);
}
</script>

<?php
$toast_msg = $_GET['toast_msg'] ?? '';
?>

<?php if ($toast_msg): ?>
  <div id="toast-container" aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
      <div class="d-flex">
        <div class="toast-body">
          <?php echo htmlspecialchars($toast_msg); ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const toastEl = document.querySelector('.toast');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  </script>
<?php endif; ?>
