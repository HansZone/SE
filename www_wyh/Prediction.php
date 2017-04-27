<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->


<?php session_start();
@$username=$_SESSION["username"];
include_once 'VR.php';
include_once 'KDJ.php';
include_once 'RSI.php';
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
			
				<!-- Page header -->
				<div class="page-header">
					<h1><span class="icon-file"></span> Prediction</h1>
					<ul class="page-header-actions">
						<li class="active demoTabs"><a href="#visualize" class="btn btn-wuxia">Indicator</a></li>
						<li class="demoTabs"><a href="#flot1" class="btn btn-wuxia">Price</a></li>
						<li class="demoTabs"><a href="#flot2" class="btn btn-wuxia">Prediction Strategy</a></li>
					</ul>
					
					
				</div>
				<!-- /Page header -->
				
<!--indicator-->		

				<!-- Tab content -->
				<div class="page-container tab-content">

					<!-- Tab #visualize -->
					<div class="tab-pane active" id="visualize">
						
						<!-- Tab button-->
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
						
						</form>
						</div>
						<!-- Tab button-->
						
					<h2>
						<?php 
						echo "You have selected ",@$_POST["submit"];
                        echo "<br><br>";
						?>

					</h2>
						<h3>KDJ indicator</h3>
						<?php
                        if (isset($_POST["submit"]))
                        {
                            @$r1=KDJfunction($_POST["submit"]);
                        }
                        echo "<br><br>";
						?>
                        <h3>VR indicator</h3>
                        <?php
                        if (isset($_POST["submit"]))
                        {
                            $VR=new VR();
                            @$VRpridiction=$VR->CalculateVR($_POST["submit"]);
                            echo "The VR is ",$VRpridiction,"<br>";
                            $r2=$VR->Analysis($VRpridiction);
                        }
                        echo "<br><br>";
                        ?>
                        <h3>RSI indicator</h3>
                        <?php
                        if (isset($_POST["submit"]))
                        {
                            $RSI=new RSI();
                            @$RSIpridiction=$RSI->CalculateRSI($_POST["submit"]);
                            echo "The RSI is ",$RSIpridiction,"<br>";
                            $r3=$RSI->Analysis($RSIpridiction);
                        }
                        echo "<br><br>";
                        ?>
                        <h3>Accordingly, final suggestion is:
                        <?php
                        if (isset($_POST["submit"]))
                        {
                            $r=$r1+$r2+$r3;
                            if ($r>1)echo"BUY";
                            else if ($r<-1) echo"SELL";
                            else echo"HOLD or SIT OUT";
                        }
                        ?>
                        </h3>
					</div>
					<!-- Tab #visualize -->

					<!-- Tab #flot -->
					<div class="tab-pane" id="flot1">
						
						<h2>You want to predict long term or short term? </h2>
						<br>
						<a href="Long_Term.php" class="btn btn-wuxia" target="blank">Long Term</a>
						<a href="Short_Term.php" class="btn btn-wuxia" target="blank">Short Term</a>

					</div>
					<!-- /Tab #flot -->

					<!-- Tab #flot -->
					<div class="tab-pane" id="flot2">

						<h2>Our prediction strategy is: </h2>
						<br>
                        <h3>KDJ</h3>
						<p>&#9830;If K is smaller than 10 or D is smaller than 20 or J is smaller than 0, stock is oversold, this gives a suggestion to buy this stock.<br/>
                            &#9830; If K is greater than 90 or D is greater than 80 or J is greater than 100, stock is overbought, this gives a suggestion to sell this stock.<br/>
                            &#9830; Otherwise, it's a suggestion to hold or sit out
                        </p>
                        <h3>VR</h3>
						<p>
                            VR = total volume at rising days of N days/ total volume at declining days of N days.<br/>
                            &#9830; If VR<0.7, it's likely to form a bottom which is a sign to buy.<br/>
                            &#9830; If 0.7<=VR<1.5, it's likely to be safe which is a sign to hold.<br/>
                            &#9830; If VR>=1.5, it's likely to form a top which is a sign to sell.
                        <h3>RSI</h3>
                        <p>
                            &#9830; If RSI<30, stock is likely oversold which is a sign to buy.<br/>
                            &#9830; If 30<=VR<70, it's likely to be safe which is a sign to hold.<br/>
                            &#9830; If VR>=70, stock is likely overbought which is a sign to sell.
                        </p>
                        <h3>Combine</h3>
                        <p>
                            Define a counter,<br/>
                            &#9830;if an indicator suggest to buy, counter+1,<br/>
                            &#9830;if an indicator suggest to sell, counter-1,<br/>
                            &#9830;if an indicator suggest to hold, counter doesn't change,<br/>
                            after all indicators give their suggestion,<br/>
                            &#9830;if counter>1, we recommend to buy,<br/>
                            &#9830;if counter<-1, we recommend to sell,<br/>
                            &#9830;otherwise, we suggest you to hold this stock.
                        </p>
						
					</div>
					<!-- /Tab #flot -->
					
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