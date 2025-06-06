<?php 
session_start();
include("connect.inc");
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
</style>
<h3 style="margin-top:20px;">ระบบบันทึกการแพ้ยาตามกลุ่มยาที่มีโอกาสแพ้
<span style="margin-left: 35px;"><input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="fontsarabun" /></span>
<span style="margin-left: 35px;"><input type="button" name="button" id="button" value="บันทึกแพ้ยา" onclick="window.location='drugreact_new_add.php' " class="fontsarabun" /></span>
<span style="margin-left: 50px;"><input type="button" name="button" id="button" value="รายชื่อผู้ป่วยแพ้ยา" onclick="window.open('list_drugreact.php') " class="fontsarabun" /></span>
</h3>
<?php
if( $_GET["page"] == 'first' ) {
	$sql = "SELECT * FROM `drugreact_group`";
	$query=mysql_query($sql);
	?>
	<table class="chk_table" width="60%" bgcolor="#FFFFFF">
		<tr>
			<th>กลุ่ม</th>
			<th>รายการ</th>
			<th>จำนวนยา</th>
			<th >ดำเนินการ</th>
		</tr>
		<?php
		while($item = mysql_fetch_array($query)){

			$sql = "SELECT COUNT(*) AS cnt FROM `drugreact_group_list` WHERE drugreact_group = '".$item['id']."'";
			$q = mysql_query($sql);
			$group = mysql_fetch_assoc($q);
			$groupRows = $group['cnt'];

			?>
			<tr>
				<td align="center"><?=$item['id'];?></td>
				<td><a href="drugreact_group_item.php?id=<?=$item['id'];?>" target="_blank"><?=$item['name'];?></a></td>
				<td>
					<?=$groupRows;?>
				</td>
				<td align="center"><a href="drugreactgroup_new_add.php?page=show&group=<?=$item['id'];?>&hn=<?=$_GET['hn'];?>">บันทึก</a></td>
			</tr>
			<?php
		}
		?>
	</table>
<?php
}else if( $_GET["page"] == 'show' ) {	
	$group = $_GET['group'];
	$hn = $_GET['hn'];

	$strsql = "SELECT name FROM `drugreact_group` where id='$group'";
	$strquery=mysql_query($strsql);
	list($groupname)=mysql_fetch_array($strquery);
	
    $sql2 = "SELECT * FROM `opcard` WHERE `hn` = '$hn'";
    $query2=mysql_query($sql2);	
	$result2 = mysql_fetch_array($query2);
	$ptname=$result2['yot']." ".$result2['name']." ".$result2['surname'];	
	
	$sql = "SELECT * FROM `drugreact_group_list` where drugreact_group='$group'";
	//echo $sql;
	$query=mysql_query($sql);	
?>

<TABLE bgcolor="#FFFFFF" width="90%" align="center" border="0" cellpadding="10" cellspacing="0">
<TR style="background-color:#16A085;">
	<TD colspan="6" align="center" style="font-size: 20px;font-weight:bold;">ข้อมูลส่วนตัว</TD>
</TR>	
<TR style="background-color:#D5F5E3;">
	<TD width="15%" align="right"><strong>HN : </strong></TD>
	<TD width="15%"><?php echo $result2["hn"];?>	</TD>
	<TD width="15%" align="right"><strong>ชื่อ - นามสกุล : </strong></TD>
	<TD width="30%"><?php echo $ptname;?>	</TD>	
	<TD width="10%" align="right"><strong>เบอร์โทรศัพท์ : </strong></TD>
	<TD width="15%"><?php echo $result2["phone"];?></TD>		
</TR>
<TR style="background-color:#D5F5E3;">
	<TD width="15%" align="right"><strong>เลขที่บัตรประชาชน : </strong></TD>
	<TD width="15%"><?php echo $result2["idcard"];?>	</TD>
	<TD width="15%" align="right"><strong>โรคประจำตัว : </strong></TD>
	<TD colspan="3" width="30%"><?php echo $result2["congenital_disease"];?></TD>	
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
<h3 align="center"><?=$groupname;?></h3>
<FORM name="f1" METHOD=POST ACTION="drugreactgroup_new_add.php" onsubmit="return checkList()">
<input name="act" type="hidden" value="add"/>
<input name="hn" type="hidden" value="<?php echo $result2["hn"];?>" />
<input name="group" type="hidden" value="<?=$group;?>" />
<input name="groupname" type="hidden" value="<?=$groupname;?>" />
        <table class="chk_table" align="center" width="90%" bgcolor="#FFFFFF">
            <tr>
                <th>ลำดับ</th>
                <th>รหัสยา</th>
				<th>ชื่อการค้า</th>
				<th>ชื่อสามัญ</th>
                <th width='8%'>เลือกข้อมูล</th>
            </tr>
            <?php
			$num=0;
            while($item = mysql_fetch_array($query)){
				$num++;
				$chkdrugcode=$item["drugcode"];
				$query1 = "SELECT * FROM drugreact WHERE  hn = '$hn' and drugcode = '$chkdrugcode' ";
				//echo $query1;
				$result1 = mysql_query($query1)or die("Query failed");	
				$numrows=mysql_num_rows($result1);
				$rows=mysql_fetch_array($result1);
				if($numrows > 0){
					$chk="checked='checked'";
					$chkname="<span style='color:red;'>มีประวัติแพ้</span>";
					//echo $chk;
				}else{
					$chk="";
					$chkname="";
				}

				$query2 = "SELECT drugcode,tradname,genname FROM druglst WHERE drugcode = '$chkdrugcode'";
				$result2 = mysql_query($query2);
				$rows2=mysql_fetch_array($result2);				
                ?>
                <tr>
                    <td align="center"><?=$num;?></td>
                    <td><?=$item['drugcode'];?></td>
					<td><?=$rows2['tradname'];?></td>
					<td><?=$rows2['genname'];?></td>
					<td align="center">
					<input name='ch<?=$num?>' type='checkbox'  value='1' <?=$chk;?> >&nbsp;<?=$chkname;?>
					<input name='drugcode<?=$num?>' type='hidden' value='<?=$rows2['drugcode']?>'>
					<input name='tradname<?=$num?>' type='hidden' value='<?=$rows2['tradname'];?>'>
					<input name='genname<?=$num?>' type='hidden' value='<?=$rows2['genname'];?>'>					
					<input name='numm' type='hidden' value='<?=$num?>'>
					</td>
                </tr>
                <?php
            }
            ?>
        </table>
		<h3 align="center">ระบบบันทึกการแพ้ยาแบบกลุ่ม</h3>
<?
    $dsql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' and `groupname` = '$groupname' group by groupname";
    //echo $dsql;
	$dquery=mysql_query($dsql);
	$dnum=mysql_num_rows($dquery);
	$dresult = mysql_fetch_array($dquery);
	
	if($dnum > 0){  //มีข้อมูล
		$reporter=$dresult["reporter"];
	}else{
		$reporter="OPD";		
	}
	
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
        <table class="chk_table" width="90%" align="center" bgcolor="#FFFFFF" >
            <tr>
                <th>อาการแพ้</th>
                <th>ประเมิน</th>
				<th>ผลข้างเคียง</th>
            </tr>
                <tr>
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
                <td valign="top"><textarea id="sideeffects" name="sideeffects" class="fontsarabun" rows="8" cols="55"><?=$dresult["sideeffects"];?></textarea></td>				
			<tr>
				<td align="left"><div style="margin-left:10px;"><strong>ผู้รายงาน : </strong> <input name="reporter" type="text" class="fontsarabun" value="<?=$reporter;?>" /></div></td>
				<td colspan="2" align="left"><div style="margin-left:10px;"><strong>วันที่รายงาน : </strong> <input name="report_date" type="text" class="fontsarabun" value="<?=date("Y-m-d H:i:s");?>" /></div></td>
			</tr>			
			<tr>
				<td colspan="5" align="center"><div style="margin-top:10px;"><INPUT TYPE="submit" name="submit"  value="   บันทึกข้อมูล   " class="fontsarabun"><span style="margin-left:40px;"><INPUT TYPE="reset" name="reset"  value="   เคลียร์ข้อมูล   " class="fontsarabun"></span></div></td>
			</tr>
        </table>
</form>			
<?
}
?>

<?
if($_POST["act"]=="add"){
	$hn=$_POST["hn"];
	$group=$_POST["group"];
	$asses=$_POST["asses"];
	$reporter=$_POST["reporter"];
	$report_date=$_POST["report_date"];
	$sideeffects=$_POST["sideeffects"];
	$groupname=$_POST["groupname"];
	
	$advreact = implode(',', $_POST["advreact"]);
	$advreact_other=trim($_POST["advreact_other"]);
	
	if(!empty($advreact_other)){  //ถ้ามีอาการแพ้อื่นๆ
		$advreact=$advreact.",".$advreact_other;
	}
	
	$no=0;
	for($no=1; $no<=$_POST['numm']; $no++){
		if($_POST['ch'.$no]=='1'){
			$dsql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' and `drugcode` = '".$_POST['drugcode'.$no]."' and `groupname` = '$groupname'";
			//echo $dsql."<br>";
			$dquery=mysql_query($dsql);
			$dnum=mysql_num_rows($dquery);
			$dresult = mysql_fetch_array($dquery);
			if($dnum > 0){  //มีข้อมูล
				$sql = "UPDATE drugreact SET advreact='".$advreact."',
				asses='".$asses."',
				sideeffects='".$sideeffects."',
				reporter='".$reporter."',
				date='".$report_date."',
				officer='".$_SESSION['sOfficer']."' WHERE row_id='".$dresult["row_id"]."';";
				//echo $sql."<br>";
				$result = mysql_query($sql);	
			}else{
				$sql = "INSERT INTO drugreact(hn,drugcode,tradname,genname,advreact,asses,sideeffects,groupname,reporter,date,officer) VALUES('".$hn."','".trim($_POST['drugcode'.$no])."','".$_POST['tradname'.$no]."','".$_POST['genname'.$no]."','".$advreact."','".$asses."','".$sideeffects."','".$groupname."','".$reporter."','".$report_date."','".$_SESSION['sOfficer']."');";
				//echo $sql."<br>";
				$result = mysql_query($sql);				
			}
			
			// เก็บข้อมูลเข้าแฟ้ม drugallergy
			$sHn=$hn;
			$test_drugcode = trim($_POST['drugcode'.$no]);
			$dname = $_POST['tradname'.$no];
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
			
		}
	}
	if($result){
		echo "<script>alert('บันทึกข้อมูลแพ้ยาเรียบร้อย');window.location='drugreact_new_add.php';</script>";
	}else{
		echo "<script>alert('ไม่สามารถบันทึกข้อมูลแพ้ยาได้ กรุณาลองใหม่อีกครั้ง');window.location='drugreactgroup_new_add.php?page=show&group='$group'&hn=$hn';</script>";
	}		
	exit;
}
?>	