<?php
print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$labhn&nbsp;<b></b>($labtvn)&nbsp;$Thaidate</span></DIV>";
print "<DIV style='left:0PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'>$labptname</span></DIV>";

$nLab21=sprintf("%03d",$nLab2);

		 $y=date("Y")+543;
		 $yy=substr($y,2,2);
		 $mmdd=date("md");
		 //echo $mmdd;
		 $ymd=$yy.$mmdd;
		 

$labno=$ymd.$nLab21."02";

print "<DIV style='left:45PX;top:45PX;width:180PX;height:14PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"><font size='+5' style='margin-left:5px;'>C</font></span></DIV>";
