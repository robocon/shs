<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
<?

header("content-type: text/html; charset=tis-620");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

include "Connections/dbconfig.php";
conndb();
          
$data = $_GET['data'];
$val = $_GET['val'];


     if ($data=='vaccine') { 
          echo "<select name='vaccine' onChange=\"dochange('vaccine_detail', this.value)\" class='forntsarabun'>\n";
          echo "<option value='0'>===เลือกวัคซีน===</option>\n";
          $result=mysql_db_query($dbname,"select * from vaccine order by id_vac");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[id_vac]\" >$row[vac_name]</option> \n" ;
          }
     }  else if ($data=='vaccine_detail') {
          echo "<select name='vaccine_detail' class='forntsarabun'>\n";
          echo "<option value='0'>=== เลือกเข็ม ===</option>\n";
          $result=mysql_db_query($dbname,"SELECT * FROM vaccine_detail WHERE id_vac= '$val' ORDER BY syringe_no asc");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[syringe_no]\" >$row[detail]</option> \n" ;
          }
     }
     echo "</select>\n";

echo mysql_error();
closedb();

?>