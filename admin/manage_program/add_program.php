<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $cost = openssl_encrypt($_POST["txt_cost"], $method, $key);

    $query = "insert into tb_program(name, cost_per_unit) values('$name', '$cost')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>