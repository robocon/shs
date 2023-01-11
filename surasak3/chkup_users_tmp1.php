<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txtsarabun{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
</style>
<? 
include("connect.inc");
////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
	$nPrefix2="25".$nPrefix;
////*runno ตรวจสุขภาพ*/////////
?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>&nbsp;&nbsp;<a href ="regiment_data.php" >ข้อมูลสังกัดและผู้รับบริการ</a>
<p align="center" style="font-weight:bold;">นำเข้ารายชื่อผู้รับบริการ</p>
<form name="form1" method="post" action="chkup_users_tmp1.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">ปีงบประมาณ&nbsp;&nbsp;
    <? 
			   $Y=date("Y")+543;
			   $Y=$Y+1;
			   $date=date("Y")+543;
			  
				$dates=range(2560,$date+1);
				echo "<select name='year1'  class='txtsarabun'>";
				foreach($dates as $i){

				?>
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
	&nbsp;&nbsp;หน่วย :
        <label>      
        <select name="camp" id="camp" class="txtsarabun">
          <option value="all" selected>ทุกหน่วย</option>
		 <?
		 $sql="select distinct(camp) as camp from condxofyear_so where `yearcheck` = '$nPrefix2'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=$rows["camp"];
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <span style="margin-left:5px;"><input type="submit" name="button" id="button" class="txtsarabun" value="ดูรายงาน"></span>
        </label></td>
    </tr>
  </table>
</form>
<?php

if($_POST["act"]=="show"){
$nPrefix=$_POST["year1"];

	if($_POST["camp"]=="all"){
		$sql1="SELECT * FROM `condxofyear_so` WHERE `yearcheck` = '$nPrefix' 
		GROUP BY hn 
		ORDER BY camp ASC, age DESC";
	}else{
		$sql1="SELECT * FROM `condxofyear_so` WHERE `yearcheck` = '$nPrefix'
		AND `camp`='$_POST[camp]' 
		GROUP BY hn 
		ORDER BY age DESC";	
		
	}	
	//echo $sql1;
	$query1=mysql_query($sql1)or die ("Query condxofyear_so Error");
	$num=mysql_num_rows($query1);
$msql=mysql_query("select pcucode, pcuname, pcupart from mainhospital where pcuid='1'");		
list($pcucode,$pcuname,$pcupart)=mysql_fetch_row($msql);
	
?>

<div align="center"><strong>รายงานข้อมูลการตรวจร่างกายของกำลังพลกองทัพบก(รายบุคคล) ประจำปี</strong> <?=$nPrefix;?></div>
<div align="center"><strong>หน่วยสายแพทย์ที่ทำการตรวจ</strong>  <?="($pcucode) $pcuname";?></div>
<div align="center"><strong>หน่วยทหารที่มารับการตรวจ</strong>
  <? if($_POST["camp"]=="all"){ echo $pcupart;}else{ echo substr($_POST["camp"],4);}?>
</div>
<div align="center"><strong>จำนวน</strong> <?=$num;?> <strong>นาย</strong></div>
<br />
<div align="center">
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;" class="pdxpro">
  <tr>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>ยศ/คำนำหน้า</strong></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>ชื่อ</strong></td>
    <td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>นามสกุล</strong></td>
    <td width="3%"  align="center"  bgcolor="#FFFFFF"><strong>เลขบัตรประชาชน</strong></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>วัน/เดือน/ปีเกิด</strong></td>
	<td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>อายุ</strong></td>
    <td width="5%" align="center"><strong>รอบเอว</strong></td>
    <td width="5%" align="center"><strong>น้ำหนัก</strong></td>
    <td width="5%" align="center"><strong>ส่วนสูง</strong></td>
    <td width="5%" align="center"><strong>BMI</strong></td>
    <td width="7%" align="center"><strong>ความดันโลหิต</strong></td>
	<td width="7%" align="center"><strong>CBC</strong></td>
	<td width="7%" align="center"><strong>ข้อแนะนำ</strong></td>
	<td width="7%" align="center"><strong>UA</strong></td>
	<td width="7%" align="center"><strong>ข้อแนะนำ</strong></td>
	<td width="7%" align="center"><strong>เบาหวาน (FBS)</strong></td>
	<td width="7%" align="center"><strong>เก๊าฑ์ (URIC)</strong></td>
	<td width="7%" align="center"><strong>การทำงานของไต (BUN)</strong></td>
	<td width="7%" align="center"><strong>การทำงานของไต (CR)</strong></td>
	<td width="7%" align="center"><strong>ไขมันในเลือด (Cholesterol)</strong></td>
	<td width="7%" align="center"><strong>ไขมันในเลือด (Triglyseride)</strong></td>
	<td width="7%" align="center"><strong>การทำงานของตับ (AST)</strong></td>
	<td width="7%" align="center"><strong>การทำงานของตับ (ALT)</strong></td>
	<td width="7%" align="center"><strong>การทำงานของตับ (ALK)</strong></td>
	
  </tr>
  <?php
	while($rows=mysql_fetch_array($query1)){  
	$age=substr($rows["age"],0,2);	
	
	$opsql="select hn,yot,name,surname,idcard,sex, DAY(dbirth) as bday,MONTH(dbirth) as bmonth,(YEAR(dbirth)) as byear from opcard where hn='$rows[hn]'";
	//echo $opsql."<br>";
	$opquery=mysql_query($opsql);
	list($hn,$yot,$name,$surname,$idcard,$gender,$bday,$bmonth,$byear)=mysql_fetch_row($opquery);	
	
	$bday=sprintf("%02d", $bday);
	$bmonth=sprintf("%02d", $bmonth);
	$birthday="$bday/$bmonth/$byear";
	
	if(!empty($gender)){
		if($gender=="ช"){
			$sex="1";
		}else{
			$sex="2";
		}
	}else{
		$sex="";
	}	
	
	if($yot=="พลอาสาฯ" || $yot=="พลอาสา"){
		$yot="พลอาสาสมัคร";
	}else if($yot=="ส.ต."){
		$yot="สิบตรี";
	}else if($yot=="ส.ต.หญิง"){
		$yot="สิบตรีหญิง";
	}else if($yot=="ส.ท."){
		$yot="สิบโท";
	}else if($yot=="ส.ท.หญิง"){
		$yot="สิบโทหญิง";
	}else if($yot=="ส.อ."){
		$yot="สิบเอก";
	}else if($yot=="ส.อ.หญิง"){
		$yot="สิบเอกหญิง";
	}else if($yot=="จ.ส.ต."){
		$yot="จ่าสิบตรี";
	}else if($yot=="จ.ส.ต.หญิง"){
		$yot="จ่าสิบตรีหญิง";
	}else if($yot=="จ.ส.ท."){
		$yot="จ่าสิบโท";
	}else if($yot=="จ.ส.ท.หญิง"){
		$yot="จ่าสิบโทหญิง";
	}else if($yot=="จ.ส.อ."){
		$yot="จ่าสิบเอก";
	}else if($yot=="จ.ส.อ.หญิง"){
		$yot="จ่าสิบเอกหญิง";	
	}else if($yot=="ร.ต."){
		$yot="ร้อยตรี";
	}else if($yot=="ร.ต.หญิง"){
		$yot="ร้อยตรีหญิง";
	}else if($yot=="ร.ท."){
		$yot="ร้อยโท";
	}else if($yot=="ร.ท.หญิง"){
		$yot="ร้อยโทหญิง";
	}else if($yot=="ร.อ."){
		$yot="ร้อยเอก";
	}else if($yot=="ร.อ.หญิง"){
		$yot="ร้อยเอกหญิง";
	}else if($yot=="พ.ต."){
		$yot="พันตรี";
	}else if($yot=="พ.ต.หญิง"){
		$yot="พันตรีหญิง";
	}else if($yot=="พ.ท."){
		$yot="พันโท";
	}else if($yot=="พ.ท.หญิง"){
		$yot="พันโทหญิง";
	}else if($yot=="พ.อ."){
		$yot="พันเอก";
	}else if($yot=="พ.อ.หญิง"){
		$yot="พันเอกหญิง";	
	}else if($yot=="พล.ต."){
		$yot="พลตรี";
	}else if($yot=="พล.ต.หญิง"){
		$yot="พลตรีหญิง";
	}else if($yot=="พล.ท."){
		$yot="พลโท";
	}else if($yot=="พล.ท.หญิง"){
		$yot="พลโทหญิง";
	}else if($yot=="พล.อ."){
		$yot="พลเอก";
	}else if($yot=="พล.อ.หญิง"){
		$yot="พลเอกหญิง";
	}

if($rows["prawat"]=="0"){ $prawat="ไม่มีโรคประจำตัว";}else if($rows["prawat"]=="1"){ $prawat="ความดันโลหิตสูง";}else if($rows["prawat"]=="2"){ $prawat="เบาหวาน";}else if($rows["prawat"]=="3"){ $prawat="โรคหัวใจและหลอดเลือด";}else if($rows["prawat"]=="4"){ $prawat="ไขมันในเลือดสูง";}else if($rows["prawat"]=="5"){ $prawat="โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป";}else if($rows["prawat"]=="6"){ $prawat="โรคประจำตัวอื่นๆ";}else if($rows["prawat"]=="7"){ $prawat="โรคเก๊าท์";}else if($rows["prawat"]=="8"){ $prawat="โรคถุงลมโป่งพอง";}


if(!empty($rows["bp1"]) && !empty($rows["bp2"])){
	$bp63=$rows["bp1"]."/".$rows["bp2"];
}else{
	$bp63="";
}


if($rows["cigarette"]=="0"){
	$cigarette="ไม่เคยสูบบุหรี่";
}else if($rows["cigarette"]=="1"){
	$cigarette="เคยสูบ แต่เลิกแล้ว";
}else if($rows["cigarette"]=="2"){
	$cigarette="สูบบุหรี่ เป็นครั้งคราว";
}else if($rows["cigarette"]=="3"){
	$cigarette="สูบบุหรี่ เป็นประจำ";
}

if($rows["alcohol"]=="0"){
	$alcohol="ไม่เคยดื่ม";
}else if($rows["alcohol"]=="1"){
	$alcohol="เคยดื่ม แต่เลิกแล้ว";
}else if($rows["alcohol"]=="2"){
	$alcohol="ดื่ม เป็นครั้งคราว";
}else if($rows["alcohol"]=="3"){
	$alcohol="ดื่ม เป็นประจำ";
}


if($rows["exercise"]=="0"){
	$exercise="ไม่เคยออกกำลังกาย";
}else if($rows["exercise"]=="1"){
	$exercise="ออกกำลังกาย ต่ำกว่าเกณฑ์";
}else if($rows["exercise"]=="2"){
	$exercise="ออกกำลังกาย ตามเกณฑ์";
}	
  ?>
  <tr>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$yot;?></td>
    <td width="1%"  align="left"  bgcolor="#FFFFFF"><?=$name;?></td>
    <td width="2%"  align="left"  bgcolor="#FFFFFF"><?=$surname;?></td>
    <td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$idcard;?></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$birthday;?></td>
    <td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$age;?></td>
    <td align="center"><?=round($rows["round_"]);?></td>
    <td align="center"><?=round($rows["weight"]);?></td>
    <td align="center"><?=round($rows["height"]);?></td>
    <td align="center"><?=$rows["bmi"];?></td>
	<td align="center"><?=$bp63;?></td>	
	<td align="center"><?=$rows["stat_cbc"];?></td>
	<td align="center"><?=$rows["reason_cbc"];?></td>
	<td align="center"><?=$rows["stat_ua"];?></td>
	<td align="center"><?=$rows["reason_ua"];?></td>
	<td align="center"><?=$rows["bs"];?></td>
	<td align="center"><?=$rows["uric"];?></td>
	<td align="center"><?=$rows["bun"];?></td>
	<td align="center"><?=$rows["cr"];?></td>
	<td align="center"><?=$rows["chol"];?></td>
	<td align="center"><?=$rows["tg"];?></td>
	<td align="center"><?=$rows["sgot"];?></td>
	<td align="center"><?=$rows["sgpt"];?></td>
	<td align="center"><?=$rows["alk"];?></td>
  </tr>  
  <?php
	}
	?>
</table>	
</div>


<?php	
}	
?>	