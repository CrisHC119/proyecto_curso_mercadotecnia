<?php
    ob_start();
    include_once __DIR__ . '/../code_general/verificar_session_encendido.php';
    include_once __DIR__ . '/../code_general/verificar_idioma.php';
    include_once __DIR__ . '/../code_general/error_404.php';
?>
<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tecnm Ciudad Victoria - <?php echo $textos['titulo']; ?></title>
        <link rel="icon" href="/assets/images/icons_pestana/icon_50_tecnm.jpg" type="image/jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
            include_once __DIR__ . '/../code_general/bootstrap_5.php';
            include_once __DIR__ . '/../styles/style_navbar.php';
        ?>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark">
            <div class="container-fluid">
            <a class="navbar-brand" title="<?php echo $textos['title_home']; ?>" href="/index.php?lang=<?php echo $_SESSION['lang']; ?>">
                <i class="bi bi-mortarboard-fill me-2"></i>ITCV - <?php echo $textos['titulo']; ?>  
            </a>
            <button class="navbar-toggler p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation" style="font-size: 0.9rem; transform: scale(0.9);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContenido">
                <div class="d-flex align-items-center flex-wrap justify-content-end">
                    <div class="d-flex align-items-center flex-wrap">
                    <a class="navbar-brand d-none d-xxl-block me-2" title="<?php echo $textos['title_gobierno']; ?>" href="https://www.gob.mx/">
                    <img src="/assets/images/icons_navbar/Gobierno de Mexico.png" alt="Gobierno de México" width="150" height="40">
                    </a>
                    <a class="navbar-brand d-none d-xl-block me-2" title="<?php echo $textos['title_gobierno']; ?>" href="https://www.gob.mx/">
                    <img src="/assets/images/icons_navbar/Gobierno de Mexico 2.png" alt="Gobierno de México 2" width="50" height="50">
                    </a>
                    <a class="navbar-brand d-none d-lg-block me-2" title="<?php echo $textos['title_secretaria']; ?>" href="https://www.gob.mx/sep">
                    <img src="/assets/images/icons_navbar/Secretaria de Educacion Publica.png" alt="SEP" width="140" height="40">
                    </a>
                    <a class="navbar-brand d-none d-md-block me-2" title="<?php echo $textos['title_tec']; ?>" href="https://www.tecnm.mx/">
                    <img src="/assets/images/icons_navbar/TecNM.png" alt="TecNM" width="110" height="40">
                    </a>
                    <a class="navbar-brand d-none d-sm-block me-2" title="<?php echo $textos['title_tec_CV']; ?>" href="https://www.itvictoria.edu.mx/">
                    <img src="/assets/images/icons_navbar/TecNM CD Victoria.png" alt="TecNM CD Victoria" width="45" height="45">
                    </a>
                    <a class="navbar-brand d-none d-sm-block me-2" title="<?php echo $textos['title_tec_CV']; ?>" href="https://www.itvictoria.edu.mx/">
                    <img src="/assets/images/icons_navbar/TecNM Gestion Empresarial.png" alt="TecNM Gestion Empresarial" width="50" height="50">
                    </a>
                </div>
                <a href="/login.php?lang=<?php echo $_SESSION['lang']; ?>" title="<?php echo $textos['login']; ?>" class="btn btn-primary ms-3 my-2 my-md-0" style="font-size: 0.9rem;">
                    <i class="bi bi-box-arrow-in-right me-1"></i><?php echo $textos['login']; ?>
                </a>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid mt-3">
    <ul class="nav nav-tabs px-3 fs-5 align-items-center">
    <li class="nav-item">
        <a class="nav-link <?php echo $page_1; ?>" title="<?php echo $textos['title_home']; ?>" aria-current="page" href="/index.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $textos['home']; ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $page_2; ?>" title="<?php echo $textos['title_temas']; ?>" href="/temas_curso.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $textos['temas']; ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $page_3; ?>" title="<?php echo $textos['contacto']; ?>" href="/contacto.php?lang=<?php echo $_SESSION['lang']; ?>"><?php echo $textos['contacto']; ?></a>
    </li>
    <li class="nav-item dropdown ms-auto">
        <a class="nav-link dropdown-toggle" title="<?php echo $textos['title_idioma']; ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
        <?= $idiomas[$idioma] ?? 'Idioma' ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item <?= $idioma == 'es' ? 'active' : '' ?>" href="?lang=es">Español</a></li>
        <li><a class="dropdown-item <?= $idioma == 'en' ? 'active' : '' ?>" href="?lang=en">English</a></li>
        </ul>
    </li>
    <li class="nav-item ms-2">
        <button id="toggleMode" class="btn btn-outline-secondary" title="<?php echo $textos['title_night_mode']; ?>">
        <i id="modeIcon" class="bi bi-moon"></i>
        </button>
    </li>
    </ul>
</div>
<script src="/assets/scripts/night_mode.js"></script>