<?php
session_start();
include("connect.inc");

?>
<style type="text/css">
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
body {
	background-color: #FFFFFF;
}
</style>
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>��Ѻ˹��������ѡ</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_add.php'><font size='4' class='forntsarabun'>�駫���/��Ѻ��ا�����</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>��§ҹ��Ш���͹</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>��§ҹ�š�÷ӧҹ</font></a>";
print "<hr>";

if($_SESSION['supportMessage'])
{
    ?><div style="border: 2px solid #bdbd00;background-color: #fdfd8c;padding: 4px;text-align:center;"><?=$_SESSION['supportMessage'];?></div><?php
    $_SESSION['supportMessage'] = NULL;
}

print"<br><div align='center' class='forntsarabun'><strong>�к��ѹ�֡����駫����ػ�ó���������� ��оѲ�һ�Ѻ��ا�������к��ç��Һ��<BR>�ٹ���ԡ�ä��������� �ç��Һ�Ť�������ѡ��������</strong></div><BR>";
    print"<div align='center'><font class='forntsarabun'>�Թ�յ�͹�Ѻ �س <strong>$sOfficer</strong> �������к�</font></div>";
    echo "<div align='center'><font size='1' class='forntsarabun'><b>���˹�ҷ������������....</b>�.�. ��Թ  ������ ��й�¡�ɳ��ѡ���  �ѹ���<b>....��. 8500</b></font></div>";
	echo "<div align='center'><font size='1' class='forntsarabun'><b>���˹�ҷ���ҧ����������....</b>��¨ѡþѹ��  ������ͧ��� ��й�°ҹ�Ѳ��  ��Ť�<b>....��. 6203</b></font></div><br>";
$Thaidate=date("d-m-").(date("Y")+543);
$n =0;
$num = "Y";

// �ҹ��ҧ����ѧ������Ѻ�Դ�ͺ
$query = "SELECT row,depart,head,datetime,programmer,date,user1 
FROM com_support 
WHERE status ='$num' 
ORDER BY row desc";
$result = mysql_query($query) or die("Query failed111");
if($num1=mysql_num_rows($result)){
    print"<div align='center' class='forntsarabun'><strong>�ҹ����������������к� �ӹǹ $num1 ��¡��</strong></div>";
    print"<table class='forntsarabun'  align='center' width='98%'>";
    print" <tr>";
    print"  <th bgcolor=#FF0033>�ӴѺ��</th>";
    print"  <th bgcolor=#FF0033>Ἱ�</th>";
    print"  <th bgcolor=#FF0033>��Ǣ��</th>";
    print"  <th bgcolor=#FF0033>�������ͧ��</th>";
    print"  <th bgcolor=#FF0033>�ѹ�����ͧ��</th>";
    print"  <th bgcolor=#FF0033>����Ѻ�Դ�ͺ</th>";
    print"  <th bgcolor=#FF0033>�����</th>";
    print" </tr>";
    while (list ($row,$depart,$head,$datetime,$programmer,$date,$user1) = mysql_fetch_row ($result)) {
        $n++;

        $programmer = ( !empty($programmer) ) ? $programmer : '�͡�õͺ�Ѻ' ;

        if($_SESSION['smenucode']=='ADM' || $_SESSION['smenucode']=='ADMCOM'){
            $where="<a target=_TOP href=\"com_edit.php?row=$row\">$programmer</a>";
        } else {
            $where="$programmer";
        }
	
        print (" <tr>\n".
        "  <td BGCOLOR=#FF8080 align='center'>$row</td>\n".
        "  <td BGCOLOR=#FF8080>$depart</td>\n".
        "  <td BGCOLOR=#FF8080><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
        "  <td BGCOLOR=#FF8080>$user1</td>\n".
        "  <td BGCOLOR=#FF8080>$date</td>\n".
        "  <td BGCOLOR=#FF8080>$where</td>\n".
        "  <td BGCOLOR=#FF8080><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
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
$query = "SELECT  row,depart,head,datetime,programmer,date,user 
FROM com_support 
WHERE status ='$num' 
ORDER BY programmer asc, row desc";
$result = mysql_query($query) or die("Query failed111");

   if($num2=mysql_num_rows($result)){
        print"<div align='center' class='forntsarabun'><strong>�ҹ�����ѧ���Թ��� �ӹǹ $num2 ��¡��</strong></div>";
        print"<table class='forntsarabun'  align='center' width='98%'>";
        print" <tr>";
        print"  <th bgcolor=#FFCC00>�ӴѺ��</th>";
        print"  <th bgcolor=#FFCC00>Ἱ�</th>";
        print"  <th bgcolor=#FFCC00>��Ǣ��</th>";
        print"  <th bgcolor=#FFCC00>�ѹ�����ͧ��</th>";
		print"  <th bgcolor=#FFCC00>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=#FFCC00>�����</th>";
		//print"  <th bgcolor=#FFCC00>��÷ӧҹ</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user) = mysql_fetch_row ($result)) {
			$n++;
			if($_SESSION['smenucode']=='ADM' || $_SESSION['smenucode']=='ADMCOM'){$where="<a target=_TOP href=\"comsucces.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
			if($_SESSION['smenucode']=='ADM'){$add="<a target='_blank' href=\"comservice.php?row=$row&act=win\">�ѹ�֡</a>";} else {$add="�ѹ�֡";};
			
            print (" <tr>\n".
                "  <td BGCOLOR=#FFFF99 align='center'>$row</td>\n".
                "  <td BGCOLOR=#FFFF99>$depart</td>\n".
                "  <td BGCOLOR=#FFFF99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#FFFF99>$date</td>\n".
				  "  <td BGCOLOR=#FFFF99>$where</td>\n".
				  "  <td BGCOLOR=#FFFF99><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
				 // "  <td BGCOLOR=#FFFF99 align='center'>$add</td>\n".
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
$query = "SELECT row,depart,head,datetime,programmer,date,p_edit,dateend 
FROM com_support 
WHERE status ='$num' 
ORDER BY dateend desc, programmer asc";
$result = mysql_query($query) or die("Query failed111");

   if($num3=mysql_num_rows($result)){
	    print"<div align='center' class='forntsarabun'><strong>�ҹ�����Թ����������� �ӹǹ $num3 ��¡��</strong></div>";
        print"<table class='forntsarabun'  align='center' width='98%'>";
        print" <tr>";
        print"  <th bgcolor=#339966>�ӴѺ��</th>";
        print"  <th bgcolor=#339966>Ἱ�</th>";
        print"  <th bgcolor=#339966>��Ǣ��</th>";
        print"  <th bgcolor=#339966>�ѹ���ҷ����ͧ��</th>";
		print"  <th bgcolor=#339966>����Ѻ�Դ�ͺ</th>";
		print"  <th bgcolor=#339966>��ô��ԡ��</th>";
		print"  <th bgcolor=#339966>�ѹ���ҷ����Թ���</th>";
		print"  <th bgcolor=#339966>�����</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$p_edit,$dateend) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=#33CC99  align='center'>$row</td>\n".
                "  <td BGCOLOR=#33CC99>$depart</td>\n".
                "  <td BGCOLOR=#33CC99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#33CC99>$date</td>\n".
				"  <td BGCOLOR=#33CC99>$programmer</td>\n".
				"  <td BGCOLOR=#33CC99>$p_edit</td>\n".
				"  <td BGCOLOR=#33CC99>$dateend</td>\n".
				"  <td BGCOLOR=#33CC99><a target='_blank' href=\"com_form.php?row=$row\">�����</a></td>\n".
                " </tr>\n");
  				}
        print "</table>";
			}
 include("unconnect.inc");  
?>