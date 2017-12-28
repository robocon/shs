<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
    $aMancode=array("aMancode"); 
	$aMancode[1]='director';
	$aMancode[2]='pharmacy';
	$aMancode[3]='logis';
	$aMancode[4]='logis2';
	$aMancode[5]='budget';
	$aMancode[6]='reciever';
	$aMancode[7]='reciever2';
	$aMancode[8]='reciever3';
	$aMancode[9]='witness';
	$aMancode[10]='witness2';
	$aMancode[11]='headmony';
	$aMancode[12]='headmonysub';
	$aMancode[13]='headmony2';

	include("connect.inc");

	print"<b>รายชื่อเจ้าหน้าที่เดิมงานจัดซื้อ สป.สายแพทย์</b><br>";
	for ($n=1; $n<=13; $n++){

		$query = "SELECT * FROM officers_purchase WHERE mancode = '$aMancode[$n]'";
		$result = mysql_query($query)
			or die("Query failed");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
				 }

			if(!($row = mysql_fetch_object($result)))
				continue;
				 }
		$aYot[$n]	=$row->yot; 
		$aFname[$n] =$row->fullname; 
		$aPost[$n]  =$row->position; 
		$aPost2[$n] =$row->position2; 

//		print"$n,$aYot[$n] $aFname[$n],$aPost[$n],$aPost2[$n]<br>";
		print"$n $aPost[$n] $aPost2[$n]#...";
		print"<b>$aYot[$n] $aFname[$n]</b><br>";

			}

/*
CREATE TABLE officers_purchase (
  row_id int(11) NOT NULL auto_increment,
  mancode varchar(16) default NULL,
  position varchar(40) default NULL,
  position2 varchar(40) default NULL,
  yot varchar(40) default NULL,
  fullname varchar(40) default NULL,
  PRIMARY KEY  (row_id),
  KEY mancode (mancode)
) TYPE=MyISAM;
*/

	include("unconnect.inc");

	print"----------------------------------------------------------------";
	print"<br><font face='Angsana New' size=5><b>ถ้าต้องการแก้ไขรายชื่อ  โปรดแก้ไขด้านล่าง</b><br>";
	print"---|ยศ|--- ---|ชื่อ|--- ---|ตำแหน่ง|--- ---|ตำแหน่ง|---";
    print"<form method='POST' action='purchase_officerok.php'>";

	print"<b>ผู้อำนวยการโรงพยาบาล</b><br>";
    print"<input type='text' name='yot1' size='8' value='$aYot[1]'>
		  <input type='text' name='fname1'size='20' value='$aFname[1]'>
		  <input type='text' name='post1' size='25' value='$aPost[1]'>
		  <input type='text' name='post21'size='25' value='$aPost2[1]'><br>";
	print"<b>หัวหน้าเจ้าหน้าที่พัสดุ </b><br>";
    print"<input type='text' name='yot2' size='8' value='$aYot[2]'>
		  <input type='text' name='fname2'size='20' value='$aFname[2]'>
		  <input type='text' name='post2' size='25' value='$aPost[2]'>
		  <input type='text' name='post22'size='25' value='$aPost2[2]'><br>";
    print"<b>หัวหน้าแผนกส่งกำลังและบริการ</b><br>";
    print"<input type='text' name='yot3' size='8' value='$aYot[3]'>
		  <input type='text' name='fname3'size='20' value='$aFname[3]'>
		  <input type='text' name='post3' size='25' value='$aPost[3]'>
		  <input type='text' name='post23'size='25' value='$aPost2[3]'><br>";
	print"<b>นายทหารส่งกำลังสายแพทย์</b><br>";
    print"<input type='text' name='yot4' size='8' value='$aYot[4]'>
		  <input type='text' name='fname4'size='20' value='$aFname[4]'>
		  <input type='text' name='post4' size='25' value='$aPost[4]'>
		  <input type='text' name='post24'size='25' value='$aPost2[4]'><br>";
		    	print"<b>หัวหน้าการเงิน</b><br>";
    print"<input type='text' name='yot11' size='8' value='$aYot[11]'>
		  <input type='text' name='fname11'size='20' value='$aFname[11]'>
		  <input type='text' name='post11' size='25' value='$aPost[11]'>
		  <input type='text' name='post211'size='25' value='$aPost2[11]'><BR>";
	
	print"<input type='text' name='yot13' size='8' value='$aYot[13]'>
		  <input type='text' name='fname13'size='20' value='$aFname[13]'>
		  <input type='text' name='post13' size='25' value='$aPost[13]'>
		  <input type='text' name='post213'size='25' value='$aPost2[13]'><BR>";


	print"<b>เจ้าหน้าที่งบประมาณ</b><br>";
    print"<input type='text' name='yot5' size='8' value='$aYot[5]'>
		  <input type='text' name='fname5'size='20' value='$aFname[5]'>
		  <input type='text' name='post5' size='25' value='$aPost[5]'>
		  <input type='text' name='post25'size='25' value='$aPost2[5]'><br>";
	print"<b>กรรมการตรวจรับพัสดุ</b><br>";
    print"<input type='text' name='yot6' size='8' value='$aYot[6]'>
		  <input type='text' name='fname6'size='20' value='$aFname[6]'>
		  <input type='text' name='post6' size='25' value='$aPost[6]'>
		  <input type='text' name='post26'size='25' value='$aPost2[6]'><br>";

    print"<input type='text' name='yot7' size='8' value='$aYot[7]'>
		  <input type='text' name='fname7'size='20' value='$aFname[7]'>
		  <input type='text' name='post7' size='25' value='$aPost[7]'>
		  <input type='text' name='post27'size='25' value='$aPost2[7]'><br>";

    print"<input type='text' name='yot8' size='8' value='$aYot[8]'>
		  <input type='text' name='fname8'size='20' value='$aFname[8]'>
		  <input type='text' name='post8' size='25' value='$aPost[8]'>
		  <input type='text' name='post28'size='25' value='$aPost2[8]'><br>";

	print"<b>พยาน</b><br>";
    print"<input type='text' name='yot9' size='8' value='$aYot[9]'>
		  <input type='text' name='fname9'size='20' value='$aFname[9]'>
		  <input type='text' name='post9' size='25' value='$aPost[9]'>
		  <input type='text' name='post29'size='25' value='$aPost2[9]'><br>";

    print"<input type='text' name='yot10' size='8' value='$aYot[10]'>
		  <input type='text' name='fname10'size='20' value='$aFname[10]'>
		  <input type='text' name='post10' size='25' value='$aPost[10]'>
		  <input type='text' name='post210'size='25' value='$aPost2[10]'><br>";

		



    print"<br><input type='submit' value='  แก้ไขถูกต้อง   ' name='B1'></font></p>";
    print"</form>";
?>