<?php 
session_start();
include("connect.inc");
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=UTF-8");
}


if($_POST["act"]=="add"){
	$hn=$_POST["hn"];
	$drugcode=$_POST["drugcode"];
	$tradname=$_POST["tradname"];
	$genname=$_POST["genname"];
	$asses=$_POST["asses"];
	$reporter=$_POST["reporter"];
	$report_date=$_POST["report_date"];
	$sideeffects=$_POST["sideeffects"];
	$officer = $_SESSION['sOfficer'];
	
	$advreact = implode(',', $_POST["advreact"]);
	$advreact_other=trim($_POST["advreact_other"]);
	
	if(!empty($advreact_other)){  //ถ้ามีอาการแพ้อื่นๆ
		$advreact=$advreact.",".$advreact_other;
	}

	$drugreact_group_id = sprintf("%s", $_POST['drugreact_group']);
	$sql = "SELECT `name` FROM `drugreact_group` WHERE `id` = '$drugreact_group_id' LIMIT 1";
	$q = $dbi->query($sql);
	$drugreact_group_name = '';
	if($q->num_rows>0){
		$d = $q->fetch_assoc();
		$drugreact_group_name = $d['name'];
	}
	$q->free_result();

	$sql_drugreact_insert = "INSERT INTO `drugreact` ( 
		`row_id`, `hn`, `drugcode`, `tradname`, `advreact`, `asses`, 
		`reporter`, `date`, `officer`, `genname`, `groupname`, `sideeffects`, 
		`officer1`
	) VALUES (
		NULL, '$hn', '$drugcode', '$tradname', '$advreact', '$asses', 
		'$reporter', '$report_date', '$officer', '$genname', '$drugreact_group_name', '$sideeffects', 
		''
	);";

	//echo $edit;
	if(mysql_query($sql_drugreact_insert)){

		// เก็บข้อมูลเข้าแฟ้ม drugallergy
		$sHn=$hn;
		$test_drugcode = $drugcode;
		$dname = $tradname;
		$typedx = $asses;
		$symptom = $advreact;
		$provider = $_SESSION['sOfficer'];

		$q = mysql_query("SELECT `code24` FROM `druglst` WHERE `drugcode` LIKE '$test_drugcode'");
		$item = mysql_fetch_assoc($q);
		$drugallergy = $item['code24'];
		$daterecord = date('Ymd');
		$d_update = date('YmdHis');

		$q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$sHn' ");
		$item = mysql_fetch_assoc($q);
		$cid = $item['idcard'];

		$q = mysql_query("SELECT `id` FROM `drugallergy` WHERE `PID` = '$sHn' AND `drugcode` = '$test_drugcode' ");
		$rows = mysql_num_rows($q);

		if( $rows > 0 ){

			// update 
			$item = mysql_fetch_assoc($q);
			$id = $item['id'];

			$sql = "UPDATE `drugallergy` SET 
			`HOSPCODE`='11512', `PID`='$sHn', `DATERECORD`='$daterecord', 
			`DRUGALLERGY`='$drugallergy', `DNAME`='$dname', `TYPEDX`='$typedx', 
			`ALEVEL`=NULL, `SYMPTOM`='$symptom', `INFORMANT`=NULL, 
			`INFORMHOSP`='11512', `D_UPDATE`='$d_update', `PROVIDER`='$provider', 
			`CID`='$cid', `drugcode` = '$test_drugcode' WHERE (`id`='$id');";
			mysql_query($sql);


		}else{

			$sql = "INSERT INTO `drugallergy` (
				`id`, `HOSPCODE`, `PID`, `DATERECORD`, `DRUGALLERGY`, `DNAME`, 
				`TYPEDX`, `ALEVEL`, `SYMPTOM`, `INFORMANT`, `INFORMHOSP`, `D_UPDATE`, 
				`PROVIDER`, `CID`, `drugcode`
			) VALUES (
				NULL, '11512', '$sHn', '$daterecord', '$drugallergy', '$dname', 
				'$typedx', NULL, '$symptom', NULL, '11512', '$d_update', 
				'$provider', '$cid', '$test_drugcode' 
			);";
			mysql_query($sql);

		}

		// เก็บข้อมูลเข้าแฟ้ม drugallergy
		$msg = "บันทึกข้อมูลแพ้ยาเรียบร้อย";
		
	}else{
		$msg = "ไม่สามารถบันทึกข้อมูลแพ้ยาได้ กรุณาลองใหม่อีกครั้ง";
		
	}

	?>
	<p>
		<b><?=$msg;?></b>
		<div>ระบบจะนำท่านกลับหน้าหลักใน <span id="showTime"></span></div>
	</p>
	<script>
		setTimeout(function(){
			window.location='drugreact_new_add.php?page=show&hn=<?=$hn;?>';
		}, 5000);

		var count = 5;
		var timerId = setInterval(function(){

			document.getElementById('showTime').innerHTML = count;
			count--;
			
			if (count == 0) {
				clearInterval(timerId);
			}
			
		}, 1000);
	</script>
	<?php
	exit;
}

if($_POST["act"]=="edit"){
	$row_id=$_POST["row_id"];
	$hn=$_POST["hn"];
	$drugcode=$_POST["drugcode"];	
	$tradname=$_POST["tradname"];	
	$asses=$_POST["asses"];
	$reporter=$_POST["reporter"];
	$report_date=$_POST["report_date"];
	$sideeffects=$_POST["sideeffects"];
	
	$advreact = implode(',', $_POST["advreact"]);
	$advreact_other=trim($_POST["advreact_other"]);
	
	if(!empty($advreact_other)){  //ถ้ามีอาการแพ้อื่นๆ
		$advreact=$advreact.",".$advreact_other;
	}	

	$drugreact_group_id = sprintf("%s", $_POST['drugreact_group']);
	$sql = "SELECT `name` FROM `drugreact_group` WHERE `id` = '$drugreact_group_id' LIMIT 1";
	$q = $dbi->query($sql);
	$drugreact_group_name = '';
	if($q->num_rows>0){
		$d = $q->fetch_assoc();
		$drugreact_group_name = $d['name'];
	}
	$q->free_result();

	$edit="update drugreact SET 
	advreact='$advreact',
	sideeffects='$sideeffects',
	asses='$asses',
	reporter='$reporter',
	date='$report_date',
	officer1='".$_SESSION['sOfficer']."',
	groupname='$drugreact_group_name'
	where row_id='".$row_id."'";
	//echo $edit;
	if(mysql_query($edit)){	
		// เก็บข้อมูลเข้าแฟ้ม drugallergy
		$sHn=$hn;
		$test_drugcode = $drugcode;
		$dname = $tradname;
		$typedx = $asses;
		$symptom = $advreact;
		$provider = $_SESSION['sOfficer'];

		$q = mysql_query("SELECT `code24` FROM `druglst` WHERE `drugcode` LIKE '$test_drugcode'");
		$item = mysql_fetch_assoc($q);
		$drugallergy = $item['code24'];
		$daterecord = date('Ymd');
		$d_update = date('YmdHis');

		$q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$sHn' ");
		$item = mysql_fetch_assoc($q);
		$cid = $item['idcard'];

		$q = mysql_query("SELECT `id` FROM `drugallergy` WHERE `PID` = '$sHn' AND `drugcode` = '$test_drugcode' ");
		$rows = mysql_num_rows($q);
		// เก็บข้อมูลเข้าแฟ้ม drugallergy
		if( $rows > 0 ){

			// update 
			$item = mysql_fetch_assoc($q);
			$id = $item['id'];

			$sql = "UPDATE `drugallergy` SET 
			`HOSPCODE`='11512', `PID`='$sHn', `DATERECORD`='$daterecord', 
			`DRUGALLERGY`='$drugallergy', `DNAME`='$dname', `TYPEDX`='$typedx', 
			`ALEVEL`=NULL, `SYMPTOM`='$symptom', `INFORMANT`=NULL, 
			`INFORMHOSP`='11512', `D_UPDATE`='$d_update', `PROVIDER`='$provider', 
			`CID`='$cid', `drugcode` = '$test_drugcode' WHERE (`id`='$id');";
			mysql_query($sql);


		}
		// echo "<script>alert('แก้ไขข้อมูลแพ้ยาเรียบร้อย');window.location='drugreact_new_add.php?page=show&hn=$hn';</script>";			
		$msg = "บันทึกข้อมูลแพ้ยาเรียบร้อย";
		$url = 'drugreact_new_add.php?page=show&hn='.$hn;
		
	}else{
		// echo "<script>alert('ไม่สามารถบันทึกข้อมูลแพ้ยาได้ กรุณาลองใหม่อีกครั้ง');window.location='drugreact_new_add.php?page=showedit&row_id=$row_id&hn=$hn';</script>";
		$msg = "ไม่สามารถบันทึกข้อมูลแพ้ยาได้ กรุณาลองใหม่อีกครั้ง";
		$url = 'drugreact_new_add.php?page=showedit&row_id='.$row_id.'&hn='.$hn;
	}		

	?>
	<p>
		<b><?=$msg;?></b>
		<div>ระบบจะนำท่านกลับหน้าหลักใน <span id="showTime"></span></div>
	</p>
	<script>
		setTimeout(function(){
			window.location='<?=$$url;?>';
		}, 5000);

		var count = 5;
		var timerId = setInterval(function(){

			document.getElementById('showTime').innerHTML = count;
			count--;
			
			if (count == 0) {
				clearInterval(timerId);
			}
			
		}, 1000);
	</script>
	<?php
	exit;
}	


///////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "drugreact"){
	
	$sql = "Select drugcode,tradname,genname from druglst where tradname like '%".$_GET["search"]."%' or drugcode like '%".$_GET["search"]."%' or genname like '%".$_GET["search"]."%' and drug_active='y' limit 20 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){		
		echo "<Div style=\"position: absolute;text-align: center; margin-top:400px; width:500px; height:430px; overflow:auto; \">";	
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td>
		<td width=\"30\"><font style=\"color: #FFFFFF;\"><strong>ชื่อการค้า</strong></font></td>
		<td width=\"30\"><font style=\"color: #FFFFFF;\"><strong>ชื่อสามัญ</strong></font></td>
		<td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td>&nbsp;&nbsp;<A HREF=\"javascript:void(0);\" 
		Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".$se["drugcode"]."';
		document.getElementById('".$_GET["getto2"]."').value = '".$se["tradname"]."';
		document.getElementById('".$_GET["getto3"]."').value = '".$se["genname"]."';
		document.getElementById('list').innerHTML ='';\">".$se["drugcode"]."</A></td>
		<td>".$se['tradname']."</td>
		<td>".$se['genname']."</td>
		<td>&nbsp;</td>
		</tr>";
		}
		
		echo "</TABLE></Div>";
	}
	exit();
}
?>
<style type="text/css">
body{
	font-family: TH SarabunPSK;
	font-size: 16px;
	background-color:#F4F6F6;
}
.fontsarabun {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
    font-size: 16px;
}
.chk_table1 td{
    padding: 3px;
    border: 0px solid black;
    font-size: 16px;
}
label:hover{
	cursor: pointer;
}
</style>
<script>
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}
function searchSuggest(str,len,getto,getto2,getto3) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'drugreact_new_add.php?action=drugreact&search='+ str+'&getto='+ getto+'&getto2='+ getto2+'&getto3='+ getto3;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function checkList(){
	
	if(document.getElementById("drugcode").value==""){
		alert("กรุณาระบุรหัสยา");
		document.getElementById("drugcode").focus()
		return false;		
	}else if(document.getElementById("tradname").value==""){
		alert("กรุณาระบุชื่อการค้า");
		document.getElementById("tradname").focus()
		return false;	
	}else if(document.getElementById("genname").value==""){
		alert("กรุณาระบุชื่อสามัญ");
		document.getElementById("genname").focus()
		return false;	
	}else if(document.f1.asses1.checked == false && document.f1.asses2.checked == false && document.f1.asses3.checked == false && document.f1.asses4.checked == false && document.f1.asses5.checked == false && document.f1.asses6.checked == false){
		alert("กรุณาเลือกการประเมิน");
		return false;			
	}else{
		return true;
	}
}
</script>
<h3 style="margin-top:20px;">ระบบบันทึกการแพ้ยา รูปแบบใหม่
<span style="margin-left: 35px;"><input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="fontsarabun" /></span>
<span style="margin-left: 35px;"><input type="button" name="button" id="button" value="บันทึกแพ้ยา" onclick="window.location='drugreact_new_add.php' " class="fontsarabun" /></span>
<span style="margin-left: 50px;"><input type="button" name="button" id="button" value="รายชื่อผู้ป่วยแพ้ยา" onclick="window.open('list_drugreact.php') " class="fontsarabun" /></span>
</h3>
<div align="center">
<form action="drugreact_new_add.php" method="post">
    <fieldset style="width: 300px;">
        <legend>ค้นหาตาม HN</legend>
        <div>
            HN: <input type="text" name="hn" id="hn" class="fontsarabun">
        </div>
        <div>
            <div style="margin-left: 20px; margin-top:10px;"><INPUT TYPE="submit" name="submit"  value="   ค้นหา   " class="fontsarabun"></div>
            <input type="hidden" name="page" value="search">
        </div>
    </fieldset>
</form>
</div>
<?php 

$page = $_POST['page'];

if ( $page == 'search' ) {
    
    $hn = $_POST['hn'];
    $sql = "SELECT * FROM `opcard` WHERE `hn` = '$hn'";
    $query=mysql_query($sql);
	$num=mysql_num_rows($query);
	

    if ( $num > 0 ) {
        ?>
        <table class="chk_table" width="90%" bgcolor="#FFFFFF" align="center">
            <tr>
                <th>HN</th>
                <th>ชื่อ - นามสกุล</th>
                <th>เลขที่บัตรประชาชน</th>
                <th>โรคประจำตัว</th>
                <th colspan="2">ดำเนินการ</th>
            </tr>
            <?php
            while($item = mysql_fetch_array($query)){
				$ptname=$item['yot']." ".$item['name']." ".$item['surname'];
                ?>
                <tr>
                    <td><?=$item['hn'];?></td>
                    <td><?=$ptname;?></td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['congenital_disease'];?></td>
					<td align="center"><a href="drugreact_new_add.php?page=show&hn=<?=$item['hn'];?>">บันทึกแพ้ยา</a></td>
					<td align="center"><a href="drugreactgroup_new_add.php?page=first&hn=<?=$item['hn'];?>" target="_blank">แพ้ยาตามกลุ่ม</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }else{
        ?>
        <p><b>ไม่พบข้อมูล</b></p>
        <?php
    }
?>	
<h3 align="center">ประวัติการแพ้ยา</h3>
<?
    $dsql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' order by groupname";
    $dquery=mysql_query($dsql);
	$dnum=mysql_num_rows($dquery);
	

    if ( $dnum > 0 ) {
        ?>
        <table class="chk_table" width="90%" bgcolor="#FFFFFF" align="center">
            <tr style="background-color:#16A085;">
                <th>รหัสยา</th>
                <th>ชื่อการค้า</th>
                <th>ชื่อสามัญ</th>
                <th>อาการแพ้</th>
				<th width="10%">ผลข้างเคียง</th>
				<th>ประเมินอาการ</th>
				<th>กลุ่มที่แพ้</th>
				<th>ผู้บันทึก</th>
				<th>ผู้แก้ไข</th>
            </tr>
            <?php
            while($ditem = mysql_fetch_array($dquery)){
                ?>
                <tr style="background-color:#D5F5E3;">
                    <td align="center"><?=$ditem['drugcode'];?></td>
                    <td><?=$ditem['tradname'];?></td>
                    <td><?=$ditem['genname'];?></td>
                    <td><?=$ditem['advreact'];?></td>
					<td><?=$ditem['sideeffects'];?></td>
					<td align="center"><?=$ditem['asses'];?></td>
					<td align="center"><?=$ditem['groupname'];?></td>
					<td><?=$ditem['officer'];?></td>
					<td><?=$ditem['officer1'];?></td>					
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }else{
        ?>
        <p align="center">-------------------------------------- ไม่พบข้อมูลการแพ้ยาของผู้ป่วยรายนี้ -------------------------------------- 
		<hr>
		</p>
    <?php
    }
	?>
<?	
}else if( $_GET["page"] == 'show' ) {
    $hn = $_GET['hn'];
    $sql = "SELECT * FROM `opcard` WHERE `hn` = '$hn'";
    $query=mysql_query($sql);	
	$result = mysql_fetch_array($query);
	$ptname=$result['yot']." ".$result['name']." ".$result['surname'];
?>
<TABLE bgcolor="#FFFFFF" width="90%" align="center" border="0" cellpadding="10" cellspacing="0">
<TR style="background-color:#16A085;">
	<TD colspan="6" align="center" style="font-size: 20px;font-weight:bold;">ข้อมูลส่วนตัว</TD>
</TR>	
<TR style="background-color:#D5F5E3;">
	<TD width="15%" align="right"><strong>HN : </strong></TD>
	<TD width="15%"><?php echo $result["hn"];?>	</TD>
	<TD width="15%" align="right"><strong>ชื่อ - นามสกุล : </strong></TD>
	<TD width="30%"><?php echo $ptname;?>	</TD>	
	<TD width="10%" align="right"><strong>เบอร์โทรศัพท์ : </strong></TD>
	<TD width="15%"><?php echo $result["phone"];?></TD>		
</TR>
<TR style="background-color:#D5F5E3;">
	<TD width="15%" align="right"><strong>เลขที่บัตรประชาชน : </strong></TD>
	<TD width="15%"><?php echo $result["idcard"];?>	</TD>
	<TD width="15%" align="right"><strong>โรคประจำตัว : </strong></TD>
	<TD colspan="3" width="30%"><?php echo $result["congenital_disease"];?></TD>	
</TR>

</TABLE>
<h3 align="center">ประวัติการแพ้ยา</h3>
<?
    $dsql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' order by groupname";
    $dquery=mysql_query($dsql);
	$dnum=mysql_num_rows($dquery);
	

    if ( $dnum > 0 ) {
        ?>
        <table class="chk_table" width="90%" bgcolor="#FFFFFF" align="center">
            <tr style="background-color:#16A085;">
                <th>รหัสยา</th>
                <th>ชื่อการค้า</th>
                <th>ชื่อสามัญ</th>
                <th>อาการแพ้</th>
				<th width="10%">ผลข้างเคียง</th>
				<th>ประเมินอาการ</th>
				<th>กลุ่มที่แพ้</th>
				<th>ผู้บันทึก</th>
				<th>ผู้แก้ไข</th>
                <th colspan="2" width="10%">ดำเนินการ</th>
            </tr>
            <?php
            while($ditem = mysql_fetch_array($dquery)){
                ?>
                <tr style="background-color:#D5F5E3;">
                    <td align="center"><?=$ditem['drugcode'];?></td>
                    <td><?=$ditem['tradname'];?></td>
                    <td><?=$ditem['genname'];?></td>
                    <td><?=$ditem['advreact'];?></td>
					<td><?=$ditem['sideeffects'];?></td>
					<td align="center"><?=$ditem['asses'];?></td>
					<td align="center"><?=$ditem['groupname'];?></td>
					<td><?=$ditem['officer'];?></td>
					<td><?=$ditem['officer1'];?></td>
					<td align="center"><a href="drugreact_new_add.php?page=showedit&row_id=<?=$ditem['row_id'];?>&hn=<?=$ditem['hn'];?>">แก้ไขข้อมูล</a></td>
					<td align="center"><a href="drugreact_new_add.php?page=del&row_id=<?=$ditem['row_id'];?>&hn=<?=$ditem['hn'];?>" onclick="return confirm('ท่านต้องการลบข้อมูลรายการนี้ใช่หรือไม่');">ลบข้อมูล</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }else{
        ?>
        <p align="center">-------------------------------------- ไม่พบข้อมูลการแพ้ยาของผู้ป่วยรายนี้ -------------------------------------- 
		<hr>
		</p>
    <?php
    }
	?>
<h3 align="center">ระบบบันทึกการแพ้ยา</h3>
<Div id="list" style="left:200PX;top:30PX;position:absolute;" class="fontsarabun"></Div>
<FORM name="f1" METHOD=POST ACTION="drugreact_new_add.php" onsubmit="return checkList()">
<input name="act" type="hidden" value="add"/>
<input name="hn" type="hidden" value="<?php echo $result["hn"];?>" />
        <table class="chk_table" width="90%" align="center" bgcolor="#FFFFFF" >
            <tr>
                <th>รหัสยา</th>
                <th>ชื่อการค้า</th>
				<th>ชื่อสามัญ</th>
                <th>อาการแพ้</th>
                <th>ประเมิน</th>
            </tr>
                <tr>
                <td align="center" valign="top"><div style="margin-top:5px;"><input type="text" name="drugcode" size="15" id='drugcode' class="fontsarabun" onKeyPress="searchSuggest(this.value,3,'drugcode','tradname','genname');"></div></td>
                <td align="center" valign="top"><div style="margin-top:5px;"><input type="text" name="tradname" size="25" id='tradname' class="fontsarabun" onKeyPress="searchSuggest(this.value,3,'drugcode','tradname','genname');"></div></td>
				<td align="center" valign="top"><div style="margin-top:5px;"><input type="text" name="genname" size="25" id='genname' class="fontsarabun" onKeyPress="searchSuggest(this.value,3,'drugcode','tradname','genname');"></div></td>
                <td>
					<TABLE width="100%" align="center" border="0"  cellpadding="5" cellspacing="0" class="chk_table1">

					<TR>
						<TD><strong>ผื่นแพ้ยาลักษณะต่าง ๆ</strong></TD>
						<TD><strong>อาการทางระบบทางเดินหายใจ</strong></TD>
					</TR>
					<TR>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="MP rash (maculopapular rash)" class="fontsarabun"> MP rash (maculopapular rash)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Urticaria" class="fontsarabun"> Urticaria</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Fixed drug reaction" class="fontsarabun"> Fixed drug reaction</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="SJS (Stevens Johnson Syndrome)" class="fontsarabun"> SJS (Stevens Johnson Syndrome)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="TEN (Toxic epidermal necrolysis)" class="fontsarabun"> TEN (Toxic epidermal necrolysis)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="DRESS (Drug rash with eosinophilia and systemic symptoms)" class="fontsarabun"> DRESS (Drug rash with eosinophilia and systemic symptoms)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="AGEP (Acute generalized exanthematous pustulosis)" class="fontsarabun"> AGEP (Acute generalized exanthematous pustulosis)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นแดงราบ" class="fontsarabun"> ผื่นแดงราบ</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นแดงนูน" class="fontsarabun"> ผื่นแดงนูน</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นมีหัวหนองคล้ายสิว" class="fontsarabun"> ผื่นมีหัวหนองคล้ายสิว</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="จุดแดงเลือดออกใต้ผิวหนัง" class="fontsarabun"> จุดแดงเลือดออกใต้ผิวหนัง</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นลมพิษ" class="fontsarabun"> ผื่นลมพิษ</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผิวหนังและ/หรือเยื่อบุลอก" class="fontsarabun"> ผิวหนังและ/หรือเยื่อบุลอก</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="คัน" class="fontsarabun"> คัน</div>						
						</TD>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หายใจลำบาก" class="fontsarabun"> หายใจลำบาก</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หายใจไม่ออก" class="fontsarabun"> หายใจไม่ออก</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หอบเหนื่อย" class="fontsarabun"> หอบเหนื่อย</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หายใจมีเสียงหวีด" class="fontsarabun"> หายใจมีเสียงหวีด</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ทางเดินหายใจส่วนบนมีการบวม" class="fontsarabun"> ทางเดินหายใจส่วนบนมีการบวม</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="เยื่อบุจมูกอักเสบ" class="fontsarabun"> เยื่อบุจมูกอักเสบ</div>							
						</TD>	
					</TR>
					<TR>
						<TD><strong>อาการทางระบบหัวใจและหลอดเลือด</strong></TD>
						<TD><strong>อาการทางระบบทางเดินอาหาร</strong></TD>
					</TR>
					<TR>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Hypotension(ความดันต่ำ)" class="fontsarabun"> Hypotension(ความดันต่ำ)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Angioedema(หน้าบวม ปาก ลิ้นและเพดานอ่อนบวม)" class="fontsarabun"> Angioedema(หน้าบวม ปาก ลิ้นและเพดานอ่อนบวม)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="เวียนศีรษะและ/หรือเป็นลม" class="fontsarabun"> เวียนศีรษะและ/หรือเป็นลม</div>
						</TD>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="คลื่นไส้" class="fontsarabun"> คลื่นไส้</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="อาเจียน" class="fontsarabun"> อาเจียน</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="อุจจาระร่วง" class="fontsarabun"> อุจจาระร่วง</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ปวดท้อง" class="fontsarabun"> ปวดท้อง</div>	
						</TD>	
					</TR>
					<TR>
						<TD><strong>อาการทางระบบอื่น ๆ</strong></TD>
						<TD><strong>อื่น ๆ</strong></TD>
					</TR>
					<TR>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ปวดศีรษะ" class="fontsarabun"> ปวดศีรษะ</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="แน่นหน้าอก" class="fontsarabun"> แน่นหน้าอก</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ชัก" class="fontsarabun"> ชัก</div>
						</TD valign="top">
						<TD><textarea id="advreact_other" name="advreact_other" rows="4" cols="30" class="fontsarabun"></textarea></TD>	
					</TR>
					</table>				
				</td>
                <td valign="top">
				<div><input type="radio" id="asses1" name="asses" value="1" class="fontsarabun"> 1= ใช่แน่นอน (Certain)</div>
				<div><input type="radio" id="asses2" name="asses" value="2" class="fontsarabun"> 2= น่าจะใช่ (Probable)</div>
				<div><input type="radio" id="asses3" name="asses" value="3" class="fontsarabun"> 3= อาจจะใช่ (Possible)</div>
				<div><input type="radio" id="asses4" name="asses" value="4" class="fontsarabun"> 4= ไม่น่าใช่ (Unlikely)</div>
				<div><input type="radio" id="asses5" name="asses" value="5" class="fontsarabun"> 5= ไม่สามารถระบุระดับ (Unclassified)</div>
				<div><input type="radio" id="asses6" name="asses" value="Hx" class="fontsarabun"> Hx = มีประวัติแพ้ยาเดิมจากที่อื่น</div>
				</td>
            </tr>
			
			<tr>
				<td><div style="margin-left:10px;"><strong>ผลข้างเคียง : </strong></div></td>
				<td colspan="4" align="left"><div style="margin-left:10px;"><input name="sideeffects" type="text" class="fontsarabun" size="150" value="" /></div></td>
			</tr>
			<tr valign="top">
				<td><div style="margin-left:10px;"><strong>แพ้ยาตามกลุ่ม : </strong></div></td>
				<td colspan="4">
					<?php 
					$q = $dbi->query("SELECT * FROM `drugreact_group` ");
					$i = 1;
					while ($a = $q->fetch_assoc()) {
						?>
						<label for="<?=$a['id'];?>">
							<input type="radio" name="drugreact_group" id="<?=$a['id'];?>" value="<?=$a['id'];?>"> <?=$i.') '.$a['name'];?><br>
						</label>
						<?php
						$i++;
					}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left"><div style="margin-left:10px;"><strong>ผู้รายงาน : </strong> <input name="reporter" type="text" class="fontsarabun" value="OPD" /></div></td>
				<td colspan="2" align="left"><div style="margin-left:10px;"><strong>วันที่รายงาน : </strong> <input name="report_date" type="text" class="fontsarabun" value="<?=date("Y-m-d H:i:s");?>" /></div></td>
			</tr>			
			<tr>
				<td colspan="5" align="center"><div style="margin-top:10px;"><INPUT TYPE="submit" name="submit"  value="   บันทึกข้อมูล   " class="fontsarabun"><span style="margin-left:40px;"><INPUT TYPE="reset" name="reset"  value="   เคลียร์ข้อมูล   " class="fontsarabun"></span></div></td>
			</tr>
        </table>
</form>		
<br>
<br>
<?
}else if( $_GET["page"] == 'showedit' ) {  //แก้ไขข้อมูล
	$row_id = $_GET['row_id'];
    $hn = $_GET['hn'];
    $sql = "SELECT * FROM `opcard` WHERE `hn` = '$hn'";
    $query=mysql_query($sql);	
	$result = mysql_fetch_array($query);
	$ptname=$result['yot']." ".$result['name']." ".$result['surname'];
?>
<TABLE bgcolor="#FFFFFF" width="90%" align="center" border="0" cellpadding="5" cellspacing="0">
<TR style="background-color:#16A085;">
	<TD colspan="6" align="center" style="font-size: 20px;font-weight:bold;">ข้อมูลส่วนตัว</TD>
</TR>
<TR style="background-color:#D5F5E3;">
	<TD width="15%" align="right"><strong>HN : </strong></TD>
	<TD width="15%"><?php echo $result["hn"];?>	</TD>
	<TD width="15%" align="right"><strong>ชื่อ - นามสกุล : </strong></TD>
	<TD width="30%"><?php echo $ptname;?>	</TD>	
	<TD width="10%" align="right"><strong>เบอร์โทรศัพท์ : </strong></TD>
	<TD width="15%"><?php echo $result["phone"];?></TD>		
</TR>
<TR style="background-color:#D5F5E3;">
	<TD width="15%" align="right"><strong>เลขที่บัตรประชาชน : </strong></TD>
	<TD width="15%"><?php echo $result["idcard"];?>	</TD>
	<TD width="15%" align="right"><strong>โรคประจำตัว : </strong></TD>
	<TD colspan="3" width="30%"><?php echo $result["congenital_disease"];?>	</TD>	
</TR>
</table>
<?
    $dsql = "SELECT * FROM `drugreact` WHERE `row_id` = '$row_id'";
    $dquery=mysql_query($dsql);
	$dnum=mysql_num_rows($dquery);
	$dresult = mysql_fetch_array($dquery);
	
	$variable=explode(",", $dresult["advreact"]);
	//print_r($variable);
	
//--------------- ผื่นแพ้ยาลักษณะต่าง ๆ ------------//
if (in_array("MP rash (maculopapular rash)", $variable)){
  $checkadvreact1="checked";
}else{
  $checkadvreact1="";
}

if (in_array("Urticaria", $variable)){
  $checkadvreact2="checked";
}else{
  $checkadvreact2="";
}	

if (in_array("Fixed drug reaction", $variable)){
  $checkadvreact3="checked";
}else{
  $checkadvreact3="";
}

if (in_array("SJS (Stevens Johnson Syndrome)", $variable)){
  $checkadvreact4="checked";
}else{
  $checkadvreact4="";
}

if (in_array("TEN (Toxic epidermal necrolysis)", $variable)){
  $checkadvreact5="checked";
}else{
  $checkadvreact5="";
}

if (in_array("DRESS (Drug rash with eosinophilia and systemic symptoms)", $variable)){
  $checkadvreact6="checked";
}else{
  $checkadvreact6="";
}

if (in_array("AGEP (Acute generalized exanthematous pustulosis)", $variable)){
  $checkadvreact7="checked";
}else{
  $checkadvreact7="";
}

if (in_array("ผื่นแดงราบ", $variable)){
  $checkadvreact8="checked";
}else{
  $checkadvreact8="";
}

if (in_array("ผื่นแดงนูน", $variable)){
  $checkadvreact9="checked";
}else{
  $checkadvreact9="";
}

if (in_array("ผื่นมีหัวหนองคล้ายสิว", $variable)){
  $checkadvreact10="checked";
}else{
  $checkadvreact10="";
}

if (in_array("จุดแดงเลือดออกใต้ผิวหนัง", $variable)){
  $checkadvreact11="checked";
}else{
  $checkadvreact11="";
}

if (in_array("ผื่นลมพิษ", $variable)){
  $checkadvreact12="checked";
}else{
  $checkadvreact12="";
}

if (in_array("ผิวหนังและ/หรือเยื่อบุลอก", $variable)){
  $checkadvreact13="checked";
}else{
  $checkadvreact13="";
}

if (in_array("คัน", $variable)){
  $checkadvreact14="checked";
}else{
  $checkadvreact14="";
}
//--------------- จบผื่นแพ้ยาลักษณะต่าง ๆ ------------//

//--------------- อาการทางระบบทางเดินหายใจ ๆ ------------//
if (in_array("หายใจลำบาก", $variable)){
  $checkadvreact15="checked";
}else{
  $checkadvreact15="";
}

if (in_array("หายใจไม่ออก", $variable)){
  $checkadvreact16="checked";
}else{
  $checkadvreact16="";
}

if (in_array("หอบเหนื่อย", $variable)){
  $checkadvreact17="checked";
}else{
  $checkadvreact17="";
}

if (in_array("หายใจมีเสียงหวีด", $variable)){
  $checkadvreact18="checked";
}else{
  $checkadvreact18="";
}

if (in_array("ทางเดินหายใจส่วนบนมีการบวม", $variable)){
  $checkadvreact19="checked";
}else{
  $checkadvreact19="";
}

if (in_array("เยื่อบุจมูกอักเสบ", $variable)){
  $checkadvreact20="checked";
}else{
  $checkadvreact20="";
}
//--------------- จบอาการทางระบบทางเดินหายใจ ๆ ------------//


//--------------- อาการทางระบบหัวใจและหลอดเลือด ------------//
if (in_array("Hypotension(ความดันต่ำ)", $variable)){
  $checkadvreact21="checked";
}else{
  $checkadvreact21="";
}

if (in_array("Angioedema(หน้าบวม ปาก ลิ้นและเพดานอ่อนบวม)", $variable)){
  $checkadvreact22="checked";
}else{
  $checkadvreact22="";
}

if (in_array("เวียนศีรษะและ/หรือเป็นลม", $variable)){
  $checkadvreact23="checked";
}else{
  $checkadvreact23="";
}
//--------------- จบอาการทางระบบหัวใจและหลอดเลือด ------------//


//--------------- อาการทางระบบทางเดินอาหาร ------------//
if (in_array("คลื่นไส้", $variable)){
  $checkadvreact24="checked";
}else{
  $checkadvreact24="";
}

if (in_array("อาเจียน", $variable)){
  $checkadvreact25="checked";
}else{
  $checkadvreact25="";
}

if (in_array("อุจจาระร่วง", $variable)){
  $checkadvreact26="checked";
}else{
  $checkadvreact26="";
}

if (in_array("ปวดท้อง", $variable)){
  $checkadvreact27="checked";
}else{
  $checkadvreact27="";
}
//--------------- จบอาการทางระบบทางเดินอาหาร ------------//

//--------------- อาการทางระบบอื่น ๆ ------------//
if (in_array("ปวดศีรษะ", $variable)){
  $checkadvreact28="checked";
}else{
  $checkadvreact28="";
}

if (in_array("แน่นหน้าอก", $variable)){
  $checkadvreact29="checked";
}else{
  $checkadvreact29="";
}

if (in_array("ชัก", $variable)){
  $checkadvreact30="checked";
}else{
  $checkadvreact30="";
}
//--------------- จบอาการทางระบบอื่น ๆ ------------//

if (in_array("", $variable)){
  $checkadvreact31="";
}else{
 foreach ($variable as $key => $value) {	
  $checkadvreact31=$value;
 }
}


?>
<h3 align="center">ระบบแก้ไขข้อมูลการแพ้ยา</h3>
<Div id="list" style="left:200PX;top:30PX;position:absolute;" class="fontsarabun"></Div>
<FORM name="f1" METHOD=POST ACTION="drugreact_new_add.php" onsubmit="return checkList()">
<input name="act" type="hidden" value="edit"/>
<input name="row_id" type="hidden" value="<?php echo $dresult["row_id"];?>" />
<input name="hn" type="hidden" value="<?php echo $dresult["hn"];?>" />
        <table class="chk_table" width="90%" align="center" bgcolor="#FFFFFF" >
            <tr>
                <th>รหัสยา</th>
                <th>ชื่อการค้า</th>
				<th>ชื่อสามัญ</th>
                <th>อาการแพ้</th>
                <th>ประเมิน</th>
            </tr>
                <tr>
                <td align="center" valign="top"><div style="margin-top:5px;"><input type="text" name="drugcode" size="15" id='drugcode' value="<?php echo $dresult["drugcode"];?>" class="fontsarabun" onKeyPress="searchSuggest(this.value,3,'drugcode','tradname','genname');" readonly></div></td>
                <td align="center" valign="top"><div style="margin-top:5px;"><input type="text" name="tradname" size="25" id='tradname' value="<?php echo $dresult["tradname"];?>" class="fontsarabun" readonly></div></td>
				<td align="center" valign="top"><div style="margin-top:5px;"><input type="text" name="genname" size="25" id='genname' value="<?php echo $dresult["genname"];?>" class="fontsarabun" readonly></div></td>
                <td>
					<TABLE width="100%" align="center" border="0"  cellpadding="5" cellspacing="0" class="chk_table1">

					<TR>
						<TD><strong>ผื่นแพ้ยาลักษณะต่าง ๆ</strong></TD>
						<TD><strong>อาการทางระบบทางเดินหายใจ</strong></TD>
					</TR>
					<TR>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="MP rash (maculopapular rash)" <?=$checkadvreact1;?> class="fontsarabun"> MP rash (maculopapular rash)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Urticaria" <?=$checkadvreact2;?> class="fontsarabun"> Urticaria</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Fixed drug reaction" <?=$checkadvreact3;?> class="fontsarabun"> Fixed drug reaction</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="SJS (Stevens Johnson Syndrome)" <?=$checkadvreact4;?> class="fontsarabun"> SJS (Stevens Johnson Syndrome)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="TEN (Toxic epidermal necrolysis)" <?=$checkadvreact5;?> class="fontsarabun"> TEN (Toxic epidermal necrolysis)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="DRESS (Drug rash with eosinophilia and systemic symptoms)" <?=$checkadvreact6;?> class="fontsarabun"> DRESS (Drug rash with eosinophilia and systemic symptoms)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="AGEP (Acute generalized exanthematous pustulosis)" <?=$checkadvreact7;?> class="fontsarabun"> AGEP (Acute generalized exanthematous pustulosis)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นแดงราบ" <?=$checkadvreact8;?> class="fontsarabun"> ผื่นแดงราบ</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นแดงนูน" <?=$checkadvreact9;?> class="fontsarabun"> ผื่นแดงนูน</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นมีหัวหนองคล้ายสิว" <?=$checkadvreact10;?> class="fontsarabun"> ผื่นมีหัวหนองคล้ายสิว</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="จุดแดงเลือดออกใต้ผิวหนัง" <?=$checkadvreact11;?> class="fontsarabun"> จุดแดงเลือดออกใต้ผิวหนัง</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผื่นลมพิษ" <?=$checkadvreact12;?> class="fontsarabun"> ผื่นลมพิษ</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ผิวหนังและ/หรือเยื่อบุลอก" <?=$checkadvreact13;?> class="fontsarabun"> ผิวหนังและ/หรือเยื่อบุลอก</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="คัน" <?=$checkadvreact14;?> class="fontsarabun"> คัน</div>	
						</TD>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หายใจลำบาก" <?=$checkadvreact15;?> class="fontsarabun"> หายใจลำบาก</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หายใจไม่ออก" <?=$checkadvreact16;?> class="fontsarabun"> หายใจไม่ออก</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หอบเหนื่อย" <?=$checkadvreact17;?> class="fontsarabun"> หอบเหนื่อย</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="หายใจมีเสียงหวีด" <?=$checkadvreact18;?> class="fontsarabun"> หายใจมีเสียงหวีด</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ทางเดินหายใจส่วนบนมีการบวม" <?=$checkadvreact19;?> class="fontsarabun"> ทางเดินหายใจส่วนบนมีการบวม</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="เยื่อบุจมูกอักเสบ" <?=$checkadvreact20;?> class="fontsarabun"> เยื่อบุจมูกอักเสบ</div>							
						</TD>	
					</TR>
					<TR>
						<TD><strong>อาการทางระบบหัวใจและหลอดเลือด</strong></TD>
						<TD><strong>อาการทางระบบทางเดินอาหาร</strong></TD>
					</TR>
					<TR>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Hypotension(ความดันต่ำ)" <?=$checkadvreact21;?> class="fontsarabun"> Hypotension(ความดันต่ำ)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="Angioedema(หน้าบวม ปาก ลิ้นและเพดานอ่อนบวม)" <?=$checkadvreact22;?> class="fontsarabun"> Angioedema(หน้าบวม ปาก ลิ้นและเพดานอ่อนบวม)</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="เวียนศีรษะและ/หรือเป็นลม" <?=$checkadvreact23;?> class="fontsarabun"> เวียนศีรษะและ/หรือเป็นลม</div>
						</TD>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="คลื่นไส้" <?=$checkadvreact24;?> class="fontsarabun"> คลื่นไส้</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="อาเจียน" <?=$checkadvreact25;?> class="fontsarabun"> อาเจียน</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="อุจจาระร่วง" <?=$checkadvreact26;?> class="fontsarabun"> อุจจาระร่วง</div>	
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ปวดท้อง" <?=$checkadvreact27;?> class="fontsarabun"> ปวดท้อง</div>	
						</TD>	
					</TR>
					<TR>
						<TD><strong>อาการทางระบบอื่น ๆ</strong></TD>
						<TD><strong>อื่น ๆ</strong></TD>
					</TR>
					<TR>
						<TD valign="top">
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ปวดศีรษะ" <?=$checkadvreact28;?> class="fontsarabun"> ปวดศีรษะ</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="แน่นหน้าอก" <?=$checkadvreact29;?> class="fontsarabun"> แน่นหน้าอก</div>
						<div><input type="checkbox" id="advreact" name="advreact[]" value="ชัก" <?=$checkadvreact30;?> class="fontsarabun"> ชัก</div>
						</TD valign="top">
						<TD><textarea id="advreact_other" name="advreact_other" rows="4" cols="30" class="fontsarabun"><?=$checkadvreact31;?></textarea></TD>	
					</TR>
					</table>				
				</td>
                <td valign="top">
				<div><input type="radio" id="asses1" name="asses" value="1" <? if($dresult["asses"]=='1'){ echo "checked"; } ?> class="fontsarabun"> 1= ใช่แน่นอน (Certain)</div>
				<div><input type="radio" id="asses2" name="asses" value="2" <? if($dresult["asses"]=='2'){ echo "checked"; } ?> class="fontsarabun"> 2= น่าจะใช่ (Probable)</div>
				<div><input type="radio" id="asses3" name="asses" value="3" <? if($dresult["asses"]=='3'){ echo "checked"; } ?> class="fontsarabun"> 3= อาจจะใช่ (Possible)</div>
				<div><input type="radio" id="asses4" name="asses" value="4" <? if($dresult["asses"]=='4'){ echo "checked"; } ?> class="fontsarabun"> 4= ไม่น่าใช่ (Unlikely)</div>
				<div><input type="radio" id="asses5" name="asses" value="5" <? if($dresult["asses"]=='5'){ echo "checked"; } ?> class="fontsarabun"> 5= ไม่สามารถระบุระดับ (Unclassified)</div>
				<div><input type="radio" id="asses6" name="asses" value="Hx" <? if($dresult["asses"]=='Hx'){ echo "checked"; } ?> class="fontsarabun"> Hx = มีประวัติแพ้ยาเดิมจากที่อื่น</div>
				</td>
            </tr>
			<tr>
				<td><div style="margin-left:10px;"><strong>ผลข้างเคียง : </strong></div></td>
				<td colspan="4" align="left"><div style="margin-left:10px;"><input name="sideeffects" type="text" class="fontsarabun" size="150" value="<?php echo $dresult["sideeffects"];?>" /></div></td>
			</tr>
			<tr valign="top">
				<td><div style="margin-left:10px;"><strong>แพ้ยาตามกลุ่ม : </strong></div></td>
				<td colspan="4">
					<?php 
					
					$q = $dbi->query("SELECT * FROM `drugreact_group` ");
					$i = 1;
					while ($a = $q->fetch_assoc()) { 
						
						$checked = ( $a['name']== $dresult["groupname"] ) ? 'checked="checked"' : '' ;

						?>
						<label for="<?=$a['id'];?>">
							<input type="radio" name="drugreact_group" id="<?=$a['id'];?>" value="<?=$a['id'];?>" <?=$checked;?> > <?=$i.') '.$a['name'];?><br>
						</label>
						<?php
						$i++;
					}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="left"><div style="margin-left:10px;"><strong>ผู้รายงาน : </strong> <input name="reporter" type="text" class="fontsarabun" value="<?php echo $dresult["reporter"];?>" /></div></td>
				<td colspan="2" align="left"><div style="margin-left:10px;"><strong>วันที่รายงาน : </strong> <input name="report_date" type="text" class="fontsarabun" value="<?php echo $dresult["date"];?>" />
				<span style="margin-left:30px;"><strong>ผู้บันทึกข้อมูล : </strong> <?php echo $dresult["officer"];?></span></div></td>
			</tr>			
			<tr>
				<td colspan="5" align="center"><div style="margin-top:10px;"><INPUT TYPE="submit" name="submit"  value="   แก้ไขข้อมูล   " class="fontsarabun"><span style="margin-left:40px;"><INPUT TYPE="reset" name="reset"  value="   เคลียร์ข้อมูล   " class="fontsarabun"></span></div></td>
			</tr>
        </table>
</form>		
<br>
<br>
<?
}else if( $_GET["page"] == 'del' ) {
	$hn = $_GET['hn'];
	$del="DELETE FROM drugreact WHERE row_id='".$_GET["row_id"]."'";
	$query=mysql_query($del);	
	if($query){
		echo "<script>alert('ระบบได้ทำการลบข้อมูลรายการแพ้ยาเรียบร้อยแล้ว');window.location='drugreact_new_add.php?page=show&hn=$hn';</script>";
	}
}	
?>