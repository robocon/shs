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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

	return $pAge;
}
$company['name'] = '��Ǩ�آ�Ҿ���Ǩ 23 �ѹ�Ҥ� 2562';
?>
<title>�����㺵�Ǩ�آ�Ҿ <?=$company['name'];?></title>
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
$dateCheckUp = '23 �ѹ�Ҥ� 2562';
$part = '�ͺ���Ǩ63_02';

$sql1 = "SELECT a.*, a.`HN` AS `hn` 
FROM `opcardchk` AS a 
WHERE a.`part` = '$part' 
ORDER BY a.`row` ASC ";
$row2 = mysql_query($sql1) or die ( mysql_error() );

$out_result_rows = mysql_num_rows($row2);
if( $out_result_rows == 0 ){
	echo "�ѧ��辺�����š�úѹ�֡�š�ëѡ����ѵ�";
	exit;
}

while($result = mysql_fetch_assoc($row2)){

	$age = $result["age"];
	$hn = $result["hn"];
	$show_date = $result['show_date'];

	if( empty($show_date) ){
		$sqlcc = mysql_query("SELECT datechkup, branch FROM `opcardchk`WHERE `HN` = '$hn'");
		list($show_date, $branch)=mysql_fetch_array($sqlcc);   //18-09-60 ��ͧ�Ѵ���������¹���ѹ���Ѵ��Ǩ
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
	
	// @todo $showdatelab �����������
    $strSQL11 = "SELECT date_format(`orderdate`,'%d-%m-%Y') as orderdate2 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND ( 
		`clinicalinfo` ='CBC ,UA ,@stool ,HIV ,VDRL ,AMP ,' 
	) order by autonumber desc";  //��������
	
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
					<td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="�ç��Һ�Ť�������ѡ��������" height="60" /></td>
					<td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ�ͺ����Ѻ�Ҫ��õ��Ǩ �Ҥ 5</strong></td>
					<td width="14%" align="center" valign="top" class="texthead">
						<span style="font-weight: bold; font-size: 28px;"><?=$result['seq'];?></span>
					</td>
				</tr>
				<tr>
					<td align="center" valign="top" class="texthead"><strong class="text2">�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305-6 ��� 1132</strong></td>
					<td align="center" valign="top" class="texthead">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="top" class="text3">
						<span class="text">
							<span class="text1">
								<span class="text2">
									<strong>
										˹��§ҹ : �ٹ��֡ͺ�����Ǩ�ٸ� �Ҥ 5
										�ѹ����Ǩ <?=$dateCheckUp;?>
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
												<strong class="text1"><u>�����ż���Ǩ�آ�Ҿ</u></strong> 
												<strong>HN : <?=$hn?>&nbsp;&nbsp;</strong> 
												<strong>���� : </strong>
												<span style="font-size:24px">
													<strong><?=$ptname;?></strong>&nbsp;&nbsp;&nbsp;
													<?php if(!empty($age)){ ?>
														<strong>���� : </strong> 
														<strong><?=$age;?> ��</strong>
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
												<strong class="text" style="font-size:20px"><u>��Ǩ��ҧ��·����</u></strong>&nbsp;&nbsp;
												<span class="text3">
													<strong>���˹ѡ : </strong><?=$opd['weight']?>&nbsp;��. 
													<strong>��ǹ�٧ : </strong><?=$opd['height']?>&nbsp;��. 
													<strong>BMI : </strong> <u><?=$bmi?> </u>&nbsp;&nbsp;
													<strong>BP : <u><? echo $opd['bp1']; ?> / <? echo $opd['bp2']; ?>mmHg. </u></strong>&nbsp;&nbsp;
													
													<?php if(!empty($opd["bp3"]) && !empty($opd["bp4"])){ ?>
														<strong>RE-BP : <u><?php echo $opd['bp3']; ?> / <?php echo $opd['bp4']; ?>mmHg. </u></strong>&nbsp;&nbsp;
													<?php } ?>

													<strong>T : </strong> <u><?=$opd['temp']?> C</u>&nbsp;&nbsp;
													<strong>P : </strong> <u><?=$opd['p']?> ����/�ҷ�</u>&nbsp;&nbsp;
													<strong>R : </strong> <u><?=$opd['rate']?> ����/�ҷ�</u>
												</span>
											</td>
										</tr>
										<tr>
                  							<td valign="top">
												<strong style="font-size:20px;">�ŵ�Ǩ : </strong>
												<span style="font-size:16px;"> �Ѫ����š�� 
												<?php 
												if($bmi == '0.00' ){
													echo "'������Ѻ��õ�Ǩ";
												} else if($bmi >= 18.5 && $bmi <= 22.99){
													echo "�չ��˹ѡ���ࡳ��";
												}else{
													if($bmi < 18.5){ echo "�չ��˹ѡ��ӡ���ࡳ��";}
													if($bmi >= 23 && $bmi <= 24.99){ echo "������չ��˹ѡ�Թࡳ��";}
													if($bmi >= 25 && $bmi <= 29.99){ echo "�չ��˹ѡ�Թࡳ��";}
													if($bmi >= 30 && $bmi <= 34.99){ echo "��������ǹ��͹��ҧ�ҡ";}
													if($bmi >= 35){ echo "��������ǹ�ҡ";}
												}

												?>
												/ �����ѹ���Ե  
												<?php 
					
												$bp1 = ( empty($result['bp3']) ) ? $result['bp1'] : $result['bp3'];
												$bp2 = ( empty($result['bp4']) ) ? $result['bp2'] : $result['bp4'];

												if($bp1 =='NO'){
														echo "������Ѻ��õ�Ǩ";
												}else  if($bp1 <= 130){
														echo "����";
												}else{
													if($bp1 >=140){ 
														echo "�դ����ѹ���Ե�٧ ����͡���ѧ���ҧ�������� Ŵ����÷��������� ���;�ᾷ�����ͷӡ���ѡ��";
													}else if($bp1 >=131 && $bp1 < 140){
														echo "����������Ф����ѹ���Ե�٧ ����͡���ѧ������ҧ��������";
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
			<strong class="text" style="font-size:22px"><u>�š�õ�Ǩ�ҧ��ͧ��Ժѵԡ��</u></strong>
		</td>
	</tr>
  <tr>
    <td width="50%"  valign="top">		
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
	<tr>
		<td height="30" align="center">
			<strong class="text" style="font-size:22px"><u>CBC : ��õ�Ǩ������ʹ</u></strong>		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="50%" align="center" bgcolor="#CCCCCC"><strong>��õ�Ǩ������ʹ </strong></td>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>�ŵ�Ǩ</strong></td>
					<td width="18%" align="center" bgcolor="#CCCCCC"><strong>��һ���</strong></td>
					<!--
					<td width="17%" align="center" bgcolor="#CCCCCC"><strong>��ػ��</strong></td>
					-->
					<?php
					/*
					?>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>��ػ�š�õ�Ǩ</strong></td>
					<?php
					*/
					?>
				</tr>
				<?php 
				$sql = "SELECT *,MAX(autonumber)  AS `latest_id` 
				FROM resulthead 
				WHERE profilecode='CBC' 
				AND hn = '$hn' AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�63' 
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

				  echo "<tr height='150'><td align='center' colspan='4' style='font-size: 20px; font-weight: bold;'>������Ѻ��õ�Ǩ</td></tr>";	
				}else{	

				while($objResult = mysql_fetch_array($objQuery)){

// dump($objResult);

					if($objResult["labcode"]=="WBC"){
						$labmean="(��õ�Ǩ�Ѻ������ʹ���)";
						$wbc_result = $objResult["result"];

					}else if($objResult["labcode"]=="NEU"){
						$labmean="(��õԴ����Ấ������)";
						$neu_result = $objResult["result"];

					}else if($objResult["labcode"]=="LYMP"){
						$labmean="(��õԴ��������� ���������������ʹ)";
						$lymp_result = $objResult["result"];

					}else if($objResult["labcode"]=="MONO"){
						$labmean="(�ä����ǡѺ����� ���������������ʹ)";
					}else if($objResult["labcode"]=="EOS"){
						$labmean="(�ҡ�âͧ�ä����� ���;�Ҹ�)";
						$eos_result = $objResult["result"];

					}else if($objResult["labcode"]=="BASO"){
						$labmean="(������ä�����������ʹ���)";
					}else if($objResult["labcode"]=="ATYP"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="BAND"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="OTHER"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="NRBC"){
						$labmean="(***)";
					}else if($objResult["labcode"]=="RBC"){
						$labmean="(������ʹᴧ)";
					}else if($objResult["labcode"]=="HB"){
						$labmean="(��õ�Ǩ�Ѵ��������鹢ͧ�����źԹ)";
					}else if($objResult["labcode"]=="HCT"){
						$labmean="(����Ѵ������ʹᴧ�Ѵ��)";
						$hct_result = $objResult["result"];

					}else if($objResult["labcode"]=="MCV"){
						$labmean="(����Ѵ����ҵ�������ʹᴧ��������)";
					}else if($objResult["labcode"]=="MCH"){
						$labmean="(���˹ѡ�ͧ�����źԹ�������ʹᴧ)";
					}else if($objResult["labcode"]=="MCHC"){
						$labmean="(��������������źԹ�������ʹᴧ)";
					}else if($objResult["labcode"]=="PLTC"){
						$labmean="(��õ�Ǩ�Ѻ������ʹ����ʹ)";
						$pltc_result = $objResult["result"];
						
					}else if($objResult["labcode"]=="PLTS"){
						$labmean="";
					}else if($objResult["labcode"]=="RBCMOR"){
						$labmean="(�ٻ��ҧ������ʹᴧ)";
					}
			
					if($objResult['flag']=='L' || $objResult['flag']=='H'){
						$objResult["result"]="<strong>".$objResult["result"]."</strong>";
						$showresult="�Դ����";
					}else{
						$objResult["result"]=$objResult["result"];
						$showresult="����";
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
								// echo ( $normal_min >= $lab_result && $normal_max <= $lab_result ) ? '����' : '�Դ����' ;

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
        <td height="30" align="center"><strong class="text" style="font-size:22px"><u>UA : ��õ�Ǩ��÷ӧҹ�ͧ�������</u></strong></td>
      </tr>
      <tr>
        <td style="vertical-align: top;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
          <tr>
            <td width="49%" align="center" bgcolor="#CCCCCC"><strong>��õ�Ǩ�������</strong></td>
            <td width="14%" align="center" bgcolor="#CCCCCC"><strong>�ŵ�Ǩ</strong></td>
            <td width="17%" align="center" bgcolor="#CCCCCC"><strong>��һ���</strong></td>
			<!--
            <td width="17%" align="center" bgcolor="#CCCCCC"><strong>��ػ��</strong></td>
			-->
          </tr>
    <?php 
	$sql="SELECT *, MAX(autonumber) AS `latest_id` 
	FROM resulthead 
	WHERE profilecode = 'UA' 
	AND hn = '$hn' AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�63' 
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
				$labmean="�բͧ�������";
			}else if($objResult["labcode"]=="APPEAR"){
				$labmean="������";
			}else if($objResult["labcode"]=="SPGR"){
				$labmean="������ǧ�����";
			}else if($objResult["labcode"]=="PH"){
				$labmean="�����繡ô��ҧ";
			}else if($objResult["labcode"]=="BLOODU"){  //���ʹ㹻������
				$labmean="���ʹ㹻������";
				// if($objResult["result"]=="Negative" || $objResult["result"]=="Trace"){
				// 	$showresultua="����";
				// }else{
				// 	$showresultua="�Դ����";
				// }
			}else if($objResult["labcode"]=="PROU"){  //�õչ㹻������
				$labmean="�õչ㹻������";
				$provalue=$objResult["result"];
			}else if($objResult["labcode"]=="GLUU"){  //��ӵ��㹻������
				$labmean="��ӵ��㹻������";
				$gluuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="KETU"){
				$labmean="��⵹㹻������";
			}else if($objResult["labcode"]=="UROBIL"){
				$labmean="��÷����������ʹᴧ�٧";
			}else if($objResult["labcode"]=="BILI"){
				$labmean="�����ٺԹ㹻������";
			}else if($objResult["labcode"]=="NITRIT"){
				$labmean="��÷�㹻������";
			}else if($objResult["labcode"]=="WBCU"){  //������ʹ���
				$labmean="������ʹ���";
				$wbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="RBCU"){  //������ʹᴧ
				$labmean="������ʹᴧ";
				$rbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="EPIU"){
				$labmean="��������ͺ�";
			}else if($objResult["labcode"]=="BACTU"){
				$labmean="Ấ������";
			}else if($objResult["labcode"]=="YEAST"){
				$labmean="��ʵ�";
			}else if($objResult["labcode"]=="MUCOSU"){
				$labmean="Mucous";
			}else if($objResult["labcode"]=="AMOPU"){
				$labmean="";
			}else if($objResult["labcode"]=="CASTU"){
				$labmean="���õչ";
			}else if($objResult["labcode"]=="CRYSTU"){
				$labmean="��֡";
			}else if($objResult["labcode"]=="OTHERU"){
				$labmean="����";
			}
						
			if($objResult["labcode"]=="RBCU"){
				if($hn=="53-6092"){
					$showresultua="�Դ����";
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
								$showresultua="����";
							}else if($objResult6["result"] == "*"){
								$showresultua="*";
							}else{
								$showresultua="�Դ����";
							}
						}	
				}
			}else{
				if($objResult['flag']=='L' || $objResult['flag']=='H' || $objResult['result']=='1+'|| $objResult['result']=='2+'|| $objResult['result']=='3+'|| $objResult['result']=='4+'|| $objResult['result']=='5+'|| $objResult['result']=='6+'|| $objResult['result']=='7+'|| $objResult['result']=='8+'|| $objResult['result']=='9+'){
					$objResult["result"]="<strong>".$objResult["result"]."</strong>";
					$showresultua="�Դ����";
				}else{
					$objResult["result"]=$objResult["result"];
					$showresultua="����";
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
								<td width="60%"><b>��¡�õ�Ǩ</b></td>
								<td width="40%"><b>�ŵ�Ǩ</b></td>
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
						<strong class="text" style="font-size:22px"><u>STOOL: ��õ�Ǩ�ب����</u></strong>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellspacing="0" >
							<tr bgcolor="#CCCCCC" align="center">
								<td width="65%"><b>��¡�õ�Ǩ</b></td>
								<td width="35%"><b>�ŵ�Ǩ</b></td>
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
              <td width="30%"><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ�͡������ (X-RAY)</u> </strong> </td>
              <td width="70%"><strong class="text" style="margin-left: 9px;"> :
                <? if($opd["cxr"]==""){ echo "����"; }else{ echo $opd["cxr"];} ?>
              </strong> </td>
            </tr>

			<?php if( !empty($opd['va']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ��</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$opd['va'];?>
					</strong> </td>
				</tr>
			<?php } ?>
			<?php if( !empty($opd['eye']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ��µ����ͧ��</u> </strong> </td>
					<td><strong class="text" style="margin-left: 9px;"> :
					<?=$opd['eye']." ".$opd['eye_detail'];?>
					</strong> </td>
				</tr>
			<?php } ?>  
			<?php if( !empty($opd['pt']) ){ ?>           
				<tr>
					<td><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ���ö�Ҿ�ʹ</u> </strong> </td>
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
			if(!empty($num3)){  //����ա�äԴ��������
			?>
			<tr>
				<td>
					<strong class="text" style="font-size:18px">
						<u>�š�õ�Ǩ��������俿�� (EKG)</u>
					</strong>
				</td>
				<td>
					<strong class="text" style="margin-left: 9px;"> : <?=( !empty($result["ekg"]) ? $result["ekg"] : '����' );?></strong>
				</td>
			</tr>
			<?php } ?>   

						<?php if( !empty($result['altra']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ��ŵ��ҫ�Ǵ��ͧ��ͧ</u> </strong> </td>
								<td><strong class="text" style="margin-left: 9px;"> :
									<?=$result['altra'];?>
								</strong> </td>
							</tr>
						<? } ?>
						<?php if( !empty($result['psa']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ�����١��ҡ�¡�ä��</u> </strong> </td>
								<td><strong class="text" style="margin-left: 9px;"> :
									<?=$result['psa'];?>
								</strong> </td>
							</tr>
						<? } ?>
						<?php if( !empty($result['hpv']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ����移ҡ���١</u> </strong> </td>
								<td><strong class="text" style="margin-left: 9px;"> :
									<?=$result['hpv'];?>
								</strong> </td>
							</tr>
						<? } ?>
						<?php if( !empty($result['mammogram']) ){ ?>           
							<tr>
								<td><strong class="text" style="font-size:18px"> <u>�š�õ�Ǩ��������</u> </strong> </td>
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
	echo "������������� : </strong><span class='text' style='font-size:20px'>$comment</span> <br />";
 } ?>                
            <strong class="text" style="font-size:20px">��ػ�š�õ�Ǩ :</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text3">
          <input type="checkbox" name="checkbox" id="checkbox" />
          &nbsp;��ᾷ��
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="checkbox2" id="checkbox2" />
&nbsp;����ͧ��ᾷ��</span>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="50%" align="center" class="text3">&nbsp;</td>
                <td width="48%" align="left" class="text3"><?php for($i=1; $i<5; $i++){ echo '&nbsp;'; } ?>ᾷ�����Ǩ</td>
                <td width="2%" class="text3">&nbsp;</td>
              </tr>
							<tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">�.�.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="text3">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">(���Է�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ǧ�����)</td>
                <td class="text3">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" class="text3">&nbsp;</td>
                <td align="center" class="text3">��Ժѵ�˹�ҷ���иҹ���µ�Ǩ�آ�Ҿ �ç��Һ�Ť�������ѡ��������</td>
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
		<strong>CXR : </strong>�.�.��Է��� ��ظҴ� (�.38228) �ѧ��ᾷ��<strong> (<?=$authorisedate ;?>)</strong><br />
		-->
		<b>����Ѻ�Դ�ͺ�š�õ�Ǩ�͡������</b> �.�.��Է��� ��ظҴ� (�.38228) <b>����Ѻ�Դ�ͺ�š�õ�Ǩ�ҧ��ͧ��Ժѵԡ��</b> �.�.���� �ʧ�آ (��.3226)
	</td>
  </tr>
</table>

</div>
<?php 
} // while
?>
</body>
</html>