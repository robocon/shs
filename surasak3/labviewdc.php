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
  <p class="forntsarabun">ดูผล LAB ชิ้นเนื้อ</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="hn" type="text" class="forntsarabun" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="B1" type="submit" class="forntsarabun" value="      ตกลง      "> <a href ="../nindex.htm"  class="forntsarabun">&lt;&lt;กลับเมนู</a></p>
</form><br />

<? if(isset($_REQUEST['hn'])){ ?>
<p class="forntsarabun">ผลตรวจชิ้นเนื้อ</p>

<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
 <tr bgcolor="#0099FF">
  <th>วันและเวลา</th>
  <th>HN</th>
  <th>AN</th>
  <th>ชื่อ-สกุล</th>
  <th>รายการ</th>
 
  <th>ดูไฟล์</th>
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
		echo " <td><a href=\"vaccine1/Lab_upload/dcorder/$filename\" target='_blank'>ดูไฟล์ $filename</a></td>";
		
}elseif(file_exists("vaccine1/Lab_upload/dcorder/$filename1")){
	
	 	echo " <tr class=\"forntsarabun\">
				  <td>$dbarr[date]</td>
				  <td>$dbarr[hn]</td>
				  <td>$dbarr[an]</td>
				  <td>$dbarr[ptname]</td>
 				  <td>$dbarr[detail]</td>";
		echo " <td><a href=\"vaccine1/Lab_upload/dcorder/$filename1\" target='_blank'>ดูไฟล์ $filename1</a></td>";
		
}
	echo "</tr>";
       }
}
include("unconnect.inc");
?>
</table>


<p class="forntsarabun">Discharge summary</p>
<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
<tr bgcolor="#0099FF">
  <th>AN</th>
  <th>HN</th>
  <th>ชื่อ-สกุล</th>
  <th>สิทธิ</th>
  <th>รับป่วย</th>
  <th>จำหน่าย</th>
  <th>โรค</th>
  <th>แพทย์</th>
  <th>เตียง</th>
  <th>Discharge summary</th>

 </tr>
<?
include("connect.inc");

$query = "SELECT an,hn,ptname,ptright,date,dcdate,diag,doctor,bedcode,fname FROM ipcard WHERE hn = '".$_REQUEST['hn']."' and fname !=' ' ";
$result = mysql_query($query)or die("Query failed2");
while (list ($an,$hn,$ptname,$ptright,$date,$dcdate,$diag,$doctor,$bedcode,$fname) = mysql_fetch_row ($result)) {
	
	 print (" <tr>\n".
           "  <td>$an</a></td>\n".
           "  <td>$hn</td>\n".
           "  <td>$ptname</td>\n".
           "  <td>$ptright</a></td>\n".
           "  <td>$date</a></td>\n".
           "  <td>$dcdate</td>\n".
           "  <td>$diag</td>\n".
           "  <td>$doctor</td>\n".
           "  <td>$bedcode</td>\n".
   "  <td align=\"center\"><A HREF=\"".$fname
."\" target=\"_blank\">ดูข้อมูล</A></td>\n".
           " </tr>\n");
       }

	   include("unconnect.inc");
}
?>
