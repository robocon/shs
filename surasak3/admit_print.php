<style type="text/css">
.e1 {
	font-size: 18px;
}
.e2 { font-size: 16px; }
.font3 {
	font-family: AngsanaUPC;
	font-size: 18px;
}

.font4 {
	font-family: AngsanaUPC;
	font-size: 22px;
}
</style>

<?

    include("connect.inc");
$row=$_GET['row_id'];
$sql="SELECT *
FROM `admit`where row_id = '$row'";
$rw =mysql_query($sql);
$rw1=mysql_fetch_array($rw);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" size="2"><div align="center">
      <h2><span class="font4"><strong><u>แบบการแจ้งนอนโรงพยาบาล</u></strong></span></h2>
    </div></td>
  </tr>
  <tr>
    <td colspan="2">
      <span class="font3"><b class="e1">HN</b>
        &nbsp;<?=$rw1['hn'];?>&nbsp;
        <b class="e1">ชื่อ</b>
        <?=$rw1['name'];?>
        
     <?=$rw1['surname'];?>&nbsp;</span></td>
    <td colspan="2"><span class="font3"><b class="e1">สิทธิ์การรักษา</b>&nbsp;
        <?=$rw1['ptright'];?>
    &nbsp;</span><span class="font3"><b class="e1">อายุ</b>&nbsp;
        <?=$rw1['age'];?>
    </span></td>
  </tr>
  <tr>
    <td width="10%" class="e2"><span class="font3"><strong>ประเภท :</strong></span></td>
    <td width="19%"><span class="font3">
      <?=$rw1['type'];?>
    </span></td>
    <td width="10%"><span class="e2"><span class="font3"><strong>Clinic :</strong></span></span></td>
    <td width="61%"><span class="font3">
      <?=$rw1['clinic'];?>
    </span></td>
  </tr>
  <tr>
    <td class="e2"><span class="font3"><strong>แพทย์ :</strong></span></td>
    <td><span class="font3">
      <?=$rw1['doctor'];?>
    </span></td>
    <td><span class="e2"><span class="font3"><strong>ห้อง :</strong></span></span></td>
    <td><span class="font3">
      <?=$rw1['room'];?>
    </span></td>
  </tr>
  <tr>
    <td class="e2"><span class="font3"><strong>หมายเหตุ :</strong></span></td>
    <td colspan="3"><span class="font3">
      <?=$rw1['comment'];?>
    </span></td>
  </tr>
</table>
</body>
</html>