<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $academic_year = $_POST["slct_startyear"]." - ".$_POST["slct_endyear"];

    $academic_year = openssl_encrypt($academic_year, $method, $key);
    $semester = openssl_encrypt($_POST["slct_semester"], $method, $key);
    $start_date = openssl_encrypt($_POST["txt_startdate"], $method, $key);
    $end_date = openssl_encrypt($_POST["txt_enddate"], $method, $key);

    $query = "insert into tb_yearsem(academic_year, semester, start_date, end_date) values('$academic_year', '$semester', '$start_date', '$end_date')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>