<?php
 include("connect.inc");
 
 function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}
 

$sql = "Select * From `inhale_wound` where hn = '".$_GET["hn"]."' and date like '".$_GET["date"]."%' order by startdate  asc";


//echo $sql;

$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
$name = $arr["yot"]." ".$arr["name"];
$sname = $arr["sname"];

$date_nows = explode("-",$arr["startdate"]);
$start = $date_nows[2]."/".$date_nows[1]."/".$date_nows[0];
$date_now = explode("-",$arr["enddate"]);
$end = $date_now[2]."/".$date_now[1]."/".$date_now[0];

$hn = $arr["hn"];

$size_wound = $arr["size_wound"];
$detail = $arr["detail"];
$total_day = $arr["total_day"];
$remark = $arr["remark"];
$remark2 = $arr["remark2"];
$detail2 = $arr["detail2"];

$sql = "Select ptright, idcard From opcard where hn = '".$hn."'  limit 0,1 ";

$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
$ptright = $arr["ptright"];
$idcard = $arr["idcard"];

$sql = "Select name From `inputm` where row_id = ".$_GET["row_id"]." limit  0,1 ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
$inhaler = "��ͧ�ء�Թ";
Mysql_free_result($result);
unset($arr);


$sql2= "Select startdate AS date From `inhale_wound` where hn = '".$_GET["hn"]."' and date like '".$_GET["date"]."%' order by startdate asc";

$result2 = Mysql_Query($sql2);

include("unconnect.inc");

?>
<HTML>
<HEAD>
<TITLE> �͡㺹Ѵ���� </TITLE>
</HEAD>

<BODY leftmargin="0" topmargin="0">
<TABLE border="1"  bordercolor="#000000" cellspacing="0" cellpadding="0">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD valign="top">
	
	<TABLE border="0" style="font-family: 'TH SarabunPSK'; font-size: 18px;">
	<TR>
		<TD><B>㺹Ѵ������ͧ�ء�Թ<BR>þ.��������ѡ��������</B></TD>
		<TD align="center">
			<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
			<TR>
				<TD style="font-family: 'TH SarabunPSK'; font-size: 18px;" align="center">
			&nbsp;<U>��Ҵ��</U>&nbsp;<BR><B><?php echo $size_wound;?></B>
				</TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD colspan="2">����<U>&nbsp;<?php echo $name;?>&nbsp;<?php echo $sname;?></U></TD>
	</TR>
	<TR>
		<TD>�����<U>&nbsp;<?php echo $start;?></U></TD>
		<TD>�֧<U>&nbsp;<?php echo $end;?></U></TD>
	</TR>
	<TR>
		<TD><FONT style="font-family: 'TH SarabunPSK'; font-size: 24px;">HN<U>&nbsp;<?php echo $hn;?></U></FONT></TD>
		<TD><FONT style="font-family: 'TH SarabunPSK'; font-size: 24px;">ID<U>&nbsp;<?php echo $idcard;?></U></FONT></TD>
	</TR>
	<TR>
		<TD colspan="2">���Ѵ&nbsp;:&nbsp;<?php echo $inhaler;?></U>&nbsp; �Է���&nbsp;:&nbsp;<B><?php echo $ptright;?></B></U></TD>
	</TR>
	<TR>
		<TD colspan="2"></TD>
	</TR>
	<TR>
		<TD colspan="2">����ǳ<U>&nbsp;<?php echo $detail;?></U>&nbsp;&nbsp;
        	
      
        </TD>
	</TR>
	<TR>
	  <TD colspan="2">
      <?php if($remark != ""){
		
			if($remark == "Case Study" && count(explode("+",$remark2)) == 2){
				$xxx  = explode("+",$remark2);
				$remark = "Case Study ��� ".$xxx[0];
				$remark2 = " �Ѵ����ѹ��� ".$xxx[1];

			}
			}
		
	?> 
    <FONT SIZE="2" ><B><?php 
		$remark = str_replace(" ","&nbsp;",$remark);
		echo $remark,"&nbsp;&nbsp;<U>&nbsp;&nbsp;&nbsp;",displaydate($remark2),"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>";?></B></FONT>
      </TD>
	  </TR>

	<TR>
		<TD colspan="2">�����˵� : <?=$detail2;?></TD>
	</TR>
	<TR>
		<TD colspan="2">
		
<TABLE border="1" align="center" width="300" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-family: 'TH SarabunPSK'; font-size: 18px;">
<TR align="center">
	<TD width="25%">�/�/�</TD>
	<TD width="25%">�����Ѻ<br>�ѵä��</TD>
	<td width="25%">���������<br>����</td>
	<TD width="25%">������</TD>
</TR>
<?php while($arr2 = Mysql_fetch_assoc($result2)){
	$show="";
	if($arr2['date']==$remark2){	
	$show="*";
	}else{
	$show="";
	}
	
	echo "<TR>
			<TD align=\"center\">";echo displaydate($arr2['date']).' '.$show."</TD>
					<TD>&nbsp;</TD> 
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>";
		}
	?>
</TABLE>

		</TD>
	</TR>
	</TABLE>
	
	
	</TD>
	<TD>&nbsp;&nbsp;</TD>
	<TD valign="top">
	
	
	<CENTER>
	<B>
	<FONT style="font-family: 'TH SarabunPSK'; font-size: 22px;">
	��ͤ�û�Ժѵ�����Ѻ������
	</FONT></B><BR>
	</CENTER>

	<FONT style="font-family: 'TH SarabunPSK'; font-size: 18px;">
	1. ��ͧ�����ѹ�� 1 ���駷��þ.����ʶҹ��Һ������ҹ<BR>
	2. ������ⴹ���, ��ͧ�ѹ�������ŵԴ����<BR>
	3. �Ѻ��зҹ�����ѡ�ʺ������ҷ��ᾷ�����<BR>
	4. ��Ф������㹡óշ���ſ�������� 24 ��. �á���<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;���ʺ�غѵ��˵ص���������蹻�Ф�<BR>
	5. ¡��ǹ����ա���ѡ�ʺ����٧�����дѺ��������Ŵ�ҡ��<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;������Ŵ�ҡ���ѡ�ʺ&nbsp;�������&nbsp;�Ǵ����ǳ��������<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;����ö����Ҵ��¡���Ѻ��зҹ����ǴŴ����ᾷ���˹�<BR>
	6. �Ѻ��зҹ����÷�����õչ�٧<BR>
	7. �����ٺ������, �������� �ͧ ��ѡ�ͧ<BR>
	* ��ҷ�ҹ���ҡ�� ���٧ �Ҵ���պ��ᴧ��͹,<BR> ������¡, ����˹ͧ����ա������� ����Ҿ�ᾷ��
	
	</FONT>
	<TABLE  style="font-family: 'TH SarabunPSK'; font-size: 20px;">
			<TR>
		<TD colspan='2' align="center" ><b><u>���ҷ���</u></b></TD>
	</TR>
		<TR>
		<TD >�ء�ѹ�������ѹ��ش�Ҫ���</TD>
		<TD>08.30-12.00 �. , 13.00-16.00 �.</TD>
	</TR>
	<TR>
	  <TD  colspan= '2' align="center" ><u><b>*** ��س��ҷ��ŵ�����ҷӡ�� ***</b></u></TD>
	  </TR>
	</TABLE>
	
	</TD>
</TR>
<TR>
	<TD colspan="3" align="center" style="font-family: 'TH SarabunPSK'; font-size: 14px;">
	�͡��������Ţ FR-OPD-003/4
	��䢤��駷�� 02 �ռźѧ�Ѻ�� 9 ��.�. 51
		
	</TD>
<TR>
</TABLE>
</TD>
</TR>
</TABLE>
</body>
</html>
