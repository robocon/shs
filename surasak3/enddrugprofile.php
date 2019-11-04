<?php
    session_start();

    if (!isset($sIdname)){die;}

	 include("connect.inc");

if($_GET["action"] == "view_order"){
	
	$sql = "Select distinct an From bed where an != '' ";
	$result = mysql_query($sql);
	$i=0;
	while($arr = mysql_fetch_assoc($result)){
		$lst[$i] = $arr["an"];
		$i++;
		$lst[$i] = "&nbsp;";
		$i++;
	}


	$sql = "Select distinct a.an From file_dcorder as a INNER JOIN bed as b ON a.an = b.an  where a.drugok = '0' ";
	echo $sql."<br>";
	$result = mysql_query($sql);
	
	while($arr = mysql_fetch_assoc($result)){
		$lst[$i] = $arr["an"];
		$i++;
		$lst[$i] = "<A HREF=\"view_order.php?an=".$arr["an"]."\" target=\"_blank\"><IMG SRC=\"new.gif\" WIDTH=\"31\" HEIGHT=\"15\" BORDER=\"0\" ALT=\"\"></A>";
		$i++;
	}
	
	$list = implode("[]",$lst);

	echo $list;

exit();
}

	$month_["01"] = "ม.ค.";
    $month_["02"] = "ก.พ.";
    $month_["03"] = "มี.ค.";
    $month_["04"] = "เม.ย.";
    $month_["05"] = "พ.ค.";
    $month_["06"] = "มิ.ย.";
    $month_["07"] = "ก.ค.";
    $month_["08"] = "ส.ค.";
    $month_["09"] = "ก.ย.";
    $month_["10"] = "ต.ค.";
    $month_["11"] = "พ.ย.";
    $month_["12"] = "ธ.ค.";

	$_SESSION["cWard"]="หอผู้ป่วยหญิง ";

 $build = array("หอผู้ป่วยหญิง"=>"42","หอผู้ป่วย ICU"=>"44","หอผู้ป่วยสูติ"=>"43","หอผู้ป่วยพิเศษ"=>"45");

	//$build = array("หอผู้ป่วยหญิง"=>"42");

?>
<html>
<head>

<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#669900; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
body,td,th {
font-family:  MS Sans Serif;
font-size: 16 px;
}
.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}

</style>

<SCRIPT LANGUAGE="JavaScript">

var marked_row = new Array;
function setPointer(theRow, theRowNum, theAction, theDefaultColor, thePointerColor, theMarkColor)
{
    var theCells = null;

    // 1. Pointer and mark feature are disabled or the browser can't get the
    //    row -> exits
    if ((thePointerColor == '' && theMarkColor == '')
        || typeof(theRow.style) == 'undefined') {
        return false;
    }

    // 2. Gets the current row and exits if the browser can't get it
    if (typeof(document.getElementsByTagName) != 'undefined') {
        theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        theCells = theRow.cells;
    }
    else {
        return false;
    }

    // 3. Gets the current color...
    var rowCellsCnt  = theCells.length;
    var domDetect    = null;
    var currentColor = null;
    var newColor     = null;
    // 3.1 ... with DOM compatible browsers except Opera that does not return
    //         valid values with "getAttribute"
    if (typeof(window.opera) == 'undefined'
        && typeof(theCells[0].getAttribute) != 'undefined') {
        currentColor = theCells[0].getAttribute('bgcolor');
        domDetect    = true;
    }
    // 3.2 ... with other browsers
    else {
        currentColor = theCells[0].style.backgroundColor;
        domDetect    = false;
    } // end 3

    // 3.3 ... Opera changes colors set via HTML to rgb(r,g,b) format so fix it
    if (currentColor.indexOf("rgb") >= 0) 
    {
        var rgbStr = currentColor.slice(currentColor.indexOf('(') + 1,
                                     currentColor.indexOf(')'));
        var rgbValues = rgbStr.split(",");
        currentColor = "#";
        var hexChars = "0123456789ABCDEF";
        for (var i = 0; i < 3; i++)
        {
            var v = rgbValues[i].valueOf();
            currentColor += hexChars.charAt(v/16) + hexChars.charAt(v%16);
        }
    }

    // 4. Defines the new color
    // 4.1 Current color is the default one
    if (currentColor == ''
        || currentColor.toLowerCase() == theDefaultColor.toLowerCase()) {
        if (theAction == 'over' && thePointerColor != '') {
            newColor              = thePointerColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor              = theMarkColor;
            marked_row[theRowNum] = true;
            // Garvin: deactivated onclick marking of the checkbox because it's also executed
            // when an action (like edit/delete) on a single item is performed. Then the checkbox
            // would get deactived, even though we need it activated. Maybe there is a way
            // to detect if the row was clicked, and not an item therein...
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = true;
        }
    }
    // 4.1.2 Current color is the pointer one
    else if (currentColor.toLowerCase() == thePointerColor.toLowerCase()
             && (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])) {
        if (theAction == 'out') {
            newColor              = theDefaultColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor              = theMarkColor;
            marked_row[theRowNum] = true;
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = true;
        }
    }
    // 4.1.3 Current color is the marker one
    else if (currentColor.toLowerCase() == theMarkColor.toLowerCase()) {
        if (theAction == 'click') {
            newColor              = (thePointerColor != '')
                                  ? thePointerColor
                                  : theDefaultColor;
            marked_row[theRowNum] = (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])
                                  ? true
                                  : null;
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = false;
        }
    } // end 4

    // 5. Sets the new color...
    if (newColor) {
        var c = null;
        // 5.1 ... with DOM compatible browsers except Opera
        if (domDetect) {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].setAttribute('bgcolor', newColor, 0);
            } // end for
        }
        // 5.2 ... with other browsers
        else {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].style.backgroundColor = newColor;
            }
        }
    } // end 5

    return true;
} // end of the 'setPointer()' function

function show_tooltip(diagnos,doctor,age){

	tooltip.style.left=document.body.scrollLeft+event.clientX;
	tooltip.style.top=document.body.scrollTop+event.clientY;
	tooltip.innerHTML="";
	tooltip.innerHTML = tooltip.innerHTML+"<TABLE border=\"1\" bordercolor=\"blue\"><TR bgcolor=\"blue\"><TD align=\"center\"><B><FONT COLOR=\"#FFFFFF\">รายละเอียด</FONT></B></TD></TR><TR><TD><BR>&nbsp;อายุ&nbsp;:&nbsp;"+age+"&nbsp;&nbsp;<BR>&nbsp;โรค&nbsp;:&nbsp;"+diagnos+"&nbsp;&nbsp;<BR>&nbsp;หมอ&nbsp;:&nbsp;"+doctor+"&nbsp;&nbsp;<BR><BR></TD></TR></TABLE>";
	tooltip.style.display="";
}

function hid_tooltip(){
	tooltip.style.display="none";
	tooltip.innerHTML = "";

}

function handlerMMX(e){
	x = (document.layers) ? e.pageX : document.body.scrollLeft+event.clientX
	return x;
}

function handlerMMY(e){
	y = (document.layers) ? e.pageY : document.body.scrollTop+event.clientY
	return y;
}

</SCRIPT>
</head>
<body>

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

function view_order() {
	

			url = 'enddrugprofile.php?action=view_order';
			var str="";
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			var str = xmlhttp.responseText;
			str = str.substr(4);
			xx = str.split("[]");
			
			for(i=0;i<xx.length;i=i+2){
				document.getElementById(xx[i]).innerHTML = xx[i+1];
				
				if(xx[i+1] != "&nbsp;"){
					document.getElementById(xx[i]+"rows").style.backgroundColor ="#FF9797";
				}else{
					document.getElementById(xx[i]+"rows").style.backgroundColor ="#FFFF99";
					document.getElementById(xx[i]).innerHTML = "<A HREF=\"view_order.php?an="+xx[i]+"\" target=\"blank\">view</A>";
				}

				//alert(xx[i]+" "+xx[i+1]);
			}

		setTimeout("view_order();",6000);

}

	window.onload = function(){
		
		view_order();
		
	}

</SCRIPT>

<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>

<BR>
<TABLE width="100%">
<TR valign="top">
	<TD>
<?php

foreach ($build as $key => $value){
	echo "<A HREF=\"#$value\">",$key,"</A>&nbsp;&nbsp;";
}
echo "<A HREF=\"drugprofile_today.php\" target='_blank'>ผู้ป่วยรับป่วยวันนี้</A>&nbsp;&nbsp;";
echo "<BR><BR><A HREF=\"../nindex.htm\">&lt; &lt; เมนู</A><BR>";?>
</TD>
	<TD align="right">
<FORM   METHOD=POST ACTION="rp_profile.php" target="_blank">
<TABLE border="1" bordercolor="blue" cellspacing="0" cellpadding="0">
<TR>
	<TD>
	<TABLE ID="form_search">
	<TR bgcolor="blue"  class="font_title">
		<TD colspan="2">ข้อมูลการจ่ายยา</TD>
	</TR>
	<TR>
		<TD align="right">AN&nbsp;:&nbsp;</TD>
		<TD><INPUT TYPE="text" NAME="an" value="<?php echo $_REQUEST["an"];?>"></TD>
	</TR>
	<TR>
		<TD align="right">เดือน&nbsp;:&nbsp;</TD>
		<TD><SELECT NAME="month">
	
	<?php

	 $month_["01"] = "มกราคม";
    $month_["02"] = "กุมภาพันธ์";
    $month_["03"] = "มีนาคม";
    $month_["04"] = "เมษายน";
    $month_["05"] = "พฤษภาคม";
    $month_["06"] = "มิถุนายน";
    $month_["07"] = "กรกฏาคม";
    $month_["08"] = "สิงหาคม";
    $month_["09"] = "กันยายน";
    $month_["10"] = "ตุลาคม";
    $month_["11"] = "พฤศจิกายน";
    $month_["12"] = "ธันวาคม";

	while(list($key, $value) = each($month_)){
		echo "<OPTION VALUE=\"",$key,"\" ";
			if($key == date("m")) echo " Selected ";
		echo ">",$value,"</OPTION>";
	}
	?>
		
	</SELECT>&nbsp;&nbsp;ปี&nbsp;:&nbsp;<INPUT TYPE="text" NAME="year" size="4" value="<?php echo date("Y")+543;?>"></TD>
	</TR>
	<!-- <TR>
		<TD align="right">สถานะ&nbsp;:&nbsp;</TD>
		<TD><SELECT NAME="statcon">
			<OPTION VALUE="" SELECTED>ทั้งหมด</OPTION>
			<OPTION VALUE="STAT" >one day</OPTION>
			<OPTION VALUE="CONT">contine</OPTION>
		</SELECT></TD>
	</TR> -->
	<TR>
		<TD colspan="2"><INPUT TYPE="submit" value="ตกลง"></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>

</FORM>
</TD>
</TR>
</TABLE>

<?php
foreach ($build as $key => $value){

	$sql = "SELECT bed,date_format(date,'%d') as date1,date_format(date,'%m') as date2,date_format(date,'%Y') as date3,ptname,an,diagnos,doctor,ptright,age,accno, bedcode, last_drug FROM bed WHERE bedcode LIKE '".$value."%' AND an != '' ORDER BY bed ASC";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) == 0)
		continue;
?><BR>
<CENTER><a name="<?php echo $value;?>"></a><?php echo $key;?></CENTER><BR>
<TABLE align="center" border="1" bordercolor="blue" cellspacing="0" cellpadding="0"  width="95%">
<TR>
	<TD>
<TABLE width="99%" align="center">
<TR>
	<TD colspan="10"><A HREF="ward_phardividedrug.php?idward=<?php echo $value;?>">จ่ายยา <?php echo $key;?> ทั้งหมด</A></TD>
</TR>
<TR bgcolor="blue" align="center" class="font_title">
	<TD bgcolor="#FFFFFF"><FONT COLOR="#000000"><B><A HREF="<?php echo $_SERVER["PHP_SELF"];?>">UP</A></B></FONT></TD>
	<TD><B>เตียง</B></TD>
	<TD><B><FONT COLOR="#FFFFDD">วันรับป่วย</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">AN</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">ชื่อผู้ป่วย</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">คืนยา</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">เพิ่ม/แก้ไข/OFF ยา</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">จ่ายยา</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">ข้อมูล<BR>การจ่ายยา</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">จ่ายยา<BR>ล่าสุด</FONT></B></TD>
	<TD><B><FONT COLOR="#FFFFDD">Doctor Order</FONT></B></TD>
</TR>
<?php

while($arr = Mysql_fetch_assoc($result)){

	$an = $arr['an'];

	$sql = "SELECT * FROM `med_scan` WHERE `an` = '$an' AND `confirm` IS NULL ";
	$medScanQuery = mysql_query($sql);
	$link_scan = "";
	if ( mysql_num_rows($medScanQuery) > 0 ) {
		$link_scan = '<a href="med_phar.php?fill_an='.$an.'" target="_blank">'.$an.'</a>';
	}

	if($arr["last_drug"] != "0000-00-00 00:00:00"){
		$bgcolor = "#FFFF99";
		$list_drug = explode(" ",$arr["last_drug"]);
		$day = explode("-",$list_drug[0]);
		
		$arr["last_drug"] = $day[2]."/".$day[1]."/".$day[0]."<BR>".$list_drug[1];
	}else{
		$bgcolor = "#FFFFFF";
		$arr["last_drug"]="";
	}
	$dAdmit = $arr["date3"]."-".$arr["date2"]."-".$arr["date1"];
	$today = (date("Y")+543)."-".date("m-d");
	if($dAdmit==$today){
		
		$bgcolor = "#66FFFF";
	}
	
	$str1="select lock_dc from ipcard WHERE an = '".$arr["an"]."' ";
	$strresult1=mysql_query($str1);
	$arr1=mysql_fetch_array($strresult1);
	
 if($arr1['status_log']=='' || $arr1['status_log']==NULL){

	$message="ยืนยันการปลดล็อคเพื่อจำหน่าย";
	
	$L1="<A HREF=\"add_medical_supplies.php?an=".$arr["an"]."&bed=".$arr["bed"]."&bedcode=".$arr["bedcode"]."&date=".$arr["date3"]."-".$arr["date2"]."-".$arr["date1"]."\"  target=\"_blank\">คืนยา</A>";
	
	$L2="<A HREF=\"add_drug.php?an=".$arr["an"]."&bed=".$arr["bed"]."&bedcode=".$arr["bedcode"]."&date=".date("dmy")."\">เพิ่ม/แก้ไข/OFF ยา</A>";
	$L3="<A HREF=\"phardividedrug.php?an=".$arr["an"]."&bed=".$arr["bed"]."&bedcode=".$arr["bedcode"]."&date=".date("dmy")."\">จ่ายยา</A>";
	}else{
	$message="ยืนยันการยกเลิกการปลดล็อคเพื่อจำหน่าย";	
	$L1="คืนยา";
	$L2="เพิ่ม/แก้ไข/OFF ยา";
	$L3="จ่ายยา";
	}



echo "
<TR  id='",$arr["an"],"rows' bgcolor=\"$bgcolor\">
	<TD></TD>
	<TD>",$arr["bed"],"</TD>
	<TD align=\"center\">",$arr["date1"]," ",$month_[$arr["date2"]]," ",substr($arr["date3"],2),"</TD>
	<TD><a href='phardc.php?an=".$arr["an"]."' onclick=\"return confirm('".$message." an : ".$arr["an"]."?');\"><span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('",$arr["diagnos"],"','",$arr["doctor"],"','",$arr["age"],"');\" OnmouseOut = \"hid_tooltip();\">",$arr["an"],"</a></span></TD>
	<TD>",$arr["ptname"],"</TD>
	<TD align=\"center\">$L1</TD>
	<TD align=\"center\">$L2</TD>
	<TD align=\"center\">$L3</TD>
	<TD align=\"center\"><A HREF=\"rp_profile.php?an=".$arr["an"]."&month=".date("m")."&year=".(date("Y")+543)."&date=".date("dmy")."\" target=\"_blank\">ข้อมูล<BR>การจ่ายยา</A></TD>
	<TD align=\"center\">",$arr["last_drug"],"</TD>
	<TD align=\"center\">&nbsp;<div id='",$arr["an"],"'></div>&nbsp;$link_scan</TD>
</TR>
		";
}
?>
</TABLE>
	</TD>
	</TR>
</TABLE>
<?php
}	
?>
<BR><BR><BR><BR><BR><BR><BR>
</body>
</html>
<?php
include("unconnect.inc");
?>