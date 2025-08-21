<style>
    body {
        padding-top: 70px;
        background: linear-gradient(135deg, #1a1a1d, #3c3c3c);
        color: #f1f1f1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .navbar {
        height: 70px; /* o el valor que prefieras */
    }
    #offcanvasDarkNavbar {
        width: 600px !important;
    }
    .navbar-custom {
        background: linear-gradient(90deg, rgb(9, 31, 62), rgb(17, 66, 138));
    }
    .navbar-brand {
        font-weight: bold;
        font-size: 1.3rem;
    }
    .dropdown-menu-dark {
        background-color: #252525;
        border-radius: 8px;
    }
    .dropdown-item {
        padding: 12px 20px;
        font-size: 1rem;
        transition: background 0.3s;
    }
    .dropdown-item:hover {
        background-color: #343a40;
        color: #fff;
    }
    .form-control {
        border-radius: 25px;
        padding-left: 20px;
    }
    .btn-success {
        border-radius: 25px;
        padding: 0.375rem 1.2rem;
    }
    .offcanvas-header {
        border-bottom: 1px solid #495057;
    }
    .offcanvas-title {
        font-weight: 600;
    }
    .justificado {
        text-align: justify;
    }
    .contenedor-cursos {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        margin-top: 2rem;
    }
    .contenedor-lateral {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        flex: 1 1 300px;
        max-width: 530px;
    }
    #mainContent {
        flex: 1 1 400px;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        max-width: 900px;
    }
    #temasCurso {
        flex: 1 1 400px;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        max-width: 500px;
    }
    #temasCurso h2 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    .tarjeta-curso {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        color: inherit;
        font-size: 0.95rem;
    }
    .tarjeta-curso {
        padding: 1rem;
        font-size: 0.9rem;
    }
    .lista-temas {
        list-style-type: none;
        padding: 0;
    }
    .lista-temas li {
        padding: 8px;
        font-size: 16px;
        margin-bottom: 10px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.07);
        transition: background-color 0.3s ease, border-left 0.3s ease;
        cursor: pointer;
    }
    .lista-temas li a {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .lista-temas li.activo {
        font-weight: bold;
        background-color: rgba(0, 123, 255, 0.2); 
        border-left: 4px solid #007bff;
        color: #fff;
    }
    iframe {
        border-radius: 12px;
        max-width: 100%;
    }
    video {
        border-radius: 12px;
        max-width: 100%;
    }
    .light-mode {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
        color: #212529 !important;
    }
    .light-mode #mainContent {
        background-color: rgba(255, 255, 255, 0.85) !important;
        color: #212529 !important;
    }
    body.light-mode {
        background-color: #f8f9fa;
        color: #212529;
    }
    .mode-toggle {
        background: none;
        border: none;
        color: #fff;
        font-size: 1.3rem;
    }
    .mode-toggle:hover {
        color: #ffc107;
    }
    .btn-pdf {
        margin-top: 1rem;
        background-color: #28a745;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 1rem;
    }
    .btn-pdf:hover {
        background-color: #218838;
    }
    .tema-lista-custom .titulo-tema {
        font-weight: 700;
        font-size: 1.0rem;
        color: #0d6efd; /* azul bootstrap */
        background-color: rgba(255, 255, 255, 0.05);
        border: none;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 10px;
    }
    .tema-lista-custom .list-group-item {
        background-color: rgba(255, 255, 255, 0.05);
        color: #ddd;
        border: none;
        transition: background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
        padding-left: 1.25rem;
    }
    .tema-lista-custom .list-group-item.ps-5 {
        padding-left: 3rem !important;
        font-style: italic;
        color: #bbb;
    }
    .tema-lista-custom .list-group-item:hover,
    .tema-lista-custom .list-group-item:focus {
        background-color: #0d6efd;
        color: #fff;
        text-decoration: none;
        outline: none;
    }
    body.light-mode .tema-lista-custom .titulo-tema {
        background-color: #e9ecef;
        color: #0d6efd;
    }
    body.light-mode .tema-lista-custom .list-group-item {
        background-color: #fff;
        color: #212529;
    }
    body.light-mode .tema-lista-custom .list-group-item.ps-5 {
        color: #495057;
        font-style: italic;
    }
    body.light-mode .tema-lista-custom .list-group-item:hover,
    body.light-mode .tema-lista-custom .list-group-item:focus {
        background-color: #0d6efd;
        color: #fff;
        text-decoration: none;
        outline: none;
    }
    @media (max-width: 768px) {
        #temasCurso {
            display: none;
        }
        .contenedor-lateral {
            display: none;
        }
    }
    @media (max-width: 576px) {
        body {
            padding-top: 60px;
            font-size: 0.95rem;
        }
        .navbar {
            height: auto;
            flex-wrap: wrap;
        }
        .navbar-brand {
            font-size: 1rem;
        }
        .navbar-brand img {
            max-width: 100px;
            height: auto;
        }
        .btn {
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }
        .btn-pdf {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
        #mainContent {
            padding: 1rem;
            max-width: 100%;
        }
        iframe, video {
            width: 100%;
            height: auto;
        }
        footer {
            font-size: 0.85rem;
            text-align: center;
        }
        footer i {
            font-size: 1.2rem;
        }
        .mode-toggle {
            font-size: 1rem;
        }
        .contenedor-cursos {
            flex-direction: column;
            gap: 1.5rem;
            padding: 0 10px;
        }
        .nav-tabs {
            margin-top: -10px;
            font-size: 0.8rem !important;
        }
        .nav-tabs .nav-link {
            font-size: 0.8rem !important;
            padding: 6px 10px !important;
        }
        .nav-tabs .dropdown-menu {
            font-size: 0.75rem !important;
        }
        .navbar-brand {
            font-size: 0.9rem;
        }
        .avatar{
            width: 40px;
            height: 40px;
        }
    }
</style>