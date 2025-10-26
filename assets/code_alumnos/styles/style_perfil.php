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
    .btn-actualizar {
        background: linear-gradient(135deg, #007bff 0%, #007bff 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        margin-top: 2rem;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
        transition: all 0.3s ease;
    }
    .btn-actualizar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.6);
    }
    .btn-regresar {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        margin-top: 2rem;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
        transition: all 0.3s ease;
    }
    .btn-regresar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.6);
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

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        text-align: left;
    }
    body {
        background-color: #f8f9fa;
        color: #212529;
    }
    
    .card-perfil {
        width: 100%;
        max-width: 1400px;
        background-color: #ffffff;
        color: #212529;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-radius: 20px;
        text-align: center;
        padding: 2rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .badge-estudiante {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
        box-shadow: 0 3px 8px rgba(40, 167, 69, 0.3);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    label {
        font-weight: 500;
        margin-bottom: 0.4rem;
        color: #495057;
    }

    .form-control {
        background-color: #f8f9fa;
        color: #212529;
        border: 1px solid #ced4da;
        border-radius: 10px;
        padding: 10px 15px;
    }
    
    .form-control::placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control:focus {
        background-color: #e9ecef;
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .modal-content {
        background-color: #f1f1f1;
        color: #212529;
        border-radius: 15px;
    }
    .modal-header,
    .modal-footer {
        border-color: #dee2e6;
    }

    .ui-autocomplete {
        background-color: #fff;
        color: #000;
        border: 1px solid #0d6efd;
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        max-height: 200px;
        overflow-y: auto;
        font-family: 'Segoe UI', sans-serif;
        border-radius: 10px;
        z-index: 1050;
        box-sizing: border-box;
    }
    .ui-menu-item-wrapper {
        padding: 10px;
        cursor: pointer;
    }
    .ui-menu-item-wrapper:hover {
        background-color: #0d6efd;
        color: #fff;
        transition: 0.2s;
    }
    body.light-mode {
        background-color: #121212;
        color: white;
    }

    body.light-mode .card-perfil {
        background-color: #1f1f1f;
        color: #e0e0e0;
        border: 1px solid #3a3a3a;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }

    body.light-mode .badge-estudiante {
        background: linear-gradient(135deg, #00c733 0%, #009927 100%);
        color: white;
        box-shadow: 0 3px 8px rgba(0, 180, 50, 0.4);
    }

    body.light-mode .card-perfil label {
        color: #bdbdbd;
    }

    body.light-mode .card-perfil .form-control {
        background-color: #2a2a2a;
        color: #ffffff;
        border: 1px solid #444444;
    }
    body.light-mode .card-perfil .form-control::placeholder {
        color: #888;
        opacity: 1;
    }
    body.light-mode .card-perfil .form-control:focus {
        background-color: #3d3d3d;
        border-color: #00ff73;
        box-shadow: 0 0 0 0.2rem rgba(0, 255, 98, 0.35);
    }
    body.light-mode .modal-content {
        background-color: #333;
        color: #f1f1f1;
        border: 1px solid #444;
    }
    body.light-mode .modal-header {
        border-bottom: 1px solid #444; 
    }
    body.light-mode .modal-footer {
        border-top: 1px solid #444;
    }
    body.light-mode .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    body.light-mode .ui-autocomplete {
        background-color: #333;
        color: white;
        border: 1px solid #00ff73;
        box-shadow: 0 4px 12px rgba(0,255,98,0.3);
    }
    body.light-mode .ui-menu-item-wrapper:hover {
        background-color: #00ff73;
        color: #000;
    }
    @media (max-width: 576px) {
        .contenedor-central {
            margin-top: 20px;
            padding: 0 0.5rem;
        }
        .card-perfil {
            padding: 1.3rem 1rem;
        }
        .img-circular {
            width: 120px;
            height: 120px;
        }
        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .card-perfil label,
        label {
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
        }
        .card-perfil .form-control,
        .card-perfil .form-select {
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem; 
        }
        
        .btn-actualizar,
        .btn-regresar,
        .btn-borrar,
        .btn-avatar_perfil {
            font-size: 0.8rem;
            padding: 10px 20px;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        .btn-avatar_perfil {
            margin-bottom: 1rem;
        }
    }
</style>