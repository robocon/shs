<?
session_start();
include("connect.inc");
?>
<style type="text/css">
	<!--
	.formdrug {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	.formdrugd {
		font-family: "TH SarabunPSK";
		font-size: 22px;
	}
	.formdrug1 {
		font-family: "TH SarabunPSK";
		font-size: 24px;
		font-weight: bold;
	}
	-->
</style>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script>

var dp_cal2,dp_cal3,dp_cal5,dp_cal6,dp_cal8,dp_cal9,dp_cal11,dp_cal12,dp_cal14,dp_cal15,dp_cal17,dp_cal18,dp_cal20,dp_cal21,dp_cal23,dp_cal24,dp_cal26,dp_cal27;
window.onload = function(){
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('date11'));
dp_cal3  = new Epoch('epoch_popup','popup',document.getElementById('date12'));
dp_cal5  = new Epoch('epoch_popup','popup',document.getElementById('date21'));
dp_cal6  = new Epoch('epoch_popup','popup',document.getElementById('date22'));
dp_cal8  = new Epoch('epoch_popup','popup',document.getElementById('date31'));
dp_cal9  = new Epoch('epoch_popup','popup',document.getElementById('date32'));
dp_cal11  = new Epoch('epoch_popup','popup',document.getElementById('date41'));
dp_cal12  = new Epoch('epoch_popup','popup',document.getElementById('date42'));
dp_cal14  = new Epoch('epoch_popup','popup',document.getElementById('date51'));
dp_cal15  = new Epoch('epoch_popup','popup',document.getElementById('date52'));
dp_cal17  = new Epoch('epoch_popup','popup',document.getElementById('date61'));
dp_cal18  = new Epoch('epoch_popup','popup',document.getElementById('date62'));
dp_cal20  = new Epoch('epoch_popup','popup',document.getElementById('date71'));
dp_cal21  = new Epoch('epoch_popup','popup',document.getElementById('date72'));
dp_cal23  = new Epoch('epoch_popup','popup',document.getElementById('date81'));
dp_cal24  = new Epoch('epoch_popup','popup',document.getElementById('date82'));
dp_cal26  = new Epoch('epoch_popup','popup',document.getElementById('date91'));
dp_cal27  = new Epoch('epoch_popup','popup',document.getElementById('date92'));

function check(){
	if(document.formadddrug.fac.value==undefined){
		alert("��س����͡ᾷ��੾�зҧ�Ң�");
		return false;	
	}
	
}
}
</script>
<?
if(isset($_POST['savef'])){
			if($_POST['d1']==1){
				$re = $_POST['reason1'];	
			}
			elseif($_POST['d1']==2)
			{
				$re = "";
			}
			elseif($_POST['d1']==3)
			{
				$re = $_POST['reason2'];
			}
			///////////////////////////
			if($_POST['d2']==1){
				$re2 = $_POST['reason3'];	
				$re3 = $_POST['reason4'];
			}
			elseif($_POST['d2']==2)
			{
				$re2 = $_POST['reason5'];	
				$re3 = $_POST['reason6'];
			}
			elseif($_POST['d2']==3)
			{
				$re2 = $_POST['reason7'];	
				$re3 = "";
			}
			$insertform = "insert into dt_drugadd values('','".$_SESSION['nn']."','".$_SESSION["yot_now"].$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["hn_now"]."','','".$_SESSION["age_now"]."','".$_SESSION["ptright_now"]."','".$_POST['diag']."','".$_POST['d1']."','".$re."','".$_POST['d2']."','".$re2."','".$re3."','".date("d-m-Y H:i:s")."','".$_SESSION["dt_doctor"]."','A')";
			//echo $insertform;
			if(mysql_query($insertform)){
				echo "�ѹ�֡���������º��������";	
			}
			else{
				echo "�������ö�ѹ�֡��������";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="�Դ˹�ҵ�ҧ" />
			<?
}
elseif(isset($_POST['savef2'])){
			if($_POST['d1']==1){
				$re = $_POST['reason1'];	
				$re2 = $_POST['reason2'];
				$re3 = $_POST['reason3'];
			}
			elseif($_POST['d1']==2)
			{
				$re = $_POST['reason4'];
				$re2 = "";
				$re3 = "";
			}
			elseif($_POST['d1']==3)
			{
				$re = $_POST['reason5'];
				$re2 = $_POST['reason6'];
				$re3 = "";
			}
			elseif($_POST['d1']==4)
			{
				$re = $_POST['reason7'];
				$re2 = "";
				$re3 = "";
			}
			$insertform = "insert into dt_drugadd values('','".$_SESSION['nn']."','".$_SESSION["yot_now"].$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["hn_now"]."','','".$_SESSION["age_now"]."','".$_SESSION["ptright_now"]."','".$_POST['diag']."','".$_POST['d1']."','".$re."','".$re2."','".$re3."','".$_POST['lab1']."/".$_POST['datelab']."','".date("d-m-Y H:i:s")."','".$_SESSION["dt_doctor"]."','B')";
			//echo $insertform;
			if(mysql_query($insertform)){
				echo "�ѹ�֡���������º��������";	
			}
			else{
				echo "�������ö�ѹ�֡��������";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="�Դ˹�ҵ�ҧ" />
			<?
}
elseif(isset($_POST['savef3'])){
			if($_POST['d1']==1){
				$re = $_POST['reason1'];	
			}
			elseif($_POST['d1']==2)
			{
				$re = "";
			}
			elseif($_POST['d1']==3)
			{
				$re = $_POST['reason2'];
			}
			$insertform = "insert into dt_drugadd values('','".$_SESSION['nn']."','".$_SESSION["yot_now"].$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["hn_now"]."','','".$_SESSION["age_now"]."','".$_SESSION["ptright_now"]."','".$_POST['diag']."','".$_POST['d1']."','".$re."','','','','".date("d-m-Y H:i:s")."','".$_SESSION["dt_doctor"]."','C')";
			//echo $insertform;
			if(mysql_query($insertform)){
				echo "�ѹ�֡���������º��������";	
			}
			else{
				echo "�������ö�ѹ�֡��������";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="�Դ˹�ҵ�ҧ" />
			<?
}
elseif(isset($_POST['savef4'])){
			if($_POST['d2']==1){
				$re = $_POST['re1'];	
				if($_POST['re1']==3){
					$re2 = $_POST['reason3'];	
				}
				else{
					$re2 = "";
				}
			}
			elseif($_POST['d2']==2)
			{
				$re = $_POST['re2'];	
				if($_POST['re2']==3){
					$re2 = $_POST['reason4'];	
				}
				else{
					$re2 = "";
				}
			}
			$insertform = "insert into dt_drugadd values('','".$_SESSION['nn']."','".$_SESSION["yot_now"].$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["hn_now"]."','','".$_SESSION["age_now"]."','".$_SESSION["ptright_now"]."','".$_POST['diag']."','".$_POST['d1']."','".$_POST['d2']."','".$re."','".$re2."','','".date("d-m-Y H:i:s")."','".$_SESSION["dt_doctor"]."','D')";
			//echo $insertform;
			if(mysql_query($insertform)){
				echo "�ѹ�֡���������º��������";	
			}
			else{
				echo "�������ö�ѹ�֡��������";	
				?>
			<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="�Դ˹�ҵ�ҧ" />
			<?
}elseif(isset($_POST['savef5'])){
		if($_POST['re3']=='3')
		{
			if($_POST['ch1']=='1'){
				$sch1 = $_POST['week1'];	
				$sch2 = $_POST['date11'];	
				$sch3 = $_POST['date12'];	
			}
			if($_POST['ch2']=='1'){
				$sch4 = $_POST['week2'];	
				$sch5 = $_POST['date21'];	
				$sch6 = $_POST['date22'];	
				
				$sch7 = $_POST['week3'];	
				$sch8 = $_POST['date31'];	
				$sch9 = $_POST['date32'];	
				
				$sch10 = $_POST['week4'];	
				$sch11 = $_POST['date41'];	
				$sch12 = $_POST['date42'];	
				
				$sch13 = $_POST['week5'];	
				$sch14 = $_POST['date51'];	
				$sch15 = $_POST['date52'];	
			}
			if($_POST['ch3']=='1'){
				$sch16 = $_POST['week6'];	
				$sch17 = $_POST['date61'];	
				$sch18 = $_POST['date62'];	
				
				$sch19 = $_POST['week7'];	
				$sch20 = $_POST['date71'];	
				$sch21 = $_POST['date72'];	
				
				$sch22 = $_POST['week8'];	
				$sch23 = $_POST['date81'];	
				$sch24 = $_POST['date82'];	
				
				$sch25 = $_POST['week9'];	
				$sch26 = $_POST['date91'];	
				$sch27 = $_POST['date92'];	
			}
		}
		$insertform = "insert into drug_gruco (row_id,name_doc,num_doc,fac,hospital,province,hn,name_pt,age,reason1,reason2,reason3,ch1,week1,date11,date12,ch2,week2,date21,date22,week3,date31,date32,week4,date41,date42,week5,date51,date52,ch3,week6,date61,date62,week7,date71,date72,week8,date81,date82,week9,date91,date92,dateup) values('','".$_SESSION["dt_doctor"]."','".$_POST['num_doc']."','".$_POST['fac']."','".$_POST['hospital']."','".$_POST['province']."','".$_SESSION['hn_now']."','".$_SESSION["yot_now"].$_SESSION["name_now"]." ".$_SESSION["surname_now"]."','".$_SESSION["age_now"]."','".$_POST['re1']."','".$_POST['re2']."','".$_POST['re3']."','".$_POST['ch1']."','".$sch1."','".$sch2."','".$sch3."','".$_POST['ch2']."','".$sch4."','".$sch5."','".$sch6."','".$sch7."','".$sch8."','".$sch9."','".$sch10."','".$sch11."','".$sch12."','".$sch13."','".$sch14."','".$sch15."','".$_POST['ch3']."','".$sch16."','".$sch17."','".$sch18."','".$sch19."','".$sch20."','".$sch21."','".$sch22."','".$sch23."','".$sch24."','".$sch25."','".$sch26."','".$sch27."','".date("d-m-Y H:i:s")."')";
			//echo $insertform;
			if(mysql_query($insertform)){
				echo "�ѹ�֡���������º��������";	
			}
			else{
				echo "�������ö�ѹ�֡��������";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="�Դ˹�ҵ�ҧ" />
			<?
}
elseif(isset($_GET['name'])){
	$sqlselectdrug = "select count(*) from druglst where drugcode = '".$_GET['name']."' and status = 'A'";
	//echo $sqlselectdrug;
	$rowcountdrug = mysql_query($sqlselectdrug);
	$resultcount = mysql_fetch_array($rowcountdrug);
	if($resultcount[0]!=0){  
		$selectnamedrug = "select * from druglst where drugcode = '".$_GET['name']."' and status = 'A'";
		//echo $selectnamedrug;
		$rownamedrug = mysql_query($selectnamedrug);
		$resultname = mysql_fetch_array($rownamedrug);
		$_SESSION['nn']=$resultname['tradname'];
			?>
	<form action="<? $_SERVER['PHP_SELF']?>" name="formadddrug" method="post">
	  <table width="556" height="500">
	    <tr>
	      <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Angiotensin II receptor antagonists (ARBs)</span></td>
        </tr>
	    <tr>
	      <td align="center" class="formdrug"><span class="formdrug1">-....
	        <?=$_SESSION['nn']?>
	        ....- </span></td>
        </tr>
	    <tr>
	      <td class="formdrug"><strong>�����ż�����</strong></td>
        </tr>
	    <tr>
	      <td class="formdrug"><strong>���ͼ����� : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?> <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?> <strong>AN : - </strong> <strong>���� : </strong><?php echo $_SESSION["age_now"];?><br />
	        <strong> �Է�ԡ���ѡ�� :</strong> <?php echo $_SESSION["ptright_now"];?></td>
        </tr>
	    <tr>
	      <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	        <input name="diag2" type="text" size="30" /></td>
        </tr>
	    <tr>
	      <td><table>
	        <tr>
	          <td class="formdrug"><strong>�˵ؼŻ�Сͺ������ҡ���� ARBs</strong></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d1" type="radio" value="1" />
	            �. �Դ�ҡ�����֧���ʧ��ҡ������ҡ���� ACEI �ô�к��ҡ��
	            <input name="reason8" type="text" size="15" /></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d1" type="radio" value="2" />
	            �. �Ҵ��Ҽ����¨����Ѻ����ª��������������Ѻ ACEI �� ������ diabetic kidney disease &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����� protein urea > � g/day</td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d1" type="radio" value="3" />
	            �. ��� � �ô�к�
	            <input name="reason8" type="text" size="20" /></td>
            </tr>
	        </table></td>
        </tr>
	    <tr>
	      <td><table>
	        <tr>
	          <td class="formdrug"><strong>�˵ؼŻ�Сͺ������ҡ���� ARBs �������͡�ѭ������ѡ��觪ҵ�</strong></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d2" type="radio" value="1" />
	            �. �� ARB �������㹺ѭ������ѡ���
	            <input name="reason8" type="text" size="15" />
	            �����Դ�ҡ�����֧���ʧ��<br />
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ô�к��ҡ��
	            <input name="reason8" type="text" size="15" /></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d2" type="radio" value="2" />
	            �. �� ARB �������㹺ѭ������ѡ���
	            <input name="reason8" type="text" size="15" />
	            �����������������¢ͧ����ѡ��<br />
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��
	            <input name="reason8" type="text" size="15" /></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d2" type="radio" value="3" />
	            �. ��� � �ô�к�
	            <input name="reason8" type="text" size="20" /></td>
            </tr>
	        </table></td>
        </tr>
	    <tr>
	      <td align="center" class="formdrug"><input name="savef" type="submit" value=" �ѹ�֡ " /></td>
        </tr>
      </table>
	</form>
	<?
	}elseif($resultcount[0]==0){
			$sqlselectdrug = "select count(*) from druglst where drugcode = '".$_GET['name']."' and status = 'B'";
			$rowcountdrug = mysql_query($sqlselectdrug);
			$resultcount = mysql_fetch_array($rowcountdrug);
			if($resultcount[0]!=0){  
				$selectnamedrug = "select * from druglst where drugcode = '".$_GET['name']."' and status = 'B'";
				//echo $selectnamedrug;
				$rownamedrug = mysql_query($selectnamedrug);
				$resultname = mysql_fetch_array($rownamedrug);
				$_SESSION['nn']=$resultname['tradname'];
	?> 
                <form action="<? $_SERVER['PHP_SELF']?>" name="formadddrug2" method="post">
                <table width="556" height="500">
                <tr><td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Statins <br /> �������͡�ѭ������ѡ��觪ҵ�</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><span class="formdrug1">-....<?=$_SESSION['nn']?>....-
                </span></td>
                </tr>
                <tr><td class="formdrug"><strong>�����ż�����</strong></td>
                </tr>
                <tr><td class="formdrug"><strong>���ͼ����� : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?>  <strong>AN : - </strong> <strong>���� : </strong><?php echo $_SESSION["age_now"];?><br /><strong> �Է�ԡ���ѡ�� :</strong> <?php echo $_SESSION["ptright_now"];?></td>
                </tr>
                <tr>
	  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  <input name="diag" type="text" size="30" />
	</td>
	</tr>
                <tr>
                  <td class="formdrug"><strong>�š�õ�Ǩ�ҧ��ͧ��Ժѵԡ�� <br />LDL : </strong>
                    <input name="lab1" type="text" size="15" /> mg/dl (�ѹ��� <input name="datelab" value="<?=date("d-m-Y");?>" type="text" />)
                </td>
                </tr>
                <tr>
                  <td>
                <table><tr>
                  <td class="formdrug"><strong>�˵ؼŻ�Сͺ�������</strong></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" />�. �Դ�ҡ�����֧���ʧ��ҡ������� Simvastatin �ô�к��ҡ��
                  <input name="reason1" type="text" size="15" />
��мŷҧ��ͧ��Ժѵԡ��
<input type="checkbox" value="1" name="lab1" /> 
AST, ALT 
<input name="reason2" type="text" size="10"  /> <input type="checkbox" value="2" name="lab2" /> CPK <input name="reason3" type="text" size="10"  /></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" />�. ���Ѻ����������Ҩ�Դ Drug interaction �Ѻ Simvastatin ��� 
                  <input name="reason4" type="text" size="15" /></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="3" />�. ���Ѻ Simvastatin ��Ҵ�٧���������ҧ���� 6 ��͹ ���дѺ LDL �ѧ�������������¢ͧ����ѡ�� �����Ѻ Simvastatin 㹢�Ҵ
                  <input name="reason5" type="text" size="5" />
mg ������
<input name="reason6" type="text" size="5" />
��͹ </td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="4" />�. ��� � �ô�к� 
                      <input name="reason7" type="text" size="20" />
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug">
                  <input name="savef2" type="submit" value=" �ѹ�֡ " /></td>
                </tr>
                </table>
                </form>
    <?
			}elseif($resultcount[0]==0){
				$sqlselectdrug = "select count(*) from druglst where drugcode = '".$_GET['name']."' and status = 'C'";
				$rowcountdrug = mysql_query($sqlselectdrug);
				$resultcount = mysql_fetch_array($rowcountdrug);
				if($resultcount[0]!=0){  
					$selectnamedrug = "select * from druglst where drugcode = '".$_GET['name']."' and status = 'C'";
					//echo $selectnamedrug;
					$rownamedrug = mysql_query($selectnamedrug);
					$resultname = mysql_fetch_array($rownamedrug);
					$_SESSION['nn']=$resultname['tradname'];
	?> 
                <form action="<? $_SERVER['PHP_SELF']?>" name="formadddrug" method="post">
                <table width="556" height="455">
                <tr>
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Proton pump inhibitor (PPIs) <br />�������͡�ѭ������ѡ��觪ҵ�</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><span class="formdrug1">-....<?=$_SESSION['nn']?>....-
                </span></td>
                </tr>
                <tr><td height="27" class="formdrug"><strong>�����ż�����</strong></td>
                </tr>
                <tr><td height="83" class="formdrug"><strong>���ͼ����� : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?>  <strong>AN : - </strong> <strong>���� : </strong><?php echo $_SESSION["age_now"];?><br /><strong> �Է�ԡ���ѡ�� :</strong> <?php echo $_SESSION["ptright_now"];?></td>
                </tr>
                <tr>
                  <td height="30" class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
                  <input name="diag" type="text" size="30" />
                </td>
                </tr>
                <tr><td height="158">
                <table><tr>
                  <td class="formdrug"><strong>�˵ؼŻ�Сͺ�������</strong></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" />�. ������ Peptic ulcer ������Ѻ�� Omeprazole ���������ҧ���� � ��͹ �����ͺʹͧ��͡���ѡ�� ������ѡ�ҹ�ʴ� ��� 
                    <input name="reason1" type="text" size="15" />
                </td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" />�. ������ GERD ������Ѻ�� Omeprazole ���������ҧ���� � ��͹ �����ͺʹͧ��͡���ѡ��</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="3" />�. ��� � �ô�к� 
                  <input name="reason2" type="text" size="20" />
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug">
                  <input name="savef3" type="submit" value=" �ѹ�֡ " /></td>
                </tr>
                </table>
                </form>
    <?
				}elseif($resultcount[0]==0){
					$sqlselectdrug = "select count(*) from druglst where drugcode = '".$_GET['name']."' and status = 'D'";
					$rowcountdrug = mysql_query($sqlselectdrug);
					$resultcount = mysql_fetch_array($rowcountdrug);
					if($resultcount[0]!=0){  
						$selectnamedrug = "select * from druglst where drugcode = '".$_GET['name']."' and status = 'D'";
						//echo $selectnamedrug;
						$rownamedrug = mysql_query($selectnamedrug);
						$resultname = mysql_fetch_array($rownamedrug);
						$_SESSION['nn']=$resultname['tradname'];
	?> 
                <form action="<? $_SERVER['PHP_SELF']?>" name="formadddrug" method="post">
                <table width="556" height="500">
                <tr>
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Selective COX-II inhibitors</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><span class="formdrug1">-....<?=$_SESSION['nn']?>....-
                </span></td>
                </tr>
                <tr><td class="formdrug"><strong>�����ż�����</strong></td>
                </tr>
                <tr><td class="formdrug"><strong>���ͼ����� : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?>  <strong>AN : - </strong> <strong>���� : </strong><?php echo $_SESSION["age_now"];?><br /><strong> �Է�ԡ���ѡ�� :</strong> <?php echo $_SESSION["ptright_now"];?></td>
                </tr>
                <tr>
                  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
                  <input name="diag" type="text" size="30" />
                </td>
                </tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>�ô��Ǩ�ͺ�����š�͹�������</strong></td>
                </tr>
                <tr>
                  <td class="formdrug">�������ջ���ѵ����ä���� �����ä����������������</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" />�. 
                �����</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" />�. �� <strong>&gt;&gt;</strong> �����ա����§�������</td>
                </tr>
                </table>
                </td></tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>�˵ؼŻ�Сͺ�������</strong></td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="1" /><strong>Acute pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="1" />�. �������ջ���ѵ��� Non-selective COX inhibitor Ẻ�ع�ç����Ẻ pseudo-allergy ����Ҩ���ҡ���� Non-selective COX inhibitor ��駡����
                </td>
                </tr>
                <tr>
                  <td class="formdrug">
                    &nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="2" />�. �������ջѨ�������§����Ҩ�Դ�ҡ�����֧���ʧ��ҡ������ҡ���� Non-selective COX inhibitor ���ҧ���� � ��� ���仹��<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ����ѡ�ҹ�ʴ���Ҽ������� recent Gl bleeding,peptic ulcer, Gl perforation<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ���� �� �� ����<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ���Ѻ����������������͡���Դ Gl adverse event ���ҡ��� �� warfarin , aspirin, clopidogrel,corticosteroids
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="3" />�. ��� � �ô�к� 
                  <input name="reason3" type="text" size="20" />
                </td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="2" /><strong>Chronic pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="1" />�. �������� Non-selective COX inhibitor �����Ѻ PPI �����ѧ���Դ�ҡ�����֧���ʧ��ҡ�������</td>
                </tr>
                <tr>
                  <td class="formdrug">
                   &nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="2" />�. �������ջ���ѵ����� Non-selective COX inhibitor Ẻ�ع�ç����Ẻ pseudo-allergy ����Ҩ���ҡ���� Non-selective COX inhibitor ��駡���� 
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="3" />�. ��� � �ô�к� 
                  <input name="reason4" type="text" size="20" />
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug">
                  <input name="savef4" type="submit" value=" �ѹ�֡ " /></td>
                </tr>
                </table>
                </form>
    <?
					}elseif($resultcount[0]==0){
						$sqlselectdrug = "select count(*) from druglst where drugcode = '".$_GET['name']."' and status = 'E'";
						$rowcountdrug = mysql_query($sqlselectdrug);
						$resultcount = mysql_fetch_array($rowcountdrug);
						if($resultcount[0]!=0){  
							$selectnamedrug = "select * from druglst where drugcode = '".$_GET['name']."' and status = 'E'";
							//echo $selectnamedrug;
							$rownamedrug = mysql_query($selectnamedrug);
							$resultname = mysql_fetch_array($rownamedrug);
							$_SESSION['nn']=$resultname['tradname'];
		?> 
					<form action="<? $_SERVER['PHP_SELF']?>" name="formadddrug" onsubmit="return check()" method="post">
					<table width="575" height="500">
					<tr>
                    <?
                    $sqlform = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' order by dateup desc ";
					$reform =mysql_query($sqlform);
					$rowform = mysql_fetch_array($reform);
					?>
					  <td width="567" height="62" align="center" class="formdrug"><span class="formdrug1">��Ѻ�ͧ������ҡ��⤫��չ���࿵<br />
					  </span>�ô�����������´����ѡ�Ҿ�Һ�����ú�ء���</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>��Ҿ���</strong>
                      <?
     $dr = "select codedoctor from inputm where name = '".$_SESSION["dt_doctor"]."'";
	 $rowdr = mysql_query($dr);
	 $resultdr = mysql_fetch_array($rowdr);
	 
	 
					  ?>
				      <input name="name_doc" type="text" size="20" value="<?=$_SESSION["dt_doctor"]?>"/> <strong>�Ţ����Ǫ����</strong>				      <input name="num_doc" type="text" size="20" value="<?=$resultdr['codedoctor']?>" /></td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>ᾷ��੾�зҧ�Ң�</strong>
				        (��س����͡)<br />
			          <input name="fac" type="radio" value="1" />�����ᾷ���ä��� <input name="fac" type="radio" value="2" <? if($resultdr['codedoctor']=='32140') echo "checked";?>/>�Ǫ��ʵ���鹿� <input name="fac" type="radio" value="3" <? if($resultdr['codedoctor']=='20182'||$resultdr['codedoctor']=='19921') echo "checked";?>/>����⸻Դԡ��</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>����ʶҹ��Һ�� <input name="hospital" type="text" id="hospital" value="�ç��Һ�Ť�������ѡ��������" size="25" /> 
					  �ѧ��Ѵ <input name="province" type="text" id="province" value="�ӻҧ" size="8" /><br />���Ѻ�ͧ���(����-ʡ�� ������) : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?><br /><strong>���� : </strong><?php echo $_SESSION["age_now"];?></td>
					</tr>
					<tr>
					  <td class="formdrug"><input name="re1" type="checkbox" value="1" <? if($rowform['reason1']=="1") echo "checked=checked"?>/>�. ���������ҹ����ѡ�����ҧ͹��ѡ��������ҧ��������������<br />&nbsp;&nbsp;&nbsp; ᾷ����繤��������ҡ��⤫��չ���࿵</td>
					</tr>
					<tr>
					  <td class="formdrug"><input name="re2" type="checkbox" value="2" <? if($rowform['reason2']=="2") echo "checked=checked"?>/>�. ������������仵���Ƿҧ�ӡѺ������ҡ��⤫��չ���࿵<br />&nbsp;&nbsp;&nbsp;&nbsp;�ͧ�Ҫ�Է�����ᾷ������⸻Դԡ����觻�����µ��˹ѧ��͡�з�ǧ��ä�ѧ<br /> &nbsp;&nbsp;&nbsp;&nbsp;��ǹ����ش ��� �� �����/��� ŧ�ѹ��� �� �Զع�¹ ����</td></tr>
                      <tr>
					  <td class="formdrug"><input name="re3" type="checkbox" value="3" <? if($rowform['reason3']=="3") echo "checked=checked"?>/>�. �����觨�������������</td></tr>
					<tr><td>
					<table><tr>
					  <td width="552" class="formdrug">&nbsp;&nbsp;&nbsp;<input name="ch1" type="checkbox" value="1" <? if($rowform['reason2']=="1") echo "checked=checked"?>/>�.� ���������Ѻ�Ҥ����á�Ѻ������ѹ����з�ǧ��ä�ѧ͹حҵ����ԡ����<br />
					  ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					  <input name="week1" type="text" id="week1" size="8" value="<?=$rowform['week1']?>" /><br /> 
					  ������ѹ��� <input name="date11" type="text" id="date11" size="8"  value="<?=$rowform['date11']?>"/> �֧�ѹ��� <input name="date12" type="text" id="date12" size="8" value="<?=$rowform['date12']?>" />
                      </td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<input name="ch2" type="checkbox" value="1" <? if($rowform['ch2']=="1") echo "checked=checked"?>/>
					  �.� �����������Ѻ�������ա�û����Թ�ҡ�þ���Ҵբ�� �֧����ҵ���¡����觨����ҹ�� ���������Ѻ�����觨����Ҥ��駡�͹��������Թ � ��͹������������´�������� �ѧ���<br />
					  ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					  <input name="week2" type="text" id="week2" size="8" value="<?=$rowform['week2']?>" /> 
					  <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� <input name="date21" type="text" id="date21" size="8" value="<?=$rowform['date21']?>" /> �֧�ѹ��� <input name="date22" type="text" id="date22" size="8" value="<?=$rowform['date22']?>"/>
                          <br />
                          ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
				        <input name="week3" type="text" id="week3" size="8" value="<?=$rowform['week3']?>"/> 
					      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� 
				        <input name="date31" type="text" id="date31" size="8" value="<?=$rowform['date31']?>"/> 
					      �֧�ѹ��� <input name="date32" type="text" id="date32" size="8" value="<?=$rowform['date32']?>"/>
                          <br />
					      ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
				        <input name="week4" type="text" id="week4" size="8" value="<?=$rowform['week4']?>" /> 
					      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� 
				        <input name="date41" type="text" id="date41" size="8" value="<?=$rowform['date41']?>"/> 
					      �֧�ѹ��� 
				        <input name="date42" type="text" id="date42" size="8" value="<?=$rowform['date42']?>"/>
                          <br />
					      ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
				        <input name="week5" type="text" id="week5" size="8" value="<?=$rowform['week5']?>" /> 
					      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� <input name="date51" type="text" id="date51" size="8" value="<?=$rowform['date51']?>" /> 
					      �֧�ѹ��� 
		            <input name="date52" type="text" id="date52" size="8" value="<?=$rowform['date52']?>" />
                          </td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<input name="ch3" type="checkbox" value="1" <? if($rowform['reason2']=="3") echo "checked=checked"?>/>�.� ����������ش������� �����¡��� � ��͹ ���Ѻ�����ҡ���纻Ǵ����͹���<br /> 
					  ᾷ������Թ����ѡ��������繤������Ҥ������� ������������´�������� �ѧ���<br />
					  ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹)
					  <input name="week6" type="text" id="week6" size="8" value="<?=$rowform['week6']?>" /> 
					  <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� <input name="date61" type="text" id="date61" size="8" value="<?=$rowform['date61']?>" /> 
				      �֧�ѹ��� <input name="date62" type="text" id="date62" size="8" value="<?=$rowform['date62']?>" />  
					<br />
				      ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
				      <input name="week7" type="text" id="week7" size="8" value="<?=$rowform['week7']?>" /> 
				      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� <input name="date71" type="text" id="date71" size="8" value="<?=$rowform['date71']?>" /> �֧�ѹ��� <input name="date72" type="text" id="date72" size="8" value="<?=$rowform['date72']?>" />
                      <br />
				      ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹)  
				      <input name="week8" type="text" id="week8" size="8" value="<?=$rowform['week8']?>"/> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� <input name="date81" type="text" id="date81" size="8" value="<?=$rowform['date81']?>"/> �֧�ѹ��� <input name="date82" type="text" id="date82" size="8" value="<?=$rowform['date82']?>" />
                      <br />
				      ���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
				      <input name="week9" type="text" id="week9" size="8" value="<?=$rowform['week9']?>"/> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ѹ��� <input name="date91" type="text" id="date91" size="8" value="<?=$rowform['date91']?>"/> 
				      �֧�ѹ��� 
				      <input name="date92" type="text" id="date92" size="8" value="<?=$rowform['date92']?>"/>
                      </td>
					</tr>
					</table>
					</td></tr>
					<tr><td align="center" class="formdrug">
					  <input name="savef5" type="submit" value=" �ѹ�֡ " /></td>
					</tr>
					</table>
			</form>
		<?
					}else{
							echo "����ͧ��͡�������Сͺ�������";
							?>
							<script>
								window.close();
							</script>
							<?
					}
				}
			}
			}
	}
}
elseif(isset($_GET['rowA'])){
	?>
		<script>
        window.print();
        </script>
	<?
	$sqlselectdruga = "select * from dt_drugadd where row_id = '".$_GET['rowA']."'";
	$rowcountdruga = mysql_query($sqlselectdruga);
	$resultcounta = mysql_fetch_array($rowcountdruga);
	?>
	<table width="556" height="500">
	<tr><td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Angiotensin II receptor antagonists (ARBs)</span></td>
	</tr>
	<tr>
	  <td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>�����ż�����</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>���ͼ����� : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>���� : </strong>...<?=$resultcounta[5]?>...<br /><strong> �Է�ԡ���ѡ�� : </strong>...<?=$resultcounta[6]?>...</td>
	</tr>
	<tr>
	  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
	</tr>
	<tr><td>
	<table><tr><td class="formdrug"><strong>�˵ؼŻ�Сͺ������ҡ���� ARBs</strong></td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?> />�. �Դ�ҡ�����֧���ʧ��ҡ������ҡ���� ACEI �ô�к��ҡ�� 
	  ...<? if($resultcounta[8]=="1") echo $resultcounta[9]?>...
	</td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?> />�. �Ҵ��Ҽ����¨����Ѻ����ª��������������Ѻ ACEI �� ������ diabetic kidney disease &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����� protein urea > � g/day</td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="3" <? if($resultcounta[8]=="3") echo "checked='checked'";?> />�. ��� � �ô�к� 
	 ...<? if($resultcounta[8]=="3") echo $resultcounta[9]?>...
	</td>
	</tr>
	</table>
	</td></tr>
	<tr><td>
	<table><tr><td class="formdrug"><strong>�˵ؼŻ�Сͺ������ҡ���� ARBs �������͡�ѭ������ѡ��觪ҵ�</strong></td>
	</tr>
	<tr><td class="formdrug"><input name="d2" type="radio" value="1" <? if($resultcounta[10]=="1") echo "checked='checked'";?>/>�. �� ARB �������㹺ѭ������ѡ��� 
	  ...<? if($resultcounta[10]=="1") echo $resultcounta[11]?>... �����Դ�ҡ�����֧���ʧ��<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ô�к��ҡ�� ...<? if($resultcounta[10]=="1") echo $resultcounta[12]?>...
	</td>
	</tr>
	<tr>
	  <td class="formdrug"><input name="d2" type="radio" value="2" <? if($resultcounta[10]=="2") echo "checked='checked'";?>/>�. �� ARB �������㹺ѭ������ѡ��� 
		...<? if($resultcounta[10]=="2") echo $resultcounta[11]?>... �����������������¢ͧ����ѡ��<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�� ...<? if($resultcounta[10]=="2") echo $resultcounta[12]?>...
	  </td>
	</tr>
	<tr><td class="formdrug"><input name="d2" type="radio" value="3" <? if($resultcounta[10]=="3") echo "checked='checked'";?>/>�. ��� � �ô�к� 
	  ...<? if($resultcounta[10]=="3") echo $resultcounta[11]?>...
	</td>
	</tr>
	</table>
	</td></tr>
    <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />ᾷ�����������<br />�ѹ��� <?=$resultcounta[13]?>
    </td></tr>
	</table>
<?
}
elseif(isset($_GET['rowB'])){
	?>
		<script>
        window.print();
        </script>
	<?
	$sqlselectdruga = "select * from dt_drugadd where row_id = '".$_GET['rowB']."'";
	$rowcountdruga = mysql_query($sqlselectdruga);
	$resultcounta = mysql_fetch_array($rowcountdruga);
	?>
	<table width="556" height="500">
	<tr>
	  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Statins �������͡�ѭ������ѡ��觪ҵ�</span></td>
	</tr>
	<tr>
	  <td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>�����ż�����</strong></td>
	</tr>
	<tr>
	  <td class="formdrug"><strong>���ͼ����� : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>���� : </strong>...<?=$resultcounta[5]?>...<br /><strong> �Է�ԡ���ѡ�� : </strong>...<?=$resultcounta[6]?>...</td>
	</tr>
	<tr>
	  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
	</tr>
	<tr><td>
	<table><tr>
	  <td class="formdrug"><strong>�˵ؼŻ�Сͺ�������</strong></td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?> />�. �Դ�ҡ�����֧���ʧ��ҡ������� Simvastatin �ô�к��ҡ�� 
	  ...<? if($resultcounta[8]=="1") echo $resultcounta[9]?>...
	��мŷҧ��ͧ��Ժѵԡ�� <input name="" type="checkbox" value="1"<? if($resultcounta[8]=="1"&($resultcounta[10]!="")) echo "checked='checked'"; ?>/> AST , ALT  ...<? if($resultcounta[8]=="1"&isset($resultcounta[10])) echo $resultcounta[10]; ?>... <input name="" type="checkbox" value="2" <? if($resultcounta[8]=="1"&($resultcounta[11]!="")) echo "checked='checked'"; ?> /> 
	CPK ...<? if($resultcounta[8]=="1"&isset($resultcounta[11])) echo $resultcounta[11]; ?>... </td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?> />�. ���Ѻ����������Ҩ�Դ Drug interaction �Ѻ Simvastatin ��� ...<? if($resultcounta[8]=="2") echo $resultcounta[9]; ?>...</td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="3" <? if($resultcounta[8]=="3") echo "checked='checked'";?> />�. ���Ѻ Simvastatin ��Ҵ�٧���������ҧ���� 6 ��͹ ���дѺ LDL �ѧ�������������¢ͧ����ѡ�� �����Ѻ Simvastatin 㹢�Ҵ
                 ...<? if($resultcounta[8]=="3") echo $resultcounta[9];?>...
mg ������
...<? if($resultcounta[8]=="3") echo $resultcounta[10];?>...
��͹</td>
	</tr>
    <tr>
	  <td class="formdrug"><input name="d1" type="radio" value="4" <? if($resultcounta[8]=="4") echo "checked='checked'";?> />�. ��� � �ô�к� 
                      ...<? if($resultcounta[8]=="4") echo $resultcounta[9];?>...</td></tr>
	</table>
	</td></tr>
    <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />ᾷ�����������<br />�ѹ��� <?=$resultcounta[13]?>
    </td></tr>
	</table>
<?
}
elseif(isset($_GET['rowC'])){
	?>
		<script>
        window.print();
        </script>
	<?
	$sqlselectdruga = "select * from dt_drugadd where row_id = '".$_GET['rowC']."'";
	$rowcountdruga = mysql_query($sqlselectdruga);
	$resultcounta = mysql_fetch_array($rowcountdruga);
	?>
<table width="556" height="386">
                <tr>
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Proton pump inhibitor (PPIs) <br />�������͡�ѭ������ѡ��觪ҵ�</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>�����ż�����</strong></td>
	</tr>
	<tr>
	  <td height="46" class="formdrug"><strong>���ͼ����� : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>���� : </strong>...<?=$resultcounta[5]?>...<br /><strong> �Է�ԡ���ѡ�� : </strong>...<?=$resultcounta[6]?>...</td>
  </tr>
	<tr>
	  <td height="25" class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
  </tr>
                <tr><td height="136" >
                <table><tr>
                  <td class="formdrug"><strong>�˵ؼŻ�Сͺ�������</strong></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?>/>�. ������ Peptic ulcer ������Ѻ�� Omeprazole ���������ҧ���� � ��͹ �����ͺʹͧ��͡���ѡ�� ������ѡ�ҹ�ʴ� ��� 
                   ...<? if($resultcounta[8]=="1") echo $resultcounta[9];?>...
                </td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?>/>�. ������ GERD ������Ѻ�� Omeprazole ���������ҧ���� � ��͹ �����ͺʹͧ��͡���ѡ��</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="3" <? if($resultcounta[8]=="3") echo "checked='checked'";?>/>�. ��� � �ô�к� 
                 ...<? if($resultcounta[8]=="3") echo $resultcounta[9];?>...
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />ᾷ�����������<br />�ѹ��� <?=$resultcounta[13]?>
    </td></tr>
            </table>
<?	
}
elseif(isset($_GET['rowD'])){
	?>
		<script>
        window.print();
        </script>
	<?
	$sqlselectdruga = "select * from dt_drugadd where row_id = '".$_GET['rowD']."'";
	$rowcountdruga = mysql_query($sqlselectdruga);
	$resultcounta = mysql_fetch_array($rowcountdruga);
	?>
<table width="556" height="500">
                <tr>
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">Ẻ�������Сͺ���������ҡ���� Selective COX-II inhibitors</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>�����ż�����</strong></td>
	</tr>
	<tr>
	  <td height="46" class="formdrug"><strong>���ͼ����� : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>���� : </strong>...<?=$resultcounta[5]?>...<br /><strong> �Է�ԡ���ѡ�� : </strong>...<?=$resultcounta[6]?>...</td>
  </tr>
	<tr>
	  <td height="25" class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
  </tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>�ô��Ǩ�ͺ�����š�͹�������</strong></td>
                </tr>
                <tr>
                  <td class="formdrug">�������ջ���ѵ����ä���� �����ä����������������</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?>/>�. 
                �����</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?>/>�. �� <strong>&gt;&gt;</strong> �����ա����§�������</td>
                </tr>
                </table>
                </td></tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>�˵ؼŻ�Сͺ�������</strong></td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="1" <? if($resultcounta[9]=="1") echo "checked='checked'";?>/><strong>Acute pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="1" <? if($resultcounta[9]=="1"&$resultcounta[10]=="1") echo "checked='checked'";?>/>�. �������ջ���ѵ��� Non-selective COX inhibitor Ẻ�ع�ç����Ẻ pseudo-allergy ����Ҩ���ҡ���� Non-selective COX inhibitor ��駡����
                </td>
                </tr>
                <tr>
                  <td class="formdrug">
                    &nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="2" <? if($resultcounta[9]=="1"&$resultcounta[10]=="2") echo "checked='checked'";?>/>�. �������ջѨ�������§����Ҩ�Դ�ҡ�����֧���ʧ��ҡ������ҡ���� Non-selective COX inhibitor ���ҧ���� � ��� ���仹��<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ����ѡ�ҹ�ʴ���Ҽ������� recent Gl bleeding,peptic ulcer, Gl perforation<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ���� �� �� ����<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ���Ѻ����������������͡���Դ Gl adverse event ���ҡ��� �� warfarin , aspirin, clopidogrel,corticosteroids
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="3" <? if($resultcounta[9]=="1"&$resultcounta[10]=="3") echo "checked='checked'";?>/>�. ��� � �ô�к� 
                  ...<? if($resultcounta[9]=="1"&$resultcounta[10]=="3") echo $resultcounta[11];?>...
                </td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="2" <? if($resultcounta[9]=="2") echo "checked='checked'";?>/><strong>Chronic pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="1" <? if($resultcounta[9]=="2"&$resultcounta[10]=="1") echo "checked='checked'";?>/>�. �������� Non-selective COX inhibitor �����Ѻ PPI �����ѧ���Դ�ҡ�����֧���ʧ��ҡ�������</td>
                </tr>
                <tr>
                  <td class="formdrug">
                   &nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="2" <? if($resultcounta[9]=="2"&$resultcounta[10]=="2") echo "checked='checked'";?>/>�. �������ջ���ѵ����� Non-selective COX inhibitor Ẻ�ع�ç����Ẻ pseudo-allergy ����Ҩ���ҡ���� Non-selective COX inhibitor ��駡���� 
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="3" <? if($resultcounta[9]=="2"&$resultcounta[10]=="3") echo "checked='checked'";?>/>�. ��� � �ô�к� 
                 ...<? if($resultcounta[9]=="2"&$resultcounta[10]=="3") echo $resultcounta[11];?>...
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />ᾷ�����������<br />�ѹ��� <?=$resultcounta[13]?>
    </td></tr>
            </table>
<?	
}
elseif(isset($_GET['rowE'])){
	?>
		<script>
        window.print();
        </script>
	<?
	$sqlselectdruga = "select * from drug_gruco where row_id = '".$_GET['rowE']."'";
	$rowcountdruga = mysql_query($sqlselectdruga);
	$resultcounta = mysql_fetch_array($rowcountdruga);
	
	$idcard = "select idcard from opcard where hn='".$resultcounta['hn']."'";
	 $rowidcard = mysql_query($idcard);
	 $resultidcard = mysql_fetch_array($rowidcard);
	?>
		<table width="773" height="500">
					<tr>
					  <td width="765" height="62" align="center" class="formdrug"><span class="formdrug1">��Ѻ�ͧ������ҡ��⤫��չ���࿵<br />
					  </span>�ô�����������´����ѡ�Ҿ�Һ�����ú�ء���</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>��Ҿ���</strong>
					    ...<?=$resultcounta['name_doc']?>...
				      <strong>�Ţ����Ǫ����</strong> ...<?=$resultcounta['num_doc']?>...</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>ᾷ��੾�зҧ�Ң�</strong>
				      <? if($resultcounta['fac']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> �����ᾷ���ä��� 
				      <? if($resultcounta['fac']=="2") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> �Ǫ��ʵ���鹿� 
					  <? if($resultcounta['fac']=="3") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> ����⸻Դԡ��</td>
					</tr>
					<tr>
					  <td class="formdrugd"><strong>����ʶҹ��Һ�� </strong>...<?=$resultcounta['hospital']?>... 
					  <strong>�ѧ��Ѵ </strong>...<?=$resultcounta['province']?>...<br />
					  <strong>���Ѻ�ͧ��� :</strong> ...<?=$resultcounta['name_pt']?>... <strong>HN</strong> : ...<?=$resultcounta['hn']?>... <strong>���� : </strong>...<?=$resultcounta['age']?>...<br />
					  <strong>�Ţ�ѵû��.</strong>&nbsp;<?=$resultidcard['idcard']?></td>
					</tr>
					<tr>
					  <td class="formdrug"><br /><? if($resultcounta['reason1']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>				        �. ���������ҹ����ѡ�����ҧ͹��ѡ��������ҧ�������������� ᾷ����繤��������ҡ��⤫��չ���࿵</td>
					</tr>
					<tr>
					  <td class="formdrug"><? if($resultcounta['reason2']=="2") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>				        �. ������������仵���Ƿҧ�ӡѺ������ҡ��⤫��չ���࿵�ͧ�Ҫ�Է�����ᾷ������⸻Դԡ����觻������<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���˹ѧ��͡�з�ǧ��ä�ѧ��ǹ����ش ��� �� ����.�/��� ŧ�ѹ��� �� �Զع�¹ ����</td></tr>
                      <tr>
					  <td class="formdrug"><? if($resultcounta['reason3']=="3") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> �. �����觨�������������</td></tr>
					<tr><td>
					<table><tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<? if($resultcounta['ch1']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> �.� ���������Ѻ�Ҥ����á�Ѻ������ѹ����з�ǧ��ä�ѧ͹حҵ����ԡ����<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					  ...<?=$resultcounta['week1']; ?>...
					  ������ѹ��� ...<?=$resultcounta['date11']; ?>... �֧�ѹ��� ...<?=$resultcounta['date12']; ?>...</td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<? if($resultcounta['ch2']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>
					  �.� �����������Ѻ�������ա�û����Թ�ҡ�þ���Ҵբ�� �֧����ҵ���¡����觨����ҹ�� ���������Ѻ�����觨����Ҥ��駡�͹����<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����Թ � ��͹������������´�������� �ѧ���<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					  ...<?=$resultcounta['week2']; ?>... ������ѹ��� ...<?=$resultcounta['date21']; ?>...
					    �֧�ѹ��� 
				        ...<?=$resultcounta['date22']; ?>...<br />
					      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					     ...<?=$resultcounta['week3']; ?>... ������ѹ��� 
					      ...<?=$resultcounta['date31']; ?>...
�֧�ѹ��� ...<?=$resultcounta['date32']; ?>...<br />
					      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					      ...<?=$resultcounta['week4']; ?>... ������ѹ��� 
					      ...<?=$resultcounta['date41']; ?>...
					      �֧�ѹ��� 
			          ...<?=$resultcounta['date42']; ?>...<br />
					      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					      ...<?=$resultcounta['week5']; ?>...&nbsp;������ѹ��� ...<?=$resultcounta['date51']; ?>...
					      �֧�ѹ��� 
					      ...<?=$resultcounta['date52']; ?>...</td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<? if($resultcounta['ch3']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>				        �.� ����������ش������� �����¡��� � ��͹ ���Ѻ�����ҡ���纻Ǵ����͹��� ᾷ������Թ����ѡ������<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��繤������Ҥ������� ������������´�������� �ѧ���<br />
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
					  ...<?=$resultcounta['week6']; ?>...
					  ������ѹ��� ...<?=$resultcounta['date61']; ?>... �֧�ѹ��� ...<?=$resultcounta['date62']; ?>...<br />
				      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
				      ...<?=$resultcounta['week7']; ?>... ������ѹ��� ...<?=$resultcounta['date71']; ?>... �֧�ѹ��� ...<?=$resultcounta['date72']; ?>...<br />
				      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹)  
				      ...<?=$resultcounta['week8']; ?>... ������ѹ��� ...<?=$resultcounta['date81']; ?>... �֧�ѹ��� ...<? if($resultcounta['reason1']=="3"&$resultcounta['reason2']=="3") echo $resultcounta['date82']; ?>...<br />
				      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���駷�� � ����ҳ�ҵ�ͤ���(�ѻ����/��͹) 
				      ...<?=$resultcounta['week9']; ?>... 
				      ������ѹ��� ...<?=$resultcounta['date91']; ?>...
				      �֧�ѹ��� 
				      ...<?=$resultcounta['date92']; ?>...</td>
					</tr>
					</table>
					</td></tr>
					<tr><td align="center" class="formdrug"><br />
					  <br />
					  ŧ���� ...<?=$resultcounta['name_doc']?>...<br />�ѹ��� <?=$resultcounta['dateup']?></td>
					</tr>
                    
					</table>
<?
}
?>
<script>focus()</script>