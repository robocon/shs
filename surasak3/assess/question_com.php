<?php
session_start();



include "connect.php";

////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ตรวจสุขภาพ*/////////

$sql ="select * from  tb_assess  where row_id = '$sRowid' and year ='$nPrefix'";
$query_id = mysql_query($sql)or die (mysql_error());
$num_rows = mysql_num_rows($query_id);
$a = mysql_fetch_array($query_id);

if($num_rows){
	
	echo "<script>window.location='../../nindex.htm'</script>";
	
	
	}else {
	

?>

<HTML>
<HEAD><TITLE>แบบสอบถาม</TITLE>
<script language="JavaScript1.2">
<!--
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}
//-->
</script>
<style type="text/css">
.style0 { font-family:"AngsanaUPC"; font-size:30px}
.style1 { font-family:"AngsanaUPC"; font-size:18px}
.style2 { font-family:"AngsanaUPC"; font-size:25px}
.style3 { font-family:"AngsanaUPC"; font-size:20px}
.style4 { font-family:"AngsanaUPC"; font-size:22px}
.style5 { font-family:"AngsanaUPC"; font-size:18px}
	
}
</style>
</HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<BODY>
<script>
function chkform(){
	if(document.getElementById('ch11').checked == false && document.getElementById('ch12').checked == false && document.getElementById('ch13').checked == false && document.getElementById('ch14').checked == false && document.getElementById('ch15').checked == false){
		alert('กรุณาลงคะแนนข้อ1');	
		return false;	
	}	
		
	else if(document.form1.ch21.checked == false && document.form1.ch22.checked == false && document.form1.ch23.checked == false && document.form1.ch24.checked == false && document.form1.ch25.checked == false){
			alert('กรุณาลงคะแนนข้อ2 ');
			return false;	
	}	
	
	else if(document.form1.ch31.checked == false && document.form1.ch32.checked == false && document.form1.ch33.checked == false && document.form1.ch34.checked == false && document.form1.ch35.checked == false){
			alert('กรุณาลงคะแนนข้อ3 ');	
			return false;
	}	
	
	else if(document.form1.ch41.checked == false && document.form1.ch42.checked == false && document.form1.ch43.checked == false && document.form1.ch44.checked == false && document.form1.ch45.checked == false){
			alert('กรุณาลงคะแนนข้อ4 ');	
			return false;
	}	
	
	else if(document.form1.ch51.checked == false && document.form1.ch52.checked == false && document.form1.ch53.checked == false && document.form1.ch54.checked == false && document.form1.ch55.checked == false)
	{
			alert('กรุณาลงคะแนนข้อ5 ');
			return false;
			
	}
	else if(document.form1.ch61.checked == false && document.form1.ch62.checked == false && document.form1.ch63.checked == false && document.form1.ch64.checked == false && document.form1.ch65.checked == false){
			alert('กรุณาลงคะแนนข้อ6 ');	
			return false;
	}	
	else if(document.form1.ch71.checked == false && document.form1.ch72.checked == false && document.form1.ch73.checked == false && document.form1.ch74.checked == false && document.form1.ch75.checked == false){
			alert('กรุณาลงคะแนนข้อ7 ');	
			return false;
	}	
	else if(document.form1.ch81.checked == false && document.form1.ch82.checked == false && document.form1.ch83.checked == false && document.form1.ch84.checked == false && document.form1.ch85.checked == false){
			alert('กรุณาลงคะแนนข้อ8 ');	
			return false;
	}	
	else if(document.form1.ch91.checked == false && document.form1.ch92.checked == false && document.form1.ch93.checked == false && document.form1.ch94.checked == false && document.form1.ch95.checked == false){
			alert('กรุณาลงคะแนนข้อ9 ');	
			return false;
	}	
	else if(document.form1.ch101.checked == false && document.form1.ch102.checked == false && document.form1.ch103.checked == false && document.form1.ch104.checked == false && document.form1.ch105.checked == false){
			alert('กรุณาลงคะแนนข้อ10 ');	
			return false;
	}
		else if(document.form1.ch111.checked == false && document.form1.ch112.checked == false && document.form1.ch113.checked == false && document.form1.ch114.checked == false && document.form1.ch115.checked == false){
			alert('กรุณาลงคะแนนข้อ11 ');	
			return false;
	}
		else if(document.form1.ch121.checked == false && document.form1.ch122.checked == false && document.form1.ch123.checked == false && document.form1.ch124.checked == false && document.form1.ch125.checked == false){
			alert('กรุณาลงคะแนนข้อ12 ');	
			return false;
	}
		else if(document.form1.ch131.checked == false && document.form1.ch132.checked == false && document.form1.ch133.checked == false && document.form1.ch134.checked == false && document.form1.ch135.checked == false){
			alert('กรุณาลงคะแนนข้อ13 ');	
			return false;
	}
		else if(document.form1.ch141.checked == false && document.form1.ch142.checked == false && document.form1.ch143.checked == false && document.form1.ch144.checked == false && document.form1.ch145.checked == false){
			alert('กรุณาลงคะแนนข้อ14 ');	
			return false;
	}
		else if(document.form1.ch151.checked == false && document.form1.ch152.checked == false && document.form1.ch153.checked == false && document.form1.ch154.checked == false && document.form1.ch155.checked == false){
			alert('กรุณาลงคะแนนข้อ15 ');	
			return false;
	}
		else if(document.form1.ch161.checked == false && document.form1.ch162.checked == false && document.form1.ch163.checked == false && document.form1.ch164.checked == false && document.form1.ch165.checked == false){
			alert('กรุณาลงคะแนนข้อสรุป ');	
			return false;
	}
	else{
		return true;	
	}	
}
</script>
<H2><center>
  <table width="282" border="0">
    <tr>
      <td><img src="phpworkshop.jpg" width="128" height="128">&nbsp;&nbsp;&nbsp;&nbsp;<img src="shs.png" width="128" height="128"></td>
    </tr>
  </table>
  <p><strong class="style0">แบบสอบถามความพึงพอใจ <br>
    การให้บริการโปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี
  </strong></p>
 
</center>
</H2>
<FORM METHOD="POST" ACTION="save.php" name="form1" onSubmit="return chkform()">
<TABLE BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0" bordercolor="#0033FF" >
	<TR ALIGN="center" BGCOLOR="#EFEFEF">
    </TR>
	<TR ALIGN="center" BGCOLOR="#6495ED">
	  <TD class="style1" width="30"><B>ข้อ</B></TD>
	  <TD class="style1" width="650"><B>รายละเอียด</B></TD>
	  <TD class="style1" width="50"><B>มากที่สุด<BR>5</B></TD>
	  <TD class="style1" width="50"><B>มาก<BR>4</B></TD>
	  <TD class="style1" width="50"><B>ปานกลาง<BR>3</B></TD>
	  <TD class="style1" width="50"><B>น้อย<BR>2</B></TD>
	  <TD class="style1" width="50"><B>น้อยที่สุด<BR>1</B></TD>
    </TR>
<?
	include "question.php";
	for ($i=1;$i<=15;$i++) { 
	
			  ?> 
  <TR BGCOLOR="#FFFFFF" >
  <? if($i==16){  $n="สรุป"; }else{ $n=$i; }  ?>
    <TD ALIGN="center" class="style2"><b><?=$n;?>.</b></TD>
    <TD class="style2">
        <?=$q[$i]?></TD>
    
    <TD ALIGN="center" style="border-right-style:none;">
		<INPUT TYPE="radio"  id="<? echo "ch".$i; ?>5" NAME="<? echo "ch".$i; ?>" VALUE="5" >
	</TD>
    <TD ALIGN="center" style="border-right-style:none; border-left-style:none;">
        <INPUT TYPE="radio" id="<? echo "ch".$i; ?>4" NAME="<? echo "ch".$i; ?>" VALUE="4">
    </TD>
    <TD ALIGN="center" style="border-left-style:none; border-right-style:none;">
        <INPUT TYPE="radio" id="<? echo "ch".$i; ?>3" NAME="<? echo "ch".$i; ?>"  VALUE="3">
    </TD>
    <TD ALIGN="center" style="border-left-style:none; border-right-style:none;">
        <INPUT TYPE="radio" id="<? echo "ch".$i; ?>2" NAME="<? echo "ch".$i; ?>" VALUE="2">
    </TD>
    <TD ALIGN="center" style="border-left-style:none;">
        <INPUT TYPE="radio" id="<? echo "ch".$i; ?>1" NAME="<? echo "ch".$i; ?>" VALUE="1">
    </TD>
  </TR>
 <? 
	}
?>
</TABLE>
  <p align="center" class="style2"><strong>
    แสดงความคิดเห็นเพิ่มเติม</strong>
  </p>
<center>
    <p>
      <textarea name="com1" id="com1" cols="150" rows="3" class="style3"></textarea>
    </p>
    <table width="95%" border="0" class="style2">
      <tr>
        <td>  <strong>
          <? if($i==16){  $n="สรุป"; }else{ $n=$i; }  ?>
          
          <?=$n;?>
          .
      
      <?=$q[$i]?>
        </strong></td>        
    <td><strong><span style="border-right-style:none;"><input type="radio"  id="<? echo "ch".$i; ?>10" name="<? echo "ch".$i; ?>" value="5">
          มากที่สุด
          
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></td>
        <td><strong><span style="border-right-style:none; border-left-style:none;"> <input type="radio" id="<? echo "ch".$i; ?>9" name="<? echo "ch".$i; ?>" value="4">
          มาก
         
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></td>
        <td><strong><span style="border-left-style:none; border-right-style:none;"><input type="radio" id="<? echo "ch".$i; ?>8" name="<? echo "ch".$i; ?>"  value="3">
          ปานกลาง
          
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></td>
        <td><strong><span style="border-left-style:none; border-right-style:none;"><input type="radio" id="<? echo "ch".$i; ?>7" name="<? echo "ch".$i; ?>" value="2">
          น้อย
          
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></td>
        <td><strong><span style="border-left-style:none;"><input type="radio" id="<? echo "ch".$i; ?>6" name="<? echo "ch".$i; ?>" value="1">
          น้อยที่สุด
          
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></td>
      </tr>
    </table>
</center>
  
<TR BGCOLOR="#FFFFFF">
  <TD ALIGN="center" class="style2">&nbsp;</TD>
    <TD class="style2">&nbsp;</TD>
    
    <TD ALIGN="center" style="border-right-style:none;">&nbsp;</TD>
    <TD ALIGN="center" style="border-right-style:none; border-left-style:none;">&nbsp;</TD>
    <TD ALIGN="center" style="border-left-style:none; border-right-style:none;">&nbsp;</TD>
    <TD ALIGN="center" style="border-left-style:none; border-right-style:none;">&nbsp;</TD>
    <TD ALIGN="center" style="border-left-style:none;">&nbsp;</TD>
  </TR>

  <center>
<input type="hidden" name="row_id" value="<?=$sRowid;?>">
<br>
  <input type="submit" value="      บันทึก      ">
  <!--<INPUT TYPE="reset" VALUE="ล้าง">--></center>

</FORM>

<? 



}
?>
</BODY>
    
</HTML>
