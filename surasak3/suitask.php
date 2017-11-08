<form method="POST" action="presuit.php">
  <p><font size="4" face="Angsana New"><b>สร้างสูตร
  ชุดการตรวจวินิจฉัยโรค</b></font></p>
  <p><font face="Angsana New">ชื่อสูตร(คำอธิบาย)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="suitname" size="20"></font></p>
  <p><font face="Angsana New">รหัสสูตร(นำด้วย&nbsp;@
  เสมอ)&nbsp; <input type="text" name="suitcode" size="15" value="@"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="       ตกลง       " name="B1"></font></p>
</form><br />
<br />
<br />
<br />
สูตรLabที่มีอยู่
<table width="50%" border="0">
<?
include("connect.inc");
$sql = "select * from labcare where code like '@%' ";
$row = mysql_query($sql);
while($result = mysql_fetch_array($row)){
	$i++;
	if($i%2==0){
		$color='#CCCCCC';
	}else{
		$color='#99CCFF';
	}
?>
  <tr bgcolor="<?=$color?>" >
    <td width="80%"><a target="_blank" href="suitdetail.php?code=<?=$result['code']?>"><?=$result['code']?></a></td>
    <td width="20%" align="center"><a target="_blank" href="suitdetail.php?code=<?=$result['code']?>&del" onclick="return confirm('ยืนยันการลบสูตร <?=$result['code']?>?');"> ลบ </a></td>
  </tr>
<?
}
?>
</table>



