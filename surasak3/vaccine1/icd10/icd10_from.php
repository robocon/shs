 <form name="form1" method="post" action="?do=icdcount">
                     
					  <? $m=date('m'); ?>
                        <div align="left"><h1>��������ó�ͧ�Ǫ����¹��� ICD10</h1><br>
                        �ѹ���
                         <select name="date">
						<option value="">�ѹ���</option>
						<?
						for($i=1;$i<=31;$i++){
						?>
						<option value="<?=$i;?>" <? if($i==date("j")){ echo"selected"; } ?>><?=$i?></option>
						<?
						}
						?>
						</select>
                          ��͹ 
                          <select name="keymonth">
                            <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
                            <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
                            <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
                            <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
                            <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
                            <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
                            <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
                            <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
                            <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
                            <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
                            <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
                            <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
                          </select>
                          �� �.�. 
               <? 
			   $Y=date("Y");
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='keyyear'>";
				foreach($dates as $i){

				$ii=$i-543; ?>
                
				<option value='<?=$ii?>' <? if($Y==$ii){ echo "selected"; }?>><?=$i;?></option>
                <?
				}
				echo "<select>";
				?>
                        


                          <input type="submit" name="Submit" value="��ŧ">
                           <input type=button value='��Ѻ' onClick="window.location='http://162.168.1.2/sm3/nindex.htm'">
                        </div>
                      </form>
                      
<br/>
<? 
include("Connections/connect.inc.php");
include("Connections/all_function.php");


if($_REQUEST['do']=="icdcount"){
	
	if($_POST['Submit']=="��ŧ"){
		
			$keyyear=$_POST['keyyear']+543;
			
			$thidate=$keyyear.'-'.$_POST['keymonth'].'-'.$_POST['date'];
			
			$sql="SELECT  count(*)as counticd FROM opday  WHERE thidate  LIKE  '$thidate%' ";
			$result = mysql_query($sql) or die("Query failed");	
			$dbarr=mysql_fetch_array($result);
			
			$sql2="SELECT  count(*)as icdnull  FROM opday  WHERE thidate  LIKE  '$thidate%' and icd10 IS NULL ";
			$result2 = mysql_query($sql2) or die("Query failed2");		
			$dbarr2=mysql_fetch_array($result2);
			
			$sql3="SELECT  count(*)as icdnotnull  FROM opday  WHERE  thidate  LIKE  '$thidate%' and icd10 IS NOT NULL";
			$result3 = mysql_query($sql3) or die("Query failed3");		
			$dbarr3=mysql_fetch_array($result3);
			
			
			
			$sql_avg="SELECT AVG(icd10)as Avgicd  FROM opday  WHERE  thidate  LIKE  '$thidate%'  ";
			$result_avg = mysql_query($sql_avg) or die("Query failed avg");		
			$dbarr_avg=mysql_fetch_array($result_avg);
			
			
			
			$avgnotnull=100*$dbarr3['icdnotnull']/$dbarr['counticd'];
			
			$avgnull=100*$dbarr2['icdnull']/$dbarr['counticd'];
			
	/*		$avgnotnull=number_format($avgnotnull,2);
			$avgnull=number_format($avgnull,2);*/
		?>
        
        
	<table width="42%" border="1">
  <tr>
    <td colspan="4" align="center">��������ó�ͧ�Ǫ���¹��� ICD10</td>
    </tr>
  <tr>
    <td width="45%">�����·��ŧ����¹������</td>
    <td width="23%"><? if($dbarr['counticd']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr['counticd'].' &nbsp;��¡��'; } ?>&nbsp;</td>
    <td width="14%">100%</td>
    <td width="18%" align="center"><a href="viewicd10.php?list=all&date=<?=$thidate;?>" target="_blank">�٢�����</a></td>
  </tr>
  <tr>
    <td>�� ICD10</td>
    <td><? if($dbarr3['icdnotnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr3['icdnotnull'].' &nbsp;��¡��'; }?></td>
    <td><?=number_format($avgnotnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=notnull&date=<?=$thidate;?>"  target="_blank">�٢�����</a></td>
  </tr>
  <tr>
    <td>����� ICD10</td>
    <td><? if($dbarr2['icdnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr2['icdnull'].' &nbsp;��¡��'; }?>&nbsp;</td>
    <td><?=number_format($avgnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=null&date=<?=$thidate;?>"  target="_blank">�٢�����</a></td>
  </tr>
</table>

        <?
			 
	}
}
?>