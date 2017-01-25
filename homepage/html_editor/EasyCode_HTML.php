<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Raleway:400, 600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../../signup_form/navigation.css">
        <title></title>
        <style>
            textarea,iframe{
                width: 650px;
                height: 500px;
                text-align: left;
                font-size: 15px;
                font-weight: bold;
            }
            textarea{
                resize: none;
            }
            body{
                background: url("developer.png") no-repeat;
                background-size: cover;
            }
            h1{
                text-align: center;
            }
            span{
                color: white;
                padding: 10px 10px 10px 10px;
                background-color: #1295C9;
            }
            #op{
                padding: 2px 2px 2px 2px;
                color: white;
                background-color: black;
                font-size: 20px;
            }
            #op:hover{
                transform: scale(1.1);
            }
            #edit{
                font-size: 20px;
                font-weight: bolder;
                color: white;
                background-color: mediumseagreen;
            }
            iframe{
                background-color: white;
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
	//$conn=mysqli_connect("localhost", "root","", "wp");
        $conn=mysqli_connect("mysql9.000webhost.com", "a5113957_root","siddhantrai30","a5113957_wp");
        if (!$conn) {die("");}
        
	$luname=$_POST["uname"];
	$lpass=$_POST["pass"];
        
        $query="select uname,password from user_info where uname='".$luname."' and password='".$lpass."'";
        $result=mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION['username']=$luname;
//            header('Location: ../../successlogin.php');
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
                                    <?php echo "<span style='background: #ccc; color: red; font-size: 10px;'>".$loginErr."</span>"; ?><br>
                                Username : <br>	<input type="text" name="uname" value='<?php echo $luname; ?>' required> <br>
                                Password : <br>	<input type="password" name="pass" required><br>
				<input type="submit" style="background:#1295C9;padding:8px;" value="Log in" id="login_btn">
				</form>
				
			</div>
		
            </nav>
			
        </header>

        <br><br><br>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formname"] == "editor"){            
                    
                            $file_content = $_POST["html"];
            
            $file_html =  fopen("file.html","w");
          
  //          file_put_contents("save_file.html",  ltrim($file_content));
            fwrite($file_html,$file_content);
            fclose($file_html);
            }
        ?>      
        <h1><span>Easy Code for HTML</span></h1>
        <form name="editor" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <input type="hidden" name="formname" value="editor">
<!--        <form name="editor" action="Html_process.php" method="post"> -->
            <table>
                <tr>
                    <td><span id="edit">Edit code here : </span></td>
                    <td>
                        <input type="submit" id="op" value="Output>>>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="html">
                        <?php
                            echo ltrim(file_get_contents("file.html"));
                        ?>
                        </textarea>
                    </td>
                    <td>
                        <iframe name="output" src="file.html">
                        </iframe>    
                    </td>
                </tr>
            </table>    
        </form>
    </body>
</html>
