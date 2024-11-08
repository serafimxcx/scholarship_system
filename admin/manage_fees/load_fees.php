<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    date_default_timezone_set('Asia/Manila');
    $dateNow = date("Y-m-d");

    $loadinfo ="";

    $n = 1;

    $query = "select * from tb_fees order by id ASC";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $loadinfo = "<table class='table table-bordered table_records'> 
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Coverage</th>
                    <th>Frequency per AY</th>
                    <th>Reference/BOT Resolution No</th>
                    <th>Date of Approval of BOT Resolution</th>
                    <th></th>
                    <th></th>
                    </tr>";

    while($row = mysqli_fetch_assoc($result)){
        $name = openssl_decrypt($row["name"], $method, $key);
        $description = openssl_decrypt($row["description"], $method, $key);
        $amount = openssl_decrypt($row["amount"], $method, $key);
        $coverage = openssl_decrypt($row["coverage"], $method, $key);
        $frequency = openssl_decrypt($row["frequency"], $method, $key);
        $ref_no = openssl_decrypt($row["ref_no"], $method, $key);
        $approval_date = openssl_decrypt($row["approval_date"], $method, $key);

        $approvaldate_create = date_create($approval_date);
        $format_approvaldate = date_format($approvaldate_create,"F j, Y");

        $amount_double = (double)$amount;
        $amount_formatted = number_format($amount_double, 2, '.', ',');

        
        $loadinfo .= "<tr>
                <td>$n</td>
                <td>$name</td>
                <td>Php $amount_formatted</td>
                <td>$coverage</td>
                <td>$frequency</td>
                <td>$ref_no</td>
                <td>$format_approvaldate</td>
                <td><center><button type='button' class='btn btn-default btn_edit' fee_id='".$row["id"]."'><i class='bi bi-pencil-square'></i></button></center></td>
                <td><center><button type='button' class='btn btn-default btn_del' fee_id='".$row["id"]."'><i class='bi bi-trash-fill'></i></button></center></td>
        </tr>";

        $n++;
    }

    $loadinfo .= "</table>";
    
    echo $loadinfo;
?>