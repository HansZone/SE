<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->
<?php
	class stockRetriever {
		//request URL for historical prices
		private $requestURL_historical = "http://ichart.yahoo.com/table.csv?s=";
		//request URL for current information
		private $requestURL_current = "http://download.finance.yahoo.com/d/quotes.csv?s=";
		//request URL for decsription
		private $requestURL_desc = "https://www.google.com/finance?q=";

		//get file from outside URL
		public function get_content($URL) {
            echo $URL;
            $data = file_get_contents($URL);
//			$ch = curl_init();
//			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_URL, $URL);
//			$data = curl_exec($ch);
//			curl_close($ch);
			return $data;
		}	
		
		//retrieve current price
		public function retrieveCurrentPrice($ticker) {
			//create URL
			$URL = $this->requestURL_current.$ticker."&f=l1v";

			//return CSV file
			return $this->get_content($URL);
		}	

		//retrieve historical prices for a $ticker from $startDate to $endDate and return CSV file
		public function retrieveHistorical($ticker, $startDate, $endDate) {
			//parse start date
			$startDate_ = explode("/", $startDate);

			//parse end date
			$endDate_ = explode("/", $endDate);
			//create URL
			$URL = $this->requestURL_historical.$ticker."&a=".($startDate_[1] - 1)."&b=".$startDate_[2]."&c=".$startDate_[0]."&d=".($endDate_[1] - 1)."&e=".$endDate_[2]."&f=".$endDate_[0];
			//return CSV file
//            $URL = 'http://ichart.yahoo.com/table.csv?s='.($ticker).'&a=3&b=22&c=1985&d=3&e=23&f=2017';
			return $this->get_content($URL);
			
		}	

	}
?>