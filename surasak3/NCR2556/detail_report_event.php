<?php
session_start();

include("connect.inc");
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
	font-family: "TH SarabunPSK";
	font-size: 16 px;
}

.font_title{
	font-family: "TH SarabunPSK";
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

</HEAD>
<BODY>
<BR>

<TABLE width="100%" align="center" border="1" bordercolor="#3366FF" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	
	<TABLE border="1" style="border-collapse:collapse" bordercolor="#FFFFFF" cellpadding="0" cellspacing="0" width="100%">
	<TR align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">
		<TD  rowspan="2">No.</TD>
		<TD  rowspan="2" >NCR</TD>
		<TD  rowspan="2">˹��§ҹ/���</TD>
		<TD rowspan="2" align="center">�˵ء�ó�</TD>
		<?php
		if( $_SESSION['Namencr'] === '�ҵ�� �ʧ������' ){
			?>
			<td rowspan="2" width="20%">�ѭ�ҷ�辺/���˵�</td>
			<?php
		}
		?>
		<TD  align="center">�����ع�ç</TD>
		<TD rowspan="2"  align="center">��������§</TD>
		<TD  rowspan="2" >�ѹ���</TD>
		<TD  rowspan="2">����</TD>
		<TD  rowspan="2">View</TD>
	</TR>
	<TR align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">
	  <TD >Clinic</TD>
	  <!--<TD >Non-Clinic</TD>-->
	  </TR>
	<?php
	if(isset($_GET['until'])){
	$where="AND ".$_GET['topic']." = '1' AND  until = '".$_GET['until']."' ";	
	}else if(isset($_GET['topicdetail'])){
	$where="AND ".$_GET['topicdetail']." !='' ";	
	}else{
	$where="AND ".$_GET['topic']." = '1'";
	}

		$sql = "Select date_format(nonconf_date,'%d/%m/%Y')as nonconf_date, left(nonconf_time,5)as nonconf_time ,a.*  From  ncr2556 as a  where nonconf_date like '".$_GET["y"]."%'  $where  Order by nonconf_id DESC ";
		$result = mysql_query($sql) or die(mysql_error());
		$i=0;
		
//	echo $sql;
		while($arr = mysql_fetch_array($result)){	
		$i++;
		
		
		$sqld="SELECT name FROM `departments` where code='$arr[until]' ";
		$queryd=mysql_query($sqld);
		$arrd = mysql_fetch_assoc($queryd);

		$clinic=$arr['clinic'];
		//$nonclinic=$arr['nonclinic'];
		
		$nonconf_date=$arr[0];
		$nonconf_time=$arr[1];
		
		////////// �˵ء�ó� //////////
		// topic
		if($arr['topic1_1'] || $arr['topic1_2']|| $arr['topic1_3'] ||$arr['topic1_4'] ||$arr['topic1_5'] ||$arr['topic1_6']==1 || $arr['topic1_7']!=''){
			$topic1="1.������ʹ���/��/ˡ��� ,";
		}else{
			$topic1="";
		}
		if($arr['topic2_1'] || $arr['topic2_2']|| $arr['topic2_3'] ||$arr['topic2_4'] ||$arr['topic2_5'] ||$arr['topic2_6']==1 || $arr['topic2_7']!=''){
			$topic2="2.��õԴ���������� ,";
		}else{
			$topic2="";
		}
		if($arr['topic3_1'] || $arr['topic3_2']|| $arr['topic3_3'] ==1 ||$arr['topic3_4']!=''){
			$topic3="3.���ʹ ,";
		}else{
			$topic3="";
		}
		if($arr['topic4_1'] || $arr['topic4_2']|| $arr['topic4_3'] ||$arr['topic4_4'] ||$arr['topic4_5']==1 || $arr['topic4_6']!=''){
			$topic4="4.����ͧ��� ,";
		}else{
			$topic4="";
		}
		if($arr['topic5_1'] || $arr['topic5_2']|| $arr['topic5_3'] ||$arr['topic5_4'] ||$arr['topic5_5'] ||$arr['topic5_6'] || $arr['topic5_7'] || $arr['topic5_8'] || $arr['topic5_9'] || $arr['topic5_10']==1 || $arr['topic5_11']!=''){
			$topic5="5.����ԹԨ��� / �ѡ�� ,";
		}else{
			$topic5="";
		}
		if($arr['topic6_1'] || $arr['topic6_2']|| $arr['topic6_3'] ||$arr['topic6_4']==1 || $arr['topic6_5']!=''){
			$topic6="6.��ä�ʹ ,";
		}else{
			$topic6="";
		}
		if($arr['topic7_1'] || $arr['topic7_2']|| $arr['topic7_3'] ||$arr['topic7_4'] ||$arr['topic7_5'] ||$arr['topic7_6']==1 || $arr['topic7_7']!=''){
			$topic7="7.��ü�ҵѴ /���ѭ�� ,";
		}else{
			$topic7="";
		}
		if($arr['topic8_1'] || $arr['topic8_2']|| $arr['topic8_3'] ||$arr['topic8_4'] ||$arr['topic8_5'] ||$arr['topic8_6'] || $arr['topic8_7'] || $arr['topic8_8'] || $arr['topic8_9'] || $arr['topic8_10']==1 || $arr['topic8_11']!=''){
			$topic8="8.���� ,";
		}else{
			$topic8="";
		}
		
		//1.
		if($arr['topic1_1']==1){
		$topic1_1="��� ,";
		}else{
		$topic1_1="";
		}
		if($arr['topic1_2']==1){
		$topic1_2="����ҹ͹���躹��� ,";
		}else{
		$topic1_2="";
		}
		if($arr['topic1_3']==1){
		$topic1_3="���ҡ��§/������ /���,";
		}else{
		$topic1_3="";
		}
		if($arr['topic1_4']==1){
		$topic1_4="����ͧ�Ѵ�֧��ش,";
		}else{
		$topic1_4="";
		}
		
		if($arr['topic1_5']==1){
		$topic1_5="�չ�����������§,";
		}else{
		$topic1_5="";
		}
		
		if($arr['topic1_6']==1){
		$topic1_6="��Ѵ�������ҧ�������͹����,";
		}else{
		$topic1_6="";
		}
		$topic1_7=$arr['topic1_7'];
		
		//2.
		if($arr['topic2_1']==1){
		$topic2_1="�������§ҹ�� lab / Film X-ray ��ǹ���ͼԴ����,";
		}else{
		$topic2_1="";
		}
		if($arr['topic2_2']==1){
		$topic2_2="�����§ҹᾷ��/ᾷ�����ͺ,";
		}else{
		$topic2_2="";
		}
		
		if($arr['topic2_3']==1){
		$topic2_3="��Ժѵ����١��ͧ��������,";
		}else{
		$topic2_3="";
		}
		if($arr['topic2_4']==1){
		$topic2_4="�Ǫ����¹�������ó�,";
		}else{
		$topic2_4="";
		}
		if($arr['topic2_5']==1){
		$topic2_5="��Թ������ç�Ѻ�ѵ����,";
		}else{
		$topic2_5="";
		}
		if($arr['topic2_6']==1){
		$topic2_6="���ѵ�������������Թ���,";
		}else{
		$topic2_6="";
		}
		$topic2_7=$arr['topic2_7'];
	
		//3.
		if($arr['topic3_1']==1){
		$topic3_1="�Դ��,";
		}else{
		$topic3_1="";
		}
		if($arr['topic3_2']==1){
		$topic3_2="�����á��͹�ҡ���������ʹ,";
		}else{
		$topic3_2="";
		}
		if($arr['topic3_3']==1){
		$topic3_3="�����ʹ,";
		}else{
		$topic3_3="";
		}
		$topic3_4=$arr['topic3_4'];
		
		//4.
		if($arr['topic4_1']==1){
		$topic4_1="�����¶١�ǡ /����,";
		}else{
		$topic4_1="";
		}
		if($arr['topic4_2']==1){
		$topic4_2="���������� ,";
		}else{
		$topic4_2="";
		}
		if($arr['topic4_3']==1){
		$topic4_3="���ӧҹ / �ӧҹ�Դ���� ,";
		}else{
		$topic4_3="";
		}
		if($arr['topic4_4']==1){
		$topic4_4="���������ͧ����� ,";
		}else{
		$topic4_4="";
		}
		if($arr['topic4_5']==1){//
		$topic4_5="�Կ�����ӧҹ ,";
		}else{
		$topic4_5="";
		}
		$topic4_6=$arr['topic4_6'];

		//5.
		if($arr['topic5_1']==1){
		$topic5_1="�Ѻ admit ������ä���� 7�ѹ ,";
		}else{
		$topic5_1="";
		}
		if($arr['topic5_2']==1){
		$topic5_2="�������ö�ԹԨ����ä����ͧ admit ������ er ��� ,";
		}else{
		$topic5_2="";
		}
		if($arr['topic5_3']==1){
		$topic5_3="��ҹ����硫�����Դ,";
		}else{
		$topic5_3="";
		}
		if($arr['topic5_4']==1){
		$topic5_4="��Ҫ��㹡���ѡ�Ҽ����·���شŧ,";
		}else{
		$topic5_4="";
		}
		if($arr['topic5_5']==1){
		$topic5_5="�����á��͹�ҡ�ѵ����,";
		}else{
		$topic5_5="";
		}
		if($arr['topic5_6']==1){
		$topic5_6="��÷� diag proc ����������Ἱ,";
		}else{
		$topic5_6="";
		}
		if($arr['topic5_7']==1){
		$topic5_7="���������ѧ�����§��,";
		}else{
		$topic5_7="";
		}
		if($arr['topic5_8']==1){
		$topic5_8="��� Cath / Tube /Drain ���١,";
		}else{
		$topic5_8="";
		}
		if($arr['topic5_9']==1){
		$topic5_9="���� Cath / Tube /Drain,";
		}else{
		$topic5_9="";
		}
		if($arr['topic5_10']==1){
		$topic5_10="���¼�������� ICU �������Ἱ,";
		}else{
		$topic5_10="";
		}
		$topic5_11=$arr['topic5_11'];
		
		//6. 
		if($arr['topic6_1']==1){
		$topic6_1="��辺 Fetal distress �ѹ��ǧ��,";
		}else{
		$topic6_1="";
		}
		if($arr['topic6_2']==1){
		$topic6_2="��ҵѴ��ʹ����Թ�,";
		}else{
		$topic6_2="";
		}
		if($arr['topic6_3']==1){
		$topic6_3="�����á��͹�ҡ��ä�ʹ,";
		}else{
		$topic6_3="";
		}
		if($arr['topic6_4']==1){
		$topic6_4="�Ҵ�纨ҡ��ä�ʹ,";
		}else{
		$topic6_4="";
		}
		$topic6_5=$arr['topic6_5'];
		
		//7.
		if($arr['topic7_1']==1){
		$topic7_1="�����á��͹�ҧ���ѭ��,";
		}else{
		$topic7_1="";
		}
		if($arr['topic7_2']==1){
		$topic7_2="��ҵѴ�Դ��/�Դ��ҧ/�Դ���˹�,";
		}else{
		$topic7_2="";
		}if($arr['topic7_3']==1){
		$topic7_3="�Ѵ�������͡��������ҧἹ,";
		}else{
		$topic7_3="";
		}
		if($arr['topic7_4']==1){
		$topic7_4="��纫��������з��Ҵ��,";
		}else{
		$topic7_4="";
		}
		if($arr['topic7_5']==1){
		$topic7_5="�������ͧ��� / �������㹼�����,";
		}else{
		$topic7_5="";
		}
		if($arr['topic7_6']==1){
		$topic7_6="��Ѻ�Ҽ�ҵѴ���,";
		}else{
		$topic7_6="";
		}
		$topic7_7=$arr['topic7_7'];
		
		//8.
		if($arr['topic8_1']==1){
		$topic8_1="������/�ҵ� ���֧���,";
		}else{
		$topic8_1="";
		}
		if($arr['topic8_2']==1){
		$topic8_2="�����Ѥ������ þ. ,";
		}else{
		$topic8_2="";
		}if($arr['topic8_3']==1){
		$topic8_3="�ա�÷�������ҧ��� ������/�ҵ�/���˹�ҷ�� ,";
		}else{
		$topic8_3="";
		}if($arr['topic8_4']==1){
		$topic8_4="�����¾�������ҵ�ǵ��/��������ҧ��µ���ͧ ,";
		}else{
		$topic8_4="";
		}if($arr['topic8_5']==1){
		$topic8_5="�á���/�ѡ���� ,";
		}else{
		$topic8_5="";
		}
		if($arr['topic8_6']==1){
		$topic8_6="��äء���/������ ,";
		}else{
		$topic8_6="";
		}
		if($arr['topic8_7']==1){
		$topic8_7="����Ǵ�������ѹ����/�����͹ ,";
		}else{
		$topic8_7="";
		}
		if($arr['topic8_8']==1){
		$topic8_8="�غѵ��˵������ ,";
		}else{
		$topic8_8="";
		}
		if($arr['topic8_9']==1){
		$topic8_9="���.�Ҵ�纨ҡ��÷ӧҹ ,";
		}else{
		$topic8_9="";
		}
		if($arr['topic8_10']==1){
		$topic8_10="��������¡�纤������� ,";
		}else{
		$topic8_10="";
		}
		$topic8_11=$arr['topic8_11'];
		
		/*if($arr['topic2_1'] || $arr['topic2_2'] || $arr['topic2_3'] || $arr['topic2_4'] || $arr['topic2_5'] || $arr['topic2_6'] =='1'){
			
			$topic2="��õԴ����������";
			
		}
		*/
		///////////////
		
		

		///////// clinic //////////
		if($clinic=='A'){
			$clinic="A ���˵ء�ó������͡�ʷ��������Դ������Ҵ����͹";
		}elseif($arr['clinic']=='B'){
			$clinic="B �Դ������Ҵ����͹������ѧ���֧��Ǽ�����";
		}elseif($clinic=='C'){
			$clinic="C �Դ������Ҵ����͹�Ѻ������ ����Դ�ѹ���� ����ա���ѡ��";
		}elseif($clinic=='D'){
			$clinic="D �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѧ�ҡ���������͡���Դ�ѹ������ ����Դ�ѹ���µ�ͼ�����";
		}elseif($clinic=='E'){
			$clinic="E �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�������ҡ��鹨ҡ�˵ء�ó��� �Դ�ѹ����/�ԡ����§���Ǥ��ǵ�ͼ�����";
		}elseif($clinic=='F'){
			$clinic="F �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�� �Դ�ѹ����/�ԡ�� ��§���Ǥ��� �����µ�ͧ���� þ.�ҹ���";
		}elseif($clinic=='G'){
			$clinic="G �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�� �Դ�����ԡ�ö���";
		}elseif($clinic=='H'){
			$clinic="H �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�ҷӡ�á����Ե/��ͺ���ª��Ե";
		}elseif($clinic=='I'){
			$clinic="I �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�Ҷ֧����Ե";
		}else{
			$clinic="";
		}
	///////////////// non - clinic ///////////	
		if($nonclinic=='N1'){
			$nonclinic="Near miss �����дѺ 1 - ��ͺ��Ҵ ����Դ�����������";
		}elseif($nonclinic=='N2'){
			$nonclinic="Low �����дѺ 2  - ��Ť�Ҥ���������µ�ӡ��� 10,000";
		}elseif($nonclinic=='N3'){
			$nonclinic="Intermediate �����дѺ 3  - ��Ť�Ҥ���������µ���� 10,000 �֧���¡��� 50,000 �ҷ <br>
			- �Դ�Ѥ�����㹢���������";
		}elseif($nonclinic=='N4'){
			$nonclinic="High  �����дѺ 4  - ��Ť�Ҥ���������µ���� 50,000 ����  
			- �Դ�Ѥ�����㹷���ҡ���Ң��������� <br> - Sentinel Event";
		}else{
			$nonclinic= "";
		}
		////////////////////
		
		if($arr['risk1']=="1"){	
		$showrisk1="Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr['risk2']=="1"){
		$showrisk2="Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr['risk3']=="1"){
		$showrisk3="Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr['risk4']=="1"){
		$showrisk4="Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr['risk5']=="1"){
		$showrisk5="Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr['risk6']=="1"){
		$showrisk6="Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr['risk7']=="1"){
		$showrisk7="Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr['risk8']=="1"){
		$showrisk8="Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr['risk9']=="1"){
		$showrisk9="Information Risk , ";	
		}else{
		$showrisk9="";
		}
		
	

		if($i % 2 ==0)
			$bgcolor="#FFFFFF";
		else
			$bgcolor="#FFFFDD";
	echo "<TR bgcolor='".$bgcolor."'>";
		echo "<TD>".$i.".</TD>";
		echo "<TD align='right'>".$arr['ncr']."&nbsp;&nbsp;&nbsp;</TD>";
		echo "<TD>".$arrd['name']."</TD>";
		echo "<TD valign='top'>
		<b>$topic1</b>".$topic1_1.$topic1_2.$topic1_3.$topic1_4.$topic1_5.$topic1_6.$topic1_7."
		<b>$topic2</b>".$topic2_1.$topic2_2.$topic2_3.$topic2_4.$topic2_5.$topic2_6.$topic2_7."
		<b>$topic3</b>".$topic3_1.$topic3_2.$topic3_3.$topic3_4."
		<b>$topic4</b>".$topic4_1.$topic4_2.$topic4_3.$topic4_4.$topic4_5.$topic4_6."
		<b>$topic5</b>".$topic5_1.$topic5_2.$topic5_3.$topic5_4.$topic5_5.$topic5_6.$topic5_7.$topic5_8.$topic5_9.$topic5_10.$topic5_11."
		<b>$topic6</b>".$topic6_1.$topic6_2.$topic6_3.$topic6_4.$topic6_5."
		<b>$topic7</b>".$topic7_1.$topic7_2.$topic7_3.$topic7_4.$topic7_5.$topic7_6.$topic7_7."
		<b>$topic8</b>".$topic8_1.$topic8_2.$topic8_3.$topic8_4.$topic8_5.$topic8_6.$topic8_7.$topic8_8.$topic8_9.$topic8_10.$topic8_11."
		
		</TD>";
		if( $_SESSION['Namencr'] === '�ҵ�� �ʧ������' ){
			?>
			<td><?=$arr['problem'];?></td>
			<?php
		}
		echo "<TD>".$clinic."</TD>";
		echo "<TD>".$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9."</TD>";
		echo "<TD align='center'>".$nonconf_date.($arr['nonconf_date2'])."</TD>";
		echo "<TD align='center'>".$nonconf_time."</TD>";
		echo "<TD align='center'><A HREF=\"ncf_print.php?ncr_id=".$arr['nonconf_id']."\" target=\"_blank\">View</A></TD>";
	echo "</TR>";
 } ?>
  </TABLE>
	
		</TD>
</TR>
</TABLE>

</BODY>
</HTML>