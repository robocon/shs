<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
-->
</style></head>
<? include("../connect.inc"); ?>
<body>
<form id="form1" name="form1" method="post" action="report_chkopd.php">
<input name="act" type="hidden" value="search" />
  <table width="100%" border="0">
    <tr>
      <td width="30%">�ӹǹ�Ո : 
        <input type="text" name="numdate" id="numdate" value="" />
        ����������Ѻ��ԡ�Ú� : 
       <select name="type" id="type">
           <option value="0">��Ǩ�����</option>
           <option value="1">��Ѥè��µç</option>
           <option value="2">��Ǩ�آ�Ҿ</option>
           <option value="3">�͡�����Ҫ���</option>
           <option value="4">�ء�Թ</option>
         </select>
         <input type="submit" name="button" id="button" value="���Ң�����" />
		</td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="search"){
	if($_POST["numdate"]==""){
	echo "<script>alert('�ѧ������кبӹǹ��');window.location='report_chkopd.php;</script>";		
	}
/*	}else if($_POST["numdate"]=="1"){
	$sql="select hn from opday where ";
	}else if($_POST["numdate"]=="2"){
	
	}else if($_POST["numdate"]=="3"){
	
	}else{
		echo "<script>alert('�кػ���͹��ѧ���٧�ش 3 ����ҹ��');window.location='report_chkopd.php;</script>";		
	}*/
	
$numdate = trim($_POST["numdate"]);
$stringlastyear=mktime(0,0,0,date("m"),date("d"),date("y")-$numdate);
$datelastyear=(date("Y",$stringlastyear)+543).date("-m-d H:i:s",$stringlastyear);


if($_POST["type"]=="0"){
	$type ="EX01";  //�ѡ���ä�����������Ҫ���
	$typename ="�ѡ���ä�����������Ҫ���";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="1"){
	$type ="EX03";  //��Ѥ��ç��è��µç
	$typename ="��Ѥ��ç��è��µç";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="2"){
	$type ="EX16";  // ��Ǩ�آ�Ҿ
	$typename ="��Ǩ�آ�Ҿ";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="3"){
	$type ="EX11";  //�ѡ���ä�͡�����Ҫ���
	$typename ="�ѡ���ä�͡�����Ҫ���";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="4"){
	$type ="EX02";  // �����©ء�Թ
	$typename ="�����©ء�Թ";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}

//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
//echo "--->".$num;
?>
<p>�ӹǹ�����·������Ѻ����ѡ����ç��Һ�� <? echo "����� $typename �������� $numdate ����͹��ѧ �շ����� $num ���";?></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><strong>�ӴѺ</strong></td>
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>����-���ʡ��</strong></td>
    <td align="center"><strong>�ѹ���������ش</strong></td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td width="7%" align="center"><?=$i;?></td>
    <td width="21%"><?=$rows["hn"];?></td>
    <td width="35%"><?=$rows["ptname"];?></td>
    <td width="37%"><?=$rows["lastupdate"];?></td>
  </tr>
<?
}
?>  
</table>
<?
}
?>
</body>
</html>
