<?php

global $detail, $user_code;

include("connect.inc");
$Thidate = date("d-m-").(date("Y")+543).date(" H:i:s"); 

$sql = "Select * From appoint  where hn='".$_GET["hn"]."' AND `date` like '".(date("Y")+543).date("-m-d")."%' AND apptime <> '¡��ԡ��ùѴ'  Order by row_id DESC limit 1 ";

$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);

$xxx = explode("(�",$arr["doctor"]);
$arr["doctor"] = $xxx[0];

$sql2 = "Select * From appoint_lab where id = '".$arr["row_id"]."' and id != 0 ";
$result2 = Mysql_Query($sql2);
$i=false;
$list_lab_appoint = array();
while($arr2 = Mysql_fetch_assoc($result2)){
	array_push($list_lab_appoint,$arr2["code"]);
	$i=true;
}


$drugstk = "<TABLE cellpadding=\"0\" cellspacing=\"0\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 ><B>㺹Ѵ������ þ.��������ѡ�������� �ӻҧ</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2>���� : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>�ѹ��� : ".$arr["appdate"]."<font face='Angsana New' size= 2 >&nbsp;���� : ".$arr["apptime"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 ><B>���� :</B> ".$arr["detail"]."<font face='Angsana New' size= 2 >&nbsp;<B>ᾷ�� :</B> ".$arr["doctor"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><U><B>���㺹Ѵ��� :</B> ".$arr["room"]."</U></TD>
			</TR>";

if($i){

$drugstk .="<TR >
				<TD><font face='Angsana New' size= 1 >LAB : ".implode(", ",$list_lab_appoint)."</TD>
			</TR>";
}

if(trim($arr["xray"]) !="" &&  trim($arr["xray"]) !="NA"){
$drugstk .="<TR >
				<TD><font face='Angsana New' size= 1 >X-Ray : ".$arr["xray"]."&nbsp;&nbsp;&nbsp;&nbsp;����".$arr["other"]."</TD>
			</TR>";

}

$drugstk .="<TR>
				<TD><font face='Angsana New' size= 1 >�ѹ�����͡㺹Ѵ : ".date("d/m/Y H:i:s")."</TD>
			</TR>";

$phone_intra = '1100';
if( $user_code === 'ADMDEN' ){
	$phone_intra = '1230';
}

$drugstk .= "<TR>
				<TD><font face='Angsana New' size= 1 > �բ��ʧ���㹡�ùѴ�Դ��ͨش��ԡ�ùѴ �� 054-839305 ��� $phone_intra</TD>
			</TR>
			</TABLE>
			";

if($i){
	$drugstk .= '<div style="page-break-after: always;"></div>';
	$drugstk .= '<div style="line-height:1px;">&nbsp;</div>';
$drugstk .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" >
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 ><b>㺹Ѵ������ʹ</b></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >���ͼ����� : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>�Ѵ�ѹ��� : ".$arr["appdate"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ᾷ�� : ".$arr["doctor"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >��ͤ�û�Ժѵ� : <U>".$arr["advice"]."</U></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >��¡�� : <B>".implode(", ",$list_lab_appoint)."</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 1 >".$arr["other"]."</TD>
			</TR>
			</TABLE>
			";
}


if(trim($arr["xray"]) !=""  &&  trim($arr["xray"]) !="NA"){
	$drugstk .= '<div style="page-break-after: always;"></div>';
	$drugstk .= '<div style="line-height:1px;">&nbsp;</div>';
$drugstk .= "<TABLE cellpadding=\"0\" cellspacing=\"0\">
			<TR>
				<TD align=\"center\"><font size= 3 ><b>㺹Ѵ X-Ray</b></TD>
			</TR>
			<TR>
				<TD><font size= 2 >���ͼ����� : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
			</TR>
			<TR>
				<TD><font size= 3 ><B><U>�Ѵ�ѹ��� : ".$arr["appdate"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font size= 2 >ᾷ�� : ".$arr["doctor"]."</TD>
			</TR>
			<TR>
				<TD><font size= 2 >X-Ray : <B>".$arr["xray"]."</B></TD>
			</TR>
			<TR>
				<TD><font size= 1 >".$arr["other"]."</TD>
			</TR>
			</TABLE>";
}



echo "<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		window.onload = function(){
			window.print();
			//setTimeout(\"window.location.href='dt_index.php';\",5000);
		}
		</SCRIPT>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">
		",$drugstk,"
	</body>
	</html>";


	include("unconnect.inc");
?>