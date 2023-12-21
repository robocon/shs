<?
session_start();
include("connect.inc");
if ($_GET["act"] == "del") {
	$del = "update inputm set status='N' where row_id='" . $_GET["id"] . "'";
	if (mysql_query($del)) {
		echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='showuser.php?menucode=$_GET[menucode]';</script>";
	} else {
		echo "<script>alert('!!! ผิดพลาดไม่สามารถลบข้อมูลได้');window.location='showuser.php?menucode=$_GET[menucode]';</script>";
	}
}
?>
<style type="text/css">
	body,
	td,
	th {
		font-family: TH SarabunPSK;
		font-size: 20px;
	}
    .addUserButton{
        text-decoration: none;
        border: none;
        padding: 8px 12px;
        background-color: #009688;
        color: #ffffff;
    }
    .addUserButton:hover{
        background-color: #01746a;
    }
</style>
<div align="center">
	<p><strong>จัดการข้อมูลผู้ใช้งานระบบ</strong></p>
	<div>
        <a href="adduser.php?menucode=<?= $_GET["menucode"] ?>" class="addUserButton">เพิ่มผู้ใช้ในแผนก</a>
    </div>
    <div>&nbsp;</div>
	<table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"
		style="border-collapse:collapse;">
		<tr>
			<td width="12%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
			<td width="40%" align="center" bgcolor="#66CC99"><strong>ชื่อ - นามสกุล</strong></td>
			<td width="20%" align="center" bgcolor="#66CC99"><strong>part</strong></td>
            <td width="20%" align="center" bgcolor="#66CC99"><strong>สถานะ</strong></td>
			<td width="36%" align="center" bgcolor="#66CC99"><strong>จัดการข้อมูล</strong></td>
		</tr>
		<?
		$sql = "select * from inputm where menucode like '" . $_GET["menucode"] . "%' order by menucode ";
		$query = mysql_query($sql);
		$num = mysql_num_rows($query);
		if ($num < 1) {
			echo "<tr><td colspan='3' align='center'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
		} else {
			$i = 0;
			while ($rows = mysql_fetch_array($query)) {
				$i++;

                $statusTxt = 'ใช้งาน';
                $statusColor = '';
                $statusTextColor = '';
                if($rows["status"]=='N'){
                    $statusTxt = 'ปิดการใช้งาน';
                    $statusColor = '#dc3545';
                    $statusTextColor = 'color: #ffffff;';
                }

				?>
				<tr bgcolor="<?=$statusColor; ?>" style="<?=$statusTextColor;?>">
					<td align="center">
						<?= $i; ?>
					</td>
					<td bgcolor="<?= $bg; ?>">
						<?= $rows["name"]; ?>
					</td>
					<td bgcolor="<?= $bg; ?>">
						<?= $rows["menucode"]; ?>
					</td>
                    <td align="center">
                    <?php
                    
                    echo $statusTxt;
                    ?>
                    </td>
					<td align="center" bgcolor="<?= $bg; ?>">
						<? if ($rows["level"] == "user") { ?>
							<a
								href="edituser.php?menucode=<?= $_GET["menucode"]; ?>&id=<?= $rows["row_id"]; ?>">แก้ไข</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
								href="showuser.php?act=del&menucode=<?= $_GET["menucode"]; ?>&id=<?= $rows["row_id"]; ?>"
								onClick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่');">ลบ</a>
						<? } else {
							echo "ติดต่อโปรแกรมเมอร์";
						} ?>
					</td>
				</tr>
			<?
			}
		}
		?>
	</table>

</div>