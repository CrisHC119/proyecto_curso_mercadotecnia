<?php
    $page_2 = 'active';
    include_once __DIR__ . '/code_general/navbar.php';
    include_once __DIR__ . '/../modelo/conexion.php'; 

    $sql = "
        SELECT
            U.id_usuario, U.nombres, U.apellido_paterno, U.avatar,
            A.nocontrol,
            C.calf_1 AS unidad_1,
            C.calf_2 AS unidad_2,
            C.calf_3 AS unidad_3,
            C.calf_4 AS unidad_4,
            C.calf_5 AS unidad_5
        FROM usuarios U
        INNER JOIN alumnos A ON U.id_usuario = A.id_usuario
        LEFT JOIN alumnos_calificacion C ON U.id_usuario = C.id_usuario
        WHERE U.id_tipo_usuario = 3
        ORDER BY U.apellido_paterno, U.nombres;
    ";
    $result = $conn->query($sql);
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            --bs-body-bg: #f8f9fa; 
            --bs-body-color: #212529; 
            padding-top: 70px; 
        }
        .card { background-color: #fff; }
        .table { --bs-table-bg: #fff; --bs-table-striped-bg: #f2f2f2; }

        body.light-mode { 
            --bs-body-bg: #121212; 
            --bs-body-color: #f1f1f1; 
        }
        body.light-mode .card { background-color: #2c2c2c; border-color: rgba(255,255,255,0.1); }
        body.light-mode .table { --bs-table-bg: #2c2c2c; --bs-table-color: #f1f1f1; --bs-table-border-color: #444; --bs-table-striped-bg: #333; }
        body.light-mode .form-control { background-color: #333; border-color: #555; color: #fff; }
        
        .avatar-calif { width: 45px; height: 45px; object-fit: cover; }
        .table thead th { text-align: center; vertical-align: middle; }
        .table tbody td { text-align: center; vertical-align: middle; }
        .alumno-info { text-align: left; }
        .calif-aprobado { color: var(--bs-success); font-weight: 500; }
        .calif-reprobado { color: var(--bs-danger); font-weight: 500; }
        .calif-final { font-size: 1.1rem; font-weight: bold; }
        .sin-calificar { color: var(--bs-secondary); }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0"><i class="bi bi-journal-check me-2"></i>Calificaciones</h1>
            </div>

            <div class="card shadow-sm rounded-4">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" id="buscador" class="form-control" placeholder="Buscar Alumnos">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col"><?php echo $textos['alumnos']; ?></th>
                                    <th scope="col">U1</th>
                                    <th scope="col">U2</th>
                                    <th scope="col">U3</th>
                                    <th scope="col">U4</th>
                                    <th scope="col">U5</th>
                                    <th scope="col">Calificacion Final</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-calificaciones">
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($alumno = $result->fetch_assoc()): ?>
    <tr class="alumno-row">
        <td class="alumno-info">
            <div class="d-flex align-items-center">
                <img src="/assets/images/avatar/<?php echo htmlspecialchars($alumno['avatar']); ?>" alt="Avatar" class="rounded-circle avatar-calif me-3">
                <div>
                    <h6 class="mb-0"><?php echo htmlspecialchars($alumno['nombres'] . ' ' . $alumno['apellido_paterno']); ?></h6>
                    <small class="text-body-secondary"><?php echo $textos['login_matricula'] ?? 'No. Control'; ?>: <?php echo htmlspecialchars($alumno['nocontrol']); ?></small>
                </div>
            </div>
        </td>
        
        <?php
            $calificaciones = [
                $alumno['unidad_1'],
                $alumno['unidad_2'],
                $alumno['unidad_3'],
                $alumno['unidad_4'],
                $alumno['unidad_5']
            ];
            
            foreach ($calificaciones as $calif) {
                if ($calif !== null) {
                    $clase_color = $calif >= 70 ? 'calif-aprobado' : 'calif-reprobado';
                    echo "<td class='{$clase_color}'>" . htmlspecialchars($calif) . "</td>";
                } else {
                    echo "<td class='sin-calificar'>—</td>";
                }
            }

            $suma_total = 0;
            foreach ($calificaciones as $calif) {
                $suma_total += intval($calif);
            }
            
            $promedio = $suma_total / 5;
            $promedio_final = number_format($promedio, 1);
            $clase_promedio = $promedio_final >= 70 ? 'calif-aprobado' : 'calif-reprobado';
            
            echo "<td class='calif-final {$clase_promedio}'>{$promedio_final}</td>";
        ?>
    </tr>
<?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4"><?php echo $textos['no_hay_alumnos']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const buscador = document.getElementById('buscador');
    if (buscador) {
        buscador.addEventListener('input', function() {
            const filtro = this.value.toLowerCase().trim();
            document.querySelectorAll('#tabla-calificaciones .alumno-row').forEach(row => {
                const textoRow = row.textContent.toLowerCase();
                row.style.display = textoRow.includes(filtro) ? '' : 'none';
            });
        });
    }
});
</script>

<?php
    include_once __DIR__ . '/../code_general/footer.php';
?>
</body>
</html>