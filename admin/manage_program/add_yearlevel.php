<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $name = openssl_encrypt($_POST["slct_yearlevel"], $method, $key);
    $fees = openssl_encrypt($_POST["txt_fees"], $method, $key);

    $query = "insert into tb_yearlevel(program_id, name, fees_id) values('$_POST[program_id]','$name', '$fees')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>