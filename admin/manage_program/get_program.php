<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "select * from tb_program where id='".$_REQUEST["program_id"]."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $getinfo = "";

    if ( $row = mysqli_fetch_assoc($result) ) {
        $name = openssl_decrypt($row["name"], $method, $key);
        $cost = openssl_decrypt($row["cost_per_unit"], $method, $key);
        $getinfo = '{
                        "name":"'.$name.'",
                        "cost":"'.$cost.'"
                        }';
        
    } 



    echo $getinfo;
?>