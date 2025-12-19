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

            // Título Cambiado
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(0, 10, mb_convert_encoding('Reporte de Actividades', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
            $this->Ln(5);
            
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(200, 220, 255);
            
            // Anchos
            $w = array(30, 110, 20, 20, 20, 20, 20, 20);
            
            // Encabezados cambiados a Act.X
            $header = array('No. Control', 'Nombre del Alumno', 'Act.1', 'Act.2', 'Act.3', 'Act.4', 'Act.5', 'Prom');

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

    $pdf = new PDF('L', 'mm', 'A4');
    $pdf->AliasNbPages(); 
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 9);

    // --- CONSULTA PARA ACTIVIDADES ---
    // Usamos la tabla alumnos_actividad (aa) y las columnas calf_A_X
    $query = "SELECT 
                a.nocontrol, 
                u.nombres, u.apellido_paterno, u.apellido_materno,
                aa.calf_A_1, aa.calf_A_2, aa.calf_A_3, aa.calf_A_4, aa.calf_A_5
              FROM alumnos a
              INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
              LEFT JOIN alumnos_actividad aa ON a.id_usuario = aa.id_usuario
              WHERE u.id_tipo_usuario = 3
              ORDER BY u.apellido_paterno ASC, u.apellido_materno ASC, u.nombres ASC";

    if ($result = $conn->query($query)) {
        
        $w = array(30, 110, 20, 20, 20, 20, 20, 20);
        $x_centered = $pdf->getTableX($w);

        while ($row = $result->fetch_assoc()) {
            $pdf->SetX($x_centered);
            
            $nombreCompleto = $row['apellido_paterno'] . ' ' . $row['apellido_materno'] . ' ' . $row['nombres'];
            $nombreDisplay = mb_convert_encoding($nombreCompleto, 'ISO-8859-1', 'UTF-8');
            $noControl = mb_convert_encoding($row['nocontrol'], 'ISO-8859-1', 'UTF-8');

            $pdf->Cell($w[0], 7, $noControl, 1, 0, 'C');
            $pdf->Cell($w[1], 7, $nombreDisplay, 1, 0, 'L');

            // --- CÁLCULO DE PROMEDIO ACTIVIDADES ---
            $suma_actividades = 0;
            
            for ($i = 1; $i <= 5; $i++) {
                // Obtenemos calificación de la columna calf_A_1, calf_A_2, etc.
                $nota = isset($row['calf_A_' . $i]) ? floatval($row['calf_A_' . $i]) : 0;
                
                $pdf->Cell($w[$i+1], 7, $nota, 1, 0, 'C');
                
                $suma_actividades += $nota;
            }

            $promedio = $suma_actividades / 5;

            // Imprimir Promedio
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell($w[7], 7, number_format($promedio, 1), 1, 0, 'C'); 
            $pdf->SetFont('Arial', '', 9); 

            $pdf->Ln();
        }
        $result->free();
    } else {
        $pdf->Cell(0, 10, 'Error en la consulta: ' . $conn->error, 1, 1, 'C');
    }

    $pdf->Output('I', 'Reporte_Actividades.pdf');
?>