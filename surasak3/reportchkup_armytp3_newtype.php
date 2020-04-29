<?
include("connect.inc");
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
	$nPrefix="25".$nPrefix;
?>	
<title>รายงานผลการตรวจสุขภาพกำลังพล ทบ. ประจำปี <?=$nPrefix;?> แยกตามหน่วยใหญ่ๆ</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<div id="no_print" > 
<a href ="../nindex.htm" >&lt;&lt; กลับหน้าหลัก</a>
<p align="center" style="font-weight:bold;">รายงานผลการตรวจสุขภาพกำลังพล ทบ. ประจำปี <?=$nPrefix;?>
</p>
<form name="form1" method="post" action="reportchkup_armytp3_newtype.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วย :
        <label>      
        <select name="camp" id="camp">
          <option value="all" selected>ทุกหน่วย</option>
          <option value="M04">โรงพยาบาลค่ายสุรศักดิ์มนตรี</option>
          <option value="MTB32">หน่วยขึ้นตรง มทบ.32</option>
          <option value="M02">ร.17 พัน.2</option>
          <option value="M05">ช.พัน.4 ร้อย4</option>
          <option value="M06">ร้อย.ฝรพ.3</option>
        </select>
        <input type="submit" name="button" id="button" value="ดูรายงาน">
        </label></td>
    </tr>
  </table>
  </div>
</form>
<?
if($_POST["act"]=="show"){
	if($_POST["camp"]=="all"){  //กำลังพลทั้งหมด
	$showcamp="ทุกหน่วย";
	$result="select * from condxofyear_so where yearcheck='$nPrefix' group by hn";
	}else if($_POST["camp"]=="MTB32"){
	$result="select * from condxofyear_so where yearcheck='$nPrefix' and (camp LIKE 'M03%' OR camp LIKE 'M07%' OR camp LIKE 'M08%' OR camp LIKE 'M10%')  group by hn";	
	}else{
	$showcamp=substr($_POST["camp"],4);	
	$result="select * from condxofyear_so where yearcheck='$nPrefix' and camp LIKE '$_POST[camp]%' group by hn";
	}
	//echo $result;
	$object=mysql_query($result) or die("Query condxofyear_so Error");
	$numtotal=mysql_num_rows($object);
	$sumchunyot1=0;
	$sumchunyot2=0;
	$sumchunyot3=0;
while($chkrows=mysql_fetch_array($object)){
	
		$sql1="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP 'ร.ต.' OR ptname REGEXP 'ร.ท.' OR ptname REGEXP 'ร.อ.' OR ptname REGEXP 'พ.ต.' OR ptname REGEXP 'พ.ท.' OR ptname REGEXP 'พ.อ.' OR ptname REGEXP 'พล.ต.' OR ptname REGEXP 'พลตรี')";
		//echo $sql1."<br>";
		$query1=mysql_query($sql1);
		$num1=mysql_num_rows($query1);
		if($num1 >0){
			$sumchunyot1++;
		}
		
		$sql2="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP 'ส.ต.' OR ptname REGEXP 'ส.ท.' OR ptname REGEXP 'ส.อ.' OR ptname REGEXP 'จ.ส.ต.' OR ptname REGEXP 'จ.ส.ท.' OR ptname REGEXP 'จ.ส.อ.' OR ptname REGEXP 'พลอาสา' OR ptname REGEXP 'พลอาสาสมัคร')";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		if($num2 >0){
			$sumchunyot2++;
		}
		
		$sql3="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP 'นาย' OR ptname REGEXP 'นาง ')";
		//echo $sql3."<br>";
		$query3=mysql_query($sql3);
		$num3=mysql_num_rows($query3);
		if($num3 >0){
			$sumchunyot3++;
		}			
		
}	
	
	
	

	$sqlhos=mysql_query("select pcuname from mainhospital where pcuid='1'");
	list($pcuname)=mysql_fetch_array($sqlhos);

	if($_POST["camp"]=="all"){  //กำลังพลที่เข้ารับการตรวจ
	$showcamp="ทุกหน่วย";
	$result1="select * from condxofyear_so where yearcheck='$nPrefix' group by hn";
	}else if($_POST["camp"]=="MTB32"){
	$showcamp="มณฑลทหารบกที่ 32";
	$result1="select * from condxofyear_so where yearcheck='$nPrefix' and (camp LIKE 'M03%' OR camp LIKE 'M07%' OR camp LIKE 'M08%' OR camp LIKE 'M10%')  group by hn";	
	}else{
		if($_POST["camp"]=="M04"){
			$showcamp="โรงพยาบาลค่ายสุรศักดิ์มนตรี";
		}else if($_POST["camp"]=="M02"){
			$showcamp="ร.17 พัน.2";
		}else if($_POST["camp"]=="M05"){
			$showcamp="ช.พัน.4 ร้อย4";
		}else if($_POST["camp"]=="M06"){
			$showcamp="ร้อย.ฝรพ.3";
		}	$result1="select * from condxofyear_so where yearcheck='$nPrefix' and camp LIKE '$_POST[camp]%' group by hn";
	}	
	$object1=mysql_query($result1) or die("Query condxofyear_so Error");
	$numnotchkup=mysql_num_rows($object1);
	$percentchkup=($numnotchkup*100)/$numtotal;
	$numchunyot1=0;
	$numchunyot2=0;
	$numchunyot3=0;
while($chkrows=mysql_fetch_array($object1)){
		
		$sql1="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP 'ร.ต.' OR ptname REGEXP 'ร.ท.' OR ptname REGEXP 'ร.อ.' OR ptname REGEXP 'พ.ต.' OR ptname REGEXP 'พ.ท.' OR ptname REGEXP 'พ.อ.' OR ptname REGEXP 'พลตรี') and (ptname NOT REGEXP 'ส.ต.' and ptname NOT REGEXP 'ส.ท.' and ptname NOT REGEXP 'ส.อ.' and ptname NOT REGEXP 'จ.ส.ต.' and ptname NOT REGEXP 'จ.ส.ท.' and ptname NOT REGEXP 'จ.ส.อ.') group by hn";
		//echo $sql1."<br>";
		$query1=mysql_query($sql1);
		$num1=mysql_num_rows($query1);
		if($num1 >0){
			$numchunyot1++;
		}
		
		$sql2="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP 'ส.ต.' OR ptname REGEXP 'ส.ท.' OR ptname REGEXP 'ส.อ.' OR ptname REGEXP 'จ.ส.ต.' OR ptname REGEXP 'จ.ส.ท.' OR ptname REGEXP 'จ.ส.อ.' OR ptname REGEXP 'พลอาสา' OR ptname REGEXP 'พลอาสาสมัคร') group by hn";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		if($num2 >0){
			$numchunyot2++;
		}
		
		$sql3="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP 'นาย' OR ptname REGEXP 'นาง ') group by hn";
		//echo $sql3."<br>";
		$query3=mysql_query($sql3);
		$num3=mysql_num_rows($query3);
		if($num3 >0){
			$numchunyot3++;
		}			
		
}	
		
?>
<!--รายงานแบบที่ 1-->
<strong>
<p align="center">บัญชียอดกำลังพล การตรวจร่างกายข้าราชการ และลูกจ้าง ประจำปี <?=$nPrefix;?><br>
</p>

<p align="center">รพ. ที่ทำการตรวจ <u><?=$pcuname;?></u><br>
หน่วยที่มารับการตรวจ <u><?=$showcamp;?></u>
</p>
</strong>
<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="11%" align="center"><strong>ยอดกำลังพลบรรจุจริง</strong></td>
    <td width="11%" align="center"><strong>กำลังพลเข้ารับการตรวจ</strong></td>
    <td width="13%" align="center"><strong>กำลังพลไม่เข้ารับการตรวจ</strong></td>
    <td width="24%" align="center"><strong>ยศ - ชื่อ ผู้ที่ไม่เข้ารับการตรวจ</strong></td>
    <td width="33%" align="center"><strong>สาเหตุที่ไม่เข้ารับการตรวจ</strong></td>
    <td width="8%" align="center"><p><strong>หมายเหตุ</strong></p>    </td>
  </tr>
  <? $total=$numtotal-$numnotchkup;?>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top"><?=$numtotal;?></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<?
	if($_POST["camp"]=="all"){  //กำลังพลทั้งหมด
	$showcamp="ทุกหน่วย";
	$sql="select * from condxofyear_so where yearcheck='$nPrefix' group by hn";
	}else if($_POST["camp"]=="MTB32"){
	$showcamp="มณฑลทหารบกที่ 32";
	$sql="select * from condxofyear_so where yearcheck='$nPrefix' and (camp LIKE 'M03%' OR camp LIKE 'M07%' OR camp LIKE 'M08%' OR camp LIKE 'M10%')  group by hn";	
	}else{
		if($_POST["camp"]=="M04"){
			$showcamp="โรงพยาบาลค่ายสุรศักดิ์มนตรี";
		}else if($_POST["camp"]=="M02"){
			$showcamp="ร.17 พัน.2";
		}else if($_POST["camp"]=="M05"){
			$showcamp="ช.พัน.4 ร้อย4";
		}else if($_POST["camp"]=="M06"){
			$showcamp="ร้อย.ฝรพ.3";
		}
	$sql="select * from condxofyear_so where yearcheck='$nPrefix' and camp LIKE '$_POST[camp]%' group by hn";
	}
	
	//echo $sql;
	$query=mysql_query($sql);
	$numchkup=mysql_num_rows($query);
	$age35=0;
	$age34=0;
	$normal=0;
	$unnormal=0;
	$sum301=0;
	$sum302=0;
	$sum303=0;
	$sum304=0;
	$sum305=0;
	$sum306=0;
	$sum307=0;
	$sum308=0;
	$sum309=0;
	$sum310=0;
	$sum311=0;
	$sum312=0;
	$risk=0;
	while($rows=mysql_fetch_array($query)){
		$chkage=substr($rows['age'],0,2);
		if($rows["prawat"]=="0" || $rows["prawat"]==""){  //กลุ่มปกติ
			if($chkage >= 35){ //อายุ 35 ปีขึ้นไป
				if($rows['stat_bs']=="ปกติ" && $rows['stat_chol']=="ปกติ" && $rows['stat_tg']=="ปกติ" && $rows['stat_hdl']!="ผิดปกติ" && $rows['stat_ldl']!="ผิดปกติ" && $rows['bp1'] < 140 && $rows['bmi'] < 30.0){
					$normal++;  //ปกติ
				}else{
					$risk++;  //กลุ่มเสี่ยง
				}
			}else{  //อายุต่ำกว่า 35 ปี
				if($rows['bp1'] < 140 && $rows['bmi'] < 30.0){
					$normal++;  //ปกติ
				}else{
					$risk++;  //กลุ่มเสี่ยง
				}
			}
		}else{  //กลุ่มป่วย
			$unnormal++;
		}
	
		//รายงานที่ 3
		if($rows["bmi"] >= 25.00 && $rows["bmi"] <=29.99){
			$sum301++;
		}
		if($rows["bmi"] >= 30.00){
			$sum302++;
		}
		
		
		$sql1="select * from condxofyear_so where row_id='".$rows["row_id"]."' and ptname NOT REGEXP 'หญิง' group by hn";
		//echo $sql1."<br>";
		$query1=mysql_query($sql1);
		$num1=mysql_num_rows($query1);
		if($num1 >0){
			if($rows["round_"] >= 91.44){
				$sum303++;
			}
		}
		
		$sql2="select * from condxofyear_so where row_id='".$rows["row_id"]."' and ptname REGEXP 'หญิง' group by hn";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		if($num2 >0){
			if($rows["round_"] >= 81.28){
				$sum303++;
			}
		}		
		
		
		if($chkage >= 35){ //อายุ 35 ปีขึ้นไป
			$age35++;
			if($rows['stat_chol']=="ผิดปกติ" || $rows['stat_tg']=="ผิดปกติ" || $rows['stat_hdl']=="ผิดปกติ" || $rows['stat_ldl']=="ผิดปกติ"){
				$sum304++;
				//echo $rows["ptname"]."<br>";
			}
			
			if($rows['stat_bs']=="ผิดปกติ"){
				$sum306++;
				//echo $rows["ptname"]."<br>";
			}	
			
			if($rows['stat_sgot']=="ผิดปกติ" || $rows['stat_sgpt']=="ผิดปกติ" || $rows['stat_alk']=="ผิดปกติ"){
				$sum307++;
				//echo $rows["ptname"]."<br>";
			}					
		}else{  //อายุต่ำกว่า 35 ปี
			$age34++;
		}
		
			$bp1=$rows['bp1'];
			if($bp1 >=140){
				$sum305++;
			}		
	}  //close while

$numnormal=$numnotchkup-$numchkup;
//echo "$numnormal=$numnotchkup-$numchkup";
$sumnormal=$normal+$numnormal;
//echo "$sumnormal=$normal+$numnormal";
$percentnormal= ($sumnormal*100)/$numnotchkup;
$percentrisk= ($risk*100)/$numnotchkup;
$percentunnormal= ($unnormal*100)/$numnotchkup;

//รายงานที่3
$percent301= ($sum301*100)/$numnotchkup;
$percent302= ($sum302*100)/$numnotchkup;
$percent303= ($sum303*100)/$numnotchkup;
$percent304= ($sum304*100)/$age35;
$percent305= ($sum305*100)/$numnotchkup;
$percent306= ($sum306*100)/$age35;
$percent307= ($sum307*100)/$age35;

?>
<!--รายงานแบบที่ 2-->
<strong>
<p align="center">แบบฟอร์มการรายงานสรุปผลการตรวจร่างกายประจำปี <?=$nPrefix;?><br>
</p>
<p align="center">หน่วยที่เข้ารับการตรวจร่างกาย (ชื่อหน่วยงาน)
  <u><?=$showcamp;?></u><br>
หน่วยที่ทำการตรวจ 
<u><?=$pcuname;?></u>
</p>
</strong>
<p><strong>1. ยอดของกำลังพลในหน่วยทั้งหมด</strong></p>
<table width="90%" border="1"  cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><strong>กำลังพล</strong></td>
    <td align="center"><strong>ยอดกำลังพล</strong></td>
    <td align="center"><strong>เข้ารับการตรวจ</strong></td>
    <td align="center"><strong>ไม่เข้ารับการตรวจ</strong></td>
  </tr>
  <tr>
    <td>1. นายทหารสัญญาบัตร</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$numchunyot1;?></td>
    <td align="center"><?=$totalchunyot1;?></td>
  </tr>
  <tr>
    <td>2. นายทหารชั้นประทวน</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$numchunyot2;?></td>
    <td align="center"><?=$totalchunyot2;?></td>
  </tr>
  <tr>
    <td>3. ลูกจ้างประจำ</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$numchunyot3;?></td>
    <td align="center"><?=$totalchunyot3;?></td>
  </tr>
  <tr>
    <td align="center"><strong>รวม</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center"><strong>
      <?=$numnotchkup;?>
    </strong></td>
    <td align="center"><strong>
      <?=$totalchkup;?>
    </strong></td>
  </tr>
  <tr>
    <td align="center"><strong>ร้อยละ</strong></td>
    <td align="center"><strong>100 %</strong></td>
    <td align="center"><strong>
      <?=number_format($percentchkup,2);?>
    </strong></td>
    <td align="center"><strong>
      <?=number_format($percentnotchkup,2);?>
    </strong></td>
  </tr>
</table>
<p><strong>2. การประเมินผลการตรวจ</strong></p>
<table width="90%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.1 กลุ่มปกติ</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sumnormal;?></td>
    <td>ร้อยละ
      <?=number_format($percentnormal,2);?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.2 กลุ่มเสี่ยง</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$risk;?></td>
    <td>ร้อยละ
      <?=number_format($percentrisk,2);?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.3 กลุ่มเป็นโรค</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$unnormal;?></td>
    <td>ร้อยละ
      <?=number_format($percentunnormal,2);?></td>
  </tr>
</table>
<p><strong>3. ผลการตรวจร่างกายและการตรวจของห้องปฏิบัติการ</strong></p>
<table width="90%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td colspan="3">3.1 กำลังพลที่มีภาวะน้ำหนักเกิน</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum301;?></td>
    <td>ร้อยละ
      <?=number_format($percent301,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.2 กำลังพลที่มีภาวะโรคอ้วน</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum302;?></td>
    <td>ร้อยละ
      <?=number_format($percent302,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.3 กำลังพลที่มีภาวะรอบเอวเกิน</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum303;?></td>
    <td>ร้อยละ
      <?=number_format($percent303,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.4 กำลังพลที่มีภาวะระดับไขมันในเลือดสูง</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum304;?></td>
    <td>ร้อยละ
      <?=number_format($percent304,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.5 กำลังพลที่มีภาวะความดันโลหิตสูง</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum305;?></td>
    <td>ร้อยละ
      <?=number_format($percent305,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.6 กำลังพลที่มีภาวะน้ำตาลในเลือดสูง</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum306;?></td>
    <td>ร้อยละ
      <?=number_format($percent306,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.7 กำลังพลที่มีภาวการณ์ทำงานของตับผิดปกติ</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum307;?></td>
    <td>ร้อยละ
      <?=number_format($percent307,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.8 กำลังพลที่มีภาวะโรคหัวใจ</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum308;?></td>
    <td>ร้อยละ
      <?=number_format($percent308,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.9 กำลังพลที่มีภาวะโรคเบาหวาน</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum309;?></td>
    <td>ร้อยละ
      <?=number_format($percent309,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.10 กำลังพลที่มีภาวะโรคเก๊าท์</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum310;?></td>
    <td>ร้อยละ
      <?=number_format($percent310,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.11 กำลังพลที่มีภาวะโรคถุงลมโป่งพอง</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum311;?></td>
    <td>ร้อยละ
      <?=number_format($percent311,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.12 กำลังพลที่มีความผิดปกติจากแอลกอฮอล์ (Alcoholic)</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>จำนวน&nbsp;&nbsp;
        <?=$sum312;?></td>
    <td>ร้อยละ
      <?=number_format($percent312,2);?></td>
  </tr>
</table>
<p><strong>4. การดำเนินการหรือแผนการดำเนินการของ รพ.ทบ.ในพื้นที่ ทภ.3 ในกำลังพลกลุ่มต่างๆ</strong></p>
<table width="90%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>4.1 กลุ่มปกติ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4.2 กลุ่มเสี่ยง</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4.3 กลุ่มเป็นโรค</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>หมายเหตุ : สำหรับรายละเอียดการดำเนินการ/โครงการ สามารถแนบท้ายเป็นเอกสารประกอบการรายงานได้</strong></td>
  </tr>
</table>
<p>&nbsp;</p>
<?
}
?>