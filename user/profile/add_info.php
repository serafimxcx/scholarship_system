<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    $student_id = $_SESSION['kll_user_id'];

    $targetDir = "./profilepic/";
    $fileName = basename($_FILES["slct_profileimg"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $profile_pic = openssl_encrypt($fileName, $method, $key);
    $lrn = openssl_encrypt($_POST["txt_lrn"], $method, $key);
    $school_attended = openssl_encrypt($_POST["txt_sch_attended"], $method, $key);
    $school_id_num = openssl_encrypt($_POST["txt_sch_num"], $method, $key);
    $school_address = openssl_encrypt($_POST["txt_sch_address"], $method, $key);
    $school_sector = openssl_encrypt($_POST["slct_sch_sector"], $method, $key);
    $disability = openssl_encrypt($_POST["txt_disability"], $method, $key);
    $tribal_membership = openssl_encrypt($_POST["txt_membership"], $method, $key);
    $program_id = $_POST["slct_program"];
    $yearlevel_id = $_POST["slct_yearlevel"];
    $total_units = openssl_encrypt($_POST["txt_units"], $method, $key);
    $last_name = openssl_encrypt($_POST["txt_lastname"], $method, $key);
    $first_name = openssl_encrypt($_POST["txt_firstname"], $method, $key);
    $middle_name = openssl_encrypt($_POST["txt_middlename"], $method, $key);
    $birthdate = openssl_encrypt($_POST["txt_birthdate"], $method, $key);
    $birthplace = openssl_encrypt($_POST["txt_birthplace"], $method, $key);
    $sex = openssl_encrypt($_POST["slct_sex"], $method, $key);
    $civil_status = openssl_encrypt($_POST["slct_civilstatus"], $method, $key);
    $religion = openssl_encrypt($_POST["txt_religion"], $method, $key);
    $citizenship = openssl_encrypt($_POST["txt_citizenship"], $method, $key);
    $address = openssl_encrypt($_POST["txt_address"], $method, $key);
    $postal_code = openssl_encrypt($_POST["txt_postal"], $method, $key);

    $father_name = openssl_encrypt($_POST["txt_f_name"], $method, $key);
    $father_occupation = openssl_encrypt($_POST["txt_f_occupation"], $method, $key);
    $father_address = openssl_encrypt($_POST["txt_f_address"], $method, $key);
    $father_status = openssl_encrypt($_POST["slct_f_status"], $method, $key);
    $mother_name = openssl_encrypt($_POST["txt_m_name"], $method, $key);
    $mother_occupation = openssl_encrypt($_POST["txt_m_occupation"], $method, $key);
    $mother_address = openssl_encrypt($_POST["txt_m_address"], $method, $key);
    $mother_status = openssl_encrypt($_POST["slct_m_status"], $method, $key);
    $no_of_siblings = openssl_encrypt($_POST["txt_siblings"], $method, $key);
    $gross_income = openssl_encrypt($_POST["txt_grossincome"], $method, $key);

    $values1= "";
    if(!empty($_FILES["slct_profileimg"]["name"])){
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif', 'JPG', 'PNG', 'JPEG', 'GIF');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["slct_profileimg"]["tmp_name"], $targetFilePath)){
                // inserting image file name into database
                
                $values1= "('$student_id', '$profile_pic', '$lrn', '$school_attended', '$school_id_num', '$school_address', '$school_sector', '$disability', '$tribal_membership', '$program_id', '$yearlevel_id', '$total_units', '$last_name', '$first_name', '$middle_name', '$birthdate', '$birthplace', '$sex', '$civil_status', '$religion', '$citizenship', '$address', '$postal_code')";
                

            }else{
                $response = array('success'=>false, 'message'=>"Sorry, there was an error uploading your file.");
                echo json_encode($response);
            }
        }else{
            $response = array('success'=>false, 'message'=>"Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.");
            echo json_encode($response);
        }
    }else{
        $values1 = "('$student_id', '', '$lrn', '$school_attended', '$school_id_num', '$school_address', '$school_sector', '$disability', '$tribal_membership', '$program_id', '$yearlevel_id', '$total_units', '$last_name', '$first_name', '$middle_name', '$birthdate', '$birthplace', '$sex', '$civil_status', '$religion', '$citizenship', '$address', '$postal_code')";

        
    }

    $insert1 = $conn->query("insert into tb_studentinfo(student_id, profile_pic, lrn, school_attended, school_id_num, school_address, school_sector, disability, tribal_membership, program_id, yearlevel_id, total_units, last_name, first_name, middle_name, birthdate, birthplace, sex, civil_status, religion, citizenship, address, postal_code) values $values1");

    $insert2 = $conn->query("insert into tb_familyinfo(student_id, father_name, father_occupation, father_address, father_status, mother_name, mother_occupation, mother_address, mother_status, no_of_siblings, gross_income) values('$student_id', '$father_name', '$father_occupation', '$father_address', '$father_status', '$mother_name', '$mother_occupation', '$mother_address', '$mother_status', '$no_of_siblings', '$gross_income')");

    if($insert1 && $insert2){
        $response = array('success'=>true, 'message'=>"Profile Information Saved Successfully. You can now apply for scholarship.");
        echo json_encode($response);
    }else{
        $response = array('success'=>false, 'message'=>"File upload failed, please try again.");
        echo json_encode($response);
    } 
?>