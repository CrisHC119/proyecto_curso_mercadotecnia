<?php
    ob_start();
    include_once __DIR__ . '/assets/code_general/verificar_session_encendido.php';
    include_once __DIR__ . '/assets/code_general/verificar_session_apagado.php';
    include_once __DIR__ . '/assets/code_general/verificar_idioma.php';
    include_once __DIR__ . '/assets/code_general/bootstrap_5.php';
    include_once __DIR__ . '/assets/styles/style_login.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $textos['login']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/assets/images/icons_pestana/icon_50_tecnm.jpg" type="image/jpg">
    </head>
    <body>
        <button id="switchFormBtn" class="btn btn-outline-light"><?php echo $textos['login_profesor']; ?></button>
        <div id="loadingOverlay">
            <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden"><?php echo $textos['cargando']; ?></span>
            </div>
        </div>
        <div class="container center-container">
            <div id="formAlumno" class="formulario active-form">
                <div class="card shadow-lg p-4">
                    <div class="card-body">
                        <div class="logo-container">
                            <img src="/assets/images/icons_navbar/TecNM Gestion Empresarial.png" alt="Logo">
                            <span class="logo-text"><?php echo $textos['titulo']; ?></span>
                        </div>
                        <h3 class="card-title mb-2 text-center"><?php echo $textos['login']; ?></h3>
                        <p class="text-muted mensaje_1 mb-4 text-center"><?php echo $textos['login_frase']; ?></p>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nocontrol" name="nocontrol" placeholder="Número de Control" maxlength="8" required>
                            <label for="nocontrol"><?php echo $textos['no_control']; ?></label>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control pe-5" id="inputPassword5" name="password" placeholder="Contraseña" maxlength="20" required>
                            <label for="inputPassword5"><?php echo $textos['password']; ?></label>
                            <button type="button" id="togglePassword" class="btn btn-outline-secondary border-0 rounded-circle position-absolute top-50 end-0 translate-middle-y me-2 p-2">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="form-text mensaje_2 mb-3 text-center"><?php echo $textos['aviso_password']; ?></div>
                            <button id="loginBtn" class="btn btn-primary w-100"><?php echo $textos['login']; ?></button>
                            <div class="text-center mt-3">
                                <span class="mensaje_1"><?php echo $textos['aviso_registrar_1']; ?></span>
                                <a href="/register.php?lang=<?php echo $_SESSION['lang']; ?>" class="text-primary mensaje_1 fw-bold text-decoration-none"><?php echo $textos['aviso_registrar_2']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="formProfesor" class="formulario out-right">
                    <div class="card shadow-lg p-4">
                        <div class="card-body">
                            <div class="logo-container">
                                <img src="/assets/images/icons_navbar/TecNM Gestion Empresarial.png" alt="Logo">
                                <span class="logo-text"><?php echo $textos['titulo']; ?></span>
                            </div>
                            <h3 class="card-title mb-2 text-center"><?php echo $textos['login_profesor']; ?></h3>
                            <p class="text-muted mensaje_1 mb-4 text-center"><?php echo $textos['login_frase_profesor']; ?></p>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="matriculaProfesor" name="matricula" placeholder="Matrícula" maxlength="10" required>
                                <label for="nocontrolProfesor"><?php echo $textos['login_matricula']; ?></label>
                            </div>
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" class="form-control pe-5" id="inputPasswordProfesor" name="password" placeholder="Contraseña" maxlength="20" required>
                                <label for="inputPasswordProfesor"><?php echo $textos['password']; ?></label>
                                <button type="button" id="togglePasswordProfesor" class="btn btn-outline-secondary border-0 rounded-circle position-absolute top-50 end-0 translate-middle-y me-2 p-2">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-text mensaje_2 mb-3 text-center"><?php echo $textos['aviso_password']; ?></div>
                            <button id="loginProfesorBtn" class="btn btn-primary w-100"><?php echo $textos['login']; ?></button>
                        </div>
                    </div>
                </div>
            </div>
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
                <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body" id="toastMensaje">
                            <?php echo $textos['error_iniciar_sesion']; ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
            </div>
        </div>
    </body>
</html>
<?php
    include_once __DIR__ . '/assets/scripts/script_login.php'; 
?>