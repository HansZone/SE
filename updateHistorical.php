<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->
<?php
	include_once 'dbConnection.php';
	include_once 'query.php';
	include_once 'stockRetriever.php';
	include_once 'stockExtractor.php';
	
	//set time zone
	date_default_timezone_set('America/New_York');
	//instantiate necessary objects
	$dbConnection = new dbConnection();
	$query = new query();
	$stockRetriever = new stockRetriever();
	$stockExtractor = new stockExtractor();
	
	//connect to database
	$dbConnection->connect();
	//get last date of historical prices for every stock
	$dbConnection->prepare($query->get_last_date());
	$date = $dbConnection->resultSet();
	$last_date=$date[0]['recentDate'];
    // $last_date=2017/03/22;
    // get stock id, ticker and name
	$dbConnection->prepare($query->get_stockID_ticker_name());
	$results = $dbConnection->resultset();
	//for each stock
	foreach ($results as $stock) {
		//if the most recent date does not equal todays date
		if ($last_date != date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))))) {
			//startdate is most recent date + 1
			$startDate = strtotime("+1 day", strtotime($last_date));
			$startDate = date("Y/m/d", $startDate);
			//retrieve historical prices
			$document = $stockRetriever->retrieveHistorical($stock['Ticker'], $startDate, date('Y/m/d'));
			//extract historical prices
			$stockExtractor->extractHistorical($document, $stock['StockID'],$stock['name']);
		}
	}
	//disconnect from database
	$dbConnection->disconnect();
?>