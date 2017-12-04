<title>โปรแกรมปรับปรุงข้อมูลexercise</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<p align="center" style="font-weight:bold;">โปรแกรมปรับปรุงข้อมูลexerciseของกำลังพลที่ตรวจสุขภาพประจำปี</p>
<?
include("connect.inc");
if($_POST["act"]=="edit"){
	$yearcheck="25".$_POST["year"];  //ใช้สำหรับตาราง condxofyear_so ฟิลด์ yearcheck
	
	$sql="select * from  dxofyear  where  	yearchk='$_POST[year]'";
	echo $sql;
	$query=mysql_query($sql) or die("Query chkup_solider Error");
	while($rows=mysql_fetch_array($query)){
		$chksql="select * from condxofyear_so where hn='$rows[hn]' and yearcheck='$yearcheck' ";
		$result=mysql_query($chksql)  or die("Query condxofyear_so Error");
		$num=mysql_num_rows($result);
		$row=mysql_fetch_array($result);
		if(!empty($num)){
			$edit="update condxofyear_so set exercise='$rows[exercise]' where hn='$row[hn]' and yearcheck='$yearcheck'";
			mysql_query($edit);
		}
	}
		echo "<script>alert('ปรับปรุงข้อมูลเรียบร้อยแล้ว');window.location='reportexercise_chkuparmy.php';</script>";	
}
?>
<form name="form1" method="post" action="updateexercise_chkuparmy.php" >
<input name="act" type="hidden" value="edit">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">ปี พ.ศ. 
        <label>
        <select name="year" id="year">
          <option value="58">2558</option>
          <option value="59">2559</option>
        </select>
        <input type="submit" name="button" id="button" value="ปรับปรุงข้อมูล">
        </label></td>
    </tr>
  </table>
</form>
