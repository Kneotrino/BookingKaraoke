        
<!DOCTYPE html>
<html>
<head>
	<title>Create Booking</title>
</head>
<body>
	
        <?php
            include './connect.php';

            foreach ($_GET as $key => $value) {
                debug_to_console($key,$value);
            }
            $harga = $_GET['PerJam_Booking'];
            $total = $harga * $_GET['Jam_Booking']; 
            $deposit = $total / 2;


            $sqlBoking = "
                INSERT INTO boking (
                 boking_nama, 
                 boking_email, 
                 boking_no_hp, 
                 boking_room_id, 
                 boking_Harga, 
                 boking_jumlah_jam, 
                 boking_waktu, 
                 boking_tanggal, 
                 boking_ket,
                 boking_total,
                 boking_deposit
                 ) 
                VALUES 
                ('".$_GET['Nama_Booking']."',
                 '".$_GET['Email_Booking']."', 
                 '".$_GET['NoHP_Booking']."', 
                 '".$_GET['Room_Booking']."', 
                 '".$_GET['PerJam_Booking']."', 
                 '".$_GET['Jam_Booking']."', 
                 '".$_GET['Waktu_Booking']."', 
                 '".$_GET['Tanggal_Booking']."', 
                 'Belum Lunas',
                 '$total',
                 '$deposit'
                 );
            ";
            // echo "$sqlBoking";
            // echo 'getPost('Nama_Boking')';
            // echo 'Hello ' . htmlspecialchars($_GET["Nama_Boking"]) . '!';            
            // if (isset($_GET['Nama_Booking'])) {
                
            //     echo $_GET['Nama_Booking'];
            // } else {
            // }
            // echo "$sqlBoking";
            // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
            // VALUES ('John', 'Doe', 'john@example.com')";

            // if (mysqli_query($conn, $sqlBoking)) {
            //     echo "New record created successfully";
            // } else {
            //     // echo "Error: " . $sqlBoking . "<br>" . mysqli_error($conn);
            // }            

            
            if ($conn->query($sqlBoking) === TRUE) {
                $last_id = $conn->insert_id;
                echo "<script type='text/javascript'>alert('Berhasil Booking');</script>";
                echo "http://localhost/HappyPuppy/kwintasi.php?id=". $last_id;
                $pesan = "Selamat ".$_GET['Nama_Booking'].
                    " Berhasil boking HappyPuppy TGL :".$_GET['Tanggal_Booking'].
                    "Jam".$_GET['Waktu_Booking'];
                // SMS("628113833635",$pesan);
                header("Location: http://localhost/HappyPuppy/kwintasi.php?id=" . $last_id);
                // die();  
                // echo "New record created successfully. Last inserted ID is: " . $last_id;
            } else {
                // echo "$sqlBoking";
                echo "<script type='text/javascript'>alert('Gagal Booking');</script>";
                // header("Location: http://localhost/HappyPuppy/booking.php");
                // echo "Error: " . $sqlBoking . "<br>" . $conn->error;
            }
        ?>


</body>
</html>
