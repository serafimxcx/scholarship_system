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
$filetitle = "";

if($_GET["slct_apptype"] == "New"){
    $filename = " Annex 5 - TES New Form 1";
    $filetitle = "CONSOLIDATED NEW TES BILLING STATEMENT";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TES Continuing Form 1 - Annex 2";
    $filetitle = "CONSOLIDATED CONTINUING TES BILLING STATEMENT";

}else{
    $filetitle = "CONSOLIDATED TES BILLING STATEMENT";
    $filename = "TES Form 1";
}

$total_accumulated = 0;
$n = 0;
$academic_year = "__________";
$semester = "__________";

while($row = mysqli_fetch_assoc($result)){
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);

    $allowance = openssl_decrypt($row["allowance"], $method, $key);

    $total_accumulated += floatval($allowance);
    $n++;

}
$support_amount = $total_accumulated*0.01;

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle($filename); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);

//----------------------------------------------------------------------------

$sheet->mergeCells('R1:X1');
$sheet->setCellValue('R1', $filename);
$sheet->getStyle('R1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('R1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('R1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('A2:X2');
$sheet->setCellValue('A2', 'Republic of the Philippines');
$sheet->getStyle('A2')->getFont()->setSize(12);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A3:X3');
$sheet->setCellValue('A3', 'KOLEHIYO NG LUNGSOD NG LIPA');
$sheet->getStyle('A3')->getFont()->setBold(true)->setItalic(true)->setSize(12);
$sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A4:X4');
$sheet->setCellValue('A4', 'MARAWOY LIPA CITY');
$sheet->getStyle('A4')->getFont()->setItalic(true)->setSize(12);
$sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$drawingChed = new Drawing();
$drawingChed->setName('CHED Logo');
$drawingChed->setDescription('CHED Logo');
$drawingChed->setPath($destinationChedLogo);
$drawingChed->setHeight(50); // Set height of the image in points (pixels)
$drawingChed->setCoordinates('I2'); // Position where the image should be placed
$drawingChed->setWorksheet($sheet);

$drawingChed = new Drawing();
$drawingChed->setName('Unifast Logo');
$drawingChed->setDescription('Unifast Logo');
$drawingChed->setPath($destinationUnifastLogo);
$drawingChed->setHeight(50); 
$drawingChed->setCoordinates('R2'); 
$drawingChed->setOffsetX(25);
$drawingChed->setWorksheet($sheet);

$sheet->mergeCells('A7:X7');
$sheet->setCellValue('A7', $filetitle);
$sheet->getStyle('A7')->getFont()->setBold(true)->setSize(20);
$sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A7')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('N8:S8');
$sheet->setCellValue('N8', 'TES Billing Statement Reference No.:');
$sheet->getStyle('N8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('N8')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->getRowDimension(8)->setRowHeight(20);

$sheet->mergeCells('T8:X8');


$sheet->mergeCells('N9:S9');
$sheet->setCellValue('N9', 'Date:');
$sheet->getStyle('N9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('N9')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->getRowDimension(9)->setRowHeight(20);


$sheet->mergeCells('T9:X9');
$sheet->setCellValue('T9', $formatDate);
$sheet->getStyle('T9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('T9')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A11:C11');
$sheet->setCellValue('A11', 'To');
$sheet->getStyle('A11')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('A11')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D11:X11');
$sheet->setCellValue('D11', 'CHED - Regional Office IV-A');
$sheet->getStyle('D11')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('D11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('D11')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A12:C12');
$sheet->setCellValue('A12', 'Address');
$sheet->getStyle('A12')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('A12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D12:X12');
$sheet->setCellValue('D12', 'Jose P. Laurel Highway, City Hall Compound, Barangay Marawoy, Lipa City');
$sheet->getStyle('D12')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('D12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('D12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A13:C35');
$sheet->setCellValue('A13', 'Responsibility Center');
$sheet->getStyle('A13')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_TOP);

$sheet->mergeCells('D13:R13');
$sheet->setCellValue('D13', 'CHED - Regional Officee _____');

$sheet->mergeCells('D14:R14');
$sheet->setCellValue('D14', 'Request for payment of the Tertiary Education Subsidy (TES) grant for '.$semester.',  ');

$sheet->mergeCells('D15:R15');
$sheet->setCellValue('D15', 'Academic Year '.$academic_year.' to be charged against the funds for Universal Access to Quality ');

$sheet->mergeCells('D16:R16');
$sheet->setCellValue('D16', 'Tertiary Education (UAQTE) under General Appropriation Act (GAA)  for Fiscal Year __________, ');

$sheet->mergeCells('D17:R17');
$sheet->setCellValue('D17', 'as per attached supporting documents ……..');

$sheet->mergeCells('D21:R21');
$sheet->setCellValue('D21', 'Total number of TES student-grantees in the Higher Education Institution (HEI): ');

$sheet->mergeCells('D22:R22');
$sheet->setCellValue('D22', '       TES-1 for all the TES student-grantees enrolled in the HEI');

$sheet->mergeCells('D23:R23');
$sheet->setCellValue('D23', '       TES-2 for all the TES student-grantees enrolled in the HEI');

$sheet->mergeCells('D24:R24');
$sheet->setCellValue('D24', '       TES-3a for all TES student-grantees with disability enrolled in the HEI');

$sheet->mergeCells('D25:R25');
$sheet->setCellValue('D25', 'Total Amount');

$sheet->mergeCells('D26:R26');
$sheet->setCellValue('D26', '       Add:  1 percent (1%) Administrative Support Cost (ASC) for partner HEI');

$sheet->mergeCells('D27:R27');
$sheet->setCellValue('D27', 'TOTAL:  TES Billing Amount');
$sheet->getStyle('D27')->getFont()->setBold(true);

$sheet->mergeCells('D29:R29');
$sheet->setCellValue('D29', 'Basis for the Tertiary Education Subsidy: Section 23, Rule IV, IRR of R.A. No. 10931');

$sheet->mergeCells('S13:U13');
$sheet->setCellValue('S13', 'Account Code');
$sheet->getStyle('S13')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('S20:U20');

$sheet->mergeCells('S21:U21');
$sheet->setCellValue('S21', $n);
$sheet->getStyle('S21')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);


$sheet->mergeCells('S22:U22');
$sheet->setCellValue('S22', 'Php');

$sheet->mergeCells('S23:U23');
$sheet->setCellValue('S23', 'Php    '. number_format($total_accumulated, 2, ".", ","));

$sheet->mergeCells('S24:U24');
$sheet->setCellValue('S24', 'Php');

$sheet->mergeCells('S25:U25');
$sheet->setCellValue('S25', 'Php    '. number_format($total_accumulated, 2, ".", ","));

$sheet->mergeCells('S26:U26');
$sheet->setCellValue('S26', 'Php    '. number_format(floatval($support_amount), 2, ".", ","));

$sheet->mergeCells('S27:U27');
$sheet->setCellValue('S27', 'Php    '. number_format($support_amount+$total_accumulated, 2, ".", ","));

$sheet->mergeCells('S28:U28');

$sheet->mergeCells('V13:X13');
$sheet->setCellValue('V13', 'Amount');
$sheet->getStyle('V13')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('V16:X16');
$sheet->setCellValue('V16', 'Php    '. number_format($support_amount+$total_accumulated, 2, ".", ","));

$sheet->mergeCells('S29:X29');
$sheet->setCellValue('S29', 'Action to be taken');
$sheet->getStyle('S29')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('S30:X30');
$sheet->setCellValue('S30', '(To be approved by CHEDRO)');
$sheet->getStyle('S30')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('S31:U33');
$sheet->setCellValue('S31', 'Php');
$sheet->getStyle('S31')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('V31:X33');
$sheet->setCellValue('V31', 'Excess (deficient) billing noted for further action');
$sheet->getStyle('V31')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);

$sheet->mergeCells('S34:U35');
$sheet->setCellValue('S34', 'Php');
$sheet->getStyle('S34')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('V34:X35');
$sheet->setCellValue('V34', 'Approved for payment');
$sheet->getStyle('V34')->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);

$sheet->mergeCells('A36:M36');
$sheet->setCellValue('A36', 'Certified ');
$sheet->getStyle('A36')->getFont()->setBold(true);
$sheet->getStyle('A36')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->getRowDimension(37)->setRowHeight(5);

$sheet->mergeCells('C38:M38');
$sheet->setCellValue('C38', 'Supporting documents complete and amount claimed proper. ');
$sheet->getStyle('C38')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('B40:M40');
$sheet->setCellValue('B40', 'Is this the last batch of billing for this term of A.Y. '.$academic_year);
$sheet->getStyle('B40')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->getRowDimension(41)->setRowHeight(2);

$sheet->setCellValue('D42', 'Yes');
$sheet->setCellValue('G42', 'No');

$sheet->mergeCells('N36:X36');
$sheet->setCellValue('N36', 'Approved ');
$sheet->getStyle('N36')->getFont()->setBold(true);
$sheet->getStyle('N36')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('A44:C45');
$sheet->setCellValue('A44', 'Signature ');
$sheet->getStyle('A44')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D44:M45');

$sheet->mergeCells('N44:P45');
$sheet->setCellValue('N44', 'Signature ');
$sheet->getStyle('N45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q44:X45');

$sheet->mergeCells('A46:C47');
$sheet->setCellValue('A46', 'Printed Name ');
$sheet->getStyle('A46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D46:M47');
$sheet->setCellValue('D46', 'TERESITA V. ESPLAGO');
$sheet->getStyle('D46')->getFont()->setBold(true);
$sheet->getStyle('D46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N46:P47');
$sheet->setCellValue('N46', 'Printed Name ');
$sheet->getStyle('N46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q46:X47');
$sheet->setCellValue('Q46', 'MARIO CARMELO A. PESA');
$sheet->getStyle('Q46')->getFont()->setBold(true);
$sheet->getStyle('Q46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A48:C49');
$sheet->setCellValue('A48', 'Position');
$sheet->getStyle('A48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D48:M48');
$sheet->setCellValue('D48', 'Vice President for Administration, Planning & Finance');
$sheet->getStyle('D48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->mergeCells('D49:M49');
$sheet->setCellValue('D49', 'Head, Accounting/Authorized Representative');
$sheet->getStyle('D49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N48:P49');
$sheet->setCellValue('N48', 'Position');
$sheet->getStyle('N48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q48:X48');
$sheet->setCellValue('Q48', 'College Administrator');
$sheet->getStyle('Q48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->mergeCells('Q49:X49');
$sheet->setCellValue('Q49', 'President/Authorized Representative');
$sheet->getStyle('Q49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A50:C51');
$sheet->setCellValue('A50', 'Date');
$sheet->getStyle('A50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D50:M51');
$sheet->setCellValue('D50', $formatDate);
$sheet->getStyle('D50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N50:P51');
$sheet->setCellValue('N50', 'Date');
$sheet->getStyle('N50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q50:X51');
$sheet->setCellValue('Q50', $formatDate);
$sheet->getStyle('Q50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A52:M52');
$sheet->mergeCells('N52:X52');

$sheet->mergeCells('A53:M53');
$sheet->setCellValue('A53', 'INSTRUCTIONS');
$sheet->getStyle('A53')->getFont()->setBold(true);

$sheet->mergeCells('A54:M54');
$sheet->setCellValue('A54', '1. The HEIs are allowed a maximum of two (2) tranches of payments per semester.');

$sheet->mergeCells('A56:M56');
$sheet->setCellValue('A56', '2. The TES statement reference number shall comprise of the REGIONAL CODE (2-digit),');

$sheet->mergeCells('A57:M57');
$sheet->setCellValue('A57', 'HEI CODE (alpha codes), ACADEMIC YEAR (4-digit), TERM (1-digit), ');

$sheet->mergeCells('A58:M58');
$sheet->setCellValue('A58', 'and BATCH NUMBER (1 digit).  The description and codes are provided below:');

$sheet->mergeCells('A60:M60');
$sheet->setCellValue('A60', 'Regional Codes');
$sheet->getStyle('A60')->getFont()->setBold(true);

$sheet->mergeCells('A61:B61');
$sheet->setCellValue('A61', 'Region');
$sheet->getStyle('A61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('A61')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('A62:B62');
$sheet->setCellValue('A62', 'Region 01');
$sheet->getStyle('A62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A63:B63');
$sheet->setCellValue('A63', 'Region 02');
$sheet->getStyle('A63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A64:B64');
$sheet->setCellValue('A64', 'Region 03');
$sheet->getStyle('A64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A65:B65');
$sheet->setCellValue('A65', 'Region 4A');
$sheet->getStyle('A65')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A66:B66');
$sheet->setCellValue('A66', 'Region 4B');
$sheet->getStyle('A66')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A67:B67');
$sheet->setCellValue('A67', 'Region 05');
$sheet->getStyle('A67')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('C61:E61');
$sheet->setCellValue('C61', 'Code');
$sheet->getStyle('C61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('C61')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('C62:E62');
$sheet->setCellValue('C62', '01');
$sheet->getStyle('C62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C63:E63');
$sheet->setCellValue('C63', '02');
$sheet->getStyle('C63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C64:E64');
$sheet->setCellValue('C64', '03');
$sheet->getStyle('C64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C65:E65');
$sheet->setCellValue('C65', '04');
$sheet->getStyle('C65')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C66:E66');
$sheet->setCellValue('C66', 'MIMAROPA');
$sheet->getStyle('C66')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C67:E67');
$sheet->setCellValue('C67', '05');
$sheet->getStyle('C67')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('F61:G61');
$sheet->setCellValue('F61', 'Region');
$sheet->getStyle('F61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('F61')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('F62:G62');
$sheet->setCellValue('F62', 'Region 06');
$sheet->getStyle('F62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F63:G63');
$sheet->setCellValue('F63', 'Region 07');
$sheet->getStyle('F63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F64:G64');
$sheet->setCellValue('F64', 'Region 08');
$sheet->getStyle('F64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F65:G65');
$sheet->setCellValue('F65', 'Region 09');
$sheet->getStyle('F65')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F66:G66');
$sheet->setCellValue('F66', 'Region 10');
$sheet->getStyle('F66')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F67:G67');
$sheet->setCellValue('F67', 'Region 11');
$sheet->getStyle('F67')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('H61');
$sheet->setCellValue('H61', 'Code');
$sheet->getStyle('H61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('H61')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('H62');
$sheet->setCellValue('H62', '06');
$sheet->getStyle('H62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H63');
$sheet->setCellValue('H63', '07');
$sheet->getStyle('H63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H64');
$sheet->setCellValue('H64', '08');
$sheet->getStyle('H64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H65');
$sheet->setCellValue('H65', '09');
$sheet->getStyle('H65')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H66');
$sheet->setCellValue('H66', '10');
$sheet->getStyle('H66')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H67');
$sheet->setCellValue('H67', '11');
$sheet->getStyle('H7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('J61:K61');
$sheet->setCellValue('J61', 'Region');
$sheet->getStyle('J61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('J61')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('J62:K62');
$sheet->setCellValue('J62', 'Region 12');
$sheet->getStyle('J62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J63:K63');
$sheet->setCellValue('J63', 'NCR');
$sheet->getStyle('J63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J64:K64');
$sheet->setCellValue('J64', 'CARAGA');
$sheet->getStyle('J64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J65:K65');
$sheet->setCellValue('J65', 'BARMM');
$sheet->getStyle('J65')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J66:K66');
$sheet->setCellValue('J66', 'CAR');
$sheet->getStyle('J66')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('L61:M61');
$sheet->setCellValue('L61', 'Code');
$sheet->getStyle('L61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('L61')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('L62:M62');
$sheet->setCellValue('L62', '12');
$sheet->getStyle('L62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L63:M63');
$sheet->setCellValue('L63', 'NCR');
$sheet->getStyle('L63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L64:M64');
$sheet->setCellValue('L64', 'CARAGA');
$sheet->getStyle('L64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L65:M65');
$sheet->setCellValue('L65', 'BARMM');
$sheet->getStyle('L65')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L66:M66');
$sheet->setCellValue('L66', 'CAR');
$sheet->getStyle('L66')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A69:M69');
$sheet->setCellValue('A69', '" HEI Code" shall be the Acronym used by the HEI for its institution.');

$sheet->mergeCells('A70:M70');
$sheet->setCellValue('A70', 'e.g.  Jose Rizal University - JRU');

$sheet->mergeCells('A72:M72');
$sheet->setCellValue('A72', '"Academic Year" - the year when the AY began (e.g. 2020 for AY 2020-2021).');

$sheet->mergeCells('N54:X54');
$sheet->setCellValue('N54', '"Term" refers to the academic year semester or terms: ');

$sheet->mergeCells('P55:R55');
$sheet->setCellValue('P55', 'Term ');
$sheet->getStyle('P55')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('P55')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('P56:R56');
$sheet->setCellValue('P56', '1st Semester ');
$sheet->getStyle('P56')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('P57:R57');
$sheet->setCellValue('P57', '2nd Semester ');
$sheet->getStyle('P57')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->setCellValue('S55', 'Code ');
$sheet->getStyle('S55')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('S55')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->setCellValue('S56', '1');
$sheet->getStyle('S56')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('S57', '2');
$sheet->getStyle('S57')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('U55:W55');
$sheet->setCellValue('U55', 'Term ');
$sheet->getStyle('U55')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('U55')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('U56:W56');
$sheet->setCellValue('U56', '3rd Semester ');
$sheet->getStyle('U56')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('U57:W57');
$sheet->setCellValue('U57', 'Summer ');
$sheet->getStyle('U57')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('X55', 'Code ');
$sheet->getStyle('X55')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('X55')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->setCellValue('X56', '3');
$sheet->getStyle('X56')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('X57', '3');
$sheet->getStyle('X57')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N59:X59');
$sheet->setCellValue('N59', '"Batch" refers to the number of times the HEI bills the CHED within a semester. ');

$sheet->mergeCells('N60:X60');
$sheet->setCellValue('N60', 'Note that the HEIs can only bill the CHED up to two (2) batches per semester.');
$sheet->getStyle('N60')->getFont()->setBold(true);

$sheet->mergeCells('N62:X62');
$sheet->setCellValue('N62', 'Examples of a billing statement no.');
$sheet->getStyle('N60')->getFont()->setUnderline(true);

$sheet->mergeCells('N63:X63');
$sheet->setCellValue('N63', 'The first batch of TES statement submitted by JRU in 1st sem AY 2020-2021:');

$sheet->mergeCells('N65:X65');
$sheet->setCellValue('N65', 'The second batch of TES statement submitted by Jose Rizal University in the First Semester');

$sheet->mergeCells('N66:X66');
$sheet->setCellValue('N66', 'for AY 2020 - 2021');

$sheet->mergeCells('N67:X67');
$sheet->setCellValue('N67', '           NCR-JRU-2020-1-1');
$sheet->getStyle('N67')->getFont()->setBold(true);

$sheet->mergeCells('N69:X69');
$sheet->setCellValue('N69', '3. Submit a printed copy of complete TES Statement Form (Form 1) including other required  ');

$sheet->mergeCells('N70:X70');
$sheet->setCellValue('N70', 'documents and a cover letter address to:');

$sheet->mergeCells('N71:X71');
$sheet->setCellValue('N71', 'Name of Regional Director');
$sheet->getStyle('N71')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N72:X72');
$sheet->setCellValue('N72', 'Position');
$sheet->getStyle('N72')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N73:X73');
$sheet->setCellValue('N73', 'Region');
$sheet->getStyle('N73')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);


//-----------------------------------------------------------------------------------

$columns = range('A', 'X');
foreach ($columns as $column) {
    $width = 5;
    if (in_array($column, ['M',  'X', 'R'])) {
        $width = 14;
    }

    $sheet->getColumnDimension($column)->setWidth($width);
}



//---------------------------------------------------------------------

$allBorderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '000000'],
        ],
    ],
];

$leftBorderStyle = [
    'borders' => [
        'left' => [
           'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '000000'],
        ]
        
    ],
];

$rightBorderStyle = [
    'borders' => [
        'right' => [
           'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '000000'],
        ]
        
    ],
];


$topBorderStyle = [
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '000000'],
        ]
    ],
];

$bottomBorderStyle = [
    'borders' => [
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '000000'],
        ]
    ],
];

$thin_bottomBorderStyle = [
    'borders' => [
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ]
    ],
];

$sheet->getStyle('R1:X1')->applyFromArray($allBorderStyle);

$sheet->getStyle('A1:X1')->applyFromArray($topBorderStyle);
$sheet->getStyle('A1:X10')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A1:X10')->applyFromArray($rightBorderStyle);

$sheet->getStyle('T8:X8')->applyFromArray($thin_bottomBorderStyle);
$sheet->getStyle('T9:X9')->applyFromArray($thin_bottomBorderStyle);

$sheet->getStyle('A11:X12')->applyFromArray($allBorderStyle);

$sheet->getStyle('A13:C35')->applyFromArray($allBorderStyle);
$sheet->getStyle('D13:R35')->applyFromArray($leftBorderStyle);
$sheet->getStyle('D13:R35')->applyFromArray($rightBorderStyle);

$sheet->getStyle('D19:X19')->applyFromArray($bottomBorderStyle);
$sheet->getStyle('D28:X28')->applyFromArray($bottomBorderStyle);
$sheet->getStyle('D35:X35')->applyFromArray($bottomBorderStyle);

$sheet->getStyle('S13:U19')->applyFromArray($leftBorderStyle);
$sheet->getStyle('S13:U19')->applyFromArray($rightBorderStyle);

$sheet->getStyle('S20:U28')->applyFromArray($rightBorderStyle);

$sheet->getStyle('V13:X28')->applyFromArray($rightBorderStyle);

$sheet->getStyle('S29:X30')->applyFromArray($rightBorderStyle);

$sheet->getStyle('S31:X35')->applyFromArray($allBorderStyle);

$sheet->getStyle('A44:X52')->applyFromArray($allBorderStyle);


for($i = 36; $i <= 43; $i++){
    $sheet->getStyle('A'.$i.':M'.$i)->applyFromArray($leftBorderStyle);
    $sheet->getStyle('A'.$i.':M'.$i)->applyFromArray($rightBorderStyle);
}

$sheet->getStyle('B38')->applyFromArray($allBorderStyle);
$sheet->getStyle('C42')->applyFromArray($allBorderStyle);
$sheet->getStyle('F42')->applyFromArray($allBorderStyle);

$sheet->getStyle('N36:X43')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A53:M74')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A53:M74')->applyFromArray($rightBorderStyle);

$sheet->getStyle('N53:X74')->applyFromArray($leftBorderStyle);
$sheet->getStyle('N53:X74')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A74:X74')->applyFromArray($bottomBorderStyle);

//---------------------------------------------------------------------------------------------

$sheet->getPageMargins()->setTop(1 / 2.54);
$sheet->getPageMargins()->setLeft(1 / 2.54);
$sheet->getPageMargins()->setRight(1 / 2.54);
$sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:X74');

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>