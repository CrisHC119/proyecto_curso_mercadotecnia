<?php
    ob_start();
    include_once __DIR__ . '/assets/code_index/navbar.php';
    include_once __DIR__ . '/assets/code_general/verificar_session_encendido.php';
    include_once __DIR__ . '/assets/code_general/verificar_institucion.php';
    include_once __DIR__ . '/assets/styles/style_transicion.php';
    include_once __DIR__ . '/assets/styles/style_register.php';
    include_once __DIR__ . '/assets/styles/style_botones.php';
    // Verifica las instituciones de instituto.json (igual no funciona aparte)
    $institutos = json_decode(file_get_contents(__DIR__ . '/assets/json/institutos.json'), true);
    $clave_campus = $_SESSION['campus'] ?? 'itcv';
    $nombre_campus = $institutos[$clave_campus] ?? 'Campus no encontrado';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
        //Redirecciona a la misma página con el idioma establecido (No se pudo guardar en otro archivo jaja)
    }
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<body class="bg-dark text-white">
    <div class="contenedor-central">
        <div class="text-center">
            <img id="previewAvatar" src="/assets/images/avatar/avatar_default.jpg" alt="Avatar" class="img-circular">
        </div>
        <div class="card card-perfil mt-4">
            <span class="badge-estudiante"><?php echo $textos['estudiante']; ?></span>
            <form method="POST" action="/assets/modelo/no_login/registrar_alumno.php" enctype="multipart/form-data" onsubmit="return validarFormulario();">
                <input type="hidden" name="form_type" value="datos_personales">
                    <div class="form-grid">
                        <div>
                            <label for="nombre"><?php echo $textos['nombre']; ?></label>
                            <input type="text" id="nombre" name="nombres" class="form-control" required>
                        </div>
                        <div>
                            <label for="apellido_p"><?php echo $textos['a_paterno']; ?></label>
                            <input type="text" id="apellido_p" name="apellido_paterno" class="form-control" required>
                        </div>
                        <div>
                            <label for="apellido_m"><?php echo $textos['a_materno']; ?></label>
                            <input type="text" id="apellido_m" name="apellido_materno" class="form-control">
                        </div>
                        <div>
                            <label for="semestre"><?php echo $textos['semestre']; ?></label>
                            <input type="text" id="semestre" name="semestre" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-grid mt-4">
                        <div>
                            <label for="campus_autocompletado"><?php echo $textos['campus']; ?></label>
                            <input type="text" id="campus_autocompletado" class="form-control" placeholder="Escribe tu campus..." required>
                            <input type="hidden" name="campus" id="campus_clave">
                        </div>
                    <div>
                        <label for="no_control"><?php echo $textos['no_control']; ?>:</label>
                        <input type="text" id="no_control" name="nocontrol" class="form-control" required>
                    </div>
                </div>
                <div class="form-grid mt-4">
                    <div>
                        <label for="pass"><?php echo $textos['pass']; ?></label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                <div>
                    <label for="pass"><?php echo $textos['pass_confirm']; ?></label>
                    <input type="password" id="pass_confirm" name="pass_confirm" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-verde_fuerte"><?php echo $textos['registrar_datos']; ?></button>
            </form>
            <button type="button" onclick="history.back()" class="btn btn-azul"><?php echo $textos['regresar']; ?></button>
        </div>
    </div>
</body>
<?php
    include_once __DIR__ . '/assets/code_general/footer.php';
?>
<?php
    include_once __DIR__ . '/assets/code_general/toast_message.php';
    include_once __DIR__ . '/assets/scripts/script_register.php';
?>