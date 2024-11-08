<?php


$filename = "";
$filetitle = "";
$instruction1 = "";
$instruction2 = "";

if($_GET["slct_apptype"] == "New"){
    $filename = "New TDP Form 2 - Annex 7";
    $filetitle = "CONSOLIDATED NEW TDP DETAILS";
    $instruction1 = "1.  In the table below, list down the names of enrolled new TDP grantees per campus in alphabetical order, if applicable, (1) by campus; (2) by college; (3) by program; and (4) by student name <br><br>

        2. Include and update all information required in the space provided. <br><br>

        3.  Assign a 5-digit Control Number for each enrolled student. The control numbers should be assigned in chronological order to the students listed according to instruction no. 1.<br><br>

        4.  Submit pdf files of the Certificate of Registration (COR) of Official Enrollment in the ".$semester." of Academic Year ".$academic_year."  in the order as it appears in the TDP New Form 2.<br>";
    $instruction2 = "5.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;5.1 New TDP Form 1<br>
                &nbsp;&nbsp;&nbsp;&nbsp;5.2 New TDP Form 2<br>
                &nbsp;&nbsp;&nbsp;&nbsp;5.3 New TDP Form 3<br>
                ";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TDP Continuing Form 2 - Annex 5";
    $filetitle = "CONSOLIDATED CONTINUING TDP GRANTEES DETAILS";
    $instruction1 = "1.  Include only in this form the names of continuing grantees WHO ARE CURRENTLY ENROLLED this semester.<br><br>	
				
                    2.  In the table below, list down the names of enrolled continuing TDP grantees per campus in alphabetical order, if applicable, (1) by campus; (2) by college; (3) by program; and (4) by student name (Last Name, First Name, MI).<br><br>			
                                    
                                    
                    3.  Include and update all information required in the space provided.<br><br>		
                                    
                    4.  Assign a 5-digit Control Number for each enrolled student. The control numbers should be assigned in chronological order to the students listed according to instruction no. 2.<br><br>
                                    
                    5.  Submit pdf files of the Certificate of Registration (COR) of Official Enrollment in the ".$semester." of Academic Year ".$academic_year."  in the order as it appears in the TDP Continuing Form 2.				
                    <br>";
    $instruction2 = "6.  Submit the Notarized Certification of TDP Grantees, as an endorsement document, for all the PDF <b>files</b> of <b>the CORs submitted</b>.<br><br>
                7.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:<br>
                &nbsp;&nbsp;&nbsp;&nbsp;7.1 TDP Continuing Form 1<br>
                &nbsp;&nbsp;&nbsp;&nbsp;7.2 TDP Continuing Form 2<br>
                &nbsp;&nbsp;&nbsp;&nbsp;7.3 TDP Continuing Form 3<br>
                &nbsp;&nbsp;&nbsp;&nbsp;7.4 Notarized Registrar's Certification<br>
    ";

}else{
    $filetitle = "CONSOLIDATED TDP DETAILS";

}

$loadinfo .= '<table width="100%" class="header new_tdp_header">
<tr><td colspan="3" style="text-align: right;"><h1>'.$filename.'</h1></td></tr>
<tr>
        <td class="header_left"><img src="'.$destinationChedLogo.'" class="pdf_logo"></td>
        <td class="header_middle">
            
            Republic of the Philippines<br>
            <b>KOLEHIYO NG LUNGSOD NG LIPA</b><br>
            MARAWOY LIPA CITY
            
        </td>
        <td class="header_right"><img src="'.$destinationUnifastLogo.'" class="pdf_logo"></td>
    </tr>
<tr><td colspan="3"><h2 style="text-align:center;">'.$filetitle.'</h2></td></tr>
<tr><td colspan="3"><span class="date">TDP Billing Details Reference Number: _______________________<br>Date:<span class="txt_date"> ' . date("F j, Y") .'</span></span></td></tr>
</table>
<table width="100%" border="1">
    <tr>
        <td><b>INSTRUCTIONS</b><br>
        <p>
        '.$instruction1.'
        </p>
        
        </td>
        <td>
            <br><br>
            <p>
                '.$instruction2.'
            </p>
        </td>
    </tr>
</table>
<table width="100%" style="border: 1px solid black;">
    <tr>
        <td width="10%">TO: </td>
        <td width="90%">CHED - Regional Office</td>
    </tr>
</table>
<table width="100%" style="border: 1px solid black;">
    <tr>
        <td width="10%">Address: </td>
        <td width="90%">CHED Region IVA Bldg. Jose P. Laurel Highway</td>
    </tr>
</table>
<table width="100%" border="1">
    <tr>
        <td rowspan="4"></td>
        <td colspan="16"><b>TDP Continuing Grantees Details: </b></td>
        

    </tr>
    <tr>
        <td colspan="5"><span style="color: red;">TDP will have to be listed and tabulated PER CAMPUS.  The Total Amount of the TDP for all </span></td>
        <td></td>
        <td colspan="10" rowspan="3"></td>
        
    </tr>
    <tr>
        <td colspan="6"><span style="color: red;">campuses should tally with the total amount of TDP in the Billing Statement </span></td>
    </tr>
    <tr>
        <td colspan="6">Note: Insert Additional line if needed</td>
    </tr>

    <tr>
        <td></td>
        <td colspan="16"><b>Tulong Dunong Program : Based on R.A. No. 10931</b></td>

    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="3" class="annex7_column_title">Student\'s Name</td>
        <td colspan="5" class="annex7_column_title">Student Profile</td>
        <td colspan="3" class="annex7_column_title">Contact Information</td>
        <td colspan="2" class="annex7_column_title">TDP TES Grant</td>
        <td></td>
    </tr>
    <tr>
        <td class="annex7_column_title2">5-digit Control Number</td>
        <td class="annex7_column_title2">Student Number</td>
        <td class="annex7_column_title2">TDP Award Number</td>
        <td class="annex7_column_title2">Last Name</td>
        <td class="annex7_column_title2">Given Name</td>
        <td class="annex7_column_title2">Middle Initial</td>
        <td class="annex7_column_title2">Sex at Birth</td>
        <td class="annex7_column_title2">Birthdate</td>
        <td class="annex7_column_title2">Degree Program</td>
        <td class="annex7_column_title2">Year Level</td>
        <td class="annex7_column_title2">Total Academic Units Enrolled (credit and non-credit courses)</td>
        <td class="annex7_column_title2">Zip Code</td>
        <td class="annex7_column_title2">Email Address</td>
        <td class="annex7_column_title2">Phone Number</td>
        <td class="annex7_column_title2">1st Semester</td>
        <td class="annex7_column_title2">2nd Semester</td>
        <td class="annex7_column_title2"><b>Total Amount</b></td>
    </tr>';

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
    $format_birthdate = date_format($birthdate_create, "m-d-Y");
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

    if ($first_semester !== null) {
        $total_firstgrant += floatval($first_semester);
        $total_amount += floatval($first_semester);
        $total_accumulated += floatval($first_semester);
        $first_semester = number_format($first_semester, 2, '.', ',');
    } else {
        $first_semester = "-";
    }

    if ($second_semester !== null) {
        $total_secondgrant += floatval($second_semester);
        $total_amount += floatval($second_semester);
        $total_accumulated += floatval($second_semester);
        $second_semester = number_format($second_semester, 2, '.', ',');
    } else {
        $second_semester = "-";
    }

    $middle_initial = strtoupper(substr($middle_name, 0, 1));
    $yearnum = strtoupper(substr($yearlevel, 0, 1));
    $formattedRowNumber = sprintf("%05d", $n);

    $loadinfo .= '<tr>
        <td>'.$formattedRowNumber.'</td>
        <td>'.$award_number.'</td>
        <td>'.$student_number.'</td>
        <td>'.$last_name.'</td>
        <td>'.$first_name.'</td>
        <td>'.$middle_initial.'.</td>
        <td>'.$sex.'</td>
        <td>'.$format_birthdate.'</td>
        <td>'.$program_name.'</td>
        <td>'.$yearnum.'</td>
        <td>'.$total_units.'</td>
        <td>'.$postal_code.'</td>
        <td>'.$email.'</td>
        <td>'.$contact.'</td>
        <td>'.$first_semester.'</td>
        <td>'.$second_semester.'</td>
        <td>'.number_format($total_amount, 2, ".", ",").'</td>
    </tr>';

    $n++;
}

    $support_amount = $total_accumulated * 0.005;

$loadinfo .= '<tr>
        <td colspan="2">Page Total</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td>';
if($total_firstgrant != 0){
$loadinfo .= number_format($total_firstgrant, 2, '.', ',');

}else{
    $loadinfo .= '-';
    }

$loadinfo .= '</td>
<td>';
if($total_secondgrant !=0){
$loadinfo .= number_format($total_secondgrant, 2, '.', ',');

}else{
$loadinfo .= '-';
}

$loadinfo .= '</td>
        <td >'.number_format($total_accumulated, 2, '.', ',').'</td>
</tr>';

$loadinfo .= '<tr>
        <td colspan="2">Page Accumulated Total</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td>';
if($total_firstgrant != 0){
$loadinfo .= number_format($total_firstgrant, 2, '.', ',');

}else{
    $loadinfo .= '-';
    }

$loadinfo .= '</td>
<td>';
if($total_secondgrant !=0){
$loadinfo .= number_format($total_secondgrant, 2, '.', ',');

}else{
$loadinfo .= '-';
}

$loadinfo .= '</td>
        <td >'.number_format($total_accumulated, 2, '.', ',').'</td>
</tr>';
    
    
$loadinfo .= '</table>

<table width="100%" style="border: 1px solid black">
    <tr>
        <td><b>TOTAL TULONG DUNONG PROGRAM</b></td>
        <td style="text-align: right">'.number_format($total_accumulated, 2, '.', ',').'</td>
    </tr>
</table>
<table width="100%" style="border: 1px solid black">
    <tr>
        <td><b>Add .5 percent (.005%) Administrative Support for Partner Institutions</b></td>
        <td style="text-align: right">'.number_format($support_amount, 2, '.', ',') .'</td>
    </tr>
</table>
<table width="100%" style="border: 1px solid black">
    <tr>
        <td><b>TOTAL TDP BILLING PER CAMPUS</b></td>
        <td style="text-align: right">'.number_format($total_accumulated+$support_amount, 2, '.', ',').'</td>
    </tr>
</table>
<table width="100%" style="border: 1px solid black">
    <tr>
        <td><b>TOTAL TDP BILLING ALL CAMPUS</b></td>
        <td style="text-align: right">'.number_format($total_accumulated+$support_amount, 2, '.', ',').'</td>
    </tr>
</table>
<br>
<table>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan="2"></td>
<td colspan="5">As to correctness of enrollment data<br>Prepared and Verified by:</td>
<td colspan="6">As to correctness of financial data<br>Certified by:</td>
<td colspan="4">Approved by:</td>
</tr>
</table>
<br><br><br>
<table class="persons">
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan="2"></td>
<td colspan="5"><b>JINGEL LEYNES</b><br>UniFast Focal Person<br>Scholarship Coordinator</td>
<td colspan="6"><b>TERESITA V. ESPLAGO</b><br>Vice President for Administration<br>Planning and Finance</td>
<td colspan="4"><b>MARIO CARMELO A. PESA</b><br>College Administrator</td>
</tr>
</table>
';


?>