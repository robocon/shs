<html>
<head>
<title>LOCK �ӹǹ��</title>
<link href="sm3_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script language="JavaScript">
	function onADD()
	{
		if(confirm('�س��ͧ��úѹ�֡������ ?')==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>

 <FORM name="form_search" METHOD='post'  ACTION=""  >
  <TABLE border="0" width="70%" align="center">
  <TR  bgcolor="#3366FF" class="font_title">
    <TD colspan="2" align="center" bgcolor="#3366FF">�кػ�������</TD>
  </TR>
  <TR >
    <TD  width="100" align="right">���͡�ä�� : </TD>
    <TD ><INPUT TYPE="text" NAME="tradname" value="<?php echo $_POST["tradname"];?>"></TD>
  </TR>
  <TR>
    <TD align="right">�������ѭ : </TD>
    <TD><INPUT TYPE="text" NAME="genname" value="<?php echo $_POST["genname"];?>"></TD>
  </TR>
  <TR>
    <TD align="right">������ : </TD>
    <TD>
      <SELECT NAME="part" class="fontsara1">
        <Option value="">���͡ �ҷ����� </Option>
        <Option value="DDL" <?php if($_POST["part"] == "DDL")echo " Selected ";?>>��㹺ѭ������ѡ��觪ҵ� �ԡ��  (DDL)</Option>
        <Option value="DDY" <?php if($_POST["part"] == "DDY")echo " Selected ";?>>�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��  (DDY)</Option>
        <Option value="DDN" <?php if($_POST["part"] == "DDN")echo " Selected ";?>>�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����� (DDN)</Option>
        </SELECT><input type="checkbox" name="original" id="original" value="original" <?php if($_POST["original"] == "original")echo " checked ";?>>
        Original 
        <input type="checkbox" name="pay" id="pay" value="Y" <?php if($_POST["pay"] == "Y")echo " checked ";?>>
        �������� 
        <input type="checkbox" name="statuspha" id="statuspha" value="Y" <?php if($_POST["statuspha"] == "Y")echo " checked ";?>>
��ҹ����</TD>
  </TR>
  <TR>
    <TD align="center" colspan="2"><INPUT TYPE="submit" value="��ŧ" name="submit_search" class="fontsara1"><A HREF="../nindex.htm" class="fontsara1">&lt;&lt; ����</A></TD>
  </TR>
  </TABLE>
</FORM>
<BR>
<hr>
<?
 include("connect.inc");

if(empty($_POST["submit_search"])){
	
	exit();
}else{

	
		if($_POST["tradname"] != ""){
		$where .= "AND tradname like '%".$_POST["tradname"]."%' ";
		}	
		if($_POST["genname"] != ""){
		$where .= " AND genname like '%".$_POST["genname"]."%' ";
		}
		if($_POST["part"] != ""){
		$where .= " AND part ='".$_POST["part"]."' ";
		}
		if($_POST["original"] != ""){
		$where .= " AND original  ='".$_POST["original"]."' ";
		}
		if($_POST["pay"] != ""){
		$where .= "AND pay  ='".$_POST["pay"]."' ";
		}
		if($_POST["statuspha"] != ""){
		$where .= "AND status_pha  ='".$_POST["statuspha"]."' ";
		}				
		if($_POST["part"] == "" && $_POST["tradname"]=="" && $_POST["genname"] == "" && $_POST["original"] == "" && $_POST["pay"] == "" && $_POST["statuspha"] == ""){
		$where .= "AND part in ('DDL','DDY','DDN') ";
	}

	
	$where = $where;

}




$strSQL = "SELECT * FROM  druglst  WHERE 1 $where order by drugcode asc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");

//echo $strSQL;

?>
<?php 
if($_POST["part"] == "DDL"){ $part ="��㹺ѭ������ѡ��觪ҵ� �ԡ��"; } 
if($_POST["part"] == "DDY"){ $part = "�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��"; } 
if($_POST["part"] == "DDN"){ $part = "�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����� "; } 
?>
<h1 align="center" class="fontsara1"><?=$part;?></h1>
<div align="center">
<form name="frmMain" action="drug_locknumadd.php" method="post" OnSubmit="return onADD();" target="_blank">
<table border="1" bordercolor="#000000" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
  <tr bgcolor="#ffff99" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
  <th > <div align="center"># </div></th>
    <th > <div align="center">���� </div></th>
     <th > <div align="center">���� </div></th>
      <th > <div align="center">���� </div></th>
    <th> <div align="center">����ѷ </div></th>
    <th> <div align="center">�ҤҢ�� </div></th>
     <th> <div align="center">�Ҥҷع </div></th>
     <th>�ҤҢ������</th>
    <th > <div align="center">˹��� </div></th>
    <th >������úѭ</th>
    <th >LIMIT PAY</th>
    <th >LIMIT PTRIGHT</th>
    <th > <div align="center">���� </div></th>
     <th > <div align="center">���� </div></th>
      <th > <div align="center">���� </div></th>
  </tr>
<?
$i=1;
while($objResult = mysql_fetch_array($objQuery))
{
	
	//$newsale=$objResult["unitpri"];
	
	if($objResult["unitpri"] >=0.01 && $objResult["unitpri"] <=0.20){
		$nSalepri =0.5;
	}elseif ($objResult["unitpri"] >=0.21 && $objResult["unitpri"] <=0.50){
		$nSalepri =1.00;
	}elseif ($objResult["unitpri"] >=0.51 && $objResult["unitpri"] <=1.00){
		$nSalepri =1.50;
	}elseif ($objResult["unitpri"] >=1.01 && $objResult["unitpri"] <=10.00){
		$nSalepri =($objResult["unitpri"]*200)/100;
	}elseif ($objResult["unitpri"] >=10.01 && $objResult["unitpri"] <=100.00){
		$nSalepri =($objResult["unitpri"]*175)/100;
	}elseif ($objResult["unitpri"] >=100.01 && $objResult["unitpri"] <=1000.00){
		$nSalepri =($objResult["unitpri"]*150)/100;
	}elseif ($objResult["unitpri"] >=1000.01 && $objResult["unitpri"] <=5000.00){
		$nSalepri =($objResult["unitpri"]*125)/100;
	}elseif ($objResult["unitpri"] >5000.00){
		$nSalepri =($objResult["unitpri"]*110)/100;
	}
		//$nSalepri =round($nSalepri);
		
?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''"> 
    <td align="center"><?=$i;?></td>
    <td><?=$objResult["drugcode"];?></td>
      <td><?=$objResult["tradname"];?></td>
        <td><?=$objResult["genname"];?></td>
    <td>(<?=$objResult["comcode"];?>)<?=$objResult["comname"];?></td>  
    <td align="right"><?=number_format($objResult["salepri"],2);?></td>
    <td align="right"><?=number_format($objResult["unitpri"],2);?></td>
    <td align="right"><?=number_format($nSalepri,2);?></td>
    <td align="center" ><?=$objResult["unit"];?></td>
    <td align="center" ><?=$objResult["bcode"];?></td>
   <td align="right" >
	<input type="hidden" name="row_id<?=$i;?>"  value="<?=$objResult["row_id"];?>">
   <input type="hidden" name="max"  value="<?=$i;?>">   
   <input name="limit_pay<?=$i;?>" type="text" class="fontsara1" value="<?=$objResult["limit_pay"];?>" size="8" style="text-align:right;padding-right:2px;"></td>
    <td align="right" ><input name="limit_ptright<?=$i;?>" type="text" class="fontsara1" value="<?=$objResult["limit_ptright"];?>" size="8" style="text-align:right;padding-right:2px;"></td>
    <td><?=$objResult["drugcode"];?></td>
      <td><?=$objResult["tradname"];?></td>
        <td><?=$objResult["genname"];?></td>
  </tr>
  
<?
$i++;
}
?>
</table>

<input type="submit" name="btnAdd" value=" �ѹ�֡��������" class="fontsara1">
</form>
</div>



</body>
</html>