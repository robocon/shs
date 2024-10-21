<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syndromic Surveillance Report</title>
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
            font-size: 18px;
        }
        table.table th, #NavBar{
            background-color: #13795b;
            color: #ffffff;
        }
        #NavBar a{
            color: #ffffff;
        }
    </style>
    <nav class="navbar" id="NavBar">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.htm">&#127968; หน้าหลัก</a>
        </div>
    </nav>  
    <div class="container">
        <div class="mt-2">
            <h3>Syndromic Surveillance Report</h3>
        </div>
        <div>
            <form class="" action="syndromic_surveillance_report.php" method="post">
                <div class="mb-3 row">
                    <label class="col-sm-1 col-form-label" align="right">กลุ่ม</label>
                    <div class="col-sm-4">
                        <?php 
                        $diarrheaList = array(1=>'Acute diarrhea','Viral conjunctivitis','Fever of unknown origin','Acute Flaccid Paralysis อายุน้อยกว่า 15 ปี','Adverse Event Following Immunization ','Viral exanthema','Influenza-like illness');
                        ?>
                        <select name="group" id="group" class="form-select">
                            <?php 
                            foreach ($diarrheaList as $key => $diarr) { 
                                $groupSelected = ($key==$_POST['group']) ? 'selected="selected"' : '' ;
                                ?>
                                <option value="<?=$key;?>" <?=$groupSelected;?> ><?=$diarr;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-1 col-form-label" align="right">วันที่</label>
                    <div class="col-sm-2">
                        <?php 
                        $defCurrentDate = ((date('Y')+543).date('-m-d'));
                        $inputDate = empty($_POST['date']) ? $defCurrentDate : sprintf("%s", $_POST['date']) ;
                        ?>
                        <input type="text" name="date" id="date" class="form-control" value="<?=$inputDate;?>">
                        <div class="mt-1">
                            <span class="badge text-bg-primary"><strong>ค้นตามวันที่</strong> เช่น 2567-10-21</span>
                        </div>
                        <div class="mt-1">
                            <span class="badge text-bg-primary"><strong>ค้นตามเดือน</strong> เช่น 2567-10</span>
                        </div>
                        <div class="mt-1">
                            <span class="badge text-bg-primary"><strong>ค้นตามปี</strong> เช่น 2567</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary">ค้นหาข้อมูล</button>
                        <input type="hidden" name="action" value="search">
                    </div>
                </div>
            </form>
        </div>

    <?php 
    $action = sprintf($_POST['action']);
    if($action==='search'){
    
        $group = sprintf("%s", $_POST['group']);
        $dateSelected = sprintf("%s", $_POST['date']);
        ?>
        <div>
            <h3>กลุ่ม <?=$diarrheaList[$group];?></h3>
        </div>
        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>วัน-เวลา</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>อายุ</th>
                <th>สิทธิ์</th>
                <th>โรค</th>
                <th>ICD10</th>
                <th>ปัตร ปชช</th>
                <th>ที่อยุ่</th>
                <th>ตำบล</th>
                <th>อำเภอ</th>
                <th>จังหวัด</th>
                <th>โทรศัพท์</th>
            </tr>
            <?php 
            if($group==1){
                $whereGroup = "a.`icd10` REGEXP '(A04[0-9])$' 
                OR a.`icd10` REGEXP '(A08[0-5])$' 
                OR a.`icd10` = 'A090' 
                OR a.`icd10` = 'A099'";

            }else if ($group == 2) {
                $whereGroup = "a.`icd10` REGEXP '(B30[0-3])$' 
                OR a.`icd10` = 'B308' 
                OR a.`icd10` = 'B309'";

            }else if ($group == 3) {
                $whereGroup = "a.`icd10` = 'R508' 
                OR a.`icd10` = 'R509'";

            }else if ($group == 4) {
                $whereGroup = " TIMESTAMPDIFF(year,CONCAT((SUBSTRING(b.`dbirth`,1,4)-543),SUBSTRING(b.`dbirth`,5,6)), now() ) < 15 
                AND a.`icd10` IN ('A051', 'A80', 'E802', 'G369', 'G373', 'G588', 'G589', 'G610', 'G629', 'G634', 'G700', 'G723', 'G724', 'G75', 'G800', 'G810', 'G820', 'G822', 'G823', 'G825', 'G830','G831','G832','G833', 'G839', 'G959', 'M791', 'M792', 'R53', 'T60') ";

            }else if ($group == 5) {
                $whereGroup = "a.`icd10` IN ('T805', 'T806', 'T880', 'T881', 'M022')";

            }else if ($group == 6) {
                $whereGroup = "a.`icd10` = 'B09'";
                
            }else if ($group == 7) {
                $whereGroup = "a.`icd10` IN ('J00', 'J029', 'J09', 'J10', 'J11')";
                
            }
            
            $sql = sprintf("SELECT a.`svdate`,a.`hn`,a.`diag`,a.`icd10`,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`,TIMESTAMPDIFF(year,CONCAT((SUBSTRING(b.`dbirth`,1,4)-543),SUBSTRING(b.`dbirth`,5,6)), now() ) AS `age`,b.`ptright`,b.`idcard`,b.`address`,b.`tambol`,b.`ampur`,b.`changwat`,b.`phone` 
            FROM `diag` AS a 
            LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
            WHERE a.`svdate` LIKE '%s%%' 
            AND ( $whereGroup ) 
            ORDER BY a.`svdate` DESC;",
            $dbi->real_escape_string($dateSelected)
            );
            $q = $dbi->query($sql);
            if($q->num_rows > 0){
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?=$a['svdate'];?></td>
                        <td><?=$a['hn'];?></td>
                        <td><?=$a['ptname'];?></td>
                        <td><?=$a['age'];?></td>
                        <td><?=$a['ptright'];?></td>
                        <td><?=$a['diag'];?></td>
                        <td><?=$a['icd10'];?></td>
                        <td><?=$a['idcard'];?></td>
                        <td><?=$a['address'];?></td>
                        <td><?=$a['tambol'];?></td>
                        <td><?=$a['ampur'];?></td>
                        <td><?=$a['changwat'];?></td>
                        <td><?=$a['phone'];?></td>
                    </tr>
                    <?php
                }
            }else{
                ?>
                <tr>
                    <td colspan="14"><p class="text-center"><strong>ไม่พบข้อมูล</strong></p></td>
                </tr>
                <?php
            }
            ?>
        </table>
    <?php 
    }
    ?>
    </div>
</body>
</html>