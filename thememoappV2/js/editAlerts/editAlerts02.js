	/*=================================================================
							Grab all the saved input to be sent to editAlerts02.php
			1. For loop will run through every checked value
				1a. if checked, all content within will be recorded w/ their autoincrement id
				1b. Check to see if there was any edit on the uni, instructor or class info
					- Grab the identification number along with the saved edits
			2. xhr to be posted to the database and you will be brought to a new page that will
			show the new changes displayed in the traditional format
			
	=================================================================*/
	var days = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "27", "28", "29", "30", "31", "32"];
	var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	var years = ["2015", "2016"];
	 var total = '';
	var totalQry ='';
	var idQry = '';
	var classIdentification = '';
	var url = window.location.search;
			url = url.replace("?task=", ''); //? used to be there


	/*
	var classes = $('#cName').val();
	var instructor = $('#iName').val();
	*/
			var xhr = new XMLHttpRequest();
			var url = "../../backend/editAlerts/editAlerts02.php?id=" + url;
		
			xhr.onreadystatechange = function() {
				if(xhr.readyState === 4 && xhr.status == 200) {
					var result = JSON.parse(xhr.responseText);
					console.log(result);
					
					total = result.length;
					totalQry = '&total='+total;
					var j = 0
					var statusHTML = '<h3>' +'Alerts for ' + result[j].instructor + '</h3>';
					var taskNum = 'task';
					
					
					statusHTML += ' ';
					
					for(var i = 0; i < result.length; i++) {
					idQry += '&id' + i + '='+result[i].id;
					classIdentification = '&identification=' + result[j].identification;
					//text field
					statusHTML += '<p style="display: block">Task</p>';
					statusHTML += '<input type="text" id="'+ taskNum + i +'" value="'+ result[i].task + '">'; //Note: close with " and then ' to grab full value
					// date dropdown
					statusHTML += '<p style="display: inline">'  + 'Original Date: ' + result[i].day + '/' + result[i].month + '/' + result[i].years + '</p>';
					statusHTML += ' ';
					statusHTML += '<label>Day</label>';
							statusHTML += '<select id = days' + i +'>';
							statusHTML += '<option value =' + result[i].day + '>' + result[i].day + '</option>';
							for(var d = 1; d <= days.length; d++ ) {
								statusHTML += '<option value=' + d + '>' + d + '</option>';
							}
							statusHTML += '</select>';
						
							//Creates Month dropdown
							statusHTML += '<label>Month</label>';
							statusHTML += '<select id = months' + i + '>';
							statusHTML += '<option value =' + result[i].month + '>' + result[i].month + '</option>'; //Add the result day
							for(var m = 0; m < months.length; m++) {
								statusHTML += '<option value=' + months[m] + '>' + months[m] + '</option>';
							}
							statusHTML += '</select>';
						
							//Creates Year dropdown
							statusHTML += '<label>Year</label>';
							statusHTML += '<select id = years' + i +'>';
							statusHTML += '<option value =' + result[i].years + '>' + result[i].years + '</option>';
							for(var y = 0; y < years.length; y++) {
								statusHTML += '<option value=' + years[y] + '>' + years[y] + '</option>';
							}
							statusHTML += '</select>';
					statusHTML += " ";

					
					statusHTML += '<hr>';
				
			
		}
			statusHTML += '<label>Instructor & University</label>';
			statusHTML += '<p style= "display: inline">' + result[j].instructor + ' ' + result[j].university + '</p>';
			statusHTML += ' ';

			statusHTML += '<label style="display: block">Instructor & Class</label>';
			statusHTML += '<input type="text" id="instructor" value="' + result[j].instructor + '">';

			statusHTML += '<label style="display: block">University</label>';

			statusHTML += '<input type="text" id="university" value="' + result[j].university + '">';
			
			
			document.getElementById("answer").innerHTML = statusHTML;
			console.log(classIdentification);
		}


	};


	

			xhr.open('GET', url, true);


			xhr.send();
		
	/*=========================================================
					When the saveEdit button is clicked
						Process saved data
	1. Record all variables
	2. Run a for loop converting all variables into retrievable ids
	3. If statement to control whether qry string carries the '&'
	4. Run loop to store everything in a qryString
	5. xhr time
	==========================================================*/
		function saveEdit() {
			//1	
			var taskEdit ='';
			var taskID= '';
			var dateEdit = '';
			var word = '';
			var qryString = '';
			var days = '';
			var months = '';
			var years = '';
			//sql variables
			var dayQry = '';
			var monthQry = '';
			var yearQry = '';
			var instructorQry = '&instructor=';
			var uniQry = '&uni=';
			//id for dates
			var dayID = ''
			var monthID = '';
			var yearID = '';
			var uniID = 'university';
			var instructorID = 'instructor';
			
				
			
			for(var i = 0; i < total; i++) {
				//2
				dayID = 'days'+i;
				monthID = 'months'+i;
				yearID = 'years'+i;
				taskID = 'task' + i;

				//3
				if(i == 0) {
					taskEdit = 'task' + i + '=';
					dayQry = '&day'+i+'=';
					monthQry = '&month'+i+'=';
					yearQry = '&year'+i+'=';
					
				} else {
					taskEdit = '&task' + i + '=';
					dayQry = '&day'+i+'=';
					monthQry = '&month'+i+'=';
					yearQry = '&year'+i+'=';
				}

				//4
				qryString += taskEdit + document.getElementById(taskID).value;
				qryString += dayQry + document.getElementById(dayID).value;
				qryString += monthQry + document.getElementById(monthID).value;
				qryString += yearQry + document.getElementById(yearID).value;
			}
				qryString += instructorQry + document.getElementById(instructorID).value;
				qryString += uniQry + document.getElementById(uniID).value;
				qryString += idQry;
				qryString += classIdentification;
				qryString += totalQry;
					//console.log(qryString);
			
			var xhr = new XMLHttpRequest();
			var url = "../../backend/editAlerts/editAlerts03.php";
			
			xhr.onreadystatechange = function() {
				if(xhr.readyState === 4 && xhr.status == 200) {
					//var result = JSON.parse(xhr.responseText);
					console.log(qryString);
					window.location.href="../../frontend/academicAlerts/displayAlertsSuccess03.html";
				}	


			};
			
			xhr.open('POST', url, true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

			xhr.send(qryString);			
		}