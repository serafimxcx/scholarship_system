<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    $loadinfo ="";

    $n = 1;

    $query = "select * from tb_scholarships order by id DESC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $loadinfo = "<table class='table table-bordered table_records'> 
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Allowance Per Student</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $name = openssl_decrypt($row["name"], $method, $key);
        $description = openssl_decrypt($row["description"], $method, $key);
        $allowance = openssl_decrypt($row["allowance"], $method, $key);
        $start_date = openssl_decrypt($row["start_date"], $method, $key);
        $end_date = openssl_decrypt($row["end_date"], $method, $key);

        $startdate_create = date_create($start_date);
        $format_startdate = date_format($startdate_create,"F j, Y");

        $enddate_create = date_create($end_date);
        $format_enddate = date_format($enddate_create,"F j, Y");

        $allowance_double = (double)$allowance;
        $allowance_formatted = number_format($allowance_double, 2, '.', ',');

        $loadinfo .= "<tr>
                <td>$n</td>
                <td>$name</td>
                <td>Php $allowance_formatted</td>
                <td>$format_startdate</td>
                <td>$format_enddate</td>
                <td>";

                if($dateNow < $start_date){
                    $loadinfo .= "Not yet started";
                }else if($dateNow > $end_date){
                    $loadinfo .= "Finished";
                }else{
                    $loadinfo .= "Ongoing";
                }
                
        $loadinfo .="</td>
                <td><center><button type='button' class='btn btn-default btn_edit' scholarship_id='".$row["id"]."'><i class='bi bi-pencil-square'></i></button></center></td>
                <td><center><button type='button' class='btn btn-default btn_del' scholarship_id='".$row["id"]."'><i class='bi bi-trash-fill'></i></button></center></td>
        </tr>";

        $n++;
    }

    $loadinfo .= "</table>";
    
    echo $loadinfo;
?>