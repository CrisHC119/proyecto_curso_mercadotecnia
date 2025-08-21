<div class="modal fade" id="modalPasswordProfesor" tabindex="-1" aria-labelledby="modalPasswordProfesorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formVerificarPassword">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPasswordProfesorLabel">Verificación de contraseña</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p>Por favor, ingresa tu contraseña para continuar:</p>
          <input type="password" class="form-control" name="password" id="passwordProfesor" required>
          <div class="text-danger mt-2" id="errorPassword"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Verificar</button>
        </div>
      </form>
    </div>
  </div>
</div>