<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
?>
<body bgcolor='#808080' text='#FFFFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<form method="POST" action="opdhnadd.php" target="_BLANK">
  <table border="0" cellpadding="0" cellspacing="0" width="100%" height="367">
    <tr>
      <td width="1%" height="367"></td>
      <td width="99%" height="367">
    <p>&nbsp;&nbsp;<font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp; <b>บันทึกข้อมูลทำบัตรตรวจโรค&nbsp;&nbsp;&nbsp;
    HN </b></font><input type="text" name="hn" size="15"></p>
    <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; ยศ&nbsp;&nbsp; <input type="text" name="yot" size="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ชื่อ&nbsp; <input type="text" name="name" size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  สกุล&nbsp; <input type="text" name="surname" size="15">&nbsp;&nbsp;&nbsp;
    เพศ&nbsp; <select size="1" name="sex">
      <option selected>ช</option>
      <option>ญ</option>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เลขบัตร
    ปชช. <input type="text" name="idcard" size="15"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp; วันเกิด&nbsp;&nbsp; <input type="text" name="d" size="2" value="วว" maxlength="2"><input type="text" name="m" size="2" value="ดด" maxlength="2"><input type="text" name="y" size="4" value="พ.ศ." maxlength="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  เชื้อชาติ <select size="1" name="race">
    <option selected>01 ไทย</option>
    <option>02 จีน</option>
    <option>03 ลาว</option>
    <option>04 พม่า</option>
    <option>05 กัมพูชา</option>
    <option>06 อินเดีย</option>
    <option>07 เวียดนาม</option>
    <option>08 อื่นๆ</option>
  </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; สัญชาติ&nbsp;&nbsp; <select size="1" name="nation">
    <option selected>01 ไทย</option>
    <option>02 จีน</option>
    <option>03 ลาว</option>
    <option>04 พม่า</option>
    <option>05 กัมพูชา</option>
    <option>06 อินเดีย</option>
    <option>07 เวียดนาม</option>
    <option>08 อื่นๆ</option>
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ศาสนา&nbsp; <select size="1" name="religion">
    <option selected>พุทธ</option>
    <option>คริสต์</option>
    <option>อิสลาม</option>
    <option>อื่นๆ</option>
  </select>&nbsp;&nbsp;&nbsp;&nbsp; สถานภาพ<select size="1" name="married">
    <option selected>โสด</option>
    <option>สมรส</option>
    <option>หม้าย/หย่า</option>
    <option>อื่นๆ</option>
  </select></font></p>
    <p><font face="Angsana New">&nbsp;&nbsp; อาชีพ&nbsp; <select size="1" name="career">
    <option selected>...เลือกอาชีพ...</option>
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
    </select>&nbsp;&nbsp;&nbsp; ประเภท&nbsp; <select size="1" name="goup">
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
  </select>&nbsp;&nbsp;&nbsp; สังกัด&nbsp; <select size="1" name="camp">
    <option selected>M01&nbsp; พลเรือน</option>
    <option>M02&nbsp; ร.17 พัน2</option>
      <option>M03&nbsp; มณฑลทหารบกที่32</option>
      <option>M04&nbsp;
      ร.พ.ค่ายสุรศักดิ์มนตรี</option>
      <option>M05&nbsp; ช.พัน4</option>
      <option>M06&nbsp;
      ร้อยฝึกรบพิเศษประตูผา</option>
      <option>M07&nbsp; หน่วยทหารอื่นๆ</option>
    </select></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; ที่อยู่&nbsp; <input type="text" name="address" size="10">&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp; ตำบล&nbsp; <input type="text" name="tambol" size="10">&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp; อำเภอ&nbsp; <input type="text" name="ampur" size="10" value="เมือง">&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;
  จังหวัด&nbsp; <input type="text" name="changwat" size="10" value="ลำปาง">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  โทร. <input type="text" name="phone" size="10"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; ชื่อบิดา&nbsp;&nbsp;
  <input type="text" name="father" size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;ชื่อมารดา&nbsp;&nbsp; <input type="text" name="mother" size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp; ชื่อคู่สมรส&nbsp;&nbsp;&nbsp; <input type="text" name="couple" size="15"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; สิทธิการรักษา&nbsp;
  <select size="1" name="ptright">
    <option selected>R01&nbsp; เงินสด</option>
    <option>R02&nbsp; เบิกคลังจังหวัด</option>
   <option> R03&nbsp;รัฐวิสาหกิจ</option>
<option>R04&nbsp;พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ</option>
<option>R05&nbsp;ประกันสังคม</option>
<option>R06&nbsp;ประกันสุขภาพถ้วนหน้า(30บาท)</option>
<option>R07&nbsp;ก.ท.44(บาดเจ็บในงาน)</option>
<option>R08&nbsp;ประกันสุขภาพนักเรียน(บริษัท)</option>
<option>R09&nbsp; ศึกษาธิการ(ครูเอกชน)</option>  
  </select>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ผู้ใช้สิทธิเบิก&nbsp; <input type="text" name="guardian" size="15" value="ชื่อ-สกุล,เกี่ยวข้องเป็น">&nbsp;&nbsp;
  &nbsp;&nbsp;
  เลขบัตร ปชช.&nbsp; <input type="text" name="idguard" size="15"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;
  หมายเหตุ&nbsp;&nbsp;&nbsp; <input type="text" name="note" size="20"></font>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp&nbsp;
  <input type="submit" value="  บันทึก  " name="B1">&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  ลบทิ้ง  " name="B2">&nbsp&nbsp&nbsp&nbsp&nbsp;
  <a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
    </td>
    </tr>
  </table>
</form
</body>

