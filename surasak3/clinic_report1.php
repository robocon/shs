<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานสมุดทะเบียนใบรับรองแพทย์</title>
	
<style type="text/css">

/* CSS Rest */
/* http://meyerweb.com/eric/tools/css/reset/
v2.0 | 20110126
License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

/* Your Style */
@font-face{
	font-family: 'Trirong-Regular';
	src: url('fonts/webfont/Trirong-Regular.eot');
	src: url('fonts/webfont/Trirong-Regular.eot#iefix'),
	url('fonts/webfont/Trirong-Regular.woff') format('embedded-opentype'),
	url('fonts/webfont/Trirong-Regular.ttf') format('truetype');
	/*url('fonts/webfont/Trirong-Regular.svg#ludger_duvernayregular') format('svg');*/
	font-weight: normal;
	font-style: normal;
}

body{
	padding: 0;
}
body, td, th, h1, h2, h3, legend{
	font-family: 'Trirong-Regular';
	font-size: 1em;
}
select, input, button{
	font-family: 'Trirong-Regular';
	font-size: 1em;
}
fieldset{
	border: 1px solid #000000;
	padding: 0.2em;
}
fieldset legend{
	padding: 0.5em;
	margin-left: 0.5em;
}
b, strong, h1, h2, h3{
	font-weight: bold;
}

.shs-table{
	width: 100%;
	border-left: 1px solid #000000;
	border-top: 1px solid #000000;
}
.shs-table td,
.shs-table th{
	border-right: 1px solid #000000;
	border-bottom: 1px solid #000000;
	column-span: none;
	padding: 0.3em;
	vertical-align: bottom;
}
.shs-table th{
	background-color: #EDEDED;
	font-weight: bold;
	vertical-align: middle;
}
.shs-header{
	font-size: 1.4em;
	padding: 0.2em;
}
.footer-sign td{
	padding: 0.2em;
}

@media print{
	.new-page{
		page-break-before: always; 
		page-break-inside: avoid;
	}
	body{
		padding-left: 10px;
		font-size: 0.8em;
	}
	
	body, td, th, h1, h2, h3, legend{
		padding-left: 10px;
		/*font-family: 'Trirong-Regular';
		font-size: 1em;*/
	}
	.shs-header{
		font-size: 1.2em;
		padding: 0.2em;
	}
	#no_print{
		display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000;
color: #FFF; 
} 
</style>
<? include("connect.inc"); ?>
<script type="text/javascript">
		$(document).ready(function() {
	

			$('a[id^="edit"]').fancybox({
				'width'				: '100%',
				'height'			: '50%',
				'autoScale'     	: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe',
				onClosed	:	function() {
					//parent.location.reload(true); 
					//parent.location.reload() = parent.opener.location;
					//parent.location.href = parent.location.reload();
				}
			});

			$('a[id^="delete"]').fancybox({
				'width'				: '20%',
				'height'			: '20%',
				onStart		:	function() {
					return window.confirm('Do you want to delete?');
				},
				onClosed	:	function() {
					//parent.location.reload(true); 
					//parent.opener.location.href = parent.opener.location;
					parent.location.href = parent.location.reload();
				}
			});

			/*
				onStart		:	function() {
					return window.confirm('Continue?');
				},
				onCancel	:	function() {
					alert('Canceled!');
				},
				onComplete	:	function() {
					alert('Completed!');
				},
				onCleanup	:	function() {
					return window.confirm('Close?');
				},
				onClosed	:	function() {
					alert('Closed!');
				}
				*/

		});
	</script>

</head>
<script language="javascript">
function fncSubmit(){
	if(document.form1.cHn.value==""){
		
		alert("กรุณาระบุ HN ด้วยครับ");
		document.form1.cHn.focus();
		return false;
	}
	document.form1.submit();
}

function fncSubmit2(){
	if(document.form2.doctor.value==""){
		
		alert("กรุณาเลือกชื่อ doctor");
		document.form2.doctor.focus();
		return false;
	}
	document.form2.submit();
}


function chkvalue(){
	
	var name=document.getElementById('doctor').value;
	
	document.getElementById('name').value=name ;
	
}
// onSubmit="JavaScript:return fncSubmit();"

function showHide1(obj){
var txt = obj.options[obj.selectedIndex].value;
var objseach=document.form1.seach;

var div1 = document.getElementById('text1').style;

var div3 = document.getElementById('text3').style;
if(txt=='thidate'){
div1.visibility ='visible';
div1.display = 'inline';

div3.visibility ='visible';
div3.display = 'none';


//objseach.options[objseach.length].selected = true;


}
else if(txt=='hn' || txt=='ptname' ){
div3.visibility ='visible';
div3.display = 'inline';


div1.visibility ='visible';
div1.display = 'none';
//objseach.options[objseach.length].selected = true;
}

else{

div1.visibility ='visible';
div1.display = 'none';

div3.visibility ='visible';
div3.display = 'none';


}
}

</script>



<body>
<div id="no_print">
<h1 class="font1">คลินิกพิเศษนอกเวลาราชการ</h1>

<fieldset class="font1" style="width: 80%">
  <legend>ค้นหา  </legend><form id="form1" name="form1" method="post" text-align: center;>
  <table border="0" align="center" style="margin-left: auto; margin-right: auto;">
    <tr>
      <td>ค้นหาจาก วันที่<!--<select name="seach" class="font1" id="seach"  disabled="disabled">
      <option value="">----กรุณาเลือก-----</option>
      <option value="thidate" selected="selected">วันที่</option>
    <option value="time">ช่วงเวลา</option>
      <option value="hn">HN</option>
       <option value="ptname">ชื่อ-สกุล</option>
       <option value="all">ทั้งหมด</option>
      </select>-->      </td>
      <td>ระบุ</td>
      <td>
<!--      <span id="text1" style="display:none">
-->      <select name='d_start' class="font1">
    			 <? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					if($dd==$d){
					?>
                    
                    <option value="<?=$d;?>" selected><?=$d;?></option>
				<?
					}else{
				?>
                <option value="<?=$d;?>"><?=$d;?></option>
                <?
				}
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
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "</select>";
				?>
                ช่วงเวลา 
    <select name='time' class="font1" >
    <option value="08.00-12.00">08.00-12.00</option>
    <option value="08.00-16.00">08.00-16.00</option>
    <option value="09.00-15.00">09.00-15.00</option>
    <option value="10.30-14.00">10.30-14.00</option>
    <option value="16.00-20.00">16.00-20.00</option>
    </select>
      <!--</span>-->
     <!--   <span id="text3" style="display:none">
 <input name="key" type="text" class="font1" id="key" value="<?=$_POST['key'];?>" size="30" />
    
      </span>-->

      </td>
    </tr>
    <tr>
      <td colspan="2" align="right">แพทย์: </td>
      <td><select name="doctor" id="doctor">
        <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" />
      <a target=_self  href='../nindex.htm'> ไปเมนู </a> &nbsp;&nbsp; <a href="clinic_vip.php">เพิ่มข้อมูล</a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />
</div>
<?
if($_POST['button']){
	




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

 $dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	
	
	
	$fil=$_POST['seach'];
	$key=$_POST['key'];
	
	

	// $where="";
	
	//if($fil=='thidate'){
		
	$thidate=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
	// $where="where thidate = '".$thidate."' and time ='".$_POST['time']."'  and doctor ='".$_POST['doctor']."' and status='Y' order by row_id asc";
	
	//}/*elseif($fil=='time'){
		
	/*$time=$_POST['time'];
	$where="where ".$fil." = '".$time."'   order by row_id asc";*/
	
	/*}elseif($fil=='ptname' || $fil=='hn'){
	$where="where ".$fil." like '%".$key."%'   and status='Y' order by row_id asc";
	}elseif($fil=='all') {
	$where="where 1 and status='Y'  order by row_id  asc";
	}else{
	$where="where 1  and status='Y' order by row_id  asc";
	}*/

	$sql="SELECT a.*,b.ptright 
	FROM clinic_vip AS a 
	LEFT JOIN opcard AS b ON b.hn=a.hn
	WHERE a.thidate LIKE '$thidate' 
	AND a.time ='".$_POST['time']."' 
	AND a.doctor ='".$_POST['doctor']."' 
	AND a.status='Y' ORDER BY a.row_id ASC";
	
	$query=mysql_query($sql) or die (mysql_error());
	$numrow=mysql_num_rows($query);
	
//	echo $sql;
	?>

  <h1 class="font1 shs-header" align="center">คลินิกพิเศษนอกเวลาราชการ</h1>
<? //if($fil=='thidate'){ ?>
<h2 class="font3 shs-header" align="center">วันที่ <?=$dateshow;?> เวลา <?=$_POST['time'];?>  ห้องตรวจโรคกระดูกและข้อ</h2>
<? //} ?>
<!--<?//if($fil=='hn'){ ?>
  <h2 class="font3" align="center">HN<?//=$key;?>ห้องตรวจโรคผู้ป่วยนอก</h2>
<?//} ?>-->
<table border="1" style="border-collapse:collapse; border-color:#000;" cellpadding="0" cellspacing="0" class="font2 shs-table" width="100%" align="center">
  <tr bgcolor="#999999">
    <td align="center"  width="7%">ลำดับ</td>
    <td colspan="2" align="center" width="47%">ชื่อ - สกุล</td>
    <td align="center" width="13%">HN</td>
	<td align="center" width="20%">สิทธิ์</td>
    <td align="center" width="13%">AN</td>
    <td colspan="2" align="center" id="no_print">จัดการ</td>

  </tr>
  <? 
  $run=1;
  $r=0;
   while($arr=@mysql_fetch_array($query)){ 
   
   $yot=$arr['yot'];
   $doctor=substr($arr['doctor'],5);
   
   global  $yot,$doctor;



  $r++;
  	  if($r=='31'){
$r=1;


echo "<table width='100%' border='0' align='center' class='font2 footer-sign'>
  <tr>
    <td align='center' width='40%'><br>ผู้บันทึก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align='center' width='40%' >&nbsp;</td>
  </tr>
  <tr>
    <td align='center'>พ.ต.หญิง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align='center'>$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align='center'>( บุญทิวา เนียมทอง )</td>
    <td align='center'>($doctor)</td>
  </tr>
  <tr>
    <td align='center'>หัวหน้าห้องตรวจโรคผู้ป่วยนอก</td>
    <td align='center'>แพทย์ผู้รักษา</td>
  </tr>
  <tr>
    <td align='center'>........./............/.........</td>
    <td align='center'>........./............/.........</td>
  </tr>
</table>";

		echo "</table>";
		
		// echo "<div style='page-break-after: always'> ";
		echo "<div class=\"new-page\"></div>";
		echo "<h1 class='font1 shs-header' align='center'>คลินิกพิเศษนอกเวลาราชการ</h1>";
		echo "<h2 class='font3 shs-header' align='center'>วันที่  $dateshow เวลา $_POST[time]  ห้องตรวจโรคกระดูกและข้อ</h2>";
		
		echo "<table width=\"100%\" border=\"1\" style=\"border-collapse:collapse; border-color:#000;\" cellpadding=\"0\" cellspacing=\"0\" class=\"font2 shs-table\" align='center'>
  <tr bgcolor=\"#999999\">
    <td align=\"center\" width=\"7%\">ลำดับ</td>
    <td colspan='2' align='center' width=\"47%\">ชื่อ - สกุล</td>
    <td align=\"center\" width=\"13%\">HN</td>
	<td align=\"center\" width=\"20%\">สิทธิ์</td>
    <td align=\"center\" width=\"13%\">AN</td>
    <td align=\"center\" id='no_print' colspan='2' id=\"no_print\">จัดการ</td>

  </tr>";
?>


<? } 
$name=explode(" ",$arr['ptname']);
$fname=$name[0];
$lname = substr($arr['ptname'],strlen($fname)+1);
?>
    <tr>
    <td align="center"><?=$run;?></td>
    <td style='border-right-style:none'>&nbsp;<?=$fname?></td>
    <td style="border-left-style:none"><?=$lname?></td>
    <td>&nbsp;<?=$arr['hn']?></td>
	<td>&nbsp;<?php 
		echo str_replace('โครงการ', '', substr($arr['ptright'], 4));
	?></td>
    <td>&nbsp;<?=$arr['an']?></td>
    <td align="center" id="no_print"><a id="edit" class="various iframe" href="clinic_editform.php?row_id=<?=$arr['row_id']?>">แก้ไข</a></td>
    <td align="center" id="no_print"><a id="delete" class="various iframe" href="clinic_delete.php?row_id=<?=$arr['row_id']?>">ลบ</a></td>
    </tr>
  
  <?
  $run++;
   } // End while

//echo "</div>";
// echo "</div>";
   ?>
</table>
<BR />
<table width="100%" border="0" align="center" class="font2 footer-sign">
  <tr>
    <td align="center" width="40%">ผู้บันทึก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" width="40%" >&nbsp;</td>
  </tr>
  <tr>
    <td align="center">พ.ต.หญิง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center"><?=$yot;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="center">( บุญทิวา เนียมทอง )</td>
    <td align="center">(<?=$doctor;?>)</td>
  </tr>
  <tr>
    <td align="center">หัวหน้าห้องตรวจโรคผู้ป่วยนอก</td>
    <td align="center">แพทย์ผู้รักษา</td>
  </tr>
  <tr>
    <td align="center">........./............/.........</td>
    <td align="center">........./............/.........</td>
  </tr>
</table>
<? }?>

</body>
</html>