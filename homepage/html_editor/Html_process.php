<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $file_content = $_POST["html"];
            
            $file_html =  fopen("file.html","w");
          
  //          file_put_contents("save_file.html",  ltrim($file_content));
            fwrite($file_html,$file_content);
            fclose($file_html);
            
            header('Location: ./EasyCode_HTML.php');
        ?>
    </body>
</html>
