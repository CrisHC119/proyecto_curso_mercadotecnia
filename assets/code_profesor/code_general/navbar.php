<?php
    ob_start();
    include_once __DIR__ . '/../../code_general/verificar_session_apagado.php';
    include_once __DIR__ . '/../../code_general/bootstrap_5.php';
    include_once __DIR__ . '/../styles/style_navbar.php';
    include_once __DIR__ . '/verificar_idioma.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tecnm Ciudad Victoria - <?php echo $textos['titulo']; ?></title>
        <link rel="icon" href="/assets/images/icons_pestana/icon_50_tecnm.jpg" type="image/jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-dark navbar-expand-md fixed-top navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand" href="/assets/code_profesor/index_profesor.php">
                    <i class="bi bi-mortarboard-fill me-2"></i>ITCV - <?php echo $textos['titulo']; ?>  
                </a>
                <div class="ms-auto" id="navbarContenido"> 
                    <div class="d-flex align-items-center flex-wrap justify-content-end">
                        
                        <div class="d-flex align-items-center flex-wrap">
                            <a class="navbar-brand d-none d-xxl-block me-2" href="https://www.gob.mx/">
                                <img src="/assets/images/icons_navbar/Gobierno de Mexico.png" alt="Gobierno de México" width="150" height="40">
                            </a>
                            <a class="navbar-brand d-none d-xl-block me-2" href="https://www.gob.mx/">
                                <img src="/assets/images/icons_navbar/Gobierno de Mexico 2.png" alt="Gobierno de México 2" width="50" height="50">
                            </a>
                            <a class="navbar-brand d-none d-lg-block me-2" href="https://www.gob.mx/sep">
                                <img src="/assets/images/icons_navbar/Secretaria de Educacion Publica.png" alt="SEP" width="140" height="40">
                            </a>
                            <a class="navbar-brand d-none d-md-block me-2" href="https://www.tecnm.mx/">
                                <img src="/assets/images/icons_navbar/TecNM.png" alt="TecNM" width="110" height="40">
                            </a>
                            <a class="navbar-brand d-none d-sm-block me-2" href="https://www.itvictoria.edu.mx/">
                                <img src="/assets/images/icons_navbar/TecNM CD Victoria.png" alt="TecNM CD Victoria" width="45" height="45">
                            </a>
                            <a class="navbar-brand d-none d-sm-block me-2" href="https://www.itvictoria.edu.mx/">
                                <img src="/assets/images/icons_navbar/TecNM Gestion Empresarial.png" alt="TecNM Gestion Empresarial" width="50" height="50">
                            </a>
                        </div>

                        <div class="dropdown">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/assets/images/avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="avatar" width="55" height="55" class="rounded-circle shadow border border-2">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="avatarDropdown" style="min-width: 200px;">
                                <li><a class="dropdown-item" href="/assets/code_profesor/menu_alumnos.php?lang=<?php echo $idioma; ?>"><?php echo $textos['alumnos']; ?></a></li>
                                <li><a class="dropdown-item" href="/assets/code_profesor/menu_profesores.php?lang=<?php echo $idioma; ?>"><?php echo $textos['profesor']; ?></a></li>
                                <li><a class="dropdown-item" href="/assets/code_profesor/menu_material.php?lang=<?php echo $idioma; ?>"><?php echo $textos['material']; ?></a></li>
                                <li><a class="dropdown-item" href="/assets/code_profesor/menu_examenes.php?lang=<?php echo $idioma; ?>"><?php echo $textos['examen']; ?></a></li>
                                <li><a class="dropdown-item" href="/assets/code_profesor/menu_calificacion_alumnos.php?lang=<?php echo $idioma; ?>"><?php echo $textos['calificacion']; ?></a></li>
                                <li><a class="dropdown-item" href="/assets/code_profesor/menu_ajustes.php?lang=<?php echo $idioma; ?>"><?php echo $textos['ajustes']; ?></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/assets/modelo/logout_profesor.php"><?php echo $textos['cerrar_sesion']; ?></a></li>
                            </ul>
                        </div>      
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-3">
            <ul class="nav nav-tabs px-3 fs-5 align-items-center">
                <div class="nav-links-scrollable">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_1; ?>" href="/assets/code_profesor/index_profesor.php?lang=<?php echo $idioma; ?>"><?php echo $textos['home']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_2; ?>" href="/assets/code_profesor/menu_calificacion_alumnos.php?lang=<?php echo $idioma; ?>"><?php echo $textos['calificacion']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_7; ?>" href="/assets/code_profesor/menu_material.php?lang=<?php echo $idioma; ?>"><?php echo $textos['material']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_3; ?>" href="/assets/code_profesor/menu_alumnos.php?lang=<?php echo $idioma; ?>"><?php echo $textos['alumnos']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_4; ?>" href="/assets/code_profesor/menu_profesores.php?lang=<?php echo $idioma; ?>"><?php echo $textos['profesor']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_5; ?>" href="/assets/code_profesor/menu_examenes.php?lang=<?php echo $idioma; ?>"><?php echo $textos['examenes']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_6; ?>" href="/assets/code_profesor/menu_ajustes.php?lang=<?php echo $idioma; ?>"><?php echo $textos['ajustes']; ?></a>
                    </li>
                </div>
                <li class="nav-item dropdown ms-auto">
                    <a class="nav-link dropdown-toggle" title="Cambiar Idioma" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <?= $idiomas[$idioma] ?? 'Idioma' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php foreach ($idiomas as $codigo => $nombre): ?>
                        <li>
                            <a class="dropdown-item <?= $idioma === $codigo ? 'active' : '' ?>" href="?lang=<?= $codigo ?>">
                            <?= $nombre ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
        <script src="/assets/scripts/night_mode.js"></script>