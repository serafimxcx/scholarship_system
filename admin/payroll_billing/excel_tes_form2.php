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
    $filename = " Annex 5 - TES New Form 2";
    $filetitle = "CONSOLIDATED TES NEW DETAILS";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TES Continuing Form 2 - Annex 2";
    $filetitle = "CONSOLIDATED CONTINUING TES GRANTEES DETAILS";

}else{
    $filetitle = "CONSOLIDATED TES DETAILS";
    $filename = "TES Form 2";

}

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle($filename); // Set sheet title

// Set default font and font size
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);


//----------------------------------------------------------------------------

$sheet->mergeCells('P1:S1');
$sheet->setCellValue('P1', $filename);
$sheet->getStyle('P1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('P1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('P1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('A3:S3');
$sheet->setCellValue('A3', 'Republic of the Philippines');
$sheet->getStyle('A3')->getFont()->setSize(12);
$sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A4:S4');
$sheet->setCellValue('A4', 'KOLEHIYO NG LUNGSOD NG LIPA');
$sheet->getStyle('A4')->getFont()->setBold(true)->setItalic(true)->setSize(12);
$sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheet->mergeCells('A5:S5');
$sheet->setCellValue('A5', 'MARAWOY LIPA CITY');
$sheet->getStyle('A5')->getFont()->setItalic(true)->setSize(12);
$sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$drawingChed = new Drawing();
$drawingChed->setName('CHED Logo');
$drawingChed->setDescription('CHED Logo');
$drawingChed->setPath($destinationChedLogo);
$drawingChed->setHeight(50); // Set height of the image in points (pixels)
$drawingChed->setCoordinates('F2'); // Position where the image should be placed
$drawingChed->setWorksheet($sheet);

$drawingChed = new Drawing();
$drawingChed->setName('Unifast Logo');
$drawingChed->setDescription('Unifast Logo');
$drawingChed->setPath($destinationUnifastLogo);
$drawingChed->setHeight(50); 
$drawingChed->setCoordinates('M2'); 
//$drawingChed->setOffsetX(25);
$drawingChed->setWorksheet($sheet);

$sheet->mergeCells('A7:S8');
$sheet->setCellValue('A7', $filetitle);
$sheet->getStyle('A7')->getFont()->setBold(true)->setSize(20);
$sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A7')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('P9:R9');
$sheet->setCellValue('P9', 'TES Billing Details Reference Number:  ');
$sheet->getStyle('P9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('P9')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


$sheet->mergeCells('P10:R10');
$sheet->setCellValue('P10', 'Date:');
$sheet->getStyle('P10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
$sheet->getStyle('P10')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$sheet->setCellValue('S10', $formatDate);
$sheet->getStyle('S10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$sheet->getStyle('S10')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

if($_GET["slct_apptype"] == "Continuing"){

    $sheet->mergeCells('A11:E11');
    $sheet->setCellValue('A11', 'INSTRUCTIONS');
    $sheet->getStyle('A11')->getFont()->setBold(true);

    $sheet->mergeCells('A12:E12');
    $sheet->setCellValue('A12', '1.  Generate the list of continuing TES grantees from the HEI Portal. Include only in this form the names of continuing grantees WHO ARE CURRENTLY ENROLLED this semester.');
    $sheet->getStyle('A12')->getAlignment()->setVertical(Alignment::VERTICAL_TOP)->setWrapText(true);
    $sheet->getRowDimension(12)->setRowHeight(30.60);

    $sheet->mergeCells('A15:E15');
    $sheet->setCellValue('A15', '2.  In the table below, list down the names of enrolled continuing TES grantees per campus in alphabetical order, ');

    $sheet->mergeCells('A16:E16');
    $sheet->setCellValue('A16', 'if applicable, (1) by campus; (2) by college; (3) by program; and (4) by student name (Last Name, First Name, MI).');

    $sheet->mergeCells('A18:E18');
    $sheet->setCellValue('A18', '3.  Include and update all information required in the space provided.');

    $sheet->mergeCells('A20:E20');
    $sheet->setCellValue('A20', '4.  Assign a 5-digit Control Number for each enrolled student. The control numbers should be assigned in ');

    $sheet->mergeCells('A21:E21');
    $sheet->setCellValue('A21', 'chronological order to the students listed according to instruction no. 2.');

    $sheet->mergeCells('A23:E23');
    $sheet->setCellValue('A23', '5.  Submit pdf files of the Certificate of Registration (COR) of Official Enrollment in the '.$semester);

    $sheet->mergeCells('A24:E24');
    $sheet->setCellValue('A24', 'Semester of Academic Year '.$academic_year.'  in the order as it appears in the TES Continuing Form 2.');

    $sheet->mergeCells('F12:O12');
    $sheet->setCellValue('F12', '6.  Submit the Notarized Certification of TES Grantees, as an endorsement document, for all the PDF files of the CORs');

    $sheet->mergeCells('F15:O15');
    $sheet->setCellValue('F15', '7.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:');

    $sheet->mergeCells('F16:O16');
    $sheet->setCellValue('F16', '           7.1 TES Continuing Form 1');

    $sheet->mergeCells('F17:O17');
    $sheet->setCellValue('F17', '           7.2 TES Continuing Form 2');

    $sheet->mergeCells('F18:O18');
    $sheet->setCellValue('F18', '           7.3 TES Continuing Form 3');

    $sheet->mergeCells('F19:O19');
    $sheet->setCellValue('F19', '           7.4 Notarized Registrar\'s Certification');

    $sheet->setCellValue('A26', 'To');

    $sheet->mergeCells('C26:S26');
    $sheet->setCellValue('C26', 'CHED - Regional Office IV-A');
    $sheet->getStyle('C26')->getFont()->setBold(true);

    $sheet->setCellValue('A27', 'Address');

    $sheet->mergeCells('C27:S27');
    $sheet->setCellValue('C27', 'Jose P. Laurel Highway, City Hall Compound, Barangay Marawoy, Lipa City');
    $sheet->getStyle('C27')->getFont()->setBold(true);

    $sheet->mergeCells('B28:S28');
    $sheet->setCellValue('B28', 'TES Continuing Grantees Details:');
    $sheet->getStyle('B28')->getFont()->setBold(true);

    $sheet->mergeCells('B29:S29');
    $sheet->setCellValue('B29', 'TES will have to be listed and tabulated PER CAMPUS.  The Total Number of TES  grantees for all');
    $sheet->getStyle('B29')->getFont()->setItalic(true);

    $sheet->mergeCells('B30:S30');
    $sheet->setCellValue('B30', 'campuses should tally with the total number of TES in the Annex 2-TES Continuing Form 1');
    $sheet->getStyle('B30')->getFont()->setItalic(true);

    $sheet->mergeCells('B31:S31');
    $sheet->setCellValue('B31', ' Note:  Please insert additional line as needed');
    $sheet->getStyle('B31')->getFont()->setItalic(true);



}else if($_GET["slct_apptype"] == "New"){
    
    $sheet->mergeCells('A11:O11');
    $sheet->setCellValue('A11', 'INSTRUCTIONS');
    $sheet->getStyle('A11')->getFont()->setBold(true);

    $sheet->mergeCells('A12:O12');
    $sheet->setCellValue('A12', '1.  In the table below, list down the names of enrolled TES qualified grantees per campus in alphabetical order, if applicable, (1) by campus; (2) by college; (3) by program; and (4) by student name (Last Name, First Name, MI).');

    $sheet->mergeCells('A14:O14');
    $sheet->setCellValue('A14', '2.  Include and update all information required in the space provided.');

    $sheet->mergeCells('A16:O16');
    $sheet->setCellValue('A16', '3.  Assign a 5-digit Control Number for each enrolled student. The control numbers should be assigned in chronological order to the students listed according to instruction no. 1.');

    $sheet->mergeCells('A18:O18');
    $sheet->setCellValue('A18', '4.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:');

    $sheet->mergeCells('A19:O19');
    $sheet->setCellValue('A19', '           4.1 TES New Form 1');

    $sheet->mergeCells('A20:O20');
    $sheet->setCellValue('A20', '           4.2 TES New Form 2');

    $sheet->mergeCells('A21:O21');
    $sheet->setCellValue('A21', '           4.3 Notarized Registrar\'s Certification');

    $sheet->mergeCells('A22:O22');
    $sheet->setCellValue('A22', '5. Additional Documentary Requirements (if applicable)');

    $sheet->mergeCells('A23:O23');
    $sheet->setCellValue('A23', '           5.1 Certificate of residency for qualified grantees under the PNSL category');

    $sheet->mergeCells('A24:O24');
    $sheet->setCellValue('A24', '           5.2 Copy of PWD ID (for qualified grantees that is Person with disability)');

    $sheet->mergeCells('A25:B25');
    $sheet->setCellValue('A25', 'To: ');

    $sheet->mergeCells('C25:S25');
    $sheet->setCellValue('C25', 'CHED - Regional Office _______________');
    $sheet->getStyle('C25')->getFont()->setBold(true);

    $sheet->mergeCells('A26:B26');
    $sheet->setCellValue('A26', 'Address: ');

    $sheet->mergeCells('C26:S26');
    $sheet->setCellValue('C26', 'Address of CHED Regional Office');
    $sheet->getStyle('C26')->getFont()->setBold(true);

    $sheet->mergeCells('A27:B27');
    $sheet->setCellValue('A27', 'Copy Furnished: ');

    $sheet->mergeCells('C27:S27');
    $sheet->setCellValue('C27', 'UniFAST Secretariat ');
    $sheet->getStyle('C27')->getFont()->setBold(true);

    $sheet->mergeCells('B28:S28');
    $sheet->setCellValue('B28', 'TES New Grantees Summary:');
    $sheet->getStyle('B28')->getFont()->setBold(true);

    $sheet->mergeCells('B29:F29');
    $sheet->setCellValue('B29', 'TES will have to be listed and tabulated PER CAMPUS.  The Total Amount of the TES for all');

    $sheet->mergeCells('B30:G30');
    $sheet->setCellValue('B30', 'campuses should tally with the total amount of TES in the Annex 5-TES New Form 1');

    $sheet->mergeCells('B31:G31');
    $sheet->setCellValue('B31', 'Note:  Please insert additional line as needed');

    $sheet->mergeCells('H29:S31');


}

$sheet->mergeCells('B32:S32');
$sheet->setCellValue('B32', 'Tertiary Education Subsidy : Based on Section 23 of Rule IV of IRR of R.A. No. 10931');
$sheet->getStyle('B32')->getFont()->setBold(true);

$sheet->getStyle('A33:S34')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
$sheet->getRowDimension(34)->setRowHeight(67.20);

$sheet->mergeCells('D33:F33');
$sheet->setCellValue('D33', 'Student\'s Name');
$sheet->getStyle('D33')->getFont()->setBold(true);

$sheet->mergeCells('G33:K33');
$sheet->setCellValue('G33', 'Student Profile');
$sheet->getStyle('G33')->getFont()->setBold(true);

$sheet->mergeCells('L33:N33');
$sheet->setCellValue('L33', 'Contact Information');
$sheet->getStyle('L33')->getFont()->setBold(true);

$sheet->setCellValue('A34', '5-digit Control Number');
$sheet->setCellValue('B34', 'Student Number');
$sheet->setCellValue('C34', 'TES Award Number');
$sheet->setCellValue('D34', 'Last Name');
$sheet->setCellValue('E34', 'Given Name');
$sheet->setCellValue('F34', 'Middle Initial');
$sheet->setCellValue('G34', 'Sex at Birth (M/F)');
$sheet->setCellValue('H34', 'Birthdate (mm/dd/yyyy)');
$sheet->setCellValue('I34', 'Degree Program');
$sheet->setCellValue('J34', 'Year Level');
$sheet->setCellValue('K34', 'Academic Units Enrolled (credit and non-credit courses)');
$sheet->setCellValue('L34', 'ZIP Code');
$sheet->setCellValue('M34', 'Email Address');
$sheet->setCellValue('N34', 'Phone Number');



if($_GET["slct_apptype"] == "Continuing"){

    $sheet->mergeCells('O33:P33');
    $sheet->setCellValue('O33', 'TES-1 (for Private HEIs only)');
    $sheet->getStyle('O33')->getFont()->setBold(true);

    $sheet->mergeCells('Q33');
    $sheet->setCellValue('Q33', 'TES-2');
    $sheet->getStyle('Q33')->getFont()->setBold(true);

    $sheet->mergeCells('R33');
    $sheet->setCellValue('R33', 'TES-3A');
    $sheet->getStyle('R33')->getFont()->setBold(true);

    $sheet->setCellValue('O34', 'Actual Tuition and Other School Fees for 1st and / or 2nd semester AY (_______)');
    $sheet->setCellValue('P34', 'Billed Amount');
    $sheet->setCellValue('Q34', 'Stipend');
    $sheet->setCellValue('R34', 'Person with Disability');



}else if($_GET["slct_apptype"] == "New"){
    $sheet->mergeCells('O33:P33');
    $sheet->setCellValue('O33', 'TES Benefits');
    $sheet->getStyle('O33')->getFont()->setBold(true);

    $sheet->mergeCells('Q33:R33');
    $sheet->setCellValue('Q33', 'TES 3A');
    $sheet->getStyle('Q33')->getFont()->setBold(true);

    $sheet->mergeCells('O34:P34');
    $sheet->setCellValue('O34', 'Amount');

    $sheet->mergeCells('Q34:R34');
    $sheet->setCellValue('Q34', 'Person with Disability');
}

$sheet->setCellValue('S34', 'TOTAL AMOUNT');
$sheet->getStyle('S34')->getFont()->setBold(true);

// Initialize an array to store student data
$data = [];
$total_accumulated = 0;
$n = 1;

$starting_row = 35;
$current_row = 35;

// Fetch data from the database and decrypt it
while ($row = mysqli_fetch_assoc($result)) {
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
    $disability = openssl_decrypt($row["disability"], $method, $key);
    $allowance = openssl_decrypt($row["allowance"], $method, $key);
    
    $birthdate = openssl_decrypt($row["birthdate"], $method, $key);
    $birthdate_create = date_create($birthdate);
    $format_birthdate = date_format($birthdate_create, "m/d/Y");
    
    $sex = openssl_decrypt($row["sex"], $method, $key);
    $yearlevel = openssl_decrypt($row["yearlevel"], $method, $key);
    $scholarship_name = openssl_decrypt($row["scholarship_name"], $method, $key);
    $postal_code = openssl_decrypt($row["postal_code"], $method, $key);
    $email = openssl_decrypt($row["email"], $method, $key);
    $contact = openssl_decrypt($row["contact"], $method, $key);
    
    $award_number = openssl_decrypt($row["award_number"], $method, $key);
    $student_number = openssl_decrypt($row["student_number"], $method, $key);
    $total_units = openssl_decrypt($row["total_units"], $method, $key);
    
    $first_semester = openssl_decrypt($row["1st_semester"], $method, $key);
    $second_semester = openssl_decrypt($row["2nd_semester"], $method, $key);
    
    // Add data to the array
    $data[] = [
        'application_num' => $application_num,
        'application_date' => $format_applydate,
        'type' => $type,
        'academic_year' => $academic_year,
        'semester' => $semester,
        'program_name' => $program_name,
        'last_name' => $last_name,
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'disability' => $disability,
        'allowance' => $allowance,
        'birthdate' => $format_birthdate,
        'sex' => $sex,
        'yearlevel' => $yearlevel,
        'scholarship_name' => $scholarship_name,
        'postal_code' => $postal_code,
        'email' => $email,
        'contact' => $contact,
        'award_number' => $award_number,
        'student_number' => $student_number,
        'total_units' => $total_units,
        'first_semester' => $first_semester,
        'second_semester' => $second_semester
    ];
}

// Sort data by program name and last name
usort($data, function ($a, $b) {
    if ($a['program_name'] == $b['program_name']) {
        return strcmp($a['last_name'], $b['last_name']);
    }
    return strcmp($a['program_name'], $b['program_name']);
});


// Loop through the sorted data to generate the table rows
foreach ($data as $row) {
    $formattedRowNumber = sprintf("%05d", $n);
    $middle_initial = strtoupper(substr($row['middle_name'], 0, 1));
    $yearnum = strtoupper(substr($row['yearlevel'], 0, 1));
    
    //--------------------------------------------------

    $sheet->setCellValue('A'.$current_row, $formattedRowNumber);
    $sheet->getStyle('A'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

    $sheet->setCellValue('B'.$current_row, $row["student_number"]);
    $sheet->setCellValue('C'.$current_row, $row["award_number"]);

    $sheet->getStyle('D'.$current_row.':E'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->setCellValue('D'.$current_row, $row["last_name"]);
    $sheet->setCellValue('E'.$current_row, $row["first_name"]);

    $sheet->setCellValue('F'.$current_row, $middle_initial);
    $sheet->setCellValue('G'.$current_row, $row["sex"]);

    $sheet->setCellValue('H'.$current_row, $row["birthdate"]);
    $sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

    $sheet->setCellValue('I'.$current_row, $row["program_name"]);

    $sheet->getStyle('J'.$current_row.':S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $sheet->setCellValue('J'.$current_row, $yearnum);
    $sheet->setCellValue('K'.$current_row, $row["total_units"]);
    $sheet->setCellValue('L'.$current_row, $row["postal_code"]);
    $sheet->setCellValue('M'.$current_row, $row["email"]);
    $sheet->setCellValue('N'.$current_row, $row["contact"]);

    if($_GET["slct_apptype"] == "Continuing"){
        $sheet->setCellValue('O'.$current_row, '-');
        $sheet->setCellValue('P'.$current_row, '-');
        $sheet->setCellValue('Q'.$current_row, number_format($row['allowance'], 2, ".", ","));
        $sheet->setCellValue('R'.$current_row, '-');


    }else if($_GET["slct_apptype"] == "New"){
        $sheet->mergeCells('O'.$current_row.':P'.$current_row);
        $sheet->setCellValue('O'.$current_row, number_format($row['allowance'], 2, ".", ","));

        $sheet->mergeCells('Q'.$current_row.':R'.$current_row);
        $sheet->setCellValue('Q'.$current_row, '');

    }
    
    $sheet->setCellValue('S'.$current_row, number_format($row['allowance'], 2, ".", ","));



    //-------------------------------------------------------
    
    $total_accumulated += floatval($row['allowance']);
    $n++;
    $current_row++;
}


    $support_amount = $total_accumulated*0.01;


if($_GET["slct_apptype"] == "Continuing"){

    $sheet->mergeCells('A'.$current_row.':B'.$current_row);
    $sheet->setCellValue('A'.$current_row, 'Page Total');

    $sheet->setCellValue('O'.$current_row, '-');
    $sheet->setCellValue('P'.$current_row, '-');
    $sheet->setCellValue('Q'.$current_row, number_format($total_accumulated, 2, ".", ","));
    $sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

    $sheet->setCellValue('S'.$current_row, number_format($total_accumulated, 2, ".", ","));
    $sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


    $current_row++;

    $sheet->mergeCells('A'.$current_row.':B'.$current_row);
    $sheet->setCellValue('A'.$current_row, 'Page Accumulated Total');

    $sheet->setCellValue('O'.$current_row, '-');
    $sheet->setCellValue('P'.$current_row, '-');
    $sheet->setCellValue('Q'.$current_row, number_format($total_accumulated, 2, ".", ","));
    $sheet->getStyle('Q'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

    $sheet->setCellValue('S'.$current_row, number_format($total_accumulated, 2, ".", ","));
    $sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);



}else if($_GET["slct_apptype"] == "New"){
    $sheet->mergeCells('A'.$current_row.':R'.$current_row);
    $sheet->setCellValue('A'.$current_row, 'Page Total');
    $sheet->setCellValue('S'.$current_row, number_format($total_accumulated, 2, ".", ","));
    $sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


    $current_row++;

    $sheet->mergeCells('A'.$current_row.':R'.$current_row);
    $sheet->setCellValue('A'.$current_row, 'Page Accumulated Total');
    $sheet->setCellValue('S'.$current_row, number_format($total_accumulated, 2, ".", ","));
    $sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


}

$current_row++;

$sheet->mergeCells('A'.$current_row.':R'.$current_row);
$sheet->setCellValue('A'.$current_row, 'TOTAL TERTIARY EDUCATION SUBSIDY');

$sheet->setCellValue('S'.$current_row, number_format($total_accumulated, 2, ".", ","));
$sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->getStyle('A'.$current_row.':S'.$current_row)->getFont()->setBold(true);

$current_row++;

$sheet->mergeCells('A'.$current_row.':R'.$current_row);
$sheet->setCellValue('A'.$current_row, 'Add 1 percent (1%) Administrative Support for Partner Institutions');
$sheet->setCellValue('S'.$current_row, number_format(floatval($support_amount), 2, ".", ","));
$sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


$current_row++;

$sheet->mergeCells('A'.$current_row.':R'.$current_row);
$sheet->setCellValue('A'.$current_row, 'TOTAL TES BILLING PER CAMPUS');
$sheet->setCellValue('S'.$current_row, number_format($total_accumulated+floatval($support_amount), 2, ".", ","));
$sheet->getStyle('A'.$current_row.':S'.$current_row)->getFont()->setBold(true);
$sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);


$current_row++;

$sheet->mergeCells('A'.$current_row.':R'.$current_row);
$sheet->setCellValue('A'.$current_row, 'TOTAL TES BILLING ALL CAMPUSES');
$sheet->setCellValue('S'.$current_row, number_format($total_accumulated+floatval($support_amount), 2, ".", ","));
$sheet->getStyle('S'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->getStyle('A'.$current_row.':S'.$current_row)->getFont()->setBold(true);

$current_row+=2;

$sheet->mergeCells('C'.$current_row.':D'.$current_row);
$sheet->setCellValue('C'.$current_row, 'As to corectness of enrollment data');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('H'.$current_row.':I'.$current_row);
$sheet->setCellValue('H'.$current_row, 'As to correctness of financial data');
$sheet->getStyle('H'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

$sheet->mergeCells('N'.$current_row.':Q'.$current_row);
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

$sheet->mergeCells('N'.$current_row.':Q'.$current_row);
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

$sheet->mergeCells('N'.$current_row.':Q'.$current_row);
$sheet->setCellValue('N'.$current_row, 'College Administrator');
$sheet->getStyle('N'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$current_row++;
$sheet->mergeCells('C'.$current_row.':D'.$current_row);
$sheet->setCellValue('C'.$current_row, 'UniFast Focal Person and Scholarship Coordinator');
$sheet->getStyle('C'.$current_row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$current_row++;

//-----------------------------------------------------------------------------------

$sheet->getColumnDimension('A')->setWidth(7.30);
$sheet->getColumnDimension('B')->setWidth(13.80);
$sheet->getColumnDimension('C')->setWidth(27.90);
$sheet->getColumnDimension('D')->setWidth(18.70);
$sheet->getColumnDimension('E')->setWidth(26.90);
$sheet->getColumnDimension('F')->setWidth(12.40);
$sheet->getColumnDimension('G')->setWidth(6.90);
$sheet->getColumnDimension('H')->setWidth(9.70);
$sheet->getColumnDimension('I')->setWidth(66.90);
$sheet->getColumnDimension('J')->setWidth(6.90);
$sheet->getColumnDimension('K')->setWidth(10.10);
$sheet->getColumnDimension('L')->setWidth(8.50);
$sheet->getColumnDimension('M')->setWidth(19.50);
$sheet->getColumnDimension('N')->setWidth(13.80);
$sheet->getColumnDimension('O')->setWidth(13.20);
$sheet->getColumnDimension('P')->setWidth(12.40);
$sheet->getColumnDimension('Q')->setWidth(13.80);
$sheet->getColumnDimension('R')->setWidth(12.20);
$sheet->getColumnDimension('S')->setWidth(17.30);




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


$sheet->getStyle('A1:S1')->applyFromArray($topBorderStyle);
$sheet->getStyle('A1:S10')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A1:S10')->applyFromArray($rightBorderStyle);

$sheet->getStyle('S9')->applyFromArray($thin_bottomBorderStyle);
$sheet->getStyle('S10')->applyFromArray($thin_bottomBorderStyle);

$sheet->getStyle('A10:O10')->applyFromArray($bottomBorderStyle);

$sheet->getStyle('A11:S32')->applyFromArray($leftBorderStyle);
$sheet->getStyle('A11:S32')->applyFromArray($rightBorderStyle);


if($_GET["slct_apptype"] == "Continuing"){
    $sheet->getStyle('A11:E25')->applyFromArray($rightBorderStyle);
    $sheet->getStyle('A11:O25')->applyFromArray($leftBorderStyle);
    $sheet->getStyle('A11:O25')->applyFromArray($rightBorderStyle);

    $sheet->getStyle('A26:S26')->applyFromArray($topBorderStyle);
    $sheet->getStyle('A27:S27')->applyFromArray($topBorderStyle);

    $sheet->getStyle('B28:S28')->applyFromArray($bottomBorderStyle);


}else if($_GET["slct_apptype"] == "New"){
    $sheet->getStyle('A11:O24')->applyFromArray($leftBorderStyle);
    $sheet->getStyle('A11:O24')->applyFromArray($rightBorderStyle);

    $sheet->getStyle('A25:S25')->applyFromArray($topBorderStyle);
    $sheet->getStyle('A26:S26')->applyFromArray($topBorderStyle);
    $sheet->getStyle('A27:S27')->applyFromArray($topBorderStyle);

    $sheet->getStyle('B28:S31')->applyFromArray($allBorderStyle);


}

$sheet->getStyle('A28:S28')->applyFromArray($topBorderStyle);

$sheet->getStyle('A28:A32')->applyFromArray($rightBorderStyle);


$footer_start_row = $current_row-8;
$sheet->getStyle('A33:S'.$footer_start_row)->applyFromArray($allBorderStyle);

$sheet->getStyle('A'.$footer_start_row.':S'.$current_row)->applyFromArray($leftBorderStyle);
$sheet->getStyle('A'.$footer_start_row.':S'.$current_row)->applyFromArray($rightBorderStyle);
$sheet->getStyle('A'.$current_row.':S'.$current_row)->applyFromArray($bottomBorderStyle);



//---------------------------------------------------------------------------------------------

$sheet->getPageMargins()->setTop(1 / 2.54);
$sheet->getPageMargins()->setLeft(1 / 2.54);
$sheet->getPageMargins()->setRight(1 / 2.54);
$sheet->getPageMargins()->setBottom(1 / 2.54);

$sheet->getPageSetup()->setPrintArea('A1:S'.$current_row);

// Set up headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'_'.$dateNow.'.xlsx"');
header('Cache-Control: max-age=0');

// Create Excel file and stream the output directly to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>