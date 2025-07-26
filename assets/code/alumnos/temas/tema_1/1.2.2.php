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
        <h1 class="text-center mb-4"><?php echo $textos['tema_1.2.2']; ?></h1>
        <p class="justificado"><?php echo $textos['parrafo_0066']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0067']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0068']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0069']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0070']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0071']; ?></p>
        <p class="justificado"><?php echo $textos['parrafo_0072']; ?></p>
        <strong><p class="justificado"><?php echo $textos['parrafo_0073']; ?></p></strong>
        <ul class="list-unstyled justificado mt-4">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0074_1']; ?></strong><?php echo $textos['parrafo_0074']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0075_1']; ?></strong><?php echo $textos['parrafo_0075']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0076_1']; ?></strong><?php echo $textos['parrafo_0076']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><strong><?php echo $textos['parrafo_0077_1']; ?></strong><?php echo $textos['parrafo_0077']; ?>
          </li>
        </ul>

        <p class="justificado"><?php echo $textos['parrafo_0078']; ?></p>
        <ul class="list-unstyled justificado mt-4">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><strong><?php echo $textos['parrafo_0079_1']; ?></strong><?php echo $textos['parrafo_0079']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><strong><?php echo $textos['parrafo_0080_1']; ?></strong><?php echo $textos['parrafo_0080']; ?>
          </li>
        </ul>

        <div class="d-flex align-items-start justify-content-between flex-wrap">
  <!-- Parte de texto -->
  <div style="flex: 1; min-width: 250px;">
    <strong><p class="justificado"><?php echo $textos['parrafo_0081']; ?></p></strong>
    <p class="justificado"><?php echo $textos['parrafo_0082']; ?></p>
    <p class="justificado"><?php echo $textos['parrafo_0083']; ?></p>
    <strong><p class="justificado"><?php echo $textos['parrafo_0084']; ?></p></strong>
    <p class="justificado"><?php echo $textos['parrafo_0085']; ?></p>
            <ul class="list-unstyled justificado mt-4">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_1']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_2']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_3']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0085_4']; ?>
          </li>
        </ul>
        <strong><p class="justificado"><?php echo $textos['parrafo_0086']; ?></p></strong>
        <p class="justificado"><?php echo $textos['parrafo_0087']; ?></p>
        <ul class="list-unstyled justificado mt-4">
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0087_1']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0087_2']; ?>
          </li>
          <li class="mb-3">
            <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0087_3']; ?>
          </li>
        </ul>
  </div>

  <!-- Parte de imagen (a la derecha) -->
  <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
    <img src="/assets/images/tema_1/image_1.2.2.jpg" alt="Descripción" class="img-fluid rounded shadow" />
    <img src="/assets/images/tema_1/image_1.2.2_2.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
  </div>
</div>




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