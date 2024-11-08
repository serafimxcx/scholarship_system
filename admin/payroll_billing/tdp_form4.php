<?php 
$n = 0;

$academic_year = "__________";
$semester = "__________";

if($_GET["slct_apptype"] == "New"){
    $filename = "New TDP Form 3 - Annex 7";

}else if($_GET["slct_apptype"] == "Continuing"){
    $filename = "TDP Continuing Form 4 - Annex 5";

}

while($row = mysqli_fetch_assoc($result)){
    
    $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
    $semester = openssl_decrypt($row["semester"], $method, $key);

    $first_semester = openssl_decrypt($row["1st_semester"], $method, $key);
    $second_semester = openssl_decrypt($row["2nd_semester"], $method, $key);

    $n++;

}
$loadinfo .= '<table width="100%" class="header">
<tr><td colspan="3" style="text-align: right;"><h1>'.$filename.'</h1><br><br></td></tr>
<tr>
        <td class="header_left"><img src="'.$destinationLipaLogo.'" class="pdf_logo2"></td>
        <td class="header_middle">
            
            Republic of the Philippines<br>
            <b>KOLEHIYO NG LUNGSOD NG LIPA</b><br>
            MARAWOY LIPA CITY
            
        </td>
        <td class="header_right"><img src="'.$destinationKLLLogo.'" class="pdf_logo2"></td>
    </tr>
</table><br><br>
<div>
<span class="date">Date: &nbsp;' . date("F j, Y") .' &nbsp;</span>
</div><br>
<div style="text-align: center">
<h2>CERTIFICATION</h2>
</div>
<div>
<b>TO WHOM IT MAY CONCERN</b><br><br>
This is to certify that the total number of TDP grantees by campus as shown below, are qualified to avail of the Tulong Dunong Program (TDP) under R.A. No. 10931 also known as Universal Access to Quality Tertiary Education (UAQTE) for the  '.$semester.' of Academic '.$academic_year.', 
</div><br>
<table cellpadding="3">
    <tr>
        <td width="10%"></td>
        <td width="40%" style="border: 1px solid black; text-align:center">Name of Campus</td>
        <td width="40%" style="border: 1px solid black; text-align:center">Number of TDP Grantees</td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="40%" style="border: 1px solid black;">Campus A</td>
        <td width="40%" style="border: 1px solid black; text-align:center">'.$n.'</td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="40%" style="border: 1px solid black;">Total</td>
        <td width="40%" style="border: 1px solid black; text-align:center">'.$n.'</td>
        <td width="10%"></td>
    </tr>
</table><br>
<div>
This further certifies that the students’ information indicated in the billing statement of the Masterlist of Continuing TDP Grantees (Annex 6) is accurate and complete.<br><br>
This certification is being issued in accordance with the UniFAST Memorandum Circular (JMC) No. __ Series of 2022, on the Enhanced Guidelines of the Tulong Dunong Program (TDP).

</div>
<br><br><br><br>
<div style="text-align:right">
<p>Certified by:<br><br><br>DELIA A. LIBREA</p>
</div><BR><BR><BR><BR>
<div style="text-align:right">
<p>Approved by:<br><br><br>MARIO CARMELO A. PESA</p>
</div>
';


?>