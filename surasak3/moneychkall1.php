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
    print "<font face='Angsana New'><b>��¡�÷��١�ѹ�֡�����¹͡</b><br>";
  
  print "<b>�ѹ���</b> $appd ";
   
 print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
?>


<?php
    include("connect.inc");
//    $query="CREATE TEMPORARY TABLE opacc1 SELECT * FROM opacc WHERE date like '$appd1%' ";
	
  //  $result = mysql_query($query) or die("Query failed,app");


  print "�ӹǹ��¡�÷��ѹ�֡/���� = ��ª��ͼ�����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  credit,COUNT(*) AS duplicate FROM opacc WHERE date like '$appd1%'   GROUP BY credit HAVING duplicate > 0 ORDER BY credit";
   $result = mysql_query($query);
     $n=0;
 while (list ($credit,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chkmonycredit1.php? doctor1=$credit&yr=$thiyr&m=$appmo&d=$appdate\">$credit&nbsp;&nbsp;</a></td>\n".
         "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��¡��</td>\n".
               " </tr>\n<br>");
               }

if( $appd1 == '2562-12-22' ){
  $part = urlencode('�ͺ���Ǩ63');
  $appd = urlencode($appd);
  echo '<a target="_BLANK" href="chk_credit_police63.php?repdate='.$appd.'&part='.$part.'">��Ǩ�آ�Ҿ���Ǩ</a>&nbsp;&nbsp;�ӹǹ&nbsp; = &nbsp;417 &nbsp;&nbsp;��¡��';

}elseif ( $appd1 == '2562-12-23' ) {
  $part = urlencode('�ͺ���Ǩ63_02');
  $appd = urlencode($appd);
  echo '<a target="_BLANK" href="chk_credit_police63.php?repdate='.$appd.'&part='.$part.'">��Ǩ�آ�Ҿ���Ǩ</a>&nbsp;&nbsp;�ӹǹ&nbsp; = &nbsp;281 &nbsp;&nbsp;��¡��';

}


include("unconnect.inc");
?>




