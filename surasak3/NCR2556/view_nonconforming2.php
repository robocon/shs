<?php
session_start();
include("connect.inc");	


$sql = "Select * From noncof where nonconf_id = '".$_GET["id"]."' limit 1 ";
		$result = Mysql_Query($sql) or die(Mysql_error());
		$arr_edit = Mysql_fetch_assoc($result);
		$sql = "Select * From nonconf2 where nonconf_id = '".$_GET["id"]."' limit 1 ";
		$result = Mysql_Query($sql) or die(Mysql_error());
		$arr_edit2 = Mysql_fetch_assoc($result);
		
		$nonconf_id = $arr_edit["nonconf_id"];
		$date_now = $arr_edit["nonconf_date"];
		$nonconf_time1 = substr($arr_edit["nonconf_time"],0,-3);
		$nonconf_time2 = substr($arr_edit["nonconf_time"],-2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</TITLE>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

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
.style1 {
	color: #000000;
	font-weight: bold;
}
.style2 {color: #000000}
</style>
<?php
	if(empty($_GET["view"])){
?>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;
	window.onload = function(){
		window.print();
		window.close();
	}

</script>
<?php } ?>
</HEAD>

<BODY>

<TABLE align="center" border="0" bordercolor="#000000" style="BORDER-COLLAPSE: collapse">
<TR>
	<TD width="722" align="center">
		<span class="style1"><FONT SIZE="1"><br>
		��§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ ( Non - Conforming Report )</FONT> <br>
		</span></TD>
</TR>
<TR>
	<TD valign="top">
<TABLE width="721" border="1" bordercolor="#000000" style="BORDER-COLLAPSE: collapse">
<TR valign="top">
	<TD width="233" class="style2">
	<TABLE height="115" width="100%">
	<TR valign="top">
		<TD><br>
		<? if($arr_edit["ncr"] != "000" && $arr_edit["ncr"] != "" && $arr_edit["ncr"] != "-"){
				echo "�Ţ��� NCR : ".$arr_edit["ncr"]."<BR>";	
		}?>
		˹��§ҹ / ��� : <?php echo $cfg_until[$arr_edit["until"]];?><BR>
		�ѹ��� : <?php echo $date_now;?>&nbsp;&nbsp;
		���� : <?php echo $nonconf_time1,":",$nonconf_time2; ?>		
		<br>
<strong>�ѹ�֡��§ҹ</strong> <br>

		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="�˵ء�ó��Ӥѭ" <?php if($arr_edit["type"] == "�˵ء�ó��Ӥѭ") echo " Checked ";?>>&nbsp;�˵ء�ó��Ӥѭ<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="�غѵԡ�ó�" <?php if($arr_edit["type"] == "�غѵԡ�ó�") echo " Checked ";?>>&nbsp;�غѵԡ�ó�<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="��������ʹ���ͧ" <?php if($arr_edit["type"] == "��������ʹ���ͧ") echo " Checked ";?>>&nbsp;��������ʹ���ͧ<br>
		</TD>
	</TR>
	</TABLE>	</TD>
	<TD colspan="2">
		<TABLE  height="115" width="82%" >
		<TR  valign="top">
			<TD><B>�����</B></TD>
			<TD>
				<INPUT TYPE="radio" NAME="come_from_id" value="1"  <?php if($arr_edit["come_from_id"] == "1") echo " Checked ";?>>&nbsp;ENV ROUND<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="2"  <?php if($arr_edit["come_from_id"] == "2") echo " Checked ";?>>&nbsp;IC ROUND<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="3"  <?php if($arr_edit["come_from_id"] == "3") echo " Checked ";?>>&nbsp;RM ROUND<BR>			</TD>
			<TD>
				<INPUT TYPE="radio" NAME="come_from_id" value="4"  <?php if($arr_edit["come_from_id"] == "4") echo " Checked ";?>>&nbsp;12 �Ԩ�������ǹ<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="5"  <?php if($arr_edit["come_from_id"] == "5") echo " Checked ";?>>&nbsp;˹�����§ҹ�ͧ<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="6"  <?php if($arr_edit["come_from_id"] == "6") echo " Checked ";?>>&nbsp;����&nbsp;&nbsp;<?php echo $arr_edit["come_from_detail"];?><BR>			</TD>
		</TR>
		</TABLE>	</TD>
</TR>
<TR  valign="top">
	<TD valign="top">
	<TABLE  width='100%'>
	<TR>
		<TD>
	<B>1. ������ʹ��� / ��/ ˡ���</B><BR>
		<INPUT TYPE="checkbox" NAME="topic1_1" value="1" <?php if($arr_edit["topic1_1"] == "1") echo " Checked ";?>> 1. ���<BR>
		<INPUT TYPE="checkbox" NAME="topic1_2" value="1" <?php if($arr_edit["topic1_2"] == "1") echo " Checked ";?>> 2. ����ҹ͹���躹���<BR>
		<INPUT TYPE="checkbox" NAME="topic1_3" value="1" <?php if($arr_edit["topic1_3"] == "1") echo " Checked ";?>> 3. ���ҡ��§/������/���<BR>
		<INPUT TYPE="checkbox" NAME="topic1_4" value="1" <?php if($arr_edit["topic1_4"] == "1") echo " Checked ";?>> 4. ����ͧ�Ѵ��֧��ش<BR>
		<INPUT TYPE="checkbox" NAME="topic1_5" value="1" <?php if($arr_edit["topic1_5"] == "1") echo " Checked ";?>> 5. �չ�����������§<BR>
		<INPUT TYPE="checkbox" NAME="topic1_6" value="1" <?php if($arr_edit["topic1_6"] == "1") echo " Checked ";?>> 6. ��Ѵ�������ҧ�������͹����<BR>

		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic1_7"]);?></TD>
		</TR>
		</TABLE>		</TD>
		</TR>
		</TABLE><BR>
<TABLE  width='100%'>
<TR>
	<TD>
	<B>2. ��õԴ����������</B><BR>
		<INPUT TYPE="checkbox" NAME="topic2_1" value="1" <?php if($arr_edit["topic2_1"] == "1") echo " Checked ";?>> 1. �������§ҹ�� Lab/Film X-ray ��ǹ<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� �Դ����<BR>
		<INPUT TYPE="checkbox" NAME="topic2_2" value="1" <?php if($arr_edit["topic2_2"] == "1") echo " Checked ";?>> 2. �������§ҹᾷ��/ᾷ�����ͺ<BR>
		<INPUT TYPE="checkbox" NAME="topic2_3" value="1" <?php if($arr_edit["topic2_3"] == "1") echo " Checked ";?>> 3. ��Ժѵ����١��ͧ��������<BR>
		<INPUT TYPE="checkbox" NAME="topic2_4 " value="1" <?php if($arr_edit["topic2_4"] == "1") echo " Checked ";?>> 4. �Ǫ����¹�������ó�<BR>
		<INPUT TYPE="checkbox" NAME="topic2_5" value="1" <?php if($arr_edit["topic2_5"] == "1") echo " Checked ";?>> 5. ��Թ������ç�Ѻ�ѵ����<BR>
		<INPUT TYPE="checkbox" NAME="topic2_6 " value="1" <?php if($arr_edit["topic2_6"] == "1") echo " Checked ";?>> 6. ���ѵ�������������Թ���<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic2_7"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>
<BR>
<TABLE  width='100%' height="236">
<TR>
	<TD valign="top">
	<B>3. ���ʹ</B><BR>
		<INPUT TYPE="checkbox" NAME="topic3_1" value="1" <?php if($arr_edit["topic3_1"] == "1") echo " Checked ";?> > 1. �Դ��<BR>
		<INPUT TYPE="checkbox" NAME="topic3_2" value="1" <?php if($arr_edit["topic3_2"] == "1") echo " Checked ";?> > 2. �����á��͹�ҡ���������ʹ<BR>
		<INPUT TYPE="checkbox" NAME="topic3_3" value="1" <?php if($arr_edit["topic3_3"] == "1") echo " Checked ";?> > 3. �����ʹ<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic3_4"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>	</TD>
	<TD width="221">
<TABLE  width='100%'>
<TR>
	<TD>
	<B>4. ����ͧ���</B><BR>

<INPUT TYPE="checkbox" NAME="topic4_1" value="1" <?php if($arr_edit["topic4_1"] == "1") echo " Checked ";?> >  1.�����¶١�ǡ / ����<BR>
<INPUT TYPE="checkbox" NAME="topic4_2" value="1" <?php if($arr_edit["topic4_2"] == "1") echo " Checked ";?> >  2.����������<BR>
<INPUT TYPE="checkbox" NAME="topic4_3" value="1" <?php if($arr_edit["topic4_3"] == "1") echo " Checked ";?> >  3.���ӧҹ / �ӧҹ�Դ����<BR>
<INPUT TYPE="checkbox" NAME="topic4_4" value="1" <?php if($arr_edit["topic4_4"] == "1") echo " Checked ";?> >  4.���������ͧ��� ��<BR>
<INPUT TYPE="checkbox" NAME="topic4_5" value="1" <?php if($arr_edit["topic4_5"] == "1") echo " Checked ";?> >  5.�Կ�����ӧҹ<BR>

		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic4_7"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE><BR>
<TABLE  width='100%'>
<TR>
	<TD>
	<B>5. ����ԹԨ��� / �ѡ��</B><BR>
		<INPUT TYPE="checkbox" NAME="topic5_1" value="1" <?php if($arr_edit["topic5_1"] == "1") echo " Checked ";?>> 1. �Ѻ Admit ������ä����  7 �ѹ<BR>
		<INPUT TYPE="checkbox" NAME="topic5_2" value="1" <?php if($arr_edit["topic5_2"] == "1") echo " Checked ";?>> 2. �������ö�ԹԨ����ä����ͧ admit  ������ ER ���<BR>
		<INPUT TYPE="checkbox" NAME="topic5_3" value="1" <?php if($arr_edit["topic5_3"] == "1") echo " Checked ";?>> 3. ��ҹ����硫�����Դ<BR>
		<INPUT TYPE="checkbox" NAME="topic5_4" value="1" <?php if($arr_edit["topic5_4"] == "1") echo " Checked ";?>> 4. ��Ҫ��㹡���ѡ�Ҽ����·���شŧ<BR>
		<INPUT TYPE="checkbox" NAME="topic5_5" value="1" <?php if($arr_edit["topic5_5"] == "1") echo " Checked ";?>> 5. �����á��͹�ҡ�ѵ����<BR>
		<INPUT TYPE="checkbox" NAME="topic5_6" value="1" <?php if($arr_edit["topic5_6"] == "1") echo " Checked ";?>> 6. �� Diag  Proc ����������Ἱ<BR>
		<INPUT TYPE="checkbox" NAME="topic5_7" value="1" <?php if($arr_edit["topic5_7"] == "1") echo " Checked ";?>> 7. ���������ѧ�����§��<BR>
		<INPUT TYPE="checkbox" NAME="topic5_8" value="1" <?php if($arr_edit["topic5_8"] == "1") echo " Checked ";?>> 8. ��� Cath / Tube / Drain ���١<BR>
		<INPUT TYPE="checkbox" NAME="topic5_9" value="1" <?php if($arr_edit["topic5_9"] == "1") echo " Checked ";?>> 9. ���� Cath / Tube / Drain <BR>
		<INPUT TYPE="checkbox" NAME="topic5_10" value="1" <?php if($arr_edit["topic5_10"] == "1") echo " Checked ";?>> 10. ���¼�������� ICU �������Ἱ<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic5_11"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>
<BR>
<TABLE  width='100%'>
<TR>
	<TD>
	<B>6. ��ä�ʹ</B><BR>
		<INPUT TYPE="checkbox" NAME="topic6_1" value="1" <?php if($arr_edit["topic6_1"] == "1") echo " Checked ";?>> 1. ��辺 Fetal distress �ѹ��ǧ��<BR>
		<INPUT TYPE="checkbox" NAME="topic6_2" value="1" <?php if($arr_edit["topic6_2"] == "1") echo " Checked ";?>> 2. ��ҵѴ��ʹ����Թ�<BR>
		<INPUT TYPE="checkbox" NAME="topic6_3" value="1" <?php if($arr_edit["topic6_3"] == "1") echo " Checked ";?>> 3. �����á��͹�ҡ��ä�ʹ<BR>
		<INPUT TYPE="checkbox" NAME="topic6_4" value="1" <?php if($arr_edit["topic6_4"] == "1") echo " Checked ";?>> 4. �Ҵ�纨ҡ��ä�ʹ<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic6_5"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>	</TD>
	<TD width="245">

<TABLE  width='100%'>
	<TR>
		<TD>
	<B>7. ��ü�ҵѴ / ���ѭ��</B><BR>
		<INPUT TYPE="checkbox" NAME="topic7_1" value="1" <?php if($arr_edit["topic7_1"] == "1") echo " Checked ";?>> 1. �����á��͹�ҧ���ѭ��<BR>
		<INPUT TYPE="checkbox" NAME="topic7_2" value="1" <?php if($arr_edit["topic7_2"] == "1") echo " Checked ";?>> 2. ��ҵѴ�Դ�� / �Դ��ҧ / �Դ���˹�<BR>
		<INPUT TYPE="checkbox" NAME="topic7_3" value="1" <?php if($arr_edit["topic7_3"] == "1") echo " Checked ";?>> 3. �Ѵ�������͡��������ҧἹ<BR>
		<INPUT TYPE="checkbox" NAME="topic7_4" value="1" <?php if($arr_edit["topic7_4"] == "1") echo " Checked ";?>> 4. ��纫��������з��Ҵ��<BR>
		<INPUT TYPE="checkbox" NAME="topic7_5" value="1" <?php if($arr_edit["topic7_5"] == "1") echo " Checked ";?>> 5. �������ͧ��� / ���� ���㹼�����<BR>
		<INPUT TYPE="checkbox" NAME="topic7_6" value="1" <?php if($arr_edit["topic7_6"] == "1") echo " Checked ";?>> 6. ��Ѻ�Ҽ�ҵѴ���<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic7_7"]);?></TD>
		</TR>
		</TABLE></TD>
	</TR>
	</TABLE>
	<BR>

	<TABLE  width='100%'>
	<TR>
		<TD>
	<B>8. ��� �</B><BR>
		<INPUT TYPE="checkbox" NAME="topic8_1" value="1" <?php if($arr_edit["topic8_1"] == "1") echo " Checked ";?>> 1. ������ / �ҵ� ���֧���<BR>
		<INPUT TYPE="checkbox" NAME="topic8_2" value="1" <?php if($arr_edit["topic8_2"] == "1") echo " Checked ";?>> 2. �����Ѥ������ þ.<BR>
		<INPUT TYPE="checkbox" NAME="topic8_3" value="1" <?php if($arr_edit["topic8_3"] == "1") echo " Checked ";?>> 3. �ա�÷�������ҧ��� ������ / �ҵ� /  ���˹�ҷ��<BR>
		<INPUT TYPE="checkbox" NAME="topic8_4" value="1" <?php if($arr_edit["topic8_4"] == "1") echo " Checked ";?>> 4. �����¾�������ҵ�ǵ�� / ��������ҧ��µ���ͧ<BR>
		<INPUT TYPE="checkbox" NAME="topic8_5" value="1" <?php if($arr_edit["topic8_5"] == "1") echo " Checked ";?>> 5. �á��� / �ѡ����<BR>
		<INPUT TYPE="checkbox" NAME="topic8_6" value="1" <?php if($arr_edit["topic8_6"] == "1") echo " Checked ";?>> 6. ��äء��� / ������<BR>
		<INPUT TYPE="checkbox" NAME="topic8_7" value="1" <?php if($arr_edit["topic8_7"] == "1") echo " Checked ";?>> 7. ����Ǵ�������ѹ���� / �����͹<BR>
		<INPUT TYPE="checkbox" NAME="topic8_8" value="1" <?php if($arr_edit["topic8_8"] == "1") echo " Checked ";?>> 8. �غѵ��˵������<BR>
		<INPUT TYPE="checkbox" NAME="topic8_9" value="1" <?php if($arr_edit["topic8_9"] == "1") echo " Checked ";?>> 9. ���. �Ҵ�纨ҡ��÷ӧҹ <BR>
		<INPUT TYPE="checkbox" NAME="topic8_10" value="1" <?php if($arr_edit["topic8_10"] == "1") echo " Checked ";?>> 10. ��������¡�纤�������<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic8_11"]);?></TD>
		</TR>
		</TABLE></TD>
	</TR>
	</TABLE>

	<BR>

	<TABLE  width='100%'>
	<TR>
		<TD>
	<B>9. ��� �</B><BR>
		
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic9_1"]);?></TD>
		</TR>
		</TABLE></TD>
	</TR>
	</TABLE>	</TD>
</TR>
<TR>
	<TD >
		<B>�����ҵԢͧ��úҴ��</B><BR>
		<INPUT TYPE="radio" NAME="type_injured" value="1" <?php if($arr_edit["type_injured"] == "1") echo " Checked ";?> > 1.  ��д١��С��������<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="2" <?php if($arr_edit["type_injured"] == "2") echo " Checked ";?> > 2. ���˹ѧ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="3" <?php if($arr_edit["type_injured"] == "3") echo " Checked ";?> > 3. ����ҷ��ǹ��ҧ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="4" <?php if($arr_edit["type_injured"] == "4") echo " Checked ";?> > 4. ������лʹ	</TD>
	<TD >
		<B>�ѹ�֡��Ǫ����¹</B> <INPUT TYPE="radio" NAME="save_in_medical_record" value="1" <?php if($arr_edit["save_in_medical_record"] == "1") echo " Checked ";?> > �� &nbsp;&nbsp;&nbsp;&nbsp; <INPUT TYPE="radio" NAME="save_in_medical_record" value="0" <?php if($arr_edit["save_in_medical_record"] == "0") echo " Checked ";?> > ����<BR>
		��§ҹᾷ�� : <BR>&nbsp;&nbsp;<?php echo nl2br($arr_edit["tell_doctor"]);?>
	</TD>
	<TD >
		ᾷ��������Թ : <?php echo $arr_edit["estimate_doctor"];?><BR>
		�š�û����Թ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="1" <?php if($arr_edit["estimate_result"] == "1") echo " Checked ";?> >&nbsp;����ա�úҴ��<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="2" <?php if($arr_edit["estimate_result"] == "2") echo " Checked ";?> >&nbsp;�����繡�úҴ�纪Ѵਹ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="3" <?php if($arr_edit["estimate_result"] == "3") echo " Checked ";?> >&nbsp;��ͧ���� þ. �ҹ���<BR>	
		
		</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  >
	<DIV style="page-break-after:always"></DIV><BR>
		<B>��������ػ�˵ء�ó�</B> : <BR>&nbsp;&nbsp;&nbsp;<?php echo nl2br($arr_edit["sum_up"]);?>
	</TD>
</TR>
<TR valign="top">
	<TD colspan="3" align="center"  >
		<TABLE width="100%" border='1' bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
          <TR>
            <TD colspan="3"><B>�����ع�ç</B> </TD>
          </TR>
          <TR align="center">
            <TD>Clinic</TD>
            <TD colspan="2">Non - Clinic</TD>
          </TR>
          <TR>
            <TD valign="top"><INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="A" <?php if($arr_edit2["clinic"] == "A") echo " Checked ";?>>
              &nbsp;A ���˵ء�ó������͡�ʷ��������Դ������Ҵ����͹<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="B" <?php if($arr_edit2["clinic"] == "B") echo " Checked ";?>>
              &nbsp;B  �Դ������Ҵ����͹������ѧ���֧��Ǽ�����<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="C" <?php if($arr_edit2["clinic"] == "C") echo " Checked ";?>>
              &nbsp;C  �Դ������Ҵ����͹�Ѻ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�Դ������Ҵ����͹�Ѻ����������Դ�ѹ���� <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����ա���ѡ��<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="D" <?php if($arr_edit2["clinic"] == "D") echo " Checked ";?>>
              &nbsp;D  �Դ������Ҵ����͹�Ѻ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͧ������ѧ�ҡ���������͡���Դ�ѹ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����Դ �ѹ���µ�ͼ�����<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="E" <?php if($arr_edit2["clinic"] == "E") echo " Checked ";?>>
              &nbsp;E  �Դ������Ҵ����͹�Ѻ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͧ������ѡ�������ҡ��鹨ҡ�˵ء�ó��� <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�Դ�ѹ���� / �ԡ��  ��§���Ǥ��ǵ�ͼ�����<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="F" <?php if($arr_edit2["clinic"] == "F") echo " Checked ";?>>
              &nbsp;F  �Դ������Ҵ����͹�Ѻ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͧ������ѡ��  �Դ�ѹ���� / �ԡ��  ��§���Ǥ��� <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����µ�ͧ����  þ.�ҹ���<BR>
            </TD>
            <TD valign="top"><INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N1" <?php if($arr_edit2["nonclinic"] == "N1") echo " Checked ";?>>
              Near  miss  �����дѺ 1 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  ��ͺ��Ҵ  ����Դ�����������<BR>
              <INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N2" <?php if($arr_edit2["nonclinic"] == "N2") echo " Checked ";?>>
              Low  �����дѺ 2 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  ��Ť�Ҥ���������µ�ӡ���10,000 �ҷ<BR>
              <BR>
              <INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N3" <?php if($arr_edit2["nonclinic"] == "N3") echo " Checked ";?>>
              Intermediate  �����дѺ 3 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  ��Ť�Ҥ���������µ����  10,000 �֧ <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���¡���  50,000 �ҷ <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  �Դ�Ѥ�����㹢���������<BR>
            </TD>
            <TD align="center"> ����§ҹ�ٹ��Ѳ�Ҥس�Ҿ </TD>
          </TR>
          <TR>
            <TD  valign="top"><INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="G" <?php if($arr_edit2["clinic"] == "G") echo " Checked ";?>>
              &nbsp;G  �Դ������Ҵ����͹�Ѻ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͧ������ѡ��  �Դ�����ԡ�ö���<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="H" <?php if($arr_edit2["clinic"] == "H") echo " Checked ";?>>
              &nbsp;H  �Դ������Ҵ����͹�Ѻ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͧ������ѡ��  �ӡ�á����Ե / ��ͺ���ª��Ե<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="I" <?php if($arr_edit2["clinic"] == "I") echo " Checked ";?>>
              &nbsp;I   �Դ������Ҵ����͹�Ѻ������ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ͧ������ѡ�Ҷ֧����Ե<BR>
            </TD>
            <TD valign="top"><INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N4" <?php if($arr_edit2["nonclinic"] == "N4") echo " Checked ";?>>
              High  �����дѺ 4 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  ��Ť�Ҥ���������µ���� 50,000 �ҷ 	    ���� <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  �Դ�Ѥ����·���ҡ���Ң��������� <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  Sentinel  Event<BR>
            </TD>
            <TD align="center">��§ҹ��ǹ���� 6 �������<BR>
              ��.þ�����, <BR>
              ����Ѵ��ä�������§</TD>
          </TR>
        </TABLE>	</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  >
		<B>�ѭ�ҷ�辺/���˵</B>� : <BR>&nbsp;&nbsp;&nbsp;<?php echo nl2br($arr_edit["problem"]);?>	</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  >
		<B>�ҵá����䢷������Թ�������� / �ҵá�û�ͧ�ѹ</B> : <BR>&nbsp;&nbsp;&nbsp;<?php echo nl2br($arr_edit["protect"]);?>	</TD>
</TR>
<TR>
	<TD colspan="3">
	<B>���ͼ���� : </B><?php echo $arr_edit2["send_by"];?>
	&nbsp;&nbsp;&nbsp;&nbsp;<B>�������˹�� : </B><?php echo $arr_edit2["head_name"];?>
	</TD>
</TR>
<TR>
	<TD  colspan="3">
	<B>���¤س�Ҿ</B><BR>
<INPUT TYPE="radio" NAME="until_quality" value="1" <?php if($arr_edit2["until_quality"] == "1") echo " Checked ";?>>  �Ң������������
<INPUT TYPE="radio" NAME="until_quality" value="2" <?php if($arr_edit2["until_quality"] == "2") echo " Checked ";?>>  �Դ����������ͧ��������ʹ���ͧ
<INPUT TYPE="radio" NAME="until_quality" value="3" <?php if($arr_edit2["until_quality"] == "3") echo " Checked ";?>>  �͡  CAR / PAR  �Ţ��� <?php echo $arr_edit2["no_car"];?>

	</TD>
</TR>
<TR>
	<TD  colspan="3">
	<B>�����</B><BR>
	<!--<TABLE>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P1" <?php //if($arr_edit2["program"] == "P1") echo " Checked ";?> readonly> 1. ��ô����ѡ�Ҽ�����</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P6" <?php //if($arr_edit2["program"] == "P6") echo " Checked ";?> readonly>6. �Ҫ��͹������Ф�����ʹ��¢ͧ���˹�ҷ��</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P2" <?php //if($arr_edit2["program"] == "P2") echo " Checked ";?> readonly>2. ��äǺ�����õԴ������ç��Һ��</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P7" <?php //if($arr_edit2["program"] == "P7") echo " Checked ";?> readonly>7. ��èѴ����ç���ҧ����Ҿ��Ф�����ʹ���</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P3" <?php //if($arr_edit2["program"] == "P3") echo " Checked ";?> readonly>3. ��ú����èѴ��ô�ҹ��</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P8" <?php //if($arr_edit2["program"] == "P8") echo " Checked ";?> readonly>8. ��þԷѡ������Ǵ���� ��� �������</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P4" <?php //if($arr_edit2["program"] == "P4") echo " Checked ";?> readonly>4. ����ͧ�������к��Ҹ�óٻ���</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P9" <?php //if($arr_edit2["program"] == "P9") echo " Checked ";?> readonly>9. ��û�ͧ�ѹ�Ѥ���������غѵ����</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P5" <?php //if($arr_edit2["program"] == "P5") echo " Checked ";?> readonly>5. �Է�Լ�����</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P10" <?php //if($arr_edit2["program"] == "P10") echo " Checked ";?> readonly>10.��èѴ�������</TD>
	</TR>
	</TABLE>-->
    <TABLE>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P1" <?php if($arr_edit2["program"] == "P1") echo " Checked ";?> readonly> 1. ��ô����ѡ�Ҽ�����</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P11" <?php if($arr_edit2["program"] == "P11") echo " Checked ";?> readonly>
		  4. ����ͧ���ᾷ��</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P2" <?php if($arr_edit2["program"] == "P2") echo " Checked ";?> readonly>2. ��äǺ�����õԴ������ç��Һ��</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P12" <?php if($arr_edit2["program"] == "P12") echo " Checked ";?> readonly>
		  5. ��èѴ�������Ǵ������Ф�����ʹ���</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P3" <?php if($arr_edit2["program"] == "P3") echo " Checked ";?> readonly>3. ��ú����èѴ��ô�ҹ��</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P10" <?php if($arr_edit2["program"] == "P10") echo " Checked ";?> readonly>
		  6. ��ԡ�÷����</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE></TD>
</TR>
</TABLE>

<br>
<br>
</BODY>
</HTML>
