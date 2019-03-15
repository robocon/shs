<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
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
<body>
<div id="no_print">
<form id="form1" name="form1" method="post" action="">
  <table  border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">สถิติงานนวดแผนไทย</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>วัน/เดือน/ปี</td>
      <td><select name='d_start' class="font1">
        <option value="" selected="selected">--ไม่เลือก---</option>
        <? 
				//$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					//if($dd==$d){
					?>
        <option value="<?=$d;?>"> <?=$d;?></option>
        <?
				//	}else{
				?>
    <!--    <option value="<?//=$d;?>"> <?//=$d;?> </option>-->
        <?
				//}
				}
				
				?>
      </select>
        <? $m=date('m'); ?>
        <select name="m_start" class="font1">
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
        </select>
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="ตกลง" /></td>
    </tr>
  </table>
</form>
<br />
</div>

<?
switch($_POST['m_start']){
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

include("connect.inc");

if($_POST['d_start']==''){
	
$today=$_POST['y_start'].'-'.$_POST['m_start'];
$sh="ประจำเดือน";
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'];
$dateshow=$printmonth." ".$_POST['y_start'];


}else{
	
$today=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$sh="ประจำวันที่ ";	
$dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];


}

	
	


print "<div align=\"center\" class=\"forntsarabun\">สถิติงานแพทย์แผนไทย  $sh  $dateshow</div><BR>";

$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58131','58130','58101','58130P','58133','58131P','58130S','58131S','58201','58301','58301a')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0 Group by b.date ,b.hn,a.code ";
	
	
	$result = mysql_query($query) or die("Query failed ".$query."");

//echo $query;
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">ลำดับ</td>
    <td align="center">ชื่อ-สกุล ผู้รับบริการ</td>
    <td align="center">เพศ</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ-สกุล พนักงาน</td>
    <td align="center">การวินิจฉัยโรค</td>
    <td align="center">สิทธิการรักษา</td>
    <td align="center">นัดครั้งต่อไป</td>
    <td align="center">หมายเหตุ</td>
  </tr>
 <?   
 $i=1;
 while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$tvn,$staf_massage,$diag,$ptright) = mysql_fetch_row ($result)) {
	 
	 $sql = "SELECT sex  FROM `opcard` WHERE  hn='".$hn."' ";
	 $query = mysql_query($sql) or die("Query failed ".$sql."");
	 $arr=mysql_fetch_array($query);
	 
	 if($arr['sex']=='ช' || $arr['sex']=='1'){
		$sex= "ชาย"; 
		
		$nsex++;
	 }else if($arr['sex']=='ญ' || $arr['sex']=='2'){
		$sex= "หญิง"; 
		$nsex2++;
	 }
	 
	 $subdate=explode(" ",$date);
	 $strsql2="SELECT  appdate   FROM appoint    WHERE  hn='$hn'  and date like '$subdate[0]%' ";
	 $objquery2  = mysql_query($strsql2);
	list($appdate) = mysql_fetch_row($objquery2);
		 
//echo $strsql2;
?>

  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$ptname;?></td>
    <td><?=$sex?></td>
    <td><?=$hn;?></td>
    <td><?=$staf_massage;?></td>
    <td><?=$diag;?></td>
    <td><?=$ptright;?></td>
    <td><?=$appdate;?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }
  
/*  print "เพศชาย  ".$nsex." คน <BR>"; 
  print "เพศหญิง  ".$nsex2." คน"; */
  ?>
</table>
<BR />
<p>
<table width="100%" border="0" class="forntsarabun">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้บันทึก</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">( ........................................................................)</td>
    <td align="center">( ........................................................................)</td>
  </tr>
  <tr>
    <td align="center">แพทย์แผนไทย</td>
    <td align="center">หัวหน้างานแพทย์แผนไทย</td>
  </tr>
  <tr>
    <td align="center">................/................../................../</td>
    <td align="center">................/................../................../</td>
  </tr>
</table>

</p>
</body>
</html>