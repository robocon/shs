<?
session_start();
include("connect.inc");
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
</head>

<body>
<? if(!isset($_GET['view'])&!isset($_GET['stricker'])){?>
<div id="no_print" > 
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<p align="center">
  <font class="pdxhead"><strong>㺹ӷҧ��Ǩ�آ�Ҿ��Шӻ�Ẻ�����</strong></font>
</p>
<table class="pdxhead" border="1" bordercolor="#339966">
  <tr><td width="480" align="center" bgcolor="#339966"><strong>��͡������ HN </strong></td>
  </tr>
  <tr><td>HN: <input name="hn" type="text" size="10" class="pdxhead"  /> 
  <input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td></tr>
  <tr><td>���� - ʡ�� : <input name="namep" type="text" size="20" class="pdxhead"  /> 
  <input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td></tr>
  <tr>
    <td>���ʺѵû��.
      <input name="idcard" type="text" size="20" class="pdxhead"  />
      <input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td>
  </tr>
</table>
<br />
<a href="search_dxofyear.php" target="_blank">****���Ҩҡ����-ʡ��****</a>
<br />
<a href="pdx_ofyear2.php">****˹���á��Ǩ�آ�Ҿ��Шӻ�****</a>
<br />
<a href ="../nindex.htm" >**** &lt;&lt; ����****</a>
</form>
</div>

<?
}
if(isset($_POST['okhn'])){
	if($_POST['hn']!=""){
		$sql = "select hn,concat(yot,' ',name,' ',surname) as ptname,idcard,dbirth,concat(address,' ',tambol,' ',ampur,' ',changwat) as address,phone from opcard where hn = '".$_POST['hn']."'";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
		$bdate = explode("-",$arr['dbirth']);
		$_SESSION["age_n"] = "�ѹ/��͹/�� �Դ ".$bdate[2]."-".$bdate[1]."-".$bdate[0]." ���� : ".calcage($arr['dbirth']).".";
		$_SESSION['add_n'] = $arr['address'];
		$_SESSION['tel_n'] = $arr['phone'];
		$_SESSION['name_n'] = $arr['ptname'];
		$_SESSION['hn_n'] = $arr['hn'];
		$_SESSION['idcard_n'] = $arr['idcard'];
	}elseif($_POST['idcard']!=""){
		$sql = "select hn,concat(yot,' ',name,' ',surname) as ptname,idcard,dbirth,concat(address,' ',tambol,' ',ampur,' ',changwat) as address,phone from opcard where idcard = '".$_POST['idcard']."'";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
		$bdate = explode("-",$arr['dbirth']);
		$_SESSION["age_n"] = "�ѹ/��͹/�� �Դ...".$bdate[2]."-".$bdate[1]."-".$bdate[0]."... ���� :.".calcage($arr['dbirth']).".";
		$_SESSION['add_n'] = $arr['address'];
		$_SESSION['tel_n'] = $arr['phone'];
		$_SESSION['name_n'] = $arr['ptname'];
		$_SESSION['hn_n'] = $arr['hn'];
		$_SESSION['idcard_n'] = $arr['idcard'];
	}

	?>
<form action="<? $_SERVER['PHP_SELF']?>" method="POST" name="pdxofyear1">
	<table>
    	<tr>
    	  <td colspan="2" align="center" bgcolor="#339966" class="pdxhead"><strong>�����Ż���ѵ�</strong></td>
   	  </tr>
    	<tr>
        	<td width="336"><span class="pdxhead">����-ʡ�� : 
       	    <?=$_SESSION['name_n']?>
        	</span></td>
            <td width="357">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><span class="pdxhead">�ѹ����Ǩ : 
          <input name="datechkup" type="text" class="pdxpro" id="datechkup" size="30" />
          </span>
            <span class="pdx">������ҧ �� 1 ���Ҥ� 2557          </span></td>
      </tr>
        <tr>
        	<td colspan="2"><span class="pdxhead">˹��§ҹ : 
                <input name="company" type="text" class="pdxpro" id="company" size="40" />
   	    </span></td>
        </tr>
        <tr>
          <td colspan="2"><span class="pdxhead">����� : 
            <input name="type" type="text" class="pdxpro" id="type" /></span>            
            <span class="pdx">������ҧ �� 1,2,3,4 ����յ�Ǩ���� ������ 5</span></td>
      </tr>
        <tr>
          <td colspan="2"><span class="pdxhead">�Ҥ� : 
            <input name="price" type="text" class="pdxpro" id="price" />
          �ҷ</span></td>
        </tr>
        <tr><td colspan="2" align="left"><div style="margin-left:60px;"><input name="okselect" type="submit" class="pdxpro"  value="   ��ŧ   "/></div></td></tr>
</table>
</form>
	<?
}elseif(isset($_POST['okselect'])){

	$pic = explode("-",$_POST['company']);

	if($_SESSION['hn_n']=="......................."){
		$sql2 = "insert into predxofyear(row_id,hn,ptname,company,type_check,comment,datechkup,price) value ('','','".$_SESSION['name_n']."','".$_POST['company']."','".$_POST['type']."','".$_POST['comment']."','".$_POST['datechkup']."','".$_POST['price']."')";
	}else{
		$sql2 = "insert into predxofyear(row_id,hn,ptname,company,type_check,comment,datechkup,price) value ('','".$_SESSION['hn_n']."','".$_SESSION['name_n']."','".$_POST['company']."','".$_POST['type']."','".$_POST['comment']."','".$_POST['datechkup']."','".$_POST['price']."')";
	}

	if(mysql_query($sql2)){
			
	}else{
		echo "�ѹ�֡�����żԴ��Ҵ ��سҺѹ�֡����������";
	}
	?>
    <script type="text/javascript">
    window.print();
    </script>
	<table width="100%">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="8%" rowspan="3" align="center"><img src="images/logo.jpg" width="87" height="83" /></td>
						<td width="75%" align="center" class="pdx">
							<strong>
								<span class="pdxhead">Ẻ��õ�Ǩ�آ�Ҿ <?=$_POST['company']?></span>
							</strong>
						</td>
						<td width="17%" align="center" class="pdx">&nbsp;</td>
					</tr>
					<tr>
						<td align="center" class="pdx"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
						<td align="center" class="pdx">&nbsp;</td>
					</tr>
					<tr>
						<td align="center" class="pdx"><span class="pdxhead">��Ǩ�ѹ���   <?=$_POST['datechkup']?></span></td>
						<td align="center" class="pdx">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
				<strong>1. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ�</strong></span><br />
				<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
					<tr>
						<td>
							<table>
								<tr>
									<td class="pdxpro">HN :
										<strong><?=$_SESSION['hn_n']?></strong> ����-ʡ�� : 
										<strong><?=$_SESSION['name_n']?></strong> <?=$_SESSION["age_n"]?>
									</td>
								</tr>
								<tr>
									<td class="pdx">�Ţ�ѵû�� : <?=$_SESSION["idcard_n"]?> ������� :
										<?=$_SESSION['add_n']?> ���Ѿ�� : <?=$_SESSION['tel_n']?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?
				$ban = $_POST['type'];

				$arrtype = array('��Ǩ x-ray �ʹ','��Ǩ��������ó�ͧ������ʹ(CBC)','��Ǩ�������(UA)','����ҹ(BS)','��ѹ(CHOL) (TRI)','��Ǩ˹�ҷ��ͧ�Ѻ(SGOT,SGPT)','��Ǩ˹�ҷ��ͧ�(BUN,CR)','��Ǩ˹�ҷ��ͧ�(ALK)','��Ǩ�ô���ԡ(URICACID)');
				$arrprice = array('170.00','90.00','50.00','40.00','120.00','100.00','100.00','50','60');
				
				?>
				<table width="100%">
					<tr>
						<td class="pdxpro" colspan="2"><strong>��¡�õ�Ǩ�آ�Ҿ</strong></td>
					</tr>
					<!--
					<tr>
						<td class="pdxpro" colspan="2"><strong><?=$_POST['company']?></strong></td>
					</tr>
					-->
						<? 
						$sumpri=0;
						if($ban=="1"){
							echo "<tr><td class='pdxpro'><strong>�������� 1</strong></td></tr>";
						}elseif($ban=="2"){
							echo "<tr><td class='pdxpro'><strong>�������� 2</strong></td></tr>";
						}elseif($ban=="3"){
							echo "<tr><td class='pdxpro'><strong>�������� 3</strong></td></tr>";
						}elseif($ban=="4"){
							echo "<tr><td class='pdxpro'><strong>�������� 4</strong></td></tr>";
						}else{
							echo "<tr><td class='pdxpro'><strong>��������� �������º����ѭ�ա�ҧ</strong></td></tr>";
						}
						?>
					<tr>
						<td class="pdx" colspan="2"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
					</tr>
					<tr>
						<td class="pdx" colspan="2">
							<table>
								<tr style='line-height:16px'>
									<?
									// echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 1 <br>ŧ����¹<br>����¹<br>.............................</td></tr></table></td>";
									
									echo "<td>
									<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										<tr align='center' style='line-height:16px'>
											<td>ʶҹ� 1<br>������ʹ<br>��ͧ��Ҹ�<br>.............................</td>
										</tr>
									</table></td>";

									echo "<td>
									<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										<tr align='center' style='line-height:16px'>
											<td>ʶҹ� 2<br>X-RAY<br>��ͧ�������<br>.............................</td>
										</tr>
									</table></td>";
									
									echo "<td>
									<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										<tr align='center' style='line-height:16px'>
											<td>ʶҹ� 3<br>PAP<br>OPD �ٵ��<br>.............................</td>
										</tr>
									</table></td>";

									echo "<td>
									<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										<tr align='center' style='line-height:16px'>
											<td>ʶҹ� 4<br>V/S<br>�ش�Ѵ�¡<br>.............................</td>
										</tr>
									</table></td>";

									if($ban!="1" && $ban!="2" && $ban!="3" && $ban!="4"){
										// echo "<td>
										// <table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										// 	<tr align='center' style='line-height:16px'>
										// 		<td>ʶҹ� 5<br>PAP<br>OPD �ٵ��<br>.............................</td>
										// 	</tr>
										// </table></td>";
										// echo "<td>
										// <table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										// 	<tr align='center' style='line-height:16px'>
										// 		<td>ʶҹ� 6<br>V/A<br>OPD ��<br>.............................</td>
										// 	</tr>
										// </table></td>";
										// echo "<td>
										// <table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										// 	<tr align='center' style='line-height:16px'>
										// 		<td>ʶҹ� 7<br>EKG<br>OPD ��<br>.............................</td>
										// 	</tr>
										// </table></td>";	
									}
								?>
								</tr>
							</table>
						</td>
					</tr>
					<!--
					<tr>
						<td class="pdx">&nbsp;</td>
					</tr>
					-->
				</table>
			</td>
		</tr>
	 </table>
    <div class="pdx" style="margin-left:10px;"><strong>*** �����˵� ***</strong><br />
    <!-- 
	- ������˹�ҷ���繵���͡ӡѺ�ءʶҹ� ����ͷӡ�õ�Ǩ���������������� <br />
	-->
    - ����ͷӡ�õ�Ǩ�ú�ءʶҹ����� ���͡����觤׹���˹�ҷ�� � <!-- �شŧ����¹ -->�ش�Ѵ�¡<br />
	<!--
    - ��س����ҷ��͡���㺹ӷҧ��� ���ѹ�索Ҵ</div>
	-->
<?
}elseif(isset($_GET['stricker'])){

	$sqls = "select * from predxofyear where row_id = '".$_GET['stricker']."'";
	$result = mysql_query($sqls);
	$row = mysql_fetch_array($result);
	$pic = explode("-",$row['company']);

	$sqls2 = "select * from opcard where hn = '".$row['hn']."'";
	$result2 = mysql_query($sqls2);
	$row2 = mysql_fetch_array($result2);
	//echo "<span class='stricker1'>".$pic[1]."</span><br>";
	?>
	<span class='stricker'><strong>�ç��Һ�Ť�������ѡ�������� �ӻҧ</strong></span><br />
	<span class='stricker'><strong>HN:<?=$row['hn']?></strong></span><br />
	<span class='stricker'><strong>����:<?=$row['ptname']?></strong></span><br />
	<span class='stricker'><strong>����:<?=calcage($row2['dbirth'])?></strong></span><br />
	<span class='stricker'><?=$row['type_check']?></span>
    <script>
    // window.print();
    </script>
<?
}
include("unconnect.inc");

?>
</body>
</html>