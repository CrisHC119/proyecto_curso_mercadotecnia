<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_3.8.php'; 
    $siguiente = 'T_3.A.php'; 
    include __DIR__ . '/../../code_general/icon_navegacion.php';
?>
<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_1.G']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0444']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0445']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0446']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0447']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0448']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0449']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0450']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0451']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0452']; ?></p>
            </div>
        </div>
    </div>
    <?php
        include __DIR__ . '/../../code_general/tarjeta_curso.php';
    ?>
</div>
<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>