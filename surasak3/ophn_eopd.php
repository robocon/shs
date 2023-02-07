<?php
session_start();
include("connect.inc");
session_unregister("cHn");
session_unregister("cPtname");
session_unregister("cPtright");
session_unregister("nVn");
session_unregister("cAge");
session_unregister("nRunno");
session_unregister("vAN");
session_unregister("thdatehn");
session_unregister("cNote");
session_unregister("Ptright1");
//    session_destroy();
?>
<style>
body {
	background-color: #FFFFF0;
    font-family: "TH SarabunPSK";
        font-size: 18px;
    }
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 18;
	}
a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #2980B9;
  color: white;
}	
</style>
 <SCRIPT LANGUAGE="JavaScript">
function checkForm(){
	if(document.f2.hn.value == "" && document.f2.name.value == "" && document.f2.name.value == ""){
		alert('กรุณาระบุเงื่อนไขในการค้นหาข้อมูลด้วยครับ');
		return false;
	}else{
		return true;
	}
}
</script>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script><body bgcolor="#60c4b8">
<div style="margin-top: 30px; margin-left: 30px;">
<form name="f2" method="post" action="ophn_eopd.php" Onsubmit="return checkForm();">
<input type="hidden" name="act" value="show">
    <p style="font-size:24px;"><b>ค้นหาคนไข้ e-OPD จากHN</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="hn" type="text" class="txtsarabun" id="aLink"  size="50" height="40">
	<span style="margin-left: 10px;">หรือ</span></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="name" type="text" class="txtsarabun" id="aLink"  size="50" height="40">
	<span style="margin-left: 10px;">หรือ</span>&nbsp;&nbsp; นามสกุล&nbsp;&nbsp;
    <input name="surname" type="text" class="txtsarabun" size="50" height="40">
    </p>    
    <p style="margin-left:100px;">
    <input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     ">
    &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="     ยกเลิก     ">
&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" name="button" id="button" value="   กลับหน้าหลัก   " onclick="window.location='../nindex.htm'" class="txtsarabun" />	
    </p>	
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>
<table width="80%" border="0" cellpadding="10" cellspacing="4" bordercolor="#FFFFFF">
<tr>
        <th width="57" height="22" bgcolor=#009688><span class="style2">HN</span></th>
      <th bgcolor=#009688 width="47"><span class="style2">ยศ</span></th>
      <th width="77" bgcolor=#009688><span class="style2">ชื่อ</span></th>

      <th width="69" bgcolor=#009688><span class="style2">สกุล</span></th>
      <th width="174" bgcolor=#009688><span class="style2">สิทธิการรักษา</span></th>
	  <th width="120" bgcolor="#009688">การมาโรงพยาบาล</th>
	  <th width="120" bgcolor="#009688">สติ๊กเกอร์ QR CODE</th>
    </tr>

    <?php
	$act=$_POST["act"];
	$hn=$_POST["hn"];
	$name=$_POST["name"];
	$surname=$_POST["surname"];
	$dthn=date("d-m-").(date("Y")+543).$hn;
    if (!empty($act)){
		
		if(!empty($hn)){
			$query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '$hn'";	
			echo"<FONT SIZE='' COLOR='#FF0033'>ผลการค้นหาจาก HN: $hn</FONT>";
		}else if(!empty($name) && empty($surname)){
			$query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE name = '$name'";
			echo"<FONT SIZE='' COLOR='#FF0033'>ผลการค้นหาจาก ชื่อ: $name</FONT>";
		}else if(!empty($surname) && empty($name)){
			$query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE surname = '$surname'";
			echo"<FONT SIZE='' COLOR='#FF0033'>ผลการค้นหาจาก นามสกุล: $surname</FONT>";
		}else if(!empty($name) && !empty($surname)){
			$query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE name LIKE '%$name%' and surname LIKE '%$surname%'";
			echo"<FONT SIZE='' COLOR='#FF0033'>ผลการค้นหาจาก ชื่อ: $name และ นามสกุล: $surname</FONT>";
		} 	

        $result = mysql_query($query)or die("Query failed");
        while (list ($hn,$yot,$name,$surname,$ptright,$ptright1,$idcard) = mysql_fetch_row ($result)) {

            if(substr($ptright,0,3)=='R07' && !empty($idcard)){
                $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    $color = "#208eb4";
                }else{
                    $color = "FF8C8C";
                }
            }else if(substr($ptright,0,3)=='R03'){
                $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    $color = "7dcf80";
                }else{
                    $color = "FF8C8C";
                }
            }else{
                $color = "#fdee6e";
            }


			$sql112 = "Select hn From opday where thdatehn = '".$dthn."' order by row_id desc limit 1 ";
			$result112 = Mysql_Query($sql112);
			list($chkhn) = Mysql_fetch_row($result112);	

			if(empty($chkhn)){
				$link="<button type=\"button\" class=\"txtsarabun\" id=\"button\" onclick=\"window.open('printQrCode_opd2.php?hn=$hn')\"><img src='images/print.png' height='28px' width='28px' style='margin-top:5px;' /><div style='margin-top:5px;'>พิมพ์ QR Code</div></button>";
			}else{
				$link="<button type=\"button\" class=\"txtsarabun\" id=\"button\" onclick=\"window.open('printQrCode_opd1.php?hn=$hn')\"><img src='images/print.png' height='28px' width='28px' style='margin-top:5px;' /><div style='margin-top:5px;'>พิมพ์ QR Code</div></button>";
			}

            $link .= '<div style="margin-top:20px;"><a target="_BLANK" href="sticker80.php?hn='.$hn.'&stickersize=30"><img src="images/print.png" height="20px" width="20px"><div style="margin-top:5px;">พิมพ์สติ๊กเกอร์เล็ก</div></a></div>';

            // opedit.php? cHn=$hn & cName=$name &cSurname=$surname
            print (" <tr style='font-size: 18px;'>\n".
            "  <td BGCOLOR=".$color."><a target= href=\"#\">$hn</a></td>\n".
            "  <td BGCOLOR=".$color.">$yot</td>\n".
            "  <td BGCOLOR=".$color.">$name</td>\n".
            "  <td BGCOLOR=".$color.">$surname</td>\n".
            "  <td BGCOLOR=".$color.">$ptright</td>\n".
			"<td bgcolor=\"$color\" align=\"center\">
            <button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"window.open('dt_paperLess.php?hn=$hn')\"><img src='images/views.png' height='28px' width='28px' style='margin-top:5px;' /><div style='margin-top:5px;'>ประวัติการรักษา</div></button>
            </td>".
			"<td bgcolor=\"$color\" align=\"center\">$link</td>".
            " </tr>\n");
        }
        ?>
</table>
<?php 
    }
    ?>


</div>