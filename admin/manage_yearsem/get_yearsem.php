<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "select * from tb_yearsem where id='".$_REQUEST["yearsem_id"]."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $getinfo = "";

    if ( $row = mysqli_fetch_assoc($result) ) {
        $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
        $a_year = explode("-", $academic_year);
        $start_year = trim($a_year[0]);
        $end_year = trim($a_year[1]);
        $semester = openssl_decrypt($row["semester"], $method, $key);
        $start_date = openssl_decrypt($row["start_date"], $method, $key);
        $end_date = openssl_decrypt($row["end_date"], $method, $key);

        
        $getinfo = '{
                        "start_year":"'.$start_year.'",
                        "end_year":"'.$end_year.'",
                        "semester":"'.$semester.'",
                        "start_date":"'.$start_date.'",
                        "end_date":"'.$end_date.'"
                        }';
        
    } 



    echo $getinfo;
?>