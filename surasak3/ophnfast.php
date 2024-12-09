<?php
session_start();
require_once "connect.php";

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
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }

    .style2 {
        font-family: "TH SarabunPSK";
        font-size: 18;
    }
</style>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>

<body bgcolor="#60c4b8">
    <div style="margin-left:50px; margin-top: 30px;">
        <form method="post" action="ophnfast.php">
            <p style="font-size:24px;"><b>ค้นหาคนไข้จาก&nbsp; HN</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="hn" type="text" class="txtsarabun" id="aLink" size="50" height="40" autofocus>
            </p>

            <p style="margin-left:100px;">
                <input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     ">
                &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="     ยกเลิก     ">
            </p>
        </form>
        <script type="text/javascript">
            document.getElementById('aLink').focus();
        </script>

        <table width="83%" border="0" cellpadding="10" cellspacing="4" bordercolor="#FFFFFF">
            <tr>
                <th width="57" height="22" bgcolor=#009688><span class="style2">HN</span></th>
                <th bgcolor=#009688 width="47"><span class="style2">ยศ</span></th>
                <th width="77" bgcolor=#009688><span class="style2">ชื่อ</span></th>
                <th width="69" bgcolor=#009688><span class="style2">สกุล</span></th>
                <th width="100" bgcolor=#009688><span class="style2">สิทธิการรักษา</span></th>
                <th width="100" bgcolor=#009688><span class="style2">ดำเนินการ</span></th>
            </tr>

            <?php
            if (!empty($hn)) {
                
                global $hn;
                $query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '$hn'";
                $result = mysql_query($query) or die("Query failed");
                while (list($hn, $yot, $name, $surname, $ptright, $ptright1, $idcard) = mysql_fetch_row($result)) {

                    if (substr($ptright, 0, 3) == 'R07' && !empty($idcard)) {
                        $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

                        if (Mysql_num_rows(Mysql_Query($sql)) > 0) {
                            $color = "#208eb4";
                        } else {
                            $color = "FF8C8C";
                        }
                    } else if (substr($ptright, 0, 3) == 'R03') {
                        $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

                        if (Mysql_num_rows(Mysql_Query($sql)) > 0) {
                            $color = "7dcf80";
                        } else {
                            $color = "FF8C8C";
                        }
                    } else {
                        $color = "#fdee6e";
                    }

                    if (!empty($idcard)) {
                        $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
                        if (Mysql_num_rows(Mysql_Query($sql)) > 0) {
                            echo "ผู้ป่วยมีสิทธิประกันสังคม";
                        } else {
                            $sql1 = "Select Idcard From botdata where Idcard LIKE '$idcard%' limit 1 ";
                            if (Mysql_num_rows(Mysql_Query($sql1)) > 0) {
                                echo "ผู้ป่วยมีสิทธิธนาคารออมสิน";
                            } else {
                                $sql2 = "Select emp_idcard From botdata where emp_idcard LIKE '$idcard%' limit 1 ";
                                if (Mysql_num_rows(Mysql_Query($sql2)) > 0) {
                                    echo "ผู้ป่วยมีสิทธิธนาคารแห่งประเทศไทย";
                                } else {
                                    echo "";
                                }
                            }
                        }
                    } else {
                        echo "<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มีเลขประจำตัวประชาชน</FONT>";
                        ?>
                        <script type="text/javascript">
                            alert('ผู้ป่วยไม่มีเลขประจำตัวประชาชน');
                        </script>
                        <?php
                    }

                    if (!empty($hn)) {
                        $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
                        if (Mysql_num_rows(Mysql_Query($sql)) > 0) {
                            echo "<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิจ่ายตรง</FONT>";
                        } else {
                            echo "";
                        }
                    } else {
                        echo "<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มี HN</FONT>";
                    }

                    print (" <tr style='font-size: 18px;'>\n" .
                        "  <td BGCOLOR=" . $color . ">$hn</td>\n" .
                        "  <td BGCOLOR=" . $color . ">$yot</td>\n" .
                        "  <td BGCOLOR=" . $color . ">$name</td>\n" .
                        "  <td BGCOLOR=" . $color . ">$surname</td>\n" .
                        "  <td BGCOLOR=" . $color . ">$ptright</td>\n" .
                        "  <td align=\"center\" BGCOLOR=" . $color . "><input type=\"button\" name=\"button\" id=\"button\" value=\"ลงทะเบียนผู้ป่วย\" oncontextmenu=\"return doNotOpenNewTab(event, '$hn');\" onclick=\"openNewWindow(event,'$hn')\" class=\"txtsarabun\" /></td>\n" .
                        " </tr>\n");

                    $_SESSION['hn'] = $hn;
                    $_SESSION['name'] = $name;
                    $_SESSION['surname'] = $surname;

                }

                $sql1 = "SELECT  * FROM opcard where name='" . $_SESSION['name'] . "' and surname='" . $_SESSION['surname'] . "' and hn !='" . $_SESSION['hn'] . "' ";
                $result1 = mysql_query($sql1);
                $rows1 = mysql_num_rows($result1);
                if ($rows1) {
                    echo "<font color='#FF0000'>ซ้ำ</font>";
                }

                // ตรวจสอบและเปลี่ยน HN AN ตอนขึ้นปีใหม่
                $sql = "Select left(prefix,2) From runno where title = 'HN' ";
                list($title_hn) = Mysql_fetch_row(Mysql_Query($sql));
                $year_now = substr(date("Y") + 543, 2);
                if ($title_hn != $year_now) {
                    $sql = "Update runno set prefix = '" . $year_now . "-', runno = 0 where  title = 'HN' limit 1;";
                    $result = mysql_Query($sql);
                }

                $sql = "Select left(prefix,2) From runno where title = 'AN' ";
                list($title_an) = Mysql_fetch_row(Mysql_Query($sql));
                $year_now = substr(date("Y") + 543, 2);
                if ($title_an != $year_now) {
                    $sql = "Update runno set prefix = '" . $year_now . "/', runno = 0 where  title = 'AN' limit 1;";
                    $result = mysql_Query($sql);
                }
                // END
                ?>
            </table>
            <div style="margin-top: 30px; font-size:18px; font-weight:bold;">
                <FONT COLOR="#990000">***คำอธิบาย***</FONT> <BR>
                <FONT COLOR="#fdee6e">สีเหลือง คือ ยังไม่ได้ทำการตรวจสิทธิการรักษา</FONT><BR>
                <FONT COLOR="#208eb4">สีน้ำเงิน คือ ตรวจสอบแล้ว มีสิทธิประกันสังคม</FONT><BR>
                <FONT COLOR="#7dcf80">สีเขียว คือ ตรวจสอบแล้ว มีสิทธิจ่ายตรง</FONT><BR>
                <FONT COLOR="#FF0033">สีแดง คือ ไม่มีสิทธิ</FONT><BR>
            </div>
            <hr />

            <?php
        }
            $alert_msg = null;
            $hn = isset($_POST['hn']) ? $_POST['hn'] : null;
            if ($hn !== null) {

                $query = mysql_query("select * from ipcard where hn='$hn' and ( dcdate='0000-00-00 00:00:00' AND bedcode <> '' ) ");
                if (mysql_num_rows($query) > 0) {
                    $item = mysql_fetch_assoc($query);
                    $alert_msg = "ผู้ป่วยรายนี้ยังAdmit อยู่ที่" . $item['my_ward'];
                    echo "<script>alert('" . $alert_msg . "');</script>";
                }

            }

            if (!empty($alert_msg)) {
                ?>
                <h2 style="color: red;"><u>!!! <?= $alert_msg; ?> !!!</u></h2>
                <?php
            }
            ?>

        <script type="text/javascript">

            function openNewWindow(event, hn){
                if (event.ctrlKey) {
                    return doNotOpenNewTab(event, hn);
                }
                window.open('opworkfast.php?hn='+hn, 'registerVn',"width="+screen.width+",height="+screen.height);
            }

            function doNotOpenNewTab(event,hn){
                onSendTab(hn);
                alert("ห้ามเปิดหน้าลงทะเบียนซ้ำซ้อน");
                return false;
            }

            async function onSendTab(hn) {
                const username = encodeURIComponent('<?=$sOfficer;?>');
                const tab = encodeURIComponent('ophn จะเปิด tab ใหม่');
                const response = await fetch('open_tab.php?username='+username+'&tab='+tab+'&hn='+hn);

                if (!response.ok) {
                }

                const body = await response.text();
            }

        </script>
    </div>