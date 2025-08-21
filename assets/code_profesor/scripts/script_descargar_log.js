document.addEventListener('DOMContentLoaded', function() {
    const btnDescargar = document.getElementById('btnDescargar');
    const cmdBox = document.querySelector('.cmd-box');

    if(btnDescargar && cmdBox) {
        btnDescargar.addEventListener('click', function(e) {
            e.preventDefault();

            solicitarPasswordProfesor((verificado) => {
                if(verificado) {
                    const contenido = cmdBox.value;
                    const blob = new Blob([contenido], { type: 'text/plain' });
                    const url = URL.createObjectURL(blob);

                    const a = document.createElement('a');
                    a.href = url;
                    window.location.href = "../code_general/descargar_log.php";
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                } else {
                }
            });
        });
    } else {
        console.error("No se encontró el botón o el textarea.");
    }
});