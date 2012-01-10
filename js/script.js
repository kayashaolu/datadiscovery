$(document).ready(function() {

	/* On search button click, send requests for every div with class dataSource (which indicates a dataSource that the client wants to search from) */
	$('#searchFormButton').click(function() {
	
	  var searchFormFirstName = $('#searchFormFirstName').val();
	  var searchFormLastName = $('#searchFormLastName').val();
	  
	  /* For each div that is of class dataSource, send a request to the corresponding datasource to search via the query terms we got from the form */
	  $('.dataSource').each(function() {	  
	  	  var searchFormDataSource = $(this).attr('id');
	  	    // show loading animation
	  	    $('#' + searchFormDataSource).html("");
		    $("#" + searchFormDataSource + "Loading").show();
		  		  
		  $.post("Requests/getData.php", { 'searchFormFirstName':searchFormFirstName, 'searchFormLastName':searchFormLastName, 'searchFormDataSource':searchFormDataSource }, function(data, textStatus, jqXHR) {
			
			/* Formats response from AbstractDataSource (in the format specified) for display in a browser 
			   Expecting format: 
			   	<response>
			   		<row>
			   			<key>value</key>
			   			<key>value</key>
			   		</row>
			   	</response>
			*/
			
		  	var text = '';
		  	$(data).find('row').each(function(){

		  		$(this).children().each(function(){
		  			text += '<strong>' + this.nodeName + '</strong>: <span>' + $(this).text() + '</span><br />';		  			
		  		})
		  		text+= '<hr />'
		  	});
		  	
		  	// hide losing information after result processing
		  	$("#" + searchFormDataSource + "Loading").hide();
		  	
		  	// show result 		  	
		  	$('#' + searchFormDataSource).html(text);
		  }, 'xml');
		  
	  });
	});
});