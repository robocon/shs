<?php 
session_start();
include("connect.inc");
	$sqlr = "Select an,hn,ptname, age, ptright,bedcode From ipcard where an = '".$_GET['an']."' limit 1";
	$resultr = mysql_query($sqlr);
	$rep = mysql_fetch_array($resultr);
?>

<TABLE width="900">
  <TR>
    <TD colspan="8" class="tb_head">�����ż�����</TD>
  </TR>
  <TR>
    <TD align="right" class="tb_detail">AN : </TD>
    <TD><?php echo $rep['an'];?></TD>
    <TD align="right" class="tb_detail">����-ʡ�� : </TD>
    <TD><?php echo $rep['ptname'];?></TD>
    <TD align="right" class="tb_detail">���� : </TD>
    <TD><?php echo $rep['age'];?></TD>
    <TD align="right" class="tb_detail">�Է�ԡ���ѡ�� : </TD>
    <TD><?php echo $rep['ptright'];?></TD>
  </TR>
</TABLE>
<br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />

<style type="text/css">
<!--
.normal {
	font-family: "Angsana New";
	font-size: 20px;
}
.normal1 {
	font-family: "Angsana New";
	font-size: 22px;
}
.normal2 {
	font-family: "Angsana New";
	font-size: 18px;
}
.small {
	font-family: "Angsana New";
	font-size: 16px;
}
body,td,th {
	font-family: "Angsana New";
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
</head>

<body>

<?
if(!isset($_GET['show'])){
		$i=0;
		$sql3 = "SELECT distinct(profilecode) FROM resulthead WHERE hn ='".$_GET['hn_now']."' "; //�µ�Ǩ�����Һ�ҧ
		$resulthead = mysql_query($sql3);
		echo "<table border='1' width='90%' bgcolor='#DEFEE3' align='center'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr class='normal1'><td align='center'>LAB<hr></td><td align='center'>���駷��1<hr></td><td align='center'>���駷��2<hr></td><td align='center'>���駷��3<hr></td><td align='center'>���駷��4<hr></td><td align='center'>���駷��5<hr></td></tr><tr>";
		while($arrhead = mysql_fetch_array($resulthead)){
				$sql4 = "SELECT autonumber,orderdate FROM resulthead WHERE hn ='".$_GET['hn_now']."' and profilecode = '".$arrhead['profilecode']."' order by orderdate desc limit 5"; //����Ţ autonumber �ҡ����µ�Ǩ�͡��
				$resulthead4 = mysql_query($sql4);
				echo "<td align='center'><span class='normal'><strong><u><a target='_blank' href='comparelab_in.php?show=".$arrhead['profilecode']."&an=".$_GET['an']."&hn_now=".$_GET['hn_now']."'>".$arrhead['profilecode']."</a><u></strong></span></td>";
				while($arrhead4 = mysql_fetch_array($resulthead4)){
					$sql5 = "SELECT * FROM resultdetail where autonumber ='".$arrhead4['autonumber']."'"; //�֧�����ʴ��ҡ�Ţ autonumber
					$resulthead5 = mysql_query($sql5);
					while($arrhead5 = mysql_fetch_array($resulthead5)){
						$numhead5 = mysql_num_rows($resulthead5);
						if($numhead5=="1"){
							echo "<td align='center'><span class='normal'><strong>".$arrhead5['result']."</strong></span><br><span class='small'>(".substr($arrhead4['orderdate'],8,2)."-".substr($arrhead4['orderdate'],5,2)."-".substr($arrhead4['orderdate'],0,4).")</span><hr></td>";
						}else{
							echo "</tr><td align='center'><span class='normal2'>".$arrhead5['labcode']."</span></td>";
							echo "<td align='center'><span class='normal'><strong>".$arrhead5['result']."</strong></span><br><span class='small'>(".substr($arrhead4['orderdate'],8,2)."-".substr($arrhead4['orderdate'],5,2)."-".substr($arrhead4['orderdate'],0,4).")</span><hr></td></tr><tr>";
						}
					}
				}
				echo "</tr>";
		}
		echo "</table></td></tr></table>";
}else{
	echo "<table><tr>";
	$sql7 = "SELECT autonumber,orderdate FROM resulthead WHERE hn ='".$_GET['hn_now']."' and profilecode = '".$_GET['show']."' order by orderdate desc";
	$resulthead7 = mysql_query($sql7);
	while($arrhead7 = mysql_fetch_array($resulthead7)){
		$nrow++;
		echo "<td align='center'>���駷�� $nrow</td>";
	}
	echo "</tr><tr>";
	$resulthead7 = mysql_query($sql7);
	while($arrhead7 = mysql_fetch_array($resulthead7)){
		$sql8 = "SELECT * FROM resultdetail where autonumber ='".$arrhead7['autonumber']."'";
		$resulthead8 = mysql_query($sql8);
			while($arrhead8 = mysql_fetch_array($resulthead8)){
				echo "<td align='center'><span class='normal'><strong>".$arrhead8['result']."</strong></span><br><span class='small'>(".substr($arrhead7['orderdate'],8,2)."-".substr($arrhead7['orderdate'],5,2)."-".substr($arrhead7['orderdate'],0,4).")</span><hr></td>";
			}
	}
	echo "</tr></table>";
}
	?>
</body>
</html>
<?php include("unconnect.inc");?>