<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación de Examen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow p-4" style="max-width: 500px;">
    <h4 class="mb-3">¿Estás listo para comenzar el examen?</h4>
    <p class="mb-4">Tendrás <strong>10 minutos</strong> para completarlo. Una vez que comiences, no podrás detener el tiempo.</p>

    <form action="1.E.php" method="post">
      <button type="submit" class="btn btn-success w-100">Comenzar Examen</button>
      <a href="javascript:history.back()" class="btn btn-secondary mt-4 w-100">
        <i class="bi bi-arrow-left"></i> Regresar
      </a>
    </form>
  </div>

</body>
</html>