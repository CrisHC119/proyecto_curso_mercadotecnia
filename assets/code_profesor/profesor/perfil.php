<?php
    include_once __DIR__ . '/../../code_general/verificar_session_apagado.php';

    $institutos = json_decode(file_get_contents(__DIR__ . '/../../json/institutos.json'), true);
    $clave_campus = $_SESSION['campus'] ?? 'itcv';
    $nombre_campus = $institutos[$clave_campus] ?? 'Campus no encontrado';

    include_once __DIR__ . '/../code_general/navbar.php';
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .contenedor-central { display: flex; flex-direction: column; align-items: center; margin-top: 40px; padding: 0 1rem; }
    body { background-color: #121212; color: white; }
    .form-control { background-color: rgba(255,255,255,0.1); color: white; border: none; border-radius: 10px; padding: 10px 15px; }
    .form-control:focus { background-color: rgba(255,255,255,0.15); box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); }
    .card-perfil { background-color: rgba(255, 255, 255, 0.06); color: white; width: 100%; max-width: 1400px; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.4); text-align: center; padding: 2rem; }
    .modal-content { background-color: #222; color: white; border-radius: 15px; }
    .modal-header, .modal-footer { border: none; }
    .img-circular { width: 180px; height: 180px; object-fit: cover; border-radius: 50%; border: 4px solid #0d6efd; box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3); z-index: 2; position: relative; margin-bottom: 15px; }
    .btn-avatar_perfil, .btn-actualizar { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); border: none; border-radius: 50px; padding: 12px 25px; font-weight: 600; text-transform: uppercase; box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4); transition: all 0.3s ease; color: white; }
    .btn-avatar_perfil { margin-bottom: 20px; }
    .btn-actualizar { margin-top: 2rem; width: 100%; }
    .btn-avatar_perfil:hover, .btn-actualizar:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(13, 110, 253, 0.6); }
    .badge-profesor { background: #0d6efd; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.9rem; font-weight: bold; display: inline-block; margin-bottom: 1.5rem; }
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; text-align: left; }
    label { font-weight: 500; margin-bottom: 0.4rem; }
    .btn-regresar { background: linear-gradient(135deg, #6c757d 0%, #5c636a 100%); color: white; border: none; border-radius: 50px; padding: 12px 25px; font-weight: 600; margin-top: 2rem; text-transform: uppercase; box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4); transition: all 0.3s ease; }
    .btn-regresar:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(108, 117, 125, 0.6); }
    body.light-mode { background-color: #f8f9fa; color: #212529; }
    body.light-mode .card-perfil, body.light-mode .form-control { background-color: #ffffff; color: #212529; }
    body.light-mode .form-control { border: 1px solid #ced4da; }
    body.light-mode .modal-content { background-color: #f1f1f1; color: #212529; }
</style>

<body class="bg-dark text-white">
    <div class="contenedor-central">
        <img src="/assets/images/avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar" class="img-circular">
        <button type="button" class="btn btn-avatar_perfil" data-bs-toggle="modal" data-bs-target="#modalAvatar"><?php echo $textos['cambiar_avatar']; ?></button>
        <div class="card card-perfil">
            <span class="badge-profesor"><?php echo $textos['profesor']; ?></span>
            
            <form method="POST" action="/assets/modelo/login_profesor/update_profesor.php" onsubmit="return confirmarActualizar();">
                <input type="hidden" name="form_type" value="datos_personales">
                <div class="form-grid">
                    <div>
                        <label for="nombre"><?php echo $textos['nombre']; ?></label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($_SESSION['nombre']); ?>" required>
                    </div>
                    <div>
                        <label for="apellido_p"><?php echo $textos['a_paterno']; ?></label>
                        <input type="text" id="apellido_p" name="apellido_p" class="form-control" value="<?php echo htmlspecialchars($_SESSION['apellido_p']); ?>" required>
                    </div>
                    <div>
                        <label for="apellido_m"><?php echo $textos['a_materno']; ?></label>
                        <input type="text" id="apellido_m" name="apellido_m" class="form-control" value="<?php echo htmlspecialchars($_SESSION['apellido_m']); ?>">
                    </div>
                </div>
                <div class="form-grid mt-4">
                    <div>
                        <label for="campus_autocompletado"><?php echo $textos['campus']; ?></label>
                        <input type="text" id="campus_autocompletado" class="form-control" placeholder="Escribe tu campus..." required>
                        <input type="hidden" name="campus" id="campus_clave" value="<?php echo htmlspecialchars($_SESSION['campus'] ?? ''); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-actualizar"><?php echo $textos['act_datos']; ?></button>
            </form>

            <hr class="my-4">

            <form method="POST" action="/assets/modelo/login_profesor/update_profesor.php" onsubmit="return confirmarContraseña();">
                <input type="hidden" name="form_type" value="cambio_contraseña">
                <h5 class="mb-3">Cambiar Contraseña</h5>
                <div class="form-grid mt-4">
                    <div>
                        <label for="oldpass"><?php echo $textos['pass_actual']; ?></label>
                        <input type="password" id="oldpass" name="oldpass" class="form-control">
                    </div>
                    <div>
                        <label for="pass"><?php echo $textos['pass_new']; ?></label>
                        <input type="password" id="pass" name="pass" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-actualizar"><?php echo $textos['act_pass']; ?></button>
            </form>
            
            <a href="javascript:history.back()" class="btn btn-regresar">
                <?php echo $textos['regresar']; ?>
            </a>
        </div>
    </div>
    
    <div class="modal fade" id="modalAvatar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="/assets/modelo/general/cambiar_avatar.php" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $textos['new_avatar']; ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $textos['cancelar']; ?></button>
                        <button type="submit" class="btn btn-avatar_perfil"><?php echo $textos['actualizar_avatar']; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
    include_once __DIR__ . '/../../code_general/footer.php';
    include_once __DIR__ . '/../scripts/script_perfil.php';
?>
</body>