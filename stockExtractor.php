<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->
<?php

	include_once "dbConnection.php";
	include_once "query.php";
	date_default_timezone_set('America/New_York');
	class stockExtractor {
		private $dbConnection; //dbConnection object
		private $query; //query object
		
		//constructor creates dbConnection and query object
		public function __construct() {
			$this->dbConnection = new dbConnection();
			$this->query = new query();
		}
		
		//extract historical prices where $document is a CSV file of historical prices and $stockID is the ID for the given stock
		public function extractHistorical($document, $stockID,$name) {			
			//used to ignore first line of CSV file
			$isFirst = true;
			//parse CSV file into lines
			$sourceLines = str_getcsv($document, "\n");
			//connect to database
			$this->dbConnection->connect();
			//prepare insertion statement
			echo $name," ";
			$this->dbConnection->prepare($this->query->insert_historical($name));
			//for each line
			foreach($sourceLines as $line) {
				//parse contents of each line into an array
				$contents = str_getcsv( $line );
				//skip first line
				if ($isFirst) {
					$isFirst = false;
					continue;
				}				
				//bind necessary values to SQL statement
				$this->dbConnection->bind(1, $stockID);
				$this->dbConnection->bind(2, $contents[0]);
				$this->dbConnection->bind(3, $contents[1]);
				$this->dbConnection->bind(4, $contents[2]);
				$this->dbConnection->bind(5, $contents[3]);
				$this->dbConnection->bind(6, $contents[4]);
				$this->dbConnection->bind(7, $contents[5]);			
				//execute query
				$this->dbConnection->execute();
			}
			//disconnect from databases
			$this->dbConnection->disconnect();
		}
		
		public function extractCurrentPrice($document, $stockID,$name) {
			$contents = str_getcsv($document);
			//connect to database
			$this->dbConnection->connect();
			//prepare statement
			$this->dbConnection->prepare($this->query->update_price());
			//bind values to SQL statement
			$this->dbConnection->bind(1, $contents[0]);
			$this->dbConnection->bind(2, time());
			$this->dbConnection->bind(3, $contents[1]);
			$this->dbConnection->bind(4, $stockID);
			//execute query
			$this->dbConnection->execute();

			// realtime update
			$this->dbConnection->prepare($this->query->update_realtime($name));
			//bind values to SQL statement
			$this->dbConnection->bind(1, $stockID);
			$this->dbConnection->bind(2, date("Y/m/d",time()));
			$this->dbConnection->bind(3, date("H:i:s",time()));
			$this->dbConnection->bind(4, $contents[0]);
			$this->dbConnection->bind(5, $contents[1]);
			$this->dbConnection->execute();
			//disconnect from database
			$this->dbConnection->disconnect();
		}
	}
	
	?>