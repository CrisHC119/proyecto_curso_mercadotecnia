<?php
    require_once '../../modelo/conexion.php';
    require_once __DIR__ . '/../../extensiones/fpdf/fpdf.php';

    class PDF extends FPDF
    {
        public $logoIzq;
        public $logoCentro;
        public $logoDer;

        public $w_logoIzq = 40; 
        public $w_logoCen = 60;
        public $w_logoDer = 20;

        function __construct($orientation = 'L', $unit = 'mm', $size = 'A4') {
            parent::__construct($orientation, $unit, $size);
            
            $baseDir = dirname(__DIR__);
            $this->logoIzq    = $baseDir . '/../images/icons_tecnm/logo_tec_mexico.png';
            $this->logoCentro = $baseDir . '/../images/icons_tecnm/logo_tec_edu.png';
            $this->logoDer    = $baseDir . '/../images/icons_tecnm/logo_tec_victoria.png';
        }

        function Header()
        {
            $y_img = 10; 
            
            if(file_exists($this->logoIzq)) {
                $this->Image($this->logoIzq, 10, $y_img, $this->w_logoIzq);
            }

            if(file_exists($this->logoDer)) {
                $x_der = $this->GetPageWidth() - 10 - $this->w_logoDer;
                $this->Image($this->logoDer, $x_der, $y_img, $this->w_logoDer);
            }

            if(file_exists($this->logoCentro)) {
                $x_cen = ($this->GetPageWidth() - $this->w_logoCen) / 2;
                $this->Image($this->logoCentro, $x_cen, $y_img, $this->w_logoCen);
            }

            $this->Ln(30);

            $this->SetFont('Arial', 'B', 15);
            $this->Cell(0, 10, 'Reporte de Calificaciones', 0, 1, 'C');
            $this->Ln(5);
            
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(200, 220, 255);
            
            $w = array(30, 110, 20, 20, 20, 20, 20, 20);
            
            $header = array('No. Control', 'Nombre del Alumno', 'Unidad 1', 'Unidad 2', 'Unidad 3', 'Unidad 4', 'Unidad 5', 'Final');

            // Centrar tabla
            $tableWidth = array_sum($w);
            $x = ($this->GetPageWidth() - $tableWidth) / 2;
            $this->SetX($x);

            for($i=0; $i<count($header); $i++) {
                $this->Cell($w[$i], 8, mb_convert_encoding($header[$i], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
            }
            
            $this->Ln();
            $this->SetFont('Arial', '', 9);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
        
        function getTableX($w) {
            $tableWidth = array_sum($w);
            return ($this->GetPageWidth() - $tableWidth) / 2;
        }
    }

    // --- 1. OBTENER LOS VALORES DE PONDERACIÓN (RETÍCULA) ---
    // Guardaremos los porcentajes en un array indexado por número de unidad (1-5)
    $valores_unidad = []; 
    $sql_valores = "SELECT id_unidad, examen_valor, actividad_valor FROM alumnos_valores_calificar WHERE id_unidad BETWEEN 1 AND 5";
    $res_val = $conn->query($sql_valores);
    
    if($res_val) {
        while($row = $res_val->fetch_assoc()) {
            $valores_unidad[$row['id_unidad']] = [
                'examen' => $row['examen_valor'],    // Ej: 40
                'actividad' => $row['actividad_valor'] // Ej: 60
            ];
        }
    }

    // --- 2. CONFIGURACIÓN DEL PDF ---
    $pdf = new PDF('L', 'mm', 'A4'); // Landscape
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 9);

    // --- 3. CONSULTA PRINCIPAL DE ALUMNOS Y CALIFICACIONES ---
    // Usamos LEFT JOIN para traer al alumno aunque no tenga calificaciones registradas aún (saldrán en 0)
    $query = "SELECT 
                a.nocontrol, 
                u.nombres, u.apellido_paterno, u.apellido_materno,
                -- Calificaciones Examen
                ac.calf_1, ac.calf_2, ac.calf_3, ac.calf_4, ac.calf_5,
                -- Calificaciones Actividad
                aa.calf_A_1, aa.calf_A_2, aa.calf_A_3, aa.calf_A_4, aa.calf_A_5
              FROM alumnos a
              INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
              LEFT JOIN alumnos_calificacion ac ON a.id_usuario = ac.id_usuario
              LEFT JOIN alumnos_actividad aa ON a.id_usuario = aa.id_usuario
              WHERE u.id_tipo_usuario = 3
              ORDER BY u.apellido_paterno ASC, u.apellido_materno ASC, u.nombres ASC";

    if ($result = $conn->query($query)) {
        
        // Anchos de columnas (Coinciden con Header)
        $w = array(30, 110, 20, 20, 20, 20, 20, 20);
        $x_centered = $pdf->getTableX($w);

        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($x_centered);
            
            // Datos personales
            $nombreCompleto = $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . ' ' . $row['nombres'];
            $nombreDisplay = mb_convert_encoding($nombreCompleto, 'ISO-8859-1', 'UTF-8');
            $noControl = mb_convert_encoding($row['nocontrol'], 'ISO-8859-1', 'UTF-8');

            $pdf->Cell($w[0], 7, $noControl, 1, 0, 'C');
            $pdf->Cell($w[1], 7, $nombreDisplay, 1, 0, 'L'); // Alineado a la izquierda

            // --- CÁLCULO DE CALIFICACIONES POR UNIDAD ---
            $suma_final = 0;
            $unidades_contadas = 0; // Para el promedio, contamos 5 unidades fijas

            for ($i = 1; $i <= 5; $i++) {
                // Obtenemos calificaciones crudas (si es null, es 0)
                $nota_examen = isset($row['calf_' . $i]) ? floatval($row['calf_' . $i]) : 0;
                $nota_activ  = isset($row['calf_A_' . $i]) ? floatval($row['calf_A_' . $i]) : 0;

                // Obtenemos los pesos de la base de datos para esa unidad
                // Si no se definieron valores, asumimos 0 para evitar errores
                $peso_examen = isset($valores_unidad[$i]['examen']) ? floatval($valores_unidad[$i]['examen']) : 0;
                $peso_activ  = isset($valores_unidad[$i]['actividad']) ? floatval($valores_unidad[$i]['actividad']) : 0;
                
                // NOTA: Asumimos que asistencia y proyecto no se usan o valen 0 ya que no hay tabla de datos para ellos.
                
                // Fórmula: (NotaExamen * %Examen) + (NotaActividad * %Actividad)
                // Los valores en BD suelen ser enteros (ej: 40, 60), por eso dividimos entre 100.
                $calificacion_unidad = ($nota_examen * ($peso_examen / 100)) + ($nota_activ * ($peso_activ / 100));
                
                // Redondear a 0 decimales (o 1 si prefieres) para mostrar en tabla
                $calif_mostrar = round($calificacion_unidad); // Entero más cercano

                // Imprimir celda de la unidad
                // Si la calificación es reprobatoria (<70), podrías ponerla en rojo (opcional)
                /* if($calif_mostrar < 70) $pdf->SetTextColor(200,0,0); 
                else $pdf->SetTextColor(0);
                */
                
                $pdf->Cell($w[$i+1], 7, $calif_mostrar, 1, 0, 'C');
                
                // Acumular para el promedio final
                $suma_final += $calif_mostrar;
            }

            // --- CÁLCULO PROMEDIO FINAL ---
            // Promedio simple de las 5 unidades
            $promedio_final = $suma_final / 5;
            
            // Restablecer color negro por si se usó rojo
            $pdf->SetTextColor(0);

            // Imprimir Promedio Final
            // Negrita para el final
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell($w[7], 7, number_format($promedio_final, 0), 1, 0, 'C'); // Sin decimales
            $pdf->SetFont('Arial', '', 9); // Volver a normal

            $pdf->Ln();
        }
        $result->free();
    } else {
        $pdf->Cell(0, 10, 'Error en la consulta: ' . $conn->error, 1, 1, 'C');
    }

    $pdf->Output('I', 'Reporte_Calificaciones.pdf');
?>