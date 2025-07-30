<?php
  session_start(); 
  include_once __DIR__ . '/../code/navbar.php';
?>
<style>
  .bbody {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100vh - 70px); /* espacio para navbar */
    text-align: center;
    background: none;
    color: inherit;
  }

  .container {
    background-color: rgba(255, 255, 255, 0.07);
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    width: 90%;
    animation: fadeIn 0.6s ease-in-out;
    color: inherit;
  }

  body.light-mode .container {
    background-color: rgba(255, 255, 255, 0.9);
    color: #333;
  }

  .imga {
    width: 200px;
    height: auto;
    margin-bottom: 25px;
  }

  h1 {
    font-size: 30px;
    margin-bottom: 15px;
  }

  p {
    font-size: 17px;
    margin-bottom: 25px;
    line-height: 1.5;
  }

  .btns {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
  }

  .btns:hover {
    background-color: #2980b9;
    transform: scale(1.05);
  }

  footer {
    margin-top: 25px;
    font-size: 12px;
    color: #999;
  }

  @media screen and (max-width: 480px) {
    .container {
      padding: 20px;
    }

    h1 {
      font-size: 22px;
    }

    p {
      font-size: 15px;
    }

    .btns {
      font-size: 14px;
      padding: 10px 20px;
    }

    .imga {
      width: 150px;
    }
  }
</style>
</head>
<body>
  <div class="bbody">
    <div class="container">.
      <?php $r = rand(1, 2);
      if ($r === 1): ?>
      <img class="imga" src="/assets/images/lost_page/Sleep_dog.png" alt="Página en desarrollo">
      <?php elseif ($r === 2): ?>
      <img class="imga" src="/assets/images/lost_page/dog.png" alt="Página en desarrollo">
      <?php endif; ?>
      <h1><?php echo $textos['pagina_no_disponible']; ?></h1>
      <p><?php echo $textos['pagina_desarrollo']; ?>.<br><?php echo $textos['disculpa_lost']; ?></p>
      <button class="btns" onclick="history.back()">← <?php echo $textos['regresar']; ?></button>
      <footer>© 2025 TecNM Ciudad Victoria</footer>
    </div>
  </div>
</body>
</html>
