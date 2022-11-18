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
<span style="margin-left: 50px;"><input type="button" name="button" id="button" value="รายชื่อผู้ป่วยแพ้ยา" onclick="window.open('list_drugreact.php') " class="fontsarabun" /></span>
</h3>

<?
if( $_GET["page"] == 'first' ) {
	$sql = "SELECT * FROM `drugreact_group`";
	$query=mysql_query($sql);
?>
        <table class="chk_table" width="60%" bgcolor="#FFFFFF">
            <tr>
                <th>กลุ่ม</th>
                <th>รายการ</th>
                <th >ดำเนินการ</th>
            </tr>
            <?php
            while($item = mysql_fetch_array($query)){
                ?>
                <tr>
                    <td align="center"><?=$item['id'];?></td>
                    <td><?=$item['name'];?></td>
					<td align="center"><a href="drugreactgroup_new_add.php?page=show&group=<?=$item['id'];?>&hn=<?=$_GET['hn'];?>">บันทึก</a></td>
                </tr>
                <?php
            }
            ?>
        </table>		
<?		
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
<h3 align="center">ข้อมูลส่วนตัว</h3>
<TABLE bgcolor="#FFFFFF" width="90%" align="center" border="0" cellpadding="5" cellspacing="5">
<TR>
	<TD width="15%" align="right"><strong>HN : </strong></TD>
	<TD width="15%"><?php echo $result2["hn"];?>	</TD>
	<TD width="15%" align="right"><strong>ชื่อ - นามสกุล : </strong></TD>
	<TD width="30%"><?php echo $ptname;?>	</TD>	
	<TD width="10%" align="right"><strong>เบอร์โทรศัพท์ : </strong></TD>
	<TD width="15%"><?php echo $result2["phone"];?></TD>		
</TR>
<TR>
	<TD width="15%" align="right"><strong>เลขที่บัตรประชาชน : </strong></TD>
	<TD width="15%"><?php echo $result2["idcard"];?>	</TD>
	<TD width="15%" align="right"><strong>โรคประจำตัว : </strong></TD>
	<TD colspan="3" width="30%"><?php echo $result2["congenital_disease"];?>	</TD>	
</TR>
</TABLE>
<h3 align="center"><?=$groupname?></h3>
        <table class="chk_table" align="center" width="90%" bgcolor="#FFFFFF">
            <tr>
                <th>ลำดับ</th>
                <th>รหัสยา</th>
				<th>ชื่อการค้า</th>
				<th>ชื่อสามัญ</th>
                <th width='8%'>ดำเนินการ</th>
            </tr>
            <?php
			$i=0;
            while($item = mysql_fetch_array($query)){
				$i++;
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
                    <td align="center"><?=$i?></td>
                    <td><?=$item['drugcode'];?></td>
					<td><?=$rows2['tradname'];?></td>
					<td><?=$rows2['genname'];?></td>
					<td align="center"><input name='ch<?=$num?>' type='checkbox'  value='1' <?=$chk;?> >&nbsp;<?=$chkname;?></td>
                </tr>
                <?php
            }
            ?>
        </table>
<?
}
?>