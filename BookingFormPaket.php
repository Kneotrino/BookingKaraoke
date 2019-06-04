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
  display: block; /* Hidden by default */
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
            include './connect.php';
            foreach ($_POST as $key => $value) {
                debug_to_console($key,$value);
            }
            $RoomID = $_POST['Room_Booking']; 
            $RoomHr = $_POST['Jam_Booking']; 
            $RoomRow = getRoomByID($RoomID);
            $Room_Name = $RoomRow["Room_Name"];
            $Room_Price = $RoomRow["Room_Price"];
            // echo "$RoomRow["Room_Price"]";          
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

<div id="id02" class="modal">
  <form class="modal-content" method="GET" action="BookingSendPaket.php">
    <div class="container">
      <div class="imgcontainer">
        <img src="images/logo.png" alt="Avatar" class="avatar">
      </div>


      <h1>Confirmasi Booking</h1>
      <p>Silahkan pastikan form ini untuk booking.</p>
      <hr>
      <input type="Hidden" name="Nama_Booking" 
      value="<?php getPost('Nama_Booking') ?>" readonly>


      <label for="email"><b>Nama</b></label>
      <input type="text" placeholder="Nama" name="Nama_Booking" 
      value="<?php getPost('Nama_Booking') ?>" readonly>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Email" name="Email_Booking" 
      value="<?php getPost('Email_Booking') ?>" readonly>

      <label for="email"><b>Nomor HP</b></label>
      <input type="text" placeholder="Nomor HP" name="NoHP_Booking" 
      value="<?php getPost('NoHP_Booking') ?>" readonly>
      
      <label for="email"><b>Room</b><br></label>
      <select name="Room_Booking" class="custom-select" readonly >
          <option value="<?php getPost('Room_Booking') ?>" selected="selected"> 
          <?php
            echo "$Room_Name";
          ?> </option>          
      </select>

      <label for="email"><b>Room/Jam</b><br></label>
      <input type="text" placeholder="Nomor HP" name="" 
      value="<?php 
      echo "Rp. ".number_format($Room_Price);
      ?>" readonly>

      <input type="Hidden" placeholder="Nomor HP" name="PerJam_Booking" 
      value="<?php 
      echo ($Room_Price);
      ?>" readonly>


      <label for="email"><br><b>Lama Sewa</b> <br> </label>
      <select name="Jam_Booking" class="custom-select" readonly>
        <option value="<?php getPost('Jam_Booking') ?>" selected="selected"> 
          <?php getPost('Jam_Booking') ?> JAM</option>  
      </select>

      <label for="email"><b>Total</b><br></label>
      <input type="text" placeholder="Nomor HP" name="" 
      value="<?php 
           $Total = $Room_Price;
            echo "Rp. ".number_format($Total);
      ?>" readonly>

      <label for="email"><b>Minimal DP</b><br></label>
      <input type="text" placeholder="Nomor HP" name="" 
      value="<?php 
           $DP_Booking = $Total / 2;
            echo "Rp. ".number_format($DP_Booking);
      ?>" readonly>


      <label for="email"><br><b>Jam Acara</b><br></label>
      <input type="time" name="Waktu_Booking"  min="10:00" max="22:00" 
        value="<?php getPost('Waktu_Booking') ?>" readonly >

      <label for="email"><br><b>Waktu</b><br></label>
      <input type="date" name="Tanggal_Booking" data-date-format="DD MM YYYY"
        value="<?php getPost('Tanggal_Booking') ?>" readonly>

      <p>Dengan booking ini anda setuju sesuai Kebijakan dan Aturan kami <a href="#" style="color:dodgerblue">Kebijakan dan Aturan</a>.</p>
      <div class="clearfix">
        <input type="button" value="Batal" class="cancelbtn" id="btnHome" 
          onClick="window.location = 'Booking.php'" />
        <button type="submit" class="signupbtn">Konfirmasi</button>
      </div>
    </div>
  </form>
</div>


</body>
</html>
