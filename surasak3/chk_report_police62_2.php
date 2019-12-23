<?php
include 'bootstrap.php';
$db = Mysql::load();
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
$company['name'] = 'ตรวจสุขภาพตำรวจ 23 ธันวาคม 2562';
?>
<title>พิมพ์ใบตรวจสุขภาพ <?=$company['name'];?></title>
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

$xraydate ="23-12-2019";
$dateCheckUp = '23 ธันวาคม 2562';
$part = 'สอบตำรวจ63_02';

$sql1 = "SELECT a.*, a.`HN` AS `hn` 
FROM `opcardchk` AS a 
WHERE a.`part` = '$part' 
ORDER BY a.`row` ASC ";
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
		$sqlcc = mysql_query("SELECT datechkup, branch FROM `opcardchk`WHERE `HN` = '$hn'");
		list($show_date, $branch)=mysql_fetch_array($sqlcc);   //18-09-60 น้องนัดแจ้งให้เปลี่ยนเป็นวันที่นัดตรวจ
	}
	
	$sql2="SELECT * 
	FROM out_result_chkup 
	WHERE hn='$hn' 
	AND part='$part'";
	$query2=mysql_query($sql2);
	$opd=mysql_fetch_assoc($query2);

	// if(empty($age)){
	// 	$age = $result["age"];
	// }

	// if(empty($result['name'])){
		$ptname = $result['yot'].$result['name'].' '.$result['surname'];
	// }else{
	// 	$ptname = $result['name']." ".$result['surname'];
	// }

	// $sex = $result['sex'];
	// $newdbirth = $result['dbirth'];
	// $hbd = calcage($newdbirth);
	
	$ht = $opd['height']/100;
	$bmi = number_format($opd['weight'] /($ht*$ht),2);
	
	// @todo $showdatelab ไม่ได้ใช้อะไร
    $strSQL11 = "SELECT date_format(`orderdate`,'%d-%m-%Y') as orderdate2 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND ( 
		`clinicalinfo` ='CBC ,UA ,@stool ,HIV ,VDRL ,AMP ,' 
	) order by autonumber desc";  //โชว์ข้อมูล
	
    $objQuery11 = mysql_query($strSQL11);
    list($orderdate) = mysql_fetch_array($objQuery11);
	
	list($d,$m,$y) = explode("-",$orderdate);
	$yy = $y+543;
	$showdatelab = "$d/$m/$yy";
	
	$dateekg="$yy-$m";	



?>
<div id="divprint">
<table width="100%" border="0">
	<tr>
		<td colspan="2">
			<table width="100%">
				<tr>
					<td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="โรงพยาบาลค่ายสุรศักดิ์มนตรี" height="60" /></td>
					<td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพสอบเข้ารับราชการตำรวจ ภาค 5</strong></td>
					<td width="14%" align="center" valign="top" class="texthead">
						<span style="font-weight: bold; font-size: 28px;"><?=$result['seq'];?></span>
					</td>
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
										หน่วยงาน : ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5
										วันที่ตรวจ <?=$dateCheckUp;?>
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
													<strong>น้ำหนัก : </strong><?=$opd['weight']?>&nbsp;กก. 
													<strong>ส่วนสูง : </strong><?=$opd['height']?>&nbsp;ซม. 
													<strong>BMI : </strong> <u><?=$bmi?> </u>&nbsp;&nbsp;
													<strong>BP : <u><? echo $opd['bp1']; ?> / <? echo $opd['bp2']; ?>mmHg. </u></strong>&nbsp;&nbsp;
													
													<?php if(!empty($opd["bp3"]) && !empty($opd["bp4"])){ ?>
														<strong>RE-BP : <u><?php echo $opd['bp3']; ?> / <?php echo $opd['bp4']; ?>mmHg. </u></strong>&nbsp;&nbsp;
													<?php } ?>

													<strong>T : </strong> <u><?=$opd['temp']?> C</u>&nbsp;&nbsp;
													<strong>P : </strong> <u><?=$opd['p']?> ครั้ง/นาที</u>&nbsp;&nbsp;
													<strong>R : </strong> <u><?=$opd['rate']?> ครั้ง/นาที</u>
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

	<tr>
		<td align="center" colspan="2">
			<strong class="text" style="font-size:22px"><u>ผลการตรวจทางห้องปฏิบัติการ</u></strong>
		</td>
	</tr>
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
					<!--
					<td width="17%" align="center" bgcolor="#CCCCCC"><strong>สรุปผล</strong></td>
					-->
					<?php
					/*
					?>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>สรุปผลการตรวจ</strong></td>
					<?php
					*/
					?>
				</tr>
				<?php 
				$sql = "SELECT *,MAX(autonumber)  AS `latest_id` 
				FROM resulthead 
				WHERE profilecode='CBC' 
				AND hn = '$hn' AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี63' 
				GROUP BY hn 
				ORDER BY `autonumber` desc";
				
				$query = mysql_query($sql) or die( mysql_error() );
				$arrresult = mysql_fetch_array($query);
				
				/////

				$strSQL = "SELECT * 
				FROM resultdetail 
				WHERE autonumber='".$arrresult['latest_id']."' 
				AND ( 
					labcode = 'WBC' 
					|| labcode ='NEU' 
					|| labcode ='LYMP' 
					|| labcode ='MONO' 
					|| labcode ='EOS' 
					|| labcode ='BASO' 
					|| labcode ='HB' 
					|| labcode ='HCT' 
					|| labcode ='MCV' 
					|| labcode ='MCH' 
					|| labcode ='MCHC' 
					|| labcode ='PLTC' 
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
						<td><strong><?=$objResult["labcode"];?></strong> <?=$labmean;?></td>
						<td align="center"><?=$objResult["result"];?></td>
						<td align="center"><?=$objResult["normalrange"];?></td>
						<!--
						<td align="center"><?=$showresult;?></td>
						-->
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
			<!--
            <td width="17%" align="center" bgcolor="#CCCCCC"><strong>สรุปผล</strong></td>
			-->
          </tr>
    <?php 
	$sql="SELECT *, MAX(autonumber) AS `latest_id` 
	FROM resulthead 
	WHERE profilecode = 'UA' 
	AND hn = '$hn' AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี63' 
	GROUP BY `hn` 
	ORDER BY `autonumber` desc";
	// var_dump($sql);
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * 
		FROM resultdetail  
		WHERE autonumber='".$arrresult['latest_id']."' 
		and ( 
			labcode = 'COLOR' 
			|| labcode ='SPGR' 
			|| labcode ='PH' 
			|| labcode ='BLOODU' 
			|| labcode ='PROU' 
			|| labcode ='GLUU' 
			|| labcode ='KETU' 
			|| labcode ='EPIU' 
			|| labcode ='WBCU' 
			|| labcode ='RBCU' 
			|| labcode ='BACTU' 
			|| labcode ='MUCOSU' 
			

		) ";
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
			}else if($objResult["labcode"]=="PH"){
				$labmean="ความเป็นกรดด่าง";
			}else if($objResult["labcode"]=="BLOODU"){  //เลือดในปัสสาวะ
				$labmean="เลือดในปัสสาวะ";
				// if($objResult["result"]=="Negative" || $objResult["result"]=="Trace"){
				// 	$showresultua="ปกติ";
				// }else{
				// 	$showresultua="ผิดปกติ";
				// }
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
				$labmean="Mucous";
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
			}elseif($objResult["labcode"]=="BLOODU"){
				$normalrange = "Negative";
			}else{
				$normalrange=$objResult["normalrange"];
			}

		?>
          <tr height="23">
            <td><strong><?=$labmean;?></strong></td>
            <td align="center"><?=$objResult["result"];?></td>
			<td align="center"><?=$normalrange;?></td>
			<!--
			<td width="3%" align="center"><?=$showresultua;?></td>
			-->
          </tr>
		<? } ?>
        </table>
		</td>
      </tr>
    </table>
	</td>
  </tr>
<?  // end from else ?>  
  
	<tr>

		<?php
		$sql = "SELECT b.* 
		FROM ( 
			SELECT MAX(`autonumber`) AS `latest_id` 
			FROM `resulthead` 
			WHERE `hn` = '$hn' 
			AND ( 
				`profilecode` = 'HIV' 
				OR `profilecode` = 'VDRL' 
				OR `profilecode` = 'METAMP' 
			) 
			GROUP BY `profilecode`
		 ) AS a 
		LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_id` ";
		$q = mysql_query($sql) or die( mysql_error() );
		?>
		<td width="50%" valign="top">
			<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse" class="text3">
				<tr>
					<td align="center">
						<strong class="text" style="font-size:22px"><u>&nbsp;Serology&nbsp;</u></strong>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" >
							<tr bgcolor="#CCCCCC" align="center">
								<td width="60%"><b>รายการตรวจ</b></td>
								<td width="40%"><b>ผลตรวจ</b></td>
							</tr>
							<?php 
							while ($item = mysql_fetch_assoc($q)) {

								if( $item['labcode'] == 'HIV' ){
									$item['result'] = 'Negative by determine HIV 1/2';
								}

								?>
								<tr>
									<td><b><?=$item['labname'];?></b></td>
									<td><?=$item['result'];?></td>
								</tr>
								<?php
							}
							?>
							
						</table>
					</td>
				</tr>
			</table>
		</td>

		<?php
		$sql = "SELECT b.* 
		FROM ( 
			SELECT MAX(`autonumber`) AS `latest_id` 
			FROM `resulthead` 
			WHERE `hn` = '$hn' 
			AND `profilecode` = 'STOOL'
		) AS a 
		LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_id` 
		WHERE ( b.`labname` != 'Character' AND b.`labname` != 'Mucous' ) ";
		$q = mysql_query($sql) or die( mysql_error() );
		?>
		<td width="50%" valign="top">
			<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse" class="text3">
				<tr>
					<td align="center">
						<strong class="text" style="font-size:22px"><u>STOOL: การตรวจอุจจาระ</u></strong>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" >
							<tr bgcolor="#CCCCCC" align="center">
								<td width="65%"><b>รายการตรวจ</b></td>
								<td width="35%"><b>ผลตรวจ</b></td>
							</tr>
							<?php
							while ($item = mysql_fetch_assoc($q)) {


								$strSQL1 = "SELECT authorisename, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 
								FROM resultdetail 
								WHERE autonumber='".$item['autonumber']."' 
								limit 0,1";
								$objQuery1 = mysql_query($strSQL1);
								list($authorisename,$authorisedate)=mysql_fetch_array($objQuery1);	

								?>
								<tr>
									<td><b><?=$item['labname'];?></b></td>
									<td><?=$item['result'];?></td>
								</tr>
								<?php
							}
							?>
							
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

  <tr>
    <td colspan="2"  valign="top">
		<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">          
        <tr>
          <td valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr valign="middle">
              <td width="30%"><strong class="text" style="font-size:18px"> <u>ผลการตรวจเอกซ์เรย์ (X-RAY)</u> </strong> </td>
              <td width="70%"><strong class="text" style="margin-left: 9px;"> :
                <? if($opd["cxr"]==""){ echo "ปกติ"; }else{ echo $opd["cxr"];} ?>
              </strong> </td>
            </tr>

			<?php if( !empty($opd['va']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจตา</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$opd['va'];?>
					</strong> </td>
				</tr>
			<?php } ?>
			<?php if( !empty($opd['eye']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจสายตาเบื้องต้น</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$opd['eye']." ".$opd['eye_detail'];?>
					</strong> </td>
				</tr>
			<?php } ?>  
			<?php if( !empty($opd['pt']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>ผลการตรวจสมรรถภาพปอด</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$opd['pt']." ".$opd['pt_detail'];?>
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
		<!-- 
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
              <tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">ปฏิบัติหน้าที่ประธานฝ่ายตรวจสุขภาพ โรงพยาบาลค่ายสุรศักดิ์มนตรี</td>
                <td class="text3">&nbsp;</td>
              </tr>
            </table>            </td>
          </tr>   
		  -->            
    </table>
	</td>
  </tr>
  
</table>

<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center">
 		<!--
		<strong>Authorise LAB : </strong><?=$authorisename;?> <strong> (<?=$authorisedate;?>) </strong>
		<strong>CXR : </strong>พ.ต.วริทธิ์ พสุธาดล (ว.38228) รังสีแพทย์<strong> (<?=$authorisedate ;?>)</strong><br />
		-->
		<b>ผู้รับผิดชอบผลการตรวจเอกซ์เรย์</b> พ.ท.วริทธิ์ พสุธาดล (ว.38228) <b>ผู้รับผิดชอบผลการตรวจทางห้องปฏิบัติการ</b> พ.ท.สมยศ แสงสุข (ทน.3226)
	</td>
  </tr>
</table>

</div>
<?php 
} // while
?>
</body>
</html>