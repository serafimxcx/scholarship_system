<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $desc = openssl_encrypt($_POST["txt_desc"], $method, $key);
    $amount = openssl_encrypt($_POST["txt_amount"], $method, $key);
    $coverage = openssl_encrypt($_POST["slct_coverage"], $method, $key);
    $frequency = openssl_encrypt($_POST["slct_frequency"], $method, $key);
    $ref_no = openssl_encrypt($_POST["txt_refno"], $method, $key);
    $approval_date = openssl_encrypt($_POST["txt_date"], $method, $key);

    $query = "update tb_fees set
                name='".$name."',
                description='".$desc."',
                amount='".$amount."',
                coverage='".$coverage."',
                frequency='".$frequency."',
                ref_no='".$ref_no."',
                approval_date='".$approval_date."'
                where id='".intval($_REQUEST["fee_id"])."'";
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

    echo "";
?>