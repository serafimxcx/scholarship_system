<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");
    include_once("../navbar.php");
    session_start();

    $loadinfo = "";

    $result = $conn->query("select * from tb_yearlevel where program_id='$_POST[program_id]'");

    while($row=$result->fetch_assoc()){
        $loadinfo .= "<option value='$row[id]' ";
                        if($row["id"] == $yearlevel_id){
                            $loadinfo .= "selected";
                        }
        $loadinfo .= ">".openssl_decrypt($row["name"], $method, $key)."</option>";
    }

    echo $loadinfo;

?>