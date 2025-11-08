<script>
    const modalFechaElement = document.getElementById('modalFecha');
    const inputFechaDisponible = document.getElementById('fecha_disponible');
    const inputFechaLimite = document.getElementById('fecha_limite');
    const errDisponible = document.getElementById('fechaDisponibleError');
    const errLimite = document.getElementById('fechaLimiteError');
    const modalUnidadTitulo = document.getElementById('modalUnidadTitulo');
    function solicitarPassword(accion) {
        if (accion === 'reiniciar') {
            if (!confirm('<?php echo $textos['confirmar_reinicio_fecha']; ?>')) {
                return; 
            }
        }

        const modalFechaEl = document.getElementById('modalFecha'); 
        const modalFechaInstance = bootstrap.Modal.getInstance(modalFechaEl);
        const modalPasswordEl = document.getElementById('modalPassword');
        
        const idExamen = document.getElementById('modal_id_examen').value;
        const fechaInicio = inputFechaDisponible.value;
        const fechaFin = inputFechaLimite.value;
        
        errDisponible.textContent = '';
        errLimite.textContent = '';
        document.getElementById('passwordError').textContent = '';
        
        let valid = true;

        if (accion === 'guardar') {
            if (!fechaInicio) {
                errDisponible.textContent = '<?php echo $textos['error_fecha_inicio_vacia']; ?>';
                valid = false;
            }
            if (!fechaFin) {
                errLimite.textContent = '<?php echo $textos['error_fecha_fin_vacia']; ?>';
                valid = false;
            }
            if (fechaInicio && fechaFin && fechaFin <= fechaInicio) {
                errLimite.textContent = '<?php echo $textos['error_fecha_fin_anterior']; ?>';
                valid = false;
            }
            
            const minAllowedStr = getMinDateTime(); 
            if (fechaInicio && fechaInicio < minAllowedStr) {
                try {
                    const startDate = new Date(fechaInicio);
                    const minDate = new Date(minAllowedStr);
                    if ((startDate.getTime() + 60000) < minDate.getTime()) { 
                         errDisponible.textContent = 'La fecha de inicio no puede ser en el pasado.'; 
                         valid = false;
                    }
                } catch(e) { }
            }
        }
        
        if (!valid) {
             console.log("Validation failed. Stopping.");
             return; 
        }

        console.log("Validation passed. Preparing password modal."); 

        document.getElementById('password_id_examen').value = idExamen;
        document.getElementById('password_fecha_disponible').value = fechaInicio; 
        document.getElementById('password_fecha_limite').value = fechaFin;       
        document.getElementById('password_accion').value = accion;
        document.getElementById('profesor_password').value = '';

        if (modalFechaInstance) {
            console.log("Hiding date modal.");
            modalFechaInstance.hide();
        }
        
        if (modalPasswordEl) {
             console.log("Showing password modal."); 
             const modalPasswordInstance = bootstrap.Modal.getOrCreateInstance(modalPasswordEl);
             modalPasswordInstance.show();
        } else {
             console.error("Password modal element not found!"); 
        }
    }
    function formatDateTimeLocal(date) {
        if (!date) return '';
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    function getMinDateTime() {
        const now = new Date();
        now.setSeconds(0, 0);
        return formatDateTimeLocal(now);
    }
    
    function prepararModal(id, fechaInicioActual, fechaFinActual) {
        document.getElementById('modal_id_examen').value = id;
        modalUnidadTitulo.textContent = id;
        errDisponible.textContent = '';
        errLimite.textContent = '';

        const minDateTime = getMinDateTime();
        inputFechaDisponible.min = minDateTime;
        inputFechaLimite.min = minDateTime;

        inputFechaDisponible.value = fechaInicioActual && fechaInicioActual !== '0000-00-00 00:00:00' ? fechaInicioActual.replace(' ', 'T').slice(0, 16) : minDateTime;
        inputFechaLimite.value = fechaFinActual && fechaFinActual !== '0000-00-00 00:00:00' ? fechaFinActual.replace(' ', 'T').slice(0, 16) : '';
        
        if (inputFechaDisponible.value) {
            inputFechaLimite.min = inputFechaDisponible.value;
        }
    }

    inputFechaDisponible.addEventListener('change', function() {
        if (inputFechaDisponible.value) {
            inputFechaLimite.min = inputFechaDisponible.value;
            if (inputFechaLimite.value && inputFechaLimite.value < inputFechaDisponible.value) {
                 inputFechaLimite.value = '';
            }
        } else {
             inputFechaLimite.min = getMinDateTime();
        }
    });

    function setStartToNow() {
         const nowFormatted = getMinDateTime();
         inputFechaDisponible.value = nowFormatted;
         inputFechaDisponible.dispatchEvent(new Event('change'));
    }

    function solicitarPassword(accion) {
        if (accion === 'reiniciar') {
            if (!confirm('<?php echo $textos['confirmar_reinicio_fecha']; ?>')) {
                return; 
            }
        }

        const modalFechaInstance = bootstrap.Modal.getInstance(modalFechaElement);
        const modalPassword = new bootstrap.Modal(document.getElementById('modalPassword'));

        const idExamen = document.getElementById('modal_id_examen').value;
        const fechaInicio = inputFechaDisponible.value;
        const fechaFin = inputFechaLimite.value;
        
        errDisponible.textContent = '';
        errLimite.textContent = '';
        let valid = true;

        if (accion === 'guardar') {
            if (!fechaInicio) {
                errDisponible.textContent = '<?php echo $textos['error_fecha_inicio_vacia']; ?>';
                valid = false;
            }
            if (!fechaFin) {
                errLimite.textContent = '<?php echo $textos['error_fecha_fin_vacia']; ?>';
                valid = false;
            }
            if (fechaInicio && fechaFin && fechaFin <= fechaInicio) {
                errLimite.textContent = '<?php echo $textos['error_fecha_fin_anterior']; ?>';
                valid = false;
            }
             const minAllowed = getMinDateTime();
             if (fechaInicio && fechaInicio < minAllowed) {
                 errDisponible.textContent = 'La fecha de inicio no puede ser en el pasado.';
                 valid = false;
             }
        }
        
        if (!valid) return; 

        document.getElementById('password_id_examen').value = idExamen;
        document.getElementById('password_fecha_disponible').value = fechaInicio;
        document.getElementById('password_fecha_limite').value = fechaFin;
        document.getElementById('password_accion').value = accion;
        document.getElementById('profesor_password').value = '';
        document.getElementById('passwordError').textContent = '';

        if (modalFechaInstance) modalFechaInstance.hide();
        modalPassword.show();
    }

    document.getElementById('formPassword').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);
        const errorDiv = document.getElementById('passwordError');
        const modalPasswordEl = document.getElementById('modalPassword');
        const modalConfirmacionEl = document.getElementById('modalConfirmacionExito');
        const confirmacionMsg = document.getElementById('modalConfirmacionMensaje');

        fetch('../modelo/login_profesor/actualizar_fecha_seguro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modalPasswordInstance = bootstrap.Modal.getInstance(modalPasswordEl);
                if (modalPasswordInstance) {
                    modalPasswordInstance.hide();
                }

                const accionRealizada = formData.get('accion'); 
                if (accionRealizada === 'reiniciar') {
                     confirmacionMsg.textContent = 'La fecha del examen ha sido reiniciada correctamente.';
                } else {
                     confirmacionMsg.textContent = 'La fecha del examen se ha actualizado correctamente.';
                }

                const modalConfirmacionInstance = bootstrap.Modal.getOrCreateInstance(modalConfirmacionEl);
                modalConfirmacionInstance.show();

            } else {
                errorDiv.textContent = data.message || 'Ocurrió un error.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorDiv.textContent = 'Error de conexión con el servidor.';
        });
    });
</script>