<?php
require_once("connection.php");
extract($_POST);
$sql = "DELETE FROM roti WHERE idRoti='$idRoti'";
if ($conn->query($sql) === TRUE) {
    header("Location: roti.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
