<script>
    const institutos = <?php echo json_encode($institutos); ?>;
    const etiquetas = Object.keys(institutos).map(clave => ({
        label: institutos[clave],
        value: clave
    }));

    function sinTildes(texto) {
        if (typeof texto !== 'string') return '';
        return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    $(function () {
        const $botonGuardar = $('#btnGuardarCambiosProfesor');
        const modalAjustes = new bootstrap.Modal(document.getElementById('confirmAjustesModal'));
        
        const valoresIniciales = {
            nombre: "<?php echo htmlspecialchars($profesor_data['nombres']); ?>",
            apaterno: "<?php echo htmlspecialchars($profesor_data['apellido_paterno']); ?>",
            amaterno: "<?php echo htmlspecialchars($profesor_data['apellido_materno']); ?>",
            campus: "<?php echo htmlspecialchars($profesor_data['campus']); ?>"
        };

        const valoresCalificacionIniciales = {};
        for (let i = 1; i <= 5; i++) {
            valoresCalificacionIniciales[i] = {
                examen: $('#examen_unidad_' + i).val(),
                actividad: $('#actividad_unidad_' + i).val(),
                asistencia: $('#asistencia_unidad_' + i).val(),
                proyecto: $('#proyecto_final_unidad_' + i).val()
            };
        }

        function verificarCambios() {
            const nombreActual = $('#nombreProfesor').val();
            const apaternoActual = $('#apaternoProfesor').val();
            const amaternoActual = $('#amaternoProfesor').val();
            const campusActual = $('#campusProfesor').val();
            const nuevaPassActual = $('#nuevaContrasena').val();
            const confirmarPassActual = $('#confirmarContrasena').val();
            const datosPersonalesCambiados = 
                nombreActual !== valoresIniciales.nombre ||
                apaternoActual !== valoresIniciales.apaterno ||
                amaternoActual !== valoresIniciales.amaterno ||
                campusActual !== valoresIniciales.campus;
            const contrasenaCambiada = nuevaPassActual !== '' || confirmarPassActual !== '';
            $botonGuardar.prop('disabled', !(datosPersonalesCambiados || contrasenaCambiada));
        }

        $('#nombreProfesor, #apaternoProfesor, #amaternoProfesor, #nuevaContrasena, #confirmarContrasena').on('input', verificarCambios);

        $("#campus_autocompletado_profesor").autocomplete({
            source: function (request, response) {
                const termino = sinTildes(request.term);
                const resultados = etiquetas.filter(item => sinTildes(item.label).includes(termino));
                response(resultados);
            },
            minLength: 1,
            select: function (event, ui) {
                $("#campus_autocompletado_profesor").val(ui.item.label); 
                $("#campusProfesor").val(ui.item.value);
                verificarCambios();
                return false;
            },
        });

        const claveActual = $("#campusProfesor").val();
        if (claveActual && institutos[claveActual]) {
            $("#campus_autocompletado_profesor").val(institutos[claveActual]);
        }

        $("#campus_autocompletado_profesor").on('input', function() {
            const textoVisible = $(this).val().trim();
            const match = etiquetas.find(item => sinTildes(item.label) === sinTildes(textoVisible));
            if (match) {
                $("#campusProfesor").val(match.value);
            } else {
                $("#campusProfesor").val("");
            }
            verificarCambios();
        });

        $botonGuardar.on('click', function() {
            const nombre = $('#nombreProfesor').val().trim();
            const apaterno = $('#apaternoProfesor').val().trim();
            const amaterno = $('#amaternoProfesor').val().trim();
            const nombreCampus = $("#campus_autocompletado_profesor").val().trim();
            const claveCampus = $("#campusProfesor").val().trim();
            
            if (nombre === '' || apaterno === '' || amaterno === '') {
                alert("Por favor, completa todos los campos de nombre y apellidos.");
                if (nombre === '') $('#nombreProfesor').focus();
                else if (apaterno === '') $('#apaternoProfesor').focus();
                else $('#amaternoProfesor').focus();
                return;
            }
            if (nombreCampus === "") {
                alert("Por favor, ingresa el nombre de tu campus.");
                $("#campus_autocompletado_profesor").focus();
                return;
            }
            if (claveCampus === "") {
                alert("El campus '" + nombreCampus + "' no es válido. Por favor, selecciónelo de la lista desplegable.");
                $("#campus_autocompletado_profesor").focus();
                return;
            }
            modalAjustes.show();
        });
        
        const modalAvatarEl = document.getElementById('modalAvatarProfesor');
        const inputAvatarFile = document.getElementById('inputAvatarFile');
        
        function resetAvatarModal() {
        }

        modalAvatarEl.addEventListener('show.bs.modal', resetAvatarModal);
        
        inputAvatarFile.addEventListener('change', function() {
        });
        const valoresInicialesTimer = {
            alumno: "<?php echo htmlspecialchars($timer_data['timer_alumno_min']); ?>",
            profesor: "<?php echo htmlspecialchars($timer_data['timer_profesor_min']); ?>"
        };

        const $botonGuardarTimer = $('#btnGuardarTimer');
        const $timerAlumnoInput = $('#timer_alumno');
        const $timerProfesorInput = $('#timer_profesor');

        function verificarCambiosTimer() {
            const alumnoActual = $timerAlumnoInput.val();
            const profesorActual = $timerProfesorInput.val();

            const cambiados = alumnoActual !== valoresInicialesTimer.alumno ||
                              profesorActual !== valoresInicialesTimer.profesor;
            
            const validos = alumnoActual.trim() !== '' && parseFloat(alumnoActual) > 0 &&
                            profesorActual.trim() !== '' && parseFloat(profesorActual) > 0;

            $botonGuardarTimer.prop('disabled', !(cambiados && validos));
        }

        $timerAlumnoInput.on('input', verificarCambiosTimer);
        $timerProfesorInput.on('input', verificarCambiosTimer);
        
        function actualizarSumaUnidad(unidadId) {
            const $examenInput = $('#examen_unidad_' + unidadId);
            const $actividadInput = $('#actividad_unidad_' + unidadId);
            const $asistenciaInput = $('#asistencia_unidad_' + unidadId);
            const $proyectoInput = $('#proyecto_final_unidad_' + unidadId);
            const $sumaBadge = $('#suma_unidad_' + unidadId);

            const examenValStr = $examenInput.val();
            const actividadValStr = $actividadInput.val();
            const asistenciaValStr = $asistenciaInput.val();
            const proyectoValStr = $proyectoInput.val();

            const allEmpty = examenValStr === '' && actividadValStr === '' && asistenciaValStr === '' && proyectoValStr === '';
            const someEmpty = examenValStr === '' || actividadValStr === '' || asistenciaValStr === '' || proyectoValStr === '';

            if (allEmpty) {
                $sumaBadge.text('Suma: 0%');
                $sumaBadge.removeClass('bg-success bg-danger').addClass('bg-secondary');
                return;
            }

            if (someEmpty) {
                $sumaBadge.text('Suma: N/A');
                $sumaBadge.removeClass('bg-success bg-secondary').addClass('bg-danger');
                return;
            }

            const examenVal = parseInt(examenValStr) || 0;
            const actividadVal = parseInt(actividadValStr) || 0;
            const asistenciaVal = parseInt(asistenciaValStr) || 0;
            const proyectoVal = parseInt(proyectoValStr) || 0;

            const suma = examenVal + actividadVal + asistenciaVal + proyectoVal;

            $sumaBadge.text('Suma: ' + suma + '%');

            if (suma === 100) {
                $sumaBadge.removeClass('bg-secondary bg-danger').addClass('bg-success');
            } else {
                $sumaBadge.removeClass('bg-secondary bg-success').addClass('bg-danger');
            }
        }

        function validarTodosLosValores() {
            const $botonValores = $('#btnGuardarValores');
            let todoValido = true;
            let hayCambios = false;
            
            for (let i = 1; i <= 5; i++) {
                const examenVal = $('#examen_unidad_' + i).val();
                const actividadVal = $('#actividad_unidad_' + i).val();
                const asistenciaVal = $('#asistencia_unidad_' + i).val();
                const proyectoVal = $('#proyecto_final_unidad_' + i).val();

                if (
                    examenVal !== valoresCalificacionIniciales[i].examen ||
                    actividadVal !== valoresCalificacionIniciales[i].actividad ||
                    asistenciaVal !== valoresCalificacionIniciales[i].asistencia ||
                    proyectoVal !== valoresCalificacionIniciales[i].proyecto
                ) {
                    hayCambios = true;
                }

                const allEmpty = (examenVal === '' && actividadVal === '' && asistenciaVal === '' && proyectoVal === '');
                const someEmpty = (examenVal === '' || actividadVal === '' || asistenciaVal === '' || proyectoVal === '');

                if (allEmpty) {
                    continue; 
                }

                if (someEmpty) { 
                    todoValido = false;
                    break; 
                }

                const suma = (parseInt(examenVal) || 0) + 
                             (parseInt(actividadVal) || 0) + 
                             (parseInt(asistenciaVal) || 0) +
                             (parseInt(proyectoVal) || 0);
                
                if (suma !== 100) {
                    todoValido = false;
                    break; 
                }
            }
            
            $botonValores.prop('disabled', !(todoValido && hayCambios));
        }

        for (let i = 1; i <= 5; i++) {
            actualizarSumaUnidad(i);
            
            $('#examen_unidad_' + i + ', #actividad_unidad_' + i + ', #asistencia_unidad_' + i + ', #proyecto_final_unidad_' + i).on('input', function() { 
                actualizarSumaUnidad(i);
                validarTodosLosValores();
            });
        }
        
        validarTodosLosValores();

        $('#valoresForm').on('submit', function(e) {
            let allValid = true;
            let firstErrorUnit = -1;
            for (let i = 1; i <= 5; i++) {
                const $examenInput = $('#examen_unidad_' + i);
                const $actividadInput = $('#actividad_unidad_' + i);
                const $asistenciaInput = $('#asistencia_unidad_' + i);
                const $proyectoInput = $('#proyecto_final_unidad_' + i);

                const examenVal = $examenInput.val();
                const actividadVal = $actividadInput.val();
                const asistenciaVal = $asistenciaInput.val();
                const proyectoVal = $proyectoInput.val();

                if (examenVal === '' && actividadVal === '' && asistenciaVal === '' && proyectoVal === '') {
                    continue;
                }

                if (examenVal === '' || actividadVal === '' || asistenciaVal === '' || proyectoVal === '') {
                    allValid = false;
                    firstErrorUnit = i;
                    alert('Error en Unidad ' + i + ': Debe completar TODOS los valores (Examen, Actividades, Asistencia y Proyecto) o dejar TODOS vacíos.');
                    break;
                }

                const suma = (parseInt(examenVal) || 0) + 
                             (parseInt(actividadVal) || 0) + 
                             (parseInt(asistenciaVal) || 0) +
                             (parseInt(proyectoVal) || 0);
                
                if (suma !== 100) {
                    allValid = false;
                    firstErrorUnit = i;
                    alert('Error en Unidad ' + i + ': La suma de los valores debe ser 100. Actualmente suma ' + suma + '%.');
                    break;
                }
            }
            if (!allValid) {
                e.preventDefault();
                if (firstErrorUnit !== -1) {
                    if ($('#examen_unidad_' + firstErrorUnit).val() === '') {
                        $('#examen_unidad_' + firstErrorUnit).focus();
                    } else if ($('#actividad_unidad_' + firstErrorUnit).val() === '') {
                        $('#actividad_unidad_' + firstErrorUnit).focus();
                    } else if ($('#asistencia_unidad_' + firstErrorUnit).val() === '') {
                        $('#asistencia_unidad_' + firstErrorUnit).focus();
                    } else {
                        $('#proyecto_final_unidad_' + firstErrorUnit).focus();
                   }
                }
            }
        });

        document.getElementById("btnDescargarAlumnosPDF").addEventListener("click", function () {
            try {
                const doc = new jsPDF();
                doc.text("Lista de Alumnos", 14, 20);
                doc.autoTable({
                    html: '#tabla-lista-alumnos',
                    startY: 30,
                    styles: { fontSize: 10, cellPadding: 2 },
                    headStyles: { fillColor: [52, 58, 64] }
                });
                doc.save("lista_alumnos.pdf");
            } catch (error) {
                console.error("Error al generar el PDF:", error);
                alert("Hubo un error al generar el PDF. Ver consola para más detalles.");
            }
        });

    });
</script>