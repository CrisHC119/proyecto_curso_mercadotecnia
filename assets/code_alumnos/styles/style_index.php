<style>
    .btn-downtema {
        background: linear-gradient(135deg,rgb(46, 184, 30) 0%,rgb(5, 104, 5) 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 255, 72, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-downtema:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(13, 255, 0, 0.6);
    }
    .btn-downtema:active {
        transform: translateY(1px);
    }
    .btn-downtema i {
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    .btn-downtema:hover i {
        transform: rotate(10deg);
    }
    .btn-downtema::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(17, 232, 60, 0.1) 0%, rgba(255,255,255,0) 100%);
        transition: all 0.3s ease;
    }
    .btn-downtema:hover::after {
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
    }
    .pdf-viewer-wrapper {
        position: relative;
        width: 100%;
        height: 75vh;
        min-height: 500px;
        border: 1px solid #dee2e6;
        border-top: none;
    }
    .pdf-viewer-wrapper iframe.visor-pdf {
        width: 100%;
        height: 100%;
        border: none;
    }
    .tab-pane .ratio {
        border: 1px solid #dee2e6;
        border-top: none;
    }
    .btn-tema {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-tema:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 117, 252, 0.6);
    }
    .btn-tema:active {
        transform: translateY(1px);
    }
    .btn-tema i {
        margin-right: 8px;
        transition: all 0.3s ease;
    }
    .btn-tema:hover i {
        transform: rotate(10deg);
    }
    .btn-tema::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        transition: all 0.3s ease;
    }
    .btn-tema:hover::after {
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
    }
    @media (max-width: 767px) {
        #mainContent h2 {
            font-size: 1.1rem;
        }
        #mainContent h1 {
            font-size: 1.1rem;
        }
        #mainContent h3 {
            font-size: 1.1rem;
        }
        #mainContent h4 {
            font-size: 1.1rem;
        }
        .justificado {
            font-size: 0.6rem;
        }
    }
</style>