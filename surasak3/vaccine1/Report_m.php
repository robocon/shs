<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
</head>
<style type="text/css">
<!--
.style3 {font-size: 14px}
-->

@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

</style>
	<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
		<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() +543);//


		    // กรณีต้องการใส่ปฏิทินลงไปมากกว่า 1 อันต่อหน้า ก็ให้มาเพิ่ม Code ที่บรรทัดด้านล่างด้วยครับ (1 ชุด = 1 ปฏิทิน)
  $("#datepicker-th-1").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});



		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

     		    $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});

		    $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });


			});
		</script>
		
<?
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$showdate=date("Y-m");

$d=date('Y-m-d');
$dateN=explode("-",$d);

$mm=$dateN[0].'-'.$dateN[1];
?>

<body>
<p style='page-break-before: always'></p>
<h3 align="center" class="forntsarabun">ทะเบียนผู้รับบริการอนามัยเด็กในงานสร้างเสริมภูมิคุ้มกันโรค</h3>
<h4 align="center" class="forntsarabun"><span class="forntsarabun"> ห้องตรวจโรคผู้ป่วยนอก โรงพยาบาลค่ายสุรศักดิ์มนตรี</span></h4>

<div align="center" class="forntsarabun">
<div id="no_print" >
<FORM METHOD="POST" ACTION="" name="FrmR" enctype="multipart/form-data" >
	<span class="style14">ตั้งแต่วันที่ : &nbsp;&nbsp;
	 <input name="date1" type="text" class="forntsarabun" id="datepicker-th-1" size="10" />
&nbsp;&nbsp;&nbsp;&nbsp;ถึงวันที่ :   &nbsp;&nbsp;
	 <input name="date2" type="text" class="forntsarabun" id="datepicker-th-2" size="10" />
	</span>	&nbsp;&nbsp;&nbsp;&nbsp;
	<input  name="SubReoprt" type="submit" class="forntsarabun" value="View Report" />
	<input type="button" name="button"  class="forntsarabun" value="พิมพ์ใบรายงาน"  onClick="JavaScript:window.print();">
   <input type=button value='กลับเมนู'  class="forntsarabun" onClick="window.location='service.php'">&nbsp;
 <input type=button value='กลับหน้าแรก'  class="forntsarabun" onClick="window.location='../../nindex.htm'">
</FORM>
</div>
</div>
<?

$d1=substr($_POST['date1'],0,2);
$m1=substr($_POST['date1'],3,2);
$y1=substr($_POST['date1'],6,4);
$y1=$y1-543;
$date1=$y1.'-'.$m1.'-'.$d1;
//***date1***//

$d2=substr($_POST['date2'],0,2);
$m2=substr($_POST['date2'],3,2);
$y2=substr($_POST['date2'],6,4);
$y2=$y2-543;
$date2=$y2.'-'.$m2.'-'.$d2;
//***date2***//

			  
if($_POST['SubReoprt']){
	
$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`date_ser`  between '$date1' and '$date2'  order by `tb_service`.`date_ser` asc ";
  
}else{

$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`date_ser`  like '$mm%' order by `tb_service`.`date_ser` asc ";
  
	  $strsql="SELECT SUM(unit) AS Sumunit  FROM tb_service  where  date_ser  like '$mm%' ";
	  $query = mysql_query($strsql);
	  $arr= mysql_fetch_array($query); 
}



$result = mysql_query($sql);
  
$rows=mysql_num_rows($result);


$n=1;
?>
<br /><table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
  <tr class="forntsarabun">
    <td  height="48" align="center" >ลำดับ</td>
    <td  align="center" >ว.ด.ป.</td>
    <td  align="center" >hn</td>
    <td  align="center" >ชื่อ - สกุล</td>
    <td  align="center" >อายุ</td>
    <td  align="center" >ที่อยู่</td>
    <td align="center">วัคซีน</td>
    <td  align="center" >เข็มที่</td>
    <td  align="center" >LotNo</td>
    <td  align="center" >Exp.</td>
    <td  align="center" >วัคซีน</td>
    <td  align="center" >เข็มที่</td>
    <td  align="center" >LotNo</td>
    <td  align="center" >Exp.</td>
    <td  align="center" >แพทย์</td>
  </tr>
  
<?
$r=0;
if($rows){

while($row= mysql_fetch_array($result)){
	  $r++;
if($row['vac_name']=="VAC+OPV"){
		  
		  $name1=substr($row['vac_name'],0,3);
		  
		   if($name1=="VAC"){ 
		   $vac++; 
	  	   }
		  $name2=substr($row['vac_name'],4,3);
		  
		   if($name2=="OPV"){ 
		   $opv++; 
	  	   }

	  }elseif($row['vac_name']=="DPT+OPV"){
		  
		  $name1=substr($row['vac_name'],0,3);
		 	
			if($name1=="DPT"){ 
		   $dpt++; 
	  	   }
		  
		  $name2=substr($row['vac_name'],4,3);
		  
		  if($name2=="OPV"){ 
		   $opv++; 
	  	   }
		   
	  }else{
		$name1=$row['vac_name'];  
		
		
		if($name1=="MMR"){ 
		   $mmr++; 
	  	   }elseif($name1=="JEV"){ 
		   $jev++; 
	  	   }elseif($name1=="TT"){ 
		   $tt++; 
	  	   }elseif($name1=="VEROLAB"){ 
		   $vero++; 
	  	   }elseif($name1=="HVB"){ 
		   $hvb++; 
	  	   }
	  }
	  
$y=substr($row['date_ser'],0,4);
$m=substr($row['date_ser'],5,2);
$d=substr($row['date_ser'],8,2);


/*$named=explode("  ",$row['name_doc']);

$namedoc=$named[1];*/

$named=substr($row['name_doc'],6);

$namedoc=trim($named);

$y=$y+543;
switch($m){
		case "01": $printmonth = "ม.ค."; break;
		case "02": $printmonth = "ก.พ."; break;
		case "03": $printmonth = "มี.ค."; break;
		case "04": $printmonth = "เม.ย."; break;
		case "05": $printmonth = "พ.ค."; break;
		case "06": $printmonth = "มิ.ย."; break;
		case "07": $printmonth = "ก.ค."; break;
		case "08": $printmonth = "ส.ค."; break;
		case "09": $printmonth = "ก.ย."; break;
		case "10": $printmonth = "ต.ค."; break;
		case "11": $printmonth = "พ.ย."; break;
		case "12": $printmonth = "ธ.ค."; break;
	}
	
   $dateshow=$d." ".$printmonth." ".$y;
	  

	  if($r=='21'){
		 $r=1;
		echo "</table>";
		echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
?>
<table  width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
  <tr class="forntsarabun">
    <td  height="48" align="center" >ลำดับ</td>
    <td  align="center" >ว.ด.ป.</td>
    <td  align="center" >hn</td>
    <td  align="center" >ชื่อ - สกุล</td>
    <td  align="center" >อายุ</td>
    <td  align="center" >ที่อยู่</td>
    <td align="center">วัคซีน</td>
    <td  align="center" >เข็มที่</td>
    <td  align="center" >LotNo</td>
    <td  align="center" >Exp.</td>
    <td  align="center" >วัคซีน</td>
    <td  align="center" >เข็มที่</td>
    <td  align="center" >LotNo</td>
    <td  align="center" >Exp.</td>
    <td  align="center" >แพทย์</td>
  </tr>

<? } ?>
 <tr class="forntsarabun">
    <td align="center"><?=$n++; ?></td>
    <td><?=$dateshow;?></td>
    <td align="center"><?=$row['hn'];?></td>
    <td><?=$row['yot'].$row['name'].' '.$row['surname'];?></td>
    <td><?=calcage($row['dbirth']);?></td>
    <td><?=$row['address'].' '.$row['tambol'].' '.$row['ampur'].' '.$row['changwat'];?></td>
    <td align="center"><?= $name1;?></td>
    <td align="center"><?=$row['num'];?></td>
    <td align="center"><?=$row['lotno'];?></td>
    <td align="center"><?=$row['date_end'];?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $name2; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $row['num']; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $row['lotno2']; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $row['date_end2']; }?></td>
    <td><?=$namedoc;?></td>
  </tr>
 <?  
}
} else {
	echo "<tr>";
 	echo "<td colspan='10' align=center class='forntsarabun'><font color=red>ยังไม่มีรายการ</font></td>";
	echo "</tr>";
}
echo "</div>";
echo "</div>";
?>

</table>
<br />
<table  width="50%" border="1"  align="center" cellspacing="0" cellpadding="0" bordercolorlight="#CCCCCC" bordercolordark="#FFFFFF" class="forntsarabun">
  <tr>
    <td align="center" bgcolor="#CCCCCC">วัคซีน</td>
    <td align="center">MMR</td>
    <td align="center">JEV</td>
    <td align="center">TT</td>
    <td align="center">VEROLAB</td>
    <td align="center">OPV</td>
    <td align="center">VAC รวม</td>
    <td align="center">DPT</td>
    <td align="center">HVB</td>
  </tr>
  <tr align="center">
    <td align="center" bgcolor="#CCCCCC">จำนวนผู้รับบริการ</td>
    <td><? if($mmr==''){ echo "0"; }else{ echo $mmr; }?></td>
    <td><? if($jev){ echo $jev; }else{  echo "0"; }?>
</td>
    <td><? if($tt){ echo $tt; }else{ echo "0"; }?>
</td>
    <td><? if($vero){ echo $vero; }else{ echo "0";; }?>
</td>
    <td><? if($opv){ echo $opv; }else{ echo "0"; }?>
</td>
    <td><? if($vac){ echo $vac; }else{ echo "0"; }?>
</td>
    <td><? if($dpt){ echo $dpt; }else{ echo "0"; }?>
</td>
</td>
    <td><? if($hvb){ echo $hvb; }else{ echo "0"; }?>
</td>
  </tr>
</table>
</table>
</body>
</html>