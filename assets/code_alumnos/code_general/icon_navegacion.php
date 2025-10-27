<?php   
    include __DIR__ . '/verificar_idioma.php';
?>
<?php if (isset($anterior) && !empty($anterior)) : ?>
    <a href="<?php echo htmlspecialchars($anterior); ?>" class="btn btn-outline-primary nav-flotante nav-flotante-anterior" title="Anterior">
        <i class="bi bi-arrow-left-circle-fill"></i>
        
        <span class="nav-flotante-texto d-none d-md-inline ms-2"><?php echo $textos['anterior']; ?></span>
    </a>
<?php endif; ?>

<?php if (isset($siguiente) && !empty($siguiente)) : ?>
    <a href="<?php echo htmlspecialchars($siguiente); ?>" class="btn btn-primary nav-flotante nav-flotante-siguiente" title="Siguiente">
        <span class="nav-flotante-texto d-none d-md-inline me-2"><?php echo $textos['siguiente']; ?></span>
        
        <i class="bi bi-arrow-right-circle-fill"></i>
    </a>
<?php endif; ?>

<style>
    .nav-flotante {
        position: fixed;
        bottom: 25px;   
        z-index: 1030;  
        
        border-radius: 50px; 
        padding: 0.6rem 1.25rem;
        font-size: 1.1rem;
        line-height: 1.5;

        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        
        transition: all 0.2s ease-in-out;
    }

    .nav-flotante-anterior {
        left: 25px;
    }

    .nav-flotante-siguiente {
        right: 25px;
    }

    .nav-flotante:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 767.98px) {
        .nav-flotante {
            padding: 0.5rem 0.75rem;
            width: 46px; 
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-flotante .bi {
            margin: 0 !important;
            font-size: 1.2rem;
        }
    }
</style>