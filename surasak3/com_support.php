<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'><------ �����</a>&nbsp;&nbsp;<a target=_blank  href='com_add.php'><font size='4' class='forntsarabun'>�ѹ�֡�駧ҹ����</font></a>&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>��§ҹ��Ш���͹</font></a>&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>��§ҹ�š�÷ӧҹ</font></a>";
print"<br><div align='center' class='forntsarabun'>�к��ѹ�֡��â����/��������������к����͢���<BR>�ç��Һ�Ť�������ѡ�������� �ӻҧ</div><BR>";
$Thaidate=date("d-m-").(date("Y")+543);
$n =0;
$num = Y;
session_start();
    include("connect.inc");
    $query = "SELECT  row,depart,head,datetime,programmer,date,user1 FROM com_support   WHERE status ='$num' ORDER BY row  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
 print"<font class='forntsarabun'>$sOfficer</font><BR>";
       print"<div align='center' class='forntsarabun'>�ҹ��ҧ����ѧ������Ѻ�Դ�ͺ</div>";
        print"<table class='forntsarabun'  align='center'>";
        print" <tr>";
		print"  <th bgcolor=CD853F>�ӴѺ</th>";
        print"  <th bgcolor=CD853F>�ӴѺ��</th>";
        print"  <th bgcolor=CD853F>Ἱ�</th>";
        print"  <th bgcolor=CD853F>��Ǣ��</th>";
		print"  <th bgcolor=CD853F>�������ͧ��</th>";
        print"  <th bgcolor=CD853F>�ѹ�����ͧ��</th>";
		print"  <th bgcolor=CD853F>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=CD853F>�����</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user1) = mysql_fetch_row ($result)) {
$n++;
$head=substr($head,0,40);
if($_SESSION['smenucode']=='ADM'){$where="<a target=_TOP href=\"com_edit.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
	
            print (" <tr>\n".
				  "  <td BGCOLOR=F5DEB3 align='center'>$n</td>\n".
                "  <td BGCOLOR=F5DEB3 align='center'>$row</td>\n".
                "  <td BGCOLOR=F5DEB3>$depart</td>\n".
                "  <td BGCOLOR=F5DEB3><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
					          "  <td BGCOLOR=F5DEB3>$user1</td>\n".
                "  <td BGCOLOR=F5DEB3>$date</td>\n".
				  "  <td BGCOLOR=F5DEB3>$where</td>\n".
				  "  <td BGCOLOR=F5DEB3><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
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
    $query = "SELECT  row,depart,head,datetime,programmer,date,user FROM com_support   WHERE status ='$num' ORDER BY row  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
        print"<div align='center' class='forntsarabun'>�ҹ�����ѧ���Թ�������</div>";
        print"<table class='forntsarabun'  align='center'>";
        print" <tr>";
		        print"  <th bgcolor=#009900>�ӴѺ</th>";
        print"  <th bgcolor=#009900>�ӴѺ��</th>";
        print"  <th bgcolor=#009900>Ἱ�</th>";
        print"  <th bgcolor=#009900>��Ǣ��</th>";
        print"  <th bgcolor=#009900>�ѹ�����ͧ��</th>";
		print"  <th bgcolor=#009900>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=#009900>�����</th>";
		print"  <th bgcolor=#009900>��÷ӧҹ</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user) = mysql_fetch_row ($result)) {
			$n++;
			$head=substr($head,0,40);
			if($_SESSION['smenucode']=='ADM'){$where="<a target=_TOP href=\"comsucces.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
			if($_SESSION['smenucode']=='ADM'){$add="<a target='_blank' href=\"comservice.php?row=$row&act=win\">�ѹ�֡</a>";} else {$add="�ѹ�֡";};
			
            print (" <tr>\n".
				      "  <td BGCOLOR=#00FF99 align='center'>$n</td>\n".
                "  <td BGCOLOR=#00FF99 align='center'>$row</td>\n".
                "  <td BGCOLOR=#00FF99>$depart</td>\n".
                "  <td BGCOLOR=#00FF99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#00FF99>$date</td>\n".
				  "  <td BGCOLOR=#00FF99>$where</td>\n".
				  "  <td BGCOLOR=#00FF99><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
				  "  <td BGCOLOR=#00FF99 align='center'>$add</td>\n".
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
	    print"<div align='center' class='forntsarabun'>�ҹ�����Թ�����������</div>";
        print"<table class='forntsarabun'  align='center'>";
        print" <tr>";
        print"  <th bgcolor=#0033FF>�ӴѺ��</th>";
        print"  <th bgcolor=#0033FF>Ἱ�</th>";
        print"  <th bgcolor=#0033FF>��Ǣ��</th>";
        print"  <th bgcolor=#0033FF>�ѹ���ҷ����ͧ��</th>";
		print"  <th bgcolor=#0033FF>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=#0033FF>��ô��ԡ��</th>";
		print"  <th bgcolor=#0033FF>�ѹ���ҷ����Թ���</th>";
		print"  <th bgcolor=#0033FF>�����</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$p_edit,$dateend) = mysql_fetch_row ($result)) {
			$head=substr($head,0,40);
            print (" <tr>\n".
                "  <td BGCOLOR=#00CCFF  align='center'>$row</td>\n".
                "  <td BGCOLOR=#00CCFF>$depart</td>\n".
                "  <td BGCOLOR=#00CCFF><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#00CCFF>$date</td>\n".
				"  <td BGCOLOR=#00CCFF>$programmer</td>\n".
				"  <td BGCOLOR=#00CCFF>$p_edit</td>\n".
				"  <td BGCOLOR=#00CCFF>$dateend</td>\n".
				"  <td BGCOLOR=#00CCFF><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
                " </tr>\n");
  				}
        print "</table>";
			}
 include("unconnect.inc");  
?>
