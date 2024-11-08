<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Borders;

$filename = "";

if($_GET["slct_apptype"] == "New"){
    $filename = "New TDP Form 3 - Annex 7";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TDP Continuing Form 4 - Annex 5";

}


$n = 0;

$academic_year = "__________";
$semester = "__________";

while($row = mysqli_fetch_assoc($result)){
    
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);

    $first_semester = openssl_decrypt($row["1st_semester"], $method, $key);
    $second_semester = openssl_decrypt($row["2nd_semester"], $method, $key);

    $n++;

}

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle($filename); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);


//-----------------------------------------------------------------------------------------

$sheet->mergeCells('D1:H1');
$sheet->setCellValue('D1', $filename);
$sheet->getStyle('D1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('D1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('C3:F3');
$sheet->setCellValue('C3', 'Republic of the Philippines');
$sheet->getStyle('C3')->getFont()->setSize(12);
$sheet->getStyle('C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getRowDimension(3)->setRowHeight(15);

$sheet->mergeCells('C4:F4');
$sheet->setCellValue('C4', 'KOLEHIYO NG LUNGSOD NG LIPA');
$sheet->getStyle('C4')->getFont()->setBold(true);
$sheet->getStyle('C4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getRowDimension(4)->setRowHeight(15);


$sheet->mergeCells('C5:F5');
$sheet->setCellValue('C5', 'MARAWOY LIPA CITY');
$sheet->getStyle('C5')->getFont()->setBold(true);
$sheet->getStyle('C5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getRowDimension(5)->setRowHeight(15);

$drawingChed = new Drawing();
$drawingChed->setName('Lipa Logo');
$drawingChed->setDescription('Lipa Logo');
$drawingChed->setPath($destinationLipaLogo);
$drawingChed->setHeight(100); // Set height of the image in points (pixels)
$drawingChed->setOffsetX(50);
$drawingChed->setCoordinates('B2'); // Position where the image should be placed

$drawingChed->setWorksheet($sheet);

$drawingChed = new Drawing();
$drawingChed->setName('KLL Logo');
$drawingChed->setDescription('KLL Logo');
$drawingChed->setPath($destinationKLLLogo);
$drawingChed->setHeight(100); 
$drawingChed->setCoordinates('G2'); 
$drawingChed->setOffsetX(-20);
$drawingChed->setWorksheet($sheet);

$sheet->mergeCells('F10:G10');
$sheet->setCellValue('F10', 'Date: ' . $formatDate);
$sheet->getStyle('F10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('D13');
$sheet->setCellValue('D13', 'CERTIFICATION');
$sheet->getStyle('D13')->getFont()->setBold(true);
$sheet->getStyle('D13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('B17:D17');
$sheet->setCellValue('B17', 'TO WHOM IT MAY CONCERN:');
$sheet->getStyle('B17')->getFont()->setBold(true);
$sheet->getStyle('B17')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('B19:G21');
$sheet->setCellValue('B19', 'This is to certify that the total number of TDP grantees by campus as shown below, are qualified to avail of the Tulong Dunong Program (TDP) under R.A. No. 10931 also known as Universal Access to Quality Tertiary Education (UAQTE) for the '.$semester.' of Academic Year '.$academic_year.', ');
$sheet->getStyle('B19')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('C23:D23');
$sheet->setCellValue('C23', 'Name of Campus');
$sheet->getStyle('C23')->getFont()->setBold(true);
$sheet->getStyle('C23')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('C24:D24');
$sheet->setCellValue('C24', 'Campus A');
$sheet->getStyle('C24')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('C25:D25');
$sheet->setCellValue('C25', 'Campus B');
$sheet->getStyle('C25')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('C26:D26');
$sheet->setCellValue('C26', '(Insert more rows for additional Campus)');
$sheet->getStyle('C26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('C27:D27');
$sheet->setCellValue('C27', 'Total');
$sheet->getStyle('C27')->getFont()->setBold(true);
$sheet->getStyle('C27')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('E23:F23');
$sheet->setCellValue('E23', 'Number of TDP Grantees');
$sheet->getStyle('E23')->getFont()->setBold(true);
$sheet->getStyle('E23')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('E24:F24');
$sheet->setCellValue('E24', $n);
$sheet->getStyle('E24')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('E25:F25');
$sheet->mergeCells('E26:F26');

$sheet->mergeCells('E27:F27');
$sheet->setCellValue('E27', $n);
$sheet->getStyle('E27')->getFont()->setBold(true);
$sheet->getStyle('E27')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('B30:G31');
$sheet->setCellValue('B30', 'This further certifies that the students’ information indicated in the billing statement of the Masterlist of Continuing TDP Grantees (Annex 6) is accurate and complete.');
$sheet->getStyle('B30')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('B33:G34');
$sheet->setCellValue('B33', 'This certification is being issued in accordance with the UniFAST Memorandum Circular (JMC) No. __ Series of 2022, on the Enhanced Guidelines of the Tulong Dunong Program (TDP).');
$sheet->getStyle('B33')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);


$sheet->mergeCells('F39');
$sheet->setCellValue('F39', 'Certified By:');
$sheet->getStyle('F39')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('E42:G42');
$sheet->setCellValue('E42', 'DELIA A. LIBREA');
$sheet->getStyle('E42')->getFont()->setBold(true);
$sheet->getStyle('E42')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$sheet->mergeCells('F47');
$sheet->setCellValue('F47', 'Approved By:');
$sheet->getStyle('F47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('E50:G50');
$sheet->setCellValue('E50', 'MARIO CARMELO A. PESA');
$sheet->getStyle('E50')->getFont()->setBold(true);
$sheet->getStyle('E50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


//-------------------------------------------------------------------

$sheet->getColumnDimension('A')->setWidth(5.78);
$sheet->getColumnDimension('B')->setWidth(13.78);
$sheet->getColumnDimension('C')->setWidth(13.78);
$sheet->getColumnDimension('D')->setWidth(22.11);
$sheet->getColumnDimension('E')->setWidth(13.78);
$sheet->getColumnDimension('F')->setWidth(13.78);
$sheet->getColumnDimension('G')->setWidth(17.78);
$sheet->getColumnDimension('H')->setWidth(6.67);


//--------------------------------------------------------------------------

$allBorderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
];

$sheet->getStyle('C23:F27')->applyFromArray($allBorderStyle);



//------------------------------------------------------------

// $sheet->getPageMargins()->setTop(1 / 2.54);
// $sheet->getPageMargins()->setLeft(1 / 2.54);
// $sheet->getPageMargins()->setRight(1 / 2.54);
// $sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:H55');

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>