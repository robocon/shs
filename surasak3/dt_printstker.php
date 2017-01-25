<?php
session_start();

// Default time
$time = 10000;

if($_SESSION["sIdname"] == "md19921"){
	$time = 2000;
}else if($_SESSION['sIdname'] == 'md38220' OR $_SESSION['sIdname'] == 'md50814'){ // หมอพิพิธ
	$time = 31536000;
}

/*	if($_SESSION["sldname"]=="md12891" || $_SESSION["sldname"]=="HDเลือก"){  //หมอเลือก
		echo header("Refresh:0; url=dt_index.php");	
	}else if($_SESSION["sIdname"] == "md19921"){  //หมอธนบดินทร์
		echo header("Refresh:1; url=dt_index.php");
	}else if($_SESSION['sIdname'] == 'md38220' || $_SESSION['sIdname'] == 'md50814'){ // หมอพิพิธ
		echo header("Refresh:3; url=dt_index.php");
	}else{
		echo header("Refresh:2; url=dt_index.php");
	}*/
	
	
?>
<html>
<head>
<script type="text/javascript">
	window.onload = function(){
		window.print();
		setTimeout(function(){
			window.location.href = 'dt_index.php';
		},<?php echo $time;?>);

	}
</script>
</head>

<body leftmargin="0" topmargin="0">
<style type="text/css">
/* CSS Rest */
/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}


/* Your CSS is below */
html{
    font-family: 'TH SarabunPSK'!important;
    font-size: 14pt;
}
u{
    border-bottom: 2px solid #000000;
    text-decoration: none;
}
b{ font-weight: bold; }
.size1{
    font-size: 6pt;
    line-height: 12pt;
}
.size2{
    font-size: 12pt;
    line-height: 12pt;
}
.size3{
    font-size: 14pt;
    line-height: 17.5pt;
}
.size4{
    font-size: 15pt;
    line-height: 21pt;
}
.size5{
    font-size: 22pt;
    line-height: 28pt;
}
.center{
    text-align: center;
}
</style>
<?php 
echo $_SESSION["dt_drugstk"];
?>
</body>
</html>