<?php
    $horas = [
        'intro' => 1,
        'tema_1.1' => 1,
        'tema_1.2' => 1,
        'tema_1.2.1' => 2,
        'tema_1.2.2' => 3,
        'tema_1.2.3' => 2,
        'tema_1.3' => 2,
        'tema_1.4' => 1,
        'tema_1.5' => 2,
        'tema_1.6' => 2,
        'tema_1_total' => 17,
    ];

    $excluir = ['tema_1_total']; 

    $total = 0;
    foreach ($horas as $clave => $valor) {
        if (!in_array($clave, $excluir)) {
        $total += $valor;
        }
    }
    $horas['total'] = $total;
    // Se colocan la cantidad de horas establecidas en cada tema, en excluir, se excluye las horas en total
?>