<?
session_start();
?>
<script language="JavaScript">
function checksubmit() {
if(document.form1.slipcode.value=="") {
alert("กรุณาระบุรหัสจ่ายยา") ;
document.form1.slipcode.focus() ;
return false ;
}else if(document.form1.detail1.value=="") {
alert("กรุณาระบุรายการ1") ;
document.form1.detail1.focus() ;
return false ;
}else if(document.form1.detail2.value=="") {
alert("กรุณาระบุรายการ2") ;
document.form1.detail2.focus() ;
return false ;
}else if(document.form1.detail3.value=="") {
alert("กรุณาระบุรายการ3") ;
document.form1.detail3.focus() ;
return false ;
}
}
</script>
<body>
<?php include("dt_menu.php");?>
<form name="form1" method="POST" action="dt_rxadd.php">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
  <p>&nbsp;&nbsp;&nbsp;<strong>เพิ่มข้อมูลทำสลากยา</strong></p>
  <p>&nbsp;&nbsp; &#3619;&#3627;&#3633;&#3626;&#3592;&#3656;&#3634;&#3618;&#3618;&#3634;&nbsp; &nbsp;&nbsp;&nbsp;
  <input type="text" name="slipcode" id="slipcode" size="12">
  รหัสต้องไม่เกิน 15 ตัวอักษร
  ตัวอย่าง. ann1*3 หมายถึง ann คือชื่อย่อแพทย์, 1*3 คือรับประทานครั้งละ 1 เม็ด 3 เวลา</p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input name="detail1" type="text" id="detail1" value="รับประทานครั้งละ 1 เม็ด" size="48">
  ตัวอย่าง. รับประทานครั้งละ 1 เม็ด
  </p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="detail2" type="text" id="detail2" value="วันละ 3 ครั้ง หลังอาหาร" size="48"> 
  ตัวอย่าง. วันละ 3 ครั้ง หลังอาหาร</p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 3&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
  <input name="detail3" type="text" id="detail3" value="เช้า-กลางวัน-เย็น" size="48"> 
  ตัวอย่าง. เช้า-กลางวัน-เย็น</p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 4&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
  <input type="text" name="detail4" id="detail4" size="1"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;
  <input type="submit" value="  &#3605;&#3585;&#3621;&#3591;  " onClick="JavaScript:return checksubmit();" name="B1">&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2"></p>
  <p>&nbsp;</p>
</form>

</body>

