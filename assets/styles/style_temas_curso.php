<!-- style_temas_curso.php -->
<style>
    #mainContent {
        max-width: 1400px;
        margin: 40px auto;
        background-color: #ffffff;
        color: #1a1a1a;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }
    .accordion {
        background-color: transparent;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        max-width: 1500px;
        margin: 0 auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow: hidden;
    }
    .accordion-button,
    .sub-accordion-button {
        background-color: #ffffff;
        color: #111827;
        cursor: pointer;
        padding: 1rem 1.25rem;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s ease-in-out;
    }
    .accordion-button {
        border-bottom: 1px solid #e5e7eb;
    }
    .accordion > div:last-of-type > .accordion-button {
        border-bottom: none;
    }
    .accordion-button:hover,
    .sub-accordion-button:hover {
        background-color: #f9fafb;
    }
    .accordion-button:focus-visible,
    .sub-accordion-button:focus-visible {
        box-shadow: inset 0 0 0 2px #d1d5db;
    }
    .accordion-button::after,
    .sub-accordion-button::after {
        content: '\002B';
        font-size: 1.4rem;
        font-weight: 300;
        color: #6b7280;
        transition: transform 0.3s ease-in-out;
    }
    .accordion-button.active::after,
    .sub-accordion-button.active::after {
        transform: rotate(45deg);
    }
    .accordion-content,
    .sub-accordion-content {
        background-color: #f9fafb;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }
    .accordion-content.show,
    .sub-accordion-content.show {
        max-height: 2000px;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .sub-accordion-button {
        padding-left: 2.5rem;
        font-size: 0.95rem;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
    }
    .sub-accordion-content {
        background-color: #f9fafb;
        padding-left: 3.5rem;
        border-left: none;
    }
    .subtema-text {
        font-size: 0.9rem;
        color: #4b5563;
        margin-bottom: 0.75rem;
        line-height: 1.6;
    }
    body.light-mode #mainContent {
        background-color: #111827;
        color: #f9fafb;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
    }
    body.light-mode .accordion {
        border-color: #374151;
    }
    body.light-mode .accordion-button,
    body.light-mode .sub-accordion-button {
        background-color: #1f2937;
        color: #f3f4f6;
    }
    body.light-mode .accordion-button {
        border-bottom-color: #374151;
    }
    body.light-mode .accordion-button:hover,
    body.light-mode .sub-accordion-button:hover {
        background-color: #374151;
    }
    body.light-mode .accordion-button:focus-visible,
    body.light-mode .sub-accordion-button:focus-visible {
        box-shadow: inset 0 0 0 2px #4b5563;
    }
    body.light-mode .accordion-button::after,
    body.light-mode .sub-accordion-button::after {
        color: #9ca3af;
    }
    body.light-mode .accordion-content,
    body.light-mode .sub-accordion-content {
        background-color: #111827;
    }
    body.light-mode .sub-accordion-button {
        background-color: #1f2937;
        border-top: 1px solid #374151;
        border-bottom: 1px solid #374151;
    }
    body.light-mode .subtema-text {
        color: #d1d5db;
    }
    .accordion-button,
    .accordion-button:hover,
    .accordion-button:focus,
    .accordion-button:active,
    .sub-accordion-button,
    .sub-accordion-button:hover,
    .sub-accordion-button:focus,
    .sub-accordion-button:active {
        background-color: #fff !important;
        color: #000 !important;
        box-shadow: none !important; 
        outline: none !important;    
    }
    body.light-mode .accordion-button,
    body.light-mode .accordion-button:hover,
    body.light-mode .accordion-button:focus,
    body.light-mode .accordion-button:active {
        background-color: #333 !important;
        color: #eee !important;
    }
    body.light-mode .sub-accordion-button,
    body.light-mode .sub-accordion-button:hover,
    body.light-mode .sub-accordion-button:focus,
    body.light-mode .sub-accordion-button:active {
        background-color: #2a2a2a !important;
        color: #ccc !important;
    }
    .badge-horas {
        display: inline-block;
        padding: 0.3em 0.7em;
        font-size: 0.75em;
        font-weight: 700;
        text-transform: uppercase; 
        letter-spacing: 0.5px;
        vertical-align: middle;
        border-radius: 50rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        white-space: nowrap;
    }
    .badge-horas {
        background: linear-gradient(145deg, #ffffff, #e6e6e6);
        color: #343a40;
        border: 1px solid #dee2e6;
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.7);
    }
    body.light-mode .badge-horas {
        background: linear-gradient(145deg, #495057, #343a40);
        color: #f8f9fa;
        border: 1px solid #5a6268;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
    }
    .badge-horas:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    body.light-mode .badge-horas:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    }
    @media (max-width: 768px) {
        #mainContent {
            padding: 0.5rem;
            margin: 15px 8px;
            border-radius: 8px;
        }
        .accordion-button,
        .sub-accordion-button {
            font-size: 0.65rem;
            padding: 0.75rem 1rem;
        }
        .sub-accordion-button {
            padding-left: 2rem;
        }
        .sub-accordion-content {
            padding-left: 2.5rem;
        }
        .subtema-text {
            font-size: 0.85rem;
        }
        .badge-horas {
            font-size: 0.40rem;
            padding: 0.25em 0.5em;
        }
        .btn-verde {
            font-size: 0.6rem !important;
            padding: 10px 20px !important;
            margin-top: 1.5rem !important;
        }
    }
    .layout-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 2rem;
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 1rem;
        align-items: start;
    }
    .indice-wrapper {
        position: sticky;
        top: 110px;
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }
    .indice-box {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }
    .indice-box h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #0d6efd;
        color: #1a1a1a;
    }
    .nav-link-tema {
        display: block;
        padding: 0.5rem 0.75rem;
        color: #1a1a1a;
        font-weight: 600;
        text-decoration: none;
        border-radius: 6px;
        margin-top: 0.5rem;
        transition: all 0.2s;
    }
    .nav-link-subtema {
        display: block;
        padding: 0.35rem 0.75rem 0.35rem 1.5rem;
        color: #6b7280;
        font-size: 0.9rem;
        text-decoration: none;
        border-left: 2px solid #e5e7eb;
        transition: all 0.2s;
    }
    .nav-link-tema:hover, .nav-link-subtema:hover {
        background-color: #f3f4f6;
        color: #0d6efd;
    }
    .active-nav {
        color: #0d6efd !important;
        background-color: #e7f1ff;
        border-left-color: #0d6efd; 
        font-weight: 700;
    }
    #mainContent {
        background-color: #ffffff;
        color: #1a1a1a;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        width: 100%;
    }
    .tema-seccion {
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .tema-seccion:last-child {
        border-bottom: none;
    }
    .titulo-tema {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        border-left: 5px solid #0d6efd;
    }
    .subtema-bloque {
        margin-top: 2rem;
        margin-bottom: 1.5rem;
    }
    .titulo-subtema {
        font-size: 1.2rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .apartado-bloque {
        margin-left: 1rem;
        margin-top: 1rem;
        padding: 1rem;
        background-color: #f9fafb;
        border-radius: 8px;
    }
    .titulo-apartado {
        font-size: 1rem;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .texto-contenido {
        color: #4b5563;
        line-height: 1.7;
        text-align: justify;
        margin-bottom: 1rem;
    }
    .badge-horas {
        font-size: 0.75rem;
        padding: 0.35em 0.8em;
        font-weight: 700;
        border-radius: 50rem;
        background: #e9ecef;
        color: #495057;
        border: 1px solid #ced4da;
        white-space: nowrap;
    }
    .list-unstyled li {
        margin-bottom: 0.5rem;
    }
    @media (max-width: 992px) {
        .layout-container {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        .indice-wrapper {
            position: relative;
            top: 0;
            max-height: none;
            order: -1;
            margin-bottom: 1rem;
        }
        .indice-box {
            padding: 1rem;
        }
        .titulo-tema {
            font-size: 1.25rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        #mainContent {
            padding: 1rem;
        }
    }
</style>