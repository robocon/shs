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
<form id="form1" name="form1" method="post" action="solider3.php">
  <table width="42%" border="0" align="center">
    <tr>
    <td height="31" align="center"><strong>รายงานการตรวจร่างกายประจำปี ทภ.3</strong></td>
  </tr>
  <tr>
    <td height="36" align="center">
          กลุ่ม :  
<select  name='camp'>
<option value='' >--เลือกสังกัด--</option>
<option value=''>ทั้งหมด</option>
<!--<option value='พลเรือน'>พลเรือน</option>-->
<option value='ร.17 พัน2'>ร.17 พัน2</option>
<option value='ร.พ.ค่ายสุรศักดิ์มนตรี'>ร.พ.ค่ายสุรศักดิ์มนตรี</option>
<option value='ช.พัน4'>ช.พัน4</option>
<option value='ร้อยฝึกรบพิเศษประตูผา'>ร้อยฝึกรบพิเศษประตูผา</option>
<option value='บก.มทบ.32'>บก.มทบ.32</option>
<option value='กกพ.มทบ.32'>กกพ.มทบ.32</option>
<option value='กขว.,ฝผท.มทบ.32'>กขว.,ฝผท.มทบ.32</option>
<option value='กยก.มทบ.32'>กยก.มทบ.32</option>
<option value='กกบ.มทบ.32'>กกบ.มทบ.32</option>
<option value='กกร.มทบ.32'>กกร.มทบ.32</option>
<option value='ฝคง.มทบ.32'>ฝคง.มทบ.32</option>
<option value='ฝกง.มทบ.32'>ฝกง.มทบ.32</option>
<option value='ฝสก.มทบ.32'>ฝสก.มทบ.32</option>
<!--<option value='ฝปบฝ.มทบ.32'>ฝปบฝ.มทบ.32</option>-->
<option value='ผพธ.มทบ.32'>ผพธ.มทบ.32</option>
<option value='อก.ศาล มทบ.32'>อก.ศาล มทบ.32</option>
<option value='ฝสวส.มทบ.32'>ฝสวส.มทบ.32</option>
<option value='ฝธน.มทบ.32'>ฝธน.มทบ.32</option>
<option value='อศจ.มทบ.32'>อศจ.มทบ.32</option>
<option value='ร้อย.มทบ.32'>ร้อย.มทบ.32</option>
<option value='สขส.มทบ.32'>สขส.มทบ.32</option>
<option value='รจ.มทบ.32'>รจ.มทบ.32</option>
<option value='ผยย.มทบ.32'>ผยย.มทบ.32</option>
<option value='ฝสส.มทบ.32'>ฝสส.มทบ.32</option>
<option value='ฝสห.มทบ.32'>ฝสห.มทบ.32</option>
<option value='ร้อย.สห.มทบ.32'>ร้อย.สห.มทบ.32</option>
<option value='มว.ดย.มทบ.32'>มว.ดย.มทบ.32</option>
<option value='ผสพ.มทบ.32'>ผสพ.มทบ.32</option>
<option value='สรรพกำลัง มทบ.32'>สรรพกำลัง มทบ.32</option>
<option value='ศฝ.นศท.มทบ.32'>ศฝ.นศท.มทบ.32</option>
<option value='ศาล.มทบ.32'>ศาล.มทบ.32</option>
<option value='ศูนย์โทรศัพท์ มทบ.32'>ศูนย์โทรศัพท์ มทบ.32</option>
<option value='ผปบ.มทบ.32'>ผปบ.มทบ.32</option>
<option value='สัสดีจังหวัดลำปาง'>สัสดีจังหวัดลำปาง</option>
<option value='มว.คลัง สป.๓ฯ'>มว.คลัง สป.๓ฯ</option>
<option value='กรม ทพ.33'>กรม ทพ.33</option>
<option value='หน่วยทหารอื่นๆ'>หน่วยทหารอื่นๆ</option>
<!--<option value='aaug'>-----ตกค้างตั้งแต่ สค.------</option>
<option value='aร.17 พัน2'>ร.17 พัน2</option>
<option value='aหน่วยทหารอื่นๆ'>หน่วยทหารอื่นๆ</option>-->
</select>
&nbsp;ปี :
<select name="year" id="yr">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="ตกลง" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	$bmi1=0;
	$bmi2=0;
	$bmi3=0;
	$bmi4=0;
	$bmi5=0;
	$bpcount1=0;
	$bpcount2=0;
	$cxrcount1=0;
	$cxrcount2=0;
	$stat_uacount1=0;
	$stat_uacount2=0;
	$stat_hctcount1=0;
	$stat_hctcount2=0;
	$stat_bscount2=0;
	$stat_cholcount2=0;
	$stat_tgcount2=0;
	$stat_buncount2=0;
	$stat_crcount2=0;
	$stat_sgotcount2=0;
	$stat_sgptcount2=0;
	$stat_alkcount2=0;
	$stat_uriccount2=0;
	$tahan1=0;
	$tahan2=0;
	$tahan3=0;
	$stat_sum1=0;
	$stat_sum2=0;
	$stat_dm1=0;
	$stat_ht1=0;
	$stat_str1=0;
	$stat_obe1=0;
	$stat_dm2=0;
	$stat_ht2=0;
	$stat_str2=0;
	$stat_obe2=0;
	$stat_dm3=0;
	$stat_ht3=0;
	$stat_str3=0;
	$stat_obe3=0;
	$stat_dm4=0;
	$stat_ht4=0;
	$stat_str4=0;
	$stat_obe4=0;
	$y1 = $_POST['year']-543;
	$y2=$y1+1;
	if($_POST['camp']=='ฝสส.มทบ.32') $_POST['camp']="M0319";
	if($_POST['camp']=='ฝสห.มทบ.32') $_POST['camp']="M0320";
	
	if($_POST['camp']==''){
		$query123 = "select count(*) as sum from chkup_solider where idno like '".substr($_POST['year'],2,2)."%' and substr(left(camp,3),2) between '02' and '10'  ";
		
		$sqlall = "SELECT  a.camp,a.bmi,a.age,a.bp1,a.bp2,a.cxr,a.stat_ua,a.hn,a.stat_hct,a.stat_bs,a.stat_chol,a.stat_tg,a.stat_bun,a.stat_cr,a.stat_sgot,a.stat_sgpt,a.stat_alk,a.stat_uric,a.smbasic,a.smdm,a.smht,a.smstr,a.smobe,a.round_,a.chol,a.tg,a.bs,a.sgot,a.sgpt FROM condxofyear_so AS a, chkup_solider AS b WHERE a.status_dr =  'Y' AND a.yearcheck =  '".$_POST['year']."' AND b.hn = a.hn AND substr( left( a.camp, 3  ) , 2 ) BETWEEN  '02' AND  '10'";
		$_POST['camp']="มทบ.32";
		
	}else{
		$query123 = "select goup,count(*) as sum  from chkup_solider where idno like '".substr($_POST['year'],2,2)."%' and camp like '%".$_POST['camp']."%' group by goup ";
		$sqlall = "SELECT a.camp,a.bmi,a.age,a.bp1,a.bp2,a.cxr,a.stat_ua,a.hn,a.stat_hct,a.stat_bs,a.stat_chol,a.stat_tg,a.stat_bun,a.stat_cr,a.stat_sgot,a.stat_sgpt,a.stat_alk,a.stat_uric,a.smbasic,a.smdm,a.smht,a.smstr,a.smobe,a.round_,a.chol,a.tg,a.bs,a.sgot,a.sgpt FROM condxofyear_so AS a, chkup_solider AS b WHERE a.status_dr =  'Y' AND a.yearcheck =  '".$_POST['year']."' AND b.hn = a.hn and a.camp like '%".$_POST['camp']."%'  ";
	}

	$aa2 = mysql_query($query2);
	
	$aa9 = mysql_query($sqlall);
	$count = mysql_num_rows($aa9);//จำนวนทั้งหมดที่มาตรวจ
	if($_POST['camp']=="มทบ.32"){
		$count=970;
	}
	elseif($_POST['camp']=="ร้อย.สห.มทบ.32"){
		$count=54;
	}
	elseif($_POST['camp']=="กกบ.มทบ.32"){
		$count=7;
	}
	elseif($_POST['camp']=="สัสดีจังหวัดลำปาง"){
		$count=51;
	}
	elseif($_POST['camp']=="ฝคง.มทบ.32"){
		$count=7;
	}
	elseif($_POST['camp']=="ช.พัน4"){
		$count=54;
	}
	
	$aa3 = mysql_query($query123);
	while($rep3 = mysql_fetch_array($aa3)){
		$count33+=$rep3['sum'];//จำนวนทั้งหมดที่ต้องตรวจ
		if(substr($rep3['goup'],0,3)=="G11"){
			$tahan31=$rep3['sum'];//นายทหาร
		}
		elseif(substr($rep3['goup'],0,3)=="G12"|substr($rep3['goup'],0,3)=="G21"){
			$tahan32=$rep3['sum'];//นายสิบ
		}
		else{
			$tahan33=$rep3['sum'];
		}
	}
	$percent1=($count*100)/$count33;
	
	while(list($camp,$bmi,$age,$bp1,$bp2,$cxr,$stat_ua,$nhn,$stat_hct,$stat_bs,$stat_chol,$stat_tg,$stat_bun,$stat_cr,$stat_sgot,$stat_sgpt,$stat_alk,$stat_uric,$smbasic,$smdm,$smht,$smstr,$smobe,$round,$chol,$tg,$bs,$sgot,$sgpt) = mysql_fetch_array($aa9)){
			
		$query = "select goup,sex from opcard where hn='".$nhn."'";
		$aa = mysql_query($query);
		$result = mysql_fetch_array($aa);
		$code = substr($result['goup'],0,3);
		
		if($bmi<18.50){
			$bmi1++;
		}
		elseif($bmi>=18.50&&$bmi<=24.99){
			$bmi2++;
		}
		elseif($bmi>=25.00&&$bmi<=29.99){
			$bmi3++;
		}
		elseif($bmi>=30.00){
			$bmi4++;
		}
		if($result['sex']=="ญ"&&$round>80){
			$roundcount++;
		}
		elseif($result['sex']=="ช"&&$round>90){
			$roundcount++;
		}
		
		if($chol>240||$tg>200){
			$cholcount++;
		}
		
		if($bs>126){
			$bscount++;
		}
		
		if($sgot>80||$sgpt>80){
			$sgcount++;
		}
		
		$age = substr($age,0,2);
		if($age<=35){
			$count2++; 
			if($bp1>140||$bp2>90){
				$bpcount1++;
			}
			if($cxr=="ผิดปกติ"){
				$cxrcount1++;
			}
			if($stat_ua=="ผิดปกติ"){
				$stat_uacount1++;
			}
			if($stat_hct=="ผิดปกติ"){
				$stat_hctcount1++;
			}
			if($smbasic=="ไม่พบความเสี่ยง"){
				$stat_sum1++;
			}elseif($smbasic=="พบความเสี่ยงเบื้องต้นต่อโรค"){
				$stat_sum3++;
				if($smdm=="Y"){
					$stat_dm1++;
				}
				if($smht=="Y"){
					$stat_ht1++;
				}
				if($smstr=="Y"){
					$stat_str1++;
				}
				if($smobe=="Y"){
					$stat_obe1++;
				}	 	
			}elseif($smbasic=="ป่วยด้วยโรคเรื้อรัง"){
				$stat_sum5++;
				if($smdm=="Y"){
					$stat_dm2++;
				}
				if($smht=="Y"){
					$stat_ht2++;
				}
				if($smstr=="Y"){
					$stat_str2++;
				}
				if($smobe=="Y"){
					$stat_obe2++;
				}
			}
		}
		
		elseif($age>35){
			$count3++;
			if($bp1>140||$bp2>90){
				$bpcount2++;
			}
			if($cxr=="ผิดปกติ"){
				$cxrcount2++;
			}
			if($stat_ua=="ผิดปกติ"){
				$stat_uacount2++;
			}
			if($stat_hct=="ผิดปกติ"){
				$stat_hctcount2++;
			}
			if($stat_bs=="ผิดปกติ"){
				$stat_bscount2++;
			}
			if($stat_chol=="ผิดปกติ"){
				$stat_cholcount2++;
			}
			if($stat_tg=="ผิดปกติ"){
				$stat_tgcount2++;
			}
			if($stat_bun=="ผิดปกติ"){
				$stat_buncount2++;
			}
			if($stat_cr=="ผิดปกติ"){
				$stat_crcount2++;
			}
			if($stat_sgot=="ผิดปกติ"){
				$stat_sgotcount2++;
			}
			if($stat_sgpt=="ผิดปกติ"){
				$stat_sgptcount2++;
			}
			if($stat_alk=="ผิดปกติ"){
				$stat_alkcount2++;
			}
			if($stat_uric=="ผิดปกติ"){
				$stat_uriccount2++;
			}
			if($smbasic=="ไม่พบความเสี่ยง"){
				$stat_sum2++;
			}elseif($smbasic=="พบความเสี่ยงเบื้องต้นต่อโรค"){
				$stat_sum4++;
				if($smdm=="Y"){
					$stat_dm3++;
				}
				if($smht=="Y"){
					$stat_ht3++;
				}
				if($smstr=="Y"){
					$stat_str3++;
				}
				if($smobe=="Y"){
					$stat_obe3++;
				}
			}elseif($smbasic=="ป่วยด้วยโรคเรื้อรัง"){
				$stat_sum6++;
				if($smdm=="Y"){
					$stat_dm4++;
				}
				if($smht=="Y"){
					$stat_ht4++;
				}
				if($smstr=="Y"){
					$stat_str4++;
				}
				if($smobe=="Y"){
					$stat_obe4++;
				}
			}
		}
		//$_POST['camp']=$camp;
	}
	
	if($_POST['camp']=='M0319') $_POST['camp']="ฝสส.มทบ.32";
	if($_POST['camp']=='M0320') $_POST['camp']="ฝสห.มทบ.32";

	$allcount = $count;
	?>
	<table width="100%" class="font1">
    	<tr>
    	  <td colspan="3" align="center"><strong>แบบรายงานสรุปผลการตรวจร่างกาย ประจำปี 
   	      <?=$_POST['year']?></strong></td>
   	    </tr>
        <tr>
        <td colspan="3" align="center"><strong>รพ.ทบ.ที่ทำการตรวจ ..................โรงพยาบาลค่ายสุรศักดิ์มนตรี...........................</strong></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><strong>นามหน่วยที่มารับการตรวจ................<?=$_POST['camp']?>...................</strong></td>
        </tr>
        <tr>
          <td>1. ยอดของกำลังพลในหน่วยทั้งหมด</td>
          <td width="23%" align="center"></td>
          <td width="26%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.1 จำนวน</td>
          <td align="center"><?=$count33?></td>
          <td> ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.2 ร้อยละ</td>
          <td align="center">100</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>2. ยอดของกำลังพลที่เข้ารับการตรวจ</td>
          <td align="center"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.1 จำนวน</td>
          <td align="center"><?=$count;?></td>
          <td> ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.2 ร้อยละ</td>
          <td align="center"><?=number_format(((100*$count)/$count33),2)?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>3. การประเมินผลการตรวจ</td>
          <td align="center"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.1 กลุ่มปกติ </td>
          <td>จำนวน
          <?=$stat_sum1+$stat_sum2;?> ราย</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.2 กลุ่มเสี่ยง </td>
          <td>จำนวน
          <?=$stat_sum3+$stat_sum4;?> ราย</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.3 กลุ่มเป็นโรค </td>
          <td>จำนวน
          <?=$stat_sum5+$stat_sum6?> ราย</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
      </tr>
        <tr>
          <td width="51%">4. ผลการตรวจร่างกายและการตรวจของห้องปฏิบัติการ</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.1 กำลังพลที่มีภาวะและน้ำหนักเกิน ( BMI = 25.1-29.9 )</td>
          <td>จำนวน <?=$bmi3?>            ราย </td>
          <td>ร้อยละ <?=number_format(((100*$bmi3)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.2 กำลังพลที่มีภาวะโรคอ้วน ( BMI &gt; 30 )</td>
          <td>จำนวน            <?=$bmi4?>
          ราย </td>
          <td>ร้อยละ <?=number_format(((100*$bmi4)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.3 กำลังพลที่มีภาวะรอบเอวเกิน ( ชาย &gt; 90 ซม.,หญิง &gt; 80 ซม. )</td>
          <td>จำนวน
            <?=$roundcount?>
          ราย </td>
          <td>ร้อยละ <?=number_format(((100*$roundcount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.4 กำลังพลที่มีภาวะระดับไขมันในเลือดสูง<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Chol &gt; 240 และ/หรือ TG &gt; 200 )</td>
          <td>จำนวน
            <?=$cholcount?>
          ราย </td>
          <td>ร้อยละ <?=number_format(((100*$cholcount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.5 กำลังพลที่มีภาวะความดันโลหิตสูง ( BP &gt;140 / 90 mmHg  )</td>
          <td>จำนวน
            <?=$bpcount1+$bpcount2;?>
            ราย </td>
          <td>ร้อยละ <?=number_format(((100*($bpcount1+$bpcount2))/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.6 กำลังพลที่มีภาวะน้ำตาลในเลือดสูง ( FBS &gt; 126 mg% ) </td>
          <td>จำนวน
            <?=$bscount?>
            ราย </td>
          <td>ร้อยละ <?=number_format(((100*$bscount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.7 กำลังพลที่มีภาวการณ์ทำงานของตับผิดปกติ <br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(SGOT &gt; 80 u/l และหรือ SGPT &gt; 80 u/l) </td>
          <td>จำนวน
            <?=$sgcount?>
            ราย </td>
          <td>ร้อยละ <?=number_format(((100*$sgcount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.8 กำลังพลที่มีภาวะโรคหัวใจ</td>
          <td>จำนวน
            
            - ราย </td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.9 กำลังพลที่เจ็บป่วยจากอุบัติเหตุจำแนกตามประเภท<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ของการเกิดอุบัติเหตุ</td>
          <td>จำนวน
            
            - ราย </td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.10 กำลังพลที่มีผลการทดสอบสมรรถภาพร่างกายผ่านเกณฑ์</td>
          <td>จำนวน
            
            - ราย </td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        </table>
<div style="page-break-before:always;"></div>
<div style="page-break-before:always"></div>

        <table width="100%" class="font1">
        <tr>
          <td width="100%">5.สรุปผลการตรวจร่างกายฯ จำแนกเป็น 3 กลุ่ม (100%)</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;5.1 กลุ่มปกติ ..
          <?=$stat_sum1+$stat_sum2?>.. ราย คิดเป็นร้อยละ...<?=round((($stat_sum1+$stat_sum2)*100)/$count,2)?>......</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-อายุไม่เกิน 35 ปี บริบูรณ์ ..<?=$stat_sum1?>.. ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-อายุมากกว่า 35 ปี บริบูรณ์ ..<?=$stat_sum2?>.. ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-การปฏิบัติของ รพ.ทบ.ทภ.3 สำหรับกำลังพลกลุ่มปกติ.....ให้คำแนะนำการดูแลตนเอง และตรวจคัดกรองซ้ำทุก 1 ปี......</td>
        </tr>

        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;5.2 กลุ่มเสี่ยงต้องเฝ้าระวัง ..<?=$stat_sum3+$stat_sum4?>.. ราย คิดเป็นร้อยละ....<?=round((($stat_sum3+$stat_sum4)*100)/$count,2)?>.....</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-อายุไม่เกิน 35 ปี บริบูรณ์ ..<?=$stat_sum3?>.. ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-อายุมากกว่า 35 ปี บริบูรณ์ ..<?=$stat_sum4?>.. ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-โรคที่ต้องเฝ้าระวังในกำลังพลกลุ่มเสี่ยง 5 ลำดับแรก</td>
        </tr>
        <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.โรค เบาหวาน จำนวน ....<? echo $stat_dm1+$stat_dm3;?>.... ราย</td>
          </tr>
          <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.โรค ความดันโลหิตสูง จำนวน ....<? echo $stat_ht1+$stat_ht3;?>.... ราย</td>
          </tr>
          <tr>
          <td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.โรค  หลอดเหลือสมองตีบตัน จำนวน ....<? echo $stat_str1+$stat_str3;?>.... ราย</td>
          </tr>
          <tr>
          <td>        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.โรค  อ้วน จำนวน ....<? echo $stat_obe1+$stat_obe3;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-การปฏิบัติของ รพ.ทบ.ทภ.3 สำหรับกำลังพลกลุ่มเสี่ยงต้องเฝ้าระวัง.....ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม.....</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;5.3 กลุ่มผู้ป่วย ..<?=$stat_sum5+$stat_sum6?>.. ราย คิดเป็นร้อยละ....<?=round((($stat_sum5+$stat_sum6)*100)/$count,2)?>.....</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-อายุไม่เกิน 35 ปี บริบูรณ์ ..<?=$stat_sum5?>.. ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-อายุมากกว่า 35 ปี บริบูรณ์ ..<?=$stat_sum6?>.. ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-โรคที่ตรวจพบในกลุ่มผู้ป่วย 5 ลำดับแรก </td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.โรค เบาหวาน จำนวน ....<? echo $stat_dm2+$stat_dm4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.โรค ความดันโลหิตสูง จำนวน ....<? echo $stat_ht2+$stat_ht4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.โรค  หลอดเหลือสมองตีบตัน จำนวน ....<? echo $stat_str2+$stat_str4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.โรค  อ้วน จำนวน ....<? echo $stat_obe2+$stat_obe4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-การปฏิบัติของ รพ.ทบ.ทภ.3 สำหรับกำลังพลกลุ่มผู้ป่วย.....ส่งต่อเพื่อรักษา.....</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
</table>
<br><br>
	<?
}

?>
</body>
</html>