<?php
$cHn = "";
$cPtname = "";
$cPtright = "";
$nRunno = "";
$tvn = "";
session_register("nRunno");
session_register("cHn");
session_register("cPtname");
session_register("cPtright");
session_register("tvn");
?>
<div>
	<a target="_self"  href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลักโปรแกรม</a>
</div>
<fieldset style="display:inline-block;">
    <legend>ผู้ป่วยนอก หมายเลข VN (ได้จากแผนกเวชระเบียน)</legend>
    <form method="POST" action="vnordx.php">
        <table>
            <tr>
                <td width="10%">VN: </td>
                <td><input type="text" name="vn" size="8"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="   ตรวจสอบ   " name="B1"></td>
            </tr>
        </table>
    </form>
</fieldset>
<div>&nbsp;</div>

<?php
if (!empty($vn)) {
    $tvn = "$vn";
    include("connect.inc");

    $today = date("d-m-Y");
    $d = substr($today, 0, 2);
    $m = substr($today, 3, 2);
    $yr = substr($today, 6, 4) + 543;
    $thdatevn = $d . '-' . $m . '-' . $yr . $vn;
    // ตรวจดูว่าลงทะเบียนหรือยัง
    $query = "SELECT * FROM opday WHERE thdatevn = '$thdatevn'";
    $result = mysql_query($query) or die("Query failed,opday");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if (!($row = mysql_fetch_object($result)))
            continue;
    }
    //กรณียังไม่ลงทะเบียน
    if (empty($row->hn)) {
        print "VN :$vn<br>";
        print "ยังไม่ได้ลงทะเบียนตรวจวันนี้  โปรดขอ VN ใหม่จากห้องทะเบียน<br>";
    } else { //กรณีลงทะเบียนแล้ว
        $cHn = $row->hn;
        $cPtname = $row->ptname;
        $cPtright = $row->ptright;
        ?>
        <fieldset style="display:inline-block;">
            <legend>ข้อมูลผู้มารับบริการ</legend>
            <table>
                <tr>
                    <td align="right"><strong>HN: </strong></td>
                    <td><?=$cHn;?></td>
                </tr>
                <tr>
                    <td align="right"><strong>VN: </strong></td>
                    <td><?=$vn;?></td>
                </tr>
                <tr>
                    <td align="right"><strong>ชื่อสกุล: </strong></td>
                    <td><?=$cPtname;?></td>
                </tr>
                <tr>
                    <td align="right"><strong>สิทธิการรักษา: </strong></td>
                    <td><?=$cPtright;?></td>
                </tr>
                <tr>
                    <td align="right"><strong>สิทธิปัจจุบัน: </strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
            </table>
        </fieldset>
        <div>
            <p>
                <a href='orask.php'>ยืนยันข้อมูลถูกต้อง และต้องการทำรายการต่อไป</a>
            </p>
            <p>* หากข้อมูลไม่ถูกต้อง กรุณาประสานแผนกทะเบียน เพื่อแก้ไขข้อมูล</p>
        </div>
        <?php 

        //runno  for chktranx
        $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
        $result = mysql_query($query) or die("Query failed");

        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
            if (!mysql_data_seek($result, $i)) {
                echo "Cannot seek to row $i\n";
                continue;
            }

            if (!($row = mysql_fetch_object($result)))
                continue;
        }

        $nRunno = $row->runno;
        $nRunno++;

        // !!!!!!!!
        // $nRunno เอาไปใช้ใน chktranx ในตาราง depart
        // !!!!!!!!

        $query = "UPDATE runno SET runno = $nRunno WHERE title='depart'";
        $result = mysql_query($query)
            or die("Query failed");
        //end  runno  for chktranx
    }
    include("unconnect.inc");
}else{
    ?>
    <p><strong>กรุณาใส่ VN</strong></p>
    <?php
}
?>