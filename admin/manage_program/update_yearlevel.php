<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $name = openssl_encrypt($_POST["slct_yearlevel"], $method, $key);
    $fees = openssl_encrypt($_POST["txt_fees"], $method, $key);

    $query = "update tb_yearlevel set
                name='".$name."',
                fees_id='".$fees."'
                where id='".intval($_REQUEST["yearlevel_id"])."'";
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

    echo "";
?>