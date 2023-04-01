<?php
/*
 *   Crafted On Fri Mar 17 2023
 *   Author Martin (martinezmbithi@gmail.com)
 * 
 *   www.makueni.go.ke
 *   info@makueni.go.ke
 *
 *
 *   The Makueni County Government ICT, Education and Internship Department End User License Agreement
 *   Copyright (c) 2022 Makueni County Government
 *
 *
 *   1. GRANT OF LICENSE 
 *   Makueni County Government ICT, Education and Internship Department hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 *   install and activate this system on one computer solely for your official and non-commercial use,
 *   unless you have purchased a commercial license from Makueni County Government ICT. Sharing this Software with other individuals, 
 *   or allowing other individuals to view the contents of this Software, is in violation of this license.
 *   You may not make the Software available on a network, or in any way provide the Software to multiple users
 *   unless you have first purchased at least a multi-user license from Makueni County Government ICT, Education and Internship Department
 *
 *   2. COPYRIGHT 
 *   The Software is owned by Makueni County Government ICT, Education and Internship Department and protected by copyright law and international copyright treaties. 
 *   You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 *
 *   3. RESTRICTIONS ON USE
 *   You may not, and you may not permit others to
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 *   (b) modify, distribute, or create derivative works of the Software;
 *   (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 *   otherwise exploit the Software. 
 *
 *
 *   4. TERM
 *   This License is effective until terminated. 
 *   You may terminate it at any time by destroying the Software, together with all copies thereof.
 *   This License will also terminate if you fail to comply with any term or condition of this Agreement.
 *   Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 *
 *   5. NO OTHER WARRANTIES. 
 *   MAKUENI COUNTY GOVERNMENT ICT, EDUCATION AND INTERNSHIP DEPARTMENT  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 *   MAKUENI COUNTY GOVERNMENT ICT, EDUCATION AND INTERNSHIP DEPARTMENT SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 *   EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 *   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 *   SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 *   ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 *   INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 *   SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 *   THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 *   HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 *
 *   6. SEVERABILITY
 *   In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 *   affect the validity of the remaining portions of this license.
 *
 *
 *   7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL MAKUENI COUNTY GOVERNMENT ICT, EDUCATION AND INTERNSHIP DEPARTMENT OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 *   CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 *   USE OF THE SOFTWARE, EVEN IFMAKUENI COUNTY GOVERNMENT ICT, EDUCATION AND INTERNSHIP DEPARTMENT HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 *   IN NO EVENT WILL MAKUENI COUNTY GOVERNMENT ICT, EDUCATION AND INTERNSHIP DEPARTMENT  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 *   TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 *
 */

$report_template = '../storage/templates/template.xlsx';
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($report_template);
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('All Applications List', true);

/* Sheet columns head names */
$sheet->setCellValue('A1', 'S/N');
$sheet->setCellValue('B1', 'Application Ref Number');
$sheet->setCellValue('C1', 'Applicant Names');
$sheet->setCellValue('D1', 'Applicant Contacts');
$sheet->setCellValue('E1', 'Applicant Email');
$sheet->setCellValue('F1', 'Applicant Course Taking');
$sheet->setCellValue('G1', 'Applicant Year Of Study');
$sheet->setCellValue('H1', 'Applicant Education Level');
$sheet->setCellValue('I1', 'Applicant County');
$sheet->setCellValue('J1', 'Applicant Sub County');
$sheet->setCellValue('K1', 'Applicant Ward');
$sheet->setCellValue('L1', 'Department Applied');
$sheet->setCellValue('M1', 'Directorate Applied');
$sheet->setCellValue('N1', 'Intake Period');


$query = $mysqli->query("SELECT * FROM attachment_applications aa
    INNER JOIN attachees a ON a.attachee_id = aa.application_attachee_id
    INNER JOIN attachment_departments ad ON ad.dep_id = aa.application_attachee_department_id
    INNER JOIN intake_periods ip ON ip.period_id = aa.application_attachee_intake_period_id
    INNER JOIN directories d ON d.directory_id = aa.application_attachee_directorate_id
    WHERE application_attachee_attachment_status != 'Approved'
    ");
if ($query->num_rows > 0) {
    $cnt = 1;
    $row = 2;/* Start filling data from row */
    while ($users = $query->fetch_assoc()) {
        /* Populate cell data */
        $sheet->setCellValue('A' . $row, $cnt);
        $sheet->setCellValue('B' . $row, $users['application_ref_code']);
        $sheet->setCellValue('C' . $row, $users['attachee_names']);
        $sheet->setCellValue('D' . $row, $users['attachee_phone_number']);
        $sheet->setCellValue('E' . $row, $users['attachee_email']);
        $sheet->setCellValue('F' . $row, $users['application_attachee_course']);
        $sheet->setCellValue('G' . $row, $users['application_attachee_yos']);
        $sheet->setCellValue('H' . $row, $users['application_attachee_level']);
        $sheet->setCellValue('I' . $row, $users['attachee_county']);
        $sheet->setCellValue('J' . $row, $users['attachee_sub_county']);
        $sheet->setCellValue('K' . $row, $users['attachee_ward']);
        $sheet->setCellValue('L' . $row, $users['dep_name']);
        $sheet->setCellValue('M' . $row, $users['directory_name']);
        $sheet->setCellValue('N' . $row, $users['period_details']);

        $row++;
        $cnt = $cnt + 1;
    }
}

$file_name = 'All Applications List.xlsx';
ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $file_name . '');
header('Cache-Control: max-age=0');

$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
exit($xlsxWriter->save('php://output'));
