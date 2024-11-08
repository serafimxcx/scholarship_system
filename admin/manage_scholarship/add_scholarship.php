<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $desc = openssl_encrypt($_POST["txt_desc"], $method, $key);
    $allowance = openssl_encrypt($_POST["txt_allowance"], $method, $key);
    $start_date = openssl_encrypt($_POST["txt_startdate"], $method, $key);
    $end_date = openssl_encrypt($_POST["txt_enddate"], $method, $key);

    $query = "insert into tb_scholarships(name, description, allowance, start_date, end_date) values('$name', '$desc', '$allowance', '$start_date', '$end_date')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>