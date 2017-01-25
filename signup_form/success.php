<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>Successful Registration</title>        
<link href='https://fonts.googleapis.com/css?family=Raleway:400, 600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="navigation.css">
        <style>
            body{
                //background-color: yellowgreen;;
                background: url("back.png") no-repeat;
                background-size: cover;
                padding-top: 150px;
                padding-bottom: 100px;
                padding-left: 300px;
                padding-right: 300px;
                font-family: 'Raleway',sans-serif;
            }
            #border_form{
                padding-top: 50px;
                padding-bottom: 50px;
                padding-left: 50px;
                padding-right: 50px;
                background-color: cornsilk;
                font-size: 28px;
                font-family: 'Raleway',sans-serif;
                font-weight: bold;
                color: #F90;
            }
        </style>
        
        <script src="../homepage/jquery-1.12.2.min.js">
</script> 
<script>

$(document).ready(function(){		
    $('#loginbtn').click(
	function()
	{
            $("#toggle").animate({height:'toggle',width:'toggle'},'1000');	
            $('article').fadeTo("slow",0.5);
	});
				
			
	$('article').click(function(){
            $("#toggle").hide("slow");
            $("article").fadeTo("slow",1);
	});
	});
	
$(document).ready(function(){$('#toggle').hide();});
</script>

    </head>
    <body>
                <?php 
            $loginErr="";
            $luname=$lpass="";
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formname"] == "loginform"){
//	$conn=mysqli_connect("localhost", "root","", "wp");
  $conn=mysqli_connect("mysql9.000webhost.com", "a5113957_root","siddhantrai30","a5113957_wp");      
        if (!$conn) {die("");}
        
	$luname=$_POST["uname"];
	$lpass=$_POST["pass"];
        
        $query="select uname,password from user_info where uname='".$luname."' and password='".$lpass."'";
        $result=mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION['username']=$luname;
            header('Location: ../successlogin.php');
        }
        else{
            $loginErr="* Username and Password do not match!!";
            echo "<script>$(document).ready(function(){\$('#toggle').show();});</script>";
        }
    }
?>
        
        <header>
            <nav>
		<logarrow id="loginbtn">Log in</logarrow>
                <label id="signuppage"><a href="./signup.php">Sign up</a></label>
                <ul>
					
                    <li><a href="../homepage/index.php#top">Home</a></li>
                    <li><a href="../homepage/index.php#courses">Courses</a></li>
                    <li><a href="../homepage/index.php#code">Code</a></li>
                    <li><a href="../homepage/index.php#play">Play</a></li>
                    <li><a href="../homepage/index.php#contact">Contact us</a></li> 
                    <li><a><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">'.$_SESSION['username'].'</user>';}?></a></li>
                    <li><a href="../logout.php"><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">Logout</user>';}?></a></li>                                        
                </ul>
				<div id="toggle" style="padding:15px;">
                                <form name="loginform" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <input type="hidden" name="formname" value="loginform">
                                    <?php echo "<span style='color: red; font-size: 10px;'>".$loginErr."</span>"; ?><br>
                                Username : <br>	<input type="text" name="uname" value='<?php echo $luname; ?>' required> <br>
                                Password : <br>	<input type="password" name="pass" required><br>
				<input type="submit" style="background:#1295C9;padding:8px;" value="Log in" id="login_btn">
				</form>
				
			</div>
		
            </nav>
			
        </header>
        
        <div id="border_form">
            Hurrah!! You have successfully registered for EasyCode
            <br>
            <a href="../homepage/index.php">Click Here!</a> To Login and start learning
        </div>
        
    </body>
</html>
