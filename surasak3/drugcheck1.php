<?
session_start();
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname from druglst  where  drugcode like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:500px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td ><strong>&nbsp;</strong></td><td ><font style=\"color: #FFFFFF;\"><strong>������</strong></font></td><td ><font style=\"color: #FFFFFF;\"><strong>������(��ä��)</strong></font></td><td ><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",$se["drugcode"],"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}

?>
<script>
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'drugcheck1.php?action=drugcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<form method="post" action="<?php echo $PHP_SELF ?>">
<Div id="list" style="left:270PX;top:50PX;position:absolute;"></Div>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ������ҵ�� ������ (��ǧ����)</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a target=_BLANK href="dgcodechk.php">������</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="drugcode" size="20" id='drugcode' onKeyPress="searchSuggest(this.value,2,'drugcode')";></p>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 �ѹ��� <INPUT TYPE="text" NAME="rptday" maxlength="2" size="2" value="<?=$rptday?>">
 &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;<? $m=date('m'); ?>
  <select size="1" name="rptmo">
    <option value="01" <? if($rptmo=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($rptmo=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($rptmo=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($rptmo=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($rptmo=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($rptmo=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($rptmo=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($rptmo=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($rptmo=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($rptmo=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($rptmo=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
  </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
      &nbsp;&nbsp;-&nbsp;&nbsp; �ѹ���
      <input type="text" name="rptday2" maxlength="2" size="2" value="<?=$rptday2?>"/>
&#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;
<? $m=date('m'); ?>
<select size="1" name="rptmo2">
  <option value="01" <? if($rptmo2=='01'){ echo "selected"; }?>>���Ҥ�</option>
  <option value="02" <? if($rptmo2=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
  <option value="03" <? if($rptmo2=='03'){ echo "selected"; }?>>�չҤ�</option>
  <option value="04" <? if($rptmo2=='04'){ echo "selected"; }?>>����¹</option>
  <option value="05" <? if($rptmo2=='05'){ echo "selected"; }?>>����Ҥ�</option>
  <option value="06" <? if($rptmo2=='06'){ echo "selected"; }?>>�Զع�¹</option>
  <option value="07" <? if($rptmo2=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
  <option value="08" <? if($rptmo2=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
  <option value="09" <? if($rptmo2=='09'){ echo "selected"; }?>>�ѹ��¹</option>
  <option value="10" <? if($rptmo2=='10'){ echo "selected"; }?>>���Ҥ�</option>
  <option value="11" <? if($rptmo2=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
  <option value="12" <? if($rptmo2=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
</select>
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr2'>";
				foreach($dates as $i){

				?>
<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
<?=$i;?>
</option>
<?
				}
				echo "<select>";
				?>
 </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>
<a href="drugcheck1.php?new">��ҧ������</a>
<table>
 <tr>

  <th bgcolor=CD853F>������</th>

  <th bgcolor=CD853F>�������ѭ</th>
 
<th bgcolor=CD853F>���͡�ä��</th>
 <th bgcolor=CD853F>�ӹǹ�������</th>
<th bgcolor=CD853F>����������ͧ����</th>
 <th bgcolor=CD853F>�������㹤�ѧ��</th>
 <th bgcolor=CD853F>������§ҹ</th>
  </tr>


<?php
if(isset($_GET['new'])){
	$_SESSION['listdrug2']=array();
	$_SESSION['listtime']=array();
}

if(!isset($_SESSION['listdrug2'])){
	$_SESSION['listdrug2']=array();
	$_SESSION['listtime']=array();
}
 $yym=$thiyr.'-'.$rptmo.'-'.$rptday;
 $yym2=$thiyr2.'-'.$rptmo2.'-'.$rptday2;

if(!empty($drugcode)){
  include("connect.inc");
  global $drugcode;
  $query = "SELECT drugcode FROM drugrx WHERE drugcode = '$drugcode' and date between '$yym 00:00:00' and '$yym2 23:59:59' group by drugcode";
    $result = mysql_query($query) or die("Query failed");
    $j = $i= Mysql_num_rows($result);
    while (list ($drugcode) = mysql_fetch_row ($result)) {
		array_push($_SESSION['listdrug2'],$drugcode);
		$dnow= date("d/m/Y H:i:s");
		array_push($_SESSION['listtime'],$dnow);
	}
	
	for($k=0;$k<count($_SESSION['listdrug2']);$k++){
	 $query = "SELECT drugcode,tradname,sum(amount) FROM drugrx WHERE drugcode = '".$_SESSION['listdrug2'][$k]."' and date between '$yym 00:00:00' and '$yym2 23:59:59' group by drugcode";
    $result = mysql_query($query) or die("Query failed");
    $j = $i= Mysql_num_rows($result);
    list ($drugcode,$tradname,$amount) = mysql_fetch_row ($result);
	
	$query2 = "select genname,stock,mainstk from druglst where drugcode = '".$_SESSION['listdrug2'][$k]."' ";
	$result2 = mysql_query($query2) or die("Query failed");
	list($genname,$stock,$mainstk) = mysql_fetch_row ($result2);
	
		 print (" <tr>\n".
		"  <td BGCOLOR=F5DEB3>$drugcode</td>\n".
		"  <td BGCOLOR=F5DEB3>$genname</td>\n".
		"  <td BGCOLOR=F5DEB3>$tradname</td>\n".
		"  <td BGCOLOR=F5DEB3>$amount</td>\n".
		"  <td BGCOLOR=F5DEB3>$stock</td>\n".
		"  <td BGCOLOR=F5DEB3>$mainstk</td>\n".
		"  <td BGCOLOR=F5DEB3>".$_SESSION['listtime'][$k]."</td>\n".
		" </tr>\n");
		   $i++;
		  
	}


//print "������$tradname �����������ҡѺ  $Total ˹��� |";
//print "&nbsp;&nbsp;&nbsp;&nbsp;������ ".count($list_peoper)." �� |";
//print "&nbsp;&nbsp;&nbsp;&nbsp; $j ��¡�� |";
//print "&nbsp;&nbsp;&nbsp;&nbsp;�Ҥ� $sal_price �ҷ";
//echo "<!-- ('".implode("','",$list_hn)."') -->";
include("unconnect.inc");
       }
?>
</table>
