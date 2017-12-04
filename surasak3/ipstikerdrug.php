<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Stiker </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<STYLE>A {text-decoration:none}A IMG {border-style:none; border-width:0;}DIV {position:absolute; z-index:25;}.fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}.fc1-1 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}.fc1-2 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}.ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}.ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
</STYLE>
</HEAD>

<BODY Onload="window.print();" BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>
<DIV style='z-index:0'> &nbsp; </div>
<?php
	$x1 = "0";
	$x2 = "320";

	$y1=0;
	$y2=20;
	$y3=40;
	$y4=60;
	$y5=80;
	
	$sizerow = 130;
	$line1 = "ชื่อ-สกุลผู้ป่วย&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>&nbsp;เตียง&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>";
	$line2 = "ชื่อยา&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>";
	$line3 = "อัตราส่วนผสม&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>";
	$line4 = "วัน-เวลาที่ผสม&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>";
	$line5 = "วัน-เวลาที่หมดอายุ&nbsp;<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>";

?>
<?for($i=0;$i<6;$i++){
	
	if($i==3) $sizerow += 5;
	?>
<DIV style='left:<?php echo $x1;?>PX;top:<?php echo $y1+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line1;?></DIV>
<DIV style='left:<?php echo $x1;?>PX;top:<?php echo $y2+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line2;?></DIV>
<DIV style='left:<?php echo $x1;?>PX;top:<?php echo $y3+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line3;?></DIV>
<DIV style='left:<?php echo $x1;?>PX;top:<?php echo $y4+($i*$sizerow);?>PX;width:500PX;height:30PX;' class='fc1-1'><?php echo $line4;?></DIV>
<DIV style='left:<?php echo $x1;?>PX;top:<?php echo $y5+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line5;?></DIV>

<DIV style='left:<?php echo $x2;?>PX;top:<?php echo $y1+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line1;?></DIV>
<DIV style='left:<?php echo $x2;?>PX;top:<?php echo $y2+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line2;?></DIV>
<DIV style='left:<?php echo $x2;?>PX;top:<?php echo $y3+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line3;?></DIV>
<DIV style='left:<?php echo $x2;?>PX;top:<?php echo $y4+($i*$sizerow);?>PX;width:500PX;height:30PX;' class='fc1-1'><?php echo $line4;?></DIV>
<DIV style='left:<?php echo $x2;?>PX;top:<?php echo $y5+($i*$sizerow);?>PX;width:306PX;height:30PX;' class='fc1-1'><?php echo $line5;?></DIV>
<?php }?>


</BODY>
</HTML>
