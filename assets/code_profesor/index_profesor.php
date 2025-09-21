<?php
    $page_1 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>
<?php
    // Verificar inactividad
    //include_once '../modelo/login_profesor/logout_inactividad.php';
?>
<!--<script src="/assets/scripts/logout_inactividad_profesor.js"></script>-->

<body>
    <main class="flex-fill">
        <div class="container py-4">
            <h4 class="mb-4"><?php echo $textos['panel_navegacion']; ?></h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <div class="col">
                    <a href="/assets/code_404/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
                        <div class="card card-menu mensaje shadow-sm">
                            <i class="bi bi-chat-dots-fill"></i>
                            <h5><?php echo $textos['mensajes']; ?></h5>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/assets/code_404/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
                        <div class="card card-menu alumnos shadow-sm">
                            <i class="bi bi-people-fill"></i>
                            <h5><?php echo $textos['alumnos_registrados']; ?></h5>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/assets/code_404/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
                        <div class="card card-menu profesores shadow-sm">
                            <i class="bi bi-person-badge-fill"></i>
                            <h5><?php echo $textos['profesores_registrados']; ?></h5>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/assets/code_profesor/registros.php" class="text-decoration-none">
                        <div class="card card-menu registros shadow-sm">
                            <i class="bi bi-journal-text"></i>
                            <h5><?php echo $textos['registros']; ?></h5>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/assets/code_404/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
                        <div class="card card-menu actividades shadow-sm">
                            <i class="bi bi-list-task"></i>
                            <h5><?php echo $textos['actividades']; ?></h5>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/assets/code_404/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
                        <div class="card card-menu calificaciones shadow-sm">
                            <i class="bi bi-card-checklist"></i>
                            <h5><?php echo $textos['calificaciones']; ?></h5>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/assets/code_profesor/menu_examenes.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
                        <div class="card card-menu examenes shadow-sm">
                            <i class="bi bi-pencil-square"></i>
                            <h5><?php echo $textos['examenes']; ?></h5>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="/assets/modelo/logout_profesor.php" class="text-decoration-none">
                        <div class="card card-menu logout shadow-sm">
                            <i class="bi bi-box-arrow-right"></i>
                            <h5><?php echo $textos['cerrar_sesion']; ?></h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
</body>
