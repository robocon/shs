<?php
session_start();
include("connect.inc");

     $month_["01"] = "มกราคม";
    $month_["02"] = "กุมภาพันธ์";
    $month_["03"] = "มีนาคม";
    $month_["04"] = "เมษายน";
    $month_["05"] = "พฤษภาคม";
    $month_["06"] = "มิถุนายน";
    $month_["07"] = "กรกฏาคม";
    $month_["08"] = "สิงหาคม";
    $month_["09"] = "กันยายน";
    $month_["10"] = "ตุลาคม";
    $month_["11"] = "พฤศจิกายน";
    $month_["12"] = "ธันวาคม";

?>

<FORM METHOD=POST ACTION="statrp01.php" target="_blank">
<TABLE border="1" bordercolor="#3300FF"  cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE border="0">
	<TR><TD colspan="4" bgcolor="#3300FF" align="center">
		<FONT COLOR="#FFFFFF"><B>สถิติผู้มารับการตรวจและโรคที่มารับการรักษา</B></FONT>
	</TD></TR>
	<TR>
		<TD align="right">วัน&nbsp;:&nbsp;</TD>
		<TD><INPUT TYPE="text" NAME="day" size="3" maxlength="2"></TD>

		<TD align="right">เดือน&nbsp;:&nbsp;</TD>
		<TD><SELECT NAME="month">
	
	<?php
	foreach($month_ as $key => $value){
		echo "<OPTION VALUE=\"",$key,"\" ";
			if($key == date("m")) echo " Selected ";
		echo ">",$value,"</OPTION>";
	}
	?>
		
	</SELECT>&nbsp;&nbsp;ปี&nbsp;:&nbsp;
	
	<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>

	</TR>
	<TR>
		<TD>รายการ</TD>
		<TD colspan="3">
			<Select name="code">
			<Option value="">-- รายการ --</Option>
			<?php 
			$sql = "Select code, detail From labcare where code in ('58000', '58001', '56007', '58002', '58003', '58005', '58006','58008','11229','58007','11227') limit 0,8 ";
			$result  = Mysql_Query($sql);
			while($arr = Mysql_fetch_assoc($result)){
				echo "<Option value = '",$arr["code"],"' ";
					if($_POST["code"] == $arr["code"]) echo " Selected ";
				echo ">",$arr["detail"],"</Option>";
			}
			
			
		?>
		</Select>
		</TD>
	</TR>

	<TR>
		<TD colspan="5" align="center"><INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>

<FORM METHOD="GET" ACTION="statrp03.php" target="_blanks">
<TABLE border="1" bordercolor="#3300FF"  cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE border="0">
	<TR><TD colspan="4" bgcolor="#3300FF" align="center">
		<FONT COLOR="#FFFFFF"><B>รายชื่อผู้ป่วยที่มาทำการตรวจ</B></FONT>
	</TD></TR>
	<TR>
		<TD align="right">วัน&nbsp;:&nbsp;</TD>
		<TD><INPUT TYPE="text" NAME="day" size="3" maxlength="2"></TD>

		<TD align="right">เดือน&nbsp;:&nbsp;</TD>
		<TD><SELECT NAME="month">
	
	<?php
	foreach($month_ as $key => $value){
		echo "<OPTION VALUE=\"",$key,"\" ";
			if($key == date("m")) echo " Selected ";
		echo ">",$value,"</OPTION>";
	}
	?>
		
	</SELECT>&nbsp;&nbsp;ปี&nbsp;:&nbsp;
	
	<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>

	</TR>
	<TR>
		<TD>รายการ</TD>
		<TD colspan="3">
			<Select name="code">
			<Option value="">-- รายการ --</Option>
			<?php 
		//	$sql = "Select code, detail From labcare where code in ('58001', '58002') limit 0,2 ";
		$sql = "Select code, detail From labcare where code in ('58000','58001', '56007', '58002', '58003', '58005', '58006','58008','11229','11227') limit 0,7 ";
			$result  = Mysql_Query($sql);
			while($arr = Mysql_fetch_assoc($result)){
				echo "<Option value = '",$arr["code"],"' ";
					if($_POST["code"] == $arr["code"]) echo " Selected ";
				echo ">",$arr["detail"],"</Option>";
			}
			
			
		?>
		</Select>
		</TD>
	</TR>
	<TR>
		<TD>เวลา</TD>
		<TD colspan="3">
			<Select name="time">
			<Option value="">-- เวลา --</Option>
			<Option value = '07:30:00-12:30:00'>08.00 - 12.00</Option>
			<Option value = '16:20:00-21:00:00'>16.30 - 20.30</Option>
			<Option value = '08.00:00-16:00:00'>08.00 - 16:00</Option>
            <Option value = '13:00:01-16:00:00'>13.00 - 16.00</Option>
			<Option value = '16:00:01-20:30:00'>16.00 - 20.00</Option>
		</Select>
		</TD>
	</TR>
	<TR>
		<TD>แพทย์</TD>
		<TD colspan="3">
        
        	  <? 
	 $strSQL = "SELECT name FROM doctor where (menucode='admnid' || menucode='admpt' ) order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=substr($objResult["name"],0,5);?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 

            <Option value="MD058">แพทย์แผนไทย</Option>
      		</Select>
		</TD>
	</TR>
	<TR>
		<TD colspan="5" align="center"><INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>

<FORM METHOD="GET" ACTION="statrp04.php" target="_blanks">
<TABLE border="1" bordercolor="#3300FF"  cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE border="0">
	<TR><TD colspan="4" bgcolor="#3300FF" align="center">
		<FONT COLOR="#FFFFFF"><B>รายชื่อผู้ป่วยที่มาทำการตรวจกายภาพ</B></FONT>
	</TD></TR>
	<TR>
		<TD align="right">วัน&nbsp;:&nbsp;</TD>
		<TD><INPUT TYPE="text" NAME="day" size="3" maxlength="2"></TD>

		<TD align="right">เดือน&nbsp;:&nbsp;</TD>
		<TD><SELECT NAME="month">
	
	<?php
	foreach($month_ as $key => $value){
		echo "<OPTION VALUE=\"",$key,"\" ";
			if($key == date("m")) echo " Selected ";
		echo ">",$value,"</OPTION>";
	}
	?>
		
	</SELECT>&nbsp;&nbsp;ปี&nbsp;:&nbsp;
	
	<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>

	</TR>
	<TR>
		<TD>รายการ</TD>
		<TD colspan="3">
			<Select name="code">
			<Option value="">-- รายการ --</Option>
				<Option value="กายภาพ">กายภาพ</Option>
					<Option value="กายภาพ1">กายภาพ(ยอดเงิน)</Option>
		</Select>
		</TD>
	</TR>
	<TR>
		<TD>เวลา</TD>
		<TD colspan="3">
			<Select name="time">
			<Option value="">-- เวลา --</Option>
			<Option value = '07:30:00-16:00:00'>08.00 - 16.00</Option>
			<Option value = '16:00:00-21:00:00'>16.00 - 21.00</Option>
			<Option value = '07:30:00-21:00:00'>08.00 - 21.00</Option>
		</Select>
		</TD>
	</TR>
	<TR>
	  <TD>แพทย์</TD>
	  <TD colspan="3"><select name="doctor" id="doctor">
		    <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		//echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){
			
			//$sub1=substr($arr_dxofyear['doctor'],0,5);
			//$sub2=substr($dbarr2['name'],0,5);
			
		
			//if($dbarr2['name']==$arr_dxofyear['doctor']){
			
			//echo "<option value='".$dbarr2['name']."'  selected>".$dbarr2['name']."</option>";	
			//}else{
			echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
			//}
		}
		?>
		    </select></TD>
	  </TR>
	<TR>
		<TD colspan="5" align="center"><INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>

<a target=_top  href="../nindex.htm">&lt;&lt; เมนู</a>


<?php include("unconnect.inc");?>