<?php
session_start();
$Thaidate = date("d-m-").(date("Y")+543);
$Thaitime = date("H:i");
function calcage($birth){
    $today = getdate();   
    $nY  = $today['year']; 
    $nM = $today['mon'] ;
    $bY = substr($birth,0,4)-543;
    $bM = substr($birth,5,2);
    $ageY = $nY-$bY;
    $ageM = $nM-$bM;
    if ($ageM<0) {
        $ageY = $ageY-1;
        $ageM = 12+$ageM;
    }
    if ($ageM==0){
        $pAge="$ageY ปี";
    }else{
        $pAge="$ageY ปี $ageM เดือน";
    }
    return $pAge;
}

include("connect.inc");
?>
<html>
<body BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>
    <style type="text/css">
        .fc1-0 { color:000000; font-size:18pt; font-family:Cordia New; font-weight:bold;}
        .fc1-1 { color:000000; font-size:16pt; font-family:Cordia New; font-weight:normal; line-height: 18px;}
        .fc1-2 { color:000000; font-size:16pt; font-family:Cordia New; font-weight:bold;}
        .fc1-3 { color:000000; font-size:15pt; font-family:Cordia New; font-weight:normal;}
        .ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
        .ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
    </style>
<?php
$Can = $_GET['Can'];
$query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone,opcard.camp 
FROM ipcard 
LEFT JOIN opcard ON ipcard.hn=opcard.hn 
WHERE ipcard.an = '$Can'";
$result = mysql_query($query)or die("Query failed");
while (list ($an,$hn,$date,$bedcode,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone,$camp) = mysql_fetch_row ($result)) {
    
    $d = substr($dbirth,8,2);
    $m = substr($dbirth,5,2); 
    $y = substr($dbirth,0,4); 
    $birthdate = "$d-$m-$y"; //print into opdcard
    $cAge = calcage($dbirth);
    $cPtname = $yot.' '.$name.' '.$surname;
    
    $sex = ( $sex === 'ช' ) ? 'ชาย' : 'หญิง' ;
    
    $ddate = substr($date,8,2);
    $mdate = substr($date,5,2); 
    $ydate = substr($date,0,4); 
    $tdate = substr($date,11,5); 
    $adate = "$ddate-$mdate-$ydate"; 
    //print opd card ที่นี่ จาก opdcardprn.htm  by frontpage
    
    ?>
    <div class="fc1-0">&nbsp;<?=$cPtname?></div>
    <div class="fc1-1">
        AN:&nbsp;<?=$an?>&nbsp;HN:&nbsp;<?=$hn?>
    </div>
    <div style="height: 5px; padding: 0; margin: 0;">&nbsp;</div>
    <div class="fc1-0">&nbsp;<?=$cPtname?></div>
    <div class="fc1-1">
        AN:&nbsp;<?=$an?>&nbsp;HN:&nbsp;<?=$hn?>
    </div>
    <?php
}
?>
    <script type="text/javascript">
        function CloseWindowsInTime(){
            window.print();
            setTimeout( function(){ window.close(); }, 1000 );
        }
        
        window.onload = function(){
			CloseWindowsInTime(); 
		}
        
        ie4up=nav4up=false;
        var agt = navigator.userAgent.toLowerCase();
        var major = parseInt(navigator.appVersion);
        if ((agt.indexOf('msie') != -1) && (major >= 4))
            ie4up = true;
        if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
            nav4up = true;
    </script>
</body>
</html>