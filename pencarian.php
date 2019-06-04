<!DOCTYPE html>
<html>
<head>
<title>Perncarian</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #fff;
}
tr:nth-child(odd) {
  background-color: #aaa;
}

</style>
</head>
<body>
<div id="header">
        <?php
            include './navigation-all.php';
            include './connect.php';    
            $boking_Cari = $_GET["Cari"];   
            if (isset($_GET["Cari"]))   {
              $booking = PencarianBookingBy($boking_Cari);
            }
            else {
              header("Location: http://localhost/HappyPuppy");
              die();                                        
            }            
        ?>
        
</div>
  <div id="body">
    <table>
    <tr>
      <th>Nama</th>
      <th>Email</th>
      <th>No HP</th>
      <th>Keterangan</th>
      <th>Upload Boking</th>
    </tr>

    <?php 
      while($row = $booking->fetch_assoc()) {
          $boking_email = "$row[boking_email] <br>";
          $boking_no_hp = "$row[boking_no_hp] <br>";
          $boking_kode = "$row[boking_id]";
          echo "<tr>";
          echo "<td>$row[boking_nama]</td>";
          echo "<td>".substr_replace($boking_email,"******",0,5)."</td>";
          echo "<td>".substr_replace($boking_no_hp,"******",0,5)."</td>";
          echo "<td>$row[boking_ket]</td>";
          echo "<td><a href='kwintasi.php?id=$boking_kode'> Upload Boking</td>";
          echo "<tr>";
      }
     ?>
  </table>

  </div>
<div id="footer">
        <?php
            include './footer.php';
        ?>
    
</div>
</body>
</html>