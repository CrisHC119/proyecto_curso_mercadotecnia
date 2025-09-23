document.addEventListener('DOMContentLoaded', function() {
    
    const modalEl = document.getElementById('avisoModal');
    const modalTitle = document.getElementById('avisoModalLabel');
    const modalBody = document.getElementById('avisoModalBody');
    const avisoModal = new bootstrap.Modal(modalEl);

    const linksExamen = document.querySelectorAll('.link-examen');

    linksExamen.forEach(link => {
        link.addEventListener('click', function(event) {
            
            // ¡SIEMPRE prevenimos la navegación primero!
            event.preventDefault(); 
            
            const fechaStr = link.getAttribute('data-fecha');
            const urlDestino = link.getAttribute('data-url'); // Obtenemos la URL
            const ahora = new Date();
            
            if (!fechaStr) {
                modalTitle.textContent = 'Examen No Disponible';
                modalBody.textContent = 'Este examen aún no tiene una fecha asignada. Por favor, contacta a tu profesor.';
                avisoModal.show();
                return;
            }

            const fechaExamen = new Date(fechaStr);

            if (isNaN(fechaExamen.getTime()) || fechaExamen < ahora) {
                const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = fechaExamen.toLocaleDateString('es-MX', opciones);

                modalTitle.textContent = 'Acceso Denegado';
                modalBody.textContent = `La fecha límite para este examen ya pasó (${fechaFormateada}). No puedes acceder.`;
                avisoModal.show();
                return;
            }
            
            // ✅ Si todas las validaciones pasan, navegamos manualmente con JavaScript
            window.location.href = urlDestino;
        });
    });
});