<?php
$loadinfo .= '<table width="100%" class="header">
<tr><td colspan="3" style="text-align: right;"><h1>TDP Form - Annex 10</h1></td></tr>
<tr>
        <td class="header_left"><img src="'.$destinationChedLogo.'" class="pdf_logo"></td>
        <td class="header_middle">
            
            Republic of the Philippines<br>
            <b>KOLEHIYO NG LUNGSOD NG LIPA</b><br>
            MARAWOY LIPA CITY
            
        </td>
        <td class="header_right"><img src="'.$destinationUnifastLogo.'" class="pdf_logo"></td>
    </tr>
</table>
<br><h2 style="text-align:center;">TULONG DUNONG PROGRAM - TERTIARY EDUCATION SUBSIDY (TDP-TES) PAYROLL</h2>
<br><span class="date"> Date:<span class="txt_date"> ' . date("F j, Y") .'</span></span><br><br>';

$loadinfo .= '<table width="100%" class="records_table" cellspacing="0" cellpadding="2"> 
<tr>
    <th></th>
    <th></th>
    <th></th>
    <th colspan="3">Student\'s Name</th>
    <th colspan="2"></th>
    <th colspan="6">TDP-TES Grant</th>
</tr>
<tr>
    <td>Sequence No.</td>
    <td>Award Number</td>
    <td>Student ID No.</td>
    <td>Last Name</td>
    <td>Given Name</td>
    <td>Middle Initial</td>
    <td>Program</td>
    <td>Year Level</td>
    <td>1st Semester</td>
    <td>Date Received</td>
    <td>Student Signature</td>
    <td>2nd Semester</td>
    <td>Date Received</td>
    <td>Student Signature</td>
    </tr>';

    $total_firstgrant = 0;
    $total_secondgrant = 0;

    $n = 1;

    
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
    
    // Generate the HTML table from the sorted data
    foreach ($data as $row) {
        $loadinfo .= '<tr>
            <td>'.$n.'</td>
            <td>'.$row['award_number'].'</td>
            <td>'.$row['student_number'].'</td>
            <td>'.$row['last_name'].'</td>
            <td>'.$row['first_name'].'</td>
            <td>'.$row['middle_initial'].'.</td>
            <td>'.$row['program_name'].'</td>
            <td>'.$row['yearnum'].'</td>
            <td>'.$row['first_semester'].'</td>
            <td>'.$row['firstdate_received'].'</td>
            <td>'.$row['firstsig'].'</td>
            <td>'.$row['second_semester'].'</td>
            <td>'.$row['seconddate_received'].'</td>
            <td>'.$row['secondsig'].'</td>
        </tr>';
    
        $n++;

    }
$loadinfo .= '<tr>
<td colspan="8" class="total">Total</td>
<td>';
if($total_firstgrant != 0){
$loadinfo .= number_format($total_firstgrant, 2, '.', ',');

}

$loadinfo .= '</td>
<td></td>
<td></td>
<td>';
if($total_secondgrant !=0){
$loadinfo .= number_format($total_secondgrant, 2, '.', ',');

}

$loadinfo .= '</td>
<td></td>
<td></td>

</tr>

</table>
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
</tr>
<tr>
<td colspan="3"></td>
<td colspan="3">As to correctness of enrollment data<br>Verified by:</td>
<td colspan="3">As to correctness of financial data<br>Certified true and correct by:</td>
<td></td>
<td colspan="4">Approved by:</td>
</tr>
</table>
<br><br>
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
</tr>
<tr>
<td colspan="3"></td>
<td colspan="3"><b>JINGEL LEYNES</b><br>UniFast Focal Person<br>Scholarship Coordinator</td>
<td colspan="3"><b>TERESITA V. ESPLAGO</b><br>Vice President for Administration<br>Planning and Finance</td>
<td></td>
<td colspan="4"><b>MARIO CARMELO A. PESA</b><br>College Administrator</td>
</tr>

</table>
';

?>