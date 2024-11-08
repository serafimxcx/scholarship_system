<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Borders;

$fee_totals = array();


// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Free HE Billing Details - 2'); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

//---------------------------------------------------------------------------------------------------

$sheet->mergeCells('Z1:AD1');
$sheet->setCellValue('Z1', 'FORM 2');
$sheet->getStyle('Z1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('Z1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('Z1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('A2:AD2');

$sheet->mergeCells('A3:AD3');
$sheet->setCellValue('A3', 'Republic of the Philippines');
$sheet->getStyle('A3')->getFont()->setSize(12);
$sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A4:AD4');
$sheet->setCellValue('A4', 'KOLEHIYO NG LUNGSOD NG LIPA');
$sheet->getStyle('A4')->getFont()->setBold(true)->setItalic(true);
$sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$sheet->mergeCells('A5:AD5');
$sheet->setCellValue('A5', 'MARAWOY LIPA CITY');
$sheet->getStyle('A5')->getFont()->setItalic(true);
$sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A6:AD7');
$sheet->setCellValue('A6', 'TULONG DUNONG PROGRAM - TERTIARY EDUCATION SUBSIDY (TDP-TES) PAYROLL');
$sheet->getStyle('A6')->getFont()->setBold(true)->setSize(20);
$sheet->getStyle('A6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->getRowDimension(8)->setRowHeight(26.40);

$sheet->mergeCells('X8:AB8');
$sheet->setCellValue('X8', 'Free HE Billing Details Reference Number:  ');
$sheet->getStyle('X8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('AC8:AD8');

$sheet->mergeCells('X9:AB9');
$sheet->setCellValue('X9', 'Date  ');
$sheet->getStyle('X9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('AC9:AD9');

$sheet->mergeCells('A10:AD10');

$sheet->getRowDimension(9)->setRowHeight(27.60);

$sheet->mergeCells('A11:AD11');
$sheet->setCellValue('A11', 'TUITION AND OTHER SCHOOL FEES (Based on Section 7, Rule II of the IRR of RA 10931)');
$sheet->getStyle('A11')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);


$sheet->setCellValue('A12', 'Sequence Number');
$sheet->setCellValue('B12', 'Student Number');
$sheet->setCellValue('C12', 'Learner\'s Reference Number');
$sheet->setCellValue('D12', 'Last Name');
$sheet->setCellValue('E12', 'Given Name');
$sheet->setCellValue('F12', 'Middle Initial');
$sheet->setCellValue('G12', 'Degree Program');
$sheet->setCellValue('H12', 'Year Level');
$sheet->setCellValue('I12', 'Sex at Birth');
$sheet->setCellValue('J12', 'Email Address');
$sheet->setCellValue('K12', 'Phone Number');
$sheet->setCellValue('L12', 'Laboratory Units/Subject');
$sheet->setCellValue('M12', 'Computer Lab Units/Subject');
$sheet->setCellValue('N12', 'Academic Units Enrolled (credit and non-credit courses)');
$sheet->setCellValue('O12', 'Academic Units of NSTP Enrolled (credit and non-credit courses)');
$sheet->setCellValue('P12', 'Tuition Fee based on enrolled academic units (credit and  non-credit courses)');
$sheet->setCellValue('Q12', 'NSTP Fee based on enrolled academic units (credit and  non-credit courses)');

$col = 'R';

$resultFees = $conn->query("select * from tb_fees");
                      
while($rowFees = $resultFees->fetch_assoc()){
    $sheet->setCellValue($col.'12', openssl_decrypt($rowFees["name"], $method, $key));

    
    $fee_totals[$rowFees["id"]] = 0; 

    $col++;
}

$sheet->setCellValue('AD12', 'TOTAL TOSF');

$sheet->getStyle('A12:AD12')->getFont()->setBold(true)->setSize(12);
$sheet->getRowDimension(12)->setRowHeight(122.40);
$sheet->getStyle('A12:AD12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$total_tuition = 0;
$total_tosf = 0;
$data = [];

// Fetch and decrypt the data
while ($row = mysqli_fetch_assoc($result)) {
    $row['program_name'] = openssl_decrypt($row['program_name'], $method, $key);
    $row['tuition_fee'] = openssl_decrypt($row['tuition_fee'], $method, $key);
    $row['last_name'] = openssl_decrypt($row['last_name'], $method, $key);
    $row['first_name'] = openssl_decrypt($row['first_name'], $method, $key);
    $row['middle_name'] = openssl_decrypt($row['middle_name'], $method, $key);
    $row['yearlevel'] = openssl_decrypt($row['yearlevel'], $method, $key);
    $row['student_number'] = openssl_decrypt($row['student_number'], $method, $key);
    $row['email'] = openssl_decrypt($row['email'], $method, $key);
    $row['contact'] = openssl_decrypt($row['contact'], $method, $key);
    $row['sex'] = openssl_decrypt($row['sex'], $method, $key);
    $row['lrn'] = openssl_decrypt($row['lrn'], $method, $key);
    $row['fees_id'] = openssl_decrypt($row['fees_id'], $method, $key);
    $data[] = $row;
}

// Sort the data by program_name and last_name
usort($data, function($a, $b) {
    if ($a['program_name'] == $b['program_name']) {
        return strcmp($a['last_name'], $b['last_name']);
    }
    return strcmp($a['program_name'], $b['program_name']);
});

$n = 1;
$starting_row = 13;
$current_row = 13;

foreach ($data as $row) {
    $total_fees = 0;
    $program_name = $row['program_name'];
    $tuition_fee = $row['tuition_fee'];
    $last_name = $row['last_name'];
    $first_name = $row['first_name'];
    $middle_name = $row['middle_name'];
    $middle_initial = strtoupper(substr($middle_name, 0, 1));
    $yearlevel = $row['yearlevel'];
    $yearnum = strtoupper(substr($yearlevel, 0, 1));
    $student_number = $row['student_number'];
    $email = $row['email'];
    $contact = $row['contact'];
    $sex = $row['sex'] == "M" ? "Male" : "Female";
    $lrn = $row['lrn'];
    $fees_id = $row['fees_id'];
    $fees = explode(",", $fees_id);

    //--------------------------------------------------------------------------

    $sheet->setCellValue('A'.$current_row, $n);
    $sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('B'.$current_row, $student_number);
    $sheet->getStyle('B'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('C'.$current_row, $lrn);
    $sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('D'.$current_row, $last_name);
    $sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('E'.$current_row, $first_name);
    $sheet->getStyle('E'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('F'.$current_row, $middle_initial);
    $sheet->getStyle('F'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('G'.$current_row, $program_name);
    $sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('H'.$current_row, $yearnum);
    $sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('I'.$current_row, $sex);
    $sheet->getStyle('I'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('J'.$current_row, $email);
    $sheet->getStyle('J'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('K'.$current_row, $contact);
    $sheet->getStyle('K'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('P'.$current_row, $tuition_fee);
    $sheet->getStyle('P'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);


    //-----------------------------------------------------------------------

    $col_val = 'R';
        
    $total_tuition += floatval($tuition_fee);

    $resultFees = $conn->query("select * from tb_fees");
                        
    while ($rowFees = $resultFees->fetch_assoc()) {
        $found = false;
        foreach ($fees as $fee_id) {
            if ($fee_id == $rowFees["id"]) {
                $found = true;
                $amount = floatval(openssl_decrypt($rowFees["amount"], $method, $key));
                
                $sheet->setCellValue($col_val.$current_row, $amount);
                $sheet->getStyle($col_val.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


                $total_fees += $amount;
                $fee_totals[$fee_id] += $amount;
                break; 
            }
        }
        if (!$found) {
            $fee_totals[$fee_id] += 0;
        }

        $col_val++;
    }

    $total_fees += $tuition_fee;

    //$loadinfo .= '<td>'.number_format($total_fees, 2, ".", ",").'</td></tr>';
    $sheet->setCellValue('AD'.$current_row, number_format($total_fees, 2, ".", ","));
    $sheet->getStyle('AD'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


    $total_tosf += $total_fees;

    $current_row++;
    $n++;
    
}

$sheet->mergeCells('A'.$current_row.':C'.$current_row);
$sheet->setCellValue('A'.$current_row, 'Page Total');
//$sheet->getStyle('A'.$current_row)->getFont()->setItalicBold(true);
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->setCellValue('P'.$current_row, $total_tuition);
$sheet->getStyle('P'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$col_val2 = 'R';

foreach ($fee_totals as $fee_id => $total) {
    if($total == 0){
        $sheet->setCellValue($col_val2.$current_row, '');


    }else{
        $sheet->setCellValue($col_val2.$current_row, number_format($total, 2, ".", ","));
        $sheet->getStyle($col_val2.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);



    }

    $col_val2++;
}

$sheet->setCellValue('AD'.$current_row, number_format($total_tosf, 2, ".", ","));
$sheet->getStyle('AD'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


$current_row++;

$sheet->mergeCells('A'.$current_row.':C'.$current_row);
$sheet->setCellValue('A'.$current_row, 'Page Accumulated Total');
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->setCellValue('P'.$current_row, $total_tuition);
$sheet->getStyle('P'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$col_val3 = 'R';

foreach ($fee_totals as $fee_id => $total) {
    if($total == 0){
        $sheet->setCellValue($col_val3.$current_row, '');


    }else{
        $sheet->setCellValue($col_val3.$current_row, number_format($total, 2, ".", ","));
        $sheet->getStyle($col_val3.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


    }

    $col_val3++;
}

$sheet->setCellValue('AD'.$current_row, number_format($total_tosf, 2, ".", ","));
$sheet->getStyle('AD'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row++;

$sheet->mergeCells('A'.$current_row.':C'.$current_row);
$sheet->setCellValue('A'.$current_row, 'OVER-ALL TOTAL-TOSF');
$sheet->getStyle('A'.$current_row)->getFont()->setBold(true);
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->setCellValue('AD'.$current_row, number_format($total_tosf, 2, ".", ","));
$sheet->getStyle('AD'.$current_row)->getFont()->setBold(true);
$sheet->getStyle('AD'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row+=2;

$sheet->mergeCells('A'.$current_row.':AD'.$current_row);
$sheet->setCellValue('A'.$current_row, '*Entrance/Admission Fee may be used interchangeably if pertaining to the admission examination of the SUC/LUC only.');
$sheet->getStyle('A'.$current_row)->getFont()->setBold(true)->setItalic(true);
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$current_row+=6;

$sheet->mergeCells('C'.$current_row.':F'.$current_row);
$sheet->setCellValue('C'.$current_row, 'Prepared and Certified by:');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('I'.$current_row.':N'.$current_row);
$sheet->setCellValue('I'.$current_row, 'Certified by:');
$sheet->getStyle('I'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('T'.$current_row.':AC'.$current_row);
$sheet->setCellValue('T'.$current_row, 'Approved by:');
$sheet->getStyle('T'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$current_row +=3;

$sheet->mergeCells('C'.$current_row.':F'.$current_row);
$sheet->setCellValue('C'.$current_row, 'JINGEL H. LEYNES');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('C'.$current_row)->getFont()->setBold(true);

$sheet->mergeCells('I'.$current_row.':N'.$current_row);
$sheet->setCellValue('I'.$current_row, 'TERESITA V. ESPLAGO');
$sheet->getStyle('I'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('I'.$current_row)->getFont()->setBold(true);

$sheet->mergeCells('T'.$current_row.':AC'.$current_row);
$sheet->setCellValue('T'.$current_row, 'MARIO CARMELO A. PESA');
$sheet->getStyle('T'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('T'.$current_row)->getFont()->setBold(true);

$current_row++;

$sheet->mergeCells('C'.$current_row.':F'.$current_row);
$sheet->setCellValue('C'.$current_row, 'College Registrar');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('I'.$current_row.':N'.$current_row);
$sheet->setCellValue('I'.$current_row, 'Vice President for Administration');
$sheet->getStyle('I'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('T'.$current_row.':AC'.$current_row);
$sheet->setCellValue('T'.$current_row, 'College Administrator');
$sheet->getStyle('T'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$current_row++;

$sheet->mergeCells('C'.$current_row.':F'.$current_row);
$sheet->setCellValue('C'.$current_row, 'UniFast Focal Person & Scholarship Coordinator');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$current_row++;

//-----------------------------------------------------------------------------------

$sheet->getColumnDimension('A')->setWidth(5.44);
$sheet->getColumnDimension('B')->setWidth(16.56);
$sheet->getColumnDimension('C')->setWidth(11.33);
$sheet->getColumnDimension('D')->setWidth(23);
$sheet->getColumnDimension('E')->setWidth(27.89);
$sheet->getColumnDimension('F')->setWidth(20.89);
$sheet->getColumnDimension('G')->setWidth(66.33);
$sheet->getColumnDimension('H')->setWidth(5.89);
$sheet->getColumnDimension('I')->setWidth(11.56);
$sheet->getColumnDimension('J')->setWidth(34.33);
$sheet->getColumnDimension('K')->setWidth(14.78);
$sheet->getColumnDimension('L')->setWidth(7.78);
$sheet->getColumnDimension('M')->setWidth(7.78);
$sheet->getColumnDimension('N')->setWidth(7.78);
$sheet->getColumnDimension('O')->setWidth(7.78);
$sheet->getColumnDimension('P')->setWidth(17.89);
$sheet->getColumnDimension('Q')->setWidth(4.44);
$sheet->getColumnDimension('R')->setWidth(16);
$sheet->getColumnDimension('S')->setWidth(16);
$sheet->getColumnDimension('T')->setWidth(16);
$sheet->getColumnDimension('U')->setWidth(4.44);
$sheet->getColumnDimension('V')->setWidth(4.44);
$sheet->getColumnDimension('W')->setWidth(4.44);
$sheet->getColumnDimension('X')->setWidth(4.44);
$sheet->getColumnDimension('Y')->setWidth(14.78);
$sheet->getColumnDimension('Z')->setWidth(16);
$sheet->getColumnDimension('AA')->setWidth(16);
$sheet->getColumnDimension('AB')->setWidth(4.44);
$sheet->getColumnDimension('AC')->setWidth(14.78);
$sheet->getColumnDimension('AD')->setWidth(20.89);


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

$sheet->getStyle('Z1:AD1')->applyFromArray($allBorderStyle);

$sheet->getStyle('A1:AD1')->applyFromArray($topBorderStyle);
$sheet->getStyle('A1:AD10')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A1:AD10')->applyFromArray($rightBorderStyle);

$sheet->getStyle('AC8:AD8')->applyFromArray($thin_bottomBorderStyle);
$sheet->getStyle('AC9:AD9')->applyFromArray($thin_bottomBorderStyle);

$footer_start_row = $current_row-15;

$sheet->getStyle('A11:AD'.$footer_start_row)->applyFromArray($allBorderStyle);

$sheet->getStyle('A'.$footer_start_row.':AD'.$current_row)->applyFromArray($leftBorderStyle);
$sheet->getStyle('A'.$footer_start_row.':AD'.$current_row)->applyFromArray($rightBorderStyle);
$sheet->getStyle('A'.$current_row.':AD'.$current_row)->applyFromArray($bottomBorderStyle);

//---------------------------------------------------------------------------------------------

$sheet->getPageMargins()->setTop(1 / 2.54);
$sheet->getPageMargins()->setLeft(1 / 2.54);
$sheet->getPageMargins()->setRight(1 / 2.54);
$sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:AD'.$current_row);

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="FHE_Billing_Details_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>