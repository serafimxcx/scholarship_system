<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $student_no = openssl_encrypt($_POST["txt_studentno"], $method, $key);
    $pass = openssl_encrypt($_POST["txt_pass"], $method, $key);
    $email = openssl_encrypt($_POST["txt_email"], $method, $key);
    $contact = openssl_encrypt($_POST["txt_contact"], $method, $key);

    $checkStudent = $conn->query("select * from tb_student where student_number like '$student_no'");

    if(mysqli_num_rows($checkStudent) == 0){
        $query = "insert into tb_student(student_number, pass, email, contact) values('$student_no', '$pass', '$email', '$contact')";


        mysqli_query($conn, $query) or die(mysqli_error($conn));

        echo "";
    }else{
        echo "Student number is already existing.";
        
    }
    

    
?>