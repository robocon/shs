<?php
session_start();
include("connect.inc");
// var_dump($_SESSION);

     $month_["01"] = "มกราคม";
    $month_["02"] = "กุมภาพันธ์";
    $month_["03"] = "มีนาคม";
    $month_["04"] = "เมษายน";
    $month_["05"] = "พฤษภาคม";
    $month_["06"] = "มิถุนายน";
    $month_["07"] = "กรกฏาคม";
    $month_["08"] = "สิงหาคม";
    $month_["09"] = "กันยายน";
    $month_["10"] = "ตุลาคม";
    $month_["11"] = "พฤศจิกายน";
    $month_["12"] = "ธันวาคม";
	
	$list_status_drug["STAT1"] = "Stat";
	$list_status_drug["STAT"] = "One day";
	$list_status_drug["CONT"] = "Continue";
	$list_status_drug["OLD"] = "ยาเดิม";
	$list_status_drug["OLDEX"] = "ยาเดิมนอกโรงพยาบาล";	


include 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");


$action = sprintf("%s", $_REQUEST['action']);
$page = sprintf("%s", $_REQUEST['page']);

$wards = array(
    '42' => 'หอผู้ป่วยรวม',
    '43' => 'หอผู้ป่วยสูติ',
    '44' => 'หอผู้ป่วยICU',
    '45' => 'หอผู้ป่วยพิเศษ',
	'46' => 'หอผู้ป่วย Cohort Ward',
	'47' => 'หอผู้ป่วย Home Isolation',
	'48' => 'หอผู้ป่วย รพ.สนาม'
);

/*
เตียง1-9 ,301-310 พิเศษชั้นสาม
เตียง10-17,201-207 พิเศษชั้นสอง
*/
function getFullWardName($cbedcode){
    global $wards;
    $wardExTest = preg_match('/45.+/', $cbedcode);
    $exName = '';
    if( $wardExTest > 0 ){
        $wardBxTest = preg_match('/45(F[1-3]|M[1-6])/', $cbedcode); // B1-B9
        $wardR3Test = preg_match('/45R3[0-9]{2}/', $cbedcode); // R301-R310
        $exName = ($wardBxTest > 0 || $wardR3Test > 0) ? 'ชั้น3' : 'ชั้น2' ;
        
    }

    $short_code = substr($cbedcode,0,2);
    $fullWardName = $wards[$short_code].$exName;
    return $fullWardName;
}

$str = "month=".date('m')."&year=".(date('Y')+543)."&date=".date('dmy');
?>
<title>ระบบตรวจสอบข้อมูลใบ MAR ผู้ป่วยใน</title>
<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	background-color:#e1f5fe;
	font-size: 32px;
 }
a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#669900; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
.font_title{
	font-family: 'TH SarabunPSK';
	font-size: 24 px;
	color:#FFFFFF;
	font-weight: bold;

}
tr:hover {background-color: #dcedc8;}

*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
p{
    margin: 0;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

tr{
    vertical-align: top;
}

#imgContainer{
    position: absolute;
    top: 2%;
    left: 2%;
    background-color: #ffffff;
    border: 2px solid #000000;
}
#imgContent{
    max-width: 210mm;
}
#imgBtnClose{
    text-align: center; 
    background-color: #b8b8b8;
}
#imgBtnClose:hover{
    cursor: pointer;
}
a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #2980B9;
  color: white;
}
</style>
<SCRIPT LANGUAGE="JavaScript">
	
	function print_page(){
		
		document.getElementById('form_search').style.display='none';
		document.getElementById('print_button').style.display='none';
		setTimeout("window.print();",1500);

	}

</SCRIPT>
<div align="center" style="margin-top:50px;"><img src="images/drug.png" width="96px" height="96px"></div>
 <h1 align="center">ระบบตรวจสอบใบ MAR ผู้ป่วยใน</h1>
</div>
<div align="center">
<div>
<span><A style="width:200px;"  HREF="med_record_print_2023.php?act=1&an=<?=$an;?>&hn=<?=$hn;?>&<?=$str;?>"><img src="images/prescription.png" height="25px" width="25px"><br><strong>ยา High Alert Drug</strong><br>[HAD]</a></span>
</div>
<div style="margin-top:20px;">
<span><A style="width:200px;"  HREF="med_record_print_2023.php?act=2&an=<?=$an;?>&hn=<?=$hn;?>&<?=$str;?>"><img src="images/pills.png" height="25px" width="25px"><br><strong>ยา Oneday+Stat</strong><br>[แบบรับประทาน]</a></span>
<span style="margin-left:20px;"><A style="width:200px;"  HREF="med_record_print_2023.php?act=3&an=<?=$an;?>&hn=<?=$hn;?>&<?=$str;?>"><img src="images/drops.png" height="25px" width="25px"><br><strong>ยา Oneday+Stat</strong><br>[แบบฉีด]</a></span>
</div>
<div style="margin-top:20px;">
<span><A style="width:200px;" HREF="med_record_print_2023.php?act=4&an=<?=$an;?>&hn=<?=$hn;?>&<?=$str;?>"><img src="images/pills.png" height="25px" width="25px"><br><strong>ยา Continue</strong><br>[แบบรับประทาน]</a></span>
<span style="margin-left:20px;"><A style="width:200px;"  HREF="med_record_print_2023.php?act=5&an=<?=$an;?>&hn=<?=$hn;?>&<?=$str;?>"><img src="images/drops.png" height="25px" width="25px"><br><strong>ยา Continue</strong><br>[แบบฉีด]</a></span>
</div>
</div>
<BR>
<hr>
<div style="text-align: center;">
<span style="color:#0000FF">
<span style="font-size:24px"><strong>ข้อมูล Doctor Order</strong></span>
</span>
<br></div>
<div style="text-align: center;">
<?php     
    $an = sprintf("%s", $_GET['an']);   
    $sql = "SELECT a.*,b.`bedcode` 
    FROM `med_scan` AS a 
    LEFT JOIN `ipcard` AS b ON b.`an`= a.`an` 
    WHERE a.`confirm` = 'y' AND a.`an` = '$an' 
    AND a.`status` = 'y' 
    ORDER BY a.`id` DESC";
    //echo $sql;
    $q = $dbi->query($sql);
    if ( $q->num_rows > 0 ) {

        ?>
		<hr>
        <table class="chk_table" align="center" width="80%">
            <tr>
                <th>วันที่บันทึกข้อมูล</th>
                <th>ข้อมูล</th>
                <th>ไฟล์</th>
                <th>Re-Print</th>
            </tr>
        
        <?php
        while ($item = $q->fetch_assoc()) { 

            $fullWardName = getFullWardName(trim($item['bedcode']));

            ?>
            <tr>
                <td>
                    <p><?=$item['date'];?></p>
                </td>
                <td>
                    <p>HN: <?=$item['hn'];?></p>
                    <p>AN: <?=$item['an'];?></p>
                    <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                    <p><?=$fullWardName;?></p>
                </td>
                <td>
                <?php 
                
                if(is_file($item['path'])){
                    $image = '<a href="javascript:void(0)"><img class="showImg" src="'.$item['path'].'" width="200px;"></a>';
                }else{
                    $image = 'ไม่พบไฟล์แนบ กรุณาติดต่อหอผู้ป่วยเพื่ออัพโหลดไฟล์เข้ามาใหม่';
                }

                if( preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT']) > 0 ){ 
                    ?>
                    <!--[if lt IE 9]>
                    <a href="<?=$item['path'];?>" target="_blank"><img src="<?=$item['path'];?>" width="200px;"></a>
                    <![endif]-->
                    <!--[if gte IE 9]>
                    <?=$image;?>
                    <![endif]-->
                    <?php
                }else{
                    echo $image;
                }
                ?>
                </td>
                <td style="vertical-align: middle;" align="center">
                    <a href="med_phar.php?action=print&id=<?=$item['id'];?>" class="btnActive" target="_blank">พิมพ์</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an";
    }
?>
<div id="imgContainer" style="display: none;">
    <div id="imgBtnClose">[Close]</div>
    <div><img src="" alt="" id="imgContent" style="max-width:210mm;"></div>
</div>
<script>
    
    // open popup
    var imgs = document.querySelectorAll('.showImg');
    for (var index = 0; index < imgs.length; index++) {
        var item = imgs[index];
        
        item.addEventListener('click', function(event) {
            document.getElementById('imgContent').setAttribute('src', this.getAttribute('src'));
            document.getElementById('imgContainer').style.display = ''; // show

            var doc = document.documentElement;
            var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
            document.getElementById('imgContainer').setAttribute('style', 'top: '+top+'px;');
        });
        
    }

    // close button
    var imgBtn = document.querySelectorAll('#imgBtnClose');
    imgBtn[0].addEventListener('click', function(event){
        document.getElementById('imgContainer').style.display = 'none';
    });
    
</script>
</div>


<?php
 include("unconnect.inc");
?>