  <?php
    $page_1 = '';
    $page_2 = 'active';
    include_once __DIR__ . '/assets/code/navbar_index.php';
  ?>
  <style>
    #mainContent {
      max-width: 1400px;
      margin: 30px auto 20px auto;
      background-color: rgba(255,255,255,0.05);
      border-radius: 16px;
      padding: 2rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }
    .accordion {
      background-color: #222;
      color: #eee;
      border-radius: 8px;
      max-width: 1500px;
      margin: 0 auto; 
      box-shadow: 0 0 10px rgba(0,0,0,0.7);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .accordion-button {
      background-color: #333;
      color: #eee;
      cursor: pointer;
      padding: 0.75rem 1rem;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 1.1rem;
      font-weight: bold;
      border-bottom: 1px solid #444;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background-color 0.3s ease;
    }

    .accordion-button:hover {
      background-color: #444;
    }

    .accordion-button::after {
      content: '\25bc';
      font-size: 0.8rem;
      transition: transform 0.3s ease;
    }

    .accordion-button.active::after {
      transform: rotate(180deg);
    }

    .accordion-content {
      background-color: #1a1a1a;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease;
      padding-left: 1rem;
    }
    
    .accordion-content.show {
      max-height: 2000px;
      padding: 0.5rem 1rem 1rem 1rem;
    }

    .sub-accordion-button {
      background-color: #2a2a2a;
      color: #ccc;
      cursor: pointer;
      padding: 0.5rem 1rem;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 1rem;
      font-weight: 600;
      border-bottom: 1px solid #555;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-left: 1rem;
      transition: background-color 0.3s ease;
    }

    .sub-accordion-button:hover {
      background-color: #3a3a3a;
    }

    .sub-accordion-button::after {
      content: '\25bc';
      font-size: 0.7rem;
      transition: transform 0.3s ease;
    }

    .sub-accordion-button.active::after {
      transform: rotate(180deg);
    }

    .sub-accordion-content {
      background-color: #121212;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease;
      padding-left: 1rem;
      margin-left: 2rem;
      border-left: 2px solid #444;
    }

    .sub-accordion-content.show {
      max-height: 1500px;
      padding: 0.5rem 1rem 1rem 1rem;
    }

    .subtema-text {
      font-size: 0.95rem;
      color: #ddd;
      margin-bottom: 0.7rem;
    }
    @media (max-width: 768px) {
      #mainContent {
        padding: 1rem;
        max-width: 100%;
        margin: 20px 10px;
      }

      .accordion {
        max-width: 100%;
        margin: 0 5px;
      }

      .accordion-button,
      .sub-accordion-button {
        font-size: 0.75rem;
        padding: 0.6rem 0.8rem;
      }

      .subtema-text {
        font-size: 0.65rem;
      }

      .sub-accordion-button {
        margin-left: 0.5rem;
      }

      .sub-accordion-content {
        margin-left: 0.8rem;
        padding-left: 0.8rem;
      }
    }
    body.light-mode #mainContent {
      background-color: #ffffff;
      color: #000;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    body.light-mode .accordion {
      background-color: #f1f1f1;
      color: #000;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    body.light-mode .accordion-button {
      background-color: #e4e4e4;
      color: #000;
      border-bottom: 1px solid #ccc;
    }

    body.light-mode .accordion-button:hover {
      background-color: #dcdcdc;
    }

    body.light-mode .accordion-content {
      background-color: #fafafa;
    }

    body.light-mode .sub-accordion-button {
      background-color: #eaeaea;
      color: #000;
      border-bottom: 1px solid #ccc;
    }

    body.light-mode .sub-accordion-button:hover {
      background-color: #dedede;
    }

    body.light-mode .sub-accordion-content {
      background-color: #f5f5f5;
      border-left: 2px solid #ccc;
    }

    body.light-mode .subtema-text {
      color: #333;
    }
    .accordion-button.nivel-2,
    .accordion-button.nivel-3 {
      text-align: left;
      padding-right: 1rem;
    }
  </style>

  <main class="flex-fill">
  <div class="contenedor-temas">
    <div id="mainContent">
      <h1 class="text-center mb-4"><?php echo $textos['temario']; ?></h1>
      <div class="accordion">
        <button class="accordion-button"><?php echo $textos['tema_1']; ?>
          <span class="text-muted small ms-2 flex-shrink-0">17 hrs</span>
        </button>
        <div class="accordion-content">
          <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100"><?php echo $textos['tema_0']; ?>
            <span class="text-muted small ms-2 flex-shrink-0">1 hrs</span>
          </button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_0_description']; ?></p>
          </div>
          <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100" style="text-align: left;">
            <span><?php echo $textos['tema_1.1']; ?></span>
            <span class="text-muted small ms-2 flex-shrink-0">1 hrs</span>
          </button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_1.1']; ?></p>
          </div>
          <button class="accordion-button nivel-2 d-flex justify-content-between align-items-center w-100">
            <span><?php echo $textos['tema_1.2']; ?></span>
            <span class="text-muted small ms-2 flex-shrink-0">1 hrs (8 hrs)</span>
          </button>    
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_1.2']; ?></p>
            <button class="accordion-button nivel-3"><?php echo $textos['tema_1.2.1']; ?>
              <span class="text-muted small ms-2 flex-shrink-0">2 hrs</span>
            </button>
            <div class="accordion-content">
              <p class="subtema-text"><?php echo $textos['tema_1.2.1']; ?></p>
            </div>
            <button class="accordion-button nivel-3"><?php echo $textos['tema_1.2.2']; ?>
              <span class="text-muted small ms-2 flex-shrink-0">3 hrs</span>
            </button>
            <div class="accordion-content">
              <p class="subtema-text"><?php echo $textos['tema_1.2.2']; ?></p>
            </div>
            <button class="accordion-button nivel-3"><?php echo $textos['tema_1.2.3']; ?>
              <span class="text-muted small ms-2 flex-shrink-0">2 hrs</span>
            </button>
            <div class="accordion-content">
              <p class="subtema-text"><?php echo $textos['tema_1.2.3']; ?></p>
            </div>
          </div>
          <button class="accordion-button nivel-2"><?php echo $textos['tema_1.3']; ?>
            <span class="text-muted small ms-2 flex-shrink-0">2 hrs</span>
          </button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_1.3']; ?></p>
          </div>
          <button class="accordion-button nivel-2"><?php echo $textos['tema_1.4']; ?>
            <span class="text-muted small ms-2 flex-shrink-0">1 hrs</span>
          </button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_1.4']; ?></p>
          </div>
          <button class="accordion-button nivel-2"><?php echo $textos['tema_1.5']; ?>
            <span class="text-muted small ms-2 flex-shrink-0">2 hrs</span>
          </button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_1.5']; ?></p>
          </div>
          <button class="accordion-button nivel-2"><?php echo $textos['tema_1.6']; ?>
            <span class="text-muted small ms-2 flex-shrink-0">2 hrs</span>
          </button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_1.6']; ?></p>
          </div>
        </div>

        <button class="accordion-button"><?php echo $textos['tema_2']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_2']; ?></p>
          <button class="accordion-button nivel-2"><?php echo $textos['tema_2.1']; ?></button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_2.1']; ?></p>
          </div>
          <button class="accordion-button nivel-2"><?php echo $textos['tema_2.2']; ?></button>
          <div class="accordion-content">
            <p class="subtema-text"><?php echo $textos['tema_2.2']; ?></p>
      <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.1']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_2.2.1']; ?></p>
      </div>
      <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.2']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_2.2.2']; ?></p>
      </div>
      <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.3']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_2.2.3']; ?></p>
      </div>
      <button class="accordion-button nivel-3"><?php echo $textos['tema_2.2.4']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_2.2.4']; ?></p>
      </div>
    </div>
  </div>
  <button class="accordion-button"><?php echo $textos['tema_3']; ?></button>
  <div class="accordion-content">
    <p class="subtema-text"><?php echo $textos['tema_3']; ?></p>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_3.1']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3.1']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_3.2']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3.2']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_3.3']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3.3']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_3.4']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3.4']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_3.5']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3.5']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_3.6']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3.6']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_3.7']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_3.7']; ?></p>
      </div>
    </div>
    <button class="accordion-button"><?php echo $textos['tema_4']; ?></button>
    <div class="accordion-content">
      <p class="subtema-text"><?php echo $textos['tema_4']; ?></p>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_4.1']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_4.1']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_4.2']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_4.2']; ?></p>
        <button class="accordion-button nivel-3"><?php echo $textos['tema_4.2.2']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_4.2.2']; ?></p>
        </div>
        <button class="accordion-button nivel-3"><?php echo $textos['tema_4.2.3']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_4.2.3']; ?></p>
        </div>
        <button class="accordion-button nivel-3"><?php echo $textos['tema_4.2.4']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_4.2.4']; ?></p>
        </div>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_4.3']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_4.3']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_4.4']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_4.4']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_4.5']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_4.5']; ?></p>
        <button class="accordion-button nivel-3"><?php echo $textos['tema_4.5.1']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_4.5.1']; ?></p>
        </div>
        <button class="accordion-button nivel-3"><?php echo $textos['tema_4.5.2']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_4.5.2']; ?></p>
        </div>
      </div>
    </div>
    <button class="accordion-button"><?php echo $textos['tema_5']; ?></button>
    <div class="accordion-content">
      <p class="subtema-text"><?php echo $textos['tema_5']; ?></p>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_5.1']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_5.1']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_5.2']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_5.2']; ?></p>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_5.3']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_5.3']; ?></p>
        <button class="accordion-button nivel-3"><?php echo $textos['tema_5.3.1']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_5.3.1']; ?></p>
        </div>
        <button class="accordion-button nivel-3"><?php echo $textos['tema_5.3.2']; ?></button>
        <div class="accordion-content">
          <p class="subtema-text"><?php echo $textos['tema_5.3.2']; ?></p>
        </div>
      </div>
      <button class="accordion-button nivel-2"><?php echo $textos['tema_5.4']; ?></button>
      <div class="accordion-content">
        <p class="subtema-text"><?php echo $textos['tema_5.4']; ?></p>
      </div>
    </div>
</div>

</div>
    <div class="text-center mt-4">
      <a href="assets/pdf/AE045 Mercadotecnia Electronica.pdf" download class="btn btn-success d-inline-block px-4 py-2 mt-3" style="
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
  
</div>
</main>
<?php
include_once __DIR__ . '/assets/code/footer.php';
?>



</body>
</html>
<script>
  // Acordeón principal
  document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', () => {
      const content = button.nextElementSibling;
      const isActive = button.classList.contains('active');

      // Si ya está activo, ciérralo
      if (isActive) {
        button.classList.remove('active');
        content.classList.remove('show');
      } else {
        button.classList.add('active');
        content.classList.add('show');
      }
    });
  });

  // Acordeón secundario (subacordeón)
  document.querySelectorAll('.sub-accordion-button').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation(); // para que no afecte al padre
      const isActive = btn.classList.contains('active');
      if (isActive) {
        btn.classList.remove('active');
        btn.nextElementSibling.classList.remove('show');
      } else {
        btn.classList.add('active');
        btn.nextElementSibling.classList.add('show');
      }
    });
  });
</script>