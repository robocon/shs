<?php
 session_start();


include("connect.inc");

if(isset($_POST["form_action"])){
switch($_POST["form_action"]){

	case 'form_add':
		
	$sql = "Select prepack_id From stiker_prepack Order by prepack_id DESC limit 0,1 ";
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
	if($rows == 0){
		$new_id = 0;
	}else{
		$arr = Mysql_fetch_assoc($result);
		$new_id = $arr["prepack_id"]+1;

	}
	Mysql_free_result($result);

		$sql = " INSERT INTO `stiker_prepack` ( `prepack_id` , `drugcode`  , `total` , `lot` , `startdate` , `enddate` ) ";
		$sql .= " VALUES ( ";
		$sql .= " '$new_id', '".$_POST["drugcode"]."', '".$_POST["drugtotal"]."', '".$_POST["druglot"]."', '".$_POST["sdd"]."/".$_POST["smm"]."/".$_POST["syy"]."', '".$_POST["edd"]."/".$_POST["emm"]."/".$_POST["eyy"]."' ";
		$sql .= " ); ";
		$result = Mysql_Query($sql);
		if($result)
		$title = "ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว";
	else
		$title = "แก้ความผิดพลาดกรุณาติดต่อผู้ดูแล";
	break;

	case 'form_edit':
		
	$sql = " UPDATE `stiker_prepack` SET `drugcode` = '".$_POST["drugcode"]."',";
	$sql .= " `total` = '".$_POST["drugtotal"]."',";
	$sql .= " `lot` = '".$_POST["druglot"]."',";
	$sql .= " `startdate` = '".$_POST["sdd"]."/".$_POST["smm"]."/".$_POST["syy"]."',";
	$sql .= " `enddate` = '".$_POST["edd"]."/".$_POST["emm"]."/".$_POST["eyy"]."' WHERE `prepack_id` = '".$_POST["edit_id"]."' LIMIT 1 ";

	$result = Mysql_Query($sql);
	if($result)
		$title = "ได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว";
	else
		$title = "แก้ความผิดพลาดกรุณาติดต่อผู้ดูแล";
	break;




}

	echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
				window.onload = function(){
					window.open('prepack.php','right');
				}
			</SCRIPT>";

echo "<BR><BR><BR>
<TABLE  cellspacing=\"0\" border=\"1\" bordercolor=\"#3300FF\" align=\"center\">
<TR>
	<TD>
<TABLE bgcolor=\"#FFFFCC\">
	<TR>
		<TD align=\"center\"><BR><FONT style=\"font-family: 'MS Sans Serif'; font-size:16px\"><B>".$title."</B></FONT><BR><BR></TD>
	</TR>
	</TABLE>	
</TD>
</TR>
</TABLE>
";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=dgstrik.php\">";
exit();
}





if(isset($_GET["edit"]) && $_GET["edit"] != ""){
	
	$sql ="Select a.prepack_id,  a.drugcode,  a.total,  a.lot , a.startdate , a.enddate, b.tradname   From stiker_prepack as a , druglst  as b where a.prepack_id = '".$_GET["id"]."'   AND a.drugcode  = b.drugcode limit 0,1";
	$result = Mysql_Query($sql);
	$arr_edit = Mysql_fetch_assoc($result);

$arr["drugcode"] = $arr_edit["drugcode"];
$arr["tradname"] = $arr_edit["tradname"];

$arr["tradname"] = str_replace('"','&quot;',$arr["tradname"]);
$arr["tradname"] = str_replace("<","&lt;",$arr["tradname"]);
$arr["tradname"] = str_replace(">","&gt;",$arr["tradname"]);

$x = explode("/",$arr_edit["startdate"]);
$edit_sdd = $x[0];
$edit_smm = $x[1];
$edit_syy = $x[2];

$x = explode("/",$arr_edit["enddate"]);
$edit_edd = $x[0];
$edit_emm = $x[1];
$edit_eyy = $x[2];

$action = "form_edit";

$button = "แก้ไข";
$hidden = "<INPUT TYPE=\"hidden\" NAME=\"edit_id\" value=\"".$_GET["id"]."\">";
$cancle = "<INPUT TYPE=\"button\" VALUE=\"ยกเลิก\" ONCLICK=\"window.location.href='dgstrik.php'\">";
$sget = "&id=".$_GET["id"]."&edit=true";
}else{

$action = "form_add";
$button = "เพิ่ม";
$hidden = "";
$cancle = "<INPUT TYPE=\"reset\" VALUE=\"ยกเลิก\">";
$sget = "";
}

if(isset($_GET["dcode"])){

$sql = "Select drugcode,tradname FROM druglst Where drugcode = '".$_GET["dcode"]."' ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);

//$arr["tradname"] = str_replace("\"","\\\"",$arr["tradname"]);
$arr["tradname"] = str_replace('"','&quot;',$arr["tradname"]);
$arr["tradname"] = str_replace("<","&lt;",$arr["tradname"]);
$arr["tradname"] = str_replace(">","&gt;",$arr["tradname"]);

}

include("unconnect.inc");
?>

<style type="text/css">
<!--
.font1 {font-family: "MS Sans Serif"; font-size:14px}
-->
</style>

<form name="f1" action="" METHOD=POST>
<TABLE style="font-family: 'Angsana New';font-size: 18px;">
<TR>
	<TD align="right" class="font1"><a href="#" onclick="window.open('dgcode_in_strik.php?dgcode='+document.f1.drugcode.value+'&page=dgstrik<?php echo $sget;?>','right');">รหัสยา</a>&nbsp;:&nbsp;</TD>
	<TD>
	<input type="text" id ="drugcode" name="drugcode" size="8" id="aLink" value="<?php echo $arr["drugcode"];?>">
	
	</TD>
</TR>
<TR>
	<TD align="right"  class="font1">ชื่อทางการค้า&nbsp;:&nbsp;</TD>
	<TD><input type="text" id ="drugsalename" name="drugsalename" size="35" value="<?php echo $arr["tradname"];?>"></TD>
</TR>
<TR>
	<TD align="right"  class="font1">จำนวน&nbsp;:&nbsp;</TD>
	<TD><input type="text" id ="drugtotal" name="drugtotal" size="5" value="<?php echo $arr_edit["total"];?>"></TD>
</TR>
<TR>
	<TD align="right"  class="font1">Lot. No.&nbsp;:&nbsp;</TD>
	<TD><input type="text" id ="druglot" name="druglot" size="5" value="<?php echo $arr_edit["lot"];?>"></TD>
</TR>
<TR>
	<TD align="right"  class="font1">วันผลิต&nbsp;:&nbsp;</TD>
	<TD  class="font1">
	วันที่&nbsp;<INPUT TYPE="text" NAME="sdd" size="2" maxlength="2" value="<?php echo $edit_sdd; ?>">&nbsp;เดือน&nbsp;<INPUT TYPE="text" NAME="smm" size="2" maxlength="2" value="<?php echo $edit_smm; ?>">&nbsp;ปี&nbsp;<INPUT TYPE="text" NAME="syy" size="4" maxlength="4" value="<?php echo $edit_syy; ?>">
	</TD>
</TR>
<TR>
	<TD align="right"  class="font1">หมดอายุ&nbsp;:&nbsp;</TD>
	<TD  class="font1">วันที่&nbsp;<INPUT TYPE="text" NAME="edd" size="2" maxlength="2" value="<?php echo $edit_edd; ?>">&nbsp;เดือน&nbsp;<INPUT TYPE="text" NAME="emm" size="2" maxlength="2" value="<?php echo $edit_emm; ?>">&nbsp;ปี&nbsp;<INPUT TYPE="text" NAME="eyy" size="4" maxlength="4" value="<?php echo $edit_eyy; ?>"></TD>
</TR>
<!-- <TR>
	<TD align="right"  class="font1">จำนวนที่จะพิทพ์&nbsp;:&nbsp;</TD>
	<TD><input type="text" id ="total" name="total" value="1" size="2" ></TD>
</TR> -->
<TR>
	<TD align="center" colspan="2">
<INPUT TYPE="submit" value="<?php echo $button;?>">
&nbsp;&nbsp;
<?php echo $cancle;?>
&nbsp;&nbsp;
<INPUT TYPE="button" VALUE="แสดงข้อมูลที่เคยบันทึก" ONCLICK="window.open('prepack.php','right');">
</TD>
</TR>
</TABLE>
<!-- <INPUT TYPE="button" VALUE="&nbsp;ตกลง&nbsp;" ONCLICK="window.open('phar_sticker.php?drugcode='+document.f1.drugcode.value+'&drugsalename='+document.f1.drugsalename.value+'&drugtotal='+document.f1.drugtotal.value+'&druglot='+document.f1.druglot.value+'&sdd='+document.f1.sdd.value+'&smm='+document.f1.smm.value+'&syy='+document.f1.syy.value+'&edd='+document.f1.edd.value+'&emm='+document.f1.emm.value+'&eyy='+document.f1.eyy.value+'&total='+document.f1.total.value,'_target');"> -->


<INPUT TYPE="hidden" NAME="form_action" value="<?php echo $action;?>">
<?php echo $hidden;?>
</form>

<!-- 
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
 <th bgcolor=6495ED><font face='Angsana New'>ห้องจ่าย</th>
 <th bgcolor=6495ED><font face='Angsana New'>คลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>
 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,salepri ,stock,mainstk FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$salepri,$stock,$mainstk) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='right'  href=\"info.php? Dgcode=$drugcode& Amount=$amount& Trade=$tradname & Price=$salepri & Slcode=$slipcode\"><font face='Angsana New'>$drugcode</a></td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table> -->
