

<script language="JavaScript1.2">
<!--
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}
//-->
</script>
<?php
    session_start();
    session_unregister("Bcode");
	 session_register("Bcode");


 $Thdate = date("d-m-").(date("Y")+543).'   '.date("H:i:s");

	
	$Bcode = $_GET["cBedcode"];
	$_SESSION["Bcode"] = $_GET["cBedcode"];
	$_SESSION["cBed"] = $_GET["cBed"];
	$cBedcode = $_GET["cBedcode"];
	$_SESSION["cBedcode"] = $_GET["cBedcode"];
	
    include("connect.inc");

    $query = "SELECT * FROM bed WHERE bedcode = '$cBedcode'";


    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
   		 }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   If ($result){
      $cBed=$row->bed;  //add  2/5/04
      $cBedcode=$row->bedcode;
      $cAn=$row->an;
      $cHn=$row->hn;
      $cPtname=$row->ptname;
      $cPtright=$row->ptright;
      $cDoctor=$row->doctor;
      $cAge=$row->age;
      $cAddress=$row->address;
      $cMuang=$row->muang;
      $cDate=$row->date;
      $cDiagnos=$row->diagnos;
      $cChgdate=$row->chgdate;

   }else {
      echo "ไม่พบ bedcode : $cBedcode";
   }
 
 $_SESSION["cAn"] = $_GET["cAn"];

$query = "SELECT an FROM bed WHERE an = '".$_SESSION["cAn"]."' limit 0,1 ";
$result = mysql_query($query) or die("Query pocompany fail");
$arr = Mysql_fetch_assoc($result);

if($arr["an"] != ""){


  $query = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";

    $result = mysql_query($query) or die("Query pocompany fail");



    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {

        if (!mysql_data_seek($result, $i)) {

            echo "Cannot seek to row $i\n";

            continue;

        }



        if(!($row = mysql_fetch_object($result)))

            continue;

         }

//31

	$chn=$row->hn;

	$can=$row->an;

	$cptname=$row->ptname;

	$cage=$row->age;

	$cptright=$row->ptright;

	$cbedcode=$row->bedcode;

	$cdoctor=$row->doctor;
	$cdiagnos=$row->diagnos;


	







////

///po97 ใบที่ 1


print "<HTML>";

print "<script>";

 print "ie4up=nav4up=false;";

 print "var agt = navigator.userAgent.toLowerCase();";

 print "var major = parseInt(navigator.appVersion);";

 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";

   print "ie4up = true;";

 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";

   print "nav4up = true;";

print "</script>";



print "<head>";

print "<STYLE>";

 print "A {text-decoration:none}";

 print "A IMG {border-style:none; border-width:0;}";

 print "DIV {position:absolute; z-index:25;}";

print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:0PX;top:0PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed</span></DIV>";

print "<DIV style='left:0PX;top:20PX;width:306PX;height:30PX;'><span class='fc1-0'>AN:$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;อายุ&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-1'>โรค&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>แพทย์&nbsp;$cdoctor</span></DIV>";


print "<br /><br /><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp  <input type='button' onclick='history.back();' value='       กลับหน้า ward       ' /></BODY></HTML>";

                        }
else{

	$codeward=substr($_GET['cBedcode'],0,2);

    echo "เตียง $cBed ว่าง   รหัสward  : $codeward";
?>

<div align="left">
  <table border="0" cellpadding="0" cellspacing="0" width="56%" height="247">
    <tr>
      <td width="8%" height="43"></td>
      <td width="92%" height="43"><b>&#3619;&#3633;&#3610;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3651;&#3627;&#3617;&#3656;&#3627;&#3619;&#3639;&#3629;&#3619;&#3633;&#3610;&#3618;&#3657;&#3634;&#3618;&#3652;&#3604;&#3657;</b>
      </td>
    </tr>
    <tr>
      <td width="8%" height="145"></td>
      <td width="92%" height="145">
        <div align="left">
          <table border="2" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td width="100%"><form method="POST" action="ipcheck.php">
   <p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &#3619;&#3633;&#3610;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3651;&#3627;&#3617;&#3656;</b></p>
   <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &#3614;&#3636;&#3617;&#3614;&#3660; AN
  &#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3607;&#3637;&#3656;&#3605;&#3657;&#3629;&#3591;&#3585;&#3634;&#3619;&#3619;&#3633;&#3610;&#3652;&#3623;&#3657;&#3609;&#3629;&#3609;&#3648;&#3605;&#3637;&#3618;&#3591;&#3609;&#3637;&#3657;</font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp; AN&nbsp; <input type="text" name="an" size="10"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="  &#3605;&#3585;&#3621;&#3591;  " name="B1">&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2"></font></p>
</form></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td width="8%" height="59"></td>
      <td width="92%" height="59">&nbsp;
        <div align="left">
          <table border="2" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td width="100%">
                <form method="POST" action="chgwa.php"  target="_blank">
                
                <input type="hidden" name="codeward" value="<?=$codeward;?>"  />
                  <p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &#3619;&#3633;&#3610;&#3618;&#3657;&#3634;&#3618;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3592;&#3634;&#3585;&#3627;&#3629;&#3629;&#3639;&#3656;&#3609;</b></p>
                  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &#3619;&#3633;&#3610;&#3618;&#3657;&#3634;&#3618;&#3592;&#3634;&#3585;&#3627;&#3629; <select size="1" name="ward">
                    <option selected>-&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;-</option>
                    <option value="41">&#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
                    <option value="42">&#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
                    <option value="43">&#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
                    <option value="44">&#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;
                    ICU</option>
                    <option value="45">&#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;</option>
                  </select></p>
                   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="  &#3605;&#3585;&#3621;&#3591;  " name="B1">&nbsp;&nbsp;
                  <input type="reset" value="  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2"></p>
                </form>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
</div>
<br />
<input type="button" onclick="history.back();" value="       กลับหน้า ward       " />

<?php
      }
   include("unconnect.inc");
?>

