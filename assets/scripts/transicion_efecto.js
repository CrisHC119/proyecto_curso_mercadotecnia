// transicion_efecto.php (eliminado)
window.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('fade-in');
});
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
    document.body.classList.add('fade-in');
    document.body.classList.remove('fade-out');
    }
});
document.querySelectorAll('a[href]').forEach(link => {
    const url = new URL(link.href, window.location.href);
    if (
        url.hostname === window.location.hostname &&
        !url.href.includes('#') &&
        !link.target
    ) {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        document.body.classList.remove('fade-in');
        document.body.classList.add('fade-out');
        setTimeout(() => {
        window.location.href = this.href;
        }, 500);
    });
    }
});