<?
include("connect.inc");
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$showyear="25".$nPrefix;
?>	
<title>รายงานผลการตรวจสุขภาพกำลังพล ทบ. ประจำปี <?=$showyear;?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<div id="no_print" > 
<a href ="../nindex.htm" >&lt;&lt; กลับหน้าหลัก</a>
<p align="center" style="font-weight:bold;">รายงานเปรียบเทียบผลการตรวจสุขภาพกำลังพล ทบ. ประจำปี <?=$showyear;?>
</p>
<form name="form1" method="post" action="reportchkup_armylist62.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วย :
        <label>      
        <select name="camp" id="camp">
		 <?
		 $sql="select distinct(camp) as camp from chkup_solider where yearchkup = '$nPrefix' order by camp";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value="ดูรายงาน">
        </label></td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="show"){
	$showcamp=substr($_POST["camp"],4);
	$result="select * from condxofyear_so where yearcheck='2562' and camp1='$_POST[camp]'  group by hn order by age desc";
	//echo $result;
	$object=mysql_query($result) or die("Query chkup_solider Error");
	$numtotal=mysql_num_rows($object);		
?>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="16%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="5%" rowspan="2" align="center" bgcolor="#66CC99"><strong>หน่วย</strong></td>
    <td width="5%" rowspan="2" align="center" bgcolor="#66CC99"><strong>อายุ</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>BMI</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>รอบเอว</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>BP</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>BS</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>CHOL</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><p><strong>TR</strong></p>    </td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>HDL</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>LDL</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>CR</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>BUN</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>URIC</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>SGOT</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>SGPT</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>ALK</strong></td>
  </tr>
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99">60</td>
    <td width="5%" align="center" bgcolor="#66CC99">61</td>
    <td width="5%" align="center" bgcolor="#66CC99">62</td>
    <td width="5%" align="center" bgcolor="#66CC99">60</td>
    <td width="5%" align="center" bgcolor="#66CC99">61</td>
    <td width="5%" align="center" bgcolor="#66CC99">62</td>
    <td width="4%" align="center" bgcolor="#66CC99">60</td>
    <td width="4%" align="center" bgcolor="#66CC99">61</td>
    <td width="4%" align="center" bgcolor="#66CC99">62</td>
    <td width="4%" align="center" bgcolor="#66CC99">60</td>
    <td width="4%" align="center" bgcolor="#66CC99">61</td>
    <td width="4%" align="center" bgcolor="#66CC99">62</td>
    <td width="7%" align="center" bgcolor="#66CC99">60</td>
    <td width="7%" align="center" bgcolor="#66CC99">61</td>
    <td width="7%" align="center" bgcolor="#66CC99">62</td>
    <td width="4%" align="center" bgcolor="#66CC99">60</td>
    <td width="4%" align="center" bgcolor="#66CC99">61</td>
    <td width="4%" align="center" bgcolor="#66CC99">62</td>
    <td width="5%" align="center" bgcolor="#66CC99">60</td>
    <td width="5%" align="center" bgcolor="#66CC99">61</td>
    <td width="5%" align="center" bgcolor="#66CC99">62</td>
    <td width="5%" align="center" bgcolor="#66CC99">60</td>
    <td width="5%" align="center" bgcolor="#66CC99">61</td>
    <td width="5%" align="center" bgcolor="#66CC99">62</td>
    <td width="4%" align="center" bgcolor="#66CC99">60</td>
    <td width="4%" align="center" bgcolor="#66CC99">61</td>
    <td width="4%" align="center" bgcolor="#66CC99">62</td>
    <td width="6%" align="center" bgcolor="#66CC99">60</td>
    <td width="6%" align="center" bgcolor="#66CC99">61</td>
    <td width="6%" align="center" bgcolor="#66CC99">62</td>
    <td width="6%" align="center" bgcolor="#66CC99">60</td>
    <td width="6%" align="center" bgcolor="#66CC99">61</td>
    <td width="6%" align="center" bgcolor="#66CC99">62</td>
    <td width="7%" align="center" bgcolor="#66CC99">60</td>
    <td width="7%" align="center" bgcolor="#66CC99">61</td>
    <td width="7%" align="center" bgcolor="#66CC99">62</td>
    <td width="6%" align="center" bgcolor="#66CC99">60</td>
    <td width="6%" align="center" bgcolor="#66CC99">61</td>
    <td width="6%" align="center" bgcolor="#66CC99">62</td>
    <td width="6%" align="center" bgcolor="#66CC99">60</td>
    <td width="6%" align="center" bgcolor="#66CC99">61</td>
    <td width="6%" align="center" bgcolor="#66CC99">62</td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($object)){
$i++;
$ptname=$rows["ptname"];
$age=substr($rows["age"],0,2);

$sql1="select * from armychkup where hn='$rows[hn]' and yearchkup='60' and camp='$_POST[camp]'";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);

$sql2="select * from armychkup where hn='$rows[hn]' and yearchkup='61' and camp='$_POST[camp]'";
$query2=mysql_query($sql2);
$rows2=mysql_fetch_array($query2);

$sql3="select * from condxofyear_so where hn='$rows[hn]' and yearcheck='2562' and camp1='$_POST[camp]'";
$query3=mysql_query($sql3);
$rows3=mysql_fetch_array($query3);


$waist1=$rows1["waist"]*2.54;
$waist1=number_format($waist1,2);

$waist2=$rows2["waist"]*2.54;
$waist2=number_format($waist2,2);
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$ptname;?></td>
    <td><?=substr($rows["camp1"],4);?></td>
    <td><?=$age;?></td>
    <td><?=$rows1["bmi"];?></td>
    <td><?=$rows2["bmi"];?></td>
    <td><?=$rows3["bmi"];?></td>
    <td><?=$waist1;?></td>
    <td><?=$waist2;?></td>
    <td><?=$rows3["round_"];?></td>
    <td><?=$rows1["bp1"];?></td>
    <td><?=$rows2["bp1"];?></td>
    <td><?=$rows3["bp1"]."/".$rows3["bp2"];?></td>
    <td><?=$rows1["glu_result"];?></td>
    <td><?=$rows2["glu_result"];?></td>
    <td><?=$rows3["bs"];?></td>
    <td><?=$rows1["chol_result"];?></td>
    <td><?=$rows2["chol_result"];?></td>
    <td><?=$rows3["chol"];?></td>
    <td><?=$rows1["trig_result"];?></td>
    <td><?=$rows2["trig_result"];?></td>
    <td><?=$rows3["tg"];?></td>
    <td><?=$rows1["hdl_result"];?></td>
    <td><?=$rows2["hdl_result"];?></td>
    <td><?=$rows3["hdl"];?></td>
    <td><?=$rows1["ldl_result"];?></td>
    <td><?=$rows2["ldl_result"];?></td>
    <td><?=$rows3["ldl"];?></td>
    <td><?=$rows1["crea_result"];?></td>
    <td><?=$rows2["crea_result"];?></td>
    <td><?=$rows3["cr"];?></td>
    <td><?=$rows1["bun_result"];?></td>
    <td><?=$rows2["bun_result"];?></td>
    <td><?=$rows3["bun"];?></td>
    <td><?=$rows1["uric_result"];?></td>
    <td><?=$rows2["uric_result"];?></td>
    <td><?=$rows3["uric"];?></td>
    <td><?=$rows1["ast_result"];?></td>
    <td><?=$rows2["ast_result"];?></td>
    <td><?=$rows3["sgot"];?></td>
    <td><?=$rows1["alt_result"];?></td>
    <td><?=$rows2["alt_result"];?></td>
    <td><?=$rows3["sgpt"];?></td>
    <td><?=$rows1["alp_result"];?></td>
    <td><?=$rows2["alp_result"];?></td>
    <td><?=$rows3["alk"];?></td>
  </tr>
<?
}
?>  
</table>

<?
}  //close if act=show
?>