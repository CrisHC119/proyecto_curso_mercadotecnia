<style>
    .card-menu {
        transition: transform 0.2s ease-in-out;
        cursor: pointer;
        border-radius: 1rem;
        text-align: center;
        padding: 1.5rem 1rem;
    }
    .card-menu:hover {
        transform: scale(1.03);
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .card-menu i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: block;
    }
    .card-menu h5 {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .card-menu.alumnos {
        background-color: #0d6efd; 
        color: #ffffff;
    }
    .card-menu.profesores {
        background-color: #20c997; 
        color: #ffffff;
    }
    .card-menu.mensaje {
        background-color: #373737ff; 
        color: #ffffff;
    }
    .card-menu.calificaciones {
        background-color: #ffc107; 
        color: #ffffffff;
    }
    .card-menu.examenes {
        background-color: #fd7e14; 
        color: #ffffff;
    }
    .card-menu.actividades {
        background-color: #5d0075ff; 
        color: #ffffff;
                
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed;
        transform: none; 
    }
    .card-menu.logout {
        background-color: #920000ff; 
        color: #ffffff;
    }
    .card-menu.registros {
        background-color: #3311bcff; 
        color: #ffffff;
    }
    .card-menu i {
        color: #ffffff;
    }
    body.light-mode .card-menu.actividades {
        background-color: #2c2c2e;
        color: #ffffff;
        border: 1px solid rgba(255,255,255,0.1);
                
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed;
        transform: none; 
    }
    body.light-mode .card-menu i {
        color: #6f42c1;
    }
    body.light-mode .card-menu.examenes, 
    body.light-mode .card-menu.registros, 
    body.light-mode .card-menu.logout, 
    body.light-mode .card-menu.alumnos, 
    body.light-mode .card-menu.profesores, 
    body.light-mode .card-menu.calificaciones, 
    body.light-mode .card-menu.mensaje {
        background-color: #2c2c2e;
        color: #ffffff;
        border: 1px solid rgba(255,255,255,0.1);
    }
</style>