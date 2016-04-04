<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>สมุดทะเบียนการรับบริการวัคซีนเด็ก</title>
    <style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;

}
fieldset{

display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;


}
</style>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าหลัก</span></a></li>
        <li><a href="service.php"><span>สมุดทะเบียนวัคซีนเด็ก</span></a></li>
        <li><a href="clinic_well_baby.php"><span>คลินิก Well baby</span></a></li>
     	<li><a href="#"><span>รายงานการรับบริการวัคซีนเด็ก</span></a></li>
  	<ul>
	  	<li><a href="Report_m.php"><span>รายงานการรับบริการประจำเดือน</span></a></li>
        <li><a href="Report_vac.php"><span>รายงานการรับบริการตามวัคซีน</span></a></li>
        <li><a href="Report_all.php"><span>รายงานการรับบริการทั้งหมด</span></a></li>
        
    </ul>
    <li><a href="Report_clinic_wellbaby.php"><span>รายงาน คลินิก Well baby</span></a></li>
    <li><a href="show_edit.php"><span>แก้ไขข้อมูลวัคซีน</span></a></li>
     <li><a href="add_vac.php"><span>จัดการข้อมูลวัคซีน</span></a></li>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
		
<?
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$showdate=date("Y-m");

$d=date('Y-m-d');
$dateN=explode("-",$d);

$mm=$dateN[0].'-'.$dateN[1];
?>

<!--<p style='page-break-before: always'></p>-->
<h3 align="center" class="forntsarabun">ทะเบียนผู้รับบริการอนามัยเด็กในงานสร้างเสริมภูมิคุ้มกันโรค</h3>
<h4 align="center" class="forntsarabun"><span class="forntsarabun">ห้องตรวจโรคผู้ป่วยนอก โรงพยาบาลค่ายสุรศักดิ์มนตรี</span></h4>

<div id="no_print" align="center" class="forntsarabun">
<FORM METHOD="POST" ACTION="" name="FrmR" enctype="multipart/form-data" >
	<span class="style14">ตั้งแต่วันที่ : <!--&nbsp;&nbsp;
	 <input name="date1" type="text" class="forntsarabun" id="datepicker-th-1" size="10" />
&nbsp;&nbsp;&nbsp;&nbsp;ถึงวันที่ :   &nbsp;&nbsp;
	 <input name="date2" type="text" class="forntsarabun" id="datepicker-th-2" size="10" />
	</span>	&nbsp;&nbsp;&nbsp;&nbsp;--><select name='d_start' class="font1">
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
				?>
	<input  name="SubReoprt" type="submit" class="forntsarabun" value="View Report" />
	<input type="button" name="button"  class="forntsarabun" value="พิมพ์ใบรายงาน"  onClick="JavaScript:window.print();">
   <input type=button value='กลับเมนู'  class="forntsarabun" onClick="window.location='service.php'">&nbsp;
 <input type=button value='กลับหน้าแรก'  class="forntsarabun" onClick="window.location='../../nindex.htm'">
</FORM>
</div>
<?


/*$d1=substr($_POST['date1'],0,2);
$m1=substr($_POST['date1'],3,2);
$y1=substr($_POST['date1'],6,4);
$y1=$y1-543;
$date1=$y1.'-'.$m1.'-'.$d1;


$d2=substr($_POST['date2'],0,2);
$m2=substr($_POST['date2'],3,2);
$y2=substr($_POST['date2'],6,4);
$y2=$y2-543;
$date2=$y2.'-'.$m2.'-'.$d2;

*/		
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
$dateshow=$printmonth." ".$_POST['y_start'];

$today=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];

	  

	
$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`date_ser`  like  '$today%' order by `tb_service`.`date_ser` asc ";
  


/*$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`date_ser`  like '$mm%' order by `tb_service`.`date_ser` asc ";*/
  
/*	  $strsql="SELECT SUM(unit) AS Sumunit  FROM tb_service  where  date_ser  like '$mm%' ";
	  $query = mysql_query($strsql);
	  $arr= mysql_fetch_array($query); */
//}



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
	  	   }elseif($name1=="HBV"){ 
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
	  
if($r%21==0)
{
  
/*}
	  if($r=='21'){
		 $r=1;*/
		 
		 $r=1;
		echo "</table>";
		echo "<div style='page-break-after: always'>";
		echo "<div style='page-break-before: always'>";
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
    <td align="center">HBV</td>
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
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>