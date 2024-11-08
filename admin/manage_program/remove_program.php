<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "delete from tb_program
			where id=".intval($_REQUEST["program_id"]);
    
    mysqli_query($conn,$query) or die(mysqli_error($conn)."<br>".$query);

echo "";
?>