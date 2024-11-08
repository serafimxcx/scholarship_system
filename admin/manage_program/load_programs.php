<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $loadinfo ="";

    $n = 1;

    $query = "select * from tb_program";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $loadinfo = "<table class='table table-bordered table_records'> 
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Cost Per Unit</th>
                    <th>Year Level</th>
                    <th></th>
                    <th></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $name = openssl_decrypt($row["name"], $method, $key);
        $cost = openssl_decrypt($row["cost_per_unit"], $method, $key);


        
        $loadinfo .= "<tr>
                <td>$n</td>
                <td>$name</td>
                <td>Php $cost</td>
                <td><center><button type='button' class='btn btn-default btn_yearlevel' program_id='".$row["id"]."'><i class='bi bi-plus-lg'></i>&nbsp; Add Year Level</button></center></td>
                <td><center><button type='button' class='btn btn-default btn_edit' program_id='".$row["id"]."'><i class='bi bi-pencil-square'></i></button></center></td>
                <td><center><button type='button' class='btn btn-default btn_del' program_id='".$row["id"]."'><i class='bi bi-trash-fill'></i></button></center></td>
        </tr>";

        $n++;
    }

    $loadinfo .= "</table>";
    
    echo $loadinfo;
?>