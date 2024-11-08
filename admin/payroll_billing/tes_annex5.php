<?php
$loadinfo .= '<table width="100%" class="header new_tes_header">
<tr><td colspan="3" style="text-align: right;"><h1>Annex 5 - TES New Form 2</h1></td></tr>
<tr>
        <td class="header_left"><img src="'.$destinationChedLogo.'" class="pdf_logo"></td>
        <td class="header_middle">
            
            Republic of the Philippines<br>
            <b>KOLEHIYO NG LUNGSOD NG LIPA</b><br>
            MARAWOY LIPA CITY
            
        </td>
        <td class="header_right"><img src="'.$destinationUnifastLogo.'" class="pdf_logo"></td>
    </tr>
<tr><td colspan="3"><h2 style="text-align:center;">CONSOLIDATED TES NEW DETAILS</h2></td></tr>
<tr><td colspan="3"><span class="date">TES Billing Reference Number: _______________________<br>Date:<span class="txt_date"> ' . date("F j, Y") .'</span></span></td></tr>
<tr>
    <td colspan="2" style="border-top: 1px solid black; border-right: 1px solid black;">
        <b>INSTRUCTIONS</b>
        <p>
        1.  In the table below, list down the names of enrolled TES qualified grantees per campus in alphabetical order, if applicable, (1) by campus; (2) by college; (3) by program; and (4) by student name (Last Name, First Name, MI).<br><br>
        2.  Include and update all information required in the space provided.<br><br>
        3.  Assign a 5-digit Control Number for each enrolled student. The control numbers should be assigned in chronological order to the students listed according to instruction no. 1.<br><br>
        4.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.1 TES New Form 1<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.2 TES New Form 2<br>
        5. Additional Documentary Requirements (if applicable)<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.1 Certificate of residency for qualified grantees under the PNSL category<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.2 Copy of PWD ID (for qualified grantees that is Person with disability)<br>
        </p>


    </td>   
    <td></td>
</tr>
</table>
<table width="100%" style="border: 1px solid black;">
    <tr>
        <td width="10%">TO: </td>
        <td width="90%"><b>CHED - Regional Office</b></td>
    </tr>
</table>
<table width="100%" style="border: 1px solid black;">
    <tr>
        <td width="10%">Address: </td>
        <td width="90%"><b>CHED Region IVA Bldg. Jose P. Laurel Highway</b></td>
    </tr>
</table>
<table width="100%" style="border: 1px solid black;">
    <tr>
        <td width="10%">Copy Furnished: </td>
        <td width="90%"><b>UniFast Secretariat</b></td>
    </tr>
</table>
<table width="100%" border="1">
    <tr>
        <td rowspan="4"></td>
        <td colspan="16"><b>TES New Grantees Summary: </b></td>
        

    </tr>
    <tr>
        <td colspan="5"><b>TES will have to be listed and tabulated PER CAMPUS.</b>  The Total Amount of the TES for all</td>
        <td></td>
        <td colspan="10" rowspan="3"></td>
        
    </tr>
    <tr>
        <td colspan="6">campuses should tally with the total amount of TES in the Annex 5-TES New Form 1</td>
    </tr>
    <tr>
        <td colspan="6">Note: Insert Additional line if needed</td>
    </tr>

    <tr>
        <td></td>
        <td colspan="16"><b>Tertiary Education Subsidy : Based on Section 23 of Rule IV of IRR of R.A. No. 10931</b></td>

    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="3" class="annex7_column_title">Student\'s Name</td>
        <td colspan="5" class="annex7_column_title">Student Profile</td>
        <td colspan="3" class="annex7_column_title">Contact Information</td>
        <td class="annex7_column_title">TES Benefits</td>
        <td class="annex7_column_title">TES 3A</td>
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
        <td class="annex7_column_title2">Amount</td>
        <td class="annex7_column_title2">Person with Disability</td>
        <td class="annex7_column_title2"><b>Total Amount</b></td>
    </tr>';

    // Initialize an array to store student data
$data = [];
$total_accumulated = 0;
$n = 1;

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
    $format_birthdate = date_format($birthdate_create, "m-d-Y");
    
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
    
    $loadinfo .= '<tr>
        <td>' . $formattedRowNumber . '</td>
        <td>' . $row['award_number'] . '</td>
        <td>' . $row['student_number'] . '</td>
        <td>' . $row['last_name'] . '</td>
        <td>' . $row['first_name'] . '</td>
        <td>' . $middle_initial . '.</td>
        <td>' . $row['sex'] . '</td>
        <td>' . $row['birthdate'] . '</td>
        <td>' . $row['program_name'] . '</td>
        <td>' . $yearnum . '</td>
        <td>' . $row['total_units'] . '</td>
        <td>' . $row['postal_code'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['contact'] . '</td>
        <td>' . number_format($row['allowance'], 2, ".", ",") . '</td>
        <td>' . $row['disability'] . '</td>
        <td>' . number_format($row['allowance'], 2, ".", ",") . '</td>
    </tr>';
    
    $total_accumulated += floatval($row['allowance']);
    $n++;
}


    $support_amount = $total_accumulated*0.01;

$loadinfo .= '
<tr>
    <td colspan="16">Page Total</td>
    <td>'.number_format($total_accumulated, 2, ".", ",").'</td>
</tr>
<tr>
    <td colspan="16">Page Accumulated Total</td>
    <td>'.number_format($total_accumulated, 2, ".", ",").'</td>
</tr>
<tr>
    <td colspan="16"><b>TOTAL TERTIARY EDUCATION SUBSIDY</b></td>
    <td><b>'.number_format($total_accumulated, 2, ".", ",").'</b></td>
</tr>
<tr>
    <td colspan="16">Add 1 percent (1%) Administrative Support for Partner Institutions</td>
    <td>'.number_format($support_amount, 2, ".", ",").'</td>
</tr>
<tr>
    <td colspan="16"><b>TOTAL TES BILLING PER CAMPUS</b></td>
    <td><b>'.number_format($total_accumulated + $support_amount, 2, ".", ",").'</b></td>
</tr>
<tr>
    <td colspan="16"><b>TOTAL TES BILLING ALL CAMPUS</b></td>
    <td><b>'.number_format($total_accumulated + $support_amount, 2, ".", ",").'</b></td>
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