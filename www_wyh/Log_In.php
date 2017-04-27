<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->

<?php session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Group #2|Stock Forecasting System</title>
<link href="css/login/main.css" rel="stylesheet" type="text/css" />



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
<div class="loginWrapper">
    <div class="loginLogo"><img src="img/login.png" alt="" /></div>
    <div class="widget">
        <div class="title"><img src="img/files.png" alt="" class="titleIcon" /><h6>Please Input your Username and Password</h6></div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" id="validate" class="form" method="post">
            <fieldset>
                <div class="formRow">
                    <label for="login">Username:</label>
                    <div class="loginInput"><input type="username" name="username" class="validate[required]" id="login" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Password:</label>
                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="pass" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <div class="remember">
                    <input type="checkbox" id="remember" name="remember" /><label for="remember">Remember me</label></div>
                    <input type="submit" value="Log me in" class="dredB logMeIn" name="submit" />
                    <div class="clear"></div>
                </div>

            </fieldset>
        </form>
    </div>
</div>    

</body>
</html>