<style>
    :root { 
        --bs-body-bg: #f8f9fa; 
        --bs-body-color: #212529; 
    }
    .card { 
        background-color: #ffffff; 
        border-color: #dee2e6; 
    }
    .list-group-item { 
        background-color: #ffffff; 
        border-color: #dee2e6; 
    }
    .card-footer { 
        background-color: transparent; 
    }
    .form-control, .input-group-text { 
        background-color: #fff; 
        border-color: #ced4da; 
        color: #212529; 
    }
    .form-control::placeholder { 
        color: #6c757d; 
    }
    .btn-outline-primary { 
        --bs-btn-color: #0d6efd; 
        --bs-btn-border-color: #0d6efd; 
        --bs-btn-hover-bg: #0d6efd; 
        --bs-btn-hover-border-color: #0d6efd; 
    }
    .btn-outline-danger { 
        --bs-btn-color: #dc3545; 
        --bs-btn-border-color: #dc3545; 
        --bs-btn-hover-bg: #dc3545; 
        --bs-btn-hover-border-color: #dc3545; 
    }
    .avatar-card { 
        width: 100px; 
        height: 100px; 
        object-fit: cover; 
    }

    body.light-mode { 
        --bs-body-bg: #1c1c1e; 
        --bs-body-color: #ffffff; 
    }
    body.light-mode .card, 
    body.light-mode .list-group-item { 
        background-color: #2c2c2e; 
        border-color: rgba(255, 255, 255, 0.15); 
    }
    body.light-mode .form-control, 
    body.light-mode .input-group-text { 
        background-color: #2c2c2e; 
        border-color: rgba(255, 255, 255, 0.2); 
        color: #fff; 
    }
    body.light-mode .form-control::placeholder { 
        color: #8e8e93; 
    }
    body.light-mode .list-group-item .text-body-secondary {
        color: #fff !important;
    }
    body.light-mode .card-body .text-body-secondary {
        color: rgba(255, 255, 255, 0.75) !important;
    }
    body.light-mode .modal-content {
        background-color: #2c2c2e;
        border-color: rgba(255, 255, 255, 0.15);
        color: #fff;
    }
    body.light-mode .modal-header {
        border-bottom-color: rgba(255, 255, 255, 0.15);
    }
    body.light-mode .modal-footer {
        border-top-color: rgba(255, 255, 255, 0.15);
    }
    body.light-mode .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    @media (max-width: 576px) {
        h1.h2 {
            font-size: 1.1rem;
        }
        .input-group .form-control,
        .input-group .input-group-text {
            font-size: 0.7rem;
        }
        .avatar-card {
            width: 80px; 
            height: 80px;
        }
        .usuario-card .card-title {
            font-size: 1.0rem;
        }
        .usuario-card .list-group-item {
            font-size: 0.7rem;
            padding-top: 0.4rem;
            padding-bottom: 0.6rem;
        }
        .usuario-card .card-footer {
            text-align: center !important; 
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .usuario-card .card-footer .btn {
            width: 100%;
        }
        .usuario-card .col-sm-8 {
            text-align: center;
        }

        #detallesPersonalModal .modal-body {
            padding: 1rem;
        }
        #detallesPersonalModal .row.align-items-center {
            text-align: center;
        }
        #modalAvatarPersonal {
            width: 100px !important; 
            height: 100px !important;
        }
        #modalNombreCompletoPersonal {
            font-size: 1.2rem; 
        }
        .modal-body p {
            font-size: 0.8rem;
        }
    }
    body.light-mode .modal-content .form-label {
        color: #f8f9fa;
    }
    body.light-mode .modal-content .text-muted {
        color: rgba(255, 255, 255, 0.55);
    }
    body.light-mode .modal-content {
        background-color: #2c2c2e;
        border-color: rgba(255, 255, 255, 0.15);
        color: #fff;
    }
    body.light-mode .modal-content .text-muted {
        color: rgba(255, 255, 255, 0.7) !important;
    }
</style>