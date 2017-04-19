<?php
    session_start();
include("connect.inc");
$sql="select edpri,unitpri from druglst where drugcode='$Dgcode'";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);

if($rows["edpri"] > 0){
	if($rows["edpri"] < $rows["unitpri"]){  //ราคากลางน้อยกว่าราคาทุน/หน่วย
	$edpri=$rows["edpri"];  //ราคากลาง
	$unitpri=$rows["unitpri"];  //ราคาทุน/หน่วย
		echo "<script>alert('ยา $Dgcode มีการกำหนดราคาทุน/หน่วยมากกว่าราคากลางครับ');</script>";  //พี่มุ้ยสั่ง 7/4/60
		echo "<strong style='color:red;font-size:20px;'>กรุณาพิจารณาการสั่งซื้อยา $Dgcode  เนื่องจากราคาทุน/หน่วยสูงกว่าราคากลางที่กำหนด<br></strong>";
		echo "<strong style='color:blue;font-size:20px;'>ราคากลาง คือ $edpri บาท<br>ราคาทุน/หน่วย คือ $unitpri บาท</strong>";
		
	}
}

    print"<form method='POST' action='podginfo.php' target='top'>";
	print"<font face='Angsana New'><p>รายการสั่งซื้อที่ $x <span lang='en-us'>&nbsp; </span>บริษัท ($cComcode) $cComname</p>";
      	print"> รหัส<span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	   print"</span>&nbsp;<input type='text' name='drugcode' size='15' value='$Dgcode'><span lang='en-us'>&nbsp;&nbsp;";
	print"</span>ชื่อการค้า<span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	print"</span><input type='text' name='tradname' size='20' value='$Trade'><br>";
	print"หน่วยนับ <span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	print"</span> <input type='text' name='cPacking' size='15' value='$Packing'><span lang='en-us'>&nbsp;&nbsp;";
	      print"</span>ขนาดบรรจุ<span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp; </span><input type='text' name='cPack' size='18' value='$Pack'><br>";
	print"จำนวนวางระดับ <input type='text' name='nMinimum' size='10' value='$Minimum'><span lang='en-us'>&nbsp;&nbsp;";
	print"</span>จำนวนคงคลัง";
	print"<input type='text' name='nTotalstk' size='15' value='$Totalstk'><br>";
	print"</span>SPEC";
	print"<input type='text' name='nSpec' size='15' value='$Spec'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print"</span>SNSPEC";
	print"<input type='text' name='nSnspec' size='20' value='$Snspec'><br>";

	print"ราคา(+VAT)<span lang='en-us'>&nbsp;&nbsp;&nbsp; </span>";
	print"<input type='text' name='nPackpri_vat' size='10' value='$Packpri_vat'> บาท &nbsp;&nbsp;&nbsp; ราคา(ไม่รวมvat)<input type='text' name='nPackpri' size='10' value='$Packpri'> บาท<<<<<</p>";

	print"<p>********** จำนวนสั่งซื้อ <span lang='en-us'>&nbsp;&nbsp;&nbsp; </span> ";
	print"<input type='text' name='amount' size='15'><span lang='en-us'>&nbsp;&nbsp;";
	print"</span>หน่วย";
    print"&nbsp;</p>";
	?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       ตกลง       ' name='B1' onclick='window.open("","_self");self.setTimeout("window.close()",0);'></p>";
    <?
    print"</form>";
/*window.open('','_self');
self.setTimeout("window.close()",2000);*/
 ?>