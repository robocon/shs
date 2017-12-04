<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
?>
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td width='13%'></td>
      <td width='87%'>&nbsp;
        <p><b><font size='4'>โปรดทราบ !</font></b><br>
	ถ้าเลือก ทำต่อไป โปรแกรมจะตั้งค่า 0 ให้การจ่ายสะสมยาทุกตัว<br>
	และเก็บข้อมูลจำนวนจ่ายยาทุกตัว จนกว่าจะตั้งค่า 0 ใหม่<br>
	ข้อมูลนี้ใช้ในการคำนวณหา อัตราการจ่ายยาต่อเดือน <br>
	และคำนวณหาจำนวนเดือนที่ยาจะเหลือพอใช้ได้<br>
        <br>
               <a target=_parent href="drxaccum.php">ทำต่อไป</a>
               &nbsp;&nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><< ยกเลิก</a></td>
    </tr>
  </table>
</div>



