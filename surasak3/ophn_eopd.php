<?php
session_start();
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
</style>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script><body bgcolor="#60c4b8">
<div style="margin-top: 30px;">
<form method="post" action="ophn_eopd.php">
    <p style="font-size:24px;"><b>ค้นหาคนไข้ e-OPD จากHN</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="hn" type="text" class="txtsarabun" id="aLink"  size="50" height="40">
    </p>
    
    <p style="margin-left:100px;">
    <input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     ">
    &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="     ยกเลิก     ">
    </p>
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>

<table width="100%" border="0" cellpadding="10" cellspacing="4" bordercolor="#FFFFFF">
<tr>
        <th width="57" height="22" bgcolor=#009688><span class="style2">HN</span></th>
      <th bgcolor=#009688 width="47"><span class="style2">ยศ</span></th>
      <th width="77" bgcolor=#009688><span class="style2">ชื่อ</span></th>

      <th width="69" bgcolor=#009688><span class="style2">สกุล</span></th>
      <th width="174" bgcolor=#009688><span class="style2">ใบต่อแบบใหม่</span></th>
      <th width="98" bgcolor=#009688><span class="style2">มา รพ.</span></th>
      <th width="130" bgcolor=#009688><span class="style2">ตรวจนอน</span></th>
      <th width="81" bgcolor=#009688><span class="style2">ใบต่อ</span></th>
<!-- <th bgcolor=6495ED>ใบยานอก</th>
        <th bgcolor=6495ED>ใบสั่งยา</th>
        <th bgcolor=6495ED>ใบตรวจโรค</th>-->       
        <th bgcolor=#009688 colspan="5"><span class="style2">ใบตรวจโรค</span></th>
        <th bgcolor=#009688><span class="style2">เช็คสิทธิ์ ธ.ออมสิน</span></th>
        <th bgcolor=#009688><span class="style2">เช็คสิทธิ์ ธปท.</span></th>
		<th bgcolor=#009688><span class="style2">เช็คสิทธิ์ ททท.</span></th>
	  <th width="120" bgcolor="#009688">&nbsp;</th>
    </tr>

    <?php
    If (!empty($hn)){
        include("connect.inc");
        global $hn;
        $query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '$hn'";
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

			if(!empty($idcard)){
				$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql)) > 0){
					echo"ผู้ป่วยมีสิทธิประกันสังคม";
				}else{
					$sql1="Select Idcard From botdata where Idcard LIKE '$idcard%' limit 1 ";
					if(Mysql_num_rows(Mysql_Query($sql1)) > 0){
						echo"ผู้ป่วยมีสิทธิธนาคารออมสิน";
					}else{
						$sql2="Select emp_idcard From botdata where emp_idcard LIKE '$idcard%' limit 1 ";
						if(Mysql_num_rows(Mysql_Query($sql2)) > 0){
							echo"ผู้ป่วยมีสิทธิธนาคารแห่งประเทศไทย";
						}else{							
							echo"";
						}
					}
				}
            }else{
                echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มีเลขประจำตัวประชาชน</FONT>";
                ?>
                <script type="text/javascript">
                alert('ผู้ป่วยไม่มีเลขประจำตัวประชาชน');
                </script>
                <?php
            }

            if(!empty($hn)){
                $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิจ่ายตรง</FONT>";
                }else{
                    echo"";
                }
            }else{
                echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มี HN</FONT>";
            }

            // opedit.php? cHn=$hn & cName=$name &cSurname=$surname
            print (" <tr style='font-size: 18px;'>\n".
            "  <td BGCOLOR=".$color."><a target= href=\"#\">$hn</a></td>\n".
            "  <td BGCOLOR=".$color.">$yot</td>\n".
            "  <td BGCOLOR=".$color.">$name</td>\n".
            "  <td BGCOLOR=".$color.">$surname</td>\n".
            "  <td BGCOLOR=".$color."><a target=_BLANK  href=\"opdcard_opregis.php?cHn=$hn\">$ptright</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">มา รพ.</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</a></td>\n".
            // "  <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน</td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"opdprint2.php?cHn=$hn\">ใบต่อ</a></td>\n".
            /*"  <td BGCOLOR=".$color."><a target= _BLANK href=\"edprint.php?cHn=$hn\">ใบยานอก</td>\n".
            "  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">ผู้ป่วยนัด</td>\n".
            "  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint1.php?cHn=$hn\">ใบตรวจโรค</td>\n".*/
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointhdvn.php?cHn=$hn\">ไต</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointdenvn.php?cHn=$hn\">ฟัน</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointeyevn.php?cHn=$hn\">ตา</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointbgvn.php?cHn=$hn\">สูติ</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">ผป.นัด</a></td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"gsb_chk.php\">ตรวจสอบ</a></td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"bot_chk.php\">ตรวจสอบ</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"travel_chk.php\">ตรวจสอบ</a></td>\n".
			"<td bgcolor=\"$color\" align=\"center\">
            <button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"window.open('dt_paperLess.php?hn=$hn')\">ค้นหา<br>e-OPD</button><br>
            <a target= _BLANK href=\"register_print_qrcode.php?hn=$hn\">พิมพ์ QR Code</a>
            </td>".
			/*"<td bgcolor=\"$color\" align=\"center\">
            <button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"checkPtRight(this, event, '$idcard')\">ตรวจสอบสิทธิ</button><br>
            <a target= _BLANK href=\"register_print_qrcode.php?hn=$hn\">พิมพ์ QR Code</a>
            </td>".*/
            " </tr>\n");
        }
        ?>
</table>
<?php 
    }
    ?>


</div>