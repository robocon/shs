<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
-->
</style>
<div id="non-printable">
<form id="form1" name="form1" method="post" action="report_ptmonth.php">
<input name="act" type="hidden" value="show" />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td align="center">���͡��ǧ����
        <select name="seldate" id="seldate" class="txt">
          <option value="1" selected="selected">1-15</option>
          <option value="2">16-31</option>
        </select> 
        ��͹       
		<?
        $thaimonthFull=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�", "��Ȩԡ�¹","�ѹ�Ҥ�");
        echo "<select name='selmon' size='1'  class='txt'>";
        for($i=0;$i<count($thaimonthFull);$i++){
        	echo "<option value='".($i+1)."' ";
			if(date("m")==$i+1){
				echo " selected";
			}
        	echo ">".$thaimonthFull[$i]."</option>";
        }
        echo "</select>";
        ?>
        �� 
		<? 
			$y=date("Y")+543;
			$date=date("Y")+543+5;
			$dates=range(2547,$date);
			echo "<select name='selyear' size='1' class='txt'>";
			foreach($dates as $i){
		?>
        	<option value="<?=$i;?>" <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
		<?
			}
			echo "</select>";
		?>        <span style="margin-left: 65px;">
		 <input type="submit" value="���Ң�����" name="B1"  class="txt" />
		</span></td>
    </tr>
    <tr>
      <td align="center"><a href="../nindex.htm">&lt;&lt; ��Ѻ������ѡ &gt;&gt;</a></td>
    </tr>
  </table>
</form>
</div> 
<?
if($_POST["act"]=="show"){
$seldate=$_POST["seldate"];
if($seldate=="1"){
	$showdate="1-15";
}else{
	$showdate="16-30";
}
$selmon=$_POST["selmon"];
	if($selmon=="01"){
		$mon ="���Ҥ�";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="����Ҿѹ��";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="�չҤ�";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="����¹";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="����Ҥ�";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="�Զع�¹";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="�á�Ҥ�";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="�ԧ�Ҥ�";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="�ѹ��¹";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="���Ҥ�";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="��Ȩԡ�¹";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="�ѹ�Ҥ�";
		$selmon="12";
	}
$thyear=$_POST["selyear"];
$ksyear=$_POST["selyear"]-543;
?>
<?
if($seldate=="1"){
$sql="SELECT distinct(staf_massage) FROM depart WHERE staf_massage !='' AND date BETWEEN '$thyear-$selmon-01 00:00:00' AND '$thyear-$selmon-15 23:59:59'";
}else{
$sql="SELECT distinct(staf_massage) FROM depart WHERE staf_massage !='' AND date BETWEEN '$thyear-$selmon-16 00:00:00' AND '$thyear-$selmon-31 23:59:59'";
}
$query=mysql_query($sql);
$num=mysql_num_rows($query);
while($row=mysql_fetch_array($query)){
$staf_massage=$row["staf_massage"];
?>
<div id="printable"> 
<p align="center"><strong>��ª��ͼ�����Ѻ��ԡ�ùǴἹ��</strong></p>
<div style="margin-left: 5%;"><strong>���;�ѡ�ҹ�Ǵ : </strong><?=$staf_massage;?></div>
<div style="margin-left: 5%;"><strong>��ǧ���������ҧ�ѹ��� : </strong><?=$showdate;?> ��͹<?=$mon;?> �.�. <?=$thyear;?></div>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr bgcolor="#FFCCCC">
    <td width="8%" align="center"><strong>�ӴѺ</strong></td>
    <td align="center" bgcolor="#FFCCCC"><strong>�ѹ/��͹/��</strong></td>
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>���� - ���ʡ��</strong></td>
    <td align="center" bgcolor="#FFCCCC"><strong>��è�����</strong></td>
  </tr>
  <?
  	if($seldate=="1"){
	$sql1 = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright,b.idname FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND (b.date between '$thyear-$selmon-01 00:00:00' AND '$thyear-$selmon-15 23:59:59') and  a.status='Y' and a.price >0  and staf_massage='$staf_massage' Group by b.date ,b.hn,a.code";
	}else{
	$sql1 = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright,b.idname FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND (b.date between '$thyear-$selmon-16 00:00:00' AND '$thyear-$selmon-31 23:59:59') and  a.status='Y' and a.price >0  and staf_massage='$staf_massage' Group by b.date ,b.hn,a.code";	
	}
	$result = mysql_query($sql1) or die("Query failed ".$sql1.""); 
	$i=0;
	while($rows=mysql_fetch_array($result)){
	$i++;
	$showdate=substr($rows["date"],0,10);
	list($yy,$mm,$dd)=explode("-",$showdate);
	$dateshow="$dd/$mm/$yy";
	$showtime=substr($rows["date"],11,8);
  ?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$dateshow;?></td>
    <td><?=$rows["hn"];?></td>
    <td align="left"><?=$rows["ptname"];?></td>
    <?
	$sql3="select * from drugrx where date like '$showdate%' and hn='".$rows["hn"]."'";
	$query3=mysql_query($sql3);
	$num3=mysql_num_rows($query3);
	if(empty($num3)){
		$showdrug="";
	}else{
		$showdrug="";
	}
	?>
    <td align="center"><?=$showdrug;?></td>
  </tr>
  <?
  }
  ?>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="15%" align="right"><strong>���ѹ�֡</strong></td>
    <td width="32%" valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
    <td width="18%" align="right"><strong>��Ǩ�١��ͧ</strong></td>
    <td width="35%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
    <td align="right">�.�.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:10px;">(�ѭ��Ǵ�&nbsp;&nbsp;&nbsp;&nbsp; ����ѵ��)</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">ᾷ��Ἱ��</div></td>
  </tr>
</table>
</div>  
<?
	}
}
?>
