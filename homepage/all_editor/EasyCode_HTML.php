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
                font-size: 25px;
                font-weight: bold;
            }
            textarea{
                resize: none;
            }
            body{
                background: url("developer.png") no-repeat;
                background-size: cover ;
            }
            h2{
                font-weight: bold;
                color: white;
                font-size: 20px;
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
	$conn=mysqli_connect("localhost", "root","", "wp");
        
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
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formname"] == "editor"){            
                
            $file_content = $_POST["html"];
            $file_html =  fopen("html.html","w");         
            fwrite($file_html,$file_content);
            fclose($file_html);
            
            $file_content1 = $_POST["css"];
            $file_html1 =  fopen("css.css","w");         
            fwrite($file_html1,$file_content1);
            fclose($file_html1);
            
            $file_content2 = $_POST["js"];
            $file_html2 =  fopen("js.js","w");         
            fwrite($file_html2,$file_content2);
            fclose($file_html2);
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

        <h1><span>Easy Code for HTML CSS & JAVASCRIPT</span></h1><br>
        <h2>
        <span>NOTE :</span><br><br>
        <span>1. No need of Writing html,head,body tags for HTML file.</span><br><br>
        <span>2. Directly write the css code. style tag not required.</span><br><br>
        <span>3. script tag also not needed.</span><br><br>
        </h2>
        <form name="editor" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <input type="hidden" name="formname" value="editor">
            <table>
                <tr>
                    <td><span id="edit">Edit code here : </span></td>
                    <td>
                        <input type="submit" id="op" value="See Result>>>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1><span>HTML</span></h1>
                        <textarea name="html">
                        <?php
                            echo ltrim(file_get_contents("html.html"));
                        ?>
                        </textarea>
                    </td>
                    <td><h1><span>OUTPUT</span></h1>
                          <iframe name="output" src="save_file.php">
                        </iframe>  
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1><span>JAVASCRIPT</span></h1>
                        <textarea name="js">
                        <?php
                            echo ltrim(file_get_contents("js.js"));
                        ?>
                        </textarea>
                    </td>
                    <td>
                        <h1><span>CSS</span></h1>
                        <textarea name="css">
                        <?php
                            echo ltrim(file_get_contents("css.css"));
                        ?>
                        </textarea>  
                    </td>
                </tr>
            </table>    
        </form>
    </body>
</html>
