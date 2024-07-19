<?php
// vnordx.php --> orask.php --> preor.php --> ortopayop.php --> orpaid.php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$Conn = mysql_connect(HOST,USER,PASS);
mysql_select_db(DB);
mysql_query("SET NAMES UTF8");

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เก็บค่าเวชภัณฑ์และอุปกรณ์(ผป.นอก)</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
        }
        h3, legend{
            font-weight: bold;
        }
        fieldset{
            border: 1px solid #000000;
            padding: 16px;
        }
        legend{
            border: 1px solid #000000;
            float: none;
            padding: 0 16px;
        }
        #menu{
            background-color: #13795b!important;
        }
    </style>
    <nav class="navbar bg-dark border-bottom border-body" id="menu" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../nindex.htm">หน้าหลักโปรแกรม</a>
        </div>
    </nav>
    <div class="container mt-4">
        <h3>เก็บค่าเวชภัณฑ์และอุปกรณ์(ผป.นอก)</h3>
        <div class="col-md-8">
            <fieldset>
                <legend>ผู้ป่วยนอก หมายเลข VN (ได้จากแผนกเวชระเบียน)</legend>
                <form method="POST" action="vnordx.php">
                    <table>
                        <tr>
                            <td width="10%"><strong>VN:</strong> </td>
                            <td><input type="text" id="vn" name="vn" size="8"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="ตรวจสอบ" name="B1" id="submit" class="btn btn-primary"></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    <?php
    if (!empty($vn)) {
        $tvn = "$vn";
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
            ?>
            <div class="alert alert-warning col-md-8 mt-4" role="alert">VN: <?=$vn;?> ยังไม่ได้ลงทะเบียนตรวจวันนี้  โปรดขอ VN ใหม่จากห้องทะเบียน</div>
            <?php
        } else { //กรณีลงทะเบียนแล้ว
            $cHn = $row->hn;
            $cPtname = $row->ptname;
            $cPtright = $row->ptright;
            ?>
            <div class="col-md-8 mt-4">
                <fieldset>
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
            </div>
            
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
        <div class="alert alert-warning col-md-8 mt-4" role="alert">กรุณาใส่ VN</div>
        <?php
    }
    ?>




    </div>
</body>
</html>