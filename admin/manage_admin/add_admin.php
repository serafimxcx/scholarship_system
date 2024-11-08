<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $type = openssl_encrypt($_POST["slct_type"], $method, $key);
    $name = openssl_encrypt($_POST["txt_name"], $method, $key);
    $contact = openssl_encrypt($_POST["txt_contact"], $method, $key);
    $email = openssl_encrypt($_POST["txt_email"], $method, $key);
    $username = openssl_encrypt($_POST["txt_username"], $method, $key);
    $password = openssl_encrypt($_POST["txt_pass"], $method, $key);

    $query = "insert into tb_admin(admin_type, name, contact, email, username, pass) values('$type', '$name', '$contact', '$email', '$username', '$password')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "";
?>