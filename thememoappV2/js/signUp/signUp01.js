/*=============================================================
	Grab values in sign up form, verify and submit them to server
1. Collect values from input forms
2. Validate
3. Create user id 
4. AJAX
=============================================================*/
function signUp() {
	//1
	var email = document.getElementById('email').value;
	var pass = document.getElementById('password').value;
	var rep = document.getElementById('repPassword').value;
	var check = document.getElementById('check').checked;
	
	//2 check to make sure everything is filled in
	if(email == "" || pass == "" || rep == "") {
		var statusHTML = '<label style="color: red">Please fill in all fields</label>';
		document.getElementById('error').innerHTML = statusHTML;
		return false;
	}
	
	//2 check to see if passwords match
	if(pass != rep) {
		var statusHTML = '<label style="color: red">Both passwords do not match</label>';
		document.getElementById('error').innerHTML = statusHTML;
		return false;
	}
	//3
	var id = '';
	var randomInt = '';
	var randomLet = '';
	var randomNum = Math.floor((Math.random()*5) + 1)
	var numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
	var letters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "p", "q"];
	
	for(var j = 0; j < 5; j++) {
		randomInt = Math.floor((Math.random()*9) + 1);
		randomLet = Math.floor((Math.random()*15) + 1);
		id += numbers[randomInt];
		id+= letters[randomLet];
	}
	id += numbers[randomNum];
	id += letters[randomNum];
	
	//4
	var statement = '';
	statement += "&email=" + email + "&pass=" + pass + "&rep=" + rep + "&teacher=" + check + "&identification=" + id;
	console.log(statement);
						
	var xhr = new XMLHttpRequest();
	var url = "backend/signUp/signUp01.php";
												
	xhr.onreadystatechange = function() {
		if(xhr.readyState === 4 && xhr.status == 200) {
			if(check == true) {
				window.location.href="frontend/controlPanel/controlPanel.html";
			} else {
				window.location.href="frontend/academicAlerts/receiveAlertsEveryone.html";
			}
			console.log("The ready state has occurred and this is the url");
			console.log(url);
		}
	};
	xhr.open('POST', url, true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(statement);
	
	

}