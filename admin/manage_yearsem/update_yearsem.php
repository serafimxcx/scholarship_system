<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    
    $academic_year = $_POST["slct_startyear"]." - ".$_POST["slct_endyear"];

    $academic_year = openssl_encrypt($academic_year, $method, $key);
    $semester = openssl_encrypt($_POST["slct_semester"], $method, $key);
    $start_date = openssl_encrypt($_POST["txt_startdate"], $method, $key);
    $end_date = openssl_encrypt($_POST["txt_enddate"], $method, $key);

    $query = "update tb_yearsem set
                academic_year='".$academic_year."',
                semester='".$semester."',
                start_date='".$start_date."',
                end_date='".$end_date."'
                where id='".intval($_REQUEST["yearsem_id"])."'";
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

    echo "";
?>