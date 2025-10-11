<style>
    .avatar-calif { width: 50px; height: 50px; object-fit: cover; }
    .list-group-item-calif {
        display: flex; align-items: center; flex-wrap: wrap; padding: 1rem; gap: 1rem;
    }
    .info-alumno { flex: 1 1 200px; }
    .calif-estado { flex: 1 1 150px; text-align: center; }
    .acciones-calif { flex: 0 0 auto; text-align: center; }
    .calificacion-valor { font-size: 1.5rem; font-weight: 500; }
    
    body { 
        --bs-body-bg: #f8f9fa; 
        --bs-body-color: #212529; 
    }
    .card { 
        background-color: #fff; 
        border-color: #dee2e6;
    }
    .list-group-item { 
        background-color: #fff; 
        border-color: #dee2e6;
    }
    .form-control, .input-group-text {
        background-color: #fff;
        border-color: #ced4da;
        color: #212529;
    }
    body.light-mode { 
        --bs-body-bg: #121212; 
        --bs-body-color: #f1f1f1; 
    }
    body.light-mode .card { 
        background-color: #2c2c2c; 
        border-color: rgba(255,255,255,0.1); 
        color: var(--bs-body-color);
    }
    body.light-mode .list-group-item { 
        background-color: transparent; 
        border-color: rgba(255,255,255,0.15); 
    }
    body.light-mode .form-control,
    body.light-mode .input-group-text { 
        background-color: #333; 
        border-color: #555; 
        color: #fff; 
    }
    body.light-mode .form-control::placeholder {
        color: #8e8e93;
    }
    body.light-mode .text-body-secondary {
        color: rgba(255, 255, 255, 0.75) !important;
    }
</style>