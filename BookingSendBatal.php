<?php
	include './connect.php';	
    foreach ($_POST as $key => $value) {
        debug_to_console($key,$value);
    }

    $Batal_ID    = $_POST["ID_Booking"];
    $Batal_Email = $_POST["Email_Booking"];
    $Batal_HP = $_POST["NoHP_Booking"];

    $sql = "UPDATE boking 
    SET boking_ket= 'Batal' 
    WHERE ((boking.boking_id = $Batal_ID AND boking.boking_email = '$Batal_Email') AND boking.boking_no_hp = '$Batal_HP')";    

    $update = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if(mysqli_affected_rows($conn) > 0 ){
        echo "<script type='text/javascript'>alert('Berhasil Batal'); window.location= 'index.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Gagal Batal'); window.history.back();</script>";
    }

?>