<?php
class Tabel
{
    private $table_name;
    private $connection;
    private $delete;
    private $update;

    function __construct($host, $user, $pass, $database, $tabel, $update = "roti.php", $delete = "delete.php")
    {
        $this->connection = new mysqli($host, $user, $pass, $database);
        $this->table_name = $tabel;
        $this->delete = $delete;
        $this->update = $update;
    }

    function executeSql($query)
    {
        $this->connection->query($query);
    }

    function getRow($sql)
    {
        $tabel = $this->connection->query($sql);
        return $tabel->fetch_assoc();
    }

    function showTable()
    {
        $table = $this->connection->query("SELECT * FROM $this->table_name");
        if ($table->num_rows > 0) {
            echo "<table border='1'>\n";
            $associate = $table->fetch_assoc();
            echo "<tr>\n";
            foreach ($associate as $field => $value) {
                echo "<th>" . ucwords($field) . "</th>";
            }
            echo "<th>Option</th></tr>\n";
            $table->data_seek(0);
            while ($row = $table->fetch_assoc()) {
                echo "<tr>\n";
                foreach ($row as $value) {
                    $found = false;
                    $formats = array('.png','.jpg', 'jpeg');
                    foreach ($formats as $format) {
                        if (strpos($value, $format) !== false) {
                            $found = true;
                            break;
                        }
                    }
                    if ($found) {
                        echo "<td style=\"text-align: center;\"><img src='assets/images/{$value}' width='70px'></td>";
                    } else {
                        echo "<td style=\"text-align: center;\">$value</td>";
                    }
                }
                $idRoti = $row["idRoti"];
                echo "<td style='text-align: center;'><form action='roti.php' method='post'>";
                echo "<input type='hidden' name='idRoti' value='$idRoti'>";
                echo "<input style='text-align:center; height: 35px; width: 70px;' type='submit' name='update' value='Update'> ";
                echo " <input style='text-align:center; height: 35px; width: 70px;' type='submit' name='delete' value='Delete'>";
                echo "</form></td></tr>\n";
            }
            echo "</table>";
        } else {
            echo "Tidak ada data roti.";
        }
    }
}
