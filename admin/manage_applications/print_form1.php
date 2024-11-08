<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/pdf/config/tcpdf_config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/scholarship_system/pdf/tcpdf.php');

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");
    $formatDate =  date("F j, Y");

    $loadinfo = "";

    $apply_date ="";
    $application_id = "";
    $application_num = "";
    $application_date = "";
    $academic_year = "";
    $semester = "";
    $applicant_type = "";
    $status = "";
    $files = "";
    $isScholar = "";
    $otherScholarships = "";
    $student_id = "";
    $filesArr = "";
    $scholarship_id = "";
    $scholarship_name = "";
    $default_allowance = "";


    $student_no="";
    $email="";
    $contact="";

    $profile_pic = "";
    $lrn = "";
    $school_attended = "";
    $school_id_num = "";
    $school_address = "";
    $school_sector = "";
    $disability = "";
    $tribal_membership = "";
    $program_id = "";
    $yearlevel_id = "";
    $yearlevel = "";
    $total_units = "";
    $last_name = "";
    $first_name = "";
    $middle_name = "";
    $birthdate = "";
    $format_birthdate = "";
    $birthplace = "";
    $sex = "";
    $civil_status = "";
    $religion = "";
    $citizenship = "";
    $address = "";
    $postal_code = "";

    $father_name = "";
    $father_occupation = "";
    $father_address = "";
    $father_status = "";
    $mother_name = "";
    $mother_occupation = "";
    $mother_address = "";
    $mother_status = "";
    $no_of_siblings = "";
    $gross_income = "";

    $program_name="";
    $yearlevel="";

    $sourceForm1Logo = $_SERVER['DOCUMENT_ROOT'] .'/scholarship_system/form1_header.jpg';
    $destinationDir = './temporary_image/';

    // Ensure the destination directory exists
    if (!file_exists($destinationDir)) {
        mkdir($destinationDir, 0755, true);
    }

    // Define destination image paths
    $destinationForm1Logo = $destinationDir . 'form1_header.jpg';

    // Copy images to the destination directory
    if (!copy($sourceForm1Logo, $destinationForm1Logo)) {
        die('Failed to copy form1_header.jpg.');
    }

    $application_id = $_GET["application_id"];

    $resultApplication = $conn->query("select tb_application.id as application_id, tb_application.student_id, tb_application.application_date, tb_application.application_num, tb_application.applicant_type, tb_application.stats, tb_application.files, tb_application.isScholar, tb_application.otherScholarships, tb_application.yearsem_id, tb_yearsem.academic_year, tb_yearsem.semester, tb_scholarships.name as scholarship_name, tb_scholarships.allowance from tb_application, tb_yearsem, tb_scholarships where tb_application.id = '$application_id' and tb_application.yearsem_id = tb_yearsem.id and tb_application.scholarship_id = tb_scholarships.id LIMIT 1");

    while($row = $resultApplication->fetch_assoc()){
        $application_num = openssl_decrypt($row["application_num"], $method, $key);
        $yearsem_id = $row["yearsem_id"];
        $student_id = $row["student_id"];
        $applicant_type = openssl_decrypt($row["applicant_type"], $method, $key);
        $application_date = openssl_decrypt($row["application_date"], $method, $key);
        $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
        $semester = openssl_decrypt($row["semester"], $method, $key);
        $scholarship_name = openssl_decrypt($row["scholarship_name"], $method, $key);
        $default_allowance = openssl_decrypt($row["allowance"], $method, $key);
        $status = openssl_decrypt($row["stats"], $method, $key);
        $files = openssl_decrypt($row["files"], $method, $key);
        $isScholar = openssl_decrypt($row["isScholar"], $method, $key);
        $otherScholarships = openssl_decrypt($row["otherScholarships"], $method, $key);
        $filesArr = explode(",",$files);

    }

    $resultStudentInfo = $conn->query("select * from tb_student where id='$student_id'");

    while($row=$resultStudentInfo->fetch_assoc()){
        $student_no = openssl_decrypt($row["student_number"], $method, $key);
        $email = openssl_decrypt($row["email"], $method, $key);
        $contact = openssl_decrypt($row["contact"], $method, $key);
        $student_id = $row["id"];
    }

    $studentinfo =$conn->query("select * from tb_studentinfo where student_id='$student_id'");
    $familyinfo =$conn->query("select * from tb_familyinfo where student_id='$student_id'");

    while($row = $studentinfo->fetch_assoc()){
        $profile_pic = openssl_decrypt($row["profile_pic"], $method, $key);
        $lrn = openssl_decrypt($row["lrn"], $method, $key);
        $school_attended = openssl_decrypt($row["school_attended"], $method, $key);
        $school_id_num = openssl_decrypt($row["school_id_num"], $method, $key);
        $school_address = openssl_decrypt($row["school_address"], $method, $key);
        $school_sector = openssl_decrypt($row["school_sector"], $method, $key);
        $disability = openssl_decrypt($row["disability"], $method, $key);
        $tribal_membership = openssl_decrypt($row["tribal_membership"], $method, $key);
        $program_id = $row["program_id"];
        $yearlevel_id = $row["yearlevel_id"];
        $total_units = openssl_decrypt($row["total_units"], $method, $key);
        $last_name = openssl_decrypt($row["last_name"], $method, $key);
        $first_name = openssl_decrypt($row["first_name"], $method, $key);
        $middle_name = openssl_decrypt($row["middle_name"], $method, $key);
        $birthdate = openssl_decrypt($row["birthdate"], $method, $key);
        $birthdate_create = date_create($birthdate);
        $format_birthdate = date_format($birthdate_create,"m/d/Y");
        $birthplace = openssl_decrypt($row["birthplace"], $method, $key);
        $sex = openssl_decrypt($row["sex"], $method, $key);
        $civil_status = openssl_decrypt($row["civil_status"], $method, $key);
        $religion = openssl_decrypt($row["religion"], $method, $key);
        $citizenship = openssl_decrypt($row["citizenship"], $method, $key);
        $address = openssl_decrypt($row["address"], $method, $key);
        $arr_address = explode(",", $address);
        $postal_code = openssl_decrypt($row["postal_code"], $method, $key);
    }

    while($row = $familyinfo->fetch_assoc()){
        $father_name = openssl_decrypt($row["father_name"], $method, $key);
        $father_occupation = openssl_decrypt($row["father_occupation"], $method, $key);
        $father_address = openssl_decrypt($row["father_address"], $method, $key);
        $father_status = openssl_decrypt($row["father_status"], $method, $key);
        $mother_name = openssl_decrypt($row["mother_name"], $method, $key);
        $mother_occupation = openssl_decrypt($row["mother_occupation"], $method, $key);
        $mother_address = openssl_decrypt($row["mother_address"], $method, $key);
        $mother_status = openssl_decrypt($row["mother_status"], $method, $key);
        $no_of_siblings = openssl_decrypt($row["no_of_siblings"], $method, $key);
        $gross_income = openssl_decrypt($row["gross_income"], $method, $key);
    }

    $resultyearlevel =$conn->query("select * from tb_yearlevel where id='$yearlevel_id'");

    while($row = $resultyearlevel->fetch_assoc()){
        $yearlevel = openssl_decrypt($row["name"], $method, $key);
    }

    $checkAccept = $conn->query("select * from tb_approve where application_id='$application_id'");
    $isAccepted = false;

    $approve_id = "";
    $award_num = "";
    $allowance = "";
    if(mysqli_num_rows($checkAccept) > 0){
        $isAccepted = true;

        while($row = $checkAccept->fetch_assoc()){
            $approve_id = $row["id"];
            $award_number = openssl_decrypt($row["award_number"], $method, $key);
            $allowance = openssl_decrypt($row["allowance"], $method, $key);
        }
    }

    include_once("form1.php");

    
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(5, 1, 5);

    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 8);
    $pdf->writeHTML($loadinfo);
    $filename = "form1" . date("Y-m-d") . "_" . $application_num . ".pdf";
    $pdf->Output($filename, 'I');
   
?>