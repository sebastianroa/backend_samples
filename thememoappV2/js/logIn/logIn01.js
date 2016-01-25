/*=====================================================
			Grab email and password and see if it matches
			the records on the db
1. Collect variables
2. Validate
3. Ajax
=====================================================*/

function logIn() {
	//1
	var email = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	
	//2 if empty
	if(email == "" || password == "") {
		var statusHTML = '<p style="color: red; text-align: center"> Please fill in both fields</p>';
		document.getElementById('error').innerHTML = statusHTML;
		return false;
	}
	//3 Ajax
	var xhr = new XMLHttpRequest();
	var url = "../../backend/logIn/logIn01.php?user="+email +"&password=" + password;
	xhr.onreadystatechange = function() {
		if(xhr.readyState === 4 && xhr.status == 200) {
			var result = JSON.parse(xhr.responseText);
			console.log(result);
			if(result[0].identification == "error"){
				var statusHTML = '<p style="color: red">Username or password does not match</p>';
				document.getElementById("error").innerHTML = statusHTML;
			} else {
				if(result[0].teacher == "true"){
					window.location.href="../../frontend/controlPanel/controlPanel.html";
				}
				if(result[0].teacher == "false"){
					window.location.href="../../frontend/academicAlerts/receiveAlertsEveryone.html";
				}
				}
			}
			
		};
			xhr.open('GET', url, true);
			xhr.send();	

	}
			
	


	

