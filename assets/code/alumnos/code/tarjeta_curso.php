<?php
// Esto va al inicio del archivo, antes de imprimir HTML
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/code/modelo/conexion.php';
date_default_timezone_set('America/Monterrey');

$sql = "SELECT fecha_disponible FROM examen_unidad WHERE id_examen = 1 LIMIT 1";
$result = $conn->query($sql);

$fechaExamen = null;
if ($result && $result->num_rows > 0) {
    $fechaExamen = $result->fetch_assoc()['fecha_disponible'];
}

function mostrarEstadoFecha($fecha) {
    if (!$fecha) {
        return "<span class='text-danger fw-bold'>No disponible</span>";
    }
    $fechaObj = new DateTime($fecha, new DateTimeZone('America/Monterrey'));
    $ahora = new DateTime('now', new DateTimeZone('America/Monterrey'));

    if ($fechaObj < $ahora) {
        return "<span class='text-danger fw-bold'>Vencido: " . $fechaObj->format("d/m/Y H:i") . "</span>";
    }
    return "<span>" . $fechaObj->format("d/m/Y H:i") . "</span>";
}
$id_usuario = $_SESSION['id_usuario'] ?? 0;
$examenRealizado = false;
if ($id_usuario) {
    $sqlEstado = $conn->prepare("SELECT examen_U1 FROM alumnos_calificacion WHERE id_usuario = ?");
    $sqlEstado->bind_param("i", $id_usuario);
    $sqlEstado->execute();
    $resEstado = $sqlEstado->get_result();
    if ($fila = $resEstado->fetch_assoc()) {
        $examenRealizado = ($fila['examen_U1'] == 1);
    }
}
// Formato ISO para JS
$fechaISO = $fechaExamen ? (new DateTime($fechaExamen, new DateTimeZone('America/Monterrey')))->format(DateTime::ATOM) : null;
?>
<style>
    .tarjeta-curso {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        color: inherit;
        font-size: 0.9rem;
    }
    .tarjeta-curso {
        padding: 1rem;
        font-size: 0.9rem;
    }
        /* Para que el enlace y la fecha estén en línea y con espacio */
    .list-group-item {
        display: flex;
        align-items: center;
    }
.fecha-examen {
    font-weight: 600;
    font-size: 0.85rem;
    white-space: nowrap;
}

</style>
<?php
  $ubi_index = '../';
?>
  <!-- Temario general -->
<div class="tarjeta-curso">
    <h2 class="text-center mb-3"><?php echo $textos['temario']; ?></h2>
    <div class="border-top border-primary my-3" style="height: 3px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <a href="/assets/code/alumnos/temas/index_alumnos.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item titulo-tema text-decoration-none text-reset">
        <i class="bi bi-book me-2"></i><?php echo $textos['tema_1']; ?>
        </a>
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
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u1']; ?>
        </a>        
<a href="<?php 
    echo $examenRealizado 
        ? '/assets/code/alumnos/temas/tema_1/1.E.php?lang=' . $_SESSION['idioma']   // Página examen
        : '/assets/code/alumnos/temas/tema_1/1.E_confirm.php?lang=' . $_SESSION['idioma'];  // Página confirmación
?>" 
   class="list-group-item list-group-item-action"
   id="link-examen-1"
   data-fecha="<?php echo $fechaISO; ?>">
    <i class="bi bi-book me-2"></i>
    <?php 
      echo $textos['test_u1']; 
      if ($examenRealizado) echo " <span class='badge bg-success ms-2'>Realizado</span>";
    ?>
    -> 
    <span class="fecha-examen"><?php echo mostrarEstadoFecha($fechaExamen); ?></span>
</a>

    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-diagram-3-fill me-2"></i><?php echo $textos['tema_2']; ?>
        </div>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-lightbulb-fill me-2"></i><?php echo $textos['tema_2.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-ui-checks-grid me-2"></i><?php echo $textos['tema_2.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-building me-2"></i><?php echo $textos['tema_2.2.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-person-badge me-2"></i><?php echo $textos['tema_2.2.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-bank me-2"></i><?php echo $textos['tema_2.2.3']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-bar-chart-line me-2"></i><?php echo $textos['tema_2.2.4']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u2']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u2']; ?>
        </a>
    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-cpu-fill me-2"></i><?php echo $textos['tema_3']; ?>
        </div>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-wifi me-2"></i><?php echo $textos['tema_3.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-phone me-2"></i><?php echo $textos['tema_3.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-gear-wide-connected me-2"></i><?php echo $textos['tema_3.3']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-telephone-fill me-2"></i><?php echo $textos['tema_3.4']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-browser-chrome me-2"></i><?php echo $textos['tema_3.5']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-person-lines-fill me-2"></i><?php echo $textos['tema_3.6']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-person-video3 me-2"></i><?php echo $textos['tema_3.7']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u3']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u3']; ?>
        </a>
    </div>

    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-shield-lock-fill me-2"></i><?php echo $textos['tema_4']; ?>
        </div>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-file-earmark-text me-2"></i><?php echo $textos['tema_4.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-pencil-square me-2"></i><?php echo $textos['tema_4.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-diagram-3-fill me-2"></i><?php echo $textos['tema_4.2.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-journal-check me-2"></i><?php echo $textos['tema_4.2.3']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-arrow-repeat me-2"></i><?php echo $textos['tema_4.2.4']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-shield-shaded me-2"></i><?php echo $textos['tema_4.3']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-emoji-neutral-fill me-2"></i><?php echo $textos['tema_4.4']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $textos['tema_4.5']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-hdd-network-fill me-2"></i><?php echo $textos['tema_4.5.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-bug-fill me-2"></i><?php echo $textos['tema_4.5.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u4']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u4']; ?>
        </a>
    </div>


    <div class="" style="height: 20px; width: 80%; margin: 0 auto;"></div>

    <div class="list-group tema-lista-custom">
        <div class="list-group-item titulo-tema">
            <i class="bi bi-graph-up-arrow me-2"></i><?php echo $textos['tema_5_alt']; ?>
        </div>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-lightbulb me-2"></i><?php echo $textos['tema_5.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-tools me-2"></i><?php echo $textos['tema_5.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-diagram-3 me-2"></i><?php echo $textos['tema_5.3']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-database-check me-2"></i><?php echo $textos['tema_5.3.1']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action ps-5">
            <i class="bi bi-speedometer2 me-2"></i><?php echo $textos['tema_5.3.2']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
            <i class="bi bi-bar-chart-fill me-2"></i><?php echo $textos['tema_5.4']; ?>
        </a>
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-pen me-2"></i><?php echo $textos['actividad_u5']; ?>
        </a>        
        <a href="/assets/code/alumnos/temas/lost_page.php?lang=<?php echo $_SESSION['idioma'];?>" class="list-group-item list-group-item-action">
        <i class="bi bi-book me-2"></i><?php echo $textos['test_u5']; ?>
        </a>
    </div>
</div>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    <div id="toastAviso" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMensaje"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const linkExamen = document.getElementById('link-examen-1');
    if (!linkExamen) return;

    const fechaStr = linkExamen.getAttribute('data-fecha');
    const fechaExamen = fechaStr ? new Date(fechaStr) : null;

    linkExamen.addEventListener('click', function(event) {
        const ahora = new Date();

        if (!fechaExamen) {
            event.preventDefault();
            mostrarToast("El examen aún no está disponible.");
            return;
        }

        if (fechaExamen < ahora) {
            event.preventDefault();
            const opciones = { year: 'numeric', month: '2-digit', day: '2-digit', hour:'2-digit', minute:'2-digit' };
            const fechaFormateada = fechaExamen.toLocaleString('es-MX', opciones);
            mostrarToast(`El examen expiró el día: ${fechaFormateada}. Contacta con el profesor.`);
            return;
        }
        // Si está activo, deja ir normal
    });

    function mostrarToast(mensaje) {
        const toastEl = document.getElementById('toastAviso');
        const toastMensaje = document.getElementById('toastMensaje');
        toastMensaje.textContent = mensaje;

        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
});
</script>