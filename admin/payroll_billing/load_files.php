<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

date_default_timezone_set('Asia/Manila');
$dateNow = date("Y-m-d");

$scholarship_id=$_POST["scholarship_id"];

//0 = FHE, 1 = TDP, 4 = TES

$loadinfo ="";

if($scholarship_id == 0){
    $loadinfo .= "
    <option value=''>Select FHE File...</option>
    <option value='fhe_billing_details'>Free Higher Education Billing Details</option>
    <option value='fhe_billing_statement'>Consolidated Free Higher Education Billing Statement</option>
    
    ";
}else if($scholarship_id == 1){
    $loadinfo .= "
    <option value=''>Select TDP File...</option>
    <option value='tdp_annex5'>Consolidate TDP Billing Statement</option>
    <option value='tdp_form2'>Consolidated TDP Details</option>
    <option value='tdp_form4'>Certification</option>
    <option value='tdp_annex10'>TDP Payroll</option>
    
    ";

}else if($scholarship_id == 4){
    $loadinfo .= "
    <option value=''>Select TES File...</option>
    
    <option value='tes_form1'>TES Billing Statement</option>
    <option value='tes_form2'>Consolidated TES Details</option>
    ";
    // <option value='tes_annex2'>TES Continuing Form 3 - Annex 2</option>
    // <option value='tes_annex5'>Annex 5 - TES New Form 2</option>
}

echo $loadinfo;





?>