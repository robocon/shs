<?php 
session_start();
$month["01"] ="���Ҥ�";
$month["02"] ="����Ҿѹ��";
$month["03"] ="�չҤ�";
$month["04"] ="����¹";
$month["05"] ="����Ҥ�";
$month["06"] ="�Զع�¹";
$month["07"] ="�á�Ҥ�";
$month["08"] ="�ԧ�Ҥ�";
$month["09"] ="�ѹ��¹";
$month["10"] ="���Ҥ�";
$month["11"] ="��Ȩԡ�¹";
$month["12"] ="�ѹ�Ҥ�";
session_register("cHn");

if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >�����¤�Ѻ ��� Login �ͧ��ҹ������� </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">��Ѻ˹���á</a></center>";
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�Ѵ�¡������</title>
<style type="text/css">
<!--

.data_show{ 
	font-family:"MS Sans Serif"; 
	font-size:16px; 
	color:#000000;
	}

.data_drugreact{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#FF0000;
	
	}
.data_title{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#FFFFFF;
	font-weight:bold;
	background-color:#0000FF
	}

body{ font-family:"MS Sans Serif";
font-size:16px;
}
-->
</style>
</head>
<body >
<?php
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

include("connect.inc");   
?>
<p><strong>������ѡ����ѵ� OPD (Ẻ����)</strong>  </p>
<form id="f1" name="f1" method="post" action="">
  ��͡ Hn : 
  <input name="hn" type="text" id="hn" size="10" maxlength="10" />

  <input type="submit" name="Submit" value="��ŧ" /><BR>
 
</form>
 <p><a href="../nindex.htm">&lt;&lt;����</a>&nbsp;&nbsp;</p>

<?php
if(isset($_POST['basic_opd'])){
	$thidate = date("d-m-").(date("Y")+543);
	$thidatehn = $thidate.$_REQUEST["hn"];
	$thidate_now = (date("Y")+543).date("-m-d").date(" H:i:s");
	$date_app = date("d")." ".$month[date("m")]." ".(date("Y")+543);
	
	// ��Ǩ�ͺ��ùѴ **************************************************
	$sql = "Select count(hn) From appoint where hn = '".$_REQUEST["hn"]."' AND appdate = '".$date_app."' AND apptime <> '¡��ԡ��ùѴ'  limit 1";
	list($app_row) = mysql_fetch_row(mysql_query($sql));
	
	// ��Ǩ�ͺ���ŧ����¹ **************************************************
	$sql = "Select right(thidate,8), time2, vn, toborow, note, kew, row_id,hn,ptname   From opday where thdatehn = '".$thidatehn."' limit 1";
	$result = Mysql_Query($sql);
	$opday_row = mysql_num_rows($result);

	
	if($app_row > 0){
		$og="��Ǩ����Ѵ";
	}else{
		$og="";
	}
	$arropday = mysql_fetch_array($result);
	$thidatevn = $thidate.$arropday["vn"];
	$nVn=$arropday["vn"];

		if($opday_row > 0){
			$query = "SELECT `idcard` , `hn` , `yot` , `name` , `surname` , `goup` , `dbirth` , `idguard` , `ptright` , `note` , `camp`   FROM opcard WHERE hn = '".$_REQUEST["hn"]."' limit 1";
	    	$result = mysql_query($query) or die("Query failed");
			list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp) = mysql_fetch_row($result);
			$cAge=calcage($dbirth);
			$cPtname=$cYot.' '.$cName.'  '.$cSurname;
			$_SESSION["cHn"] = $cHn;
			
			////////////�Դ�Թ 50 �ҷ
			$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultcheck = mysql_query($check);
			$cal = mysql_num_rows($resultcheck);
			if($cal==0){
			//runno  for chktranx
				$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
				$result = mysql_query($query)
					or die("Query failed");
			
				for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
					if (!mysql_data_seek($result, $i)) {
						echo "Cannot seek to row $i\n";
						continue;
					}
			
					if(!($row = mysql_fetch_object($result)))
						continue;
					 }
			
				$nRunno=$row->runno;
				$nRunno++;
			
				$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
				$result = mysql_query($query) or die("Query failed");
					/////////////////////////////////////////////////////////////
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate_now."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$nVn."','".$cPtright."');";
				$result = mysql_query($query);
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate_now."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
				
				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '".$thidatehn."' AND vn = '".$nVn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}
		////////////////////////////////���Դ�Թ 50 �ҷ

		$_SESSION["cHn"] = $_REQUEST["hn"];
	}
	else{
		echo "HN : ".$_REQUEST["hn"]." �ѧ�����ŧ����¹";
		exit();
	}
	
	$sql = "Select count(row_id) From opd where thdatehn = '".$thidatehn."' limit 1";
	$result = Mysql_Query($sql);
	list($rows) = Mysql_fetch_row($result);
	
	if($rows > 0){
		$sql = "Update `opd` set  `thidate` = '".$thidate_now."', `type`  = '�Թ��', `doctor` = '".$_POST['doctor']."',  `officer` = '".$_SESSION["sOfficer"]."' ,  `dc_diag` = Null, `vn`= '".$nVn."', `toborow` = 'EX01 �ѡ���ä�����������Ҫ���', `clinic`  = '".$_POST['clinic']."' where  `thdatehn` = '".$thidatehn."' limit 1 ";


	}else{

		$sql = "INSERT INTO `opd` (`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,`type` ,`organ` ,`doctor`, `officer`, `vn` , `toborow`, `clinic`)VALUES (NULL , '".$thidate_now."', '".$thidatehn."', '".$_REQUEST["hn"]."', '".$cPtname."', '�Թ��', '".$og."', '".$_POST['doctor']."', '".$_SESSION["sOfficer"]."', '".$nVn."', 'EX01 �ѡ���ä�����������Ҫ���', '".$_POST['clinic']."' );";

}

	$result = Mysql_Query($sql) or die(Mysql_Error());


	$sql ="UPDATE opday SET clinic = '".$_POST['clinic']."' WHERE  thdatehn='".$thidatehn."' AND vn = '".$nVn."' ";
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	if($result){
		echo "�ѹ�֡���������º��������";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=basic_opd_auto.php\">";
	}
	
}elseif(isset($_REQUEST["hn"]) && $_REQUEST["hn"] !=""){
	$thidate = date("d-m-").(date("Y")+543);
	$thidatehn = $thidate.$_REQUEST["hn"];
	$sql = "Select hn, concat(yot,' ' ,name, ' ', surname) as fullname, ptright,dbirth,idcard  From opcard where hn = '".$_REQUEST["hn"]."' limit 1";
	$result = Mysql_Query($sql);
	list($hn, $fullname, $ptright, $dbirth,$idcard ) = mysql_fetch_row($result);
	
	$age = calcage($dbirth);
	
	$sql = "Select drugcode, tradname From drugreact where hn = '".$_REQUEST["hn"]."' ";
	$result = mysql_query($sql) or die(Mysql_Error());
	$i=0;
	while(list($drugcode, $tradname) = mysql_fetch_row($result)){ $txt_react[$i] = "&nbsp;&nbsp;&nbsp;<b>[".$drugcode."]</b> ".$tradname.", "; $i++; }
	
	$txt_react2 = implode("",$txt_react);
	
	$txt_react2 = "�ҷ����&nbsp;:&nbsp;".$txt_react2;
	
	$sql = "Select right(thidate,8), time2, vn, toborow, note, kew, row_id,hn,ptname   From opday where thdatehn = '".$thidatehn."' limit 1";
	$result = Mysql_Query($sql);
	list($regis_time, $time1, $vn, $toborow, $note, $kew, $row_id,$hn,$ptname) = mysql_fetch_row($result);

	?>
	<table width="800" border="1" cellpadding="0" cellspacing="0" bordercolor="#0000FF">
  <tr valign="top">
    <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" class="data_show2"><tr>
        <td colspan="2"align="center" class="data_title">�����ż����� </td>
      </tr>
	  <tr>
        <td><p>HN : <strong><?php echo $hn;?></strong>, ����-ʡ�� : <strong><?php echo $fullname;?></strong>,&nbsp;ID:<strong><?php echo $idcard;?></strong>,&nbsp;VN&nbsp;:&nbsp;<B><?php echo $vn;?></B>&nbsp;, ��� : <B><?php echo $kew;?></B>, <B><?php echo substr($toborow,4);?></B></td>
		<td rowspan="4">
		<IMG SRC="../image_patient/<?php echo $idcard;?>.jpg" WIDTH="100" HEIGHT="150" BORDER="0" ALT="">
		</td>
      </tr>
      <tr>
        <td>���� : <strong><?php echo $age;?></strong>&nbsp;,�Է�ԡ���ѡ��: <font color="#CE0000"><?php echo $ptright;?></font> &nbsp;&nbsp;&nbsp;
				, �����˵� : <?php echo $note;?>
		</td>
      </tr>
      <tr>
        <td><font class="data_drugreact"><?php echo $txt_react2;?></font></td>
      </tr>
      <tr>
        <td>����ŧ����¹ : <strong><?php echo $regis_time;?></strong>          , ���Ҩ���OPD Card : <strong><?php echo $time1;?></strong> , ���ҫѡ����ѵ� : <strong><?php echo date("H:i:s");?></strong></td>
      </tr>
    </table></td>
  </tr>
</table>
<form id="f2" name="f2" method="post" action="" Onsubmit="return checkForm();">
   <table width="800" border="1" cellpadding="0" cellspacing="0" bordercolor="#0000FF">
     <tr valign="top">
       <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" >
         <tr>
           <td colspan="7" align="center" class="data_title">��سҡ�͡������ </td>
         </tr>
		 <tr>
		   <td width="17%" align="right" class="data_show">��Թԡ : </td>
		   <td width="83%" colspan="5" align="left"><select name="clinic" id="clinic">
		     <?php 
	  	print "<option value='99' >-- ��س����͡��Թԡ --</option>";
			 print " <option value='99 �Ǫ��Ժѵ�' selected>�Ǫ��Ժѵ�</option>";
print " <option value='01 ����á���'>����á���</option>";
print " <option value='02 ���¡���'>���¡���</option>";
print " <option value='03 �ٵԡ���'>�ٵԡ���</option>";
print " <option value='04 �����Ǫ����'>�����Ǫ����</option>";
print " <option value='05 ������Ǫ'>������Ǫ</option>";
print " <option value='06 �ʵ �� ���ԡ'>�ʵ �� ���ԡ</option>";
print " <option value='07 �ѡ��'>�ѡ��</option>";
print " <option value='08 ���¡�����д١'>���¡�����дء</option>";
print " <option value='09 �Ե�Ǫ'>�Ե�Ǫ</option>";
print " <option value='10 �ѧ���Է��'>�ѧ���Է��</option>";
print " <option value='11 �ѹ�����'>�ѹ�����</option>";
print " <option value='12 �ء�Թ'>�ء�Թ</option>";
print " <option value='13 ����Ҿ�ӺѴ'>����Ҿ�ӺѴ</option>";
print " <option value='14 ᾷ��Ἱ��'>ᾷ��Ἱ��</option>";
print " <option value='15 PCU � þ.'>PCU � þ.</option>";
print " <option value='01 ��Թԡ COPD'>��Թԡ COPD</option>";
print " <option value='99 ���¡����ҧ�Թ�������'>���¡����ҧ�Թ�������</option>";
print " <option value='16 ��Թԡ�ä�'>��Թԡ�ä�</option>";
print " <option value='99 ����'>����</option>";
		if($_SESSION["smenucode"] != "ADMMAINOPD"){
		print " <option value='14 �Ǫ��ʵ���鹿�'>�Ǫ��ʵ���鹿�</option>";
		}
		print " <option value='99 ����'>����</option>";
	?>
		     </select>           </td>
	      </tr>
         <tr>
           <td align="right" class="data_show">ᾷ�� : </td>
           <td align="left" colspan="5"><select name="doctor" id="doctor">
               <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' selected>��ͧ��Ǩ�ä�����</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
			echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
             </select>           </td>
         </tr>
		 
         <tr>
           <td colspan="6" align="center" class="data_show"><!--<input type="button" value="�����㺵�Ǩ�ä" onclick="window.open('vnprint.php?clinin='+document.getElementById('clinic').value+'&doctor='+document.getElementById('doctor').value);" />-->&nbsp;<!--<input type="button" value="�������" onclick="window.open('vnprintqueue.php?clinin='+document.getElementById('clinic').value+'&doctor='+document.getElementById('doctor').value);" />-->&nbsp;<input name="basic_opd" type="submit" id="basic_opd" value="��ŧ&amp;ʵԡ���� OPD" />&nbsp;&nbsp;<!--<input name="print_basic_opd" type="submit" id="print_basic_opd" value="��ŧ &amp; ʵԡ����" />--></td>
         </tr>
       </table></td>
     </tr>
   </table>
   <input name="hn" type="hidden" value="<?php echo $_REQUEST["hn"];?>" />
    <input name="ptname" type="hidden" value="<?php echo $fullname;?>" />
	<input name="vn" type="hidden" value="<?php echo $vn;?>" />
	<input name="toborow" type="hidden" value="<?php echo $toborow;?>" />
	<input name="appoint" type="hidden" value="<?php echo $app_row;?>" />
</form>
	<?
}

include("unconnect.inc");
?>
</body>
</html>