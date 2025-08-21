<style>
    #mainContent {
        max-width: 1400px;
        margin: 30px auto 20px auto;
        background-color: rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }
    .accordion {
        background-color: #222;
        color: #eee;
        border-radius: 8px;
        max-width: 1500px;
        margin: 0 auto; 
        box-shadow: 0 0 10px rgba(0,0,0,0.7);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .accordion-button {
        background-color: #333;
        color: #eee;
        cursor: pointer;
        padding: 0.75rem 1rem;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 1.1rem;
        font-weight: bold;
        border-bottom: 1px solid #444;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.3s ease;
    }
    .accordion-button:hover {
        background-color: #444;
    }
    .accordion-button::after {
        content: '\25bc';
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }
    .accordion-button.active::after {
        transform: rotate(180deg);
    }
    .accordion-content {
        background-color: #1a1a1a;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
        padding-left: 1rem;
    }
    .accordion-content.show {
        max-height: 2000px;
        padding: 0.5rem 1rem 1rem 1rem;
    }
    .sub-accordion-button {
        background-color: #2a2a2a;
        color: #ccc;
        cursor: pointer;
        padding: 0.5rem 1rem;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 1rem;
        font-weight: 600;
        border-bottom: 1px solid #555;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 1rem;
        transition: background-color 0.3s ease;
    }
    .sub-accordion-button:hover {
        background-color: #3a3a3a;
    }
    .sub-accordion-button::after {
        content: '\25bc';
        font-size: 0.7rem;
        transition: transform 0.3s ease;
    }
    .sub-accordion-button.active::after {
        transform: rotate(180deg);
    }
    .sub-accordion-content {
        background-color: #121212;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
        padding-left: 1rem;
        margin-left: 2rem;
        border-left: 2px solid #444;
    }
    .sub-accordion-content.show {
        max-height: 1500px;
        padding: 0.5rem 1rem 1rem 1rem;
    }
    .subtema-text {
        font-size: 0.95rem;
        color: #ddd;
        margin-bottom: 0.7rem;
    }
    @media (max-width: 768px) {
        #mainContent {
            padding: 0.8rem;
            max-width: 100%;
            margin: 15px 8px;
        }
        .accordion {
            max-width: 100%;
            margin: 0 4px;
        }
        .accordion-button,
        .sub-accordion-button {
            font-size: 0.65rem; /* más pequeño */
            padding: 0.45rem 0.6rem;
        }
        .accordion-button::after,
        .sub-accordion-button::after {
            font-size: 0.55rem;
        }
        .nivel-3 {
            font-size: 0.6rem;
        }
        .subtema-text {
            font-size: 0.6rem;
            margin-bottom: 0.5rem;
        }
        h1.text-center {
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .btn.btn-success {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
        }
        .text-muted.small {
            font-size: 0.55rem !important;
        }
    }
    body.light-mode #mainContent {
        background-color: #ffffff;
        color: #000;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    body.light-mode .accordion {
        background-color: #f1f1f1;
        color: #000;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    body.light-mode .accordion-button {
        background-color: #e4e4e4;
        color: #000;
        border-bottom: 1px solid #ccc;
    }
    body.light-mode .accordion-button:hover {
        background-color: #dcdcdc;
    }
    body.light-mode .accordion-content {
        background-color: #fafafa;
    }
    body.light-mode .sub-accordion-button {
        background-color: #eaeaea;
        color: #000;
        border-bottom: 1px solid #ccc;
    }
    body.light-mode .sub-accordion-button:hover {
        background-color: #dedede;
    }
    body.light-mode .sub-accordion-content {
        background-color: #f5f5f5;
        border-left: 2px solid #ccc;
    }
    body.light-mode .subtema-text {
        color: #333;
    }
    .accordion-button.nivel-2,
    .accordion-button.nivel-3 {
        text-align: left;
        padding-right: 1rem;
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
        box-shadow: none !important; /* quita el brillo azul */
        outline: none !important;    /* quita el borde de enfoque */
    }
</style>