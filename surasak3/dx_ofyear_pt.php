<?php
session_start();
include("connect.inc");

$date_now = date("Y-m-d H:i:s");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

$thaidate = (date("Y")+543).date("-m-d");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style>
	.font_title{font-family:"Angsana New"; font-size:36px}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 { font-weight: bold; }

.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<script>
function togglediv1(divid){ 
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}else{
		//sss
	}
}
function togglediv2(divid){ 
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}else{
		//sss
	}
}
</script>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; ����</a>
<center>
  <div class="font_title">�š�õ�Ǩ���ö�Ҿ��ҧ���</div></center>

<form action="dx_ofyear_pt.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">��͡�����Ţ HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/><input type="submit" name="Submit1" value="��ŧ" /></TD>
</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<input name="post_vn" type="hidden" value="1" />
</form>

<?php 
if(isset($_POST['Submit1'])){
?>

<!-- ���������ͧ�鹢ͧ������ -->
<FORM METHOD=POST ACTION="dx_ofyear_save_pt.php">



<?

$sql1 = "select * from opcard where hn='".$_POST['p_hn']."' ";
$row1 = mysql_query($sql1);
$query1 = mysql_fetch_array($row1);

?>
<br />
<TABLE width="90%" border="1" cellpadding="0" cellspacing="0">
<TR>
	<td>
      <table>
    <tr>
      <td width="718" class="pdxpro">HN :
        <strong>
        <?=$query1['hn']?>
        </strong>       ����-ʡ�� : 
      <strong><?=$query1['yot']." ".$query1['name']." ".$query1['surname'];?></strong>
      <? $age1 = calcage($query1['dbirth']);?>
      ���� <?=$age1?> �Ţ�ѵû�� : <?=$query1['idcard']?></td>
      <input name="age" type="hidden" value="<?=$age1?>"/>
      <input name="camp" type="hidden" value="<?=$query1['camp']?>"/>
      </tr>
      </table>
      </td></tr>
    </table>
<table width="857">
    <tr>
      <td class="pdxpro"><strong>�š�õ�Ǩ���ö�Ҿ��ҧ���</strong></td>
      </tr>
    <tr>
      <td class="pdx"><table width="459">
        <tr>
          <td width="90"><strong>�ç����´��</strong></td>
          <td colspan="2"><input type="radio" name="ch1" value="���ҡ" />
            ���ҡ
              <input type="radio" name="ch1" value="��" />
              ��
              <input type="radio" name="ch1" value="����" />
              ����
              <input type="radio" name="ch1" value="��͹��ҧ���" />
              ��͹��ҧ���
              <input type="radio" name="ch1" value="���" />
            ���</td>
          </tr>
        <tr>
          <td><strong>�ç����´��ѧ</strong></td>
          <td colspan="2"><input type="radio" name="ch2" value="���ҡ" />
���ҡ
  <input type="radio" name="ch2" value="��" />
��
<input type="radio" name="ch2" value="����" />
����
<input type="radio" name="ch2" value="��͹��ҧ���" />
��͹��ҧ���
<input type="radio" name="ch2" value="���" />
���</td>
          </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td width="147" align="center"><input name="submit" type="submit" value=" ��ŧ "  /></td>
          <td width="260" align="center">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
      </tr>
    </table>
</td>
</TR>
</TABLE>
<BR>


<center>&nbsp;&nbsp;
<!--<input name="submit2" type="submit" value="��ŧ&amp;ʵԡ���� OPD" />-->
</center>
<INPUT TYPE="hidden" value="<?php echo $query1['yot']." ".$query1['name']." ".$query1['surname'];?>" name="ptname" />
<input name="age" type="hidden" id="age"  value="<?php echo $age1;?>" />
<INPUT TYPE="hidden" value="<?php echo $query1['hn'];?>" name="hn" />
</FORM>
<?php
}
elseif(isset($_GET['del'])){
	$sql3 = "delete from chk_pt where row_id='".$_GET['del']."' ";
	$result3= mysql_query($sql3);
	if($result3){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dx_ofyear_pt.php\">";
	}
}else{
	$sql2 = "select * from chk_pt where yearchk='2556' ";
	$rows2 = mysql_query($sql2);
	?>
<br /><br />
	<table width="80%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: AngsanaUPC; font-size: 18px;">
    	<tr><td width="29" align="center" bgcolor="#FF9966">#</td><td width="86" align="center" bgcolor="#FF9966">HN</td><td width="146" align="center" bgcolor="#FF9966">����-ʡ��</td>
    	  <td width="124" align="center" bgcolor="#FF9966">�ç����´��</td>
    	  <td width="124" align="center" bgcolor="#FF9966">�ç����´��ѧ</td>
    	  <td width="61" align="center" bgcolor="#FF9966">ź</td>
   	    </tr>
	<?
	while($result=mysql_fetch_array($rows2)){
		$i++;
	?>
    	<tr><td align="center"><?=$i?></td>
        <td><?=$result['hn']?></td>
        <td><?=$result['ptname']?></td>
    	<td><?=$result['leg']?></td>
    	<td><?=$result['back']?></td>
    	<td align="center"><a href="dx_ofyear_pt.php?del=<?=$result['row_id']?>" onclick="return confirm('�׹�ѹ���ź?')">ź</a></td>
   	    </tr>
	<?
	}
	?>
	</table>
	<?
}
include("unconnect.inc");
 ?>
</body>
</html>