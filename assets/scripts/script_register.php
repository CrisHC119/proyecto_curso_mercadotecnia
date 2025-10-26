<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        const institutos = <?php echo json_encode($institutos ?? []); ?>;
        const etiquetas = Object.keys(institutos).map(clave => ({
            label: institutos[clave],
            value: clave
        }));
        
        function sinTildes(texto) {
            return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        }

        $("#campus_autocompletado").autocomplete({
            source: function (request, response) {
                const termino = sinTildes(request.term);
                const resultados = etiquetas.filter(item => sinTildes(item.label).includes(termino));
                response(resultados);
            },
            minLength: 1,
            select: function (event, ui) {
                $("#campus_autocompletado").val(ui.item.label); 
                $("#campus_clave").val(ui.item.value);
                return false;
            }
        });


        const claveActual = $("#campus_clave").val();
        if (claveActual && institutos[claveActual]) {
            $("#campus_autocompletado").val(institutos[claveActual]);
        }

        const temaGuardado = localStorage.getItem('theme');
        if (temaGuardado === 'light') {
            document.body.classList.add('light-mode');
        }

        const mostrarModal = <?php echo json_encode($mostrarModalExito); ?>;
        if (mostrarModal) {
            var miModal = new bootstrap.Modal(document.getElementById('modalExito'));
            miModal.show();

            setTimeout(function() {
                const urlParams = new URLSearchParams(window.location.search);
                const lang = urlParams.get('lang') || 'es';
                window.location.href = 'login.php?lang=' + lang;
            }, 3500);
        }
    });

    function validarFormulario() {
        const campusClave = document.getElementById('campus_clave').value;
        const campusNombre = document.getElementById('campus_autocompletado').value;
        
        if (campusClave === "" || campusNombre === "") {
            alert("El campus seleccionado no es válido. Por favor, elige uno de la lista de sugerencias.");
            return false; 
        }
        
        const pass = document.querySelector('input[name="pass"]').value;
        const passConfirm = document.querySelector('input[name="pass_confirm"]').value;

        if (pass !== passConfirm) {
            alert("Las contraseñas no coinciden. Por favor, verifícalas.");
            return false;
        }

        return confirm("¿Estás seguro de registrar tus datos?");
    }
</script>