<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    $studentno = openssl_encrypt($_POST["studentno"], $method, $key);

    $newpass = openssl_encrypt($_POST["newpass"], $method, $key);
    $code = openssl_encrypt($_POST["code"], $method, $key);

    $checkStudent = $conn->query("select * from tb_student where student_number='$studentno' and verification_code='$code'");

    if(mysqli_num_rows($checkStudent) == 0){
        echo "Update Failed. Please double check your student number or verification code.";
    }else{
        $query = "update tb_student set
                pass='".$newpass."'
                where student_number='".$studentno."'";
                mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

                echo "";
    }

    
?>