<?php
/*

FacebookDataSource.php

FacebookDataSource extends AbstractDataSource in order to query Facebook for information.	

*/

require_once(dirname(dirname(__FILE__)) . "/AbstractDataSource.php");

class FacebookDataSource extends AbstractDataSource {
		
	public function __construct() {
	}
	
	// retrieves data from $query using the Facebook api, and formats it in the format defined in AbstractDataSource
	public function getData($first, $last) {
		
		$result = $this->makeAPICall($first, $last);
		
		$data = '<response>';
		
		// if $result is false, we could not get a response from the api
		if ($result === false) {
			$data .= '<row><notice>The API is down for the moment</notice></row>';
		}
		
		// no results
		else if (sizeof($result["data"]) == 0) {
			$data .= '<row><notice>There are no results</notice></row>';
		}
		
		// process information
		else {
		
			foreach($result["data"] as $row) {
				$data .= '<row>';
				
				foreach($row as $key => $value) {
					$data .= "<$key>$value</$key>";
				}
				
				$data .= '</row>';
			}
		
		}
		
		$data .= '</response>';
		
		return $data;

	}
	
	// Retrieves access token needed for user search
	protected function getAccessToken() {
		
		$url = $this->getConfigValue('fbGetAccessTokenURL') . 
			'?client_id=' . urlencode($this->getConfigValue('appID')) .
			'&redirect_uri=' . urlencode($this->getConfigValue('appRedirectURI')) . 
			'&client_secret=' . urlencode($this->getConfigValue('appSecret')) .
			'&code=' . urlencode($this->getConfigValue('appCode'));
		

		$access_token = $this->callURL($url);
		$access_token = substr($access_token, strpos($access_token, "=")+1, strlen($access_token));
		
		return $access_token;
	
	}
	
	// makes an call to Facebook's graph API
	protected function makeAPICall($first, $last) {
		$access_token = $this->getAccessToken();
		$url = $this->getConfigValue('fbAPIURL') . 
			"?access_token=$access_token" .
			"&q=".urlencode("$first $last") . 
			"&type=user";
		$ret_json = $this->callURL($url);
		$users = json_decode($ret_json, true);
		return $users;
	}
	
}
?>