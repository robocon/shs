<?php
session_start();

    $month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฎาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";
	
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY";
	}else{
		$pAge="$ageY";
	}

return $pAge;
}
?>
<a href="../nindex.htm">&lt;&lt;เมนู</a>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>ค้นบัตรเลื่อนนัด </TITLE>
 </HEAD>

 <BODY bgcolor="#CCFFFF">
<?
include("connect.inc");
  
  if(!isset($_SESSION["case_service"]) || $_SESSION["case_service"] == ""){

	    session_unregister("case_service");
		session_register("case_service");
		$_SESSION["case_service"] = "EX13 เลื่อนนัด";

  }

  if(isset($_GET["type_value"]) && $_GET["type_value"] != ""){
		
		switch($_GET["type_value"]){
			case "EX13":
				$_SESSION["case_service"] = "EX13 เลื่อนนัด";
			break;
			
		}

	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."\">";
	exit();
  }


switch($_POST["step"]){
/******************************************************case 3******************************************************/
case 3:

	// Block ผู้ป่วยมีนัดวันนี้ไปแล้ว
	$sql = "SELECT a.`max_id`,b.`ptname`,b.`room` 
	FROM ( 
		SELECT MAX(`row_id`) AS `max_id` 
		FROM `appoint` 
		WHERE `appdate` = '".date("d")." ".$month[date("m")]." ".(date("Y")+543)."' 
		AND `hn` = '".$_POST["id_barcode"]."'
	) AS a 
	LEFT JOIN `appoint` AS b ON b.`row_id` = a.`max_id`";
	$q = mysql_query($sql) or die( mysql_error() );
	$item = mysql_fetch_assoc($q);
	if( !empty($item['max_id']) ){
		echo "<br>".'ผู้ป่วยมีนัดวันนี้ที่ '.$item['room'].' กรุณาติดต่อที่แผนกดังกล่าว'."<br>";
		echo '<a href="#" onclick="window.history.back()">คลิกที่นี่เพื่อกลับไปหน้าเก่า</a>';
		exit;
	}

	// ถ้าผู้ป่วยยังอยู่ใน ward 
	$sql = "SELECT b.`my_ward` 
	FROM `bed` AS a
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an`
    WHERE a.`hn` = '".$_POST["id_barcode"]."' ;";
	$q = mysql_query($sql) or die( mysql_error() );
	$item = mysql_fetch_assoc($q);
	if( $item !== false ){
		echo "<br>สถานะของผู้ป่วยยังอยู่ที่ ".$item['my_ward']." กรุณาติดต่อที่หอผู้ป่วย<br>";
		echo '<a href="#" onclick="window.history.back()">คลิกที่นี่เพื่อกลับไปหน้าเก่า</a>';
		exit;
	}
	
	
		$Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
		$thidate = (date("Y")+543).date("-m-d H:i:s"); 
		 $today = date("d-m-Y");   
		$d=substr($today,0,2);
		$m=substr($today,3,2);
		$yr=substr($today,6,4) +543;  
		$thdatehn=$d.'-'.$m.'-'.$yr.$_POST["id_barcode"];
		$today = date("Y-m-d");
		$code21 = '21'; 
		$thdatevn=$d.'-'.$m.'-'.$yr.$vn;
		$case = $_SESSION["case_service"];

		$sql = "Select * From opcard where hn = '".$_POST["id_barcode"]."' limit 0,1 ";
		$result = Mysql_Query($sql);
		$arr_member = Mysql_fetch_assoc($result);
		$count = mysql_num_rows($result);

	if($count>0){
		$cYot = $arr_member["yot"];
		$cPtname=$arr_member["yot"].' '.$arr_member["name"].'  '.$arr_member["surname"];
		$cPtright = $arr_member["ptright"];
		$ages = calcage($arr_member["dbirth"]);

/*if (substr($arr_member["idguard"],0,4)=='MX03'){
			 
			$queue = "vip";
			$print_case = "VIP";
			$kew = "vip";

}else{

		switch(substr($_POST["case1"],0,4)){

			case "EX01" :

				if(substr($arr_member["idguard"],0,4)=='MX01'){
						 $sql ="update runno SET runno = runno+1 WHERE title='kew1'";
						 $result = Mysql_Query($sql);
						 $sql = "Select * From runno WHERE title='kew1' ";
						 $result = Mysql_Query($sql);
						 $arr = Mysql_fetch_assoc($result);
						$queue = $arr["runno"];
						$print_case = "ทหารและครอบครัว";
						$kew = $arr["prefix"].$queue;
				}elseif($ages>=75){

					 $sql ="update runno SET runno = runno+1 WHERE title='kewolder'";
					 $result = Mysql_Query($sql);
					 $sql = "Select * From runno WHERE title='kewolder' ";
					
					 $result = Mysql_Query($sql);
					 $arr = Mysql_fetch_assoc($result);
					$queue = $arr["runno"];
					$print_case = "ผู้สูงอายุ";
					$kew = $arr["prefix"].$queue;
				}else{

					 $sql ="update runno SET runno = runno+1 WHERE title='kew'";
					 $result = Mysql_Query($sql);
					 $sql = "Select * From runno WHERE title='kew' ";
					
					 $result = Mysql_Query($sql);
					 $arr = Mysql_fetch_assoc($result);
					$queue = $arr["runno"];
					$print_case = "ตรวจโรคทั่วไป";
					$kew = $arr["prefix"].$queue;
				}
			break;

			case "EX11":
				
			if (substr($arr_member["idguard"],0,4)=='MX01'){
					$print_case = "ทหารและครอบครัว";
				}else{
					$print_case = "ตรวจโรคทั่วไป";
				}
					
					 $sql ="update runno SET runno = runno+1 WHERE title='kew'";
					 $result = Mysql_Query($sql);
					 $sql = "Select * From runno WHERE title='kew' ";
					 $result = Mysql_Query($sql);
					 $arr = Mysql_fetch_assoc($result);
					$queue = $arr["runno"];
					$kew = $arr["prefix"].$queue;

			break;
		}
}*/

		$sql = "Select vn as rows From opday Where thdatehn = '".$thdatehn."' Order by row_id DESC limit 0,1 ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
		
		if($rows > 0){
			$arr = Mysql_fetch_assoc($result);
			$vn = $arr["vn"];

			$sql = "update runno SET runno = runno+1  WHERE title='VN' limit 1";
			$result = Mysql_Query($sql); 
			$sql = "Select runno From runno WHERE title='VN' limit 0,1 ";
			$result = Mysql_Query($sql);
			$arr = Mysql_fetch_assoc($result);
			

		}else{
			
			$sql = "SELECT * FROM runno WHERE title = 'VN' limit 0,1 ";
			$result = Mysql_Query($sql);
			$arr = Mysql_fetch_assoc($result);

				if(substr($arr["startday"],0,10) != $today){
					$vn = 1;
      	            $sql ="update runno SET runno = ".$vn.",startday=now()  WHERE title='VN' limit 1";
					$result = Mysql_Query($sql);
				

				}else{
					$sql = "update runno SET runno = runno+1  WHERE title='VN' limit 1";
					$result = Mysql_Query($sql); 
					$sql = "Select runno From runno WHERE title='VN' limit 0,1 ";
					$result = Mysql_Query($sql);
					$arr = Mysql_fetch_assoc($result);
					$vn = $arr["runno"];
				
				}
				
				
				$thdatevn=$d.'-'.$m.'-'.$yr.$vn;
				$sql = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,
                	     ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,phaok,time1,kew)VALUES('$thidate','$thdatehn','".$_POST["id_barcode"]."','$vn','$thdatevn','$cPtname','$cPtright','".$arr_member["goup"]."','".$arr_member["camp"]."',Null,'".$arr_member["idcard"]."','$case','$borow','$code21','".$_SESSION["sOfficer"]."','X','".date("H:i:s")."','".$kew."');";
				$result = Mysql_Query($sql);
////////////คิดเงิน 50 บาท
			/*$check = "select * from depart where hn = '".$_POST["cHn"]."' and  detail = '(55020/55021 ค่าบริการผู้ป่วยนอก)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultcheck = mysql_query($check);
			$cal = mysql_num_rows($resultcheck);
			if($cal==0){
			//runno  for chktranx
				$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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
			
				$nRunno=$row->runno;
				$nRunno++;
			
				$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
				$result = mysql_query($query) or die("Query failed");
					/////////////////////////////////////////////////////////////
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate."','".$cPtname."','".$_POST["cHn"]."','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$vn."','".$cPtright."');";
				$result = mysql_query($query);
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate."','".$_POST["cHn"]."','','".$cPtname."','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
				
				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$vn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}*/
				////////////////////////////////จบคิดเงิน 50 บาท
		}


		print "<center><font style=\"font-size: 45px\"><b>โรงพยาบาลค่ายสุรศักดิ์มนตรี </b><br><br> ";
		print "<center><font style=\"font-size: 30px\"><b>เลื่อนนัด HN : $_POST[id_barcode]</b><br> ";
		//print "<center><font style=\"font-size: 55px\" color=\"blue\"><b> ลำดับที่:$queue </b></font><br> ";
		//print "<center><font style=\"font-size: 30px\"><b>".$print_case."</b><br> ";
		//print "<center><font style=\"font-size: 30px\"><b>วันที่ ".$Thaidate."</b><br> ";
		print "<center><font style=\"font-size: 30px\"><br>$cPtname<br>"; 
		print "<center><font style=\"font-size: 40px\"color=\"red\"><b>ส่งข้อมูลค้นบัตรเรียบร้อยแล้วคะ</b></font><br>";
		//print "<center><font style=\"font-size: 40px\"><b>ขอขอบคุณที่มาใช้บริการ</b><br>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=".$_SERVER['PHP_SELF']."\">";
	}else{
		print "<center><font style=\"font-size: 40px\"color=\"red\"><b>ไม่พบข้อมูลของ HN : $_POST[id_barcode] นี้คะ</b></font><br>";
		//print "<center><font style=\"font-size: 40px\"><b>ขอขอบคุณที่มาใช้บริการ</b><br>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']."\">";
	}
//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']."\">";
		

break;

/********************************************case 2*****************************************/
/*case 2:


		$sql = "Select * From appoint  where hn = '".$_POST["id_barcode"]."' AND appdate = '".date("d")." ".$month[date("m")]." ".(date("Y")+543)."' AND apptime <> 'ยกเลิกการนัด'  limit 0,1 ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);

		if($rows > 0){

		$arr = Mysql_fetch_assoc($result);

		echo "<BR><BR><BR><BR>";

			echo "<TABLE align=\"center\" height=\"200\">";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 45px\" color=\"red\"><B>ผู้ป่วยมีนัดวันนี้</B></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 45px\" >แพทย์ <U>",$arr["doctor"],"</U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นัดเวลา<U> ",$arr["apptime"],"</U></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 45px\" >มีปัญหาสงสัยติดต่อ</FONT> <FONT style=\"font-size: 45px\"  color=\"#3300FF\"><U>จุดบริการนัด</U></FONT></TD></TR>";
			echo "</TABLE>";

			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']."\">";
			exit();

		}



		$today = date("d-m-Y");   
		$d=substr($today,0,2);
		$m=substr($today,3,2);
		$yr=substr($today,6,4) +543;  
		$thdatehn=$d.'-'.$m.'-'.$yr.$_POST["id_barcode"];
		$sql = "Select * From opday where thdatehn = '".$thdatehn."' Order by row_id DESC ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);

		if($rows > 0){
			$arr = Mysql_fetch_assoc($result);

			echo "<BR><BR><BR><BR>";

			echo "<TABLE align=\"center\" height=\"200\">";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" color=\"red\"><B>ขออภัย ท่านได้เคยทำการลงทะเบียนแล้ว</B></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" >",$arr["ptname"],"</FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" >สิทธิ์&nbsp;:&nbsp;",substr($arr["ptright"],4),"</FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" color=\"blue\"><U>ได้ลำดับคิวที่  ",$arr["kew"],"</U></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" color=\"blue\"><U>",$arr["toborow"],"</U></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" >รอรับบริการที่จุดคัดแยก<BR>มีปัญหาข้อสงสัยกรุณาติดต่อแผนกทะเบียน</B></FONT></TD></TR>";
			echo "</TABLE>";

		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']."\">";

		exit();
		}



		$sql = "Select * From opcard where hn = \"".$_POST["id_barcode"]."\" ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
		if($rows > 0){
		$arr = Mysql_fetch_assoc($result);

		echo "

		<FORM name=\"f1\" METHOD=POST ACTION=\"".$_SERVER['PHP_SELF']."\">
		<INPUT TYPE=\"hidden\" NAME=\"step\" value=\"3\">
		<INPUT TYPE=\"hidden\" NAME=\"cHn\" value=\"",$arr["hn"],"\">
		<INPUT TYPE=\"hidden\" NAME=\"case1\" value=\"".$_SESSION["case_service"]."\">
		</FORM>
		";	

		echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		
			setTimeout('f1.submit();',0000) ;
		
		</SCRIPT>
		";
		}else{
			echo "<BR><BR><BR><BR><TABLE align=\"center\" height=\"200\">";
			echo "<TR align=\"center\">
				<TD><CENTER><FONT style=\"font-size: 35px\" color=\"red\">ขออภัย ใบประจำตัวของท่านไม่สามารถใช้งานได้</FONT></TD>
			</TR>";

			echo "<TR align=\"center\">
				<TD><FONT style=\"font-size: 35px\" color=\"red\">กรุณาลองใหม่อีกครั้ง&nbsp;&nbsp;หรือ ติดต่อฝ่ายทะเบียน</FONT></TD>
			</TR>";
			echo "<TR align=\"center\">
				<TD><FONT style=\"font-size: 35px\" color=\"red\">กรุณารอซักครู่</FONT></CENTER></TD>
			</TR>";
			echo "</TABLE>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']."\">";
		}

break;*/

/******************************************************case 1******************************************************/
default : 
		echo "
		
		<SCRIPT LANGUAGE=\"JavaScript\">
		<!--
			window.onload =function(){ document.f1.id_barcode.focus(); }
		//-->
		</SCRIPT>
		<div>
			<A HREF=\"#\" onclick=\"if(check_type.style.display==''){check_type.style.display='none';}else{check_type.style.display='';}\" style=\"text-decoration: none\">&nbsp;&nbsp;&nbsp;</A>
		</div>
		<div id=\"check_type\" style=\"display:none\">
			<A HREF=\"".$_SERVER['PHP_SELF']."?type_value=EX13\">EX13 เลื่อนนัด</A><BR>
		</div>
		<FORM name=\"f1\" METHOD=POST ACTION=\"\">
		<TABLE  align=\"center\"  border = \"1\" bordercolor=\"#3300CC\" width=\"600\" height=\"400\" cellpadding=\"0\" cellspacing=\"0\">
		<TR>
			<TD align=\"center\" valign=\"top\" ><BR><BR>
		<TABLE>
		<TR>
			<TD align=\"center\"><FONT style=\"font-size:30px; \" ><B> ระบบลงทะเบียนอัตโนมัติเพื่อการเลื่อนนัด </B></FONT></TD>
		</TR>
		<TR>
			<TD align=\"center\"><FONT style=\"font-size:20px; \" ><br>
			</FONT><FONT style=\"font-size:25px; \" color=\"#000066\">
			<B>";
			
			if($_SESSION["case_service"] == "EX13 เลื่อนนัด")
				echo "ค้นบัตรเพื่อทำการเลื่อนนัดเท่านั้น";
			echo "</B></FONT></TD>
		</TR>
		<TR>
			<TD align=\"center\"><BR>HN : <INPUT TYPE=\"text\" NAME=\"id_barcode\" maxlength=\"13\" size=\"70\"></TD>
		</TR>
		<TR>
			<TD align=\"center\"><FONT style=\"font-size:20px; \" ><BR> <BR>ระบบจะลงทะเบียนและส่งข้อมูลค้นบัตรให้อัตโนมัติ</FONT></TD>
		</TR>
		</TABLE>
		</TD>
		</TR>
		</TABLE>
		<INPUT TYPE=\"hidden\" NAME=\"step\" value=\"3\">
		</FORM>
		";

}

include("unconnect.inc");
?>
</BODY>
</HTML>
