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
		<TD  rowspan="2">˹��§ҹ/���</TD>
		<TD  rowspan="2">ʶҹ����Դ�˵�</TD>
		<TD rowspan="2" align="center">��Դ������Ҵ����͹�ҧ��</TD>
		<TD  align="center">�����ع�ç</TD>
		<TD  rowspan="2" >�ѹ���</TD>
		<TD  rowspan="2">����</TD>
		<TD  rowspan="2">View</TD>
	</TR>
	<TR align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">
	  <TD >Clinic</TD>
	  <!--<TD >Non-Clinic</TD>-->
	  </TR>
	<?php
	if(isset($_GET['depart'])){
	$where="AND  depart = '".$_GET['depart']."' ";	
	}else{
	$where="";
	}

		$sql = "Select date_format(fha_date,'%d/%m/%Y')as fha_date2, left(fha_time,5)as fha_time2 ,a.*  From  drug_fail_2  as a  where fha_date like '".$_GET["y"]."-".$_GET["m"]."%'  $where  Order by row_id DESC ";
		$result = mysql_query($sql) or die(mysql_error());
		$i=0;
		
		while($arr = mysql_fetch_array($result)){
		$i++;
		
		
		$sqld="SELECT name FROM `departments` where code='$arr[depart]'";
		$queryd=mysql_query($sqld);
		$arrd = mysql_fetch_assoc($queryd);
		
		$sqla="SELECT name FROM `departments` where code='$arr[area]'";
		$querya=mysql_query($sqla);
		$arra = mysql_fetch_assoc($querya);
		
		$clinic=$arr['level_vio'];
		//$nonclinic=$arr['nonclinic'];
		
		$fha_date=$arr[0];
		$fha_time=$arr[1];
		
		////////// �˵ء�ó� //////////
		// topic
		if($arr['p1'] || $arr['p2']|| $arr['p3'] || $arr['p4'] || $arr['p5'] || $arr['p6'] || $arr['p7'] || $arr['p8'] || $arr['p9'] || $arr['p10'] || $arr['p11'] || $arr['p12'] || $arr['p13'] || $arr['p14'] || $arr['p15']==1 || $arr['p_detail']!=''){
			$topic1="��������(Prescribing error) , ";
		}else{
			$topic1="";
		}
		if($arr['d1'] || $arr['d2']|| $arr['d3'] || $arr['d4'] || $arr['d5'] || $arr['d6'] || $arr['d7'] || $arr['d8'] || $arr['d9']==1 || $arr['d_detail']!=''){
			$topic2="��è�����(Dispensing error) , ";
		}else{
			$topic2="";
		}
		if($arr['t1'] || $arr['t2']|| $arr['t3'] || $arr['t4'] || $arr['t5'] || $arr['t6'] || $arr['t7'] || $arr['t8'] || $arr['t9']==1 || $arr['t_detail']!=''){
			$topic3="��äѴ�͡�����(Transcribing error) , ";
		}else{
			$topic3="";
		}
		if($arr['a1'] || $arr['a2'] || $arr['a3'] || $arr['a4'] || $arr['a5'] || $arr['a6'] || $arr['a7'] || $arr['a8'] ||$arr['a9'] ||$arr['a10'] ||$arr['a11'] ||$arr['a12']==1 || $arr['a_detail']!=''){
			$topic4="��ú�������(Administration error) , ";
		}else{
			$topic4="";
		}
		if($arr['c1'] || $arr['c2']==1 || $arr['c_detail']!=""){
			$topic5="������Ңͧ������(Compliance Error) , ";
		}else{
			$topic5="";

		}
		
		//1.
		if($arr['p1']==1){
		$topic1_1="�����������բ�ͺ��� ,";
		}else{
		$topic1_1="";
		}
		if($arr['p2']==1){
		$topic1_2="�����������բ�������� ,";
		}else{
		$topic1_2="";
		}
		if($arr['p3']==1){
		$topic1_3="����ҷ��������ջ���ѵ���,";
		}else{
		$topic1_3="";
		}
		if($arr['p4']==1){
		$topic1_4="����ҷ���Դ��ԡ����ҵ�͡ѹ,";
		}else{
		$topic1_4="";
		}
		if($arr['p5']==1){
		$topic1_5="�����㹢�Ҵ�٧�Թ�,";
		}else{
		$topic1_5="";
		}
		if($arr['p6']==1){
		$topic1_6="�����㹢�Ҵ����Թ�,";
		}else{
		$topic1_6="";
		}
		if($arr['p7']==1){
		$topic1_7="����,";
		}else{
		$topic1_7="";
		}
		if($arr['p8']==1){
		$topic1_8="����кؤ����ç/�Ը���/�ӹǹ,";
		}else{
		$topic1_8="";
		}
		if($arr['p9']==1){
		$topic1_9="�Դ������/��Դ��,";
		}else{
		$topic1_9="";
		}
		if($arr['p10']==1){
		$topic1_10="�Դ�����ç,";
		}else{
		$topic1_10="";
		}
		if($arr['p11']==1){
		$topic1_11="�Դ�ٻẺ��,";
		}else{
		$topic1_11="";
		}					
		if($arr['p12']==1){
		$topic1_12="�Դ�Ը���,";
		}else{
		$topic1_12="";
		}
		if($arr['p13']==1){
		$topic1_13="�Դ����ҳ/�ӹǹ��,";
		}else{
		$topic1_13="";
		}
		if($arr['p14']==1){
		$topic1_14="����ҫ�ӫ�͹,";
		}else{
		$topic1_14="";
		}
		if($arr['p15']==1){
		$topic1_15="��觨��������ç�Ѻ������,";
		}else{
		$topic1_15="";
		}		
		$p_detail=$arr['p_detail'];
		
		//2.
		if($arr['d1']==1){
		$topic2_1="���������ç�Ѻ������,";
		}else{
		$topic2_1="";
		}
		if($arr['d2']==1){
		$topic2_2="�����ҼԴ��Դ/������,";
		}else{
		$topic2_2="";
		}
		if($arr['d3']==1){
		$topic2_3="�Դ��Ҵ,";
		}else{
		$topic2_3="";
		}
		if($arr['d4']==1){
		$topic2_4="�Դ�����ç,";
		}else{
		$topic2_4="";
		}
		if($arr['d5']==1){
		$topic2_5="�Դ�ӹǹ/����ҳ,";
		}else{
		$topic2_5="";
		}
		if($arr['d6']==1){
		$topic2_6="�Դ�ٻẺ,";
		}else{
		$topic2_6="";
		}
		if($arr['d7']==1){
		$topic2_7="�������������/��������Ҿ����Ҿ������������,";
		}else{
		$topic2_7="";
		}
		if($arr['d8']==1){
		$topic2_8="�ҢҴ Stock �������ö�Ѵ���������觢�й��,";
		}else{
		$topic2_8="";
		}
		if($arr['d9']==1){
		$topic2_9="����,";
		}else{
		$topic2_9="";
		}
		$d_detail=$arr['d_detail'];
	
		//3.
		if($arr['t1']==1){
		$topic3_1="�Դ������/��Դ��,";
		}else{
		$topic3_1="";
		}
		if($arr['t2']==1){
		$topic3_2="�Դ�����ç,";
		}else{
		$topic3_2="";
		}
		if($arr['t3']==1){
		$topic3_3="�Դ�ٻẺ��,";
		}else{
		$topic3_3="";
		}
		if($arr['t4']==1){
		$topic3_4="�Դ�Ը���,";
		}else{
		$topic3_4="";
		}
		if($arr['t5']==1){
		$topic3_5="�Դ����ҳ/�ӹǹ�ҫ�ӫ�͹,";
		}else{
		$topic3_5="";
		}
		if($arr['t6']==1){
		$topic3_6="�����ç�Ѻ���ͼ����,";
		}else{
		$topic3_6="";
		}
		if($arr['t7']==1){
		$topic3_7="�ҷ��ᾷ����������,";
		}else{
		$topic3_7="";
		}
		if($arr['t8']==1){
		$topic3_8="����,";
		}else{
		$topic3_8="";
		}
		$t_detail=$arr['t_detail'];
		
		//4.
		if($arr['a1']==1){
		$topic4_1="������������ҷ���˹�/��������,";
		}else{
		$topic4_1="";
		}
		if($arr['a2']==1){
		$topic4_2="�Դ��Ҵ/�����ç ,";
		}else{
		$topic4_2="";
		}
		if($arr['a3']==1){
		$topic4_3="�Դ������/��Դ�� ,";
		}else{
		$topic4_3="";
		}
		if($arr['a4']==1){
		$topic4_4="�Դ�ѵ�ҡ�������/�������� ,";
		}else{
		$topic4_4="";
		}
		if($arr['a5']==1){//
		$topic4_5="�Դ���˹�/�Զշҧ/�ٻẺ ,";
		}else{
		$topic4_5="";
		}
		if($arr['a6']==1){//
		$topic4_6="�Դ�� ,";
		}else{
		$topic4_6="";
		}
		if($arr['a7']==1){//
		$topic4_7="���� ,";
		}else{
		$topic4_7="";
		}
		if($arr['a8']==1){//
		$topic4_8="��������ú��¡��(�Ҵ/�Թ) ,";
		}else{
		$topic4_8="";
		}
		if($arr['a9']==1){//
		$topic4_9="������ҡ����/���¡��Ҩӹǹ���駷����� ,";
		}else{
		$topic4_9="";
		}
		if($arr['a10']==1){//
		$topic4_10="�����/����ҼԴ ,";
		}else{
		$topic4_10="";
		}
		if($arr['a11']==1){//
		$topic4_11="���ѡ���ҼԴ(�Ҥ�ҧ stock/�����ѹ�����ö�ء�Թ �������������� �蹹͡������ ����ͧ�ѹ�ʧ ,";
		}else{
		$topic4_11="";
		}
		if($arr['a12']==1){//
		$topic4_12="������������/��������Ҿ ,";
		}else{
		$topic4_12="";
		}
		$a_detail=$arr['a_detail'];

		//5.
		if($arr['c1']==1){
		$topic5_1="������������Ѻ��зҹ�ҵ��ᾷ����� ,";
		}else{
		$topic5_1="";
		}
		if($arr['c2']==1){
		$topic5_2="���� ,";
		}else{
		$topic5_2="";
		}
	$c_detail=$arr['c_detail'];
		////////////////////
		
	if($clinic=='A'){
			$clinic="A ���˵ء�ó������͡�ʷ��������Դ������Ҵ����͹";
		}elseif($clinic=='B'){
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
	

		if($i % 2 ==0)
			$bgcolor="#FFFFFF";
		else
			$bgcolor="#FFFFDD";
	echo "<TR bgcolor='".$bgcolor."'>";
		echo "<TD>".$i.".</TD>";
		echo "<TD>".$arrd['name']."</TD>";
		echo "<TD>".$arra['name']."</TD>";
		echo "<TD valign='top'>
		<b>$topic1</b>".$topic1_1.$topic1_2.$topic1_3.$topic1_4.$topic1_5.$topic1_6.$topic1_7.$topic1_8.$topic1_9.$topic1_10.$topic1_11.$topic1_12.$topic1_13.$topic1_14.$topic1_15.$p_detail."
		<b>$topic2</b>".$topic2_1.$topic2_2.$topic2_3.$topic2_4.$topic2_5.$topic2_6.$topic2_7.$topic2_8.$topic2_9.$d_detail."
		<b>$topic3</b>".$topic3_1.$topic3_2.$topic3_3.$topic3_4.$topic3_5.$topic3_6.$topic3_7.$topic3_8.$topic3_8.$t_detail."
		<b>$topic4</b>".$topic4_1.$topic4_2.$topic4_3.$topic4_4.$topic4_5.$topic4_6.$topic4_7.$topic4_8.$topic4_9.$topic4_10.$topic4_11.$topic4_12.$a_detail."
		<b>$topic5</b>".$topic5_1.$topic5_2.$c_detail."
		</TD>";
		echo "<TD>".$clinic."</TD>";
		echo "<TD align='center'>".$fha_date."</TD>";
		echo "<TD align='center'>".$fha_time."</TD>";
		echo "<TD align='center'><A HREF=\"fha_report.php?row_id=".$arr['row_id']."\" target=\"_blank\">View</A></TD>";
	echo "</TR>";
 } ?>
  </TABLE>
	
		</TD>
</TR>
</TABLE>

</BODY>
</HTML>