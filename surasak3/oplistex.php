<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

<script type="text/javascript"> 
function timedMsg() 
{ 
setTimeout("count();",1000) ;
} 

function count(){
	
	if(eval(document.all['mysdiv'].innerHTML) == 1){
		window.location.reload();
	}else{
		document.all['mysdiv'].innerHTML = eval(document.all['mysdiv'].innerHTML)-1;
		timedMsg();
	}

}

window.onload = function(){
timedMsg();
}

</script> 

</head>
�Ѻ�����ѧ���� refresh ��ա  <span id="mysdiv">30</span> �Թҷ�
<BR>
<?php

	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;
     $today="$d-$m-$yr";
    print "�ѹ��� $today  ��ª��ͤ������§����ӴѺ���ҡ�͹��ѧ �ѹ�֡����觨ش�Ѵ�¡";
     print "<a target=_self  href='../nindex.htm'><<�����............</a><br> ";
 print "<a target=_self  href='oplistex1.php'>仴���¡�÷���ҧ������к�<br> ";
    
$today="$yr-$m-$d";
$N='N';

?>
<table>
 <tr>
  <th bgcolor=6495ED>VN</th>
<th bgcolor=6495ED>���</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>���觤Ѵ�¡</th>

  <th bgcolor=6495ED>�Է��</th>
  <th bgcolor=6495ED><font face='Angsana New'>���觡�Ѻ令�</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>���ѹ�֡</th>
  </tr>

<?php
    $detail="�����";
    include("connect.inc");
  
    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,phaok FROM opday WHERE thidate LIKE '$today%'and phaok='$N' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$phaok) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$kew</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a   href=\"rxform3.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$ptname</a></td>\n".
     //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'><a  href=\"rxform31.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow\">$goup</a></td>\n".
           //"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'><a  href=\"rxform31.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$toborow</a></td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$borow</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>


