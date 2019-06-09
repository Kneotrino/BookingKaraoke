<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwintasi Booking Happy Puppy</title>    
    <style>

    @media print
    {
    body * { visibility: hidden; }
    .invoice-box * { visibility: visible; }
    }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(1) {
        text-align: center;
    }
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

    .btn {
  border: none;
  background-color: inherit;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  display: inline-block;
}

/* Green */
.success {
  color: green;
}

.success:hover {
  background-color: #4CAF50;
  color: white;
}

/* Blue */
.info {
  color: dodgerblue;
}

.info:hover {
  background: #2196F3;
  color: white;
}

/* Orange */
.warning {
  color: orange;
}

.warning:hover {
  background: #ff9800;
  color: white;
}

/* Red */
.danger {
  color: red;
}

.danger:hover {
  background: #f44336;
  color: white;
}

/* Gray */
.default {
  color: black;
}

.default:hover {
  background: #e7e7e7;
}
    </style>
</head>

<body>
        <script>
        function printDiv(divName) {
             window.print();
        }
        </script>
<table style="width:100%">
        <?php
            include './connect.php';    
            $boking_id = $_GET["id"];   
        ?>

  <tr>
    <th>
        <form action="BookingBayar.php" >
        <input class="btn success" type="submit" value="Cara Pembayaran" />
        </form>
    </th>
    <th>
        <form action="BookingUpload.php" >
        <input class="btn info" name="id"  type="hidden" value="<?php echo $boking_id; ?>" />
        <input class="btn info" type="submit" value="Upload Bukti" />
        </form>
    </th>
    <th>
        <form action="Booking.php" >
        <input class="btn default" type="submit" value="Booking Baru" />
        </form>
    </th>
    <th>
        <button onclick="printDiv('invoice')" class="btn warning" >Print</button>
    </th>
    <th>

        <form action="BookingBatal.php" >
        <input class="btn info" name="id"  type="hidden" value="<?php echo $boking_id; ?>" />            
        <input class="btn danger" name="ac" type="submit" value="Batalkan" />
        </form>
    </th>
  </tr>
</table>

    <h3 align="center" > Silahkan Transfer Deposit ke NO Rekening BCA [014]= 3140835683 A/N Effendi Fernandes </h3>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="images/logo.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice/Kwintasi #: <?php 
                                    $boking_id = $_GET["id"];
                                    if (isset($_GET["id"]))
                                    {
                                        echo $_GET["id"];
                                        $booking = getBookingByID($_GET["id"]);
                                        $room = getRoomByID("$booking[boking_room_id]");
                                    }
                                    else {
                                        header("Location: http://localhost/HappyPuppy");
                                        die();                                        
                                    }
                                 ?><br>
                                Tanggal Pembuatan Booking = 
                                <?php  
                            
                                    $date=date_create("$booking[boking_created]");
                                    $dateBooking=date_create("$booking[boking_tanggal] $booking[boking_waktu]"  );

                                    $dateBatas = date_create("$booking[boking_created]");                 
                                    date_add($dateBatas, date_interval_create_from_date_string('1 hours'));
                                    // $dateBatas  = $dateBatas->add(new \DateInterval('P10D'));//add 60 min
                                    // $added_date=date("Y-m-d H:i:s",strtotime('+4 hours', strtotime($dateBooking)));

                                    echo date_format($date,"d/m/Y H:i:s");
                                    echo "<br> Batas Deposit Booking = ";
                                    echo date_format($dateBatas,"d/m/Y H:i:s");
                                    echo "<br> Acara Booking = ";
                                    echo date_format($dateBooking,"d/m/Y");
                                    echo "<br>Dari   : " . date_format($dateBooking,"H:i:s");

                                    $startTime = date("$booking[boking_waktu]");
                                    $jam = "+$booking[boking_jumlah_jam] hour";
                                    $cenvertedTime = date('H:i:s',strtotime($jam,strtotime($startTime)));
                                    $Keterangan = "$booking[boking_ket]";
                                    echo '<br>Hingga : '.$cenvertedTime;
                                    echo '<br>Keterangan : '.$Keterangan;
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Nama<br>
                                Email<br>
                                No Handphone
                            </td>
                            
                            <td>
                                <?php 

                                    $boking_email = "$booking[boking_email] <br>";
                                    $boking_no_hp = "$booking[boking_no_hp] <br>";

                                    echo "$booking[boking_nama] <br>";
                                    echo substr_replace($boking_email,"******",0,5);
                                    echo substr_replace($boking_no_hp,"******",0,5);
                                 ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>            

            <tr class="heading">
                <td>
                    Order
                </td>
                <td>
                    Jumlah
                </td>            

            </tr>
            
            <tr class="item">
                <?php  
                echo "<td>$room[Room_Name] $jam</td>";
                echo "<td> Rp ". number_format("$booking[boking_total]")."<td>";
                // echo "<td>Rp. $booking[boking_total]</td>";
                ?>                
            </tr>
            <tr class="item">
                <?php  
                echo "<td style='max-width:300px;'>";
                echo str_replace("-","<br>","$room[Room_Desc]");
                echo "</td>";
                // echo "<td>Rp. $booking[boking_total]</td>";
                ?>                
            </tr>
            
            
            <tr class="total">
                <td></td>
                
                <td>
                    <?php 
                        echo "Deposit : Rp ". number_format("$booking[boking_deposit]");
                     ?>
                   <!-- Deposite : Rp. 250000 -->
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                    <?php 
                        echo "Total : Rp ". number_format("$booking[boking_total]");

                     ?>
                </td>
            </tr>

        </table>

        <h1 align="center"> 
            

            <?php 
                // 'Belum Lunas','DP Bukti Kirim','DP Lunas','Lunas','Selesai','Batal'            
                switch ($Keterangan){
                   case 'Belum Lunas':
                      echo "<p id='demo'></p>";
                      break;
                    default:
                        echo "$Keterangan";
                }

             ?>

        </h1>



    </div>
<script>
// Set the date we're counting down to



  var countDownDate = new Date("  <?php 
    echo date_format($dateBatas,"D, d M y H:i:s");
  ?>").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = "Batas Pelunasan Deposit(DP)<br>"+days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "BOOKING TELAH KADALUARSA SILAHKAN BUAT BARU";
  }
}, 1000);
</script>    
</body>
</html>