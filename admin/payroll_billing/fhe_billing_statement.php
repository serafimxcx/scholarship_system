<?php
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

$loadinfo .= '<table style="border: 1px solid black;">
    <tr>
        <td></td> 
        <td></td>
        <td style="border: 1px solid black; text-align:center;"><h1>FORM 1</h1></td> 
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
        <td colspan="3" style="text-align:center;"><br><br><br><h1><b>CONSOLIDATED FREE HE BILLING STATEMENT</b></h1></td>
    </tr>
    <tr><td colspan="3"><br><br><span class="date">Free HE Billing Statement Reference No.: _______________________<br>Date:<span class="txt_date"> ' . date("F j, Y") .'</span></span><br><br></td></tr>
</table>
<table border="1" cellpadding="3">
    <tr>
        <td width="15%" style="text-align: right"><b>To</b></td>
        <td width="85%" colspan="3"><b>CHED - Central Office</b></td>
    </tr>
    <tr>
        <td width="15%" style="text-align: right"><b>Address</b></td>
        <td width="85%" colspan="3"><b>Higher Education Development Center Building, C.P. Garcia Ave, UP Campus, Diliman, Quezon City, Metro Manila</b></td>
    </tr>
    <tr>
        <td width="15%" style="text-align:center;">Responsibility Cennter</td>
        <td width="55%" style="height: 300px">
        <br><br>
        <p>Request for payment of ';
        if(!empty($fee)){
            $loadinfo .= $fee_name;

        }else{
            $loadinfo .= "tuiton fees annd other school fees (TOSF)";

        }
        $loadinfo .=' for the ';
            if($semester == "1st Semester"){
                $loadinfo .= '<span style="font-weight: bold; text-decoration: underline;">FIRST</span>';
            }else{
                $loadinfo .= '<span style="font-weight: bold; text-decoration: underline;">SECOND</span>';

            }
        $loadinfo .= ' Term AY <span style="font-weight: bold; text-decoration: underline;">'. $academic_year .'</span> to be charged against the Free Higher Education for CHED under Republic Act 10931 otherwise known as the Universal Access to Quality Tertiary Education(UAQTE), and as per CHED-UniFAST Guidelines for Free HE per attached supporting documents. 
        </p>
        </td>
        <td width="15%" style="text-align:center;">Account Code</td>
        <td width="15%" style="text-align:center;">Amount
        <br><br><br>Php '.number_format($total_fees, 2, ".", ",").'
        </td>
    </tr>
    
</table>
<table border="1" cellpadding="7">
 <tr>
            <td width="15%" style="text-align: center">Signature</td>
            <td width="35%"></td>
            <td width="15%" style="text-align: center">Signature</td>
            <td width="35%"></td>
        </tr>
        <tr>
            <td width="15%" style="text-align: center">Printed Name</td>
            <td width="35%" style="text-align: center"><b>TERESITA V. ESPLAGO</b></td>
            <td width="15%" style="text-align: center">Printed Name</td>
            <td width="35%" style="text-align: center"><b>MARIO CARMELO A. PESA</b></td>
        </tr>
        <tr>
            <td width="15%" style="text-align: center">POSITION</td>
            <td width="35%" style="text-align: center"><b>Vice President for Administration, Planning & Finance</b></td>
            <td width="15%" style="text-align: center">POSITION</td>
            <td width="35%" style="text-align: center"><b>College Administrator</b></td>
        </tr>
        <tr>
            <td width="15%" style="text-align: center">Date</td>
            <td width="35%" style="text-align: center">'.$formatDate.'</td>
            <td width="15%" style="text-align: center">Date</td>
            <td width="35%" style="text-align: center">'.$formatDate.'</td>
        </tr>
</table>
<table width="100%" border="1">
        <tr><td></td><td> </td></tr>
        <tr>
            <td><b>INSTRUCTIONS</b>
            <p>1. SUCs are allowed a maximum of two (2) tranches of payments per semester.											
            </p>
            <p>2. The Free HE statement reference number shall comprise of the REGIONAL CODE (2-digit),												
            <br>SUC CODE (alpha codes), ACADEMIC YEAR (4-digit), TERM (1-digit), 												
            <br>LUC CODE (alpha code) ACADEMIC YEAR (4-digit), TERM (1-digit)												
            <br>& BATCH NUMBER (1 digit). Descriptions and codes are provided below:												

            </p>
            <br><b>Regional Codes</b><br><br>
            <table>
                <tr>
                    <td>Region</td>
                    <td>Code</td>
                    <td>Region</td>
                    <td>Code</td>
                    <td>Region</td>
                    <td>Code</td>
                </tr>
                <tr>
                    <td>Region 1</td>
                    <td>01</td>
                    <td>Region 6</td>
                    <td>06</td>
                    <td>Region 12</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>Region 2</td>
                    <td>02</td>
                    <td>Region 7</td>
                    <td>07</td>
                    <td>NCR</td>
                    <td>NCR</td>
                </tr>
                <tr>
                    <td>Region 3</td>
                    <td>03</td>
                    <td>Region 8</td>
                    <td>08</td>
                    <td>CARAGA</td>
                    <td>CARAGA</td>
                </tr>
                <tr>
                    <td>Region 4A</td>
                    <td>04</td>
                    <td>Region 9</td>
                    <td>09</td>
                    <td>BARMM</td>
                    <td>BARMM</td>
                </tr>
                <tr>
                    <td>Region 4B</td>
                    <td>MIMAROPA</td>
                    <td>Region 10</td>
                    <td>10</td>
                    <td>CAR</td>
                    <td>CAR</td>
                </tr>
                <tr>
                    <td>Region 5</td>
                    <td>05</td>
                    <td>Region 11</td>
                    <td>11</td>
                    <td></td>
                    <td></td>
                </tr>
            </table><br>
            <p style="font-style: italic;">"SUC Code" shall be the Acronym used by the SUC for their institution.
            <br>"LUC Code" shall be the Acronym used by the LUC for their institution.
            <br>e.g. MinSCAT for Mindoro State College of Agriculture and Technology<br>									
            </p>
            </td>
            <td><br>
            <p>"Academic Year" will use the year when the AY began (e.g. 2018 for AY 2018-2019).<br>
            <br>"Term" refers to the academic year semester or terms: </p>
            <table>
                <tr>
                    <td style="text-decoration: underline">Term</td>
                    <td style="text-decoration: underline">Code</td>
                    <td style="text-decoration: underline">Term</td>
                    <td style="text-decoration: underline">Code</td>
                </tr>

                <tr>
                    <td>1st Semester</td>
                    <td>1</td>
                    <td>3rd Semester</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>2nd Semester</td>
                    <td>2</td>
                    <td>Summer</td>
                    <td>3</td>
                </tr>
            </table><br>
            <p>"Batch" refers to the number of times an SUC / LUC liquidates with  CHED in a semester. 										
            <br><b>Note that SUCs / LUCs may liquidate with CHED no more than two (2) batches per semester</b>.										
            </p><br>
            <p>Examples of a billing statement no.
            <br>The first batch of Free HE statement submitted by MinSCAT in 1st sem AY 2018-2019:<br>									
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>MIMAROPA - MinSCAT - 2018 - 1 -1</b>									
            <br>The second batch of Free HE statement submitted by Quirino State University in 1st semester of AY 2018 - 2019<br>										
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>02 - QSU - 2018 - 1 - 2</b>							

            </p><br>
            <p>3. Send a printed copy of this completed Free HE Statement Form (Form 1) to 								
            <br>CHED Central Office Records Section for proper receiving procedures. 								
            <br>Do not send the signed forms to any other office in CHED.								

            </p>
            </td>
        </tr>
    
    </table>
';

?>