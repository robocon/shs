<?php
?>
<form method="POST" action="" >
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
��ػ�ӹǹ�ѵ���âͧ�ͧ�ѹ����� ����ѹ</b></font></font></p>
  <p><font face="Angsana New"><font size="3">
 (�ѹ��� 01,02,....30,31  ���������ѹ��� ���繢����ŵ����͹)</font></font></p>
  <font face="Angsana New">�ѹ���&nbsp;&nbsp;<input type="text" name="appdate" size="2"><select size="1" name="appmo">
    <option selected>--��͹--</option>
    <option value="01">���Ҥ�</option>
    <option value="02">����Ҿѹ��</option>
    <option value="03">�չҤ�</option>
    <option value="04">����¹</option>
    <option value="05">����Ҥ�</option>
    <option value="06">�Զع�¹</option>
    <option value="07">�á�Ҥ�</option>
    <option value="08">�ԧ�Ҥ�</option>
    <option value="09">�ѹ��¹</option>
    <option value="10">���Ҥ�</option>
    <option value="11">��Ȩԡ�¹</option>
    <option value="12">�ѹ�Ҥ�</option>
  </select><select size="1" name="thiyr">
    <option>2548</option>
    <option>2549</option>
    <option>2550</option>
    <option selected>2551</option>
    <option>2552</option>
    <option>2553</option>
    <option>2554</option>
    <option>2555</option>

  </select></p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="��ŧ" name="B1">

<?php
    print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
?>

<br/>
<? 
include("../Connections/connect.inc.php");
include("../Connections/all_function.php");


	
	if($_REQUEST['B1']=="��ŧ"){
		
			 $thidate=$thiyr.'-'.$appmo.'-'.$appdate;
			
			$sql="SELECT  count(*)as counticd FROM opday  WHERE  thidate  LIKE  '$thidate%'";
			$result = mysql_query($sql) or die("Query failed");	
			$dbarr=mysql_fetch_array($result);


			$sql2="SELECT  count(*)as icdnull  FROM opday  WHERE thidate  LIKE  '$thidate%' and (icd10 =''OR icd10 is NULL) ";
			$result2 = mysql_query($sql2) or die("Query failed2");		
			$dbarr2=mysql_fetch_array($result2);
			
			
			$sql3="SELECT  count(*)as icdnotnull  FROM opday  WHERE  thidate  LIKE  '$thidate%' and icd10 !='' ";
			$result3 = mysql_query($sql3) or die("Query failed3");		
			$dbarr3=mysql_fetch_array($result3);
			
			
			$avgnotnull=100*$dbarr3['icdnotnull']/$dbarr['counticd'];
			$avgnull=100*$dbarr2['icdnull']/$dbarr['counticd'];
			
			
			/*		$avgnotnull=number_format($avgnotnull,2);
			$avgnull=number_format($avgnull,2);*/
			///////////////////////////////////////  Diag ///////////////////////////////////////////////////////
			
	
			$diag="SELECT  count(*)as alldiag FROM opday  WHERE thidate  LIKE  '$thidate%' ";
			$resultdiag = mysql_query($diag) or die("Query failed diag");	
			$dbarrdiag=mysql_fetch_array($resultdiag);
			
			$diag2="SELECT  count(*)as diagnull  FROM opday  WHERE thidate  LIKE  '$thidate%' and ((diag !='' and diag!='�к��ä���ͧ��')OR(diag !='' and diag IS NULL))";
			$resultdiag2 = mysql_query($diag2) or die("Query failed diag");		
			$dbarrdiag2=mysql_fetch_array($resultdiag2);//// �� 
			
			$sqldiag3="SELECT  count(*)as diagnotnull  FROM opday  WHERE  thidate  LIKE  '$thidate%' and ((diag ='' and diag IS NOT NULL) OR(diag ='' and  diag='�к��ä���ͧ��')OR diag='�к��ä���ͧ��' OR diag IS NULL) ";
			$resultdiag3 = mysql_query($sqldiag3) or die("Query failed diag");		
			$dbarrdiag3=mysql_fetch_array($resultdiag3);// �����
			
			
			$avgdiag1=100*$dbarrdiag3['diagnotnull']/$dbarrdiag['alldiag'];
			$avgdiag2=100*$dbarrdiag2['diagnull']/$dbarrdiag['alldiag'];
		?>
        
	<table width="55%" border="1">
  <tr>
    <td colspan="4" align="center">��������ó�ͧ�Ǫ����¹��� ICD10</td>
    </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">��¡��</td>
    <td align="center" bgcolor="#CCCCCC">�ӹǹ</td>
    <td align="center" bgcolor="#CCCCCC">����ૹ��</td>
    <td align="center" bgcolor="#CCCCCC">�٢�����</td>
  </tr>
  <tr>
    <td width="45%">�����·��ŧ����¹������</td>
    <td width="23%"><? if($dbarr['counticd']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr['counticd']; } ?>&nbsp;</td>
    <td width="14%">100%</td>
    <td width="18%" align="center"><a href="viewicd10.php?list=all&date=<?=$thidate;?>" target="_blank">�٢�����</a></td>
  </tr>
  <tr>
    <td>�� ICD10</td>
    <td><? if($dbarr3['icdnotnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr3['icdnotnull']; }?></td>
    <td><?=number_format($avgnotnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=notnull&date=<?=$thidate;?>"  target="_blank">�٢�����</a></td>
  </tr>
  <tr>
    <td>����� ICD10</td>
    <td><? if($dbarr2['icdnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr2['icdnull']; }?>&nbsp;</td>
    <td><?=number_format($avgnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=null&date=<?=$thidate;?>"  target="_blank">�٢�����</a></td>
  </tr>
</table>
<BR/>
<BR/>
	<table width="55%" border="1">
  <tr>
    <td colspan="4" align="center">diag</td>
    </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">��¡��</td>
    <td align="center" bgcolor="#CCCCCC">�ӹǹ</td>
    <td align="center" bgcolor="#CCCCCC">����ૹ��</td>
    <td align="center" bgcolor="#CCCCCC">�٢�����</td>
  </tr>
  <tr>
    <td width="45%">�����·��ŧ����¹������</td>
    <td width="23%"><? if($dbarrdiag['alldiag']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarrdiag['alldiag']; } ?>&nbsp;</td>
    <td width="14%">100%</td>
    <td width="18%" align="center"><a href="viewdiag.php?list=all&date=<?=$thidate;?>" target="_blank">�٢�����</a></td>
  </tr>
  <tr>
    <td>�� diag</td>
    <td><? if($dbarrdiag3['diagnotnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarrdiag3['diagnotnull']; }?></td>
    <td><?=number_format($avgdiag1,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=notnull&date=<?=$thidate;?>"  target="_blank">�٢�����</a></td>
  </tr>
  <tr>
    <td>����� diag</td>
    <td><? if($dbarrdiag2['diagnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarrdiag2['diagnull']; }?>&nbsp;</td>
    <td><?=number_format($avgdiag2,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=null&date=<?=$thidate;?>"  target="_blank">�٢�����</a></td>
  </tr>
</table>

        <?

}
?>