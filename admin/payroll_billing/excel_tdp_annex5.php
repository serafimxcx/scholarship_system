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
    $filename = "New TDP Form 1 - Annex 7";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TDP Continuing Form 1 - Annex 5";

}

$total_accumulated = 0;
$n = 0;

$academic_year = "__________";
$semester = "__________";

while($row = mysqli_fetch_assoc($result)){
    
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);

    $first_semester = openssl_decrypt($row["1st_semester"], $method, $key);
    $second_semester = openssl_decrypt($row["2nd_semester"], $method, $key);

    if ($row["1st_semester"] !== null) {
    $total_accumulated += floatval($first_semester);

    }else{
    $total_accumulated += 0;
    }
    
    if ($row["2nd_semester"] !== null) {
    $total_accumulated += floatval($second_semester);


    }else{
    $total_accumulated += 0;
    
    
    }   

    $n++;

}

$support_amount = $total_accumulated * 0.005;
$format_support = number_format(floatval($support_amount), 2, ".", ",");
$format_total = number_format($total_accumulated, 2, ".", ",");

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle($filename); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

//----------------------------------------------------------------------------


// Merge cells for the header
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
$drawingChed->setCoordinates('J2'); // Position where the image should be placed
$drawingChed->setOffsetX(100);
$drawingChed->setWorksheet($sheet);

$drawingChed = new Drawing();
$drawingChed->setName('Unifast Logo');
$drawingChed->setDescription('Unifast Logo');
$drawingChed->setPath($destinationUnifastLogo);
$drawingChed->setHeight(50); 
$drawingChed->setCoordinates('P2'); 
$drawingChed->setWorksheet($sheet);

$sheet->mergeCells('A7:X7');
$sheet->setCellValue('A7', 'CONSOLIDATED TDP BILLING STATEMENT');
$sheet->getStyle('A7')->getFont()->setBold(true)->setSize(20);
$sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A7')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('N8:S8');
$sheet->setCellValue('N8', 'TDP-TES Billing Statement Reference No.:');
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
$sheet->setCellValue('D11', 'CHED - Regional Office___');
$sheet->getStyle('D11')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('D11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('D11')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A12:C12');
$sheet->setCellValue('A12', 'Address');
$sheet->getStyle('A12')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('A12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D12:X12');
$sheet->setCellValue('D12', 'CHED Region IVA Bldg. Jose P. Laurel Highway');
$sheet->getStyle('D12')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('D12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('D12')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A13:C13');
$sheet->mergeCells('D13:X13');

$sheet->mergeCells('A14:C32');
$sheet->setCellValue('A14', 'Responsibility Center');
$sheet->getStyle('A14')->getFont()->setSize(12);
$sheet->getStyle('A14')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_TOP);


$sheet->mergeCells('D14:R14');
$sheet->setCellValue('D14', 'CHED - Regional Officee _____');
$sheet->getStyle('D14')->getFont()->setSize(12);
$sheet->getStyle('D14')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('D15:R20');
$sheet->setCellValue('D15', "Request for payment of the Tulong Dungong Program - Tertiary Education Subsidy (TDP-TES) grant for 1st semester,  Academic Year 2022-2023 to be charged against the funds for Universal Access to Quality Tertiary Education (UAQTE) under General Appropriation Act (GAA)  for Fiscal Year __________, as per attached supporting documents\n"."
a) Certificate of Registration (COR) (PDF File only)\n"."
b) Photocopy of ID with signature (PDF FIle only)\n"."
c) Certified true copy of grades\n\n");
$sheet->getRowDimension(20)->setRowHeight(35);
$sheet->getStyle('D15')->getFont()->setSize(11);
$sheet->getStyle('D15')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('S14:U14');
$sheet->setCellValue('S14', 'Account Code');
$sheet->getStyle('S14')->getFont()->setSize(12);
$sheet->getStyle('S14')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('S15:U20');

$sheet->mergeCells('V14:X14');
$sheet->setCellValue('V14', 'Amount');
$sheet->getStyle('V14')->getFont()->setSize(12);
$sheet->getStyle('V14')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('V15:X20');
$sheet->setCellValue('V15', 'PhP '.$format_total);
$sheet->getStyle('V15')->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('V15')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D22:R22');
$sheet->setCellValue('D22', 'Total number of TDP-TES student-grantees in the Higher Education Institution (HEI): ');
$sheet->getStyle('D22')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D23:R23');
$sheet->setCellValue('D23', 'Add .5 percent (.005%) Administrative Support for Partner Institutions ');
$sheet->getStyle('D23')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D24:R24');
$sheet->setCellValue('D24', 'TOTAL:  TDP-TES Billing Amount ');
$sheet->getStyle('D24')->getFont()->setBold(true);
$sheet->getStyle('D24')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D26:R32');
$sheet->setCellValue('D26', 'Basis for the Tertiary Education Subsidy: Section 23, Rule IV, IRR of R.A. No. 10931');
$sheet->getStyle('D26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_TOP);

$sheet->mergeCells('S21:U21');

$sheet->mergeCells('S22:U22');
$sheet->setCellValue('S22', $n);
$sheet->getStyle('S22')->getFont()->setBold(true);
$sheet->getStyle('S22')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('S23:U23');
$sheet->setCellValue('S23', 'PhP '.$format_support);
$sheet->getStyle('S23')->getFont()->setBold(true);
$sheet->getStyle('S23')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('S24:U24');
$sheet->setCellValue('S24', 'PhP '.$format_total);
$sheet->getStyle('S24')->getFont()->setBold(true);
$sheet->getStyle('S24')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('S25:U25');
$sheet->mergeCells('V21:X25');

$sheet->mergeCells('S26:X26');
$sheet->setCellValue('S26', 'Action to be taken');
$sheet->getStyle('S26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('S27:X27');
$sheet->setCellValue('S27', '(To be approved by CHEDRO)');
$sheet->getStyle('S27')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('S28:U30');
$sheet->setCellValue('S28', 'PhP');
$sheet->getStyle('S28')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('V28:X30');
$sheet->setCellValue('V28', 'Excess (deficient) billing noted for further action');
$sheet->getStyle('V28')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_TOP)->setWrapText(true);

$sheet->mergeCells('S31:U32');
$sheet->setCellValue('S31', 'PhP');
$sheet->getStyle('S31')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('V31:X32');
$sheet->setCellValue('V31', 'Approved for payment');
$sheet->getStyle('V31')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A33:M33');
$sheet->setCellValue('A33', 'Certified ');
$sheet->getStyle('A33')->getFont()->setBold(true);
$sheet->getStyle('A33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->getRowDimension(34)->setRowHeight(5);

$sheet->mergeCells('C35:M35');
$sheet->setCellValue('C35', 'Supporting documents complete and amount claimed proper. ');
$sheet->getStyle('C35')->getFont()->setBold(true);
$sheet->getStyle('C35')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('B37:M37');
$sheet->setCellValue('B37', 'Is this the last batch of billing for this term of A.Y. '.$academic_year);
$sheet->getStyle('B37')->getFont()->setBold(true);
$sheet->getStyle('B37')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->getRowDimension(38)->setRowHeight(2);

$sheet->setCellValue('D39', 'Yes');
$sheet->setCellValue('G39', 'No');

$sheet->mergeCells('N33:X33');
$sheet->setCellValue('N33', 'Approved ');
$sheet->getStyle('N33')->getFont()->setBold(true);
$sheet->getStyle('N33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A41:C42');
$sheet->setCellValue('A41', 'Signature ');
$sheet->getStyle('A41')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D41:M42');

$sheet->mergeCells('N41:P42');
$sheet->setCellValue('N41', 'Signature ');
$sheet->getStyle('N41')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q41:X42');

$sheet->mergeCells('A43:C44');
$sheet->setCellValue('A43', 'Printed Name ');
$sheet->getStyle('A43')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D43:M44');
$sheet->setCellValue('D43', 'TERESITA V. ESPLAGO');
$sheet->getStyle('D43')->getFont()->setBold(true);
$sheet->getStyle('D43')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N43:P44');
$sheet->setCellValue('N43', 'Printed Name ');
$sheet->getStyle('N43')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q43:X44');
$sheet->setCellValue('Q43', 'MARIO CARMELO A. PESA');
$sheet->getStyle('Q43')->getFont()->setBold(true);
$sheet->getStyle('Q43')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A45:C46');
$sheet->setCellValue('A45', 'Position');
$sheet->getStyle('A45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D45:M45');
$sheet->setCellValue('D45', 'Vice President for Administration, Planning & Finance');
$sheet->getStyle('D45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->mergeCells('D46:M46');
$sheet->setCellValue('D46', 'Head, Accounting/Authorized Representative');
$sheet->getStyle('D46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N45:P46');
$sheet->setCellValue('N45', 'Position');
$sheet->getStyle('N45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q45:X45');
$sheet->setCellValue('Q45', 'College Administrator');
$sheet->getStyle('Q45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->mergeCells('Q46:X46');
$sheet->setCellValue('Q46', 'President/Authorized Representative');
$sheet->getStyle('Q46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A47:C48');
$sheet->setCellValue('A47', 'Date');
$sheet->getStyle('A47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('D47:M48');
$sheet->setCellValue('D47', $formatDate);
$sheet->getStyle('D47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N47:P48');
$sheet->setCellValue('N47', 'Date');
$sheet->getStyle('N47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('Q47:X48');
$sheet->setCellValue('Q47', $formatDate);
$sheet->getStyle('Q47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A49:M49');
$sheet->mergeCells('N49:X49');

$sheet->mergeCells('A50:M50');
$sheet->setCellValue('A50', 'INSTRUCTIONS:');
$sheet->getStyle('A50')->getFont()->setBold(true);
$sheet->getStyle('A50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A51:M52');

$sheet->mergeCells('A53:M53');
$sheet->setCellValue('A53', 'The TDP-TES statement reference number shall comprise of the REGIONAL CODE (2-digit),');
$sheet->getStyle('A53')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A54:M54');
$sheet->setCellValue('A54', 'HEI CODE (alpha codes), ACADEMIC YEAR (4-digit), TERM (1-digit),');
$sheet->getStyle('A54')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A55:M55');
$sheet->setCellValue('A55', 'and BATCH NUMBER (1 digit).  The Descrption and codes are provided below:');
$sheet->getStyle('A55')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A56:M56');

$sheet->mergeCells('A57:M57');
$sheet->setCellValue('A57', 'Regional Code:');
$sheet->getStyle('A57')->getFont()->setBold(true);
$sheet->getStyle('A57')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A58:B58');
$sheet->setCellValue('A58', 'Region');
$sheet->getStyle('A58')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('A58')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('A59:B59');
$sheet->setCellValue('A59', 'Region 01');
$sheet->getStyle('A59')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A60:B60');
$sheet->setCellValue('A60', 'Region 02');
$sheet->getStyle('A60')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A61:B61');
$sheet->setCellValue('A61', 'Region 03');
$sheet->getStyle('A61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A62:B62');
$sheet->setCellValue('A62', 'Region 4A');
$sheet->getStyle('A62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A63:B63');
$sheet->setCellValue('A63', 'Region 4B');
$sheet->getStyle('A63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A64:B64');
$sheet->setCellValue('A64', 'Region 05');
$sheet->getStyle('A64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('C58:E58');
$sheet->setCellValue('C58', 'Code');
$sheet->getStyle('C58')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('C58')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('C59:E59');
$sheet->setCellValue('C59', '01');
$sheet->getStyle('C59')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C60:E60');
$sheet->setCellValue('C60', '02');
$sheet->getStyle('C60')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C61:E61');
$sheet->setCellValue('C61', '03');
$sheet->getStyle('C61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C62:E62');
$sheet->setCellValue('C62', '04');
$sheet->getStyle('C62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C63:E63');
$sheet->setCellValue('C63', 'MIMAROPA');
$sheet->getStyle('C63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C64:E64');
$sheet->setCellValue('C64', '05');
$sheet->getStyle('C64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('F58:G58');
$sheet->setCellValue('F58', 'Region');
$sheet->getStyle('F58')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('F58')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('F59:G59');
$sheet->setCellValue('F59', 'Region 06');
$sheet->getStyle('F59')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F60:G60');
$sheet->setCellValue('F60', 'Region 07');
$sheet->getStyle('F60')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F61:G61');
$sheet->setCellValue('F61', 'Region 08');
$sheet->getStyle('F61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F62:G62');
$sheet->setCellValue('F62', 'Region 09');
$sheet->getStyle('F62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F63:G63');
$sheet->setCellValue('F63', 'Region 10');
$sheet->getStyle('F63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F64:G64');
$sheet->setCellValue('F64', 'Region 11');
$sheet->getStyle('F64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('H58');
$sheet->setCellValue('H58', 'Code');
$sheet->getStyle('H58')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('H58')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('H59');
$sheet->setCellValue('H59', '06');
$sheet->getStyle('H59')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H60');
$sheet->setCellValue('H60', '07');
$sheet->getStyle('H60')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H61');
$sheet->setCellValue('H61', '08');
$sheet->getStyle('H61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H62');
$sheet->setCellValue('H62', '09');
$sheet->getStyle('H62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H63');
$sheet->setCellValue('H63', '10');
$sheet->getStyle('H63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H64');
$sheet->setCellValue('H64', '11');
$sheet->getStyle('H64')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('J58');
$sheet->setCellValue('J58', 'Region');
$sheet->getStyle('J58')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('J58')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('J59');
$sheet->setCellValue('J59', 'Region 12');
$sheet->getStyle('J59')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J60');
$sheet->setCellValue('J60', 'NCR');
$sheet->getStyle('J60')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J61');
$sheet->setCellValue('J61', 'CARAGA');
$sheet->getStyle('J61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J62');
$sheet->setCellValue('J62', 'BARMM');
$sheet->getStyle('J62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J63');
$sheet->setCellValue('J63', 'CAR');
$sheet->getStyle('J63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('K58');
$sheet->setCellValue('K58', 'Code');
$sheet->getStyle('K58')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('K58')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('K59');
$sheet->setCellValue('K59', '12');
$sheet->getStyle('K59')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('K60');
$sheet->setCellValue('K60', 'NCR');
$sheet->getStyle('K60')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('K61');
$sheet->setCellValue('K61', 'CARAGA');
$sheet->getStyle('K61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('K62');
$sheet->setCellValue('K62', 'BARMM');
$sheet->getStyle('K62')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('K63');
$sheet->setCellValue('K63', 'CAR');
$sheet->getStyle('K63')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A65:M65');

$sheet->mergeCells('A66:M66');
$sheet->setCellValue('A66', '" HEI Code" shall be the Acronym used by the HEI for their institution.');
$sheet->getStyle('A66')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('A66')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); 

$sheet->mergeCells('A67:M67');
$sheet->setCellValue('A67', 'e.g.  Jose Rizal University - JRU');
$sheet->getStyle('A67')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A68:M68');

$sheet->mergeCells('A69:M69');
$sheet->setCellValue('A69', '"Academic Year" will use the year when the AY began (e.g. 2020 for AY 2020-2021).');
$sheet->getStyle('A69')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A70:M71');

//N TO X
$sheet->mergeCells('N50:X50');

$sheet->mergeCells('N51:X51');
$sheet->setCellValue('N51', '"Term" refers to the academic year semester or terms: ');
$sheet->getStyle('N51')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('P52:R52');
$sheet->setCellValue('P52', 'Term ');
$sheet->getStyle('P52')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('P52')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('P53:R53');
$sheet->setCellValue('P53', '1st Semester ');
$sheet->getStyle('P53')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('P54:R54');
$sheet->setCellValue('P54', '2nd Semester ');
$sheet->getStyle('P54')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->setCellValue('S52', 'Code ');
$sheet->getStyle('S52')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('S52')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->setCellValue('S53', '1');
$sheet->getStyle('S53')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('S54', '2');
$sheet->getStyle('S54')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('U52:W52');
$sheet->setCellValue('U52', 'Term ');
$sheet->getStyle('U52')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('U52')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('U53:W53');
$sheet->setCellValue('U53', '3rd Semester ');
$sheet->getStyle('U53')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('U54:W54');
$sheet->setCellValue('U54', 'Summer ');
$sheet->getStyle('U54')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('X52', 'Code ');
$sheet->getStyle('X52')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('X52')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->setCellValue('X53', '3');
$sheet->getStyle('X53')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('X54', '3');
$sheet->getStyle('X54')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N55:X55');

$sheet->mergeCells('N56:X56');
$sheet->setCellValue('N56', '"Batch" refers to the number of times the HEI bills the CHED within a semester. ');
$sheet->getStyle('N56')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('N56')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); 

$sheet->mergeCells('N57:X57');
$sheet->setCellValue('N57', 'Note that the HEIs may bill the CHED no more than two (2) batches per semester.');
$sheet->getStyle('N57')->getFont()->setBold(true);
$sheet->getStyle('N57')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N58:X58');

$sheet->mergeCells('N59:X59');
$sheet->setCellValue('N59', 'Examples of a billing statement no.');
$sheet->getStyle('N59')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('N59')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('N60:X60');
$sheet->setCellValue('N60', 'The first batch of TDP-TES statement submitted by JRU in 1st sem AY 2020-2021:');
$sheet->getStyle('N60')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N61:X61');
$sheet->setCellValue('N61', 'NCR-JRU-2020-1-1');
$sheet->getStyle('N61')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('N61')->getAlignment()->setIndent(1);

$sheet->mergeCells('N62:X64');

$sheet->mergeCells('N65:X66');
$sheet->setCellValue('N65', 'Submit a printed copy of completed TES Statement Form (Form 1) together with other required documents and a cover letter address to:');
$sheet->getStyle('N65')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_TOP);

$sheet->mergeCells('N67:X67');
$sheet->setCellValue('N67', 'Name of Regional Director');
$sheet->getStyle('N67')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('N67')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); 

$sheet->mergeCells('N68:X68');
$sheet->setCellValue('N68', 'Position');
$sheet->getStyle('N68')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('N68')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); 

$sheet->mergeCells('N69:X69');
$sheet->setCellValue('N69', 'Region');
$sheet->getStyle('N69')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('N69')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); 

$sheet->mergeCells('N70:X71');


//---------------------------------------------------------------------------------------------------------------

// Adjust column widths
$columns = range('A', 'X');
foreach ($columns as $column) {
    $width = 5;
    if (in_array($column, ['J', 'K', 'M', 'R', 'X'])) {
        $width = 15;
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

$sheet->getStyle('A1:X1')->applyFromArray($topBorderStyle);

for($i = 1; $i <= 10; $i++){
    $sheet->getStyle('A'.$i.':X'.$i)->applyFromArray($leftBorderStyle);
    $sheet->getStyle('A'.$i.':X'.$i)->applyFromArray($rightBorderStyle);
}


for($i = 11; $i <= 13; $i++){

    $sheet->getStyle('A'.$i.':C'.$i)->applyFromArray($allBorderStyle);
    $sheet->getStyle('D'.$i.':X'.$i)->applyFromArray($allBorderStyle);
}

$sheet->getStyle('T8:X8')->applyFromArray($thin_bottomBorderStyle);
$sheet->getStyle('T9:X9')->applyFromArray($thin_bottomBorderStyle);

$sheet->getStyle('A14:C32')->applyFromArray($allBorderStyle);
$sheet->getStyle('D14:R32')->applyFromArray($rightBorderStyle);
$sheet->getStyle('S14:U20')->applyFromArray($rightBorderStyle);
$sheet->getStyle('V14:X20')->applyFromArray($rightBorderStyle);
$sheet->getStyle('D26:R32')->applyFromArray($allBorderStyle);
$sheet->getStyle('S21:U25')->applyFromArray($allBorderStyle);
$sheet->getStyle('V21:X25')->applyFromArray($allBorderStyle);
$sheet->getStyle('S26:X27')->applyFromArray($rightBorderStyle);
$sheet->getStyle('S28:X32')->applyFromArray($allBorderStyle);


for($i = 33; $i <= 40; $i++){
    $sheet->getStyle('A'.$i.':M'.$i)->applyFromArray($leftBorderStyle);
    $sheet->getStyle('A'.$i.':M'.$i)->applyFromArray($rightBorderStyle);
}

$sheet->getStyle('B35')->applyFromArray($allBorderStyle);
$sheet->getStyle('C39')->applyFromArray($allBorderStyle);
$sheet->getStyle('F39')->applyFromArray($allBorderStyle);

$sheet->getStyle('N33:X40')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A41:X49')->applyFromArray($allBorderStyle);

$sheet->getStyle('A50:M57')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A50:M57')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A58:A64')->applyFromArray($leftBorderStyle);
$sheet->getStyle('M58:M64')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A65:M71')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A65:M71')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A71:X71')->applyFromArray($bottomBorderStyle);

$sheet->getStyle('N50:X51')->applyFromArray($rightBorderStyle);

$sheet->getStyle('X52:X54')->applyFromArray($rightBorderStyle);

$sheet->getStyle('N55:X71')->applyFromArray($rightBorderStyle);


//------------------------------------------------------------------------------------

$sheet->getPageMargins()->setTop(1 / 2.54);
$sheet->getPageMargins()->setLeft(1 / 2.54);
$sheet->getPageMargins()->setRight(1 / 2.54);
$sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:X71');

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>
