<style>
    .contenedor-central {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 40px;
        padding: 0 1rem;
    }
    body {
        background-color: #121212;
        color: white;
    }
    .form-control {
        background-color: rgba(255,255,255,0.1);
        color: white;
    }
    /* ✅ Resplandor de foco ahora es AZUL */
    .form-control:focus {
        background-color: rgba(255,255,255,0.15);
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .card-perfil {
        background-color: rgba(255, 255, 255, 0.06);
        color: white;
    }
    .modal-content {
        background-color: #222;
        color: white;
    }
    .img-circular {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 50%;
        /* ✅ Borde del avatar ahora es AZUL */
        border: 4px solid #0d6efd;
        box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3);
        z-index: 2;
        position: relative;
        margin-bottom: 15px;
    }
    /* ✅ Botones principales ahora son AZUL */
    .btn-avatar_perfil, .btn-actualizar {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        transition: all 0.3s ease;
    }
    .btn-avatar_perfil {
        margin-bottom: 20px;
    }
    .btn-actualizar {
        margin-top: 2rem;
    }
    .btn-avatar_perfil:hover, .btn-actualizar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.6);
    }
    .card-perfil {
        width: 100%;
        max-width: 1400px;
        background-color: rgba(255, 255, 255, 0.06);
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        color: white;
        text-align: center;
        padding: 2rem;
    }
    /* ✅ Badge ahora es AZUL y renombrado para 'profesor' */
    .badge-profesor {
        background: #0d6efd;
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 1.5rem;
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        text-align: left;
    }
    label {
        font-weight: 500;
        margin-bottom: 0.4rem;
    }
    .form-control {
        background-color: rgba(255,255,255,0.1);
        border: none;
        border-radius: 10px;
        color: white;
        padding: 10px 15px;
    }
    /* ✅ Botón regresar ahora es GRIS (color secundario) para mejor contraste */
    .btn-regresar {
        background: linear-gradient(135deg, #6c757d 0%, #5c636a 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        margin-top: 2rem;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
        transition: all 0.3s ease;
    }
    .btn-regresar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108, 117, 125, 0.6);
    }
    .btn-borrar { /* (Sin cambios, ya era rojo) */
        background: linear-gradient(135deg, #cb1111ff 0%, #dd0c0cff 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        margin-top: 2rem;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4);
        transition: all 0.3s ease;
    }
    .btn-borrar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 0, 0, 0.6);
    }
    .modal-content {
        background-color: #222;
        color: white;
        border-radius: 15px;
    }
    .modal-header, .modal-footer {
        border: none;
    }
    /* ✅ Autocompletado ahora es AZUL */
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        background-color: #333;
        color: white;
        font-family: 'Segoe UI', sans-serif;
        border-radius: 10px;
        z-index: 1050;
        border: 1px solid #0d6efd;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        box-sizing: border-box;
    }
    .ui-menu-item-wrapper:hover {
        background-color: #0d6efd;
        color: #fff;
        transition: 0.2s;
    }
    
    /* MODO CLARO (sin cambios, ya usaba azul) */
    body.light-mode { background-color: #f8f9fa; color: #212529; }
    body.light-mode .form-control { background-color: #fff; color: #212529; }
    body.light-mode .form-control:focus { background-color: #f0f0f0; box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); }
    body.light-mode .card-perfil { background-color: #ffffff; color: #212529; }
    body.light-mode .modal-content { background-color: #f1f1f1; color: #212529; }
    body.light-mode .ui-autocomplete { background-color: #fff; color: #000; border-color: #0d6efd; }
    body.light-mode .form-control { background-color: #ffffff; color: #212529; border: 1px solid #ced4da; }
    body.light-mode .form-control:focus { background-color: #f0f0f0; box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); border-color: #80bdff; }
</style>