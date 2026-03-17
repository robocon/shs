<title>โปรแกรมปรับปรุงข้อมูลสังกัด</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<p align="center" style="font-weight:bold;">โปรแกรมปรับปรุงข้อมูลสังกัดของกำลังพลที่ตรวจสุขภาพประจำปี</p>
<?
include("connect.inc");
if($_POST["act"]=="edit"){
	$yearcheck="25".$_POST["year"];  //ใช้สำหรับตาราง condxofyear_so ฟิลด์ yearcheck
	
	$sql="select * from condxofyear_so where  yearcheck='$yearcheck' and keymanual='y'";
	//echo "==>".$sql;
	$query=mysql_query($sql) or die("Query chkup_solider Error");
	$i=0;
	while($rows=mysql_fetch_array($query)){
		$i++;
		$chksql="select idcard,camp from opcard where hn='$rows[hn]'";
		//echo $chksql;
		$result=mysql_query($chksql)  or die("Query condxofyear_so Error");
		$num=mysql_num_rows($result);
		$row=mysql_fetch_array($result);
		if(!empty($num)){
			$edit="update condxofyear_so set camp='$row[camp]' where hn='$rows[hn]' and yearcheck='$yearcheck'";
			echo "$i-->".$edit."<br>";
			mysql_query($edit);
			
			$edit1="update register_chkup_soldier set register_type='ตรวจนอกหน่วย',  register_date='$rows[thidate]', comment='ส่งผลตรวจ บันทึกผลตรวจโดย OPD' where (hn='$rows[hn]' OR idcard = '$row[idcard]') and yearcheck='$yearcheck'";
			echo "$i==>".$edit1."<br>";
			mysql_query($edit1);
		}
	}
		echo "<script>alert('ปรับปรุงข้อมูลเรียบร้อยแล้ว');window.location='reportcamp_chkuparmy.php';</script>";	
}
?>
<form name="form1" method="post" action="updatecamp_chkuparmy.php" >
<input name="act" type="hidden" value="edit">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="49%" align="right">ปี พ.ศ. (ปีงบประมาณ)</td>
      <td width="51%"><label>
        <select name="year" id="year">
          <option value="69">2569</option>
        </select>
        <input type="submit" name="button" id="button" value="ปรับปรุงข้อมูล">
      </label></td>
    </tr>
  </table>
</form>
