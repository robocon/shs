
<?php
   //print"<br><b>รายชื่อผู้ที่ตรวจสุขภาพซ้ำกัน</b>";
 include("connect.inc");
   $query="SELECT  hn,ptname,camp1,COUNT(*) AS duplicate FROM  condxofyear_so where yearcheck ='2558' and camp1 !=''  GROUP BY hn  HAVING duplicate > 1";
   $result = mysql_query($query);
     $n=0;
 while (list ($hn,$ptname,$camp,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n,</td>\n".
              // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>HN: $hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>ชื่อ: $ptname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>สังกัด: $camp</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนครั้งที่ซ้ำ = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
?>

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
<form id="form1" name="form1" method="post" action="solider3_58.php">
  <table width="42%" border="0" align="center">
    <tr>
    <td height="31" align="center"><strong>รายงานการตรวจร่างกายประจำปี ทภ.3</strong></td>
  </tr>
  <tr>
   
     <td align="center" ><strong>สังกัด (ตรวจสุขภาพ) : </strong></td></tr>
  <tr>
    <td><select name="camp"  id="camp">
    
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
	///if($_POST['camp']=='ฝสส.มทบ.32') $_POST['camp']="M0319";
//	if($_POST['camp']=='ฝสห.มทบ.32') $_POST['camp']="M0320";
	
	if($_POST['camp']==''){
		$query123 = "select count(*) as sum from chkup_solider where yearchkup like '".substr($_POST['year'],2,2)."%'   ";
		
		$sqlall = "SELECT camp1,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric,smbasic,smdm,smht,smstr,smobe,round_,chol,tg,bs,sgot,sgpt,sum1,sum2,sum3,sum4,sum5,rs_sum21,rs_sum22,rs_sum23,rs_sum24,rs_sum25,rs_sum51,rs_sum52,rs_sum53 FROM condxofyear_so WHERE yearcheck =  '".$_POST['year']."' AND  camp1 like 'D%'  ";
		
	}else{
		$query123 = "select goup,count(*) as sum  from chkup_solider where yearchkup like '".substr($_POST['year'],2,2)."%'  and camp like '%".$_POST['camp']."%' group by goup ";
		$sqlall = "SELECT camp1,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric,smbasic,smdm,smht,smstr,smobe,round_,chol,tg,bs,sgot,sgpt,sum1,sum2,sum3,sum4,sum5,rs_sum21,rs_sum22,rs_sum23,rs_sum24,rs_sum25,rs_sum51,rs_sum52,rs_sum53 FROM condxofyear_so WHERE yearcheck =  '".$_POST['year']."' AND  camp1 like '%".$_POST['camp']."%'  ";
		
	}

//echo $sqlall;
	$aa2 = mysql_query($query2);
	
	$aa9 = mysql_query($sqlall);
	$count = mysql_num_rows($aa9);//จำนวนทั้งหมดที่มาตรวจ
	
	
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
	
	while(list($camp,$bmi,$age,$bp1,$bp2,$cxr,$stat_ua,$nhn,$stat_hct,$stat_bs,$stat_chol,$stat_tg,$stat_bun,$stat_cr,$stat_sgot,$stat_sgpt,$stat_alk,$stat_uric,$smbasic,$smdm,$smht,$smstr,$smobe,$round,$chol,$tg,$bs,$sgot,$sgpt,$smbasic1,$smbasic2,$smbasic3,$smbasic4,$smbasic5,$rs_sum21,$rs_sum22,$rs_sum23,$rs_sum24,$rs_sum25,$rs_sum51,$rs_sum52,$rs_sum53) = mysql_fetch_array($aa9)){
			
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
			
			
			
			if($smbasic5=="ป่วยด้วยโรคเรื้อรัง"){
				$stat_sum5++;
				if($rs_sum51=="DM"){
					$stat_dm2++;
				}
				if($rs_sum52=="HT"){
					$stat_ht2++;
				}
				if($rs_sum53=="DLP"){
					$stat_str2++;
				}
				if($smobe=="Y"){
					$stat_obe2++;
				}
			}else if($smbasic3=="มีภาวะน้ำหนักเกิน" || $smbasic4=="มีค่าความดันโลหิตเกินค่าปกติ" ||$smbasic2=="พบความเสี่ยงเบื้องต้นต่อโรค"){
				$stat_sum3++;
				if($rs_sum21=="น้ำตาล"){
					$stat_dm1++;
				}if($rs_sum22=="ไขมัน"){
					$stat_dm1_1++;
				}if($rs_sum23=="ยูริค"){
					$stat_dm1_2++;
				}if($rs_sum24=="ตับ"){
					$stat_dm1_3++;
				}if($rs_sum25=="ไต"){
					$stat_dm1_4++;
				}
				if($smbasic4=="มีค่าความดันโลหิตเกินค่าปกติ"){
					$stat_ht1++;
				}
				
				if($smbasic3=="มีภาวะน้ำหนักเกิน"){
					$stat_obe1++;
				}
			}	 
			else if($smbasic1=="ปกติ (ไม่พบความเสี่ยง)"){
				$stat_sum1++;	
			
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
			
			
			
			
			if($smbasic5=="ป่วยด้วยโรคเรื้อรัง"){
				$stat_sum6++;
				if($rs_sum51=="DM"){
					$stat_dm2++;
				}
				if($rs_sum52=="HT"){
					$stat_ht2++;
				}
				if($rs_sum53=="DLP"){
					$stat_str2++;
				}
				if($smobe=="Y"){
					$stat_obe2++;
				}
			}elseif($smbasic3=="มีภาวะน้ำหนักเกิน" || $smbasic4=="มีค่าความดันโลหิตเกินค่าปกติ" ||$smbasic2=="พบความเสี่ยงเบื้องต้นต่อโรค"){
				$stat_sum4++;
				if($rs_sum21=="น้ำตาล"){
					$stat_dm3++; }
					if($rs_sum22=="ไขมัน"){
					$stat_dm3_1++;
					}if($rs_sum23=="ยูริค"){
					$stat_dm3_2++;
					}if($rs_sum24=="ตับ"){
					$stat_dm3_3++;
					}if($rs_sum25=="ไต"){
					$stat_dm3_4++;
				}
				if($smbasic4=="มีค่าความดันโลหิตเกินค่าปกติ"){
					$stat_ht3++;
				}
				if($smbasic3=="มีภาวะน้ำหนักเกิน" ){
					$stat_obe3++;
				} 
			}
			else if($smbasic1=="ปกติ (ไม่พบความเสี่ยง)"){
				$stat_sum2++;
			}
		}
		//$_POST['camp']=$camp;
	}
	
	
	//เป็นโรค
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
<br>
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
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-โรคที่ต้องเฝ้าระวังในกำลังพลกลุ่มเสี่ยง </td>
        </tr>
        <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.โรค เบาหวาน จำนวน ....<? echo $stat_dm1+$stat_dm3;?>.... ราย</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.โรค ไขมันในเลือด จำนวน ....<? echo $stat_dm1_1+$stat_dm3_1;?>.... ราย</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.โรค เก๊าท์ จำนวน ....<? echo $stat_dm1_2+$stat_dm3_2;?>.... ราย</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.โรค ตับ จำนวน ....<? echo $stat_dm1_3+$stat_dm3_3;?>.... ราย</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.โรค ไต จำนวน ....<? echo $stat_dm1_4+$stat_dm3_4;?>.... ราย</td>
          </tr>
       
          <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.โรค ความดันโลหิตสูง จำนวน ....<? echo $stat_ht1+$stat_ht3;?>.... ราย</td>
          </tr>
          <tr>
          <td>        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.โรค  อ้วน จำนวน ....<? echo $stat_obe1+$stat_obe3;?>.... ราย</td>
        </tr>
        
   
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-การปฏิบัติของ รพ.ทบ.ทภ.3 สำหรับกำลังพลกลุ่มเสี่ยงต้องเฝ้าระวัง.....ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม.....</td>
        </tr>
             <br>
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
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-โรคที่ตรวจพบในกลุ่มผู้ป่วย  </td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.โรค เบาหวาน จำนวน ....<? echo $stat_dm2+$stat_dm4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.โรค ความดันโลหิตสูง จำนวน ....<? echo $stat_ht2+$stat_ht4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.โรค  ไขมันในเลือดสูง จำนวน ....<? echo $stat_str2+$stat_str4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.โรค  อ้วน จำนวน ....<? echo $bmi4;?>.... ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-การปฏิบัติของ รพ.ทบ.ทภ.3 สำหรับกำลังพลกลุ่มผู้ป่วย.....ส่งต่อเพื่อรักษา.....</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
</table>
<br>

<?php


    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

  $camp111 = $_POST['camp'];
	 print "<font face='Angsana New' size='3'>รายชื่อผู้ที่ไม่ได้เข้ารับการตรวจสุขภาพประจำปี $year ";
	 print "<font face='Angsana New' size='2'>แผนก/ฝ่าย $camp111   <br>";   
    print "<font face='Angsana New' size='2'><b>รายงานวันที่ $Thidate</b> ";
  
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$num=1;
?>
<table>
 <tr>
   <th bgcolor=6495ED><font size='2'>#</th>
  <th bgcolor=6495ED><font size='2'>HN</th>
  <th bgcolor=6495ED><font size='2'>ชื่อ</th>
  <th bgcolor=6495ED><font size='2'>ตำแหน่ง</th>
    <th bgcolor=6495ED><font size='2'>idno</th>
    <th bgcolor=6495ED><font size='2'>เหตุผล</th>
	

<?php
 include("connect.inc");
 $query="SELECT hn,camp,position,idno  FROM chkup_solider WHERE camp like '%".$_POST['camp']."%' ORDER by goup,idno";
  $result = mysql_query($query)or die("Query failed");
    while (list ($hn,$camp,$group,$idno) = mysql_fetch_row ($result)) {	

		$tbsql="select * from condxofyear_so where hn='$hn' and yearcheck =  '".$_POST['year']."'  ";
  		$tbresult = mysql_query($tbsql)or die("Query failed");
		//echo $tbsql."</br>";
		$num1=mysql_num_rows($tbresult);
		//echo "--->".$num1."</br>";
		if($num1 < 1){

$sql = "Select yot,name,surname From opcard where hn = '$hn' ";
	list($yot,$name,$surname)  = mysql_fetch_row(Mysql_Query($sql));

$fullname=$yot.''.$name.'&nbsp;'.$surname;
if($dr!=""){
	$dr=(substr($dr,0,4)+543)."-".substr($dr,5);
}
if($opd!=""){
	$opd=(substr($opd,0,4)+543)."-".substr($opd,5);
}
 	print("<tr>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$hn</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$fullname</td>\n".
//	"<td bgcolor=F5DEB3><font face='Angsana New'>$camp</td>\n".    
	"<td bgcolor=F5DEB3><font face='Angsana New'>$group</td>\n".    
	"<td bgcolor=F5DEB3 ><font face='Angsana New'>$idno</td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'></td>\n".  
	" </tr>\n");
$num++;
}       
	}
include("unconnect.inc");
//แสดงรายการคืนเงิน
?>




<br><br>
	<?
}

?>

</body>
</html>