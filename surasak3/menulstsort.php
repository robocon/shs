<?php
	session_start();
?>
 <link type="text/css" href="sm3_style.css" rel="stylesheet" />
<a href="../nindex.htm" class="fontsara"><--ไปเมนู </a>

<BR />
<div class="fontsara"><br>** กรุณาใส่ตัวเลขในช่องเฉพาะที่ต้องการเรียงเมนูค่ะ ** <br></div>
<div class="fontsara">เรียงลำดับเมนูทั้งหมด <?=$x;?> รายการ <br></div>
<FORM METHOD="POST" ACTION="menulstsort_edit.php" target="_blank">
<table style="border-collapse:collapse" bordercolor="#000000" cellpadding="0" cellspacing="0" border="1" class="fontsara1">
 	<tr  bgcolor="#ffff99" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
 		<th >#</th>
  		<th>เมนู</th>
  		<th>ลำดับที่</th>
	</tr>
<?php

    include("connect.inc");
 	$query = "SELECT * FROM menulst WHERE menucode LIKE '$smenucode%' order by menu_sort desc";
    $result = mysql_query($query) or die("Query failed");
$numrow=mysql_num_rows($result);
$n=1;
while($row = mysql_fetch_array($result)){
	
	
	$query1 = "SELECT sort  FROM menu_user WHERE member_code='".$sRowid."' AND menu='".$row['menu']."' ";
	$result1 = mysql_query($query1) or die("Query failed");

	
	$arrsort = mysql_fetch_array ($result1);
	 
	 
	 
?>
	<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
		<td><?=$n;?></td>
		<td><?=$row['menu'];?></td>
		<td align='right'>
        <INPUT TYPE="text" NAME="sort<?=$n;?>" value='<?=$arrsort['sort'];?>' size="5" class="fontsara1">
        <INPUT TYPE="hidden" NAME="row_id<?=$n;?>" value="<?=$row['row_id'];?>">
        <INPUT type="hidden" NAME="script<?=$n;?>" value="<?=$row['script'];?>">
		<INPUT type="hidden" NAME="menu<?=$n;?>" value="<?=$row['menu'];?>">
		<INPUT type="hidden" NAME="target<?=$n;?>" value="<?=$row['target'];?>">
        </td>

 </tr>
        <? 
	$n++;
	//}
	?>
    
    <?
}

 include("unconnect.inc");
?> 

<tr>
<td colspan="3" align="center">
<INPUT type='hidden' NAME="max" value="<?=$numrow;?>">

<INPUT TYPE="submit" value="ตกลง" name="edit" class="fontsara">
</td>
 </tr>
      
</table>


</FORM>


