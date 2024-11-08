<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $allowance = openssl_encrypt($_POST["allowance"], $method, $key);
    $award_number = openssl_encrypt($_POST["award_number"], $method, $key);

    $query = "update tb_approve set
                allowance='".$allowance."',
                award_number='".$award_number."'
                where id='".intval($_REQUEST["approve_id"])."'";
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

    echo "";
?>