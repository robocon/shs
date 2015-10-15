<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานสมุดทะเบียนใบรับรองแพทย์</title>
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<link rel="stylesheet" href="css/style.css" />
<style type="text/css">
.font1 {
	font-family:"TH SarabunPSK";
	font-size:20pt;
	src: url("surasak3/TH SarabunPSK.ttf");
}
.font2 {
	font-family:"TH SarabunPSK";
	font-size:14pt;
	src: url("surasak3/TH SarabunPSK.ttf");
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
</style>
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

</script>
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
					parent.location.href = parent.location.reload();
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
<body>
<div id="no_print">
<h1 class="font1">สมุดทะเบียนใบรับรองแพทย์</h1>

<fieldset class="font1" style="width:80%">
  <legend>ค้นหา HN </legend>
  <form id="form1" name="form1" method="post"  onSubmit="JavaScript:return fncSubmit();">
  <input name="act" type="hidden" value="show" />
  <table border="0" align="center">
    <tr>
      <td>ค้นหาจาก</td>
      <td><select name="seach" class="font1">
      <option value="bookid">เล่มที่</option>
      <option value="noid">เลขที่</option>
      <option value="hn">HN</option>
       <option value="ptname">ชื่อ-สกุล</option>
       <option value="all">ทั้งหมด</option>
      </select>
      </td>
      <td>ระบุ</td>
      <td>
      <input name="key" type="text" class="font1" id="key" value="<?=$_POST['key'];?>" size="30" /></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" />
      <a target=_self  href='../nindex.htm'> ไปเมนู </a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />
</div>
<?

	
include("connect.inc");
if($_POST["act"]=="show"){
	$fil=$_POST['seach'];
	$key=$_POST['key'];

	$where="";
	if($fil=='ptname'){
	$where="where ".$fil." like '%".$key."%'  and status='Y' order by  bookid  asc ,noid asc";
	}elseif($fil=='bookid' || $fil=='noid' || $fil=='hn'){
	$where="where ".$fil." ='".$key."'  and status='Y' order by bookid  asc ,noid asc";
	}elseif($fil=='all') {
	$where="where 1 and status='Y' order by bookid  asc ,noid asc";
	}else{
	$where="where 1 and status='Y' order by bookid  asc ,noid asc";
	}

	$sql="select * from certificate ".$where."";
	$query=mysql_query($sql) or die (mysql_error());
	$numrow=mysql_num_rows($query);
	
	?>
<br />
<br />
  <h1 class="font1" align="center">สมุดทะเบียนใบรับรองแพทย์</h1>
  <div align="right" class="font2">เล่มที่ <?=$key;?> ห้องตรวจโรคที่.........</div>
  <table width="100%" border="1" style="border-collapse:collapse; border-color:#000;" cellpadding="3" cellspacing="0" class="font2">
  <tr bgcolor="#999999">
    <td align="center">เล่มที่</td>
    <td align="center">เลขที่</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">แพทย์</td>
    <td align="center">การวินิจฉัย</td>
    <td align="center">ความคิดเห็น</td>
    <td align="center">ว/ด/ป ที่ออก</td>
 	<td colspan="2" align="center" id="no_print">จัดการ</td>
  </tr>
  <? 
  $r=0;
   while($arr=mysql_fetch_array($query)){ ?>

  <?
  
  $r++;
  	  if($r=='26'){
		 $r=1;
		echo "</table>";
		echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
		echo "<div align='right' class='font2'>เล่มที่  $key ห้องตรวจโรคที่.........</div>";
		echo "<table width=\"100%\" border=\"1\" style=\"border-collapse:collapse; border-color:#000;\" cellpadding=\"3\" cellspacing=\"0\" class=\"font2\">
  <tr bgcolor=\"#999999\">
    <td align=\"center\">เล่มที่</td>
    <td align=\"center\">เลขที่</td>
    <td align=\"center\">HN</td>
    <td align=\"center\">ชื่อ-สกุล</td>
    <td align=\"center\">แพทย์</td>
    <td align=\"center\">การวินิจฉัย</td>
    <td align=\"center\">ความคิดเห็น</td>
    <td align=\"center\">ว/ด/ป ที่ออก</td>
	<td colspan=\"2\" align=\"center\" id=\"no_print\">จัดการ</td>
  </tr>";
?>


<? } ?>
    <tr>
    <td align="center"><?=$arr['bookid']?></td>
    <td align="center"><?=$arr['noid']?></td>
    <td><?=$arr['hn']?></td>
    <td><?=$arr['ptname']?></td>
    <td><?=substr($arr['doctor'],5)?></td>
    <td><?=$arr['diag']?></td>
    <td><?=$arr['comment']?></td>
    <td><?=$arr['thaidate']?></td>

    <td align="center" id="no_print"><a id="edit" href="certificate_editform.php?row_id=<?=$arr['row_id']?>" target="_blank">แก้ไข</a></td>
    <td align="center" id="no_print"><a  id="delete" href="certificate_delete.php?row_id=<?=$arr['row_id']?>" target="_blank">ลบ</a></td>
    </tr>
  
  <? }
  
  echo "</div>";
echo "</div>";
   ?>
</table>
<?
}
?>


</body>
</html>