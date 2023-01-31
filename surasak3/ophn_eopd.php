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
<div style="margin-top: 30px; margin-left: 30px;">
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
            "  <td BGCOLOR=".$color.">$ptright</td>\n".
			"<td bgcolor=\"$color\" align=\"center\">
            <button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"window.open('dt_paperLess.php?hn=$hn')\">ดูประวัติการรักษา<br>e-OPD</button>
            </td>".
			"<td bgcolor=\"$color\" align=\"center\"><a target= _BLANK href=\"printQrCode_opd.php?hn=$hn\">พิมพ์ QR Code</a>
            </td>".
            " </tr>\n");
        }
        ?>
</table>
<?php 
    }
    ?>


</div>