<style>
    .card-calificacion {
        max-width: 700px;
        font-size: 1.1rem;
        transition: transform 0.2s, box-shadow 0.2s;
        margin: auto;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .card-calificacion:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
    }
    .card-calificacion .card-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--bs-primary);
    }
    .calificacion-split {
        gap: 1rem;
    }
    .calificacion-split > div {
        flex: 1;
    }
    .calificacion-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .calificacion-valor {
        font-size: 2rem;
        font-weight: 700;
        color: #343a40;
    }
    .no-registrado {
        color: #dc3545;
        font-style: italic;
        font-size: 1.2rem;
        font-weight: 500;
    }
    .calificacion-reprobada {
        color: #dc3545;
        font-weight: 700;
        font-size: 2rem;
    }
    .calificacion-pendiente {
        color: #6c757d;
        font-style: italic;
        font-weight: 500;
        font-size: 1.2rem;
    }
    .card-final {
        border-left: 5px solid var(--bs-primary);
        background-color: #ffffff;
    }
    .card-calificacion:last-child {
        border: 1px solid transparent; 
        border-radius: 0.5rem;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    #rubrica-flotante .card-header,
    #rubrica-abajo .card-header {
        background-color: #f8f9fa;
        padding: 0.5rem 0.75rem;
    }
    #rubrica-flotante th,
    #rubrica-flotante td,
    #rubrica-abajo th,
    #rubrica-abajo td {
        padding: 0.3rem 0.4rem;
        vertical-align: middle;
    }
    #rubrica-flotante caption,
    #rubrica-abajo caption {
        padding-top: 0.3rem;
        padding-bottom: 0.1rem;
    }
    #rubrica-flotante {
        position: sticky;
        top: 100px; 
        width: 100%; 
        z-index: 1010;
        font-size: 1.1rem; 
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        background-color: #fff;
        transform: none !important;
    }
    #rubrica-flotante .card-header {
        font-size: 1em; 
    }
    #rubrica-flotante table {
        font-size: 1.03em;
        table-layout: fixed; 
        width: 100%;
        margin-top: 5px;
    }
    #rubrica-flotante thead th {
        font-size: 0.75em;
        line-height: 1.1; 
        padding-top: 0.5rem !important;
        padding-bottom: 0.3rem !important;
        white-space: nowrap;
    }
    #rubrica-flotante tbody td {
        font-size: 1.05em;
    }
    #rubrica-flotante th,
    #rubrica-flotante td {
        padding: 0.3rem 0.2rem !important;
        vertical-align: middle;
        font-weight: 500;
    }
    #rubrica-abajo .card-header {
        font-size: 0.8em;
    }
    #rubrica-abajo table {
        font-size: 0.8em;
    }
    body.light-mode .card-calificacion {
        background-color: #2d3748; 
        color: #f1f1f1;
        border-color: #4a5568;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3) !important;
    }
    body.light-mode .card-calificacion .card-title {
        color: #63b3ed;
    }
    body.light-mode .calificacion-label {
        color: #a0aec0;
    }
    body.light-mode .calificacion-aprobada {
        color: #c6f6d5;
    }
    body.light-mode .calificacion-reprobada {
        color: #feb2b2;
    }
    body.light-mode .no-registrado,
    body.light-mode .calificacion-pendiente {
        color: #a0aec0;
    }
    body.light-mode .card-calificacion hr {
        border-top-color: #4a5568;
        opacity: 0.5;
    }
    body.light-mode .card-final {
        background-color: #1a202c;
        border-left-color: #63b3ed;
    }
    body.light-mode .card-final .card-title {
        color: #ffffff; 
    }
    body.light-mode #rubrica-flotante,
    body.light-mode #rubrica-abajo {
        background-color: #2d3748;
        color: #f1f1f1;
        border-color: #4a5568;
    }
    body.light-mode #rubrica-flotante .card-header,
    body.light-mode #rubrica-abajo .card-header {
        background-color: #1a202c;
        color: #e2e8f0;
        border-bottom: 1px solid #4a5568;
    }
    body.light-mode #rubrica-flotante table,
    body.light-mode #rubrica-abajo table {
        color: #e2e8f0;
    }
    body.light-mode #rubrica-flotante th,
    body.light-mode #rubrica-flotante td,
    body.light-mode #rubrica-abajo th,
    body.light-mode #rubrica-abajo td {
        color: inherit;
        border-color: #4a5568;
    }

    body.light-mode #rubrica-flotante caption,
    body.light-mode #rubrica-abajo caption {
        color: #a0aec0;
    }
    body.light-mode #rubrica-flotante thead,
    body.light-mode #rubrica-abajo thead {
        border-bottom: 1px solid #4a5568;
    }
    body.light-mode #rubrica-flotante .table,
    body.light-mode #rubrica-abajo .table {
        --bs-table-color: #e2e8f0;
        --bs-table-bg: transparent;
        --bs-table-border-color: #4a5568;
        --bs-table-striped-color: #e2e8f0;
        --bs-table-striped-bg: rgba(255, 255, 255, 0.04);
        --bs-table-hover-color: #f1f1f1;
        --bs-table-hover-bg: rgba(255, 255, 255, 0.08);
    }
    body.light-mode #rubrica-flotante .table-striped > tbody > tr:nth-of-type(odd) > * {
        --bs-table-accent-bg: rgba(255, 255, 255, 0.04);
        color: inherit;
    }
    body.light-mode .table-hover > tbody > tr:hover > * {
        --bs-table-accent-bg: rgba(255, 255, 255, 0.08);
        color: inherit;
    }
    
    /* ------------------------------------------- */
    /* MEDIA QUERIES (Mobile) */
    /* ------------------------------------------- */
    @media (max-width: 575.98px) {
        .card-calificacion {
            font-size: 1rem;
            max-width: 95%;
        }
        .card-calificacion .card-title {
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }
        .calificacion-split {
            margin-top: 0.5rem !important;
            margin-bottom: 1rem !important;
            gap: 0.5rem;
        }
        .calificacion-label {
            font-size: 0.6rem;
            letter-spacing: 0.25px;
        }
        .calificacion-valor,
        .calificacion-reprobada {
            font-size: 1.3rem;
        }
        .no-registrado,
        .calificacion-pendiente {
            font-size: 1rem;
        }
        .card-calificacion .text-center.mt-3 {
            margin-top: 0.70rem !important;
        }
        .calificacion-valor-parcial,
        .calificacion-valor-final {
            margin-top: 0.2rem !important;
        }
        .calificacion-valor-final .calificacion-pendiente,
        .calificacion-valor-final .calificacion-reprobada,
        .calificacion-valor-final .calificacion-aprobada {
            font-size: 1.0rem;
        }
        .card-final .card-title {
            font-size: 1.0rem;
            margin-bottom: 0.5rem;
        }
    }
</style>