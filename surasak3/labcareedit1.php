<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php

    print "��¡���ѵ������ͧ LAB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a>&nbsp;&nbsp;&nbsp;<a target=_self  href='lab_add.php'>������������¡�� LAB</a><br><br>";
    include("connect.inc");
	print "<form name='f1' method='post' action=''>";
	 print "<table>";
    print "<tr>";
	print "<td>";
	print "ʶҹ�";
	print "</td>";
	print "<td>";
	
	print "<select name='status'>";
	print "<option value=''>�ʴ�������</option> ";
	print "<option value='Y'>Y (�Դ�����ҹ)</option> ";
	print "<option value='N'>N (�Դ�����ҹ)</option> ";
	print "<option value='C'>੾�� Chkup</option> ";
	print "</select>";
	print "<input type='submit' name='b1' value='��ŧ'>";
	
	print "</td>";
	print "</tr>";
	print "</table>";
	print "</form>";
	
if($_POST['status']=="Y"){
	$where="AND labstatus='Y' ";	
	$show="Y (�Դ�����ҹ)";
}else if($_POST['status']=="N"){
	$where="AND labstatus='N' ";	
	$show="N (�Դ�����ҹ)";
}else if($_POST['status']=="C"){
	$where="AND chkup<>'' ";
	$show="੾�� Chkup";	
}else{
	$where='';
	$show="������";	
}

    //$query = "SELECT  row_id,code,codex,detail,price,yprice,nprice,lablis,codex,depart,codelab,outlab_name,labpart,labtype,labstatus,chkup,reportlabno FROM labcare WHERE depart like '%patho%' and code not like '%@%' ".$where."  order by row_id desc ";
	//echo $query;
    $query = "SELECT  row_id,code,codex,detail,price,yprice,nprice,lablis,codex,depart,codelab,outlab_name,labpart,labtype,labstatus,chkup,reportlabno FROM labcare WHERE depart like '%patho%' ".$where."  order by row_id desc ";
	
    $result = mysql_query($query) or die("Query failed");
	$num = mysql_num_rows($result);
	
	echo "<div>������ $show �ӹǹ $num ��¡��</div>";	
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>���ʤԴ�Թ</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>���ʡ���ѭ�ա�ҧ</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>���� Sticker</b></th>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>��¡��</b></th>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>Ἱ�</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>�Ҥ����</b></th>";
 	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>�Ҥ��ԡ��</b></th>";
 	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>�Ҥ��ԡ�����</b></th>";
 	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>code LAB</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>chkup</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>report Labno.</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>Part</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>����ѷ</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>������</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>ʶҹ�</b></th>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>���</b></th>";
 // print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>........</b></th>";
//    print " <th bgcolor=CD853F><font face='TH SarabunPSK'><b>ź��¡��</b></th>";
    print "</tr>";
	
    while (list ($rowid,$code,$codex,$detail,$price,$yprice,$nprice,$lablis,$codex,$depart,$codelab,$outlab_name,$labpart,$labtype,$labstatus,$chkup,$reportlabno) = mysql_fetch_row ($result)) {

		if($price<=1){$color='#FF6699';}else{$color='F5DEB3';};
        print ("<tr>\n".
           "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$code</td>\n".
		    "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$codex</td>\n".
			"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$codelab</td>\n".
           "  <td BGCOLOR=$color><font face='TH SarabunPSK'><B>$detail</B></td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$depart</td>\n".
           "  <td BGCOLOR=$color><font face='TH SarabunPSK'><B><a target=_BLANK href=\"labedit.php? code=$code\">$price</B></a></td>\n".
  		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$yprice</td>\n".
      	   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$nprice</td>\n".
		 /*  "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$lablis</td>\n".*/
		"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$codelab</td>\n".
					"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$chkup</td>\n".
					"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$reportlabno</td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$labpart</td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$outlab_name</td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$labtype</td>\n".
		  "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$labstatus</td>\n".
		 "  <td BGCOLOR=$color><font face='TH SarabunPSK'><a href='labcareeditrow.php?rowid=$rowid' target=blank>���</a></td>\n".
       
     //   "  <td BGCOLOR=F5DEB3><font face='TH SarabunPSK'></td>\n".
  //   "  <td bgcolor=F5DEB3><font face='TH SarabunPSK'><a target=_BLANK href=\"lebdele.php? code=$code\">ź</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

