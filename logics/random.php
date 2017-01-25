<!DOCTYPE html>
<html>
    <head>
        <title>random</title>
    </head>
    <body>
        <?php
            echo "1".mt_srand();
            echo "<br>";
            echo "2".rand("12345678", "67890123");
            
            $str="qwertyuiopasdfghjklzxcvbnm1234567890";
            $r_str="";
            for($i=0;$i<30;$i++){
                $r_str .=$str[rand(0,30-1)];
            }
            echo "<hr>";
            echo $r_str;
        ?>
    </body>
</html>
