<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Borders;

$total_fees = 0;
$fee_name = "";
while($row = mysqli_fetch_assoc($result)){
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);
    $tuition_fee = openssl_decrypt($row["tuition_fee"], $method, $key);
    $fees_id = openssl_decrypt($row["fees_id"], $method, $key);
    $fees = explode(",", $fees_id);

    if($fee != "Tuition Fee"){
        if(!empty($fee)){
        
            $resultFees = $conn->query("select * from tb_fees where id = $fee");
    
    
        }else{
            $resultFees = $conn->query("select * from tb_fees");
    
    
        }
    
                          
        while($rowFees = $resultFees->fetch_assoc()){
            $found = false;
            foreach ($fees as $fee_id) {
                if ($fee_id == $rowFees["id"]) {
                    $found = true;
                    $fee_name = openssl_decrypt($rowFees["name"], $method, $key);
                    $total_fees += floatval(openssl_decrypt($rowFees["amount"], $method, $key));
                    break; 
                }
            }
            if (!$found) {
                $total_fees += 0;
                $fee_name = openssl_decrypt($rowFees["name"], $method, $key);
            }
            
        }
    }else{
        $total_fees += $tuition_fee;
        $fee_name = "Tuition Fees";
    }
    

    if(empty($fee)){
        
        $total_fees += $tuition_fee;

    }

}


// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Free HE Billing Statement - 1'); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);


//---------------------------------------------------------------------------------------------------

$sheet->mergeCells('R1:X1');
$sheet->setCellValue('R1', 'FORM 1');
$sheet->getStyle('R1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('R1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('R1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('A2:X2');
$sheet->setCellValue('A2', 'Republic of the Philippines');
$sheet->getStyle('A2')->getFont()->setSize(12);
$sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A3:X3');
$sheet->setCellValue('A3', 'Kolehiyo ng Lungsod ng Lipa');
$sheet->getStyle('A3')->getFont()->setBold(true)->setItalic(true);
$sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A4:X4');
$sheet->setCellValue('A4', 'Marawoy Lipa City');
$sheet->getStyle('A4')->getFont()->setItalic(true);
$sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A5:X6');

$sheet->getRowDimension(7)->setRowHeight(24.60);
$sheet->mergeCells('A7:X7');
$sheet->setCellValue('A7', 'CONSOLIDATED FREE HE BILLING STATEMENT');
$sheet->getStyle('A7')->getFont()->setBold(true)->setSize(20);
$sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('N8:S8');
$sheet->setCellValue('N8', 'Free HE Billing Statement Reference No.:  ');
$sheet->getStyle('N8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('T8:X8');

$sheet->mergeCells('N9:S9');
$sheet->setCellValue('N9', 'Date  ');
$sheet->getStyle('N9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('T9:X9');
$sheet->setCellValue('N9', $formatDate);

$sheet->mergeCells('A10:X10');

$sheet->mergeCells('A11:C11');
$sheet->setCellValue('A11', 'To');
$sheet->getStyle('A11')->getFont()->setBold(true);
$sheet->getStyle('A11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->mergeCells('D11:X11');
$sheet->setCellValue('D11', 'CHED - Central Office');
$sheet->getStyle('D11')->getFont()->setBold(true);
$sheet->getStyle('D11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('A12:C12');
$sheet->setCellValue('A12', 'Address');
$sheet->getStyle('A12')->getFont()->setBold(true);
$sheet->getStyle('A12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->mergeCells('D12:X12');
$sheet->setCellValue('D12', 'Higher Education Development Center Building, C.P. Garcia Ave, UP Campus, Diliman, Quezon City, Metro Manila');
$sheet->getStyle('D12')->getFont()->setBold(true);
$sheet->getStyle('D12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->getRowDimension(25)->setRowHeight(244.80);

$sheet->mergeCells('A13:C19');
$sheet->setCellValue('A13', 'Responsibility Center');
$sheet->getStyle('A13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_TOP)->setWrapText(true);

$sheet->mergeCells('D13:R19');
$sheet->setCellValue('D13', 'Request for payment of '. (!empty($fee)? $fee_name : "tuiton fees annd other school fees (TOSF)") .' for the '.$semester.' AY '.$academic_year.' to be charged against the Free Higher Education for CHED under Republic Act 10931 otherwise known as the Universal Access to Quality Tertiary Education(UAQTE), and as per CHED-UniFAST Guidelines for Free HE per attached supporting documents. ');
$sheet->getStyle('D13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);

$sheet->mergeCells('S13:U13');
$sheet->setCellValue('S13', 'Account Code');
$sheet->getStyle('S13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);

$sheet->mergeCells('V13:X13');
$sheet->setCellValue('V13', 'Amount');
$sheet->getStyle('V13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);

$sheet->mergeCells('V16:X16');
$sheet->setCellValue('V16', number_format($total_fees, 2, ".", ","));
$sheet->getStyle('V16')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->mergeCells('A26:C27');
$sheet->setCellValue('A26', 'Signature');
$sheet->getStyle('A26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('D26:M27');

$sheet->mergeCells('N26:P27');
$sheet->setCellValue('N26', 'Signature');
$sheet->getStyle('N26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('Q26:X27');


$sheet->mergeCells('A28:C29');
$sheet->setCellValue('A28', 'Printed Name');
$sheet->getStyle('A28')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('D28:M29');
$sheet->setCellValue('D28', 'TERESITA V. ESPLAGO');
$sheet->getStyle('D28')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('N28:P29');
$sheet->setCellValue('N28', 'Printed Name');
$sheet->getStyle('N28')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('Q28:X29');
$sheet->setCellValue('Q28', 'MARIO CARMELO A. PESA');
$sheet->getStyle('Q28')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);


$sheet->mergeCells('A30:C31');
$sheet->setCellValue('A30', 'Position');
$sheet->getStyle('A30')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('D30:M31');
$sheet->setCellValue('D30', 'Vice President for Administration, Planning and Finance');
$sheet->getStyle('D30')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('N30:P31');
$sheet->setCellValue('N30', 'Position');
$sheet->getStyle('N30')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('Q30:X31');
$sheet->setCellValue('Q30', 'College Administrator');
$sheet->getStyle('Q30')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);


$sheet->mergeCells('A32:C33');
$sheet->setCellValue('A32', 'Date');
$sheet->getStyle('A32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('D32:M33');
$sheet->setCellValue('D32', $formatDate);
$sheet->getStyle('D32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('N32:P33');
$sheet->setCellValue('N32', 'Date');
$sheet->getStyle('N32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('Q32:X33');
$sheet->setCellValue('Q32', $formatDate);
$sheet->getStyle('Q32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A34:M34');
$sheet->mergeCells('N34:X34');

$sheet->getStyle('A35:X55')->getFont()->setItalic(true);

$sheet->getStyle('A35:X55')->getFont()->setSize(10);

$sheet->mergeCells('A35:M35');
$sheet->setCellValue('A35', 'INSTRUCTIONS');
$sheet->getStyle('A35')->getFont()->setBold(true);

$sheet->mergeCells('A36:M36');
$sheet->setCellValue('A36', '1. SUCs are allowed a maximum of two (2) tranches of payments per semester.');

$sheet->mergeCells('A37:M38');

$sheet->mergeCells('A39:M39');
$sheet->setCellValue('A39', '2. The Free HE statement reference number shall comprise of the REGIONAL CODE (2-digit),');

$sheet->mergeCells('A40:M40');
$sheet->setCellValue('A40', '   SUC CODE (alpha codes), ACADEMIC YEAR (4-digit), TERM (1-digit), ');

$sheet->mergeCells('A41:M41');
$sheet->setCellValue('A41', '   LUC CODE (alpha code) ACADEMIC YEAR (4-digit), TERM (1-digit)');

$sheet->mergeCells('A42:M42');
$sheet->setCellValue('A42', '   & BATCH NUMBER (1 digit). Descriptions and codes are provided below:');

$sheet->mergeCells('A43:M43');

$sheet->mergeCells('A44:M44');
$sheet->setCellValue('A44', 'Regional Codes');
$sheet->getStyle('A44')->getFont()->setBold(true);

$sheet->mergeCells('A45:B45');
$sheet->setCellValue('A45', 'Region');
$sheet->getStyle('A45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('A45')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('A46:B46');
$sheet->setCellValue('A46', 'Region 01');
$sheet->getStyle('A46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A47:B47');
$sheet->setCellValue('A47', 'Region 02');
$sheet->getStyle('A47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A48:B48');
$sheet->setCellValue('A48', 'Region 03');
$sheet->getStyle('A48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A49:B49');
$sheet->setCellValue('A49', 'Region 4A');
$sheet->getStyle('A49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A50:B50');
$sheet->setCellValue('A50', 'Region 4B');
$sheet->getStyle('A50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A51:B51');
$sheet->setCellValue('A51', 'Region 05');
$sheet->getStyle('A51')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('C45:E45');
$sheet->setCellValue('C45', 'Code');
$sheet->getStyle('C45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('C45')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('C46:E46');
$sheet->setCellValue('C46', '01');
$sheet->getStyle('C46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C47:E47');
$sheet->setCellValue('C47', '02');
$sheet->getStyle('C47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C48:E48');
$sheet->setCellValue('C48', '03');
$sheet->getStyle('C48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C49:E49');
$sheet->setCellValue('C49', '04');
$sheet->getStyle('C49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C50:E50');
$sheet->setCellValue('C50', 'MIMAROPA');
$sheet->getStyle('C50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('C51:E51');
$sheet->setCellValue('C51', '05');
$sheet->getStyle('C51')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('F45:G45');
$sheet->setCellValue('F45', 'Region');
$sheet->getStyle('F45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('F45')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('F46:G46');
$sheet->setCellValue('F46', 'Region 06');
$sheet->getStyle('F46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F47:G47');
$sheet->setCellValue('F47', 'Region 07');
$sheet->getStyle('F47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F48:G48');
$sheet->setCellValue('F48', 'Region 08');
$sheet->getStyle('F48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F49:G49');
$sheet->setCellValue('F49', 'Region 09');
$sheet->getStyle('F49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F50:G50');
$sheet->setCellValue('F50', 'Region 10');
$sheet->getStyle('F50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('F51:G51');
$sheet->setCellValue('F51', 'Region 11');
$sheet->getStyle('F51')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('H45');
$sheet->setCellValue('H45', 'Code');
$sheet->getStyle('H45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('H45')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('H46');
$sheet->setCellValue('H46', '06');
$sheet->getStyle('H46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H47');
$sheet->setCellValue('H47', '07');
$sheet->getStyle('H47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H48');
$sheet->setCellValue('H48', '08');
$sheet->getStyle('H48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H49');
$sheet->setCellValue('H49', '09');
$sheet->getStyle('H49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H50');
$sheet->setCellValue('H50', '10');
$sheet->getStyle('H50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('H51');
$sheet->setCellValue('H51', '11');
$sheet->getStyle('H51')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('J45:K45');
$sheet->setCellValue('J45', 'Region');
$sheet->getStyle('J45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('J45')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('J46:K46');
$sheet->setCellValue('J46', 'Region 12');
$sheet->getStyle('J46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J47:K47');
$sheet->setCellValue('J47', 'NCR');
$sheet->getStyle('J47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J48:K48');
$sheet->setCellValue('J48', 'CARAGA');
$sheet->getStyle('J48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J49:K49');
$sheet->setCellValue('J49', 'BARMM');
$sheet->getStyle('J49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('J50:K50');
$sheet->setCellValue('J50', 'CAR');
$sheet->getStyle('J50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('L45:M45');
$sheet->setCellValue('L45', 'Code');
$sheet->getStyle('L45')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('L45')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('L46:M46');
$sheet->setCellValue('L46', '12');
$sheet->getStyle('L46')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L47:M47');
$sheet->setCellValue('L47', 'NCR');
$sheet->getStyle('L47')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L48:M48');
$sheet->setCellValue('L48', 'CARAGA');
$sheet->getStyle('L48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L49:M49');
$sheet->setCellValue('L49', 'BARMM');
$sheet->getStyle('L49')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('L50:M50');
$sheet->setCellValue('L50', 'CAR');
$sheet->getStyle('L50')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('A52:M52');

$sheet->mergeCells('A53:M53');
$sheet->setCellValue('A53', '   "SUC Code" shall be the Acronym used by the SUC for their institution.');

$sheet->mergeCells('A54:M54');
$sheet->setCellValue('A54', '   "LUC Code" shall be the Acronym used by the LUC for their institution.');

$sheet->mergeCells('A55:M55');
$sheet->setCellValue('A55', '   e.g. MinSCAT for Mindoro State College of Agriculture and Technology');

$sheet->mergeCells('N36:X36');
$sheet->setCellValue('N36', '   "Academic Year" will use the year when the AY began (e.g. 2018 for AY 2018-2019).');

$sheet->mergeCells('N38:X38');
$sheet->setCellValue('N38', '   "Term" refers to the academic year semester or terms: ');

$sheet->mergeCells('P39:R39');
$sheet->setCellValue('P39', 'Term ');
$sheet->getStyle('P39')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('P39')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('P40:R40');
$sheet->setCellValue('P40', '1st Semester ');
$sheet->getStyle('P40')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('P41:R41');
$sheet->setCellValue('P41', '2nd Semester ');
$sheet->getStyle('P41')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->setCellValue('S39', 'Code ');
$sheet->getStyle('S39')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('S39')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->setCellValue('S40', '1');
$sheet->getStyle('S40')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('S41', '2');
$sheet->getStyle('S41')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('U39:W39');
$sheet->setCellValue('U39', 'Term ');
$sheet->getStyle('U39')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('U39')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->mergeCells('U40:W40');
$sheet->setCellValue('U40', '3rd Semester ');
$sheet->getStyle('U40')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('U41:W41');
$sheet->setCellValue('U41', 'Summer ');
$sheet->getStyle('U41')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('X39', 'Code ');
$sheet->getStyle('X39')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('X39')->getFont()->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);

$sheet->setCellValue('X40', '3');
$sheet->getStyle('X40')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('X41', '3');
$sheet->getStyle('X41')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('N43:X43');
$sheet->setCellValue('N43', '   "Batch" refers to the number of times an SUC / LUC liquidates with  CHED in a semester. ');

$sheet->mergeCells('N44:X44');
$sheet->setCellValue('N44', '   Note that SUCs / LUCs may liquidate with CHED no more than two (2) batches per semester.');
$sheet->getStyle('N44')->getFont()->setBold(true);

$sheet->mergeCells('N46:X46');
$sheet->setCellValue('N46', '   Examples of a billing statement no.');

$sheet->mergeCells('N47:X47');
$sheet->setCellValue('N47', '   The first batch of Free HE statement submitted by MinSCAT in 1st sem AY 2018-2019:');

$sheet->mergeCells('N48:X48');
$sheet->setCellValue('N48', '           MIMAROPA - MinSCAT - 2018 - 1 -1 ');
$sheet->getStyle('N48')->getFont()->setBold(true);


$sheet->mergeCells('N49:X49');
$sheet->setCellValue('N49', '   The second batch of Free HE statement submitted by Quirino State University in 1st semester');
$sheet->mergeCells('N50:X50');
$sheet->setCellValue('N50', '       of AY 2018 - 2019');

$sheet->mergeCells('N51:X51');
$sheet->setCellValue('N51', '           02 - QSU - 2018 - 1 - 2');
$sheet->getStyle('N51')->getFont()->setBold(true);

$sheet->mergeCells('N53:X53');
$sheet->setCellValue('N53', '3. Send a printed copy of this completed Free HE Statement Form (Form 1) to ');

$sheet->mergeCells('N54:X54');
$sheet->setCellValue('N54', '   CHED Central Office Records Section for proper receiving procedures. ');

$sheet->mergeCells('N55:X55');
$sheet->setCellValue('N55', '   Do not send the signed forms to any other office in CHED.');

//-----------------------------------------------------------------------------------


$columns = range('A', 'X');
foreach ($columns as $column) {
    $width = 5;
    if (in_array($column, ['M',  'X', 'R'])) {
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

$sheet->getStyle('R1:X1')->applyFromArray($allBorderStyle);

$sheet->getStyle('A1:X1')->applyFromArray($topBorderStyle);
$sheet->getStyle('A1:X10')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A1:X10')->applyFromArray($rightBorderStyle);

$sheet->getStyle('T8:X8')->applyFromArray($thin_bottomBorderStyle);
$sheet->getStyle('T9:X9')->applyFromArray($thin_bottomBorderStyle);

$sheet->getStyle('A11:X12')->applyFromArray($allBorderStyle);

$sheet->getStyle('A13:C25')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A13:C25')->applyFromArray($rightBorderStyle);

$sheet->getStyle('D13:R25')->applyFromArray($leftBorderStyle);
$sheet->getStyle('D13:R25')->applyFromArray($rightBorderStyle);

$sheet->getStyle('S13:U25')->applyFromArray($leftBorderStyle);
$sheet->getStyle('S13:U25')->applyFromArray($rightBorderStyle);

$sheet->getStyle('V13:X25')->applyFromArray($leftBorderStyle);
$sheet->getStyle('V13:X25')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A25:X25')->applyFromArray($bottomBorderStyle);

$sheet->getStyle('A26:X34')->applyFromArray($allBorderStyle);

$sheet->getStyle('A35:M55')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A35:M55')->applyFromArray($rightBorderStyle);

$sheet->getStyle('N35:X55')->applyFromArray($leftBorderStyle);
$sheet->getStyle('N35:X55')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A55:X55')->applyFromArray($bottomBorderStyle);

//---------------------------------------------------------------------------------------------

$sheet->getPageMargins()->setTop(1 / 2.54);
$sheet->getPageMargins()->setLeft(1 / 2.54);
$sheet->getPageMargins()->setRight(1 / 2.54);
$sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:X55');

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="FHE_Billing_Statement_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;


?>