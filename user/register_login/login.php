<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    session_start();
    //date and time now
    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d H:i:s");

    $user = "";
    $pass = "";
    $user_id="";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $inptuser = $_POST['txt_studentno'];
        $inptpass = $_POST['txt_pass'];

        $e_user = openssl_encrypt($inptuser, $method, $key);
        $e_dateNow = openssl_encrypt($dateNow, $method, $key);

        $result = $conn->query("select * from tb_student where student_number like '$e_user'");
        while($row = $result -> fetch_assoc()){
            $user = $row['student_number'];
            $pass = $row['pass'];
            $user_id = $row['id'];
        }

        $user = openssl_decrypt($user, $method, $key);
        $pass = openssl_decrypt($pass, $method, $key);


        if($inptpass == "" || $inptuser =="") {
            $response = array('success'=>false,'message'=>'Login Failed. Blank Input. Please Try Again.');

            header('Content-Type: application/json');
            echo json_encode($response);
        }
        elseif ($inptuser == $user && $inptpass == $pass) {
            $response = array('success'=>true, 'message'=>" You are successfully logged in. Welcome $inptuser");
            $_SESSION['kll_user_id'] = $user_id;
            
            header('Content-Type: application/json');
            echo json_encode($response);
        
        } else {
            $response = array('success'=>false, 'message'=>'Login Failed. Wrong Input. Please Try Again.');

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
?>