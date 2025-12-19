<?php
    session_start(); 
    include_once __DIR__ . '/../code_index/navbar.php';
    include_once __DIR__ . '/../styles/style_lost_page.php';
?>
    </head>
    <body>
        <div class="bbody">
            <div class="container">.
                <?php $r = rand(1, 2);
                if ($r === 1): ?>
                <img class="imga" src="/assets/images/lost_page/Sleep_dog.png" alt="Página en desarrollo">
                <?php elseif ($r === 2): ?>
                <img class="imga" src="/assets/images/lost_page/Sleep_dog.png" alt="Página en desarrollo">
                <?php endif; ?>
                <h1><?php echo $textos['pagina_no_disponible']; ?></h1>
                <p><?php echo $textos['pagina_desarrollo']; ?>.<br><?php echo $textos['disculpa_lost']; ?></p>
                <button class="btns" onclick="history.back()">← <?php echo $textos['regresar']; ?></button>
                <footer>© 2025 TecNM Ciudad Victoria</footer>
            </div>
        </div>
    </body>
</html>