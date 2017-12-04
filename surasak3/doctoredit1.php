<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?php

print "<a target=_self  href='../nindex.htm' class='forntsarabun'><------ ไปเมนู</a>&nbsp;&nbsp;";
print"<a target=_self  href='doctoradd.php' class='forntsarabun'>เพื่มแพทย์ใหม่</a><br>";



 $Thaidate=date("d-m-").(date("Y")+543);

$num = Y;
    include("connect.inc");
    $query = "SELECT  row_id,name,doctorcode,menucode FROM doctor   WHERE status ='$num' ORDER BY row_id  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
        print "<div class='forntsarabun'>แพทย์ปัจจุบัน</div>";
		?>
      <table class="forntsarabun" bordercolor="#000000">
  <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
        	<th>ชื่อ</th>
        	<th>รหัส ว.</th>
       	    <th>แผนก</th>
            <th>ลบ</th>
       </tr>
       <?
        while (list ($row,$name,$doctorcode,$menucode) = mysql_fetch_row ($result)) {
    	?>
  <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
                <td><?=$name;?></td>
                <td><?=$doctorcode;?></td>
				<td>	<?=$menucode;?></td>
 				<td><a  href="doctordele.php?row=<?=$row;?>">ลบ</a></td>
            </tr>
            <?
  		 }
		?>
        </table>
        <?
			}
 include("unconnect.inc");  

print "<br><br><div class='forntsarabun'>แพทย์เก่า</div><br>";
 $Thaidate=date("d-m-").(date("Y")+543);
$num = N;
    include("connect.inc");
    $query = "SELECT  row_id,name,doctorcode,menucode FROM doctor   WHERE status ='$num' ORDER BY row_id  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
      //  print"ข่าวสาร";
	  ?>
        <table class="forntsarabun" bordercolor="#000000">
  <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
       		<th>ชื่อ</th>
        	<th>รหัส ว.</th>
       	    <th>แผนก</th>
            <th>ลบ</th>

         </tr>
        <?
        while (list ($row,$name,$doctorcode,$menucode) = mysql_fetch_row ($result)) {
		?>
           <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
                <td><?=$name;?></td>
                <td><?=$doctorcode;?></td>
				<td>	<?=$menucode;?></td>
 				 <td><a  href="doctordele1.php? row=<?=$row;?>">นำกลับมาใช้ใหม่</a></td>
            </tr>
            <?
  		 }
		?>
        </table>
        <?
			}
 include("unconnect.inc");  
?>
