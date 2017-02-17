<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

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
<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าแรก</span></a></li>
        <li><a href="gward_report_doctor.php" class="parent"><span>รายงานผู้ป่วยในตามแพทย์</span></a></li>
		<li><a href="report_wardlog.php" class="parent"><span>รายงานการเปลี่ยนข้อมูลผู้ป่วย</span></a></li>

     	
        <li><a href="#"><span>สถิติหอผู้ป่วยประจำเดือน</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_fward.php"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_gward.php"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_icuward.php"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_vipward.php"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
        <li><a href="#"><span>Diagnosis ประจำปี</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_icd10_ofyear.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_icd10_ofyear.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_icd10_ofyear.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_icd10_ofyear.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
        <li><a href="#"><span>Diagnosis Top5 ประจำปี</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_icd10_top5.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_icd10_top5.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_icd10_top5.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_icd10_top5.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
         <li><a href="#"><span>รายงานผู้ป่วยเสียชีวิต</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_dead.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
	  	<li class="last"><a href="report_dead.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
          	<li class="last"><a href="report_dead.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
              	<li class="last"><a href="report_dead.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
       	</ul>
        <li><a href="report_age15.php" class="parent"><span>รายชื่อเด็กอายุต่ำกว่า 15ปี</span></a></li>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<?

include("../connect.inc");

?>
<style type="text/css">
<!--
.texticd {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.textH1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
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
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
	  <tr class="texticd">
	    <td colspan="2" align="center" bgcolor="#99CC99">Diagnosis หอผู้ป่วย</td>
      </tr>
	  <tr class="texticd">
	    <td  align="right">ปี</td>
	    <td><? 
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
      </tr>
	  <tr>
	    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>
	      &nbsp;&nbsp;
	      <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">--></td>
      </tr>
    </table>
  </form>
</div>


<?  
if($_POST['submit']){
	
	
$lbedcode=$_GET['code'];
	
	if($lbedcode=='42'){
$wardname="หอผู้ป่วยรวม";	
$sortname="รวม";
	}elseif($lbedcode=='43'){
$wardname="หอผู้ป่วยสูติ";	
$sortname="สูติ";
	}elseif($lbedcode=='44'){
$wardname="หอผู้ป่วยICU";	
$sortname="ICU";
	}elseif($lbedcode=='45'){
$wardname="หอผู้ป่วยพิเศษ";	
$sortname="พิเศษ";
	}

 ///icd10,diag,count(icd10) as count,dcdate
$sqlicd10 = "CREATE TEMPORARY TABLE ipcard01 SELECT *  FROM  ipcard  WHERE dcdate like '".$_POST['y_start']."-%'  and bedcode  like '$lbedcode%' and icd10 !='' ";
$result = Mysql_Query($sqlicd10 ) or die(mysql_error());

/*	$sqlicd10 = "CREATE TEMPORARY TABLE ipcard01 SELECT a.bedcode,b.icd10,b.diag FROM  ipcard as a LEFT JOIN diag as b ON a.an=b.an WHERE b.type = 'PRINCIPLE' and a.bedcode like '42%' and a.date like '2555%' ";
	$result = Mysql_Query($sqlicd10 ) or die(mysql_error());
	//year now
	//$listicd = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		$selectsql = "SELECT count(*) FROM ipcard01 where date like '".(date("Y")+543)."-".$m."-%' ";
		$result = Mysql_Query($selectsql);
		$arr = mysql_fetch_array($result);
	//	array_push($listicd,$arr[0]);
	}*/
	
/*$sql1="SELECT a.bedcode, b.icd10, b.diag ,count(b.icd10)as count
FROM ipcard AS a
LEFT  JOIN diag AS b ON a.an = b.an
WHERE b.type =  'PRINCIPLE' AND a.bedcode
LIKE  '42%' AND a.date
LIKE  '2555%' GROUP BY b.icd10 order by count desc";*/

$sqla="SELECT  icd10,diag,count(icd10) as count,dcdate  FROM  ipcard01 Group by icd10  Order by count desc";
$resulta = Mysql_Query($sqla)or die (mysql_error())	;




?>
	
    <BR />
<h1 class="textH1"  align="center"/>
Diagnosis <?=$wardname;?> ปี 
<?=$_POST['y_start']?></h1>
<table border="1" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;" bordercolor="#000000">
<tr>
  <td  rowspan="2" align="center" bgcolor="#66CC66" class="texticd"><div align="center"><strong>Diagnosis</strong></div></td>
<td colspan="13" align="center" bgcolor="#66CC66" class="texticd"><strong>ปี <?=$_POST['y_start']?>
</strong></td>
</tr>
<tr>
  <td width="48" align="center" bgcolor="#66CC66" class="texticd"><strong>ม.ค.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>ก.พ.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>มี.ค.</strong></td>
  <td width="59" align="center" bgcolor="#66CC66" class="texticd"><strong>เม.ย.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>พ.ค.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>มิ.ย.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>ก.ค.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>ส.ค.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>ก.ย.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>ต.ค.</strong></td>
  <td width="51" align="center" bgcolor="#66CC66" class="texticd"><strong>พ.ย.</strong></td>
  <td width="62" align="center" bgcolor="#66CC66" class="texticd"><strong>ธ.ค.</strong></td>
  <td width="62" align="center" bgcolor="#66CC66" class="texticd">รวม</td>
</tr>
<? 

$i=0;
while($arr=mysql_fetch_array($resulta)){ 
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}
$sicd10="SELECT detail FROM `icd10` WHERE code='".$arr['icd10']."' ";
		$sresult = mysql_query($sicd10)or die(mysql_error());
		$sarr  = mysql_fetch_array($sresult);

?>
<tr>
  <td class="texticd" bgcolor="<?=$bg;?>"><?=$sarr['detail'];?>&nbsp;  [&nbsp;<?=$arr['icd10'];?>&nbsp;]</td>
<?		
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;	
		
		$selectsql1 = "SELECT count(icd10)as count1 FROM ipcard01 where dcdate like '".$_POST['y_start']."-$m-%' and icd10='".$arr['icd10']."' ";
		$result1 = mysql_query($selectsql1)or die(mysql_error());
		$arr1  = mysql_fetch_array($result1);
		
		
	//	echo $selectsql1."<br>";
		
		
?>

  <td align="center" class="texticd" bgcolor="<?=$bg;?>"><?=$arr1['count1'];?>&nbsp;</td>

<?	

	}
?>
<td align="center" class="texticd" bgcolor="<?=$bg;?>"><?=$arr['count'];?>&nbsp;</td>
</tr>
<?
 }?>
</table>


<? }// post ==submit ?>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>