<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->

<?php session_start();
@$username=$_SESSION["username"];
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
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

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	
		<?php

		// Connect to the database
		$conn = @mysql_connect("localhost","root","");
		if (!$conn){
			die("Failed to connect database£º" . mysql_error());
		}
		$db=mysql_select_db("se", $conn);
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
							<li class="active"><a href="index.php" title="Homepage dashboard"><span class="icon-home"></span> Home</a></li>
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
		
			<!-- Secondary navigation in hero unit -->
			<div class="hero-unit blow">
				<h1>Stock Forecasting</h1>
				<p>Welcome to Group #2 Stock Forecasting System!</p>
				<div class="nav-secondary inverse">
					<nav>
						<ul>
							<li><a class="wuxify-me" href="figure.php"><span class="icon-signal"></span>Figure</a></li>
							<li><a class="wuxify-me" href="query_se.php"><span class="icon-picture"></span>Query</a></li>
							<li><a class="wuxify-me" href="Prediction.php"><span class="icon-file"></span>Predict</a></li>
							<li><a class="wuxify-me" href="news.php"><span class="icon-font"></span>News</a></li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /Secondary navigation in hero unit -->
			
			<!-- Main data container -->
			<div class="content">
			
				<!-- Page header -->
				<div class="page-header">
					<h1>Welcome, <?php
						                if($username!="") echo $username;
                						else echo "Visitor";?>
                						</h1>
				</div>
				<!-- /Page header -->
				
			</div>
			<!-- /Main data container -->
			
		</div>
		<!-- /Main content -->

		<!-- Scripts -->
		<script src="js/navbar.js"></script>
		<script src="js/plugins/waypoints.min.js"></script>
		<script src="js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap/bootstrap-dropdown.js"></script>
		<script src="js/bootstrap/bootstrap-collapse.js"></script>
		
		<!-- jQuery Flot Charts -->
		<!--[if lte IE 8]>
			<script language="javascript" type="text/javascript" src="js/plugins/flot/excanvas.min.js"></script>
		<![endif]-->
		<script src="js/plugins/flot/jquery.flot.js"></script>
		<script src="js/plugins/flot/jquery.flot.pie.js"></script>
		
		<!-- jQuery DataTable -->
		<script src="js/plugins/dataTables/jquery.datatables.min.js"></script>
		<script>
			/* Default class modification */
			$.extend( $.fn.dataTableExt.oStdClasses, {
				"sWrapper": "dataTables_wrapper form-inline"
			} );
			
			/* API method to get paging information */
			$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
			{
				return {
					"iStart":         oSettings._iDisplayStart,
					"iEnd":           oSettings.fnDisplayEnd(),
					"iLength":        oSettings._iDisplayLength,
					"iTotal":         oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
					"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
				};
			}
			
			/* Bootstrap style pagination control */
			$.extend( $.fn.dataTableExt.oPagination, {
				"bootstrap": {
					"fnInit": function( oSettings, nPaging, fnDraw ) {
						var oLang = oSettings.oLanguage.oPaginate;
						var fnClickHandler = function ( e ) {
							e.preventDefault();
							if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
								fnDraw( oSettings );
							}
						};
			
						$(nPaging).addClass('pagination').append(
							'<ul>'+
								'<li class="prev disabled"><a href="#"><span class="icon-caret-left"></span> '+oLang.sPrevious+'</a></li>'+
								'<li class="next disabled"><a href="#">'+oLang.sNext+' <span class="icon-caret-right"></span></a></li>'+
							'</ul>'
						);
						var els = $('a', nPaging);
						$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
						$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
					},
			
					"fnUpdate": function ( oSettings, fnDraw ) {
						var iListLength = 0;
						var oPaging = oSettings.oInstance.fnPagingInfo();
						var an = oSettings.aanFeatures.p;
						var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);
			
						if ( oPaging.iTotalPages < iListLength) {
							iStart = 1;
							iEnd = oPaging.iTotalPages;
						}
						else if ( oPaging.iPage <= iHalf ) {
							iStart = 1;
							iEnd = iListLength;
						} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
							iStart = oPaging.iTotalPages - iListLength + 1;
							iEnd = oPaging.iTotalPages;
						} else {
							iStart = oPaging.iPage - iHalf + 1;
							iEnd = iStart + iListLength - 1;
						}
			
						for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
			
							// Add / remove disabled classes from the static elements
							if ( oPaging.iPage === 0 ) {
								$('li:first', an[i]).addClass('disabled');
							} else {
								$('li:first', an[i]).removeClass('disabled');
							}
			
							if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
								$('li:last', an[i]).addClass('disabled');
							} else {
								$('li:last', an[i]).removeClass('disabled');
							}
						}
					}
				}
			});
			
			/* Table #example */
			$(document).ready(function() {
				$('.datatable').dataTable( {
					"sDom": "<'row'<'span4'l><'span4'f>r>t<'row'<'span4'i><'span4'p>>",
					"sPaginationType": "bootstrap",
					"oLanguage": {
						"sLengthMenu": "_MENU_ records per page"
					}
				});
			});
		</script>
		
		
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
