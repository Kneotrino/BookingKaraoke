<!DOCTYPE html>
<html>
<head>
<title>Karaoke Night | Gallery</title>
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
        ?>    
  <div id="gallery">
    <h2>Photo Gallery</h2>
<!--     <h4>Aliquam semper felis et nunc egestas placerat. Sed vel erat et orci lacinia dapibus. Nulla cursus nisi vel dolor venenatis aliquam fusce consectetur,</h4>
 -->    <ul>
      <li><a href="images\INSIDE-3.jpeg"><img src="images\FRONT-1.jpeg" alt="" height="250" width="250"></a></li>
      <li><a href="images\INSIDE-3.jpeg"><img src="images\INSIDE-1.jpeg" alt="" height="250" width="250"></a></li>
      <li><a href="images\INSIDE-3.jpeg"><img src="images\INSIDE-2.jpeg" alt="" height="250" width="250"></a></li>
      <li><a href="images\INSIDE-3.jpeg"><img src="images\INSIDE-3.jpeg" alt="" height="250" width="250"></a></li>
      <li><a href="images\PEOPLE-1.jpeg"><img src="images\PEOPLE-1.jpeg" alt="" height="250" width="250"></a></li>
      <li><a href="images\FRONT-1.jpeg"><img src="images\FRONT-1.jpeg" alt="" height="250" width="250"></a></li>
    </ul>
  </div>
</div>
<div id="footer">
        <?php
            include './footer.php';
        ?>
</div>
</body>
</html>