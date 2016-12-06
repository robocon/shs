<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>รายการค่าอุปกรณ์เวชภัณฑ์</title>
</head>
<body>
ค่าอุปกรณ์เวชภัณฑ์ในการผ่าตัด<BR>
<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>
<FORM METHOD=POST ACTION="">
<TABLE>
<TR>
	<TD align="right">วัน/เดือน/ปี &nbsp;:&nbsp;</TD>
	<TD>
	
		<select size="1" name="appdate"  id="aLink">
		<option value="" selected>--วันที่--</option>
		<option value="01">01</option>
		<option value="02">02</option>
		<option value="03">03</option>
		<option value="04">04</option>
		<option value="05">05</option>
		<option value="06">06</option>
		<option value="07">07</option>
		<option value="08">08</option>
		<option value="09">09</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		</select>
		<select size="1" name="appmo">
		<option value="" selected>--เดือน--</option>
		<option value="01">มกราคม</option>
		<option value="02">กุมภาพันธ์</option>
		<option value="03">มีนาคม</option>
		<option value="04">เมษายน</option>
		<option value="05">พฤษภาคม</option>
		<option value="06">มิถุนายน</option>
		<option value="07">กรกฏาคม</option>
		<option value="08">สิงหาคม</option>
		<option value="09">กันยายน</option>
		<option value="10">ตุลาคม</option>
		<option value="11">พฤศจิกายน</option>
		<option value="12">ธันวาคม</option>
		</select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
		</TD>
</TR>
<TR>
	<TD align="right">HN&nbsp;:&nbsp;</TD>
	<TD><INPUT TYPE="text" NAME="hn"></TD>
	<TD><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</FORM>


<TABLE>
<TR align="center" bgcolor=6495ED>
	<TD>วันที่-เวลา</TD>
	<TD>HN</TD>
	<TD>ชื่อ-สกุล</TD>
	<TD>&nbsp;</TD>
	</TR>
<?php
if(isset($_POST["hn"]) ){

$sql = "Select row_id,date, ptname, hn From depart where hn != '' AND (  hn = '".$_POST["hn"]."' OR `date` LIKE '".$_POST["thiyr"]."-".$_POST["appmo"]."-".$_POST["appdate"]."%') AND detail = 'ค่าอุปกรณ์เวชภัณฑ์ในการผ่าตัด' Order by row_id DESC ";

$result = Mysql_Query($sql);

while(list($row_id,$date,$ptname,$hn) = Mysql_fetch_row($result)){

echo "
<TR BGCOLOR=66CDAA>
	<TD>",$date,"</TD>
	<TD>",$hn,"</TD>
	<TD>",$ptname,"</TD>
	<TD align='center'><A HREF=\"detailsurg_view.php?id=",$row_id,"\" target='_blank'>View</A></TD>
</TR>";

}}
?>
</TABLE>

<?
include("unconnect.inc");
?>
</body>
</html>