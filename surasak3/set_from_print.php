<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<style type="text/css">
.font1 {
	font-family:"TH SarabunPSK";
	font-size:16pt;
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
.font11 {	font-family:"TH SarabunPSK";
	font-size:20px;
}
</style>
<div id="no_print">
<h1 class="font1">&nbsp;</h1>

<fieldset class="font1" style="width:80%">
  <legend>� SET ��ҵѴ </legend>
  <form id="form1" name="form1" method="post"  onSubmit="JavaScript:return fncSubmit();">
  <table border="0" align="center">
    <tr>
      <td>��͹/��</td>
      <td>
        <select name="m_start" class="font11">
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
      <td>˹���</td>
      <td><select name="ward" class="font1" id="ward">
        <option value="">----��س����͡----</option>
        <option value="OPD">OPD</option>
        <option value="ER">ER</option>
        <option value="�ͼ��������">�ͼ��������</option>
        <option value="�ͼ������ٵ�">�ͼ������ٵ�</option>
        <option value="�ͼ����¾����">�ͼ����¾����</option>
        <option value="�ͼ�����˹ѡ">�ͼ�����˹ѡ</option>
        <option value="����к�">����к�</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font1" id="button" value="��ŧ" />
      <a target=_self  href='../nindex.htm'> ����� </a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />
</div>
<? 
if($_POST['button']){
include("connect.inc");

$y_start=($_POST['y_start']-543);
$datenow=date("Y-m-d");
$thidate=$y_start.'-'.$_POST['m_start'];
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
	if($_POST['ward']=="OPD"){
		
	$where="and ward='OPD' or  ward='��ͧ��Ǩ�ä' ";	
	}else{
	
	$where="and ward='".$_POST['ward']."'";	
	}

$sqlnow="SELECT * FROM `set_or` WHERE date_surg like '$thidate%'  $where ";
$querynow=mysql_query($sqlnow);

$rownow=mysql_num_rows($querynow);


 $dateshow=$printmonth." ".($_POST['y_start']);

if($rownow){
	 
?>
<br />
<br />
<h1 class="font1" align="center">� SET ��ҵѴ  ��͹ <?=$dateshow;?></h1>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="font1" style="border-collapse:collapse; border-color:#000;">
  <tr>
    <td bgcolor="#0099CC"><div align="center">˹���</div></td>
    <td bgcolor="#0099CC"><div align="center">�ѹ/��͹/��</div></td>
    <td bgcolor="#0099CC">����</td>
    <td bgcolor="#0099CC"><div align="center">hn</div></td>
    <td bgcolor="#0099CC"><div align="center">an</div></td>
    <td bgcolor="#0099CC"><div align="center">����-ʡ��</div></td>
    <td bgcolor="#0099CC"><div align="center">����</div></td>
    <td bgcolor="#0099CC"><div align="center">�Է��	</div></td>
    <td bgcolor="#0099CC"><div align="center">����ԹԨ���</div></td>
    <td bgcolor="#0099CC"><div align="center">��ü�ҵѴ</div></td>
    <td bgcolor="#0099CC"><div align="center">ᾷ��</div></td>
    <td bgcolor="#0099CC"><div align="center">��Դ����</div></td>
    <td bgcolor="#0099CC">�����˵�</td>
  </tr>
  <? 
    $r=0;
  while($arr=mysql_fetch_array($querynow)){
	  
	  $exd=explode('-',$arr['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg=$exd[2].'-'.$exd[1].'-'.$exd[0];
    
	$r++;
	
 if($r=='26'){
$r=1;
	echo "</table>";
		echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
		echo "<table  width='100%' border='1' style='border-collapse:collapse; border-color:#000;' cellpadding='0' cellspacing='0' class='font1' align='center'>
  <tr>
    <td bgcolor='#0099CC'><div align='center'>˹���</div></td>
    <td bgcolor='#0099CC'><div align='center'>�ѹ/��͹/��</div></td>
    <td bgcolor='#0099CC'>����</td>
    <td bgcolor='#0099CC'><div align='center'>hn</div></td>
    <td bgcolor='#0099CC'><div align='center'>an</div></td>
    <td bgcolor='#0099CC'><div align='center'>����-ʡ��</div></td>
    <td bgcolor='#0099CC'><div align='center'>����</div></td>
    <td bgcolor='#0099CC'><div align='center'>�Է��	</div></td>
    <td bgcolor='#0099CC'><div align='center'>����ԹԨ���</div></td>
    <td bgcolor='#0099CC'><div align='center'>��ü�ҵѴ</div></td>
    <td bgcolor='#0099CC'><div align='center'>ᾷ��</div></td>
    <td bgcolor='#0099CC'><div align='center'>��Դ����</div></td>
    <td bgcolor='#0099CC'>�����˵�</td>
  </tr>";
  
  
 }
  ?>
  <tr>
    <td><?=$arr['ward'];?></td>
    <td><?=$date_surg;?>    </td>
    <td><?=$arr['time'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><?=$arr['surg'];?>    </td>
    <td><?=$arr['doctor'];?></td>
    <td><?=$arr['inhalation_type'];?></td>
    <td><?=$arr['comment'];?></td>
  </tr>
  
  <?  } 
//echo "</div>";
echo "</div>";
  ?>
</table>

<?

} else {
	
 echo "<div align='center' class='font1'>����բ����Ţͧ��͹ </div>";	
}
} 
?>