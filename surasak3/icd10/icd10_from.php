<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
 <form name="form1" method="post" action="?do=icdcount">
                     
					  <? $m=date('m'); ?>
                        <div align="left" class="forntsarabun"><h1 class="forntsarabun">��������ó�ͧ�Ǫ����¹��� ICD10</h1>
                        *�ҡ������͡�ѹ��� ������͡������� &quot; �ѹ��� &quot;<br>
                        �ѹ���
                         <select name="keydate" class="forntsarabun">
						<option value="">---�ѹ���----</option>
						<?
						for($i=1;$i<=31;$i++){
						?>
						<option value="<?=$i;?>" <? if($i==date("j")){ echo"selected"; } ?>><?=$i?></option>
						<?
						}
						?>
						</select>
                          ��͹ 
                          <select name="keymonth" class="forntsarabun">
                            <option  value="">---���͡��͹-----</option>
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
				echo "<select name='keyyear' class='forntsarabun'>";
				foreach($dates as $i){

				$ii=$i-543; ?>
                
				<option value='<?=$ii?>' <? if($Y==$ii){ echo "selected"; }?>><?=$i;?></option>
                <?
				}
				echo "<select>";
				?>
                        


                          <input type="submit" name="Submit" value="��ŧ">
                          <input type=button value='��Ѻ' onClick="window.location='http://192.168.1.2/sm3/nindex.htm'">
                        </div>
                      </form>
                      
<br/>
<hr align="center" />
<? 
include("../Connections/connect.inc.php");
include("../Connections/all_function.php");


if($_REQUEST['do']=="icdcount"){
	
	if($_REQUEST['Submit']=="��ŧ"){
		
			$keyyear=$_REQUEST['keyyear']+543;
			
			
			if($_REQUEST['keymonth']==''){ $keymonth=''; }else{ $keymonth=$_REQUEST['keymonth']; }
			if($_REQUEST['keydate']==''){ $keydate=''; }else{ $keydate=$_REQUEST['keydate']; }
			
			
			
			
			if($_REQUEST['keydate']!='' && $_REQUEST['keymonth']!='' && $_REQUEST['keydate']!=''){
				
				$thidate=$keyyear.'-'.$keymonth.'-'.$keydate;
				
			}else if($_REQUEST['keymonth']=='' && $_REQUEST['keydate']==''){
				
				$thidate=$keyyear;
				
			}else if($_REQUEST['keymonth']==''){
				
				$thidate=$keyyear;
				
			}else if($_REQUEST['keydate']==''){
			
				$thidate=$keyyear.'-'.$keymonth;
			}
			
			
			echo "<h1 class='forntsarabun'>�ʴ��������ѹ���  ".$keydate.'-'.$keymonth.'-'.$keyyear."</h1>";
			
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
        
	<table width="55%" border="1" class="forntsarabun">
  <tr>
    <td colspan="4" align="center">��������ó�ͧ�Ǫ���¹��� ICD10</td>
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
    <td width="18%" align="center"><a href="viewicd10.php?list=all&date=<?=$thidate;?>" >�٢�����</a></td>
  </tr>
  <tr>
    <td>�� ICD10</td>
    <td><? if($dbarr3['icdnotnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr3['icdnotnull']; }?></td>
    <td><?=number_format($avgnotnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=notnull&date=<?=$thidate;?>" >�٢�����</a></td>
  </tr>
  <tr>
    <td>����� ICD10</td>
    <td><? if($dbarr2['icdnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarr2['icdnull']; }?>&nbsp;</td>
    <td><?=number_format($avgnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=null&date=<?=$thidate;?>" >�٢�����</a></td>
  </tr>
</table>
<BR/>
<BR/>
	<table width="55%" border="1" class="forntsarabun">
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
    <td width="18%" align="center"><a href="viewdiag.php?list=all&date=<?=$thidate;?>" >�٢�����</a></td>
  </tr>
  <tr>
    <td>�� diag</td>
    <td><? if($dbarrdiag2['diagnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarrdiag2['diagnull']; }?></td>
    <td><?=number_format($avgdiag2,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=notnull&date=<?=$thidate;?>" >�٢�����</a></td>
  </tr>
  <tr>
    <td>����� diag</td>
    <td><? if($dbarrdiag3['diagnotnull']==0){ echo "�ѧ�������¡��" ;}else{ echo $dbarrdiag3['diagnotnull']; }?>&nbsp;</td>
    <td><?=number_format($avgdiag1,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=null&date=<?=$thidate;?>"  >�٢�����</a></td>
  </tr>
</table>

        <?
			 
	}
}
?>