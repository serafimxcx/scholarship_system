<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    $student_id = $_SESSION['kll_user_id'];

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");


    $targetDir = "./applicationfiles/";        
    $fileNames = array_filter($_FILES["inputFiles"]["name"]);
    $allowTypes = array('jpg','png','jpeg', 'pdf', 'JPG', 'JPEG', 'PNG');
    $fileIMGs = implode(",", $fileNames);

    $txt_files = $_POST["txt_files"];
    $application_date = openssl_encrypt($dateNow, $method, $key);
    $yearsem_id = $_POST["slct_yearsem"];
    $scholarship_id = $_POST["scholarship_id"];
    $application_id = $_POST["application_id"];
    $applicant_type = openssl_encrypt($_POST["slct_type"], $method, $key);
    $isScholar = openssl_encrypt($_POST["slct_isScholar"], $method, $key);
    $otherScholarships = openssl_encrypt($_POST["txt_otherScholarships"], $method, $key);
    $stats = openssl_encrypt("Pending", $method, $key);
    $isLocked = openssl_encrypt("false", $method, $key);

    if($txt_files == "N/A"){
        $files = openssl_encrypt($fileIMGs, $method, $key);
    }else{
        $files = openssl_encrypt($txt_files.",".$fileIMGs, $method, $key);
        
    }

    if($fileNames){
        foreach($_FILES["inputFiles"]["name"] as $key=>$val){
            $fileName = basename($_FILES["inputFiles"]["name"][$key]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["inputFiles"]["tmp_name"][$key], $targetFilePath)){

                    
                    $values="files='$files', yearsem_id='$yearsem_id', applicant_type='$applicant_type', isScholar='$isScholar', otherScholarships='$otherScholarships'";
                    
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
        $update = $conn->query("update tb_application set $values where id='$application_id'");

        if($update){
            $response = array('success'=>true, 'message'=>"Application has updated successfully. ");
            echo json_encode($response);
        }
    }
?>