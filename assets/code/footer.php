<style>
  /* Transición suave de opacidad */
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
</style>


<footer class="bg-dark text-white pt-4 pb-3 mt-5">
  <div class="container text-center">
    <p class="mb-2 fw-bold fs-5">TecNM Ciudad Victoria</p>
    <div class="mb-3">
      <a href="https://www.facebook.com/TECNM.ITVICTORIA/?locale=es_LA" class="text-white me-3" target="_blank" rel="noopener"><i class="bi bi-facebook fs-4"></i></a>
      <a href="https://www.itvictoria.edu.mx/" class="text-white me-3" target="_blank" rel="noopener"><i class="bi bi-google fs-4"></i></a>
      <a href="https://www.instagram.com/tecnm_cd.victoria/" class="text-white me-3" target="_blank" rel="noopener"><i class="bi bi-instagram fs-4"></i></a>
      <a href="https://www.youtube.com/@tecnmcdvictoria/videos" class="text-white" target="_blank" rel="noopener"><i class="bi bi-youtube fs-4"></i></a>
    </div>
    <small>&copy; 2025 TecNM Ciudad Victoria. <?php echo $textos['copyright']; ?>.</small>
  </div>
</footer>

<script>
  // Al cargar la página, mostrar transición de entrada
  window.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('fade-in');
  });

  // Manejar cuando la página viene del cache (back-forward cache)
  window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      document.body.classList.add('fade-in');
      document.body.classList.remove('fade-out');
    }
  });

  // Transición de salida al hacer click en enlaces internos
  document.querySelectorAll('a[href]').forEach(link => {
    const url = new URL(link.href, window.location.href);

    if (
      url.hostname === window.location.hostname &&  // enlace interno
      !url.href.includes('#') &&                     // no ancla
      !link.target                                  // no abre en nueva pestaña
    ) {
      link.addEventListener('click', function (e) {
        e.preventDefault();

        document.body.classList.remove('fade-in');
        document.body.classList.add('fade-out');

        setTimeout(() => {
          window.location.href = this.href;
        }, 500); // Duración de la transición en CSS
      });
    }
  });
</script>