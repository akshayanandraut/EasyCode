<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         //  unset($_COOKIE['username']);
          //$res=  setcookie('username', '', 1);
          if(isset($_SESSION['username'])){
              $_SESSION['username']=NULL;
          }
          header('Location: index.php');
        ?>
    </body>
</html>
