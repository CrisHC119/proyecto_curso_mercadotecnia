<?php
    session_start(); 
    include_once __DIR__ . '/../code_index/navbar.php';
    include_once __DIR__ . '/../styles/style_lost_page.php';

    $errorResumido = $_SESSION['error_db'] ?? 'Error desconocido';
    unset($_SESSION['error_db']);
?>
</head>
<body>
    <div class="bbody">
        <div class="container">
            <img class="imga" src="/assets/images/lost_page/idle_dog.webp" alt="Página en desarrollo">
            <h1><?php echo htmlspecialchars($textos['conexion_fallida']); ?></h1>
            <p>
                <strong>Error:</strong> <?php echo htmlspecialchars($errorResumido); ?><br>
                <?php echo htmlspecialchars($textos['disculpa_lost']); ?>
            </p>
            <button class="btns" onclick="history.back()">← <?php echo htmlspecialchars($textos['regresar']); ?></button>
            <footer>© 2025 TecNM Ciudad Victoria</footer>
        </div>
    </div>
</body>
</html>
