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
     #printable { display: block; }
} 
-->
</style>
<div id="non-printable">
<form id="form1" name="form1" method="post" action="report_debtorptmonth.php">
<input name="act" type="hidden" value="show" />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td align="center">เลือก
         
        เดือน       
		<?
        $thaimonthFull=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม", "พฤศจิกายน","ธันวาคม");
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
        ปี 
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
		 <input type="submit" value="ค้นหาข้อมูล" name="B1"  class="txt" />
		</span></td>
    </tr>
    <tr>
      <td align="center"><a href="../nindex.htm">&lt;&lt; กลับเมนูหลัก &gt;&gt;</a></td>
    </tr>
  </table>
</form>
</div> 
<?
if($_POST["act"]=="show"){
$selmon=$_POST["selmon"];
	if($selmon=="01"){
		$mon ="มกราคม";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="กุมภาพันธ์";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="มีนาคม";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="เมษายน";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="พฤษภาคม";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="มิถุนายน";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="กรกฎาคม";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="สิงหาคม";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="กันยายน";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="ตุลาคม";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="พฤศจิกายน";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="ธันวาคม";
		$selmon="12";
	}
$thyear=$_POST["selyear"];
$ksyear=$_POST["selyear"]-543;
?>
<?
$sql = "Select  a.depart, a.credit, sum(a.paidcscd) as showprice From opacc as a where  ( a.date BETWEEN '$thyear-$selmon-01 00:00:00' AND '$thyear-$selmon-31 23:59:59')  AND a.depart='NID' group by  a.credit  ORDER by a.txdate";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
?>
<div id="printable"> 
<p align="center"><strong>สรุปลูกหนี้นวดแผนไทย/ฝังเข็ม ประจำเดือน <?=$mon;?> พ.ศ.<?=$thyear;?></strong></p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr bgcolor="#FFCCCC">
    <td width="8%" align="center"><strong>ลำดับ</strong></td>
    <td width="72%" align="center" bgcolor="#FFCCCC"><strong>ประเภทลูกหนี้</strong></td>
    <td width="20%" align="center" bgcolor="#FFCCCC"><strong>จำนวนเงิน</strong></td>
  </tr> 
  <?
  $i=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="left"><?=$rows["credit"];?></td>
    <td align="right"><?=number_format($rows["showprice"],2);?></td>
  </tr>
  <?
  }
  ?>
</table>
</div>  
<?
}
?>

