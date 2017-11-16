<?php
include 'bootstrap.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<?php

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

?>
<title>พิมพ์ใบตรวจสุขภาพ <?=$title;?></title>
<style type="text/css">
	*{
		font-family: TH SarabunPSK;
	}
	.text{ font-size: 16px; }
	.text1{ font-size: 22px; }
	.text2{ font-size: 20px; }
	.text3{ font-size: 16px; }
	.text4{ font-size: 14px; }

	.texthead{ font-size: 25px; }
	.textsub{ font-size: 15px;}

	@media print{ #no_print{ display:none; } }
	#divprint{ page-break-after:always; }

	.theBlocktoPrint{ background-color: #000; color: #FFF; } 
	label{ display: block; }
	.etc label{ display: inline; }
</style>
</head>

<body>
<?php

$showpart = ( empty($_POST["camp"]) ) ? $_GET["camp"] : $_POST["camp"];
$xraydate ="18-09-2017";

$sql1 = "SELECT a.*, a.`HN` AS `hn`, 
b.`date_checkup` AS `show_date`, b.`name` AS `company_name`
FROM `out_result_chkup` AS a 
LEFT JOIN `chk_company_list` AS b ON b.`code` = a.`part` 
WHERE a.`part` = '$showpart' 
ORDER BY a.`row_id` ASC";

$row2 = mysql_query($sql1) or die ( mysql_error() );

$out_result_rows = mysql_num_rows($row2);
if( $out_result_rows == 0 ){
	echo "ยังไม่พบข้อมูลการบันทึกผลการซักประวัติ";
	exit;
}

while($result = mysql_fetch_assoc($row2)){

	$age = $result["age"];
	$hn = $result["hn"];
	$show_date = $result['show_date'];

	if( empty($show_date) ){
		$sqlcc = mysql_query("SELECT datechkup, branch
		FROM `opcardchk`
		WHERE `HN` = '".$hn."'");
		list($show_date, $branch)=mysql_fetch_array($sqlcc);   //18-09-60 น้องนัดแจ้งให้เปลี่ยนเป็นวันที่นัดตรวจ
	}
	

	// $sql2="SELECT * 
	// FROM out_result_chkup 
	// WHERE hn='".$hn."' 
	// AND part='".$result["part"]."'";
	// $query2=mysql_query($sql2);
	// $result=mysql_fetch_array($query2);

	// if(empty($age)){
	// 	$age = $result["age"];
	// }

	// if(empty($result['name'])){
		$ptname = $result['ptname'];
	// }else{
	// 	$ptname = $result['name']." ".$result['surname'];
	// }

	// $sex = $result['sex'];
	// $newdbirth = $result['dbirth'];
	// $hbd = calcage($newdbirth);
	
	$ht = $result['height']/100;
	$bmi = number_format($result['weight'] /($ht*$ht),2);
	
	// @todo $showdatelab ไม่ได้ใช้อะไร
    $strSQL11 = "SELECT date_format(`orderdate`,'%d-%m-%Y') as orderdate2 
    FROM `resulthead` 
    WHERE `hn` = '".$hn."' 
    AND ( 
		`clinicalinfo` ='ตรวจสุขภาพประจำปี60' 
		OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' 
		OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60' 
	) order by autonumber desc";  //โชว์ข้อมูล
	
    $objQuery11 = mysql_query($strSQL11);
    list($orderdate) = mysql_fetch_array($objQuery11);
	
	list($d,$m,$y) = explode("-",$orderdate);
	$yy = $y+543;
	$showdatelab = "$d/$m/$yy";

	// if( $_POST['camp'] == 'scg61' ){
	// 	$showdate="4-19 ตุลาคม 2560";
	// }
	
	$dateekg="$yy-$m";	
?>
<div id="divprint">
<table width="100%" border="0">
	<tr>
		<td colspan="2">
			<table width="100%">
				<tr>
					<td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
					<td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานผลการตรวจสุขภาพประจำปี <?=(date('Y') + 543);?></strong></td>
					<td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="top" class="texthead"><strong class="text2">โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305-6 ต่อ 1132</strong></td>
					<td align="center" valign="top" class="texthead">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="top" class="text3">
						<span class="text">
							<span class="text1">
								<span class="text2">
									<strong>
										หน่วยงาน : <?=$result['company_name'];?>
										วันที่ตรวจ <?=$show_date;?>
									</strong>
								</span>
							</span>
						</span>
					</td>
					<td align="center" valign="top" class="text3">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

  	<tr>
    	<td colspan="2">
			<table width="100%" border="0">
        		<tr>
          			<td>

					  	<table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            				<tr>
              					<td>
								  	<table width="100%" class="text1" >
                						<tr>
                  							<td  valign="top" class="text2">
												<strong class="text1"><u>ข้อมูลผู้ตรวจสุขภาพ</u></strong> 
												<strong>HN : <?=$hn?>&nbsp;&nbsp;</strong> 
												<strong>ชื่อ : </strong>
												<span style="font-size:24px">
													<strong><?=$ptname;?></strong>&nbsp;&nbsp;&nbsp;
													<?php if(!empty($age)){ ?>
														<strong>อายุ : </strong> 
														<strong><?=$age;?> ปี</strong>
													<?php } ?>
                    							</span>
											</td>
                						</tr>
              						</table>
			  					</td>
            				</tr>
          				</table>
						
		  			</td>
        		</tr>
        		<tr>
          			<td>
					  	<table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<table width="100%"  class="text1" >
										<tr>
											<td width="588" valign="top">
												<strong class="text" style="font-size:20px"><u>ตรวจร่างกายทั่วไป</u></strong>&nbsp;&nbsp;
												<span class="text3">
													<strong>น้ำหนัก : </strong><?=$result['weight']?>&nbsp;กก. 
													<strong>ส่วนสูง : </strong><?=$result['height']?>&nbsp;ซม. 
													<strong>BMI : </strong> <u><?=$bmi?> </u>&nbsp;&nbsp;
													<strong>BP : <u><? echo $result['bp1']; ?> / <? echo $result['bp2']; ?>mmHg. </u></strong>&nbsp;&nbsp;
													
													<?php if(!empty($result["bp3"]) && !empty($result["bp4"])){ ?>
														<strong>RE-BP : <u><?php echo $result['bp3']; ?> / <?php echo $result['bp4']; ?>mmHg. </u></strong>&nbsp;&nbsp;
													<?php } ?>

													<strong>T : </strong> <u><?=$result['temp']?> C</u>&nbsp;&nbsp;
													<strong>P : </strong> <u><?=$result['p']?> ครั้ง/นาที</u>&nbsp;&nbsp;
													<strong>R : </strong> <u><?=$result['rate']?> ครั้ง/นาที</u>
												</span>
											</td>
										</tr>
										<tr>
                  							<td valign="top">
												<strong style="font-size:20px;">ผลตรวจ : </strong>
												<span style="font-size:16px;"> ดัชนีมวลกาย 
												<?php 
												if($bmi == '0.00' ){
													echo "'ไม่ได้รับการตรวจ";
												} else if($bmi >= 18.5 && $bmi <= 22.99){
													echo "มีน้ำหนักตามเกณฑ์";
												}else{
													if($bmi < 18.5){ echo "มีน้ำหนักต่ำกว่าเกณฑ์";}
													if($bmi >= 23 && $bmi <= 24.99){ echo "เริ่มมีน้ำหนักเกินเกณฑ์";}
													if($bmi >= 25 && $bmi <= 29.99){ echo "มีน้ำหนักเกินเกณฑ์";}
													if($bmi >= 30 && $bmi <= 34.99){ echo "มีภาวะอ้วนค่อนข้างมาก";}
													if($bmi >= 35){ echo "มีภาวะอ้วนมาก";}
												}

												?>
												/ ความดันโลหิต  
												<?php 
					
												$bp1 = ( empty($result['bp3']) ) ? $result['bp1'] : $result['bp3'];
												$bp2 = ( empty($result['bp4']) ) ? $result['bp2'] : $result['bp4'];

												if($bp1 =='NO'){
														echo "ไม่ได้รับการตรวจ";
												}else  if($bp1 <= 130){
														echo "ปกติ";
												}else{
													if($bp1 >=140){ 
														echo "มีความดันโลหิตสูง ควรออกกำลังอย่างสม่ำเสมอ ลดอาหารที่มีรสเค็ม หรือพบแพทย์เพื่อทำการรักษา";
													}else if($bp1 >=131 && $bp1 < 140){
														echo "เริ่มมีภาวะความดันโลหิตสูง ควรออกกำลังกายอย่างสม่ำเสมอ";
													}
												}
				  								?>
				  								</span>
				  							</td>
                						</tr>
              						</table>
			  					</td>
            				</tr>
          				</table>
		  			</td>
        		</tr>
    		</table>
		</td>
  	</tr>
	<?php 
		$sql55="SELECT * 
		FROM resulthead 
		WHERE (profilecode='CBC' OR profilecode='UA')
		AND hn = '".$hn."' 
		AND ( clinicalinfo ='ตรวจสุขภาพประจำปี60' OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60' )  
		GROUP BY profilecode 
		ORDER BY `autonumber` desc";
		//echo $sql55;
		$query55 = mysql_query($sql55) or die( mysql_error() );
		$num=mysql_num_rows($query55);
		$arrresult55 = mysql_fetch_array($query55);    
		if($num==1 && $arrresult55["profilecode"]=="CBC"){
	?>            
	<tr>
    	<td colspan="2"  valign="top"><table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
			<tr>
				<td height="30" align="center"><strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong> </td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="50%" align="center" bgcolor="#CCCCCC"><strong>การตรวจเม็ดเลือด </strong></td>
							<td width="15%" align="center" bgcolor="#CCCCCC"><strong>ผลตรวจ</strong></td>
							<td width="18%" align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
							<td width="17%" align="center" bgcolor="#CCCCCC"><strong>สรุปผล</strong></td>
							<?php
							/*
							?>
							<td width="15%" align="center" bgcolor="#CCCCCC"><strong>สรุปผลการตรวจ</strong></td>
							<?php
							*/
							?>
						</tr>
						<?php 
							$sql="SELECT * 
							FROM resulthead 
							WHERE profilecode='CBC' 
							AND hn = '".$hn."' 
							AND ( clinicalinfo ='ตรวจสุขภาพประจำปี60' OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60' )  ORDER BY `autonumber` desc";
							$query = mysql_query($sql) or die( mysql_error() );
							$arrresult = mysql_fetch_array($query);
				
							/////

							$strSQL = "SELECT * 
							FROM resultdetail 
							WHERE autonumber='".$arrresult['autonumber']."' 
							AND ( 
								labcode = 'WBC' 
								|| labcode ='EOS' 
								|| labcode ='HCT' 
								|| labcode ='PLTC' 
								|| labcode ='NEU' 
								|| labcode ='LYMP' 
							) ";
							$objQuery = mysql_query($strSQL) or die( mysql_error() );

							$wbc_result = '';
							$neu_result = '';
							$eos_result = '';
							$hct_result = '';
							$lymp_result = '';
							$pltc_result = '';
							$cbc_rows = mysql_num_rows($objQuery);
							if($cbc_rows < 1){
								echo "<tr height='150'><td align='center' colspan='4' style='font-size: 20px; font-weight: bold;'>ไม่ได้รับการตรวจ</td></tr>";	
							}else{				
								while($objResult = mysql_fetch_array($objQuery)){

									if($objResult["labcode"]=="WBC"){
										$labmean="(การตรวจนับเม็ดเลือดขาว)";
										$wbc_result = $objResult["result"];

									}else if($objResult["labcode"]=="NEU"){
										$labmean="(การติดเชื้อแบคทีเรีย)";
										$neu_result = $objResult["result"];

									}else if($objResult["labcode"]=="LYMP"){
										$labmean="(การติดเชื้อไวรัส หรือมะเร็งเม็ดเลือด)";
										$lymp_result = $objResult["result"];

									}else if($objResult["labcode"]=="MONO"){
										$labmean="(โรคเกี่ยวกับการแพ้ หรือมะเร็งเม็ดเลือด)";
									}else if($objResult["labcode"]=="EOS"){
										$labmean="(อาการของโรคภูมแพ้ หรือพยาธิ)";
										$eos_result = $objResult["result"];

									}else if($objResult["labcode"]=="BASO"){
										$labmean="(กลุ่มโรคมะเร็งเม็ดเลือดขาว)";
									}else if($objResult["labcode"]=="ATYP"){
										$labmean="(***)";
									}else if($objResult["labcode"]=="BAND"){
										$labmean="(***)";
									}else if($objResult["labcode"]=="OTHER"){
										$labmean="(***)";
									}else if($objResult["labcode"]=="NRBC"){
										$labmean="(***)";
									}else if($objResult["labcode"]=="RBC"){
										$labmean="(เม็ดเลือดแดง)";
									}else if($objResult["labcode"]=="HB"){
										$labmean="(การตรวจวัดความเข้มข้นของฮีโมโกลบิน)";
									}else if($objResult["labcode"]=="HCT"){
										$labmean="(การวัดเม็ดเลือดแดงอัดแน่น)";
										$hct_result = $objResult["result"];

									}else if($objResult["labcode"]=="MCV"){
										$labmean="(การวัดปริมาตรเม็ดเลือดแดงในแต่ละเม็ด)";
									}else if($objResult["labcode"]=="MCH"){
										$labmean="(น้ำหนักของฮีโมโกลบินในเม็ดเลือดแดง)";
									}else if($objResult["labcode"]=="MCHC"){
										$labmean="(ความเข้มข้นฮีโมโกลบินในเม็ดเลือดแดง)";
									}else if($objResult["labcode"]=="PLTC"){
										$labmean="(การตรวจนับเกล็ดเลือดในเลือด)";
										$pltc_result = $objResult["result"];
										
									}else if($objResult["labcode"]=="PLTS"){
										$labmean="";
									}else if($objResult["labcode"]=="RBCMOR"){
										$labmean="(รูปร่างเม็ดเลือดแดง)";
									}
							
									if($objResult['flag']=='L' || $objResult['flag']=='H'){
										$objResult["result"]="<strong>".$objResult["result"]."</strong>";
										$showresult="ผิดปกติ";
									}else{
										$objResult["result"]=$objResult["result"];
										$showresult="ปกติ";
									}
									?>
									<tr height="23">
										<td><strong><?=$objResult["labcode"];?></strong> <font size="-1"><?=$labmean;?></font></td>
										<td align="center"><?=$objResult["result"];?></td>
										<td align="center"><?=$objResult["normalrange"];?></td>
										<td align="center"><?=$showresult;?></td>
										<?php
										/*
										?>
										<td align="center">
											<?php
												$lab_result = $objResult["result"];
												$pure_normalrange = str_replace(' ', '', $objResult["normalrange"]);
												list($normal_min, $normal_max) = explode('-', $pure_normalrange);
												// var_dump($normal_min);
												// var_dump($normal_max);
												// echo ( $normal_min >= $lab_result && $normal_max <= $lab_result ) ? 'ปกติ' : 'ผิดปกติ' ;

											?>
										</td>
										<?php
										*/
										?>
									</tr>
									<?php 
								}
							} // End while
							?>
							<tr height="23">
								<td colspan="4">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr> 
	<?php 
	}else if($num==1 && $arrresult55["profilecode"]=="UA"){ 
	?>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" height="77" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
      <tr>
        <td height="30" align="center"><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
      </tr>
      <tr>
        <td style="vertical-align: top;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
            <tr>
              <td width="49%" align="center" bgcolor="#CCCCCC"><strong>การตรวจปัสสาวะ</strong></td>
              <td width="14%" align="center" bgcolor="#CCCCCC"><strong>ผลตรวจ</strong></td>
              <td width="17%" align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
              <td width="17%" align="center" bgcolor="#CCCCCC"><strong>สรุปผล</strong></td>
            </tr>
            <? 
	$sql="SELECT * FROM resulthead WHERE profilecode='UA' and hn='".$hn."' and (clinicalinfo ='ตรวจสุขภาพประจำปี60' OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60' ) ORDER BY `autonumber` desc";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode ='SPGR' || labcode ='PHU' || labcode ='GLUU' || labcode ='PROU' || labcode ='WBCU' || labcode ='RBCU' ) ";
		//echo $strSQL;
		$objQuery = mysql_query($strSQL);
		$ua_rows = mysql_num_rows($objQuery);
		while($objResult = mysql_fetch_array($objQuery))
		{
			if($objResult["labcode"]=="COLOR"){
				$labmean="สีของปัสสาวะ";
			}else if($objResult["labcode"]=="APPEAR"){
				$labmean="ความใส";
			}else if($objResult["labcode"]=="SPGR"){
				$labmean="ความถ่วงจำเพาะ";
			}else if($objResult["labcode"]=="PHU"){
				$labmean="ความเป็นกรด";
			}else if($objResult["labcode"]=="BLOODU"){  //เลือดในปัสสาวะ
				$labmean="เลือดในปัสสาวะ";
				if($objResult["result"]=="Negative" || $objResult["result"]=="Trace"){
					$blooduvalue="ปกติ";
				}else{
					$blooduvalue="ผิดปกติ";
				}
			}else if($objResult["labcode"]=="PROU"){  //โปรตีนในปัสสาวะ
				$labmean="โปรตีนในปัสสาวะ";
				$provalue=$objResult["result"];
			}else if($objResult["labcode"]=="GLUU"){  //น้ำตาลในปัสสาวะ
				$labmean="น้ำตาลในปัสสาวะ";
				$gluuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="KETU"){
				$labmean="คีโตนในปัสสาวะ";
			}else if($objResult["labcode"]=="UROBIL"){
				$labmean="การทำลายเม็ดเลือดแดงสูง";
			}else if($objResult["labcode"]=="BILI"){
				$labmean="บิลิรูบินในปัสสาวะ";
			}else if($objResult["labcode"]=="NITRIT"){
				$labmean="ไนไตรท์ในปัสสาวะ";
			}else if($objResult["labcode"]=="WBCU"){  //เม็ดเลือดขาว
				$labmean="เม็ดเลือดขาว";
				$wbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="RBCU"){  //เม็ดเลือดแดง
				$labmean="เม็ดเลือดแดง";
				$rbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="EPIU"){
				$labmean="เซลล์เยื่อบุ";
			}else if($objResult["labcode"]=="BACTU"){
				$labmean="แบคทีเรีย";
			}else if($objResult["labcode"]=="YEAST"){
				$labmean="ยีสต์";
			}else if($objResult["labcode"]=="MUCOSU"){
				$labmean="";
			}else if($objResult["labcode"]=="AMOPU"){
				$labmean="";
			}else if($objResult["labcode"]=="CASTU"){
				$labmean="แท่งโปรตีน";
			}else if($objResult["labcode"]=="CRYSTU"){
				$labmean="ผลึก";
			}else if($objResult["labcode"]=="OTHERU"){
				$labmean="อื่นๆ";
			}
						
			if($objResult["labcode"]=="RBCU"){
			if($hn=="53-6092"){
				$showresultua="ผิดปกติ";
			}else{
					$rbculen=strlen($objResult6["result"]);
					if($rbculen >=5){
						$rbcu1=substr($objResult6["result"],0,2);
						$rbcu2=substr($objResult6["result"],3,2);
					}else if($rbculen ==4){
						$rbcu1=substr($objResult6["result"],0,1);
						$rbcu2=substr($objResult6["result"],2,2);						
					}else{
						$rbcu1=substr($objResult6["result"],0,1);
						$rbcu2=substr($objResult6["result"],2,1);
					}
					if($objResult6["result"] == "*" || $objResult6["result"] == "**"  || $objResult6["result"] == "--"){
						$showresultua="*";
					}else{									
						if($objResult6["result"] == "Negative" || ($rbcu1 >=0 && $rbcu2 <=1) && $objResult6["result"] != "*"){
							$showresultua="ปกติ";
						}else if($objResult6["result"] == "*"){
							$showresultua="*";
						}else{
							$showresultua="ผิดปกติ";
						}
					}	
			}
			}else{
				if($objResult['flag']=='L' || $objResult['flag']=='H' || $objResult['result']=='1+'|| $objResult['result']=='2+'|| $objResult['result']=='3+'|| $objResult['result']=='4+'|| $objResult['result']=='5+'|| $objResult['result']=='6+'|| $objResult['result']=='7+'|| $objResult['result']=='8+'|| $objResult['result']=='9+'){
					$objResult["result"]="<strong>".$objResult["result"]."</strong>";
					$showresultua="ผิดปกติ";
				}else{
					$objResult["result"]=$objResult["result"];
					$showresultua="ปกติ";
				}
			}
			
			if($objResult["labcode"]=="PROU" || $objResult["labcode"]=="GLUU"){
				$normalrange="Negative";
			}else{
				$normalrange=$objResult["normalrange"];
			}

		?>
            <tr height="23">
              <td><strong><?=$labmean;?></strong></td>
              <td align="center"><?=$objResult["result"];?></td>
              <td align="center"><?=$normalrange;?></td>
              <td width="3%" align="center"><?=$showresultua;?></td>
            </tr>
            <? }?>
            <tr height="23">
              <td>&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<? }else if($num < 1){ ?>
  <tr>
    <td colspan="2"  valign="top" style="line-height:10px;">&nbsp;</td>
  </tr>  
<? }else{ ?>  
  <tr>
    <td width="50%"  valign="top">		
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
	<tr>
		<td height="30" align="center">
			<strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong>		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="50%" align="center" bgcolor="#CCCCCC"><strong>การตรวจเม็ดเลือด </strong></td>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>ผลตรวจ</strong></td>
					<td width="18%" align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
					<td width="17%" align="center" bgcolor="#CCCCCC"><strong>สรุปผล</strong></td>
					<?php
					/*
					?>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>สรุปผลการตรวจ</strong></td>
					<?php
					*/
					?>
				</tr>
				<?php 
				$sql="SELECT * 
				FROM resulthead 
				WHERE profilecode='CBC' 
				AND hn = '".$hn."' 
				AND ( clinicalinfo ='ตรวจสุขภาพประจำปี60' 
					OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' 
					OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60' )  
				ORDER BY `autonumber` desc";
				$query = mysql_query($sql) or die( mysql_error() );
				$arrresult = mysql_fetch_array($query);
				// dump($sql);
				/////

				$strSQL = "SELECT * 
				FROM resultdetail 
				WHERE autonumber='".$arrresult['autonumber']."' 
				AND ( 
					labcode = 'WBC' 
					|| labcode ='EOS' 
					|| labcode ='HCT' 
					|| labcode ='PLTC' 
					|| labcode ='NEU' 
					|| labcode ='LYMP' 
				) ";
				$objQuery = mysql_query($strSQL) or die( mysql_error() );

				$wbc_result = '';
				$neu_result = '';
				$eos_result = '';
				$hct_result = '';
				$lymp_result = '';
				$pltc_result = '';
				$cbc_rows = mysql_num_rows($objQuery);
				if($cbc_rows < 1){

				  echo "<tr height='150'><td align='center' colspan='4' style='font-size: 20px; font-weight: bold;'>ไม่ได้รับการตรวจ</td></tr>";	
				}else{	

				while($objResult = mysql_fetch_array($objQuery)){

// dump($objResult);

					if($objResult["labcode"]=="WBC"){
						$labmean="(การตรวจนับเม็ดเลือดขาว)";
						$wbc_result = $objResult["result"];

					}else if($objResult["labcode"]=="NEU"){
						$labmean="(การติดเชื้อแบคทีเรีย)";
						$neu_result = $objResult["result"];

					}else if($objResult["labcode"]=="LYMP"){
						$labmean="(การติดเชื้อไวรัส หรือมะเร็งเม็ดเลือด)";
						$lymp_result = $objResult["result"];

					}else if($objResult["labcode"]=="MONO"){
						$labmean="(โรคเกี่ยวกับการแพ้ หรือมะเร็งเม็ดเลือด)";
					}else if($objResult["labcode"]=="EOS"){
						$labmean="(อาการของโรคภูมแพ้ หรือพยาธิ)";
						$eos_result = $objResult["result"];

					}else if($objResult["labcode"]=="BASO"){
						$labmean="(กลุ่มโรคมะเร็งเม็ดเลือดขาว)";
					}else if($objResult["labcode"]=="ATYP"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="BAND"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="OTHER"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="NRBC"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="RBC"){
						$labmean="(เม็ดเลือดแดง)";
					}else if($objResult["labcode"]=="HB"){
						$labmean="(การตรวจวัดความเข้มข้นของฮีโมโกลบิน)";
					}else if($objResult["labcode"]=="HCT"){
						$labmean="(การวัดเม็ดเลือดแดงอัดแน่น)";
						$hct_result = $objResult["result"];

					}else if($objResult["labcode"]=="MCV"){
						$labmean="(การวัดปริมาตรเม็ดเลือดแดงในแต่ละเม็ด)";
					}else if($objResult["labcode"]=="MCH"){
						$labmean="(น้ำหนักของฮีโมโกลบินในเม็ดเลือดแดง)";
					}else if($objResult["labcode"]=="MCHC"){
						$labmean="(ความเข้มข้นฮีโมโกลบินในเม็ดเลือดแดง)";
					}else if($objResult["labcode"]=="PLTC"){
						$labmean="(การตรวจนับเกล็ดเลือดในเลือด)";
						$pltc_result = $objResult["result"];
						
					}else if($objResult["labcode"]=="PLTS"){
						$labmean="";
					}else if($objResult["labcode"]=="RBCMOR"){
						$labmean="(รูปร่างเม็ดเลือดแดง)";
					}
			
					if($objResult['flag']=='L' || $objResult['flag']=='H'){
						$objResult["result"]="<strong>".$objResult["result"]."</strong>";
						$showresult="ผิดปกติ";
					}else{
						$objResult["result"]=$objResult["result"];
						$showresult="ปกติ";
					}
					?>
					<tr height="23">
						<td><strong><?=$objResult["labcode"];?></strong> <font size="-1"><?=$labmean;?></font></td>
						<td align="center"><?=$objResult["result"];?></td>
						<td align="center"><?=$objResult["normalrange"];?></td>
						<td align="center"><?=$showresult;?></td>
						<?php
						/*
						?>
						<td align="center">
							<?php
								$lab_result = $objResult["result"];
								$pure_normalrange = str_replace(' ', '', $objResult["normalrange"]);
								list($normal_min, $normal_max) = explode('-', $pure_normalrange);
								// var_dump($normal_min);
								// var_dump($normal_max);
								// echo ( $normal_min >= $lab_result && $normal_max <= $lab_result ) ? 'ปกติ' : 'ผิดปกติ' ;

							?>
						</td>
						<?php
						*/
						?>
					</tr>
                <?php 
				}} // End while
							
				?>                   
        </table>
		</td>
      </tr>
    </table></td>
    <td width="50%"  valign="top"><table width="100%" height="77" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
      <tr>
        <td height="30" align="center"><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
      </tr>
      <tr>
        <td style="vertical-align: top;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
          <tr>
            <td width="49%" align="center" bgcolor="#CCCCCC"><strong>การตรวจปัสสาวะ</strong></td>
            <td width="14%" align="center" bgcolor="#CCCCCC"><strong>ผลตรวจ</strong></td>
            <td width="17%" align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
            <td width="17%" align="center" bgcolor="#CCCCCC"><strong>สรุปผล</strong></td>
          </tr>
    <? 
	$sql="SELECT * FROM resulthead WHERE profilecode='UA' and hn='".$hn."' and (clinicalinfo ='ตรวจสุขภาพประจำปี60' OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60' ) ORDER BY `autonumber` desc";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode ='SPGR' || labcode ='PHU' || labcode ='GLUU' || labcode ='PROU' || labcode ='WBCU' || labcode ='RBCU' ) ";
		//echo $strSQL;
		$objQuery = mysql_query($strSQL);
		$ua_rows = mysql_num_rows($objQuery);
		while($objResult = mysql_fetch_array($objQuery))
		{
			if($objResult["labcode"]=="COLOR"){
				$labmean="สีของปัสสาวะ";
			}else if($objResult["labcode"]=="APPEAR"){
				$labmean="ความใส";
			}else if($objResult["labcode"]=="SPGR"){
				$labmean="ความถ่วงจำเพาะ";
			}else if($objResult["labcode"]=="PHU"){
				$labmean="ความเป็นกรด";
			}else if($objResult["labcode"]=="BLOODU"){  //เลือดในปัสสาวะ
				$labmean="เลือดในปัสสาวะ";
				if($objResult["result"]=="Negative" || $objResult["result"]=="Trace"){
					$blooduvalue="ปกติ";
				}else{
					$blooduvalue="ผิดปกติ";
				}
			}else if($objResult["labcode"]=="PROU"){  //โปรตีนในปัสสาวะ
				$labmean="โปรตีนในปัสสาวะ";
				$provalue=$objResult["result"];
			}else if($objResult["labcode"]=="GLUU"){  //น้ำตาลในปัสสาวะ
				$labmean="น้ำตาลในปัสสาวะ";
				$gluuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="KETU"){
				$labmean="คีโตนในปัสสาวะ";
			}else if($objResult["labcode"]=="UROBIL"){
				$labmean="การทำลายเม็ดเลือดแดงสูง";
			}else if($objResult["labcode"]=="BILI"){
				$labmean="บิลิรูบินในปัสสาวะ";
			}else if($objResult["labcode"]=="NITRIT"){
				$labmean="ไนไตรท์ในปัสสาวะ";
			}else if($objResult["labcode"]=="WBCU"){  //เม็ดเลือดขาว
				$labmean="เม็ดเลือดขาว";
				$wbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="RBCU"){  //เม็ดเลือดแดง
				$labmean="เม็ดเลือดแดง";
				$rbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="EPIU"){
				$labmean="เซลล์เยื่อบุ";
			}else if($objResult["labcode"]=="BACTU"){
				$labmean="แบคทีเรีย";
			}else if($objResult["labcode"]=="YEAST"){
				$labmean="ยีสต์";
			}else if($objResult["labcode"]=="MUCOSU"){
				$labmean="";
			}else if($objResult["labcode"]=="AMOPU"){
				$labmean="";
			}else if($objResult["labcode"]=="CASTU"){
				$labmean="แท่งโปรตีน";
			}else if($objResult["labcode"]=="CRYSTU"){
				$labmean="ผลึก";
			}else if($objResult["labcode"]=="OTHERU"){
				$labmean="อื่นๆ";
			}
						
			if($objResult["labcode"]=="RBCU"){
			if($hn=="53-6092"){
				$showresultua="ผิดปกติ";
			}else{
					$rbculen=strlen($objResult6["result"]);
					if($rbculen >=5){
						$rbcu1=substr($objResult6["result"],0,2);
						$rbcu2=substr($objResult6["result"],3,2);
					}else if($rbculen ==4){
						$rbcu1=substr($objResult6["result"],0,1);
						$rbcu2=substr($objResult6["result"],2,2);						
					}else{
						$rbcu1=substr($objResult6["result"],0,1);
						$rbcu2=substr($objResult6["result"],2,1);
					}
					if($objResult6["result"] == "*" || $objResult6["result"] == "**"  || $objResult6["result"] == "--"){
						$showresultua="*";
					}else{									
						if($objResult6["result"] == "Negative" || ($rbcu1 >=0 && $rbcu2 <=1) && $objResult6["result"] != "*"){
							$showresultua="ปกติ";
						}else if($objResult6["result"] == "*"){
							$showresultua="*";
						}else{
							$showresultua="ผิดปกติ";
						}
					}	
			}
			}else{
				if($objResult['flag']=='L' || $objResult['flag']=='H' || $objResult['result']=='1+'|| $objResult['result']=='2+'|| $objResult['result']=='3+'|| $objResult['result']=='4+'|| $objResult['result']=='5+'|| $objResult['result']=='6+'|| $objResult['result']=='7+'|| $objResult['result']=='8+'|| $objResult['result']=='9+'){
					$objResult["result"]="<strong>".$objResult["result"]."</strong>";
					$showresultua="ผิดปกติ";
				}else{
					$objResult["result"]=$objResult["result"];
					$showresultua="ปกติ";
				}
			}
			
			if($objResult["labcode"]=="PROU" || $objResult["labcode"]=="GLUU"){
				$normalrange="Negative";
			}else{
				$normalrange=$objResult["normalrange"];
			}

		?>
          <tr height="23">
            <td><strong><?=$labmean;?></strong></td>
            <td align="center"><?=$objResult["result"];?></td>
			<td align="center"><?=$normalrange;?></td>
			<td width="3%" align="center"><?=$showresultua;?></td>
          </tr>
		<? } ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
<? } // end from else ?>  
  
 <?php
// ผลการตรวจทางห้องปฏิบัติการ ตัด profilecode='OCCULT'
$sql1 = "SELECT * 
FROM resulthead 
WHERE ( 
	profilecode='GLU' 
	OR profilecode='CREAG' 
	OR profilecode='BUN' 
	OR profilecode='URIC' 
	OR profilecode='CHOL' 
	OR profilecode='TRIG' 
	OR profilecode='AST' 
	OR profilecode='ALT' 
	OR profilecode='LIPID' 
	OR profilecode='ALP' 
	OR profilecode='HBSAG' 
	OR profilecode='ANTIHB' 
	OR profilecode='HDL' 
	OR profilecode='LDL'
	OR profilecode='10001'  
	OR profilecode='ABOC'	
	OR profilecode='METAMP'	
	OR profilecode='OCCULT'
	)  
AND hn = '".$hn."' 
AND ( 
	clinicalinfo ='ตรวจสุขภาพประจำปี60' 
	OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' 
	OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60'  ) 
ORDER BY `autonumber` asc";
//echo $sql1."<br>";
$query1 = mysql_query($sql1) or die( mysql_error() );
$other_result_row = mysql_num_rows($query1);



// lab อื่นๆ ตัด 38302 PAP SMEAR ออกไปก่อน
$sql = "SELECT a.*, c.`labcode`, c.`result`,c.`normalrange`,c.`flag`
FROM (

	SELECT MAX(`autonumber`) AS `autonumber`
	FROM `resulthead` 
	WHERE `hn` = '".$hn."' 
	AND ( 
		`clinicalinfo` = 'ตรวจสุขภาพประจำปี60' 
		OR `clinicalinfo` ='ตรวจสุขภาพประจำปี61' 
		OR `clinicalinfo` = 'ตรวจสุขภาพประกันสังคม60' 
		 ) 
	AND ( `testgroupcode` = 'OUT' ) 
	AND `profilecode` != '38302' 
	GROUP BY `profilecode` 

) AS b 
LEFT JOIN `resulthead` AS a ON a.`autonumber` = b.`autonumber` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = b.`autonumber` ";
$outlab_query = mysql_query($sql) or die( mysql_error() );
$outlab_row = mysql_num_rows($outlab_query);


// dump($other_result_row);
// dump($outlab_row);

 if( $other_result_row > 0 OR $outlab_row > 0 ){ 
 ?>
	<tr>
		<td colspan="2"  valign="top"></td>
	</tr>
	<tr>
		<td colspan="2"  valign="top">
			<table width="100%" border="1" style="border-collapse:collapse; border-bottom-style:none;" bordercolor="#000000" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="30">
					<strong class="text" style="font-size:20px"><u>ผลการตรวจทางห้องปฏิบัติการ</u></strong>		</td>
				</tr>
				<tr>
					<td height="52" valign="top" style="padding: 2px;">
						<table width="100%" border="0" class="text3" cellpadding="0" cellspacing="0">
							<tr>
								<td width="32%" valign="top" bgcolor="#CCCCCC"><strong>รายการตรวจ</strong></td>
								<td width="9%" valign="top" bgcolor="#CCCCCC"><strong>ผลการตรวจ</strong></td>
								<td width="9%" valign="top" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
								<td width="50%" valign="top" bgcolor="#CCCCCC" style="font-size:16px;"><strong>สรุปผลการตรวจ</strong></td>
							</tr>
							<?php
							$i=0;
							while($arrresult = mysql_fetch_array($query1)){
								$i++;
								//echo $i;

								$strSQL1 = "SELECT authorisename, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' limit 0,1";
								//echo "===>".$strSQL1;
								$objQuery1 = mysql_query($strSQL1);
								list($authorisename,$authorisedate)=mysql_fetch_array($objQuery1);	

								
								$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 
								FROM resultdetail  
								WHERE autonumber='".$arrresult['autonumber']."' 
								AND (labcode !='GFR' AND labcode !='HI' AND labcode !='LDL')";
								//echo $strSQL;
								$objQuery = mysql_query($strSQL);
								while($objResult = mysql_fetch_array($objQuery)){

									if($objResult["labname"]=="Blood Sugar"){
										$labmean="(ระดับน้ำตาลในเลือด)";
									}else if($objResult["labname"]=="BUN"){
										$labmean="(การทำงานของไต)";
									}else if($objResult["labname"]=="Creatinine"){
										$labmean="(การทำงานของไต)";
									}else if($objResult["labname"]=="Uric acid"){
										$labmean="(ยูริคในเลือด)";
									}else if($objResult["labname"]=="Cholesterol"){
										$labmean="(ไขมันในเลือด)";
									}else if($objResult["labname"]=="HDL"){
										$labmean="(ไขมันดี)";			
									}else if($objResult["labname"]=="Triglyceride"){
										$labmean="(ไขมันในเลือด)";
									}else if($objResult["labname"]=="LDL"){
										$labmean="(ไขมันเลว)";	
									}else if($objResult["labname"]=="LDLC"){
										$labmean="(ไขมันเลว)";												
									}else if($objResult["labname"]=="SGOT(AST)"){
										$labmean="(การทำงานของตับ)";
									}else if($objResult["labname"]=="SGPT(ALT)"){
										$labmean="(การทำงานของตับ)";
									}else if($objResult["labname"]=="Alkaline phosphatase"){
										$labmean="(การทำงานของตับ)";
									}else if($objResult["labname"]=="HBsAg"){
										$labmean="(เชื้อไวรัสตับอักเสบบี)";
									}else if($objResult["labname"]=="Anti-HBs"){
										$labmean="(ภูมิต้านทานไวรัสตับอักเสบบี)";
									}else if($objResult["labname"]=="Occult blood"){
										$labmean="(เลือดในอุจจาระ)";
									}else if($objResult["labname"]=="ABO Cell group"){
										$labmean="(กรุ๊ปเลือด)";
									}else if($objResult["labname"]=="Metamphetamine"){
										$labmean="(การตรวจหาสารเสพติด)";
									}
											
									if( $objResult["labcode"]=='GLU'){
										if( $objResult["result"] >= 74 && $objResult["result"] <= 106 ){
											$app="ระดับน้ำตาลในเลือดมีค่าอยู่ในเกณฑ์ปกติ";
										}else if( $objResult["result"] > 106 && $objResult["result"] <= 125 ){
											$app="ระดับน้ำตาลในเลือดมีค่าสูงผิดปกติ";
										}else if( $objResult["result"] > 125 ){
											$app="ระดับน้ำตาลในเลือดมีค่าสูงมากผิดปกติ";	
										}else if( $objResult["result"] < 74 ){
											$app="ระดับน้ำตาลในเลือดมีค่าต่ำผิดปกติ";	
										}
									}

									if($objResult["labcode"]=='BUN'){
										if($objResult["result"]>18){
											$app="ผิดปกติ ควรควบคุมอาหารที่มีโซเดียมสูง และแคลเซียมสูง เช่น นม ถั่วลิสง ของเค็มทุกชนิด";	
										}else if($objResult["result"]>=7 && $objResult["result"]<=18){
											$app="การทำงานของไตมีค่าอยู่ในเกณฑ์ปกติ";	
										}else if($objResult["result"]<7 ){
											$app="ผิดปกติ การทำงานของไตต่ำกว่าปกติ";	
										}
										
									}

									if($objResult["labcode"]=='CREA'){
										if($objResult["result"]>1.3){
											$app="ผิดปกติ ควรควบคุมอาหารที่มีโซเดียมสูง และแคลเซียมสูง เช่น นม ถั่วลิสง ของเค็มทุกชนิด";	
										}else if($objResult["result"]>=0.6 && $objResult["result"]<=1.3){
											$app="การทำงานของไตมีค่าอยู่ในเกณฑ์ปกติ";	
										}else if($objResult["result"]<0.6){
											$app="ผิดปกติ การทำงานของไตต่ำกว่าปกติ";	
										}
									}

									if($objResult["labcode"]=='URIC'){
										if($objResult["result"]>7.2){
											$app="ผิดปกติ ควรงดเครื่องดื่มที่มีแอลกอฮอล์ เครื่องในสัตว์ สัตว์ปีก";	
										}else if($objResult["result"] >=2.6 && $objResult["result"] <=7.2){
											$app="ระดับกรดยูริคมีค่าอยู่ในเกณฑ์ปกติ";	
										}else if($objResult["result"]<2.6){
											$app="ผิดปกติ ระดับกรดยูริคต่ำกว่าปกติ";	
										}
									}


									if($objResult["labcode"]=='CHOL'){
										if($objResult["result"]<=200){
											$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
										}else	if($objResult["result"]>200){
											$app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
										}else	if($objResult["result"]>300){
											$app="ผิดปกติ ระดับไขมันในเลือดสูงมากผิดปกติ ควรปรึกษาแพทย์";	
										}
									}

									if($objResult["labcode"]=='HDL'){
										if($objResult["result"]>=40 && $objResult["result"]<=60){
											$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
										}else	if($objResult["result"]>60){  //สูงดี
											$app="การมีระดับ HDL สูง จะทำให้ลดภาวะเสี่ยงต่อโรคเส้นเลือดหัวใจตีบ";	
										}else	if($objResult["result"]<40){  //ต่ำไม่ดี
											$app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
										}
									}

									if($objResult["labcode"]=='TRIG'){
										if($objResult["result"]<=150){
											$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
										}else	if($objResult["result"]>150 && $objResult["result"]<250){
											$app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
										}else	if($objResult["result"]>250){
											$app="ผิดปกติ ระดับไขมันในเลือดสูงมากผิดปกติ ควรปรึกษาแพทย์";	
										}
									}

									if($objResult["labcode"]=='10001'){
										if($objResult["result"]>=0 && $objResult["result"]<=100){
											$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
										}else	if($objResult["result"]>100){
											$app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
										}
									}

									if($objResult["labcode"]=='LDL'){
										if($objResult["result"]>=0 && $objResult["result"]<=100){
											$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
										}else	if($objResult["result"]>100){
											$app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
										}
									}

									if($objResult["labcode"]=='LDLC'){
										if($objResult["result"]>=0 && $objResult["result"]<=100){
											$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
										}else	if($objResult["result"]>100){
											$app="ผิดปกติ ควรปรับพฤติกรรมการรับประทานอาหาร และออกกำลังกายอย่างสม่ำเสมอ";	
										}
									}

									if($objResult["labcode"]=='AST'){  //SGOT
										if($objResult["result"]>=15 && $objResult["result"]<=37){
											$app="การทำงานของตับปกติ";	
										}else	if($objResult["result"]>37){
											$app="การทำงานของตับผิดปกติ";	
										}else	if($objResult["result"]<15){
											$app="การทำงานของตับผิดปกติ";	
										}
									}
									if($objResult["labcode"]=='ALT'){  //SGPT
										if($objResult["result"]>=0 && $objResult["result"]<=50){
											$app="การทำงานของตับปกติ";		
										}else{
											$app="การทำงานของตับผิดปกติ";	
										}
									}

									if($objResult["labcode"]=='ALP'){  //ALK
										if($objResult["result"]>=46 && $objResult["result"]<=116){
											$app="การทำงานของตับปกติ";	
										}else	if($objResult["result"]>116){
											$app="การทำงานของตับผิดปกติ";	
										}else	if($objResult["result"]<46){
											$app="การทำงานของตับผิดปกติ";	
										}
									}

									if($objResult["labcode"]=='HBSAG'){  //HBSAG
										if($objResult["result"]=="Negative"){
											$app="ปกติ";	
										}else if($objResult["result"]=="Positive"){
											$app="ผิดปกติ";	
										}
									}

									if($objResult["labcode"]=='ANTIHB'){  //HBSAB
										if($objResult["result"]=="Negative"){
											$app="ปกติ";	
										}else if($objResult["result"]=="Positive"){
											$app="ผิดปกติ";	
										}
									}

									if($objResult["labcode"]=='OCCULT'){  //STOCB
										if($objResult["result"]=="Negative"){
											$app="ปกติ";	
										}else if($objResult["result"]=="Positive"){
											$app="ผิดปกติ";	
										}
									}

									if($objResult["labcode"]=='ABOC'){  //STOCB
										$app="";	
									}

									if($objResult["labcode"]=='METAMP'){  //METAMP
										if($objResult["result"]=="Negative"){
											$app="ปกติ";	
										}else if($objResult["result"]=="Positive"){
											$app="ผิดปกติ";	
										}
									}

									if($objResult["result"]!="*"  && $objResult["result"]!="DELETE"){

										// 
										if ( $objResult["labname"]=="Occult blood" ) {
											$objResult["labname"] = 'FOBT';
										}

									?>
									<tr height="23">
										<td width="34%" valign="top"><strong><?=$objResult["labname"];?> <font size="-1"><?=$labmean;?></font></td>
										<td width="8%" valign="top"><? if($objResult["flag"]!="N" || $objResult['result']=='Positive'){ echo "<strong>".$objResult["result"]."</strong>";}else{ echo $objResult["result"];}?></td>
										<td width="9%" valign="top"><?=$objResult["normalrange"];?></td>
										<td width="49%" valign="top" style="font-size:16px;"><?=$app;?></td>
									</tr>
									<? 
									}
								} // End while resultdetail 
							}// End resulthead

							// lab อื่นๆ

							$normal_outlab = array(
								'AFP' => '12',
								'CA125' => '0-35',
								'CA153' => '0-35',
								'CA199' => '0-39',
								'CEA' => '0-4.7',
								'PSA' => '0-4',
							);
						
			
							if( $outlab_row > 0 ){


								while( $outlab = mysql_fetch_assoc($outlab_query)){
									// dump($outlab['labcode']);
									if($outlab['labcode']=="38302"){
										// $outlab_code = "<strong>PAP SMEAR</strong> <font size='-1'>(การตรวจหามะเร็งปากมดลูก)</font>";
									}else if( $outlab['labcode']=="OCCULT" ){
										$outlab_code = "<strong>FOBT <font size='-1'>(การตรวจเลือดในอุจจาระ)</font></strong>";
									}else if( $outlab['labcode']=="AFP" ){
										$outlab_code = "<strong>AFP <font size='-1'>(การตรวจมะเร็งตับ)</font></strong>";
									}else if( $outlab['labcode']=="CEA" ){
										$outlab_code = "<strong>CEA <font size='-1'>(การตรวจมะเร็งลำไส้)</font></strong>";
									}else if( $outlab['labcode']=="PSA" ){
										$outlab_code = "<strong>PSA <font size='-1'>(การตรวจมะเร็งต่อมลูกหมาก)</font></strong>";
									}else{
										$outlab_code = $outlab['labcode'];
									}
									// เอาค่าแปลกๆออกไปก่อน
									$outlab_result = str_replace(array('<','>'), '', $outlab['result']);
	
									// ค่า normal range ที่เป็นพวก outlab
									$outlab_range = $normal_outlab[$outlab['labcode']];
									if($outlab_result=="OL" || $outlab_result=="ol"){
										// if($hn=="49-2672"){
										// 	$outlab_result="ผิดปกติ";
										// }else{
											$outlab_result="&nbsp;";
										// }
									}
								?>
								<tr height="23">
									<td><?=$outlab_code;?></td>
									<td><?=$outlab_result;?></td>
									<td><?=$outlab_range;?></td>
									<td>
										<?php
										// default เป็นค่าปกติ
										// if($hn=="49-2672"){
										// 	$result_outlab_txt = 'ผิดปกติ...นัดพบสูตินารีแพทย์';	
										// }else{
											$result_outlab_txt = 'ปกติ';
											if( $outlab['flag'] != 'N' ){
												$result_outlab_txt = 'ผิดปกติ';
											}
										// }
	
										echo $result_outlab_txt;
										?>
									</td>
								</tr>
								<?php
								}



							}



							?>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"  valign="top"></td>
	</tr>
<?php 
} 
?>
  <tr>
    <td colspan="2"  valign="top">
		<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">          
        <tr>
          <td valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr valign="middle">
              <td width="30%"><strong class="text" style="font-size:18px"> <u>ผลการตรวจเอกซ์เรย์ (X-RAY)</u> </strong> </td>
              <td width="70%"><strong class="text" style="margin-left: 9px;"> :
                <? if($result["cxr"]==""){ echo "ปกติ"; }else{ echo $result["cxr"];} ?>
              </strong> </td>
            </tr>

			<?php if( !empty($result['va']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจตา</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$result['va'];?>
					</strong> </td>
				</tr>
			<?php } ?>
			<?php if( !empty($result['eye']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจสายตาเบื้องต้น</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$result['eye']." ".$result['eye_detail'];?>
					</strong> </td>
				</tr>
			<?php } ?>  
			<?php if( !empty($result['pt']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจสมรรถภาพปอด</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$result['pt']." ".$result['pt_detail'];?>
					</strong> </td>
				</tr>
			<?php } ?>   
			<?php
				$sql3="select * from 
				patdata where 
				hn='".$hn."' 
				and code='51410' 
				and date like '$dateekg%' 
				order by row_id desc";
			$query3=mysql_query($sql3);
			$num3=mysql_num_rows($query3);
			if(!empty($num3)){  //ถ้ามีการคิดค่าใช้จ่าย
			?>
			<tr>
				<td>
					<strong class="text" style="font-size:18px">
						<u>ผลการตรวจคลื่นหัวใจไฟฟ้า (EKG)</u>
					</strong>
				</td>
				<td>
					<strong class="text" style="margin-left: 9px;"> : <?=( !empty($result["ekg"]) ? $result["ekg"] : 'ปกติ' );?></strong>
				</td>
			</tr>
			<?php } ?>   

						<?php if( !empty($result['altra']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจอัลตร้าซาวด์ช่องท้อง</u> </strong> </td>
								<td><strong class="text" style="margin-left: 9px;"> :
									<?=$result['altra'];?>
								</strong> </td>
							</tr>
						<? } ?>
						<?php if( !empty($result['psa']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจต่อมลูกหมากโดยการคลำ</u> </strong> </td>
								<td><strong class="text" style="margin-left: 9px;"> :
									<?=$result['psa'];?>
								</strong> </td>
							</tr>
						<? } ?>
						<?php if( !empty($result['hpv']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจมะเร็งปากมดลูก</u> </strong> </td>
								<td><strong class="text" style="margin-left: 9px;"> :
									<?=$result['hpv'];?>
								</strong> </td>
							</tr>
						<? } ?>
						<?php if( !empty($result['mammogram']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจแมมโมแกรม</u> </strong> </td>
								<td><strong class="text" style="margin-left: 9px;"> :
									<?=$result['mammogram'];?>
								</strong> </td>
							</tr>
						<? } ?>
          </table>
          </td>
        </tr>
        <tr>
          <td valign="bottom"><strong class="text" style="font-size:20px">
<? if(!empty($result["comment"])){
	$comment=$result["comment"];
	echo "ข้อมูลเพิ่มเติม : </strong><span class='text' style='font-size:20px'>$comment</span> <br />";
 } ?>                
            <strong class="text" style="font-size:20px">สรุปผลการตรวจ :</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text3">
          <input type="checkbox" name="checkbox" id="checkbox" />
          &nbsp;พบแพทย์
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="checkbox2" id="checkbox2" />
&nbsp;ไม่ต้องพบแพทย์</span>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="50%" align="center" class="text3">&nbsp;</td>
                <td width="48%" align="left" class="text3"><?php for($i=1; $i<5; $i++){ echo '&nbsp;'; } ?>แพทย์ผู้ตรวจ</td>
                <td width="2%" class="text3">&nbsp;</td>
              </tr>
							<tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">พ.ท.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="text3">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">(วรวิทย์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วงษ์มณี)</td>
                <td class="text3">&nbsp;</td>
              </tr>
			  <!--
              <tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">กุมารแพทย์</td>
                <td class="text3">&nbsp;</td>
              </tr>
			  -->
              <tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">ปฏิบัติหน้าที่ประธานฝ่ายตรวจสุขภาพ โรงพยาบาลค่ายสุรศักดิ์มนตรี</td>
                <td class="text3">&nbsp;</td>
              </tr>
            </table>            </td>
          </tr>               
    </table></td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise LAB : </strong><?=$authorisename;?> <strong> (<?=$authorisedate;?>) </strong><strong>CXR : </strong>พ.ต.วริทธิ์ พสุธาดล (ว.38228) รังสีแพทย์<strong> (<?=$xraydate ;?>)</strong><br /></td>
    
  </tr>
</table>
<div class="text3"><strong>*** หมายเหตุ *** </strong></div>
<div class="text">1. กรณีผลสรุปการตรวจคือพบแพทย์สามารถติดต่อผ่านทางฝ่ายตรวจสุขภาพ 093-2744550 เพื่อเข้าระบบนัดตรวจกับนายแพทย์ พ.ท.วรวิทย์ วงษ์มณี ในเวลาราชการวันจันทร์ - พฤหัสบดี ตั้งแต่เวลา 09.00-11.30 น.</div>
</div>
<?php 
} // while
?>
</body>
</html>