<?php
  session_start(); // Asegúrate de tener esto al inicio del archivo
  $ubi_index = '';
  $ubi_calificacion = '../';

  $uno_uno = '/assets/code/alumnos/temas/tema_1/1.1.php?lang=' . $_SESSION['idioma'];
  $uno_dos = '/assets/code/alumnos/temas/tema_1/1.2.php?lang=' . $_SESSION['idioma'];
  $uno_dos_uno = '/assets/code/alumnos/temas/tema_1/1.2.1.php?lang=' . $_SESSION['idioma'];
  $uno_dos_dos = '/assets/code/alumnos/temas/tema_1/1.2.2.php?lang=' . $_SESSION['idioma'];
  $uno_dos_tres = '/assets/code/alumnos/temas/tema_1/1.2.3.php?lang=' . $_SESSION['idioma'];
  $uno_tres = '/assets/code/alumnos/temas/tema_1/1.3.php?lang=' . $_SESSION['idioma'];
  $uno_cuatro = '/assets/code/alumnos/temas/tema_1/1.4.php?lang=' . $_SESSION['idioma'];
  $uno_cinco = '/assets/code/alumnos/temas/tema_1/1.5.php?lang=' . $_SESSION['idioma'];
  $uno_seis = '/assets/code/alumnos/temas/tema_1/1.6.php?lang=' . $_SESSION['idioma'];
  $uno_siete = '/assets/code/alumnos/temas/tema_1/1.7.php?lang=' . $_SESSION['idioma'];
  $uno_G = '/assets/code/alumnos/temas/tema_1/1.G.php?lang=' . $_SESSION['idioma'];
  $tema_actual = "index";
  include_once __DIR__ . '/../code/navbar.php';
?>


<style>
        .btn-downtema {
            background: linear-gradient(135deg,rgb(46, 184, 30) 0%,rgb(5, 104, 5) 100%);
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(0, 255, 72, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-downtema:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(13, 255, 0, 0.6);
        }
        
        .btn-downtema:active {
            transform: translateY(1px);
        }
        
        .btn-downtema i {
            margin-right: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-downtema:hover i {
            transform: rotate(10deg);
        }
        
        .btn-downtema::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(17, 232, 60, 0.1) 0%, rgba(255,255,255,0) 100%);
            transition: all 0.3s ease;
        }
        
        .btn-downtema:hover::after {
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
        }


        .btn-tema {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-tema:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(37, 117, 252, 0.6);
        }
        
        .btn-tema:active {
            transform: translateY(1px);
        }
        
        .btn-tema i {
            margin-right: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-tema:hover i {
            transform: rotate(10deg);
        }
        
        .btn-tema::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            transition: all 0.3s ease;
        }
        
        .btn-tema:hover::after {
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
        }
  </style>

<!-- CONTENIDO PRINCIPAL -->
<div class="contenedor-cursos">
  <!-- Cuadro de la izquierda: contenido -->
  <div id="mainContent">
    <h1 class="text-center mb-4 titulo"><?php echo $textos['titulo']; ?></h1>
    <p class="justificado">
      <?php echo $textos['parrafo_0001']; ?>
    </p>
    <p class="justificado">
      <?php echo $textos['parrafo_0002']; ?>      
    </p>
    <p class="justificado">
      <?php echo $textos['parrafo_0003']; ?>
    </p>
    <p class="justificado">
      <?php echo $textos['parrafo_0004']; ?>
    </p>
    <p class="justificado">
      <?php echo $textos['parrafo_0005']; ?>
    </p>
    <div class="text-center mt-4">
      <a href="../../../pdf/AE045 Mercadotecnia Electronica.pdf" download class="btn btn-success btn-downtema d-inline-block px-4 py-2 mt-3" style="
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 500;
        background: linear-gradient(90deg, #28a745, #218838);
        border: none;
        color: #fff;
        transition: background 0.3s ease;
        text-decoration: none;
      ">
      <?php echo $textos['descargar_pdf_temas']; ?>
      </a>
  </div>
    <div class="text-center mt-4">

<a href="tema_1/1.1.php" class="btn btn-tema text-white">
  <i class="bi bi-play-circle-fill"></i><?php echo $textos['inicio_curso']; ?>
</a>

</div>
</div>
  
<!-- CONTENEDORES ADICIONALES A LA DERECHA -->
<div class="contenedor-lateral">
  <div class="tarjeta-curso">
    <h2 class="text-center"><?php echo $textos['pendiente']; ?></h2>
    <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>
    <p>
      <?php echo $textos['objetivo_3'];?><br>
    </p>
  </div>
  <!-- Objetivos del curso -->
  <div class="tarjeta-curso">
    <h2 class="text-center"><?php echo $textos['objetivos']; ?></h2>
    <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>
    <p>
      <?php echo $textos['objetivo_1'];?><br>
      <?php echo $textos['objetivo_2'];?><br>
      <?php echo $textos['objetivo_3'];?><br>
    </p>
  </div>
<?php
  include_once __DIR__ . '/../code/tarjeta_curso_index.php';
?>

</div>

<?php
//  include_once __DIR__ . '/assets/code/temas_curso_tema_1.php';
//echo password_hash('L21380393', PASSWORD_DEFAULT);

?>
</div>


  <?php
    include_once __DIR__ . '/../../footer.php';
  ?>
<?php

?>
</body>
</html>