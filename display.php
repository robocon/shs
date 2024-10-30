<?php 
session_start();
// var_dump($_SESSION);
include("connect.inc");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>New Page 5</title>
<base target="_self">
<style type="text/css" media="screen">
	body{
		font-family: "TH SarabunPSK";
		font-size:32px;
	}
	th, td {
		font-family: "TH SarabunPSK";
		font-size:20px;		
		padding:1px;
	}	
</style>
</head>

<body bgcolor="#008080"  text="#ffffff" >
    
    <center>
         <div style="font-family:TH SarabunPSK;font-size:36px;color:#fb042d">
            <b>*** ข่าวสาร โรงพยาบาลค่ายสุรศักดิ์มนตรี  ***</b>
        </div>
    </center>
    
    <MARQUEE>
        <STRONG>
            <SPAN>
                <div style="font-family:TH SarabunPSK;font-size:24px;color:#ffffff">
                     วิสัยทัศน์ :โรงพยาบาลทหารชั้นนำ ระดับทุติยภูมิของกองทัพบก ***** ค่านิยม :  เป็นเลิศบริการ มาตรฐานการรักษา ร่วมใจพัฒนา (Service mind-Standard-Teamwork) S.S.T. Culture ******
                </div>
            </SPAN>
        </STRONG>
    </MARQUEE>
    <br>
    <center>************************************</center>
    <br>
    <?php
    if($_SESSION['smenucode']=='ADMPT'){
        $allow_user = array('เมธาวารินทร์','สุทัศน์','ปุณนาพร','อรรถโกวิทย์771');
        if(in_array(trim($_SESSION['sIdname']), $allow_user)==true && empty($_COOKIE['ptDisplayAlert'])){

            $endThisDay = gmdate('D, d M Y 23:59:59');

            $today = date('Y-m-d');
            $tomorrow = date('Y-m-').sprintf("%02d", (date('d')+1));

            $sql = "SELECT `depcode`,SUBSTRING(`date`,1,10) AS `shortDate`,SUBSTRING(depcode,1,3) AS `depcodeCode` 
            FROM `appoint` 
            WHERE `appdate_en` IN ('$today','$tomorrow') 
            AND `apptime` != 'ยกเลิกการนัด' 
            AND `detail` LIKE 'FU10%'
            AND `depcode` NOT LIKE 'U20%'
            GROUP BY `depcode` 
            ORDER BY `appdate_en`,`row_id` ASC";
            $q = mysql_query($sql);
            $numRow = mysql_num_rows($q);
            if($numRow > 0){
                $depcodeItem = array();
                while ($a = mysql_fetch_assoc($q)) {
                    $depcodeItem[] = substr($a['depcode'], 4);
                }
                $depcodeName = 'แผนก'.implode(',', $depcodeItem);
            ?>
            <script src="surasak3/js/sweetalert2.all.min.js"></script>
            <script>
                Swal.fire({
                    title: "แจ้งเตือน",
                    html: `<strong style="font-size:28px;">มีข้อมูลการนัดเพิ่มเติมจาก <?=$depcodeName;?></strong><br>
                    <br>
                    <label><input type="checkbox" id="hideAlertDisplay" value="1">ไม่ต้องแสดงข้อความนี้อีกในวันนี้</label>`,
                    showCancelButton: true,
                    cancelButtonText: "ปิด",
                    confirmButtonText: "แสดงรายละเอียด"
                }).then((result)=>{
                    if (result.isConfirmed) {
                        window.open("surasak3/appoint_physi.php");
                    }
                });
                document.getElementById('hideAlertDisplay').onclick = function(){
                    if(this.checked===true){
                        document.cookie = "ptDisplayAlert=1; expires=<?=$endThisDay;?>; path=/;";
                    }else if(this.checked===false){
                        document.cookie = "ptDisplayAlert=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    }
                }
            </script>
            <?php
            }
        }
    }

    echo "<div style='color:#00FFFF;font-size:24;'>
            **รายชื่อแพทย์ไม่ออกตรวจวันนี้ (".date("d-m-").(date("Y")+543).")**
            <br>";
    
    $sql = "select * from dr_offline where dateoffline = '".date("d-m-").(date("Y")+543)."'";
    $row = mysql_query($sql);
    while($result = mysql_fetch_array($row)){
        $arr = explode(" ",$result[2]);
        echo "แพทย์ ".$arr[1]." ".$arr[2]." , ";
    }
    echo "</div>";
    
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    // include("connect.inc");
    
    $today=(date("Y")+543).date("-m-d");
    
    print "<table>";
    
    $num = 'Y';
    $query = "SELECT  row,depart,new,datetime,file,date,numday FROM new  WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query) or die("Query failed : ".mysql_error());
    while (list ($row,$depart,$new,$datetime,$file,$start,$end) = mysql_fetch_row ($result)) {
    
        if($today==$end){
            $query = "UPDATE  new SET status = 'N' WHERE  row = '$row' ";
            $result = mysql_query($query)or die("Query failed update new N");
        }
        
        ?>
        <tr>
            <td>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height="15" src='new.gif' width="30">&nbsp;***&nbsp;
                    <?=$new;?>
                
                ***(<?=$depart;?>&nbsp;<?=$datetime;?>)&nbsp;(สิ้นสุด&nbsp;<?=$end;?>)&nbsp;*** 
                <?php 
                if($file){ 
                    echo "<a href='surasak3/file_news/$file' target='_blank'><font color='#FF00FF'>ดาวน์โหลดไฟล์</font></a>"; 
                } 
                ?>
            </td>
        </tr>
        <?php
    }
    print "</table>";
    
    $last_day = date('Y-m-d', strtotime("-3 week"));
    $sql = "SELECT * FROM `news` 
    WHERE `status` = 1
    AND `date_start` > '$last_day' OR `pin` = 'y' 
    ORDER BY `date_start` DESC;";
    $q = mysql_query($sql);
    $rows = mysql_num_rows($q);
    if( $rows > 0 ){
    ?>
    <style type="text/css">
    .news-header{
        color: #00FFFF;
    }
    .news-contain a{
        text-decoration: none;
        color: #ffffff;
    }
    .news-contain a:hover{
        text-decoration: underline;
    }
    </style>
    <div class="news-contain">
        <h3 class="news-header">ข่าวประชาสัมพันธ์ รพ.ค่าย</h3>
        <div>
            <ol>
                <?php
                while( $item = mysql_fetch_assoc($q) ){
                    ?>
                    <li class="news-link">
                        <a href="surasak3/news_detail.php?id=<?=$item['id'];?>"><?=$item['title'];?></a>
                        <?php
                        if( $last_day < $item['date_start'] ){
                            ?><img height="15" src="new.gif" width="30"><?php
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ol>
        </div>
    </div>
    <?php
    }
    
    include("surasak3/unconnect.inc");
?>
</body>
</html>