<?php
/*

getData.php

A Request that expects a variable sent via POST named "searchFormName" and "searchFormDataSource". This loads the appropriate DataSource and uses that DataSource to search for information and echo the results

*/
	
	// for sanitizing POST variables
	require_once(dirname(dirname(__FILE__)) . "/ExternalScripts/HTMLPurifier/HTMLPurifier.standalone.php");

	// autoload magic expects DataSource adapters to be located in a folder with the same className in a class with the same name
	function __autoload($className) {
		require_once(dirname(dirname(__FILE__)) . "/DataSources/$className/$className.php");
	}
	
	$purifier = new HTMLPurifier();
	
	$searchFormDataSource = $purifier->purify($_POST['searchFormDataSource']);
	$searchFormFirstName = $purifier->purify($_POST['searchFormFirstName']);
	$searchFormLastName = $purifier->purify($_POST['searchFormLastName']);
	
	$dataSource = new $searchFormDataSource();

	$data = $dataSource->getData($searchFormFirstName, $searchFormLastName);
	
	echo $data;
?>