<?php
  $idioma = $_GET['lang'] ?? 'es';

  session_start();
  $_SESSION['lang'] = $idioma;

  $idiomas = [
    'es' => 'Español',
    'en' => 'English'
  ];

  $rutaArchivo = __DIR__ . "/../lang/lang_{$idioma}.json";

  if (file_exists($rutaArchivo)) {
      $json = file_get_contents($rutaArchivo);
      $textos = json_decode($json, true);
  } else {
      $json = file_get_contents(__DIR__ . "/../lang/lang_es.json");
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

  $excluir = ['tema_1_total']; 

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      body {
        padding-top: 70px;
        background: linear-gradient(135deg, #1a1a1d, #3c3c3c);
        color: #f1f1f1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .navbar {
        height: 70px;
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
      .contenedor-lateral {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        flex: 1 1 300px;
        max-width: 530px;
      }
      .tarjeta-curso {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        color: inherit;
        font-size: 0.95rem;
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
        background-color: rgba(0, 123, 255, 0.2); 
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
@media (max-width: 576px) {
  body {
    padding-top: 60px;
    font-size: 0.95rem;
  }

  .navbar {
    height: 55px !important; /* Reducido */
    padding-top: 0.2rem;
    padding-bottom: 0.2rem;
  }

  .navbar-brand {
    font-size: 0.85rem !important;
  }

  .navbar-brand img {
    max-width: 80px;
    height: auto;
  }

  .btn {
    font-size: 0.75rem !important;
    padding: 0.3rem 0.6rem !important;
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

  .tarjeta-curso {
    padding: 1rem;
    font-size: 0.9rem;
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
    font-size: 0.75rem !important;
  }

  .nav-tabs .nav-link {
    font-size: 0.75rem !important;
    padding: 5px 8px !important;
  }

  .nav-tabs .dropdown-menu {
    font-size: 0.75rem !important;
  }
  

    .nav-item.dropdown .nav-link {
    font-size: 0.8rem;
    padding: 4px 8px;
  }

  .dropdown-menu-end {
    min-width: 90px;
    font-size: 0.75rem;
  }

  .dropdown-item {
    font-size: 0.75rem;
    padding: 5px 10px;
  }
}

      </style>
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
              <img src="/assets/images/navbar/Gobierno de Mexico.png" alt="Gobierno de México" width="150" height="40">
            </a>
            <a class="navbar-brand d-none d-xl-block me-2" title="<?php echo $textos['title_gobierno']; ?>" href="https://www.gob.mx/">
              <img src="/assets/images/navbar/Gobierno de Mexico 2.png" alt="Gobierno de México 2" width="50" height="50">
            </a>
            <a class="navbar-brand d-none d-lg-block me-2" title="<?php echo $textos['title_secretaria']; ?>" href="https://www.gob.mx/sep">
              <img src="/assets/images/navbar/Secretaria de Educacion Publica.png" alt="SEP" width="140" height="40">
            </a>
            <a class="navbar-brand d-none d-md-block me-2" title="<?php echo $textos['title_tec']; ?>" href="https://www.tecnm.mx/">
              <img src="/assets/images/navbar/TecNM.png" alt="TecNM" width="110" height="40">
            </a>
            <a class="navbar-brand d-none d-sm-block me-2" title="<?php echo $textos['title_tec_CV']; ?>" href="https://www.itvictoria.edu.mx/">
              <img src="/assets/images/navbar/TecNM CD Victoria.png" alt="TecNM CD Victoria" width="45" height="45">
            </a>
            <a class="navbar-brand d-none d-sm-block me-2" title="<?php echo $textos['title_tec_CV']; ?>" href="https://www.itvictoria.edu.mx/">
              <img src="/assets/images/navbar/TecNM Gestion Empresarial.png" alt="TecNM Gestion Empresarial" width="50" height="50">
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

    window.addEventListener('DOMContentLoaded', () => {
      const savedTheme = localStorage.getItem('theme') || 'dark';
      setMode(savedTheme === 'dark');
    });
    
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