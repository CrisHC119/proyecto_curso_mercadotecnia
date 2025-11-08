<style>
    body { 
        padding-top: 70px; 
    }
    .card { 
        background-color: #fff; 
        border: none;
        overflow: hidden;
    }
    .table { 
        --bs-table-bg: #fff; 
        --bs-table-striped-bg: #f9f9f9;
        margin-bottom: 0;
    }
    body.light-mode { 
        --bs-body-bg: #121212; 
        --bs-body-color: #f1f1f1; 
    }
    body.light-mode .card { 
        background-color: #2c2c2c; 
        border-color: rgba(255,255,255,0.1); 
    }
    body.light-mode .table { 
        --bs-table-bg: #2c2c2c; 
        --bs-table-color: #f1f1f1; 
        --bs-table-border-color: #444; 
        --bs-table-striped-bg: #272727;
    }
    body.light-mode .form-control { 
        background-color: #333; 
        border-color: #555; 
        color: #fff; 
    }
    .avatar-calif { 
        width: 45px; 
        height: 45px; 
        object-fit: cover; 
    }
    .table thead th { 
        text-align: center; 
        vertical-align: middle; 
        background-color: #f8f9fa;
        color: #6c757d;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom-width: 2px;
    }
    body.light-mode .table thead th {
        background-color: #222;
        color: #adb5bd;
    }
    .table tbody td { 
        text-align: center; 
        vertical-align: middle; 
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .table tbody tr {
        border-bottom: 1px solid var(--bs-border-color-translucent);
    }
    .table tbody tr:last-child {
        border-bottom: none;
    }
    .alumno-info { 
        text-align: left; 
    }
    .alumno-info h6 {
        font-weight: 500;
    }
    .calif-aprobado { 
        color: var(--bs-success); 
        font-weight: 500; 
        font-size: 1.05rem;
    }
    .calif-reprobado { 
        color: var(--bs-danger); 
        font-weight: 500; 
        font-size: 1.05rem;
    }
    .sin-calificar { 
        color: var(--bs-secondary); 
        font-size: 1.05rem;
    }
    .calif-final { 
        font-size: 1.25rem;
        font-weight: bold; 
    }
    .table tbody tr td:last-child {
        background-color: #f8f9fa;
    }
    body.light-mode .table tbody tr td:last-child {
        background-color: rgba(0,0,0,0.2);
    }
    .alumno-info small.text-body-secondary {
        color: #5a5a5a;
    }
    body.light-mode .alumno-info small.text-body-secondary {
        color: rgba(255, 255, 255, 0.6) !important; 
    }
    .form-control::placeholder {
        color: #888;
        opacity: 1;
    }
    body.light-mode .form-control::placeholder {
        color: #aaa;
        opacity: 1;
    }
    .input-group-text {
        background-color: #e9ecef;
        border-color: #ced4da;
        color: #495057;
    }
    body.light-mode .input-group-text {
        background-color: #3a3a3a;
        border-color: #555;
        color: #f1f1f1;
    }
    @media (max-width: 767.98px) {
        .table thead {
            display: none;
        }
        .table, .table tbody, .table tr {
            display: block;
            width: 100%;
        }
        .table tr.alumno-row {
            margin-bottom: 1.5rem;
            border: 1px solid var(--bs-border-color-translucent);
            border-radius: 8px; 
            overflow: hidden; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        body.light-mode .table tr.alumno-row {
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .table td {
            display: flex;
            justify-content: space-between; 
            align-items: center;
            text-align: right; 
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--bs-border-color-translucent);
        }
        .table td:last-child {
            border-bottom: none; 
        }
        .table td::before {
            content: attr(data-label);
            font-weight: 500;
            text-align: left;
            margin-right: 1rem;
            color: var(--bs-secondary);
        }
        body.light-mode .table td::before {
            color: rgba(255, 255, 255, 0.6);
        }
        .table td.alumno-info {
            display: flex; 
            justify-content: flex-start;
            background-color: #f8f9fa; 
            padding: 1rem 1.25rem;
        }
        body.light-mode .table td.alumno-info {
            background-color: rgba(0,0,0,0.15); 
        }
        .table td.alumno-info::before {
            display: none; 
        }
        .table td.alumno-info .d-flex {
            flex-direction: column; 
            align-items: flex-start !important;
        }
        .table td.alumno-info img {
            margin-bottom: 0.75rem; 
        }
        .table td.calif-final {
            font-size: 1.2rem;
        }
        .table td.calif-final::before {
            color: var(--bs-body-color) !important;
            font-weight: bold;
        }
        .table td[colspan="7"] {
            display: block;
            text-align: center;
            padding: 2rem;
            border: 1px solid var(--bs-border-color-translucent);
            border-radius: 8px;
        }
        .table td[colspan="7"]::before {
            display: none;
        }
    }
</style>