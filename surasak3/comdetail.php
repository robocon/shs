<?php
      
 $Thaidate=date("d-m-").(date("Y")+543);
 print"<FONT SIZE='3'><CENTER>Ẻ��§�¡�â����/��������������к��������������͢���<BR>";
  print"�ٹ����������� �ç��Һ�Ť�������ѡ�������� �ӻҧ �� 6206<BR></CENTER></FONT>";
$num = Y;
    include("connect.inc");
    $query = "SELECT  row,depart,head,datetime,programmer,date,detail,user1,phone FROM com_support   WHERE row=$row  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
        
        print"<BR><BR><CENTER><table>";
        print" <tr>";
        print"  <th bgcolor=CD853F>�ӴѺ��</th>";
        print"  <th bgcolor=CD853F>Ἱ�</th>";
        print"  <th bgcolor=CD853F>��Ǣ��</th>";
		   print"  <th bgcolor=CD853F>��������´</th>";
        print"  <th bgcolor=CD853F>�ѹ���ҷ����ͧ��</th>";
		print"  <th bgcolor=CD853F>�����ͧ��</th>";
		print"  <th bgcolor=CD853F>����Դ���</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$detail,$user1,$tel) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=F5DEB3>$row</td>\n".
                "  <td BGCOLOR=F5DEB3>$depart</td>\n".
                "  <td BGCOLOR=F5DEB3>$head</a></td>\n".
            
				          "  <td BGCOLOR=F5DEB3>".nl2br($detail)."</td>\n".
							       "  <td BGCOLOR=F5DEB3>$date</td>\n".
				 "  <td BGCOLOR=F5DEB3>$user1</td>\n".
				  "  <td BGCOLOR=F5DEB3>$tel</td>\n".
                " </tr>\n");
  						    }
        print"</table></CENTER>";


	}

 
 
 include("unconnect.inc");  

?>

