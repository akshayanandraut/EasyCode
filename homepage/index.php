<?php session_start();?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Easy Code</title>
        <link rel="stylesheet" type="text/css" href="pagestyle.css">
        <link href='https://fonts.googleapis.com/css?family=Raleway:400, 600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="jquery-1.12.2.min.js"></script> 
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
            $uname=$pass="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
	//$conn=mysqli_connect("localhost", "root","", "wp");
        $conn=mysqli_connect("mysql9.000webhost.com", "a5113957_root","siddhantrai30","a5113957_wp");
        if (!$conn) {die("");}
        
	$uname=$_POST["uname"];
	$pass=$_POST["pass"];
        
        $query="select uname,password from user_info where uname='".$uname."' and password='".$pass."'";
        $result=mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
            //setcookie('username', $uname, time() + (60*3) , '/');
            $_SESSION['username']=$uname;
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
                <label id="signuppage"><a href="../signup_form/signup.php">Sign up</a></label>
                <ul>
					
                    <li><a href="#top">Home</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#code">Code</a></li>
                    <li><a href="#play">Play</a></li>
                    <li><a href="#contact">Contact us</a></li>
                    <li><a><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">'.$_SESSION['username'].'</user>';}?></a></li>
                    <li><a href="../logout.php"><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">Logout</user>';}?></a></li>                    
                </ul>
				<div id="toggle" style="padding:15px;">
                                <form name="loginform" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <?php echo "<span style='color: red; font-size: 10px;'>".$loginErr."</span>"; ?><br>
                                Username : <br>	<input type="text" name="uname" value='<?php echo $uname; ?>' required> <br>
                                Password : <br>	<input type="password" name="pass" required><br>
				<input type="submit" style="background:#1295C9;padding:8px;" value="Log in" id="login_btn">
				</form>
				
			</div>
		
            </nav>
			
        </header>
		 
        <div id="article">
	<article>
       		
            <div class="main_cover">
            <div class="main" id="main">
            <h1>Learn Web <br>Development</h1>
            <p>HTML, CSS, JAVASCRIPT</p>
            </div>
            </div>
            
            <div class="courses" id="courses">
            <div class="incourse">
            <h2>Check out the Courses</h2>
            <a href="../course_contents/html_main.html" class="floatbox"></a>
            <a href="../course_contents/css_main.html" class="floatbox1"></a>
            <a href="../course_contents/javascript_main.html" class="floatbox2"></a>
            </div>
            </div>
            
            <div class="code" id="code">
            <div class="contain">
            <img class="easycode_img" height="300" width="400"  src="shot1.png"> 
            <div class="code_text">
                <h2>Code Online with EasyCode</h2>
<!--            <a href="./all_editor/index.php" class="floatbox3">-->
<a href="./html_editor/index.php" class="floatbox3">
            START CODING!!!!
            </a>    
            </div>
            </div><br><br><br><br>
            </div>
                
            <div class="play" id="play">
                <a href="game/tic_tac_toe.php"><img class="playimg" src="play.png" alt="click here to play"></a>
                <h2>Play Games</h2>
            </div>
            
            <div class="contact" id="contact">
                <h2>Contact us</h2>
                <a href="https://plus.google.com/+akshayanandraut0303" target="_blank"><img src="owners/akki.JPG"></a>
                <a href="https://plus.google.com/111625491858812290481" target="_blank"><img src="owners/sid.jpg"></a>
                <a href="https://plus.google.com/118237921264927709256" target="_blank"><img src="owners/rohan.jpg"></a>
            </div>
			
		
        </article>
		</div>
		
        <footer>
            <div class="foot">
                <p>@ Copyright easycode2016</p>
            </div>
        </footer>
    </body>

</html>
