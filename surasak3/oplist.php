....................................................................��§ҹ���Ἱ�.........................................<br>
<?php
set_time_limit(30);

function strtime($time){

		$subtime = explode(":",$time);
		$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));

	return  $rt;
}



$num= '0';
  $today="$d-$m-$yr";
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="$yr-$m-$d";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "<br>�ӹǹ������������¡�� ������Ҫ���<a target=_self  href=\"oplistin.php? today=$today\" >������������Ҫ���</a><br> ";
  print "�ӹǹ������������¡�� �͡�����Ҫ���<a target=_self  href=\"oplistout.php? today=$today\" >�����¹͡�����Ҫ���</a><br> ";
  print "�ӹǹ������������¡�� ������Ҫ���<a target=_self  href=\"oplist2.php? today=$today\" >�����µ�� ICD10</a><br> ";
  print "�ӹǹ������������¡��  �����͡��¡�� = ��ª��ͼ�����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT toborow ,COUNT(*) AS duplicate FROM opday1 GROUP BY  substr(toborow,1,4) HAVING duplicate > 0 ORDER BY toborow";
   $result = mysql_query($query);
     $n=0;
 while (list ($toborow,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$toborow &nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>
.....................................................................��§ҹ���ᾷ��..............................................<br>
<?php
  $today="$d-$m-$yr";
$num= '0';
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="$yr-$m-$d";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "�ӹǹ����������ᾷ��  �����͡ᾷ�� = ��ª��ͼ�����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>
....................................................................��§ҹ����Է��.........................................<br>
<?php
$num= '0';
  $today="$d-$m-$yr";
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="$yr-$m-$d";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "�ӹǹ������������¡��  �����͡��¡�� = ��ª��ͼ�����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT ptright ,COUNT(*) AS duplicate FROM opday1 GROUP BY substr(ptright,1,3) HAVING duplicate > 0 ORDER BY ptright";
   $result = mysql_query($query);
     $n=0;
 while (list ($ptright,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$ptright&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>
....................................................................��§ҹ���������.........................................<br>
<?php
$num= '0';
  $today="$d-$m-$yr";
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="$yr-$m-$d";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "�ӹǹ������������¡��  �����͡��¡�� = ��ª��ͼ�����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT goup ,COUNT(*) AS duplicate FROM opday1 GROUP BY goup HAVING duplicate > 0 ORDER BY goup";
   $result = mysql_query($query);
     $n=0;
 while (list ($goup,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$goup&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>
...............................................................................................��ª��ͼ����·�����..............................<br>
<?php
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ��ª��ͤ������§����ӴѺ���ҡ�͹��ѧ";
    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="$yr-$m-$d";
?>

<br />
<div style="background-color:#CCCC99;">������ͧ ���  ADMIT  </div>
<div style="background-color:#CC3333;">��ᴧ ��� �ѧ�����׹ OPDCARD</div>

<table>
 <tr>
  <th bgcolor=6495ED>VN</th>
<th bgcolor=6495ED>���</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>�ä</th>
  <th bgcolor=6495ED>�Է��</th>
  <th bgcolor=6495ED>������</th>
  <th bgcolor=6495ED>ᾷ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�׹OPD</th>
  <th bgcolor=6495ED><font face='Angsana New'>�͡��</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>���ѹ�֡</th>
  <th bgcolor=6495ED><font face='Angsana New'>ŧ����</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����Ѻ</th>
  <th bgcolor=6495ED><font face='Angsana New'>���Ҩ���</th>
  <th bgcolor=6495ED><font face='Angsana New'>��������</th>
  </tr>

<?php
    $detail="�����";
    include("connect.inc");
  
    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,time1,time2,officer2 FROM opday WHERE thidate LIKE '$today%' ";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed");
	$j=0;
	$countavg = 0;
    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$time1,$time2,$officer2) = mysql_fetch_row ($result)) {
    //    $time=substr($thidate,11);
		
		
	$daynow1=(date("Y")+543).date("-m-d");
    $time=substr($thidate,11);
	$daynow2=substr($thidate,0,10);
//	$color="#66CDAA";

	if($daynow1  <> $daynow2){
		
		if($okopd=="N"){
			if($an!=""){
				$color="#CCCC99";
			}else{
				$color="#CC3333";
			}
		}else if($okopd=="Y"){
			$color="#66CDAA";
		}
		
	}else{
	
	$color="#66CDAA";	
		
	}

	/*			if($time2 != ""){

$subtime = explode(":",$time1);
$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));
$stringtime = strtime($time2) - $rt;
if($stringtime > 600){
	$time2 = date("H:i:s",mktime($subtime[0],$subtime[1]+5,$subtime[2]+rand(1,60),date("m"),date("d"),date("Y")));
}
					$stringtime1 = strtime($time1);
					$stringtime2 = strtime($time2);
					$stringtime3 = $stringtime2-$stringtime1;
					$time3 = date("i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					$countavg = $countavg+$stringtime3;
					$j++;
				}else{
					$time3 = "";
				}
*/


	$starttime = $time1;
	$lasttime = $time2;
	if($lasttime!=""){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}
	
	$today=substr($thidate,0,10);
?>
		<tr>
			<td BGCOLOR=<?=$color?> align="center"><font face='Angsana New'><a href="report_checkup.php?vn=<?=$vn;?>&today=<?=$today?>&hn=<?=$hn;?>" target="_blank"><?=$vn;?></a></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$kew;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$time;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$hn;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'>
            <a target='_BLANK' href="chkopd.php? cTdatehn=<?=$thdatehn;?>&cPtname=<?=$ptname;?>&cHn=<?=$hn;?>&cDoctor=<?=$doctor;?>&cDiag=<?=$diag;?>&cOkopd=<?=$okopd;?>&cVn=<?=$vn;?>"><?=$ptname;?></a></font>
            </td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$an;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$diag;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$ptright;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$goup;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$doctor;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$okopd;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$toborow;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$borow;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$officer;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$officer2;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$time1;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$time2;?></font></td>
			<td BGCOLOR=<?=$color?>><font face='Angsana New'><?=$time3;?></font></td>
  </tr>
            <?
       }
	   ?>
</table>

<? 

$list["EX 91"]= "�͡ VN �� ����Ҿ";
$list["EX 92"]= "�͡ VN �� �ѧ���";
$list["EX 92"]= "�ѧ���";
$list["EX01"]= "�ѡ���ä�����������Ҫ���";

$list["EX02"]= "�����©ء�Թ";
$list["EX03"]= "��Ѥ��ç��è��µç";
$list["EX04"]= "�����¹Ѵ";

$list["EX05"]= "���";

$list["EX06"]= "�Ѵ��ͧ����";
$list["EX07"]= "�ѹ�����";
$list["EX10"]= "�����";
$list["EX11"]= "�ѡ���ä�͡�����Ҫ���";
$list["EX12"]= "�͹�ç��Һ��";
$list["EX13"]= "����͹�Ѵ";
$list["EX15"]= "�͡ VN";
$list["EX16"]= "��Ǩ�آ�Ҿ";
$list["EX17"]= "����Ҿ�ӺѴ";
$list["EX19"]= "�͡ VN ����";
$list["EX20"]= "�ǴἹ��";



$sql = "SELECT left(toborow,4) as toborow2,  sum( TIME_TO_SEC( SUBTIME( time2, time1 ) ) ) as time_s, count(toborow) as c_total FROM opday WHERE thidate LIKE '$today%' AND time1 != '' AND time2 != '' AND left(toborow,4) in ('EX01','EX02') group by toborow2 Order by toborow2 ASC ";
// echo $sql;
$result = Mysql_Query($sql) or die(Mysql_error());
print "<table>";
while($arr = Mysql_fetch_assoc($result)){
	
	$name_ex = trim($arr["toborow2"]);
	
	//echo $arr["time_s"];
	$avg = $arr["time_s"]/$arr["c_total"];
	//echo $avg;
	$showavg=gmdate("H:i:s", $avg);
	print "<tr><td>".$list[$name_ex]."</td><td>".$showavg."</td></tr>";

}
print "</table>";







    include("unconnect.inc");
?>
</table>




