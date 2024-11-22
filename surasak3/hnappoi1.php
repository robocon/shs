<?php
session_start();

// ถ้าแพทย์เข้าใช้หน้านัดพยาบาลให้เด้งกลับไปหน้าแพทย์เหมือนเดิม
if( $_SESSION['smenucode'] === 'ADMDR1' ){
    header("Location: dt_index.php");
    exit;
}

session_unregister("cHn");  
session_unregister("cPtname");
session_unregister("cAge");
session_unregister("cptright");
session_unregister("capptime");
session_unregister("cnote");
session_unregister("cidguard");

?>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
th, td{
  padding: 15px;
  text-align: left;
  border-bottom: 2px solid #d2b4de;
}	
}
</style>
<form method="post" action="hnappoi1.php">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ออกใบนัดผู้ป่วย</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN :&nbsp;
  <input type="text" name="hn" size="12" id="aLink">
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>
</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">
    &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< เมนู</a>&nbsp;|&nbsp;
    <a target=_self  href='appoilst.php'>ดูรายชื่อผู้ป่วยนัด</a>&nbsp;|&nbsp;
    <a href="appoint_edit.php" target="_blank">แก้ไข LAB,X-Ray ใบนัด</a>&nbsp;|&nbsp;
    <a href="reprint_wound.php" target="_blank">ใบนัดทำแผลย้อนหลัง</a>&nbsp;|&nbsp;
    <a href="reprint_inj_appoint.php" target="_blank">ใบนัดฉีดยาย้อนหลัง</a>
  </p>
คำเตือน  .....  การออกใบนัด กรุณาอย่าใช้อักษรที่พิเศษเช่น (  , "  '  เป็นต้น)   อาจทำให้ข้อมูลไม่สามารถบันทึกลงในคอมพิวเตอร์
</form>

<table width="80%">
 <tr>
  <th bgcolor=#5dade2>ออกใบนัด</th>
  <th bgcolor=#5dade2>เลขบัตรประชาชน</th>
  <th bgcolor=#5dade2>ยศ</th>
  <th bgcolor=#5dade2>ตรวจนัด</th>
  <th bgcolor=#5dade2>สกุล</th>
    <th bgcolor=#5dade2>สิทธิ</th>
 <th bgcolor=#5dade2>หมายเหตุ</th>
 </tr>

<?php
$hn = trim($_POST['hn']);
If (!empty($hn)){
    include("connect.php");
    global $hn;
    $query = "SELECT hn,yot,name,surname,dbirth,ptright,note,idguard,idcard FROM opcard WHERE hn = '$hn'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$ptright,$note,$idguard,$idcard) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=#d2b4de style='font-size:28px;font-weight:bold;'><a   href=\"preappoi1.php?cHn=$hn&chkhn=$hn&chkidcard=$idcard&cYot=".rawurlencode($yot)."&cName=".rawurlencode($name)."&cSurname=".rawurlencode($surname)."&Age=$dbirth&ptright=".rawurlencode($ptright)."&note=".rawurlencode($note)."&idguard=".rawurlencode($idguard)."\">$hn</a></td>\n".
           "  <td BGCOLOR=#d2b4de>$idcard</td>\n".
		   "  <td BGCOLOR=#d2b4de>$yot</td>\n".
           "  <td BGCOLOR=#d2b4de><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">$name</td>\n".
           "  <td BGCOLOR=#d2b4de>$surname</td>\n".
			          "  <td BGCOLOR=#d2b4de>$ptright</td>\n".
    "  <td BGCOLOR=#d2b4de>$idguard</td>\n".

           " </tr>\n");
       }
include("unconnect.inc");
}
?>
</table>
<div style='margin-top:20px; margin-left:20px;color:blue;font-weight:bold;font-size:24px;'>กรุณาตรวจสอบข้อมูลของผู้ป่วยให้ถูกต้อง เพื่อดำเนินการต่อไป...</div>