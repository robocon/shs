<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
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
-->
</style>
<div id="no_print">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">รายงานผู้ป่วยใหม่ตามปีงบประมาณ</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">ตั้งแต่ - เดือน/ปี</span></td>
    <td >
    		<input name="d_start1" type="text"  class="forntsarabun" id="d_start1" value="01" size="5"/>
   
	<? $m=date('m'); ?>
      <select name="m_start1" class="forntsarabun" id="m_start1">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start1' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">ถึง  - เดือน/ปี</td>
    <td > 
      <input name="d_start2" type="text"  class="forntsarabun" id="d_start2" value="30" size="5"/>
      <? $m=date('m'); ?>
      <select name="m_start2" class="forntsarabun" id="m_start2">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?> >ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start2' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
<HR>
</div>


<?
if($_POST['submit']){
	
	
	
include("connect.inc"); 

$y1=$_POST['y_start1']-543;
$y2=$_POST['y_start2']-543;
/*$date1=$y1.'-'.$_POST['m_start1'];
$date2=$y2.'-'.$_POST['m_start2'];*/


$date1=$y1.'-'.$_POST['m_start1'].'-'.$_POST['d_start1'];
$date2=$y2.'-'.$_POST['m_start2'].'-'.$_POST['d_start2'];


	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));

		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strMonthThai $strYear";
	}
	
/*$datethai1=$y1.'-'.$_POST['m_start1'];
$datethai2=$y2.'-'.$_POST['m_start2'];

//echo $datethai1;echo $datethai1;*/
?>
<h1 align="center" class="forntsarabun">สถิติผู้ป่วย ตั้งแต่  <? echo DateThai($date1); ?> ถึง <? echo DateThai($date2); ?></h1>
<h1 align="center" class="forntsarabun">โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</h1>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000">
  <tr>
    <td align="center" bgcolor="#CCCCCC">เดือน/ปี</td>
    <td align="center" bgcolor="#CCCCCC">ผู้ป่วยนอก</td>
    <td align="center" bgcolor="#CCCCCC">ผู้ป่วยใน</td>
    <td align="center" bgcolor="#CCCCCC">ผู้ป่วยใหม่</td>
    <td align="center" bgcolor="#CCCCCC">รวมแต่ละเดือน</td>
  </tr>
 
  
<?

function Dbetween($Datestart, $Dateend){
    $Oday = (60*60*24); #1 วัน 
    $Datestart = strtotime($Datestart); #แปลงวันที่เป็น unixtime
    $Dateend = strtotime($Dateend); #แปลงวันที่เป็น unixtime
    $Diffday = round(($Dateend - $Datestart)/$Oday); 
    $arrayDate = array();
    $arrayDate[] = date('Y-m-d',$Datestart);    
    for($x = 1; $x < $Diffday; $x++){
        $arrayDate[] = date('Y-m-d',($Datestart+($Oday*$x)));
    }
    $arrayDate[] = date('Y-m-d',$Dateend);
    return $arrayDate;
}

$sumday = Dbetween($date1, $date2);

$m1=array();



foreach ($sumday as $value) {
	
	
	
	$subvalue=substr($value,0,7);
	
	if(!in_array($subvalue,$m1)){
		
		array_push($m1,$subvalue);
		
		$explode=explode('-',$subvalue);
		$yvalue=$explode[0]+543;
		$mvalue=$explode[1];
		
		switch($mvalue){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
		}
		
		$datevalue=$yvalue.'-'.$mvalue;
	    $datevalueshow=$printmonth.' '.substr($yvalue,2);
		
		/////////////////////////////// นอก
	   
	$sql="select count(*) as opd  from opday WHERE  thidate  like '$datevalue%'  and (an IS NULL or an ='')";
	$query=mysql_query($sql)or die (mysql_error());
	$arr=mysql_fetch_array($query);
	
	////////////////////////////////////// ใน 
	
	$sql1="select count(*) as ipd  from ipcard WHERE  date  like '$datevalue%'  and an !='' ";
	$query1=mysql_query($sql1)or die (mysql_error());
	$arr1=mysql_fetch_array($query1);
	
	////////////////////////////////////////  ใหม่
	
	$sql2="select count(*) as new  from opcard  WHERE  regisdate  like '$subvalue%' ";
	$query2=mysql_query($sql2)or die (mysql_error());
	$arr2=mysql_fetch_array($query2);
	
	////////////////////////////////////////
	
	$opd=$arr['opd'];
	$ipd=$arr1['ipd'];
	$new=$arr2['new'];
	$summounth=$opd+$ipd+$new;
	
	?>
 <tr>
    <td width='20%'><?=$datevalueshow;?></td>
    <td align="center" width="20%"><?=number_format($opd)?></td>
    <td align="center" width="20%"><?=number_format($ipd)?></td>
    <td align="center" width="20%"><?=number_format($new)?></td>
	 <td align="center" width="20%"><?=number_format($summounth)?></td>
  </tr>
<?  
  $opdtotal+=$opd;
  $ipdtotal+=$ipd;
  $newtotal+=$new;
  
	}


}


?>
 <tr>
    <td align="center" bgcolor="#CCCCCC">รวมทั้งหมด</td>
    <td align="center" bgcolor="#CCCCCC"><?=number_format($opdtotal);?></td>
    <td align="center" bgcolor="#CCCCCC"><?=number_format($ipdtotal);?></td>
    <td align="center" bgcolor="#CCCCCC"><?=number_format($newtotal);?></td>
    <td align="center" bgcolor="#CCCCCC"><?=number_format($opdtotal+$ipdtotal+$newtotal);?></td>
  </tr>
</table>
<? } ?>
</body>
</html>