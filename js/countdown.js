function cd() {
	//Date the Countdown is set to
	var timeevent = new Date("April 03, 2014 00:00:00");
	//Defining Time and Date right now
	var now = new Date();
	//Getting the Time Difference btw. the set date and the Date now
	var timeDiff = timeevent.getTime() - now.getTime();
	//Code to be executed if countdown finished 
	if (timeDiff <= 0) {
		clearTimout(timer);
			document.write("Template Countdown finished");
			//Additional code to run when Countdown finished
	}
	//Defining Seconds, Minutes, Hours and Days 
	var seconds = Math.floor(timeDiff / 1000);
	var minutes = Math.floor(seconds / 60);
	var hours = Math.floor(minutes / 60);
	var days = Math.floor(hours /24);
	//Defining Variables of Days, Hours, Minutes and Seconds to determine wether to display an additional "S" or not 
	var dd = "";
	var hh = "";
	var mm = "";
	var ss = "";
	//Modulers making sure hours, minutes and seconds don't exeed their maximum (24h, 60m, 60s), passing it to the next possible variable
	hours %=24;
	minutes %= 60;
	seconds %=60;
	//Logic to determine wether to display an additional "s" or not example: 10 Days / 1 Day
	if (seconds == 1) {
		ss = "Second"; }
		else ss = "Seconds";
	if (minutes == 1) {
		mm = "Minute"; }
		else mm = "Minutes";
	if (hours == 1) {
		hh = "Hour"; }
		else hh = "Hours";
	if (days == 1) {
		dd = "Day"; }
		else dd = "Days";	
	//Output of Numbers into HTML ID
	document.getElementById("daysBox").innerHTML = days;
	document.getElementById("hoursBox").innerHTML = hours;
	document.getElementById("minsBox").innerHTML = minutes;
	document.getElementById("secsBox").innerHTML = seconds;
	//Output of Labels into HTML ID
	document.getElementById("ddBox").innerHTML = dd;
	document.getElementById("hhBox").innerHTML = hh;
	document.getElementById("mmBox").innerHTML = mm;
	document.getElementById("ssBox").innerHTML = ss;
	var timer = setTimeout('cd()',1000);
}
