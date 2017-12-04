<?php
include("connect.inc");
?>
<STYLE>
.font1 {
	font-family: "Angsana New";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</STYLE>
</head>

<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<br>
<form id="form1" name="form1" method="post" action="rpsum_dxofyear.php">
<table width="42%" border="0">
  <tr>
    <td height="31" align="center"><strong>ผลการประเมินผลการตรวจร่างกาย</strong></td>
  </tr>
  <tr>
    <td height="36" align="center">&nbsp;ปี :
      <select name="year" id="yr">
        <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
        <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
        <?php }?>
      </select>
       <input type="submit" name="search" id="search" value="ตกลง" /></td>
  </tr>
</table>
</form>
</div>
<br>
<?
if(isset($_POST['search'])){
	$cxrcount=0;
	
	$sql = "CREATE TEMPORARY TABLE emer SELECT * FROM `trauma` WHERE trauma ='trauma' and (date between '".($_POST['year']-1)."-01-01 00:00:00' and '".($_POST['year']-1)."-12-31 23:59:59') ";
	$rep = mysql_query($sql);
	
	$query2 = "select camp,bmi,age,bp1,bp2,cxr,hn,bs,chol,tg,sgot,sgpt,smbasic,round_ from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and camp not like '%M01%' ";
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);//จำนวนทั้งหมดที่มาตรวจ
	
	$query123 = "select *  from chkup_solider where idno like '".substr($_POST['year'],2,2)."%'";
	$aa3 = mysql_query($query123);
	$count2 = mysql_num_rows($aa3);
	
	while(list($camp,$bmi,$age,$bp1,$bp2,$cxr,$nhn,$bs,$chol,$tg,$sgot,$sgpt,$smbasic,$round) = mysql_fetch_array($aa2)){
		$query3 = "SELECT * FROM `opday` WHERE hn='$nhn' AND icd10 like 'I%' AND (substring(icd10,2,2) between '20' and '52') and (thidate between '".($_POST['year']-1)."-01-01 00:00:00' and '".($_POST['year']-1)."-12-31 23:59:59')";//โรคหัวใจ
		$aa3 = mysql_query($query3);
		$count3 = mysql_num_rows($aa3);
		if($count3>0){
			$cxrcount++;
		}
		
		$query4 = "SELECT * FROM `emer` WHERE hn='$nhn' ";//อุบัติเหตุ
		$aa4 = mysql_query($query4);
		$count4 = mysql_num_rows($aa4);
		if($count4>0){
			$trauma++;
		}
		
		$query = "select sex from opcard where hn='".$nhn."'";
		$aa = mysql_query($query);
		$result = mysql_fetch_array($aa);
		
		if($smbasic=="ไม่พบความเสี่ยง"){
			$stat_sum1++;
		}elseif($smbasic=="พบความเสี่ยงเบื้องต้นต่อโรค"){
			$stat_sum2++;
		}elseif($smbasic=="ป่วยด้วยโรคเรื้อรัง"){
			$stat_sum3++;
		}

		if($bmi>=21.50&&$bmi<=29.99){
			$bmi1++;
		}
		elseif($bmi>=30.00){
			$bmi2++;
		}
		
		if($result['sex']=="ญ"){
			if($round>80){
				$round1++;
			}
		}elseif($result['sex']=="ช"){
			if($round>90){
				$round1++;
			}
		}
		
		if($chol>240||$tg>200){
			$stat_cholcount1++;
		}
		
		if($bp1>140||$bp2>90){
			$bpcount1++;
		}
		
		if($bs>126){
			$stat_bscount1++;
		}
		
		if($sgot>80||$sgpt>80){
			$stat_sgotcount1++;
		}
		
		
	}
?>
<strong class="font1">ผลการประเมินผลการตรวจร่างกาย</strong>
<table width="100%" border="1" class="font1" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
  <tr>
<td width="5%" rowspan="2" align="center"><strong>ลำดับ</strong></td><td width="66%" rowspan="2" align="center"><strong>ชื่อตัวชี้วัด</strong></td><td width="13%" rowspan="2" align="center"><strong>เกณฑ์/เป้าหมาย</strong></td><td colspan="2" align="center"><strong>ผลที่ได้</strong></td>
</tr>
<tr>
<td width="8%" align="center"><strong>จำนวน</strong></td><td width="8%" align="center"><strong>ร้อยละ</strong></td>
</tr>
<tr>
  <td align="center">1</td>
  <td>จำนวนกำลังพลที่ต้องเข้ารับการตรวจสุขภาพประจำปี</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$count2?></td>
  <td align="center">100.0</td>
</tr>
<tr>
  <td align="center">2</td>
  <td>ร้อยละของกำลังพลที่เข้ารับการตรวจสุขภาพ</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$count?></td>
  <td align="center"><?=round(($count*100)/$count2,2)?></td>
</tr>
<tr>
  <td align="center">3</td>
  <td>กำลังพลกลุ่มปกติ</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$stat_sum1?></td>
  <td align="center"><?=round(($stat_sum1*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">4</td>
  <td>กำลังพลกลุ่มเสี่ยง</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$stat_sum2?></td>
  <td align="center"><?=round(($stat_sum2*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">5</td>
  <td>กำลังพลที่มีโรค</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$stat_sum3?></td>
  <td align="center"><?=round(($stat_sum3*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">6</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวะน้ำหนักเกิน (BMI = 21.5-29.9)</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$bmi1?></td>
  <td align="center"><?=round(($bmi1*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">7</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวะโรคอ้วน (BMI &gt; 30)</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$bmi2?></td>
  <td align="center"><?=round(($bmi2*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">8</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวะรอบเอวเกิน (ชาย&gt;90 ,หญิง&gt;80 ซม.)</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$round1?></td>
  <td align="center"><?=round(($round1*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">9</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวะระดับไขมันในเลือดสูง (chol&gt;240 และหรือ TG&gt;200)</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$stat_cholcount1?></td>
  <td align="center"><?=round(($stat_cholcount1*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">10</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวะความดันโลหิตสูง (BP&gt;140/90 mmHg)</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$bpcount1?></td>
  <td align="center"><?=round(($bpcount1*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">11</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวะน้ำตาลในเลือดสูง (FBS&gt;126 mg%)</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$stat_bscount1?></td>
  <td align="center"><?=round(($stat_bscount1*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">12</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวการณ์ทำงานของตับผิดปกติ (SGOT&gt;80u/l และ หรือ SGPT&gt;80u/l)</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$stat_sgotcount1?></td>
  <td align="center"><?=round(($stat_sgotcount1*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">13</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีภาวะโรคหัวใจ</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$cxrcount?></td>
  <td align="center"><?=round(($cxrcount*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">14</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่เจ็บป่วยจากอุบัติเหตุจำแนกตามประเภทของการเกิดอุบัติเหตุ</td>
  <td align="center">&nbsp;</td>
  <td align="center"><?=$trauma?></td>
  <td align="center"><?=round(($trauma*100)/$count,2)?></td>
</tr>
<tr>
  <td align="center">15</td>
  <td>จำนวน และ ร้อยละของกำลังพลที่มีผลการทดสอบสมรรถภาพร่างกายผ่านเกณฑ์</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
</tr>
</table>
<?
}
?>