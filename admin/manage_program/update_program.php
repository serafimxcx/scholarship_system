<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $cost = openssl_encrypt($_POST["txt_cost"], $method, $key);

    $query = "update tb_program set
                name='".$name."',
                cost_per_unit='".$cost."'
                where id='".intval($_REQUEST["program_id"])."'";
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

    echo "";
?>