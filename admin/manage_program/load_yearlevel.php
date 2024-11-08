<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

$loadinfo = "";

if(isset($_POST["program_id"])){
    $n = 1;

    $query = "SELECT * FROM tb_yearlevel WHERE program_id='$_POST[program_id]'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $loadinfo = "<table class='table table-bordered table_records'> 
                <tr>
                    <th>Name</th>
                    <th>School Fees</th>
                    <th></th>
                    <th></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $name = openssl_decrypt($row["name"], $method, $key);
        $fees_id = openssl_decrypt($row["fees_id"], $method, $key);

        // Debugging output
        error_log("Decrypted name: $name");
        error_log("Decrypted fees_id: $fees_id");

        $fees = explode(",", $fees_id);

        $loadinfo .= "<tr>
                <td>$name</td>
                <td>";

        foreach($fees as $fee_id){
            $feeResult = $conn->query("SELECT * FROM tb_fees WHERE id='$fee_id'") or die(mysqli_error($conn));

            while($rowfee = $feeResult->fetch_assoc()){
                $fee_name = openssl_decrypt($rowfee["name"], $method, $key);
                $loadinfo .= " - " . $fee_name . "<br>";

                // Debugging output
                error_log("Fee ID: $fee_id, Fee Name: $fee_name");
            }
        }

        $loadinfo .= "</td>
                <td><center><button type='button' class='btn btn-default btn_edityr' yearlevel_id='".$row["id"]."'><i class='bi bi-pencil-square'></i></button></center></td>
                <td><center><button type='button' class='btn btn-default btn_delyr' yearlevel_id='".$row["id"]."'><i class='bi bi-trash-fill'></i></button></center></td>
        </tr>";

        $n++;
    }

    $loadinfo .= "</table>";
}

echo $loadinfo;
?>
