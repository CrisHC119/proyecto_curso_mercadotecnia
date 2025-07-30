<?php
session_start();

// Aquí ya tienes la conexión a BD en $conn
include_once __DIR__ . '/../../modelo/conexion.php'; // Ajusta la ruta a tu archivo de conexión

// Diccionario de idiomas
$idiomas = ['es' => 'Español', 'en' => 'English'];

// Detectar idioma actual en sesión o defecto
$idioma = $_SESSION['idioma'] ?? 'es';

// Si viene parámetro GET para cambiar idioma
if (isset($_GET['lang']) && in_array($_GET['lang'], array_keys($idiomas))) {
    $nuevoIdioma = $_GET['lang'];

    // Solo si el idioma es diferente
    if ($nuevoIdioma !== ($_SESSION['idioma'] ?? 'es')) {
        $_SESSION['idioma'] = $nuevoIdioma;
        $idioma = $nuevoIdioma;

        if (isset($_SESSION['id_usuario'])) {
            include_once __DIR__ . '/../../modelo/conexion.php'; // Asegúrate que no se incluye dos veces
            $stmt = $conn->prepare("UPDATE usuarios SET idioma = ? WHERE id_usuario = ?");
            $stmt->bind_param("si", $idioma, $_SESSION['id_usuario']);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        $idioma = $nuevoIdioma;
    }
}
if (!isset($_SESSION['id_usuario'])) {
    header("Location: /index.php");
    exit;
}
// Definir ruta del archivo JSON según el idioma
$rutaArchivo = __DIR__ . "/../../../lang/lang_{$idioma}.json";

// Verificar existencia del archivo
if (file_exists($rutaArchivo)) {
    $json = file_get_contents($rutaArchivo);
    $textos = json_decode($json, true);
} else {
    // Si no existe, carga el español por defecto
    $json = file_get_contents(__DIR__ . "/../../../lang/lang_es.json");
    $textos = json_decode($json, true);
}
  $horas = [
  'intro' => 1,
  'tema_1.1' => 1,
  'tema_1.2' => 1,
  'tema_1.2.1' => 2,
  'tema_1.2.2' => 3,
  'tema_1.2.3' => 2,
  'tema_1.3' => 2,
  'tema_1.4' => 1,
  'tema_1.5' => 2,
  'tema_1.6' => 2,
  'tema_1_total' => 17,
];

$excluir = ['tema_1_total']; // estos no se suman

$total = 0;
foreach ($horas as $clave => $valor) {
  if (!in_array($clave, $excluir)) {
    $total += $valor;
  }
}

$horas['total'] = $total;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tecnm Ciudad Victoria - <?php echo $textos['titulo']; ?></title>
  <link rel="icon" href="/assets/images/icons/icon_50_tecnm.jpg" type="image/jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      padding-top: 70px;
      background: linear-gradient(135deg, #1a1a1d, #3c3c3c);
      color: #f1f1f1;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .navbar {
      height: 70px; /* o el valor que prefieras */
    }
    #offcanvasDarkNavbar {
      width: 600px !important;
    }
    .navbar-custom {
      background: linear-gradient(90deg, rgb(9, 31, 62), rgb(17, 66, 138));
    }
    .navbar-brand {
      font-weight: bold;
      font-size: 1.3rem;
    }
    .dropdown-menu-dark {
      background-color: #252525;
      border-radius: 8px;
    }
    .dropdown-item {
      padding: 12px 20px;
      font-size: 1rem;
      transition: background 0.3s;
    }
    .dropdown-item:hover {
      background-color: #343a40;
      color: #fff;
    }
    .form-control {
      border-radius: 25px;
      padding-left: 20px;
    }
    .btn-success {
      border-radius: 25px;
      padding: 0.375rem 1.2rem;
    }

    .offcanvas-header {
      border-bottom: 1px solid #495057;
    }

    .offcanvas-title {
      font-weight: 600;
    }

    .justificado {
      text-align: justify;
    }

    .contenedor-cursos {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      margin-top: 2rem;
    }

/* Nuevo contenedor lateral */
.contenedor-lateral {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  flex: 1 1 300px;
  max-width: 530px;
}

  #mainContent {
    flex: 1 1 400px;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    max-width: 900px;
  }
  #temasCurso {
    flex: 1 1 400px;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    max-width: 500px;
  }

  #temasCurso h2 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    text-align: center;
  }
    .tarjeta-curso {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        color: inherit;
        font-size: 0.95rem;
    }
    .tarjeta-curso {
        padding: 1rem;
        font-size: 0.9rem;
    }
  .lista-temas {
    list-style-type: none;
    padding: 0;
  }

.lista-temas li {
  padding: 8px;
  font-size: 16px;
  margin-bottom: 10px;
  border-radius: 10px;
  background-color: rgba(255, 255, 255, 0.07);
  transition: background-color 0.3s ease, border-left 0.3s ease;
  cursor: pointer;
}

.lista-temas li a {
  text-decoration: none;
  color: inherit;
  display: block;
}

.lista-temas li.activo {
  font-weight: bold;
  background-color: rgba(0, 123, 255, 0.2); /* Azul translúcido para destacar */
  border-left: 4px solid #007bff;
  color: #fff;
}

    iframe {
      border-radius: 12px;
      max-width: 100%;
    }
    video {
      border-radius: 12px;
      max-width: 100%;
    }
    .light-mode {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
        color: #212529 !important;
    }

    .light-mode #mainContent {
        background-color: rgba(255, 255, 255, 0.85) !important;
        color: #212529 !important;
    }
body.light-mode {
  background-color: #f8f9fa;
  color: #212529;
}


    .mode-toggle {
        background: none;
        border: none;
        color: #fff;
        font-size: 1.3rem;
    }

    .mode-toggle:hover {
        color: #ffc107;
    }

        .btn-pdf {
      margin-top: 1rem;
      background-color: #28a745;
      border: none;
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      font-size: 1rem;
    }

    .btn-pdf:hover {
      background-color: #218838;
    }
    /* Temario: modo oscuro (default) */
.tema-lista-custom .titulo-tema {
  font-weight: 700;
  font-size: 1.0rem;
  color: #0d6efd; /* azul bootstrap */
  background-color: rgba(255, 255, 255, 0.05);
  border: none;
  padding: 10px 15px;
  border-radius: 10px;
  margin-bottom: 10px;
}

.tema-lista-custom .list-group-item {
  background-color: rgba(255, 255, 255, 0.05);
  color: #ddd;
  border: none;
  transition: background-color 0.3s ease, color 0.3s ease;
  cursor: pointer;
  padding-left: 1.25rem;
}

.tema-lista-custom .list-group-item.ps-5 {
  padding-left: 3rem !important;
  font-style: italic;
  color: #bbb;
}

.tema-lista-custom .list-group-item:hover,
.tema-lista-custom .list-group-item:focus {
  background-color: #0d6efd;
  color: #fff;
  text-decoration: none;
  outline: none;
}

/* Modo claro */
body.light-mode .tema-lista-custom .titulo-tema {
  background-color: #e9ecef;
  color: #0d6efd;
}

body.light-mode .tema-lista-custom .list-group-item {
  background-color: #fff;
  color: #212529;
}

body.light-mode .tema-lista-custom .list-group-item.ps-5 {
  color: #495057;
  font-style: italic;
}

body.light-mode .tema-lista-custom .list-group-item:hover,
body.light-mode .tema-lista-custom .list-group-item:focus {
  background-color: #0d6efd;
  color: #fff;
  text-decoration: none;
  outline: none;
}
@media (max-width: 768px) {
  #temasCurso {
    display: none;
  }
  .contenedor-lateral {
    display: none;
  }
}
@media (max-width: 576px) {
  body {
    padding-top: 60px;
    font-size: 0.95rem;
  }

  .navbar {
    height: auto;
    flex-wrap: wrap;
  }

  .navbar-brand {
    font-size: 1rem;
  }

  .navbar-brand img {
    max-width: 100px;
    height: auto;
  }

  .btn {
    font-size: 0.85rem;
    padding: 0.4rem 0.8rem;
  }

  .btn-pdf {
    font-size: 0.9rem;
    padding: 8px 16px;
  }

  #mainContent {
    padding: 1rem;
    max-width: 100%;
  }

  iframe, video {
    width: 100%;
    height: auto;
  }

  footer {
    font-size: 0.85rem;
    text-align: center;
  }

  footer i {
    font-size: 1.2rem;
  }

  .mode-toggle {
    font-size: 1rem;
  }

  .contenedor-cursos {
    flex-direction: column;
    gap: 1.5rem;
    padding: 0 10px;
  }
    .nav-tabs {
  margin-top: -10px;
    font-size: 0.8rem !important;
  }

  .nav-tabs .nav-link {
    font-size: 0.8rem !important;
    padding: 6px 10px !important;
  }

  .nav-tabs .dropdown-menu {
    font-size: 0.75rem !important;
  }
  .navbar-brand {
    font-size: 0.9rem;
  }
  .avatar{
    width: 40px;
    height: 40px;
  }
}
  </style>
</head>
<body class="d-flex flex-column min-vh-100">


<!-- NAVBAR -->
<nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $Index; ?>">
      <i class="bi bi-mortarboard-fill me-2"></i>ITCV - <?php echo $textos['titulo']; ?>  
    </a>

    <!-- Botón hamburguesa para móviles -->
<button class="navbar-toggler p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation" style="font-size: 0.9rem; transform: scale(0.9);">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarContenido">
      <div class="d-flex align-items-center flex-wrap justify-content-end">

        <!-- Logos -->
        <div class="d-flex align-items-center flex-wrap">
          <a class="navbar-brand d-none d-xxl-block me-2" href="https://www.gob.mx/">
            <img src="/assets/images/navbar/Gobierno de Mexico.png" alt="Gobierno de México" width="150" height="40">
          </a>
          <a class="navbar-brand d-none d-xl-block me-2" href="https://www.gob.mx/">
            <img src="/assets/images/navbar/Gobierno de Mexico 2.png" alt="Gobierno de México 2" width="50" height="50">
          </a>
          <a class="navbar-brand d-none d-lg-block me-2" href="https://www.gob.mx/sep">
            <img src="/assets/images/navbar/Secretaria de Educacion Publica.png" alt="SEP" width="140" height="40">
          </a>
          <a class="navbar-brand d-none d-md-block me-2" href="https://www.tecnm.mx/">
            <img src="/assets/images/navbar/TecNM.png" alt="TecNM" width="110" height="40">
          </a>
          <a class="navbar-brand d-none d-sm-block me-2" href="https://www.itvictoria.edu.mx/">
            <img src="/assets/images/navbar/TecNM CD Victoria.png" alt="TecNM CD Victoria" width="45" height="45">
          </a>
          <a class="navbar-brand d-none d-sm-block me-2" href="https://www.itvictoria.edu.mx/">
            <img src="/assets/images/navbar/TecNM Gestion Empresarial.png" alt="TecNM Gestion Empresarial" width="50" height="50">
          </a>
          </div>
        <!-- Botón de login -->
<div class="dropdown">
  <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="/assets/images/avatar/<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="avatar" width="55" height="55" class="rounded-circle shadow border border-2">
  </a>
  <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="avatarDropdown" style="min-width: 200px;">
    <li><a class="dropdown-item" href="/assets/code/profesor/lost_page_profesor.php?lang=<?php echo $idioma; ?>"><?php echo $textos['temas']; ?></a></li>
    <li><a class="dropdown-item" href="/assets/code/alumnos/calificaciones.php"><?php echo $textos['calificacion']; ?></a></li>
    <li><a class="dropdown-item" href="/assets/code/alumnos/temas/perfil_alumnos.php"><?php echo $textos['perfil']; ?></a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item text-danger" href="/assets/code/modelo/logout.php"><?php echo $textos['cerrar_sesion']; ?></a></li>
  </ul>
</div>      
</div>
      
    </div>
  </div>
</nav>
<div class="container-fluid mt-3">
  <ul class="nav nav-tabs px-3 fs-5 align-items-center">
    <li class="nav-item">
<a class="nav-link <?php echo $page_1; ?>" href="index_profesor.php?lang=<?php echo $idioma; ?>"><?php echo $textos['home']; ?></a>
    </li>
    <li class="nav-item">
<a class="nav-link <?php echo $page_2; ?>" href="/assets/code/profesor/lost_page_profesor.php?lang=<?php echo $idioma; ?>"><?php echo $textos['temas']; ?></a>
    </li>
    <li class="nav-item">
<a class="nav-link <?php echo $page_2; ?>" href="/assets/code/profesor/alumnos_registrados.php?lang=<?php echo $idioma; ?>"><?php echo $textos['alumnos']; ?></a>
    </li>
    <li class="nav-item">
<a class="nav-link <?php echo $page_2; ?>" href="examenes.php?lang=<?php echo $idioma; ?>"><?php echo $textos['examenes']; ?></a>
    </li>

    <!-- Menú de idioma -->
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
    <!-- Botón de modo oscuro/claro -->
    <li class="nav-item ms-2">
      <button id="toggleMode" class="btn btn-outline-secondary" title="Cambiar modo">
        <i id="modeIcon" class="bi bi-moon"></i>
      </button>
    </li>
  </ul>
</div>
<?php
?>
<script>
    const toggleModeBtn = document.getElementById('toggleMode');
    const modeIcon = document.getElementById('modeIcon');
    const body = document.body;

  function setMode(isDark) {
    if (isDark) {
      body.classList.remove('light-mode');
      modeIcon.classList.remove('bi-sun');
      modeIcon.classList.add('bi-moon');
      localStorage.setItem('theme', 'dark');
    } else {
      body.classList.add('light-mode');
      modeIcon.classList.remove('bi-moon');
      modeIcon.classList.add('bi-sun');
      localStorage.setItem('theme', 'light');
    }
  }

  toggleModeBtn.addEventListener('click', () => {
    const isDark = !body.classList.contains('light-mode');
    setMode(!isDark);
  });

  // Al cargar la página
  window.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'dark';
    setMode(savedTheme === 'dark');
  });
</script>

  <script>
    async function descargarPDF() {
      const { jsPDF } = window.jspdf;
      const content = document.getElementById("mainContent");

      const canvas = await html2canvas(content, {
        backgroundColor: null
      });

      const imgData = canvas.toDataURL("image/png");
      const pdf = new jsPDF("p", "mm", "a4");
      const imgProps = pdf.getImageProperties(imgData);
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

      pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
      pdf.save("curso_en_linea.pdf");
    }
  </script>

  <?php
// Idiomas disponibles
$idiomas = ['es' => 'Español', 'en' => 'English'];

// Si llega por GET
if (isset($_GET['lang']) && in_array($_GET['lang'], array_keys($idiomas))) {
    $_SESSION['idioma'] = $_GET['lang'];
}

// Si no hay idioma en sesión, establecer español por defecto
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}

$idioma = $_SESSION['idioma'];  
?>