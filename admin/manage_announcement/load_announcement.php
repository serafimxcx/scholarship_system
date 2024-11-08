<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $loadinfo ="";

    $n = 1;

    $query = "select * from tb_announcement";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $loadinfo = "<table class='table table-bordered table_records'> 
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th></th>
                    <th></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $title = openssl_decrypt($row["title"], $method, $key);
        $content = openssl_decrypt($row["body"], $method, $key);
        $created_at = openssl_decrypt($row["created_at"], $method, $key);
        $created_at_create = date_create($created_at);
        $format_created_at = date_format($created_at_create,"F j, Y");
        $updated_at = openssl_decrypt($row["updated_at"], $method, $key);
        $updated_at_create = date_create($updated_at);
        $format_updated_at = date_format($updated_at_create,"F j, Y");

        
        $loadinfo .= "<tr>
                <td>$n</td>
                <td>$title</td>
                <td>$format_created_at</td>
                <td>$format_updated_at</td>
                <td><center><button type='button' class='btn btn-default btn_edit' announcement_id='".$row["id"]."'><i class='bi bi-pencil-square'></i></button></center></td>
                <td><center><button type='button' class='btn btn-default btn_del' announcement_id='".$row["id"]."'><i class='bi bi-trash-fill'></i></button></center></td>
        </tr>";

        $n++;
    }

    $loadinfo .= "</table>";
    
    echo $loadinfo;
?>