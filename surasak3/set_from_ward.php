
<script type="text/javascript">
if ((typeof Range !== "undefined")
&& !Range.prototype.createContextualFragment)
{
    Range.prototype.createContextualFragment = function(html)
    {
        var frag = document.createDocumentFragment(),
        div = document.createElement("div");
        frag.appendChild(div);
        div.outerHTML = html;
        return frag;
    };
}
</script>
<html>
<head>
<title>ใบ SET ผ่าตัด</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>


<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<style>
.f1{
	font-family:"Angsana New";
	font-size:16pt;	
}
</style>
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_surg'));

};



function fncSubmit()
{

	if(document.frmMain.ward.value == "")
	{
		alert('กรุณาเลือก หอผู้ป่วย');
		document.frmMain.ward.focus();		
		return false;
	}	
		if(document.frmMain.hn.value == "")
	{
		alert('กรุณาระบุ HN');
		document.frmMain.hn.focus();		
		return false;
	}	
			if(document.frmMain.ptname.value == "")
	{
		alert('กรุณาระบุ ชื่อ-สกุล ');
		document.frmMain.ptname.focus();		
		return false;
	}	
		if(document.frmMain.diag.value == "")
	{
		alert('กรุณาระบุการวินิจฉัย (diag)');
		document.frmMain.diag.focus();		
		return false;
	}	
	if(document.frmMain.surg.value == "")
	{
		alert('กรุณาระบุการผ่าตัด');
		document.frmMain.surg.focus();		
		return false;
	}	
		if(document.frmMain.inhalation_type.value == "")
	{
		alert('กรุณาระบุชนิดดมยา');
		document.frmMain.inhalation_type.focus();		
		return false;
	}
	if(document.frmMain.doctor.value == "")
	{
		alert('กรุณาระบุแพทย์');
		document.frmMain.doctor.focus();		
		return false;
	}	
	
	document.frmMain.submit();
}

</script>

<?
include("connect.inc");
$date_now = (date("Y")).date("-m-d");


	$sql = "SELECT * FROM ipcard  WHERE an = '".$_GET['an']."' ";
	
	$result = mysql_query($sql)or die(mysql_error());
	
	$arr=mysql_fetch_array($result);
?>
<body>


<h1 class="f1" align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี</h1>
<h1 class="f1" align="center">ใบ SET ผ่าตัด --/--- FR-NUR-002/1 ,03 ,1 ต.ค.48</h1>
<form name="frmMain" method="post" onSubmit="JavaScript:return fncSubmit();" action="set_from_or_print.php" target="_blank">
  <table border="1" align="center" cellpadding="0" cellspacing="0" class="f1" style="border-collapse:collapse; border-color:#000;">
  <tr>
    <td bgcolor="#FF66CC"><div align="center">หอผู้ป่วย</div></td>
    <td><select name="ward" id="ward">
      <option value="">----กรุณาเลือก----</option>
      <option value="OPD">OPD</option>
      <option value="ER">ER</option>
      <option value="หอผู้ป่วยรวม" <? if($_GET['bedcode']=='42'){ echo "selected"; }?>>หอผู้ป่วยรวม</option>
      <option value="หอผู้ป่วยสูติ" <? if($_GET['bedcode']=='43'){ echo "selected"; }?>>หอผู้ป่วยสูติ</option>
      <option value="หอผู้ป่วยพิเศษ" <? if($_GET['bedcode']=='45'){ echo "selected"; }?>>หอผู้ป่วยพิเศษ</option>
      <option value="หอผู้ป่วยหนัก" <? if($_GET['bedcode']=='44'){ echo "selected"; }?>>หอผู้ป่วยหนัก</option>
      <option value="ไม่ระบุ">ไม่ระบุ</option>
    </select></td>
    <td bgcolor="#FF66CC"><div align="center">วัน/เดือน/ปี</div></td>
    <td><input type="text" name="date_surg" id="date_surg" value="<?=$date_now;?>" size="10">
    เวลา <SELECT NAME="time1">
    <option value="-" selected>-</option>
          <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
        </SELECT>
        :
        <SELECT NAME="time2">
        <option value="-" selected>-</option>
          <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
					//	if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
        </SELECT> </td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">HN</td>
    <td><input name="hn" type="text" id="hn" size="15" value="<?=$arr['hn'];?>"></td>
    <td bgcolor="#FF66CC">AN</td>
    <td><input name="an" type="text" id="an" size="15"  value="<?=$arr['an'];?>"></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">ชื่อ-สกุล</td>
    <td><input type="text" name="ptname" id="ptname"  value="<?=$arr['ptname'];?>"></td>
    <td bgcolor="#FF66CC">อายุ</td>
    <td><input type="text" name="age" id="age"  value="<?=$arr['age'];?>" ></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">สิทธิ </td>
    <td><input type="text" name="ptright" id="ptright"  value="<?=$arr['ptright'];?>"></td>
    <td bgcolor="#FF66CC">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">การวินิจฉัย</td>
    <td><input type="text" name="diag" id="diag"></td>
    <td bgcolor="#FF66CC">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">การผ่าตัด</td>
    <td><input type="text" name="surg" id="surg"></td>
    <td bgcolor="#FF66CC">ชนิดดมยา</td>
    <td><input type="text" name="inhalation_type" id="inhalation_type"></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">แพทย์</td>
    <td><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select></td>
    <td bgcolor="#FF66CC">หมายเหตุ</td>
    <td><label for="comment"></label>
      <textarea name="comment" id="comment" cols="45" rows="5"></textarea></td>
    </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="button" id="button" value="     ตกลง    ">  
    <a href="../nindex.htm">&lt;&lt;-เมนู;</a> <a href="set_from_print.php" target="_blank">รายงานใบ SET ผ่าตัด </a></td>
    </tr>
</table>
<br>
<div id="list2" style="position: absolute; left: 447px; top: 181px;"></div>
<br>

</form>


<?
include("set_from_list_ward.php");
?>


</body>
</html>
