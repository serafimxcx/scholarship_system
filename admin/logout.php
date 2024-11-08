<?php
    // Start the session
    ob_start();
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    session_start();

    //date and time now
    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d H:i:s");

    $e_dateNow = openssl_encrypt($dateNow, $method, $key);
    $e_action = openssl_encrypt('logged out', $method, $key);

    $conn->query("insert into tb_adminlog(admin_id, actn, date_time)values('$_SESSION[kll_admin_id]', '$e_action', '$e_dateNow')");

    // Unset all of the session variables
    unset($_SESSION["kll_admin_id"]);
    unset($_SESSION["admin_type"]);


    header('Location: admin_login.php');
    exit();
?>