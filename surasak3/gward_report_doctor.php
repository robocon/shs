
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
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
.forntsarabun1 {	font-family:"Angsana New";
	font-size: 18px;
}
-->
</style>
<div id="no_print" >

<a name="head" id="head"></a>
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">ʶԵ��ʹ ���������ٵ�-���</td>
  </tr>
  <tr class="forntsarabun">
    <td  align="right">��ǧ����</td>
    <td >
	<select name='d_start' class="forntsarabun">
	<? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					?>
      
        <option value="<?=$d;?>"> <?=$d;?></option>
        <?	
				}
		?>
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
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
        <?=$i;?>
        </option>
      <?
				}
				echo "<select>";
				?>
      �֧
      <select name='d_end' class="forntsarabun">
      <? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					?>
      
        <option value="<?=$d;?>">
          <?=$d;?>
          </option>
        <?	
				}
				?>
                </select>
        <? $m2=date('m'); ?>
        <select name="m_end" class="forntsarabun">
        <option value="01" <? if($m2=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m2=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m2=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m2=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m2=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m2=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m2=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m2=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m2=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m2=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m2=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m2=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
      </select>
      <? 
			   $Y2=date("Y")+543;
			   $date2=date("Y")+543+5;
			  
				$dates2=range(2547,$date2);
				echo "<select name='y_end' class='forntsarabun'>";
				foreach($dates2 as $i2){
				?>
      <option value='<?=$i2?>' <? if($Y2==$i2){ echo "selected"; }?>>
        <?=$i2;?>
        </option>
      <?
				}
				echo "<select>";
				?></td>
  </tr>
  <tr class="forntsarabun">
    <td  align="right">ᾷ��</td>
    <td ><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
		include("connect.inc"); 
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
      </select>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
      </td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  </table>
</form>

</div>

<?php

if($_POST['submit']){

include("connect.inc.php"); 

$date1=$_POST['y_start'].'-'.$_POST['m_start'];

$start_date=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'].' 00:00:00';
$end_date=$_POST['y_end'].'-'.$_POST['m_end'].'-'.$_POST['d_end'].' 23:59:59';

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
	switch($_POST['m_end']){
		case "01": $printmonth2 = "���Ҥ�"; break;
		case "02": $printmonth2 = "����Ҿѹ��"; break;
		case "03": $printmonth2 = "�չҤ�"; break;
		case "04": $printmonth2 = "����¹"; break;
		case "05": $printmonth2 = "����Ҥ�"; break;
		case "06": $printmonth2 = "�Զع�¹"; break;
		case "07": $printmonth2 = "�á�Ҥ�"; break;
		case "08": $printmonth2 = "�ԧ�Ҥ�"; break;
		case "09": $printmonth2 = "�ѹ��¹"; break;
		case "10": $printmonth2 = "���Ҥ�"; break;
		case "11": $printmonth2 = "��Ȩԡ�¹"; break;
		case "12": $printmonth2 = "�ѹ�Ҥ�"; break;
	}
	  $dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	  $dateshow2=$_POST['d_end'].' '.$printmonth2." ".$_POST['y_end'];

  function DateDiff($strDate1,$strDate2)
	 {
	return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
	 }
 
 
$sql1="CREATE TEMPORARY TABLE  bed1  Select * from  ipcard  WHERE date
BETWEEN  '$start_date' AND '$end_date'  AND doctor like '".substr($_POST['doctor'],0,5)."%'  AND bedcode  LIKE  '43%' ";
$query1 = mysql_query($sql1);

$sql="SELECT * FROM bed1";
$objq=mysql_query($sql);
$row=mysql_num_rows($objq);


if($row){
	
	 print "<div><font class='forntsarabun' >ʶԵ��ͼ������ٵ�-��� �����ҧ  $dateshow  �֧ $dateshow2 </font></div><br>";
 ?>
<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
  <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">HN</td>
    <td align="center">AN</td>
    <td align="center" bgcolor="#0099FF">����-ʡ��</td>
    <td align="center">�Է��</td>
    <td align="center">Diag</td>
    <td align="center">ᾷ��</td>
    <td align="center">�Ѻ����</td>
    <td align="center">�ӹ���</td>
    <td align="center">�ѹ�͹</td>
  </tr>
  <?
  $i=0;
  while($array=mysql_fetch_array($objq)){
	  
	
	  
	  $y1=substr($array['date'],0,4)-543;
	  $m1=substr($array['date'],5,2);
	  $d1=substr($array['date'],8,2);
	  $datediff1=$y1.'-'.$m1.'-'.$d1;
	  
	  
	  $y2=substr($array['dcdate'],0,4)-543;
	  $m2=substr($array['dcdate'],5,2);
	  $d2=substr($array['dcdate'],8,2);
	  $dcdate=$y2.'-'.$m2.'-'.$d2;
	  
	 if($array['dcdate'] != '0000-00-00 00:00:00'){
	  $admit=DateDiff("$datediff1","$dcdate"); 
	 }else{
	  $admit="0";
	 }
	  
  ?>
  

  <tr>
    <td align="center"><?=++$i;?></td>
    <td><?=$array['hn'];?></td>
    <td><?=$array['an'];?></td>
    <td><?=$array['ptname'];?></td>
    <td><?=$array['ptright'];?></td>
    <td><?=$array['diag'];?></td>
    <td><?=$array['doctor'];?></td>
    <td><?=substr($array['date'],0,10);?></td>
    <td><?=substr($array['dcdate'],0,10);?></td>
    <td align="center"> <?=$admit;?></td>
  </tr>
  <?
  }
  ?>
</table>

<br /><!--<a href="#head" class="forntsarabun">��鹢�ҧ��</a>-->
<a name="top" id="top"></a><h1 class="forntsarabun">Top 5 �ä</h1> 
<?

$sqltop="SELECT  icd10, COUNT(`icd10`) AS  `top` 
FROM bed1
WHERE  icd10 !=''
GROUP BY icd10
ORDER BY  `top` DESC 
LIMIT 5";
$objtop=mysql_query($sqltop);

$i=0;
 ?>
 <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
  <tr align="center">
    <td bgcolor="#0099FF">�ӴѺ</td>
    <td bgcolor="#0099FF">icd10</td>
    <td bgcolor="#0099FF">diag</td>
    <td bgcolor="#0099FF">�ӹǹ</td>
  </tr>
  <?
  while($array2=mysql_fetch_array($objtop)){
	  
	  $icd="select detail  from icd10 Where code='$array2[icd10]' ";
	  $q=mysql_query($icd);
	  $r=mysql_fetch_array($q);

  ?>
  <tr>
    <td align="center"><?=++$i;?></td>
    
    <td><a href="detail.php?do=view&icd10=<?=$array2['icd10'];?>&date=<?=$date1;?>" title="��ԡ����ʹ���������´"><?=$array2['icd10'];?></a></td>
    <td><?=$r['detail'];?></td>
  <td align="center"><?=$array2['top'];?></td>
    
  </tr>
  <?
  }
  ?>
</table>

<?


}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ��͹  $dateshow</font>";
}

}// if($_POST['submit'])
?>
