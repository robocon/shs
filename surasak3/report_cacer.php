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
    <td colspan="2" align="center" bgcolor="#99CC99">����¹�����������</td>
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


$tsql1="CREATE TEMPORARY TABLE   ipcard1  Select * from   ipcard    WHERE date 
LIKE  '$date1%'";
$tquery1 = mysql_query($tsql1);

$tsql2="CREATE TEMPORARY TABLE   opday1  Select * from   opday    WHERE thidate
LIKE  '$date1%'";
$tquery2 = mysql_query($tsql2);


print "<div><font class='forntsarabun' >����¹�����������  ��Ш�$day  $dateshow </font></div><br>";

echo "<p class='forntsarabun'>�ժ��� = ŧ����¹����<p><br>";

echo "<p class='forntsarabun'>�բ�� =�ѧ�����ŧ����¹<p><br>";


echo "<p class='forntsarabun'>�����¹͡<p>";
/////////////////////////////////// �ѧ�����ŧ����¹ /////////////////////////////

	$sql1="SELECT * FROM opday1 WHERE icd10 like 'c%' or icd10_morbidity like 'c%' or icd10_complication like 'c%' or icd10_other  like 'c%' or  icd10_external_cause like 'c%' Group by hn  order by hn asc";
	$query1 = mysql_query($sql1);

	
	$ii=1;
	$n=1;
	?>
    
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">����ԹԨ���</td>
    <td align="center">ICD10</td>
    </tr>
    <?
	
	while($arr1=mysql_fetch_array($query1)){
		$link1='';
		$strsql="SELECT * FROM cancer WHERE hn='".$arr1['hn']."'";
		$strq = mysql_query($strsql);
		$numrow=mysql_num_rows($strq);
		 if($numrow==0){
		 $color="#FFCCFF";
		 $link1="<a href='cancer.php?hn=$arr1[hn]&diag=$arr1[diag]' target='_blank'>$arr1[hn]</a>";
		 ?>
      <tr>
      <td align="center" bgcolor="<?=$color1;?>"><?=$n;?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['thidate']?></td>
      <td bgcolor="<?=$color1;?>"><?=$link1;?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['ptname']?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['ptright']?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['diag']?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['icd10']?></td>
     </tr>
         <?
	 $n++;	 
		}

	}  
?>
</table>

<?
/////////////////////////////////// ŧ����¹���� /////////////////////////////
$sql1="SELECT * FROM opday1 WHERE icd10 like 'c%' or icd10_morbidity like 'c%' or icd10_complication like 'c%' or icd10_other  like 'c%' or  icd10_external_cause like 'c%' Group by hn  order by hn asc";
	$query1 = mysql_query($sql1);

	
	$ii=1;
	$n=1;
	?>
    
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">����ԹԨ���</td>
    <td align="center">ICD10</td>
    </tr>
    <?
	
	while($arr1=mysql_fetch_array($query1)){
		$link1='';
		$strsql="SELECT * FROM cancer WHERE hn='".$arr1['hn']."'";
		$strq = mysql_query($strsql);
		$numrow=mysql_num_rows($strq);
		 if($numrow>0){
			$color1="#FFCCFF";
		 $link1="<a href='cancer.php?edit=true&hn=$arr1[hn]' target='_blank'>$arr1[hn]</a>";
		 ?>
      <tr>
      <td align="center" bgcolor="<?=$color1;?>"><?=$n;?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['thidate']?></td>
      <td bgcolor="<?=$color1;?>"><?=$link1;?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['ptname']?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['ptright']?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['diag']?></td>
      <td bgcolor="<?=$color1;?>"><?=$arr1['icd10']?></td>
     </tr>
         <?
	 $n++;	 
		}

	}  
?>
</table><br />
<hr style="color:#000"/>
<br />
<!--///////////////////////////////////// ---->
    <? 
	echo "<p class='forntsarabun'>�������<p>";
	
	$sql1="SELECT * FROM ipcard1 WHERE  icd10 like 'c%' Group by hn";
	$query1 = mysql_query($sql1);

	$i=1;
	$n=1;
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
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
		$link='';
		$color='';
		$strsql1="SELECT * FROM cancer WHERE hn='".$arr1['hn']."' ";
		$strq1 = mysql_query($strsql1);
		$numrow1=mysql_num_rows($strq1);
		
		if($numrow1==0){ 
		//$color="#FFCCFF";
		$link="<a href='cancer.php?hn=$arr1[hn]&diag=$arr1[diag]' target='_blank'>$arr1[hn]</a>"; 
		
		?>
      <tr>
      <td align="center" bgcolor="<?=$color;?>"><?=$i;?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['date']?></td>
       <td bgcolor="<?=$color;?>"><?=$arr1['dcdate']?></td>
      <td bgcolor="<?=$color;?>"><?=$link;?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['an']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['ptname']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['ptright']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['diag']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['icd10']?></td>
     </tr>
        <?
		$i++;
		}
	}  
	?>
    </table>
    <?
   	$sql1="SELECT * FROM ipcard1 WHERE  icd10 like 'c%' Group by hn";
	$query1 = mysql_query($sql1);

	$i=1;
	$n=1;
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
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
		$link='';
		$color='';
		$strsql1="SELECT * FROM cancer WHERE hn='".$arr1['hn']."' ";
		$strq1 = mysql_query($strsql1);
		$numrow1=mysql_num_rows($strq1);
		
		if($numrow1>0){ 
		$color="#FFCCFF";
		$link="<a href='cancer.php?edit=true&hn=$arr1[hn]' target='_blank'>$arr1[hn]</a>"; 
		
		?>
      <tr>
      <td align="center" bgcolor="<?=$color;?>"><?=$i;?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['date']?></td>
       <td bgcolor="<?=$color;?>"><?=$arr1['dcdate']?></td>
      <td bgcolor="<?=$color;?>"><?=$link;?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['an']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['ptname']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['ptright']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['diag']?></td>
      <td bgcolor="<?=$color;?>"><?=$arr1['icd10']?></td>
     </tr>
        <?
		$i++;
		}
	}  
	?>
    </table> 
    
    
<?
}
?>