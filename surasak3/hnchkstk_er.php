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
        .fc1-0 { color:000000; font-size:16pt; font-family:Cordia New; font-weight:bold;}
        .fc1-1 { color:000000; font-size:16pt; font-family:Cordia New; font-weight:normal; line-height: 22px;}
        .fc1-2 { color:000000; font-size:16pt; font-family:Cordia New; font-weight:bold;}
        .fc1-3 { color:000000; font-size:15pt; font-family:Cordia New; font-weight:normal;}
        .ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
        .ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
    </style>
<?php
$Chn = $_GET['Chn'];
$chkdate=(date("Y")+543).date("-m-d");
$query = "SELECT  * FROM opday 
LEFT JOIN opcard ON opday.hn=opcard.hn 
WHERE opday.hn = '$Chn' and opday.thidate like '$chkdate%' order by opday.row_id desc limit 0,1";
//echo $query;
$result = mysql_query($query)or die("Query failed");
while($rows= mysql_fetch_array($result)){
    
    $d = substr($rows["dbirth"],8,2);
    $m = substr($rows["dbirth"],5,2); 
    $y = substr($rows["dbirth"],0,4); 
    $birthdate = "$d-$m-$y"; //print into opdcard
    $cAge = calcage($rows["dbirth"]);
    $cPtname = $rows["yot"].' '.$rows["name"].' '.$rows["surname"];
    
    $sex = ( $sex === 'ช' ) ? 'ชาย' : 'หญิง' ;
    
    $ddate = substr($rows["thidate"],8,2);
    $mdate = substr($rows["thidate"],5,2); 
    $ydate = substr($rows["thidate"],0,4); 
    $tdate = substr($rows["thidate"],11,8); 
    $adate = "$ddate-$mdate-$ydate $tdate"; 
    //print opd card ที่นี่ จาก opdcardprn.htm  by frontpage
    
	
	
    ?>
    <div class="fc1-0">วันที่ : <?=$adate;?></div>
    <div class="fc1-1">ชื่อ-สกุล : <?=$cPtname;?></div>
    <div class="fc1-1">อายุ : <?=$cAge;?></div>
    <div class="fc1-1">HN:&nbsp;<?=$rows["hn"];?>&nbsp;VN:&nbsp;<?=$rows["vn"];?>    </div>
    <div style="height: 10px; padding: 0; margin: 0;">&nbsp;</div>
    <div class="fc1-0">วันที่ : <?=$adate;?></div>
    <div class="fc1-1">ชื่อ-สกุล : <?=$cPtname;?></div>
    <div class="fc1-1">อายุ : <?=$cAge;?></div>
    <div class="fc1-1">HN:&nbsp;<?=$rows["hn"];?>&nbsp;VN:&nbsp;<?=$rows["vn"];?>    </div>

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