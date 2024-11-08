<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/img_announcement/";
    $fileName = basename($_FILES["slct_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $image = openssl_encrypt($fileName, $method, $key);
    $title = openssl_encrypt($_POST["txt_title"], $method, $key);
    $body = openssl_encrypt($_POST["txt_body"], $method, $key);
    $created_at = openssl_encrypt($dateNow, $method, $key);
    $updated_at = openssl_encrypt($dateNow, $method, $key);

    $values = "";
    if(!empty($_FILES["slct_image"]["name"])){
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif', 'JPG', 'PNG', 'JPEG', 'GIF');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["slct_image"]["tmp_name"], $targetFilePath)){
                // inserting image file name into database
                
                $values= "('$title', '$body', '$image', '$created_at', '$updated_at')";
                

            }else{
                $response = array('success'=>false, 'message'=>"Sorry, there was an error uploading your file.");
                echo json_encode($response);
            }
        }else{
            $response = array('success'=>false, 'message'=>"Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.");
            echo json_encode($response);
        }
    }else{
        $values= "('$title', '$body', '', '$created_at', '$updated_at')";

        
    }

    $insert = $conn->query("insert into tb_announcement(title, body, picture, created_at, updated_at) values $values");


    if($insert){
        $response = array('success'=>true, 'message'=>"Announcement Posted Successfully.");
        echo json_encode($response);
    }else{
        $response = array('success'=>false, 'message'=>"Announcement upload failed, please try again.");
        echo json_encode($response);
    } 
?>