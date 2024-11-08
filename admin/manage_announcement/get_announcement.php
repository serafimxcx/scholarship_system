<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/scholarship_system/conn.php");

    $query = "select * from tb_announcement where id='".$_REQUEST["announcement_id"]."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    $getinfo = "";

    if ( $row = mysqli_fetch_assoc($result) ) {
        $title = openssl_decrypt($row["title"], $method, $key);
        $body = openssl_decrypt($row["body"], $method, $key);
        
        $body = str_replace(array("\r\n", "\r", "\n"), '<br>', $body);

        $getinfo = '{
                        "title":"'.$title.'",
                        "body":"'.$body.'"
                        }';
        
    } 



    echo $getinfo;
?>