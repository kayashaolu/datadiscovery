<?php
/*

TwitterDataSource.php

TwitterDataSource extends AbstractDataSource in order to query Twitter for information.	

*/

require_once(dirname(dirname(__FILE__)) . "/AbstractDataSource.php");

class TwitterDataSource extends AbstractDataSource {
		
	public function __construct() {
	}
	
	// retrieves data from $query using the Twitter api, and formats it in the format defined in AbstractDataSource
	public function getData($first, $last) {
		
		$result = $this->makeAPICall($first, $last);
		
		$data = '<response>';
		
		// if $result is false, we could not get a response from the api
		if ($result == false) {
			$data .= '<row><notice>The API is down for the moment</notice></row>';
		}
		
		// no results
		else if (sizeof($result["results"]) == 0) {
			$data .= '<row><notice>There are no results</notice></row>';
		}
		
		// process information
		else {
		
			foreach($result["results"] as $row) {
				$data .= '<row>';
				
				$data .= "<fromUser>{$row['from_user']}</fromUser>";
				$data .= "<text>{$row['text']}</text>";
				
				$data .= '</row>';
			}
		}
						
		$data .= '</response>';
		
		return $data;
	}
	

	// makes an call to Twitter
	protected function makeAPICall($first, $last) {
		$url = $this->getConfigValue('apiStem') .
			"?q=" . urlencode("$first $last") .
			"&rpp=10";

		$ret_json = $this->callURL($url);
		$users = json_decode($ret_json, true);
		return $users;
	}

}
?>