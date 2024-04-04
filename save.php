<?php
include("connection.php");
if ($_POST) {
    $LOCATION = "assets/images/";

    extract($_POST);
    $top = implode(",", $topping);
    $file = $_FILES['gambar'];
    $fileName = $file['name'];
    $fileTempPath = $file['tmp_name'];
    $fileFormat = pathinfo($fileName, PATHINFO_EXTENSION);

    if (is_uploaded_file($fileTempPath)) {
        $newFileName = strtolower(str_replace(' ', '', $namaRoti)) . '.' . $fileFormat;
        move_uploaded_file($fileTempPath, $LOCATION . $newFileName);
        $sql = "INSERT INTO roti (namaRoti, rasaRoti, diameter, tinggi, topping, harga, gambar) VALUES ('$namaRoti','$rasaRoti','$diameter','$tinggi','$top','$harga', '$newFileName')";
        if ($conn->query($sql) === TRUE) {
            header("Location: roti.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
