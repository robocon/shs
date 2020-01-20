<?
header("content-type: text/html; charset=tis-620");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
?>
<style type="text/css">
<!--
.txtsarabun {	font-family: "TH SarabunPSK";
	font-size: 16px;
}
-->
</style>
<?
include("connect.inc");   
          
$data = $_GET['data'];  //type
$val = $_GET['val'];  // id
$datar = $_GET['datar'];  //type
$valr = $_GET['valr'];  // id

     if ($data=='type') { 
		 $val = substr($_GET['val'],0,3);  // id
		  echo "<select name='subgroup' class='txtsarabun'>\n";
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
          echo "<select name='doctor' onChange=\"dochange('clinic', this.value)\" class='txtsarabun'>\n";
          echo "<option value='0'>--------------- เลือกแพทย์ ---------------</option>\n";
          $result=mysql_query("select * from doctor where status='y' ORDER BY opdstatus DESC , row_id ASC");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[row_id]\" >$row[name]</option> \n" ;
          }
	}
	echo "</select>\n";
	
	
	if($data=='clinic' && $datar =='room'){
		echo "<select name='clinic' class='txtsarabun'>\n";
		echo "<option value='0'>----- เลือกคลีนิค -----</option>\n"; 
		$result=mysql_query("SELECT * FROM doctor WHERE status='y' and row_id= '$val'");
			while($row = mysql_fetch_array($result)){
					echo "<option value=\"$row[clinic]\" selected=\"selected\">$row[clinic]</option> \n" ;
			}
		$result1=mysql_query("SELECT * FROM clinic");
			while($row1 = mysql_fetch_array($result1)){
					echo "<option value=\"$row1[detail]\">$row1[detail]</option> \n" ;
			}				
		}			  
		echo "</select>\n";
	
	if($data=='clinic' && $datar =='room'){
		 echo "<select name='room' class='txtsarabun'>\n";
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