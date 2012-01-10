<!DOCTYPE html ->
<html>
<head>
	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection">
  	<link rel="stylesheet" href="css/print.css" type="text/css" media="print"> 
  	<!--[if lt IE 8]>
    	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection">
  	<![endif]-->
  	<link rel="stylesheet" href="css/style.css" type="text/css"> 
  	
  	<script type="text/javascript" src="js/jquery-min.js"></script>
  	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="container">
		<div class="span-24 last">
			<h1>Data Discovery</h1>
			<h2>Discover data via various APIs!</h2>
			<fieldset>
				<label for="searchFormFirstName">First Name</label>
				<input type="text" id="searchFormFirstName" name="searchFormFirstName" />&nbsp;
				<label for="searchFormLastName">Last Name</label>
				<input type="text" id="searchFormLastName" name="searchFormLastName" />
				<button name="searchFormButton"id="searchFormButton">Find</button>
			</fieldset>
		</div>
		
		<hr />
	
		<div class="span-7 colborder">
			<h1>Facebook</h1>
			
			<div id="FacebookDataSourceLoading" class="loadingPic">
			  <p><img src="img/ajax-loader.gif" /> Please Wait</p>
			</div>
			
			<div id="FacebookDataSource" class="span-5 last dataSource">
				
			</div>
		</div>
		
		<div class="span-7 colborder">
			<h1>Twitter</h1>
			
			<div id="TwitterDataSourceLoading" class="loadingPic">
			  <p><img src="img/ajax-loader.gif" /> Please Wait</p>
			</div>
			
			<div id="TwitterDataSource" class="span-5 last dataSource">
			
			</div>
		</div>
		
		<div class="span-8 last">
			<h1>Rapleaf</h1>
			
			<div id="RapleafDataSourceLoading" class="loadingPic">
			  <p><img src="img/ajax-loader.gif" /> Please Wait</p>
			</div>
			
			<div id="RapleafDataSource" class="span-5 last dataSource">
			
			</div>
		</div>
		
		<hr />
			
	</div>
</body>
</html>