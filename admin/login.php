<?php 
    
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    session_start();
    //date and time now
    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d H:i:s");

    $user = "";
    $pass = "";
    $admin_id="";
    $admin_type="";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $inptuser = $_POST['txt_username'];
        $inptpass = $_POST['txt_pass'];

        $e_user = openssl_encrypt($inptuser, $method, $key);
        $e_dateNow = openssl_encrypt($dateNow, $method, $key);
        $e_action = openssl_encrypt('logged in', $method, $key);

        $result = $conn->query("select * from tb_admin where username like '$e_user'");
        while($row = $result -> fetch_assoc()){
            $user = $row['username'];
            $pass = $row['pass'];
            $admin_id = $row['id'];
            $admin_type = $row['admin_type'];
        }

        $user = openssl_decrypt($user, $method, $key);
        $pass = openssl_decrypt($pass, $method, $key);
        $admin_type = openssl_decrypt($admin_type, $method, $key);


        if($inptpass == "" || $inptuser =="") {
            $response = array('success'=>false,'message'=>'Login Failed. Blank Input. Please Try Again.');

            header('Content-Type: application/json');
            echo json_encode($response);
        }
        elseif ($inptuser == $user && $inptpass == $pass) {
            $response = array('success'=>true, 'message'=>" You are successfully logged in. Welcome $inptuser");
            $_SESSION['kll_admin_id'] = $admin_id;
            $_SESSION['admin_type'] = $admin_type;
            $conn->query("insert into tb_adminlog(admin_id, actn, date_time)values('$admin_id', '$e_action', '$e_dateNow')");
            
            header('Content-Type: application/json');
            echo json_encode($response);
        
        } else {
            $response = array('success'=>false, 'message'=>'Login Failed. Wrong Input. Please Try Again.');

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
?>