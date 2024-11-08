<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "select * from tb_yearlevel where id='".$_REQUEST["yearlevel_id"]."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $getinfo = "";

    if ( $row = mysqli_fetch_assoc($result) ) {
        $name = openssl_decrypt($row["name"], $method, $key);
        $fees_id = openssl_decrypt($row["fees_id"], $method, $key);
        $getinfo = '{
                        "name":"'.$name.'",
                        "fees_id":"'.$fees_id.'"
                        }';
        
    } 



    echo $getinfo;
?>