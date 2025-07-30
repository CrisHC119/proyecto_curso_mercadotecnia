<?php
include_once __DIR__ . '/code/navbar_profesor.php';
?>
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

/* Títulos */
.card-menu h5 {
  font-size: 1.2rem;
  font-weight: bold;
}

/* COLORES EN MODO CLARO */
body.light-mode .card-menu.alumnos {
  background-color: #0d6efd; /* Azul */
  color: #ffffff;
}
body.light-mode .card-menu.profesores {
  background-color: #20c997; /* Verde */
  color: #ffffff;
}
body.light-mode .card-menu.mensaje {
  background-color: #015901ff; /* Verde */
  color: #ffffff;
}
body.light-mode .card-menu.calificaciones {
  background-color: #ffc107; /* Amarillo */
  color: #ffffffff;
}
body.light-mode .card-menu.examenes {
  background-color: #fd7e14; /* Naranja */
  color: #ffffff;
}
body.light-mode .card-menu.actividades {
  background-color: #5d0075ff; /* Naranja */
  color: #ffffff;
}
body.light-mode .card-menu.logout {
  background-color: #920000ff; /* Naranja */
  color: #ffffff;
}
body.light-mode .card-menu i {
  color: #ffffff;
}

/* MODO OSCURO (NO .light-mode): fondo negro, íconos morados, texto blanco */
body:not(.light-mode) .card-menu {
  background-color: #2c2c2e;
  color: #ffffff;
  border: 1px solid rgba(255,255,255,0.1);
}
body:not(.light-mode) .card-menu i {
  color: #6f42c1;
}
</style>

<body>
<main class="flex-fill">
  <div class="container py-4">
    <h4 class="mb-4"><?php echo $textos['panel_navegacion']; ?></h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

      <!-- Card: Actividades -->
      <div class="col">
        <a href="/assets/code/profesor/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
          <div class="card card-menu mensaje shadow-sm">
            <i class="bi bi-chat-dots-fill"></i>
            <h5><?php echo $textos['mensajes']; ?></h5>
          </div>
        </a>
      </div>

      <!-- Card: Alumnos Registrados -->
      <div class="col">
        <a href="/assets/code/profesor/alumnos_registrados.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
          <div class="card card-menu alumnos shadow-sm">
            <i class="bi bi-people-fill"></i>
            <h5><?php echo $textos['alumnos_registrados']; ?></h5>
          </div>
        </a>
      </div>

      <!-- Card: Profesores Registrados -->
      <div class="col">
        <a href="/assets/code/profesor/profesores_registrados.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
          <div class="card card-menu profesores shadow-sm">
            <i class="bi bi-person-badge-fill"></i>
            <h5><?php echo $textos['profesores_registrados']; ?></h5>
          </div>
        </a>
      </div>

      <!-- Card: Actividades -->
      <div class="col">
        <a href="/assets/code/profesor/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
          <div class="card card-menu actividades shadow-sm">
            <i class="bi bi-list-task"></i>
            <h5><?php echo $textos['actividades']; ?></h5>
          </div>
        </a>
      </div>

      <!-- Card: Calificaciones -->
      <div class="col">
        <a href="/assets/code/profesor/lost_page_profesor.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
          <div class="card card-menu calificaciones shadow-sm">
            <i class="bi bi-card-checklist"></i>
            <h5><?php echo $textos['calificaciones']; ?></h5>
          </div>
        </a>
      </div>

      <!-- Card: Exámenes -->
      <div class="col">
        <a href="/assets/code/profesor/examenes.php?lang=<?php echo $_SESSION['idioma'];?>" class="text-decoration-none">
          <div class="card card-menu examenes shadow-sm">
            <i class="bi bi-pencil-square"></i>
            <h5><?php echo $textos['examenes']; ?></h5>
          </div>
        </a>
      </div>

      <div class="col">
        <a href="/assets/code/modelo/logout.php" class="text-decoration-none">
          <div class="card card-menu logout shadow-sm">
            <i class="bi bi-box-arrow-right"></i>
            <h5><?php echo $textos['cerrar_sesion']; ?></h5>
          </div>
        </a>
      </div>

    </div>
  </div>
</main>

<?php include_once __DIR__ . '/../footer.php'; ?>
</body>
