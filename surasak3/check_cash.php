<?php
    session_start();

	include("connect.inc");
    if (isset($sIdname)){} else {die;} //for security

    //$today = date("d-m-Y");   
  if(!isset($_POST['B1'])){
  	$d=date("d");
    $m=date("m");
    $yr=date("Y") +543;  
  }
  else{
	$d=$d;
    $m=$m;
    $yr=$yr;
	  }
	?>
<style type="text/css">
<!--
.text123 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
-->
</style>

    <form method='POST' action=<? $_SERVER['PHP_SELF']?>>
    <?
    print "<p><font face='Angsana New'>ดูรายการตรวจค้างจ่าย&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
	?>
	<select name="d">
    <?
	for($a=1;$a<32;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
	<option value="<?=$ss?><?=$a?>" <? if($d==$a) echo "selected='selected'"?>><?=$a?></option>
    <?
	}
	?>
	</select>
    <?
    print "&nbsp;&nbsp;เดือน&nbsp;";
	?>
	<select name="m">
    <?
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
	<option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>><?=$a?></option>
    <?
	}
	?>
	</select>
    <?
    print " &nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' size='5' value=$yr></font></p>";
    print "<input type='submit' value='          ตกลง          ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ลบทิ้ง' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
    //print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    print "</form>";
?>

    <center><span class="text123">รายชื่อ ผู้ป่วยที่ยังไม่ได้ชำระเงินหรือโอนข้อมูลเข้าสู่ระบบ</span></center><BR>

<TABLE width='100%' border="1" cellpadding="0" cellspacing="0" class="text123">
<TR align="center">
	<TD colspan='7'><strong>เวชภัณฑ์</strong></TD>
</TR>
<TR align="center">
	<TD>VN</TD>
	<TD>วันที่</TD>
	<TD>HN</TD>
	<TD>ชื่อ-สกุล</TD>
	<TD>สิทธิ์</TD>
	<TD>จำนวนเงิน</TD>
	<TD>เจ้าหน้าที่</TD>
</TR>
<?php 
$null='NULL';
	$sql = "Select tvn, hn, ptname, ptright, price,an,date,idname From phardep where date like '$yr-$m-$d%' AND  (cashok = '' OR cashok is Null ) AND (an is Null OR an = '') AND `borrow` is NULL AND price > 0  ORDER BY ptright ";
	$nows = date("H.i");
	$result  = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		$datearr = explode(" ",$arr["date"]);
		$datearr2 = explode(":",$datearr[1]);
		$times = $datearr2[0].".".$datearr2[1];
		$more =((24-$times)+$nows+(1-2)*24);
		//if($arr["price"]<='0'){$color="#FF6699";}
		//else{$color="66CDAA";};
		//if($more>=2){$color="#FF7979";}
?>
<TR>
	<TD align="center" BGCOLOR="<?php echo $color ?>"><a href="opcashvn.php?a=<?=$d?>&b=<?=$m?>&c=<?=$yr?>&vn=<?=$arr["tvn"]?>" target="_blank"><?php echo $arr["tvn"];?></a></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["date"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["hn"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptright"];?></TD>
	<TD align="right" BGCOLOR="<?php echo $color ?>" ><?php echo $arr["price"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["idname"];?></TD>
</TR>
<?php }?>
</TABLE>
<br>


<TABLE  width='100%' border="1" cellpadding="0" cellspacing="0" class="text123">
<TR align="center">
	<TD colspan='8'><B>หัตถการ</B></TD>
</TR>
<TR align="center">
	<TD>VN</TD>
	<TD>วันที่</TD>
	<TD>HN</TD>
	<TD>ชื่อ-สกุล</TD>
	<TD>สิทธิ์</TD>
	<TD>จำนวนเงิน</TD>
	<TD>แผนก</TD>
	<TD>เจ้าหน้าที่</TD>
</TR>
<?php 
	$sql = "Select tvn, hn, ptname, ptright, price,an,date,depart,idname From depart  where date like '$yr-$m-$d%' AND    (cashok = '' OR cashok is Null ) AND an = '' AND `status` = 'Y' AND price > 0 ORDER BY ptright ";
	$result  = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		$datearr = explode(" ",$arr["date"]);
		$datearr2 = explode(":",$datearr[1]);
		$times = $datearr2[0].".".$datearr2[1];
		$more =((24-$times)+$nows+(1-2)*24);
			//if($arr["price"]<='0'){$color="#FF6699";}
		//else{$color="66CDAA";};
		//if($more>=2){$color="#FF7979";}

?>
<TR>
	<TD align="center" BGCOLOR="<?php echo $color ?>"><a href="opcashvn.php?a=<?=$d?>&b=<?=$m?>&c=<?=$yr?>&vn=<?=$arr["tvn"]?>" target="_blank" ><?php echo $arr["tvn"];?></a></TD>
		<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["date"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["hn"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptright"];?></TD>
	<TD  align="right" BGCOLOR="<?php echo $color ?>"><?php echo $arr["price"];?></TD>
		<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["depart"];?></TD>
			<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["idname"];?></TD>
</TR>
<?php }?>
</TABLE>
</TABLE>