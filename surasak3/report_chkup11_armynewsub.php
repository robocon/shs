<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<? 
include("connect.inc");
////*runno ��Ǩ�آ�Ҿ*/////////
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
////*runno ��Ǩ�آ�Ҿ*/////////
?>
<a href ="../nindex.htm" >&lt;&lt; �����</a>
<p align="center" style="font-weight:bold;">��§ҹ�š�õ�Ǩ�آ�Ҿ���ѧ�� ��. (�ʵ.11) ��Шӻ� <?="25".$nPrefix;?> (����)
</p>
<div align="center"><a href ="report_chkup11_armynew.php">��§ҹ���������</a> || <strong>��§ҹ������˭�</strong></div>
<form name="form1" method="post" action="<?=$PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">˹��� :
        <label>      
        <select name="camp" id="camp">
          <option value="all" selected>�ء˹���</option>
          <option value="þ.��������ѡ��������">þ.��������ѡ��������</option>
          <option value="���.32">���.32</option>
          <option value="����.�þ.3">����.�þ.3</option>
          <option value="�.17 �ѹ.2">�.17 �ѹ.2</option>
          <option value="�.�ѹ.4 ����4">�.�ѹ.4 ����4</option>
          <option value="ʧ.ʴ.��.�.�.">ʧ.ʴ.��.�.�.</option>
          <option value="���.33">���.33</option>
        </select>
        <input type="submit" name="button" id="button" value="����§ҹ">
        </label></td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="show"){
if($_POST["camp"]=="all"){
$sql1="SELECT *
FROM `armychkup`
WHERE `yearchkup` = '$nPrefix'  and (camp !='D33 ˹��·�������' and camp !='')  order by chunyot asc, age desc";
}else{
$sql1="SELECT *
FROM `armychkup`
WHERE `camp` like '%$_POST[camp]%' AND `yearchkup` = '$nPrefix' and camp !='' order by chunyot asc, age desc";
}
//var_dump($sql1);
$query1=mysql_query($sql1)or die ("Query armychkup Error");

$msql=mysql_query("select pcucode, pcuname, pcupart from mainhospital where pcuid='1'");		
list($pcucode,$pcuname,$pcupart)=mysql_fetch_row($msql);

?>
<div align="center">
<div align="right">( Ẻ ç.�ʵ.11 )</div>
<h3 align="center">��ǡ �</h3>
<div align="center"><strong>������§ҹ ���Ẻ�������§ҹ��õ�Ǩ��ҧ��»�Шӻ� �ͧ���ѧ�šͧ�Ѿ����Ф�ͺ����</strong></div>
<div align="left"><strong>1. ��§ҹ�����š�õ�Ǩ��ҧ��¢ͧ���ѧ�šͧ�Ѿ��(��ºؤ��) ��Шӻ�</strong> <?="25".$nPrefix;?></div>
<div align="left"><strong>˹������ᾷ����ӡ�õ�Ǩ</strong>  <?="($pcucode) $pcuname";?></div>
<div align="left"><strong>˹��·��÷�����Ѻ��õ�Ǩ</strong> <? if($_POST["camp"]=="all"){ echo $pcupart;}else{ echo $_POST["camp"];}?></div>
<br />
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;" class="pdxpro">
  <tr>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>�ӴѺ</strong></td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>��</strong></td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>����</strong></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>���ʡ��</strong></td>
    <td width="3%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>�Ţ��Шӵ��<br />
    ��ЪҪ�</strong></td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>�ѧ�Ѵ</strong></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>���˹�</strong></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>�����Ҫ���</strong><br />
    (�к�)</td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>����</strong><br />
    (��)</td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>��</strong><br />
    <div align="left">(1) ���<br />
    (2) ˭ԧ</div></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>�Է���ԡ</strong><br />
      <div align="left">(1) ����Ҫ���<br />
      (2) �Ѱ����ˡԨ<br />
      (3) ���.<br />
      (4) ʻʪ.<br />
      (5) ����</div></td>
    <td colspan="4" align="center" valign="top" bgcolor="#FFFFFF"><strong>���˹ѡ��ǹ�٧</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>BP</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Ches x-ray</strong></td>
    <td colspan="4" align="center" valign="top" bgcolor="#FFFFFF"><strong>Urine Examination</strong></td>
    <td colspan="12" align="center" valign="top" bgcolor="#FFFFFF"><strong>�š�õ�Ǩ���ʹ</strong></td>
    <td colspan="2" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Pap smear</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>����ѵ��ä��Шӵ��</strong></td>
    <td colspan="3" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>�ĵԡ�����ô��Թ���ԵԷ���ռŵ�ͤ�������§�ä</strong></td>
  </tr>
  <tr>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>���˹ѡ</strong><br />
    (kg)</td>
    <td width="1%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>��ǹ�٧</strong><br />
    (m)</td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>BMI</strong><br />
    (kg/m2)</td>
    <td width="3%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>�ͺ���</strong><br />
    (inch)</td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Systolic</strong><br />
    (mmHg)</td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Diastolic</strong><br />
    (mmHg)</td>
    <td width="3%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>��</strong><br />
      <div align="left">0=������Ǩ<br />
      1=����<br />
      2=�Դ����</div></td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>�Դ����</strong><br />
(�к�)</td>
    <td width="3%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>��</strong><br />
      <div align="left">0=������Ǩ<br />
      1=����<br />
      2=�Դ����</div></td>
    <td colspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>�Դ����</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>CBC</strong></td>
    <td colspan="10" align="center" valign="top" bgcolor="#FFFFFF"><strong>Blood Chemistry</strong></td>
    <td width="5%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>��</strong><br />
      <div align="left">0=������ä��Шӵ��<br />
      1=�����ѹ���Ե<br />
      2=����ҹ<br />
      3=�ä���������ʹ���ʹ<br />
      4=��ѹ����ʹ�٧<br />
      5=�ä����˹�������� 2 �ä����<br />
      6=�ä��Шӵ������</div></td>
    <td width="4%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>�ä����</strong><br />
    (�к�)</td>
  </tr>
  <tr>
    <td width="4%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Proteinurea&gt;1+</strong><br />
      <div align="left">1=�����<br />
      2=��</div></td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Hematuria&gt;1+</strong><br />
    <div align="left">1=�����<br />
    2=��</div></td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>�Դ��������</strong><br />
      (�к�)</td>
    <td width="4%" align="center" valign="top" bgcolor="#FFFFFF"><strong>��</strong><br />
      <div align="left">0=������Ǩ,error<br />
      1=����<br />
      2=�Դ���� Hct&lt;40% ��� MCV &lt; 78%<br />
      3=�Դ��������</div></td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>�Դ��������</strong><br />
      (�к�)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Glu</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Chol</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>TG</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>HDL-C</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>LDL-C</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>BUN</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Cr</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Uric</strong><br />
    (mg/dL)</td>
    <td width="1%" align="center" valign="top" bgcolor="#FFFFFF"><strong>AST</strong><br />
    (U/L)</td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>ALT</strong><br />
      (U/L)</td>
    <td width="4%" align="center" valign="top" bgcolor="#FFFFFF"><strong>��</strong><br />
      <div align="left">0=������Ǩ,error<br />
      1=����<br />
      2=�Դ����</div></td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>�Դ����</strong> (�к�)</td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>����ٺ������</strong><br />
    <div align="left">0=������ٺ������<br />
      1=���ٺ ����ԡ����<br />
      2=�ٺ������ �繤��駤���<br />
      3=�ٺ������ �繻�Ш�</div></td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>��ô�������ͧ�����������š�����</strong><br />
    <div align="left">0=����´���<br />
1=�´��� ����ԡ����<br />
2=���� �繤��駤���<br />
3=���� �繻�Ш�</div></td>
    <td width="6%" align="center" valign="top" bgcolor="#FFFFFF"><strong>����͡���ѧ���</strong><br />
    <div align="left">0=������͡���ѧ���<br />
1=�͡���ѧ��µ�ӡ���ࡳ��<br />
2=�͡���ѧ��µ��ࡳ��<br />
    </div></td>
  </tr>
  <?
  $i=0;
  while($arr1=mysql_fetch_array($query1)){
  	$i++;
	if(!empty($arr1["height"])){	
	$ht = $arr1['height']/100;
	$bmi=number_format($arr1['weight'] /($ht*$ht),2);  
	}else{
	$bmi="&nbsp;";
	}
	
  
	
	
	$opsql=mysql_query("select yot,name,surname,idcard from opcard where hn='$arr1[hn]'");		
	list($yot,$name,$surname,$idcard)=mysql_fetch_row($opsql);	
	
	$chksql=mysql_query("select gender,position,ratchakarn,dxptright from chkup_solider where hn='$arr1[hn]' and yearchkup='$nPrefix'");		
	list($gender,$position,$ratchakarn,$dxptright)=mysql_fetch_row($chksql);		
	
	$age=substr($arr1["age"],0,2);
  
   ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><? if(!empty($yot)){ echo $yot;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($name)){ echo $name;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($surname)){ echo $surname;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($idcard)){ echo "<span style='color:#fff;'>'</span>".$idcard;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['camp'])){ echo substr($arr1['camp'],4);}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($position)){ echo $position;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($ratchakarn)){ echo $ratchakarn;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($age)){ echo $age;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($gender)){ echo $gender;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($dxptright)){ echo $dxptright;}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['weight'])){ echo $arr1['weight'];}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['height'])){ echo $arr1['height'];}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($bmi)){ echo $bmi;}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['waist'])){ echo $arr1['waist'];}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['bp1'])){ echo substr($arr1['bp1'],0,3);}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['bp1'])){ echo substr($arr1['bp1'],4,2);}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if($arr1['xray']==""){ echo "0";}else if($arr1['xray']=="����"){ echo "1";}else if($arr1['xray']=="�Դ����"){ echo "2";}else{ echo "0";}?></td>
    <td><? if(!empty($arr1['xray_detail'])){ echo $arr1['xray_detail'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if($arr1['ua_lab']==""){ echo "0";}else if($arr1['ua_lab']=="����"){ echo "1";}else if($arr1['ua_lab']=="�Դ����"){ echo "2";}else{ echo "0";}?></td>
    <td align="center"><? if($arr1['ua_lab']==""){ echo "0";}else if($arr1['ua_lab']=="����"){ echo "1";}else if($arr1['ua_lab']=="�Դ����"){ echo "2";}else{ echo "0";}?></td>
    <td align="center"><? if($arr1['ua_bloodu']=="1+" || $arr1['ua_bloodu']=="2+" || $arr1['ua_bloodu']=="3+" || $arr1['ua_bloodu']=="4+"){ echo "2";}else{ echo "1";}?></td>
    <td><? if(!empty($arr1['reason_ua'])){ echo $arr1['reason_ua'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if($arr1['cbc_lab']==""){ echo "0";}else if($arr1['cbc_lab']=="����"){ echo "1";}else if($arr1['cbc_lab']=="�Դ����"){ echo "2";}else{ echo "0";}?></td>
    <td><? if(!empty($arr1['reason_wbc'])){ echo $arr1['reason_wbc'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? echo $arr1['glu_result'];?></td>
    <td align="center"><? echo $arr1['chol_result'];?></td>
    <td align="center"><? echo $arr1['trig_result'];?></td>
    <td align="center"><? echo $arr1['hdl_result'];?></td>
    <td align="center"><? echo $arr1['ldl_result'];?></td>
    <td align="center"><? echo $arr1['bun_result'];?></td>
    <td align="center"><? echo $arr1['crea_result'];?></td>
    <td align="center"><? echo $arr1['uric_result'];?></td>
    <td align="center"><? echo $arr1['ast_result'];?></td>
    <td align="center"><? echo $arr1['alt_result'];?></td>
    <td align="center"><? if($arr1['pap']==""){ echo "0";}else if($arr1['pap']=="����"){ echo "1";}else if($arr1['pap']=="�Դ����"){ echo "2";}else{ echo "0";}?></td>
    <td><? if(!empty($arr1['reason_pap'])){ echo $arr1['reason_pap'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($arr1['prawat'])){ echo $arr1['prawat'];}else{ echo "0";}?></td>
    <td><? if($arr1['prawat']==6){ echo $arr1['congenital_disease'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? echo $arr1['cigarette'];?></td>
    <td align="center"><? echo $arr1['alcohol'];?></td>
    <td align="center"><? echo $arr1['exercise'];?></td>
  </tr>
  <? } ?>
</table>
</div>
<?
}
?>
