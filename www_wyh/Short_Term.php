<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->


<?php session_start();
@$username=$_SESSION["username"];
?>

<!DOCTYPE html>
<html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title>Group #2|Stock Forecasting System</title>
		<meta name="description" content="" />
		<meta name="author" content="Walking Pixels | www.walkingpixels.com" />
		<meta name="robots" content="index, follow" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<!-- jQuery Visualize Styles -->
		<link rel='stylesheet' type='text/css' href='css/plugins/jquery.visualize.css' />
		
		<!-- CSS styles -->
		<link rel='stylesheet' type='text/css' href='css/wuxia-red.css' />
		
		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="img/icons/favicon.ico" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/icons/apple-touch-icon-114-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/icons/apple-touch-icon-72-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" href="img/icons/apple-touch-icon-57-precomposed.png" />
		
		<!-- JS Libs -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery.js"><\/script>')</script>
		<script src="js/libs/modernizr.js"></script>
		<script src="js/libs/selectivizr.js"></script>

		<script>
			$(document).ready(function(){
				
				// Navbar tooltips
				$('.navbar [title]').tooltip({
					placement: 'bottom'
				});
				
				// Content tooltips
				$('[role=main] [title]').tooltip({
					placement: 'top'
				});
				
				// Dropdowns
				$('.dropdown-toggle').dropdown();
				
				// Tabs
				$('.demoTabs a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
					$('table').trigger('visualizeRefresh');; // Refresh jQuery Visualize for hidden tabs
				})
				
			});
		</script>
		<script type="text/javascript">
			var _gaq=_gaq||[];_gaq.push(["_setAccount","UA-22557155-5"]);_gaq.push(["_trackPageview"]);(function(){var b=document.createElement("script");b.type="text/javascript";b.async=true;b.src=("https:"==document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a)})();
		</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<body>
	
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


		$handle = fopen("bayes(new).csv","r");
for ($i=0;$i<10;$i++) {
   $data = fgetcsv($handle, 1000, ",");
	$num = count($data);
    for ($c=0; $c < $num; $c++) {
	$result2[$i]=$data;
    }
}
fclose($handle);
		?>

		<!-- Main navigation bar -->
		<header class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">	
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".user">
						<span class="icon-user"></span>
					</button>
				
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".navigation">
						<span class="icon-chevron-down"></span>
					</button>
				<nav class="nav-collapse navigation">
						<ul class="nav" role="navigation">
							<li class="active"><a href="index_se.php" title="Homepage dashboard"><span class="icon-home"></span> Home</a></li>
						</ul>
					</nav>
					<nav class="nav-collapse user">
						<div class="user-info pull-right">
							<img src="http://placekitten.com/35/35" alt="User avatar" />
							<div class="btn-group">
								<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
									<div><strong>
										<?php
						                if($username!="") echo $username;
                						else echo "Visitor";?>
                						</strong>Balance
            						</div>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="Log_in.php"><span class="icon-signout"></span> Switch account</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>
		<!-- /Main navigation bar -->
		
		<!-- Main content -->
		<div class="container" role="main">

		<!-- Secondary navigation -->
			<div class="nav-secondary">
				<nav>
					<ul>
							<li><a class="wuxify-me" href="figure.php"><span class="icon-signal"></span>Figure</a></li>
							<li><a class="wuxify-me" href="query_SE.php"><span class="icon-picture"></span>Query</a></li>
							<li><a class="wuxify-me" href="Prediction.php"><span class="icon-file"></span>Predict</a></li>
							<li><a class="wuxify-me" href="news.php"><span class="icon-heart"></span>News</a></li>
					</ul>
				</nav>
			</div>
			<!-- /Secondary navigation -->
			
			<!-- Main data container -->
			<div class="content">
				
<!--indicator-->		

				<!-- Tab content -->
				<div class="page-container tab-content">


					<div id="rightSide">

    
    <!-- Title area -->
    <div class="titleArea" method="post">
			<div class="button" >
			 <form action="<?php echo $_SERVER['PHP_SELF']?>" id="validate" class="form" method="post">
				<?php
				$check_query = mysql_query("SELECT name from stocks where 1"); 
				while ($row=mysql_fetch_row($check_query))
				{
					$sub="submit";
					echo "<input type=".$sub." name=".$sub." value=".$row[0]." />";
				}
				?>				
				</div>
		
    </div>
    <div class="line"></div>
    
<?php 

	if (isset($_POST["submit"]))
	{
		
		for ($i=0;$i<10;$i++)
		{
			if ($result2[$i][0]==$_POST["submit"])
				$stock2=$result2[$i];
		}
    ?>
    <!-- Main content wrapper -->
     <div class="wrappers">
            </div>
			
            <h1>Short Term prediction for <?php echo $_POST["submit"]?></h1>
            <br>
			 <h3>The prediction price for the next 10 days to<?php echo $stock2[2] ?> are </h3>
             
			 <?php 
			 echo "</br>";
				  for ($i=3;$i<13;$i++)
					echo $stock2[$i],"</br>";
				  ?>
				  
				  <?php
	}
				  ?>

        </div>
    </div>
</div>
					
				</div>
				<!-- /Tab content -->
			
			</div>
			<!-- /Main data container -->
			
		</div>
		<!-- /Main content -->
		
		<!-- Scripts -->
		<script src="js/navbar.js"></script>
		<script src="js/plugins/waypoints.min.js"></script>
		<script src="js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap/bootstrap-dropdown.js"></script>
		<script src="js/bootstrap/bootstrap-tab.js"></script>
		<script src="js/bootstrap/bootstrap-collapse.js"></script>
		<script src="js/plugins/visualize/jquery.visualize.min.js"></script>
		<script src="js/plugins/visualize/jquery.visualize.tooltip.min.js"></script>
		
		
</body>
</html>