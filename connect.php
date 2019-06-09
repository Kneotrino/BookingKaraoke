<?php
date_default_timezone_set('Asia/Jayapura');


function debug_to_console( $Tag,$data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( '". $Tag . ": " . $output . "' );</script>";
}

function getPost($value){
  if(isset($_POST[$value])) 
    echo $_POST[$value];
}

function SMS($nomor,$Pesan){
  debug_to_console("SMS nomor",$nomor);
  debug_to_console("SMS pesan",$Pesan);
  echo "$pesan";

  $from     = array('type' => "sms", 'number' => "Nexmo");
  $to       = array('type' => "sms", 'number' => "628113833635");
  $content  = array('type' => "sms", 'text' => $Pesan);
  $data_string = json_encode(array("from" =>$from,"to"=>$to,"message"=>
    array("content" => $content) ));

  // echo "$data_string";
  $url = 'https://api.nexmo.com/v0.1/messages';
  $ch = curl_init($url);
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERPWD, "2fa7eb80:$Rmm0VuE0hP6SRYp1");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  

  $output = curl_exec($ch);
  $info = curl_getinfo($ch);
  curl_close($ch);
}

function getWeekday($date) {
    return date('w', strtotime($date));
}

function PencarianBookingBy($key){
    debug_to_console( "PencarianBookingBy",$key );  

    $sql = "SELECT * FROM boking WHERE 
      (boking_no_hp LIKE '$key' OR boking_email LIKE '$key') 
      AND boking_ket != 'Selesai'
      AND boking_ket != 'Batal'
      ";
    $connMini = 
      new mysqli(
        $GLOBALS['servername'],
        $GLOBALS['username'],
        $GLOBALS['password'],
        $GLOBALS['dbname']);
    $result = $connMini->query($sql);
    if(!$connMini)    {
        die("Query Failed" . mysqli_error($connection));
    }
    return $result;
}

function getBookingByID($id){
    $sql = "SELECT * FROM `boking` WHERE `boking_id` = '$id'";
    $connMini = 
      new mysqli(
        $GLOBALS['servername'],
        $GLOBALS['username'],
        $GLOBALS['password'],
        $GLOBALS['dbname']);
        $result = $connMini->query($sql);

    if(!$connMini)    {
        die("Query Failed" . mysqli_error($connection));
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    return $row;
}

function getRoomByID($id)
{
    $sql = "SELECT *  FROM `room` WHERE `Room_Id` = '$id'";
    $connMini = 
      new mysqli(
        $GLOBALS['servername'],
        $GLOBALS['username'],
        $GLOBALS['password'],
        $GLOBALS['dbname']);
        $result = $connMini->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    return $row;
}

function alertJS($message)
{
      echo "<script type='text/javascript'>alert('$message');</script>";
}

function createEmail($id)  {  
    echo "send email booking<br>";
    $to  = 'kiritoedge@gmail.com' . ', '; // note the comma
    $to .= 'kneotrino@yahoo.com';
    $subject = 'Birthday Reminders for August';
    $message = $my_var = file_get_contents('http://localhost/HappyPuppy/kwintasi.php?id=1');
    // echo "$message";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    // $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
    // $headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
    // $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
    // $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

    // Mail it

    // if (@mail($to, $subject, $message, $headers)) {
    //     echo ("Message successfully sent!");
    // } else {
    //     echo ("Message delivery failed...");
    // }

}

function ShowListMenu($Key){
		debug_to_console("ShowListMenu",$Key);
    $sql = "SELECT Menu_Category FROM happy.menu WHERE (Menu_Class = '$Key') GROUP BY Menu_Category";
		$connMini = 
			new mysqli(
				$GLOBALS['servername'],
				$GLOBALS['username'],
				$GLOBALS['password'],
				$GLOBALS['dbname']);
        $result = $connMini->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              debug_to_console("Menu_Category", $row["Menu_Category"]);
              echo "<h4>".$row["Menu_Category"]."</h4>";
              echo "<table>";

              $queryMenu = "SELECT Menu_Name, Menu_Price FROM happy.menu WHERE (Menu_Category = '".$row["Menu_Category"]."')";
              $Hasil = $connMini->query($queryMenu);
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
        $connMini->close();
}

function DataListRoom(){
        $sql = "SELECT Room_Id, Room_Capasitas, Room_Desc, Room_Img, Room_Name, Room_Price, Room_SpecialPrice FROM happy.room WHERE Room_Class = 'Room' ";
    $connMini = 
      new mysqli(
        $GLOBALS['servername'],
        $GLOBALS['username'],
        $GLOBALS['password'],
        $GLOBALS['dbname']);
        $result = $connMini->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $Room_Desc = $row["Room_Desc"];
              $Room_Id = $row["Room_Id"];
              $Room_Name = $row["Room_Name"];
              $Room_Capasitas = $row["Room_Capasitas"];
              $Room_Price = $row["Room_Price"];
              $Room_SpecialPrice = $row["Room_SpecialPrice"];
            echo "<option value='$Room_Id'>$Room_Name</option>";
            }
        } else {
          debug_to_console("Data","Null");
        }
}

function DataListPaket(){
        $sql = "SELECT Room_Id, Room_Capasitas, Room_Desc, Room_Img, Room_Name, Room_Price, Room_SpecialPrice FROM happy.room WHERE Room_Class = 'Paket' ";
    $connMini = 
      new mysqli(
        $GLOBALS['servername'],
        $GLOBALS['username'],
        $GLOBALS['password'],
        $GLOBALS['dbname']);
        $result = $connMini->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $Room_Desc = $row["Room_Desc"];
              $Room_Id = $row["Room_Id"];
              $Room_Name = $row["Room_Name"];
              $Room_Capasitas = $row["Room_Capasitas"];
              $Room_Price = $row["Room_Price"];
              $Room_SpecialPrice = $row["Room_SpecialPrice"];
            echo "<option value='$Room_Id'>$Room_Name</option>";
            }
        } else {
          debug_to_console("Data","Null");
        }
}


function ShowListRoom(){
		debug_to_console("ShowListMenu","Room Query");
        $sql = "SELECT * FROM happy.room";
		$connMini = 
			new mysqli(
				$GLOBALS['servername'],
				$GLOBALS['username'],
				$GLOBALS['password'],
				$GLOBALS['dbname']);
        $result = $connMini->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              debug_to_console("Rooms", $row["Room_Name"]);
              $Room_Name = $row["Room_Name"];
              $Room_Desc = $row["Room_Desc"];
              $Room_Capasitas = $row["Room_Capasitas"];
              $Room_Price = $row["Room_Price"];
              $Room_SpecialPrice = $row["Room_SpecialPrice"];
              $Room_Img = $row["Room_Img"];
              $Room_MBL = $row["Room_Business_Price"];

              echo "<div>";
              echo "<h5>ROOM </h5>";
              echo "<h6>$Room_Name</h6>";
              echo "<a><img src='admin/$Room_Img' alt='' height='300'></a>";
              echo "<p>Kapasitas : $Room_Capasitas Pax";
              echo "<p>$Room_Desc<p>";
              echo "Harga Normal: Rp. ". number_format($Room_Price)  . "<p>";
              echo "Harga Special: Rp. ". number_format($Room_SpecialPrice)  . " <p>";
              echo "Harga MBL: Rp. ". number_format($Room_MBL)  . "";
              echo "</div>";

            }
        } else {
          debug_to_console("Data","Null");
        }
        $connMini->close();
}

function ShowListEvent(){
    debug_to_console("ShowListEvent","Event Query");
    $sql = "SELECT * FROM happy.event";
    $connMini = 
      new mysqli(
        $GLOBALS['servername'],
        $GLOBALS['username'],
        $GLOBALS['password'],
        $GLOBALS['dbname']);
        $result = $connMini->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              // debug_to_console("Event", $row["Event_Name"]);
              $Event_Name  = $row["Event_Name"];
              $Event_img    = $row["Event_img"];
              $Event_Desc   = $row["Event_Desc"];
              echo "<div>";
              echo "<h3>$Event_Name</h3>";
              echo "<a><img src='admin/$Event_img' alt='' height='200' width = '400'></a>";
              echo "<h5>$Event_Desc</h5>";
              echo "</div>";
            }
        } else {
          debug_to_console("Data","Null");
        }
        $connMini->close();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "happy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	debug_to_console( "Connection","Connected failed" );
    die("Connection failed: " . $conn->connect_error);
} 


// $conn->close();
debug_to_console( "Connection","Connected successfully" );

?>