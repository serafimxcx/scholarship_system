<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    
    

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");
    $formatDate =  date("F j, Y");

    $yearsem1 = $_GET["slct_yearsem1"];
    $yearsem2 = $_GET["slct_yearsem2"];
    $program = $_GET["slct_program"];

    $academic_year = "";
    $semester = "";

    $scholarship= $_GET["slct_scholarship"];
    $fee = $_GET["slct_fee"];

    $file = $_GET["slct_file"];

    $sourceChedLogo = $_SERVER['DOCUMENT_ROOT'] .'/scholarship_system/ched_logo.png';
    $sourceUnifastLogo = $_SERVER['DOCUMENT_ROOT'] .'/scholarship_system/unifast_logo.png';
    $sourceLipaLogo = $_SERVER['DOCUMENT_ROOT'] .'/scholarship_system/lipa_logo.jpg';
    $sourceKLLLogo = $_SERVER['DOCUMENT_ROOT'] .'/scholarship_system/kll_logo.jpg';
    $destinationDir = './temporary_image/';

    // Ensure the destination directory exists
    if (!file_exists($destinationDir)) {
        mkdir($destinationDir, 0755, true);
    }

    // Define destination image paths
    $destinationChedLogo = $destinationDir . 'ched_logo.png';
    $destinationUnifastLogo = $destinationDir . 'unifast_logo.png';
    $destinationLipaLogo = $destinationDir . 'lipa_logo.jpg';
    $destinationKLLLogo = $destinationDir . 'kll_logo.jpg';

    // Copy images to the destination directory
    if (!copy($sourceChedLogo, $destinationChedLogo)) {
        die('Failed to copy ched_logo.png.');
    }
    if (!copy($sourceUnifastLogo, $destinationUnifastLogo)) {
        die('Failed to copy unifast_logo.png.');
    }
    if (!copy($sourceLipaLogo, $destinationLipaLogo)) {
        die('Failed to copy unifast_logo.png.');
    }
    if (!copy($sourceKLLLogo, $destinationKLLLogo)) {
        die('Failed to copy unifast_logo.png.');
    }
    

    
    if($_GET["slct_yearlevel"] != ""){
        $yearlevel = openssl_encrypt($_GET["slct_yearlevel"], $method, $key);

    }else{
        $yearlevel = "";
    }



    if($_GET["slct_apptype"] != ""){
        $type = openssl_encrypt($_GET["slct_apptype"], $method, $key);

    }else{
        $type = "";
    }



    $conditions = [];
    if (!empty($yearsem1)) {
        $conditions[] = "tb_application.yearsem_id LIKE '%$yearsem1%'";
       
        $result_yearsem = $conn->query("select * from tb_yearsem where id LIKE '%$yearsem1%'");

        while($row = $result_yearsem->fetch_assoc()){
            $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
            $semester = openssl_decrypt($row["semester"], $method, $key);
        }
    }

    if (!empty($yearsem2)) {
        $conditions[] = "tb_application.yearsem_id LIKE '%$yearsem2%'";
       

    }

    if (!empty($program)) {
        $conditions[] = "tb_studentinfo.program_id LIKE '%$program%'";
       

    }
    if (!empty($yearlevel)) {
        $conditions[] = "tb_yearlevel.name LIKE '%$yearlevel%'";
       

    }
  

    if (!empty($type)) {
        $conditions[] = "tb_application.applicant_type LIKE '%$type%'";
       

    }

    if($file == "fhe_billing_statement"){
        if (!empty($fee) && $fee != "Tuition Fee") {
            $conditions[] = "tb_fees.id LIKE '%$fee%'";
           
    
        }
    }

    $whereClause = "";
    if (count($conditions) > 0) {
        $whereClause = "and (" . implode(" and ", $conditions) . ")";
    }


    $loadinfo ='';

    $n = 1;
    
    if($scholarship != ""){
        if($file == "fhe_billing_statement" || $file == "fhe_billing_details"){
            $query = 'select tb_student.student_number, tb_studentinfo.lrn, tb_studentinfo.last_name, tb_studentinfo.first_name, tb_studentinfo.middle_name, tb_program.name as program_name, tb_yearlevel.name as yearlevel, tb_studentinfo.sex, tb_student.email,tb_student.contact, tb_studentinfo.total_units, tb_program.cost_per_unit as tuition_fee, tb_yearlevel.fees_id, tb_yearsem.academic_year, tb_yearsem.semester
            FROM tb_student, tb_studentinfo, tb_program, tb_yearlevel, tb_application, tb_fees, tb_yearsem
            WHERE tb_yearlevel.program_id = tb_program.id and tb_program.id = tb_studentinfo.program_id and tb_studentinfo.yearlevel_id = tb_yearlevel.id and tb_studentinfo.student_id = tb_student.id and tb_application.student_id = tb_studentinfo.student_id and tb_application.yearsem_id = tb_yearsem.id '.$whereClause .'GROUP BY tb_application.student_id';
        }else{
            $query = "select 
            tb_yearsem.academic_year,
            CASE WHEN tb_yearsem.semester = '".openssl_encrypt("1st Semester", $method, $key)."' THEN tb_approve.allowance ELSE NULL END AS '1st_semester',
            CASE WHEN tb_yearsem.semester = '".openssl_encrypt("2nd Semester", $method, $key)."' THEN tb_approve.allowance ELSE NULL END AS '2nd_semester',
            
            tb_application.application_num, tb_application.application_date, tb_application.applicant_type, tb_application.id as application_id, tb_yearsem.academic_year, tb_yearsem.semester, tb_program.name as program_name, tb_studentinfo.last_name, tb_studentinfo.first_name, tb_studentinfo.middle_name, tb_studentinfo.birthdate, tb_studentinfo.sex, tb_studentinfo.postal_code, tb_studentinfo.total_units, tb_studentinfo.disability, tb_student.email, tb_student.contact, tb_yearlevel.name as yearlevel, tb_scholarships.name as scholarship_name, tb_scholarships.allowance, tb_approve.award_number, tb_approve.approved_date, tb_student.student_number
            FROM tb_application, tb_yearsem, tb_program, tb_studentinfo, tb_yearlevel, tb_scholarships, tb_approve, tb_student
            WHERE tb_application.yearsem_id = tb_yearsem.id and tb_application.student_id = tb_studentinfo.student_id and tb_application.scholarship_id = tb_scholarships.id and tb_studentinfo.program_id = tb_program.id  and tb_studentinfo.yearlevel_id = tb_yearlevel.id and tb_studentinfo.student_id = tb_student.id and tb_approve.application_id = tb_application.id and tb_application.scholarship_id = '$scholarship' $whereClause GROUP BY tb_application.student_id, tb_yearsem.academic_year";
        }
        

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

          
        if($scholarship == "0"){
            if($file == "fhe_billing_details"){
                include("excel_fhe_details.php");

            }else if($file == "fhe_billing_statement"){
                include("excel_fhe_statement.php");

            }
            
        }else if($scholarship == "1"){
            if($file == "tdp_form2"){
               include("excel_tdp_form2.php");

            }else if($file == "tdp_annex10"){
                include("excel_tdp_annex10.php");

            }else if($file == "tdp_annex5"){
                include("excel_tdp_annex5.php");
            }else if($file == "tdp_form4"){
                include("excel_tdp_form4.php");
            }

        }else if($scholarship == "4"){
            if($file == "tes_annex5"){
               // include("tes_annex5.php");

            }else if($file == "tes_annex2"){
             //   include("tes_annex2.php");

            }else if($file == "tes_form1"){
                   include("excel_tes_form1.php");
   
            }else if($file == "tes_form2"){
                include("excel_tes_form2.php");

         }
        }
    }

    
?>