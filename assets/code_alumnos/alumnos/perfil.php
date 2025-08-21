<?php
    include_once __DIR__ . '/../../code_general/verificar_session_apagado.php';

    $institutos = json_decode(file_get_contents(__DIR__ . '/../../json/institutos.json'), true);
    $clave_campus = $_SESSION['campus'] ?? 'itcv';
    $nombre_campus = $institutos[$clave_campus] ?? 'Campus no encontrado';

    include_once __DIR__ . '/../code_general/navbar.php';
    include_once __DIR__ . '/../styles/style_perfil.php';
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<body class="bg-dark text-white">
    <div class="contenedor-central">
        <img src="/assets/images/avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="Avatar" class="img-circular">
        <button type="button" class="btn btn-avatar_perfil" data-bs-toggle="modal" data-bs-target="#modalAvatar"><?php echo $textos['cambiar_avatar']; ?></button>
        <div class="card card-perfil">
            <span class="badge-estudiante"><?php echo $textos['estudiante']; ?></span>
            <form method="POST" action="/assets/modelo/login_alumno/update_alumnos.php" onsubmit="return confirmarActualizar();">
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
            <form method="POST" action="/assets/modelo/login_alumno/update_alumnos.php" onsubmit="return confirmarContraseña();">
                <input type="hidden" name="form_type" value="cambio_contraseña">
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
    <div class="modal fade" id="modalAvatar" tabindex="-1" aria-labelledby="modalAvatarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="/assets/code/modelo/cambiar_avatar.php" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAvatarLabel"><?php echo $textos['new_avatar']; ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar" onclick="resetVistaPrevia()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mt-3">
                            <img id="previewAvatar" class="img-circular d-none" alt="Vista previa" />
                        </div>
                        <input type="file" name="nuevo_avatar" class="form-control mt-3" accept="image/*" required onchange="mostrarVistaPrevia(this)">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetVistaPrevia()"><?php echo $textos['cancelar']; ?></button>
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