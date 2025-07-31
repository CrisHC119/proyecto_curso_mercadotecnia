  <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
      padding: 0 8px;
      gap: 1rem; /* antes: 2rem */
      margin-top: 1rem; /* antes: 2rem o más */
      margin-bottom: 1rem;
    }
    .justificado {
      font-size: 0.75rem; /* antes: 0.8rem */
      text-align: justify;
      padding: 0 8px;
    }

    .tarjeta-curso {
      font-size: 0.8rem; /* antes: 0.85rem */
      margin-bottom: 0.8rem;
      width: 100%;
      box-sizing: border-box;
      padding: 0.5rem 0.7rem;
    }

    h1 {
      font-size: 1rem; /* antes: 1.1rem */
      text-align: center;
    }

    h2 {
      text-align: center;
      font-size: 1.1rem;
    }
    .contenedor-lateral {
      margin-top: 1rem; /* antes: 2rem o más */
      margin-bottom: 1rem;
      gap: 1rem; /* reducir separación entre tarjetas */
    }

    .btn {
      font-size: 0.8rem;
      padding: 0.4rem 0.8rem;
    }

    footer p,
    footer small {
      font-size: 0.75rem;
    }
  }
</style>