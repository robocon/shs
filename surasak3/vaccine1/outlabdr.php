<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php echo $_SESSION["dt_doctor"];?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
</head>
<?php include("dt_menu.php");
	echo "<BR>";
	$style_menu="2"; 
	include("dt_patient.php");
?>
<body>
<BR>
<TABLE  border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#0046D7">
<TR>
	<TD>
<TABLE width="800" border="0" align="center" cellpadding="0" cellspacing="2">
<TR align="center" class="tb_head">
	<TD>DATE</TD>
	<TD>DETAIL</TD>
	<TD>VIEW</TD>
</TR>
<?
	include("connect.inc"); 
	$query = "SELECT * FROM patdata as a ,  labcare  as b  WHERE  a.code=b.code and a.hn = '".$_SESSION["hn_now"]."' and a.depart='patho' and b.labtype !='IN'  Order by date desc";
    $result = mysql_query($query) or die("Query failed");
	while ($dbarr= mysql_fetch_array($result)) {
		
		$filename=$dbarr['row_id'].'.pdf';
		$filename1=$dbarr['row_id'].'.jpg';

if(file_exists("vaccine1/Lab_upload/dcorder/$filename")){		
		echo " <tr>
				 <td BGCOLOR=F5DEB3>$dbarr[date]</td>
				  <td BGCOLOR=F5DEB3>$dbarr[detail]</td>";
	    echo   "<td BGCOLOR=F5DEB3><a href=\"dcorder/$filename\" target='_blank'>¥Ÿ‰ø≈Ï</a></td>";
		
}elseif(file_exists("vaccine1/Lab_upload/dcorder/$filename1")){
		echo " <tr>
				 <td BGCOLOR=F5DEB3>$dbarr[date]</td>
				  <td BGCOLOR=F5DEB3>$dbarr[detail]</td>";
		  echo   "<td BGCOLOR=F5DEB3><a href=\"dcorder/$filename1\" target='_blank'>¥Ÿ‰ø≈Ï</a></td>";
}
echo "</tr>";
}
?>

</TABLE>
</TD>
</TR>
</TABLE>

<?php include("unconnect.inc");?>
</body>
</html>