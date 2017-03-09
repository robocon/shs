
<html>
<head>
<title>ประกาศข่าวสาร</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

</head>

<?php
 session_start();
include("connect.inc");
$thidate = (date("Y")+543).date("-m-d H:i:s"); 

$dd = mktime(0,0,0,date("m"),date("d")+$_POST['numday'],date("Y"));
$end_date=(date("Y")+543).date("-m-d",$dd);

 


			$dataf=$_FILES['dataf']['tmp_name'];
			$dataf_name=$_FILES['dataf']['name'];
			$dataf_size=$_FILES['dataf']['size'];
			$dataf_type=$_FILES['dataf']['type'];

			$structure='file_news';
			
			

     $sql = "INSERT INTO new(depart,new,datetime,user,date,dr,numday)VALUES('$depart','$new','$datetime','$sOfficer','$thidate','$dr','$end_date');";
      $result = mysql_query($sql);

	  if($result)
		{
			//ไฟล์ประกอบข่าว
			if(empty($dataf))
				{
							echo"<CENTER>คุณไม่ได้เลือกไฟล์ประกอบข่าว หรือ <BR> ขนาดไฟล์ที่คุณทำการ Upload นั้นอาจมีขนาดใหญ่เกินไป ท่านสามารถ อัพไฟล์ได้ไม่เกิน 2 Mb.  กรุณาเลือกไฟล์ใหม่</CENTER>";
				} else
					{
						$ext=strtolower(end(explode('.',$dataf_name)));
						if($ext=="doc" or  $ext=="pdf" or $ext=="docx" or $ext=="xls" or $ext=="xlsx" or $ext=="ppt" or $ext=="pptx")
							{
								$sql="select  max(row) from new";
								$result=mysql_query($sql);
								$r=mysql_fetch_array($result);
								$id_max=$r[0];
								

								$filename=$id_max .".". $ext;
		
								copy($dataf, "$structure/$filename");

								$sql1="update new set file='$filename' where row ='$id_max' ";
								$sql_query = mysql_query($sql1) or die ("Error Query [".$sql."]"); 

							}else
								{
									echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>ไฟล์ที่คุณเลือก ไม่สามารถ Upload ได้ กรุณาเลือกไฟล์ที่มีนามสกุลดังนี้  .doc.pdf  </CENTER></B></FONT> ";
								}
					}			//ปิดไฟล์ประกอบข่าว
					
					} //ปิด result ไว้ท้ายสุด
			
echo "<meta http-equiv=refresh content=2;URL=newedit.php>";
echo "<br><CENTER><B><FONT SIZE=\"+1\" COLOR=\"#CC0000\">เพิ่มข้อมูลข่าวสารเรียบร้อยแล้ว<BR> กรุณารอสักครู่เพื่อไปยังหน้ารายการข่าว........</FONT></B></CENTER><br>";

      /*if ($result){
           print "<br><br><br>";
           //print "บันทึกเรียบร้อย<br>";      
           print "บันทึกข้อมูลเรียบร้อย";
		   print "<meta http-equiv='refresh' content='1;URL=newedit.php'>";
			 }
      else { 
           //print "<br><br><br>รหัส  :$idname  ซ้ำของเดิม โปรดแก้ไข<br>";
		   print "<br>เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้<br>";
		   print "<meta http-equiv='refresh' content='1;URL=newadd.php'>";
              }*/
include("unconnect.inc");
?>


