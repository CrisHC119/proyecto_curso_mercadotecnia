<style>
    .card-menu {
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #f2f2f2; 
        border-radius: 0.75rem;
        color: #333;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.2s ease-in-out;
        width: 100%;
    }
    .card-menu:hover {
        transform: scale(1.01);
    }
    .card-menu i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #0d6efd; 
    }
    .card-menu h5 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    .card-menu p {
        margin-bottom: 0.25rem;
    }
    .btn-group-sm .btn {
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
        margin-right: 0.5rem;
    }
    .disabled {
        pointer-events: none;
        opacity: 0.5;
    }
    .card-container {
        max-width: 900px;
        margin: 0 auto;
    }
    .card-menu .btn-primary i {
        color: #fff !important;
    }
    .card-menu .btn {
        font-size: 1rem;
        font-weight: 500;
    }
    .btn-outline-light {
        border-color: #dee2e6;
        color: #212529; 
    }
    .modal-content {
        background-color: #fff;
        color: #212529;
    }
    .form-control {
        background-color: #fff;
        color: #212529;
        border-color: #ced4da;
    }
    .form-control::placeholder {
        color: #6c757d;
    }
    .modal-header,
    .modal-footer {
        border-color: #dee2e6;
    }
    body.light-mode .card-menu {
        background-color: #2c2c2c;
        color: #fff;
    }
    body.light-mode .btn-outline-light {
        border-color: #aaa;
        color: #eee;
    }
    body.light-mode .modal-content {
        background-color: #2b2b2b;
        color: #fff;
    }
    body.light-mode .form-control {
        background-color: #3c3c3c;
        color: #fff;
        border-color: #666;
    }
    body.light-mode .form-control::placeholder {
        color: #aaa;
    }
    body.light-mode .modal-header,
    body.light-mode .modal-footer {
        border-color: #444;
    }
    .btn-outline-primary:hover .icon-calificaciones {
        color: #fff; 
    }
    @media (max-width: 576px) {
        h1.h2 {
            font-size: 0.95rem;
            text-align: center; 
            margin-bottom: 1rem;
        }
        .card-menu {
            padding: 0.8rem; 
        }
        .card-menu h5 {
            font-size: 0.9rem; 
        }
        .card-menu p {
            font-size: 0.70rem;
            margin-bottom: 0.4rem; 
        }
        .card-menu .btn-group {
            flex-direction: column; 
            width: 100%;
            gap: 0.5rem;
        }
        .card-menu .btn-group .btn {
            width: 100%;
            border-radius: var(--bs-border-radius-sm) !important; 
            font-size: 0.8rem; 
            padding: 0.3rem 0.5rem;
        }
        .container .text-center .btn-secondary {
            width: 100%;
            font-size: 0.8rem;
            padding: 0.3rem 0.5rem;
        }
        .card-menu > .d-flex i {
            font-size: 0.9rem;
            margin-bottom: 0; 
        }
        .modal-title {
            font-size: 0.8rem;
        }
        #modalFecha .modal-body .form-label {
            font-size: 0.75rem;
        }
        #modalFecha .modal-body .form-control,
        #modalFecha .modal-body .btn-outline-secondary {
            font-size: 0.75rem;
        }
        #modalFecha .modal-footer .btn-danger {
            font-size: 0.8rem;
        }
    }
</style>