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

    @keyframes aparecer {
        from {
        bottom: -100px;
        opacity: 0;
        }
        to {
        bottom: 20px;
        opacity: 1;
        }
    }

    .btn-info-flotante:hover {
        transform: scale(1.1);
    }

    @media (max-width: 600px) {
        .btn-info-flotante {
        width: 45px;
        height: 45px;
        font-size: 22px;
        right: 15px;
        bottom: 15px;
        }
    }
    </style>

    <button class="btn-info-flotante" onclick="window.location.href=\'itcv.php?lang=' . $_SESSION['lang'] . '\'">i</button>
    ';
?>
