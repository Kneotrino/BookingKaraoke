<?php
	include './connect.php';	
	 $newName = '';
	 $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	 $max = strlen($characters) - 1;
	 for ($i = 0; $i < 20; $i++) {
	      $newName .= $characters[mt_rand(0, $max)];
	 }

	$newName .=".png";
    // echo "$newName";

    $currentDir = getcwd();
    $uploadDirectory = "/admin/BokingBukti/";


    $errors = []; // Store all foreseen and unforseen errors here
	
    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];

    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . $newName; 

    if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            $filebase = "BokingBukti/".$newName;
            $id = $_POST['id'];
            if ($didUpload) {
			        $sqlBoking = "
			         UPDATE boking SET boking_Bukti_Dp = '$filebase', boking_ket= 'DP Bukti Kirim' WHERE boking.boking_id = $id
			        ";
            if ($conn->query($sqlBoking) === TRUE) {
                $last_id = $conn->insert_id;
                echo "<script type='text/javascript'>alert('Berhasil Booking'); window.location= 'index.php';</script>";
                // createEmail($last_id);
            } else {
                echo "<script type='text/javascript'>alert('Gagal Booking');</script>";
            }

                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }



?>