var url = window.location.search;
			url = url.replace("?id=", ''); //? used to be there

	/*
	var classes = $('#cName').val();
	var instructor = $('#iName').val();
	*/
			var xhr = new XMLHttpRequest();
			var url = "../../backend/academicAlerts/displayAlerts02.php?id=" + url;
			xhr.onreadystatechange = function() {
				if(xhr.readyState === 4 && xhr.status == 200) {
					var result = JSON.parse(xhr.responseText);
					console.log(result);
					var j = 0
					var statusHTML = '<h3>' +'Alerts for ' + result[j].instructor + '</h3>';
					statusHTML += '<p>';
					for(var i = 0; i < result.length; i++) {
					statusHTML += '<p style= "display: block">' + result[i].task + '</p>';
					statusHTML += " ";
					statusHTML += '<p style= "display: block">'+ result[i].day + '/' + result[i].month + '/' + result[i].years + '</p>';
					statusHTML += '<hr>';
					
			
					}
					
			statusHTML += '</p>';	
			document.getElementById("answer").innerHTML = statusHTML;
		}


	};


	

			xhr.open('GET', url, true);


			xhr.send();