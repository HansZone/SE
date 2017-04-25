<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->

<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Stock Forecasting System Login</title>

<!-- CSS -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/form-elements.css">
<link rel="stylesheet" href="assets/css/style.css">

<!-- Favicon and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">



<!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body class="nobg loginPage">

<?php

// Connect to the database
$conn = @mysql_connect("localhost","root","");
if (!$conn){
    die("Failed to connect database£º" . mysql_error());
}
$db=mysql_select_db("seteam", $conn);
if(!$db)
{
  die("Failed to connect to MySQL:". mysql_error());
}
$username=$password="";
if(isset($_POST["submit"]))
{
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
     $username = test_input($_POST["username"]);
     $password= test_input($_POST["password"]);
		//Check the user
	$check_query = mysql_query("SELECT * from users where username='$username' and password='$password'");
	if ($check_query)
	{	 
		$row=mysql_fetch_array($check_query);
		if($row)
		{
				$_SESSION["username"]=$username;
				$_SESSION["password"]=$password;
			echo "<script>alert('You have successfully logged in!');location.href='index_se.php';</script>";
		}
		else
		{
			echo "<script>alert('Your Account is not right!');location.href='Log_in.php';</script>";
		}
	}
	}
}
 















function test_input($data) 
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<!-- Main content wrapper -->


<div class="top-content">
          
            <div class="inner-bg">
                <div class="container">
                 

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Please Login </strong></h1>
                            <div class="description">
                              <p>
                                This is a free stock forecasting system. Enjoy your experience with our trustworthy financial suggestions!
                              </p>
                            </div>
                        </div>
                    </div>

                  
                   
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                          <div class="form-top">
                            <div class="form-top-left">

                              <h3>Login to our site</h3>
                                <p>Enter your username and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                              <i class="fa fa-lock"></i>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" id="validate" class="form" method="post">
                            </div>
                            <div class="form-bottom">
                          <form role="form" action="" method="post" class="login-form">
                            <div class="form-group">
                              <label for="login">Username:</label>
                              <div class="loginInput"><input type="username" name="username" class="validate[required]" id="login" /></div>
                              <div class="clear"></div>
                              </div>
                              <div class="form-group">
                              <label for="pass">Password:</label>
                              <div class="loginInput"><input type="password" name="password" class="validate[required]" id="pass" /></div>
                              <div class="clear"></div>
                              </div>
                              <div class="remember">
                              <input type="checkbox" id="remember" name="remember" /><label for="remember">Remember me</label></div>
                              <input type="submit" value="Log me in" class="dredB logMeIn" name="submit" />
                              <div class="clear"></div>
                          
                          </form>
                          
                        </div>
                        </div>
                    </div>





 <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <script type="text/javascript" src="images/login.js"></script>


</body>
</html>