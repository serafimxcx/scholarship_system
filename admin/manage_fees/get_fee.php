<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "select * from tb_fees where id='".$_REQUEST["fee_id"]."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $getinfo = "";

    if ( $row = mysqli_fetch_assoc($result) ) {
        $name = openssl_decrypt($row["name"], $method, $key);
        $description = openssl_decrypt($row["description"], $method, $key);
        $amount = openssl_decrypt($row["amount"], $method, $key);
        $coverage = openssl_decrypt($row["coverage"], $method, $key);
        $frequency = openssl_decrypt($row["frequency"], $method, $key);
        $ref_no = openssl_decrypt($row["ref_no"], $method, $key);
        $approval_date = openssl_decrypt($row["approval_date"], $method, $key);
        
        $description = str_replace(array("\r\n", "\r", "\n"), '<br>', $description);

        $getinfo = '{
                        "name":"'.$name.'",
                        "description":"'.addslashes($description).'",
                        "amount":"'.$amount.'",
                        "coverage":"'.$coverage.'",
                        "frequency":"'.$frequency.'",
                        "ref_no":"'.$ref_no.'",
                        "approval_date":"'.$approval_date.'"
                        }';
        
    } 



    echo $getinfo;
?>