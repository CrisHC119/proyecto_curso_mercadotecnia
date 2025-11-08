<?php
// Ruta: /assets/code_profesor/styles/style_calificacion_alumnos.php
?>
<style>
    /* Ajuste básico del body */
    body { 
        padding-top: 70px; 
    }

    /* --- Estilos Night Mode (Base) --- */
    body.light-mode { 
        --bs-body-bg: #121212; 
        --bs-body-color: #f1f1f1; 
    }
    body.light-mode .card { 
        background-color: #2c2c2c; 
        border-color: rgba(255,255,255,0.1); 
    }
    body.light-mode .form-control { 
        background-color: #333; 
        border-color: #555; 
        color: #fff; 
    }
    body.light-mode .form-control::placeholder { color: #aaa; }
    body.light-mode .input-group-text {
        background-color: #3a3a3a;
        border-color: #555;
        color: #f1f1f1;
    }
    /* --- Fin Estilos Night Mode --- */

    /* --- Estilos de la Lista de Calificaciones --- */
    
    .avatar-calif {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1); 
        border: 2px solid #fff;
    }
    
    body.light-mode .avatar-calif {
        border-color: #444;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    /* 1. LAYOUT DESKTOP (Grid de 4 columnas) */
    .list-group-item-calif {
        display: grid;
        grid-template-columns: auto 1fr auto auto; /* 4 columnas */
        gap: 1rem;
        align-items: center;
        padding: 1rem 1.25rem;
        transition: background-color 0.15s ease-in-out;
    }

    /* Efecto hover bonito */
    .list-group-item-calif:hover {
        background-color: #f8f9fa; 
    }
    body.light-mode .list-group-item-calif {
        background-color: #2c2c2c;
        border-color: rgba(255,255,255,0.1);
    }
    body.light-mode .list-group-item-calif:hover {
        background-color: #3a3a3a;
    }
    
    /* Columna 2: Info */
    .info-alumno h5 {
        font-size: 1.05rem; /* <-- CAMBIO: Reducido de 1.1rem */
        font-weight: 500;
        margin-bottom: 0.1rem;
    }
    .info-alumno small.text-body-secondary {
        color: #5a5a5a;
        font-size: 0.8rem; /* <-- CAMBIO: Reducido de 0.85rem */
    }
    body.light-mode .info-alumno small.text-body-secondary {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    /* Columna 3: Estado (Calificación y Badge) */
    .calif-estado {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        min-width: 100px;
    }
    .calificacion-valor {
        font-size: 1.1rem; /* <-- CAMBIO: Reducido de 1.15rem */
        font-weight: 500;
    }
    .calif-estado .badge {
        margin-top: 0.25rem;
    }

    /* Columna 4: Acciones (Botón) */
    .acciones-calif {
        min-width: 100px;
        text-align: right;
    }

    /* 2. LAYOUT MÓVIL (Menos de 768px) */
    @media (max-width: 767.98px) {
        
        .list-group-item-calif {
            grid-template-columns: auto 1fr;
            grid-template-rows: auto auto auto;
            grid-template-areas:
                "avatar info"
                "avatar estado"
                "acciones acciones";
            
            gap: 0.25rem 1rem;
            padding: 1rem;
        }

        /* Asignamos cada elemento a su área */
        .list-group-item-calif > img.avatar-calif {
            grid-area: avatar;
            align-self: start;
            width: 45px;
            height: 45px;
        }
        
        .list-group-item-calif > .info-alumno {
            grid-area: info;
            align-self: center;
        }
        
        .list-group-item-calif > .calif-estado {
            grid-area: estado;
            flex-direction: row; 
            align-items: center; 
            gap: 0.75rem;
            margin-top: 0.25rem;
            padding-left: 4px;
        }
        
        .list-group-item-calif > .acciones-calif {
            grid-area: acciones;
            text-align: left; 
            margin-top: 1rem;
        }

        .acciones-calif .btn {
            width: 100%; 
        }

        .calif-estado .badge {
            margin-top: 0;
        }
        .calificacion-valor {
            font-size: 1rem;
        }
    }
</style>