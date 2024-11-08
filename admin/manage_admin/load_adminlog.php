<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $loadinfo ="";


    $query = "select tb_admin.name as admin_name, tb_adminlog.actn, tb_adminlog.date_time from tb_admin, tb_adminlog where tb_adminlog.admin_id = tb_admin.id order by tb_adminlog.id DESC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $loadinfo = "<table class='table table-bordered table_records'> 
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Activity</th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $name = openssl_decrypt($row["admin_name"], $method, $key);
        $action = openssl_decrypt($row["actn"], $method, $key);
        $date_time = openssl_decrypt($row["date_time"], $method, $key);

        $date_create = date_create($date_time);
        $format_date = date_format($date_create,"F j, Y");
        $format_time = date_format($date_create,"h:i:s A");

        $loadinfo .= "<tr>
                <td>$format_date</td>
                <td>$format_time</td>
                <td>$name has $action.</td>
        </tr>";

    }

    $loadinfo .= "</table>";
    
    echo $loadinfo;
?>