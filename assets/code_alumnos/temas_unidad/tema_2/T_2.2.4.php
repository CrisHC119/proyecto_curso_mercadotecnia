<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = 'T_2.2.3.php'; 
    $siguiente = 'T_3.1.php'; 
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <div class="d-flex align-items-start justify-content-between flex-wrap">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="text-center mb-4"><?php echo $textos['tema_2.2.4']; ?></h1>
                <p class="justificado"><?php echo $textos['parrafo_0279']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0280']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_01']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_02']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_03']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_04']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_05']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_06']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_07']; ?>
                    </li>                    
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_08']; ?>
                    </li>                    
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_09']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0280_10']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0281']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0282']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0283']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0283_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0283_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0283_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0283_4']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0284']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0284_4']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0285']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0285_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0285_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0285_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0285_4']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0286']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0287']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0288']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0288_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0288_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0288_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0288_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0288_5']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0289']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-info me-2"></i><?php echo $textos['parrafo_0289_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-info me-2"></i><?php echo $textos['parrafo_0289_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-info me-2"></i><?php echo $textos['parrafo_0289_3']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0290']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-muted me-2"></i><?php echo $textos['parrafo_0290_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-muted me-2"></i><?php echo $textos['parrafo_0290_2']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0291']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0292']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0293']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0294']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0295']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0296']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0297']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0298']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0299']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0300']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0301']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0302']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0303']; ?></p>
                <strong><p class="justificado"><?php echo $textos['parrafo_0304']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0305']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0306']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0307']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0308']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_01']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_02']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_03']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_04']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_05']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_06']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_07']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_08']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_09']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_10']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0308_11']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0309']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0310']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0311']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0311_1']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0311_2']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0311_3']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0312']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0312_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0312_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0312_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0312_4']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0313']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0314']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0315']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0316']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0317']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0317_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0317_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0317_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0317_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0317_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-success me-2"></i><?php echo $textos['parrafo_0317_6']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0318']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0319']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0320']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0321']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0322']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0323']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0324']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0325']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_01']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_02']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_03']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_04']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_05']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_06']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_07']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_08']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_09']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_10']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_11']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_12']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_13']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_14']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_15']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-warning me-2"></i><?php echo $textos['parrafo_0325_16']; ?>
                    </li>
                </ul>
                <strong><p class="justificado"><?php echo $textos['parrafo_0326']; ?></p></strong>
                <p class="justificado"><?php echo $textos['parrafo_0327']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0328']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0328_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0328_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0328_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-danger me-2"></i><?php echo $textos['parrafo_0328_4']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0329']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_6']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_7']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-secondary me-2"></i><?php echo $textos['parrafo_0329_8']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0330']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-info me-2"></i><?php echo $textos['parrafo_0330_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-info me-2"></i><?php echo $textos['parrafo_0330_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-info me-2"></i><?php echo $textos['parrafo_0330_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-info me-2"></i><?php echo $textos['parrafo_0330_4']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0331']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-muted me-2"></i><?php echo $textos['parrafo_0331_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-muted me-2"></i><?php echo $textos['parrafo_0331_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-muted me-2"></i><?php echo $textos['parrafo_0331_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-muted me-2"></i><?php echo $textos['parrafo_0331_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-muted me-2"></i><?php echo $textos['parrafo_0331_5']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0332']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0333']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0334']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0335']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0336']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0337']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0338']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0339']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0340']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0341']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0342']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0343']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0344']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0344_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0344_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0344_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-dark me-2"></i><?php echo $textos['parrafo_0344_4']; ?>
                    </li>
                </ul>
                <p class="justificado"><?php echo $textos['parrafo_0345']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0346']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0347']; ?></p>
                <p class="justificado"><?php echo $textos['parrafo_0348']; ?></p>
                <ul class="list-unstyled justificado mt-4">
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0348_1']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0348_2']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0348_3']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0348_4']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0348_5']; ?>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-arrow-right-circle-fill text-primary me-2"></i><?php echo $textos['parrafo_0348_6']; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php
  include_once __DIR__ . '/../../code_general/tarjeta_curso.php';
?>
</div>

<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>
<style>
  ul.list-unstyled.justificado li {
  line-height: 1.2;
}
</style>