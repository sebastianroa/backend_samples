//searchSyllabus.php
function validate() {
	
  var proValue = $( "#professorField" ).val();
  var classValue = $("#classField").val();

	
	if(false) {
		$( "p" ).html( "its been left empty");
	} else {
		$( "p" ).html( "<b>Value:</b> " + proValue);
		$( "p" ).html( "<b>Value:</b> " + classValue);
	}
}

validate();