<?php
include("connect.inc");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ᾷ������͡��Ǩ </TITLE>
<META NAME="Generator" CONTENT="">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php
echo "<A HREF=\"../nindex.htm\">&lt; &lt; ����</A>";
?>
<FORM METHOD=POST ACTION="">
<TABLE >
<tr>
    <td align="right"><font face='Angsana New'>�ѹ&nbsp;:&nbsp;</td>
    <td><font face='Angsana New'>
      <select name="day" >
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
      ��͹ 
      <select name="month" >
		<option value="01">���Ҥ�</option>
		<option value="02">����Ҿѹ��</option>
		<option value="03">�չҤ�</option>
		<option value="04">����¹</option>
		<option value="05">����Ҥ�</option>
		<option value="06">�Զع�¹</option>
		<option value="07">�á�Ҥ�</option>
		<option value="08">�ԧ�Ҥ�</option>
		<option value="09">�ѹ��¹</option>
		<option value="10">���Ҥ�</option>
		<option value="11">��Ȩԡ�¹</option>
		<option value="12">�ѹ�Ҥ�</option>
      </select>
      ��
      <select name="year" >
		<?php for($i=date("Y")+542;$i<date("Y")+545;$i++){?>
	   <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
	   <?php }?>
      </select>
	  </td>
	 </tr>
	 <tr><td colspan="2"><INPUT TYPE="submit" value="��ŧ" name="submit"><td></tr>
</TABLE>
</FORM>


<TABLE width="400" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR align='center'>
	<TD>�ѹ�������͡��Ǩ</TD>
	<TD>ᾷ��</TD>
</TR>
<?php

if(isset($_POST["submit"])){
	$date_now = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];
}else{
	$date_now = (date('Y')+543).date("-m-d");
}
	$sql = "Select date_format(date_off,'%d-%m-%Y') as date_f, doctor From doctor_off where date_off = '".$date_now."' AND part = '' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
echo "
<TR align='center'>
	<TD>".$arr['date_f']."</TD>
	<TD>".$arr['doctor']."</TD>
</TR>";
 } ?>
</TABLE>

</BODY>
</HTML>
<?php include("unconnect.inc");?>