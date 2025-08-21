<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const institutos = <?php echo json_encode($institutos); ?>;
    const etiquetas = Object.keys(institutos).map(clave => ({
        label: institutos[clave],
        value: clave
    }));

    function sinTildes(texto) {
        return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    $(function () {
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
        },
        open: function () {
            const $ul = $(this).autocomplete("widget");
            $ul.hide();

            let maxWidth = 0;
            $ul.children('li').each(function () {
            const $temp = $('<span>').text($(this).text()).css({
                'font-family': 'Segoe UI, sans-serif',
                'font-size': $ul.css('font-size'),
                'font-weight': $ul.css('font-weight'),
                'visibility': 'hidden',
                'white-space': 'nowrap',
                'position': 'absolute'
            }).appendTo('body');

            const width = $temp.width();
            if (width > maxWidth) maxWidth = width;
            $temp.remove();
            });

            const paddingH = 20;

            const inputWidth = $(this).outerWidth();

            const inputOffset = $(this).offset();
            const viewportWidth = $(window).width();
            const maxAllowedWidth = viewportWidth - inputOffset.left - 10;

            let finalWidth = maxWidth + paddingH;
            if(finalWidth < inputWidth) finalWidth = inputWidth;
            if(finalWidth > maxAllowedWidth) finalWidth = maxAllowedWidth;

            $ul.css({
            'width': finalWidth + 'px',
            'display': 'none'
            });

            $ul.slideDown(150);
        }
        });

        const claveActual = $("#campus_clave").val();
        if (claveActual && institutos[claveActual]) {
        $("#campus_autocompletado").val(institutos[claveActual]);
        }
    });
    const temaGuardado = localStorage.getItem('theme');
    if (temaGuardado === 'light') {
        document.body.classList.add('light-mode');
    }
    function confirmarActualizar() {
        return confirm("<?php echo $textos['confirmacion_datos_actualizado']; ?>");
    }

    function confirmarContraseña() {
        return confirm("<?php echo $textos['confirmacion_contrasena_actualizado']; ?>");
    }
    function mostrarVistaPrevia(input) {
        const preview = document.getElementById('previewAvatar');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetVistaPrevia() {
        const preview = document.getElementById('previewAvatar');
        preview.src = '';
        preview.classList.add('d-none');

        document.querySelector('input[name="nuevo_avatar"]').value = '';
    }
</script>