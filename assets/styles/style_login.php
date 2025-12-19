<!-- style_login.php -->
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-image: url('/assets/images/background/background_login.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    body.fade-in {
        opacity: 1;
    }
    body.fade-out {
        opacity: 0;
    }
    .center-container {
        min-height: 100%; 
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1.5rem;
        box-sizing: border-box;
        position: relative;
        overflow: hidden; 
    }
    .formulario {
        width: 100%;
        max-width: 450px;
        transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
    }
    .formulario:not(.active-form) {
        position: absolute;
        opacity: 0;
    }
    .formulario.active-form {
        opacity: 1;
        transform: translateX(0);
        z-index: 1;
    }
    .formulario.out-left {
        transform: translateX(-120%);
    }
    .formulario.out-right {
        transform: translateX(120%);
    }
    .card {
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        width: 100%;
        padding: 2rem;
    }
    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    .logo-container img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }
    .logo-text {
        font-size: 1.5rem;
        font-weight: bold;
    }
    #switchFormBtn {
        position: fixed;
        top: 30px;
        right:50px;
        z-index: 100;
        transition: background-color 0.3s, color 0.3s;
        padding: 15px 30px;
        font-size: 1.7rem;
    }
    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    @media (max-width: 576px) {
        .center-container {
            padding: 1rem 0.7rem;
        }
        .formulario {
            max-width: 300px;
        }
        .card {
            padding: 0.8rem 1.2rem; 
        }
        .logo-container {
            margin-bottom: 0.6rem; 
        }
        .logo-container img {
            width: 24px;
            height: 24px;
        }
        .logo-text {
            font-size: 0.95rem;
        }
        .card-title {
            font-size: 1.05rem;
            margin-bottom: 0.2rem !important; 
        }
        .text-muted.mensaje_1 {
            margin-bottom: 0.8rem !important; 
            font-size: 0.68rem;
        }
        .form-floating {
            margin-bottom: 0.5rem !important; 
            position: relative;
        }
        .form-text.mensaje_2 {
            font-size: 0.62rem;
            line-height: 1.3;
            margin-bottom: 0.8rem !important;
        }
        .form-control,
        .form-floating > .form-control,
        .form-floating > label {
            font-size: 0.72rem;
            height: 2.6rem;
            min-height: 0;
        }
        .form-floating > .form-control {
            padding: 0.5rem;
        }
        .form-floating > label {
            padding: 0 0.5rem;
            display: flex;
            align-items: center;
            width: 100%;
        }
        .btn {
            font-size: 0.72rem; 
            padding: 0.3rem 0.7rem;
        }
        .text-center.mt-3 {
            margin-top: 0.6rem !important;
        }
        .text-center.mt-3 > .mensaje_1, 
        .text-center.mt-3 > a {
            font-size: 0.68rem;
        }
        #switchFormBtn {
            font-size: 0.65rem;
            padding: 0.2rem 0.4rem;
            top: 10px;
            right: 10px;
            padding: 15px 20px;
            font-size: 1.1rem;
        }
        #liveToast {
            max-width: 240px;
            font-size: 0.7rem;
            border-radius: 0.5rem;
            right: 0;
            left: 0;
            margin: 0 auto;
        }
        .toast-body {
            padding: 0.6rem 0.8rem;
        }
        #liveToast .btn-close {
            font-size: 0.65rem;
        }
    }
</style>