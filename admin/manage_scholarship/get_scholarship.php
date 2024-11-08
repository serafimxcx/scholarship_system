<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "select * from tb_scholarships where id='".$_REQUEST["scholarship_id"]."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $getinfo = "";

    if ( $row = mysqli_fetch_assoc($result) ) {
        $name = openssl_decrypt($row["name"], $method, $key);
        $description = openssl_decrypt($row["description"], $method, $key);
        $allowance = openssl_decrypt($row["allowance"], $method, $key);
        $start_date = openssl_decrypt($row["start_date"], $method, $key);
        $end_date = openssl_decrypt($row["end_date"], $method, $key);

        $description = str_replace(array("\r\n", "\r", "\n"), '<br>', $description);
        
        $getinfo = '{
                        "name":"'.$name.'",
                        "description":"'.addslashes($description).'",
                        "allowance":"'.$allowance.'",
                        "start_date":"'.$start_date.'",
                        "end_date":"'.$end_date.'"
                        }';
        
    } 



    echo $getinfo;
?>