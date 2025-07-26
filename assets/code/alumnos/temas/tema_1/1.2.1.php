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
        <h1 class="text-center mb-4"><?php echo $textos['tema_1.2.1']; ?></h1>
        <p class="justificado"><?php echo $textos['parrafo_0037']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0038']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0039']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0040']; ?></p>
        <ul class="list-unstyled justificado mt-4">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0041']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0042']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0043']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0044']; ?>
          </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0046']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0047']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0048']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0049']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0050']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0051']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0052']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0053']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0054']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0055']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0056']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0057']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0058']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0059']; ?></p>
        <ul class="list-unstyled justificado mt-4">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0060']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0061']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0062']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0063']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0064']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0065']; ?>
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