<?php
session_start();
include("connect.inc");
?>
<a target=_self  href='bmdhn.php'><<��Ѻ</a>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>
<?
function calcage($birth){
		$today = getdate();   
		$nY  = $today['year']; 
		$nM = $today['mon'] ;
		$bY=substr($birth,0,4)-543;
		$bM=substr($birth,5,2);
		$ageY=$nY-$bY;
		$ageM=$nM-$bM;
	
		if ($ageM<0) {
			$ageY=$ageY-1;
			$ageM=12+$ageM;
		}
	
		if ($ageM==0){
			$pAge="$ageY ��";
		}else{
			$pAge="$ageY �� $ageM ��͹";
		}
	
	return $pAge;
}
if(!isset($_POST['ch1'])){
	?>
	<script>
    	alert("��س����͡��¡�õ�Ǩ��͹��");
		window.history.back();
    </script>
	<?
}
$sql = "Select * From dorderbmd where idno= '".$_POST['ch1']."' limit 1";
$result = mysql_query($sql);
$arr = mysql_fetch_array($result);

$sql2 = "Select * From opday where thdatehn = '".date("d-m-").(date("Y")+543).$arr['hn']."' ";
$result2 = mysql_query($sql2);
$arr2 = mysql_fetch_array($result2);

$sql3 = "Select * From inputm where name= '".$arr['doctor']."' ";
$result3 = mysql_query($sql3);
$arr3 = mysql_fetch_array($result3);

?>
<table  border="0">
  <tr>
    <td>�����¹͡</td>
  </tr>
  <tr>
     <td>HN :<?=$arr['hn']?></td>
  </tr>
  <tr>
    <td>VN :<?=$arr2['vn']?></td>
    </tr>
  <tr>
   <td><?=$arr['ptname']?></td>
    </tr>
  <tr>
    <td><font color='#FF0000' style='font-size:18px'>����: <?=$arr['age']?></font></td>
    </tr>
  <tr>
    <td bgcolor="#CCCC99"><font face="Angsana New" style="font-size:20px" ><u><strong>��¡�õ�Ǩ</strong></u><br>
#
    <?=$arr['detail']?>
�ӹǹ 1 ��¡�� �Ҥ�
<?=$arr['price']?>
�ҷ<strong> �ԡ�����
<?=$arr['sumnprice']?>
�ҷ</strong></font></td>
  </tr>
</table>
<form method="POST" action="bmdxray.php" onSubmit="return check();">
  <p><font face="Angsana New"><br>

&nbsp;&nbsp;&#3650;&#3619;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;
  <select size="1" name="diag" id="aLink">
    <option value="��Ǩ�����������͡���ѡ��" <? if($arr['sumyprice']>0) echo "selected";?>>��Ǩ�����������͡���ѡ��</option>
    <option value="��Ǩ�آ�Ҿ" <? if($arr['sumnprice']>0) echo "selected";?>>��Ǩ�آ�Ҿ</option>
  </select>&nbsp;</font></p>
<font face="Angsana New">&nbsp;&nbsp;�Է��&nbsp;&nbsp;&nbsp;
<select name="pt" id="pt">
  <?
  	$sqlpt = "select * from ptright where status = 'a' order by code asc";
   $rowpt = mysql_query($sqlpt);
   while($resultpt = mysql_fetch_array($rowpt)){
	$re = $resultpt[0]."�".$resultpt[1];
	//R01��Թʴ
		if($cPtright==$re){
			 $c=0;
			 ?>
              	<option value="<?=$cPtright?>" selected="selected"><?=$cPtright?></option>
             <?
		}
		else{
			$b=0;
			?>
  				<option value="<?=$re?>"><?=$re?></option>
  			<?
		}
	}
	if(!isset($c)){
		?>
  			<option value="<?=$cPtright?>" selected="selected"><?=$cPtright?></option>
  		<?
	}
   ?>
</select></font>
  <p><font face="Angsana New" >&nbsp;&nbsp;</font><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;&nbsp;
 
  <?php
   include("connect.inc");
   $month = array("","���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
  
   ////////////////////////////////////
$strSQL = "SELECT name,doctorcode FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<?
  	while($objResult = mysql_fetch_array($objQuery)) {
	?>
<option value="<?=$objResult["name"]?>" <? if($arr3['codedoctor']==$objResult["doctorcode"]) echo "selected";?>><?=$objResult["name"]?></option>
 	<?
	}
?>
</select>

	
 
 </font> <br>
 <br>
<input type="hidden" name="idno" value="<?=$_POST['ch1']?>">
   <input type="checkbox" name="payout" id="payout"> 
   �Դ��Һ�ԡ�ù͡�����Ҫ���

  200 �ҷ</p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1"></font></p>
</form>

<!--<TABLE border="3" bordercolor="#FFFFFF" style='BORDER-COLLAPSE: collapse' width="100%" >
<TR  bgcolor="#3366FF" class="font_title">
	<TD align="center" >No.</TD>
	<TD align="center" >�ѹ������</TD>
	<TD align="center" >HN</TD>
	<TD align="center" >���� - ʡ��</TD>
	<TD align="center" >ᾷ�������</TD>
	<TD align="center" >�ԡ��</TD>
	<TD align="center" >�ԡ�����</TD>
	<TD align="center" >������Ҫ���</TD>
	<TD align="center" >�͡�����Ҫ���</TD>
</TR>
<?php
	/*$i=1;
	$Thidate = (date("Y")+543).date("-m-d");
	$sql = "Select * From dorderbmd where hn= '".$_SESSION['cHn']."' order by thidate desc";
	$result = mysql_query($sql);
	while($arr = mysql_fetch_array($result)){

		if($i % 2 == 0){
			$bgcolor="#FFFFFF";
		}else{
			$bgcolor="#BFFFBF";
		}
		
		echo "<TR bgcolor=\"",$bgcolor,"\">";
		echo "<TD align=\"center\" >",$i,"</TD>";
		echo "<TD align=\"center\" >".substr($arr["thidate"],8,2)."-".substr($arr["thidate"],5,2)."-".substr($arr["thidate"],0,4)." ".substr($arr["thidate"],11)."</TD>";
		echo "<TD align=\"center\" >",$arr["hn"],"</TD>";
		echo "<TD align=\"center\" >",$arr["ptname"],"</TD>";
		echo "<TD align=\"center\" >",$arr["doctor"],"</TD>";
		echo "<TD align=\"center\" >",$arr["sumyprice"],"</TD>";
		echo "<TD align=\"center\" >",$arr["sumnprice"],"</TD>";
		if($arr["status"]=="Y"){
			echo "<TD align=\"center\" >�����¡��</TD>";
		}else{
			echo "<TD align=\"center\" ><A target='_blank' HREF=\"bmdxray.php?idno=".$arr["idno"]."&tvn=".$_SESSION['tvn']."&yprice=".$arr["sumyprice"]."\" onclick=\"return confirm('�׹�ѹ��äԴ����������¡�÷�� $i?');\">�����¡��</A></TD>";
		}
		if($arr["status"]=="Y"){
			echo "<TD align=\"center\" >�����¡��</TD>";
		}else{
			echo "<TD align=\"center\" ><A target='_blank' HREF=\"bmdxray.php?idno=".$arr["idno"]."&tvn=".$_SESSION['tvn']."&yprice=".$arr["sumyprice"]."&out=300\" onclick=\"return confirm('�׹�ѹ��äԴ����������¡�÷�� $i?');\">�����¡��</A></TD>";
		}
		echo "</TR>";
		echo "<TR bgcolor=\"#FFFF06\">";
		echo "<TD colspan=\"9\" height=\"5\"></TD>";
		echo "</TR>";
		$i++;
	}*/
?>
</TABLE>-->

</body>
</html>
<?php include("unconnect.inc");?>