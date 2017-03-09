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
print"<a target=_self  href='newadd.php' class='forntsarabun'>บันทึกข่าวสารใหม่</a><br>";



 $Thaidate=date("d-m-").(date("Y")+543);

$num = Y;
    include("connect.inc");
    $query = "SELECT  row,depart,new,datetime,file,numday FROM new   WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
        print "<div class='forntsarabun'>ข่าวสารปัจจุบัน</div>";
		?>
      <table class="forntsarabun" bordercolor="#000000">
  <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
        	<th>Row</th>
        	<th>แผนก</th>
       	    <th>ข่าว</th>
			<th>ไฟล์</th>
       		<th>วันเวลา</th>
			<th>สิ้นสุด</th>
            <th>ลบ</th>
       </tr>
       <?
        while (list ($row,$depart,$new,$datetime,$file,$end) = mysql_fetch_row ($result)) {
    	?>
  <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
                <td><?=$row;?></td>
                <td><?=$depart;?></td>
                <td><?=substr("$new",0,80)."..."; ?><a href="new_detail.php?row=<?=$row;?>"  title="ดูรายละเอียด" >อ่านต่อ...</a></td>
				 <td><? if($file!=""){ 
				 echo " <a  href='file_news/$file'>";
				 ?>
				 <img src='Save Icon.jpg' width='32' height='32' title='ดาวน์โหลดไฟล์'/></a>
                 <?
				 }else{ 
				 echo ""; 
				 } ?>
                 </td>
				<td>	<?=$datetime;?></td>
					<td>	<?=$end;?></td>
 				<td><a  href="newdele.php?row=<?=$row;?>">ลบ</a></td>
            </tr>
            <?
  		 }
		?>
        </table>
        <?
			}
 include("unconnect.inc");  

print "<br><br><div class='forntsarabun'>ข่าวสารเก่า</div><br>";
 $Thaidate=date("d-m-").(date("Y")+543);
$num = N;
    include("connect.inc");
    $query = "SELECT  row,depart,new,datetime,file FROM new   WHERE status ='$num' ORDER BY row DESC ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
      //  print"ข่าวสาร";
	  ?>
        <table class="forntsarabun" bordercolor="#000000">
  <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
       		 <th>Row</th>
        	<th>แผนก</th>
       	    <th>ข่าว</th>
			<th>ไฟล์</th>
       		<th>วันเวลา</th>
            <th>ลบ</th>

         </tr>
        <?
        while (list ($row,$depart,$new,$datetime,$file) = mysql_fetch_row ($result)) {
		?>
           <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
                <td><?=$row;?></td>
                <td><?=$depart;?></td>
                <td><?=substr("$new",0,80)."..."; ?><a href="new_detail.php?row=<?=$row;?>"  title="ดูรายละเอียด" >อ่านต่อ...</a></td>
				 <td><? if($file!=""){ 
				 echo " <a  href='file_news/$file'>";
				 ?>
				 <img src='Save Icon.jpg' width='32' height='32' title='ดาวน์โหลดไฟล์'/></a>
                 <?
				 }else{ 
				 echo ""; 
				 } ?>
                 </td>
				<td>	<?=$datetime;?></td>
 				 <td><a  href="newdele1.php? row=<?=$row;?>">ประกาศใหม่</a></td>
            </tr>
            <?
  		 }
		?>
        </table>
        <?
			}
 include("unconnect.inc");  
?>
