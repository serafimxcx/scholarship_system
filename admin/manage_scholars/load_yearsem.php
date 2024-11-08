<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    $loadinfo ="";

    $n = 1;

    $query = "select * from tb_yearsem order by id DESC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($result)){
        $academic_year = openssl_decrypt($row["academic_year"], $method, $key);
        $semester = openssl_decrypt($row["semester"], $method, $key);
        $start_date = openssl_decrypt($row["start_date"], $method, $key);
        $end_date = openssl_decrypt($row["end_date"], $method, $key);

        $startdate_create = date_create($start_date);
        $format_startdate = date_format($startdate_create,"F j, Y");

        $enddate_create = date_create($end_date);
        $format_enddate = date_format($enddate_create,"F j, Y");


        $loadinfo .= "<option value='$row[id]'>$academic_year $semester</option>";

        $n++;
    }

    
    echo $loadinfo;
?>