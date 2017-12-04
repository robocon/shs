<?
include("connect.inc");
echo "<table><tr><td>HN</td><td>AN</td><td>วันที่ Admit</td><td>วันที่จำหน่าย</td><td>จำนวนวันนอน</td><td>วันที่วินิจฉัยโรค</td><td>รหัส ICD10</td><td>ชนิดของโรค</td><td>แพทย์ผู้รักษา</td><td>ค่าใช้จ่ายรวม</td></tr>";
	$sqlipc ="select * from ipcard where dcdate like '2557-10%'";   //  Query เอาข้อมูลจากตาราง ipcard
	$resultipc = mysql_query($sqlipc) or die("Query IDX Failed");
   	while($rowsipc = mysql_fetch_array($resultipc)){
		$hn=$rowsipc["hn"];
		$an=$rowsipc["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		$date=substr($rowsipc["date"],0,10);
		list($y,$m,$d)=explode("-",$date);
		$y=$y-543;
		$admit="$y$m$d";
		
		$dcdate=substr($rowsipc["dcdate"],0,10);
		list($yy,$mm,$dd)=explode("-",$dcdate);
		$yy=$yy-543;
		$dc="$yy$mm$dd";		
		
		$numdate=$rowsipc["days"];	
		
		$price=$rowsipc["price"];
		


		$sql9 ="select * from diag  where an ='".$an."' ";    //  Query เอาข้อมูลจากตาราง opday
		//echo $sql9;
		$result9 = mysql_query($sql9) or die("Query failed9");
		$num9 =mysql_num_rows($result9);
		//echo "จำนวน : $num9";
		if($num9 > 1 ){
			while($rows9 = mysql_fetch_array($result9)){
			$diag9=$rows9["icd10"];  //  DIAG ใช้ตัวแปรนี้นำเข้าข้อมูล
			
			$svdate=substr($rows9["regisdate"],0,10);
			list($yy,$mm,$dd)=explode("-",$svdate);
			$yy=$yy-543;
			$diagdate="$yy$mm$dd";			
			
			//------------------กำหนดตัวแปรของ ชนิดของโรค
			$dxtype9=$rows9["type"];
			
			//echo $dxtype9;
			
			if($dxtype9=='PRINCIPLE'){		
				$dxtype ="1";
			}else if(dxtype9=='CO-MORBIDITY'){
				$dxtype ="2";
			}else if(dxtype9=='COMPLICATION'){
				$dxtype ="3";
			}else if(dxtype9=='OTHER'){
				$dxtype ="4";
			}else if(dxtype9=='EXTERNAL CAUSE'){
				$dxtype ="5";
			}else{
				$dxtype ="2";
			}	
			
			//---------------------หารหัสและชื่อหมอ-------------------------//
			$doctor_name9=$rowsipc["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdrdx = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdrdx = $rowsinp["codedoctor"];
			}

			echo  "<tr><td>$hn</td>
				  <td>$an</td>
				  <td>$admit</td>
				  <td>$dc</td>			  
				  <td>$numdate</td>
				  <td>$diagdate</td>
				  <td>$diag9</td>
				  <td>$dxtype</td>	
				  <td>$newdrdx</td>		
				  <td>$price</td></tr>";			
			}
		}else{
			$rows9 = mysql_fetch_array($result9);
			$an9=$rows9["an"];   //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			
			$svdate=substr($rows9["regisdate"],0,10);
			list($yy,$mm,$dd)=explode("-",$svdate);
			$yy=$yy-543;
			$diagdate="$yy$mm$dd";		
						
			$diag9=$rows9["icd10"];  //  DIAG ใช้ตัวแปรนี้นำเข้าข้อมูล			
			
			//------------------กำหนดตัวแปรของ ชนิดของโรค
			$dxtype9=$rows9["type"];
			if($dxtype9=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=='CO-MORBIDITY'){
				$dxtype ="2";
			}else if(dxtype9=='COMPLICATION'){
				$dxtype ="3";
			}else if(dxtype9=='OTHER'){
				$dxtype ="4";
			}else if(dxtype9=='EXTERNAL CAUSE'){
				$dxtype ="5";
			}else{
				$dxtype ="4";
			}	
			
			//---------------------หารหัสและชื่อหมอ-------------------------//
			$doctor_name9=$rowsipc["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdrdx = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name9%' ";   //  Query เอาข้อมูลจากตาราง inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdrdx = $rowsinp["codedoctor"];
			}
			echo  "<tr><td>$hn</td>
				  <td>$an</td>
				  <td>$admit</td>
				  <td>$dc</td>			  
				  <td>$numdate</td>
				  <td>$diagdate</td>
				  <td>$diag9</td>				  
				  <td>$dxtype</td>	
				  <td>$newdrdx</td>		
				  <td>$price</td></tr>";			
		}
	}		
echo "</table>";	
?>            