<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.f1 {	font-size: 14px;
}
.f1 {	font-size: 18px;
}
.f1 {	font-family: "TH SarabunPSK";
}
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
</head>

<body>
<h1 class="forntsarabun">��§ҹ����� Antibiotic Smart Use  ��Ш���͹  �ç��Һ�Ť�������ѡ�������� </h1>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
        <td  align="right">���͡��͹<span class="f1"> :</span></td>
    <td ><? $m=date('m'); ?>
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
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
        <?=$i;?>
      </option>
      <?
				}
				echo "<select>";
				?></td>
    <td >���ҵ�� ICD 10</td>
    <td ><label>
      <input type="text" name="icd10" id="icd10"  class="forntsarabun"/>
    </label></td>
    <td  align="right"><span class="forntsarabun">������������ :</span></td>
    <td><select name="type_an" class="forntsarabun">
      <option value="all">�ʴ�������</option>
      <option value="an1">�������</option>
      <option value="an2">�����¹͡</option>
    </select></td>
    </tr>
  <tr>
    <td colspan="10" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>
      &nbsp;&nbsp; <a href="../regis_asu.php">��Ѻ������ѡ</a></td>
  </tr>
</table>
</form>
<br />
<?
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

if($_POST['submit']!=""){

$date1=$_POST['y_start'].'-'.$_POST['m_start'];

if($date1!=''){


		$sqlasu = "select * from druglst where asu='1' Order by drugcode ASC ";
		$resultasu = mysql_query($sqlasu);
		$rowsasu = mysql_num_rows($resultasu);
		
	/*	
	$sql="SELECT  DISTINCT drugrx.date,drugrx.drugcode,drugrx.tradname FROM  `druglst` INNER JOIN  `drugrx` ON `druglst`.`drugcode` = `drugrx`.`drugcode` WHERE druglst.asu='1' and drugrx.date like '$date1%' ";
	$query=mysql_query($sql);
	$rows=mysql_num_rows($query);*/
	
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
	
	
	if($_POST['type_an']=='all'){ $n="�����·�����"; }elseif($_POST['type_an']=='an1'){ $n="�������"; }elseif ($_POST['type_an']=='an2'){ $n="�����¹͡"; }
?>



<h1 class="forntsarabun">��Ш���͹  <?=$printmonth." ".$_POST['y_start'];?>  ������   <?=$n?></h1>

<table  border="1" cellspacing="0" cellpadding="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
  <tr class="forntsarabun">
    <td bgcolor="#339900">�ӴѺ</td>
    <td bgcolor="#339900">������</td>
    <td bgcolor="#339900">������(��ä��)</td>

    <td bgcolor="#339900">�Ҥҷع</td>
    <td bgcolor="#339900">�ҤҢ��</td>
    <td bgcolor="#339900">�ӹǹ�����</td>
    <td bgcolor="#339900">��Ť�ҷع</td>
    <td bgcolor="#339900">��Ť�Ң��</td>
 
  </tr>
  
  <?
  while($dbarr=mysql_fetch_array($resultasu)){
	  
	  	$drugcode=$dbarr['drugcode'];
		
		$icd10=$_POST['icd10'];
		  //////////////////////////////////////////////
		 if($icd10==''){
			 
		
 	$sql1="SELECT  druglst.salepri , sum(drugrx.amount)as sumamount,druglst.unitpri FROM  opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode WHERE drugrx.drugcode='$drugcode' and drugrx.date like '$date1%'";
	 }elseif($icd10!='' and $_POST['type_an']=="all"){ 
		$sql1="SELECT  opday.an,opday.icd10,druglst.salepri , sum(drugrx.amount)as sumamount,druglst.unitpri FROM opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode WHERE opday.icd10='$icd10' and drugrx.drugcode='$drugcode' and drugrx.date like '$date1%'";
     }elseif($icd10!='' and $_POST['type_an']=="an1"){ 
	
	   
		$sql1="SELECT  opday.an,opday.icd10,druglst.salepri , sum(drugrx.amount)as sumamount,druglst.unitpri FROM opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode WHERE opday.icd10='$icd10' and drugrx.drugcode='$drugcode' and (opday.an !=' ' and opday.an IS NOT NULL) and drugrx.date like '$date1%'";
  }elseif($icd10!='' and $_POST['type_an']=="an2"){ 
  

		$sql1="SELECT  opday.an,opday.icd10,druglst.salepri , sum(drugrx.amount)as sumamount,druglst.unitpri FROM opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode WHERE opday.icd10='$icd10' and drugrx.drugcode='$drugcode' and (opday.an ='' or opday.an is null) and drugrx.date like '$date1%'";

  }
  
		$query1=mysql_query($sql1);
	    $dbarr1=mysql_fetch_array($query1);
		
  ?>
  <tr class="forntsarabun">
    <td><?=++$no;?></td>
    <td><?=$dbarr['drugcode'];?></td>
    <td><?=$dbarr['tradname'];?></td>

    <td><?=number_format($dbarr1['unitpri'],'2','.',',');?></td>
    <td><?=number_format($dbarr1['salepri'],'2','.',',');?></td>
    <td><?=number_format($dbarr1['sumamount'],'','.',',');?></td>
    <td><?=number_format($dbarr1['unitpri']*$dbarr1['sumamount'],'','.',',');?></td>
    <td><?=number_format($dbarr1['salepri']*$dbarr1['sumamount'],'','.',',');?></td>
  </tr>
    <?
  $unitpri+=$dbarr1['unitpri'];
  $salepri+=$dbarr1['salepri'];
  $amount+=$dbarr1['sumamount'];
  $sumunitpri+=$dbarr1['unitpri']*$dbarr1['sumamount'];
  $sumsalepri+=$dbarr1['salepri']*$dbarr1['sumamount'];
	
	
	} ?>
  <tr class="forntsarabun">
    <td colspan="3" align="right">��� :</td>
     <td><?=number_format($unitpri,2);?></td>
    <td><?=number_format($salepri,2);?></td>
    <td><?=number_format($amount,'',';',',');?></td>
    <td><?=number_format($sumunitpri,'',';',',');?></td>
    <td><?=number_format($sumsalepri,'',';',',');?></td>
  </tr>

</table>



<?
}//if2
}//if1
?>
</body>
</html>