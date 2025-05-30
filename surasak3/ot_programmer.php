<?php
session_start();
include "bootstrap.php";

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <style>
            @media print{
                #userForm, #top_menu{
                    display: none;
                }
                *{
                    font-size:14px;
                }
            }
            .forntsarabun {
                font-family: "TH SarabunPSK";
                font-size: 22px;
            }
            img{
                max-width: 600px;
            }
        </style>
        <div class="w3-container" id="top_menu">
            <a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;
			||&nbsp;&nbsp;<a  href='com_support.php'><font size='4' class='forntsarabun'>ดูข้อมูลแจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;
            ||&nbsp;&nbsp;<a  href='com_add.php'><font size='4' class='forntsarabun'>แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;
            ||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;
            ||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>
			<? if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMCOM"){ ?>
            ||&nbsp;&nbsp;<a target=_blank  href='ot_programmer.php'><font size='4' class='forntsarabun'>OT Programmer</font></a>
			<? } ?>
            <hr>
        </div>
        <form method="post" id="userForm" action="ot_programmer.php" class="w3-container" >
            <?php 
            $yRange = range(2023,date('Y'));
            ?>
            <div class="w3-row-padding">
                <div class="w3-col s2">
                    <label>เลือกเดือน</label>
                    <?=getMonthList('months',$_POST['months'],'w3-select w3-border');?>
                </div>
                <div class="w3-col s2">
                    <label>เลือกปี</label>
                    <?=getYearList('years',true,$_POST['years'], $yRange,'w3-select w3-border');?>
                </div>
                <div class="w3-col s2">
                    <label>ผู้ปฏิบัติ</label>
                    <select name="comUser" id="comUser" class="w3-select w3-border">
                        <option value="เทวิน">เทวิน</option>
                        <option value="กฤษณะศักดิ์">กฤษณะศักดิ์</option>
                        <option value="ฐานพัฒน์">ฐานพัฒน์</option>
                        <option value="จักรพันธ์">จักรพันธ์</option>
                        <option value="ชาญวิทย์">ชาญวิทย์</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="w3-row-padding">
                <button type"submit" class="w3-btn w3-teal" >ค้นหา</button>
                <input type="hidden" name="formAction" value="search">
            </div>
        </form>
        <br>
        <?php 
        $formAction = $_POST['formAction'];
        if($formAction==='search'){

            $month = $_POST['months'];
            $year = $_POST['years']+543;
            $comUser = $_POST['comUser'];
			$chkdate="$year-$month";
			
		    $chkdate="$year-$month";

            $sql = "SELECT *,TIME(`date`) AS `date_time` 
            FROM `com_support` 
            WHERE `dateend` LIKE '$year-$month%' 
            AND `programmer` LIKE '$comUser%'
			AND `status` = 'n'
            AND 
            ( 
                ( TIME(`date`) >= '16:30:00' OR TIME(`date`) <= '08:30:00' )
				OR
				( TIME(`dateend`) >= '16:30:00' OR TIME(dateend) <= '08:30:00' )
                OR ( 
                    DATE_FORMAT(CONCAT(SUBSTRING(`date`,1,4)-543, SUBSTRING(`date`,5,6)), '%w') = 0 
                    OR DATE_FORMAT(CONCAT(SUBSTRING(`date`,1,4)-543, SUBSTRING(`date`,5,6)), '%w') = 6 
                )
				OR ( 
                    DATE_FORMAT(CONCAT(SUBSTRING(`dateend`,1,4)-543, SUBSTRING(`dateend`,5,6)), '%w') = 0 
                    OR DATE_FORMAT(CONCAT(SUBSTRING(`dateend`,1,4)-543, SUBSTRING(`dateend`,5,6)), '%w') = 6 
                )				
            ) 
			order by dateend desc";
            $q = $dbi->query($sql);
            if($q->num_rows > 0)
            {
                ?>
                <div class="w3-container">
				<div class="forntsarabun">
                <table class="w3-table-all">
                    <tr class="w3-teal">
                        <th>ลำดับ</th>
						<th>วัน/เดือน/ปี</th>
                        <th width="38%">รายละเอียดงาน</th>
                        <th>ผู้ร้องขอ</th>
                        <th>แผนก</th>
                        <th>ผู้ปฏิบัติ</th>
                    </tr>
                
                <?php
				$i=0;
                while($item = $q->fetch_assoc()) {
					$i++;
					if($chkdate == "2565-01" || $chkdate == "2565-02" || $chkdate == "2565-03" || $chkdate == "2565-04"){
						$date=$item['date'];
					}else{
						$date=$item['dateend'];
					}
					
					if($item['user']=="CSCD"){
						$user="นางพวงเพ็ชร  โนใจปิง";
					}else{
						$user=$item['user'];
					}
                    ?>
                    <tr>
						<td><?=$i;?></td>
                        <td><?=$date;?></td>
                        <td><?=$item['row'].":".htmlspecialchars_decode($item['detail']);?></td>
                        <td><?=$user;?></td>
                        <td><?=$item['depart'];?></td>
                        <td><?=$item['programmer'];?></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
				</div>
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>