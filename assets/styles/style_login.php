<style>
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
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-image: url('/assets/images/background/background_login.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .center-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }
    .formulario {
        width: 100%;
        max-width: 460px;
        transition: all 0.4s ease-in-out;
        opacity: 0;
        transform: translateX(100%);
        z-index: 0;
        position: absolute;
    }
    .formulario.active-form {
        opacity: 1;
        transform: translateX(0);
        z-index: 1;
    }
    .formulario.out-left {
        transform: translateX(-100%);
    }
    .formulario.out-right {
        transform: translateX(100%);
    }
    .card {
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.85);
        border-radius: 16px;
        width: 100%;
    }
    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
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
    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    #togglePassword i,
    #togglePasswordProfesor i {
        color: #555;
    }
    #togglePassword:hover i,
    #togglePasswordProfesor:hover i {
        color: #000;
    }
    #switchFormBtn {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 100;
    }
    @media (max-width: 576px) {
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-image: url('/assets/images/background/background_login.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        .center-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 8px;
            box-sizing: border-box;
        }
        .formulario {
            max-width: 300px;
            padding: 0.8rem !important;
        }
        .card {
            padding: 0.8rem !important;
            border-radius: 10px;
            backdrop-filter: blur(6px);
            background-color: rgba(255, 255, 255, 0.88);
        }
        .logo-container img {
            width: 28px;
            height: 28px;
            margin-right: 6px;
        }
        .logo-text {
            font-size: 0.95rem;
        }
        .mensaje_1, .mensaje_2 {
            font-size: 0.65rem;
            text-align: center;
            margin-top: 8px;
        }
        .form-control {
            font-size: 0.75rem;
            padding: 0.4rem 0.6rem;
        }
        .form-floating label {
            font-size: 0.75rem;
        }
        .btn {
            font-size: 0.75rem;
            padding: 0.35rem 0.8rem;
        }
        #switchFormBtn {
            font-size: 0.65rem;
            padding: 2px 5px;
        }
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }
    }
</style>