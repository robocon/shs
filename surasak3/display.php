<html>



<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<meta name="GENERATOR" content="Microsoft FrontPage 4.0">

<meta name="ProgId" content="FrontPage.Editor.Document">

<title>New Page 5</title>

<base target="_self">
<style type="text/css" media="screen">
@font-face {
 font-family: THSarabunPSK;
 src: url("http://172.168.1.253/sm3/surasak3/THSarabun.eot") /* EOT file for IE */
}
@font-face {
 font-family: THSarabunPSK;
 src: url("surasak3/THSarabun.ttf") /* TTF file for CSS3 browsers */
}
</style>
</head>

<body bgcolor="#008080"  text="#ffffff" >

<center><font size="5"  face="THSarabunPSK" FONT color=#fb042d> <b>*** ������� �ç��Һ�Ť�������ѡ��������  ***</font></center></body>

<MARQUEE><STRONG><SPAN  <font color=#ffffff><font size="1"  face="THSarabunPSK" > ����·�ȹ� :�ç��Һ�ŷ����дѺ�ص������� 
��������ȴ�ҹ����ѡ�Ҿ�Һ�� �����������آ�Ҿ ***** �ѹ��Ԩ : �ç��Һ�Ť�������ѡ�������� 
����������ԡ���ѡ�Ҿ�Һ�ŷ���դس�Ҿ ����ҵðҹ�ҡŴ��¤��� 
���˹ѡ�����þ�Է�Լ����� ����ִ���㹨��¸��� 
����������Ѻ��ԡ����м������ԡ�����آ�Ҿ�� 
�����駻�Ѻ��ا����Է�Լ����ҧ������ͧ 
��л�Ժѵ���áԨ������Ѻ�ͺ���¨ҡ˹����˹�� 
******</FONT></FONT></SPAN></STRONG></MARQUEE>

<body bgcolor="#008080"     >
<br><center>************************************</center><br>

<?
include("connect.inc");
$sql = "select * from dr_offline where dateoffline = '".date("d-m-").(date("Y")+543)."'";
echo "<font color=#00FFFF  face='THSarabunPSK' size='5'>**��ª���ᾷ������͡��Ǩ�ѹ��� (".date("d-m-").(date("Y")+543).")**<br>";

//echo $sql;
$row = mysql_query($sql);
while($result = mysql_fetch_array($row)){
	$arr = explode(" ",$result[2]);
	echo "ᾷ�� ".$arr[1]." ".$arr[2]." , ";
}
echo "</font>";
?>
<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
   // include("connect.inc");
$num = Y;
   $query = "SELECT  row,depart,new,datetime,file FROM new  WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($row,$depart,$new,$datetime,$file) = mysql_fetch_row ($result)) {
		?>
	   <tr>
           <td BGCOLOR=F5DEB3><font face='THSarabunPSK'><br>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=15 src='new.gif' width=30>&nbsp;***&nbsp;<FONT SIZE='5' ><?=$new;?></FONT></td>
           <td BGCOLOR=F5DEB3><font face='THSarabunPSK'>***(<?=$depart;?></td>
           <td BGCOLOR=F5DEB3><font face='THSarabunPSK'>&nbsp;<?=$datetime;?>)&nbsp;*** <? if($file){ 		echo "<a href='surasak3/file_news/$file' target='_blank'><font color='#FF00FF'>��ǹ���Ŵ���</font></a>"; } ?>
	<?
		print "<br></td>
           </tr>";
           
        }
    print "</table>";

    include("surasak3/unconnect.inc");
?>
</body>

</html>

