<?php
    
session_start();
/*
if($_SESSION["sIdname"] != "bbm"){
	echo "���������ҧ��Ѻ��ا";
	exit();
}
*/
$appd=$appdate.' '.$appmo.' '.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
    print "<font face='Angsana New'><b>��ª��ͼ�����ҵ�Ǩ�آ�Ҿ��Шӻ� $year</b><br>";
  
//  print "<b>�ѹ���</b>  ";
   
 print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
?>


<?php
    include("connect.inc");
//    $query="CREATE TEMPORARY TABLE opacc1 SELECT * FROM opacc WHERE date like '$appd1%' ";
	
  //  $result = mysql_query($query) or die("Query failed,app");


  print "�ӹǹ��¡�÷��ѹ�֡/���� = ��ª��ͼ�����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  program,company,COUNT(*) AS duplicate FROM chkup_company  WHERE company like '$company%' and idno like '$year%' GROUP BY program HAVING duplicate > 0 ORDER BY program";
   $result = mysql_query($query);
     $n=0;
 while (list ($program,$company,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chkcom_yeardetail1.php?company=$company&program=$program&year=$year\">$program&nbsp;&nbsp;</a></td>\n".
         "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��¡��</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
?>




