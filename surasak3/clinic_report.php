<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ��ش����¹��Ѻ�ͧᾷ��</title>
	<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<!--<link rel="stylesheet" href="css/style.css" />-->
<style type="text/css">

.font1 {
	font-family:"TH SarabunPSK";
	font-size:18pt;
	/*src: url("surasak3/TH Niramit AS.ttf");*/
}
.font3 {
	font-family:"TH SarabunPSK";
	font-size:16pt;
	/*src: url("surasak3/TH Niramit AS.ttf");*/
}
.font2 {
	font-family:"TH SarabunPSK";
	font-size:14pt;
	/*src: url("surasak3/TH Niramit AS.ttf");*/
}
@media print{
	body{
		padding-left: 10px;
	}
	.font1 {
		font-family:"TH SarabunPSK";
		font-size:14pt;
	}
	.font3 {
		font-family:"TH SarabunPSK";
		font-size:12pt;
	}
	.font2 {
		font-family:"TH SarabunPSK";
		font-size:10pt;
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
<?php include("connect.inc"); ?>
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
		
		alert("��س��к� HN ���¤�Ѻ");
		document.form1.cHn.focus();
		return false;
	}
	document.form1.submit();
}

function fncSubmit2(){
	if(document.form2.doctor.value==""){
		
		alert("��س����͡���� doctor");
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
<h1 class="font1">��Թԡ����ɹ͡�����Ҫ���</h1>

<fieldset class="font1" style="width:100%">
  <legend>����  </legend><form id="form1" name="form1" method="post">
  <table border="0" align="center">
    <tr>
      <td>���Ҩҡ �ѹ���<!--<select name="seach" class="font1" id="seach"  disabled="disabled">
      <option value="">----��س����͡-----</option>
      <option value="thidate" selected="selected">�ѹ���</option>
    <option value="time">��ǧ����</option>
      <option value="hn">HN</option>
       <option value="ptname">����-ʡ��</option>
       <option value="all">������</option>
      </select>-->      </td>
      <td>�к�</td>
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
                ��ǧ���� 
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
      <td colspan="2" align="right">ᾷ���Ǩ: </td>
      <td><select name="doctor" id="doctor">
        <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
      </select></td>
    </tr>
	<?php /* ?>
	<tr>
		<td colspan="2" align="right">ᾷ�������ʴ���: </td>
		<td>
			<select name="doctor2" id="doctor2">
				<option value="">-- ��س����͡ᾷ�� --</option>
				<option value="��ͧ��Ǩ�ä�����">��ͧ��Ǩ�ä�����</option>
				<?php 
				$sql = "SELECT `name` FROM `doctor` WHERE `status` = 'y' ";
				$result = mysql_query($sql);
				while(list($name) = mysql_fetch_row($result)){
					echo "<option value=\"$name\">$name</option>";
				}
				?>
			</select>
		</td>
	</tr>
	<?php */ ?>
    <tr>
      <td colspan="3" align="center"><input name="button" type="submit" class="font1" id="button" value="��ŧ" />
      <a target=_self  href='../nindex.htm'> ����� </a> &nbsp;&nbsp; <a href="clinic_vip.php">����������</a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />
</div>
<?
if($_POST['button']){
	




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

 $dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	
	
	
	$fil=$_POST['seach'];
	$key=$_POST['key'];
	
	

	// $where="";
	
	//if($fil=='thidate'){
		
	$thidate = $_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
	// $where = "where thidate = '".$thidate."' and time ='".$_POST['time']."'  and doctor ='".$_POST['doctor']."' and status='Y' order by row_id asc";
	
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

	$sql="SELECT a.*,b.ptright FROM clinic_vip AS a
	LEFT JOIN opcard AS b ON b.hn=a.hn
	WHERE a.thidate = '".$thidate."' 
	AND a.time = '".$_POST['time']."' 
	AND a.doctor = '".$_POST['doctor']."' 
	AND a.status = 'Y' ORDER BY a.row_id ASC";
	
	$query=mysql_query($sql) or die (mysql_error());
	$numrow=mysql_num_rows($query);
	
//	echo $sql;
	?>

  <h1 class="font1" align="center">��Թԡ����ɹ͡�����Ҫ���</h1>
<? //if($fil=='thidate'){ ?>
<h2 class="font3" align="center">�ѹ��� <?=$dateshow;?> ���� <?=$_POST['time'];?>
  ��ͧ��Ǩ�ä�����¹͡</h2>
<? //} ?>
<!--<?//if($fil=='hn'){ ?>
  <h2 class="font3" align="center">HN<?//=$key;?>��ͧ��Ǩ�ä�����¹͡</h2>
<?//} ?>-->
<table border="1" style="border-collapse:collapse; border-color:#000;" cellpadding="0" cellspacing="0" class="font2" width="100%" align="center">
  <tr bgcolor="#999999">
    <td align="center"  width="7%">�ӴѺ</td>
    <td colspan="2" align="center" width="47%">���� - ʡ��</td>
    <td align="center" width="13%">HN</td>
	<td align="center" width="20%">�Է���</td>
    <td align="center" width="13%">AN</td>
    <td colspan="2" align="center" id="no_print">�Ѵ���</td>

  </tr>
  <?php
  $doctor_replace = false;
  $yot_replace = false;
  $doctor2 = ( isset($_POST['doctor2']) && $_POST['doctor2'] != '' ) ? trim($_POST['doctor2']) : false ;
	if( $doctor2 !== false ){
		
		$where = " `name` = '$doctor2'";
		if( preg_match('/�\.\d+/', $doctor2, $matchs) > 0 ){
			$dr_code = substr($matchs['0'], 2);
			
			$where = " `doctorcode` = '$dr_code'";
		}
		
		$sql = "SELECT `yot`,`yot2`,`name` FROM `doctor` WHERE $where";
		$q = mysql_query($sql) or die( mysql_error() );
		$item = mysql_fetch_assoc($q);
		$doctor2 = $item['name'];
		
		$doctor_replace = substr($doctor2, 5);
		$yot_replace = $item['yot'];
		if(empty($item['yot'])){
			$yot_replace = $item['yot2'];
		}
		
	}
  
  $run=1;
  $r=0;
   while($arr=@mysql_fetch_array($query)){ 
   
   if( $yot_replace !== false ){
	   $yot = $yot_replace;
   }else{
	   $yot = $arr['yot'];
   }
   
   
   if( $doctor_replace !== false ){
	   $doctor = $doctor_replace;
   }else{
	   $doctor=substr($arr['doctor'],5);
   }
   
   
   global  $yot,$doctor;



  $r++;
  	  if($r=='31'){
$r=1;


echo "<table width='100%' border='0' align='center' class='font2'>
  <tr>
    <td align='center' width='40%'><br>���ѹ�֡&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align='center' width='40%' >&nbsp;</td>
  </tr>
  <tr>
    <td align='center'>�.�.˭ԧ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align='center'>$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align='center'>( �ح���� �����ͧ )</td>
    <td align='center'>($doctor)</td>
  </tr>
  <tr>
    <td align='center'>���˹����ͧ��Ǩ�ä�����¹͡</td>
    <td align='center'>ᾷ�����ѡ��</td>
  </tr>
  <tr>
    <td align='center'>........./............/.........</td>
    <td align='center'>........./............/.........</td>
  </tr>
</table>";

		echo "</table>";
		
		//echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
		echo "<h1 class='font1' align='center'>��Թԡ����ɹ͡�����Ҫ���</h1>";
		echo "<h2 class='font3' align='center'>�ѹ���  $dateshow ���� $_POST[time]  ��ͧ��Ǩ�ä�����¹͡</h2>";
		
		echo "<table width=\"100%\" border=\"1\" style=\"border-collapse:collapse; border-color:#000;\" cellpadding=\"0\" cellspacing=\"0\" class=\"font2\" align='center'>
  <tr bgcolor=\"#999999\">
    <td align=\"center\" width=\"7%\">�ӴѺ</td>
    <td colspan='2' align='center' width=\"47%\">���� - ʡ��</td>
    <td align=\"center\" width=\"13%\">HN</td>
	<td align=\"center\" width=\"20%\">�Է���</td>
    <td align=\"center\" width=\"13%\">AN</td>
    <td align=\"center\" id='no_print' colspan='2'>�Ѵ���</td>

  </tr>";
?>


<? } 
$name=explode(" ",$arr['ptname']);
$fname=$name[0];
$lname = substr($arr['ptname'],strlen($fname)+1);
?>
    <tr>
    <td align="center"><?=$run;?></td>
    <td  style='border-right-style:none'>&nbsp;<?=$fname?></td>
    <td  style="border-left-style:none"><?=$lname?></td>
    <td>&nbsp;<?=$arr['hn']?></td>
	<td>&nbsp;<?php 
		echo str_replace('�ç���', '', substr($arr['ptright'], 4));
	?></td>
    <td>&nbsp;<?=$arr['an']?></td>
    <td  align="center" id="no_print"><a id="edit" class="various iframe" href="clinic_editform.php?row_id=<?=$arr['row_id']?>">���</a></td>
    <td align="center" id="no_print"><a id="delete" class="various iframe" href="clinic_delete.php?row_id=<?=$arr['row_id']?>">ź</a></td>
    </tr>
  
  <?
  $run++;
   }

//echo "</div>";
echo "</div>";
   ?>
</table>
<BR />
<table width="100%" border="0" align="center" class="font2">
  <tr>
    <td align="center" width="40%">���ѹ�֡&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" width="40%" >&nbsp;</td>
  </tr>
  <tr>
    <td align="center">�.�.˭ԧ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center"><?=$yot;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="center">( �ح���� �����ͧ )</td>
    <td align="center">(<?=$doctor;?>)</td>
  </tr>
  <tr>
    <td align="center">���˹����ͧ��Ǩ�ä�����¹͡</td>
    <td align="center">ᾷ�����ѡ��</td>
  </tr>
  <tr>
    <td align="center">........./............/.........</td>
    <td align="center">........./............/.........</td>
  </tr>
</table>
<? }?>

</body>
</html>