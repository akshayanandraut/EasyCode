<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
        /*$mail='siddhantraisgr@gmail.com';
        $subject='test message';
        $msg='Congo mail services working';
    
        mail($mail, $subject, $msg, 'From : easycode2016@gmail.com');    
        */echo 'done bye';
			$conn=mysqli_connect("mysql9.000webhost.com", "a5113957_root","siddhantrai30","a5113957_wp");        
        if (!$conn) {die("Connection failed: " . mysqli_connect_error());}
		else{echo "<br>db done!!!!!!!!!!!!!!!!";}

        ?>
    </body>
</html>
