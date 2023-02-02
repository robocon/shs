<?php
include("connect.inc");
session_start();
require_once 'bootstrap.php';

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
    <div style="margin-top: 30px; margin-left: 30px;">
        <form method="post" action="ophn_eopd.php">
            <p style="font-size:24px;"><b>ค้นหาคนไข้ e-OPD จากHN</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="hn" type="text" class="txtsarabun" id="aLink" size="50" height="40">
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

                    // opedit.php? cHn=$hn & cName=$name &cSurname=$surname
                    print(" <tr style='font-size: 18px;'>\n" .
                        "  <td BGCOLOR=" . $color . "><a target= href=\"#\">$hn</a></td>\n" .
                        "  <td BGCOLOR=" . $color . ">$yot</td>\n" .
                        "  <td BGCOLOR=" . $color . ">$name</td>\n" .
                        "  <td BGCOLOR=" . $color . ">$surname</td>\n" .
                        "  <td BGCOLOR=" . $color . ">$ptright</td>\n" .
                        "<td bgcolor=\"$color\" align=\"center\">
                        <button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"window.open('dt_paperLess.php?hn=$hn')\">ดูประวัติการรักษา<br>e-OPD</button>
                        </td>" .
                        "<td bgcolor=\"$color\" align=\"center\"><a target= _BLANK href=\"printQrCode_opd2.php?hn=$hn\">พิมพ์ QR Code</a>
                        </td>" .
                        " </tr>\n");
                }
                ?>
        
            <?php
            }
            ?>
            </table>
    </div>

    <hr>
    <div>
    <style>
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        border: 1px solid black;
        font-size: 16pt;
        padding: 3px;
    }
    label:hover{
        cursor: pointer;
    }
    </style>
        <h3>รายชื่อผู้ป่วยนัดในวันนี้</h3>
        <div>
            <?php 
            $follow_lab_checked = $dolab_checked = '';
            foreach ($_REQUEST['controls'] as $key => $c) {
                if($c==='follow_lab'){
                    $follow_lab_checked = 'checked="checked"';
                }elseif($c==='do_lab'){
                    $dolab_checked = 'checked="checked"';
                }elseif($c==='do_xray'){
                    $xray_checked = 'checked="checked"';
                }
                
            }
            
            $date = date('Y-m-d');
            $dbi = new mysqli(HOST,USER,PASS,DB);
            $dbi->query("SET NAMES UTF8");

            ?>
            <form action="ophn_eopd.php?page=show_appoint" method="post" id="formAppoint">
                <table>
                    <tr>
                        <td>
                            <label for="follow_lab"><input type="checkbox" name="controls[]" id="follow_lab" onclick="actionSubmit()" value="follow_lab" <?=$follow_lab_checked;?> > ตามผล OUTLAB</label>
                        </td>
                        <td>
                            <label for="do_lab"><input type="checkbox" name="controls[]" id="do_lab" onclick="actionSubmit()" value="do_lab" <?=$dolab_checked;?> > มี LAB</label>
                        </td>
                        <td>
                            <label for="do_xray"><input type="checkbox" name="controls[]" id="do_xray" onclick="actionSubmit()" value="do_xray" <?=$xray_checked;?> > มี X-RAY</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php 
                            $applist = sprintf("%s", $_REQUEST['applist']);
                            $app_sql = $dbi->query("SELECT * FROM `applist` WHERE `status`='Y' ");
                            ?>
                            นัดมาเพื่อ 
                            <select name="applist" id="applist" onchange="actionSubmit()">
                                <option value="0">ดูทั้งหมด</option>
                            <?php 
                            while ($app = $app_sql->fetch_assoc()) { 

                                $selected = ( $applist===$app['appvalue'] ) ? 'selected="selected"' : '' ;

                                ?><option value="<?=$app['appvalue'];?>" <?=$selected;?> ><?=$app['applist'];?></option><?php
                            }
                            ?>
                            </select>
                        </td>
                        <td>
                            แพทย์ 
                            <?php 
                            $doctor = sprintf("%s", $_REQUEST['doctor']);
                            $doctor_q = $dbi->query("SELECT `name`,`position` FROM `doctor` WHERE `status` = 'y' ORDER BY `row_id` ASC");
                            ?>
                            <select name="doctor" id="doctor" onchange="actionSubmit()">
                                <option value="0">ดูทั้งหมด</option>
                            <?php 
                            while ($dt = $doctor_q->fetch_assoc()) { 

                                $selected = ( $doctor===$dt['name'] ) ? 'selected="selected"' : '' ;

                                ?><option value="<?=$dt['name'];?>" <?=$selected;?> ><?=$dt['name'];?></option><?php
                            }
                            ?>
                            </select>
                        </td>
                        <td>---</td>
                    </tr>
                </table>
            </form>
        </div>
        <div>
            <?php 
            // dump($_REQUEST);
            

            $sql_tmp = "CREATE TEMPORARY TABLE `appoint_tmp` 
            SELECT `appdate_en`,`hn`,`ptname`,`doctor`,`room`,`detail`, TRIM(`detail2`) AS `detail2`, TRIM(`patho`) AS `patho`, TRIM(`xray`) AS `xray` 
            FROM `appoint` 
            WHERE `appdate_en` = '$date' AND `apptime` != 'ยกเลิกการนัด' ";
            $dbi->query($sql_tmp);


            $sql = "SELECT * FROM `appoint_tmp` WHERE 1 ";

            foreach ($_REQUEST['controls'] as $key => $c) {
                if($c==='follow_lab'){
                    $sql .= "AND `detail2` LIKE '%ตามผล%' ";
                }

                if($c==='do_lab'){
                    $sql .= "AND ( `patho` != '' AND `patho` != 'ไม่มี' AND `patho` != 'NA' ) ";
                }

                if($c==='do_xray'){
                    $sql .= "AND ( `xray` != '' AND `xray` != 'ไม่มี' AND `xray` != 'NA' ) ";
                }
            }

            
            if(!empty($_REQUEST['applist'])){ 
                $sql .= "AND `detail` = '$applist' ";
            }

            if(!empty($_REQUEST['doctor'])){ 
                $sql .= "AND `doctor` = '$doctor' ";
            }
            
            $sql .= "ORDER BY `doctor`;";

            $q = $dbi->query($sql);
            if($q->num_rows > 0){
            
            ?>
            <table class="chk_table">
                <tr style="background-color: #009688;">
                    <th width="6%">hn</th>
                    <th width="15%">ptname</th>
                    <th width="13%">doctor</th>
                    <th>room</th>
                    <th>detail</th>
                    <th>patho</th>
                    <th>xray</th>
                    <th width="10%">พิมพ์สติกเกอร์</th>
                </tr>
            <?php 
            
            while ($a = $q->fetch_assoc()) {

                list($y, $m, $d) = explode('-', ad_to_bc($a['appdate_en']));

                $thdatehn = "$d-$m-$yhn";
                ?>
                <tr>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['doctor'];?></td>
                    <td><?=$a['room'];?></td>
                    <td>
                        <?=$a['detail'].(!empty($a['detail2']) ? ' ('.$a['detail2'].')' : '' );?></td>
                    <td><?=$a['patho'];?></td>
                    <td><?=$a['xray'];?></td>
                    <td>
                        <a href="sticker80.php?hn=<?=$a['hn'];?>">80x50 QR-Code</a><br>
                        <a href="sticker80.php?hn=<?=$a['hn'];?>&showvn=vn&thdatehn=<?=$thdatehn;?>">80x50 QR-Code + VN</a><br><br>

                        <a href="">50x30 QR-Code</a><br>
                        <a href="">50x30 QR-Code + VN</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php 
            }else{
                ?><p>ไม่พบข้อมูล</p><?php
            } // End rows > 0
            ?>

            <script>
                function actionSubmit(){
                    document.getElementById("formAppoint").submit();
                }
            </script>
        </div>
    </div>
</body>
