<?
include("Connections/connect.inc.php");

?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
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
<div id="no_print" >
<form name="f1" action="" method="post" onsubmit="JavaScript:return fncSubmit();">
<table width="971"  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td width="111"  align="right">���͡ �ѹ /��͹ /��</td>
    <td width="270" ><? $d=date('d'); ?>
      <select name="d_start" class="forntsarabun">
        <option value="">������͡�ѹ</option>
        <? for($i=1;$i<=31;$i++){
			
			if($i<=9){
				
				$i="0".$i;
			?>
             <option value="<?=$i;?>" <? if($d==$i){ echo "selected"; }?>><?=$i;?></option>
             <? }else{ ?>
        	<option value="<?=$i;?>" <? if($d==$i){ echo "selected"; }?>><?=$i;?></option>
        <? } }?>
        </select>
      
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
        </select>
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
    <td width="560" rowspan="2" valign="top" >* �ҡ��ͧ��â����� ����͹ -��  㹪�ͧ�ѹ���������͡�� ������͡�ѹ</td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
      <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
    </td>
    </tr>
</table>
</form>

<hr />
</div>
<?php
if($_POST['submit']=="����"){

$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];

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
	if($_POST['d_start']==""){
   $dateshow=$printmonth." ".$_POST['y_start'];
   $day="��͹";
	}else{
	$dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	$day="�ѹ���";
	}

 print "<font class='forntsarabun' >Ẻ��§ҹ 506 ��Ш�$day  $dateshow </font><br />
<br />";

$temp="CREATE TEMPORARY TABLE  opday1  Select  *  from  opday  WHERE  (icd10 is not null and icd10!='')and thidate  LIKE  '$date1%'";
$qtemp = mysql_query($temp); 

$strsql="select row_id,icd10 from opday1  order by icd10";
$objq=mysql_query($strsql);

//echo $strsql."<br />";

while($array=mysql_fetch_array($objq)){
	

if($array['icd10']=='A01' || $array['icd10']=='A010' || $array['icd10']=='B008' || $array['icd10']=='B081' || $array['icd10']=='B084' || $array['icd10']=='B853' || $array['icd10']=='A630' || $array['icd10']=='A590' || $array['icd10']=='T881' || $array['icd10']=='T881' || $array['icd10']=='B804' || $array['icd10']=='T622' || $array['icd10']=='G937'){
	$subicd10=$array['icd10'];
	$select="select * from icd506 WHERE  icd10 ='$subicd10' ";
}else{
	$subicd10=substr($array['icd10'],0,3);
	$select="select * from icd506 WHERE  icd10 like '$subicd10%' ";
}
	$q1=mysql_query($select);
	$dbarr=mysql_fetch_array($q1);
	
	$ref=$dbarr['icd10'];

//echo $array['row_id']."-".$ref."</br>";
$update="update opday set ref_icd10='$ref' where  row_id='".$array['row_id']."' ";
$query=mysql_query($update);
	//echo $update."<br />";
}
	


$query="SELECT  icd506.icd10,depart_thai,depart_eng ,COUNT(*) AS duplicate FROM opday, icd506   Where opday.ref_icd10=icd506.icd10 and thidate like '$date1%' GROUP BY opday.ref_icd10 HAVING duplicate > 0 ORDER BY  icd506.icd10";

   $result = mysql_query($query);
   $rows=mysql_num_rows($result);
   $n=0;
   
 //  echo $query."<br />";
   ?>

<table  border="1" cellspacing="0" cellpadding="0" class="forntsarabun">
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td align="center">�ӴѺ</td>
<td align="center">icd10</td>
<td align="center">�����ä(��)</td>
<td align="center">�����ä(�ѧ���)</td>
<td align="center">�ӹǹ</td>
</tr>
  <? 	 
if($rows){
while ($dbarr1= mysql_fetch_array ($result)) {
$n++;
  ?>
<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td align="center"><?=$n;?></td>
<td><a href="icd506_detail.php?icd10=<?=$dbarr1['icd10'];?>&&date1=<?=$date1;?>" target="_blank"><?=$dbarr1['icd10'];?></a></td>
<td><?=$dbarr1['depart_thai'];?></td>
<td><?=$dbarr1['depart_eng'];?></td>
<td align="center"><?=$dbarr1['duplicate'];?></td>
</tr>
<? 
}
}else{
 echo " <tr> <td colspan='5' class='forntsarabun' align='center'>��辺��¡��</td>
  </tr>";
}
?>
</table>
<?
}
?>




