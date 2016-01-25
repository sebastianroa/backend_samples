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
		var url = "../../backend/editAlerts/editAlerts01.php?phoneNum=" + phoneNum + "&email=" + email;
		xhr.onreadystatechange = function() {
		if(xhr.readyState === 4 && xhr.status == 200) {
			//3
			var result = JSON.parse(xhr.responseText);
					console.log("This is the result from the server");
					console.log(result);
					console.log("This was the url sent");
					console.log(url);
			
					var j = 0
					var statusHTML = '<h3> Click the class you want to edit</h3>';
			//stringTask += '<input type="checkbox" id="daysNotified1" class="check" value="1">1| ';
					//statusHTML += '<p>';
					var classNum = "";
					for(var i = 0; i < result.length; i++) {
					classNum = "Class"+i;
					statusHTML += '<a href=editAlerts02.html?task=' + result[i].task_identification + '>' + result[i].class_instructor + '</a>';
					statusHTML += " ";
					statusHTML += '<hr>';
					
					taskLength = i;
		}
			//statusHTML += '</p>';	
			document.getElementById("answer").innerHTML = statusHTML;
			//window.location.href="displayAlertsSuccess03.html";
			
			console.log("The ready state has occurred");

		}


	};


	

xhr.open('GET', url, true);


xhr.send();
			}