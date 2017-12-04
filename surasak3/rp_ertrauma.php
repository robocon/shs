<?php
session_start();
if(isset($_GET["action"]) && $_GET["action"] != "edit" && $_GET["action"] != "del"){
	header("content-type: application/x-javascript; charset=TIS-620");
}
	 include("connect.inc");

?>
<style>
body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}
.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
<script language="JavaScript" src="calendar/calendar2.js">
</script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br>
<strong>ประวัติผู้ป่วย ER</strong>
<TABLE width="100%" border="0">
<TR>
		<TD>
		<FORM METHOD=GET ACTION="">
		<TABLE border="1" bordercolor="#3366FF">
		<TR>
			<TD class="font_title" align="center" bgcolor="#3366FF">
		<B>ค้นหา</B>
		</TD>
		</TR>
		<TR>
			<TD>
		วันที่ : <INPUT TYPE="text" NAME="search_date" size="10" readonly> <input type="button" name="calendar_button" value="....." onClick="showCalendar('search_date','YY-MM-DD')"><BR>
		HN : <INPUT TYPE="text" NAME="search_hn" size="10"><BR>
		<CENTER><INPUT TYPE="submit" value="ค้นหา"></CENTER>
		</TD>
		</TR>
		</TABLE>
		</FORM>

		
		</TD>
		<TD align="right" valign="bottom">

		<?php
			
			$where ="";
			if($_REQUEST["search_hn"] != "")
			$where .=" hn = '".$_REQUEST["search_hn"]."' AND ";
			if($_REQUEST["search_date"] != "")
			$where .= "date_in = '".$_REQUEST["search_date"]."' AND ";
			
			if($where != ""){
				$where = " where ".$where; 
				$where = substr($where,0,-4);
			}

			if($where == ""){
				$where = " where  date_in = '".(date("Y")+543).date("-m-d")."' ";
			}

			$sql = "Select count(row_id) as count_tb From trauma ".$where;
			list($rows) = Mysql_fetch_row(Mysql_Query($sql));
			
			if(empty($_GET["page"]))
				$_GET["page"] = 1;

			$max = 30;
			if($rows <= $max){
				$total_page = 1;
				$limit = "  limit 0,".$max." ";
			}else{
				$xxx = number_format($rows/$max,0,",","");
				if($rows%2 == 1) $i=1; else $i=0;
				$total_page = $xxx + $i;
				$start = $max*($_GET["page"]-1);
				$limit = "  limit ".$start.",".$max." ";
			}
			

			echo "<FORM METHOD=GET ACTION=\"\">";
			echo "หน้า <INPUT TYPE=\"text\" NAME=\"page\" onkeypress = \"if(event.keyCode != 13){ check_number();}\" size=\"2\" value=\"".$_GET["page"]."\"> of ".$total_page;
			echo "<INPUT TYPE=\"hidden\" name=\"search_date\" value=\"".$_REQUEST["search_date"]."\">";
			echo "<INPUT TYPE=\"hidden\" name=\"search_hn\" value=\"".$_REQUEST["search_hn"]."\">";
			echo "</FORM>";
		?>
	</TD>
	</TR>
	</TABLE>
	<table width="100%"  border="1" bordercolor="#3366FF">
  <tr>
    <td ><table width="100%" border="0" align="center">
      <tr align="center" bgcolor="#3366FF" class="font_title">
        <td >วันที่รักษา</td>
		<td >เวลา</td>
        <td >HN</td>
        <td >DX/อาการ/การรักษา</td>
		<td >ปภ</td>
		<td >trauma</td>
		</tr>
	  <?php
	
		$sql = "Select a.row_id, date_format(a.date_in,'%d/%m/%y') as f_date, left(a.time_in,5) as time_in2, CONCAT(a.time_in,' ',date_format(a.date,'%H:%i:%s')) as h_date , a.vn, a.hn, a.dx, a.organ, a.maintenance, a.trauma, a.type_wounded, a.type_wounded2,next_ka, doctor From trauma as a ".$where."  Order by date_in DESC,  h_date desc ".$limit;

		$result = Mysql_Query($sql) or die(Mysql_Error());

		$list_hn = array();

		while($arr = Mysql_fetch_assoc($result)){
			array_push($list_hn,$arr["hn"]);
		}

	$sql = "Select hn, CONCAT(yot,' ',name,' ',surname) as full_name From opcard where hn in ('".implode("','",$list_hn)."') ";
	$result2 = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result2)){

		$hn[$arr["hn"]] = $arr["full_name"];

	}

		mysql_data_seek  ( $result , 0);
		$i=0;
		while($arr = Mysql_fetch_assoc($result)){
			if($i%2 == 0){
				$bgcolor = "#FFFFB7";
			}else{
				$bgcolor = "#FFFFFF";
			}
			$i++;
	  ?>
      <tr bgcolor="<?php echo $bgcolor;?>">
        <td align="center">
		
			<?php echo $arr["f_date"];?><BR>
			<?php if($arr["next_ka"] == "1") echo "<FONT COLOR=\"#3300FF\">[ยกยอดเวร]</FONT>";?>
			
		</td>
		<td align="center"><?php echo $arr["time_in2"];?></td>
        <td><?php echo $arr["hn"];?></td>
        <td>
		<TABLE>
		<TR>
			<TD align='right'>DX : </TD>
			<TD>
				<?php echo $arr["dx"];?>
			</TD>
		</TR>
		<TR>
			<TD align='right'>อาการ : </TD>
			<TD><?php echo $arr["organ"];?></TD>
		</TR>
		<TR>
			<TD align='right'>รักษา : </TD>
			<TD><?php echo $arr["maintenance"];?></TD>
		</TR>
		</TABLE>
		
		
		</td>
		<td><?php echo $arr["type_wounded"],",&nbsp;&nbsp;",$arr["type_wounded2"];?></td>
		<td align="center"><?php if($arr["trauma"]=="nontrauma") echo "non<BR>trauma"; else echo $arr["trauma"];?></td>
		</tr>
	  <?php }?>
    </table></td>
  </tr>
</table>
	<!--  -->
	
	</TD>
</TR>
</TABLE>