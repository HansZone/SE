<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->



<?php session_start();
$stockname=$_SESSION["stockname"];
@$username=$_SESSION["username"];
?>
<!DOCTYPE HTML>
<html>
	<head>
<meta charset="utf-8" />
        <title>Group #2|Stock Forecasting System</title>
        <meta name="description" content="" />
        <meta name="author" content="Walking Pixels | www.walkingpixels.com" />
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

        <!-- Scripts -->
        <script src="js/navbar.js"></script>
        <script src="js/plugins/waypoints.min.js"></script>
        <script src="js/bootstrap/bootstrap-tooltip.js"></script>
        <script src="js/bootstrap/bootstrap-dropdown.js"></script>
        <script src="js/bootstrap/bootstrap-collapse.js"></script>
        
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
                
            });
        </script>




		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highstock Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
	
		<script type="text/javascript">
function HistoricalChart (StockName){
	$(function () {
	var filename =StockName+".json";
	var tittle = StockName+" historical";
    $.getJSON(filename, function (data) {

        // split the data set into ohlc and volume
        var ohlc = [],
            volume = [],
            dataLength = data.length,
            // set the allowed units for data grouping
            groupingUnits = [[
                'week',                         // unit name
                [1]                             // allowed multiples
            ], [
                'month',
                [1, 2, 3, 4, 6]
            ]],

            i = 0;

        for (i; i < dataLength; i += 1) {
            ohlc.push([
                data[i][0], // the date
                data[i][1], // open
                data[i][2], // high
                data[i][3], // low
                data[i][4] // close
            ]);

            volume.push([
                data[i][0], // the date
                data[i][5] // the volume
            ]);
        }


        // create the chart
        $('#container').highcharts('StockChart', {

            rangeSelector: {
                selected: 1
            },

            title: {
                text: tittle
            },

            yAxis: [{
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Candlesticks'
                },
                height: '60%',
                lineWidth: 2
            }, {
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Volume'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            }],

            series: [{
                type: 'candlestick',
                name: StockName,
                data: ohlc,
                dataGrouping: {
                    units: groupingUnits
                }
            }, {
                type: 'column',
                name: 'Volume',
                data: volume,
                yAxis: 1,
                dataGrouping: {
                    units: groupingUnits
                }
            }]
        });
    });
});
	
}

		</script>
	</head>
	<body>
<script src="highstock.js"></script>
<script src="exporting.js"></script>


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
   
        
<script type="text/javascript">
var stockname = "<?php echo $stockname; ?>"; 
HistoricalChart(stockname);
</script>
<div id="container" style="height: 400px; min-width: 310px"></div>
	</body>
</html>

