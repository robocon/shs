<?php     
    $today="$d-$m-$yr";    	
    print "�ѹ��� $today ��¡������Ѻ�����¹͡ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< ��Ѻ�'>";  		
    $today="$yr-$m-$d";
    print "<br>"; 

/*table opacc 
CREATE TABLE opacc (
  row_id int(11) NOT NULL auto_increment,
  date datetime default NULL,
  txdate datetime default NULL,
  hn varchar(12) default NULL,
  an varchar(12) default NULL,
  depart varchar(5) default NULL,
  detail varchar(40) default NULL,
  price double(12,2) default NULL,
  paid double(12,2) default NULL,
  idname varchar(32) default NULL,
  essd double(10,2) default NULL,
  nessdy double(10,2) default NULL,
  nessdn double(10,2) default NULL,
  dpy double(10,2) default NULL,
  dpn double(10,2) default NULL,
  dsy double(10,2) default NULL,
  dsn double(10,2) default NULL,
  ptright varchar(40) default NULL,
  credit varchar(32) default NULL,
  PRIMARY KEY  (row_id),
  KEY inxdate (date)
) TYPE=MyISAM;
*/
?>
<table>
 <tr>
 <th bgcolor=#669999>#</th>
 <th bgcolor=#669999>����</th>
 <th bgcolor=#669999>HN</th>
 <th bgcolor=#669999>AN</th>
 <th bgcolor=#669999>Ἱ�</th>
 <th bgcolor=#669999>��¡��</th>
 <th bgcolor=#669999>�Ҥ�</th>
 <th bgcolor=#669999>����</th>
 <th bgcolor=#669999>�ѵ��ôԵ</th>
  <th bgcolor=#669999>�Է��</th>
 <th bgcolor=#669999>���.</th>
 </tr>
<?php
    include("connect.inc");
   $n=0;
   $totalpri=0;
    $query = "SELECT date_format(date,'%H:%i'),hn,an,depart,detail,price,paid,credit,ptright,idname FROM opacc WHERE date LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query opacc failed");

    while (list ($date,$hn,$an,$depart,$detail,$price,$paid,$credit,$ptright,$idname) = mysql_fetch_row ($result)) {
        $n++;	
     $totalpri=$totalpri+$price;
           print (" <tr>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$credit</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=#00CC99><font face='Angsana New'>$idname</td>\n".
           " </tr>\n");
        }
    print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>

