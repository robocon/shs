<?php 
session_start();

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
 include("connect.inc");
?>
<!-- <body Onload="window.print();"> -->
<body >
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<!-- <meta http-equiv="refresh" content="3;URL=1hnappoi1.php"> -->
</head>
<?php

if(isset($cHn )){ 

  $appd=$cappdate.' '.$cappmo.' '.$cthiyr;
  $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
	detail,detail2,advice,patho,xray,other,depcode)
	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',
	'$room','$detail','$detail2','$advice','$patho','$xray','$other','$depcode');";
	//$result = mysql_query($sql);
}

?>


<TABLE border="0"  bordercolor="#000000" cellspacing="0" cellpadding="0" width="650" >
<TR>
	<TD>
	<CENTER><B><FONT style="font-family: Angsana New; font-size: 22px;">㺹Ѵ������&nbsp;&nbsp;�ç��Һ�Ť�������ѡ��������</FONT></B></CENTER>
<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0" width="650">
<TR>
	<TD valign="top" rowspan="2">
	
	<TABLE border="0" style="font-family: Angsana New; font-size: 18px;" cellspacing="0" cellpadding="0"  width="100%" height="350">
	<TR>
		<TD>&nbsp;&nbsp;<FONT style="font-family: Angsana New; font-size: 25px;" >HN<U>&nbsp;<?php echo $cHn;?></FONT></U></TD>
		<TD><FONT style="font-family: Angsana New; font-size: 25px;" >ID<U>&nbsp;<?php echo $idcard;?></U></FONT></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;����<U>&nbsp;<?php echo $cPtname;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;����<U>&nbsp;<?php echo $cAge;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;�Է���<U>&nbsp;<?php echo $cptright,"&nbsp;:",$cidguard;?></U></TD>
	</TR>
			<TR bgcolor="#000000" height="2">
		<TD colspan="2"></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;�Ѵ���ѹ���<U>&nbsp;<?php echo $appd,"</U>&nbsp;&nbsp;&nbsp;����<U>&nbsp;",$capptime;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;���㺹Ѵ���<U>&nbsp;<?php echo $room;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;����<U>&nbsp;<?php echo $detail," ",$detail2;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;ᾷ����Ѵ<U>&nbsp;<?php echo $cdoctor;?></U></TD>
	</TR>
	</TR>
			<TR bgcolor="#000000" height="2">
		<TD colspan="2"></TD>
	</TR>
	<?php

   if($advice != 'NA') {

       echo "
	   <TR>
		<TD colspan=\"2\">
			&nbsp;&nbsp;����й�&nbsp;",$advice,"
		</TD>
	</TR>";

    }



   if($patho != 'NA') {

         echo "<TR>
		<TD colspan=\"2\">
			&nbsp;&nbsp;��Ǩ��Ҹ�&nbsp;",$patho,"
		</TD>
	</TR>";

    }



   if($xray != 'NA') {

        echo "<TD colspan=\"2\">
			&nbsp;&nbsp;��Ǩ�͡�����&nbsp;",$xray,"
		</TD>
	</TR>";

    }



   if(!empty($other)) { 

        echo "<TD colspan=\"2\">
			&nbsp;&nbsp;��Ǩ&nbsp;",$other,"
		</TD>
	</TR>";

    }

	?>
	
	<TR>
		<TD colspan="2">&nbsp;&nbsp;�ѹ������ҷ���͡㺹Ѵ&nbsp;<?php echo $Thaidate;?>
		</TD>
	</TR>
	</TABLE>
	
	
	</TD>
	<TD valign="top">

	<CENTER>
	<B>
	<FONT style="font-family: Angsana New; font-size: 22px;">
	��ͤ�û�Ժѵ�����Ѻ������
	</FONT></B><BR>
	</CENTER>

<FONT style="font-family: Angsana New; font-size: 18px;">
		&nbsp;&nbsp;
		<?php

		switch($detail){
			case "FU01 ��Ǩ����Ѵ" : 
				echo "<b>�����˵�:<u>$cidguard</u></b><br>&nbsp;&nbsp;��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������㺹Ѵ���Ἱ�����¹ &nbsp; "; 
			break;

			case "FU02 ����ŵ�Ǩ" : 
				echo "<b>�����˵�:<u>$cidguard</u></b><br>&nbsp;&nbsp;��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B>";
			break;

			case "FU03 �͹�ç��Һ��" : 
				echo "<b>�����˵�:<u>$cidguard</u></b><br>&nbsp;&nbsp;�����¹Ѵ�͹�ç��Һ��������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;��س��ҵç����ѹ������ҹѴ <br>&nbsp;&nbsp;  ������͡��÷���ͧ����ç��Һ�� �� ���Һѵû�Шӵ�� , ˹ѧ����Ѻ�ͧ�Է�Ե�ҧ�  &nbsp;<b> </B>";
			break;

			case "FU04 �ѹ�����" : 
				echo "<b>�����˵�:<u>$cidguard</u></b><br>&nbsp;&nbsp;1.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ����� &nbsp;&nbsp;<br>&nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B> ";
			break;

			case "FU05 ��ҵѴ" : 
				echo "<b>�����˵�:<u>$cidguard</u></b><br>&nbsp;&nbsp;1.�����¹Ѵ��Ǩ��ҵѴ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;<br>&nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B> ";
			break;

			case "FU06 �ٵ�" : 
				echo "<b>�����˵�:<u>$cidguard</u></b><br>&nbsp;&nbsp;1.�����¹Ѵ��Ǩ�ٵ�������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;<br>&nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B>";
			break;

			case "FU07 ��չԡ�ѧ���" : 
				echo "1.�����¹Ѵ��Ǩ��չԡ�ѧ���������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;<br>&nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<br>&nbsp;&nbsp;3.�Ӥ������Ҵ��ҧ���������º����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.�Ѻ��зҹ������������� <br>&nbsp;&nbsp; 5.�������ͼ�ҷ������Ѵ�� ����������ᢹ������͡ҧࡧ�������ö�ٴ����˹��������дǡ<br>&nbsp;&nbsp; 6.�����ͧ��� �������������º���¡�͹�����������Դ�ҡ�ûǴ������Т�нѧ���";
			break;

			case "FU08 Echo" : 
				echo "1.�����¹Ѵ��Ǩ Echo ������㺹Ѵ���ش�Ѵ &nbsp;&nbsp;<br>&nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B>";
			break;

			case "FU09 ��š�д١" : 
				echo "1.�����¹Ѵ��Ǩ��š�д١������㺹Ѵ���ش�Ѵ&nbsp;&nbsp;<br>&nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B>";
			break;

			default : 
				echo "<b><u>$cidguard</u></b><br>&nbsp;&nbsp;1.�����¹Ѵ��Ǩ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;<br>&nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B> ";
			break;
		}
		?><BR>
		
		</FONT>
		<BR>
	
	</TD>
</TR>
<TR>
	<TD>
	<FONT style="font-family: Angsana New; font-size: 18px;">
		&nbsp;&nbsp;����͡㺹Ѵ<U>&nbsp;<?php echo $sOfficer,"&nbsp;",$depcode;?></U><BR>
		
		&nbsp;&nbsp;�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br>&nbsp;&nbsp;��ѹ�����Ҫ��� ���� 13.00 �. - 15.00 �.<BR>
		&nbsp;&nbsp;�� 054-221874 ��� 1100 , 1125
		</FONT>
	</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<?php
 include("unconnect.inc");
session_unregister("cHn");  
session_unregister("cPtname");
session_unregister("cAge");
session_unregister("idcard");
?>