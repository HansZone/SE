<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->

<?php
	include_once 'dbConnection.php';
	include_once 'query.php';
	include_once 'stockRetriever.php';
	include_once 'stockExtractor.php';
	
	set_time_limit(0);
	ignore_user_abort(false);
	//instantiate necessary objects
	$dbConnection = new dbConnection();
	$query = new query();
	$stockRetriever = new stockRetriever();
	$stockExtractor = new stockExtractor();
	//conect to database
	$dbConnection->connect();
	//get stockID , ticker and  of all stocks
	$dbConnection->prepare($query->get_stockID_ticker_name());
	$results = $dbConnection->resultset();
	//disconnect from database
	$dbConnection->disconnect();
	
	// every 50s retrieve the data
	do {		
		//for each stocks
		foreach ($results as $stock) {
			//retrieve current price
			$document = $stockRetriever->retrieveCurrentPrice($stock['Ticker']);
			//extract current price
			$stockExtractor->extractCurrentPrice($document, $stock['StockID'],$stock['name']);
			
		}
		usleep(50000000);
	}while (true);
	
?>