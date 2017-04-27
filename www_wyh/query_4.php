<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->


<?php session_start();
@$username=$_SESSION["username"];
//echo $_SESSION["username"];
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
                <li><a class="wuxify-me" href="query_se.php"><span class="icon-picture"></span>Query</a></li>
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
            <h1><span class="icon-signal"></span> Query</h1>
            <ul class="page-header-actions">
                <li class="demoTabs"><a href="query_se.php" class="btn btn-wuxia">1.Show all</a></li>
                <li class="demoTabs"><a href="query_1.php" class="btn btn-wuxia">2.Get highest</a></li>
                <li class="demoTabs"><a href="query_2.php" class="btn btn-wuxia">3.Get average</a></li>
                <li class="demoTabs"><a href="query_3.php" class="btn btn-wuxia">4.Get lowest</a></li>
                <li class="active demoTabs"><a href="query_4.php" class="btn btn-wuxia">5.Get smaller</a></li>
            </ul>
        </div>
        <!-- /Page header -->

        <!-- Tab content -->
        <div class="page-container tab-content">

            <!-- Tab #visualize -->
            <div class="tab-pane" id="visualize">

                <h2>The latest price for all stocks in database are: </h2>
                <br>
                <h3>
                    <?php
                    $check_query=mysql_query("SELECT Ticker, Company, Price FROM stocks");
                    while ($row=mysql_fetch_assoc($check_query))
                    {
                        echo $row["Ticker"];
                        echo " ";
                        echo $row["Company"];
                        echo " ";
                        echo $row["Price"];
                        echo "<br>";
                    }
                    ?>
                </h3>

            </div>
            <!-- Tab #visualize -->

            <!-- Tab #flot1 -->
            <div class="tab-pane" id="flot1">
                <!-- Title area -->
                <div class="titleArea" method="post">
                    <a href="#flot1">
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
                    </a>
                </div>

            </div>

            <h2>The highest price for <?php echo @$_POST["submit"]?> in the last ten days is: </h2>
            <br>
            <h2>
                <?php
                if(isset($_POST["submit"]))
                {
                    $stock=@$_POST["submit"];
                    $check_query=mysql_query("SELECT close FROM {$stock}_historical /*WHERE*/ /*date>='2017-04-14'*/ORDER BY date DESC LIMIT 10");
                    $price = 0;
                    while($row=mysql_fetch_assoc($check_query))
                    {
                        if ($row["close"]>$price)
                            $price=$row["close"];
                    }
                    echo $price;
                }
                // while(1){}
                ?>
            </h2>

        </div>
        <!-- /Tab #flot1 -->

        <!-- Tab #flot2 -->
        <div class="tab-pane" id="flot2">

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


            <h2>The average price of <?php echo @$_POST["submit"]?> in the last year is: </h2>
            <br>
            <h2>
                <?php
                if(isset($_POST["submit"])){
                    $stock=@$_POST["submit"];
                    $check_query=mysql_query("SELECT * FROM {$stock}_historical WHERE date>='2016-04-21' ");
                    $price = 0;
                    $i = 0;
                    while ($row=mysql_fetch_assoc($check_query))
                    {
                        $price += $row["close"];
                        $i++;
                    }
                    echo $price/$i;
                }
                ?>


            </h2>

        </div>
        <!-- /Tab #flot2 -->


        <!-- Tab #flot3 -->
        <div class="tab-pane" id="flot3">
            <h2>Lowest stock price for each company in the latest one year is: </h2>
            <br>
            <h3>
                <?php
                echo "GOOG: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM google_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "YHOO: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM yahoo_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "FB: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM facebook_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "TWTR: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM twitter_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "INTC: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM intel_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "AAPL: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM apple_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "AMD: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM amd_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "TSLA: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM tesla_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "NVDA: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM nvidia_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
                <?php
                echo "MSFT: ";
                $check_goog=mysql_query("SELECT MIN(close) FROM microsoft_historical WHERE date>='2016-04-21' ");
                $row=mysql_fetch_assoc($check_goog);
                echo $row['MIN(close)'];
                ?>
                <br>
            </h3>


        </div>
        <!-- /Tab #flot3 -->


        <!-- Tab #flot4 -->
        <div class="tab-pane active" id="flot4">

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

            <h2>Company whose average stock price less than the lowest of <?php echo @$_POST["submit"]?> in the latest one year: </h2>
            <br>
            <h3>
                <?php
                function findlowest($name){
                    $data=mysql_query("SELECT close FROM {$name}_historical WHERE date>='2016-04-21'");
                    $lowest=999999;
                    while($day=mysql_fetch_assoc($data))
                    {
                        if ($day["close"]<$lowest) $lowest=$day["close"];
                    }
                    return $lowest;
                }
                function findaverage($name){
                    $data=mysql_query("SELECT close FROM {$name}_historical WHERE date>='2016-04-21'");
                    $sum=0;
                    $count=0;
                    while($day=mysql_fetch_assoc($data))
                    {
                        $sum=$sum+$day["close"];
                        $count=$count+1;
                    }
                    $average=$sum/$count;
                    return $average;
                }

                if (isset($_POST["submit"])){
                $stock=@$_POST["submit"];
                $lowest=findlowest($stock);
                }
                else
                {
                    $lowest=findlowest("google");
                }
                $check_query=mysql_query("SELECT  StockID,Ticker,name,Company FROM stocks");
                while ($row=mysql_fetch_assoc($check_query))
                {
                    $average=findaverage($row['name']);
                    if($average < $lowest)
                    {
                        echo "StockID ";
                        echo $row["StockID"];
                        echo " ";
                        echo $row["name"];
                        echo "<br>";
                    }

                }
            
                ?>
            </h3>

        </div>
        <!-- /Tab #flot4 -->

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

<!-- jQuery Visualize -->
<!--[if lte IE 8]>
<script language="javascript" type="text/javascript" src="js/plugins/visualize/excanvas.js"></script>
<![endif]-->
<script src="js/plugins/visualize/jquery.visualize.min.js"></script>
<script src="js/plugins/visualize/jquery.visualize.tooltip.min.js"></script>

<script>
    $(document).ready(function() {

        $('table').each(function() {
            var chartType = ''; // Set chart type
            var chartWidth = $(this).parent().width()*0.85; // Set chart width to 85% of its parent
            var chartHeight = chartWidth; // Nice squares

            if ($(this).attr('data-chart')) { // If exists chart-chart attribute
                chartType = $(this).attr('data-chart'); // Get chart type from data-chart attribute
            } else {
                chartType = 'area'; // If data-chart attribute is not set, use 'area' type as default. Options: 'bar', 'area', 'pie', 'line'
            }

            if(chartType == 'line' || chartType == 'pie') {
                $(this).hide().visualize({
                    type: chartType,
                    width: chartWidth,
                    height: chartHeight,
                    colors: ['#389abe','#fa9300','#6b9b20','#d43f3f','#8960a7','#33363b','#b29559','#6bd5b1','#66c9ee'],
                    lineDots: 'double',
                    interaction: true,
                    multiHover: 5,
                    tooltip: true,
                    tooltiphtml: function(data) {
                        var html ='';
                        for(var i=0; i<data.point.length; i++){
                            html += '<p class="tooltip chart_tooltip"><div class="tooltip-inner"><strong>'+data.point[i].value+'</strong> '+data.point[i].yLabels[0]+'</div></p>';
                        }
                        return html;
                    }
                });
            } else {
                $(this).hide().visualize({
                    type: chartType,
                    width: chartWidth,
                    height: chartHeight,
                    colors: ['#389abe','#fa9300','#6b9b20','#d43f3f','#8960a7','#33363b','#b29559','#6bd5b1','#66c9ee'],
                });
            }
        });

    });
</script>

<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>