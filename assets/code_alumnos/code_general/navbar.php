<?php
    ob_start();
    include_once __DIR__ . '/../../code_general/verificar_session_apagado.php';
    include __DIR__ . '/verificar_idioma.php';
    include_once __DIR__ . '/../../modelo/conexion.php';
    include_once __DIR__ . '/../../code_general/horas_establecidas.php';
    include_once __DIR__ . '/../../code_general/bootstrap_5.php';
    include_once __DIR__ . '/../styles/style_navbar.php';
//  include_once __DIR__ . '/../code/contador.php';
    include_once __DIR__ . '/verificar_notificacion.php';
?>
<script src="/assets/scripts/logout_inactividad.js"></script>
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
                <a class="navbar-brand" href="/assets/code_alumnos/index_alumnos.php?lang=<?php echo $_SESSION['idioma'];?>">
                <i class="bi bi-mortarboard-fill me-2"></i>ITCV - <?php echo $textos['titulo']; ?>  
                </a>

                <button class="navbar-toggler p-1 d-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation" style="font-size: 0.9rem; transform: scale(0.9);">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarContenido">
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
                    </div>
                </div>
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle position-relative" href="#" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/assets/images/avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>?v=<?php echo $_SESSION['avatar_version'] ?? time(); ?>" alt="avatar" width="40" height="40" class="rounded-circle shadow border border-2">                        <?php if ($hay_notificaciones): ?>
                            <span class="p-2 bg-danger border border-light rounded-circle notification-dot">
                                <span class="visually-hidden">Nuevas notificaciones</span>
                            </span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="avatarDropdown" style="min-width: 250px;"> <li><h6 class="dropdown-header"><?php echo $textos['noti']; ?></h6></li>
                        <?php if (!empty($notificaciones_pendientes)): ?>
                            <?php foreach ($notificaciones_pendientes as $notif): ?>
                                <li>
                                <a class="dropdown-item notification-item" href="<?php echo htmlspecialchars($notif['enlace'] ?? '#'); ?>"> <small>                        <?php if ($notif['tipo'] == 'actividad'): ?>
                                                <i class="bi bi-pencil-fill text-warning me-2"></i> <?php else: ?>
                                                <i class="bi bi-file-earmark-text-fill text-info me-2"></i> <?php endif; ?>
                                            <?php echo htmlspecialchars($notif['mensaje']); ?>
                                        </small>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><span class="dropdown-item-text text-muted ps-3"><small><?php echo $textos['no_noti']; ?></small></span></li>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/assets/code_alumnos/temas_curso.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['temas']; ?></a></li>
                        <li><a class="dropdown-item" href="/assets/code_alumnos/calificacion.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['calificacion']; ?></a></li>
                        <li><a class="dropdown-item" href="/assets/code_alumnos/alumnos/perfil.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['perfil']; ?></a></li>
                        <li><a class="dropdown-item" href="/assets/code_alumnos/contacto.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['contacto']; ?></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/assets/modelo/logout.php"><?php echo $textos['cerrar_sesion']; ?></a></li>
                    </ul>
                </div>   
            </div>
        </nav>
        <div class="container-fluid mt-3">
            <ul class="nav nav-tabs px-3 fs-5 align-items-center">
                <div class="nav-links-scrollable">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_1; ?>" href="/assets/code_alumnos/index_alumnos.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['home']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_2; ?>" href="/assets/code_alumnos/temas_curso.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['temas']; ?></a><!-- Pendiente -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_3; ?>" href="/assets/code_alumnos/calificacion.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['calificacion']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_4; ?>" href="/assets/code_alumnos/material.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['material']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page_5; ?>" href="/assets/code_alumnos/contacto.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['contacto']; ?></a>
                    </li>
                </div>
                <li class="nav-item dropdown ms-auto">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
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
                </li>
            </ul>
        </div>
        <div class="container-fluid d-md-none mt-3" id="mobile-hub-container">
            <div class="accordion" id="mobile-hub-accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAvatar">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAvatar" aria-expanded="false" aria-controls="collapseAvatar">
                        <img src="/assets/images/avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>?v=<?php echo $_SESSION['avatar_version'] ?? time(); ?>" alt="avatar" width="40" height="40" class="rounded-circle me-2">                            <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido_p']); ?>
                    </h2>
                    <div id="collapseAvatar" class="accordion-collapse collapse" aria-labelledby="headingAvatar" data-bs-parent="#mobile-hub-accordion">
                        <div class="accordion-body p-0">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action" href="/assets/code_alumnos/alumnos/perfil.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['perfil']; ?></a>
                                <a class="list-group-item list-group-item-action" href="/assets/code_alumnos/calificacion.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['calificacion']; ?></a>
                                <a class="list-group-item list-group-item-action" href="/assets/code_alumnos/contacto.php?lang=<?php echo $_SESSION['idioma'];?>"><?php echo $textos['contacto']; ?></a>
                                <a class="list-group-item list-group-item-action text-danger" href="/assets/modelo/logout.php"><?php echo $textos['cerrar_sesion']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThemes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThemes" aria-expanded="false" aria-controls="collapseThemes">
                            <?php echo $textos['temas']; ?> </button>
                    </h2>
                    <div id="collapseThemes" class="accordion-collapse collapse" aria-labelledby="headingThemes" data-bs-parent="#mobile-hub-accordion">
                        <div class="accordion-body">
                            <?php
                                include __DIR__ . '/tarjeta_curso.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="modal fade" id="modalInactividad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalInactividadLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInactividadLabel">Advertencia de Inactividad</h5>
                        </div>
                    <div class="modal-body text-center p-4">
                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 4rem;"></i>
                        
                        <p class="mt-3 fs-5">Tu sesión está a punto de expirar.</p>
                        <p>Para proteger tu información, serás desconectado automáticamente.</p>
                        
                        <h3 class="my-3">
                            Cerrando en <strong id="contadorInactividad">60</strong> segundos...
                        </h3>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" id="btnPermanecerActivo">Permanecer Conectado</button>
                    </div>
                </div>
            </div>
        </div>
    <script src="/assets/scripts/night_mode.js"></script>
