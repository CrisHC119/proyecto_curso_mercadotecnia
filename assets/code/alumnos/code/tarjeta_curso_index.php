<style>
    .tarjeta-curso {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        color: inherit;
        font-size: 0.95rem;
    }
    .tarjeta-curso {
        padding: 1rem;
        font-size: 0.9rem;
    }
</style>
  <!-- Temario general -->
<div class="tarjeta-curso">
    <h2 class="text-center mb-3"><?php echo $textos['temario_1']; ?></h2>
    <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-book me-2"></i><?php echo $textos['tema_1']; ?>
        </div>
        <a href="/assets/code/alumnos/temas/tema_1/1.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-globe2 me-2"></i></i><?php echo $textos['tema_1.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.2.1.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
        <i class="bi bi-people-fill me-2"></i><?php echo $textos['tema_1.2.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.2.2.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
        <i class="bi bi-diagram-3 me-2"></i><?php echo $textos['tema_1.2.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.2.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
        <i class="bi bi-currency-dollar me-2"></i><?php echo $textos['tema_1.2.3']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.3.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-search me-2"></i><?php echo $textos['tema_1.3']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.4.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-laptop me-2"></i><?php echo $textos['tema_1.4']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.5.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-exclamation-triangle me-2"></i><?php echo $textos['tema_1.5']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.6.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-palette me-2"></i><?php echo $textos['tema_1.6']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.7.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_1.7']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/tema_1/1.G.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-journal-text me-2"></i><?php echo $textos['tema_1.G']; ?>
        </a>
    </div>
</div>