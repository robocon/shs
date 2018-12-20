<?php
    session_start();
	global $sIdname;
    if (isset($sIdname)){} else {die;} //for security
 
    session_unregister("nRunno");
    session_unregister("vHN");
    $nRunno="";
    $vHN="";
    session_register("vHN");
    session_register("nRunno");

    include("connect.inc");   
	
	// ตรวจสอบและเปลี่ยน HN AN ตอนขึ้นปีใหม่
	$sql = "Select left(prefix,2) From runno where title = 'HN' ";
	list($title_hn) = Mysql_fetch_row(Mysql_Query($sql));
	$year_now = substr(date("Y")+543,2);
	if($title_hn != $year_now){
		$sql = "Update runno set prefix = '".$year_now."-', runno = 0 where  title = 'HN' limit 1;";
		$result = mysql_Query($sql);
	}
	$sql = "Select left(prefix,2) From runno where title = 'AN' ";
	list($title_an) = Mysql_fetch_row(Mysql_Query($sql));
	$year_now = substr(date("Y")+543,2);
	if($title_an != $year_now){
		$sql = "Update runno set prefix = '".$year_now."/', runno = 0 where  title = 'AN' limit 1;";
		$result = mysql_Query($sql);
	}
	// END


	if($_POST["idcard"] !="-" ){
	$sql = "Select hn , yot, name, surname From opcard where idcard = '".$_POST["idcard"]."' limit 0,1 ";
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
		if($rows > 0){
			$arr = Mysql_fetch_assoc($result);
			// echo "
			// <CENTER>
			// 	เลขบัตรประชาชน ",$_POST["idcard"]," มีผู้ใช้แล้วคือ<BR>
			// 	HN : ",$arr["hn"]," ",$arr["yot"]," ",$arr["name"]," ",$arr["surname"],"<BR>
			// 	<A HREF=\"../nindex.htm\">&lt;&lt; ไปเมนู</A>
			// </CENTER>
			
			// ";
			// exit();
		}
	}

    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'HN'";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $vTitle=$row->title;
    $vPrefix=$row->prefix;
    $nRunno=$row->runno;
    $nRunno++;
    $vHN=$vPrefix.$nRunno; //HN

    // 
    // include_once 'opdadd_json.php';

    // บันทึกเป็น pdf ให้ Dr.Com Sync ข้อมูล
   // include_once 'opdadd_pdf.php';  ปิดใช้งานเมื่อ 26/7/2560 เวลา 19:00 น. เนื่องจากทำบัตรใหม่ไม่ได้

    //$query ="UPDATE runno SET runno = $nRunno WHERE title='HN'";
   // $result = mysql_query($query) or die("Query failed");
    include("unconnect.inc");

    print "<div align='left'>";
    print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
    print "    <tr>";
    print "      <td width='25%'></td>";
    //print "      <td width='75%'><font face='Angsana New' size='3'>ทำบัตรตรวจโรคใหม่.....HN $vHN</font></td>";
    print "    </tr>";
    print "  </table>";
    print "</div>";
?>

<?php
    session_start();
	$hospcode=$_POST['hospcode'];
	$ptrcode=$_POST['rdo1'];
//	$note=$_POST['note'].'/'.$hospcode;
	
global   $regisdate,$idcard,$mid,$hn,$yot,$name,$surname,$education,$goup,$married,$Y,$y,$m,$d,
           $dbirth,$guardian,$idguard,$nation,$religion,$career,$ptright,$ptrightdetail,$address,
           $tambol,$ampur,$changwat,$hphone,$phone,$father,$mother,$couple,$note,
           $sex,$camp,$race,$ptf,$ptfadd,$ptffone,$ptfmon,$blood,$drugreact,$phone2,$hospcode,$ptrcode,$typeservice;
//   $Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");

// รับค่าจาก $_POST ดีที่สุด เพราะ global มีกาสที่ตัวแปรจะซ้ำได้จากการเปิด tab ซ้อน
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);

$typearea = $_POST['typearea'];

$Thaidate = date("d-m-").(date("Y")+543);

if (!empty($name)){
    include("connect.inc");   

Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;
       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
                    }
      if ($ageM==0){
           $pAge="$ageY ปี";
             }
      else{
            $pAge="$ageY ปี $ageM เดือน";
                        }
      return $pAge;
          }
//
//$Y=($y-543);
//$dbirth="$Y-$m-$d";
$d = sprintf('%02d', $d);
$m = sprintf('%02d', $m);

$dbirth="$y-$m-$d"; //insert to opcard
$birthdate="$d-$m-$y"; //print into opdcard
$cAge=calcage($dbirth);
$ptname=$yot.' '.$name.' '.$surname;
$sql = "INSERT INTO opcard (regisdate,idcard,mid,hn,yot,name,surname,education,goup,married,
dbirth,guardian,idguard,nation,religion,career,ptright,ptrightdetail,address,tambol,ampur,changwat,hphone,phone,father,mother,couple,note,sex,camp,race,ptf,ptfadd,ptffone,ptfmon, ptright1, officer, blood, drugreact,phone2,hospcode,ptrcode,typeservice,typearea) VALUES (now(),'$idcard','$mid','$vHN',
'$yot','$name','$surname','$education','$goup','$married','$dbirth','$guardian','$idguard',
'$nation','$religion','$career','$ptright','$ptrightdetail','$address','$tambol','$ampur','$changwat',
'$hphone','$phone','$father','$mother','$couple','$note','$sex','$camp','$race','$ptf','$ptfadd','$ptffone','$ptfmon','$ptright','".$_SESSION["sOfficer"]."','$blood', '$drugreact','$phone2','$hospcode','$ptrcode','$typeservice','$typearea');";

$result = mysql_query($sql) or die( mysql_error() . "หมายเลข HN $vHN ซ้ำ    ไม่สามารถบันทึกได้    โปรดทำบัตรใหม่ !");


$query ="UPDATE runno SET runno = $nRunno WHERE title='HN'"; 

$result = mysql_query($query) or die("Query failed");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

$thidate = ( date('Y') + 543 ).date('-m-d');

// เก็บข้อมูลเข้า PERSON
$short_th_date = substr($thidate,0,10);
$date_hn = $short_th_date.$vHN;
$cid = trim($idcard);
$hn = $pid = $vHN;
$prename = trim($yot);
$name = trim($name);
$lname = trim($surname);
$sex = trim($sex);
$birth = trim($dbirth);
$mstatus = trim($married);
$occupation_new = trim($career);
$race = trim($race);
$nation = trim($nation);
$religion = trim($religion);
$education = trim($education);
// $father = trim($_POST['idcard_father']);
// $mother = trim($_POST['idcard_mother']);
// $couple = trim($_POST['idcard_couple']);
$idcard_father = NULL;
$idcard_mother = NULL;
$idcard_couple = NULL;
$abogroup = trim($blood);
$d_update = trim($thidate);
// $vstatus = $_POST['vstatus'];
$vstatus = NULL;

$telephone = str_replace(array(' ', '-'), '', trim($hphone));
$mobile = str_replace(array(' ', '-'), '', trim($phone));

$q = mysql_query("SELECT `id` FROM `PERSON` WHERE `date_hn` = '$date_hn' ");
if( mysql_num_rows($q) == 0 ){
	// insert 
	$sql = "INSERT INTO `PERSON` (
		`id`, `date_hn`, `HOSTPCODE`, `CID`, `PID`, `HID`, `PRENAME`, `NAME`, `LNAME`, `HN`, 
		`SEX`, `BIRTH`, `MSTATUS`, `OCCUPATION_OLD`, `OCCUPATION_NEW`, `RACE`, `NATION`, `RELIGION`, `EDUCATION`, `FSTATUS`, 
		`FATHER`, `MOTHER`, `COUPLE`, `VSTATUS`, `MOVEIN`, `DISCHARGE`, `DDISCHARGE`, `ABOGROUP`, `RHGROUP`, `LABOR`, 
		`PASSPORT`, `TYPEAREA`, `D_UPDATE`, `TELEPHONE`, `MOBILE`
	) VALUES (
		NULL, '$date_hn', '11512', '$cid', '$pid', NULL, '$prename', '$name', '$lname', '$hn', 
		'$sex', '$birth', '$mstatus', NULL, '$occupation_new', '$race', '$nation', '$religion', '$education', NULL, 
		'$idcard_father', '$idcard_mother', '$idcard_couple', '$vstatus', NULL, NULL, NULL, '$abogroup', NULL, NULL, 
		NULL, '$typearea', '$d_update', '$telephone', '$mobile'
	);";
	mysql_query($sql);
}else{ 
	$item = mysql_fetch_assoc($q);
	$person_id = $item['id'];
	// update
	$sql = "UPDATE `PERSON` SET 
	`date_hn`='$date_hn', `HOSTPCODE`='11512', `CID`='$cid', `PID`='$pid', `HID`=NULL, 
	`PRENAME`='$prename', `NAME`='$name', `LNAME`='$lname', `HN`='$hn', `SEX`='$sex', `BIRTH`='$birth', 
	`MSTATUS`='$mstatus', `OCCUPATION_OLD`=NULL, `OCCUPATION_NEW`='$occupation_new', `RACE`='$race', `NATION`='$nation', `RELIGION`='$religion', 
	`EDUCATION`='$education', `FSTATUS`=NULL, `FATHER`='$idcard_father', `MOTHER`='$idcard_mother', `COUPLE`='$idcard_couple', `VSTATUS`='$vstatus', 
	`MOVEIN`=NULL, `DISCHARGE`=NULL, `DDISCHARGE`=NULL, `ABOGROUP`='$abogroup', `RHGROUP`=NULL, `LABOR`=NULL, 
	`PASSPORT`=NULL, `TYPEAREA`='$typearea', `D_UPDATE`='$d_update', `TELEPHONE`='$telephone', `MOBILE`='$mobile' 
	WHERE (`id`='$person_id');";
	mysql_query($sql);
}

// เก็บข้อมูลเข้า PERSON



//print opd card ที่นี่ จาก opdcardprn.htm  by frontpage


print "<HTML>";print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<BODY  Onload=\"window.print();\" BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:540PX;top:30PX;width:600PX;height:30PX;'><span class='fc1-0'><a  href=\"opdprint3.php? ptname=$ptname&vHn=$vhn&birthdate=$birthdate&idcard=$idcard&ptright=$ptright\">$vHN</a></span></DIV>";
print "<DIV style='left:460PX;top:185PX;width:200PX;height:30PX;'><span class='fc1-9'>$sOfficer..จนท.ทำประวัติ</span></DIV>";

print "<DIV style='left:480PX;top:70PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"opdprintbchn.php?cHn=$idcard\"></span></DIV>";
print "<DIV style='left:120PX;top:160PX;width:200PX;height:30PX;'><span class='fc1-1'>$idcard</span></DIV>";
//print "<DIV style='left:80PX;top:130PX;width:200PX;height:20PX;'><span class='fc1-1'><img src = \"opdprintbcid.php?cHn=$idcard\"></span></DIV>";
print "<DIV style='left:460PX;top:160PX;width:200PX;height:30PX;'><span class='fc1-1'>$Thaidate</span></DIV>";
print "<DIV style='left:70PX;top:220PX;width:500PX;height:30PX;'><span class='fc1-2'> $ptname </span></DIV>";
print "<DIV style='left:400PX;top:270PX;width:200PX;height:30PX;'><span class='fc1-1'> $cAge</span></DIV>";
print "<DIV style='left:250PX;top:270PX;width:200PX;height:30PX;'><span class='fc1-1'> $sex</span></DIV>";
print "<DIV style='left:100PX;top:380PX;width:200PX;height:30PX;'><span class='fc1-1'> $married</span></DIV>";

print "<DIV style='left:100PX;top:270PX;width:100PX;height:30PX;'><span class='fc1-1'> $birthdate</span></DIV>";
print "<DIV style='left:250PX;top:380PX;width:200PX;height:30PX;'><span class='fc1-1'> $career</span></DIV>";
print "<DIV style='left:100PX;top:300PX;width:200PX;height:30PX;'><span class='fc1-1'> $religion</span></DIV>";
print "<DIV style='left:300PX;top:300PX;width:200PX;height:30PX;'><span class='fc1-1'> $race</span></DIV>";
print "<DIV style='left:400PX;top:300PX;width:100PX;height:30PX;'><span class='fc1-1'>$nation</span></DIV>";
print "<DIV style='left:100PX;top:500PX;width:300PX;height:30PX;'><span class='fc1-2'> $ptright</span></DIV>";
print "<DIV style='left:100PX;top:425PX;width:700PX;height:30PX;'><span class='fc1-3'>$address&nbsp;ตำบล$tambol&nbsp;อำเภอ$ampur&nbsp;จังหวัด$changwat&nbsp;โทร &nbsp;$phone&nbsp;&nbsp;$hphone</span></DIV>";
print "<DIV style='left:80PX;top:340PX;width:700PX;height:30PX;'><span class='fc1-1'>$father</span></DIV>";
print "<DIV style='left:250PX;top:340PX;width:700PX;height:30PX;'><span class='fc1-1'>$mother </span></DIV>";
print "<DIV style='left:400PX;top:340PX;width:700PX;height:30PX;'><span class='fc1-1'>$couple</span></DIV>";
print "<DIV style='left:90PX;top:540PX;width:700PX;height:30PX;'><span class='fc1-1'>$camp /$guardian</span></DIV>"; // lสังกัด ที่ทำงาน
print "<DIV style='left:80PX;top:460PX;width:200PX;height:30PX;'><span class='fc1-9'>$ptf</span></DIV>";
print "<DIV style='left:290PX;top:460PX;width:200PX;height:30PX;'><span class='fc1-1'>$ptfadd</span></DIV>";//เกี่ยวข้องเป็น
print "<DIV style='left:420PX;top:460PX;width:200PX;height:30PX;'><span class='fc1-1'>$ptffone</span></DIV>";
print "<DIV style='left:100PX;top:580PX;width:500PX;height:30PX;'><span class='fc1-1'>$note</span></DIV>";
print "<DIV style='left:80PX;top:620PX;width:200PX;height:30PX;'><span class='fc1-1'>$blood</span></DIV>";
print "<DIV style='left:260PX;top:620PX;width:200PX;height:30PX;'><span class='fc1-1'>$drugreact</span></DIV>";
print "<DIV style='left:500PX;top:580PX;width:200PX;height:30PX;'><span class='fc1-1'></span></DIV>";
print "<DIV style='left:150PX;top:790PX;width:200PX;height:30PX;'><span class='fc1-0'>$vHN</span></DIV>";
print "<DIV style='left:250PX;top:800PX;width:200PX;height:30PX;'><span class='fc1-1'>$Thaidate</span></DIV>";
print "<DIV style='left:90PX;top:820PX;width:200PX;height:30PX;'><span class='fc1-1'>$ptname</span></DIV>";
print "<DIV style='left:130PX;top:840PX;width:300PX;height:30PX;'><span class='fc1-1'>$ptright</span></DIV>";
print "<DIV style='left:240PX;top:850PX;width:200PX;height:30PX;'><span class='fc1-3 '>ID:$idcard</span></DIV>";
print "<DIV style='left:150PX;top:870PX;width:200PX;height:30PX;'><span class='fc1-1'>$idguard</span></DIV>";

print "<DIV style='left:110PX;top:880PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"opdprintbchn.php?cHn=$idcard\"></span></DIV>";
print "</BODY></HTML>";


//end opdcard
//	
 include("unconnect.inc");
	}
else {
         print "<br><br>ข้อมูลคนไข้ไม่มีชื่อผู้ป่วย   ";

         }
?>





