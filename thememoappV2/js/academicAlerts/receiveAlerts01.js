
function studentAjax() {
	var classes = document.getElementById("cName").value;
	var instructor = document.getElementById("iName").value;
	/*
	var classes = $('#cName').val();
	var instructor = $('#iName').val();
	*/
var xhr = new XMLHttpRequest();
var url = "../../backend/academicAlerts/receiveAlerts01.php?x=" + classes + "&y=" + instructor;
xhr.onreadystatechange = function() {
	if(xhr.readyState === 4 && xhr.status == 200) {
		var result = JSON.parse(xhr.responseText);
		console.log(result);
			var statusHTML = '<h3>Results</h3>';
			statusHTML += '<p>';
		for(var i = 0; i < result.length; i++) {

			statusHTML += '<a style= "display: block" href=displayAlerts02.html?id='+result[i].task_identification+'>'+result[i].class_instructor+ ' , ' + result[i].university_name + '</a>';
			statusHTML += " ";
			statusHTML += '</br>';
			
			
		}
			statusHTML += '</p>';	
			document.getElementById("answer").innerHTML = statusHTML;

	}
};

	

xhr.open('GET', url, true);


xhr.send();

}

