		//Global variables
		var taskLength = "";
		var phoneTransfer = "";
		var emailTransfer = "";
		function checkClass() {
		/*===========================================================================
								Use contact info to pull relevant classes
		1. grab phone number and or email
		2. start XHR
		3. Display classes w/ check boxes
		===========================================================================*/
		//1
		var phoneNum = document.getElementById("phone_number").value;
		var email = document.getElementById("email").value;
		phoneTransfer = document.getElementById("phone_number").value;
		emailTransfer = document.getElementById("email").value;
		//2
		var xhr = new XMLHttpRequest();
		var url = "../../backend/editAlerts/deleteAlerts01.php?phoneNum=" + phoneNum + "&email=" + email;
		xhr.onreadystatechange = function() {
		if(xhr.readyState === 4 && xhr.status == 200) {
			//3
			var result = JSON.parse(xhr.responseText);
					console.log("This is the result from the server");
					console.log(result);
					console.log("This was the url sent");
					console.log(url);
			
					var j = 0
					var statusHTML = '<h3> Check the class and click "stop receiving alerts" </h3>';
			//stringTask += '<input type="checkbox" id="daysNotified1" class="check" value="1">1| ';
					//statusHTML += '<p>';
					var classNum = "";
					for(var i = 0; i < result.length; i++) {
					classNum = "Class"+i;
					statusHTML += '<input type="checkbox" id=' + classNum + ' value='+ result[i].task_identification +'>' + result[i].class_instructor;
					statusHTML += " ";
					statusHTML += '<hr>';
					
					taskLength = i;
		}
			//statusHTML += '</p>';	
			statusHTML += '<button onclick="deleteClass()">Stop Receiving Alerts</button>';
			document.getElementById("answer").innerHTML = statusHTML;
			//window.location.href="displayAlertsSuccess03.html";
			
			console.log("The ready state has occurred");

		}


	};


	

xhr.open('GET', url, true);


xhr.send();
		}
			
		function deleteClass() {
		
		/*================================================================
							Record all the checked classes and POST to server
		1. Run a loop checking for all the checked checkboxes
		2. Record qry for server submission
		3. xhr 
		================================================================*/
			var classNumber = ""
			var qry = "";
			//1
			for(var u = 0; u <= taskLength; u++) {
				classNumber = "Class"+u;
				if(document.getElementById(classNumber).checked == true) {
					if(u == 0) {
						qry += classNumber + '=' + document.getElementById(classNumber).value;
					} else {
						qry += '&' + classNumber + '=' + document.getElementById(classNumber).value;
					}
				}
			}
			//2
			qry += '&numOfClasses=' + taskLength + '&phoneTransfer=' + phoneTransfer + '&emailTransfer=' + emailTransfer;
			
			//3

			var xhr = new XMLHttpRequest();
			var url = "../../backend/editAlerts/deleteAlerts02.php";
						
						
			xhr.onreadystatechange = function() {
				if(xhr.readyState === 4 && xhr.status == 200) {
					//var result = JSON.parse(xhr.responseText);
					window.location.href="../academicAlerts/displayAlertsSuccess03.html";
					console.log("The ready state has occurred and this is the url");
					console.log(url);

				}


			};

			xhr.open('POST', url, true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

			xhr.send(qry);
		}
		