<?php
    // Start the session
    ob_start();
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    session_start();


    // Unset all of the session variables
    unset($_SESSION["kll_user_id"]);


    header('Location: ./register_login/user_login.php');
    exit();
?>