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
      <li><a href="#"><img src="images/girl-sing3.jpg" alt=""></a></li>
      <li><a href="#"><img src="images/group-singing2.jpg" alt=""></a></li>
      <li><a href="#"><img src="images/girls-singing2.jpg" alt=""></a></li>
      <li><a href="#"><img src="images/girl-smiling3.jpg" alt=""></a></li>
      <li><a href="#"><img src="images/boys-drinking3.jpg" alt=""></a></li>
      <li><a href="#"><img src="images/asian-girl-singing.jpg" alt=""></a></li>
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