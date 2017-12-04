<?php
include("connect.inc");
?>
<STYLE>
.font1 {
	font-family: "Angsana New";
	font-size:20px;
}

.font2 { font-family: "Angsana New"; font-size:20px; }

@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</STYLE>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
  <!--<a href="abnormal_dx_all.php">รายงานสรุปทุกหน่วย</a>-->
<table width="42%" border="0" align="center">
  <tr>
    <td height="31" align="center"><strong>รายงานการตรวจร่างกายประจำปี ทบ.</strong></td>
  </tr>
  <tr>
    <td height="36" align="center">
         สังกัด :  

<select name="camp"  id="camp">
    
     <option value="">ทั้งหมด</option>
      <option value="D01 รพ.ค่ายสุรศักดิ์มนตรี">รพ.ค่ายสุรศักดิ์มนตรี</option>
      <option value="D02 ศาล และ อก.ศาล มทบ.32">ศาล และ อก.ศาล มทบ.32</option>
      <option value="D03 ผปบ.มทบ.32">ผปบ.มทบ.32</option>
      <option value="D04 สง.สด.จว.ล.ป.">สง.สด.จว.ล.ป.</option>
      <option value="D05 กกบ.มทบ.32">กกบ.มทบ.32</option>
      <option value="D06 กยก.มทบ.32">กยก.มทบ.32</option>
      <option value="D07 กขว.มทบ.32">กขว.มทบ.32</option>
      <option value="D08 กกร.มทบ.32">กกร.มทบ.32</option>
      <option value="D09 ฝกง.มทบ.32">ฝกง.มทบ.32</option>
      <option value="D10 ฝสก.มทบ.32">ฝสก.มทบ.32</option> 
      <option value="D11 ฝธน.มทบ.32">ฝธน.มทบ.32</option>  
      <option value="D12 ฝสวส.มทบ.32">ฝสวส.มทบ.32</option> 
      <option value="D13 บก.มทบ.32">บก.มทบ.32</option> 
      <option value="D14 กกพ.มทบ.32">กกพ.มทบ.32</option>  
      <option value="D15 ฝคง.มทบ.32">ฝคง.มทบ.32</option> 
      <option value="D16 ฝอศจ.มทบ.32">ฝอศจ.มทบ.32</option> 
      <option value="D17 ผพธ.มทบ.32">ผพธ.มทบ.32</option>  
      <option value="D18 ฝสส.มทบ.32">ฝสส.มทบ.32</option> 
      <option value="D19 มว.ส.มทบ.32">มว.ส.มทบ.32</option> 
      <option value="D20 ผยย.มทบ.32">ผยย.มทบ.32</option>  
      <option value="D21 กอง รจ.มทบ.32">กอง รจ.มทบ.32</option>                                    
      <option value="D22 ร้อย.สห.มทบ.32">ร้อย.สห.มทบ.32</option>  
      <option value="D23 ฝสห.มทบ.32">ฝสห.มทบ.32</option>  
      <option value="D24 สขส.มทบ.32">สขส.มทบ.32</option>  
      <option value="D25 สรรพกำลัง มทบ.32">สรรพกำลัง มทบ.32</option>  
      <option value="D26 ร้อย.มทบ.32">ร้อย.มทบ.32</option>  
      <option value="D27 ผสพ.มทบ.32">ผสพ.มทบ.32</option>  
      <option value="D28 มว.ดย.มทบ.32">มว.ดย.มทบ.32</option>  
      <option value="D29 ศฝ.นศท.มทบ.32">ศฝ.นศท.มทบ.32</option>  
      <option value="D30 ร.17 พัน.2">ร.17 พัน.2</option>  
      <option value="D31 ช.พัน.4 ร้อย4">ช.พัน.4 ร้อย4</option>  
      <option value="D32 ร้อย.ฝรพ.3">ร้อย.ฝรพ.3</option>
        <option value="D34 กทพ.33">กทพ.33</option>
      <option value="D33 หน่วยทหารอื่นๆ">หน่วยทหารอื่นๆ</option>                            
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
	$sumg11=0;
	$sumg12=0;
	$sumg13=0;
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
	if($_POST['camp']==''){
		$query123 = "select chunyot,count(*) as sum  from chkup_solider   WHERE  yearchkup like '".substr($_POST['year'],2,2)."%' and camp like '%D'  group by chunyot  "; 
	
		$query2 = "SELECT chunyot1,camp,bmi,age FROM condxofyear_so   where yearcheck =  '".$_POST['year']."' AND  camp1 like '%D'   ";
		
	}else{
		
		$query123 = "select chunyot,count(*) as sum  from chkup_solider   WHERE  yearchkup like '".substr($_POST['year'],2,2)."%' and camp like '%".$_POST['camp']."%'  group by chunyot ";
		

		
		$query2 = "SELECT chunyot1,camp,bmi,age FROM condxofyear_so   where yearcheck =  '".$_POST['year']."' AND  camp1 like '%".$_POST['camp']."%'   ";
		
	
	
	}


		$count33 = mysql_query($query123);
		while($result1 = mysql_fetch_array($count33)){
		$re1 = substr($result1['chunyot'],0,4);
		if($re1 =="CH01"){
			$sumg11=$result1['sum'];
		}
		else if($re1 =="CH02"){
			$sumg12=$result1['sum'];
		}else{
			$sumg13=$result1['sum'];
		}
		}
		
		
		$suma = $sumg11+$sumg12+$sumg13;
		
		
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);
	$perce = $count*100/$suma;
	while(list($chunyot,$camp,$bmi,$age) = mysql_fetch_array($aa2)){
	$chunyot1=substr($chunyot,0,4);	
		if($chunyot1=="CH01"){
			$tahan1++;//นายทหาร
			//echo $result['yot']."<br>";
			//echo $nhn."<br>";
		}
		elseif($chunyot1=="CH02"){
			$tahan2++;//นายสิบ
			//echo $result['yot']."<br>";
			//echo $nhn."<br>";
		}
		/*elseif($code=="G14"){
			$tahan3++;//ลูกจ้างประจำ
		}*/
		else{
			$tahan3++;
			//echo $nhn."<br>";
		}
		
		if($bmi<18.50){
			$bmi1++;
		}
		elseif($bmi>=18.50&&$bmi<=22.90){
			$bmi2++;
		}
		elseif($bmi>=23.00&&$bmi<=24.90){
			$bmi3++;
		}
		elseif($bmi>=25.00&&$bmi<=29.90){
			$bmi4++;
		}
		elseif($bmi>=30.00){
			$bmi5++;
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
		}
		
	}
	

	$allcount = $count;
	?>
  <table width="100%" class="font1">
    <tr>
      <td colspan="4" align="center">บัญชีรายชื่อข้าราชการที่ป่วยเป็นโรค</td>
    </tr>
    <tr>
      <td colspan="4" align="center">การตรวจร่างกายประจำปี
     &nbsp;&nbsp;&nbsp;&nbsp;<?=$_POST['year']?></td>
    </tr>
    <tr>
      <td colspan="4" align="center">หน่วย
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$_POST['camp']?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>1. จำนวนข้าราชการที่บรรจุจริง</td>
      <td width="24%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- นายทหาร</td>
      <td><?=$sumg11?></td>
      <td>คน</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- นายสิบ</td>
      <td><?=$sumg12?></td>
      <td>คน</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- พลอาสาสมัคร, คนงาน, ลูกจ้าง</td>
      <td><?=$sumg13?></td>
      <td>คน</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</td>
      <td><?=$suma?></td>
      <td>คน</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>2. จำนวนข้าราชการที่รับการตรวจ</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- นายทหาร</td>
      <td><?=$tahan1?></td>
      <td>คน</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- นายสิบ</td>
      <td><?=$tahan2?></td>
      <td>คน</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- พลอาสาสมัคร, คนงาน, ลูกจ้าง</td>
      <td><?=$tahan3?></td>
      <td>คน</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</td>
      <td><?=$count?></td>
      <td>คน</td>
    </tr>
      <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เข้ารับการตรวจ</td>
      <td><?=number_format($perce, 2, '.', '')?></td>
      <td>เปอร์เซ็น</td>
    </tr>
  </table>
  <div style="page-break-after:always;"></div>
  <?
	include("abnormal_dx58.php");
?>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="font2">
  	  <tr>
  	    <td width="7%" colspan="2">ตรวจถูกต้อง</td>
  	    <td width="9%">&nbsp;</td>
  	    <td width="35%">&nbsp;</td>
  	    <td width="25%">&nbsp;</td>
      </tr>
  	  <tr>
  	    <td colspan="2">.......................................................................</td>
  	    <td width="25%">&nbsp;</td>
  	    <td >(ลงชื่อ) .......................................................</td>
  	    <td>กรรมการแพทย์ผู้ตรวจ</td>
      </tr>
  	  <tr>
  	    <td colspan="2">ตำแหน่ง ...ผอ.รพ.ค่ายสุรศักดิ์มนตรี....</td>
        <td width="25%">&nbsp;</td>
  	    <td >(ลงชื่อ) .......................................................</td>
  	    <td>กรรมการ จนท.แพทย์</td>
      </tr>
  	  <tr>
  	    <td colspan="3"></td>
  	    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.......................................................</td>
  	    <td>กรรมการ จนท.แพทย์</td>
      </tr>
</table>
  	  <?
}

?>
  	  
