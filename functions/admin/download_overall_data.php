<?php

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require_once "../../spreadsheet/vendor/autoload.php";
require_once "../config.php";

$time = $_POST['time'];

$helper = new Sample();
if ($helper->isCli()) {
    $helper->log('This example should only be run from a Web Browser' . PHP_EOL);

    return;
}
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Maarten Balliauw')
    ->setLastModifiedBy('Maarten Balliauw')
    ->setTitle('Office 2007 XLSX Test Document')
    ->setSubject('Office 2007 XLSX Test Document')
    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
    ->setKeywords('office 2007 openxml php')
    ->setCategory('Test result file');

// Add some data
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'General Data')
    ->setCellValue('B1', $time)
    ->setCellValue('A2', 'Name')
    ->setCellValue('B2', 'Email')
    ->setCellValue('C2', 'Phone')
    ->setCellValue('D2', 'Gender')
    ->setCellValue('E2', 'DOB')
    ->setCellValue('F2', 'University')
    ->setCellValue('G2', 'Department')
    ->setCellValue('H2', 'Year')
    ->setCellValue('I2', 'Enrollment Number')
    ->setCellValue('J2', 'Payment ID')
    ->setCellValue('K2', 'Order ID')
    ->setCellValue('L2', 'Profile Status');


$sql = "SELECT * FROM user";
$result = $conn->query($sql);
$i = 3;
while ($row = $result->fetch_assoc()) {
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $i, $row['name'])
        ->setCellValue('B' . $i, $row['email'])
        ->setCellValue('C' . $i, $row['phone'])
        ->setCellValue('D' . $i, $row['gender'])
        ->setCellValue('E' . $i, $row['dob'])
        ->setCellValue('F' . $i, $row['university'])
        ->setCellValue('G' . $i, $row['department'])
        ->setCellValue('H' . $i, $row['year'])
        ->setCellValue('I' . $i, $row['enrollment'])
        ->setCellValue('J' . $i, $row['payment_id'])
        ->setCellValue('K' . $i, $row['order_id'])
        ->setCellValue('L' . $i, $row['profile_lock']);
    $i++;
}


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;

?>