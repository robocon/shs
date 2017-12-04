<?php
session_start();
/*if(isset($_GET["action"]) && $_GET["action"] != "edit" && $_GET["action"] != "del"){
	header("content-type: application/x-javascript; charset=TIS-620");
}*/
	 include("connect.inc");


	 Function calcage($birth){

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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
	$str = trim($str);
    return $str;
}

/********************************************* AJAX *********************************************************************/
/*	 if(isset($_GET["action"]) && $_GET["action"] =="view"){
		//header("content-type: application/x-javascript; charset=TIS-620");

		$sql = "Select yot, name, surname, dbirth, ptright, ptffone, phone, sex From opcard where hn='".$_GET["hn"]."' limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr = Mysql_fetch_assoc($result);

		switch($arr["sex"]){
			case 'ช': $sex = "ชาย"; break;
			case 'ญ': $sex = "หญิง"; break;
			default : $sex = "<FONT COLOR='#FF000000'><B>ไม่ได้ลงข้อมูล</B></FONT>"; break;
		}

		echo $arr["yot"]." ".$arr["name"]." ".$arr["surname"]."  อายุ : ".calcage($arr["dbirth"])." เพศ : ".$sex."  <BR>สิทธิ์ : ".$arr["ptright"]."  tel : ".$arr["phone"]."&nbsp;ผู้เกี่ยวข้อง : ".$arr["ptffone"]."<BR><A HREF=\"consent4.php?hn=".urlencode($_GET["hn"])."\" target=\"_blank\">ออกใบยินยอม</A>";
		exit();
	}
	
	*/
/********************************************* END AJAX *********************************************************************/

	

	if(isset($_POST["submit_update"]) && $_POST["submit_update"] != ""){
		
if($_POST["submit_update"] == "เลือก"){
	$status = "hd";
}else{
	$status = "";
}
		if(count($_POST["row_id"]) > 0){
			
			$sql = "Update opcard set `hd` = '{$status}' Where row_id in ('".implode("','",$_POST["row_id"])."') ";
			$result = Mysql_query($sql);


		}		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=lock_hd.php\">";
		exit();
	}else if(isset($_POST["submit_password"]) && $_POST["submit_password"] != ""){
		


			$sql = "Select prefix From runno where title='passdrug' limit 1";
		list($passdrug) = mysql_fetch_row(mysql_query($sql));

			
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=lock_hd.php\">";
		exit();
	}

?><html>
<head>
<title>ผู้ป่วย HD</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<A HREF="../nindex.htm">&lt;&lt; เมนู</A>
</SCRIPT>
<TABLE width="100%">
<TR valign="top">
	<TD width="50%">
	<FORM name="form_search" METHOD=POST ACTION="" >
<TABLE   width="400" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"    width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<TD colspan="2" align="center">ค้นหาตาม HN</TD>
</TR>
<TR >
	<TD  width="100" align="right">HN </TD>
	<TD ><INPUT TYPE="text" NAME="tradname" value="<?php echo $_POST["tradname"];?>"></TD>
</TR>
<TR>
	<TD align="right">ประเภทผู้ป่วย : </TD>
	<TD>
	<SELECT NAME="hd">
	<Option value="">เลือกทั้งหมด</Option>
		<Option value="hd" <?php if($_POST["hd"] == "hd")echo " Selected ";?>>ผู้ป่วย HD</Option>
	</SELECT>
	
	</TD>
</TR>
<TR>
	<TD align="center"><INPUT TYPE="submit" value="ตกลง" name="submit_search"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
	</TD>
	<FORM name="f1" METHOD=POST ACTION="" >
<TABLE   width="700" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"  width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<!-- <TD align="center" >รหัส</TD> -->
	<TD align="center" >HN</TD>
	<TD align="center" >ชื่อ</TD>
	<TD align="center" >นามสกุล</TD>
		<TD align="center" >ประเภท</TD>
	<TD align="center" >Check</TD>
</TR>
<?php

if(empty($_POST["submit_search"])){
	
	exit();
}else{
	
	
	

	if($_POST["tradname"] != ""){
		$where .= " AND hn = '".$_POST["tradname"]."' ";
	}
	
	if($_POST["hd"] != ""){
		$where .= " AND `hd` ='".$_POST["hd"]."' ";
	}

	$where = substr($where,4);

}

$sql = "Select * From opcard where ".$where;
$result = mysql_query($sql);
while($arr = mysql_fetch_assoc($result)){

	if($arr["hd"] != ""){
		$bgcolor="#FF9393";
	}else{
		$bgcolor="#FFFFFF";
	}

?>
<TR bgcolor="<?php echo $bgcolor;?>">
<!-- 	<TD><?php //echo $arr["drugcode"];?></TD> -->
 

<td><a target=_blank  href=\sm3/surasak3/hdsticker.php?cHn=<?php echo $arr["hn"];?>><?php echo $arr["hn"];?></a></td>
	<TD><?php echo $arr["name"];?></TD>
		<TD><?php echo $arr["surname"];?></TD>
				<TD><?php echo $arr["hd"];?></TD>
	<TD align="center"><INPUT TYPE="checkbox" NAME="row_id[]" value="<?php echo $arr["row_id"];?>"></TD>

</TR>
<?php
}	
?>
<TR>
	<TD colspan="7" align="center"><INPUT TYPE="submit" name="submit_update" value="เลือก">&nbsp;&nbsp;<INPUT TYPE="submit" name="submit_update" value="ไม่เลือก"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>


</body>
</html>
<?php include("unconnect.inc");?>
