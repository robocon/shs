<?php
session_start();
include("connect.inc");
include("checklogin.php");
include("dt_menu.php");
include("dt_patient.php");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
<body >
<script>
function rechk(con){
	for(var m=1;m<=con;m++){
		if(document.getElementById("reason"+m).selectedIndex==0){
			alert("กรุณาเลือกเหตุผล");
			return false;
		}
	}
}


</script>
<?
$count = count($_SESSION["list_drugcode"]);


?>
<FORM name="form5" METHOD=POST ACTION="dt_drug_add_pt.php" onSubmit="return rechk(<?=$count?>)" >
<table width="90%" border="0" align="center">
<tr>
  <td colspan="3" align="center"><u><strong>กรุณาระบุเหตุผลการไม่ใช้ยาในบัญชียาหลักแห่งชาติ</strong></u></td>
  </tr>
<tr><td width="10%" align="center"><strong>รหัสยา</strong></td><td width="19%" align="center"><strong>ชื่อการค้า</strong></td><td width="71%" align="center"><strong>เหตุผล</strong></td></tr>
<?
$countddy=0;
for($i=0;$i<$count;$i++){
	$sql = "Select tradname, unit, stock, salepri, freepri, part, medical_sup_free  From druglst_pt  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";
	$result = Mysql_Query($sql);
	list($drugname,$unit, $stock, $salepri, $freepri, $part, $medical_sup_free) = Mysql_fetch_row($result);
	if($part=="DDY"){
		$countddy++;
?>
<tr><td bgcolor="#FFFFCC"><?=$_SESSION["list_drugcode"][$i]?></td>
<td bgcolor="#FFFFCC"><?=$drugname?></td>
<?
		if(substr($_SESSION["list_drug_reason"][$i],0,3)=="FPT"){
	?>
	<td><SELECT NAME="reason<?=$countddy?>">
   				<Option value="">กรุณาเลือกเหตุผล</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F") echo "selected='selected'"; ?>>ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
		</SELECT></td>
	<?	
		}else{
?>
<td><SELECT NAME="reason<?=$countddy?>">
				<Option value="">กรุณาเลือกเหตุผล</Option>
                <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="A") echo "selected='selected'"; ?>>เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="B") echo "selected='selected'"; ?>>ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="C") echo "selected='selected'"; ?>>ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="D") echo "selected='selected'"; ?>>มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="E") echo "selected='selected'"; ?>>ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F") echo "selected='selected'"; ?>>ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
		</SELECT></td>
<?
		}
?>
<td>
<SELECT NAME="reason2<?=$countddy?>">
				<Option value="">กรุณาเลือกข้อบ่งชี้</Option>
                <Option value="1" <? if($_SESSION["list_drug_reason2"][$i]=="1") echo "selected='selected'"; ?>>เคยใช้ยาในบัญชียาหลักมาก่อน</Option>
               <Option value="2" <? if($_SESSION["list_drug_reason2"][$i]=="2") echo "selected='selected'"; ?>>ไม่มียาในบัญชียาหลักแห่งชาติ</Option>
		</SELECT>
</td>
        </tr>
<?
	}
}
?>
<tr><td colspan="3" align="center"><input type="submit" value="          ตกลง          "></td></tr>
</table>
</FORM>
<?
if($countddy==0){
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dt_drug_add_pt.php\">";
	
}else{ if(substr($_SESSION["ptright_now"],0,3)!="R03"){
	
	?>
<script>
alert('ผู้ป่วยมีการใช้ยานอกบัญชียาหลักแห่งชาติ \n กรุณาลงลายมือชื่อใน ใบรับรองยานอกบัญชียาหลักแห่งชาติ ');
</script>
	<?
}

}

	?>
	</body>