  <?php
    session_start();
    if (isset($_SESSION['id_usuario'])) {
      session_unset(); 
      session_destroy(); 
      header("Location: index.php");
      exit;
    }
    $page_1 = 'active';
    $page_2 = '';
    include_once __DIR__ . '/assets/code/navbar_index.php';
  ?>

  <main class="flex-fill">
    <div class="contenedor-cursos">
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
          <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" title="<?php echo $textos['title_descargar_temario']; ?>" download class="btn btn-success d-inline-block px-4 py-2 mt-3" style="
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
    </div>

    <div class="contenedor-lateral">
      <div class="tarjeta-curso">
        <h2 class="text-center"><?php echo $textos['objetivos']; ?></h2>
        <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>
          <p>
            <?php echo $textos['objetivo_1'];?><br>
            <?php echo $textos['objetivo_2'];?><br>
            <?php echo $textos['objetivo_3'];?><br>
          </p>
        </div>
      <div class="tarjeta-curso">
        <h2 class="text-center"><?php echo $textos['total_horas'];?></h2>
        <p class="text-center display-6 fw-bold"><?php echo $horas['total'];?> hrs</p>
        <p class="text-center"><?php echo $textos['texto_horas'];?></p>
      </div>
    </div>
  </main>

  <?php
    include_once __DIR__ . '/assets/code/footer.php';
  ?>

  </body>
</html>


<style>
  @media (max-width: 768px) {
    .contenedor-cursos {
      flex-direction: column;
      display: flex;
      padding: 0 10px;
    }

    .justificado {
      font-size: 0.85rem; /* antes: 0.95rem */
      text-align: justify;
      padding: 0 10px;
    }

    .tarjeta-curso {
      font-size: 0.9rem;
      padding: 1rem;
    }

    h1 {
      font-size: 1.2rem; /* antes: 1.4rem */
    }

    h2 {
      font-size: 1.3rem;
    }

    .contenedor-lateral {
      margin-top: 2rem;
    }

    .btn {
      font-size: 0.9rem;
      padding: 0.5rem 1rem;
    }

    footer p,
    footer small {
      font-size: 0.85rem;
    }
  }
</style>