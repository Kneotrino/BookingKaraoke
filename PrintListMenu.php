    <?php

    $sql = "SELECT Menu_Category FROM happy.menu WHERE (Menu_Class = 'Makanan') GROUP BY Menu_Category";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          debug_to_console("Menu_Category", $row["Menu_Category"]);
          echo "<h4>".$row["Menu_Category"]."</h4>";
          echo "<table>";

          $queryMenu = "SELECT Menu_Name, Menu_Price FROM happy.menu WHERE (Menu_Category = '".$row["Menu_Category"]."')";
          $Hasil = $conn->query($queryMenu);
          if ($Hasil->num_rows > 0) {
            while ($rowHasil = $Hasil->fetch_assoc()) {
              debug_to_console($row["Menu_Category"],$rowHasil["Menu_Name"]);
              $Nama  = $rowHasil["Menu_Name"];
              $Harga = $rowHasil["Menu_Price"];
              echo "<tr> <td class='product''> $Nama <td class='price'> Rp.$Harga</tr>";
            }
          }
          echo "</table>";

        }
    } else {
      debug_to_console("Data","Null");
    }
    $conn->close();

    ?>
