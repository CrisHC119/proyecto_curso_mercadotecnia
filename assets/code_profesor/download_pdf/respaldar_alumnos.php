<?php
    // respaldar_alumnos.php
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

        public $tituloReporte = '';
        public $cabeceraTabla = []; 
        public $anchosColumnas = [];

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

            // --- TÍTULO DINÁMICO ---
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(0, 10, mb_convert_encoding($this->tituloReporte, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 5, 'Generado el: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
            $this->Ln(5);
            
            // --- CABECERA DE TABLA DINÁMICA ---
            if (!empty($this->cabeceraTabla) && !empty($this->anchosColumnas)) {
                $this->SetFont('Arial', 'B', 10);
                $this->SetFillColor(200, 220, 255);
                
                $tableWidth = array_sum($this->anchosColumnas);
                $x = ($this->GetPageWidth() - $tableWidth) / 2;
                $this->SetX($x);

                for($i=0; $i<count($this->cabeceraTabla); $i++) {
                    $this->Cell($this->anchosColumnas[$i], 8, mb_convert_encoding($this->cabeceraTabla[$i], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
                }
                $this->Ln();
            }

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

    // ==========================================
    // INICIO DE LA GENERACIÓN DEL PDF
    // ==========================================

    $pdf = new PDF('L', 'mm', 'A4');
    $pdf->AliasNbPages(); 

    // Definir anchos generales para todas las tablas
    $w_global = array(30, 110, 20, 20, 20, 20, 20, 20);

    // ------------------------------------------
    // SECCIÓN 1: REPORTE DE ACTIVIDADES
    // ------------------------------------------
    
    // Configurar encabezados para esta sección
    $pdf->tituloReporte = 'Reporte de Actividades';
    $pdf->cabeceraTabla = array('No. Control', 'Nombre del Alumno', 'Act.1', 'Act.2', 'Act.3', 'Act.4', 'Act.5', 'Prom');
    $pdf->anchosColumnas = $w_global;
    
    $pdf->AddPage(); // Añadir página con la configuración actual

    $queryAct = "SELECT 
                    a.nocontrol, 
                    u.nombres, u.apellido_paterno, u.apellido_materno,
                    aa.calf_A_1, aa.calf_A_2, aa.calf_A_3, aa.calf_A_4, aa.calf_A_5
                 FROM alumnos a
                 INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
                 LEFT JOIN alumnos_actividad aa ON a.id_usuario = aa.id_usuario
                 WHERE u.id_tipo_usuario = 3
                 ORDER BY u.apellido_paterno ASC, u.apellido_materno ASC, u.nombres ASC";

    if ($result = $conn->query($queryAct)) {
        $x_centered = $pdf->getTableX($w_global);
        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($x_centered);
            $nombreCompleto = mb_convert_encoding($row['apellido_paterno'] . ' ' . $row['apellido_materno'] . ' ' . $row['nombres'], 'ISO-8859-1', 'UTF-8');
            $noControl = mb_convert_encoding($row['nocontrol'], 'ISO-8859-1', 'UTF-8');

            $pdf->Cell($w_global[0], 7, $noControl, 1, 0, 'C');
            $pdf->Cell($w_global[1], 7, $nombreCompleto, 1, 0, 'L');

            $suma = 0;
            for ($i = 1; $i <= 5; $i++) {
                $nota = isset($row['calf_A_' . $i]) ? floatval($row['calf_A_' . $i]) : 0;
                $pdf->Cell($w_global[$i+1], 7, $nota, 1, 0, 'C');
                $suma += $nota;
            }
            $promedio = $suma / 5;
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell($w_global[7], 7, number_format($promedio, 1), 1, 0, 'C'); 
            $pdf->SetFont('Arial', '', 9); 
            $pdf->Ln();
        }
        $result->free();
    }

    // ------------------------------------------
    // SECCIÓN 2: REPORTE DE EXÁMENES
    // ------------------------------------------

    // Configurar encabezados para esta sección
    $pdf->tituloReporte = 'Reporte de Exámenes';
    $pdf->cabeceraTabla = array('No. Control', 'Nombre del Alumno', 'Examen 1', 'Examen 2', 'Examen 3', 'Examen 4', 'Examen 5', 'Prom');
    // Anchos siguen siendo los mismos $w_global
    
    $pdf->AddPage(); // Salto de página, imprime nuevo header con el nuevo título

    $queryExam = "SELECT 
                    a.nocontrol, 
                    u.nombres, u.apellido_paterno, u.apellido_materno,
                    ac.calf_1, ac.calf_2, ac.calf_3, ac.calf_4, ac.calf_5
                  FROM alumnos a
                  INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
                  LEFT JOIN alumnos_calificacion ac ON a.id_usuario = ac.id_usuario
                  WHERE u.id_tipo_usuario = 3
                  ORDER BY u.apellido_paterno ASC, u.apellido_materno ASC, u.nombres ASC";

    if ($result = $conn->query($queryExam)) {
        $x_centered = $pdf->getTableX($w_global);
        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($x_centered);
            $nombreCompleto = mb_convert_encoding($row['apellido_paterno'] . ' ' . $row['apellido_materno'] . ' ' . $row['nombres'], 'ISO-8859-1', 'UTF-8');
            $noControl = mb_convert_encoding($row['nocontrol'], 'ISO-8859-1', 'UTF-8');

            $pdf->Cell($w_global[0], 7, $noControl, 1, 0, 'C');
            $pdf->Cell($w_global[1], 7, $nombreCompleto, 1, 0, 'L');

            $suma = 0;
            for ($i = 1; $i <= 5; $i++) {
                $nota = isset($row['calf_' . $i]) ? floatval($row['calf_' . $i]) : 0;
                $pdf->Cell($w_global[$i+1], 7, $nota, 1, 0, 'C');
                $suma += $nota;
            }
            $promedio = $suma / 5;
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell($w_global[7], 7, number_format($promedio, 1), 1, 0, 'C'); 
            $pdf->SetFont('Arial', '', 9); 
            $pdf->Ln();
        }
        $result->free();
    }

    // ------------------------------------------
    // SECCIÓN 3: REPORTE DE CALIFICACIONES FINALES
    // ------------------------------------------

    // 1. Obtener ponderaciones
    $valores_unidad = []; 
    $sql_valores = "SELECT id_unidad, examen_valor, actividad_valor FROM alumnos_valores_calificar WHERE id_unidad BETWEEN 1 AND 5";
    $res_val = $conn->query($sql_valores);
    if($res_val) {
        while($row = $res_val->fetch_assoc()) {
            $valores_unidad[$row['id_unidad']] = [
                'examen' => $row['examen_valor'], 
                'actividad' => $row['actividad_valor']
            ];
        }
    }

    // Configurar encabezados
    $pdf->tituloReporte = 'Reporte de Calificaciones Finales';
    $pdf->cabeceraTabla = array('No. Control', 'Nombre del Alumno', 'Unidad 1', 'Unidad 2', 'Unidad 3', 'Unidad 4', 'Unidad 5', 'Final');
    
    $pdf->AddPage(); // Salto de página

    // Consulta unificada
    $queryFinal = "SELECT 
                    a.nocontrol, 
                    u.nombres, u.apellido_paterno, u.apellido_materno,
                    ac.calf_1, ac.calf_2, ac.calf_3, ac.calf_4, ac.calf_5,
                    aa.calf_A_1, aa.calf_A_2, aa.calf_A_3, aa.calf_A_4, aa.calf_A_5
                  FROM alumnos a
                  INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
                  LEFT JOIN alumnos_calificacion ac ON a.id_usuario = ac.id_usuario
                  LEFT JOIN alumnos_actividad aa ON a.id_usuario = aa.id_usuario
                  WHERE u.id_tipo_usuario = 3
                  ORDER BY u.apellido_paterno ASC, u.apellido_materno ASC, u.nombres ASC";

    if ($result = $conn->query($queryFinal)) {
        $x_centered = $pdf->getTableX($w_global);
        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($x_centered);
            $nombreCompleto = mb_convert_encoding($row['apellido_paterno'] . ' ' . $row['apellido_materno'] . ' ' . $row['nombres'], 'ISO-8859-1', 'UTF-8');
            $noControl = mb_convert_encoding($row['nocontrol'], 'ISO-8859-1', 'UTF-8');

            $pdf->Cell($w_global[0], 7, $noControl, 1, 0, 'C');
            $pdf->Cell($w_global[1], 7, $nombreCompleto, 1, 0, 'L');

            $suma_final = 0;
            for ($i = 1; $i <= 5; $i++) {
                $nota_examen = isset($row['calf_' . $i]) ? floatval($row['calf_' . $i]) : 0;
                $nota_activ  = isset($row['calf_A_' . $i]) ? floatval($row['calf_A_' . $i]) : 0;
                
                $peso_examen = isset($valores_unidad[$i]['examen']) ? floatval($valores_unidad[$i]['examen']) : 0;
                $peso_activ  = isset($valores_unidad[$i]['actividad']) ? floatval($valores_unidad[$i]['actividad']) : 0;
                
                $calificacion_unidad = ($nota_examen * ($peso_examen / 100)) + ($nota_activ * ($peso_activ / 100));
                $calif_mostrar = round($calificacion_unidad);

                $pdf->Cell($w_global[$i+1], 7, $calif_mostrar, 1, 0, 'C');
                $suma_final += $calif_mostrar;
            }
            
            $promedio_final = $suma_final / 5;
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell($w_global[7], 7, number_format($promedio_final, 0), 1, 0, 'C'); 
            $pdf->SetFont('Arial', '', 9); 
            $pdf->Ln();
        }
        $result->free();
    }

    // ==========================================
    // GUARDAR ARCHIVO EN SERVIDOR
    // ==========================================
    
    // 1. Definir carpeta de destino
    $carpeta_destino = __DIR__ . '/../../respaldos/'; 
    
    // 2. Crear si no existe
    if (!file_exists($carpeta_destino)) {
        mkdir($carpeta_destino, 0777, true);
    }

    // 3. Nombre del archivo
    $nombre_archivo = 'Respaldo_curso_' . date('Y-m-d_H-i-s') . '.pdf';
    $ruta_completa = $carpeta_destino . $nombre_archivo;

    // 4. Guardar
    $pdf->Output('F', $ruta_completa);

    // 5. Cerrar pestaña automáticamente
    echo "<script>window.close();</script>";
?>