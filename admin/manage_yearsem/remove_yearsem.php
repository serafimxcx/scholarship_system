<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "delete from tb_yearsem
			where id=".intval($_REQUEST["yearsem_id"]);
    
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";
?>