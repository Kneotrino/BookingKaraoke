<!DOCTYPE html>
<html>
<head>
<title>Karaoke Night | Rooms</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div id="header"> <a href="index.php" id="logo"><img src="images/logo.png" alt=""></a>
        <?php
            include './navigation-top.php';
        ?>
</div>
<div class="body">
        <?php
            include './navigation-side.php';
            include './connect.php';
        ?>
  <div id="rooms">
    <h2>Rooms</h2>
        <?php
            ShowListRoom();
        ?>

      </div>
  </div>
</div>
<div id="footer">
        <?php
            include './footer.php';
        ?>

</div>
</body>
</html>