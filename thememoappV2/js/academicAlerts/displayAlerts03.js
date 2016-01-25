//=============================================================================================================
//AJAX will retrieve class info w/ assignment names and due dates
//=============================================================================================================
		
//=============================================================================================================
//upload Contact will upload contact info and number of days into DB
//=============================================================================================================
	function uploadContact() {
	/*=============================================================================
	1. listOfDays - Holds the list of days user select to get alerted
	2. phoneNum && email - record the contact info of user
	3. if statements - will check to see if each checkbox has been checked and if so, save the 
					respective number into the listOfDays variable
	4. urls - unique class id to be sent to server
	5. AJAX time - POST data to displayAlertsUpload02.php and be redirected to displayAlertSuccess03.html
	
	==============================================================================*/
	//1
	var listOfDays = "";
		
	//2
	var phoneNum = document.getElementById("phone_number").value;
	var email = document.getElementById("email").value;
		
	 //3
	//Check for day 1 
	if(document.getElementById("daysNotified1").checked == true) {
		var day1 = document.getElementById("daysNotified1").checked;
		false;
		listOfDays += "1";
	}
	//Check for day 2
	if(document.getElementById("daysNotified2").checked == true) {
		var day2 = document.getElementById("daysNotified2").checked;
		false;
		listOfDays += "2";
	}
	//Check for day 3
	if(document.getElementById("daysNotified3").checked == true) {
		var day3 = document.getElementById("daysNotified3").checked;
		false;
		listOfDays += "3";
	}
	//Check for day 4
	if(document.getElementById("daysNotified4").checked == true) {
		var day4 = document.getElementById("daysNotified4").checked;
		false;
		listOfDays += "4";
	}
	//Check for day 5
	if(document.getElementById("daysNotified5").checked == true) {
		var day5 = document.getElementById("daysNotified5").checked;
		false;
		listOfDays += "5";
	}
	//Check for day 6
	if(document.getElementById("daysNotified6").checked == true) {
		var day6 = document.getElementById("daysNotified6").checked;
		false;
		listOfDays += "6";
	}
	//Check for day 7
	if(document.getElementById("daysNotified7").checked == true) {
		var day7 = document.getElementById("daysNotified7").checked;
		false;
		listOfDays += "7";
	}
		
	//4
	var urls = window.location.search;
	urls = urls.replace("?id=", ''); //? used to be there

	//5
		var xhr = new XMLHttpRequest();
		var url = "../../backend/academicAlerts/displayAlertsUpload02.php?phoneNum=" + phoneNum + "&email=" + email + "&days=" + listOfDays + "&syllabusID=" + urls;
		xhr.onreadystatechange = function() {
		if(xhr.readyState === 4 && xhr.status == 200) {
			//var result = JSON.parse(xhr.responseText);
			window.location.href="displayAlertsSuccess03.html";
			console.log("The ready state has occurred and this is the url");
			console.log(url);

		}


	};


	

xhr.open('GET', url, true);


xhr.send();

		console.log(phoneNum);
		console.log(email);
		console.log("Here are the list of days");
		console.log(listOfDays);
		console.log("And this is the class ID");
		console.log(urls);

		

	} 

