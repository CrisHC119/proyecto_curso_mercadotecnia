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
        <h1 class="text-center mb-4"><?php echo $textos['tema_1.2.3']; ?></h1>
        <p class="justificado"><?php echo $textos['parrafo_0088']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0089']; ?></p>
        <ul class="list-unstyled justificado mt-4">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0090_1']; ?></strong><?php echo $textos['parrafo_0090']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0091_1']; ?></strong><?php echo $textos['parrafo_0091']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0092_1']; ?></strong><?php echo $textos['parrafo_0092']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0093_1']; ?></strong><?php echo $textos['parrafo_0093']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0094_1']; ?></strong><?php echo $textos['parrafo_0094']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0095_1']; ?></strong><?php echo $textos['parrafo_0095']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0096_1']; ?></strong><?php echo $textos['parrafo_0096']; ?>
          </li>
        </ul>
        <p class="justificado"><?php echo $textos['parrafo_0097']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0098']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0099']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0100']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0101']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0102']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0103']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0104']; ?></p>









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