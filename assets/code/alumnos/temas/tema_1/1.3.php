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

<div class="contenedor-cursos">
  <!-- Cuadro de la izquierda: contenido -->
  <div id="mainContent">
    <div class="d-flex align-items-start justify-content-between flex-wrap">
      <!-- Texto -->
      <div style="flex: 1; min-width: 250px;">
        <h1 class="text-center mb-4"><?php echo $textos['tema_1.3']; ?></h1>
        <p class="justificado"><?php echo $textos['parrafo_0105']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0106']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0107']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0108']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0109']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0110']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0111']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0112']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0113']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0114']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0115']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0116']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0117']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0118']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0119']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0120']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0121']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0122']; ?></p>
        <ul class="list-unstyled justificado mt-3">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_1']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_2']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_3']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_4']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_5']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_6']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_7']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_8']; ?>
          </li>        
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_9']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0122_10']; ?>
          </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0123']; ?></p>
        <ul class="list-unstyled justificado mt-3">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0123_1']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0123_2']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0123_3']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0123_4']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0123_5']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0123_6']; ?>
          </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0124']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0125']; ?></p>
        <ul class="list-unstyled justificado mt-3">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0125_1']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0125_2']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0125_3']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0125_4']; ?>
          </li>
        </ul>
        </div>
    </div>
  </div>
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