<?php
    session_start();
    echo "$cTitle";
?>
<BR>
�������Ѷ���Ἱ���� : 

<SELECT NAME="dp" Onchange="window.location.href='codehlp.php?dp='+this.value;">
	<Option value="OTHER">�����</Option>
	<Option value="WARD" <?if(isset($_GET["dp"]) && $_GET["dp"] == "WARD") echo " Selected ";?>>WARD</Option>
	<Option value="PATHO" <?if(isset($_GET["dp"]) && $_GET["dp"] == "PATHO") echo " Selected ";?>>��ͧ LAB</Option>
	<Option value="EMER" <?if(isset($_GET["dp"]) && $_GET["dp"] == "EMER") echo " Selected ";?>>��ͧ�ء�Թ</Option>
	<Option value="XRAY" <?if(isset($_GET["dp"]) && $_GET["dp"] == "XRAY") echo " Selected ";?>>X-RAY</Option>
	<Option value="SURG" <?if(isset($_GET["dp"]) && $_GET["dp"] == "SURG") echo " Selected ";?>>��ͧ��ҵѴ</Option>
	<Option value="DENTA" <?if(isset($_GET["dp"]) && $_GET["dp"] == "DENTA") echo " Selected ";?>>��ͧ�ѹ</Option>
</SELECT>

<table>
 <tr>
  <th bgcolor=CC9900>����</th>
  <th bgcolor=CC9900>��¡��</th>
  <th bgcolor=CC9900>�Ҥ�</th>
    <th bgcolor=CC9900>�ԡ�����</th>
 </tr>
<?php
    include("connect.inc");

	if(isset($_GET["dp"])){
		$dpt = $_GET["dp"];
	}else{
		$dpt = $cDepart;
	}

    $query = "SELECT code,detail,price,depart,nprice FROM labcare WHERE depart = '".$dpt."' ORDER BY code ASC ";

    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code, $detail, $price,$depart,$nprice) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><a target='left'  href=\"labpaste.php? vCode=$code\">$code</a></td>\n".
           "  <td BGCOLOR=99CCFF>$detail</td>\n".
           "  <td BGCOLOR=99CCFF>$price</td>\n".
			       "  <td BGCOLOR=99CCFF>$nprice</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>


