<?php
/*
    session_start();
global $regisdate,$idcard,$hn,$yot,$name,$surname,$goup,$married,$Y,$y,$m,$d,
           $dbirth,$guardian,$idguard,$nation,$religion,$career,$ptright,$address,
           $tambol,$ampur,$changwat,$phone,$father,$mother,$couple,$note,
           $sex,$camp,$race;
//   $Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
*/
    $Thaidate=date("d-m-").(date("Y")+543);
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
$dbirth="$y-$m-$d"; //insert to opcard
$birthdate="$d-$m-$y"; //print into opdcard
$cAge=calcage($dbirth);
$ptname=$yot.' '.$name.' '.$surname;
$sql = "INSERT INTO opcard (regisdate,idcard,hn,yot,name,surname,goup,married,
            dbirth,guardian,idguard,nation,religion,career,ptright,address,
            tambol,ampur,changwat,phone,father,mother,couple,note,sex,camp,race) VALUES(now(),'$idcard','$hn',
            '$yot','$name','$surname','$goup','$married','$dbirth','$guardian','$idguard',
            '$nation','$religion','$career','$ptright','$address','$tambol','$ampur','$changwat',
            '$phone','$father','$mother','$couple','$note','$sex','$camp','$race');";
/*
  regisdate
  idcard 
  hn 
  yot
  name
  surname 
  goup 
  married 
  cbirth (วันเกิดข้อความเก็บไว้ดู)
  dbirth 
  guardian
  idguard
  nation 
  religion 
  career 
  ptright 
  address 
  tambol 
  ampur 
  changwat 
  phone 
  father 
  mother 
  couple 
  note
  sex 
  camp 
  race
*/

$result = mysql_query($sql) or die("หมายเลข HN :$hn ซ้ำ    ไม่สามารถบันทึกได้    โปรดทำบัตรใหม่ !");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

//print opd card ที่นี่ จาก opdcardprn.htm  by frontpage

print "<body>";
print "<p>&nbsp;</p>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%' height='23'>";
print "  <tr>";
print "    <td width='67%' valign='top' height='23'></td>";
print "    <td width='33%' valign='top' height='23'><font face='Angsana New'>$hn</font>";
print "    </td>";
print "  </tr>";
print "</table>";
print "<p>&nbsp;</p>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%' height='14'>";
print "  <tr>";
print "    <td width='15%' height='14' valign='top'></td>";
print "    <td width='52%' height='14' valign='top'><font face='Angsana New'>$idcard</font>";
print "      <p>&nbsp;</p>";
print "    </td>";
print "    <td width='33%' height='14' valign='top'><font face='Angsana New'>$Thaidate</font></td>";
print "  </tr>";
print "</table>";

//print "<table border='0' cellpadding='0' cellspacing='0' width='707' height='27'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='707'>";
print "  <tr>";
print "    <td width='104' height='27' valign='middle'></td>";
print "    <td width='273' height='27' valign='middle'>";
print "      <p><font face='Angsana New'>$ptname</font></p>";
print "    </td>";
print "    <td width='217' height='27' valign='middle'>";
print "      <p><font face='Angsana New'>$cAge</font></p>";
print "    </td>";
print "    <td width='103' height='27' valign='middle'>";
print "      <p><font face='Angsana New'>$married</font></p>";
print "    </td>";
print "  </tr>";
print "</table>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr>";
print "    <td width='15%' valign='top'></td>";
print "    <td width='39%' valign='top'><font face='Angsana New'>$birthdate</font></td>";
print "    <td width='46%' valign='top'><font face='Angsana New'>$career</font></td>";
print "  </tr>";
print "</table>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%' height='39'>";
print "  <tr>";
print "    <td width='15%' valign='top' height='39'></td>";
print "    <td width='39%' valign='top' height='39'><font face='Angsana New'>$religion</font></td>";
print "    <td width='31%' valign='top' height='39'><font face='Angsana New'>$race</font></td>";
print "    <td width='15%' valign='top' height='39'><font face='Angsana New'>$nation</font></td>";
print "  </tr>";
print "</table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%' height='45'>";
print "    <tr>";
print "      <td width='15%' height='45' valign='middle'></td>";
print "      <td width='85%' height='45' valign='middle'>";
print "        <p><font face='Angsana New'>$ptright</font></p>";
print "      </td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%' height='95'>";
print "    <tr>";
print "     <td width='15%' valign='top' height='24'></td>";
print "     <td width='44%' valign='top' height='24'><font face='Angsana New'>$address</font></td>";
print "      <td width='41%' valign='top' height='24'><font face='Angsana New'>&#3610;&#3636;&#3604;&#3634;&nbsp;&nbsp;&nbsp;";
print "        $father</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='15%' valign='top' height='24'></td>";
print "      <td width='44%' valign='top' height='24'><font face='Angsana New'>$tambol&nbsp;&nbsp; $ampur</font></td>";
print "      <td width='41%' valign='top' height='24'><font face='Angsana New'>&#3617;&#3634;&#3619;&#3604;&#3634;&nbsp;&nbsp;&nbsp;";
print "        $mother</font></td>";
print "    </tr>";
print "    <tr>";
print "      <td width='15%' valign='top' height='47'></td>";
print "      <td width='44%' valign='top' height='47'><font face='Angsana New'>$changwat&nbsp; $phone</font></td>";
print "      <td width='41%' valign='top' height='47'><font face='Angsana New'>&#3588;&#3641;&#3656;&#3626;&#3617;&#3619;&#3626;&nbsp;&nbsp;&nbsp;";
print "        $couple</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%' height='20'>";
print "  <tr>";
print "    <td width='15%' height='20' valign='top'></td>";
print "    <td width='51%' height='20' valign='middle'><font face='Angsana New'>$camp</font></td>";
print "    <td width='34%' height='20' valign='top'>&nbsp;";
print "      <p>&nbsp;</td>";
print "  </tr>";
print "</table>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%' height='43'>";
print "  <tr>";
print "    <td width='15%' height='43' valign='top'></td>";
print "    <td width='51%' height='43' valign='top'><font face='Angsana New'>&#3612;&#3641;&#3657;&#3651;&#3594;&#3657;&#3626;&#3636;&#3607;&#3608;&#3636;&#3648;&#3610;&#3636;&#3585;&nbsp;&nbsp;";
print "      $guardian</font></td>";
print "    <td width='34%' height='43' valign='top'><font face='Angsana New'>&#3648;&#3621;&#3586;&#3610;&#3633;&#3605;&#3619;";
print "      &#3611;&#3594;&#3594;.&nbsp; $idguard</font>";
print "      <p>&nbsp;</p>";
print "    </td>";
print "  </tr>";
print "</table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%' height='1'>";
print "    <tr>";
print "      <td width='15%' height='1' valign='top'></td>";
print "      <td width='85%' height='1' valign='top'><font face='Angsana New'>$note</font>";
print "      </td>";
print "    </tr>";
print "  </table>";
print "</div>";

//บัตรประจำตัว ผป.
print "<p>&nbsp;</p>";
print "<p>&nbsp;</p>";
print "<p>&nbsp;</p>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='100%' valign='top'></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr>";
print "    <td width='12%' valign='top'></td>";
print "    <td width='22%' valign='top'><font face='Angsana New'>$hn</font></td>";
print "    <td width='43%' valign='top'><font face='Angsana New'>$Thaidate</font></td>";
print "    <td width='23%' valign='top'><font face='Angsana New'>$hn</font></td>";
print "  </tr>";
print "</table>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr>";
print "    <td width='12%' valign='top'></td>";
print "    <td width='55%' valign='top'><font face='Angsana New'>$ptname</font></td>";
print "    <td width='33%' valign='top'><font face='Angsana New'>$ptname</font></td>";
print "  </tr>";
print "</table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='12%' valign='top'></td>";
print "      <td width='55%' valign='top'><font face='Angsana New'>$ptright</font></td>";
print "      <td width='33%' valign='top'><font face='Angsana New'>$Thaidate</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";

print "</body>";

//end opdcard
//	
 include("unconnect.inc");
	}
else {
         print "<br><br>ข้อมูลคนไข้ไม่มีชื่อผู้ป่วย";
         }
?>




