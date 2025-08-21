<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const pass = document.querySelector('input[name="pass"]').value;
    const passConfirm = document.querySelector('input[name="pass_confirm"]').value;
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
        return confirm("¿Estás seguro de que deseas actualizar tus datos?");
    }
    function confirmarContraseña() {
        return confirm("¿Estás seguro de que deseas cambiar tu contraseña? Se cerrará tu sesión actual.");
    }
    function validarFormulario() {
        const pass = document.querySelector('input[name="pass"]').value;
        const passConfirm = document.querySelector('input[name="pass_confirm"]').value;
        const similitud = porcentajeSimilitud(pass, passConfirm);
        if (similitud < 0.8) {
            alert("Las contraseñas no coinciden.");
            return false;
        }
        return confirm("¿Estás seguro de registrar tus datos?");
    }
    function porcentajeSimilitud(str1, str2) {
        const len = Math.max(str1.length, str2.length);
        let iguales = 0;
        for (let i = 0; i < Math.min(str1.length, str2.length); i++) {
            if (str1[i] === str2[i]) iguales++;
        }
        return (iguales / len);
    }
</script>