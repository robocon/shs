<? session_start(); ?>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
<table class="font2">
 <tr>
  <th bgcolor=6495ED>สารบัญ</th>
  <? if($sOfficer=="อรัญญา ชาวไชย"){ ?>
  <th bgcolor=6495ED>แก้ไข / <a target=_self  href='dgcontent_add.php'>เพิ่มสารบัญใหม่</a></th>
  <? } ?>
 </tr>
<?php
    include("connect.inc");

    $query = "SELECT title,page FROM content order by page, row_id asc";
    $result = mysql_query($query)or die("Query failed");



    while (list ($title, $page) = mysql_fetch_row ($result)) {
        print " <tr>";
       print  "  <td BGCOLOR=66CDAA><a target=_self  href=\"dgpage.php?cTitle=$title&cPage=$page\">$title</a></td>";
		   	
			if($sOfficer=="อรัญญา ชาวไชย"){ 
		    print "<td BGCOLOR=66CDAA><a target=_self  href='dgcontent_edit.php?cPage=$page'>แก้ไข</a></td>";
		  	}
		  
         print  " </tr>";
        }
    include("unconnect.inc");
?>
</table>


