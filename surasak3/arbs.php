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
		alert("กรุณาเลือกแพทย์เฉพาะทางสาขา");
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
				echo "บันทึกข้อมูลเรียบร้อยแล้ว";	
			}
			else{
				echo "ไม่สามารถบันทึกข้อมูลได้";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="ปิดหน้าต่าง" />
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
				echo "บันทึกข้อมูลเรียบร้อยแล้ว";	
			}
			else{
				echo "ไม่สามารถบันทึกข้อมูลได้";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="ปิดหน้าต่าง" />
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
				echo "บันทึกข้อมูลเรียบร้อยแล้ว";	
			}
			else{
				echo "ไม่สามารถบันทึกข้อมูลได้";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="ปิดหน้าต่าง" />
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
				echo "บันทึกข้อมูลเรียบร้อยแล้ว";	
			}
			else{
				echo "ไม่สามารถบันทึกข้อมูลได้";	
				?>
			<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="ปิดหน้าต่าง" />
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
				echo "บันทึกข้อมูลเรียบร้อยแล้ว";	
			}
			else{
				echo "ไม่สามารถบันทึกข้อมูลได้";	
				?>
				<script>
                window.location.href = 'arbs.php?name='<?=$_GET['name']?>;
                </script>
				<?
			}
			?>
            <br />
			<input name="close" type="button" onclick="window.close()" value="ปิดหน้าต่าง" />
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
	      <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Angiotensin II receptor antagonists (ARBs)</span></td>
        </tr>
	    <tr>
	      <td align="center" class="formdrug"><span class="formdrug1">-....
	        <?=$_SESSION['nn']?>
	        ....- </span></td>
        </tr>
	    <tr>
	      <td class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
        </tr>
	    <tr>
	      <td class="formdrug"><strong>ชื่อผู้ป่วย : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?> <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?> <strong>AN : - </strong> <strong>อายุ : </strong><?php echo $_SESSION["age_now"];?><br />
	        <strong> สิทธิการรักษา :</strong> <?php echo $_SESSION["ptright_now"];?></td>
        </tr>
	    <tr>
	      <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	        <input name="diag2" type="text" size="30" /></td>
        </tr>
	    <tr>
	      <td><table>
	        <tr>
	          <td class="formdrug"><strong>เหตุผลประกอบการใช้ยากลุ่ม ARBs</strong></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d1" type="radio" value="1" />
	            ๑. เกิดอาการไม่พึงประสงค์จากการใช้ยากลุ่ม ACEI โปรดระบุอาการ
	            <input name="reason8" type="text" size="15" /></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d1" type="radio" value="2" />
	            ๒. คาดว่าผู้ป่วยจะได้รับประโยชน์เมื่อใช้ร่วมกับ ACEI เช่น ผู้ป่วย diabetic kidney disease &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ที่มี protein urea > ๓ g/day</td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d1" type="radio" value="3" />
	            ๓. อื่น ๆ โปรดระบุ
	            <input name="reason8" type="text" size="20" /></td>
            </tr>
	        </table></td>
        </tr>
	    <tr>
	      <td><table>
	        <tr>
	          <td class="formdrug"><strong>เหตุผลประกอบการใช้ยากลุ่ม ARBs ที่อยู่นอกบัญชียาหลักแห่งชาติ</strong></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d2" type="radio" value="1" />
	            ๑. ใช้ ARB ที่อยู่ในบัญชียาหลักคือ
	            <input name="reason8" type="text" size="15" />
	            แล้วเกิดอาการไม่พึงประสงค์<br />
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรดระบุอาการ
	            <input name="reason8" type="text" size="15" /></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d2" type="radio" value="2" />
	            ๒. ใช้ ARB ที่อยู่ในบัญชียาหลักคือ
	            <input name="reason8" type="text" size="15" />
	            แล้วไม่บรรลุเป้าหมายของการรักษา<br />
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โดย
	            <input name="reason8" type="text" size="15" /></td>
            </tr>
	        <tr>
	          <td class="formdrug"><input name="d2" type="radio" value="3" />
	            ๓. อื่น ๆ โปรดระบุ
	            <input name="reason8" type="text" size="20" /></td>
            </tr>
	        </table></td>
        </tr>
	    <tr>
	      <td align="center" class="formdrug"><input name="savef" type="submit" value=" บันทึก " /></td>
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
                <tr><td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Statins <br /> ที่อยู่นอกบัญชียาหลักแห่งชาติ</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><span class="formdrug1">-....<?=$_SESSION['nn']?>....-
                </span></td>
                </tr>
                <tr><td class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
                </tr>
                <tr><td class="formdrug"><strong>ชื่อผู้ป่วย : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?>  <strong>AN : - </strong> <strong>อายุ : </strong><?php echo $_SESSION["age_now"];?><br /><strong> สิทธิการรักษา :</strong> <?php echo $_SESSION["ptright_now"];?></td>
                </tr>
                <tr>
	  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  <input name="diag" type="text" size="30" />
	</td>
	</tr>
                <tr>
                  <td class="formdrug"><strong>ผลการตรวจทางห้องปฏิบัติการ <br />LDL : </strong>
                    <input name="lab1" type="text" size="15" /> mg/dl (วันที่ <input name="datelab" value="<?=date("d-m-Y");?>" type="text" />)
                </td>
                </tr>
                <tr>
                  <td>
                <table><tr>
                  <td class="formdrug"><strong>เหตุผลประกอบการใช้ยา</strong></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" />๑. เกิดอาการไม่พึงประสงค์จากการใช้ยา Simvastatin โปรดระบุอาการ
                  <input name="reason1" type="text" size="15" />
และผลทางห้องปฏิบัติการ
<input type="checkbox" value="1" name="lab1" /> 
AST, ALT 
<input name="reason2" type="text" size="10"  /> <input type="checkbox" value="2" name="lab2" /> CPK <input name="reason3" type="text" size="10"  /></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" />๒. ได้รับยาร่วมที่อาจเกิด Drug interaction กับ Simvastatin คือ 
                  <input name="reason4" type="text" size="15" /></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="3" />๓. ได้รับ Simvastatin ขนาดสูงมาแล้วอย่างน้อย 6 เดือน แต่ระดับ LDL ยังไม่บรรลุเป้าหมายของการรักษา โดยได้รับ Simvastatin ในขนาด
                  <input name="reason5" type="text" size="5" />
mg มาแล้ว
<input name="reason6" type="text" size="5" />
เดือน </td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="4" />๔. อื่น ๆ โปรดระบุ 
                      <input name="reason7" type="text" size="20" />
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug">
                  <input name="savef2" type="submit" value=" บันทึก " /></td>
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
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Proton pump inhibitor (PPIs) <br />ที่อยู่นอกบัญชียาหลักแห่งชาติ</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><span class="formdrug1">-....<?=$_SESSION['nn']?>....-
                </span></td>
                </tr>
                <tr><td height="27" class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
                </tr>
                <tr><td height="83" class="formdrug"><strong>ชื่อผู้ป่วย : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?>  <strong>AN : - </strong> <strong>อายุ : </strong><?php echo $_SESSION["age_now"];?><br /><strong> สิทธิการรักษา :</strong> <?php echo $_SESSION["ptright_now"];?></td>
                </tr>
                <tr>
                  <td height="30" class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
                  <input name="diag" type="text" size="30" />
                </td>
                </tr>
                <tr><td height="158">
                <table><tr>
                  <td class="formdrug"><strong>เหตุผลประกอบการใช้ยา</strong></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" />๑. ผู้ป่วย Peptic ulcer ที่ได้รับยา Omeprazole มาแล้วอย่างน้อย ๑ เดือน แต่ไม่ตอบสนองต่อการรักษา โดยมีหลักฐานแสดง คือ 
                    <input name="reason1" type="text" size="15" />
                </td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" />๒. ผู้ป่วย GERD ที่ได้รับยา Omeprazole มาแล้วอย่างน้อย ๑ เดือน แต่ไม่ตอบสนองต่อการรักษา</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="3" />๓. อื่น ๆ โปรดระบุ 
                  <input name="reason2" type="text" size="20" />
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug">
                  <input name="savef3" type="submit" value=" บันทึก " /></td>
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
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Selective COX-II inhibitors</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><span class="formdrug1">-....<?=$_SESSION['nn']?>....-
                </span></td>
                </tr>
                <tr><td class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
                </tr>
                <tr><td class="formdrug"><strong>ชื่อผู้ป่วย : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?>  <strong>HN :</strong> <?php echo $_SESSION["hn_now"];?>  <strong>AN : - </strong> <strong>อายุ : </strong><?php echo $_SESSION["age_now"];?><br /><strong> สิทธิการรักษา :</strong> <?php echo $_SESSION["ptright_now"];?></td>
                </tr>
                <tr>
                  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
                  <input name="diag" type="text" size="30" />
                </td>
                </tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>โปรดตรวจสอบข้อมูลก่อนสั่งใช้ยา</strong></td>
                </tr>
                <tr>
                  <td class="formdrug">ผู้ป่วยมีประวัติเป็นโรคหัวใจ หรือโรคไตร่วมด้วยหรือไม่</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" />๑. 
                ไม่มี</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" />๒. มี <strong>&gt;&gt;</strong> ควรหลีกเลี่ยงการใช้ยา</td>
                </tr>
                </table>
                </td></tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>เหตุผลประกอบการใช้ยา</strong></td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="1" /><strong>Acute pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="1" />๑. ผู้ป่วยมีประวัติแพ้ Non-selective COX inhibitor แบบรุนแรงหรือแบบ pseudo-allergy ที่อาจแพ้ยากลุ่ม Non-selective COX inhibitor ทั้งกลุ่ม
                </td>
                </tr>
                <tr>
                  <td class="formdrug">
                    &nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="2" />๒. ผู้ป่วยมีปัจจัยเสี่ยงที่อาจเกิดอาการไม่พึงประสงค์จากการใช้ยากลุ่ม Non-selective COX inhibitor อย่างน้อย ๑ ข้อ ต่อไปนี้<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- มีหลักฐานแสดงว่าผู้ป่วยมี recent Gl bleeding,peptic ulcer, Gl perforation<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- อายุ ๖๕ ปี ขึ้นไป<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ได้รับยาร่วมที่ทำให้มีโอกาสเกิด Gl adverse event ได้มากขึ้น เช่น warfarin , aspirin, clopidogrel,corticosteroids
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="3" />๓. อื่น ๆ โปรดระบุ 
                  <input name="reason3" type="text" size="20" />
                </td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="2" /><strong>Chronic pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="1" />๑. ผู้ป่วยใช้ Non-selective COX inhibitor ร่วมกับ PPI แล้วยังคงเกิดอาการไม่พึงประสงค์จากการใช้ยา</td>
                </tr>
                <tr>
                  <td class="formdrug">
                   &nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="2" />๒. ผู้ป่วยมีประวัติแพ้ยา Non-selective COX inhibitor แบบรุนแรงหรือแบบ pseudo-allergy ที่อาจแพ้ยากลุ่ม Non-selective COX inhibitor ทั้งกลุ่ม 
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="3" />๓. อื่น ๆ โปรดระบุ 
                  <input name="reason4" type="text" size="20" />
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug">
                  <input name="savef4" type="submit" value=" บันทึก " /></td>
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
					  <td width="567" height="62" align="center" class="formdrug"><span class="formdrug1">ใบรับรองการใช้ยากลูโคซามีนซัลเฟต<br />
					  </span>โปรดใส่รายละเอียดการรักษาพยาบาลให้ครบทุกข้อ</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>ข้าพเจ้า</strong>
                      <?
     $dr = "select codedoctor from inputm where name = '".$_SESSION["dt_doctor"]."'";
	 $rowdr = mysql_query($dr);
	 $resultdr = mysql_fetch_array($rowdr);
	 
	 
					  ?>
				      <input name="name_doc" type="text" size="20" value="<?=$_SESSION["dt_doctor"]?>"/> <strong>เลขที่เวชกรรม</strong>				      <input name="num_doc" type="text" size="20" value="<?=$resultdr['codedoctor']?>" /></td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>แพทย์เฉพาะทางสาขา</strong>
				        (กรุณาเลือก)<br />
			          <input name="fac" type="radio" value="1" />อายุรแพทย์โรคข้อ <input name="fac" type="radio" value="2" <? if($resultdr['codedoctor']=='32140') echo "checked";?>/>เวชศาสตร์ฟื้นฟู <input name="fac" type="radio" value="3" <? if($resultdr['codedoctor']=='20182'||$resultdr['codedoctor']=='19921') echo "checked";?>/>ออร์โธปิดิกส์</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>ชื่อสถานพยาบาล <input name="hospital" type="text" id="hospital" value="โรงพยาบาลค่ายสุรศักดิ์มนตรี" size="25" /> 
					  จังหวัด <input name="province" type="text" id="province" value="ลำปาง" size="8" /><br />ขอรับรองว่า(ชื่อ-สกุล ผู้ป่วย) : </strong><?php echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];?><br /><strong>อายุ : </strong><?php echo $_SESSION["age_now"];?></td>
					</tr>
					<tr>
					  <td class="formdrug"><input name="re1" type="checkbox" value="1" <? if($rowform['reason1']=="1") echo "checked=checked"?>/>๑. ผู้ป่วยได้ผ่านการรักษาอย่างอนุรักษ์นิยมอย่างเต็มที่แต่ไม่ได้ผล<br />&nbsp;&nbsp;&nbsp; แพทย์เห็นควรให้ใช้ยากลูโคซามีนซัลเฟต</td>
					</tr>
					<tr>
					  <td class="formdrug"><input name="re2" type="checkbox" value="2" <? if($rowform['reason2']=="2") echo "checked=checked"?>/>๒. การสั่งใช้ยาเป็นไปตามแนวทางกำกับการใช้ยากลูโคซามีนซัลเฟต<br />&nbsp;&nbsp;&nbsp;&nbsp;ของราชวิทยาลัยแพทย์ออร์โธปิดิกส์แห่งประเทศไทยตามหนังสือกระทรวงการคลัง<br /> &nbsp;&nbsp;&nbsp;&nbsp;ด่วนที่สุด ที่ กค ๐๕๒๒๒/ว๖๒ ลงวันที่ ๒๘ มิถุนายน ๒๕๕๔</td></tr>
                      <tr>
					  <td class="formdrug"><input name="re3" type="checkbox" value="3" <? if($rowform['reason3']=="3") echo "checked=checked"?>/>๓. การสั่งจ่ายยาให้ผู้ป่วย</td></tr>
					<tr><td>
					<table><tr>
					  <td width="552" class="formdrug">&nbsp;&nbsp;&nbsp;<input name="ch1" type="checkbox" value="1" <? if($rowform['reason2']=="1") echo "checked=checked"?>/>๓.๑ ผู้ป่วยได้รับยาครั้งแรกนับตั้งแต่วันที่กระทรวงการคลังอนุญาตให้เบิกจ่าย<br />
					  ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					  <input name="week1" type="text" id="week1" size="8" value="<?=$rowform['week1']?>" /><br /> 
					  ตั้งแต่วันที่ <input name="date11" type="text" id="date11" size="8"  value="<?=$rowform['date11']?>"/> ถึงวันที่ <input name="date12" type="text" id="date12" size="8" value="<?=$rowform['date12']?>" />
                      </td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<input name="ch2" type="checkbox" value="1" <? if($rowform['ch2']=="1") echo "checked=checked"?>/>
					  ๓.๒ ผู้ป่วยเคยได้รับยาแล้วมีการประเมินอาการพบว่าดีขึ้น จึงให้ยาต่อโดยการสั่งจ่ายยานั้น เมื่อรวมกับการสั่งจ่ายยาครั้งก่อนแล้วไม่เกิน ๖ เดือนโดยมีรายละเอียดการสั่งยา ดังนี้<br />
					  ครั้งที่ ๑ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					  <input name="week2" type="text" id="week2" size="8" value="<?=$rowform['week2']?>" /> 
					  <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ <input name="date21" type="text" id="date21" size="8" value="<?=$rowform['date21']?>" /> ถึงวันที่ <input name="date22" type="text" id="date22" size="8" value="<?=$rowform['date22']?>"/>
                          <br />
                          ครั้งที่ ๒ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
				        <input name="week3" type="text" id="week3" size="8" value="<?=$rowform['week3']?>"/> 
					      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ 
				        <input name="date31" type="text" id="date31" size="8" value="<?=$rowform['date31']?>"/> 
					      ถึงวันที่ <input name="date32" type="text" id="date32" size="8" value="<?=$rowform['date32']?>"/>
                          <br />
					      ครั้งที่ ๓ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
				        <input name="week4" type="text" id="week4" size="8" value="<?=$rowform['week4']?>" /> 
					      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ 
				        <input name="date41" type="text" id="date41" size="8" value="<?=$rowform['date41']?>"/> 
					      ถึงวันที่ 
				        <input name="date42" type="text" id="date42" size="8" value="<?=$rowform['date42']?>"/>
                          <br />
					      ครั้งที่ ๔ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
				        <input name="week5" type="text" id="week5" size="8" value="<?=$rowform['week5']?>" /> 
					      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ <input name="date51" type="text" id="date51" size="8" value="<?=$rowform['date51']?>" /> 
					      ถึงวันที่ 
		            <input name="date52" type="text" id="date52" size="8" value="<?=$rowform['date52']?>" />
                          </td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<input name="ch3" type="checkbox" value="1" <? if($rowform['reason2']=="3") echo "checked=checked"?>/>๓.๓ ผู้ป่วยได้หยุดการใช้ยา ไม่น้อยกว่า ๓ เดือน แต่กลับมามีอาการเจ็บปวดเหมือนเดิม<br /> 
					  แพทย์ประเมินการรักษาแล้วเห็นควรให้ยาครั้งใหม่ โดยมีรายละเอียดการสั่งยา ดังนี้<br />
					  ครั้งที่ ๑ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน)
					  <input name="week6" type="text" id="week6" size="8" value="<?=$rowform['week6']?>" /> 
					  <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ <input name="date61" type="text" id="date61" size="8" value="<?=$rowform['date61']?>" /> 
				      ถึงวันที่ <input name="date62" type="text" id="date62" size="8" value="<?=$rowform['date62']?>" />  
					<br />
				      ครั้งที่ ๒ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
				      <input name="week7" type="text" id="week7" size="8" value="<?=$rowform['week7']?>" /> 
				      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ <input name="date71" type="text" id="date71" size="8" value="<?=$rowform['date71']?>" /> ถึงวันที่ <input name="date72" type="text" id="date72" size="8" value="<?=$rowform['date72']?>" />
                      <br />
				      ครั้งที่ ๓ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน)  
				      <input name="week8" type="text" id="week8" size="8" value="<?=$rowform['week8']?>"/> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ <input name="date81" type="text" id="date81" size="8" value="<?=$rowform['date81']?>"/> ถึงวันที่ <input name="date82" type="text" id="date82" size="8" value="<?=$rowform['date82']?>" />
                      <br />
				      ครั้งที่ ๔ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
				      <input name="week9" type="text" id="week9" size="8" value="<?=$rowform['week9']?>"/> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตั้งแต่วันที่ <input name="date91" type="text" id="date91" size="8" value="<?=$rowform['date91']?>"/> 
				      ถึงวันที่ 
				      <input name="date92" type="text" id="date92" size="8" value="<?=$rowform['date92']?>"/>
                      </td>
					</tr>
					</table>
					</td></tr>
					<tr><td align="center" class="formdrug">
					  <input name="savef5" type="submit" value=" บันทึก " /></td>
					</tr>
					</table>
			</form>
		<?
					}else{
							echo "ไม่ต้องกรอกฟอร์มประกอบการใช้ยา";
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
	<tr><td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Angiotensin II receptor antagonists (ARBs)</span></td>
	</tr>
	<tr>
	  <td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>ชื่อผู้ป่วย : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>อายุ : </strong>...<?=$resultcounta[5]?>...<br /><strong> สิทธิการรักษา : </strong>...<?=$resultcounta[6]?>...</td>
	</tr>
	<tr>
	  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
	</tr>
	<tr><td>
	<table><tr><td class="formdrug"><strong>เหตุผลประกอบการใช้ยากลุ่ม ARBs</strong></td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?> />๑. เกิดอาการไม่พึงประสงค์จากการใช้ยากลุ่ม ACEI โปรดระบุอาการ 
	  ...<? if($resultcounta[8]=="1") echo $resultcounta[9]?>...
	</td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?> />๒. คาดว่าผู้ป่วยจะได้รับประโยชน์เมื่อใช้ร่วมกับ ACEI เช่น ผู้ป่วย diabetic kidney disease &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ที่มี protein urea > ๓ g/day</td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="3" <? if($resultcounta[8]=="3") echo "checked='checked'";?> />๓. อื่น ๆ โปรดระบุ 
	 ...<? if($resultcounta[8]=="3") echo $resultcounta[9]?>...
	</td>
	</tr>
	</table>
	</td></tr>
	<tr><td>
	<table><tr><td class="formdrug"><strong>เหตุผลประกอบการใช้ยากลุ่ม ARBs ที่อยู่นอกบัญชียาหลักแห่งชาติ</strong></td>
	</tr>
	<tr><td class="formdrug"><input name="d2" type="radio" value="1" <? if($resultcounta[10]=="1") echo "checked='checked'";?>/>๑. ใช้ ARB ที่อยู่ในบัญชียาหลักคือ 
	  ...<? if($resultcounta[10]=="1") echo $resultcounta[11]?>... แล้วเกิดอาการไม่พึงประสงค์<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรดระบุอาการ ...<? if($resultcounta[10]=="1") echo $resultcounta[12]?>...
	</td>
	</tr>
	<tr>
	  <td class="formdrug"><input name="d2" type="radio" value="2" <? if($resultcounta[10]=="2") echo "checked='checked'";?>/>๒. ใช้ ARB ที่อยู่ในบัญชียาหลักคือ 
		...<? if($resultcounta[10]=="2") echo $resultcounta[11]?>... แล้วไม่บรรลุเป้าหมายของการรักษา<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โดย ...<? if($resultcounta[10]=="2") echo $resultcounta[12]?>...
	  </td>
	</tr>
	<tr><td class="formdrug"><input name="d2" type="radio" value="3" <? if($resultcounta[10]=="3") echo "checked='checked'";?>/>๓. อื่น ๆ โปรดระบุ 
	  ...<? if($resultcounta[10]=="3") echo $resultcounta[11]?>...
	</td>
	</tr>
	</table>
	</td></tr>
    <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />แพทย์ผู้สั่งใช้ยา<br />วันที่ <?=$resultcounta[13]?>
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
	  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Statins ที่อยู่นอกบัญชียาหลักแห่งชาติ</span></td>
	</tr>
	<tr>
	  <td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
	</tr>
	<tr>
	  <td class="formdrug"><strong>ชื่อผู้ป่วย : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>อายุ : </strong>...<?=$resultcounta[5]?>...<br /><strong> สิทธิการรักษา : </strong>...<?=$resultcounta[6]?>...</td>
	</tr>
	<tr>
	  <td class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
	</tr>
	<tr><td>
	<table><tr>
	  <td class="formdrug"><strong>เหตุผลประกอบการใช้ยา</strong></td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?> />๑. เกิดอาการไม่พึงประสงค์จากการใช้ยา Simvastatin โปรดระบุอาการ 
	  ...<? if($resultcounta[8]=="1") echo $resultcounta[9]?>...
	และผลทางห้องปฏิบัติการ <input name="" type="checkbox" value="1"<? if($resultcounta[8]=="1"&($resultcounta[10]!="")) echo "checked='checked'"; ?>/> AST , ALT  ...<? if($resultcounta[8]=="1"&isset($resultcounta[10])) echo $resultcounta[10]; ?>... <input name="" type="checkbox" value="2" <? if($resultcounta[8]=="1"&($resultcounta[11]!="")) echo "checked='checked'"; ?> /> 
	CPK ...<? if($resultcounta[8]=="1"&isset($resultcounta[11])) echo $resultcounta[11]; ?>... </td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?> />๒. ได้รับยาร่วมที่อาจเกิด Drug interaction กับ Simvastatin คือ ...<? if($resultcounta[8]=="2") echo $resultcounta[9]; ?>...</td>
	</tr>
	<tr><td class="formdrug"><input name="d1" type="radio" value="3" <? if($resultcounta[8]=="3") echo "checked='checked'";?> />๓. ได้รับ Simvastatin ขนาดสูงมาแล้วอย่างน้อย 6 เดือน แต่ระดับ LDL ยังไม่บรรลุเป้าหมายของการรักษา โดยได้รับ Simvastatin ในขนาด
                 ...<? if($resultcounta[8]=="3") echo $resultcounta[9];?>...
mg มาแล้ว
...<? if($resultcounta[8]=="3") echo $resultcounta[10];?>...
เดือน</td>
	</tr>
    <tr>
	  <td class="formdrug"><input name="d1" type="radio" value="4" <? if($resultcounta[8]=="4") echo "checked='checked'";?> />๔. อื่น ๆ โปรดระบุ 
                      ...<? if($resultcounta[8]=="4") echo $resultcounta[9];?>...</td></tr>
	</table>
	</td></tr>
    <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />แพทย์ผู้สั่งใช้ยา<br />วันที่ <?=$resultcounta[13]?>
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
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Proton pump inhibitor (PPIs) <br />ที่อยู่นอกบัญชียาหลักแห่งชาติ</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
	</tr>
	<tr>
	  <td height="46" class="formdrug"><strong>ชื่อผู้ป่วย : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>อายุ : </strong>...<?=$resultcounta[5]?>...<br /><strong> สิทธิการรักษา : </strong>...<?=$resultcounta[6]?>...</td>
  </tr>
	<tr>
	  <td height="25" class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
  </tr>
                <tr><td height="136" >
                <table><tr>
                  <td class="formdrug"><strong>เหตุผลประกอบการใช้ยา</strong></td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?>/>๑. ผู้ป่วย Peptic ulcer ที่ได้รับยา Omeprazole มาแล้วอย่างน้อย ๑ เดือน แต่ไม่ตอบสนองต่อการรักษา โดยมีหลักฐานแสดง คือ 
                   ...<? if($resultcounta[8]=="1") echo $resultcounta[9];?>...
                </td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?>/>๒. ผู้ป่วย GERD ที่ได้รับยา Omeprazole มาแล้วอย่างน้อย ๑ เดือน แต่ไม่ตอบสนองต่อการรักษา</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="3" <? if($resultcounta[8]=="3") echo "checked='checked'";?>/>๓. อื่น ๆ โปรดระบุ 
                 ...<? if($resultcounta[8]=="3") echo $resultcounta[9];?>...
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />แพทย์ผู้สั่งใช้ยา<br />วันที่ <?=$resultcounta[13]?>
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
                  <td width="548" height="62" align="center" class="formdrug"><span class="formdrug1">แบบฟอร์มประกอบการสั่งใช้ยากลุ่ม Selective COX-II inhibitors</span></td>
                </tr>
                <tr><td align="center" class="formdrug"><strong>-....<?=$resultcounta[1]?>....-</strong></td>
	</tr>
	<tr><td class="formdrug"><strong>ข้อมูลผู้ป่วย</strong></td>
	</tr>
	<tr>
	  <td height="46" class="formdrug"><strong>ชื่อผู้ป่วย : </strong>...<?=$resultcounta[2]?>... <strong>HN :</strong> ...<?=$resultcounta[3]?>...  <strong>AN :</strong> ...-...  <strong>อายุ : </strong>...<?=$resultcounta[5]?>...<br /><strong> สิทธิการรักษา : </strong>...<?=$resultcounta[6]?>...</td>
  </tr>
	<tr>
	  <td height="25" class="formdrug"><strong>Diagnosis/Underlying disease : </strong>
	  ...<?=$resultcounta[7]?>...
	</td>
  </tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>โปรดตรวจสอบข้อมูลก่อนสั่งใช้ยา</strong></td>
                </tr>
                <tr>
                  <td class="formdrug">ผู้ป่วยมีประวัติเป็นโรคหัวใจ หรือโรคไตร่วมด้วยหรือไม่</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="1" <? if($resultcounta[8]=="1") echo "checked='checked'";?>/>๑. 
                ไม่มี</td>
                </tr>
                <tr><td class="formdrug"><input name="d1" type="radio" value="2" <? if($resultcounta[8]=="2") echo "checked='checked'";?>/>๒. มี <strong>&gt;&gt;</strong> ควรหลีกเลี่ยงการใช้ยา</td>
                </tr>
                </table>
                </td></tr>
                <tr><td>
                <table><tr>
                  <td class="formdrug"><strong>เหตุผลประกอบการใช้ยา</strong></td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="1" <? if($resultcounta[9]=="1") echo "checked='checked'";?>/><strong>Acute pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="1" <? if($resultcounta[9]=="1"&$resultcounta[10]=="1") echo "checked='checked'";?>/>๑. ผู้ป่วยมีประวัติแพ้ Non-selective COX inhibitor แบบรุนแรงหรือแบบ pseudo-allergy ที่อาจแพ้ยากลุ่ม Non-selective COX inhibitor ทั้งกลุ่ม
                </td>
                </tr>
                <tr>
                  <td class="formdrug">
                    &nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="2" <? if($resultcounta[9]=="1"&$resultcounta[10]=="2") echo "checked='checked'";?>/>๒. ผู้ป่วยมีปัจจัยเสี่ยงที่อาจเกิดอาการไม่พึงประสงค์จากการใช้ยากลุ่ม Non-selective COX inhibitor อย่างน้อย ๑ ข้อ ต่อไปนี้<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- มีหลักฐานแสดงว่าผู้ป่วยมี recent Gl bleeding,peptic ulcer, Gl perforation<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- อายุ ๖๕ ปี ขึ้นไป<br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ได้รับยาร่วมที่ทำให้มีโอกาสเกิด Gl adverse event ได้มากขึ้น เช่น warfarin , aspirin, clopidogrel,corticosteroids
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re1" type="radio" value="3" <? if($resultcounta[9]=="1"&$resultcounta[10]=="3") echo "checked='checked'";?>/>๓. อื่น ๆ โปรดระบุ 
                  ...<? if($resultcounta[9]=="1"&$resultcounta[10]=="3") echo $resultcounta[11];?>...
                </td>
                </tr>
                <tr>
                  <td class="formdrug"><input name="d2" type="radio" value="2" <? if($resultcounta[9]=="2") echo "checked='checked'";?>/><strong>Chronic pain</strong></td>
                </tr>
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="1" <? if($resultcounta[9]=="2"&$resultcounta[10]=="1") echo "checked='checked'";?>/>๑. ผู้ป่วยใช้ Non-selective COX inhibitor ร่วมกับ PPI แล้วยังคงเกิดอาการไม่พึงประสงค์จากการใช้ยา</td>
                </tr>
                <tr>
                  <td class="formdrug">
                   &nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="2" <? if($resultcounta[9]=="2"&$resultcounta[10]=="2") echo "checked='checked'";?>/>๒. ผู้ป่วยมีประวัติแพ้ยา Non-selective COX inhibitor แบบรุนแรงหรือแบบ pseudo-allergy ที่อาจแพ้ยากลุ่ม Non-selective COX inhibitor ทั้งกลุ่ม 
                  </td>
                </tr>
                
                <tr><td class="formdrug">&nbsp;&nbsp;&nbsp;&nbsp;<input name="re2" type="radio" value="3" <? if($resultcounta[9]=="2"&$resultcounta[10]=="3") echo "checked='checked'";?>/>๓. อื่น ๆ โปรดระบุ 
                 ...<? if($resultcounta[9]=="2"&$resultcounta[10]=="3") echo $resultcounta[11];?>...
                </td>
                </tr>
                </table>
                </td></tr>
                <tr><td align="center" class="formdrug"><?=$resultcounta[14]?><br />แพทย์ผู้สั่งใช้ยา<br />วันที่ <?=$resultcounta[13]?>
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
					  <td width="765" height="62" align="center" class="formdrug"><span class="formdrug1">ใบรับรองการใช้ยากลูโคซามีนซัลเฟต<br />
					  </span>โปรดใส่รายละเอียดการรักษาพยาบาลให้ครบทุกข้อ</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>ข้าพเจ้า</strong>
					    ...<?=$resultcounta['name_doc']?>...
				      <strong>เลขที่เวชกรรม</strong> ...<?=$resultcounta['num_doc']?>...</td>
					</tr>
					<tr>
					  <td class="formdrug"><strong>แพทย์เฉพาะทางสาขา</strong>
				      <? if($resultcounta['fac']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> อายุรแพทย์โรคข้อ 
				      <? if($resultcounta['fac']=="2") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> เวชศาสตร์ฟื้นฟู 
					  <? if($resultcounta['fac']=="3") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> ออร์โธปิดิกส์</td>
					</tr>
					<tr>
					  <td class="formdrugd"><strong>ชื่อสถานพยาบาล </strong>...<?=$resultcounta['hospital']?>... 
					  <strong>จังหวัด </strong>...<?=$resultcounta['province']?>...<br />
					  <strong>ขอรับรองว่า :</strong> ...<?=$resultcounta['name_pt']?>... <strong>HN</strong> : ...<?=$resultcounta['hn']?>... <strong>อายุ : </strong>...<?=$resultcounta['age']?>...<br />
					  <strong>เลขบัตรปชช.</strong>&nbsp;<?=$resultidcard['idcard']?></td>
					</tr>
					<tr>
					  <td class="formdrug"><br /><? if($resultcounta['reason1']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>				        ๑. ผู้ป่วยได้ผ่านการรักษาอย่างอนุรักษ์นิยมอย่างเต็มที่แต่ไม่ได้ผล แพทย์เห็นควรให้ใช้ยากลูโคซามีนซัลเฟต</td>
					</tr>
					<tr>
					  <td class="formdrug"><? if($resultcounta['reason2']=="2") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>				        ๒. การสั่งใช้ยาเป็นไปตามแนวทางกำกับการใช้ยากลูโคซามีนซัลเฟตของราชวิทยาลัยแพทย์ออร์โธปิดิกส์แห่งประเทศไทย<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามหนังสือกระทรวงการคลังด่วนที่สุด ที่ กค ๐๕๒๒.๒/ว๖๒ ลงวันที่ ๒๘ มิถุนายน ๒๕๕๔</td></tr>
                      <tr>
					  <td class="formdrug"><? if($resultcounta['reason3']=="3") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> ๓. การสั่งจ่ายยาให้ผู้ป่วย</td></tr>
					<tr><td>
					<table><tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<? if($resultcounta['ch1']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?> ๓.๑ ผู้ป่วยได้รับยาครั้งแรกนับตั้งแต่วันที่กระทรวงการคลังอนุญาตให้เบิกจ่าย<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					  ...<?=$resultcounta['week1']; ?>...
					  ตั้งแต่วันที่ ...<?=$resultcounta['date11']; ?>... ถึงวันที่ ...<?=$resultcounta['date12']; ?>...</td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<? if($resultcounta['ch2']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>
					  ๓.๒ ผู้ป่วยเคยได้รับยาแล้วมีการประเมินอาการพบว่าดีขึ้น จึงให้ยาต่อโดยการสั่งจ่ายยานั้น เมื่อรวมกับการสั่งจ่ายยาครั้งก่อนแล้ว<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่เกิน ๖ เดือนโดยมีรายละเอียดการสั่งยา ดังนี้<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๑ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					  ...<?=$resultcounta['week2']; ?>... ตั้งแต่วันที่ ...<?=$resultcounta['date21']; ?>...
					    ถึงวันที่ 
				        ...<?=$resultcounta['date22']; ?>...<br />
					      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๒ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					     ...<?=$resultcounta['week3']; ?>... ตั้งแต่วันที่ 
					      ...<?=$resultcounta['date31']; ?>...
ถึงวันที่ ...<?=$resultcounta['date32']; ?>...<br />
					      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๓ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					      ...<?=$resultcounta['week4']; ?>... ตั้งแต่วันที่ 
					      ...<?=$resultcounta['date41']; ?>...
					      ถึงวันที่ 
			          ...<?=$resultcounta['date42']; ?>...<br />
					      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๔ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					      ...<?=$resultcounta['week5']; ?>...&nbsp;ตั้งแต่วันที่ ...<?=$resultcounta['date51']; ?>...
					      ถึงวันที่ 
					      ...<?=$resultcounta['date52']; ?>...</td>
					</tr>
					<tr>
					  <td class="formdrug">&nbsp;&nbsp;&nbsp;<? if($resultcounta['ch3']=="1") echo "[ / ]"; else echo "[&nbsp;&nbsp;&nbsp;]";?>				        ๓.๓ ผู้ป่วยได้หยุดการใช้ยา ไม่น้อยกว่า ๓ เดือน แต่กลับมามีอาการเจ็บปวดเหมือนเดิม แพทย์ประเมินการรักษาแล้ว<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เห็นควรให้ยาครั้งใหม่ โดยมีรายละเอียดการสั่งยา ดังนี้<br />
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๑ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
					  ...<?=$resultcounta['week6']; ?>...
					  ตั้งแต่วันที่ ...<?=$resultcounta['date61']; ?>... ถึงวันที่ ...<?=$resultcounta['date62']; ?>...<br />
				      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๒ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
				      ...<?=$resultcounta['week7']; ?>... ตั้งแต่วันที่ ...<?=$resultcounta['date71']; ?>... ถึงวันที่ ...<?=$resultcounta['date72']; ?>...<br />
				      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๓ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน)  
				      ...<?=$resultcounta['week8']; ?>... ตั้งแต่วันที่ ...<?=$resultcounta['date81']; ?>... ถึงวันที่ ...<? if($resultcounta['reason1']=="3"&$resultcounta['reason2']=="3") echo $resultcounta['date82']; ?>...<br />
				      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ครั้งที่ ๔ ปริมาณยาต่อครั้ง(สัปดาห์/เดือน) 
				      ...<?=$resultcounta['week9']; ?>... 
				      ตั้งแต่วันที่ ...<?=$resultcounta['date91']; ?>...
				      ถึงวันที่ 
				      ...<?=$resultcounta['date92']; ?>...</td>
					</tr>
					</table>
					</td></tr>
					<tr><td align="center" class="formdrug"><br />
					  <br />
					  ลงชื่อ ...<?=$resultcounta['name_doc']?>...<br />วันที่ <?=$resultcounta['dateup']?></td>
					</tr>
                    
					</table>
<?
}
?>
<script>focus()</script>