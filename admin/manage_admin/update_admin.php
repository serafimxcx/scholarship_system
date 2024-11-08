<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $type = openssl_encrypt($_POST["slct_type"], $method, $key);
    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $contact = openssl_encrypt($_POST["txt_contact"], $method, $key);
    $email = openssl_encrypt($_POST["txt_email"], $method, $key);
    $username = openssl_encrypt($_POST["txt_username"], $method, $key);
    $password = openssl_encrypt($_POST["txt_pass"], $method, $key);

    $query = "update tb_admin set
                admin_type='".$type."',
                name='".$name."',
                contact='".$contact."',
                email='".$email."',
                username='".$username."',
                pass='".$password."'
                where id='".intval($_REQUEST["admin_id"])."'";
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

    echo "";
?>