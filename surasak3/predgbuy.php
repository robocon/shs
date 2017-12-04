<?php
    session_start();
    session_unregister("x");
    session_unregister("cComcode");
    session_unregister("cComname");

    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPacking");
    session_unregister("aPack");
    session_unregister("aAmount");
    session_unregister("aMinimum");
    session_unregister("aTotalstk");
    session_unregister("aPackpri");
    session_unregister("aPrice");
    session_unregister("aPackpri_vat");
    session_unregister("aPrice_vat");
	 session_unregister("aSpec");
 session_unregister("aSnspec");

  	$x=1;
	$cComcode="" ;
	$cComname="";
	$aDgcode = array("รหัสยา");
    	$aTrade  = array("ชื่อการค้า");
	$aPacking= array("หน่วยนับ");
    	$aPack = array("ขนาดบรรจุ");
    	$aAmount = array("จำนวนpack");
	$aMinimum= array("จำนวนวางระดับ");
    	$aTotalstk = array("จำนวนคงคลัง");
    	$aPackpri  = array("หน่วนละไม่รวมvat");
    	$aPrice  = array("เป็นเงินไม่รวมvat");
    	$aPackpri_vat  = array("หน่วนละรวมvat");
    	$aPrice_vat  = array("เป็นเงินรวมvat");
$aSpec  = array("SPEC");
$aSnspec  = array("SNSPEC");
    session_register("x");
    session_register("cComcode");
    session_register("cComname");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPacking");
    session_register("aPack");
    session_register("aAmount");
    session_register("aMinimum");
    session_register("aTotalstk");
    session_register("aPackpri");
    session_register("aPrice");
    session_register("aPackpri_vat");
    session_register("aPrice_vat");
	  session_register("aSpec");
	    session_register("aSnspec");



?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="compfrm.php">สั่งซื้อยาเวชภัณฑ์</a>&nbsp;&nbsp;จากบริษัทต่างๆ
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a target=_top  href="../nindex.htm"><< เลิกทำ,ไปเมนู</a>)</font><p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(เพื่อให้ข้อมูล อัตราการใช้ยา ยาเหลือใช้อีกกี่เดือน ถูกต้อง ควรทำการ<a target=_BLANK href="stkcorrect.php">ปรับปรุงข้อมูลคลังยา</a>&nbsp;&nbsp;&nbsp;&nbsp;ก่อนสั่งซื้อเสมอ)<p>





