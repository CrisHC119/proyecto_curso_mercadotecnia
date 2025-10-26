<style>
    .mapa-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    a.link-theme {
        color: inherit;
        text-decoration: none;
    }
    a.link-theme:hover {
        text-decoration: underline;
    }
    #mainContent {
        flex: 1 1 400px;
        background-color: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
    }
    #map {
        height: 400px;
        min-height: 300px;
        width: 100%;
        border-radius: 12px;
        max-width: 600px;
        flex: 1;
    }
    .info-card {
        background-color: #ffffff;
        color: #212529;
        width: 100%;
        flex: 1;
        max-width: 1400px;
        border-radius: 12px;
        transition: background-color 0.3s, color 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    body.light-mode #mainContent {
        background-color: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }
    body.light-mode .info-card {
        background-color: rgba(255, 255, 255, 0.07);
        color: #ffffff;
    }
    .face-card {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        color: #212529;
        width: 100%;
        flex: 1;
        border-radius: 12px;
        transition: background-color 0.3s, color 0.3s;
        align-self: flex-start;
        width: 100% !important;
        max-width: 100% !important;
        align-self: stretch;
    }
    .fb-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .fb-page, 
    .fb-page > span, 
    .fb-page > span > iframe[style] {
        width: 100% !important;
        min-width: 0 !important;
        max-width: 100% !important;
        display: block !important;
    }
    body.light-mode .face-card {
        background-color: rgba(255, 255, 255, 0.07);
        color: #ffffff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }
    .contenedor-principal {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: stretch;
        gap: 2rem;
        margin-top: 2rem;
        padding: 0 50px;
    }
    .mapa-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        flex: 1 1 600px;
        min-width: 300px;
    }
    #map {
        flex: 1;
        max-width: 600px;
    }
    @media (max-width: 768px) {
        .contenedor-principal {
            flex-direction: column;
            align-items: center;
            padding: 0 1rem;
            gap: 1.5rem;
        }
        #mainContent {
            padding: 1rem;
            width: 100%;
        }
        .info-card {
            padding: 1rem;
            width: 100%;
        }
        .info-card p {
            font-size: 0.7rem;
            margin-bottom: 0.90rem !important;
        }
        .face-card {
            max-width: 100%;
            margin: 0;
            align-self: stretch;
        }
        .mapa-info {
            flex-direction: column-reverse; 
            align-items: center;
            width: 100%;
        }
        .fb-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .fb-page,
        .fb-page > span,
        .fb-page > span > iframe[style] {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            display: block !important;
        }
        #mainContent .titulo {
            font-size: 1.2rem;
            margin-bottom: 1.2rem !important;
        }
        .info-card h4 {
            font-size: 0.9rem;
        }
    }
</style>