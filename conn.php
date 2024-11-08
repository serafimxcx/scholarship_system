<?php
    $conn = new mysqli("localhost", "root", "","scholarship_db");
    

    $hexKey = "a3f5d4e6b1c2d3e4f5a6b7c8d9e0f1a2";
    $key = hex2bin($hexKey);

    $method = "AES-128-ECB"; 
?>