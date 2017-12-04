
<!--<h1 class="forntsarabun">คลินิคเบาหวาน</h1>-->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<!--<h1 class="forntsarabun">สถิติแผนกรังสีกรรม</h1>-->
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td width="64"  align="right">เลือกปี</td>
    <td width="387" >
      <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp;  <a href="hd_from.php" class="forntsarabun">ลงข้อมูลใหม่</a> &nbsp;</td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="ค้นหา"){
	
	$date1=($_POST['y_start'])-543;
	
	include("../connect.inc");
	
			
///////////////  ร้อยละของผู้ป่วย DM ที่มีค่า BP < 130/80 mmHg ///////////		
	$listbp = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   opd_hd  WHERE date_hd  like '".$date1."-".$m."-%' and bp1 <130 AND bp2 <80";
		$result = mysql_query($selectsql);
		$arrp = mysql_fetch_array($result);
		array_push($listbp,$arrp[0]);
		

	}
	

			$strbp="SELECT COUNT(*) as countbp FROM  `opd_hd` WHERE bp1 <130 AND bp2 <80 and  date_hd like '".$date1.'%'."' ";
			$resultbp = mysql_query($strbp);
			$arr = mysql_fetch_array($resultbp);
	
		//	$avg=100*$arr['countbp']/$dbarr['count1'];
			
//////////////////////////////  ร้อยละของผู้ป่วย DM ที่มีค่า LDL < 100 mg/dl /////////////

$listldl = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and l_ldl < 100 ";
		$result = mysql_query($selectsql);
		$arrldl1 = mysql_fetch_array($result);
		array_push($listldl,$arrldl1[0]);
	}

			$strldl="SELECT COUNT(*) as countldl FROM  `diabetes_clinic` WHERE l_ldl <100 and  thidate like '".$date1.'%'."' ";
			$resultldl = mysql_query($strldl);
			$arrldl2= mysql_fetch_array($resultldl);
	
		//	$avgldl=100*$arrldl['countldl']/$dbarr['count1'];
			
///////////////////////////// ร้อยละของผู้ป่วย DM ที่มีค่า HbaA1c <7% //////////////////////		

$listhba = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic WHERE thidate like '".$date1."-".$m."-%' and l_hbalc < 7 ";
		$result = mysql_query($selectsql);
		$arrhba1 = mysql_fetch_array($result);
		array_push($listhba,$arrhba1[0]);
	
	}


			$strhba="SELECT COUNT(*) as counthba FROM  `diabetes_clinic` WHERE l_hbalc < 7 and  thidate like '".$date1.'%'."' ";
			$resulthba= mysql_query($strhba);
			$arrhba= mysql_fetch_array($resulthba);
			
			//$avghba=100*$arrhba['counthba']/$dbarr['count1'];


			
///////////////////////////// ร้อยละของผู้ป่วย DM ที่ได้รับการตรวจ BS  //////////////////////		

$list01 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and l_bs!='' ";
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		
	//	echo $selectsql;
		
		array_push($list01,$arr01[0]);
	
	}


			$str01="SELECT COUNT(*) as count01 FROM  `diabetes_clinic` WHERE  l_bs !='' and  thidate like '".$date1.'%'."' ";
			$result01= mysql_query($str01);
			$arr01= mysql_fetch_array($result01);			
			
///////////////////////////// ร้อยละของผู้ป่วย DM ที่ได้รับการตรวจ hbalc  //////////////////////		

$list02 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and 
		l_hbalc!='' ";
		$result = mysql_query($selectsql);
		$arr02 = mysql_fetch_array($result);
		array_push($list02,$arr02[0]);
	
	}


			$str02="SELECT COUNT(*) as count02 FROM  `diabetes_clinic` WHERE  l_hbalc !='' and  thidate like '".$date1.'%'."' ";
			$result02= mysql_query($str02);
			$arr02= mysql_fetch_array($result02);			
			
///////////////////////////// ร้อยละของผู้ป่วย DM ที่ได้รับการตรวจ LDL  //////////////////////		

$list03 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and 
		l_ldl!='' ";
		$result = mysql_query($selectsql);
		$arr03 = mysql_fetch_array($result);
		array_push($list03,$arr03[0]);
	
	}


			$str03="SELECT COUNT(*) as count03 FROM  `diabetes_clinic` WHERE  l_ldl !='' and  thidate like '".$date1.'%'."' ";
			$result03= mysql_query($str03);
			$arr03= mysql_fetch_array($result03);				
			

?>
<div class="forntsarabun" align="center">ดัชนีชี้วัดคุณภาพ รพ.ค่ายสุรศักดิ์มนตรี กอง/แผนก/ห้องตรวจโรค</div>
<div class="forntsarabun" align="center">FR - QMR - 004/7, 00,29 มี.ค. 48</div>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" class="forntsarabun">วัตถุประสงค์</td>
  <td rowspan="2" align="center" class="forntsarabun">
    <p>เครื่องชี้วัด</p></td>
<td rowspan="2" align="center" class="forntsarabun">เป้าหมาย</td>
<td rowspan="2" align="center" class="forntsarabun">ผู้รับผิดชอบ</td>
	<td rowspan="2" align="center" class="forntsarabun">ปี<br>
	  <?=($date1+543)?>
    </td>
  <td colspan="12" align="center" class="forntsarabun">ปี 
    <?=($date1+543)?>
  </td>
</tr>
<tr>
  <td align="center" class="forntsarabun">ม.ค.</td>
  <td align="center" class="forntsarabun">ก.พ.</td>
  <td align="center" class="forntsarabun">มี.ค.</td>
  <td align="center" class="forntsarabun">เม.ย.</td>
  <td align="center" class="forntsarabun">พ.ค.</td>
  <td align="center" class="forntsarabun">มิ.ย.</td>
  <td align="center" class="forntsarabun">ก.ค.</td>
  <td align="center" class="forntsarabun">ส.ค.</td>
  <td align="center" class="forntsarabun">ก.ย.</td>
  <td align="center" class="forntsarabun">ต.ค.</td>
  <td align="center" class="forntsarabun">พ.ย.</td>
  <td align="center" class="forntsarabun">ธ.ค.</td>
</tr>
<tr>
  <td rowspan="13" valign="top" class="forntsarabun">1.ด้านคุณภาพการ<br />
    ให้บริการพยาบาล</td>
<td valign="top" class="forntsarabun">- อัตราการควบคุมควาดันโลหิต &lt;130/80 mmHg</td>
  <td align="center" valign="top" class="forntsarabun">>80%</td>
  <td align="center" valign="top" class="forntsarabun">สุวิมล</td>

    <td align="center" class="forntsarabun"><?=$arr['countbp'];?></td>
    <? 
	for($x=0;$x<=11;$x++){
		echo "<td align='center' class='forntsarabun'>$listbp[$x]</td>";
	}
	?>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการควบคุมน้ำตาลในกระแสเลือด<br />
    1.prepadial BS 90-130<br />
    2.postpadial BS &lt;180</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td align="center" class="forntsarabun"><?=$arr02['count02'];?></td>
  <? 
	for($x=0;$x<=11;$x++){
		echo "<td align='center' class='forntsarabun'>$list02[$x]</td>";
	}
	?>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการควบคุมไขมันในเลือด<br />
    1.LDL &lt;100<br />
    2.LDL &lt;70 ในผู้ป่วยที่มีโรคหัวใจและ stroke</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td align="center" class="forntsarabun"><?=$arr03['count03'];?></td>
  <td align="center" class="forntsarabun"><?=$list03[0];?></td>
  <td align="center" class="forntsarabun"><?=$list03[1];?></td>
  <td align="center" class="forntsarabun"><?=$list03[2];?></td>
  <td align="center" class="forntsarabun"><?=$list03[3];?></td>
  <td align="center" class="forntsarabun"><?=$list03[4];?></td>
  <td align="center" class="forntsarabun"><?=$list03[5];?></td>
  <td align="center" class="forntsarabun"><?=$list03[6];?></td>
  <td align="center" class="forntsarabun"><?=$list03[7];?></td>
  <td align="center" class="forntsarabun"><?=$list03[8];?></td>
  <td align="center" class="forntsarabun"><?=$list03[9];?></td>
  <td align="center" class="forntsarabun"><?=$list03[10];?></td>
  <td align="center" class="forntsarabun"><?=$list03[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการควบคุมระดับ ca x P &lt; 55</td>
  <td align="center" valign="top" class="forntsarabun">&nbsp;</td>
  <td align="center" valign="top" class="forntsarabun">สุวิมล<br />
    พยอม</td>
  <td align="center" class="forntsarabun"><?=$arr04['count04'];?></td>
  <td align="center" class="forntsarabun"><?=$list04[0];?></td>
  <td align="center" class="forntsarabun"><?=$list04[1];?></td>
  <td align="center" class="forntsarabun"><?=$list04[2];?></td>
  <td align="center" class="forntsarabun"><?=$list04[3];?></td>
  <td align="center" class="forntsarabun"><?=$list04[4];?></td>
  <td align="center" class="forntsarabun"><?=$list04[5];?></td>
  <td align="center" class="forntsarabun"><?=$list04[6];?></td>
  <td align="center" class="forntsarabun"><?=$list04[7];?></td>
  <td align="center" class="forntsarabun"><?=$list04[8];?></td>
  <td align="center" class="forntsarabun"><?=$list04[9];?></td>
  <td align="center" class="forntsarabun"><?=$list04[10];?></td>
  <td align="center" class="forntsarabun"><?=$list04[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราความเข้มข้นของเลือด<br />
    1. HCT มากกว่าหรือเท่ากับ 30 mg/dl <br />
    2. HB มากกว่าหรือเท่ากับ</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td align="center" class="forntsarabun"><?=$arr05['count05'];?></td>
  <td align="center" class="forntsarabun"><?=$list05[0];?></td>
  <td align="center" class="forntsarabun"><?=$list05[1];?></td>
  <td align="center" class="forntsarabun"><?=$list05[2];?></td>
  <td align="center" class="forntsarabun"><?=$list05[3];?></td>
  <td align="center" class="forntsarabun"><?=$list05[4];?></td>
  <td align="center" class="forntsarabun"><?=$list05[5];?></td>
  <td align="center" class="forntsarabun"><?=$list05[6];?></td>
  <td align="center" class="forntsarabun"><?=$list05[7];?></td>
  <td align="center" class="forntsarabun"><?=$list05[8];?></td>
  <td align="center" class="forntsarabun"><?=$list05[9];?></td>
  <td align="center" class="forntsarabun"><?=$list05[10];?></td>
  <td align="center" class="forntsarabun"><?=$list05[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการควบคุม serum phosephate น้อยกว่า 4.5 mg/dl</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td align="center" class="forntsarabun"><?=$arr06['count06'];?></td>
  <td align="center" class="forntsarabun"><?=$list06[0];?></td>
  <td align="center" class="forntsarabun"><?=$list06[1];?></td>
  <td align="center" class="forntsarabun"><?=$list06[2];?></td>
  <td align="center" class="forntsarabun"><?=$list06[3];?></td>
  <td align="center" class="forntsarabun"><?=$list06[4];?></td>
  <td align="center" class="forntsarabun"><?=$list06[5];?></td>
  <td align="center" class="forntsarabun"><?=$list06[6];?></td>
  <td align="center" class="forntsarabun"><?=$list06[7];?></td>
  <td align="center" class="forntsarabun"><?=$list06[8];?></td>
  <td align="center" class="forntsarabun"><?=$list06[9];?></td>
  <td align="center" class="forntsarabun"><?=$list06[10];?></td>
  <td align="center" class="forntsarabun"><?=$list06[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการควบคุม serum  biocarbonate 22-26 meq/l</td> 
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td align="center" class="forntsarabun"><?=$arr07['count07'];?></td>
  <td align="center" class="forntsarabun"><?=$list07[0];?></td>
  <td align="center" class="forntsarabun"><?=$list07[1];?></td>
  <td align="center" class="forntsarabun"><?=$list07[2];?></td>
  <td align="center" class="forntsarabun"><?=$list07[3];?></td>
  <td align="center" class="forntsarabun"><?=$list07[4];?></td>
  <td align="center" class="forntsarabun"><?=$list07[5];?></td>
  <td align="center" class="forntsarabun"><?=$list07[6];?></td>
  <td align="center" class="forntsarabun"><?=$list07[7];?></td>
  <td align="center" class="forntsarabun"><?=$list07[8];?></td>
  <td align="center" class="forntsarabun"><?=$list07[9];?></td>
  <td align="center" class="forntsarabun"><?=$list07[10];?></td>
  <td align="center" class="forntsarabun"><?=$list07[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการควบคุม PTH น้อยกว่า 200-300 pg/dl </td>
  <td align="center" valign="top" class="forntsarabun">&lt;8%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการได้รับการฉีดวัคซีนตับอักเสบ บี และ ไข้หวัดใหญ่</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">สุวิมล<br />
    กนกพร</td>
  <td align="center" class="forntsarabun"><?=$arr09['count09'];?></td>
  <td align="center" class="forntsarabun"><?=$list09[0];?></td>
  <td align="center" class="forntsarabun"><?=$list09[1];?></td>
  <td align="center" class="forntsarabun"><?=$list09[2];?></td>
  <td align="center" class="forntsarabun"><?=$list09[3];?></td>
  <td align="center" class="forntsarabun"><?=$list09[4];?></td>
  <td align="center" class="forntsarabun"><?=$list09[5];?></td>
  <td align="center" class="forntsarabun"><?=$list09[6];?></td>
  <td align="center" class="forntsarabun"><?=$list09[7];?></td>
  <td align="center" class="forntsarabun"><?=$list09[8];?></td>
  <td align="center" class="forntsarabun"><?=$list09[9];?></td>
  <td align="center" class="forntsarabun"><?=$list09[10];?></td>
  <td align="center" class="forntsarabun"><?=$list09[11];?></td>
</tr>
<tr>
  <td valign="top" class="forntsarabun">- อัตราการไม่สูบบุหรี่</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">สุวิมล<br /> 
    พยอม
</td>
  <td align="center" class="forntsarabun"><?=$arrhba['counthba'];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[0];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[1];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[2];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[3];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[4];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[5];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[6];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[7];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[8];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[9];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[10];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[11];?></td>
  </tr>
<tr>
  <td height="31" valign="top" class="forntsarabun">- อัตราการได้รับความรู้จากโภชนาการ และสามารถ<br />
    จำกัดอาหารโซเดียมและโปรตีนได้ถูกต้อง</td>
  <td align="center" valign="top" class="forntsarabun">&gt;50%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td align="center" class="forntsarabun"><?=$arr01['count01'];?></td>
  <td align="center" class="forntsarabun"><?=$list01[0];?></td>
  <td align="center" class="forntsarabun"><?=$list01[1];?></td>
  <td align="center" class="forntsarabun"><?=$list01[2];?></td>
  <td align="center" class="forntsarabun"><?=$list01[3];?></td>
  <td align="center" class="forntsarabun"><?=$list01[4];?></td>
  <td align="center" class="forntsarabun"><?=$list01[5];?></td>
  <td align="center" class="forntsarabun"><?=$list01[6];?></td>
  <td align="center" class="forntsarabun"><?=$list01[7];?></td>
  <td align="center" class="forntsarabun"><?=$list01[8];?></td>
  <td align="center" class="forntsarabun"><?=$list01[9];?></td>
  <td align="center" class="forntsarabun"><?=$list01[10];?></td>
  <td align="center" class="forntsarabun"><?=$list01[11];?></td>
  </tr>
</table>

<div style="page-break-after:always;"></div>
<div style="page-break-before:always;"></div>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" class="forntsarabun">วัตถุประสงค์</td>
  <td rowspan="2" align="center" class="forntsarabun">
    <p>เครื่องชี้วัด</p></td>
<td rowspan="2" align="center" class="forntsarabun">เป้าหมาย</td>
<td rowspan="2" align="center" class="forntsarabun">ผู้รับผิดชอบ</td>
	<td rowspan="2" align="center" class="forntsarabun">ปี<br>
	  <?=($date1+543)?>
    </td>
  <td colspan="12" align="center" class="forntsarabun">ปี 
    <?=($date1+543)?>
  </td>
</tr>
<tr>
  <td align="center" class="forntsarabun">ม.ค.</td>
  <td align="center" class="forntsarabun">ก.พ.</td>
  <td align="center" class="forntsarabun">มี.ค.</td>
  <td align="center" class="forntsarabun">เม.ย.</td>
  <td align="center" class="forntsarabun">พ.ค.</td>
  <td align="center" class="forntsarabun">มิ.ย.</td>
  <td align="center" class="forntsarabun">ก.ค.</td>
  <td align="center" class="forntsarabun">ส.ค.</td>
  <td align="center" class="forntsarabun">ก.ย.</td>
  <td align="center" class="forntsarabun">ต.ค.</td>
  <td align="center" class="forntsarabun">พ.ย.</td>
  <td align="center" class="forntsarabun">ธ.ค.</td>
</tr>
<tr>
  <td rowspan="3" class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">- อัตราการได้รับความรู้จากนักกายภาพบำบัดและ<br />
สามารถออกกำลังกายได้ถูกต้อง</td>
  <td align="center" class="forntsarabun">&gt;50%</td>
  <td align="center" valign="top" class="forntsarabun">กนกพร</td>
  <td align="center" class="forntsarabun"><?=$arr['countbp'];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[0];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[1];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[2];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[3];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[4];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[5];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[6];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[7];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[8];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[9];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[10];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[11];?></td>
  </tr>
<tr>
  <td class="forntsarabun">- อัตราการได้รับการเตรียม vascular access ในผู้ป่วย<br />
    ไตวายเรื้อรัง ระยะที่ 4 </td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">- อัตราการได้รับคำแนะนำการบำบัดทดแทนไต ใน<br />
    ผู้ป่วยไตวายเรื้อรัง ระยะที่ 4 </td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td rowspan="5" valign="top" class="forntsarabun">2. ผู้ให้บริการ</td>
  <td class="forntsarabun">1. บุคลากรได้รับการอบรมตามแผน /งานของหน่วยงาน</td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">2. คะแนนประเมินทักษะเฉพาะงานผ่านเกณฑ์</td>
  <td align="center" class="forntsarabun">80%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">3. จำนวนครั้งที่เกิดอุบัติเหตุจากการทำงาน</td>
  <td align="center" class="forntsarabun">0 ครั้ง</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">4.บุคลากรได้รับการตรวจสุขภาพประจำปี</td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">บุญทิวา</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">5.ความพึงพอใจในงานของเจ้าหน้าที่ที่ปฏิบัติงาน</td>
  <td align="center" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">กนกพร</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td rowspan="2" valign="top" class="forntsarabun">3. ด้านการบริหาร<br />
    จัดการ</td>
  <td valign="top" class="forntsarabun">1. ความเพียงพอและความพร้อมใช้งานของอุปกรณ์เครื่องมือ<br />
    ทางการแพทย์</td>
  <td align="center" class="forntsarabun">90%</td>
  <td align="center" valign="top" class="forntsarabun">พยอม</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="forntsarabun">2. อัตราความพึงพอใจของหน่วยงานอื่นต่อห้องตรวจโรคไต</td>
  <td align="center" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">กนกพร</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
</table>
<? } ?>