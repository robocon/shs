<body bgcolor="#669999" text="#FFFFFF">

<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		var stat = true;
		var id13 = document.f1.idcard.value;
		var sum = 0;
		if(id13.length != 13){
			stat = false;
		}

		if(stat == true){
				
				for (i = 0; i < 12; i++)
				{
					sum += eval(id13.charAt(i)) * (13 - i);
				}

			sum = ((11 - (sum % 11)) % 10)
			
			if(eval(id13.charAt(12)) != sum)
				stat = false;
		}

		return stat;
	}

</SCRIPT>

<form name="f1" method="POST" action="opdadd.php" Onsubmit="return checkForm();">

<TABLE style="font-family: Angsana New;">
<TR>
	<TD align="right">ยศ&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="yot" size="5" ></TD>
	<TD align="right">ชื่อ&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="name" size="15" ></TD>
	<TD align="right">สกุล&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="surname" size="15"></TD>
</TR>
<TR>
	<TD align="right">เพศ&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="sex">
			<option selected>?</option>
			<option>ช</option>
			<option>ญ</option>
		</select>
	</TD>
	<TD align="right">เลขบัตร ปชช.&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="idcard" size="15" value="-" maxlength="13"></TD>
	<TD></TD>
	<TD></TD>
</TR>
<TR>
	<TD align="right">วันเกิด&nbsp;:&nbsp;</TD>
	<TD colspan="5">
		<input type="text" name="d" size="2" value="วว" maxlength="2">
		<input type="text" name="m" size="2" value="ดด" maxlength="2">
		<input type="text" name="y" size="4" value="พ.ศ." maxlength="4"></TD>
</TR>
<TR>
	<TD align="right">เชื้อชาติ&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="race">
		<option selected>ไทย</option>
		<option>จีน</option>
		<option>ลาว</option>
		<option>พม่า</option>
		<option>กัมพูชา</option>
		<option>อินเดีย</option>
		<option>เวียดนาม</option>
		<option>อื่นๆ</option>
		</select>
	</TD>
	<TD align="right">สัญชาติ&nbsp;:&nbsp;</TD>
	<TD>
	<select size="1" name="nation">
    <option selected>ไทย</option>
    <option>จีน</option>
    <option>ลาว</option>
    <option>พม่า</option>
    <option>กัมพูชา</option>
    <option>อินเดีย</option>
    <option>เวียดนาม</option>
    <option>อื่นๆ</option>
  </select>
  </TD>
  	<TD align="right">ศาสนา&nbsp;:&nbsp;</TD>
	<TD>
	<select size="1" name="religion">
    <option selected>พุทธ</option>
    <option>คริสต์</option>
    <option>อิสลาม</option>
    <option>อื่นๆ</option>
   </select>
   </TD>
</TR>
<TR>
	<TD align="right">สถานภาพ&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="married">
		<option selected><-เลือก-></option>
		<option >โสด</option>
		<option>สมรส</option>
		<option>หม้าย/หย่า</option>
		<option>อื่นๆ</option>
		</select>
	</TD>
	<TD align="right">อาชีพ&nbsp;:&nbsp;</TD>
	<TD colspan="3">
		<select size="1" name="career">
    <option selected><-เลือก-></option>
    <option>01&nbsp;&nbsp; เกษตรกร</option>
      <option>02&nbsp;&nbsp; รับจ้างทั่วไป</option>
      <option>03&nbsp;&nbsp; ช่างฝีมือ</option>
      <option>04&nbsp;&nbsp; ธุรกิจ&nbsp;&nbsp; </option>
      <option>05&nbsp;&nbsp; ทหาร/ตำรวจ</option>
      <option>06&nbsp;&nbsp;
      นักวิทยาศาตร์และนักเทคนิก</option>
      <option>07&nbsp;&nbsp;
      บุคลากรด้านสาธารณสุข</option>
      <option>08&nbsp;&nbsp;
      นักวิชาชีพ/นักวิชาการ</option>
      <option>09&nbsp;&nbsp; ข้าราชการทั่วไป</option>
      <option>10&nbsp;&nbsp; รัฐวิสาหกิจ</option>
      <option>11&nbsp;&nbsp;
      ผู้เยาว์ไม่มีอาชีพ</option>
      <option>12&nbsp;&nbsp;
      นักบวช/งานด้านศาสนา</option>
      <option>13&nbsp;&nbsp; อื่นๆ</option>
    </select>
	</TD>
</TR>
<TR>
	<TD align="right">ประเภท&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="goup">
    <option selected><-เลือก-></option>
    <option>G11&nbsp;ก.1 นายทหารประจำการ</option>
    <option>G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ</option>
  <option>G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน</option>
 <option>G14&nbsp;ก.4 ลูกจ้างประจำ</option>
 <option>G15 &nbsp;ก.5 ลูกจ้างชั่วคราว</option>
 <option>G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ</option>
 <option>G22&nbsp;ข.2 นักเรียนทหาร</option>
 <option>G23 &nbsp;ข.3 อาสาสมัครทหารพราน</option>
 <option>G24 &nbsp;ข.4 นักโทษทหาร</option>
 <option>G31&nbsp;ค.1 ครอบครัวทหาร</option>
 <option>G32&nbsp;ค.2 ทหารนอกประจำการ
 <option>G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)</option>
 <option>G34&nbsp;ค.4 วิวัฒน์พลเมือง</option>
 <option>G35&nbsp;ค.5 บัตรประกันสังคม
 <option>G36&nbsp;ค.6 บัตรทอง30บาท</option>
 <option>G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</option>
 <option>G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</option>
 <option>G39&nbsp;ค.9 อื่นๆไม่ระบุ
  </select>
	</TD>
	<TD align="right">สังกัด&nbsp;:&nbsp;</TD>
	<TD colspan="3">
	<select size="1" name="camp">
    <option selected><-เลือก-></option>
    <option>M01&nbsp; พลเรือน</option>
    <option>M02&nbsp; ร.17 พัน2</option>
      <option>M03&nbsp; มณฑลทหารบกที่32</option>
      <option>M04&nbsp;
      ร.พ.ค่ายสุรศักดิ์มนตรี</option>
      <option>M05&nbsp; ช.พัน4</option>
      <option>M06&nbsp;
      ร้อยฝึกรบพิเศษประตูผา</option>
      <option>M07&nbsp; หน่วยทหารอื่นๆ</option>
    </select>
	</TD>
</TR>
<TR>
	<TD align="right">ที่อยู่&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="address" size="20"></TD>
	<TD align="right">ตำบล&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="tambol" size="10"></TD>
	<TD align="right">อำเภอ&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="ampur" size="10" value="เมือง"></TD>
</TR>
<TR>
	<TD align="right">จังหวัด&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="changwat" size="10" value="ลำปาง"></TD>
	<TD align="right">โทร.&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="phone" size="10" value="-"></TD>
	<TD></TD>
	<TD></TD>
</TR>
<TR>
	<TD align="right">ชื่อบิดา&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="father" size="20" value="-"></TD>
	<TD align="right">ชื่อมารดา&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="mother" size="20" value="-" ></TD>
	<TD align="right">ชื่อคู่สมรส&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="couple" size="20" value="-"></TD>
</TR>
<TR>
	<TD align="right">ผู้ที่สามารถติดต่อได้&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="ptf" size='20'  value="-"></TD>
	<TD align="right">เกี่ยวข้องเป็น&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="ptfadd" size='10'  value="-"></TD>
	<TD align="right">โทรศัพท์ผู้ที่ติดต่อ&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="ptffone" size='10'  value="-"></TD>
</TR>
<TR>
	<TD align="right">สิทธิการรักษา&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="ptright">
    <option selected><-เลือก-></option>
    <option>R01&nbsp;เงินสด</option>
    <option>R02&nbsp;เบิกคลังจังหวัด</option>
<option>R03&nbsp;โครงการโรครักษาต่อเนื่อง</option>
<option> R04&nbsp;รัฐวิสาหกิจ</option>
<option>R05&nbsp;บริษัท(มหาชน)</option>
<option>R07&nbsp;ประกันสังคม</option>
<option>R09&nbsp;ประกันสุขภาพถ้วนหน้า</option>
<option>R10&nbsp;ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)</option>
<option>R11&nbsp;ประกันสุขภาพถ้วนหน้า(มาตรา8)</option>
<option>R12&nbsp;ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก,ผู้พิการ)</option>
<option>R16&nbsp;ศึกษาธิการ(ครูเอกชน)</option>  
<option>R17&nbsp;พลทหาร</option>  
<option >R21&nbsp;องค์กรปกครองส่วนท้องถิ่น</option>
 </select>
	</TD>
	<TD align="right">เบิกจาก&nbsp;:&nbsp;</TD>
	<TD>
		<select   size="1" name="ptfmon">
		<option selected><-เลือก-></option>
		<option >MO01&nbsp; ตนเอง</option>
		<option>MO02&nbsp; บิดา</option>
		<option  >MO03&nbsp; มารดา</option>
		<option >MO04&nbsp; บุตร</option>
		<option  >MO05&nbsp; คู่สมรส</option>
		</select>
	</TD>
	<TD align="right">ปชป.เจ้าของสิทธิ&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="guardian" size='13'  value="-"></TD>
</TR>
<TR>
	<TD align="right">หมายเหตุ&nbsp;:&nbsp;</TD>
	<TD colspan="5">
	<select size="1" name="idguard">
 <option selected><-เลือก-></option>
<option ></option>
<option >MX01&nbsp; ทหาร/ครอบครัว</option>
 <option >MX02&nbsp; มีปัญหาเรื่องสิทธิ</option>
 <option >MX03&nbsp; VIP</option>
  </select>
 หมายเหตุ&nbsp;:&nbsp;<input type="text" name="note" size="50" value="-"></TD>
</TR>
<TR>
	<TD colspan="6" align="center">
	<input type="submit" value="  บันทึก  " name="B1">
	&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  ลบทิ้ง  " name="B2">&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_self"  href="../nindex.htm">&lt;&lt;ไปเมนู</a>
  </TD>
</TR>
</TABLE>

</form>
</body>



