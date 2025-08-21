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
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
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
        background-color: rgba(255, 255, 255, 0.07);
        color: #ffffff;
        width: 100%;
        flex: 1;
        max-width: 1400px; /* o cualquier otro valor como 1000px o 80% */
        border-radius: 12px;
        transition: background-color 0.3s, color 0.3s;
        display: flex;
        flex-direction: column; /* para que el contenido crezca verticalmente */
        height: 100%;
    }
    body.light-mode .info-card {
        background-color: #ffffff;
        color: #212529;
    }
    .face-card {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        background-color: rgba(255, 255, 255, 0.07);
        color: #ffffff;
        width: 100%;
        flex: 1;
        border-radius: 12px;
        transition: background-color 0.3s, color 0.3s;
        align-self: flex-start; /* Para alinear arriba en pantallas grandes */
        width: 100% !important;
        max-width: 100% !important;
        align-self: stretch;
    }
    .fb-wrapper {
        width: 100%;
        display: flex;
        justify-content: center; /* centra horizontalmente */
    }
    .fb-page, 
    .fb-page > span, 
    .fb-page > span > iframe[style] {
        width: 100% !important;
        min-width: 0 !important; /* para evitar anchos mínimos forzados */
        max-width: 100% !important;
        display: block !important;
    }
    body.light-mode .face-card {
        background-color: #ffffff;
        color: #212529;
    }
    .contenedor-principal {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: stretch; /* <- esto es clave para igualar alturas */
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
        .mapa-info {
            flex-direction: column-reverse; /* Mapa abajo, info y face arriba */
            align-items: center;
        }
        .face-card {
            max-width: 90%;
            margin: 0 auto;
            align-self: center;
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
        .contenedor-principal {
            flex-direction: column;
            align-items: center;
        }
    }
</style>