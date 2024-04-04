<?php
require_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $LOCATION = "assets/images/";
    extract($_POST);
    $top = implode(",", $topping);
    $file = $_FILES['gambar'];
    $fileName = $file['name'];
    $fileTempPath = $file['tmp_name'];
    $fileFormat = pathinfo($fileName, PATHINFO_EXTENSION);
    echo "$fileTempPath";
    if (is_uploaded_file($fileTempPath)) {
        $newFileName = strtolower(str_replace(' ', '', $namaRoti)) . '.' . $fileFormat;
        move_uploaded_file($fileTempPath, $LOCATION . $newFileName);
        $sql = "UPDATE roti SET namaRoti='$namaRoti', rasaRoti='$rasaRoti', diameter='$diameter', tinggi='$tinggi', topping='$top', harga='$harga', gambar='$newFileName' WHERE idRoti='$idRoti'";
    } else {
        $sql = $sql = "UPDATE roti SET namaRoti='$namaRoti', rasaRoti='$rasaRoti', diameter='$diameter', tinggi='$tinggi', topping='$top', harga='$harga' WHERE idRoti='$idRoti'";
    }
}
if ($conn->query($sql) === TRUE) {
    header("Location: roti.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
