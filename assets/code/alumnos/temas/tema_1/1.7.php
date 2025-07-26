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
        <h1 class="text-center mb-4"><?php echo $textos['tema_1.7']; ?></h1>
        <p class="justificado"><?php echo $textos['parrafo_0176']; ?><br>
            <a href="<?php echo $textos['parrafo_0176_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
              <?php echo $textos['parrafo_0176_hyp']; ?>
            </a>
        </p>
        <p class="justificado"><?php echo $textos['parrafo_0177']; ?><br>
            <a href="<?php echo $textos['parrafo_0177_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
              <?php echo $textos['parrafo_0177_hyp']; ?>
            </a>
        </p>
        <p class="justificado"><?php echo $textos['parrafo_0178']; ?><br>
            <a href="<?php echo $textos['parrafo_0178_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
              <?php echo $textos['parrafo_0178_hyp']; ?>
            </a>
        </p>
        <p class="justificado"><?php echo $textos['parrafo_0179']; ?><br>
          <a href="<?php echo $textos['parrafo_0179_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
            <?php echo $textos['parrafo_0179_hyp']; ?>
          </a>
        </p>
        <p class="justificado"><?php echo $textos['parrafo_0180']; ?><br>
          <a href="<?php echo $textos['parrafo_0180_hyp']; ?>" target="_blank" style="color: #007bff; text-decoration: underline;">
            <?php echo $textos['parrafo_0180_hyp']; ?>
          </a>
        </p>
        
        </div>
              <div class="ms-4 d-none d-sm-block" style="max-width: 200px; flex-shrink: 0;">
        <img src="/assets/images/tema_1/image_1.7.jpg" alt="Descripción" class="img-fluid rounded shadow" />
        <img src="/assets/images/tema_1/image_1.7_1.jpg" alt="Descripción" class="img-fluid rounded shadow mt-5" />
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