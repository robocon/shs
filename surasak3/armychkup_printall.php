<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
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
		$newPrefix="25".$nPrefix;
?>
<style type="text/css">
<!--
body,td,th {
	font-size: 14px;
	font-family: AngsanaUPC;
}
.style1 {
	font-size: 16px;
	font-weight: bold;
}
.fontbig {font-size: 14px}
.fontbig3 {font-size: 18px}
.style3 {font-size: 14px; font-weight: bold; }
.style4 {font-size: 18px; font-weight: bold; }

@media print{
	#none_print { display:none;}
}

-->
</style>
<title>�����ŵ�Ǩ�آ�Ҿ���û�Шӻ�Ẻ�����</title>
<div id="none_print">
<p align="center"><strong>�����ŵ�Ǩ�آ�Ҿ���û�Шӻ� <?=$newPrefix;?></strong></p>
<form name="form1" method="post" action="<? $PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">˹��� :
        <label>      
        <select name="camp" id="camp">
		 <?
		 $sql="select distinct(camp) as camp from armychkup where yearchkup = '$nPrefix'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value="�������§ҹ">
        </label></td>
    </tr>
  </table>
</form>
</div>
<?
if($_POST["act"]=="show"){

$camp=$_POST["camp"];
$chkcamp=substr($camp,0,3);
$select = "select * from armychkup where status_print is null and typechkup!='out' and yearchkup='$nPrefix' and camp !='' and camp !='D34 ���.33' order by chunyot asc, age desc";
//echo $select;
$row = mysql_query($select);
while($result = mysql_fetch_array($row)){
if($chkcamp=="D01"){
	$datechkup="�ѹ��� 18 ��͹ ���Ҥ� �.�. 2559";
}else if($chkcamp=="D02" || $chkcamp=="D11" || $chkcamp=="D12" || $chkcamp=="D03" || $chkcamp=="D08" || $chkcamp=="D16" || $chkcamp=="D05" || $chkcamp=="D06" || $chkcamp=="D07" || $chkcamp=="D15" || $chkcamp=="D10" || $chkcamp=="D27" || $chkcamp=="D28" || $chkcamp=="21"){  //
	$datechkup="�ѹ��� 15 ��͹ ��Ȩԡ�¹ �.�. 2559";
}else if($chkcamp=="D13" || $chkcamp=="D29" || $chkcamp=="D25"){  //
	$datechkup="�ѹ��� 16 ��͹ ��Ȩԡ�¹ �.�. 2559";	
}else if($chkcamp=="D26" || $chkcamp=="D22" || $chkcamp=="D09" || $chkcamp=="D35"){  //
	$datechkup="�ѹ��� 17 ��͹ ��Ȩԡ�¹ �.�. 2559";	
}else if($chkcamp=="D23" || $chkcamp=="D24" || $chkcamp=="D20" || $chkcamp=="D18" || $chkcamp=="D14" || $chkcamp=="D17"){  //
	$datechkup="�ѹ��� 18 ��͹ ��Ȩԡ�¹ �.�. 2559";	
}else if($chkcamp=="D04" || $chkcamp=="D32"){  //ʧ.ʴ. ����.�þ.
	$datechkup="�ѹ��� 21 ��͹ ��Ȩԡ�¹ �.�. 2559";
}else if($chkcamp=="D30"){  //�.17
	$datechkup="�ѹ��� 23 ��͹ ��Ȩԡ�¹ �.�. 2559";
}else if($chkcamp=="D31"){  //�.�ѹ4
	$datechkup="�ѹ��� 25 ��͹ ��Ȩԡ�¹ �.�. 2559";
}
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="center" valign="top"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" ><img src="logo.jpg" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" ><span class="style1" style="font-size:22px;">Ẻ��§ҹ��õ�Ǩ�آ�Ҿ��Шӻ�
            <?=$newPrefix;?>
        </span></td>
        <td width="14%" align="center" valign="top" >&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" ><span class="style1">�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</span></td>
        <td align="center" valign="top" >&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" ><span class="style1"><? echo $datechkup; ?></span>        </td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr style="line-height:3px;">
    <td colspan="4" align="center" valign="top">
    <table width="100%" class="fonthead">
      <tr>
        <td width="17%" valign="top"><strong>HN :</strong>
            <span style="font-size:16px;"><?=$result['hn']?></span></td>
        <td colspan="2" valign="top"><strong>���� :</strong>
          <span style="font-size:16px;"><?=$result['yot']." ".$result['ptname']?></span></td>
        <td width="12%" valign="top"><strong>���� :</strong>
            <span style="font-size:16px;"><?=$result['age']?></span></td>
        <td colspan="2" valign="top"><strong>�ѧ�Ѵ : </strong>
          <span style="font-size:16px;"><?= substr($result['camp'],4)?></span></td>
      </tr>
      <tr>
        <td valign="top"><strong>���˹ѡ : </strong>
              <?=$result['weight']?>&nbsp;��.</td>
        <td width="18%" valign="top"><strong>��ǹ�٧ :</strong>
              <?=$result['height']?>&nbsp;��.</td>
        <td width="15%" valign="top"><strong>�ͺ��� :</strong>
            <?=$result['waist']?>&nbsp;����</td>
        <td valign="top"><strong>�س����� :</strong>
        <?=$result['temperature']?>
        C</td>
        <td width="22%" valign="top"><strong>�վ�� : </strong>
            <?=$result['pulse']?>&nbsp;����/�ҷ�</td>
        <td width="16%" valign="top"><strong>���� : </strong>
            <?=$result['rate']?>&nbsp;����/�ҷ�</td>
      </tr>
      <tr>
        <td valign="top"><strong>������ : </strong>
            <? if($result['cigarette']=="0"){ echo "������ٺ";}else if($result['cigarette']=="1"){ echo "���ٺ ����ԡ����";}else if($result['cigarette']=="2"){ echo "�ٺ�繤��駤���";}else if($result['cigarette']=="3"){ echo "�ٺ�繻�Ш�";}?>        </td>
        <td valign="top"><strong>���� : </strong>
            <? if($result['alcohol']=="0"){ echo "����´���";}else if($result['alcohol']=="1"){ echo "�´��� ����ԡ����";}else if($result['alcohol']=="2"){ echo "�����繤��駤���";}else if($result['alcohol']=="3"){ echo "�����繻�Ш�";}?>        </td>
        <td colspan="2" valign="top"><strong>�͡���ѧ��� : </strong>
            <? if($result['exercise']=="0"){ echo "������͡���ѧ���";}else if($result['exercise']=="1"){ echo "�͡���ѧ��µ�ӡ���ࡳ��";}else if($result['exercise']=="2"){ echo "�͡���ѧ��µ��ࡳ��";}?>        </td>
        <td colspan="2" valign="top"><strong>���� :</strong>
            <?=$result['hospitaldrugreact'];?>        </td>
      </tr>
      <tr>
        <td colspan="3" valign="top"><strong>����ѵ��ä��Шӵ�� : </strong>
              <? if($result['prawat']=="0"){ echo "������ä��Шӵ��";}
	  		else if($result['prawat']=="1"){  echo "�����ѹ���Ե�٧";}
			else if($result['prawat']=="2"){  echo "����ҹ";}
			else if($result['prawat']=="3"){  echo "�ä���������ʹ���ʹ";}
			else if($result['prawat']=="4"){  echo "��ѹ����ʹ�٧";}
			else if($result['prawat']=="5"){
				if(!empty($result['prawat_ht'])){
					echo "�����ѹ���Ե�٧ ";
				}
				if(!empty($result['prawat_dm'])){
					echo " ����ҹ ";
				}
				if(!empty($result['prawat_cad'])){

					echo " �ä���������ʹ���ʹ ";
				}
				if(!empty($result['prawat_dlp'])){
					echo " ��ѹ����ʹ�٧";
				}
			}
			echo " ".$result['congenital_disease'];
			 ?>        </td>
        <td colspan="3" valign="top"><strong>�Ѻ����ѡ�ҷ�� : </strong>
          <? if($result['hospital']==""){ echo ""; }else if(($result['prawat']!="0" || $result['prawat']!="") && $result['hospital']==""){ echo "������к�";}else{ echo $result['hospital'];} ?></td>
        </tr>
    </table>
    <hr style="border:#000000 solid 1px;" />    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="25%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="3" align="center" bgcolor="#999999"><strong>�����Թ�������ç</strong></td>
        </tr>
      <tr>
        <td width="38%" align="center"><strong>��¡��</strong></td>
        <td width="31%" align="center"><strong>��</strong></td>
        <td width="31%" align="center"><strong>��ػ</strong></td>
      </tr>
      <tr>
        <td>BMI</td>
        <td align="center">
          <?=$result['bmi']?>        </td>
        <td><?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){
			echo "���";
		}else  if($result['bmi'] >=18.5 && $result['bmi'] <=23.4){
			echo "����ǹ";
		}else  if($result['bmi'] >=23.5 && $result['bmi'] <=28.4){
			echo "���˹ѡ�Թ";
		}else  if($result['bmi'] >=28.5 && $result['bmi'] <=34.9){
			echo "��͹��ҧ��ǹ";
		}else  if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "��ǹ�ҡ";
		}else  if($result['bmi'] >=40.0){
			echo "�ä��ǹ";
		}else{
			echo "������Ǩ";
		}
		?></td>
      </tr>
      <tr>
        <td>%Fat</td>
        <td align="center">
          <?=$result['fat']." %";?>        </td>
        <td>
          <?
        if($result['result_fat']==1){
			echo "���";
		}else  if($result['result_fat']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_fat']==3){
			echo "����ǹ";
		}else  if($result['result_fat']==4){
			echo "��͹��ҧ��ǹ";
		}else  if($result['result_fat']==5){
			echo "��ǹ";
		}else{
			echo "������Ǩ";
		}
		?>        </td>
      </tr>
      <tr>
        <td>Fat Mass</td>
        <td align="center"><?=$result['fat_mass'];?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Muscle Mass</td>
        <td align="center"><?=$result['muscle_mass'];?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>�ç�պ���</td>
        <td align="center">
          <?=$result['hand2']." ��./��.";?>        </td>
        <td>
          <?
        if($result['result_hand']==1){
			echo "���";
		}else  if($result['result_hand']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_hand']==3){
			echo "����";
		}else  if($result['result_hand']==4){
			echo "��";
		}else  if($result['result_hand']==5){
			echo "���ҡ";
		}else{
			echo "������Ǩ";
		}
		?>        </td>
      </tr>
      <tr>
        <td>�ç����´��</td>
        <td align="center">
          <?=$result['leg2']." ��./��.";?>        </td>
        <td>
          <?
        if($result['result_leg']==1){
			echo "���";
		}else  if($result['result_leg']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_leg']==3){
			echo "����";
		}else  if($result['result_leg']==4){
			echo "��";
		}else  if($result['result_leg']==5){
			echo "���ҡ";
		}else{
			echo "������Ǩ";
		}
		?>        </td>
      </tr>
      
      <tr>
        <td>3 Minute Test</td>
        <td align="center">
          <?=$result['steptest3']." ����/�ҷ�";?>        </td>
        <td>
          <?
        if($result['result_steptest']==1){
			echo "���";
		}else  if($result['result_steptest']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_steptest']==3){
			echo "����";
		}else  if($result['result_steptest']==4){
			echo "��";
		}else  if($result['result_steptest']==5){
			echo "���ҡ";
		}else{
			echo "������Ǩ";
		}
		?>        </td>
      </tr>
    </table>
    <div align="center" style="margin: 20px 20px 20px 20px;">
    <img src="doctor.jpg" width="148" height="139" border="0" />    </div>    </td>
    <td align="center" valign="top" width="29%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="3" align="center" bgcolor="#999999"><strong>�����Թ�آ�Ҿ</strong></td>
      </tr>
      <tr>
        <td width="39%" align="center"><strong>��¡��</strong></td>
        <td width="28%" align="center"><strong>��</strong></td>
        <td width="33%" align="center"><strong>��ػ</strong></td>
      </tr>
      <tr>
        <td>�����ѹ���Ե</td>
        <td align="center">
          <? if(empty($result['bp2'])){ echo $result['bp1'];}else{ echo $result['bp2'];} ?>&nbsp;mmHg.        </td>
        <td align="left">
		<? 
		if(empty($result['bp2'])){
			$bp1=substr($result['bp1'],0,3);
			if($bp1 >=140){
				echo "�Դ����";
			}else{
				echo "����";
			}
		}else{
			$bp2=substr($result['bp2'],0,3);
			if($bp2 >=140){
				echo "�Դ����";
			}else{
				echo "����";
			}
		}
		?></td>
      </tr>
      <tr>
        <td>�������</td>
        <td align="center">-</td>
        <td align="left"><?=$result['ua_lab']?></td>
      </tr>
      <tr>
        <td>������ʹ</td>
        <td align="center">-</td>
        <td align="left"><?=$result['cbc_lab']?></td>
      </tr>
<? if($result['age'] >=35){?>      
      <tr>
        <td>��ӵ��</td>
        <td align="center"><?=$result['glu_result']?></td>
        <td align="left"><?=$result['glu_lab']?></td>
      </tr>
      <tr>
        <td>���ԡ</td>
        <td align="center"><?=$result['uric_result']?></td>
        <td align="left"><?=$result['uric_lab']?></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#CCCCCC">��ѹ</td>
        </tr>
      <tr>
        <td>&nbsp;CHOL</td>
        <td align="center"><?=$result['chol_result']?></td>
        <td align="left"><?=$result['chol_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;TRIG</td>
        <td align="center"><?=$result['trig_result']?></td>
        <td align="left"><?=$result['trig_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;HDL</td>
        <td align="center"><?=$result['hdl_result']?></td>
        <td align="left"><? if(!empty($result['hdl_lab'])){ echo $result['hdl_lab'];}else{ echo "������Ǩ";}?></td>
      </tr>
      <tr>
        <td> &nbsp;LDL</td>
        <td align="center"><?=$result['ldl_result']?></td>
        <td align="left"><? if(!empty($result['ldl_lab'])){ echo $result['ldl_lab'];}else{ echo "������Ǩ";}?></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#CCCCCC">�</td>
        </tr>
      <tr>
        <td>&nbsp;BUN</td>
        <td align="center"><?=$result['bun_result']?></td>
        <td align="left"><?=$result['bun_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;CREA</td>
        <td align="center"><?=$result['crea_result']?></td>
        <td align="left"><?=$result['crea_lab']?></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#CCCCCC">�Ѻ</td>
        </tr>
      <tr>
        <td>&nbsp;ALP</td>
        <td align="center"><?=$result['alp_result']?></td>
        <td align="left"><?=$result['alp_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;ALT</td>
        <td align="center"><?=$result['alt_result']?></td>
        <td align="left"><?=$result['alt_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;AST</td>
        <td align="center"><?=$result['ast_result']?></td>
        <td align="left"><?=$result['ast_lab']?></td>
      </tr>
      <? }  //�Դ������ ?>
    </table></td>
    <td align="center" valign="top" width="32%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="3" align="center" bgcolor="#999999"><strong>�����Թ�ĵԡ���/��������§</strong></td>
      </tr>
      <tr>
        <td width="40%" align="center"><strong>��¡��</strong></td>
        <td width="29%" align="center"><strong>��</strong></td>
        <td width="31%" align="center"><strong>��ػ</strong></td>
      </tr>
      <tr>
        <td>�ä��Шӵ��</td>
        <td><? if($result['prawat']=="0"){ echo "�����";}else{ echo "��";} ?></td>
        <td><? if($result['prawat']=="0"){ echo "����";}else{ echo "���ä";} ?></td>
      </tr>
      <tr>
        <td>����</td>
        <td><? if($result['drugreact']==0){ echo "�����";}else if($result['drugreact']==1){ echo "��";}else{ echo "����Һ";} ?></td>
        <td><? if($result['drugreact']==0){ echo "�������§";}else if($result['drugreact']==1){ echo "����§";}else{ echo "����Һ";} ?></td>
      </tr>
      <tr>
        <td>�͡���ѧ���</td>
        <td><? if($result['exercise']=="0"){ echo "�����";}else if($result['exercise']=="1"){ echo "��ӡ���ࡳ��";}else if($result['exercise']=="2"){ echo "���ࡳ��";}?></td>
        <td><? if($result['exercise']=="0"){ echo "����§";}else if($result['exercise']=="1"){ echo "����§";}else if($result['exercise']=="2"){ echo "�������§";}?></td>
      </tr>
      <tr>
        <td>�Ҫ��͹����</td>
        <td><? if(!empty($result['health_risk'])){ echo $result['health_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['health_risk']=="��"){ echo "����§";}else if($result['health_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>�غѵ��˵�/��Ҩ�</td>
        <td><? if(!empty($result['accident_risk'])){ echo $result['accident_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['accident_risk']=="��"){ echo "����§";}else if($result['accident_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>���ʾ�Դ/ͺ���آ</td>
        <td><? if(!empty($result['addictive_risk'])){ echo $result['addictive_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['addictive_risk']=="��"){ echo "����§";}else if($result['addictive_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>�آ�Ҿ�Ե</td>
        <td><? echo $result['score_stress']; ?></td>
        <td><? echo $result['result_stress']; ?></td>
      </tr>
      <tr>
        <td>����ҹ</td>
        <td><? if(!empty($result['diabetes_risk'])){ echo $result['diabetes_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['diabetes_risk']=="��"){ echo "����§";}else if($result['diabetes_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>�</td>
        <td><? if(!empty($result['kidney_risk'])){ echo $result['kidney_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['kidney_risk']=="��"){ echo "����§";}else if($result['kidney_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>�ѳ�ä</td>
        <td><? if(!empty($result['tb_risk'])){ echo $result['tb_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['tb_risk']=="��"){ echo "����§";}else if($result['tb_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>����</td>
        <td><? if(!empty($result['heart_risk'])){ echo $result['heart_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['heart_risk']=="��"){ echo "����§";}else if($result['heart_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>�����</td>
        <td><? if(!empty($result['cancer_risk'])){ echo $result['cancer_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['cancer_risk']=="��"){ echo "����§";}else if($result['cancer_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>HIV</td>
        <td><? if(!empty($result['hiv_risk'])){ echo $result['hiv_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['hiv_risk']=="��"){ echo "����§";}else if($result['hiv_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>�Ѻ</td>
        <td><? if(!empty($result['liver_risk'])){ echo $result['liver_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['liver_risk']=="��"){ echo "����§";}else if($result['liver_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>��ʹ���ʹ��ͧ</td>
        <td><? if(!empty($result['stroke_risk'])){ echo $result['stroke_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['stroke_risk']=="��"){ echo "����§";}else if($result['stroke_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>��ҷ�</td>
        <td><? if(!empty($result['gout_risk'])){ echo $result['gout_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['gout_risk']=="��"){ echo "����§";}else if($result['gout_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>������������</td>
        <td><? if(!empty($result['knee_risk'])){ echo $result['knee_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['knee_risk']=="��"){ echo "����§";}else if($result['knee_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>��д١�Ѻ���</td>
        <td><? if(!empty($result['bone_risk'])){ echo $result['bone_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['bone_risk']=="��"){ echo "����§";}else if($result['bone_risk']=="�����"){ echo "�������§";}else{ echo "&nbsp;";} ?></td>
      </tr>
    </table></td>
    <td valign="top" width="14%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999"><strong>�آ�Ҿ��ͧ�ҡ</strong></td>
        </tr>
      <tr>
        <td><div style="margin-left:5px; margin-bottom:20px;"><input name="checkbox3" type="checkbox" id="checkbox3" <?php if($result["result_dental"]=="����"){ echo "checked"; } ?> >
����<br>
<input type="checkbox" name="checkbox3" id="checkbox4" <?php  if($result["result_dental"]=="�Դ����"){ echo "checked"; } ?> >
�Դ����...��þ��ѹ�ᾷ��<br>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["dental_disease1"]==1){ echo "checked"; } ?> >
�ѹ��</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["dental_disease2"]==1){ echo "checked"; } ?> >
  �ѹ�֡</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["dental_disease3"]==1){ echo "checked"; } ?> >
  �ä��Էѹ���ѡ�ʺ</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["gum_disease1"]==1){ echo "checked"; } ?> >
  �ä�˧�͡�ѡ�ʺ</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["gum_disease2"]==1){ echo "checked"; } ?> >
  �ѹ�ش</div>
  </div>
  </td>
        </tr>
    </table>
      <br>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
          <td bgcolor="#999999"><strong>�� X-Ray</strong></td>
        </tr>
        <tr>
          <td><div style="margin-left:5px; margin-bottom:20px;"><input name="checkbox" type="checkbox" id="checkbox" <?php if($result["xray"]=="����"){ echo "checked"; } ?> >
            ����<br>
            <input name="checkbox" type="checkbox" id="checkbox" <?php if($result["xray"]=="�Դ����"){ echo "checked"; } ?> >
            �Դ������硹���<br>
            <input type="checkbox" name="checkbox2" id="checkbox2" <?php if($result["xray"]=="�Դ���Ԥ�þ�ᾷ��"){ echo "checked"; } ?> >
            �Դ����...��þ�ᾷ��
            <? if(!empty($result["xray_detail"])){ ?>
            <div><strong>�����Դ���� : </strong><? echo $result["xray_detail"]; ?></div>
			<? } ?>
          </div></td>
        </tr>
      </table>      </td>
  </tr>
  <tr style="line-height:3px;">
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">��ػ��</td>
      </tr>
      <tr>
        <td height="80" valign="top">
        <div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
		<?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){
			echo "- ���<br>";
		}else  if($result['bmi'] >=18.5 && $result['bmi'] <=23.4){
			echo "- ����ǹ<br>";
		}else  if($result['bmi'] >=23.5 && $result['bmi'] <=28.4){
			echo "- ���˹ѡ�Թ<br>";
		}else  if($result['bmi'] >=28.5 && $result['bmi'] <=34.9){
			echo "- ��͹��ҧ��ǹ<br>";
		}else  if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "- ��ǹ�ҡ<br>";
		}else  if($result['bmi'] >=40.0){
			echo "- �ä��ǹ<br>";
		}else{
			echo "&nbsp;";
		}

		if($result["gender"]=="1"){
			if($result["waist"] >=35.4){
				echo "- ����ͺ����Թ�ҵðҹ<br>";
			}
		}else if($result["gender"]=="2"){
			if($result["waist"] >=31.5){
				echo "- ����ͺ����Թ�ҵðҹ<br>";
			}		
		}

        if($result['result_fat']==4 || $result['result_fat']==5){
			echo "- �дѺ����ҳ��ѹ�Թࡳ��<br>";
		}

        if($result['result_hand']==1 || $result['result_leg']==1){
			echo "- ���������������ç<br>";
		}else  if($result['result_hand']==2 || $result['result_leg']==2){
			echo "- ������������������ç<br>";
		}else  if($result['result_hand']==3 || $result['result_leg']==3){
			echo "- ������������ç�дѺ�ҹ��ҧ<br>";
		}else  if($result['result_hand']==4 || $result['result_leg']==4){
			echo "- ������������ç��<br>";
		}else  if($result['result_hand']==5 || $result['result_leg']==5){
			echo "- ������������ç���ҡ<br>";
		}

        if($result['result_steptest']==1 || $result['result_steptest']==2 || $result['result_steptest']==3){
			echo "- �к�������¹���ʹ���<br>";
		}
		?>        
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">��ػ��</td>
      </tr>
      <tr>
        <td height="80" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
        <?
		if(empty($result['bp2'])){
			$bp1=substr($result['bp1'],0,3);
			if($bp1 >=140 && $result['prawat']!="1"){
				echo "- �����ѹ���Ե�٧<br>";
			}
		}else{
			$bp2=substr($result['bp2'],0,3);
			if($bp2 >=140 && $result['prawat']!="1"){
				echo "- �����ѹ���Ե�٧<br>";
			}
		}
		
		if($result['bp1'] < 140 || ($result['bp2'] > 0 && $result['bp2'] < 140)){
			if($result['age'] < 35){  //���ع��¡��� 35
				if($result['prawat']=="0" && $result['ua_lab']=="����" && $result['cbc_lab']=="����"){
					echo "- �آ�Ҿ���ç<br>";
				}
			}else{  //�����ҡ���� 35 
				if($result['prawat']=="0"  && $result['ua_lab']=="����" && $result['cbc_lab']=="����" && $result['glu_lab']=="����" && $result['chol_lab']=="����" && $result['trig_lab']=="����" && $result['hdl_lab']=="����" && $result['ldl_lab']=="����" && $result['bun_lab']=="����" && $result['crea_lab']=="����" && $result['uric_lab']=="����" && $result['alp_lab']=="����" && $result['alt_lab']=="����" && $result['ast_lab']=="����"){
					echo "- �آ�Ҿ���ç����ó�<br>";
				}
			}
		}
				
        if($result['ua_lab']=="�Դ����"){
			echo "- �Ż�����о������Դ����<br>";
		}
		
		if($result['cbc_lab']=="�Դ����"){
			echo "- �ŵ�Ǩ������ʹ�������Դ����<br>";
		}

        if($result['glu_flag']=="H"){
			echo "- ��ӵ������ʹ�٧<br>";
		}else if($result['glu_flag']=="L"){
			echo "- ��ӵ������ʹ���<br>";
		}
		?>
        <?
        if($result['chol_flag']=="H" || $result['trig_flag']=="H" || $result['hdl_flag']=="H" || $result['ldl_flag']=="H"){
			echo "- ��ѹ����ʹ�٧<br>";
        }else if($result['chol_flag']=="L" || $result['trig_flag']=="L" || $result['hdl_flag']=="L" || $result['ldl_flag']=="L"){
			echo "- ��ѹ����ʹ���<br>";
		}
		?>        
        <?
        if($result['bun_lab']=="�Դ����" || $result['crea_lab']=="�Դ����"){
			echo "- ��÷ӧҹ�ͧ䵼Դ����<br>";
		}
		?> 
        <?
        if($result['alp_lab']=="�Դ����" || $result['alt_lab']=="�Դ����" || $result['ast_lab']=="�Դ����"){
			echo "- ��÷ӧҹ�ͧ�Ѻ�Դ����<br>";
		}
		?>      
        <?
        if($result['uric_flag']=="H"){
			echo "- �ô���ԡ����ʹ�٧<br>";
		}else if($result['uric_flag']=="L"){
			echo "- �ô���ԡ����ʹ���<br>";
		}
		?>        
        
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">��ػ��</td>
      </tr>
      <tr>
        <td height="80" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
          <?
		   	if($result['prawat']=="0" || $result['prawat']==""){
				echo "- ������ä��Шӵ��<br>";
			}else{
				echo "- ���ä��Шӵ��<br>";
			}
			
			if($result['exercise']=="0" || $result['exercise']=="1"){
				echo "- �͡���ѧ��µ�ӡ���ࡳ��<br>";
			}
			?>
        </div></td>
      </tr>
    </table></td>
    <td rowspan="3" valign="top"><div align="center" style="margin: 20px 20px 20px 20px;"> <img src="doctor1.jpg" width="148" height="139" border="0" /> </div></td>
  </tr>
  <tr style="line-height:3px;">
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">���й�/�Ԩ����</td>
      </tr>
      <tr>
        <td height="65" valign="top">
        <div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
        <?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){  //���
			echo "- ������ú���������������ҧ����<br>";
		}
				
		if($result['result_hand']==1 || $result['result_leg']==1 || $result['result_steptest']==1){
			echo "- Fitness ��� Exercise";
		}else  if($result['result_hand']==2 || $result['result_leg']==2 || $result['result_steptest']==2){
			echo "- Fitness ��� Exercise";
		}else  if($result['result_hand']==3 || $result['result_leg']==3 || $result['result_steptest']==3){
			echo "- Fitness ��� Exercise";
		}else{
			echo "&nbsp;";
		}
		?>                
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">���й�/�Ԩ����</td>
      </tr>
      <tr>
        <td height="65" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
        <?		
        if($result["glu_lab"]=="�Դ����" || $result["chol_lab"]=="�Դ����" || $result["trig_lab"]=="�Դ����" || $result["hdl_lab"]=="�Դ����" || $result["ldl_lab"]=="�Դ����" || $result["bun_lab"]=="�Դ����" || $result["crea_lab"]=="�Դ����"){
			echo "- �Ѵ��ô�ҹ����ҡ��<br>";
		}else if($result["uric_lab"]=="�Դ����"){  //�
			echo "- �Ѵ��ô�ҹ����ҡ��<br>";
		}
		
		if(($result['alcohol']=="2" || $result['alcohol']=="3") && ($result["alp_lab"]=="�Դ����" || $result["alt_lab"]=="�Դ����" || $result["ast_lab"]=="�Դ����")){  //2=�����繤��駤���, 3=�����繻�Ш�
			echo "- ��Ѻ����Ѻ��зҹ����� ���� ��ô�������ͧ������š�����<br>";
		}else if(($result['alcohol']=="0" || $result['alcohol']=="1") && ($result["alp_lab"]=="�Դ����" || $result["alt_lab"]=="�Դ����" || $result["ast_lab"]=="�Դ����")){
			 if($result["glu_lab"]=="�Դ����" || $result["chol_lab"]=="�Դ����" || $result["trig_lab"]=="�Դ����" || $result["hdl_lab"]=="�Դ����" || $result["ldl_lab"]=="�Դ����" || $result["bun_lab"]=="�Դ����" || $result["crea_lab"]=="�Դ����" || $result["uric_lab"]=="�Դ����"){
				echo "";
			}else{
				echo "- �Ѵ��ô�ҹ����ҡ��<br>";
			}
		}	
			
		?>
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">���й�/�Ԩ����</td>
      </tr>
      <tr>
        <td height="65" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
          <?
		   	if($result['prawat']!="0"){
				echo "- �ѡ���ä���ҧ������ͧ<br>";
			}
		
			if($result['exercise']=="0" || $result['exercise']=="1"){
				echo "- ��Ѻ�ĵԡ����آ�Ҿ ��С���͡���ѧ���<br>";
			}	
		?>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr style="line-height:3px;">
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="fontbig3">��ػ �Ԩ�������֧�������آ�Ҿ</td>
      </tr>
      <tr>
        <td height="130" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig3">
        <?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){  //���
			echo "- ���������ú���������������ҧ����<br>";
		}	
		
        if($result['result_hand']==1 || $result['result_leg']==1 || $result['result_steptest']==1){
			echo "- ����͡���ѧ������ҧ�������� ������������ҧ���ö�Ҿ<br>";
		}else  if($result['result_hand']==2 || $result['result_leg']==2 || $result['result_steptest']==2){
			echo "- ����͡���ѧ������ҧ�������� ������������ҧ���ö�Ҿ<br>";
		}else  if($result['result_hand']==3 || $result['result_leg']==3 || $result['result_steptest']==3){
			echo "- ����͡���ѧ������ҧ�������� ������������ҧ���ö�Ҿ<br>";
		}else{
			if($result['bmi'] >=28.5){
				if($result['exercise']=="0" || $result['exercise']=="1"){
					echo "- ����͡���ѧ������ҧ��������<br>";
				}			
			}
		}
		
        if($result["glu_lab"]=="�Դ����" || $result["chol_lab"]=="�Դ����" || $result["trig_lab"]=="�Դ����" || $result["hdl_lab"]=="�Դ����" || $result["ldl_lab"]=="�Դ����" || $result["bun_lab"]=="�Դ����" || $result["crea_lab"]=="�Դ����"){
			echo "- ��û�Ѻ����Ѻ��зҹ����� Ŵ��ҹ �ѹ ��� �����ѡ����������<br>";
		}
		
		if($result["uric_lab"]=="�Դ����"){
			echo "- ��û�Ѻ����Ѻ��зҹ����� ���ѵ��ա ����ͧ��ѵ�� �ʹ�ѡ��ҧ�<br>";
		}
		
		if(($result['alcohol']=="2" || $result['alcohol']=="3") && ($result["alp_lab"]=="�Դ����" || $result["alt_lab"]=="�Դ����" || $result["ast_lab"]=="�Դ����")){  //2=�����繤��駤���, 3=�����繻�Ш�
			echo "- ��û�Ѻ����Ѻ��зҹ����� ���� ��ô�������ͧ������š�����<br>";
		}else if(($result['alcohol']=="0" || $result['alcohol']=="1") && ($result["alp_lab"]=="�Դ����" || $result["alt_lab"]=="�Դ����" || $result["ast_lab"]=="�Դ����")){
			echo "- ����Ѻ��зҹ����÷������ѹ��� ��������� �� ���ǡ��ͧ ���ǫ������ ��мѡ�����<br>";
		}	
				
        if($result["result_dental"]=="�Դ����" && $result["hn"]!="58-8936"){
			echo "- �������Ѻ��õ�Ǩ�ҧ�ѹ�����<br>";
		}
        if($result["xray"]=="�Դ���Ԥ�þ�ᾷ��"){
			echo "- ��þ�ᾷ�����ͷӡ���ѡ�� ���� X-Ray ����ա����<br>";
		}
        if($result["prawat"]!="0" && $result["prawat"]!="6"){
			if($result["diagtype"]=="control"){
				echo "- �ѡ���ä���Ἱ����ѡ�Ңͧᾷ�� (Control)<br>";
			}else if($result["diagtype"]=="uncontrol"){
				echo "- �ѡ���ä���Ἱ����ѡ�Ңͧᾷ�����ҧ������ͧ (Un Control)<br>";
			}else if($result["diagtype"]=="newcase"){
				echo "- ��þ�ᾷ�����ͷӡ���ѡ���ä (New Case)<br>";
			}
		}else if($result["prawat"]=="6"){
			echo "- ����ѡ���ä��Шӵ�����ҧ������ͧ";
		}			
		?>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top" height="5"><hr style="border:#000000 solid 1px;"/></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top" class="fontbig3"><div style="border-bottom:3px double; width:150px;"><strong>��ػ�š�õ�Ǩ�آ�Ҿ</strong></div></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig3">
      <input name="resultdiagnormal" type="checkbox" id="resultdiagnormal" <?php if($result["resultdiag_normal"]==1){ echo "checked"; } ?>  />
       <? if($result['prawat']=="5"){ 
	   			if($result['prawat_ht']=="1" && $result['prawat_dm']=="1" && $result['prawat_dlp']=="1" && $result['prawat_cad']=="1"){ 
					echo "����";
				}else{
					echo "���� ��辺��������§����ä NCDs";
				}
			}else{ 
				echo "���� ��辺��������§����ä NCDs";
			}
		?>
       &nbsp;&nbsp;&nbsp;
      <input name='resultdiagrisk' type='checkbox' value='1' id="resultdiagrisk" <?php if($result["resultdiag_risk"]==1){ echo "checked"; } ?> />
      �դ�������§�����آ�Ҿ &nbsp;&nbsp;&nbsp;
      <input name='resultdiagdiseases' type='checkbox' value='1' id="resultdiagdiseases" <?php if($result["resultdiag_diseases"]==1){ echo "checked"; } ?> />
      ���´����ä������ѧ...
  <?
        if($result['prawat']=="1"){
			echo "�����ѹ���Ե�٧";
		}else if($result['prawat']=="2"){
			echo "����ҹ";
		}else if($result['prawat']=="3"){
			echo "�ä���������ʹ���ʹ";
		}else if($result['prawat']=="4"){
			echo "��ѹ����ʹ�٧";
		}else if($result['prawat']=="5"){
			if(!empty($result['prawat_ht'])){
				echo "�����ѹ���Ե�٧ ";
			}
			if(!empty($result['prawat_dm'])){
				echo " ����ҹ ";
			}
			if(!empty($result['prawat_cad'])){
				echo " �ä���������ʹ���ʹ ";
			}
			if(!empty($result['prawat_dlp'])){
				echo " ��ѹ����ʹ�٧";
			}									
		}
		?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?
    if($result['typediag']=="newcase"){
	?>
  <input name='followup' type='checkbox' value='1' id="followup" checked="checked"/>
      ������ѵԡ�û��´����ä������ѧ ����Ҿ�ᾷ�����ͷӡ���ѡ��
  <?
	}
	?>
    </div></td>
  </tr>
</table>
<?
	 	echo "<div style='page-break-after : always; position: fixed; top:0; left:0;'>&nbsp;</div>";
	}  //close while	
}  //close if show
?>

