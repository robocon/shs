<style type="text/css">
<!--
.forntsarabun {
	font-family:"Angsana New";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">��§ҹ��è�˹��¼������ �����͹/��</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">��͹/��</span></td>
    <td >
	<? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
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
        </select><? 
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
      <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if($_POST['submit']){

include("connect.inc"); 


$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$day="��͹";


switch($_POST['m_start']){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}
	  $dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	
//$doctor=substr($_POST['doctor'],0,5);


$tsql1="CREATE TEMPORARY TABLE   ipcard1  Select * from   ipcard    WHERE dcdate
LIKE  '$date1%'";
$tquery1 = mysql_query($tsql1);


	 print "<div><font class='forntsarabun' >��§ҹ��è�˹��¼������  ��Ш�$day  $dateshow </font></div><br>";
	?>
    
    
    <?





echo "<p class='forntsarabun'>��¡�÷���ѧ������ʡ�  discharge summary<p>";
///////////////////////////////////  ��ҧ /////////////////////////////
	$sql2="SELECT * FROM ipcard1 WHERE fname ='' or fname is null order by an asc ";
	$query2 = mysql_query($sql2);

	$ii=1;
	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���admit</td>
    <td align="center">�ѹ����˹���</td>
    <td align="center">HN</td>
    <td align="center">AN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">����ԹԨ���</td>
    <td align="center">ICD10</td>
    <td align="center">�ͼ�����</td>
 

    </tr>
    <?
	while($arr2=mysql_fetch_array($query2)){
	?>
    <tr>
      <td align="center" bgcolor="#C6ECFF"><?=$ii;?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['date']?></td>
       <td bgcolor="#C6ECFF"><?=$arr2['dcdate']?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['hn']?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['an']?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['ptname']?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['ptright']?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['diag']?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['icd10']?></td>
      <td bgcolor="#C6ECFF"><?=$arr2['my_ward']?></td>
    
     
    </tr>
    <? $ii++;
	}  
	
	
	?>
</table>
    
    
    

    <? 
	echo "<p class='forntsarabun'>��¡�÷���ʡ�  discharge summary ����<p>";
	
	$sql1="SELECT * FROM ipcard1 WHERE fname !='' and  fname  is not null ";
	$query1 = mysql_query($sql1);

	$i=1;
	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���admit</td>
    <td align="center">�ѹ����˹���</td>
    <td align="center">HN</td>
    <td align="center">AN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">����ԹԨ���</td>
    <td align="center">ICD10</td>
    <td align="center">�ͼ�����</td>
    <td align="center">discharge summary File</td>

    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
	?>
    <tr>
      <td align="center" bgcolor="#00FF99"><?=$i;?></td>
      <td bgcolor="#00FF99"><?=$arr1['date']?></td>
       <td bgcolor="#00FF99"><?=$arr1['dcdate']?></td>
      <td bgcolor="#00FF99"><?=$arr1['hn']?></td>
      <td bgcolor="#00FF99"><?=$arr1['an']?></td>
      <td bgcolor="#00FF99"><?=$arr1['ptname']?></td>
      <td bgcolor="#00FF99"><?=$arr1['ptright']?></td>
      <td bgcolor="#00FF99"><?=$arr1['diag']?></td>
      <td bgcolor="#00FF99"><?=$arr1['icd10']?></td>
      <td bgcolor="#00FF99"><?=$arr1['my_ward']?></td>
      <td align="center" bgcolor="#00FF99"><a href="<?=$arr1['fname']?>" target="_blank">�٢�����</a></td>
     
    </tr>
    <? $i++;
	}  
	
	
	?>
    </table>

<?

}
?>