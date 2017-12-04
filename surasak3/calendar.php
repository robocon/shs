<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Calendar</TITLE>
<style type="text/css">
<!--
	td {font: 10px MS Sans Serif; color: #000000; BORDER-BOTTOM: #213BA7 solid thin;
	BORDER-LEFT: #213BA7 solid thin;BORDER-RIGHT:#213BA7 solid thin;BORDER-TOP: #213BA7 solid thin; background: #FFFFCC; width: 260px}
-->
</style>

<script language="javascript">
<!--

var test_it=location.search.substring(1);
var info = test_it.split(",");
var data_month=parseInt(info[0],10);
var data_year=parseInt(info[1],10);
var form_name=info[2]; 
var field_name=info[3]; 

var months=new Array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
var the_date= new Date();
var the_month=the_date.getMonth();
var the_date_number=the_date.getDate();
var the_year=the_date.getYear();
var the_day=the_date.getDay();

if (location.search.length >0 && data_year != 0)	{
	var the_month=data_month;
	var the_year=data_year;
}
var first_day= new Date(the_year,the_month,1);
var first_day=first_day.getDay();
var short_year=new String(the_year);
var short_year=short_year.slice(2,4);
var day_in_month=31;

if (the_month == 8 || the_month == 3 || the_month == 5 || the_month == 10)	{ 
	var day_in_month=30;
}

if (the_month==1)	{
	if (the_year%4 == 0)
		var day_in_month=29;
	else
		var  day_in_month=28;
}

var day_counter=1;
var i=0;
var the_year_show = the_year + 543;
var tm=the_month;
var ty=the_year;

document.write("<BR><center><SELECT NAME='tomonth' onchange='window.open(this.options[this.selectedIndex].value,\"_self\")'");
for (i=-1; i<12; i++) {
	tm=i;
	if (the_month == i) {
		document.write("<OPTION selected value='calendar.html?" + tm + "," +ty +  "," + form_name + "," + field_name +"'>"+months[i]+"</OPTION>");
	}
	else {
		document.write("<OPTION value='calendar.html?"+tm+"," +ty + "," + form_name + "," + field_name +"'>"+months[i]+"</OPTION>");
	}
}
document.write("</SELECT>&nbsp;");
document.write("<SELECT NAME='toyear' onchange='window.open(this.options[this.selectedIndex].value,\"_self\")'");
for (i=2509; i<=the_date.getYear()+553; i++) {
	ty=i-543;
	if (i==the_year_show){
		document.write("<OPTION selected value='calendar.html?"+the_month+"," +ty + "," + form_name + "," + field_name +"'>"+i+"</OPTION>");
	}
	else {
		document.write("<OPTION value='calendar.html?"+the_month+"," +ty + "," + form_name + "," + field_name +"'>"+i+"</OPTION>");
	}
}
document.write("</SELECT></center><BR>");
document.write("<table align='center' border='0' width='90%'>");
document.write("<tr>");
document.write("<td align='center' colspan='7'><b>" + months[the_month] + " " + the_year_show +"</b></td>");
document.write("</tr>");
document.write("<tr><td align='center'>S</td><td align='center'>M</td><td align='center'>T</td><td align='center'>W</td><td align='center'>Th</td><td align='center'>F</td><td align='center'>S</td></tr>");
document.write("<tr>");

for (i=0;i<(first_day);i++)	{
	document.write("<td></td>");
}

for (i=first_day;i<7;i++)	{
	var two_digit_year=new String(the_year+543);
	var two_digit_year=two_digit_year.slice(0,4);
	var the_date_string =  new String(day_counter) + "-" + new String(the_month+1)  +"-" + two_digit_year ;
	
	if (day_counter==the_date_number)			{
		document.write("<td align='center'><a href='#' onclick='window.opener.document." + form_name + "." + field_name + ".value=\"" + the_date_string + "\"; window.close();'><b>" + day_counter + "</a></b></td>");
	}
	
	if (day_counter != the_date_number)			{
		document.write("<td align='center'><a href='#' onclick='window.opener.document." + form_name + "." + field_name + ".value=\""+ the_date_string + "\"; window.close();'>" + day_counter + "</a></td>");	
	}
	
	var day_counter=day_counter + 1;
}

document.write("</tr>");
for (a=1;a<6;a++)	{
	document.write("<tr>");
	for (b=0;b<7;b++)			{
		var two_digit_year=new String(the_year+543);
		var two_digit_year=two_digit_year.slice(0,4);
		var the_date_string =  new String(day_counter) + "-" + new String(the_month+1)  +"-" + two_digit_year ;
	if (day_counter >= day_in_month)					{
			var b=7;
			var a=5;
		}
		if (day_counter==the_date_number)					{
			document.write("<td align='center'><a href='#' onclick='window.opener.document." + form_name + "." + field_name + ".value=\"" + the_date_string + "\"; window.close();'><b>" + day_counter + "</a></b></td>");
		}
		
		if (day_counter != the_date_number)					{
			document.write("<td align='center'><a href='#' onclick='window.opener.document." + form_name + "." + field_name + ".value=\"" + the_date_string + "\"; window.close();'>" + day_counter + "</a></td>");
		}
		
		var day_counter=day_counter + 1;
	}
	document.write("</tr>");
}

document.write("</table>");

// -->
</script>
</HEAD>
<BODY BGCOLOR="#99CCFF"   topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
</BODY>
</HTML>


