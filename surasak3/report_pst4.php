<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>

<body>
<div align="center">
  <p><strong>��§ҹ�ӹǹ������㹨�ṡ������˵ص�� (ç.�ʵ.4)<br>
˹��� �ç��Һ�Ť�������ѡ�������� <br>
  ��Ш���͹<?=$mon;?>&nbsp;�� <?=$thyear;?></strong></p>
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="5%" align="center">�ӴѺ</td>
      <td width="15%" align="center">����-ʡ��</td>
      <td width="8%" align="center">�Ţ�������<br>
        (HN.No.)</td>
      <td width="8%" align="center">�Ţ�������<br>
        (AN.No.)</td>
      <td width="15%" align="center">������<br>
      �ؤ��</td>
      <td width="9%" align="center">�ѧ�Ѵ</td>
      <td width="10%" align="center">����</td>
      <td width="10%" align="center">�ä��������˵ء�õ��</td>
      <td width="10%" align="center">�����ä���1</td>
      <td width="10%" align="center">�����ä���2</td>
      <td width="20%" align="center">�ѹ�����</td>
    </tr>
    <?
	$sql1="select * from ipcard where dcdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59' and result like '%dead%'";
	//echo $sql1;
		
		$query=mysql_query($sql1);
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;

		?>   
    <tr>
      <td align="center"><? echo $i;?></td>
      <td  align="left"><?=$rows["ptname"];?></td>
      <td  align="center"><?=$rows["hn"];?></td>
      <td  align="center"><?=$rows["an"];?></td>
      <td  align="center"><?=$rows["goup"];?></td>
      <td  align="center"><?=$rows["camp"];?></td>
      <td  align="center"><?=$rows["age"];?></td>
      <? 
		 $an=$rows["an"];
     $sql = "Select diag,icd10 From diag where an ='$an' limit 1 ";
	 //echo $sql;
$result = Mysql_Query($sql);
list($diag,$icd10) = Mysql_fetch_row($result);

	?>   
      <td  align="center"><? echo $diag ;?></td>
      <td  align="center"><? echo $icd10;?></td>
      <td  align="center">&nbsp;</td>
      <td  align="center"><?=$rows["dcdate"];?></td>
    </tr>
    <?
	}  //close while
	?>
  </table>
  <p>&nbsp;</p>
  <p><strong>��Ǩ�١��ͧ</strong></p>
</div>
</body>
</html>
