<?
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
	$nPrefix="25".$nPrefix;
?>	
<title>��§ҹ�š�õ�Ǩ�آ�Ҿ���ѧ�� ��. ��Шӻ� <?=$nPrefix;?> �¡���˹����˭��</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<div id="no_print" > 
<a href ="../nindex.htm" >&lt;&lt; ��Ѻ˹����ѡ</a>
<p align="center" style="font-weight:bold;">��§ҹ�š�õ�Ǩ�آ�Ҿ���ѧ�� ��. ��Шӻ� <?=$nPrefix;?>
</p>
<form name="form1" method="post" action="reportchkup_armytp3_newtype.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">˹��� :
        <label>      
        <select name="camp" id="camp">
          <option value="all" selected>�ء˹���</option>
          <option value="M04">�ç��Һ�Ť�������ѡ��������</option>
          <option value="MTB32">˹��¢�鹵ç ���.32</option>
          <option value="M02">�.17 �ѹ.2</option>
          <option value="M05">�.�ѹ.4 ����4</option>
          <option value="M06">����.�þ.3</option>
        </select>
        <input type="submit" name="button" id="button" value="����§ҹ">
        </label></td>
    </tr>
  </table>
  </div>
</form>
<?
if($_POST["act"]=="show"){
	if($_POST["camp"]=="all"){  //���ѧ�ŷ�����
	$showcamp="�ء˹���";
	$result="select * from condxofyear_so where yearcheck='$nPrefix' group by hn";
	}else if($_POST["camp"]=="MTB32"){
	$result="select * from condxofyear_so where yearcheck='$nPrefix' and (camp LIKE 'M03%' OR camp LIKE 'M07%' OR camp LIKE 'M08%' OR camp LIKE 'M10%')  group by hn";	
	}else{
	$showcamp=substr($_POST["camp"],4);	
	$result="select * from condxofyear_so where yearcheck='$nPrefix' and camp LIKE '$_POST[camp]%' group by hn";
	}
	//echo $result;
	$object=mysql_query($result) or die("Query condxofyear_so Error");
	$numtotal=mysql_num_rows($object);
	$sumchunyot1=0;
	$sumchunyot2=0;
	$sumchunyot3=0;
while($chkrows=mysql_fetch_array($object)){
	
		$sql1="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '��.�.' OR ptname REGEXP '�ŵ��')";
		//echo $sql1."<br>";
		$query1=mysql_query($sql1);
		$num1=mysql_num_rows($query1);
		if($num1 >0){
			$sumchunyot1++;
		}
		
		$sql2="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.�.' OR ptname REGEXP '�.�.�.' OR ptname REGEXP '�.�.�.' OR ptname REGEXP '������' OR ptname REGEXP '��������Ѥ�')";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		if($num2 >0){
			$sumchunyot2++;
		}
		
		$sql3="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP '���' OR ptname REGEXP '�ҧ ')";
		//echo $sql3."<br>";
		$query3=mysql_query($sql3);
		$num3=mysql_num_rows($query3);
		if($num3 >0){
			$sumchunyot3++;
		}			
		
}	
	
	
	

	$sqlhos=mysql_query("select pcuname from mainhospital where pcuid='1'");
	list($pcuname)=mysql_fetch_array($sqlhos);

	if($_POST["camp"]=="all"){  //���ѧ�ŷ������Ѻ��õ�Ǩ
	$showcamp="�ء˹���";
	$result1="select * from condxofyear_so where yearcheck='$nPrefix' group by hn";
	}else if($_POST["camp"]=="MTB32"){
	$showcamp="���ŷ��ú���� 32";
	$result1="select * from condxofyear_so where yearcheck='$nPrefix' and (camp LIKE 'M03%' OR camp LIKE 'M07%' OR camp LIKE 'M08%' OR camp LIKE 'M10%')  group by hn";	
	}else{
		if($_POST["camp"]=="M04"){
			$showcamp="�ç��Һ�Ť�������ѡ��������";
		}else if($_POST["camp"]=="M02"){
			$showcamp="�.17 �ѹ.2";
		}else if($_POST["camp"]=="M05"){
			$showcamp="�.�ѹ.4 ����4";
		}else if($_POST["camp"]=="M06"){
			$showcamp="����.�þ.3";
		}	$result1="select * from condxofyear_so where yearcheck='$nPrefix' and camp LIKE '$_POST[camp]%' group by hn";
	}	
	$object1=mysql_query($result1) or die("Query condxofyear_so Error");
	$numnotchkup=mysql_num_rows($object1);
	$percentchkup=($numnotchkup*100)/$numtotal;
	$numchunyot1=0;
	$numchunyot2=0;
	$numchunyot3=0;
while($chkrows=mysql_fetch_array($object1)){
		
		$sql1="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�ŵ��') and (ptname NOT REGEXP '�.�.' and ptname NOT REGEXP '�.�.' and ptname NOT REGEXP '�.�.' and ptname NOT REGEXP '�.�.�.' and ptname NOT REGEXP '�.�.�.' and ptname NOT REGEXP '�.�.�.') group by hn";
		//echo $sql1."<br>";
		$query1=mysql_query($sql1);
		$num1=mysql_num_rows($query1);
		if($num1 >0){
			$numchunyot1++;
		}
		
		$sql2="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.' OR ptname REGEXP '�.�.�.' OR ptname REGEXP '�.�.�.' OR ptname REGEXP '�.�.�.' OR ptname REGEXP '������' OR ptname REGEXP '��������Ѥ�') group by hn";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		if($num2 >0){
			$numchunyot2++;
		}
		
		$sql3="select * from condxofyear_so where row_id='".$chkrows["row_id"]."' and (ptname REGEXP '���' OR ptname REGEXP '�ҧ ') group by hn";
		//echo $sql3."<br>";
		$query3=mysql_query($sql3);
		$num3=mysql_num_rows($query3);
		if($num3 >0){
			$numchunyot3++;
		}			
		
}	
		
?>
<!--��§ҹẺ��� 1-->
<strong>
<p align="center">�ѭ���ʹ���ѧ�� ��õ�Ǩ��ҧ��¢���Ҫ��� ����١��ҧ ��Шӻ� <?=$nPrefix;?><br>
</p>

<p align="center">þ. ���ӡ�õ�Ǩ <u><?=$pcuname;?></u><br>
˹��·�����Ѻ��õ�Ǩ <u><?=$showcamp;?></u>
</p>
</strong>
<table width="98%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="11%" align="center"><strong>�ʹ���ѧ�ź�èب�ԧ</strong></td>
    <td width="11%" align="center"><strong>���ѧ������Ѻ��õ�Ǩ</strong></td>
    <td width="13%" align="center"><strong>���ѧ���������Ѻ��õ�Ǩ</strong></td>
    <td width="24%" align="center"><strong>�� - ���� ������������Ѻ��õ�Ǩ</strong></td>
    <td width="33%" align="center"><strong>���˵ط���������Ѻ��õ�Ǩ</strong></td>
    <td width="8%" align="center"><p><strong>�����˵�</strong></p>    </td>
  </tr>
  <? $total=$numtotal-$numnotchkup;?>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top"><?=$numtotal;?></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<?
	if($_POST["camp"]=="all"){  //���ѧ�ŷ�����
	$showcamp="�ء˹���";
	$sql="select * from condxofyear_so where yearcheck='$nPrefix' group by hn";
	}else if($_POST["camp"]=="MTB32"){
	$showcamp="���ŷ��ú���� 32";
	$sql="select * from condxofyear_so where yearcheck='$nPrefix' and (camp LIKE 'M03%' OR camp LIKE 'M07%' OR camp LIKE 'M08%' OR camp LIKE 'M10%')  group by hn";	
	}else{
		if($_POST["camp"]=="M04"){
			$showcamp="�ç��Һ�Ť�������ѡ��������";
		}else if($_POST["camp"]=="M02"){
			$showcamp="�.17 �ѹ.2";
		}else if($_POST["camp"]=="M05"){
			$showcamp="�.�ѹ.4 ����4";
		}else if($_POST["camp"]=="M06"){
			$showcamp="����.�þ.3";
		}
	$sql="select * from condxofyear_so where yearcheck='$nPrefix' and camp LIKE '$_POST[camp]%' group by hn";
	}
	
	//echo $sql;
	$query=mysql_query($sql);
	$numchkup=mysql_num_rows($query);
	$age35=0;
	$age34=0;
	$normal=0;
	$unnormal=0;
	$sum301=0;
	$sum302=0;
	$sum303=0;
	$sum304=0;
	$sum305=0;
	$sum306=0;
	$sum307=0;
	$sum308=0;
	$sum309=0;
	$sum310=0;
	$sum311=0;
	$sum312=0;
	$risk=0;
	while($rows=mysql_fetch_array($query)){
		$chkage=substr($rows['age'],0,2);
		if($rows["prawat"]=="0" || $rows["prawat"]==""){  //���������
			if($chkage >= 35){ //���� 35 �բ���
				if($rows['stat_bs']=="����" && $rows['stat_chol']=="����" && $rows['stat_tg']=="����" && $rows['stat_hdl']!="�Դ����" && $rows['stat_ldl']!="�Դ����" && $rows['bp1'] < 140 && $rows['bmi'] < 30.0){
					$normal++;  //����
				}else{
					$risk++;  //���������§
				}
			}else{  //���ص�ӡ��� 35 ��
				if($rows['bp1'] < 140 && $rows['bmi'] < 30.0){
					$normal++;  //����
				}else{
					$risk++;  //���������§
				}
			}
		}else{  //���������
			$unnormal++;
		}
	
		//��§ҹ��� 3
		if($rows["bmi"] >= 25.00 && $rows["bmi"] <=29.99){
			$sum301++;
		}
		if($rows["bmi"] >= 30.00){
			$sum302++;
		}
		
		
		$sql1="select * from condxofyear_so where row_id='".$rows["row_id"]."' and ptname NOT REGEXP '˭ԧ' group by hn";
		//echo $sql1."<br>";
		$query1=mysql_query($sql1);
		$num1=mysql_num_rows($query1);
		if($num1 >0){
			if($rows["round_"] >= 91.44){
				$sum303++;
			}
		}
		
		$sql2="select * from condxofyear_so where row_id='".$rows["row_id"]."' and ptname REGEXP '˭ԧ' group by hn";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		if($num2 >0){
			if($rows["round_"] >= 81.28){
				$sum303++;
			}
		}		
		
		
		if($chkage >= 35){ //���� 35 �բ���
			$age35++;
			if($rows['stat_chol']=="�Դ����" || $rows['stat_tg']=="�Դ����" || $rows['stat_hdl']=="�Դ����" || $rows['stat_ldl']=="�Դ����"){
				$sum304++;
				//echo $rows["ptname"]."<br>";
			}
			
			if($rows['stat_bs']=="�Դ����"){
				$sum306++;
				//echo $rows["ptname"]."<br>";
			}	
			
			if($rows['stat_sgot']=="�Դ����" || $rows['stat_sgpt']=="�Դ����" || $rows['stat_alk']=="�Դ����"){
				$sum307++;
				//echo $rows["ptname"]."<br>";
			}					
		}else{  //���ص�ӡ��� 35 ��
			$age34++;
		}
		
			$bp1=$rows['bp1'];
			if($bp1 >=140){
				$sum305++;
			}		
	}  //close while

$numnormal=$numnotchkup-$numchkup;
//echo "$numnormal=$numnotchkup-$numchkup";
$sumnormal=$normal+$numnormal;
//echo "$sumnormal=$normal+$numnormal";
$percentnormal= ($sumnormal*100)/$numnotchkup;
$percentrisk= ($risk*100)/$numnotchkup;
$percentunnormal= ($unnormal*100)/$numnotchkup;

//��§ҹ���3
$percent301= ($sum301*100)/$numnotchkup;
$percent302= ($sum302*100)/$numnotchkup;
$percent303= ($sum303*100)/$numnotchkup;
$percent304= ($sum304*100)/$age35;
$percent305= ($sum305*100)/$numnotchkup;
$percent306= ($sum306*100)/$age35;
$percent307= ($sum307*100)/$age35;

?>
<!--��§ҹẺ��� 2-->
<strong>
<p align="center">Ẻ����������§ҹ��ػ�š�õ�Ǩ��ҧ��»�Шӻ� <?=$nPrefix;?><br>
</p>
<p align="center">˹��·������Ѻ��õ�Ǩ��ҧ��� (����˹��§ҹ)
  <u><?=$showcamp;?></u><br>
˹��·��ӡ�õ�Ǩ 
<u><?=$pcuname;?></u>
</p>
</strong>
<p><strong>1. �ʹ�ͧ���ѧ���˹��·�����</strong></p>
<table width="90%" border="1"  cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><strong>���ѧ��</strong></td>
    <td align="center"><strong>�ʹ���ѧ��</strong></td>
    <td align="center"><strong>����Ѻ��õ�Ǩ</strong></td>
    <td align="center"><strong>�������Ѻ��õ�Ǩ</strong></td>
  </tr>
  <tr>
    <td>1. ��·����ѭ�Һѵ�</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$numchunyot1;?></td>
    <td align="center"><?=$totalchunyot1;?></td>
  </tr>
  <tr>
    <td>2. ��·��ê�鹻�зǹ</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$numchunyot2;?></td>
    <td align="center"><?=$totalchunyot2;?></td>
  </tr>
  <tr>
    <td>3. �١��ҧ��Ш�</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$numchunyot3;?></td>
    <td align="center"><?=$totalchunyot3;?></td>
  </tr>
  <tr>
    <td align="center"><strong>���</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center"><strong>
      <?=$numnotchkup;?>
    </strong></td>
    <td align="center"><strong>
      <?=$totalchkup;?>
    </strong></td>
  </tr>
  <tr>
    <td align="center"><strong>������</strong></td>
    <td align="center"><strong>100 %</strong></td>
    <td align="center"><strong>
      <?=number_format($percentchkup,2);?>
    </strong></td>
    <td align="center"><strong>
      <?=number_format($percentnotchkup,2);?>
    </strong></td>
  </tr>
</table>
<p><strong>2. ��û����Թ�š�õ�Ǩ</strong></p>
<table width="90%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.1 ���������</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sumnormal;?></td>
    <td>������
      <?=number_format($percentnormal,2);?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.2 ���������§</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$risk;?></td>
    <td>������
      <?=number_format($percentrisk,2);?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.3 ��������ä</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$unnormal;?></td>
    <td>������
      <?=number_format($percentunnormal,2);?></td>
  </tr>
</table>
<p><strong>3. �š�õ�Ǩ��ҧ�����С�õ�Ǩ�ͧ��ͧ��Ժѵԡ��</strong></p>
<table width="90%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td colspan="3">3.1 ���ѧ�ŷ�������й��˹ѡ�Թ</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum301;?></td>
    <td>������
      <?=number_format($percent301,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.2 ���ѧ�ŷ���������ä��ǹ</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum302;?></td>
    <td>������
      <?=number_format($percent302,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.3 ���ѧ�ŷ���������ͺ����Թ</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum303;?></td>
    <td>������
      <?=number_format($percent303,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.4 ���ѧ�ŷ���������дѺ��ѹ����ʹ�٧</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum304;?></td>
    <td>������
      <?=number_format($percent304,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.5 ���ѧ�ŷ�������Ф����ѹ���Ե�٧</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum305;?></td>
    <td>������
      <?=number_format($percent305,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.6 ���ѧ�ŷ�������й�ӵ������ʹ�٧</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum306;?></td>
    <td>������
      <?=number_format($percent306,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.7 ���ѧ�ŷ������ǡ�ó�ӧҹ�ͧ�Ѻ�Դ����</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum307;?></td>
    <td>������
      <?=number_format($percent307,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.8 ���ѧ�ŷ���������ä����</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum308;?></td>
    <td>������
      <?=number_format($percent308,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.9 ���ѧ�ŷ���������ä����ҹ</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum309;?></td>
    <td>������
      <?=number_format($percent309,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.10 ���ѧ�ŷ���������ä��ҷ�</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum310;?></td>
    <td>������
      <?=number_format($percent310,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.11 ���ѧ�ŷ���������ä�ا���觾ͧ</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum311;?></td>
    <td>������
      <?=number_format($percent311,2);?></td>
  </tr>
  <tr>
    <td colspan="3">3.12 ���ѧ�ŷ���դ����Դ���Ԩҡ��š����� (Alcoholic)</td>
  </tr>
  <tr>
    <td align="right">-</td>
    <td>�ӹǹ&nbsp;&nbsp;
        <?=$sum312;?></td>
    <td>������
      <?=number_format($percent312,2);?></td>
  </tr>
</table>
<p><strong>4. ��ô��Թ�������Ἱ��ô��Թ��âͧ þ.��.㹾�鹷�� ��.3 㹡��ѧ�š������ҧ�</strong></p>
<table width="90%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>4.1 ���������</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4.2 ���������§</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4.3 ��������ä</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>�����˵� : ����Ѻ��������´��ô��Թ���/�ç��� ����öṺ�������͡��û�Сͺ�����§ҹ��</strong></td>
  </tr>
</table>
<p>&nbsp;</p>
<?
}
?>