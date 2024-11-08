<?php
$loadinfo .= '<table width="100%" class="header new_tdp_header">
<tr><td colspan="3" style="text-align: right;"><h1>TES Continuing Form 3 - Annex 2</h1></td></tr>
<tr>
    <td class="header_left"><img src="'.$destinationChedLogo.'" class="pdf_logo"></td>
    <td class="header_middle">
        
        Republic of the Philippines<br>
        <b>KOLEHIYO NG LUNGSOD NG LIPA</b><br>
        MARAWOY LIPA CITY
        
    </td>
    <td class="header_right"><img src="'.$destinationUnifastLogo.'" class="pdf_logo"></td>
</tr>
<tr><td colspan="3"><h2 style="text-align:center;">CONSOLIDATED CONTINUING TES GRANTEES DETAILS</h2></td></tr>
<tr><td colspan="3"><span class="date">Date:<span class="txt_date"> &nbsp;' . date("F j, Y") .' &nbsp;</span></span></td></tr>
</table>
<table width="100%" border="1">
    <tr>
        <td><b>INSTRUCTIONS</b>
        <p>1.  This form shall only include the names of those continuing TES grantees who are NOT INCLUDED in 				
        TES Continuing Form 2.<br>		
                        
        <br>2.  In the table below, list down the names of continuing TES grantees per campus in alphabetical order, if applicable, 				
        (1) by campus; (2) by college; (3) by program; and (4) by student name (Last Name, First Name, MI).<br>		
                        
        <br>3.  Include and update all information required in the space provided.<br>			
                        
        <br>4.  Assign a 5-digit Control Number for each student. The control numbers should be assigned in chronological order				
        to the students listed according to instruction no. 2.<br>			
                        
        <br>5.  Indicate the current status of each student by selecting one of the following options under the column provided in the table:				
        not enrolled, dropped, waived, on LOA, transferee, or graduated. Add remarks if necessary.<br>		

        </p>
        </td>
        <td>
        <p>6.  Submit electronic and hard copies of the following forms to CHEDRO as supporting documents:					
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.1	TES Continuing Form 1				
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.2	TES Continuing Form 2				
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.3	TES Continuing Form 3				
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.4	Notarized Registrar’s Certification				
        </p>
        </td>
    </tr>
    
</table>
<table cellpadding="2">
    <tr>
        <td colspan="2" style="border-left: 1px solid black; border-bottom: 1px solid black;">To:</td>
        <td colspan="10" style="border-right: 1px solid black; border-bottom: 1px solid black;"><b>CHED - Regional Office IV-A</b></td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: 1px solid black; border-bottom: 1px solid black;">Address:</td>
        <td colspan="10" style="border-right: 1px solid black; border-bottom: 1px solid black;"><b>Jose P. Laurel Highway, City Hall Compound, Barangay Marawoy, Lipa City</b></td>
    </tr>
    <tr>
        <td rowspan="3" style="border: 1px solid black;"></td>
        <td colspan="11" style="border: 1px solid black;"><b>TES Continuing Grantees Details:</b></td>
    </tr>
    <tr>
        <td colspan="11" style="border: 1px solid black;">Note:  Please insert additional line as needed.</td>
    </tr>
    <tr>
        <td colspan="11" style="border: 1px solid black;"><b>Tertiary Education Subsidy : Based on Section 23 of Rule IV of IRR of R.A. No. 10931</b></td>
    </tr>
    <tr>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td colspan="3" style="border: 1px solid black; text-align:center; font-weight:bold;">Student\'s Name</td>
        <td colspan="4" style="border: 1px solid black; text-align:center; font-weight:bold;">Student Profile</td>
        <td colspan="2" style="border: 1px solid black; text-align:center; font-weight:bold;">Status</td>
    </tr>
    <tr>
        <td style="border: 1px solid black; text-align:center;">5-digit Control Number</td>
        <td style="border: 1px solid black; text-align:center;">Student Number</td>
        <td style="border: 1px solid black; text-align:center;">TES Award Number</td>
        <td style="border: 1px solid black; text-align:center;">Last Name</td>
        <td style="border: 1px solid black; text-align:center;">Given Name</td>
        <td style="border: 1px solid black; text-align:center;">Middle Initial</td>
        <td style="border: 1px solid black; text-align:center;">Sex at Birth</td>
        <td style="border: 1px solid black; text-align:center;">Birthdate</td>
        <td style="border: 1px solid black; text-align:center;">Degree Program</td>
        <td style="border: 1px solid black; text-align:center;">Year Level</td>
        <td style="border: 1px solid black; text-align:center;">(not enrolled/dropped/waived/on loa/transferee/graduated)</td>
        <td style="border: 1px solid black; text-align:center;">Remarks</td>
    </tr>
    
    ';

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Decrypt data
        $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
        $semester = openssl_decrypt($row["semester"], $method, $key);
        $program_name = openssl_decrypt($row["program_name"], $method, $key);
        $last_name = openssl_decrypt($row["last_name"], $method, $key);
        $first_name = openssl_decrypt($row["first_name"], $method, $key);
        $middle_name = openssl_decrypt($row["middle_name"], $method, $key);
        $birthdate = openssl_decrypt($row["birthdate"], $method, $key);
        $sex = openssl_decrypt($row["sex"], $method, $key);
        $yearlevel = openssl_decrypt($row["yearlevel"], $method, $key);
        $scholarship_name = openssl_decrypt($row["scholarship_name"], $method, $key);
        $award_number = openssl_decrypt($row["award_number"], $method, $key);
        $student_number = openssl_decrypt($row["student_number"], $method, $key);
    
        // Format birthdate
        $birthdate_create = date_create($birthdate);
        $format_birthdate = date_format($birthdate_create, "m/d/Y");
    
        // Add data to the array
        $data[] = [
            'academic_year' => $academic_year,
            'semester' => $semester,
            'program_name' => $program_name,
            'last_name' => $last_name,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'birthdate' => $format_birthdate,
            'sex' => $sex,
            'yearlevel' => $yearlevel,
            'scholarship_name' => $scholarship_name,
            'award_number' => $award_number,
            'student_number' => $student_number,
        ];
    }
    
    // Sort data by program name and last name
    usort($data, function($a, $b) {
        if ($a['program_name'] == $b['program_name']) {
            return strcmp($a['last_name'], $b['last_name']);
        }
        return strcmp($a['program_name'], $b['program_name']);
    });
    
    
    // Loop through the sorted data to generate the table rows
    $n = 1;
    foreach ($data as $row) {
        $formattedRowNumber = sprintf("%05d", $n);
        $middle_initial = strtoupper(substr($row['middle_name'], 0, 1));
        $yearnum = strtoupper(substr($row['yearlevel'], 0, 1));
    
        $loadinfo .= '<tr>
            <td style="border: 1px solid black;">' . $formattedRowNumber . '</td>
            <td style="border: 1px solid black;">' . $row['student_number'] . '</td>
            <td style="border: 1px solid black;">' . $row['award_number'] . '</td>
            <td style="border: 1px solid black;">' . $row['last_name'] . '</td>
            <td style="border: 1px solid black;">' . $row['first_name'] . '</td>
            <td style="border: 1px solid black;">' . $middle_initial . '.</td>
            <td style="border: 1px solid black;">' . $row['sex'] . '</td>
            <td style="border: 1px solid black;">' . $row['birthdate'] . '</td>
            <td style="border: 1px solid black;">' . $row['program_name'] . '</td>
            <td style="border: 1px solid black;">' . $yearnum . '</td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
        </tr>';
    
        $n++;
    }
    

$loadinfo .='
<tr>
    <td style="border: 1px solid black;" colspan="2">Page Total</td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
</tr>

<tr>
    <td style="border: 1px solid black;" colspan="2">Page Accumulated Total</td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
    <td style="border: 1px solid black;"></td>
</tr>
<tr>
    <td style="border: 1px solid black;" colspan="12"><b>TOTAL TERTIARY EDUCATION SUBSIDY</b></td>
</tr>
<tr>
    <td colspan="3">Prepared by:</td>
    <td colspan="3">As to corectness of enrollment data<br>Certified by:</td>
    <td colspan="3">Approved by:</td>
    <td colspan="3"></td>
</tr>

</table>
<br><br><br>
<table>
<tr>
    <td style="text-align:center" colspan="3">JINGEL H. LEYNES<br>UniFast Focal Person & Scholarship Coordinator</td>
    <td style="text-align:center" colspan="3">DELIA A. LIBREA<br>OIC - College Registrar</td>
    <td style="text-align:center" colspan="3">MARIO CARMELO A. PESA<br>College Administrator</td>
    <td style="text-align:center" colspan="3"></td>
</tr>
</table>';

?>