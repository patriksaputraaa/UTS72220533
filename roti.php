<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roti Jog's Bakery</title>
  <link rel="stylesheet" href="assets/styles/style.css" />
</head>

<body>
  <header>
    <div class="jumbotron">
      <h1>Jogjakartans Bakery</h1>
      <p>
        Toko roti yang sudah berdiri sejak 6666 dan memiliki cita rasa yang tak tertandingi super duper cihuy.
      </p>
    </div>
    <nav>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="roti.php" style="font-weight: bolder;  text-decoration: underline;">Roti</a>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="container">
      <div class="top-section">
        <?php
        include("connection.php");
        $judul = "Tambah Roti";
        if (isset($_POST["delete"])) {
          $judul = "Tambah Roti";
          extract($_POST);
          $sql = "DELETE FROM roti WHERE idRoti='$idRoti'";
          if ($conn->query($sql) === TRUE) {
            header("Location: roti.php");
            exit;
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        if (isset($_POST["update"])) {
          $judul = "Edit Roti";
        }
        ?>
        <h2><?= $judul ?></h2>
        <?php
        if (isset($_POST["update"])) {
          require_once("form.php");
          require_once("tabel.php");
          $id = $_POST["idRoti"];
          $idRoti = $id;

          $sql = "SELECT * FROM roti WHERE idRoti='$id'";
          $roti = new Tabel("localhost", "root", "", "bakery", "roti");
          $old_data = $roti->getRow($sql);
          if ($old_data !== null) {
            extract($old_data);
            $form = new Form("update.php", "");
            $form->addTextBox("idRoti", 20, $idRoti, false);
            $form->addTextBox("namaRoti", 50, $namaRoti);
            $form->addComboBox("rasaRoti", ["Vanilla", "Coklat", "Strawberry", "Matcha", "Cheese"], $rasaRoti);
            $form->addRadioButton("diameter", ["10cm", "15cm", "20cm", "25cm"], $diameter);
            $form->addNumberSpinner("tinggi", $tinggi);
            $form->addCheckBox("topping", ["Lilin", "Kartu Ucapan", "Bunga", "Sparkle"], $topping);
            $form->addTextBox("harga", 30, $harga);
            $form->addImage("recent image", $gambar);
            $form->addFile("gambar", $gambar);
            $form->show();
          } else {
            echo "No data found for the given id.";
          }
        } else {
          require_once("form.php");
          $form = new Form("save.php", "");
          $form->addTextBox("namaRoti", 40);
          $form->addComboBox("rasaRoti", ["Vanilla", "Coklat", "Strawberry", "Matcha", "Cheese"], "Vanilla");
          $form->addRadioButton("diameter", ["10cm", "15cm", "20cm", "25cm"], "10cm");
          $form->addNumberSpinner("tinggi", "1");
          $form->addCheckBox("topping", ["Lilin", "Kartu Ucapan", "Bunga", "Sparkle"], "");
          $form->addTextBox("harga", 30);
          $form->addFile("gambar");
          $form->show();
        }

        ?>
      </div>
      <div class="bottom-section">
        <h2>List Roti</h2>
        <?php
        require_once("tabel.php");
        $roti = new Tabel("localhost", "root", "", "bakery", "roti");
        $roti->showTable();
        ?>
      </div>
    </div>

  </main>
</body>

</html>