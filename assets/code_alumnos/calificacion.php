<?php
    $page_3 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../modelo/login_alumno/verificar_calificacion.php';
    include_once __DIR__ . '/styles/style_calificacion.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
?>

<?php
    // Verificar inactividad
    include_once '../modelo/login_alumno/logout_inactividad.php';
?>
<script src="/assets/scripts/logout_inactividad.js"></script>

<main class="flex-fill container my-5">
    <h2 class="mb-5"><?php echo $textos['calificacion_unidad']; ?></h2>
    <div class="row g-4 justify-content-center">
        <div class="col-12 d-flex justify-content-center">
            <div class="card shadow card-calificacion text-center" style="width: 100%; max-width: 600px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title"><?php echo $textos['tema_1']; ?></h5>
                    <p class="card-text">
                        <?php echo $textos['examen']; ?>: 
                        <?php 
                            $valor = $calificaciones['calf_1'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>" . $textos['no_registrado'] . "</span>"; 
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <div class="card shadow card-calificacion text-center" style="width: 100%; max-width: 600px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title"><?php echo $textos['tema_2']; ?></h5>
                    <p class="card-text">
                        <?php echo $textos['examen']; ?>: 
                        <?php 
                            $valor = $calificaciones['calf_2'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>" . $textos['no_registrado'] . "</span>";
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <div class="card shadow card-calificacion text-center" style="width: 100%; max-width: 600px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title"><?php echo $textos['tema_3']; ?></h5>
                    <p class="card-text">
                        <?php echo $textos['examen']; ?>: 
                        <?php 
                            $valor = $calificaciones['calf_3'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>" . $textos['no_registrado'] . "</span>"; 
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <div class="card shadow card-calificacion text-center" style="width: 100%; max-width: 600px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title"><?php echo $textos['tema_4']; ?></h5>
                    <p class="card-text">
                        <?php echo $textos['examen']; ?>: 
                        <?php 
                            $valor = $calificaciones['calf_4'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>" . $textos['no_registrado'] . "</span>"; 
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <div class="card shadow card-calificacion text-center" style="width: 100%; max-width: 600px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title"><?php echo $textos['tema_5']; ?></h5>
                    <p class="card-text">
                        <?php echo $textos['examen']; ?>: 
                        <?php 
                            $valor = $calificaciones['calf_5'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>" . $textos['no_registrado'] . "</span>"; 
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>