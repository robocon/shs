
<!--<h1 class="forntsarabun">��ԹԤ����ҹ</h1>-->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<!--<h1 class="forntsarabun">ʶԵ�Ἱ��ѧ�ա���</h1>-->
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td width="64"  align="right">���͡��</td>
    <td width="387" >
      <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>&nbsp;  <a href="hd_from.php" class="forntsarabun">ŧ����������</a> &nbsp;</td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="����"){
	
	$date1=($_POST['y_start'])-543;
	
	include("../connect.inc");
	
			
///////////////  �����Тͧ������ DM ����դ�� BP < 130/80 mmHg ///////////		
	$listbp = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   opd_hd  WHERE date_hd  like '".$date1."-".$m."-%' and bp1 <130 AND bp2 <80";
		$result = mysql_query($selectsql);
		$arrp = mysql_fetch_array($result);
		array_push($listbp,$arrp[0]);
		

	}
	

			$strbp="SELECT COUNT(*) as countbp FROM  `opd_hd` WHERE bp1 <130 AND bp2 <80 and  date_hd like '".$date1.'%'."' ";
			$resultbp = mysql_query($strbp);
			$arr = mysql_fetch_array($resultbp);
	
		//	$avg=100*$arr['countbp']/$dbarr['count1'];
			
//////////////////////////////  �����Тͧ������ DM ����դ�� LDL < 100 mg/dl /////////////

$listldl = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and l_ldl < 100 ";
		$result = mysql_query($selectsql);
		$arrldl1 = mysql_fetch_array($result);
		array_push($listldl,$arrldl1[0]);
	}

			$strldl="SELECT COUNT(*) as countldl FROM  `diabetes_clinic` WHERE l_ldl <100 and  thidate like '".$date1.'%'."' ";
			$resultldl = mysql_query($strldl);
			$arrldl2= mysql_fetch_array($resultldl);
	
		//	$avgldl=100*$arrldl['countldl']/$dbarr['count1'];
			
///////////////////////////// �����Тͧ������ DM ����դ�� HbaA1c <7% //////////////////////		

$listhba = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic WHERE thidate like '".$date1."-".$m."-%' and l_hbalc < 7 ";
		$result = mysql_query($selectsql);
		$arrhba1 = mysql_fetch_array($result);
		array_push($listhba,$arrhba1[0]);
	
	}


			$strhba="SELECT COUNT(*) as counthba FROM  `diabetes_clinic` WHERE l_hbalc < 7 and  thidate like '".$date1.'%'."' ";
			$resulthba= mysql_query($strhba);
			$arrhba= mysql_fetch_array($resulthba);
			
			//$avghba=100*$arrhba['counthba']/$dbarr['count1'];


			
///////////////////////////// �����Тͧ������ DM ������Ѻ��õ�Ǩ BS  //////////////////////		

$list01 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and l_bs!='' ";
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		
	//	echo $selectsql;
		
		array_push($list01,$arr01[0]);
	
	}


			$str01="SELECT COUNT(*) as count01 FROM  `diabetes_clinic` WHERE  l_bs !='' and  thidate like '".$date1.'%'."' ";
			$result01= mysql_query($str01);
			$arr01= mysql_fetch_array($result01);			
			
///////////////////////////// �����Тͧ������ DM ������Ѻ��õ�Ǩ hbalc  //////////////////////		

$list02 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and 
		l_hbalc!='' ";
		$result = mysql_query($selectsql);
		$arr02 = mysql_fetch_array($result);
		array_push($list02,$arr02[0]);
	
	}


			$str02="SELECT COUNT(*) as count02 FROM  `diabetes_clinic` WHERE  l_hbalc !='' and  thidate like '".$date1.'%'."' ";
			$result02= mysql_query($str02);
			$arr02= mysql_fetch_array($result02);			
			
///////////////////////////// �����Тͧ������ DM ������Ѻ��õ�Ǩ LDL  //////////////////////		

$list03 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT COUNT(*)  FROM   diabetes_clinic  WHERE thidate like '".$date1."-".$m."-%' and 
		l_ldl!='' ";
		$result = mysql_query($selectsql);
		$arr03 = mysql_fetch_array($result);
		array_push($list03,$arr03[0]);
	
	}


			$str03="SELECT COUNT(*) as count03 FROM  `diabetes_clinic` WHERE  l_ldl !='' and  thidate like '".$date1.'%'."' ";
			$result03= mysql_query($str03);
			$arr03= mysql_fetch_array($result03);				
			

?>
<div class="forntsarabun" align="center">�Ѫ�ժ���Ѵ�س�Ҿ þ.��������ѡ�������� �ͧ/Ἱ�/��ͧ��Ǩ�ä</div>
<div class="forntsarabun" align="center">FR - QMR - 004/7, 00,29 ��.�. 48</div>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" class="forntsarabun">�ѵ�ػ��ʧ��</td>
  <td rowspan="2" align="center" class="forntsarabun">
    <p>����ͧ����Ѵ</p></td>
<td rowspan="2" align="center" class="forntsarabun">�������</td>
<td rowspan="2" align="center" class="forntsarabun">����Ѻ�Դ�ͺ</td>
	<td rowspan="2" align="center" class="forntsarabun">��<br>
	  <?=($date1+543)?>
    </td>
  <td colspan="12" align="center" class="forntsarabun">�� 
    <?=($date1+543)?>
  </td>
</tr>
<tr>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">��.�.</td>
  <td align="center" class="forntsarabun">��.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">��.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
</tr>
<tr>
  <td rowspan="13" valign="top" class="forntsarabun">1.��ҹ�س�Ҿ���<br />
    ����ԡ�þ�Һ��</td>
<td valign="top" class="forntsarabun">- �ѵ�ҡ�äǺ�����Ҵѹ���Ե &lt;130/80 mmHg</td>
  <td align="center" valign="top" class="forntsarabun">>80%</td>
  <td align="center" valign="top" class="forntsarabun">������</td>

    <td align="center" class="forntsarabun"><?=$arr['countbp'];?></td>
    <? 
	for($x=0;$x<=11;$x++){
		echo "<td align='center' class='forntsarabun'>$listbp[$x]</td>";
	}
	?>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ�äǺ�����ӵ��㹡�������ʹ<br />
    1.prepadial BS 90-130<br />
    2.postpadial BS &lt;180</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td align="center" class="forntsarabun"><?=$arr02['count02'];?></td>
  <? 
	for($x=0;$x<=11;$x++){
		echo "<td align='center' class='forntsarabun'>$list02[$x]</td>";
	}
	?>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ�äǺ�����ѹ����ʹ<br />
    1.LDL &lt;100<br />
    2.LDL &lt;70 㹼����·�����ä������� stroke</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td align="center" class="forntsarabun"><?=$arr03['count03'];?></td>
  <td align="center" class="forntsarabun"><?=$list03[0];?></td>
  <td align="center" class="forntsarabun"><?=$list03[1];?></td>
  <td align="center" class="forntsarabun"><?=$list03[2];?></td>
  <td align="center" class="forntsarabun"><?=$list03[3];?></td>
  <td align="center" class="forntsarabun"><?=$list03[4];?></td>
  <td align="center" class="forntsarabun"><?=$list03[5];?></td>
  <td align="center" class="forntsarabun"><?=$list03[6];?></td>
  <td align="center" class="forntsarabun"><?=$list03[7];?></td>
  <td align="center" class="forntsarabun"><?=$list03[8];?></td>
  <td align="center" class="forntsarabun"><?=$list03[9];?></td>
  <td align="center" class="forntsarabun"><?=$list03[10];?></td>
  <td align="center" class="forntsarabun"><?=$list03[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ�äǺ����дѺ ca x P &lt; 55</td>
  <td align="center" valign="top" class="forntsarabun">&nbsp;</td>
  <td align="center" valign="top" class="forntsarabun">������<br />
    ����</td>
  <td align="center" class="forntsarabun"><?=$arr04['count04'];?></td>
  <td align="center" class="forntsarabun"><?=$list04[0];?></td>
  <td align="center" class="forntsarabun"><?=$list04[1];?></td>
  <td align="center" class="forntsarabun"><?=$list04[2];?></td>
  <td align="center" class="forntsarabun"><?=$list04[3];?></td>
  <td align="center" class="forntsarabun"><?=$list04[4];?></td>
  <td align="center" class="forntsarabun"><?=$list04[5];?></td>
  <td align="center" class="forntsarabun"><?=$list04[6];?></td>
  <td align="center" class="forntsarabun"><?=$list04[7];?></td>
  <td align="center" class="forntsarabun"><?=$list04[8];?></td>
  <td align="center" class="forntsarabun"><?=$list04[9];?></td>
  <td align="center" class="forntsarabun"><?=$list04[10];?></td>
  <td align="center" class="forntsarabun"><?=$list04[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�Ҥ�������鹢ͧ���ʹ<br />
    1. HCT �ҡ����������ҡѺ 30 mg/dl <br />
    2. HB �ҡ����������ҡѺ</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td align="center" class="forntsarabun"><?=$arr05['count05'];?></td>
  <td align="center" class="forntsarabun"><?=$list05[0];?></td>
  <td align="center" class="forntsarabun"><?=$list05[1];?></td>
  <td align="center" class="forntsarabun"><?=$list05[2];?></td>
  <td align="center" class="forntsarabun"><?=$list05[3];?></td>
  <td align="center" class="forntsarabun"><?=$list05[4];?></td>
  <td align="center" class="forntsarabun"><?=$list05[5];?></td>
  <td align="center" class="forntsarabun"><?=$list05[6];?></td>
  <td align="center" class="forntsarabun"><?=$list05[7];?></td>
  <td align="center" class="forntsarabun"><?=$list05[8];?></td>
  <td align="center" class="forntsarabun"><?=$list05[9];?></td>
  <td align="center" class="forntsarabun"><?=$list05[10];?></td>
  <td align="center" class="forntsarabun"><?=$list05[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ�äǺ��� serum phosephate ���¡��� 4.5 mg/dl</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td align="center" class="forntsarabun"><?=$arr06['count06'];?></td>
  <td align="center" class="forntsarabun"><?=$list06[0];?></td>
  <td align="center" class="forntsarabun"><?=$list06[1];?></td>
  <td align="center" class="forntsarabun"><?=$list06[2];?></td>
  <td align="center" class="forntsarabun"><?=$list06[3];?></td>
  <td align="center" class="forntsarabun"><?=$list06[4];?></td>
  <td align="center" class="forntsarabun"><?=$list06[5];?></td>
  <td align="center" class="forntsarabun"><?=$list06[6];?></td>
  <td align="center" class="forntsarabun"><?=$list06[7];?></td>
  <td align="center" class="forntsarabun"><?=$list06[8];?></td>
  <td align="center" class="forntsarabun"><?=$list06[9];?></td>
  <td align="center" class="forntsarabun"><?=$list06[10];?></td>
  <td align="center" class="forntsarabun"><?=$list06[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ�äǺ��� serum  biocarbonate 22-26 meq/l</td> 
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td align="center" class="forntsarabun"><?=$arr07['count07'];?></td>
  <td align="center" class="forntsarabun"><?=$list07[0];?></td>
  <td align="center" class="forntsarabun"><?=$list07[1];?></td>
  <td align="center" class="forntsarabun"><?=$list07[2];?></td>
  <td align="center" class="forntsarabun"><?=$list07[3];?></td>
  <td align="center" class="forntsarabun"><?=$list07[4];?></td>
  <td align="center" class="forntsarabun"><?=$list07[5];?></td>
  <td align="center" class="forntsarabun"><?=$list07[6];?></td>
  <td align="center" class="forntsarabun"><?=$list07[7];?></td>
  <td align="center" class="forntsarabun"><?=$list07[8];?></td>
  <td align="center" class="forntsarabun"><?=$list07[9];?></td>
  <td align="center" class="forntsarabun"><?=$list07[10];?></td>
  <td align="center" class="forntsarabun"><?=$list07[11];?></td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ�äǺ��� PTH ���¡��� 200-300 pg/dl </td>
  <td align="center" valign="top" class="forntsarabun">&lt;8%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  <td align="center" class="forntsarabun">&nbsp;</td>
  </tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ�����Ѻ��éմ�Ѥ�չ�Ѻ�ѡ�ʺ �� ��� ����Ѵ�˭�</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">������<br />
    �����</td>
  <td align="center" class="forntsarabun"><?=$arr09['count09'];?></td>
  <td align="center" class="forntsarabun"><?=$list09[0];?></td>
  <td align="center" class="forntsarabun"><?=$list09[1];?></td>
  <td align="center" class="forntsarabun"><?=$list09[2];?></td>
  <td align="center" class="forntsarabun"><?=$list09[3];?></td>
  <td align="center" class="forntsarabun"><?=$list09[4];?></td>
  <td align="center" class="forntsarabun"><?=$list09[5];?></td>
  <td align="center" class="forntsarabun"><?=$list09[6];?></td>
  <td align="center" class="forntsarabun"><?=$list09[7];?></td>
  <td align="center" class="forntsarabun"><?=$list09[8];?></td>
  <td align="center" class="forntsarabun"><?=$list09[9];?></td>
  <td align="center" class="forntsarabun"><?=$list09[10];?></td>
  <td align="center" class="forntsarabun"><?=$list09[11];?></td>
</tr>
<tr>
  <td valign="top" class="forntsarabun">- �ѵ�ҡ������ٺ������</td>
  <td align="center" valign="top" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">������<br /> 
    ����
</td>
  <td align="center" class="forntsarabun"><?=$arrhba['counthba'];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[0];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[1];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[2];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[3];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[4];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[5];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[6];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[7];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[8];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[9];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[10];?></td>
  <td align="center" class="forntsarabun"><?=$listhba[11];?></td>
  </tr>
<tr>
  <td height="31" valign="top" class="forntsarabun">- �ѵ�ҡ�����Ѻ�������ҡ����ҡ�� �������ö<br />
    �ӡѴ��������������õչ��١��ͧ</td>
  <td align="center" valign="top" class="forntsarabun">&gt;50%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td align="center" class="forntsarabun"><?=$arr01['count01'];?></td>
  <td align="center" class="forntsarabun"><?=$list01[0];?></td>
  <td align="center" class="forntsarabun"><?=$list01[1];?></td>
  <td align="center" class="forntsarabun"><?=$list01[2];?></td>
  <td align="center" class="forntsarabun"><?=$list01[3];?></td>
  <td align="center" class="forntsarabun"><?=$list01[4];?></td>
  <td align="center" class="forntsarabun"><?=$list01[5];?></td>
  <td align="center" class="forntsarabun"><?=$list01[6];?></td>
  <td align="center" class="forntsarabun"><?=$list01[7];?></td>
  <td align="center" class="forntsarabun"><?=$list01[8];?></td>
  <td align="center" class="forntsarabun"><?=$list01[9];?></td>
  <td align="center" class="forntsarabun"><?=$list01[10];?></td>
  <td align="center" class="forntsarabun"><?=$list01[11];?></td>
  </tr>
</table>

<div style="page-break-after:always;"></div>
<div style="page-break-before:always;"></div>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" class="forntsarabun">�ѵ�ػ��ʧ��</td>
  <td rowspan="2" align="center" class="forntsarabun">
    <p>����ͧ����Ѵ</p></td>
<td rowspan="2" align="center" class="forntsarabun">�������</td>
<td rowspan="2" align="center" class="forntsarabun">����Ѻ�Դ�ͺ</td>
	<td rowspan="2" align="center" class="forntsarabun">��<br>
	  <?=($date1+543)?>
    </td>
  <td colspan="12" align="center" class="forntsarabun">�� 
    <?=($date1+543)?>
  </td>
</tr>
<tr>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">��.�.</td>
  <td align="center" class="forntsarabun">��.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">��.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
  <td align="center" class="forntsarabun">�.�.</td>
</tr>
<tr>
  <td rowspan="3" class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">- �ѵ�ҡ�����Ѻ�������ҡ�ѡ����Ҿ�ӺѴ���<br />
����ö�͡���ѧ�����١��ͧ</td>
  <td align="center" class="forntsarabun">&gt;50%</td>
  <td align="center" valign="top" class="forntsarabun">�����</td>
  <td align="center" class="forntsarabun"><?=$arr['countbp'];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[0];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[1];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[2];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[3];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[4];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[5];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[6];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[7];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[8];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[9];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[10];?></td>
  <td align="center" class="forntsarabun"><?=$listbp[11];?></td>
  </tr>
<tr>
  <td class="forntsarabun">- �ѵ�ҡ�����Ѻ�������� vascular access 㹼�����<br />
    ����������ѧ ���з�� 4 </td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">- �ѵ�ҡ�����Ѻ���йӡ�úӺѴ��᷹� �<br />
    ����������������ѧ ���з�� 4 </td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td rowspan="5" valign="top" class="forntsarabun">2. �������ԡ��</td>
  <td class="forntsarabun">1. �ؤ�ҡ����Ѻ���ͺ�����Ἱ /�ҹ�ͧ˹��§ҹ</td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">2. ��ṹ�����Թ�ѡ��੾�Чҹ��ҹࡳ��</td>
  <td align="center" class="forntsarabun">80%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">3. �ӹǹ���駷���Դ�غѵ��˵بҡ��÷ӧҹ</td>
  <td align="center" class="forntsarabun">0 ����</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">4.�ؤ�ҡ����Ѻ��õ�Ǩ�آ�Ҿ��Шӻ�</td>
  <td align="center" class="forntsarabun">100%</td>
  <td align="center" valign="top" class="forntsarabun">�ح����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td class="forntsarabun">5.�����֧���㹧ҹ�ͧ���˹�ҷ���軯Ժѵԧҹ</td>
  <td align="center" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">�����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td rowspan="2" valign="top" class="forntsarabun">3. ��ҹ��ú�����<br />
    �Ѵ���</td>
  <td valign="top" class="forntsarabun">1. ������§����Ф����������ҹ�ͧ�ػ�ó�����ͧ���<br />
    �ҧ���ᾷ��</td>
  <td align="center" class="forntsarabun">90%</td>
  <td align="center" valign="top" class="forntsarabun">����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
<tr>
  <td valign="top" class="forntsarabun">2. �ѵ�Ҥ����֧��㨢ͧ˹��§ҹ��蹵����ͧ��Ǩ�ä�</td>
  <td align="center" class="forntsarabun">&gt;80%</td>
  <td align="center" valign="top" class="forntsarabun">�����</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
  <td class="forntsarabun">&nbsp;</td>
</tr>
</table>
<? } ?>