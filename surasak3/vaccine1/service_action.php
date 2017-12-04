<?
@ob_start();
@session_start(); 
?>


<body>

<script>
function fncGo()
{
if(confirm('คุณต้องการบันทึกต่อ')==true)
{
window.location='service_action.php?do=confrim';
}
}
</script>
<?
include("Connections/connect.inc.php"); 


 if($_GET['do']=='add'){
	 
	 	
		$hn=$_POST['hn'];
		$vaccine = $_POST['vaccine'];
		$vaccine_detail = $_POST['vaccine_detail'];
		$unit=$_POST['unit'];
		$doctor =$_POST['doctor'];
		$lotno=$_POST['lotno'];
		$lotno2=$_POST['lotno2'];
		//$date1 =$_POST['date1'];////date_ser
		$date2 =$_POST['date2'];//date_end
		$date3 =$_POST['date3'];//date_end2
		
		$d1=substr($_POST['date1'],0,2);
		$m1=substr($_POST['date1'],3,2);
		$y1=substr($_POST['date1'],6,4);
		$y1=($y1)-543;
		$date1=$y1.'-'.$m1.'-'.$d1;
		
		
		$_SESSION["hn"] = $hn; 
		$_SESSION["vaccine"] = $vaccine; 
		$_SESSION["vaccine_detail"] = $vaccine_detail; 
		$_SESSION["unit"] = $unit; 
		$_SESSION["doctor"] = $doctor; 
		$_SESSION["date1"] = $date1; 
		$_SESSION["date2"] = $date2; 
		$_SESSION["date3"] = $date3; 
		
	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'/'.$m.'/'.$y.' '.date('H:i:s');
		
		
		$sql="select  *  from  tb_service   where  (hn='$hn') and (id_vac='$vaccine') and (num='$vaccine_detail') and (date_ser='$date1')";
		$query=mysql_query($sql);
		$numrows=mysql_num_rows($query);

		if($numrows){
				echo "<h4 align=center>บันทึกข้อมูลการฉีดยา ซ้ำ !!</h4></br>";
				echo "<center><input type='submit' name='con' value='ดำเนินการต่อเพื่อบันทึก'  onclick='fncGo();'>" ;
				?>
                <input name="btnButton" type="button" value="กลับไปแก้ไข" onClick="JavaScript:window.location='service.php?hn=<?=$hn?>';">
                <?
				exit();

			}else{
	  
		 $sql_add2="INSERT INTO tb_service (date_ser,hn,id_vac,num,unit,name_doc,lotno,date_end,lotno2,date_end2,date_insert) VALUES ('$date1','$hn','$vaccine','$vaccine_detail','$unit','$doctor','$lotno','$date2','$lotno2','$date3','$datetime') ";
		 $query_add2=mysql_query($sql_add2);


//echo $sql_add2;
			if($query_add2){
			echo"<h1 align=center>บันทึกข้อมูลเรียบร้อยแล้ว</h1>";
			session_destroy(); 
		echo "<meta http-equiv='refresh' content='2; url=service.php'>" ;
			}else {
			echo "<h1 align=center>ไม่สามารถเพิ่มข้อมูลได้</h1>";
			echo "<meta http-equiv='refresh' content='2; url=service.php'>" ;
			}//*ปิด queryadd2
	}//**ปิด if rows
 
 }//**** ปิดloop add
 
 

if($_GET['do']=='confrim'){
	
	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'/'.$m.'/'.$y.' '.date('H:i:s');
	
	
		$_SESSION["hn"] = $hn; 
		$_SESSION["vaccine"] = $vaccine; 
		$_SESSION["vaccine_detail"] = $vaccine_detail; 
		$_SESSION["unit"] = $unit; 
		$_SESSION["doctor"] = $doctor; 
		$_SESSION["date1"] = $date1; 
		$_SESSION["date2"] = $date2; 
		$_SESSION["date3"] = $date2; 

		
			 $sql_add3="INSERT INTO tb_service (date_ser,hn,id_vac,num,unit,name_doc,lotno,date_end,lotno2,date_end2,date_insert) VALUES ('$date1','$hn','$vaccine','$vaccine_detail','$unit','$doctor','$lotno','$date2','$lotno2','$date3','$datetime') ";
			 $query_add3=mysql_query($sql_add3);
		 
	//	echo $sql_add3;
		 
			 if($query_add3){
			echo"<h1 align=center>บันทึกข้อมูลเรียบร้อยแล้ว</h1>";
			session_destroy(); 
			echo "<meta http-equiv='refresh' content='2; url=service.php'>" ;
			
			}else {
			echo "<h1 align=center>ไม่สามารถเพิ่มข้อมูลได้</h1>";
			echo "<meta http-equiv='refresh' content='2; url=service.php'>" ;
			}	
}
?>
</body>
