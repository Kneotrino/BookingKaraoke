<!DOCTYPE html>
<html>
<head>
<title>Karaoke Night | Events</title>
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
            include './connect.php'            
        ?>
  <div id="events">
    <h2>Events</h2>
    <?php
      ShowListEvent();
    ?>

</div>
</div>

</body>
</html>