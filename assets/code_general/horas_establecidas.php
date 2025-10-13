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
        'tema_2.1' => 2,
        'tema_2.2' => 2,
        'tema_2.2.1_a' => 3,
        'tema_2.2.1_b' => 2,
        'tema_2.2.1_c' => 2,
        'tema_2.2.1_d' => 3,
        'tema_3.1' => 3,
        'tema_3.2' => 3,
        'tema_3.3' => 2,
        'tema_3.4' => 2,
        'tema_3.5' => 2,
        'tema_3.6' => 2,
        'tema_3.7' => 2,
        'tema_4.1' => 2,
        'tema_4.2' => 2,
        'tema_4.2.2' => 2,
        'tema_4.2.3' => 2,
        'tema_4.2.4' => 2,
        'tema_4.3' => 2,
        'tema_4.4' => 2,
        'tema_4.5' => 1,
        'tema_4.5.1' => 2,
        'tema_4.5.2' => 2,
        'tema_5.1' => 3,
        'tema_5.2' => 3,
        'tema_5.3' => 1,
        'tema_5.3_1' => 2,
        'tema_5.3_2' => 2,
        'tema_5.4' => 3,
        'tema_1_total' => 17,
        'tema_2_total' => 14,
        'tema_3_total' => 16,
        'tema_4_total' => 19,
        'tema_5_total' => 14
    ];

    $excluir = [
        'tema_1_total',
        'tema_2_total',
        'tema_3_total',
        'tema_4_total',
        'tema_5_total'
    ]; 

    $total = 0;
    foreach ($horas as $clave => $valor) {
        if (!in_array($clave, $excluir)) {
        $total += $valor;
        }
    }
    $horas['total'] = $total;
    // Se colocan la cantidad de horas establecidas en cada tema, en excluir, se excluye las horas en total
?>