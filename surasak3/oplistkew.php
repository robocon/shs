
...............................รายชื่อผู้ป่วยทั้งหมด..............................<br>
<?php

	

	if(isset($_POST["submit"])){

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));

		$d = $_POST["d"];
		$m = $_POST["m"];
		$yr = $_POST["yr"];

	}else{
		
		$today = date("d-m-Y");   
		$d=substr($today,0,2);
		$m=substr($today,3,2);
		$yr=substr($today,6,4) +543;

	}

    $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อคนไข้เรียงตามลำดับคิวก่อนหลัง";
	echo "<A HREF=\"../nindex.htm\">&lt; &lt; เมนู</A>";
    print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="$yr-$m-$d";
?>

<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
	<p>วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='4' value='<?php echo $d;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $m;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $yr;?>'></font></p>
	<p>คิว&nbsp;:&nbsp;<SELECT NAME="kew">
		<OPTION value="">ทั้งหมด</OPTION>
		<OPTION value="NID" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "NID") echo " Selected ";?>>คิวฝั่งเข็ม</OPTION>
		<OPTION value="DEN_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "DEN_") echo " Selected ";?>>คิวตรวจทันตกรรม</OPTION>
		<OPTION value="สูติ_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "สูติ_") echo " Selected ";?>>คิวสูติ</OPTION>
		<OPTION value="BMD_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "BMD_") echo " Selected ";?>>มวลกระดูก</OPTION>
		<OPTION value="U_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "U_") echo " Selected ";?>>คิวคนไข้กลุ่มเสี่ยงไข้หวัด2009</OPTION>
	</SELECT></p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' name="submit" value='     ตกลง     ' >
	
	</form>

<table>
 <tr>
 
<th bgcolor=6495ED>คิว</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>เวลารับบัตร</th>
  <th bgcolor=6495ED>เวลาออกบัตร</th>


  <th bgcolor=6495ED><font face='Angsana New'>ออกโดย</th>
    <th bgcolor=6495ED><font face='Angsana New'>ผู้บันทึก</th>
  </tr>

<?php
    $detail="ค่ายา";
    include("connect.inc");
	
	if($_POST["kew"] != ""){
		$where = " AND kew like '".$_POST["kew"]."%' ";
	}

    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,time1,time2 FROM opday WHERE thidate LIKE '$today%' ".$where." ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$time1,$time2) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);

        print (" <tr>\n".
        
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$kew</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"chkopd.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time2</td>\n".
    
         
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




