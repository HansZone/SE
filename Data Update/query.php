<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->
<?php
	class query {
		
		//insert features into the historical prices table
		public function insert_historical($name) {
			return "INSERT INTO {$name}_historical (StockID, Date, Open, High, Low, Close, Volume) VALUES (?, STR_TO_DATE(?,'%Y-%m-%d'), ?, ?, ?, ?, ?)";
		}

		//get all stockIDs and tickers
		public function get_stockID_ticker_name() {
			return "SELECT StockID,Ticker, name FROM Stocks";
		}

		public function update_price() {
			return "UPDATE Stocks SET Price = ?, Time = ?, Volume = ? WHERE StockID = ?";
		}
		
		//get last inserted date for a given stockID
		public function get_last_date() {
			return "SELECT  MAX(Date) AS recentDate from facebook_historical GROUP BY StockID";
		}

		public function update_realtime($name) {
			return "INSERT INTO {$name}_realtime VALUES (?, ?, ?, ?, ?)";
		}
		
		public function get_history($name){
			return "SELECT open,close FROM {$name}_historical ORDER BY `date` DESC LIMIT 24";
		}
	}
?>