<?php 

$basePath = dirname(__FILE__);
$filePath = $basePath.'/dataupdate/h1252002.txt';
$file = file_get_contents($filePath, true);

session_start();

if($_GET['okbtn']=="true"){
	include("connect.inc");
	$trunc = "TRUNCATE TABLE ssodata";
	$result = mysql_query($trunc);
	
	if($result){
		$dd = mktime(0,0,0,date("m"),date("d")+3,date("Y"));
		$end_date=(date("Y")+543).date("-m-d",$dd);
	
		//$file = str_replace(" ","",iconv("UTF-8","UTF-8",file_get_contents('/var/www/html/sm3/surasak3/dataupdate/h1252002.txt', FALSE)));
		$file = str_replace(" ","",iconv("TIS-620", "UTF-8", file_get_contents($filePath, FALSE)));
		$arrFile = explode("\n", $file);
		//$insert = "LOAD DATA INFILE '/var/www/html/sm3/surasak3/dataupdate/hospdbon.TXT' replace INTO TABLE ssodata   FIELDS TERMINATED BY ''  ";
if(is_array($arrFile)){
    $DataArr = array();
    $dateToday = date("Y-m-d H:i:s");
    $lastOut = count($arrFile);

    foreach($arrFile as $key => $value){
        $fieldVal1 = mysql_real_escape_string($value);
        $fieldVal2 = mysql_real_escape_string(substr($value,26,80));
        $fieldVal3 = $dateToday;

        $DataArr[] = "('$fieldVal1', '$fieldVal2' ,'$fieldVal3')";

        // insert ทุก 100 records หรือรอบสุดท้าย
        if(($key+1)%100 == 0 || $key == ($lastOut-1)){
            $sql = "INSERT INTO ssodata (id, textname, lastupdate) values ";
            $sql .= implode(',', $DataArr);
            echo "<pre>SQL: $sql</pre>"; // ดูคำสั่ง SQL
            $result2 = mysql_query($sql) or die (mysql_error());
            $DataArr = array();
        }
    }

			
		
			if($result2){
				echo "ปรับปรุงข้อมูลสิทธิประกันสังคมเรียบร้อยแล้ว กำลังกลับหน้าแรก"; 

				$part = 'ศูนย์บริการคอมพิวเตอร์';
				if( $_SESSION['smenucode'] = 'ADMSSO' ){
					$part = 'ห้องประกันสังคม';
				}

				$insert2 = "insert into new (depart,new,datetime,status,user,date,numday) values ('$part','$part ได้ทำการอัพเดทข้อมูลประกันสังคมแล้วค่ะ','".date("d/m")."/".(date("Y")+543)."','Y','".$_SESSION['sOfficer']."','".(date("Y")+543)."/".date("m/d H:i:s")."','".$end_date."')";
				mysql_query($insert2);
				echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=../nindex.htm'>";	
				echo "<br><br><a href ='../nindex.htm' >&lt;&lt; ไปเมนู</a>";
			}
		}
	}
}else{
?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a><br>
<center>
  <font style="font-size:30px; font-family:AngsanaUPC;">2. ยืนยันการปรับปรุงข้อมูลสิทธิประกันสังคม</font><br />
<font style="font-size:40px; font-family:AngsanaUPC;"><a href="truncatesso.php?okbtn=true">ตกลง</a></font></center>
<?
}
?>