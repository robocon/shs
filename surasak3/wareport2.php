<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";

    $query="CREATE TEMPORARY TABLE warphar SELECT date_format(date,'%d- %m- %Y'),ptname,hn,diag,price,ptright, an FROM phardep WHERE date LIKE '$yrmonth%' and ptright LIKE 'R07%' AND (an is not Null OR an <>'')";
    $result = mysql_query($query) or die("Query failed,warphar");
 //   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. ��§ҹ����Ҽ������ ��Сѹ�ѧ�� ��͹ $yrmonth <a target=_self  href='../nindex.htm'><<�����</a><br> ";
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>#</th>";
    print "  <th bgcolor=6495ED>�ѹ���</th>";
    print "  <th bgcolor=6495ED>����</th>";
    print "  <th bgcolor=6495ED>HN</th>";
	print "  <th bgcolor=6495ED>AN</th>";
    print "  <th bgcolor=6495ED>�ԹԨ����ä</th>";
    print "  <th bgcolor=6495ED>�����</th>";
    print "  <th bgcolor=6495ED>�Է��</th>";
print " </tr>";


   $query="SELECT * FROM warphar";
   $result = mysql_query($query);
     $num=0;
	
    while (list ($date,$ptname,$hn,$diag,$price,$ptright, $an) = mysql_fetch_row ($result)) {
	if($price < 0){
		$num--;
	}else{
		$num++;
	}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           " </tr>\n");
		$sum2[0] = $sum2[0]+$price;
          }
    print "<table>";
$sum1[0] = "1. ��§ҹ����Ҽ�����㹻�Сѹ�ѧ���ӹǹ : ".$num." ��¡��";
$sum = $sum + $num;

//wadeplab table
      print("<tr>\n".
              "<td bgcolor=F5DEB3>2. ��ҷ�LAB������㹻�Сѹ�ѧ�� ��͹ $yrmonth</td>\n".
              " </tr>\n");
    $query="CREATE TEMPORARY TABLE wadeplab SELECT date_format(date,'%d- %m- %Y'),ptname,hn,price,depart,ptright, an FROM depart WHERE date LIKE '$yrmonth%' and ptright LIKE 'R07%'  and depart='PATHO'  AND (an is not Null OR an <>'')";
    $result = mysql_query($query) or die("Query failed,wardep");
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>#</th>";
    print "  <th bgcolor=6495ED>�ѹ���</th>";
    print "  <th bgcolor=6495ED>����</th>";
    print "  <th bgcolor=6495ED>HN</th>";
    print "  <th bgcolor=6495ED>AN</th>";
    print "  <th bgcolor=6495ED>�Ҥ�</th>";
    print "  <th bgcolor=6495ED>depart</th>";
    print "  <th bgcolor=6495ED>�Է��</th>";
    print " </tr>";

   $query="SELECT * FROM wadeplab";
   $result = mysql_query($query);
      $num=0;
    while (list ($date,$ptname,$hn,$price,$depart,$ptright,$an) = mysql_fetch_row ($result)) {
	if($price < 0){
		$num--;
	}else{
		$num++;
	}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
			 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
	       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
  		" </tr>\n");
		$sum2[1] = $sum2[1]+$price;
          }
		      print "<table>";
$sum1[1] = "2. ��ҷ�LAB������㹻�Сѹ�ѧ���ӹǹ : ".$num." ��¡��";
$sum = $sum + $num;
//wadepxr table
      print("<tr>\n".
              "<td bgcolor=F5DEB3>3. ��ҷ�XRAY ������㹻�Сѹ�ѧ�� ��͹ $yrmonth</td>\n".
              " </tr>\n");
    $query="CREATE TEMPORARY TABLE wadepxr SELECT date_format(date,'%d- %m- %Y'),ptname,hn,price,depart,ptright, an FROM depart WHERE date LIKE '$yrmonth%' and ptright LIKE 'R07%'  and depart='XRAY'  AND (an is not Null OR an <>'')";
    $result = mysql_query($query) or die("Query failed,wardep");
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>#</th>";
    print "  <th bgcolor=6495ED>�ѹ���</th>";
    print "  <th bgcolor=6495ED>����</th>";
    print "  <th bgcolor=6495ED>HN</th>";
	print "  <th bgcolor=6495ED>AN</th>";
    print "  <th bgcolor=6495ED>�Ҥ�</th>";
    print "  <th bgcolor=6495ED>depart</th>";
    print "  <th bgcolor=6495ED>�Է��</th>";
    print " </tr>";

   $query="SELECT * FROM wadepxr";
   $result = mysql_query($query);
    $num=0;
    while (list ($date,$ptname,$hn,$price,$depart,$ptright,$an) = mysql_fetch_row ($result)) {
	if($price < 0){
		$num--;
	}else{
		$num++;
	}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
			 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
	       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           " </tr>\n");
		$sum2[2] = $sum2[2]+$price;
          }
		      print "<table>";
$sum1[2] = "3. ��ҷ�XRAY������㹻�Сѹ�ѧ���ӹǹ : ".$num." ��¡��";
$sum = $sum + $num;
//wadepetc table
      print("<tr>\n".
              "<td bgcolor=F5DEB3>4. ��� ���� ������㹻�Сѹ�ѧ�� ��͹ $yrmonth</td>\n".
              " </tr>\n");
    $query="CREATE TEMPORARY TABLE wadepxr2 SELECT date_format(date,'%d- %m- %Y'),ptname,hn,price,depart,ptright,an FROM depart WHERE date LIKE '$yrmonth%' and ptright LIKE 'R07%'  and depart != 'PATHO' and depart != 'XRAY'  AND (an is not Null OR an <>'')";
    $result = mysql_query($query) or die("Query failed,wardepxr".mysql_error());
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>#</th>";
    print "  <th bgcolor=6495ED>�ѹ���</th>";
    print "  <th bgcolor=6495ED>����</th>";
    print "  <th bgcolor=6495ED>HN</th>";
	print "  <th bgcolor=6495ED>AN</th>";
    print "  <th bgcolor=6495ED>�Ҥ�</th>";
    print "  <th bgcolor=6495ED>depart</th>";
    print "  <th bgcolor=6495ED>�Է��</th>";
    print " </tr>";

   $query="SELECT * FROM wadepxr2";
   $result = mysql_query($query);
    $num=0;
    while (list ($date,$ptname,$hn,$price,$depart,$ptright,$an) = mysql_fetch_row ($result)) {
	if($price < 0){
		$num--;
	}else{
		$num++;
	}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
	       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           " </tr>\n");
		$sum2[3] = $sum2[3]+$price;
          }
		      print "<table>";
$sum1[3] = "4. ��� ���� ������㹻�Сѹ�ѧ���ӹǹ : ".$num." ��¡��";
$sum = $sum + $num;

echo $sum1[0]," �ӹǹ�Թ : ".$sum2[0]." �ҷ <BR>",$sum1[1]," �ӹǹ�Թ : ".$sum2[1]." �ҷ <BR>",$sum1[2]," �ӹǹ�Թ : ".$sum2[2]." �ҷ <BR>",$sum1[3]," �ӹǹ�Թ : ".$sum2[3]." �ҷ <BR>";
echo "��������� ".$sum." ��¡��<BR>";
echo "����Թ������ ".($sum2[0]+$sum2[1]+$sum2[2]+$sum2[3])." ��¡��";


/*
///
   $Gtotal=0;
   $Gnet=0;
   $x=21;
   $dxgr=0;

   For ($n=1; $n<=$x; $n++){
      $dxgr++;
      $query="SELECT * FROM dxgroup WHERE dxgroup='$dxgr' and goup LIKE 'G1%'";
      $result = mysql_query($query);
      $G1 = mysql_num_rows($result);

      $query="SELECT * FROM dxgroup WHERE dxgroup='$dxgr' and goup LIKE 'G2%'";
      $result = mysql_query($query);
      $G2 = mysql_num_rows($result);

     $query="SELECT * FROM dxgroup WHERE dxgroup='$dxgr' and goup LIKE 'G3%'";
     $result = mysql_query($query);
     $G3 = mysql_num_rows($result);

     $G123=$G1+$G2+$G3;
     $Gtotal=$Gtotal+$G123;
        print("<tr>\n".
                "<td bgcolor=66CDAA>$n</td>\n".
                "<td bgcolor=66CDAA>$G1</td>\n".
                "<td bgcolor=66CDAA>$G2</td>\n".    
                "<td bgcolor=66CDAA>$G3</td>\n".
                "<td bgcolor=66CDAA>$G123</td>\n".  
                " </tr>\n");
                        } ;

        print("<tr>\n".
                "<td bgcolor=66CDAA></td>\n".
                "<td bgcolor=66CDAA></td>\n".
                "<td bgcolor=66CDAA></td>\n".    
                "<td bgcolor=66CDAA>���</td>\n".
                "<td bgcolor=66CDAA>$Gtotal</td>\n".  
                " </tr>\n");

        print("<tr>\n".
                "<td bgcolor=66CDAA></td>\n".
                "<td bgcolor=66CDAA></td>\n".
                "<td bgcolor=66CDAA></td>\n".    
                "<td bgcolor=66CDAA>�ӹǹ����¹</td>\n".
                "<td bgcolor=66CDAA>$Grecords</td>\n".  
                " </tr>\n");

////////////////////////
    print "<table>";
    print " <tr>";
    print "  <th>2. ��§ҹ�ӹǹ�����¹͡��ṡ����������ؤ��(ç.�ʵ.1)</th>";
    print " </tr>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=CD853F>�������ؤ��</th>";
    print "  <th bgcolor=CD853F>�����¹͡(��)</th>";
    print " </tr>";
//������ �
      $query="SELECT * FROM dxgroup WHERE goup LIKE 'G11%'";
      $result = mysql_query($query);
      $G11 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.1 ��·��û�Шӡ��</td>\n".
              "<td bgcolor=F5DEB3>$G11</td>\n".
              " </tr>\n");

      $query="SELECT * FROM dxgroup WHERE goup LIKE 'G12%'";
      $result = mysql_query($query);
      $G12 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.2 ����Ժ �ŷ��û�Шӡ��</td>\n".
              "<td bgcolor=F5DEB3>$G12</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G13%'";
     $result = mysql_query($query);
     $G13 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.3 ����Ҫ��á����������͹</td>\n".
              "<td bgcolor=F5DEB3>$G13</td>\n".
              " </tr>\n");

      $query="SELECT * FROM dxgroup WHERE goup LIKE 'G14%'";
      $result = mysql_query($query);
      $G14 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.4 �١��ҧ��Ш�</td>\n".
              "<td bgcolor=F5DEB3>$G14</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G15%'";
     $result = mysql_query($query);
     $G15 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.5 �١��ҧ���Ǥ���</td>\n".
              "<td bgcolor=F5DEB3>$G15</td>\n".
              " </tr>\n");

     $G=$G11+$G12+$G13+$G14+$G15;
     $Gnet=$Gnet+$G;
        print("<tr>\n".
                "<td bgcolor=CCCCCC>........................��������� �</td>\n".
                "<td bgcolor=CCCCCC>$G</td>\n".
                " </tr>\n");
//������ �
     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G21%'";
     $result = mysql_query($query);
     $G21 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.1 ����Ժ �ŷ��áͧ��Шӡ��</td>\n".
              "<td bgcolor=F5DEB3>$G21</td>\n".
              " </tr>\n");

      $query="SELECT * FROM dxgroup WHERE goup LIKE 'G22%'";
      $result = mysql_query($query);
      $G22 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.2 �ѡ���¹����</td>\n".
              "<td bgcolor=F5DEB3>$G22</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G23%'";
     $result = mysql_query($query);
     $G23 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.3 ������Ѥ÷��þ�ҹ</td>\n".
              "<td bgcolor=F5DEB3>$G23</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G24%'";
     $result = mysql_query($query);
     $G24 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.4 �ѡ�ɷ���</td>\n".
              "<td bgcolor=F5DEB3>$G24</td>\n".
              " </tr>\n");

     $G=$G21+$G22+$G23+$G24;
     $Gnet=$Gnet+$G;
        print("<tr>\n".
                "<td bgcolor=CCCCCC>........................��������� �</td>\n".
                "<td bgcolor=CCCCCC>$G</td>\n".
                " </tr>\n");
//������ �
     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G31%'";
     $result = mysql_query($query);
     $G31 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.1 ��ͺ���Ƿ���</td>\n".
              "<td bgcolor=F5DEB3>$G31</td>\n".
              " </tr>\n");

      $query="SELECT * FROM dxgroup WHERE goup LIKE 'G32%'";
      $result = mysql_query($query);
      $G32 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.2 ���ù͡��Шӡ��</td>\n".
              "<td bgcolor=F5DEB3>$G32</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G33%'";
     $result = mysql_query($query);
     $G33 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.3 �ѡ�֡���Ԫҷ���(ô)</td>\n".
              "<td bgcolor=F5DEB3>$G33</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G34%'";
     $result = mysql_query($query);
     $G34 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.4 ���Ѳ������ͧ</td>\n".
              "<td bgcolor=F5DEB3>$G34</td>\n".
              " </tr>\n");

      $query="SELECT * FROM dxgroup WHERE goup LIKE 'G35%'";
      $result = mysql_query($query);
      $G35 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.5 �ѵû�Сѹ�ѧ��</td>\n".
              "<td bgcolor=F5DEB3>$G35</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G36%'";
     $result = mysql_query($query);
     $G36 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.6 �ѵ÷ͧ30�ҷ</td>\n".
              "<td bgcolor=F5DEB3>$G36</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G37%'";
     $result = mysql_query($query);
     $G37 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.7 ����Ҫ��þ����͹(�ԡ���ѧ�Ѵ)</td>\n".
              "<td bgcolor=F5DEB3>$G37</td>\n".
              " </tr>\n");

      $query="SELECT * FROM dxgroup WHERE goup LIKE 'G38%'";
      $result = mysql_query($query);
      $G38 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.8 �����͹(����ԡ���ѧ�Ѵ)</td>\n".
              "<td bgcolor=F5DEB3>$G38</td>\n".
              " </tr>\n");

     $query="SELECT * FROM dxgroup WHERE goup LIKE 'G39%'";
     $result = mysql_query($query);
     $G39 = mysql_num_rows($result);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>�.9 ��������к�</td>\n".
              "<td bgcolor=F5DEB3>$G39</td>\n".
              " </tr>\n");
///////

     $G=$G31+$G32+$G33+$G34+$G35+$G36+$G37+$G38+$G39;
        print("<tr>\n".
                "<td bgcolor=CCCCCC>........................��������� �</td>\n".
                "<td bgcolor=CCCCCC>$G</td>\n".
                " </tr>\n");

     $Gnet=$Gnet+$G;
        print("<tr>\n".
                "<td bgcolor=AAAAAA>........................���������</td>\n".
                "<td bgcolor=AAAAAA>$Gnet</td>\n".
                " </tr>\n");

        print("<tr>\n".
                "<td bgcolor=AAAAAA>........................�ӹǹ����¹</td>\n".
                "<td bgcolor=AAAAAA>$Grecords</td>\n".  
                " </tr>\n");

*/
    include("unconnect.inc");
?>