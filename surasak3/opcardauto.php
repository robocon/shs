<?php
session_start();

    $month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";
	
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
<a href="../nindex.htm">&lt;&lt;����</a>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>�鹺ѵ�����͹�Ѵ </TITLE>
 </HEAD>

 <BODY bgcolor="#CCFFFF">
<?
include("connect.inc");
  
  if(!isset($_SESSION["case_service"]) || $_SESSION["case_service"] == ""){

	    session_unregister("case_service");
		session_register("case_service");
		$_SESSION["case_service"] = "EX13 ����͹�Ѵ";

  }

  if(isset($_GET["type_value"]) && $_GET["type_value"] != ""){
		
		switch($_GET["type_value"]){
			case "EX13":
				$_SESSION["case_service"] = "EX13 ����͹�Ѵ";
			break;
			
		}

	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."\">";
	exit();
  }


switch($_POST["step"]){
/******************************************************case 3******************************************************/
case 3:

	// Block �������չѴ�ѹ��������
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
		echo "<br>".'�������չѴ�ѹ����� '.$item['room'].' ��سҵԴ��ͷ��Ἱ��ѧ�����'."<br>";
		echo '<a href="#" onclick="window.history.back()">��ԡ��������͡�Ѻ�˹�����</a>';
		exit;
	}

	// ��Ҽ������ѧ����� ward 
	$sql = "SELECT b.`my_ward` 
	FROM `bed` AS a
    LEFT JOIN `ipcard` AS b ON b.`an` = a.`an`
    WHERE a.`hn` = '".$_POST["id_barcode"]."' ;";
	$q = mysql_query($sql) or die( mysql_error() );
	$item = mysql_fetch_assoc($q);
	if( $item !== false ){
		echo "<br>ʶҹТͧ�������ѧ������ ".$item['my_ward']." ��سҵԴ��ͷ���ͼ�����<br>";
		echo '<a href="#" onclick="window.history.back()">��ԡ��������͡�Ѻ�˹�����</a>';
		exit;
	}
	
	
		$Thaidate=date("d-m-").(date("Y")+543)." ����  ".date("H:i:s");
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
						$print_case = "������Ф�ͺ����";
						$kew = $arr["prefix"].$queue;
				}elseif($ages>=75){

					 $sql ="update runno SET runno = runno+1 WHERE title='kewolder'";
					 $result = Mysql_Query($sql);
					 $sql = "Select * From runno WHERE title='kewolder' ";
					
					 $result = Mysql_Query($sql);
					 $arr = Mysql_fetch_assoc($result);
					$queue = $arr["runno"];
					$print_case = "����٧����";
					$kew = $arr["prefix"].$queue;
				}else{

					 $sql ="update runno SET runno = runno+1 WHERE title='kew'";
					 $result = Mysql_Query($sql);
					 $sql = "Select * From runno WHERE title='kew' ";
					
					 $result = Mysql_Query($sql);
					 $arr = Mysql_fetch_assoc($result);
					$queue = $arr["runno"];
					$print_case = "��Ǩ�ä�����";
					$kew = $arr["prefix"].$queue;
				}
			break;

			case "EX11":
				
			if (substr($arr_member["idguard"],0,4)=='MX01'){
					$print_case = "������Ф�ͺ����";
				}else{
					$print_case = "��Ǩ�ä�����";
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
////////////�Դ�Թ 50 �ҷ
			/*$check = "select * from depart where hn = '".$_POST["cHn"]."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
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
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate."','".$cPtname."','".$_POST["cHn"]."','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$vn."','".$cPtright."');";
				$result = mysql_query($query);
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate."','".$_POST["cHn"]."','','".$cPtname."','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
				
				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$vn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}*/
				////////////////////////////////���Դ�Թ 50 �ҷ
		}


		print "<center><font style=\"font-size: 45px\"><b>�ç��Һ�Ť�������ѡ�������� </b><br><br> ";
		print "<center><font style=\"font-size: 30px\"><b>����͹�Ѵ HN : $_POST[id_barcode]</b><br> ";
		//print "<center><font style=\"font-size: 55px\" color=\"blue\"><b> �ӴѺ���:$queue </b></font><br> ";
		//print "<center><font style=\"font-size: 30px\"><b>".$print_case."</b><br> ";
		//print "<center><font style=\"font-size: 30px\"><b>�ѹ��� ".$Thaidate."</b><br> ";
		print "<center><font style=\"font-size: 30px\"><br>$cPtname<br>"; 
		print "<center><font style=\"font-size: 40px\"color=\"red\"><b>�觢����Ť鹺ѵ����º�������Ǥ�</b></font><br>";
		//print "<center><font style=\"font-size: 40px\"><b>�͢ͺ�س��������ԡ��</b><br>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=".$_SERVER['PHP_SELF']."\">";
	}else{
		print "<center><font style=\"font-size: 40px\"color=\"red\"><b>��辺�����Ţͧ HN : $_POST[id_barcode] ����</b></font><br>";
		//print "<center><font style=\"font-size: 40px\"><b>�͢ͺ�س��������ԡ��</b><br>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']."\">";
	}
//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']."\">";
		

break;

/********************************************case 2*****************************************/
/*case 2:


		$sql = "Select * From appoint  where hn = '".$_POST["id_barcode"]."' AND appdate = '".date("d")." ".$month[date("m")]." ".(date("Y")+543)."' AND apptime <> '¡��ԡ��ùѴ'  limit 0,1 ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);

		if($rows > 0){

		$arr = Mysql_fetch_assoc($result);

		echo "<BR><BR><BR><BR>";

			echo "<TABLE align=\"center\" height=\"200\">";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 45px\" color=\"red\"><B>�������չѴ�ѹ���</B></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 45px\" >ᾷ�� <U>",$arr["doctor"],"</U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�Ѵ����<U> ",$arr["apptime"],"</U></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 45px\" >�ջѭ��ʧ��µԴ���</FONT> <FONT style=\"font-size: 45px\"  color=\"#3300FF\"><U>�ش��ԡ�ùѴ</U></FONT></TD></TR>";
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
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" color=\"red\"><B>������ ��ҹ���·ӡ��ŧ����¹����</B></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" >",$arr["ptname"],"</FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" >�Է���&nbsp;:&nbsp;",substr($arr["ptright"],4),"</FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" color=\"blue\"><U>���ӴѺ��Ƿ��  ",$arr["kew"],"</U></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" color=\"blue\"><U>",$arr["toborow"],"</U></FONT></TD></TR>";
			echo "<TR><TD align=\"center\"><FONT style=\"font-size: 35px\" >���Ѻ��ԡ�÷��ش�Ѵ�¡<BR>�ջѭ�Ң��ʧ��¡�سҵԴ���Ἱ�����¹</B></FONT></TD></TR>";
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
				<TD><CENTER><FONT style=\"font-size: 35px\" color=\"red\">������ 㺻�Шӵ�Ǣͧ��ҹ�������ö��ҹ��</FONT></TD>
			</TR>";

			echo "<TR align=\"center\">
				<TD><FONT style=\"font-size: 35px\" color=\"red\">��س��ͧ�����ա����&nbsp;&nbsp;���� �Դ��ͽ��·���¹</FONT></TD>
			</TR>";
			echo "<TR align=\"center\">
				<TD><FONT style=\"font-size: 35px\" color=\"red\">��س��ͫѡ����</FONT></CENTER></TD>
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
			<A HREF=\"".$_SERVER['PHP_SELF']."?type_value=EX13\">EX13 ����͹�Ѵ</A><BR>
		</div>
		<FORM name=\"f1\" METHOD=POST ACTION=\"\">
		<TABLE  align=\"center\"  border = \"1\" bordercolor=\"#3300CC\" width=\"600\" height=\"400\" cellpadding=\"0\" cellspacing=\"0\">
		<TR>
			<TD align=\"center\" valign=\"top\" ><BR><BR>
		<TABLE>
		<TR>
			<TD align=\"center\"><FONT style=\"font-size:30px; \" ><B> �к�ŧ����¹�ѵ��ѵ����͡������͹�Ѵ </B></FONT></TD>
		</TR>
		<TR>
			<TD align=\"center\"><FONT style=\"font-size:20px; \" ><br>
			</FONT><FONT style=\"font-size:25px; \" color=\"#000066\">
			<B>";
			
			if($_SESSION["case_service"] == "EX13 ����͹�Ѵ")
				echo "�鹺ѵ����ͷӡ������͹�Ѵ��ҹ��";
			echo "</B></FONT></TD>
		</TR>
		<TR>
			<TD align=\"center\"><BR>HN : <INPUT TYPE=\"text\" NAME=\"id_barcode\" maxlength=\"13\" size=\"70\"></TD>
		</TR>
		<TR>
			<TD align=\"center\"><FONT style=\"font-size:20px; \" ><BR> <BR>�к���ŧ����¹����觢����Ť鹺ѵ�����ѵ��ѵ�</FONT></TD>
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
