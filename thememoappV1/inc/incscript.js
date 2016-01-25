//=========================================
//			Glow Effect
//=========================================
$(document).ready(function(){
    $("a, li, input").mouseenter(function(){
        $(this).fadeTo('fast', 1);
    });
    $("a, li, input").mouseleave(function(){
        $(this).fadeTo('fast', 0.75);
    });
});

//=========================================
//			searchSyllabus.php
//=========================================

function validate() {
	
  var proValue = $( "#professorField" ).val();
  var classValue = $("#classField").val();
	if(proValue != "" || classValue != "") {
		
		return true;
		
	} else {
		
		$(".error_message").append("<p style='color: red; text-align: center'>Please fill in one of the fields</p>");
		
		return false;
	}
	
}
validate();


//=========================================
//			uploadSyllabusSuccess.php
//=========================================

function validateCreator() {
	var phoneNumb = $('#phoneNum').val();
	var email = $('#emailAddr').val();
	var american = $('#amProvider').val();
	var canadian = $('#caProvider').val();
	
	if(phoneNumb.length != 0 || email.length != 0 ) {
		if(phoneNumb.length > 0) {
			if((american != "USA" && canadian != "Canada") || (american == "USA" && canadian == "Canada")) {
				$(".signUpError").append("<p style='color: red; text-align: center'>Please select only 1 provider</p>");
				return false
			} else {
				return true;
			}
		}
	} else {
		$(".signUpError").append("<p style='color: red; text-align: center'>Please fill in a phone number and/or an email</p>");
		return false;
	}
	
}

validateCreator();














