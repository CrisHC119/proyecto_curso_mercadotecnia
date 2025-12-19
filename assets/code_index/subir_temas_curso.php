<?php
    echo '
    <style>
    .btn-info-flotante {
        position: fixed;
        bottom: -100px;
        right: 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 55px;
        height: 55px;
        font-size: 26px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        z-index: 1000;
        animation: aparecer 0.5s ease-out forwards;
    }

    .btn-scroll-top {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 55px;
        height: 55px;
        font-size: 26px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        z-index: 1000;
        
        opacity: 0;
        visibility: hidden;
        transform: translateY(100px);
        transition: all 0.4s ease-in-out;
    }

    .btn-scroll-top.mostrar {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .btn-info-flotante:hover, 
    .btn-scroll-top:hover {
        transform: scale(1.1);
    }
    
    @keyframes aparecer {
        from { bottom: -100px; opacity: 0; }
        to { bottom: 20px; opacity: 1; }
    }

    @media (max-width: 600px) {
        .btn-info-flotante, .btn-scroll-top {
            width: 45px;
            height: 45px;
            font-size: 22px;
        }
        .btn-info-flotante { right: 15px; bottom: 15px; }
        .btn-scroll-top { left: 15px; bottom: 15px; }
    }
    </style>

    <button class="btn-info-flotante" onclick="window.location.href=\'contacto.php?lang=' . ($_SESSION['lang'] ?? 'es') . '\'">i</button>

    <button class="btn-scroll-top" id="btnSubir" onclick="subirArriba()">&#8679;</button>

    <script>
    const btnSubir = document.getElementById("btnSubir");

    window.onscroll = function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            btnSubir.classList.add("mostrar");
        } else {
            btnSubir.classList.remove("mostrar");
        }
    };

    function subirArriba() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
    </script>
    ';
?>