<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
<link href='https://fonts.googleapis.com/css?family=Raleway:400, 600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../../signup_form/navigation.css">
	<meta charset="UTF-8">
	<title>Tic-tac-toe</title>

	<script src="game.js"></script>
	<script src="state.js"></script>

	<style>
		canvas {
			position: absolute;
			margin: auto;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
		}
	</style>
        <script src="../jquery-1.12.2.min.js">
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
            //header('Location: ../../successlogin.php');
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
                <label id="signuppage"><a href="../../signup_form/signup.php">Sign up</a></label>
                <ul>
					
                    <li><a href="../index.php#top">Home</a></li>
                    <li><a href="../index.php#courses">Courses</a></li>
                    <li><a href="../index.php#code">Code</a></li>
                    <li><a href="../index.php#play">Play</a></li>
                    <li><a href="../index.php#contact">Contact us</a></li>
                    <li><a><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">'.$_SESSION['username'].'</user>';}?></a></li>
                    <li><a href="../../logout.php"><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">Logout</user>';}?></a></li>                                        
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
    

<script>

var canvas, ctx, state, mouse = {x:0, y:0};

window.onload = function main() {

	canvas = document.createElement("canvas");
	canvas.width = canvas.height = 3*120 + 20;
	ctx = canvas.getContext("2d");

	state = new StateManager();
	state.add(new MenuState("menu"), new GameState("game"), new AboutState("about"));
	state.set("menu");

	document.body.appendChild(canvas);

	canvas.addEventListener("mousemove", mouseMove, false);

	init();
	tick();
}

function init() {
	state.get("game").init(ONE_PLAYER);
}

function tick() {
	window.requestAnimationFrame(tick);

	ctx.clearRect(0, 0, canvas.width, canvas.height);

	state.tick(ctx);
}

function mouseMove(evt) {
	var el = evt.target;
	var ox = oy = 0;
	do {
		ox += el.offsetLeft;
		oy += el.offsetTop;
	} while (el.parentOffset)

	mouse.x = evt.clientX - ox;
	mouse.y = evt.clientY - oy;
}
</script>
</body>
</html>