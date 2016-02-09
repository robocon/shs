<?
header("content-type: text/html; charset=tis-620");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

include("connect.inc");   
          
$data = $_GET['data'];  //type
$val = $_GET['val'];  // id
$datar = $_GET['datar'];  //type
$valr = $_GET['valr'];  // id

     if ($data=='type') { 
		 $val = substr($_GET['val'],0,3);  // id
		  echo "<select name='subgroup'>\n";
		  if($val =="G40"){
               echo "<option value=\"(ก) บิดามารดาของสามีหรือภรรยาที่ถูกต้องตามกฎหมายของกำลังพล ทบ.\" >บิดามารดาของสามีหรือภรรยาที่ถูกต้องตามกฎหมายของกำลังพล ทบ.</option> \n" ;
			   echo "<option value=\"(ข) พี่น้องร่วมบิดามารดาเดียวกันของกำลังพล ทบ.\" >พี่น้องร่วมบิดามารดาเดียวกันของกำลังพล ทบ.</option> \n" ;
			   echo "<option value=\"(ค) ปู่ ย่า ตา ยาย ของกำลังพล ทบ.และ สามีหรือภรรยาที่ถูกต้องตามกฎหมาย\" >ปู่ ย่า ตา ยาย ของกำลังพล ทบ.และ สามีหรือภรรยาที่ถูกต้องตามกฎหมาย</option> \n" ;
			   echo "<option value=\"(ง) ลุง ป้า น้า อา ของกำลังพล ทบ.และ สามีหรือภรรยาที่ถูกต้องตามกฎหมาย\" >ลุง ป้า น้า อา ของกำลังพล ทบ.และ สามีหรือภรรยาที่ถูกต้องตามกฎหมาย</option> \n" ;
		}else{
          echo "<option value=''>-------------- ไม่ต้องเลือกข้อมูล --------------</option>\n";	
		}
	}
     echo "</select>\n";
	 
	if($data=='doctor') { 
          echo "<select name='doctor' onChange=\"dochange('clinic', this.value)\">\n";
          echo "<option value='0'>--------------- เลือกแพทย์ ---------------</option>\n";
          $result=mysql_query("select * from doctor where status='y' ORDER BY opdstatus DESC , row_id ASC");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[row_id]\" >$row[name]</option> \n" ;
          }
	}
	echo "</select>\n";
	
	
	if($data=='clinic' && $datar =='room'){
		echo "<select name='clinic'>\n";
		echo "<option value='0'>----- เลือกคลีนิค -----</option>\n"; 
		$result=mysql_query("SELECT * FROM doctor WHERE status='y' and row_id= '$val'");
			while($row = mysql_fetch_array($result)){
					echo "<option value=\"$row[position]\" selected=\"selected\">$row[position]</option> \n" ;
			}
			echo " <option value='99 เวชปฏิบัติ'>เวชปฏิบัติ</option>";
			echo " <option value='01 อายุรกรรม'>อายุรกรรม</option>";
			echo " <option value='02 ศัลยกรรม'>ศัลยกรรม</option>";
			echo " <option value='03 สูติกรรม'>สูติกรรม</option>";
			echo " <option value='04 นารีเวชกรรม'>นารีเวชกรรม</option>";
			echo " <option value='05 กุมารเวช'>กุมารเวช</option>";
			echo " <option value='06 โสต ศอ นาสิก'>โสต สอ นาสิก</option>";
			echo " <option value='07 จักษุ'>จักษุ</option>";
			echo " <option value='08 ศัลยกรรมกระดูก'>ศัลยกรรมกระดุก</option>";
			echo " <option value='09 จิตเวช'>จิตเวช</option>";
			echo " <option value='10 รังษีวิทยา'>รังษีวิทยา</option>";
			echo " <option value='11 ทันตกรรม'>ทันตกรรม</option>";
			echo " <option value='12 ฉุกเฉิน'>ฉุกเฉิน</option>";
			echo " <option value='13 กายภาพบำบัด'>กายภาพบำบัด</option>";
			echo " <option value='14 แพทย์แผนไทย'>แพทย์แผนไทย</option>";
			echo " <option value='15 PCU ใน รพ.'>PCU ใน รพ.</option>";
			echo " <option value='01 คลินิก COPD'>คลินิก COPD</option>";
			echo " <option value='99 ศัลยกรรมทางเดินปัสสาวะ'>ศัลยกรรมทางเดินปัสสาวะ</option>";
			echo " <option value='16 คลินิกโรคไต'>คลินิกโรคไต</option>";
			echo " <option value='99 อื่นๆ'>อื่นๆ</option>";
					if($_SESSION["smenucode"] != "ADMMAINOPD"){
					echo " <option value='14 เวชศาสตร์ฟื้นฟู'>เวชศาสตร์ฟื้นฟู</option>";
					}
					echo " <option value='99 อื่นๆ'>อื่นๆ</option>";					
		}			  
		echo "</select>\n";
	
	if($data=='clinic' && $datar =='room'){
		 echo "<select name='room'>\n";
		echo "<option value='0'>----- เลือกห้อง -----</option>\n"; 
		 $result=mysql_query("SELECT * FROM doctor WHERE status='y' and row_id= '$valr'");
		 while($row = mysql_fetch_array($result)){
		   echo "<option value=\"$row[room]\" selected=\"selected\">$row[room]</option> \n" ;
		 }
		 echo "<option value='ห้องตรวจเฉพาะโรค'>ห้องตรวจเฉพาะโรค</option>\n"; 		 
		 echo "<option value='ห้อง 1'>ห้อง 1</option>\n";
		 echo "<option value='ห้อง 2'>ห้อง 2</option>\n";
		 echo "<option value='ห้อง 3'>ห้อง 3</option>\n";
		 echo "<option value='ห้อง 4'>ห้อง 4</option>\n";
		 echo "<option value='ห้อง 5'>ห้อง 5</option>\n";
		 echo "<option value='ห้อง 6'>ห้อง 6</option>\n";
		 echo "<option value='ห้อง 7'>ห้อง 7</option>\n";
		 echo "<option value='ห้อง 8'>ห้อง 8</option>\n"; 	 	
		 echo "<option value='ห้อง 9'>ห้อง 9</option>\n"; 	 
		 echo "<option value='ห้อง 10'>ห้อง 10</option>\n";	 
		 echo "<option value='ห้อง ...............'>ห้อง .............</option>\n"; 	 	 
	}			  
	echo "</select>\n";
		
	
?>