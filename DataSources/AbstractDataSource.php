<?php
/*

AbstractDataSource.php
	
Abstract base class that all DataSources must extend. Every DataSource source code must be in the folder "DataSources". Each DataSource must have its own folder which is named after the name of the datasource. For instance, for Facebook, a folder needs to be created inside DataSources called "FacebookDataSource" AbstractDataSource expects a "config.php" file as well as a main class named after the DataSource (i.e. facebookDataSource.php) in the same folder.


Author: Kay Ashaolu (kay.ashaolu@gmail.com)

*/
abstract class AbstractDataSource
{	
	// default constructor that must be used by all AbstractDataSources
	abstract public function __construct();
	
	/* returns any data that the datasource can find via searchParams
	   input: $query is a key/value array that the datasource expects
	   output: returns an xml document with a <reponse> root element that contains the results (delimited by <row>)
	   for exmaple:
	   <response>
	   	<row>
	   		<id>2323</id>
	   		<name>Kay</name>
	   	</row>
	   	<row>
	   		<id>4242</id>
	   		<name>Jared</name>
	   	</row>
	   </response>   
	 */
	abstract public function getData($first, $last);
	
	// returns configuration data from the key specified
	
	protected function getConfigValue($key) {	
	
		include(dirname(__FILE__) . "/" . get_class($this) .  "/config.php");
		return $config[$key];
	}
	
	// makes curl call
	// returns false on failed attempt
	protected function callURL($url)
	{
	    $ch = curl_init();
	    curl_setopt_array($ch, array(
	        CURLOPT_URL => $url,
	        CURLOPT_RETURNTRANSFER => true
	    ));
	 	
	    $result = curl_exec($ch);
	    curl_close($ch);
	    
	    return $result;
	}
	
}
?>