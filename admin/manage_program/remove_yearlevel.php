<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "delete from tb_yearlevel
			where id=".intval($_REQUEST["yearlevel_id"]);
    
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";
?>