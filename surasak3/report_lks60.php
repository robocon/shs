<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<?php

$companys = array(
	'�ӻҧ����ҳ�60' => '��.�ӻҧ����ҳ�',
	'���ͫ�60' => '����ѷ �� �� ��',
	'�������Թ��Ѿ��60' => '����ѷ �������Թ��Ѿ�� ��ا෾�ҳԪ�� �ӡѴ (��Ҫ�)',
	'ʶԵ��ӻҧ60' => '�ӹѡ�ҹʶԵԨѧ��Ѵ�ӻҧ',

	// 24-25 ����
	'���§���60' => '�ç���¹���§��žԷ�Ҥ�',

	// 1 �.�. �����ҹԪ60
	'�����ҹԪ60' => '����ѷ�����ҹԪ �ӻҧ',

	// 3-4 �.�. ͺ�60
	'ͺ�60' => 'ͧ���ú�������ǹ�ѧ��Ѵ�ӻҧ',
);

$key = $_POST['company'];
$title = $companys[$key];
?>
<title>�����㺵�Ǩ�آ�Ҿ <?=$title;?></title>
<style type="text/css">
.tet{ font-family: "TH SarabunPSK";font-size: 18px; }
.tet1{ font-family: "TH SarabunPSK";font-size: 36px; }
.text3{ font-family: "TH SarabunPSK";font-size: 16px; }
.text4{ font-family: "TH SarabunPSK";font-size: 14px; }
.text{ font-family: "TH SarabunPSK";font-size: 16px; }
.texthead{ font-family: "TH SarabunPSK";font-size: 25px; }
.text1{ font-family: "TH SarabunPSK";font-size: 22px; }
.text2{ font-family: "TH SarabunPSK";font-size: 20px; }
.textsub{ font-size: 15px;}
@media print{ #no_print{ display:none; } }
#divprint{ page-break-after:always; }
.theBlocktoPrint{ background-color: #000; color: #FFF; } 
label{ display: block; }
</style>
</head>

<body>

	<div id="no_print">
		<form name="formdx" action="report_lks60.php" method="post">
			<div class="tet1">
				�����㺵�Ǩ�آ�Ҿ <?=$title;?>
			</div>
			<div>
				<?php
				foreach ($companys as $key => $item) {
					?>
					<label for="<?=$key;?>">
						<input type="radio" name="company" id="<?=$key;?>" value="<?=$key;?>">
						<?=$item;?>
					</label>
					<?php
				}
				?>
			</div>
			<div>
				<fieldset>
					<legend>�ʴ�����¡������</legend>
					<input type="checkbox" id="ekg" name="ekg"> <label for="ekg">�ʴ��� EKG</label>
				</fieldset>
			</div>
			<div class="">
				<input type="submit" name="ok" value="��ŧ" style="width:60px; height:40px; font:'TH SarabunPSK'; font-size:20px;">
			</div>
		</form>
	</div>
<!--�ʴ�������-->
<?php 
if(isset($_POST['ok'])){
	
?>
<!--<script>
window.print() 
</script>-->
<?php
include("connect.inc");	
// $sql="SELECT  * FROM opcardchk  WHERE part='�Ѳ�Ҫ����60' and active='y' order by row";
// $row2 = mysql_query($sql)or die ("Query Fail line 83");

// $showpart = '�ӻҧ����ҳ�60';
$showpart = $_POST['company'];
$sql1 = "SELECT * 
FROM `out_result_chkup` 
WHERE `part` = '$showpart' 
ORDER BY `hn` ASC";

$row2 = mysql_query($sql1) or die ( mysql_error() );

while($result = mysql_fetch_array($row2)){

	// $select = "select * from out_result_chkup  WHERE hn='".$result['hn']."'";
	//echo $select."<br>";
	
	// $row = mysql_query($select)or die ("Query Fail line 91");
	// $result = mysql_fetch_array($row);
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
	
    $strSQL11 = "SELECT date_format(`orderdate`,'%d-%m-%Y') as orderdate2 
    FROM `resulthead` 
    WHERE `hn` = '".$result['hn']."' 
    AND ( `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�60' )";
	
    $objQuery11 = mysql_query($strSQL11);
    list($orderdate)=mysql_fetch_array($objQuery11);	
?>
<div id="divprint">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ <br><?=$title;?></strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong class="text2">�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305-6 ���� 093-2744550</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">�ѹ����Ǩ <?=$orderdate;?></span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0">
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"   class="text1" >
                <tr>
                  <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ</u> </strong><strong>HN : <?=$result['hn']?> 
                    &nbsp;&nbsp;</strong><strong>���� :</strong> <span style="font-size:24px"><strong>
                    <?=$result['ptname']?>
                    </strong></span></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"  class="text1" >
                <tr>
                  <td width="588" valign="top"><strong class="text" style="font-size:20px"><u>��Ǩ��ҧ��·����</u></strong>&nbsp;&nbsp;<span class="text3"><strong>���˹ѡ: </strong>
                      <?=$result['weight']?>
&nbsp;��. <strong>��ǹ�٧:</strong>
<?=$result['height']?>
&nbsp;��. <strong>BMI: </strong> <u>
<?=$bmi?> </u><strong>BP:<u>
<?=$result['bp1']?>
/
<?=$result['bp2']?>
mmHg. </u></strong><span class="text3"><strong>P: </strong> <u>
                      <?=$result['p']?> ����/�ҷ�

                  </u></span></span></td>
                </tr>
                <tr>
                  <td valign="top"><strong style="font-size:20px;">�ŵ�Ǩ : </strong><span style="font-size:16px;"> �Ѫ����š�� 
				  <?  if($bmi == '0.00' ){
				  			echo "'������Ѻ��õ�Ǩ";
						}
						 else if($bmi >= 18.5 && $bmi <= 22.99){
				  			
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
                  <? if($result["bp1"] =='NO'){
							echo "������Ѻ��õ�Ǩ";
						}else  if($result["bp1"] <= 130){
							echo "����";
						}else{
							if($result["bp1"] >=140){ 
								echo "�դ����ѹ���Ե�٧ ����͡���ѧ���ҧ�������� Ŵ����÷��������� ���;�ᾷ�����ͷӡ���ѡ��";
							}else if($result["bp1"] >=131 && $result["bp1"] < 140){
								echo "����������Ф����ѹ���Ե�٧ ����͡���ѧ������ҧ��������";
							}
						}
				  ?>
				  </span>
                  </td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="50%"  valign="top">
		
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
	<tr>
		<td height="30" align="center">
			<strong class="text" style="font-size:22px"><u>CBC : ��õ�Ǩ������ʹ</u></strong>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="61%" align="center" bgcolor="#CCCCCC"><strong>��õ�Ǩ������ʹ </strong></td>
					<td width="19%" align="center" bgcolor="#CCCCCC"><strong>�š�õ�Ǩ</strong></td>
					<td width="20%" align="center" bgcolor="#CCCCCC"><strong>��һ���</strong></td>
					<?php
					/*
					?>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>��ػ�š�õ�Ǩ</strong></td>
					<?php
					*/
					?>
				</tr>
				<?php 
				$sql="SELECT * 
				FROM resulthead 
				WHERE profilecode='CBC' 
				AND hn = '".$result['hn']."' 
				AND clinicalinfo ='��Ǩ�آ�Ҿ��Шӻ�60'";
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

				while($objResult = mysql_fetch_array($objQuery)){

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
					}else{
						$objResult["result"]=$objResult["result"];
					}
					?>
					<tr height="25">
						<td><?=$objResult["labcode"]." ".$labmean;?></td>
						<td align="center"><?=$objResult["result"];?></td>
						<td align="center"><?=$objResult["normalrange"];?></td>
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
				} // End while
				?>                   
				<tr height="25">
					<td colspan="3"><strong>��ػ�š�õ�Ǩ������ʹ</strong></td>
				</tr>
				<tr>
					<td colspan="3">            
						<table width="100%" border="0" cellpadding="1" cellspacing="0">
							<tr height="25">
								<td width="5%">&nbsp;</td>
								<td width="60%"><strong>�ӹǹ������ʹ (WBC)</strong></td>
								<td width="35%">
								<?php 
								if( !empty($wbc_result) ){
								
									if($wbc_result >= 5.0 && $wbc_result <= 10.0){
										echo "����";
									}else if($wbc_result == "*"){
										echo "*";
									}else{
										echo "�Դ����";
									}
								}
								?>
								</td>
							</tr>
							<!--
							<tr height="25">
								<td>&nbsp;</td>
								<td><strong>��õԴ����Ấ������ (NEU)</strong></td>
								<td>
								<?php 
								if( !empty($neu_result) ){
								
									if($neu_result >= 43 && $neu_result <= 76){
										echo "����";
									}else if($neu_result == "*"){
										echo "*";
									}else{
										echo "�Դ����";
									}
								}
								?>
								</td>
							</tr>
							
							<tr height="25">
								<td>&nbsp;</td>
								<td><strong>��õԴ��������� ���������������ʹ (LYMP)</strong></td>
								<td>
								<?php 
								if( !empty($lymp_result) ){
								
									if($lymp_result >= 17 && $lymp_result <= 48){
										echo "����";
									}else if($lymp_result == "*"){
										echo "*";
									}else{
										echo "�Դ����";
									}
								}
								?>
								</td>
							</tr>
							-->
							<tr height="25">
								<td>&nbsp;</td>
								<td><strong>�ҡ���ä���������;�Ҹ� (EOS)</strong></td>
								<td>
								<?php
								if( !empty($eos_result) ){
									if($eos_result >= 0 && $eos_result <= 5.0){
										echo "����";
									}else if($eos_result == "*"){
										echo "*";
									}else{
										echo "�Դ����";
									}
								}
								?>
								</td>
							</tr>
							<tr height="25">
								<td>&nbsp;</td>
								<td><strong>��������鹢ͧ���ʹ (HCT)</strong></td>
								<td>
								<?php
								if( !empty($hct_result) ){
									if($hct_result >= 37 && $hct_result <= 49){
										echo "����";
									}else if($hct_result == "*"){
										echo "*";
									}else{
										echo "�Դ����";
									}
								}
								?>
								</td>
							</tr>
							<tr height="25">
								<td>&nbsp;</td>
								<td><strong>������ʹ (PLTC)</strong></td>
								<td>
								<?php
								if( !empty($pltc_result) ){
									if($pltc_result >= 140 && $pltc_result <= 400){
										echo "����";
									}else if($pltc_result == "*"){
										echo "*";
									}else{
										echo "�Դ����";
									}
								}
								?>
								</td>
							</tr>
						</table>
			</td>
          </tr>
        </table>
		</td>
      </tr>
    </table></td>
    <td width="50%"  valign="top"><table width="100%" height="111" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
      <tr>
        <td height="30" align="center"><strong class="text" style="font-size:22px"><u>UA : ��õ�Ǩ��÷ӧҹ�ͧ�������</u></strong></td>
      </tr>
      <tr>
        <td style="vertical-align: top;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
          <tr>
            <td width="61%" align="center" bgcolor="#CCCCCC"><strong>��õ�Ǩ�������</strong></td>
            <td width="19%" align="center" bgcolor="#CCCCCC"><strong>�š�õ�Ǩ</strong></td>
            <td width="20%" align="center" bgcolor="#CCCCCC"><strong>��һ���</strong></td>
          </tr>
          <? $sql="SELECT * FROM resulthead WHERE profilecode='UA' and hn='".$result['hn']."' and (clinicalinfo ='��Ǩ�آ�Ҿ��Шӻ�60')";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////

$strSQL1 = "SELECT authorisename, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'";
//echo "===>".$strSQL1;
$objQuery1 = mysql_query($strSQL1);
list($authorisename,$authorisedate)=mysql_fetch_array($objQuery1);


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode ='COLOR' || labcode ='APPEAR' || labcode ='GLUU' || labcode ='PROU' || labcode ='WBCU' || labcode ='RBCU' ) ";
		//echo $strSQL;
		$objQuery = mysql_query($strSQL);

		$ua_rows = mysql_num_rows($objQuery);

		while($objResult = mysql_fetch_array($objQuery))
		{
			if($objResult["labcode"]=="COLOR"){
				$labmean="(�բͧ�������)";
			}else if($objResult["labcode"]=="APPEAR"){
				$labmean="(������)";
			}else if($objResult["labcode"]=="SPGR"){
				$labmean="(������ǧ�����)";
			}else if($objResult["labcode"]=="PHU"){
				$labmean="(�����繡ô)";
			}else if($objResult["labcode"]=="BLOODU"){  //���ʹ㹻������
				$labmean="(���ʹ㹻������)";
				if($objResult["result"]=="Negative" || $objResult["result"]=="Trace"){
					$blooduvalue="����";
				}else{
					$blooduvalue="�Դ����";
				}
			}else if($objResult["labcode"]=="PROU"){  //�õչ㹻������
				$labmean="(�õչ㹻������)";
				$provalue=$objResult["result"];
			}else if($objResult["labcode"]=="GLUU"){  //��ӵ��㹻������
				$labmean="(��ӵ��㹻������)";
				$gluuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="KETU"){
				$labmean="(��⵹㹻������)";
			}else if($objResult["labcode"]=="UROBIL"){
				$labmean="(��÷����������ʹᴧ�٧)";
			}else if($objResult["labcode"]=="BILI"){
				$labmean="(�����ٺԹ㹻������)";
			}else if($objResult["labcode"]=="NITRIT"){
				$labmean="(��÷�㹻������)";
			}else if($objResult["labcode"]=="WBCU"){  //������ʹ���
				$labmean="(������ʹ���)";
				$wbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="RBCU"){  //������ʹᴧ
				$labmean="(������ʹᴧ)";
				$rbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="EPIU"){
				$labmean="(��������ͺ�)";
			}else if($objResult["labcode"]=="BACTU"){
				$labmean="(Ấ������)";
			}else if($objResult["labcode"]=="YEAST"){
				$labmean="(��ʵ�)";
			}else if($objResult["labcode"]=="MUCOSU"){
				$labmean="";
			}else if($objResult["labcode"]=="AMOPU"){
				$labmean="";
			}else if($objResult["labcode"]=="CASTU"){
				$labmean="(���õչ)";
			}else if($objResult["labcode"]=="CRYSTU"){
				$labmean="(��֡)";
			}else if($objResult["labcode"]=="OTHERU"){
				$labmean="(����)";
			}
						
			if($objResult['flag']=='L' || $objResult['flag']=='H' || $objResult['result']=='1+'|| $objResult['result']=='2+'|| $objResult['result']=='3+'|| $objResult['result']=='4+'|| $objResult['result']=='5+'|| $objResult['result']=='6+'|| $objResult['result']=='7+'|| $objResult['result']=='8+'|| $objResult['result']=='9+'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr height="25">
            <td><?=$objResult["labcode"]." ".$labmean;?></td>
            <td align="center"><?=$objResult["result"];?></td>
            <? if($objResult["labcode"]=="PROU" || $objResult["labcode"]=="GLUU"){ ?>
            <td align="center">Negative</td>
            <? }else{ ?>
			<td align="center"><?=$objResult["normalrange"];?></td>
			<? } ?>
          </tr>
          
          <?  }
		  
		  // 
		if( $ua_rows > 0 ){
		?>
		<tr height="25">             
			<td colspan="3">
				<strong>��ػ�š�õ�Ǩ�������</strong>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<table width="100%" border="0" cellpadding="1" cellspacing="0">
					<tr height="25">
						<td width="5%">&nbsp;</td>
						<td width="48%"><strong>������ʹ��� (WBCU)</strong></td>
						<td width="47%">
						<? 
						$strSQL1 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'WBCU'";
						//echo "---->".$strSQL1;
						$objQuery1 = mysql_query($strSQL1);
						$objResult1 = mysql_fetch_array($objQuery1);					
						if($objResult1["labcode"]=="WBCU"){
							$wbculen=strlen($objResult1["result"]);
							if($wbculen >=5){
								$wbcu1=substr($objResult1["result"],0,2);
								$wbcu2=substr($objResult1["result"],3,2);
							}else if($wbculen ==4){
								$wbcu1=substr($objResult1["result"],0,1);
								$wbcu2=substr($objResult1["result"],2,2);							
							}else{
								$wbcu1=substr($objResult1["result"],0,1);
								$wbcu2=substr($objResult1["result"],2,1);
							}
							//echo $objResult1["result"];
							if($objResult1["result"] == "Negative" || ($wbcu1 >=0 && $wbcu2 <=5) && $objResult1["result"] != "*"){
								echo "����";
							}else if($objResult1["result"] == "*"){
								echo "*";
							}else{
								echo "�Դ����";
							}	
						}
						?>
						</td>
					</tr>
					<tr height="25">
						<td>&nbsp;</td>
						<td><strong>������ʹᴧ (RBCU)</strong></td>
						<td>
						<? 
						$strSQL2 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'RBCU'";
						//echo "---->".$strSQL2;
						$objQuery2 = mysql_query($strSQL2);
						$objResult2 = mysql_fetch_array($objQuery2);					
						if($objResult2["labcode"]=="RBCU"){

							if( strpos($objResult2["result"], '-') !== false ){
								
								$rbcu_normalrange = str_replace(' ', '', $objResult2["normalrange"]);
								list($rbcu_normal_min, $rbcu_normal_max) = explode('-', $rbcu_normalrange);

								$rbcu_result = str_replace(' ', '', $objResult2["result"]);
								list($rbcu_min, $rbcu_max) = explode('-', $rbcu_result);
								
								if( $rbcu_min >= $rbcu_normal_min && $rbcu_max <= $rbcu_normal_max ){
									echo "����";
								}else{
									echo "�Դ����";
								}

							}else{
								if( $objResult2["result"] == "*" ){
									echo "*";
								}else if( $objResult2["result"] == "Negative" ){
									echo "����";
								}else{
									echo "�Դ����";
								}
							}

							/*
							$rbculen=strlen($objResult2["result"]);
							
							if($rbculen >=5){
								$rbcu1=substr($objResult2["result"],0,2);
								$rbcu2=substr($objResult2["result"],3,2);
							}else if($rbculen ==4){
								$rbcu1=substr($objResult2["result"],0,1);
								$rbcu2=substr($objResult2["result"],2,2);						
							}else{
								$rbcu1=substr($objResult2["result"],0,1);
								$rbcu2=substr($objResult2["result"],2,1);
							}
							
							if($objResult2["result"] == "Negative" || ($rbcu1 >=0 && $rbcu2 <=1) && $objResult1["result"] != "*"){
								echo "����";
							}else if($objResult2["result"] == "*"){
								echo "*";
							}else{
								echo "�Դ����";
							}
							*/
						}
						?>
						</td>
					</tr>
					<tr height="25">
						<td>&nbsp;</td>
						<td><strong>��ӵ�� (GLUU)</strong></td>
						<td>
						<? 
						$strSQL4 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'GLUU'";
						//echo "---->".$strSQL4;
						$objQuery4 = mysql_query($strSQL4);
						$objResult4 = mysql_fetch_array($objQuery4);					
						if($objResult4["labcode"]=="GLUU"){
							if($objResult4["result"] == "Negative"){
								echo "����";
							}else if($objResult1["result"] == "*"){
								echo "*";
							}else{
								echo "�Դ����";
							}
						}
						?>
						</td>
					</tr>
					<tr height="25">
						<td>&nbsp;</td>
						<td><strong>�õչ (PROU)</strong></td>
						<td>
						<? 
						$strSQL5 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'PROU'";
						//echo "---->".$strSQL5;
						$objQuery5 = mysql_query($strSQL5);
						$objResult5 = mysql_fetch_array($objQuery5);		
						if($objResult5["labcode"]=="PROU"){
							if($objResult5["result"] == "Negative" || $objResult5["result"] == "Trace"){
								echo "����";
							}else if($objResult5["result"] == "*"){
								echo "*";
							}else{
								echo "�Դ����";
							}
						}
						?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<?php
		}
		?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top">
 <?php

$sql1 = "SELECT * 
FROM resulthead 
WHERE ( 
	profilecode='GLU' 
	OR profilecode='CREA' 
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
) 
AND hn = '".$result['hn']."' 
AND ( clinicalinfo ='��Ǩ�آ�Ҿ��Шӻ�60' ) 
GROUP BY profilecode 
ORDER BY `autonumber`";
$query1 = mysql_query($sql1) or die( mysql_error() );
$other_result_row = mysql_num_rows($query1);
 if( $other_result_row > 0 ){ 
 ?>
 </td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" style="border-collapse:collapse; border-bottom-style:none;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" height="30">
			<strong class="text" style="font-size:20px"><u>�š�õ�Ǩ�ҧ��ͧ��Ժѵԡ�� : ����</u></strong>
		</td>
      </tr>
      <tr>
        <td height="52" valign="top" style="padding: 2px;">
		<table width="100%" border="0" class="text3" cellpadding="0" cellspacing="0">
            <tr>
              <td width="32%" valign="top" bgcolor="#CCCCCC"><strong>��¡�õ�Ǩ</strong></td>
              <td width="9%" valign="top" bgcolor="#CCCCCC"><strong>�š�õ�Ǩ</strong></td>
              <td width="9%" valign="top" bgcolor="#CCCCCC"><strong>��һ���</strong></td>
              <td width="50%" valign="top" bgcolor="#CCCCCC" style="font-size:16px;"><strong>��ػ�š�õ�Ǩ</strong></td>
            </tr>
            <?


$i=0;
while($arrresult = mysql_fetch_array($query1)){
		$i++;
		//echo $i;

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
//echo $strSQL;
$objQuery = mysql_query($strSQL);
while($objResult = mysql_fetch_array($objQuery)){
			if($objResult["labname"]=="Blood Sugar"){
				$labmean="(�дѺ��ӵ������ʹ)";
			}else if($objResult["labname"]=="BUN"){
				$labmean="(��÷ӧҹ�ͧ�)";
			}else if($objResult["labname"]=="Creatinine"){
				$labmean="(��÷ӧҹ�ͧ�)";
			}else if($objResult["labname"]=="Uric acid"){
				$labmean="(���Ԥ����ʹ)";
			}else if($objResult["labname"]=="Cholesterol"){
				$labmean="(��ѹ����ʹ)";
			}else if($objResult["labname"]=="Triglyceride"){
				$labmean="(��ѹ����ʹ)";
			}else if($objResult["labname"]=="HDL"){
				$labmean="(��ѹ��)";			
			}else if($objResult["labname"]=="LDL"){
				$labmean="(��ѹ���)";	
			}else if($objResult["labname"]=="LDLC"){
				$labmean="(��ѹ���)";												
			}else if($objResult["labname"]=="SGOT(AST)"){
				$labmean="(��÷ӧҹ�ͧ�Ѻ)";
			}else if($objResult["labname"]=="SGPT(ALT)"){
				$labmean="(��÷ӧҹ�ͧ�Ѻ)";
			}else if($objResult["labname"]=="Alkaline phosphatase"){
				$labmean="(��÷ӧҹ�ͧ�Ѻ)";
			}else if($objResult["labname"]=="HBsAg"){
				$labmean="(��������ʵѺ�ѡ�ʺ��)";
			}else if($objResult["labname"]=="Anti-HBs"){
				$labmean="(���Ե�ҹ�ҹ����ʵѺ�ѡ�ʺ��)";
			}
			
if($objResult["labcode"]=='GLU'){
	if($objResult["result"]>=74 && $objResult["result"]<=106){
		$app="�дѺ��ӵ������ʹ�դ�������ࡳ�컡��";
	}else if($objResult["result"]>106 && $objResult["result"]<=125){
		$app="�дѺ��ӵ������ʹ�դ���٧�Դ����";
	}else if($objResult["result"]>125){
		$app="�дѺ��ӵ������ʹ�դ���٧�ҡ�Դ����";	
	}
}

if($objResult["labcode"]=='BUN'){
	if($objResult["result"]>18){
		$app="�Դ���� ��äǺ�������� �� ��ӵ�� ���������ҹ �����Ѻ�͡���ѧ���";	
	}else if($objResult["result"]>=7 && $objResult["result"]<=18){
		$app="��÷ӧҹ�ͧ��դ�������ࡳ�컡��";	
	}else if($objResult["result"]<7 ){
		$app="�Դ���� ��÷ӧҹ�ͧ䵵�ӡ��һ���";	
	}
	
}

if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>1.3){
		$app="�Դ���� ��äǺ�������÷����������٧ ���������٧ �� �� ������ʧ �ͧ����ء��Դ";	
	}else if($objResult["result"]>=0.6 && $objResult["result"]<=1.3){
		$app="��÷ӧҹ�ͧ��դ�������ࡳ�컡��";	
	}else if($objResult["result"]<0.6){
		$app="�Դ���� ��÷ӧҹ�ͧ䵵�ӡ��һ���";	
	}
}

if($objResult["labcode"]=='URIC'){
	if($objResult["result"]>7.2){
		$app="�Դ���� ��ç�����ͧ�����������š����� ����ͧ��ѵ�� �ѵ��ա";	
	}else if($objResult["result"] >=2.6 && $objResult["result"] <=7.2){
		$app="�дѺ�ô���Ԥ�դ�������ࡳ�컡��";	
	}else if($objResult["result"]<2.6){
		$app="�Դ���� �дѺ�ô���Ԥ��ӡ��һ���";	
	}
}


if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
	}else	if($objResult["result"]>200){
		$app="�Դ���� ��äǺ�������þǡ����ͧ��ѵ�� ����÷��� ��ᴧ �蹡��з� �з� ��ѹ�ѵ�� �����Ѻ����͡���ѧ���";	
	}else	if($objResult["result"]>300){
		$app="�Դ���� �дѺ��ѹ����ʹ�٧�ҡ�Դ����";	
	}
}

if($objResult["labcode"]=='TRIG'){
	if($objResult["result"]<=150){
		$app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
	}else	if($objResult["result"]>150 && $objResult["result"]<250){
		$app="�Դ���� ��äǺ�������þǡ�� ��ӵ�� �������ҹ �������� �з� ������ͧ������š����� �����Ѻ����͡���ѧ���";	
	}else	if($objResult["result"]>250){
		$app="�Դ���� �дѺ��ѹ����ʹ�٧�ҡ�Դ����";	
	}
}

if($objResult["labcode"]=='HDL'){
	if($objResult["result"]>=40 && $objResult["result"]<=60){
		$app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
	}else	if($objResult["result"]>60){  //�٧��
		$app="������дѺ HDL �٧ �з����Ŵ��������§����ä������ʹ���㨵պ";	
	}else	if($objResult["result"]<40){  //�������
		$app="�дѺ��ѹ����ʹ�դ�ҵ�ӼԴ���� ��ç��ٺ�����������Ѻ����͡���ѧ��� �Ѻ��з������û��������ͻ��";	
	}
}

if($objResult["labcode"]=='10001'){
	if($objResult["result"]>=0 && $objResult["result"]<=100){
		$app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
	}else	if($objResult["result"]>100){
		$app="�Դ���� ��äǺ�������þǡ����ͧ��ѵ�� ����÷��� ��ᴧ �з� ����ѹ�ѵ�� ���ٺ������ �����Ѻ����͡���ѧ���";	
	}
}

if($objResult["labcode"]=='LDL'){
	if($objResult["result"]>=0 && $objResult["result"]<=100){
		$app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
	}else	if($objResult["result"]>100){
		$app="�Դ���� ��äǺ�������þǡ����ͧ��ѵ�� ����÷��� ��ᴧ �з� ����ѹ�ѵ�� ���ٺ������ �����Ѻ����͡���ѧ���";	
	}
}

if($objResult["labcode"]=='LDLC'){
	if($objResult["result"]>=0 && $objResult["result"]<=100){
		$app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
	}else	if($objResult["result"]>100){
		$app="�Դ���� ��äǺ�������þǡ����ͧ��ѵ�� ����÷��� ��ᴧ �з� ����ѹ�ѵ�� ���ٺ������ �����Ѻ����͡���ѧ���";	
	}
}

if($objResult["labcode"]=='AST'){  //SGOT
	if($objResult["result"]>=15 && $objResult["result"]<=37){
		$app="��÷ӧҹ�ͧ�Ѻ����";	
	}else	if($objResult["result"]>37){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
	}else	if($objResult["result"]<15){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
	}
}
if($objResult["labcode"]=='ALT'){  //SGPT
	if($objResult["result"]>=0 && $objResult["result"]<=50){
		$app="��÷ӧҹ�ͧ�Ѻ����";		
	}else{
		$app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
	}
}

if($objResult["labcode"]=='ALP'){  //ALK
	if($objResult["result"]>=46 && $objResult["result"]<=116){
		$app="��÷ӧҹ�ͧ�Ѻ����";	
	}else	if($objResult["result"]>116){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
	}else	if($objResult["result"]<46){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
	}
}

if($objResult["labcode"]=='HBSAG'){  //HBSAG
	if($objResult["result"]=="Negative"){
		$app="����";	
	}else if($objResult["result"]=="Positive"){
		$app="�Դ����";	
	}
}

if($objResult["labcode"]=='ANTIHB'){  //HBSAB
	if($objResult["result"]=="Negative"){
		$app="����";	
	}else if($objResult["result"]=="Positive"){
		$app="�Դ����";	
	}
}

		?>
            <tr height="25">
              <td width="34%" valign="top"><strong>
                <?=$objResult["labname"]." ".$labmean;?>
              </strong></td>
              <td width="8%" valign="top"><? if($objResult["flag"]!="N" || $objResult['result']=='Positive'){ echo "<strong>".$objResult["result"]."</strong>";}else{ echo $objResult["result"];}?></td>
              <td width="9%" valign="top"><?=$objResult["normalrange"];?></td>
              <td width="49%" valign="top" style="font-size:16px;"><?=$app;?></td>
            </tr>
            <? 
		  } 
		}
	?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top">
	<? } ?>
	
	</td>
  </tr>
	<?php

	$normal_outlab = array(
		'AFP' => '12',
		'CA125' => '0-35',
		'CA153' => '0-35',
		'CA199' => '0-39',
		'CEA' => '0-4.7',
		'PSA' => '0-4',
	);

	$sql = "SELECT a.*, c.`labcode`, c.`result`,c.`normalrange`
	FROM (

		SELECT MAX(`autonumber`) AS `autonumber`
		FROM `resulthead` 
		WHERE `hn` = '".$result['hn']."' 
		AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�60' 
		AND `testgroupcode` = 'OUT' 
		GROUP BY `profilecode` 

	) AS b 
	LEFT JOIN `resulthead` AS a ON a.`autonumber` = b.`autonumber` 
	LEFT JOIN `resultdetail` AS c ON c.`autonumber` = b.`autonumber`";
	$q = mysql_query($sql) or die( mysql_error() );
	$outlab_row = mysql_num_rows($q);
	if( $outlab_row > 0 ){
	?>
	<tr>
		<td colspan="2">
			<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">
				<tr>
					<td colspan="2" class="text" style="text-align: center; text-decoration: underline; font-size: 20px; font-weight: bold;">Lab �͡</td>
				</tr>
				<tr>
					<td colspan="2">
						<table width="100%">
							<tr class="text3" style="background-color: #CCCCCC;">
								<td><b>��¡�õ�Ǩ</b></td>
								<td><b>��һ���</b></td>
								<td><b>�š�õ�Ǩ</b></td>
								<td><b>��ػ�š�õ�Ǩ</b></td>
							</tr>
							<?php
							while( $outlab = mysql_fetch_assoc($q)){
								$outlab_code = $outlab['labcode'];

								// ��Ҥ���š��͡仡�͹
								$outlab_result = str_replace(array('<','>'), '', $outlab['result']);

								// ��� normal range ����繾ǡ outlab
								$outlab_range = $normal_outlab[$outlab_code];
							?>
							<tr class="text3">
								<td><?=$outlab_code;?></td>
								<td><?=$outlab_range;?></td>
								<td><?=$outlab_result;?></td>
								<td>
									<?php
									// default �繤�һ���
									$result_outlab_txt = '�Դ����';

									if( strpos($outlab_range, '-') !== false ){

										list($outlab_min, $outlab_max) = explode('-', $outlab_range );
										if( $outlab_result >= $outlab_min && $outlab_result <= $outlab_max ){
											$result_outlab_txt = '����';
										}

									}else{ // �ó�����բմ
										if( $outlab_result >= 0 && $outlab_result <= $outlab_range ){
											$result_outlab_txt = '����';
										}
									}
									echo $result_outlab_txt;
									?>
								</td>
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
	<?php
	}
	?>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">          
      <? if($result["hn"]=="48-21424" || $result["hn"]=="60-1066" || $result["hn"]=="60-1067"){ ?>
      <tr>
        <td><strong class="text" style="font-size:18px"><u>�š�õ�Ǩ����移ҡ���١ (Pap Smear)</u></strong><strong class="text" style="margin-left: 9px;"> :
          <? if($result["hpv"]==""){ echo "����"; }else{ echo "�Դ����"; } ?>
        </strong></td>
      </tr>
      <? } ?>         
        <tr>
			<td height="30" width="60%">

				<table>
					<tr>
						<td>
							<strong class="text" style="font-size:18px">
								<u>�š�õ�Ǩ�͡������ (X-RAY)</u>
							</strong>
						</td>
						<td>
							<strong class="text" style="margin-left: 9px;"> : <? if($result["cxr"]==""){ echo "����"; }else{ echo $result["cxr"]; } ?></strong>
						</td>
					</tr>
					<?php
					if( !empty($result['va']) ){
						?>
						<tr>
							<td>
								<strong class="text" style="font-size:18px">
									<u>�š�õ�Ǩ��</u>
								</strong>
							</td>
							<td>
								<strong class="text" style="margin-left: 9px;"> : <?=$result['va'];?></strong>
							</td>
						</tr>
						<?php
					}
					
					$ekg = $_POST['ekg'];
					if( !empty($ekg) ){
						?>
						<tr>
							<td>
								<strong class="text" style="font-size:18px">
									<u>�š�õ�Ǩ����俿������</u>
								</strong>
							</td>
							<td>
								<strong class="text" style="margin-left: 9px;"> : <?=( ( empty($result['ekg']) ) ? '����' : '�Դ����' )?></strong>
							</td>
						</tr>
						<?php
					}
					
					if( !empty($result['42702']) ){
						?>
						<tr>
							<td>
								<strong class="text" style="font-size:18px">
									<u>�š�õ�Ǩ����˹��蹢ͧ��š�д١</u>
								</strong>
							</td>
							<td>
								<strong class="text" style="margin-left: 9px;"> : <?=$result['42702'];?></strong>
							</td>
						</tr>
						<?php
					}
					?>
				</table>
			</td>
			<td rowspan="2" valign="bottom">
				<!-- ��ͧ�� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				
					<tr>
						<td align="center" class="text3">ᾷ�����Ǩ<?php for($i=1; $i<60; $i++){ echo '&nbsp;'; } ?></td>
						<td class="text3">&nbsp;</td>
					</tr>
					<tr>
						<td align="center" class="text3">�.�. ���Է�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ǧ�����</td>
						<td class="text3">&nbsp;</td>
					</tr>
					<tr>
						<td align="center" class="text3">&nbsp;ᾷ���Ш� þ.��������ѡ�������� �.�ӻҧ</td>
						<td class="text3">&nbsp;</td>
					</tr>
				</table>
				<!-- ��ͧ�� -->
			</td>
        </tr>
        <tr>
          <td valign="bottom"><strong class="text" style="font-size:20px">��ػ�š�õ�Ǩ :</strong>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text3">
            <input type="checkbox" name="checkbox" id="checkbox" />&nbsp;��ᾷ��
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="checkbox2" id="checkbox2" />
                  &nbsp;����ͧ��ᾷ��</span>
			
			</td>
			
        </tr>               
    </table></td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB:</strong><?=$authorisename?> <strong> (<?=$authorisedate?>) </strong><strong>CXR : </strong>�.�.��Է��� ��ظҴ� (�.38228) �ѧ��ᾷ��<strong> (05-03-2017)</strong><br /></td>
    
  </tr>
</table>
</div>
<?php 
} // while
} 
?>
</body>
</html>