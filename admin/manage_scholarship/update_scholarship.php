<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $desc = openssl_encrypt($_POST["txt_desc"], $method, $key);
    $allowance = openssl_encrypt($_POST["txt_allowance"], $method, $key);
    $start_date = openssl_encrypt($_POST["txt_startdate"], $method, $key);
    $end_date = openssl_encrypt($_POST["txt_enddate"], $method, $key);

    $query = "update tb_scholarships set
                name='".$name."',
                description='".$desc."',
                allowance='".$allowance."',
                start_date='".$start_date."',
                end_date='".$end_date."'
                where id='".intval($_REQUEST["scholarship_id"])."'";
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

    echo "";
?>