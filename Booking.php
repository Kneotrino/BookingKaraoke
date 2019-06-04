<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Happy Login</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css">

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password],input[type=number],input[type=date], input[type=time] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
.custom-select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: 100%;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 30%;
  height: 30%;
  float: center;
}

.container {
  padding: 16px;
}

span.psw {
  float: center;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
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
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<center>  
<h3 style="color: #FFF; font-weight: bold; font-size: 20px;"></h3>
<button onclick="document.getElementById('Room').style.display='block'" style="width:auto;">
  Booking Room</button>

<button onclick="document.getElementById('Paket').style.display='block'" style="width:auto;">
  Booking  Paket</button>

<button onclick="document.getElementById('Cari').style.display='block'" style="width:auto;">
  Cari Booking</button>

</center>

<div id="Room" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" method="POST" action="BookingForm.php">
    <div class="container">
      <div class="imgcontainer">
        <img src="images/logo.png" alt="Avatar" class="avatar">
      </div>


      <h1>Membuat Booking Room</h1>
      <p>Silahkan isi form ini untuk booking.</p>
      <hr>
      <label for="email"><b>Nama Sesuai KTP</b></label>
      <input type="text" placeholder="Nama" name="Nama_Booking" value="" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Email" name="Email_Booking" value="" required>

      <label for="email"><b>Nomor HP</b></label>
      <input type="text" placeholder="Nomor HP" name="NoHP_Booking" value="" required>
      
      <label for="email"><b>Room</b><br></label>
      <select name="Room_Booking" class="custom-select" >
        <?php
            DataListRoom();
        ?>
      </select>

      <label for="email"><br><b>Lama Sewa</b> <br> </label>
      <select name="Jam_Booking" class="custom-select">
        <option value="1">1 JAM</option>  
        <option value="2">2 JAM</option>  
        <option value="3">3 JAM</option>  
        <option value="4">4 JAM</option>  
        <option value="5">5 JAM</option>  
        <option value="6">6 JAM</option>  
      </select>

      <label for="email"><br><b>Jam Acara</b><br></label>
      <input type="time" name="Waktu_Booking"  min="10:00" max="24:00" value="15:00" required>

      <label for="email"><br><b>Tanggal Acara</b><br></label>
      <input 
        type="date" 
        name="Tanggal_Booking" 
        min="<?php echo date('Y-m-d');?>"
        max= "<?php echo date('Y-m-d',strtotime("+1 month"));?>"

       value="<?php echo date('Y-m-d');?>" required>


      <p>Dengan booking ini anda setuju sesuai Kebijakan dan Aturan kami <a href="#" style="color:dodgerblue">Kebijakan dan Aturan</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('Room').style.display='none'" class="cancelbtn">Batal</button>
        <button type="submit" class="signupbtn">Booking</button>
      </div>
    </div>
  </form>
</div>

<div id="Paket" class="modal">
  <span onclick="document.getElementById('Paket').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" method="POST" action="BookingFormPaket.php">
    <div class="container">
      <div class="imgcontainer">
        <img src="images/logo.png" alt="Avatar" class="avatar">
      </div>


      <h1>Membuat Booking Paket </h1>
      <p>Silahkan isi form ini untuk booking.</p>
      <hr>
      <label for="email"><b>Nama Sesuai KTP</b></label>
      <input type="text" placeholder="Nama" name="Nama_Booking" value="" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Email" name="Email_Booking" value="" required>

      <label for="email"><b>Nomor HP</b></label>
      <input type="text" placeholder="Nomor HP" name="NoHP_Booking" value="" required>
      
      <label for="email"><b>Room</b><br></label>
      <select name="Room_Booking" class="custom-select" >
        <?php
            DataListPaket();
        ?>
      </select>

      <label for="email"><br><b>Lama Sewa</b> <br> </label>
      <select name="Jam_Booking" class="custom-select">
        <option value="2">2 JAM</option>  
      </select>

      <label for="email"><br><b>Jam Acara</b><br></label>
      <input type="time" name="Waktu_Booking"  min="10:00" max="22:00" value="15:00" required>

      <label for="email"><br><b>Tanggal Acara</b><br></label>
      <input 
        type="date" 
        name="Tanggal_Booking" 
        min="<?php echo date('Y-m-d',strtotime("+1 day"));?>"
        max= "<?php echo date('Y-m-d',strtotime("+1 month"));?>"

      value="<?php echo date('Y-m-d',strtotime("+1 day"));?>" required>


      <p>Dengan booking ini anda setuju sesuai Kebijakan dan Aturan kami <a href="#" style="color:dodgerblue">Kebijakan dan Aturan</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('Paket').style.display='none'" class="cancelbtn">Batal</button>
        <button type="submit" class="signupbtn">Booking</button>
      </div>
    </div>
  </form>
</div>

<div id="Cari" class="modal">
  <span onclick="document.getElementById('Paket').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" method="GET" action="pencarian.php">
    <div class="container">
      <div class="imgcontainer">
        <img src="images/logo.png" alt="Avatar" class="avatar">
      </div>


      <h1>Pencarian Booking </h1>
      <p>Silahkan isi form ini dengan benar</p>
      <hr>

      <label for="email"><b>Email atau NomorHP</b></label>
      <input type="text" placeholder="Email atau NomorHP" name="Cari" value="" required>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('Cari').style.display='none'" class="cancelbtn">Batal</button>
        <button type="submit" class="signupbtn">Cari Booking</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
