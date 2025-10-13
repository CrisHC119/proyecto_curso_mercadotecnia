<style>
    .contenedor-central {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 40px;
        padding: 0 1rem;
    }

    .img-circular {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3);
        z-index: 2;
        position: relative;
        margin-bottom: 15px;
    }

    .btn-avatar_perfil {
        background: linear-gradient(135deg, #11cb14ff 0%, #049b25ff 100%);
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 241, 76, 0.4);
        transition: all 0.3s ease;
    }

    .btn-avatar_perfil:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(8, 178, 20, 0.6);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        text-align: left;
    }

    .btn-borrar {
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

    /* =============================================
       ESTILOS PARA LA TARJETA DE PERFIL
       ============================================= */

    .card-perfil {
        background-color: #ffffff;
        color: #212529;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-radius: 20px;
        text-align: center;
        padding: 2rem;
        width: 100%;
        max-width: 1400px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .card-perfil label {
        color: #495057;
        font-weight: 500;
        margin-bottom: 0.4rem;
    }

    .card-perfil .form-control,
    .card-perfil .form-select {
        background-color: #f8f9fa;
        color: #212529;
        border: 1px solid #ced4da;
        border-radius: 10px;
        padding: 10px 15px;
    }

    .card-perfil .form-control:focus,
    .card-perfil .form-select:focus {
        background-color: #e9ecef;
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .card-perfil .badge-estudiante {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
        box-shadow: 0 3px 8px rgba(40, 167, 69, 0.3);
        padding: 8px 15px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    body.light-mode .card-perfil {
        background-color: #1f1f1f;
        color: #e0e0e0;
        border: 1px solid #3a3a3a;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }

    body.light-mode .card-perfil label {
        color: #bdbdbd;
    }

    body.light-mode .card-perfil .form-control,
    body.light-mode .card-perfil .form-select {
        background-color: #2a2a2a;
        color: #ffffff;
        border: 1px solid #444444;
    }

    body.light-mode .card-perfil .form-control:focus,
    body.light-mode .card-perfil .form-select:focus {
        background-color: #3d3d3d;
        border-color: #00ff73;
        box-shadow: 0 0 0 0.2rem rgba(0, 255, 98, 0.35);
    }

    body.light-mode .card-perfil .badge-estudiante {
        background: linear-gradient(135deg, #00c733 0%, #009927 100%);
        color: white;
        box-shadow: 0 3px 8px rgba(0, 180, 50, 0.4);
    }

    .modal-content {
        background-color: #222;
        color: white;
        border-radius: 15px;
    }

    .modal-header,
    .modal-footer {
        border: none;
    }
    
    body.light-mode .modal-content {
        background-color: #f1f1f1;
        color: #212529;
    }
    
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        background-color: #333;
        color: white;
        font-family: 'Segoe UI', sans-serif;
        border-radius: 10px;
        z-index: 1050;
        border: 1px solid #00ff73;
        box-shadow: 0 4px 12px rgba(0,255,98,0.3);
        box-sizing: border-box;
    }

    .ui-menu-item-wrapper {
        padding: 10px;
        cursor: pointer;
    }

    .ui-menu-item-wrapper:hover {
        background-color: #00ff73;
        color: #000;
        transition: 0.2s;
    }
    
    body.light-mode .ui-autocomplete {
        background-color: #fff;
        color: #000;
        border-color: #0d6efd;
    }
</style>