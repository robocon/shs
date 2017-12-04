<?php
     session_start();

include("opd/class_printvntt.php");
$classopd = new printvntt();

?>
<HTML>
<HEAD>
<TITLE> Print VN </TITLE>
<script>
 ie4up=nav4up=false;
 var agt = navigator.userAgent.toLowerCase();
 var major = parseInt(navigator.appVersion);
 if ((agt.indexOf('msie') != -1) && (major >= 4))
   ie4up = true;
 if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
   nav4up = true;
</script>

	<SCRIPT LANGUAGE="JavaScript">
		
		window.onload = function(){
			window.print();
			var t;
			t = 1*1000;
			setTimeout("window.close()",t);

		}
	</SCRIPT>

</HEAD>

<BODY  BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>
<DIV style='z-index:0'> &nbsp; </div>
	<?php
	$classopd->input_hn($_SESSION["cHn"]);
	$classopd->outputprint();
	
	?>

</BODY>
</HTML>
