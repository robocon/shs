<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p class="forntsarabun">�ټ� LAB �������</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="hn" type="text" class="forntsarabun" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="B1" type="submit" class="forntsarabun" value="      ��ŧ      "> <a href ="../nindex.htm"  class="forntsarabun">&lt;&lt;��Ѻ����</a></p>
</form><br />

<? if(isset($_REQUEST['hn'])){ ?>
<p class="forntsarabun">�ŵ�Ǩ�������</p>

<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
 <tr bgcolor="#0099FF">
  <th>�ѹ�������</th>
  <th>HN</th>
  <th>AN</th>
  <th>����-ʡ��</th>
  <th>��¡��</th>
 
  <th>�����</th>
 </tr>

<?php
if(!empty($_REQUEST['hn'])){
   include("connect.inc"); 
   
    $query = "SELECT * FROM patdata as a ,  labcare  as b  WHERE  a.code=b.code and a.hn = '".$_REQUEST['hn']."' and a.depart='patho' and b.labtype !='IN'  Order by date desc";
    $result = mysql_query($query) or die("Query failed");
	

    while ($dbarr= mysql_fetch_array($result)) {
		
		$filename=$dbarr[0].'.pdf';
		$filename1=$dbarr[0].'.jpg';
		
		if(file_exists("vaccine1/Lab_upload/dcorder/$filename")) {
		
        echo " <tr class=\"forntsarabun\">
				  <td>$dbarr[date]</td>
				  <td>$dbarr[hn]</td>
				  <td>$dbarr[an]</td>
				  <td>$dbarr[ptname]</td>
 				  <td>$dbarr[detail]</td>";
		echo " <td><a href=\"vaccine1/Lab_upload/dcorder/$filename\" target='_blank'>����� $filename</a></td>";
		
}elseif(file_exists("vaccine1/Lab_upload/dcorder/$filename1")){
	
	 	echo " <tr class=\"forntsarabun\">
				  <td>$dbarr[date]</td>
				  <td>$dbarr[hn]</td>
				  <td>$dbarr[an]</td>
				  <td>$dbarr[ptname]</td>
 				  <td>$dbarr[detail]</td>";
		echo " <td><a href=\"vaccine1/Lab_upload/dcorder/$filename1\" target='_blank'>����� $filename1</a></td>";
		
}
	echo "</tr>";
       }
}
include("unconnect.inc");
?>
</table>
<?
}
?>
