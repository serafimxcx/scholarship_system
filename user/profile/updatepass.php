<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    session_start();

    $student_id = $_SESSION['kll_user_id'];

    $oldpass = openssl_encrypt($_POST["oldpass"], $method, $key);
    $newpass = openssl_encrypt($_POST["newpass"], $method, $key);

    $checkStudent = $conn->query("select * from tb_student where id='$student_id' and pass='$oldpass'");

    if(mysqli_num_rows($checkStudent) == 0){
        echo "Old password is incorrect.";
    }else{
        $query = "update tb_student set
                pass='".$newpass."'
                where id='".$student_id."'";
                mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

                echo "";
    }

    
?>