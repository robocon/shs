<?
session_start();
include("connect.inc");
$sql1 = "select tradname from druglst where drugcode = '".$_GET['name']."'";
$result = mysql_fetch_array(mysql_query($sql1));
?>
<style type="text/css">
	<!--
	.formdrug {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	.formdrug1 {
		font-family: "TH SarabunPSK";
		font-size: 24px;
		font-weight: bold;
	}
	-->
</style>
<script>
function check(){
	if(document.formdrugg.w31.checked==true){
		if(document.formdrugg.w41.checked==false&&document.formdrugg.w42.checked==false&&document.formdrugg.w43.checked==false&&document.formdrugg.w44.checked==false){
			alert("��س����͡����������");
			return false;	
		}
		else{
			return true;
		}
	}
	else if(document.formdrugg.w31.checked==false&&document.formdrugg.w32.checked==false){
		alert("��س����͡����������");
		return false;	
	}
}
</script>
<?
if($_POST['savefg']){
	
	if($_POST['w3']=="1"){
			if($_POST['w4']=="0") $e3value = $_POST['w4_value'];
			else $e3value = "��Һ������� ".$_POST['w4'];
		}
		elseif($_POST['w3']=="2"){
			$e3value = "ᾷ������� ".$_SESSION['sOfficer'];
		}
	$dateup = (date("Y")+543).date("-m-d")." ".date("H:i:s");
	$sqlinsert = "insert into drug_typeg(date,hn,name,age,ptright,value1,value2,value3,value4,value5,officer,userlogin) values('".$dateup."','".$_SESSION["hn_now"]."','".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["age_now"]."','".$_SESSION["ptright_now"]."','".$_POST['value1']."','".$_POST['value2']."','".$_POST['value3']."','".$_POST['value4']."','".$_POST['value5']."','".$e3value."','".$_SESSION['sOfficer']."')";
	$result = mysql_query($sqlinsert);
	if($result=="1"){
		?>
		<script>
			alert("�ѹ�֡���������º��������");
        	window.close();
			return true;
        </script>
		<?
	}
}
?>
<form action="<? $_SERVER['PHP_SELF']?>" name="formdrugg" onsubmit="return check()" method="post">
<table class="formdrug">
<tr><td align="center" class="formdrug1">������㹡���������....<?=$result['tradname']?>....</td></tr>
<tr><td class="formdrug"><strong>HN :</strong> <?php echo $_SESSION["hn_now"];?><strong> ���ͼ����� : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong> ���� : </strong><?php echo $_SESSION["age_now"];?><br>
<strong> �Է�ԡ���ѡ�� :</strong> <?php echo $_SESSION["ptright_now"];?></td></tr>
<tr><td class="formdrug">1. Myocardial infraction <input name="value1" type="text" size="10"  /></td></tr>
<tr><td class="formdrug">2. Bleeding complication <input name="value2" type="text" size="10"  /></td></tr>
<tr><td class="formdrug">3. Coagnlopathy ���� ������ʹ��� <input name="value3" type="text" size="10"  /></td></tr>
<tr><td class="formdrug">4. Severe Dyslipidemia LDL= <input name="value4" type="text" size="10"  /> mg/cl</td></tr>
<tr><td class="formdrug">5. ��� � <input name="value5" type="text" size="10"  /></td></tr>
<tr><td class="formdrug"><input name="w3" type="radio" value="1" id="w31"/>��Һ�������᷹ᾷ�� <input name="w4" type="radio" value="�ح����" id="w41"/>�ح���� <input name="w4" type="radio" value="�ѹ�����" id="w42"/>�ѹ����� <input name="w4" type="radio" value="�����ѵ��" id="w43"/>�����ѵ�� <input name="w4" type="radio" value="0" id="w44"/>���� <input name="w4_value" type="text" size="10"/></td>
  </tr>
  <?
	$codedoc = strstr($_SESSION["dt_doctor"],"(");
	$namedoc = explode(" ",$_SESSION["dt_doctor"]);
  ?>
  <tr>
    <td class="formdrug"><input name="w3" type="radio" value="2" id="w32"/>ᾷ�����������
<?=$namedoc[0]?> <?=$namedoc[1]?></td></tr>
<tr>
<td align="center" class="formdrug"><input name="savefg" type="submit" value=" �ѹ�֡ " /></td>
</tr>
</table>
</form>

