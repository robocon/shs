<?
session_start();
include("connect.inc");
if(!empty($_GET["an"])){
	$sql = "Select an, hn, ptname, bedcode, ptright, doctor From bed where an = '".$_GET["an"]."' limit 0,1 ";
}else{
	$sql = "Select an, hn, ptname, bedcode, ptright, doctor From bed where an = '".$_POST["an"]."' limit 0,1 ";
}
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	Mysql_free_result($result);
	
if($_POST["act"]=="add"){
$Thidate = (date("Y")+543).date("-m-d H:i:s");
	$add="INSERT INTO dgprofile(date,an,tradname,unit,salepri,freepri,amount,price,slcode,part,statcon,onoff,dateoff,officer ) VALUES ('".$Thidate."','".$_POST["an"]."','".$_POST["drugname"]."','".$_POST["unit"]."','".$_POST["salepri"]."','".$_POST["freepri"]."', '".$_POST["amount"]."','".$_POST["price"]."','".$_POST["drugslip"]."','".$_POST["part"]."','".$_POST["statcon"]."','".$_POST["onoff"]."','','".$_SESSION["sOfficer"]."')";
	if(mysql_query($add)){
		echo "<script>alert('�ѹ�֡������ͧ AN : $_POST[an] ���º��������');window.location='add_drugold.php?an=$_POST[an]';</script>";
	}else{
		echo "<script>alert('�Դ��Ҵ �������ö������������');window.location='add_drugold.php?an=$_POST[an]';</script>";
	}
}	
?>
<TABLE width="100%" align="center">
<TR bgcolor="#3300FF">
	<TD align="center" colspan="6"><FONT COLOR="#FFFFFF"><B>��������´������</B></FONT></TD>
</TR>
<TR>
	<TD align="right">AN : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["an"];?></TD>
	<TD align="right">HN : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["hn"];?></TD>
	<TD align="right">����-ʡ�� : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["ptname"];?></TD>
</TR>
<TR>
	<TD align="right">�ͼ����� : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $build[substr($arr["bedcode"],0,2)];?></TD>
	<TD align="right">�Է��� : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["ptright"];?></TD>
	<TD align="right">ᾷ�� : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["doctor"];?></TD>
</TR>
</TABLE>
<br><br>
<form name="form1" method="post" action="add_drugold.php">
<input name="act" type="hidden" value="add">
<input name="an" type="hidden" value="<?php echo $arr["an"];?>">
<input name="salepri" type="hidden" value="0">
<input name="freepri" type="hidden" value="0">
<input name="price" type="hidden" value="0">
<input name="onoff" type="hidden" value="ON">
  <TABLE width="587" align="center">
    <TR>
      <TD>������ : </TD>
      <TD><INPUT TYPE="text" ID = "drugname" NAME="drugname"  size="20"></TD>
      <TD>�Ը��� : </TD>
      <TD><INPUT TYPE="text" ID = "drugslip" NAME="drugslip" size="10"></TD>
      <TD>�ӹǹ : </TD>
      <TD><INPUT NAME="amount" TYPE="text" ID="amount" value="0" size="4">
          <BR></TD>
    </TR>
    <TR>
      <TD>˹��� : </TD>
      <TD><INPUT NAME="unit" TYPE="text" ID="unit"  size="5"></TD>
      <TD>������: </TD>
      <TD><INPUT TYPE="text" ID="part" NAME="part"  size="5"></TD>
      <TD>ʶҹ� : </TD>
      <TD><select id="statcon" name="statcon">
        <option value="OLDEX">������͡�ç��Һ��</option>
                  </select></TD>
    </TR>
    <TR>
      <TD colspan="6" align="center">&nbsp;</TD>
    </TR>
    <TR>
      <TD colspan="6" align="center"><INPUT ID="submit" TYPE="submit" VALUE=" ��ŧ "></TD>
    </TR>
  </TABLE>
</form>
<p>&nbsp;</p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">
  <tr>
    <td width="30%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="18%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="18%" align="center" bgcolor="#66CC99"><strong>�Ը���</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>ʶҹ�</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>˹���</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>�ӹǹ</strong></td>
  </tr>
<?
$y=date("Y")+543;
$m=date("m");
$d=date("d");
$chkdate="$y-$m-$d";
$sql1="select * from dgprofile where date like '$chkdate%' and an='".$_GET["an"]."' and statcon='OLDEX'";
$query=mysql_query($sql1);
$num=mysql_num_rows($query);
if($num < 1){
	echo "<tr><td align='center' colspan='6' style='color:red;'>!!!--------------------- �ѧ���������������������ͧ�ѹ��� --------------------!!!</td></tr>";
}
while($rows=mysql_fetch_array($query)){
?>  
  <tr>
    <td bgcolor="#FFFFCC"><?=$rows["tradname"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["part"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["slcode"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["statcon"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["unit"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["amount"];?></td>
  </tr>
<?
}
?>  
</table>
<p>&nbsp;</p>
