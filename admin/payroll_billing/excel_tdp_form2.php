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
    $filename = "New TDP Form 2 - Annex 7";
    $filetitle = "CONSOLIDATED NEW TDP DETAILS";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TDP Continuing Form 2 - Annex 5";
    $filetitle = "CONSOLIDATED CONTINUING TDP GRANTEES DETAILS";

}else{
    $filetitle = "CONSOLIDATED TDP DETAILS";

}

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle($filename); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

//---------------------------------------------------------------------------------

$sheet->mergeCells('N1:Q1');
$sheet->setCellValue('N1', $filename);
$sheet->getStyle('N1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('N1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('N1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('A2:Q2');

$sheet->mergeCells('A3:Q3');
$sheet->setCellValue('A3', 'Republic of the Philippines');
$sheet->getStyle('A3')->getFont()->setSize(12);
$sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A4:Q4');
$sheet->setCellValue('A4', 'KOLEHIYO NG LUNGSOD NG LIPA');
$sheet->getStyle('A4')->getFont()->setBold(true)->setItalic(true);
$sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$sheet->mergeCells('A5:Q5');
$sheet->setCellValue('A5', 'MARAWOY LIPA CITY');
$sheet->getStyle('A5')->getFont()->setBold(true)->setItalic(true);
$sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


$drawingChed = new Drawing();
$drawingChed->setName('CHED Logo');
$drawingChed->setDescription('CHED Logo');
$drawingChed->setPath($destinationChedLogo);
$drawingChed->setHeight(60); // Set height of the image in points (pixels)
$drawingChed->setCoordinates('E3'); // Position where the image should be placed
$drawingChed->setOffsetX(120);
$drawingChed->setWorksheet($sheet);

$drawingChed = new Drawing();
$drawingChed->setName('Unifast Logo');
$drawingChed->setDescription('Unifast Logo');
$drawingChed->setPath($destinationUnifastLogo);
$drawingChed->setHeight(60); 
$drawingChed->setCoordinates('M3'); 
$drawingChed->setWorksheet($sheet);

$sheet->mergeCells('A6:Q6');

$sheet->mergeCells('A7:Q8');
$sheet->setCellValue('A7', $filetitle);
$sheet->getStyle('A7')->getFont()->setBold(true)->setSize(20);
$sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A7')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->mergeCells('M9:O9');
$sheet->setCellValue('M9', 'TDP Billing Details Reference Number: ');
$sheet->getStyle('M9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->mergeCells('P9:Q9');

$sheet->mergeCells('M10:O10');
$sheet->setCellValue('M10', 'Date:');
$sheet->getStyle('M10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->mergeCells('P10:Q10');
$sheet->setCellValue('P10', $formatDate);
$sheet->getStyle('P10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('A11:E11');
$sheet->setCellValue('A11', 'INSTRUCTIONS');
$sheet->getStyle('A11')->getFont()->setBold(true);
$sheet->getStyle('A11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('A12:E12');

$sheet->mergeCells('A15:E15');
$sheet->mergeCells('A16:E16');
$sheet->mergeCells('A17:E17');
$sheet->mergeCells('A18:E18');
$sheet->mergeCells('A19:E19');
$sheet->mergeCells('A20:E20');
$sheet->mergeCells('A21:E21');
$sheet->mergeCells('A22:E22');
$sheet->mergeCells('A23:E23');
$sheet->mergeCells('A24:E24');

$sheet->mergeCells('F11:Q11');
$sheet->mergeCells('F12:Q12');
$sheet->mergeCells('F13:Q13');
$sheet->mergeCells('F14:Q14');
$sheet->mergeCells('F15:Q15');
$sheet->mergeCells('F16:Q16');
$sheet->mergeCells('F17:Q17');
$sheet->mergeCells('F18:Q18');
$sheet->mergeCells('F19:Q19');
$sheet->mergeCells('F20:Q20');
$sheet->mergeCells('F21:Q21');
$sheet->mergeCells('F22:Q22');
$sheet->mergeCells('F23:Q23');
$sheet->mergeCells('F24:Q24');

if($_GET["slct_apptype"] == "New"){
    $sheet->mergeCells('A13:E14');

    $sheet->setCellValue('A13', '1.  In the table below, list down the names of enrolled new TDP grantees per campus in alphabetical order, if applicable, (1) by campus; (2) by college; (3) by program; and (4) by student name (Last Name, First Name, MI).');
    $sheet->getStyle('A13')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('A16', '2.  Include and update all information required in the space provided.');
    $sheet->getStyle('A16')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('A18', '3.  Assign a 5-digit Control Number for each enrolled student. The control numbers should be assigned in chronological order to the students listed according to instruction no. 1.');
    $sheet->getStyle('A18')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $sheet->getRowDimension(18)->setRowHeight(30);


    $sheet->setCellValue('A20', '4.  Submit pdf files of the Certificate of Registration (COR) of Official Enrollment in the '.$semester);
    $sheet->getStyle('A20')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('A21', 'of Academic Year '.$academic_year.'  in the order as it appears in the TDP New Form 2.');
    $sheet->getStyle('A21')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);


    $sheet->setCellValue('F13', '5.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:');
    $sheet->getStyle('F13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('F14', '5.1  New TDP Form 1');
    $sheet->getStyle('F14')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);

    $sheet->setCellValue('F15', '5.2  New TDP Form 2');
    $sheet->getStyle('F15')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);

    $sheet->setCellValue('F16', '5.3  New TDP Form 3');
    $sheet->getStyle('F16')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);

    
}else if($_GET["slct_apptype"] == "Continuing"){
    $sheet->mergeCells('A13:E13');
    $sheet->mergeCells('A14:E14');

    $sheet->setCellValue('A13', '1.  Include only in this form the names of continuing grantees WHO ARE CURRENTLY ENROLLED this semester.');
    $sheet->getStyle('A13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('A15', '2.  In the table below, list down the names of enrolled continuing TDP grantees per campus in alphabetical order, if applicable, (1) by campus; (2) by college; (3) by program; and (4) by student name (Last Name, First Name, MI).');
    $sheet->getStyle('A15')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $sheet->getRowDimension(15)->setRowHeight(30);


    $sheet->setCellValue('A18', '3.  Include and update all information required in the space provided.');
    $sheet->getStyle('A18')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('A20', '4.  Assign a 5-digit Control Number for each enrolled student. The control numbers should be assigned in chronological order to the students listed according to instruction no. 2.');
    $sheet->getStyle('A20')->getAlignment()->setWrapText(true)->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $sheet->getRowDimension(20)->setRowHeight(30);

    $sheet->setCellValue('A22', '5.  Submit pdf files of the Certificate of Registration (COR) of Official Enrollment in the '.$semester);
    $sheet->getStyle('A22')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('A23', 'of Academic Year '.$academic_year.'  in the order as it appears in the TDP New Form 2.');
    $sheet->getStyle('A23')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);


    $sheet->setCellValue('F13', '6.  Submit the Notarized Certification of TDP Grantees, as an endorsement document, for all the PDF files of the CORs submitted.');
    $sheet->getStyle('F13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('F15', '7.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:');
    $sheet->getStyle('F15')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

    $sheet->setCellValue('F16', '7.1  TDP Continuing Form 1');
    $sheet->getStyle('F16')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);

    $sheet->setCellValue('F17', '7.2  TDP Continuing Form 2');
    $sheet->getStyle('F17')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);

    $sheet->setCellValue('F18', '7.3  TDP Continuing Form 3');
    $sheet->getStyle('F18')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);

    $sheet->setCellValue('F19', '7.4  Notarized Registrar\'s Certification');
    $sheet->getStyle('F19')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);
}

$sheet->mergeCells('A25:B25');
$sheet->setCellValue('A25', 'To:');
$sheet->getStyle('A25')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('C25:Q25');
$sheet->setCellValue('C25', 'CHED - Regional Office _______________');
$sheet->getStyle('C25')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('C25')->getFont()->setBold(true);


$sheet->mergeCells('A26:B26');
$sheet->setCellValue('A26', 'Address:');
$sheet->getStyle('A26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('C26:Q26');
$sheet->setCellValue('C26', 'CHED Region IVA Bldg. Jose P. Laurel Highway');
$sheet->getStyle('C26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('C26')->getFont()->setBold(true);

$sheet->mergeCells('A27:A30');

$sheet->mergeCells('B27:Q27');
$sheet->setCellValue('B27', 'TDP Continuing Grantees Details:');
$sheet->getStyle('B27')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('B27')->getFont()->setBold(true);

$sheet->mergeCells('B28:F28');
$sheet->setCellValue('B28', 'TDP will have to be listed and tabulated PER CAMPUS.  The Total Amount of the TDP for all');
$sheet->getStyle('B28')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('B28')->getFont()->setItalic(true)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); 

$sheet->mergeCells('B29:G29');
$sheet->setCellValue('B29', 'campuses should tally with the total amount of TDP in the Billing Statement ');
$sheet->getStyle('B29')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('B29')->getFont()->setItalic(true)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); 

$sheet->mergeCells('B30:G30');
$sheet->setCellValue('B30', 'Note:  Please insert additional line as needed');
$sheet->getStyle('B30')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('B30')->getFont()->setItalic(true);

$sheet->mergeCells('H28:Q30');

$sheet->mergeCells('B31:Q31');
$sheet->setCellValue('B31', 'Tulong Dunong Program : Based on R.A. No. 10931');
$sheet->getStyle('B31')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('B31')->getFont()->setBold(true);

$sheet->mergeCells('D32:F32');
$sheet->setCellValue('D32', 'Student\'s Name');
$sheet->getStyle('D32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('D32')->getFont()->setBold(true);

$sheet->mergeCells('H32:J32');
$sheet->setCellValue('H32', 'Student Profile');
$sheet->getStyle('H32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('H32')->getFont()->setBold(true);

$sheet->mergeCells('L32:N32');
$sheet->setCellValue('L32', 'Contact Information');
$sheet->getStyle('L32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('L32')->getFont()->setBold(true);

$sheet->mergeCells('O32:P32');
$sheet->setCellValue('O32', 'TDP-TES Grant');
$sheet->getStyle('O32')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('O32')->getFont()->setBold(true);

$sheet->getRowDimension(33)->setRowHeight(97.80);

$sheet->setCellValue('A33', '5-digit Control Number');
$sheet->getStyle('A33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('B33', 'Student Number');
$sheet->getStyle('B33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('C33', 'TDP Award Number');
$sheet->getStyle('C33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('D33', 'Last Name');
$sheet->getStyle('D33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('E33', 'Given Name');
$sheet->getStyle('E33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('F33', 'Middle Initial');
$sheet->getStyle('F33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('G33', 'Sex at Birth (M/F)');
$sheet->getStyle('G33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('H33', 'Birthdate (mm/dd/yyyy)');
$sheet->getStyle('H33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('I33', 'Degree Program');
$sheet->getStyle('I33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('J33', 'Year Level');
$sheet->getStyle('J33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('K33', 'Total Academic Units Enrolled (credit and non-credit courses)');
$sheet->getStyle('K33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('L33', 'Zip Code');
$sheet->getStyle('L33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('M33', 'Email Address');
$sheet->getStyle('M33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('N33', 'Phone Number');
$sheet->getStyle('N33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('O33', '1st Semester');
$sheet->getStyle('O33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('P33', '2nd Semester');
$sheet->getStyle('P33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

$sheet->setCellValue('Q33', 'Total Amount');
$sheet->getStyle('Q33')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
$sheet->getStyle('Q33')->getFont()->setBold(true);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Decrypt the necessary fields
    $row['application_num'] = openssl_decrypt($row['application_num'], $method, $key);
    $row['application_date'] = openssl_decrypt($row['application_date'], $method, $key);
    $row['applicant_type'] = openssl_decrypt($row['applicant_type'], $method, $key);
    $row['academic_year'] = openssl_decrypt($row['academic_year'], $method, $key);
    $row['semester'] = openssl_decrypt($row['semester'], $method, $key);
    $row['program_name'] = openssl_decrypt($row['program_name'], $method, $key);
    $row['last_name'] = openssl_decrypt($row['last_name'], $method, $key);
    $row['first_name'] = openssl_decrypt($row['first_name'], $method, $key);
    $row['middle_name'] = openssl_decrypt($row['middle_name'], $method, $key);
    $row['birthdate'] = openssl_decrypt($row['birthdate'], $method, $key);
    $row['sex'] = openssl_decrypt($row['sex'], $method, $key);
    $row['yearlevel'] = openssl_decrypt($row['yearlevel'], $method, $key);
    $row['scholarship_name'] = openssl_decrypt($row['scholarship_name'], $method, $key);
    $row['postal_code'] = openssl_decrypt($row['postal_code'], $method, $key);
    $row['email'] = openssl_decrypt($row['email'], $method, $key);
    $row['contact'] = openssl_decrypt($row['contact'], $method, $key);
    $row['award_number'] = openssl_decrypt($row['award_number'], $method, $key);
    $row['student_number'] = openssl_decrypt($row['student_number'], $method, $key);
    $row['total_units'] = openssl_decrypt($row['total_units'], $method, $key);
    $row['1st_semester'] = openssl_decrypt($row['1st_semester'], $method, $key);
    $row['2nd_semester'] = openssl_decrypt($row['2nd_semester'], $method, $key);
    $data[] = $row;
}

// Sort the data by last name
usort($data, function($a, $b) {
    if ($a['program_name'] == $b['program_name']) {
        return strcmp($a['last_name'], $b['last_name']);
    }
    return strcmp($a['program_name'], $b['program_name']);
});

// Initialize totals
$total_firstgrant = 0;
$total_secondgrant = 0;
$total_accumulated = 0;
$n = 1;

$starting_row = 34;
$current_row = 34;

foreach ($data as $row) {
    $total_amount = 0;
    $application_num = $row['application_num'];
    $application_date = $row['application_date'];
    $applydate_create = date_create($application_date);
    $format_applydate = date_format($applydate_create, "F j, Y");
    $type = $row['applicant_type'];
    $academic_year = $row['academic_year'];
    $semester = $row['semester'];
    $program_name = $row['program_name'];
    $last_name = $row['last_name'];
    $first_name = $row['first_name'];
    $middle_name = $row['middle_name'];
    $birthdate = $row['birthdate'];
    $birthdate_create = date_create($birthdate);
    $format_birthdate = date_format($birthdate_create, "m/d/Y");
    $sex = $row['sex'];
    $yearlevel = $row['yearlevel'];
    $scholarship_name = $row['scholarship_name'];
    $postal_code = $row['postal_code'];
    $email = $row['email'];
    $contact = $row['contact'];
    $award_number = $row['award_number'];
    $student_number = $row['student_number'];
    $total_units = $row['total_units'];
    $first_semester = $row['1st_semester'];
    $second_semester = $row['2nd_semester'];

    if ($first_semester != null) {
        $total_firstgrant += floatval($first_semester);
        $total_amount += floatval($first_semester);
        $total_accumulated += floatval($first_semester);
        $first_semester = number_format($first_semester, 2, '.', ',');
    } else {
        $first_semester = " - ";
    }

    if ($second_semester != null) {
        $total_secondgrant += floatval($second_semester);
        $total_amount += floatval($second_semester);
        $total_accumulated += floatval($second_semester);
        $second_semester = number_format($second_semester, 2, '.', ',');
    } else {
        $second_semester = " - ";
    }

    $middle_initial = strtoupper(substr($middle_name, 0, 1));
    $yearnum = strtoupper(substr($yearlevel, 0, 1));
    $formattedRowNumber = sprintf("%05d", $n);

    //----------display the records------------------------------

    $sheet->setCellValue('A'.$current_row, $formattedRowNumber);
    $sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('B'.$current_row, $student_number);
    $sheet->getStyle('B'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('C'.$current_row, $award_number);
    $sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('D'.$current_row, $last_name);
    $sheet->getStyle('D'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('E'.$current_row, $first_name);
    $sheet->getStyle('E'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('F'.$current_row, $middle_initial);
    $sheet->getStyle('F'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('G'.$current_row, $sex);
    $sheet->getStyle('G'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('H'.$current_row, $format_birthdate);
    $sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('I'.$current_row, $program_name);
    $sheet->getStyle('I'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('J'.$current_row, $yearnum);
    $sheet->getStyle('J'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('K'.$current_row, $total_units);
    $sheet->getStyle('K'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('L'.$current_row, $postal_code);
    $sheet->getStyle('L'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('M'.$current_row, $email);
    $sheet->getStyle('M'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('N'.$current_row, $contact);
    $sheet->getStyle('N'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('O'.$current_row, $first_semester);
    $sheet->getStyle('O'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('P'.$current_row, $second_semester);
    $sheet->getStyle('P'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $sheet->setCellValue('Q'.$current_row, ($total_amount != 0 ? number_format($total_amount, 2, '.', ',') : '-'));
    $sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);

    $current_row++;
    $n++;
}

$support_amount = $total_accumulated * 0.005;

$sheet->mergeCells('A'.$current_row.':B'.$current_row);
$sheet->setCellValue('A'.$current_row, 'Page Total');
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
//$sheet->getStyle('A'.$current_row)->getFont()->setBold(true);

$sheet->setCellValue('O'.$current_row, ($total_firstgrant != 0 ? number_format($total_firstgrant, 2, '.', ',') : '-'));
$sheet->getStyle('O'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->setCellValue('P'.$current_row, ($total_secondgrant != 0 ? number_format($total_secondgrant, 2, '.', ',') : '-'));
$sheet->getStyle('P'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->setCellValue('Q'.$current_row, ($total_accumulated != 0 ? number_format($total_accumulated, 2, '.', ',') : '-'));
$sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row++;

$sheet->mergeCells('A'.$current_row.':B'.$current_row);
$sheet->setCellValue('A'.$current_row, 'Page Accumulated Total');
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->setCellValue('O'.$current_row, ($total_firstgrant != 0 ? number_format($total_firstgrant, 2, '.', ',') : '-'));
$sheet->getStyle('O'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->setCellValue('P'.$current_row, ($total_secondgrant != 0 ? number_format($total_secondgrant, 2, '.', ',') : '-'));
$sheet->getStyle('P'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->setCellValue('Q'.$current_row, ($total_accumulated != 0 ? number_format($total_accumulated, 2, '.', ',') : '-'));
$sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row++;

$sheet->mergeCells('A'.$current_row.':P'.$current_row);
$sheet->setCellValue('A'.$current_row, 'TOTAL TULONG DUNONG PROGRAM');
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('A'.$current_row)->getFont()->setBold(true);

$sheet->setCellValue('Q'.$current_row, ($total_accumulated != 0 ? number_format($total_accumulated, 2, '.', ',') : '-'));
$sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row++;

$sheet->mergeCells('A'.$current_row.':P'.$current_row);
$sheet->setCellValue('A'.$current_row, 'Add .5 percent (.005%) Administrative Support for Partner Institutions');
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('A'.$current_row)->getFont()->setBold(true);

$sheet->setCellValue('Q'.$current_row, ($support_amount != 0 ? number_format(floatval($support_amount), 2, '.', ',') : '-'));
$sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row++;

$sheet->mergeCells('A'.$current_row.':P'.$current_row);
$sheet->setCellValue('A'.$current_row, 'TOTAL TDP BILLING PER CAMPUS');
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('A'.$current_row)->getFont()->setBold(true);

$sheet->setCellValue('Q'.$current_row, ($support_amount != 0 ? number_format(floatval($support_amount+$total_accumulated), 2, '.', ',') : '-'));
$sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row++;

$sheet->mergeCells('A'.$current_row.':P'.$current_row);
$sheet->setCellValue('A'.$current_row, 'TOTAL TDP BILLING ALL CAMPUSES');
$sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('A'.$current_row)->getFont()->setBold(true);

$sheet->setCellValue('Q'.$current_row, ($support_amount != 0 ? number_format(floatval($support_amount+$total_accumulated), 2, '.', ',') : '-'));
$sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$current_row+=2;

$sheet->mergeCells('C'.$current_row.':D'.$current_row);
$sheet->setCellValue('C'.$current_row, 'As to corectness of enrollment data');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('H'.$current_row.':I'.$current_row);
$sheet->setCellValue('H'.$current_row, 'As to correctness of financial data');
$sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('N'.$current_row);
$sheet->setCellValue('N'.$current_row, 'Approved By:');
$sheet->getStyle('N'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$current_row+=3;

$sheet->mergeCells('C'.$current_row.':D'.$current_row);
$sheet->setCellValue('C'.$current_row, 'JINGEL H. LEYNES');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('C'.$current_row)->getFont()->setBold(true);

$sheet->mergeCells('H'.$current_row.':I'.$current_row);
$sheet->setCellValue('H'.$current_row, 'TERESITA V. ESPLAGO');
$sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('H'.$current_row)->getFont()->setBold(true);

$sheet->mergeCells('N'.$current_row.':O'.$current_row);
$sheet->setCellValue('N'.$current_row, 'MARIO CARMELO A. PESA');
$sheet->getStyle('N'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('N'.$current_row)->getFont()->setBold(true);

$current_row++;

$sheet->mergeCells('C'.$current_row.':D'.$current_row);
$sheet->setCellValue('C'.$current_row, 'College Registrar');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('H'.$current_row.':I'.$current_row);
$sheet->setCellValue('H'.$current_row, 'Vice President for Administration, Planning and Finance');
$sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('N'.$current_row.':O'.$current_row);
$sheet->setCellValue('N'.$current_row, 'College Administrator');
$sheet->getStyle('N'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$current_row++;
$sheet->mergeCells('C'.$current_row.':D'.$current_row);
$sheet->setCellValue('C'.$current_row, 'UniFast Focal Person and Scholarship Coordinator');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$current_row++;

//-----------------------------------------------------------------------------------

$sheet->getColumnDimension('A')->setWidth(9.33);
$sheet->getColumnDimension('B')->setWidth(15.67);
$sheet->getColumnDimension('C')->setWidth(26.78);
$sheet->getColumnDimension('D')->setWidth(22.11);
$sheet->getColumnDimension('E')->setWidth(38.78);
$sheet->getColumnDimension('F')->setWidth(7.22);
$sheet->getColumnDimension('G')->setWidth(6.89);
$sheet->getColumnDimension('H')->setWidth(6.89);
$sheet->getColumnDimension('I')->setWidth(50.22);
$sheet->getColumnDimension('J')->setWidth(5.78);
$sheet->getColumnDimension('K')->setWidth(8.22);
$sheet->getColumnDimension('L')->setWidth(5.78);
$sheet->getColumnDimension('M')->setWidth(42.67);
$sheet->getColumnDimension('N')->setWidth(15.44);
$sheet->getColumnDimension('O')->setWidth(15.22);
$sheet->getColumnDimension('P')->setWidth(6.67);
$sheet->getColumnDimension('Q')->setWidth(20.22);



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

$sheet->getStyle('A1:Q1')->applyFromArray($topBorderStyle);
$sheet->getStyle('A1:Q1')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A1:Q1')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A2:Q8')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A2:Q8')->applyFromArray($rightBorderStyle);


$sheet->getStyle('A9:A10')->applyFromArray($leftBorderStyle);
$sheet->getStyle('P9:Q10')->applyFromArray($rightBorderStyle);

$sheet->getStyle('P9:Q9')->applyFromArray($thin_bottomBorderStyle);

$sheet->getStyle('A11:Q11')->applyFromArray($topBorderStyle);

$sheet->getStyle('A11:E24')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A11:E24')->applyFromArray($rightBorderStyle);

$sheet->getStyle('F11:Q24')->applyFromArray($leftBorderStyle);
$sheet->getStyle('F11:Q24')->applyFromArray($rightBorderStyle);

$sheet->getStyle('A25:Q26')->applyFromArray($rightBorderStyle);
$sheet->getStyle('A25:Q26')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A25:Q25')->applyFromArray($topBorderStyle);
$sheet->getStyle('A26:Q26')->applyFromArray($topBorderStyle);
$sheet->getStyle('A26:Q26')->applyFromArray($bottomBorderStyle);

$sheet->getStyle('A27:Q33')->applyFromArray($allBorderStyle);

$footer_start_row = $current_row-8;
$sheet->getStyle('A'.$starting_row.':Q'.$footer_start_row)->applyFromArray($allBorderStyle);

$sheet->getStyle('A'.$footer_start_row.':Q'.$current_row)->applyFromArray($leftBorderStyle);
$sheet->getStyle('A'.$footer_start_row.':Q'.$current_row)->applyFromArray($rightBorderStyle);
$sheet->getStyle('A'.$current_row.':Q'.$current_row)->applyFromArray($bottomBorderStyle);






//---------------------------------------------------------------------------------------------

$sheet->getPageMargins()->setTop(1 / 2.54);
$sheet->getPageMargins()->setLeft(1 / 2.54);
$sheet->getPageMargins()->setRight(1 / 2.54);
$sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:X'.$current_row);

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;



?>