
				/*=======================================================
										Drop Down &  variables
					1.  Stores total amount of task entries in place & other globals
						1a. Holds important arrays for the form
					2. Activates the drop down
					=======================================================*/
					//1
					var num = 0;
					var total = 0;
					var task = "task";
					var day = "day";
					var month = "month";
					var tasks = "Task";
					var year = "year";
					//1a
					var days = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "27", "28", "29", "30", "31"];
					var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
					var years = ["2015", "2016"];
					//2
					var statusHTML = '<select id="taskDropDown">';
					
					for(var i = 1; i < 31; i++) {
					statusHTML += '<option value=' + i + '>' + i + '</option>';
					statusHTML += " ";		 				
					}
					statusHTML += '</select>';	
					document.getElementById("dropDown").innerHTML = statusHTML;
					
					/*=======================================================
										Create Task Fields
					1. Grab values of drop down
					2. Creates task w/ due dates
					3. Makes the edit buttons appear
					=======================================================*/
					function activateTask() {
						//1
						var dropDown = document.getElementById("taskDropDown").value;
						num = parseInt(dropDown);
						var buttonTool = '<button onclick="add()">Add an Entry</button>';
						buttonTool += '<hr>';
						buttonTool += '<button>Eliminate Last Entry</button>';

						//2 Create task w/ due dates
						var stringTask = '<div>';
						stringTask += '<p style="text-align: center">Fill in name of task and its respective due date</p>';
						stringTask += '<hr>';
						for(var j = 1; j <= num; j++) {
							stringTask += '<input type="text" id= uploadSyllabus' + j + ' placeholder = ' + tasks+j + ' style="border: 1px solid black">';
							//Creates day dropdown
							stringTask += '<label>Day</label>';
							stringTask += '<select id = days' + j +'>';
							for(var d = 1; d <= days.length; d++ ) {
								stringTask += '<option value=' + d + '>' + d + '</option>';
							}
							stringTask += '</select>';
							//Creates Month dropdown
							stringTask += '<label>Month</label>';
							stringTask += '<select id = months' + j + '>';
							for(var m = 0; m < months.length; m++) {
								stringTask += '<option value=' + months[m] + '>' + months[m] + '</option>';
							}
							stringTask += '</select>';
							//Creates Year dropdown
							stringTask += '<label>Year</label>';
							stringTask += '<select id = years' + j +'>';
							for(var y = 0; y < years.length; y++) {
								stringTask += '<option value=' + years[y] + '>' + years[y] + '</option>';
							}
							stringTask += '</select>';
							stringTask += '<hr>';
							total = j;
						}
						//Uni class and instructor name
						stringTask += '<p>Fill in the class, professor and university name</p>';
						stringTask += '<label>Class</label>';
						stringTask += '<input type="text" id="className" placeholder="Ex. ENG 101">';
						stringTask += '<label>Instructor</label>';
						stringTask += '<input type="text" id="professorName" placeholder="Ex. Smith">';
						stringTask += '<label>University</label>'
						stringTask += '<input type="text" id="uniName" placeholder="Ex. Auburn">';
						stringTask += '<hr>';
						//Contact info
						stringTask += '<p>Want to these receive alerts? Enter contact info below</p>';
						stringTask += '<label>Phone Number</label>';
						stringTask += '<input type="text" id="phoneNumber">';
						stringTask += '<label>Email</label>';
						stringTask += '<input type="text" id="email">';
						stringTask += '<hr>';
						// Check box for days
						
						stringTask += '<p>Check the number of days you would like to receive alerts before the due date</p>';
						stringTask += '<input type="checkbox" id="daysNotified1" class="check" value="1">1| ';
						stringTask += '<input type="checkbox" id="daysNotified2" class="check" value="2">2 | ';
						stringTask += '<input type="checkbox" id="daysNotified3" class="check" value="3">3 | ';
						stringTask += '<input type="checkbox" id="daysNotified4" class="check" value="4">4 | ';
						stringTask += '<input type="checkbox" id="daysNotified5" class="check" value="5">5 | ';
						stringTask += '<input type="checkbox" id="daysNotified6" class="check" value="6">6 | ';
						stringTask += '<input type="checkbox" id="daysNotified7" class="check" value="7">7 | ';
						
						stringTask += '<hr>';
						stringTask += '<button onclick="submitAlerts()">Submit</button>';
						stringTask += '</div>';
						document.getElementById("task").innerHTML = stringTask;

						//3
						//document.getElementById("taskTools").innerHTML = buttonTool;

					}
						
					/*=======================================================
										Submit info to server
					1. Hold variables
					2. Loop to grab all statements with task & due dates
					3. Grab all the checked days for submission
					
					=======================================================*/
					//1
					function submitAlerts() {
						var statement = "";
						var url = "";
						var stringHTML = "";
						//Stores variables
						var task = "";
						var dia = "";
						var mes = "";
						var ano = "";
						var combinedString = "";
						//Stores ids
						var taskID = "";
						var dayID = "";
						var monthID = "";
						var yearID = "";
						var className= document.getElementById("className").value;
						var proName = document.getElementById("professorName").value;
						var uniName = document.getElementById("uniName").value;
						var phoneNumber = document.getElementById("phoneNumber").value;
						var email = document.getElementById("email").value;
						var listOfDays = "";
						var qryTask = "";
						var qryDays = "";
						var qryMonths = "";
						var qryYears = "";
						
						proClassName = proName + " " + className;
						
						
						//2
						for(var u = 1; u <= total; u++) {
							taskID = 'uploadSyllabus' + u;
							dayID = 'days' + u;
							monthID = 'months' + u;
							yearID = 'years' + u;
							
							if(u > 1) {
								qryTask = '&uploadSyllabus'+u+'=';
							 } else {
								qryTask = 'uploadSyllabus'+u+'=';	
							 }
							qryDays= '&days'+u+'=';
							qryMonths= '&months'+u+'=';
							qryYears='&years'+u+'=';
								
							task = document.getElementById(taskID).value;
							dia = document.getElementById(dayID).value;
							mes = document.getElementById(monthID).value;
							ano = document.getElementById(yearID).value;
							
							statement += qryTask + task + qryDays + dia + qryMonths + mes + qryYears + ano;
							
						}

						 //3
						//Check for day 1 
						if(document.getElementById("daysNotified1").checked == true) {
							false;
							listOfDays += "1";
						}
						//Check for day 2
						if(document.getElementById("daysNotified2").checked == true) {
							false;
							listOfDays += "2";
						}
						//Check for day 3
						if(document.getElementById("daysNotified3").checked == true) {
							
							false;
							listOfDays += "3";
						}
						//Check for day 4
						if(document.getElementById("daysNotified4").checked == true) {
							
							false;
							listOfDays += "4";
						}
						//Check for day 5
						if(document.getElementById("daysNotified5").checked == true) {
							
							false;
							listOfDays += "5";
						}
						//Check for day 6
						if(document.getElementById("daysNotified6").checked == true) {
							
							false;
							listOfDays += "6";
						}
						//Check for day 7
						if(document.getElementById("daysNotified7").checked == true) {
							
							false;
							listOfDays += "7";
						}
												//3
						statement += "&totalEntries=" + num + "&instructor1=" + proClassName + "&uniInitials1=" + uniName + "&phone=" + phoneNumber + "&email=" + email + "&days=" + listOfDays;

						stringHTML +=  combinedString;
						/*
						console.log(stringHTML);
						console.log(className);
						console.log(proName);
						console.log(uniName);
						console.log(phoneNumber);
						console.log(email);
						console.log("Number of days");
						console.log(listOfDays);
						*/
						
					/*=======================================================
									Submit to server via XHR
										
					
					=======================================================*/	
						
						var xhr = new XMLHttpRequest();
						var url = "../../backend/academicAlerts/createAlerts01.php";
						
						
						xhr.onreadystatechange = function() {
							if(xhr.readyState === 4 && xhr.status == 200) {
								//var result = JSON.parse(xhr.responseText);
								window.location.href="displayAlertsSuccess03.html";
								console.log("The ready state has occurred and this is the url");
								console.log(url);

							}


						};

						/*
We are changing the task info to $_POST["uploadSyllabus".$i] - $_POST['days'.$i] - $_POST['months'.$i] - $_POST["years".$i]; 
						*/

						//var statement = "totalEntries=" + num + "&taskInfo=" + stringHTML + "&instructor1=" + proClassName + "&uniInitials1=" + uniName + "&phone=" + phoneNumber + "&email=" + email + "&days=" + listOfDays
						xhr.open('POST', url, true);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						//?"taskInfo=" + stringHTML + "&class=" + className + "&professor=" + proName + "&uni=" + uniName + "&phone=" + phoneNumber + "&email=" + email + "&days=" + listOfDays;
						xhr.send(statement);
					
					}
						
					//***********************UNDER CONSTRUCTION*****************************
					//***********************UNDER CONSTRUCTION*****************************
					/*=======================================================
					
										Add a task
					1. Gives total + 1 to label th new set of information correctly
					2. Adds the html to place a new entry
					3. Close html and load it into the document
					=======================================================*/					
					//function add() {
						
						//1
						/*
						var newTotal = total + 1;

						//2
						var addTask = '<div>';
						//input task
						addTask += '<input type="text" id=' + task + newTotal + ' placeholder = ' + tasks+newTotal + ' style="border: 1px solid black">';
						addTask += '</div>';
						
						

						document.getElementById("task").innerHTML += addTask;

						
						newTotal += 1;
						
						console.log(newTotal);
						*/
						//get rid of the form, you may have to have it under all one form instead of seperating it into 
						//Solution, you might have to store all the content in one variable and take away and add as necessary
						/*
						//day dropdown
						addTask += '<label>Day</label>';
						addTask += '<select id =' + day + newTotal +'>';
						for(var d = 1; d <= days.length; d++ ) {
							addTask += '<option value=' + d + '>' + d + '</option>';
						}
						addTask += '</select>';
						//month dropdown
						addTask += '<label>Month</label>';
						addTask += '<select id =' + month + newTotal + '>';
						for(var m = 0; m < months.length; m++) {
							addTask += '<option value=' + months[m] + '>' + months[m] + '</option>';
						}
						addTask += '</select>';
						//year dropdown
						addTask += '<label>Year</label>';
						addTask += '<select id ='+ year + newTotal +'>';
						for(var y = 0; y < years.length; y++) {
							addTask += '<option value=' + years[y] + '>' + years[y] + '</option>';
						
						
						
					}
						//3. 
					addTask = '</div>';
						document.getElementById("extra_task").innerHTML = addTask;
						*/
						
					//}
					/*=======================================================
										Delete a task

					=======================================================*/					
					//function eliminate() {
					
					//}
						
			
		