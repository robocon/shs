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
	ต้องการรับเป็นผู้ป่วยในให้เลือก  รับป่วยเป็นคนไข้ใน (admit)<br>
	โปรแกรมจะกำหนดหมายเลข AN ให้และห้ามผู้อื่นใช้<br>
	ถ้าไม่ใช้จะทิ้งหมายเลขนี้ไป<br>
        <br>
               <a target=_parent href="opipcard.php">รับป่วยเป็นผู้ป่วยใน</a>
               &nbsp;&nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><< ยกเลิก</a></td>
    </tr>
  </table>
</div>



