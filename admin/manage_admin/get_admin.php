<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "select * from tb_admin where id='".$_REQUEST["admin_id"]."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $getinfo = "";

    if ( $row = mysqli_fetch_assoc($result) ) {
        $type = openssl_decrypt($row["admin_type"], $method, $key);
        $name = openssl_decrypt($row["name"], $method, $key);
        $username = openssl_decrypt($row["username"], $method, $key);
        $contact = openssl_decrypt($row["contact"], $method, $key);
        $email = openssl_decrypt($row["email"], $method, $key);
        $password = openssl_decrypt($row["pass"], $method, $key);
        
        $getinfo = '{
                        "type":"'.$type.'",
                        "name":"'.$name.'",
                        "username":"'.$username.'",
                        "contact":"'.$contact.'",
                        "email":"'.$email.'",
                        "password":"'.$password.'"
                        }';
        
    } 



    echo $getinfo;
?>