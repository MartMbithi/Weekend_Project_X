<?php
/*
 *   Crafted On Sat Apr 01 2023
 *   Author Martin (martin@devlan.co.ke)
 */


$report_template = '../storage/templates/template.xlsx';
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($report_template);
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Tenants List', true);

/* Sheet columns head names */
$sheet->setCellValue('A1', 'S/N');
$sheet->setCellValue('B1', 'Full Names');
$sheet->setCellValue('C1', 'National ID Number');
$sheet->setCellValue('D1', 'Contacts');
$sheet->setCellValue('E1', 'House Number');
$sheet->setCellValue('F1', 'House Category');
$sheet->setCellValue('G1', 'House Rent');
$sheet->setCellValue('H1', 'Property Name');
$sheet->setCellValue('I1', 'Property Location');
$sheet->setCellValue('J1', 'Date Registered');


$query = $mysqli->query("SELECT * FROM houses h
INNER JOIN tenants t ON h.house_id = t.tenant_house_id
INNER JOIN properties p ON h.house_property_id = p.property_id");
if ($query->num_rows > 0) {
    $cnt = 1;
    $row = 2;/* Start filling data from row */
    while ($tenants = $query->fetch_assoc()) {
        /* Populate cell data */
        $sheet->setCellValue('A' . $row, $cnt);
        $sheet->setCellValue('B' . $row, $tenants['tenant_name']);
        $sheet->setCellValue('C' . $row, $tenants['tenant_national_id']);
        $sheet->setCellValue('D' . $row, $tenants['tenant_mobile_number']);
        $sheet->setCellValue('E' . $row, $tenants['house_number']);
        $sheet->setCellValue('F' . $row, $tenants['house_category']);
        $sheet->setCellValue('G' . $row, $tenants['house_rent']);
        $sheet->setCellValue('H' . $row, $tenants['property_name']);
        $sheet->setCellValue('I' . $row, $tenants['property_location']);
        $sheet->setCellValue('J' . $row, date('d M Y', strtotime($tenants['tenant_date_of_registration'])));
        $row++;
        $cnt = $cnt + 1;
    }
}

$file_name = 'Tenants List.xlsx';
ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $file_name . '');
header('Cache-Control: max-age=0');

$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
exit($xlsxWriter->save('php://output'));
