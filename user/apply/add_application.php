<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    $student_id = $_SESSION['kll_user_id'];

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    // Get the current year
    $currentYear = date('Y');

    // Get the maximum ID value from the table
    $result = $conn->query("SELECT MAX(id) AS max_id FROM tb_application");
    $row = $result->fetch_assoc();
    $maxId = $row['max_id'];

    // Increment maxId to get the new unique ID
    $uniqueId = $maxId + 1;

    // Pad the unique ID to 10 digits
    $uniqueIdPadded = str_pad($uniqueId, 10, '0', STR_PAD_LEFT);

    // Combine to form the application number
    $applicationNumber = "APPL-" . $currentYear . $uniqueIdPadded;

    $targetDir = "./applicationfiles/";        
    $fileNames = array_filter($_FILES["inputFiles"]["name"]);
    $allowTypes = array('jpg','png','jpeg', 'pdf', 'JPG', 'JPEG', 'PNG');
    $fileIMGs = implode(",", $fileNames);

    $application_num = openssl_encrypt($applicationNumber, $method, $key);
    $files = openssl_encrypt($fileIMGs, $method, $key);
    $application_date = openssl_encrypt($dateNow, $method, $key);
    $yearsem_id = $_POST["slct_yearsem"];
    $scholarship_id = $_POST["scholarship_id"];
    $applicant_type = openssl_encrypt($_POST["slct_type"], $method, $key);
    $isScholar = openssl_encrypt($_POST["slct_isScholar"], $method, $key);
    $otherScholarships = openssl_encrypt($_POST["txt_otherScholarships"], $method, $key);
    $stats = openssl_encrypt("Pending", $method, $key);
    $isLocked = openssl_encrypt("false", $method, $key);

    $values="";
    if($fileNames){
        foreach($_FILES["inputFiles"]["name"] as $key=>$val){
            $fileName = basename($_FILES["inputFiles"]["name"][$key]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["inputFiles"]["tmp_name"][$key], $targetFilePath)){

                $values="('$student_id','$application_num', '$files', '$application_date', '$yearsem_id', '$scholarship_id', '$applicant_type', '$isScholar', '$otherScholarships', '$stats', '$isLocked')";
                
                }else{
                    $response = array('success'=>false, 'message'=>"Sorry, there was an error uploading your file.");
                    echo json_encode($response);
                }

            }else{
                $response = array('success'=>false, 'message'=>"Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.");
                echo json_encode($response);
            }
        
        }


    }else{
        $response = array('success'=>false, 'message'=>"Please upload a file.");
        echo json_encode($response);
    }

    if(!empty($values)){
        $insert = $conn->query("insert into tb_application(student_id, application_num, files, application_date, yearsem_id, scholarship_id, applicant_type, isScholar, otherScholarships, stats, isLocked) values $values");

        if($insert){
            $response = array('success'=>true, 'message'=>"Application $applicationNumber submitted successfully. ");
            echo json_encode($response);
        }
    }
?>