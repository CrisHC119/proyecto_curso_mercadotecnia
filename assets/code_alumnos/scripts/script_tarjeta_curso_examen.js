document.addEventListener('DOMContentLoaded', function() {
    const modalNoDisponible = document.getElementById('modalExamenNoDisponible');
    if (modalNoDisponible) {
        const spanFechaInicio = document.getElementById('fecha-disponible-span');
        
        modalNoDisponible.addEventListener('show.bs.modal', function(event) {
            const link = event.relatedTarget;
            
            const fechaInicio = link.getAttribute('data-fecha-inicio');
            
            spanFechaInicio.textContent = fechaInicio;
        });
    }

    const modalVencido = document.getElementById('modalExamenVencido');
    if (modalVencido) {
        const spanFechaFin = document.getElementById('fecha-limite-span');
        
        modalVencido.addEventListener('show.bs.modal', function(event) {
            const link = event.relatedTarget;
            
            const fechaFin = link.getAttribute('data-fecha-fin');
            
            spanFechaFin.textContent = fechaFin;
        });
    }
});
