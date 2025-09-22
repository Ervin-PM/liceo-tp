<?php
// Bootstrap Laravel application and generate sample reports into storage/app/reports
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Asistencia;
use App\Exports\AsistenciaExport;

try {
    $asistencias = Asistencia::with(['alumno', 'alumno.curso'])->latest()->limit(200)->get();

    // Render HTML via Blade view
    $html = view('reportes.asistencia.pdf', ['data' => $asistencias])->render();

    // Ensure reports directory exists
    $reportsDir = storage_path('app/reports');
    if (!is_dir($reportsDir)) {
        mkdir($reportsDir, 0755, true);
    }

    // Generate PDF using Dompdf if available
    if (class_exists('\Dompdf\\Dompdf')) {
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfPath = $reportsDir . DIRECTORY_SEPARATOR . 'asistencia_' . date('Ymd_His') . '.pdf';
        file_put_contents($pdfPath, $dompdf->output());
        echo "Wrote PDF: {$pdfPath}\n";
    } else {
        echo "Dompdf not installed, skipping PDF generation.\n";
    }

    // Generate Excel using available libraries, or fallback to CSV
    if (class_exists('\Maatwebsite\\Excel\\Concerns\\FromCollection') && class_exists('\Maatwebsite\\Excel\\Facades\\Excel') && class_exists(\App\Exports\AsistenciaExport::class)) {
        $file = 'reports/asistencia_' . date('Ymd_His') . '.xlsx';
        \Maatwebsite\Excel\Facades\Excel::store(new AsistenciaExport($asistencias), $file, 'local');
        echo "Wrote Excel: storage/app/{$file}\n";
    } elseif (class_exists('\PhpOffice\\PhpSpreadsheet\\Spreadsheet')) {
        $xlsxPath = $reportsDir . DIRECTORY_SEPARATOR . 'asistencia_' . date('Ymd_His') . '.xlsx';
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray(['Apellidos','Nombres','Curso','Fecha','Estado','Comentario'], null, 'A1');
        $row = 2;
        foreach ($asistencias as $r) {
            $sheet->setCellValueExplicit('A'.$row, $r->alumno->apellidos ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('B'.$row, $r->alumno->nombres ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C'.$row, $r->alumno->curso->nombre ?? '');
            $sheet->setCellValue('D'.$row, $r->fecha ?? '');
            $sheet->setCellValue('E'.$row, $r->estado ?? '');
            $sheet->setCellValue('F'.$row, isset($r->comentario) ? str_replace(["\r","\n"], [' ', ' '], $r->comentario) : '');
            $row++;
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($xlsxPath);
        echo "Wrote XLSX (PhpSpreadsheet): {$xlsxPath}\n";
    } else {
        // Try to write a simple Excel 2003 XML (SpreadsheetML) file so Excel can open it without PHP extensions
        $xmlPath = $reportsDir . DIRECTORY_SEPARATOR . 'asistencia_' . date('Ymd_His') . '.xls';
        $headers = ['Apellidos', 'Nombres', 'Curso', 'Fecha', 'Estado', 'Comentario'];
        $rows = [];
        foreach ($asistencias as $r) {
            $rows[] = [
                $r->alumno->apellidos ?? '',
                $r->alumno->nombres ?? '',
                $r->alumno->curso->nombre ?? '',
                $r->fecha ?? '',
                $r->estado ?? '',
                isset($r->comentario) ? str_replace(["\r", "\n"], [' ', ' '], $r->comentario) : ''
            ];
        }

        // helper to escape XML
        $escape = function ($v) {
            return htmlspecialchars((string)$v, ENT_XML1 | ENT_COMPAT, 'UTF-8');
        };

        $xml = '<?xml version="1.0"?>'."\n";
        $xml .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'."\n";
        $xml .= "  <Worksheet ss:Name=\"Asistencias\">\n";
        $xml .= "    <Table>\n";
        // headers
        $xml .= "      <Row>\n";
        foreach ($headers as $h) {
            $xml .= '        <Cell><Data ss:Type="String">'. $escape($h) ."</Data></Cell>\n";
        }
        $xml .= "      </Row>\n";
        // data rows
        foreach ($rows as $r) {
            $xml .= "      <Row>\n";
            foreach ($r as $c) {
                $xml .= '        <Cell><Data ss:Type="String">'. $escape($c) ."</Data></Cell>\n";
            }
            $xml .= "      </Row>\n";
        }
        $xml .= "    </Table>\n";
        $xml .= "  </Worksheet>\n";
        $xml .= "</Workbook>\n";

        file_put_contents($xmlPath, $xml);
        echo "Wrote SpreadsheetML (.xls): {$xmlPath}\n";

        // Also write CSV fallback for tooling that expects CSV
        $csvPath = $reportsDir . DIRECTORY_SEPARATOR . 'asistencia_' . date('Ymd_His') . '.csv';
        $fh = fopen($csvPath, 'w');
        fputcsv($fh, $headers);
        foreach ($rows as $r) {
            fputcsv($fh, $r);
        }
        fclose($fh);
        echo "Wrote CSV fallback: {$csvPath}\n";
    }

} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
    exit(1);
}
