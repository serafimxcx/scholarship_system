<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $desc = openssl_encrypt($_POST["txt_desc"], $method, $key);
    $amount = openssl_encrypt($_POST["txt_amount"], $method, $key);
    $coverage = openssl_encrypt($_POST["slct_coverage"], $method, $key);
    $frequency = openssl_encrypt($_POST["slct_frequency"], $method, $key);
    $ref_no = openssl_encrypt($_POST["txt_refno"], $method, $key);
    $approval_date = openssl_encrypt($_POST["txt_date"], $method, $key);

    $query = "insert into tb_fees(name, description, amount, coverage, frequency, ref_no, approval_date) values('$name', '$desc', '$amount', '$coverage', '$frequency', '$ref_no', '$approval_date')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>