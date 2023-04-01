<?php
/*
 *   Crafted On Sat Apr 01 2023
 *   Author Martin (martin@devlan.co.ke)
 */


$report_template = '../storage/templates/template.xlsx';
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($report_template);
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Houses List', true);

/* Sheet columns head names */
$sheet->setCellValue('A1', 'S/N');
$sheet->setCellValue('B1', 'House Number');
$sheet->setCellValue('C1', 'House Category');
$sheet->setCellValue('D1', 'House Rent');
$sheet->setCellValue('E1', 'House Status');
$sheet->setCellValue('F1', 'Property Name');
$sheet->setCellValue('G1', 'Property Location');


$query = $mysqli->query("SELECT * FROM houses h
INNER JOIN properties p ON h.house_property_id = p.property_id
ORDER BY h.house_status ASC");
if ($query->num_rows > 0) {
    $cnt = 1;
    $row = 2;/* Start filling data from row */
    while ($houses = $query->fetch_assoc()) {
        /* Populate cell data */
        $sheet->setCellValue('A' . $row, $cnt);
        $sheet->setCellValue('B' . $row, $houses['house_number']);
        $sheet->setCellValue('C' . $row, $houses['house_category']);
        $sheet->setCellValue('D' . $row, $houses['house_rent']);
        $sheet->setCellValue('E' . $row, $houses['house_status']);
        $sheet->setCellValue('F' . $row, $houses['property_name']);
        $sheet->setCellValue('G' . $row, $houses['property_location']);

        $row++;
        $cnt = $cnt + 1;
    }
}

$file_name = 'Houses List.xlsx';
ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $file_name . '');
header('Cache-Control: max-age=0');

$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
exit($xlsxWriter->save('php://output'));
