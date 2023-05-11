<?php 
include("connect.inc");
require_once 'bootstrap.php';

/*
$appd = $appdate . ' ' . $appmo . ' ' . $thiyr;
print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจที่มีการตรวจเลือด</b><br>";
print "<b>นัดมาวันที่</b> $appd ";
print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>
<table>
  <tr>
    <th bgcolor=6495ED>#</th>
    <th bgcolor=6495ED>เวลา</th>
    <th bgcolor=6495ED>HN</th>
    <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
    <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
    <th bgcolor=6495ED><font face='Angsana New'>LAB</th>
    <th bgcolor=6495ED><font face='Angsana New'>ผู้ออกใบนัด</th>
  </tr>
  <?php
  
  $query = "SELECT `hn`,`ptname`,`apptime`,`came`,`row_id`,`age`,`doctor`,`depcode`,`officer`,`date`,`patho` FROM appoint WHERE appdate = '$appd' and patho<> 'NA'  and patho <>'' and patho <>'ไม่มี'  ORDER BY row_id ASC    ";
  $result = mysql_query($query)or die("Query failed");
  $num = 0;
  while (list($hn, $ptname, $apptime, $came, $row_id, $age, $doctor, $depcode, $officer, $date, $patho) = mysql_fetch_row($result)) {
    $num++;
    print(" <tr>\n" .
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n" .
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n" .
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n" .
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n" .
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n" .
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$patho</td>\n" .
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n" .
      " </tr>\n");
  }
  include("unconnect.inc");
  ?>
</table>
<?php

*/
?>








<div>
    <style>
      body {
        background-color: #FFFFF0;
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
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
	.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}
    </style>
        <h3>รายชื่อผู้ป่วยนัดในวันนี้ 
		<span style='margin-left:20px;'><input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" /></span>
        <span style='margin-left:20px;'><input type="button" name="button" id="button" value="เลือกวันที่ใหม่" onclick="window.location='appoichkalllab.php' " class="txtsarabun" /></span> 
		 </h3>
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
            

            $appdate = $_POST['appdate'];
            $appmo = $_POST['appmo'];
            $thiyr = $_POST['thiyr']-543;
            if(!empty($appdate) && !empty($appmo) && !empty($thiyr)){ 

                $keymo = array_search($appmo, $def_fullm_th);
                $date = "$thiyr-$keymo-$appdate";

            }else{
                $date = date('Y-m-d');
            }

            $dbi = new mysqli(HOST,USER,PASS,DB);
            $dbi->query("SET NAMES UTF8");

            ?>
            <form action="ptappoialllab.php" method="post" id="formAppoint">
                <table>
                    <tr>
                        <td>
                            <label for="follow_lab"><input type="checkbox" name="controls[]" id="follow_lab" onclick="actionSubmit()" value="follow_lab" <?=$follow_lab_checked;?> > ตามผลต่างๆ</label>
                        </td>
                        <td>
                            <label for="do_lab"><input type="checkbox" name="controls[]" id="do_lab" onclick="actionSubmit()" value="do_lab" <?=$dolab_checked;?> > มี LAB</label>
                        </td>
                        <td>
                            <label for="do_xray"><input type="checkbox" name="controls[]" id="do_xray" onclick="actionSubmit()" value="do_xray" <?=$xray_checked;?> > มี X-RAY</label>
                            <input type="hidden" name="appdate" value="<?=$_POST['appdate'];?>">
                            <input type="hidden" name="appmo" value="<?=$_POST['appmo'];?>">
                            <input type="hidden" name="thiyr" value="<?=$_POST['thiyr'];?>">
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
                <tr style="background-color: #16A085; color: white;">
                    <th width="5%">ลำดับ</th>
					<th width="6%">HN</th>
                    <th width="15%">ชื่อสกุล</th>
                    <th width="13%">แพทย์</th>
                    <th>ห้อง</th>
                    <th>รายละเอียด</th>
                    <th>patho</th>
                    <th>xray</th>
                    <th width="10%">พิมพ์สติกเกอร์</th>
                </tr>
            <?php 
            $i=0;
            while ($a = $q->fetch_assoc()) {
			$i++;
                list($y, $m, $d) = explode('-', ad_to_bc($a['appdate_en']));

                $thdatehn = "$d-$m-$yhn";
                ?>
                <tr style="background-color: #A2D9CE;">
                    <td align="center"><?=$i;?></td>
					<td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['doctor'];?></td>
                    <td><?=$a['room'];?></td>
                    <td>
                        <?=$a['detail'].(!empty($a['detail2']) ? ' ('.$a['detail2'].')' : '' );?></td>
                    <td><?=$a['patho'];?></td>
                    <td><?=$a['xray'];?></td>
                    <td>
                        <a href="sticker80.php?hn=<?=$a['hn'];?>&stickersize=80" target="_blank">QR CODE (80x50)</a><br>
	                      <a href="sticker80.php?hn=<?=$a['hn'];?>&stickersize=30" target="_blank">QR CODE (30x50)</a>
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