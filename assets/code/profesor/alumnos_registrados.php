<?php
include_once __DIR__ . '/code/navbar_profesor.php';
include_once __DIR__ . '/../modelo/conexion.php';
$instituto_data = json_decode(file_get_contents(__DIR__ . '/../institutos.json'), true);
$sql = "
SELECT 
  U.id_usuario,
  U.nombres,
  U.apellido_paterno,
  U.apellido_materno,
  U.avatar,
  U.id_tipo_usuario,
  A.nocontrol AS matricula,
  A.semestre,
  A.horas_U1,
  A.horas_U2,
  A.horas_U3,
  A.horas_U4,
  A.horas_U5,
  U.campus,
  'Estudiante' AS rol
FROM usuarios U
INNER JOIN alumnos A ON U.id_usuario = A.id_usuario
";

$result = $conn->query($sql);
?>

<style>
.card.alumno-card {
  display: flex;
  flex-direction: row;
  align-items: center;
  padding: 15px;
  height: auto;
  font-size: clamp(0.85rem, 2.5vw, 1rem);
  background-color: #2c2c2e;
  color: #fff;
  border: 1px solid rgba(255,255,255,0.1);
  flex-wrap: wrap;
}

.card.alumno-card .alumno-info {
  flex: 1;
  padding: 0;
  min-width: 200px;
}

.card-img.avatar {
  width: 180px;
  height: 180px;
  object-fit: cover;
  border-radius: 50%;
  margin-right: 20px;
  flex-shrink: 0;
}

.card-body h5 {
  font-size: clamp(1rem, 3vw, 1.25rem);
  margin-bottom: 5px;
}

.badge {
  font-size: clamp(0.75rem, 2vw, 0.95rem);
  margin-bottom: 0.5rem;
  display: inline-block;
}

.bg-purple {
  background-color: #6f42c1 !important;
  color: #fff;
}

.btn-sm {
  padding: 0.25rem 0.6rem;
  font-size: 0.85rem;
}
html, body {
  height: 100%;
  margin: 0;
}

.flex-fill {
  flex: 1 1 auto;
}
@media (max-width: 576px) {
  .card.alumno-card {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .card-img.avatar {
    margin-right: 0;
    margin-bottom: 15px;
  }

  .card-body.alumno-info {
    padding: 0 10px;
  }
}

/* Modo claro */
body.light-mode .card.alumno-card {
  background-color: #ffffff;
  color: #212529;
  border-color: #dee2e6;
}

body.light-mode .badge {
  color: #fff;
}

body.light-mode .btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
}

</style>
<body>
<main class="flex-fill">
<div class="container mt-4">
  <div class="mb-3">
    <input type="text" id="buscador" class="form-control" placeholder="<?php echo $textos['buscar_alumno']; ?>">
  </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-4">
    <?php while ($alumno = $result->fetch_assoc()): ?>
      <?php
  $clave = $alumno['campus'];
  $nombre_instituto = isset($instituto_data[$clave]) ? $instituto_data[$clave] : $textos['no_instituto'];
  $color = 'bg-success';
  $rol = 'Estudiante';

  // Si es alumno, calcula total de horas
  $totalHorasTexto = '';
  if ((int)$alumno['id_tipo_usuario'] === 3) {
    $totalMinutos =
      intval($alumno['horas_U1']) +
      intval($alumno['horas_U2']) +
      intval($alumno['horas_U3']) +
      intval($alumno['horas_U4']) +
      intval($alumno['horas_U5']);

    $horas = floor($totalMinutos / 60);
    $minutos = $totalMinutos % 60;

    $totalHorasTexto = sprintf('%d:%02d Horas', $horas, $minutos);
  }
?>

      <div class="col">
        <div class="card alumno-card shadow-sm">
          <img src="/assets/images/avatar/<?php echo htmlspecialchars($alumno['avatar']); ?>" class="card-img avatar" alt="Avatar del usuario">
          <div class="card-body alumno-info">
            <div class="badge <?php echo $color; ?>"><?php echo $rol; ?></div>
            <h5><?php echo htmlspecialchars($alumno['nombres'] . ' ' . $alumno['apellido_paterno'] . ' ' . $alumno['apellido_materno']); ?></h5>
            <p class="mb-1"><strong><?php echo $textos['login_matricula']; ?>:</strong> <?php echo $alumno['matricula']; ?></p>
            <?php if (!empty($alumno['semestre'])): ?>
              <p class="mb-1"><strong><?php echo $textos['semestre']; ?>:</strong> <?php echo $alumno['semestre']; ?></p>
            <?php endif; ?>
            <p class="mb-1"><strong><?php echo $textos['instituto']; ?>:</strong> <?php echo $nombre_instituto; ?></p>
            <?php if (!empty($totalHorasTexto)): ?>
              <p class="mb-1"><strong><?php echo $textos['total_de_horas']; ?>: </strong><?php echo $totalHorasTexto; ?></p>
            <?php endif; ?>
<div class="text-end mt-3">
    <!-- Ver detalles con href -->
    <a href="/assets/code/profesor/perfil_alumnos_detalle.php?id=<?php echo $alumno['id_usuario']; ?>"
       class="btn btn-outline-primary btn-sm me-2 d-inline-flex align-items-center gap-1 shadow-sm">
      <i class="bi bi-person-vcard"></i> <?php echo $textos['ver_detalles']; ?>
    </a>

    <!-- Dar de baja -->
    <button class="btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1 shadow-sm">
      <i class="fas fa-user-slash"></i> <?php echo $textos['expulsar_alumno']; ?>
    </button>

</div>

          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>


    </main>

    <script>
  const removeAccents = (str) => {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
  };

  document.getElementById('buscador').addEventListener('input', function () {
    const query = removeAccents(this.value);
    const tarjetas = document.querySelectorAll('.alumno-card');

    tarjetas.forEach(card => {
      const text = removeAccents(card.innerText);
      if (text.includes(query)) {
        card.closest('.col').style.display = '';
      } else {
        card.closest('.col').style.display = 'none';
      }
    });
  });
</script>
<?php
include_once __DIR__ . '/../footer.php';
?>

</body>
