document.addEventListener('DOMContentLoaded', function() {
    const linkExamen = document.getElementById('link-examen-1');
    if (!linkExamen) return;

    const fechaStr = linkExamen.getAttribute('data-fecha');
    const fechaExamen = fechaStr ? new Date(fechaStr) : null;

    linkExamen.addEventListener('click', function(event) {
        const ahora = new Date();

        if (!fechaExamen) {
            event.preventDefault();
            mostrarToast("El examen aún no está disponible.");
            return;
        }

        if (fechaExamen < ahora) {
            event.preventDefault();
            const opciones = { year: 'numeric', month: '2-digit', day: '2-digit', hour:'2-digit', minute:'2-digit' };
            const fechaFormateada = fechaExamen.toLocaleString('es-MX', opciones);
            mostrarToast(`El examen expiró el día: ${fechaFormateada}. Contacta con el profesor.`);
            return;
        }
    });

    function mostrarToast(mensaje) {
        const toastEl = document.getElementById('toastAviso');
        const toastMensaje = document.getElementById('toastMensaje');
        toastMensaje.textContent = mensaje;

        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
});