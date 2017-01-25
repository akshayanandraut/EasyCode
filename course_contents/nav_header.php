<?php session_start();?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../homepage/pagestyle.css">
    <style>
        #loginbtn a{
    color: white;
    font-size: 30px;
    font-family: 'Raleway',sans-serif;
    padding-left: 20px;
    text-decoration: none;
}
#loginbtn a:hover{
    color:#F90;
    cursor:pointer;
    opacity: .80;
}
    </style>
</head>
<body>    
<header>
            <nav>
                <label id="loginbtn"><a href="../homepage/index.php" target="_top">Log in</a></label>
                <label id="signuppage"><a href="../signup_form/signup.php" target="_top">Sign up</a></label>
                <ul>
					
                    <li><a href="../homepage/index.php#top" target="_top">Home</a></li>
                    <li><a href="../homepage/index.php#courses" target="_top">Courses</a></li>
                    <li><a href="../homepage/index.php#code" target="_top">Code</a></li>
                    <li><a href="../homepage/index.php#play" target="_top">Play</a></li>
                    <li><a href="../homepage/index.php#contact" target="_top">Contact us</a></li>
                    <li><a><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">'.$_SESSION['username'].'</user>';}?></a></li>
                    <li><a href="../logout.php" target="_top"><?php if(isset($_SESSION['username'])){echo '<user style="color:#ffa500;">Logout</user>';}?></a></li>                    
                </ul>
	      </nav>
			
        </header>
</html>