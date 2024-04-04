<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogjakartans Bakery</title>
    <link rel="stylesheet" href="assets/styles/style.css" />
</head>

<body>
    <header>
        <div class="jumbotron">
            <h1>Jogjakartans Bakery</h1>
            <p>
                Toko roti yang sudah berdiri sejak 9999 dan memiliki cita rasa yang tak tertandingi super duper cihuy.
            </p>
        </div>
        <nav>
            <ul>
                <li>
                    <a href="index.html" style="font-weight: bolder;  text-decoration: underline;">Home</a>
                </li>
                <li>
                    <a href="roti.php">Roti</a>
                </li>
            </ul>
        </nav>
    </header>
    <main style="display: inline;">
        <?php
        require_once("connection.php");
        $table = $conn->query("SELECT * FROM roti");
        if ($table->num_rows > 0) {
            echo "<div class=\"menu-container\">";
            while ($row = $table->fetch_assoc()) {
                echo "<div class=\"menu-card\">";
                echo "<img src=\"assets/images/{$row['gambar']}\" alt=\"Food\">";
                echo "<div class=\"content\">";
                echo "<h2>{$row['namaRoti']}</h2>";
                echo "<p>{$row['rasaRoti']}</p>";
                echo "<p>Diameter: {$row['diameter']} | Tinggi: {$row['tinggi']}</p>";
                echo "<p>{$row['topping']}</p>";
                echo "<p class=\"price\">Rp. {$row['harga']}</p>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>"; // Close the menu-container

        } else {
            echo "Tidak ada data roti.";
        }
        ?>
    </main>
    <footer>
      <p>UJIAN TENGAH SEMESTER Pemrograman Web &#169; 2024, Patrik Kurniawan Saputra - 72220533 </p>
    </footer>
</body>

</html>