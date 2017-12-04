<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานการใช้ Antibiotic Smart Use</title>
<style type="text/css">
<!--
.h {
	font-family: "TH SarabunPSK";
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.f1 {
	font-size: 14px;
}
.forntsarabun td {
	font-size: 16px;
}
.f1 {
	font-size: 18px;
}
.f1 {
	font-family: "TH SarabunPSK";
}
-->
</style>
</head>

<SCRIPT LANGUAGE="JavaScript">
<!--

function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_drug.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
window.onload = function(){

	document.getElementById("drug_code").focus();

}

function add_drug(drugcode){
	
	var returnstr;
	document.getElementById("drug_code").value = drugcode;
	document.getElementById('list').innerHTML='';
	document.getElementById("drug_amount").focus();
}

function addslip(drugslip){
	
	document.getElementById("drug_slip").value = drugslip;
	document.getElementById('list').innerHTML='';
	document.getElementById("form_submit").focus();
}

function check_number() {
e_k=event.keyCode
	if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
		event.returnValue = false;
		alert("กรุณากรอกเป็นตัวเลขเท่านั้นค่ะ");
		return false;
	}else{
		return true;
	}
}

function ajaxcheck(action,str){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action='+action+'&search=' + str;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return xmlhttp.responseText;
}
//-->

	function MM_openBrWindow(theURL,winName,features) { //v2.0
 	 window.open(theURL,winName,features);
	}
</SCRIPT>

<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
		<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = (d.getFullYear() +543)+ '-' + (d.getMonth() + 1) + '-' + (d.getDate());//


		    // กรณีต้องการใส่ปฏิทินลงไปมากกว่า 1 อันต่อหน้า ก็ให้มาเพิ่ม Code ที่บรรทัดด้านล่างด้วยครับ (1 ชุด = 1 ปฏิทิน)
  $("#datepicker-th-1").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'yy-mm-dd', isBuddhist: true, defaultDate: toDay,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'yy-mm-dd', isBuddhist: true, defaultDate: toDay,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

     		    $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});

		    $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });


			});
		</script>

<body>

<h1 class="h">รายงานการใช้ Antibiotic Smart Use  โรงพยาบาลค่ายสุรศักดิ์มนตรี </h1>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">ค้นหาตาม ICD-10 :</span></td>
    <td >      <span class="f1">
      <input type="text" name="icd10"  class="forntsarabun"/>    
      </span></td>
    <td  align="right"><span class="forntsarabun">ช่วงเวลา</span><span class="f1"> :</span></td>
    <td ><? $m=date('m'); ?>
    <select name="m_start" class="forntsarabun">
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
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
                
				<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
                <?
				}
				echo "<select>";
				?></td>
    <td  align="right"><span class="forntsarabun">ประเภทผู้ป่วย :</span></td>
    <td><select name="type_an" class="forntsarabun">
      <option value="all">แสดงทั้งหมด</option>
      <option value="an1">ผู้ป่วยใน</option>
      <option value="an2">ผู้ป่วยนอก</option>
    </select></td>
  </tr>
  <tr class="forntsarabun">
    <td align="right"><span class="forntsarabun">ค้นหาตาม รหัสยา/ชื่อยา(สามัญ)/ชื่อยา(การค้า) :</span></td>
    <td>      <span class="f1">
      <INPUT ID="drug_code" TYPE="text" NAME="drugcode"  onKeyPress="searchSuggest('drug',this.value,3); " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }else if(event.keyCode == 40){document.getElementById('drug_amount').focus();}" class="forntsarabun">    
      </span></td>
    <td align="right"><span class="forntsarabun">ถึง</span><span class="f1"> :</span></td>
    <td>
    <select name="m_end" class="forntsarabun">
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
				echo "<select name='y_end' class='forntsarabun'>";
				foreach($dates as $i){

			 ?>
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
      </option>
      <?
				}
				echo "<select>";
				?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center"><div align="left" class="forntsarabun"><font color="#FF0000">* ค้นหาจาก icd10 หรือ รหัสยา หรือ ชื่อยา อย่างใดอย่างหนึ่ง</font></div><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
      <a href="../regis_asu.php">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>

<br/>
<hr>
<?
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$icd10=$_POST['icd10'];
$drugcode=$_POST['drugcode'];
$type_an=$_POST['type_an'];

$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$date2=$_POST['y_end'].'-'.$_POST['m_end'];


if($_POST['submit']!=""){
	
if($_POST['icd10']){ 		

if($icd10 !='' and $date1!='' and $date2!='' and $_POST['type_an']=="all"){/////แสดงทั้งหมด
	
$sql="SELECT  DISTINCT opday.hn,opday.an,opday.thidate,opday.ptname,opday.doctor  FROM  opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN
  druglst ON drugrx.drugcode = druglst.drugcode WHERE  opday.icd10='$icd10' and opday.thidate between '".$date1.'-'.'01'. " 00:00:00' and '".$date2.'-'.'31'." 23:59:59 ' Order by opday.thidate asc";

}
if($icd10 !='' and $date1!='' and $date2!='' and $_POST['type_an']=="an1"){///แสดงเฉพาะผู้ป่วยใน
	
$sql="SELECT  DISTINCT opday.hn,opday.an,opday.thidate,opday.ptname,opday.doctor  FROM  opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN
  druglst ON drugrx.drugcode = druglst.drugcode WHERE  opday.icd10='$icd10' and (opday.an !='' or opday.an IS NOT NULL
) and opday.thidate between '".$date1.'-'.'01'. " 00:00:00' and '".$date2.'-'.'31'." 23:59:59 ' Order by opday.thidate asc";
  
}
if($icd10 !='' and $date1!='' and $date2!='' and $_POST['type_an']=="an2"){///แสดงเฉพาะผู้ป่วยนอก
	
$sql="SELECT  DISTINCT opday.hn,opday.an,opday.thidate,opday.ptname,opday.doctor  FROM  opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN
  druglst ON drugrx.drugcode = druglst.drugcode WHERE  opday.icd10='$icd10' AND (opday.an ='' OR opday.an IS NULL
) AND opday.thidate between '".$date1.'-'.'01'. " 00:00:00' and '".$date2.'-'.'31'." 23:59:59 ' Order by opday.thidate asc";
}
$result = mysql_query($sql);
$rows=mysql_num_rows($result);

?>

<br/>
<table  border="1" cellspacing="0" cellpadding="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
  <tr class="f1">
    <td align="center" bgcolor="#339900" >ลำดับ</td>
    <td  height="48" align="center" bgcolor="#339900" ><span class="forntsarabun">HN</span></td>
    <td align="center" bgcolor="#339900" ><span class="forntsarabun">AN</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">วันที่-เวลา</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">ชื่อ - สกุล</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">แพทย์</span></td>
   
  </tr>
  <?
  if($rows>0){
  
  while($dbarr=mysql_fetch_array($result)){

	  $hn=$dbarr['hn'];
	  $thidate=substr($dbarr['thidate'],'0','10');
	  
	   $sql2="SELECT  *  FROM  opday INNER JOIN  drugrx ON opday.hn = drugrx.hn INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode WHERE  opday.hn='$hn'  and  druglst.asu='1' and drugrx.date like '%$thidate%' ";
		
		$result2 = mysql_query($sql2);
		$rows2=mysql_num_rows($result2);

		if($rows2){
			$count++;
		  $bg="#FF3366";
  	    }else{
			$count1++;
 	 	 $bg="#99FFCC";
		}


	  ?>
  <tr class="f1" bgcolor="<?=$bg;?>">
    <td align="center"><?=++$no;?></td>
    <td align="center">      <span class="forntsarabun">
      <?=$dbarr['hn'];?>    
    </span></td>
    <td align="center">      <span class="forntsarabun">
      <?=$dbarr['an'];?>    
    </span></td>
    <td align="center">      <span class="forntsarabun">
      <?=$dbarr['thidate'];?>    
    </span></td>
    <td><span class="forntsarabun"><a href="asu_detail.php?hn=<?=$dbarr['hn'];?>&&icd10=<?=$icd10;?>&&date=<?=$dbarr['thidate'];?>" target="_blank">
      <?=$dbarr['ptname'];?>
    </a></span></td>
    <td>      <span class="forntsarabun">
      <?=$dbarr['doctor'];?>  <?=$dbarr['asu'];?>    
    </span></td>
  </tr> 
  <? 
  }//while 
        }else{
			
			echo "<tr class='f1'><td colspan='5' align='center'><font color='red'>ไม่พบรายการ</font></td></tr>";
			
		}
		
		if($count==0){
		$count="0";
		}
		if($count1==0){
		$count1="0";
		}
		
		$avg1=100*$count/$rows;
		$avg2=100*$count1/$rows;
		
		$avg1=number_format($avg1,2);
		$avg2=number_format($avg2,2);

		
		
		echo "<h1 class='forntsarabun'>สัดส่วนการใช้ยา ASU</h1>";
		echo "<span class='forntsarabun'>รวมทั้งหมด: ".$rows."&nbsp;ราย&nbsp;&nbsp;คิดเป็น&nbsp;100%</span><br/>";
		
		echo "<font style='background-color: #FF3366;' color='#000000'><span class='forntsarabun'>ใช้ยา ASU : ".$count."&nbsp;ราย&nbsp;&nbsp;คิดเป็น&nbsp;$avg1%</span></font><br/>";
		echo "<font style='background-color: #99FFCC;' color='#000000'><span class='forntsarabun'>ไม่ได้ใช้ยา ASU : ".$count1."&nbsp;ราย&nbsp;&nbsp;คิดเป็น&nbsp;$avg2%</span></font><br/>";
		
		
  ?>
  </table>
 

<?
}elseif($_POST['drugcode']){ 
  
if($drugcode !='' and($date1!='' and $date2!='' and $_POST['type_an']=="all")){
		
$sql="SELECT *  FROM drugrx
INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode
WHERE  drugrx.drugcode='$drugcode' and drugrx.date between '".$date1.'-'.'01'. " 00:00:00' and '".$date2.'-'.'31'." 23:59:59 ' ";
}
if($drugcode !='' and($date1!='' and $date2!='' and $_POST['type_an']=="an1")){
		
$sql="SELECT *  FROM drugrx
INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode
WHERE  drugrx.drugcode='$drugcode' and (drugrx.an !='' and drugrx.an IS NOT NULL) and drugrx.date between '".$date1.'-'.'01'. " 00:00:00' and '".$date2.'-'.'31'." 23:59:59 ' ";
}
if($drugcode !='' and($date1!='' and $date2!='' and $_POST['type_an']=="an2")){
		
$sql="SELECT *  FROM drugrx
INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode
WHERE  drugrx.drugcode='$drugcode' and (drugrx.an ='' or drugrx.an IS NULL) and drugrx.date between '".$date1.'-'.'01'. " 00:00:00' and '".$date2.'-'.'31'." 23:59:59 ' ";
}
$result = mysql_query($sql);
$rows=mysql_num_rows($result);




?>

<table  border="1" cellspacing="0" cellpadding="0" bordercolorlight="#FFFFFF" bordercolordark="#000000" >
  <tr class="f1" >
    <td  height="48" align="center" bgcolor="#339900" ><span class="forntsarabun">HN</span></td>
    <td align="center" bgcolor="#339900" ><span class="forntsarabun">AN</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">วันที่-เวลา</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">รหัสยา</span></td>
    <td align="center" bgcolor="#339900" ><span class="forntsarabun">ชื่อยา (การค้า)</span></td>
    <td align="center" bgcolor="#339900" class="forntsarabun" >วิธีใช้ยา</td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">ราคากลาง</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">ราคาทุน</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">ราคาขาย</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">จำนวน</span></td>
    <td align="center" bgcolor="#339900" ><span class="forntsarabun">มูลค่าทุน</span></td>
    <td align="center" bgcolor="#339900" ><span class="forntsarabun">มุลค่าขาย</span></td>
    <td  align="center" bgcolor="#339900" ><span class="forntsarabun">ประเภทยา</span></td> 
  </tr>
  <?
  if($rows>0){
	  
  while($dbarr=mysql_fetch_array($result)){
	  
	  if($dbarr['asu']=='1'){
		  $count++;
	  $bg="#FF3366";
  	  }else{
		  $count1++;
 	  $bg="#99FFCC";
	  }
	  
	  
	  ?>
  <tr class="f1" bgcolor="<?=$bg;?>">
    <td align="center"><span class="forntsarabun">
      <a href="asu_detail.php?hn=<?=$dbarr['hn'];?>&&date=<?=$dbarr[1];?>" target="_blank"><?=$dbarr['hn'];?></a>
    </span></td>
    <td align="center"><span class="forntsarabun">
      <?=$dbarr['an'];?>
    </span></td>
    <td align="center"><span class="forntsarabun">
      <?=$dbarr[1];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['drugcode'];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['tradname'];?>
    </span></td>
    <td align="center"><span class="forntsarabun"><a href="javascript:MM_openBrWindow('drug_detail.php?slcode=<?=$dbarr['slcode'];?>','','width=900,height=250')">
      <?=$dbarr['slcode'];?>
    </a></span></td>
    <td align="center"><span class="forntsarabun">
      <?=$dbarr['edpri'];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['unitpri'];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['salepri'];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['amount'];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['unitpri']*$dbarr['amount'];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['salepri']*$dbarr['amount'];?>
    </span></td>
    <td><span class="forntsarabun">
      <?=$dbarr['part'];?>
    </span></td>
  </tr>
  <? 
  $unitpri+=$dbarr['unitpri'];
  $salepri+=$dbarr['salepri'];
  $amount+=$dbarr['amount'];
  $sumunitpri+=$dbarr['unitpri']*$dbarr['amount'];
  $sumsalepri+=$dbarr['salepri']*$dbarr['amount'];
  } //while
  ?>
  <tr class="f1">
    <td colspan="7" align="right">รวม :</td>
    <td><?=number_format($unitpri,2);?></td>
    <td><?=number_format($salepri,2);?></td>
    <td><?=number_format($amount,'',';',',');?></td>
    <td><?=number_format($sumunitpri,2);?></td>
    <td><?=number_format($sumsalepri,'',';',',');?></td>
    <td>&nbsp;</td>
  </tr>
  <?
  }else{
			
			echo "<tr class='f1'><td colspan='13' align='center'><font color='red'>ไม่พบรายการ</font></td></tr>";
			
		}
		
		if($count==0){
		$count="0";
		}
		if($count1==0){
		$count1="0";
		}
		
		$avg1=100*$count/$rows;
		$avg2=100*$count1/$rows;
		
		echo "<h1 class='forntsarabun'>สัดส่วนการใช้ยา ASU</h1>";
		echo "<span class='forntsarabun'>รวมทั้งหมด: ".$rows."&nbsp;ราย&nbsp;&nbsp;คิดเป็น&nbsp;100%</span><br/>";
		
		echo "<font style='background-color: #FF3366;' color='#000000'><span class='forntsarabun'>ใช้ยา ASU : ".$count."&nbsp;ราย&nbsp;&nbsp;คิดเป็น&nbsp;$avg1%</span></font><br/>";
		echo "<font style='background-color: #99FFCC;' color='#000000'><span class='forntsarabun'>ไม่ได้ใช้ยา ASU : ".$count1."&nbsp;ราย&nbsp;&nbsp;คิดเป็น&nbsp;$avg2%</span></font><br/>";
  
  ?>
  </table>
  <? 
  } //
  }
  
  

  ?>
<Div id="list" style="left:240PX;top:80PX;position:absolute;"></Div>
</body>
</html>