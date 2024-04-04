<?php
    $conn = new mysqli("localhost","root","","bakery");
    if($conn->connect_error){
        die("Connection Failed!");
    }
?>