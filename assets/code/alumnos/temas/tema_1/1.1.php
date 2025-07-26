<?php
session_start();

// Idiomas disponibles
$idiomas = ['es' => 'Español', 'en' => 'English'];

// Si llega por GET
if (isset($_GET['lang']) && in_array($_GET['lang'], array_keys($idiomas))) {
    $_SESSION['idioma'] = $_GET['lang'];
}

// Si no hay idioma en sesión, establecer español por defecto
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}

$idioma = $_SESSION['idioma'];
  $ubi_index = '../';
  $ubi_calificacion = '../../';
  include_once __DIR__ . '/../../code/navbar.php';
?>

<style>
  ul.list-unstyled.justificado li {
  line-height: 1.2;
}
</style>
<div class="contenedor-cursos">
  <!-- Cuadro de la izquierda: contenido -->
  <div id="mainContent">
    <h2 class="text-center mb-4"><?php echo $textos['tema_1.1']; ?></h2>
    <p class="justificado"><?php echo $textos['parrafo_0006']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0007']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0008']; ?></p>

<ul class="list-unstyled justificado mt-4">
  <li class="mb-1 d-flex align-items-start">
    <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
    <span><?php echo $textos['parrafo_0009']; ?></span>
  </li>
  <li class="mb-1 d-flex align-items-start">
    <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
    <span><?php echo $textos['parrafo_0010']; ?></span>
  </li>
  <li class="mb-1 d-flex align-items-start">
    <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
    <span><?php echo $textos['parrafo_0011']; ?></span>
  </li>
  <li class="mb-1 d-flex align-items-start">
    <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
    <span><?php echo $textos['parrafo_0012']; ?></span>
  </li>
  <li class="mb-1 d-flex align-items-start">
    <i class="bi bi-arrow-right-circle-fill text-primary me-2 mt-1"></i>
    <span><?php echo $textos['parrafo_0013']; ?></span>
  </li>
</ul>
    <p class="justificado"><?php echo $textos['parrafo_0014']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0015']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0016']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0017']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0018']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0019']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0020']; ?></p>
    <div class="text-center">
      <h4><?php echo $textos['parrafo_0021']; ?></h4>
    </div>
    <p class="justificado mt-4"><?php echo $textos['parrafo_0022']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0023']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0024']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0025']; ?></p>
  </div>

  <!-- Cuadro de la derecha: Temas del curso -->
<?php
  include_once __DIR__ . '/../../code/tarjeta_curso.php';
?>
</div>

<footer class="bg-dark text-white pt-4 pb-3 mt-5">
  <div class="container text-center">
    <p class="mb-2 fw-bold fs-5">TecNM Ciudad Victoria</p>
    <div class="mb-3">
      <a href="https://www.facebook.com/TECNM.ITVICTORIA/?locale=es_LA" class="text-white me-3" target="_blank" rel="noopener"><i class="bi bi-facebook fs-4"></i></a>
      <a href="https://www.itvictoria.edu.mx/" class="text-white me-3" target="_blank" rel="noopener"><i class="bi bi-google fs-4"></i></a>
      <a href="https://www.instagram.com/tecnm_cd.victoria/" class="text-white me-3" target="_blank" rel="noopener"><i class="bi bi-instagram fs-4"></i></a>
      <a href="https://www.youtube.com/@tecnmcdvictoria/videos" class="text-white" target="_blank" rel="noopener"><i class="bi bi-youtube fs-4"></i></a>
    </div>
    <small>&copy; 2025 TecNM Ciudad Victoria. Todos los derechos reservados.</small>
  </div>
</footer>



</body>
</html>