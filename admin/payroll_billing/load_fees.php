<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    $loadinfo ="";

    $n = 1;

    $query = "select * from tb_fees ";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $loadinfo .= "<option value='Tuition Fee'>Tuition Fee</option>";
    while($row = mysqli_fetch_assoc($result)){
        $name = openssl_decrypt($row["name"], $method, $key);


        $loadinfo .= "<option value='$row[id]'>$name</option>";

        $n++;
    }

    
    echo $loadinfo;
?>