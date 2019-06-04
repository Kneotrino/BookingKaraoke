<!DOCTYPE html>
<html>
<head>
<title>Karaoke Night | Drinks</title>
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
  <div>
    <h2>Drinks</h2>
    <?php
      ShowListMenu("Minum");
    ?>

  </div>
</div>
<div id="footer">
        <?php
            include './footer.php';
        ?>
</div>
</body>
</html>