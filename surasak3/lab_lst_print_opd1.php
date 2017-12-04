<?php
session_start();
set_time_limit(30);
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");


if(isset($_GET["lab_date"])){
	$date_now = $_GET["lab_date"];
}else{
	$date_now = date("Y-m-d");
}

$sql = "Select date_format(orderdate,'%Y-%m-%d'),patientname,labnumber,sex From resulthead where hn = '$hn' AND autonumber = '".$_GET["number"]."' limit 0,1";

$result = mysql_query($sql);
$noLab = true;
if(mysql_num_rows($result) == 0){

	$noLab = false;

}
list($orderdate,$patientname,$labnumber,$sex) = mysql_fetch_row($result);


$xx = explode("-",$date_now);
$date_now2 = "<B>ผล LAB ของวันที่ :</B> ";

?>
<html>
<head>
<title>พิมพ์ผล LAB</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_head2 {background-color: #0C5A2F; color:#B9F2F7; font-weight: bold; text-align:center;  }
.tb_head3 {background-color:#FFFFFF; color:#000000; font-size:20px; font-weight: bold;font-family:"Angsana New"; text-align:center;  }
.tb_head3_2 {background-color:0000A0; color:#FFFF00; font-size:25px; font-weight: bold;font-family:"Angsana New"; text-align:center; font-weight: bold;width: 200px; }
.tb_head3_3 {background-color:#FFFFFF; color:#0000CC; font-size:25px; font-weight: bold;font-family:"Angsana New"; text-align:right;  }
.tb_head3_1 {color:#990000; font-size:20px; font-family:"Angsana New";  height:15px;  }
.tb_head4 {background-color: #99FFCC; color:#000099; font-size:25px;   font-family:"Angsana New";}
.tb_head4_1 {background-color: #99FFCC; color:#FF0033; font-size:25px;  font-weight: bold; font-family:"Angsana New";}


.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
<SCRIPT LANGUAGE="JavaScript">

	function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

</SCRIPT>
</head>
<body>
<?php 

	//echo "<BR>";
	$style_menu="2";
	$select_date = "";
	$select_date .= "";
	$sql = "Select distinct date_format(orderdate,'%d-%m-') as orderdate1, date_format(orderdate,'%Y') as orderdate3, date_format(orderdate,'%Y-%m-%d') as orderdate2  From resulthead where hn='$hn'  Order by orderdate DESC limit 0,10";
	//echo $sql;
	$result = mysql_query($sql);
	
	$select_date .= "<Select name=\"lab_date\"> ";
	while($arr = mysql_fetch_assoc($result)){
		$select_date .= "<option value=\"".$arr["orderdate2"]."\"";
			if($arr["orderdate2"] == $_GET["lab_date"])
				$select_date .= " Selected ";
		$select_date .= ">".$arr["orderdate1"]."".($arr["orderdate3"]+543)."</option>";
	}
	$select_date .= "</Select>&nbsp;<INPUT TYPE=\"submit\" value=\"ตกลง\">
	</FORM>";

	$select_date .= "</CENTER>";

if($noLab == false){
	echo "<BR><BR><CENTER>ไม่มีผล Lab ของวันนี้";
	echo "<BR><FORM METHOD=GET ACTION=\"".$_SERVER["PHP_SELF"]."\">ดูผล Lab ย้อนหลัง : ";
	echo $select_date ;
	exit();
}
$list_code_lab = array();
$lab_title = array();
$sql = "Select a.profilecode, count(b.labcode) From (Select * From resulthead where hn='$hn' AND  autonumber = '".$_GET["number"]."' ) as a INNER JOIN resultdetail as b ON a.autonumber = b.autonumber group by a.profilecode  Order by count(b.labcode) DESC , testgroupcode ASC";
//echo $sql;

$result = mysql_query($sql);
while(list($profilecode, $count) = mysql_fetch_row($result)){
	$list_code_lab[$profilecode] = $count;
	array_push($lab_title,$profilecode);
}

$list_lab = implode(", ",$lab_title);

?>

<TABLE align="center">
<TR>
	<TD>
<?php 
//echo $date_now2," ",$select_date;
echo "<CENTER><FONT SIZE='5' ><font face='Angsana New' style='line-height:20px;;' ><B>ใบรายงานผลทางห้องปฏิบัติการ โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</FONT></B><FONT SIZE='2'> โทร 054-839305<BR></FONT></CENTER>";
echo "<FONT SIZE='5'><font face='Angsana New' style='line-height:20px;;' >HN:<b>$hn </b>&nbsp;&nbsp;ชื่อ:&nbsp;<b>",$patientname,"</FONT></b>";
echo "<FONT SIZE='5'><font face='Angsana New' style='line-height:20px;;' >&nbsp;&nbsp;วันที่:<b>",$date_now,"</b>";
if($sex=='M'){$sex='ชาย';} else {$sex='หญิง';};
 

//echo "&nbsp;เพศ:<B>",$sex,"</b>";
echo "&nbsp;&nbsp;LAB No:<B>",$labnumber,"</b></FONT>";
echo "<FONT SIZE='4'><font face='Angsana New' style='line-height:20px;;' ><BR><B>รายการ Lab :</B> ",$list_lab;
echo "</FONT>";
?>
<TABLE width="700" border="0"  cellpadding="0" cellspacing="0" style="border-color: #33FF00" >
<TR>
	<TD valign="top">
<?php 

$group = "";
$j=0;
foreach($list_code_lab as $key => $value){

		$r=4;
		$sql = "Select autonumber, profilecode,clinicalinfo, testgroupname From resulthead where hn='$hn' AND  autonumber = '".$_GET["number"]."' AND profilecode = '".$key."'  Order by autonumber DESC limit 0,1";
		$result = mysql_query($sql);
		while(list($autonumber, $profilecode,$clinicalinfo, $testgroupname) = mysql_fetch_row($result)){
	
	?>
	<a name="<?php echo $testgroupname;?>"></a>

<?php
$j++;
	if($group != $testgroupname){
	$group = $testgroupname;

	if($j > 1){
	
	echo "</TABLE>
	</TD>
	</TR>
	</TABLE>";
	}

?>
	<TABLE border="1" bordercolor="#000000" width="100%" cellpadding="0" cellspacing="0" style='BORDER-COLLAPSE: collapse'>
	<TR>
		<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR>
		<TD class="tb_head3" width="300"><B><?php echo "<u>", $testgroupname ,"</u>";?></B></TD>
		<TD class="tb_head3"><U>Result</U></TD>
		<TD class="tb_head3" width="50">&nbsp;</TD>
		
		<TD class="tb_head3"><U>Until</U></TD>
		<TD class="tb_head3" width="200"><U>Reference Range</U></TD>
	</TR>
	<?php
		
	}
			$sql = "Select * From resultdetail where autonumber = '".$autonumber."' ";
			$result2= mysql_query($sql);
			$i=0;
			while($arr2 = mysql_fetch_assoc($result2)){
				
					if($arr2["flag"] != 'N') $bgcolor="#FFDDDD"; 
					else if($i%2==0) //$bgcolor="#FFFFBB"; 
						$bgcolor="#FFFFFF"; 
					else $bgcolor="#FFFFFF";


		?>
	<TR bgcolor="<?php echo $bgcolor;?>">
		<TD width="250"><FONT COLOR="#000000" size ="5"><font face='Angsana New' style='line-height:20px;;' ><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$arr2["labname"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></FONT></TD>
		
		<TD align="center" width="200"><FONT  size ="5"><font face='Angsana New' style='line-height:20px;;'><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["result"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></FONT></TD>
		<TD align="center" width="50"><FONT COLOR="red" size ="2"><font face='Angsana New' style='line-height:20px;;' ><B><?php if($arr2["flag"] != 'N'){  echo"[", $arr2["flag"],"]";};?></B></FONT></TD>
		<TD align="center" width="200"><FONT  size ="4"><font face='Angsana New' style='line-height:20px;;'><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo "". ($arr2["unit"] !=""?"".$arr2["unit"]."":"")."";?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></FONT></TD>
		<TD align="center" width="180"><FONT  size ="4"><font face='Angsana New' style='line-height:20px;;'><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php if($arr2["normalrange"] != ""){ echo "[",$arr2["normalrange"],"]" ;};?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></FONT></TD>
		
	</TR>
		</TR>
		
		<?php 
			$authorisename = $arr2["authorisename"];
		$releasename = $arr2["releasename"];
		$authorisedate= $arr2["authorisedate"];	
		$i++;} ?>


	  <?php } ?>

	  <?php } ?>
	  </TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<?php echo "<FONT SIZE='3'><CENTER><B>Reported By :".$releasename." &nbsp;&nbsp;Authorise name : </B>".$authorisename."&nbsp;&nbsp;<B>Authorise date :</B> ".$authorisedate."</CENTER></FONT>"; ?>
</body>
<?php include("unconnect.inc");?>
</html>