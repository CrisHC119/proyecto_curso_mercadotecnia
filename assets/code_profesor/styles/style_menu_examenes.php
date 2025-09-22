<style>
    .card-menu {
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #f2f2f2; /* claro por defecto */
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
        color: #0d6efd; /* azul */
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
    body:not(.light-mode) .card-menu {
        background-color: #2c2c2c;
        color: #fff;
    }
    body:not(.light-mode) .btn-outline-light {
        border-color: #aaa;
        color: #eee;
    }
    body:not(.light-mode) .modal-content {
        background-color: #2b2b2b;
        color: #fff;
    }
    body:not(.light-mode) .form-control {
        background-color: #3c3c3c;
        color: #fff;
        border-color: #666;
    }
    body:not(.light-mode) .form-control::placeholder {
        color: #aaa;
    }
    body:not(.light-mode) .modal-header,
    body:not(.light-mode) .modal-footer {
        border-color: #444;
    }
    .btn-outline-primary:hover .icon-calificaciones {
        color: #fff; 
    }
    @media (max-width: 768px) {
        .card-menu {
            padding: 1rem;
        }
            .btn-group-sm .btn {
            font-size: 0.75rem;
            margin-right: 0.25rem;
        }
    }
</style>