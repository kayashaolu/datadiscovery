<?php
/*

RapleafDataSource.php

RapleafDataSource extends AbstractDataSource in order to query Rapleaf for information.	

*/

require_once(dirname(dirname(__FILE__)) . "/AbstractDataSource.php");

class RapleafDataSource extends AbstractDataSource {
		
	public function __construct() {
	}
	
	// retrieves data from $query using the Rapleaf api, and formats it in the format defined in AbstractDataSource
	public function getData($first, $last) {
		
		$result = $this->makeAPICall($first, $last);
	
		$data = '<response><row>';
		
		// if $result is false, we could not get a response from the api
		if ($result === false) {
			$data .= '<notice>The API is down for the moment</notice>';
		}
		
		// no results
		else if (sizeof($result) == 0 ) {
			$data .= '<notice>There are no results</notice>';
		}
		
		// process information
		else {
		
			foreach($result as $key => $value) {
				$data .= "<$key>$value</$key>";
			}
		}
				
		$data .= '</row></response>';
		
		return $data;
	}
	

	// makes an call to Rapleaf
	protected function makeAPICall($first, $last) {
		$url = $this->getConfigValue('apiStem') .
			"?api_key=" . $this->getConfigValue('apiKey') .
			"&first=" . urlencode($first) .
			"&last=" . urlencode($last) .
			"&show_available=true";
		
		$ret_json = $this->callURL($url);
		$users = json_decode($ret_json, true);
		return $users;
	}

}
?>