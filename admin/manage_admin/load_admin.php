<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");


    $loadinfo ="";

    $n = 1;

    $query = "select * from tb_admin";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $loadinfo = "<table class='table table-bordered table_records'> 
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $type = openssl_decrypt($row["admin_type"], $method, $key);
        $name = openssl_decrypt($row["name"], $method, $key);
        $username = openssl_decrypt($row["username"], $method, $key);
        $contact = openssl_decrypt($row["contact"], $method, $key);
        $email = openssl_decrypt($row["email"], $method, $key);

        $loadinfo .= "<tr>
                <td>$n</td>
                <td>$type</td>
                <td>$name</td>
                <td>$username</td>
                <td>$contact</td>
                <td>$email</td>
                <td><center><button type='button' class='btn btn-default btn_edit' admin_id='".$row["id"]."'><i class='bi bi-pencil-square'></i></button></center></td>
                            <td><center><button type='button' class='btn btn-default btn_del' admin_id='".$row["id"]."'><i class='bi bi-trash-fill'></i></button></center></td>
        </tr>";

        $n++;
    }

    $loadinfo .= "</table>";
    
    echo $loadinfo;
?>