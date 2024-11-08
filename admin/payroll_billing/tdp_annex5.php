<?php

$filename = "";

if($_GET["slct_apptype"] == "New"){
    $filename = "New TDP Form 1 - Annex 7";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TDP Continuing Form 1 - Annex 5";

}


$total_accumulated = 0;
$n = 0;

$academic_year = "__________";
$semester = "__________";

while($row = mysqli_fetch_assoc($result)){
    
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);

    $first_semester = openssl_decrypt($row["1st_semester"], $method, $key);
    $second_semester = openssl_decrypt($row["2nd_semester"], $method, $key);

    if ($row["1st_semester"] !== null) {
    $total_accumulated += floatval($first_semester);

    }else{
    $total_accumulated += 0;
    }
    
    if ($row["2nd_semester"] !== null) {
    $total_accumulated += floatval($second_semester);


    }else{
    $total_accumulated += 0;
    
    
    }   

    $n++;

}

$support_amount = $total_accumulated * 0.005;


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
    <tr><td colspan="3"><h2 style="text-align:center;">CONSOLIDATED TDP-TES BILLING STATEMENT</h2></td></tr>
    <tr><td colspan="3"><span class="date">TDP Billing Details Reference Number: _______________________<br>Date:<span class="txt_date"> ' . date("F j, Y") .'</span></span></td></tr>
    </table>
    <table width="100%">
        <tr>
            <td width="10%" style="text-align: right; border:1px solid black;"><b>To</b></td>
            <td width="90%" colspan="3" style="border:1px solid black;"><b>CHED - Regional Office ___</b></td>
        </tr>
        <tr>
            <td style="text-align: right; border:1px solid black;"><b>Address</b></td>
            <td colspan="3" style="border:1px solid black;"><b>CHED Region IVA Bldg. Jose P. Laurel Highway</b></td>
        </tr>
        <tr>
            <td style="border:1px solid black;"></td>
            <td colspan="3" style="border:1px solid black;"></td>
        </tr>
        <tr>
            <td width="10%" rowspan="9" style="border:1px solid black;">Responsibility Center</td>
            <td width="55%" style="border-right:1px solid black;" >CHED - Regional Officee _____
                <p>Request for payment of the Tulong Dungong Program - Tertiary Education Subsidy (TDP-TES) grant '.$semester.',  Academic Year '.$academic_year.' to be charged against the funds for Universal Access to Quality Tertiary Education (UAQTE) under General Appropriation Act (GAA)  for Fiscal Year __________, as per attached supporting documents
                <br>a) Certificate of Registration (COR) (PDF File only)
                <br>b) Photocopy of ID with signature (PDF FIle only)
                <br>c) Certified true copy of grades 
                </p>
                <br>

            </td>
            <td width="15%" style="text-align:center; border:1px solid black;">Account Code</td>
            <td width="20%" style="text-align:center; border:1px solid black; ">Amount<br><br><br><br><br><br>
            <b>Php '.number_format(($total_accumulated+$support_amount), 2, ".", ",").'</b>
            <br><br><br><br><br><br>
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid black;"></td>
            <td style="border:1px solid black;"></td>
            <td style="border-right:1px solid black;"></td>
        </tr>
        <tr>
            <td style="border-right:1px solid black;">Total number of TDP-TES student-grantees in the Higher Education Institution (HEI):</td>
            <td style="border:1px solid black; text-align: right; font-weight: bold;">'.$n.'</td>
            <td style="border-right:1px solid black;"></td>
        </tr>
        <tr>
            <td style="border-right:1px solid black;">Add .5 percent (.005%) Administrative Support for Partner Institutions</td>
            <td style="border:1px solid black; text-align: right; font-weight: bold;">PhP '.number_format($support_amount, 2, ".", ",").'</td>
            <td style="border-right:1px solid black;"></td>
        </tr>

        <tr>
            <td style="border-right:1px solid black;"><b>TOTAL:  TDP-TES Billing Amount</b></td>
            <td style="border:1px solid black; text-align: right; font-weight: bold;">PhP '.number_format($total_accumulated, 2, ".", ",").'</td>
            <td style="border-right:1px solid black;"></td>
        </tr>
        <tr>
            <td style="border-right:1px solid black;"></td>
            <td style="border:1px solid black;"></td>
            <td style="border-right:1px solid black;"></td>
        </tr>
        <tr>
            <td rowspan="3" style="border:1px solid black;">Basis for the Tertiary Education Subsidy: <b>Section 23, Rule IV, IRR of R.A. No. 10931</b></td>
            <td colspan="2" style="border:1px solid black; text-align: center">Action to be taken<br>(To be approved by CHEDRO)</td>

        </tr>
        <tr>
            <td style="border:1px solid black;"><br><br>PhP<br></td>
            <td style="border:1px solid black;">Excess (deficient) billing noted for further action</td>

        </tr>
        <tr>
            <td style="border:1px solid black;"><br><br>PhP<br></td>
            <td style="border:1px solid black;">Approved for payment</td>

        </tr>
    </table>
    <table width="100%" border="1" cellpadding="5">
        <tr>
            <td colspan="2">
                <b>Certified</b><br><br>
                <table width="100%">
                    <tr>
                        <td width="10%"><div style="border: 1px solid black; width: 25px; height: 20px;"></div></td>
                        <td width="90%">&nbsp;Supporting documents complete and amount claimed proper.</td>
                    </tr>
                </table><br>
                Is this the last batch of billing for this term of AY '.$academic_year.'?<br><br>
                <table width="100%">
                    <tr>
                        <td width="10%"><div style="border: 1px solid black; width: 25px; height: 20px;"></div></td>
                        <td width="20%">&nbsp;Yes</td>
                        <td width="10%"><div style="border: 1px solid black; width: 25px; height: 20px;"></div></td>
                        <td width="40%">&nbsp;No</td>


                    </tr>
                </table><br>
            </td>
            <td colspan="2">
                <b>Approved</b><br><br>
            </td>
        </tr>
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
            <td rowspan="2" width="15%" style="text-align: center">POSITION</td>
            <td width="35%" style="text-align: center">Vice President for Administration, Planning & Finance</td>
            <td rowspan="2" width="15%" style="text-align: center">POSITION</td>
            <td width="35%" style="text-align: center">College Administrator</td>
        </tr>
        <tr>
            <td width="35%" style="text-align: center">Head, Accounting/Authorized Representative</td>
            <td width="35%" style="text-align: center">President/Authorized Representative</td>
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
            <td><b>INSTRUCTIONS</b><br><br>
            <br>The TDP-TES statement reference number shall comprise of the REGIONAL CODE (2-digit),
            <br>HEI CODE (alpha codes), ACADEMIC YEAR (4-digit), TERM (1-digit),
            <br>and BATCH NUMBER (1 digit).  The Descrption and codes are provided below:<br>
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
            <p><span style="color:red;">"HEI Code" shall be the Acronym used by the HEI for their institution.</span>
            <br>e.g.  Jose Rizal University - JRU</p><br>
            <p>"Academic Year" will use the year when the AY began (e.g. 2020 for AY 2020-2021).</p><br><br>
            
            </td>
            <td><br>
            <p>"Term" refers to the academic year semester or terms: </p>
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
            <p><span style="color:red;">"Batch" refers to the number of times the HEI bills the CHED within a semester. </span>
            <br><b>Note that the HEIs may bill the CHED no more than two (2) batches per semester.</b></p><br>
            <p><span style="text-decoration: underline;">Examples of a billing statement no.</span>
            <br>The first batch of TDP-TES statement submitted by JRU in 1st sem AY 2020-2021:
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\'NCR-JRU-2020-1-1</p><br><br>
            <p>Submit a printed copy of completed TES Statement Form (Form 1) together with other required documents and a cover letter address to:</p>
            <p style="text-align:center; color: red;">Name of Regional Director
            <br>Position
            <br>Region</p>
            </td>
        </tr>
    
    </table>
    
    
    ';
?>