<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/Exception.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/PHPMailer.php");
    require($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/PHPMailer/src/SMTP.php");
   

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    
    $status = $_POST["status"];
    $reason = $_POST["reason"];
    $application_id = $_POST["application_id"];

    $e_status = openssl_encrypt($status, $method, $key);
    $e_reason = openssl_encrypt($reason, $method, $key);


    $conn->query("update tb_approve set scholar_status='$e_status', reason='$e_reason' where application_id='$application_id'");
    
    
    echo "Record Updated Successfully.";
            

        

    
    $conn->close();

?>