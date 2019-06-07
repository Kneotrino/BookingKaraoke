<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pembayaran</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
table {
  border-collapse: collapse;
  width: 60%;
}
td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  /* background-color: #dddddd; */
}
h2,h3,p {
    color: white;
}
img {
    max-height: 300px;
    max-width: 300px;

}

</style>
</head>

<body>
<div id="header"> <a href="index.php" id="logo"><img src="images/logo.png" alt=""></a>
        <?php
            include './navigation-top.php';
            include './connect.php';
        ?>        
</div>
<center>
<div class="center">
    
                <h2 style="color:white;">Pembayaran melalui ATM</h2>
                <h3 style="color:white;">ke Admin HAPPY PUPPY Efendi Fernandes 3140835683, kode BCA[014]</h3>
            </div>
<table>
  <tr>
    <td>
        <div class="step-box">
            <img src="images\bayar\step-1.jpg?ext=.jpg" alt="Langkah 1">
            <h3>Langkah 1.</h3>
            <p>Pilih menu&nbsp;<strong>TRANSFER</strong></p>
        </div>
    </td>
    <td>
    <div class="step-box">
                                    <img src="images\bayar\step-2.jpg?ext=.jpg" alt="Langkah 2">
                                    <h3>Langkah 2.</h3>
                                    <p>Pilih menu&nbsp;<strong>DARI REKENING TABUNGAN</strong></p>
                                </div>

    </td>
    <td>
    <div class="step-box">
                                    <img src="images\bayar\step-3.jpg?ext=.jpg" alt="Langkah 3">
                                    <h3>Langkah 3.</h3>
                                    <p>Pilih tujuan transfer ke&nbsp;<strong>KE REKENING BCA</strong> Kode bank BCA [014]</p>
                                </div>

    </td>
  </tr>
  <tr>
    <td>
    <div class="step-box">
                                    <img src="images\bayar\step-4.jpg?ext=.jpg" alt="Langkah 4">
                                    <h3>Langkah 4.</h3>
                                    <p>Masukkan nomor rekening tujuan, pilih BENAR</p>
                                </div>

    </td>
    <td>
    <div class="step-box">
                                    <img src="images\bayar\step-5.jpg?ext=.jpg" alt="Langkah 5">
                                    <h3>Langkah 5.</h3>
                                    <p>Masukkan jumlah pembayaran sesuai jumlah yang ingin di depositkan, pilih&nbsp;<strong>BENAR</strong></p>
                                </div>

    </td>
    <td>
    <div class="step-box">
                                    <img src="images\bayar\step-6.jpg?ext=.jpg" alt="Langkah 6">
                                    <h3>Langkah 6.</h3>
                                    <p>Muncul halaman konfirmasi, silahkan pastikan tujuan dan jumlah pembayaran dan pilih&nbsp;<strong>YA</strong></p>
                                </div>

    </td>
  </tr>
</table>
</center>
</body>
<div id="footer">
        <?php
            include './footer.php';
        ?>    
</div>
</html>
