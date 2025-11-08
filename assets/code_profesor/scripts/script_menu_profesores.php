<script>
    document.addEventListener('DOMContentLoaded', function() {
    const loggedInUserId = <?php echo json_encode($_SESSION['id_usuario'] ?? 0); ?>;
    const loggedInUserRole = <?php echo json_encode($_SESSION['id_tipo_usuario'] ?? 0); ?>;
    
    const removeAccents = (str) => str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    const buscador = document.getElementById('buscador');
    if (buscador) {
        buscador.addEventListener('input', function() {
            const query = removeAccents(this.value);
            document.querySelectorAll('.usuario-card').forEach(card => {
                const text = removeAccents(card.innerText);
                card.closest('.col').style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    const eliminarModalEl = document.getElementById('confirmarEliminarModal');
    if (eliminarModalEl) {
        eliminarModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const usuarioId = button.getAttribute('data-id');
            eliminarModalEl.querySelector('#id_usuario_eliminar').value = usuarioId;
            eliminarModalEl.querySelector('#admin_password').value = '';
            eliminarModalEl.querySelector('#eliminarError').textContent = '';
        });
    }

    const formEliminar = document.getElementById('formEliminar');
    if (formEliminar) {
        formEliminar.addEventListener('submit', function(event) {
            event.preventDefault();
            const errorDiv = document.getElementById('eliminarError');
            const formData = new FormData(event.target);
            
            fetch('/assets/modelo/login_profesor/eliminar_usuario.php', { 
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Usuario eliminado correctamente.');
                    const usuarioCard = document.querySelector(`button[data-id='${formData.get('id_usuario_eliminar')}']`).closest('.col');
                    if (usuarioCard) {
                        usuarioCard.remove();
                    }
                    bootstrap.Modal.getInstance(eliminarModalEl).hide();
                } else {
                    errorDiv.textContent = data.message || 'Ocurrió un error.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorDiv.textContent = 'Error de conexión con el servidor.';
            });
        });
    }

    const agregarModalEl = document.getElementById('agregarPersonalModal');
    const formAgregar = document.getElementById('formAgregarPersonal');
    if (formAgregar) {
        agregarModalEl.addEventListener('hidden.bs.modal', function() {
            formAgregar.reset();
            document.getElementById('agregarError').textContent = '';
        });

        formAgregar.addEventListener('submit', function(event) {
            event.preventDefault();
            const errorDiv = document.getElementById('agregarError');
            errorDiv.textContent = ''; 

            const adminPass1 = document.getElementById('admin_password_crear').value;
            const adminPass2 = document.getElementById('admin_password_confirm_crear').value;

            if (adminPass1 !== adminPass2) {
                errorDiv.textContent = 'Las contraseñas de autorización no coinciden.';
                return;
            }

            const formData = new FormData(event.target);
            fetch('/assets/modelo/login_profesor/agregar_personal.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Personal agregado correctamente.');
                    bootstrap.Modal.getInstance(agregarModalEl).hide();
                    location.reload();
                } else {
                    errorDiv.textContent = data.message || 'Ocurrió un error al agregar el usuario.';
                }
            })
            .catch(error => {
                console.error('Error en fetch:', error);
                errorDiv.textContent = 'Error de conexión o el servidor falló.';
            });
        });
    }

    const detallesPersonalModalEl = document.getElementById('detallesPersonalModal');
    if (detallesPersonalModalEl) {
        detallesPersonalModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const modal = this;

            const avatar = button.dataset.avatar;
            const nombreCompleto = button.dataset.nombreCompleto;
            const rol = button.dataset.rol;
            const rolClass = button.dataset.rolClass;
            const instituto = button.dataset.instituto;
            
            const targetUserId = button.dataset.idUsuario; 
            const targetUserRole = button.dataset.idTipoUsuario;
            const fechaRegistro = button.dataset.fechaRegistro; 

            modal.querySelector('#modalAvatarPersonal').src = `/assets/images/avatar/${avatar}`;
            modal.querySelector('#modalNombreCompletoPersonal').textContent = nombreCompleto;
            modal.querySelector('#modalInstitutoPersonal').textContent = instituto;
            modal.querySelector('#modalIdUsuarioPersonal').textContent = targetUserId;
            modal.querySelector('#modalFechaRegistroPersonal').textContent = fechaRegistro;
            modal.querySelector('#modalIdUsuarioOculto').value = targetUserId; 

            const rolBadge = modal.querySelector('#modalRolPersonal');
            rolBadge.textContent = rol;
            rolBadge.className = 'badge fs-6 mb-3 ' + rolClass; 
            
            const btnPromote = modal.querySelector('#btnPromoverAdmin');
            const btnDemote = modal.querySelector('#btnDegradarProfesor');

            btnPromote.classList.add('d-none');
            btnDemote.classList.add('d-none');

            if (loggedInUserRole == 1 && loggedInUserId != targetUserId) {
                
                if (targetUserRole == 2) { 
                    btnPromote.classList.remove('d-none');
                }
                
                if (targetUserRole == 1) { 
                    btnDemote.classList.remove('d-none'); 
                }
            }
        });
    }
    
    function cambiarRolUsuario(targetUserId, nuevoRol) {
        const esPromover = nuevoRol == 1;
        const confirmMsg = esPromover 
            ? '¿Estás seguro de que deseas PROMOVER a este usuario a Administrador?'
            : '¿Estás seguro de que deseas DEGRADAR a este usuario a Profesor?';

        if (!confirm(confirmMsg)) {
            return;
        }
        
        const formData = new FormData();
        formData.append('id_usuario', targetUserId);
        formData.append('nuevo_rol', nuevoRol);
        const adminPassword = prompt("Para confirmar la acción, por favor ingrese su contraseña de administrador:");
        
        if (!adminPassword) {
            alert("Acción cancelada. No se proporcionó contraseña.");
            return;
        }
        
        formData.append('admin_password', adminPassword);

        fetch('/assets/modelo/login_profesor/cambiar_rol.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Rol actualizado correctamente.');
                location.reload(); 
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error en fetch:', error);
            alert('Error de conexión con el servidor.');
        });
    }

    document.getElementById('btnPromoverAdmin').addEventListener('click', function() {
        const targetUserId = document.getElementById('modalIdUsuarioOculto').value;
        cambiarRolUsuario(targetUserId, 1);
    });

    document.getElementById('btnDegradarProfesor').addEventListener('click', function() {
        const targetUserId = document.getElementById('modalIdUsuarioOculto').value;
        cambiarRolUsuario(targetUserId, 2);
  D });
});
</script>