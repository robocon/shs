
...............................��ª��ͼ����·�����..............................<br>
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
    print "�ѹ��� $today  ��ª��ͤ������§����ӴѺ��ǡ�͹��ѧ";
	echo "<A HREF=\"../nindex.htm\">&lt; &lt; ����</A>";
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="$yr-$m-$d";
?>

<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
	<p>�ѹ���&nbsp;&nbsp; 
	<input type='text' name='d' size='4' value='<?php echo $d;?>'>&nbsp;&nbsp;
	��͹&nbsp; <input type='text' name='m' size='4' value='<?php echo $m;?>'>&nbsp;&nbsp;&nbsp;
	�.�. <input type='text' name='yr' size='8' value='<?php echo $yr;?>'></font></p>
	<p>���&nbsp;:&nbsp;<SELECT NAME="kew">
		<OPTION value="">������</OPTION>
		<OPTION value="NID" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "NID") echo " Selected ";?>>��ǽ�����</OPTION>
		<OPTION value="DEN_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "DEN_") echo " Selected ";?>>��ǵ�Ǩ�ѹ�����</OPTION>
		<OPTION value="�ٵ�_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "�ٵ�_") echo " Selected ";?>>����ٵ�</OPTION>
		<OPTION value="BMD_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "BMD_") echo " Selected ";?>>��š�д١</OPTION>
		<OPTION value="U_" <?php if(isset($_POST["kew"]) && $_POST["kew"] == "U_") echo " Selected ";?>>��Ǥ�����������§����Ѵ2009</OPTION>
	</SELECT></p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' name="submit" value='     ��ŧ     ' >
	
	</form>

<table>
 <tr>
 
<th bgcolor=6495ED>���</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�����Ѻ�ѵ�</th>
  <th bgcolor=6495ED>�����͡�ѵ�</th>


  <th bgcolor=6495ED><font face='Angsana New'>�͡��</th>
    <th bgcolor=6495ED><font face='Angsana New'>���ѹ�֡</th>
  </tr>

<?php
    $detail="�����";
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




