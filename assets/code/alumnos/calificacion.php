<?php
$ubi = 'temas/';
include_once __DIR__ . '/code/navbar.php';
include_once __DIR__ . '/../modelo/conexion.php';

$id_usuario = $_SESSION['id_usuario'] ?? null;
$calificaciones = [];


// Llenar arreglo con claves null por si no existen
for ($i = 1; $i <= 5; $i++) {
    $calificaciones["calf_$i"] = null;
}

if ($id_usuario) {
    $sql = "SELECT calf_1, calf_2, calf_3, calf_4, calf_5 FROM alumnos_calificacion WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $calificaciones = $resultado->fetch_assoc();
    }

    $stmt->close();
}
?>

<body>
    <style>
 .card-calificacion {
    height: 120px;          /* Más delgado */
    max-width: 800px;       /* Más ancho máximo */
    font-size: 1.25rem;
    transition: transform 0.2s;
    margin: auto;           /* Centrado automático */
    display: flex;
    align-items: center;    /* Centra verticalmente */
}

.card-calificacion:hover {
    transform: scale(1.03);
}

.card-body {
    width: 100%;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.card-text {
    font-size: 1.1rem;
    color: #444;
}

.no-registrado {
    color: #999;
    font-style: italic;
}

    </style>
<main class="flex-fill container my-5">
    <h2 class="mb-5">Calificaciones por Unidad</h2>
    <div class="row g-4 justify-content-center">

        <div class="col-12 d-flex justify-content-center">
            <div class="card shadow card-calificacion text-center" style="width: 100%; max-width: 600px;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title"><?php echo $textos['tema_1']; ?></h5>
                    <p class="card-text">
                        Examen: 
                        <?php 
                            $valor = $calificaciones['calf_1'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>No registrado</span>";
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
                        Examen: 
                        <?php 
                            $valor = $calificaciones['calf_2'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>No registrado</span>";
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
                        Examen: 
                        <?php 
                            $valor = $calificaciones['calf_3'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>No registrado</span>";
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
                        Examen: 
                        <?php 
                            $valor = $calificaciones['calf_4'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>No registrado</span>";
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
                        Examen: 
                        <?php 
                            $valor = $calificaciones['calf_5'] ?? null;
                            echo $valor !== null ? $valor : "<span class='no-registrado'>No registrado</span>";
                        ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
</main>



    <?php include_once __DIR__ . '/../footer.php'; ?>
</body>
