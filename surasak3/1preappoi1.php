<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
<?php
//    $cHn="";
      $cPtname=$cYot.' '.$cName.' '.$cSurname;
    $cAge=$Age;
   $cptright=$ptright;
 $cnote=$note;
  
    session_register("cAge");
    session_register("cHn");  
    session_register("cPtname");
 session_register("cptright");
 session_register("cnote");
  session_register("idcard");

    include("connect.inc");   

	$sql = "Select idcard From opcard where hn = '".trim($_GET["cHn"])."' ";
	$result = Mysql_Query($sql);
	$arr = mysql_fetch_array($result);
	$idcard = $arr["idcard"];
	$_SESSION["idcard"] = $arr["idcard"];

Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;
       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
                    }
      if ($ageM==0){
           $pAge="$ageY ��";
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }

//$dbirth="$y-$m-$d"; ���ѹ�Դ� opcard= "$y-$m-$d" ���=$birth in function
$cAge=calcage($cAge);
// print "<p><b><font face='Angsana New'>�ç��Һ�Ť�������ѡ��������</font></b></p>";
   print "<p><font face='Angsana New' size = '5'>���� $cPtname  HN: $cHn ���� $cAge &nbsp;<B>�Է��:$cptright:$idguard</font></B></p>";
?>
<form method="POST" action="1preappoi2.php">
  <p><font face="Angsana New">&#3609;&#3633;&#3604;&#3617;&#3634;&#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&nbsp;&nbsp;&nbsp;&nbsp;
  <select size="1" name="appdate"  id="aLink">
    <option selected>--�ѹ���--</option>
    <option value="01">01</option>
	  <option value="02">02</option>
	    <option value="03">03</option>
		  <option value="04">04</option>
		    <option value="05">05</option>
		  <option value="06">06</option>
		    <option value="07">07</option>
	  <option value="08">08</option>
	    <option value="09">09</option>
		  <option value="10">10</option>
		    <option value="11">11</option>
			  <option value="12">12</option>
	  <option value="13">13</option>
	    <option value="14">14</option>
		  <option value="15">15</option>
		    <option value="16">16</option>
			  <option value="17">17</option>
	  <option value="18">18</option>
	    <option value="19">19</option>
		  <option value="20">20</option>
		    <option value="21">21</option>
			  <option value="22">22</option>
	  <option value="23">23</option>
	    <option value="24">24</option>
		  <option value="25">25</option>
		    <option value="26">26</option>
			  <option value="27">27</option>
			    <option value="28">28</option>
	  <option value="29">29</option>
	    <option value="30">30</option>
		  <option value="31">31</option>
		   
    

  </select>  <select size="1" name="appmo">
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
  </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2555,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 <a href="calendar1.php" target="_blank">Calendar</a>
</font></p>
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
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name "; 
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
 
     
  &nbsp;&nbsp;<input type="submit" value="    ����     " name="B1">
  &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a>&nbsp&nbsp;<<&nbsp<a target=_self  href='hnappoi1.php'>�͡㺹Ѵ����</a></p>
  </form>

