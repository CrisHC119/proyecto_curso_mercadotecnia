document.addEventListener('DOMContentLoaded', () => {
    const buscador = document.getElementById('buscador');
    if (buscador) {
        buscador.addEventListener('input', function() {
            const filtro = this.value.toLowerCase().trim();
            
            document.querySelectorAll('#tabla-calificaciones .alumno-row').forEach(row => {
                const textoRow = row.textContent.toLowerCase();
                row.style.display = textoRow.includes(filtro) ? '' : 'none';
            });
        });
    }
});