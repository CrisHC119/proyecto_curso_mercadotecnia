<style>
    body {
        padding-top: 70px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: #212529;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .navbar {
        height: 70px;
    }
    #offcanvasDarkNavbar {
        width: 600px !important;
    }
    .navbar-custom {
        background: #003772ff;
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
        background-color: rgba(255, 255, 255, 0.85);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 900px;
    }
    #temasCurso {
        flex: 1 1 400px;
        background-color: rgba(255, 255, 255, 0.85);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 500px;
    }
    #temasCurso h2 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    .tarjeta-curso {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
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
        background-color: #f1f1f1;
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
        color: #000;
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
        background: linear-gradient(135deg, #1a1a1d, #3c3c3c) !important;
        color: #f1f1f1 !important;
    }
    .light-mode #mainContent,
    .light-mode #temasCurso {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #f1f1f1 !important;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }
     .light-mode .tarjeta-curso {
        background-color: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
    }
    .light-mode .lista-temas li {
        background-color: rgba(255, 255, 255, 0.07);
    }
    .light-mode .lista-temas li.activo {
        color: #fff;
    }
    body.light-mode {
        background-color: #1a1a1d;
        color: #f1f1f1;
    }
    .mode-toggle {
        background: none;
        border: none;
        color: #212529;
        font-size: 1.3rem;
    }
    .mode-toggle:hover {
        color: #007bff;
    }
    .light-mode .mode-toggle {
        color: #fff;
    }
    .light-mode .mode-toggle:hover {
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
        color: #0d6efd;
        background-color: #e9ecef;
        border: none;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 10px;
    }
    .tema-lista-custom .list-group-item {
        background-color: #fff;
        color: #212529;
        border: none;
        transition: background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
        padding-left: 1.25rem;
    }
    .tema-lista-custom .list-group-item.ps-5 {
        padding-left: 3rem !important;
        font-style: italic;
        color: #495057;
    }
    .tema-lista-custom .list-group-item:hover,
    .tema-lista-custom .list-group-item:focus {
        background-color: #0d6efd;
        color: #fff;
        text-decoration: none;
        outline: none;
    }
    body.light-mode .tema-lista-custom .titulo-tema {
        background-color: rgba(255, 255, 255, 0.05);
        color: #0d6efd;
    }
    body.light-mode .tema-lista-custom .list-group-item {
        background-color: rgba(255, 255, 255, 0.05);
        color: #ddd;
    }
    body.light-mode .tema-lista-custom .list-group-item.ps-5 {
        color: #bbb;
        font-style: italic;
    }
    body.light-mode .tema-lista-custom .list-group-item:hover,
    body.light-mode .tema-lista-custom .list-group-item:focus {
        background-color: #0d6efd;
        color: #fff;
        text-decoration: none;
        outline: none;
    }
    #modalInactividad .modal-content {
        background-color: #2d3748;
        color: #f5f5f5;
        border: 1px solid #4a5568;
    }

    #modalInactividad .modal-header {
        border-bottom: 1px solid #4a5568;
        color: #ffffff; 
    }

    #modalInactividad .modal-footer {
        border-top: 1px solid #4a5568;
    }
    #modalInactividad .modal-body {
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
        #mainContent .titulo {
            font-size: 1.4rem;
            margin-bottom: 1.2rem !important; 
        }
        .justificado {
            font-size: 0.9rem;
        }
        .tarjeta-curso {
            padding: 1rem 1.2rem;
        }
        .tarjeta-curso h2 {
            font-size: 1.1rem;
        }
        .tema-lista-custom .titulo-tema {
            font-size: 0.70rem;
            padding: 8px 12px;
        }
        .tema-lista-custom .list-group-item {
            font-size: 0.70rem;
            padding-left: 1rem;
        }
        .tema-lista-custom .list-group-item.ps-5 {
            padding-left: 2.2rem !important;
            font-size: 0.60rem;
        }
        .btn-downtema,
        .btn-tema {
            font-size: 0.9rem;
            padding: 12px 24px;
        }
        .navbar .dropdown img {
            width: 40px !important;
            height: 40px !important;
        }
        #mobile-hub-container .accordion-button {
            font-size: 0.8rem;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        #mobile-hub-container #headingAvatar .accordion-button img {
            width: 30px !important;
            height: 30px !important;
        }
        #mobile-hub-container .accordion-body .tema-lista-custom .titulo-tema {
            font-size: 0.65rem !important;
            padding: 6px 10px;
        }
        #mobile-hub-container .accordion-body .tema-lista-custom .list-group-item {
            font-size: 0.65rem !important; 
            padding-left: 0.8rem !important;
        }
        #mobile-hub-container .accordion-body .tema-lista-custom .list-group-item.ps-5 {
            padding-left: 1.8rem !important;
            font-size: 0.6rem !important;
        }
        #mobile-hub-container {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-top: 0.5rem !important;
        }
        .nav-tabs {
            flex-wrap: nowrap;
        }

        .nav-links-scrollable {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            flex: 1;
            min-width: 0; 
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .nav-links-scrollable::-webkit-scrollbar {
            display: none;
        }
    }
    .nav-links-scrollable {
        display: flex;
    }
    .accordion-button img {
        border: 2px solid #FFF;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .accordion-body .list-group-item {
        background-color: transparent;
        border: none;
        padding: 0.75rem 1.25rem;
        font-size: 0.9rem;
    }
    .accordion-body .list-group-item:hover {
        background-color: rgba(0,0,0,0.05);
    }
    body.light-mode .accordion-item {
        border-color: rgba(255,255,255,0.15);
    }
    body.light-mode .accordion-button {
        background-color: #212529;
        color: #f1f1f1;
    }
    body.light-mode .accordion-button:not(.collapsed) {
        background-color: #343a40;
    }
    body.light-mode .accordion-button::after {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    body.light-mode .accordion-body {
        background-color: #1a1a1d;
    }
    body.light-mode .accordion-body .list-group-item {
        color: #f1f1f1;
    }
    body.light-mode .accordion-body .list-group-item:hover {
        background-color: rgba(255,255,255,0.1);
    }
    body.light-mode .accordion-body .list-group-item.text-danger {
        color: #ff5c5c !important;
    }
    body.light-mode #mobile-hub-container .accordion-body .tarjeta-curso h2 {
        color: #f1f1f1 !important;
    }

    body.light-mode #mobile-hub-container .accordion-body .tema-lista-custom .titulo-tema {
        background-color: rgba(255, 255, 255, 0.08) !important;
        color: #79a6fc !important;
        border: none !important;
    }

    body.light-mode #mobile-hub-container .accordion-body .tema-lista-custom .list-group-item {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #e0e0e0 !important;
        border: none !important;
    }

    body.light-mode #mobile-hub-container .accordion-body .tema-lista-custom .list-group-item.ps-5 {
        color: #b0b0b0 !important;
    }

    body.light-mode #mobile-hub-container .accordion-body .tema-lista-custom .list-group-item:hover,
    body.light-mode #mobile-hub-container .accordion-body .tema-lista-custom .list-group-item:focus {
        background-color: #0d6efd !important;
        color: #fff !important;
        text-decoration: none !important;
        outline: none !important;
    }
    .navbar .dropdown a#avatarDropdown {
        position: relative; 
        display: inline-block; 
    }
    .notification-dot {
        position: absolute; 
        width: 0.99rem;     
        height: 0.99rem;
        padding: 0 !important; 
        border-radius: 50%; 
        top: -2px;
        right: 5px;
        z-index: 10; 
    }
    @media (max-width: 576px) {
        .notification-dot {
            width: 0.99rem; 
            height: 0.99rem;
            top: -2px;
            right: 5px;
        }
    }
</style>