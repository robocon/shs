<form method="POST" action="ptappoi.php">
  <p><font face="Angsana New">&#3609;&#3633;&#3604;&#3617;&#3634;&#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="appdate" size="2">&nbsp;&nbsp;&nbsp;&nbsp;<select size="1" name="appmo">
    <option selected>--��͹--</option>
    <option value="���Ҥ�">���Ҥ�</option>
    <option value="����Ҿѹ��">����Ҿѹ��</option>
    <option value="�չҤ�">�չҤ�</option>
    <option value="����¹">����¹</option>
    <option value="����Ҥ�">����Ҥ�</option>
    <option value="�Զع�¹">�Զع�¹</option>
    <option value="�á�Ҥ�">�á�Ҥ�</option>
    <option value="�ԧ�Ҥ�">�ԧ�Ҥ�</option>
    <option value="�ѹ��¹">�ѹ��¹</option>
    <option value="���Ҥ�">���Ҥ�</option>
    <option value="��Ȩԡ�¹">��Ȩԡ�¹</option>
    <option value="�ѹ�Ҥ�">�ѹ�Ҥ�</option>
  </select>&nbsp;&nbsp; &#3614;.&#3624;.<select size="1" name="thiyr">
    <option selected>2547</option>
    <option>2548</option>
    <option>2549</option>
    <option>2550</option>
    <option>2551</option>
    <option>2552</option>
    <option>2553</option>
	<option>2554</option>
	<option>2555</option>
	<option>2556</option>
	<option>2557</option>
  </select></p>
  <p><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660;&#3612;&#3641;&#3657;&#3609;&#3633;&#3604;&nbsp;&nbsp;&nbsp;&nbsp;
  
   <?php
   include("connect.inc");
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
  ?>
  
  <? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>



  
	  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y' order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php }?>
  
  
  </font> </p>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;     " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
  </form>
