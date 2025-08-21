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