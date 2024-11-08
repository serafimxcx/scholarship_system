<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Borders;



// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('TDP Annex 10'); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

//---------------------------------------------------------------------------------

$sheet->mergeCells('K1:N1');
$sheet->setCellValue('K1', 'TDP Form - Annex 10');
$sheet->getStyle('K1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('K1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('K1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('A2:N2');

$sheet->mergeCells('A3:N3');
$sheet->setCellValue('A3', 'Republic of the Philippines');
$sheet->getStyle('A3')->getFont()->setSize(12);
$sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A4:N4');
$sheet->setCellValue('A4', 'KOLEHIYO NG LUNGSOD NG LIPA');
$sheet->getStyle('A4')->getFont()->setBold(true)->setItalic(true);
$sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$sheet->mergeCells('A5:N5');
$sheet->setCellValue('A5', 'MARAWOY LIPA CITY');
$sheet->getStyle('A5')->getFont()->setBold(true)->setItalic(true);
$sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$drawingChed = new Drawing();
$drawingChed->setName('CHED Logo');
$drawingChed->setDescription('CHED Logo');
$drawingChed->setPath($destinationChedLogo);
$drawingChed->setHeight(60); // Set height of the image in points (pixels)
$drawingChed->setCoordinates('E3'); // Position where the image should be placed
$drawingChed->setOffsetX(25);
$drawingChed->setWorksheet($sheet);

$drawingChed = new Drawing();
$drawingChed->setName('Unifast Logo');
$drawingChed->setDescription('Unifast Logo');
$drawingChed->setPath($destinationUnifastLogo);
$drawingChed->setHeight(60); 
$drawingChed->setCoordinates('J3'); 
$drawingChed->setWorksheet($sheet);

$sheet->mergeCells('A6:N6');

$sheet->mergeCells('A7:N8');
$sheet->setCellValue('A7', 'TULONG DUNONG PROGRAM - TERTIARY EDUCATION SUBSIDY (TDP-TES) PAYROLL');
$sheet->getStyle('A7')->getFont()->setBold(true)->setSize(20);
$sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('L9', 'Date: ');
$sheet->getStyle('L9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->mergeCells('M9:N9');
$sheet->mergeCells('A10:N10');

$sheet->mergeCells('D11:F11');
$sheet->setCellValue('D11', 'Student\'s Name');
$sheet->getStyle('D11')->getFont()->setBold(true);
$sheet->getStyle('D11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('G11:H11');

$sheet->mergeCells('I11:L11');
$sheet->setCellValue('I11', 'TDP-TES Grant');
$sheet->getStyle('I11')->getFont()->setBold(true);
$sheet->getStyle('I11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

$sheet->getRowDimension(12)->setRowHeight(42);

$sheet->getStyle('A12:N12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
$sheet->getStyle('A12:N12')->getFont()->setSize(11);


$sheet->setCellValue('A12', 'Sequence No.');
$sheet->setCellValue('B12', 'TDP-TES Award Number');
$sheet->setCellValue('C12', 'Student ID No.');
$sheet->setCellValue('D12', 'Last Name');
$sheet->setCellValue('E12', 'Given Name');
$sheet->setCellValue('F12', 'Middle Initial');
$sheet->setCellValue('G12', 'Degree Program');
$sheet->setCellValue('H12', 'Year Level');
$sheet->setCellValue('I12', '1st Semester');
$sheet->setCellValue('J12', 'Date Received');
$sheet->setCellValue('K12', 'Student Signature');
$sheet->setCellValue('L12', '2nd Semester');
$sheet->setCellValue('M12', 'Date Received');
$sheet->setCellValue('N12', 'Student Signature');

$total_firstgrant = 0;
$total_secondgrant = 0;

$n = 1;
$starting_row = 13;
$current_row = 13;

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $total_amount = 0;
    $application_num = openssl_decrypt($row["application_num"], $method, $key);
    $application_date = openssl_decrypt($row["application_date"], $method, $key);
    $applydate_create = date_create($application_date);
    $format_applydate = date_format($applydate_create, "F j, Y");

    $type = openssl_decrypt($row["applicant_type"], $method, $key);
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);
    $program_name = openssl_decrypt($row["program_name"], $method, $key);
    $last_name = openssl_decrypt($row["last_name"], $method, $key);
    $first_name = openssl_decrypt($row["first_name"], $method, $key);
    $middle_name = openssl_decrypt($row["middle_name"], $method, $key);
    $yearlevel = openssl_decrypt($row["yearlevel"], $method, $key);
    $scholarship_name = openssl_decrypt($row["scholarship_name"], $method, $key);

    $award_number = openssl_decrypt($row["award_number"], $method, $key);
    $student_number = openssl_decrypt($row["student_number"], $method, $key);

    $first_semester = openssl_decrypt($row["1st_semester"], $method, $key);
    $second_semester = openssl_decrypt($row["2nd_semester"], $method, $key);

    $firstdate_received = "";
    $firstsig = "";

    $seconddate_received = "";
    $secondsig = "";

    if ($row["1st_semester"] !== null) {
        $total_firstgrant += floatval($first_semester);
        $total_amount += floatval($first_semester);
        $first_semester = number_format($first_semester, 2, '.', ',');
    } else {
        $total_amount += 0;
        $firstdate_received = "-";
        $firstsig = "-";
        $first_semester = "-";
    }

    if ($row["2nd_semester"] !== null) {
        $total_secondgrant += floatval($second_semester);
        $total_amount += floatval($second_semester);
        $second_semester = number_format($second_semester, 2, '.', ',');
    } else {
        $total_amount += 0;
        $second_semester = "-";
        $seconddate_received = "-";
        $secondsig = "-";
    }

    $middle_initial = strtoupper(substr($middle_name, 0, 1));
    $yearnum = strtoupper(substr($yearlevel, 0, 1));

    $data[] = [
        'award_number' => $award_number,
        'student_number' => $student_number,
        'last_name' => $last_name,
        'first_name' => $first_name,
        'middle_initial' => $middle_initial,
        'program_name' => $program_name,
        'yearnum' => $yearnum,
        'first_semester' => $first_semester,
        'firstdate_received' => $firstdate_received,
        'firstsig' => $firstsig,
        'second_semester' => $second_semester,
        'seconddate_received' => $seconddate_received,
        'secondsig' => $secondsig
    ];

}

// Sort the data by last name
usort($data, function($a, $b) {
    if ($a['program_name'] == $b['program_name']) {
        return strcmp($a['last_name'], $b['last_name']);
    }
    return strcmp($a['program_name'], $b['program_name']);
});

foreach ($data as $row) {
    $sheet->setCellValue('A'.$current_row, $n);
    $sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('B'.$current_row, $row['award_number']);
    $sheet->getStyle('B'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('C'.$current_row, $row['student_number']);
    $sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('D'.$current_row, $row['last_name']);
    $sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('E'.$current_row, $row['first_name']);
    $sheet->getStyle('E'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('F'.$current_row, $row['middle_initial']);
    $sheet->getStyle('F'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('G'.$current_row, $row['program_name']);
    $sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('H'.$current_row, $row['yearnum']);
    $sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('I'.$current_row, $row['first_semester']);
    $sheet->getStyle('I'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('J'.$current_row, $row['firstdate_received']);
    $sheet->getStyle('J'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('K'.$current_row, $row['firstsig']);
    $sheet->getStyle('K'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('L'.$current_row, $row['second_semester']);
    $sheet->getStyle('L'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('M'.$current_row, $row['seconddate_received']);
    $sheet->getStyle('M'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('N'.$current_row, $row['secondsig']);
    $sheet->getStyle('N'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $current_row++;
    $n++;
}
						
$sheet->getStyle('A'.$starting_row.':N'.$current_row)->getFont()->setSize(11);

$sheet->mergeCells('D'.$current_row.':E'.$current_row);
$sheet->setCellValue('D'.$current_row, 'As to corectness of enrollment data');
//$sheet->getStyle('D'.$current_row)->getFont()->setBold(true);
$sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('D'.$current_row)->getFont()->setSize(12);


$sheet->mergeCells('G'.$current_row.':H'.$current_row);
$sheet->setCellValue('G'.$current_row, 'As to correctness of financial data');
$sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('G'.$current_row)->getFont()->setSize(12);

$sheet->mergeCells('K'.$current_row.':M'.$current_row);
$sheet->setCellValue('K'.$current_row, 'Approved by:');
$sheet->getStyle('K'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('K'.$current_row)->getFont()->setSize(12);

$current_row++;

$sheet->mergeCells('D'.$current_row.':E'.$current_row);
$sheet->setCellValue('D'.$current_row, 'Verified by: ');
$sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('D'.$current_row)->getFont()->setSize(12);

$sheet->mergeCells('G'.$current_row.':I'.$current_row);
$sheet->setCellValue('G'.$current_row, 'Certified true and correct by:');
$sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('G'.$current_row)->getFont()->setSize(12);

$current_row+=3;

$sheet->mergeCells('D'.$current_row.':E'.$current_row);
$sheet->setCellValue('D'.$current_row, 'JINGEL H. LEYNES');
$sheet->getStyle('D'.$current_row)->getFont()->setBold(true);
$sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('D'.$current_row)->getFont()->setSize(12);

$sheet->mergeCells('G'.$current_row.':I'.$current_row);
$sheet->setCellValue('G'.$current_row, 'TERESITA V. ESPLAGO');
$sheet->getStyle('D'.$current_row)->getFont()->setBold(true);
$sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('G'.$current_row)->getFont()->setSize(12);

$sheet->mergeCells('K'.$current_row.':M'.$current_row);
$sheet->setCellValue('K'.$current_row, 'MARIO CARMELO A. PESA');
$sheet->getStyle('D'.$current_row)->getFont()->setBold(true);
$sheet->getStyle('K'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('K'.$current_row)->getFont()->setSize(12);

$current_row++;

$sheet->mergeCells('D'.$current_row.':E'.$current_row);
$sheet->setCellValue('D'.$current_row, 'UniFast Focal Person');
$sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('D'.$current_row)->getFont()->setSize(12);

$sheet->mergeCells('G'.$current_row.':I'.$current_row);
$sheet->setCellValue('G'.$current_row, 'Vice President for Administration');
$sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('G'.$current_row)->getFont()->setSize(12);

$sheet->mergeCells('K'.$current_row.':M'.$current_row);
$sheet->setCellValue('K'.$current_row, 'College Administrator');
$sheet->getStyle('K'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('K'.$current_row)->getFont()->setSize(12);

$current_row++;

$sheet->mergeCells('D'.$current_row.':E'.$current_row);
$sheet->setCellValue('D'.$current_row, 'Scholarship Coordinator');
$sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('D'.$current_row)->getFont()->setSize(12);

$sheet->mergeCells('G'.$current_row.':I'.$current_row);
$sheet->setCellValue('G'.$current_row, 'Planning and Finance');
$sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('G'.$current_row)->getFont()->setSize(12);

$current_row++;

//-----------------------------------------------------------------------------------

$sheet->getColumnDimension('A')->setWidth(8.90);
$sheet->getColumnDimension('B')->setWidth(15.30);
$sheet->getColumnDimension('C')->setWidth(9.90);
$sheet->getColumnDimension('D')->setWidth(16.40);
$sheet->getColumnDimension('E')->setWidth(26.40);
$sheet->getColumnDimension('F')->setWidth(6);
$sheet->getColumnDimension('G')->setWidth(25.30);
$sheet->getColumnDimension('H')->setWidth(4.70);
$sheet->getColumnDimension('I')->setWidth(10);
$sheet->getColumnDimension('J')->setWidth(12.90);
$sheet->getColumnDimension('K')->setWidth(21.20);
$sheet->getColumnDimension('L')->setWidth(8.20);
$sheet->getColumnDimension('M')->setWidth(8.20);
$sheet->getColumnDimension('N')->setWidth(8.20);


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

$sheet->getStyle('A1:N1')->applyFromArray($topBorderStyle);
$sheet->getStyle('A1:N10')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A1:N10')->applyFromArray($rightBorderStyle);

$sheet->getStyle('M9:N9')->applyFromArray($thin_bottomBorderStyle);

$footer_start_row = $current_row-8;

$sheet->getStyle('A11:N'.$footer_start_row)->applyFromArray($allBorderStyle);

$sheet->getStyle('A'.$footer_start_row.':N'.$current_row)->applyFromArray($leftBorderStyle);
$sheet->getStyle('A'.$footer_start_row.':N'.$current_row)->applyFromArray($rightBorderStyle);
$sheet->getStyle('A'.$current_row.':N'.$current_row)->applyFromArray($bottomBorderStyle);


//---------------------------------------------------------------------------------------------

$sheet->getPageMargins()->setTop(1 / 2.54);
$sheet->getPageMargins()->setLeft(1 / 2.54);
$sheet->getPageMargins()->setRight(1 / 2.54);
$sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:X'.$current_row);

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TDP_Annex_10_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;


?>