<body>

<?
 $link = mysql_connect("localhost", "root", "1234");
mysql_select_db("smdb", $link);

		$hn=$_POST['hn'];
		$vaccine = $_POST['vaccine'];
		$vaccine_detail = $_POST['vaccine_detail'];
		$unit=$_POST['unit'];
		$doctor =$_POST['doctor'];
		$lotno=$_POST['lotno'];
		$lotno2=$_POST['lotno2'];
		$date1 =$_POST['date1'];////date_ser
		$date2 =$_POST['date2'];//date_end
		$date3 =$_POST['date3'];//date_end2
		
	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'/'.$m.'/'.$y.' '.date('H:i:s');

/*$strSQL = "SELECT * FROM tb_service WHERE   hn='".$_POST['hn']."' and  date_ser='".$_POST['date1']."' ";

$objQuery = mysql_query($strSQL)or die (mysql_error());
$objResult = mysql_num_rows($objQuery);
if($objResult>0)
{
		echo "<h4 align=center>Hn : ".$_POST['hn']." เคยบันทึกแล้ววันนี้</h4></br>";
		?>
 <!-- <div align="center"> <input name="btnButton" type="button" value="กลับไปแก้ไข" onClick="JavaScript:window.location='service.php"></div>-->
       <?
		
}
else
{*/

	 $sql_add2="INSERT  INTO tb_service (date_ser,hn,id_vac,num,unit,name_doc,lotno,date_end,lotno2,date_end2,date_insert) VALUES ('$date1','$hn','$vaccine','$vaccine_detail','$unit','$doctor','$lotno','$date2','$lotno2','$date3','$datetime') ";
		 $query_add2=mysql_query($sql_add2);
		 
	if($query_add2)
	{
		echo "บันทึกข้อมูลเรียบร้อยแล้ว";
		echo "<meta http-equiv='refresh' content='2; url=service.php'>" ;
	}
	else
	{
		echo "Error Save [".$sql_add2."]";
		echo "<meta http-equiv='refresh' content='2; url=service.php'>" ;
	}
	//}


?></body>