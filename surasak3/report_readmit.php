<style type="text/css">
<!--
.forntsarabun {
	font-family:"Angsana New";
	font-size: 18px;
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
    <td colspan="2" bgcolor="#99CC99">��§ҹ�����·���ա�� Re-admit ���� 28 �ѹ</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">����� ��</span></td>
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
				?>
                
                �֧
                
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
      
      <option value='<?=$i2?>' <? if($Y2==$i2){ echo "selected"; }?>><?=$i2;?></option>
      <?
				}
				echo "<select>";
				?>
      </td>
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




$date2=$_POST['y_end'];
$m_end=$_POST['m_end'];

/////////// �Ѻ��͹��ѧ 28 �ѹ ////
$d=01;
$m=$_POST['m_start'];
$y=$_POST['y_start']-543;
//$y=2011;
$dd = mktime(0,0,0,$m,$d-28,$y);
$start=date("Y-m-d",$dd);

$start1=explode("-",$start);
$start2=$start1[0]+543;
$start_date=$start2.'-'.$start1[1].'-'.$start1[2];

$end_date=$_POST['y_end'].'-'.$m_end.'-'.'31';





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
	  $dateshow=$printmonth." ".$_POST['y_start'];
	  $dateshow2=$printmonth2." ".$_POST['y_end'];
?>
<h2 align="center">��§ҹ�����·���ա�� Re-admit ���� 28 �ѹ  �����  <?=$dateshow;?> �֧ <?=$dateshow2;?></h2>

<p></p>
<table border="1" class="forntsarabun" bordercolor="#000000" style="border-collapse:collapse;" cellpadding="0" cellspacing="0">
    <tr>
     <td align="center">hn</td>
     <td align="center">����ʡ��</td>
     <td align="center">����</td>
     <td align="center">an1</td>
      <td align="center">admit1</td>
      <td align="center">diag1</td>
      <td align="center">ward1</td>
       <td align="center">an2</td>
       <td align="center">admit2</td>
       <td align="center">diag2</td>
       <td align="center">ward2</td>
       <td align="center">Re-admit</td>
    </tr>	

<?
$tsql1="CREATE TEMPORARY TABLE   ipcard1  SELECT hn,Count(hn) as chn
FROM ipcard
WHERE SUBSTRING( date, 1, 10 ) 
BETWEEN '$start_date' AND '$end_date' GROUP BY hn
HAVING chn >=2 ";


$tquery1 = mysql_query($tsql1);
//echo $tsql1;



///////////////////////////////////  ��ҧ /////////////////////////////
	$sql2="Select * from ipcard1 ";
	$query2 = mysql_query($sql2);



	while($arr2=mysql_fetch_array($query2)){
		
		$arrdate=array();
		$arran=array();
		$arrage=array();
		$arrptname=array();
		$arraddate=array();
		$arrdcdate=array();
		$arrdiag=array();
		$arrward=array();
		
		
		$sql3="Select * from ipcard Where hn='".$arr2['hn']."' and SUBSTRING( date, 1, 10 )  BETWEEN '$start_date' AND '$end_date' order by date asc ";
		//echo $sql3;
		$query3 = mysql_query($sql3);
		//$arr3=mysql_fetch_array($query3);
		
		while($arr3=mysql_fetch_array($query3)){
			
			$exdate=explode(" ",$arr3['date']);
			$exdate[0]=(substr($exdate[0],0,4)-543).substr($exdate[0],4);
			
			array_push($arrdate,$exdate[0]);
			array_push($arran,$arr3['an']);
			array_push($arrage,$arr3['age']);
			array_push($arrptname,$arr3['ptname']);
			array_push($arraddate,$arr3['date']);
			array_push($arrdcdate,$arr3['dcdate']);
			array_push($arrdiag,$arr3['diag']);
			array_push($arrward,$arr3['my_ward']);
//echo $exdate[0]."  ".$arr3['hn']." ".DateDiff($exdate[0],$exdate[0]).'<BR>';
			
			//echo $arr3['an']."<br />";
		
}
?>

<? 
  	
	for($k=0;$k<count($arrdate)-1;$k++){
			$strdate = (strtotime($arrdate[$k+1])-strtotime($arrdate[$k]))/  ( 60 * 60 * 24 );
			
			
		
			if($strdate<=28){
			$query4 = mysql_query($sql3);
			$arr4=mysql_fetch_array($query4);
			?>
            <tr>
            <td><?=$arr4['hn'];?>&nbsp;</td>
            <td><?=$arr4['ptname'];?></td>
            <td><?=$arrage[$k+1];?></td>
            <td><?=$arran[$k];?>&nbsp;</td>
            <td><?=$arraddate[$k];?></td>
            <td><?=$arrdiag[$k];?></td>
            <td><?=$arrward[$k];?></td>
            <td><?=$arran[$k+1];?></td>
            <td><?=$arraddate[$k+1];?></td>
            <td><?=$arrdiag[$k+1];?></td>
            <td><?=$arrward[$k+1];?></td>
            <td align="center"><?=$strdate;?></td>
            </tr>
            <?
		
			//echo $arr2['hn'].' '.$strdate."<br>";//mktime("d",0,0,0,date("m"),date("d"),date("Y"));
			
			}
		}

    }
}//// submit
	?>
</table>