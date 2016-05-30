<?php
	include("connect.inc");

	if($_POST["add_register"]){
		
		if(!empty($_POST["submit1"])){
			$withdraw = $_POST["submit1"];
		}

		if(!empty($_POST["submit2"])){
			$withdraw = $_POST["submit2"];
		}
		
		if(!empty($_POST["submit2"]) || !empty($_POST["submit1"])){

			$sql = "Update opday set withdraw='".$withdraw."' where row_id in ('".implode("','",$_POST["list"])."')";
			mysql_query($sql);

		}

		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."?appdate=".$_GET["appdate"]."&appmo=".$_GET["appmo"]."&thiyr=".$_GET["thiyr"]."&B1=".urlencode("ตกลง")."\">";
		exit();
	}

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function checkForm(){
		 if(document.f1.appmo.value == ""){
			alert("เลือก เดือนด้วยครับ")
			return false;
		}else{
			return true
		}
	
}

//-->
</SCRIPT>
<div id="div_form">
<form  name="f1" method="GET" action="rpcaseex03.php?appdate=<?php echo $_GET[""];?>&appmo=<?php echo $_GET["appmo"];?>&thiyr=<?php echo $_GET["thiyr"];?>"  onsubmit="return checkForm();">
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
 รายงานผู้สมัครโครงการเบิกจ่ายตรง</b></font></font></p>
  <p><font face="Angsana New"><font size="3">
</font></font></p>
  <font face="Angsana New">วันที่&nbsp;&nbsp;<input type="text" name="appdate" size="2">&nbsp;&nbsp;
  <? $m=date('m'); ?>
  <select size="1" name="appmo">
    <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
  </select>&nbsp;&nbsp;<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="ตกลง" name="B1">&nbsp;&nbsp;&nbsp;
<a target=_self  href='../nindex.htm'>&lt;&lt; ไปเมนู</a><BR><BR><BR>
</form>
</div>
<?php
   if(isset($_GET["B1"])){

		
		if($_GET["appdate"] != ""){
			$_GET["appdate"]=  sprintf("%02d", $_GET["appdate"]);
		}

	$sql = "Select row_id, date_format(thidate,'%d/%m/%Y'), hn,ptname,(case when withdraw='1' then '' else withdraw end)  From opday where withdraw  is not Null AND thidate like '".$_GET["thiyr"]."-".$_GET["appmo"]."-".$_GET["appdate"]."%'";
	//echo $sql;

	$result = Mysql_Query($sql);
	//echo mysql_error();

?>

<FORM METHOD=POST ACTION="">
<TABLE align="center" width="700" border='1' bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR align="center">
	<TD id="list_check0">check</TD>
	<TD>ลำดับ</TD>
	<TD>ว.ด.ป. สมัคร</TD>
	<TD>HN</TD>
	<TD>ปชช ID</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สถานะ</TD>
	<TD>หมายเหตุ</TD>
</TR>
<?php
$i=1;
$list_check="";
while(list($row_id, $date_regis, $hn, $ptname, $withdraw) = Mysql_fetch_row($result)){

	$sql = "Select idcard From opcard where hn='".$hn."' limit 1";
	list($idcard) = mysql_fetch_row(mysql_query($sql));

if($withdraw=="สมัครผ่าน")
	$withdraw="สมัครได้";
else if($withdraw=="ไม่ผ่าน")
	$withdraw="สมัครไม่ได้";


if($withdraw=="สมัครได้")
	$bgcolor="#FFFFBB";
else if($withdraw=="สมัครไม่ได้")
	$bgcolor="#FFCACA";
else
	$bgcolor="#FFFFFF";

	$list_check .= "#list_check".$i." {display:none;} \n ";
?>
<TR bgcolor="<?php echo $bgcolor;?>">
	<TD id="list_check<?php echo $i;?>"><INPUT TYPE="checkbox" NAME="list[]" value="<?php echo $row_id;?>"></TD>
	<TD><?php echo $i;?>.</TD>
	<TD align="center"><?php echo $date_regis;?></TD>
	<TD><?php echo $hn;?></TD>
	<TD align="center"><?php echo $idcard;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $withdraw;?></TD>
	<TD>&nbsp;</TD>
</TR>
<?php $i++;}?>

<TR bgcolor="#FFFFFF" id="last_row">
	<TD colspan="6"><!-- วันที่อนุมัติ : 
	<input type="text" name="date" size="2" value="<?php// echo date("d");?>">&nbsp;&nbsp;
  <select size="1" name="month">
    <option value="" selected>--เดือน--</option>
    <option value="01" <?php //if(date("m") == "01") echo " Selected ";?> >มกราคม</option>
    <option value="02" <?php //if(date("m") == "02") echo " Selected ";?> >กุมภาพันธ์</option>
    <option value="03" <?php //if(date("m") == "03") echo " Selected ";?> >มีนาคม</option>
    <option value="04" <?php //if(date("m") == "04") echo " Selected ";?> >เมษายน</option>
    <option value="05" <?php //if(date("m") == "05") echo " Selected ";?> >พฤษภาคม</option>
    <option value="06" <?php //if(date("m") == "06") echo " Selected ";?> >มิถุนายน</option>
    <option value="07" <?php //if(date("m") == "07") echo " Selected ";?> >กรกฏาคม</option>
    <option value="08" <?php //if(date("m") == "08") echo " Selected ";?> >สิงหาคม</option>
    <option value="09" <?php //if(date("m") == "09") echo " Selected ";?> >กันยายน</option>
    <option value="10" <?php //if(date("m") == "10") echo " Selected ";?> >ตุลาคม</option>
    <option value="11" <?php //if(date("m") == "11") echo " Selected ";?> >พฤศจิกายน</option>
    <option value="12" <?php //if(date("m") == "12") echo " Selected ";?> >ธันวาคม</option>
  </select>&nbsp;&nbsp;<select size="1" name="year">
  <?php/* for($i=date("Y")+543-2;$i<date("Y")+543+1;$i++){
	  echo "<option ";
		if($i == date("Y")+543) echo " Selected ";
	  echo ">",$i,"</option>";
		}*/
	  ?>
  </select> -->&nbsp;&nbsp;<INPUT TYPE="submit" name="submit1" value="สมัครได้">
  &nbsp;&nbsp;<INPUT TYPE="submit" name="submit2" value="สมัครไม่ได้">
	</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" name="add_register" value="1">
</FORM>

<style media="print">
	#list_check0 {display:none;}
	<?php echo $list_check;?>
	#div_form {display:none;}
	#last_row {display:none;}
</style>

<?php 
 include("unconnect.inc");
}?>