<?php
$fee_totals = array();

$loadinfo .= '<table style="border: 1px solid black;">
    <tr>
        <td></td> 
        <td></td>
        <td style="border: 1px solid black; text-align:center;"><h1>FORM 2</h1></td> 
    </tr>
    <tr>
        <td></td> 
        <td style="text-align:center;">
            <br><br>
            Republic of the Philippines<br>
            <b>KOLEHIYO NG LUNGSOD NG LIPA</b><br>
            MARAWOY LIPA CITY
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center;"><br><br><br><h1><b>FREE HIGHER EDUCATION BILLING DETAILS</b></h1></td>
    </tr>
    <tr><td colspan="3"><br><br><span class="date">Free HE Billing Details Reference No.: _______________________<br>Date:<span class="txt_date"> ' . date("F j, Y") .'</span></span><br><br></td></tr>
</table>
<table cellpadding="5">
    <tr>
        <td style="border: 1px solid black;"><b>TUITION AND OTHER SCHOOL FEES (Based on Section 7, Rule II of the IRR of RA 10931)</b></td>
    </tr>
</table>

<table border="1" cellpadding="3"> 
                        <tr>
                            <th>Sequence #</th>
                            <th>Student Number</th>
                            <th>Learner\'s Reference Number</th>
                            <th>Last Name</th>
                            <th>Given Name</th>
                            <th>Middle Initial</th>
                            <th>Degree Program</th>
                            <th>Year Level</th>
                            <th>Sex</th>
                            <th>Email Address</th>
                            <th>Contact</th>
                            <th>Laboratory Units/Subjects</th>
                            <th>Computer Lab Units/Subjects</th>
                            <th>Academic Units Enrolled (credit and non-credit courses)</th>
                            <th>Academic Units of NSTP Enrolled (credit and non-credit courses)</th>
                            <th>Tuition Fee based on enrolled academic units (credit and non-credit courses)</th>
                            <th>NSTP Fee based on enrolled academic</th>';
                            $resultFees = $conn->query("select * from tb_fees");
                      
                            while($rowFees = $resultFees->fetch_assoc()){
                                $loadinfo .= '<th>'.openssl_decrypt($rowFees["name"], $method, $key).'</th>';
                                $fee_totals[$rowFees["id"]] = 0; 

                            }
            $loadinfo .= '<th>Total TOSF</th>
                        </tr>';
            
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
                        
                            $loadinfo .= '<tr><td>'.$n.'</td>
                                <td>'.$student_number.'</td>
                                <td>'.$lrn.'</td>
                                <td>'.$last_name.'</td>
                                <td>'.$first_name.'</td>
                                <td>'.$middle_initial.'</td>
                                <td>'.$program_name.'</td>
                                <td>'.$yearnum.'</td>
                                <td>'.$sex.'</td>
                                <td>'.$email.'</td>
                                <td>'.$contact.'</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>'.$tuition_fee.'</td>
                                <td></td>';
                                
                            $total_tuition += floatval($tuition_fee);
                        
                            $resultFees = $conn->query("select * from tb_fees");
                                              
                            while ($rowFees = $resultFees->fetch_assoc()) {
                                $found = false;
                                foreach ($fees as $fee_id) {
                                    if ($fee_id == $rowFees["id"]) {
                                        $found = true;
                                        $amount = floatval(openssl_decrypt($rowFees["amount"], $method, $key));
                                        $loadinfo .= '<td>' .$amount. '</td>';
                                        $total_fees += $amount;
                                        $fee_totals[$fee_id] += $amount;
                                        break; 
                                    }
                                }
                                if (!$found) {
                                    $loadinfo .= '<td></td>';
                                    $fee_totals[$fee_id] += 0;
                                }
                            }
                            $total_fees += $tuition_fee;

                            $loadinfo .= '<td>'.number_format($total_fees, 2, ".", ",").'</td></tr>';
                            $total_tosf += $total_fees;
                            $n++;
                        }
            $loadinfo .= '
            <tr>
                <td colspan="2">Page Accumulated Total</td>
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
                <td>'.number_format($total_tuition, 2, ".", ",").'</td>
                <td>#</td>';
                foreach ($fee_totals as $fee_id => $total) {
                    if($total == 0){
                        $loadinfo .= '<td>#</td>';

                    }else{
                    $loadinfo .= '<td>' . number_format($total, 2, ".", ",") . '</td>';

                    }
                }
                
            
            $loadinfo .= '
            <td>'.number_format($total_tosf, 2, ".", ",").'</td>
            </tr>
            <tr>
                <td colspan="2">Page Total</td>
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
                <td>'.number_format($total_tuition, 2, ".", ",").'</td>
                <td>#</td>';
                foreach ($fee_totals as $fee_id => $total) {
                    if($total == 0){
                        $loadinfo .= '<td>#</td>';

                    }else{
                    $loadinfo .= '<td>' . number_format($total, 2, ".", ",") . '</td>';

                    }
                }
                
            
            $loadinfo .= '
            <td>'.number_format($total_tosf, 2, ".", ",").'</td>
            </tr>
            <tr>
                <td colspan="2"><b>OVER-ALL TOTAL - TOSF</b></td>
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
                <td></td>';
                foreach ($fee_totals as $fee_id => $total) {
                    if($total == 0){
                        $loadinfo .= '<td></td>';

                    }else{
                    $loadinfo .= '<td></td>';

                    }
                }
                
            
            $loadinfo .= '
            <td>'.number_format($total_tosf, 2, ".", ",").'</td>
            </tr>
            </table>
<table>
    <tr><td></td></tr>
    <tr><td><b><i>*Entrance/Admission Fee may be used interchangeably if pertaining to the admission examination of the SUC/LUC only.</i></b></td></tr>
</table>
<br><br><br>
<table>
    <tr>
        <td colspan="2"></td>
        <td colspan="5">Prepared and Certified by:<br><br>
            <div style="text-align:center"><b>JINGEL H. LEYNES</b>			
            <br>College Registrar			
            <br>UniFast Focal Person & Scholarship Coordinator			
            </div>
        </td>
        <td colspan="2"></td>
        <td colspan="5">Certified by:<br><br>
            <div style="text-align:center"><b>TERESITA V. ESPLAGO</b>				
                <br>Vice President for Administration					
		
            </div>
        </td>
        <td colspan="2"></td>
        <td colspan="5">Approved by:<br><br>
            <div style="text-align:center"><b>MARIO CARMELO A. PESA</b>								
                <br>College Administrator									
				
		
            </div>
        </td>
        
    </tr>
</table>
';

?>