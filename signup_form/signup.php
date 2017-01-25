<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
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
            #fname,#lname,#uname,#email,#gender,#pass,#cpass{
                font-family: 'Raleway',sans-serif;
                font-size: 16px;
                color: black;
            }
            #submit:hover{
                transform: scale(1.1);
            }
            #submit{
                background-color: #4d90fe;
                font-family: 'Raleway',sans-serif;
                font-size: 22px;
                color: white;
                position: relative;
                left: 500px;
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
        <?php
            $fname=$lname=$uname=$email=$gender=$pass=$cpass="";
            $unameErr=$emailErr=$passErr=$cpassErr="";
            
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formname"] == "signup"){
                $fname=$_POST["fname"];
                $lname=$_POST["lname"];
                $uname=$_POST["uname"];
                $email=$_POST["email"];
                $gender=$_POST["gender"];
                $pass=$_POST["pass"];
                $cpass=$_POST["cpass"];
                
                
  //              $con=mysqli_connect("localhost", "root", "", "wp");
    $con=mysqli_connect("mysql9.000webhost.com", "a5113957_root","siddhantrai30","a5113957_wp");            
                if(!$con)
                {
                    die("");
                }
                
                $sql="select * from user_info where uname='".$uname."'";
                $result=mysqli_query($con, $sql);
                
                if(mysqli_num_rows($result) > 0 ){
                    $unameErr="* Username already taken.Try a different one!!";
                }
                $sql="select * from user_info where email='".$email."'";
                $result=mysqli_query($con, $sql);
                
                if(mysqli_num_rows($result) > 0 ){
                    $emailErr="* Email already registered!!!";
                }
                
                if(strlen($pass)<8){
                    $passErr="* Weak password";
                }
                
                if(strcmp($pass, $cpass) != 0){
                    $cpassErr="* Password does not match!!'";
                }
                
                
                if(strcmp($unameErr, "") == 0 && strcmp($emailErr, "") == 0 && strcmp($passErr, "") == 0 && strcmp($cpassErr, "") ==0 ){
                    $random_ip="qwertyuiopasdfghjklzxcvbnm1234567890";
                    $random_str="";
                    for($i=0;$i<30;$i++){
                        $random_str .=$random_ip[rand(0,30-1)];
                    }
                    $msg="Use this code to verify your account => ".$random_str;
                    mail($email, "Verification Code", $msg, 'From : easycode2016@gmail.com');    
                    $_SESSION['fname']=$fname;
                    $_SESSION['lname']=$lname;
                    $_SESSION['uname']=$uname;
                    $_SESSION['email']=$email;
                    $_SESSION['gender']=$gender;
                    $_SESSION['pass']=$pass;
                    $_SESSION['vcode']=$random_str;
                    header('Location: verification.php');
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
            <form name="signup" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                <input type="hidden" name="formname" value="signup">
            <div class="form_data">
                <label>Name <br> 
                    <input id="fname" type="text" size="10" placeholder="First" name="fname" value='<?php echo $fname; ?>' required>
                    <input id="lname" type="text" size="10" placeholder="Last" name="lname" value='<?php echo $lname; ?>' required>
                </label>
            </div>
            <br>
            <div class="form_data">
                <label>Choose your username<br> 
                    <input type="text" size="30" placeholder="example: sid_97" name="uname" id="uname" value='<?php echo $uname; ?>' required><?php echo "<span style='color: red; font-size: 10px;'>".$unameErr.""; ?>
                </label>
            </div>
            <br>
            <div class="form_data">
                <label>Your email address<br> 
                    <input type="text" size="30" placeholder="example: sid@gmail.com" name="email" id="email" value='<?php echo $email; ?>' required><?php echo "<span style='color: red; font-size: 10px;'>".$emailErr.""; ?>
                </label>
            </div>
            <br>
            <div class="form_data">
                <label>Gender <br>
                    <select name="gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </label>
            </div>
            <br>
            <div class="form_data">
                <label>Create a password <br>
                    <input type="password" size="30" placeholder="minimum 8 characters" name="pass" id="pass" required><?php echo "<span style='color: red; font-size: 10px;'>".$passErr.""; ?>
                </label>
            </div>
            <br>
            <div class="form_data">
                <label>Confirm your password <br>
                    <input type="password" size="30" name="cpass" id="cpass" required><?php echo "<span style='color: red; font-size: 10px;'>".$cpassErr.""; ?>
                </label>
            </div>
            <br>
            <div class="form_data">
                <label><input type="checkbox" name="policy" id="policy" required> I agree to the EasyCode Terms of Service and Privacy Policy</label>
            </div>
            <br>
            <div class="form_data">
                <input id="submit" type="submit" value="Next step">
            </div>
        </form>
        </div>
    </body>
</html>
