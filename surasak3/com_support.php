<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>��Ѻ˹��������ѡ</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='com_add.php'><font size='4' class='forntsarabun'>�ѹ�֡�駧ҹ����</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>��§ҹ��Ш���͹</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>��§ҹ�š�÷ӧҹ</font></a>";
print "<hr>";
print"<br><div align='center' class='forntsarabun'><strong>�к��ѹ�֡��â����/��������������к��ç��Һ�� SHS<BR>�ç��Һ�Ť�������ѡ�������� �ӻҧ</strong></div><BR>";
$Thaidate=date("d-m-").(date("Y")+543);
$n =0;
$num = Y;
session_start();
    include("connect.inc");
    $query = "SELECT  row,depart,head,datetime,programmer,date,user1 FROM com_support   WHERE status ='$num' ORDER BY row desc";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
 print"<div align='center'><font class='forntsarabun'>�Թ�յ�͹�Ѻ �س <strong>$sOfficer</strong> �������к�</font></div>";
 echo "<div align='center'><font size='1' class='forntsarabun'>�Դ�������������....�����Թ  ������ ��й�¡�ɳ��ѡ���  �ѹ��� ��. 6206</font></div><BR>";
       print"<div align='center' class='forntsarabun'><strong>�ҹ��ҧ����ѧ������Ѻ�Դ�ͺ</strong></div>";
        print"<table class='forntsarabun'  align='center' width='90%'>";
        print" <tr>";
		print"  <th bgcolor=#FF9966>�ӴѺ</th>";
        print"  <th bgcolor=#FF9966>�ӴѺ��</th>";
        print"  <th bgcolor=#FF9966>Ἱ�</th>";
        print"  <th bgcolor=#FF9966>��Ǣ��</th>";
		print"  <th bgcolor=#FF9966>�������ͧ��</th>";
        print"  <th bgcolor=#FF9966>�ѹ�����ͧ��</th>";
		print"  <th bgcolor=#FF9966>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=#FF9966>�����</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user1) = mysql_fetch_row ($result)) {
$n++;
$head=substr($head,0,40);

    $programmer = ( !empty($programmer) ) ? $programmer : '�͡�õͺ�Ѻ' ;

    if($_SESSION['smenucode']=='ADM'){
        $where="<a target=_TOP href=\"com_edit.php?row=$row\">$programmer</a>";
    } else {
        $where="$programmer";
    };
	
            print (" <tr>\n".
				  "  <td BGCOLOR=#FFCC99 align='center'>$n</td>\n".
                "  <td BGCOLOR=#FFCC99 align='center'>$row</td>\n".
                "  <td BGCOLOR=#FFCC99>$depart</td>\n".
                "  <td BGCOLOR=#FFCC99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
					          "  <td BGCOLOR=#FFCC99>$user1</td>\n".
                "  <td BGCOLOR=#FFCC99>$date</td>\n".
				  "  <td BGCOLOR=#FFCC99>$where</td>\n".
				  "  <td BGCOLOR=#FFCC99><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
                " </tr>\n");
		
  						    }
        print"</table>";
			}
 include("unconnect.inc");  

/*print"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='com_add.php'><font size='4'>�ѹ�֡�ҹ����</a></font>";*/
echo "<hr />";
?>

<?php
 $Thaidate=date("d-m-").(date("Y")+543);
$n=0;
$num = A;
    include("connect.inc");
    $query = "SELECT  row,depart,head,datetime,programmer,date,user FROM com_support   WHERE status ='$num' and programmer !='��ԧ����' ORDER BY row desc";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
        print"<div align='center' class='forntsarabun'><strong>�ҹ�����ѧ���Թ�������</strong></div>";
        print"<table class='forntsarabun'  align='center' width='90%'>";
        print" <tr>";
		        print"  <th bgcolor=#FF99CC>�ӴѺ</th>";
        print"  <th bgcolor=#FF99CC>�ӴѺ��</th>";
        print"  <th bgcolor=#FF99CC>Ἱ�</th>";
        print"  <th bgcolor=#FF99CC>��Ǣ��</th>";
        print"  <th bgcolor=#FF99CC>�ѹ�����ͧ��</th>";
		print"  <th bgcolor=#FF99CC>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=#FF99CC>�����</th>";
		print"  <th bgcolor=#FF99CC>��÷ӧҹ</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user) = mysql_fetch_row ($result)) {
			$n++;
			$head=substr($head,0,40);
			if($_SESSION['smenucode']=='ADM'){$where="<a target=_TOP href=\"comsucces.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
			if($_SESSION['smenucode']=='ADM'){$add="<a target='_blank' href=\"comservice.php?row=$row&act=win\">�ѹ�֡</a>";} else {$add="�ѹ�֡";};
			
            print (" <tr>\n".
				      "  <td BGCOLOR=#FFCCCC align='center'>$n</td>\n".
                "  <td BGCOLOR=#FFCCCC align='center'>$row</td>\n".
                "  <td BGCOLOR=#FFCCCC>$depart</td>\n".
                "  <td BGCOLOR=#FFCCCC><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#FFCCCC>$date</td>\n".
				  "  <td BGCOLOR=#FFCCCC>$where</td>\n".
				  "  <td BGCOLOR=#FFCCCC><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
				  "  <td BGCOLOR=#FFCCCC align='center'>$add</td>\n".
                " </tr>\n");
  						    }
        print"</table>";
			}
 include("unconnect.inc");  

echo "<hr />";
?>
<?php
 $Thaidate=date("d-m-").(date("Y")+543);

$num = n;
    include("connect.inc");
    $query = "SELECT  row,depart,head,datetime,programmer,date,p_edit,dateend FROM com_support   WHERE status ='$num' ORDER BY dateend desc  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
	    print"<div align='center' class='forntsarabun'><strong>�ҹ�����Թ�����������</strong></div>";
        print"<table class='forntsarabun'  align='center'>";
        print" <tr>";
        print"  <th bgcolor=#0099CC>�ӴѺ��</th>";
        print"  <th bgcolor=#0099CC>Ἱ�</th>";
        print"  <th bgcolor=#0099CC>��Ǣ��</th>";
        print"  <th bgcolor=#0099CC>�ѹ���ҷ����ͧ��</th>";
		print"  <th bgcolor=#0099CC>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=#0099CC>��ô��ԡ��</th>";
		print"  <th bgcolor=#0099CC>�ѹ���ҷ����Թ���</th>";
		print"  <th bgcolor=#0099CC>�����</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$p_edit,$dateend) = mysql_fetch_row ($result)) {
			$head=substr($head,0,40);
            print (" <tr>\n".
                "  <td BGCOLOR=#66CCFF  align='center'>$row</td>\n".
                "  <td BGCOLOR=#66CCFF>$depart</td>\n".
                "  <td BGCOLOR=#66CCFF><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#66CCFF>$date</td>\n".
				"  <td BGCOLOR=#66CCFF>$programmer</td>\n".
				"  <td BGCOLOR=#66CCFF>$p_edit</td>\n".
				"  <td BGCOLOR=#66CCFF>$dateend</td>\n".
				"  <td BGCOLOR=#66CCFF><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
                " </tr>\n");
  				}
        print "</table>";
			}
 include("unconnect.inc");  
?>