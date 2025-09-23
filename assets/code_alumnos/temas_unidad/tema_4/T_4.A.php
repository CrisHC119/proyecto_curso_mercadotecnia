<?php
    include_once __DIR__ . '/../../code_general/navbar.php';
    include_once __DIR__ . '/../../styles/style_index.php';
    if (!isset($_GET['lang'])) {
        $url = $_SERVER['PHP_SELF'] . '?lang=' . $idioma;
        header("Location: $url");
        exit;
    }
    $anterior = '../../index_alumnos.php'; 
    $siguiente = 'T_1.2.php'; 
?>

<div class="contenedor-cursos">
    <div id="mainContent">
        <h2 class="text-center mb-4">Actividad 4 ira aqui</h2>
    </div>
<?php
  include_once __DIR__ . '/../../code_general/tarjeta_curso.php';
?>
</div>

<?php
    include_once __DIR__ . '/../../../code_general/footer.php';
?>
<style>
  ul.list-unstyled.justificado li {
  line-height: 1.2;
}
</style>