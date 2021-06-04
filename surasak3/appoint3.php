<?php
//Update 31 พค. 53 bbm
session_start();

if(isset($_GET["action"]) && $_GET["action"] != ""){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");

if(isset($_GET["action"]) && $_GET["action"] != ""){
	
	$sql = "Select CONCAT( `yot` , ' ', `name` , ' ', `surname` ) AS `full_name` From opcard where hn = '".$_GET["action"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname) = Mysql_fetch_row($result);
	
	echo $fullname;
exit();
}

?>
<html>
<head>
<title>นัดผู้ป่วย</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 16 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

<SCRIPT LANGUAGE="JavaScript">
	
	function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function checkname(hn) {
	
	var hn_value = "";

			url = 'appoint2.php?action='+hn;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			hn_value = xmlhttp.responseText;
	
	return hn_value;

}

	function add_hn(){
		var hn_true = "";

		hn_true = checkname(document.getElementById('HN').value);
		if(hn_true.length <= 4){
			alert("ไม่มีหมายเลข HN "+document.getElementById('HN').value);
		}else if(hn_true.length > 4){
			document.getElementById('list_hn').innerHTML = document.getElementById('list_hn').innerHTML + "<INPUT TYPE=\"checkbox\" name=\"list_hn[]\" value=\""+document.getElementById('HN').value+"\" checked>&nbsp;"+document.getElementById('HN').value + " "+hn_true+"<BR>";
			document.getElementById('HN').select();
		}

	}

</SCRIPT>



</head>
<body>

&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">&lt;&lt; เมนู</a>&nbsp;&nbsp;&nbsp;<a target=_self  href='appoint3.php?Line=1'>&lt;&lt;เริ่มต้นออกใบนัดใหม่</a>&nbsp;&nbsp;&nbsp;<a target="_blank"  href='appoilst.php'>ดูรายชื่อผู้ป่วยนัด</a>

<TABLE width="100%" align="center">
<TR valign="top">
	<TD align="center">
	
	<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>

<TABLE>
<TR>
	<TD align="right">
	HN : 
	</TD>
	<TD>
	<INPUT TYPE="text" ID="HN" NAME="HN" onkeypress = "if(event.keyCode == 13){ add_hn(); }">
	</TD>
</TR>
<TR>
	<TD colspan="2" align="center">
		<INPUT TYPE="button" value="ตกลง" Onclick="add_hn();">
		*กรุณาเลือกว่านัดกี่วันก่อนครับ
	</TD>
</TR>
</TABLE>

</TD>
</TR>
</TABLE>

<?php
	
	$sql = "Select distinct hn, ptname  From appoint where officer in (Select name From inputm where menucode in (Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' )) Order by row_id DESC limit 20";
	//$result = @Mysql_Query($sql);
	//if(@Mysql_num_rows($result) > 0){
	$result = 0;
	if($result > 0){
?>

<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE>
<?php
while(list($hn,$ptname) = Mysql_fetch_row($result)){	

 echo "
 <TR>
	<TD>
	 <A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('HN').value='".$hn."';add_hn(); \">",$hn,"</A>
	</TD>
	<TD>
	",$ptname,"
	</TD>
</TR>
 ";
 
 
 }?>

</TABLE>
</TD>
</TR>
</TABLE>

<?php } ?>
	</TD>
	<TD align="center">


<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		
		var stat = true;
		
		if(document.getElementById('list_hn').innerHTML == ""){
			alert("กรุณากรอก HN ");
			stat = false;
		}else if(document.f1.doctor.value == ""){
			alert("กรุณาเลือกแพทย์ผู้นัด");
			stat = false;
		}else if(document.f1.appdate.value == "" || document.f1.appmo.value == ""){
			alert("กรุณาเลือกวันที่นัดผู้ป่วย");
			stat = false;
		}

	return stat;

	}

</SCRIPT>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
  
/*  if(selObj.options[selObj.selectedIndex].value==""){
 alert('กรุณาเลือก');
 return true;
  }
*/

}
//-->
</script>
<FORM Name="f1" METHOD=POST ACTION="appoint3_3.php" Onsubmit="return checkForm();">
	
<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE>
<TR bgcolor="#3366FF">
	<TD colspan="2" align="center" class="font_title">นัดผู้ป่วยแบบนัดหลายวัน หรือ หลายคน</TD>
</TR>
<TR valign="top">
   <TD align="right">นัดกี่วัน</TD>
  <TD><select name="menu1" onChange="MM_jumpMenu('parent',this,0)" class="forntsarabun" id='menu1'>
<?
for($i=1;$i<=10;$i++)
{
	if($_GET["Line"] == $i)
	{
		$sel = "selected";
	}
	else
	{
		$sel = "";
	}
?>
	<option value="<?=$_SERVER["PHP_SELF"];?>?Line=<?=$i;?>" <?=$sel;?>><?=$i;?></option>
<?
}
?>
</select></TD>
</TR>
<TR valign="top">
	<TD align="right">HN : </TD>
	<TD><DIV ID="list_hn"></Div></TD>
</TR>
<TR>
	<TD align="right">แพทย์ : </TD>
	<TD>
	<? 
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
	$selected = "";
	if($_SESSION['sIdname']==='เมธาวารินทร์')
	{
		$selected = ($objResult["name"] == 'MD074  นักกายภาพบำบัด') ? 'selected="selected"' : '' ;
	}
?> 
<option value="<?=$objResult["name"];?>" <?=$selected;?> ><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>
   </TD>
</TR>
<TR>
  <input type="hidden" name="hdnLine" value="<?=$_GET["Line"];?>">
  <?
  $line = $_GET["Line"];
  if($line == 0){ $line=1;}
  for($i=1;$i<=$line;$i++)
  {
  ?>
  <TD align="right">ครั้งที่  <?=$i;?> นัดวันที่ :</TD>
  <TD><select size="1" name="appdate<?=$i;?>"  id="appdate<?=$i;?>">
    <option value="" selected>--วันที่--</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
    </select>
    <select size="1" name="appmo<?=$i;?>">
      <option value="" selected>--เดือน--</option>
      <option value="มกราคม">มกราคม</option>
      <option value="กุมภาพันธ์">กุมภาพันธ์</option>
      <option value="มีนาคม">มีนาคม</option>
      <option value="เมษายน">เมษายน</option>
      <option value="พฤษภาคม">พฤษภาคม</option>
      <option value="มิถุนายน">มิถุนายน</option>
      <option value="กรกฎาคม">กรกฎาคม</option>
      <option value="สิงหาคม">สิงหาคม</option>
      <option value="กันยายน">กันยายน</option>
      <option value="ตุลาคม">ตุลาคม</option>
      <option value="พฤศจิกายน">พฤศจิกายน</option>
      <option value="ธันวาคม">ธันวาคม</option>
      </select>
    <select size="1" name="thiyr<?=$i;?>">
      <?php for($ii=date("Y")+542;$ii<date("Y")+545;$ii++){?>
      <option value="<?php echo $ii;?>" <?php if($ii == date("Y")+543) echo "Selected"; ?> ><?php echo $ii;?></option>
      <?php }?>
      </select></TD>
</TR>
<?
  }
  ?>
<TR>
	<TD align="right">เวลา : </TD>
	<TD>
	<select size="1" name="capptime">
	 <?php if($_SESSION["sIdname"]== 'ฝังเข็ม'  || $_COOKIE["until"] == "ฝังเข็ม"){
		  if(empty($_COOKIE["until"])){
		 @setcookie("until", "ฝังเข็ม", time()+(3600*12));
	   }
	   ?>
		<option value="07:30 น. - 08:00 น.">07:30 น. - 08:00 น.</option>
		<option value="08:30 น. - 09:00 น.">08:30 น. - 09:00 น.</option>
		<option value="09:30 น. - 10:00 น.">09:30 น. - 10:00 น.</option>
		<option value="10:30 น. - 11:00 น.">10:30 น. - 11:00 น.</option>
		<option value="11:30 น. - 12:00 น.">11:30 น. - 12:00 น.</option>
		<option value="12:30 น. - 13:00 น.">12:30 น. - 13:00 น.</option>
		<option value="15:30 น. - 16:00 น.">15:30 น. - 16:00 น.</option>
		<option value="16:30 น. - 17:00 น.">16:30 น. - 17:00 น.</option>
		<option value="17:30 น. - 18:00 น.">17:30 น. - 18:00 น.</option>
		<option value="18:30 น. - 19:00 น.">18:30 น. - 19:00 น.</option>

	 <?php }else{ ?>
		<option>08:00 น. - 11.00 น.</option>
		<option>07:00 น.</option>
		<option>07:30 น.</option>
		<option>08:00 น.</option>
		<option>08:30 น.</option>
		<option>09:00 น.</option>
		<option>09:30 น.</option>
		<option>10:00 น.</option>
		<option>10:30 น.</option>
		<option>11:00 น.</option>
		<option>11:30 น.</option>
		<option>13:00 น.</option>
		<option>13:30 น.</option>
		<option>14:00 น.</option>
		<option>14:30 น.</option>
		<option>15:00 น.</option>
		<option>15:30 น.</option>
		<option>16:00 น.</option>
		<option>16:30 น.</option>
		<option>17:00 น.</option>
		<option>17:30 น.</option>
		<option>18:00 น.</option>
		<option>18:30 น.</option>
		<option>19:00 น.</option>
		<option>19:30 น.</option>
		<option>20:00 น.</option>
		<option>21:00 น.</option>
		<?php } ?>
   </select>
   </TD>
</TR>
<TR>
	<TD align="right">ยื่นใบนัดที่ : </TD>
	<TD>
		<?php 
		$appoint_at = array('จุดบริการนัดที่ 1', 'จุดบริการนัดที่ 2', 'แผนกทะเบียน', 'ห้องฉุกเฉิน', 'กองทันตกรรม','แผนกพยาธิวิทยา', 'แผนกเอกชเรย์', 'กองสูติ-นารี', 'กายภาพ', 'คลีนิกฝังเข็ม', 'นวดแผนไทย', 'ห้องไตเทียม', 'แผนกฝังเข็ม', 'แผนกจักษุ', 'OPD เวชศาสตร์ฟื้นฟู', 'กายภาพบำบัดชั้น2');
		?>
		<select size="1" name="room">
		<?php 
		foreach ($appoint_at as $at_item) { 
			$selected = '';
			if($_SESSION['sIdname']==='เมธาวารินทร์')
			{
				$selected = ($at_item == 'กายภาพ') ? 'selected="selected"' : '' ;
			}
			?>
			<option value="<?=$at_item;?>" <?=$selected;?> ><?=$at_item;?></option>
			<?php
		}
		?>
		</select>
   </TD>
</TR>
<TR>
	<TD align="right">นัดมาเพื่อ : </TD>
	<TD>
		<select size="1" name="detail">
            <?
			$app = "select * from applist where status='Y' ";
	 		$row = mysql_query($app);
	 		while($result = mysql_fetch_array($row)){
		  		$str="";
				if($result['applist']=="ตรวจตามนัดพร้อมประวัติผู้ป่วยใน"){
					$sql1 = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
					$result1 = Mysql_Query($sql1);
					$arr = Mysql_fetch_row($result1);
					
					if($arr[0] == "ADMICU" || $arr[0] == "ADMWF" || $arr[0] == "ADMVIP" || $arr[0] == "ADMOBG"){
							$str= "  Selected  ";
					}
				}
				
				if($_SESSION['sIdname']==='เมธาวารินทร์' && $result['applist'] == 'กายภาพ') 
				{
					$str = 'selected="selected"';
				}

				?>
				<option value="<?=$result['appvalue']?>" <?=$str;?>><?=$result['applist']?></option>
				<?
			}
			?>
			<!--ตรวจตามนัดพร้อมประวัติผู้ป่วยใน</option>
			<option value="FU12 นวดแผนไทย">นวดแผนไทย</option>
			<option value="FU13 ส่องกระเพาะ">ส่องกระเพาะ</option>
			<option value="FU14 เจาะเลือดไม่พบแพทย์">เจาะเลือดไม่พบแพทย์</option>
			<option value="FU15 OPD นอกเวลา">OPD นอกเวลาราชการ</option>
			<option value="FU16 คลินิกพิเศษ">คลินิกศัลยกรรมนอกเวลาพิเศษ(ค่าบริการ 100 บาท)</option>
			<option value="FU17 X-ray ไม่พบแพทย์">X-ray ไม่พบแพทย์</option>
			<option value="FU18 ไตเทียม">ไตเทียม</option>
				<option value="FU19 ตรวจตามนัด OPD เวชศาสตร์ฟื้นฟู">ตรวจตามนัด OPD เวชศาสตร์ฟื้นฟู</option>
                <option value="FU26 EMG">EMG</option>
                <option value="FU27 X-ray ก่อนพบแพทย์">X-ray ก่อนพบแพทย์</option>
                <option value="FU28 Lab ก่อนพบแพทย์">Lab ก่อนพบแพทย์</option>
                <option value="FU29 X-ray + Lab ก่อนพบแพทย์">X-ray + Lab ก่อนพบแพทย์</option>-->
                
		</select>
   </TD>
</TR>
<TR>
	<TD align="right">ข้อควรปฎิบัติก่อนพบแพทย์ : </TD>
	<TD>
	<select size="1" name="advice">
    <option value="ไม่มี">ไม่มี</option>
    <option>ไม่ต้องงดน้ำหรืออาหาร</option>
    <option>งดน้ำและอาหารหลังเวลา 20:00 น.</option>
    <option>งดน้ำและอาหารหลังเวลา 24:00 น.</option>
	<option>งดน้ำและอาหารหลังเวลา ........... น.</option>
	<option>เอกซเรย์ ก่อนพบแพทย์</option>
    <option>งดสวมใส่เครื่องประดับทุกชนิด งดทาโลชั่น แป้งบริเวณต้นคอ แขน และขา</option>
  </select>
   </TD>
</TR>
<TR>
	<TD align="right">เจาะเลือด : </TD>
	<TD>
		<select size="1" name="patho">
			<option selected value="ไม่มี">ไม่มี</option>
			<option>CBC</option>
				<option>CBC,BS</option>
			<option>UA</option>
			<option>CBC, UA</option>
			<option>BS</option>
			<option>CBC ,BS, CHOL, TG</option>
			<option>BS, CHOL, TG</option>
			<option>BUN,CR</option>
			<option>CHOL, TG</option>
			<option>CBC, CD4, LFT</option>
			<option>CBC,UA,BS,BUN,CR,LFT,CHOL,TG,URIC</option>
			<option>URIC ACID</option>
			<option>Anti HIV</option>
			<option>CBC,CD4</option>
			<option>BS,CHOL,TG,HDL,LDL</option>
			<option>CHOL,TG,HDL,LDL</option>
			<option>BS,HbA1C</option>
			<option>FT3,FT4,TSH</option>
			<option>FBs,Bun,Cr</option>
			<option>FBs,HbA1C,Chol,Tg</option>
			<option>FBs,HbA1C,Chol,Tg,UA</option>
			<option>Bun,Cr,E-lyte,Hct</option>
			<option>FBs,HbA1C,Bun,Cr,Chol,Tg</option>
			<option>FBs,Chol,Tg,Bun,Cr,Ua</option>
			<option>FBs,HbA1C,Chol,Tg,Bun,Cr,Ua</option>
		</select>
   </TD>
</TR>
<TR>
	<TD align="right">เอกซเรย์ : </TD>
	<TD>
	<select size="1" name="xray">
		<option selected value="ไม่มี">ไม่มี</option>
		<option>CXR</option>
		<option>KUB</option>
	</select>
   </TD>
</TR>
<TR>
	<TD align="right">แผนกที่นัด : </TD>
	<TD>
	<select size="1" name="depcode">
    <option  selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3649;&#3612;&#3609;&#3585;&#3607;&#3637;&#3656;&#3609;&#3633;&#3604;&gt;</option>
    <option>U09&nbsp;
    ห้องตรวจโรค</option>
    <option>U01&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
    <option>U02&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
    <option>U03&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
    <option>U19&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;3</option>
    <option>U04&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3609;&#3633;&#3585;ICU</option>
    <option>U05&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;</option>
    <option>U06&nbsp; &#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
    <option>U12&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3652;&#3605;&#3648;&#3607;&#3637;&#3618;&#3617;</option>
    <option>U10&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
    <option>U11&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
    <option>U13&nbsp;
    &#3585;&#3629;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
    <option>U16&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
    <option>U19&nbsp; กองตรวจโรคผู้ป่วยสูติ</option>
    <option>U20&nbsp; กายภาพ</option>
	<option>U21&nbsp; นวดแผนไทย</option>
	<option>U22&nbsp; ไตเทียม</option>
	<option>U23&nbsp; คลินิกพิเศษ</option>
		<option>U24&nbsp; แผนกฝังเข็ม</option>
			<option>U25&nbsp; แผนกจักษุ</option>
            <option>U27&nbsp; OPD PM&R</option>
  </select>
   </TD>
</TR>
<TR>
	<TD colspan="2" align="center">

    <INPUT TYPE="submit" value="  ตกลง  ">
    </TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>

	</TD>
</TR>
</TABLE>


</body>
</html>
<?php include("unconnect.inc");?>
