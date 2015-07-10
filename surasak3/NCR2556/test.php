<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style>
/* only for demo */
body{font-size:16px;font-family:arial;padding:20px}label{cursor:pointer}div.col{float:left;width:50%}h1,h2, h3{font-weight:bold;margin:10px 0}h1{font-size:24px}h2{font-size:20px}p{margin:5px 0}h3{border-bottom:1px solid #ddd;padding-bottom:5px}
/* /only for demo */
 
 
/* RADIOS & CHECKBOXES STYLES */
 
/* base styles */
input[type="radio"],
input[type="checkbox"] {
height: 1.2em;
width: 1.2em;
vertical-align: middle;
margin: 0 0.4em 0.4em 0;
border: 1px solid rgba(0, 0, 0, 0.3);
background: -webkit-linear-gradient(#FCFCFC, #DADADA);
-webkit-appearance: none;
-webkit-transition: box-shadow 200ms;
box-shadow:inset 1px 1px 0 #fff, 0 1px 1px rgba(0,0,0,0.1);
}
 
/* border radius for radio*/
input[type="radio"] {
-webkit-border-radius:100%;
border-radius:100%;
}
 
/* border radius for checkbox */
input[type="checkbox"] {
-webkit-border-radius:2px;
border-radius:2px;
}
 
/* hover state */
input[type="radio"]:not(:disabled):hover,
input[type="checkbox"]:not(:disabled):hover {
border-color:rgba(0,0,0,0.5);
box-shadow:inset 1px 1px 0 #fff, 0 0 4px rgba(0,0,0,0.3);
}
 
/* active state */
input[type="radio"]:active:not(:disabled),
input[type="checkbox"]:active:not(:disabled) {
background-image: -webkit-linear-gradient(#C2C2C2, #EFEFEF);
box-shadow:inset 1px 1px 0 rgba(0,0,0,0.2), inset -1px -1px 0 rgba(255,255,255,0.6);
border-color:rgba(0,0,0,0.5);
}
 
/* focus state */
input[type="radio"]:focus,
input[type="checkbox"]:focus {
outline:none;
box-shadow: 0 0 1px 2px rgba(0, 240, 255, 0.4);
}
 
/* input checked border color */
input[type="radio"]:checked,
input[type="checkbox"]:checked {
border-color:rgba(0, 0, 0, 0.5)
}
 
/* radio checked */
input[type="radio"]:checked:before {
display: block;
height: 0.3em;
width: 0.3em;
position: relative;
left: 0.4em;
top: 0.4em;
background: rgba(0, 0, 0, 0.7);
border-radius: 100%;
content: '';
}
 
/* checkbox checked */
input[type="checkbox"]:checked:before {
font-weight: bold;
color: rgba(0, 0, 0, 0.7);
content: '\2713';
-webkit-margin-start: 0;
margin-left: 2px;
font-size: 0.9em;
}
 
/* disabled input */
input:disabled {
opacity: .6;
box-shadow: none;
background: rgba(0, 0, 0, 0.1);
box-shadow:none;
}
 
/* style label for disabled input */
input:disabled + label {
opacity: .6;
cursor:default;
-webkit-user-select: none;
}
</style>
</head>

<body>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Styling radios &amp; checkboxes using CSS3</title>
<link rel="stylesheet" media="screen" href="styles.css" >
</head>
<body>
<h1>Styling radios &amp; checkboxes using CSS3</h1>
<h2>*only for webkit</h2>
<div class="col">
<h3>Radios</h3>
<p><input type="radio" name="radio" id="radio1" /><label for="radio1">Radio 1 </label></p>
<p><input type="radio" name="radio" id="radio2" /><label for="radio2">Radio 2</label></p>
<p><input type="radio" name="radio" id="radio3" disabled /><label for="radio3">Radio 3 disabled</label></p>
<p><input type="radio" name="radio" id="radio4" disabled checked /><label for="radio4">Radio 4 disabled checked </label></p>
</div>
<div class="col">
<h3>Checkboxes</h3>
<p><input type="checkbox" name="checkbox1" id="checkbox1" /><label for="checkbox1">Checkbox 1 </label></p>
<p><input type="checkbox" name="checkbox2" id="checkbox2" /><label for="checkbox2">Checkbox 2 </label></p>
<p><input type="checkbox" name="checkbox3" id="checkbox3" disabled /><label for="checkbox3">Checkbox 3 disabled</label></p>
<p><input type="checkbox" name="checkbox4" id="checkbox4" disabled checked /><label for="checkbox4">Checkbox 4 disabled checked</label></p>
</div>
</body>
</html>
</body>
</html>