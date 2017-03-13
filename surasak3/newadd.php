<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<script language="JavaScript">
	function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
</script>
<body>
<a target=_self  href='../nindex.htm' class="forntsarabun"><------ ไปเมนู</a>

<form name="f1" method="POST" action="newadd1.php" enctype="multipart/form-data">
  <table  border="0" class="forntsarabun">
    <tr>
      <td colspan="2" align="center" bgcolor="#99CC00">เพิ่มข่าวสาร</td>
    </tr>
    <tr>
      <td>แผนก</td>
      <td><select name="depart" id="depart">
	<option value="0">เลือกแผนก</option>
<?
$part = array('','กองบังคับการ','กองการพยาบาล','หอผู้ป่วยรวม','หอผู้ป่วยพิเศษ','หอผู้ป่วยสูตินรีเวชกรรม','หอผู้ป่วยหนัก','ห้องไตเทียม','ห้องผ่าตัด','กองเภสัชกรรม','กองทันตกรรม','ห้องฉุกเฉิน','ห้องลงรหัสโรค','ห้องทะเบียน','ห้องตรวจโรคผู้ป่วยนอก','ส่วนเก็บเงินรายได้','ห้องประกันสุขภาพฯ','แผนกพยาธิวิทยา','แผนกรังสีกรรม','แผนกส่งกำลังบำรุง','พลาธิการ','องค์กรแพทย์','ศูนย์พัฒนาคุณภาพ','ฝ่ายการเงิน','สำนักงานกิจการพิเศษ','ศูนย์บริการคอมพิวเตอร์','กายภาพบำบัด','เวชกรรมป้องกัน','ห้องจ่ายกลาง','ศูนย์ผู้ป่วยใน','ประกันสังคม','ศูนย์อบรมและพัฒนาบุคลากร','ส่งเสริมสุขภาพ','กองร้อยพลเสนารักษ์','ห้องฝังเข็ม','คณะกรรมการสิ่งแวดล้อมและความปลอดภัย','ห้องตรวจตา','นวดแผนไทย');
		/*$sql="select  *  from  ptright order by code asc";
		$result=mysql_query($sql);*/
			for($i=1;$i<38;$i++) {
    		echo '<option value="'.$part[$i].'">'.$part[$i].' </option>';
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td valign="top">รายละเอียดของข่าวสาร&nbsp;</td>
      <td>
        <TEXTAREA NAME="new" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA>
        <div>
          <span style="font-size: 16px; color: red;">สามารถขึ้นบรรทัดใหม่ด้วยการใส่ <b>&lt;br&gt;</b> ไว้ด้านหลังข้อความ</span>
        </div>
      </td>
    </tr>
    <tr>
      <td>วันที่</td>
      <td><input name="datetime" type="text" class="forntsarabun" size="20" value="<?=date("d-m-").(date("Y")+543)?>"></td>
    </tr>
    <tr>
      <td>แนบไฟล์ประกอบ</td>
      <td><input name="dataf" type="file" class="forntsarabun" id="dataf" size="40" maxlength="500" /></td>
    </tr>
    <tr>
      <td>ประกาศหน้าจอแพทย์</td>
      <td><input name="dr" type="checkbox" id="dr" value="Y"> 
        *ติ๊กในช่องเพื่อแสดงข่าวหน้าจอของแพทย์</td>
    </tr>
    <tr>
      <td>จำนวนวันประกาศข่าว</td>
      <td valign="top"><input name="numday" type="text" class="forntsarabun" id="numday" onKeyPress="return chkNumber(this)" value="7"  size="3" maxlength="2"> 
        วัน //* ใส่ได้เฉพาะตัวเลข 1-99</td>
    </tr>
    <tr>
      <td bgcolor="#99CC00">&nbsp;</td>
      <td bgcolor="#99CC00"><input name="B1" type="submit" class="forntsarabun" value="   ตกลง   ">
      <input name="B2" type="reset" class="forntsarabun" value="  ลบทิ้ง  "></td>
    </tr>
  </table>
</form>

</body>

<!--OnKeyPress="check_number();"-->