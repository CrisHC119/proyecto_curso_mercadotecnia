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
    .form-control:focus {
        background-color: rgba(255,255,255,0.15);
        box-shadow: 0 0 0 0.2rem rgba(0,255,98,0.25);
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
    .badge-estudiante {
        background: #0cc445;
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
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,255,98,0.25);
        background-color: rgba(255,255,255,0.15);
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
        background: linear-gradient(135deg, #00ff22ff 0%, #00ff22ff 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        margin-top: 2rem;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 255, 21, 0.4);
        transition: all 0.3s ease;
    }
    .btn-regresar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 255, 55, 0.6);
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
    .modal-content {
        background-color: #222;
        color: white;
        border-radius: 15px;
    }
    .modal-header,
    .modal-footer {
        border: none;
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
    body.light-mode {
        background-color: #f8f9fa;
        color: #212529;
    }
    body.light-mode .form-control {
        background-color: #fff;
        color: #212529;
    }
    body.light-mode .form-control:focus {
        background-color: #f0f0f0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    body.light-mode .card-perfil {
        background-color: #ffffff;
        color: #212529;
    }
    body.light-mode .modal-content {
        background-color: #f1f1f1;
        color: #212529;
    }
    body.light-mode .ui-autocomplete {
        background-color: #fff;
        color: #000;
        border-color: #0d6efd;
    }
    body.light-mode .form-control {
        background-color: #ffffff;
        color: #212529;
        border: 1px solid #ced4da; 
    }
    body.light-mode .form-control:focus {
        background-color: #f0f0f0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        border-color: #80bdff;
    }
</style>