<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");

	if($_POST["icd9"] != ""){

		$where = " AND icd9cm = '".$_POST["icd9"]."' ";
	}

    $query="CREATE TEMPORARY TABLE dxgroup SELECT * FROM opday WHERE thidate LIKE '$yrmonth%' ".$where." ";
    $result = mysql_query($query) or die("Query failed,opday");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";
   $query="SELECT * FROM dxgroup";
   $result = mysql_query($query);
   $Grecords = mysql_num_rows($result);

    print "1. ��§ҹ�ӹǹ�����¹͡��ṡ��� 21 ������ä <a target=_self  href='../nindex.htm'><<�����</a><br> ";
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>������ä</th>";
    print "  <th bgcolor=6495ED>������ �</th>";
    print "  <th bgcolor=6495ED>������ �</th>";
    print "  <th bgcolor=6495ED>������ �</th>";
    print "  <th bgcolor=6495ED>���(��)</th>";
    print " </tr>";
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

    include("unconnect.inc");
?>