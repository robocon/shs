<style>
.font{
	font-family: AngsanaUPC; 
	font-size: 20px;
}
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}
</style>
<?
include("connect.inc");
$query = "SELECT bed,ptname,diagnos,diag1,food,bedcode,age,hn,bedpri
                     FROM bed WHERE bedcode LIKE '".$_GET['id']."%' and an!='' ORDER BY bed ASC ";
  
$result = mysql_query($query) or die("Query failed");  
?>
<table width="100%" align="center" border="0">
<tr>
	<?
    while (list ($bed,$ptname,$diagnos,$diag1,$food,$bedcode,$age,$hn) = mysql_fetch_row ($result)) {
		$k++;
		if($diag1 == "�ä��Шӵ��"){
			$diag1_value = "";
		}else{
			$diag1_value = $diag1;
		}
		
		$sql = "SELECT thidate,weight,height FROM opd WHERE  hn ='$hn' order by thidate DESC limit 1 ";

	   list($thidate,$weight,$height) = mysql_fetch_row(Mysql_Query($sql));
	$bmi='';
	 if($height != "" && $height > 0 && $weight != "" && $weight > 0){$ht = $height/100;
		$bmi =	number_format(($weight/($ht*$ht)),2); }
		
	?>
	<td>
    <table width="323" class="font" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
    <tr>
      <td>
    <table width="332">
    <tr>
    <td colspan="3" align="center">�ѵ�����ü����� �ç��Һ�Ť�������ѡ��������</td>
    </tr>
    <tr>
    <td colspan="3" align="center">
    <?
    if($_GET['id']=="41"){
    	print "<strong>�ͼ����ª��</strong>";
	}elseif($_GET['id']=="42"){
    	print "<strong>�ͼ�����˭ԧ</strong>";
	}elseif($_GET['id']=="43"){
    	print "<strong>�ͼ������ٵԹ��</strong>";
	}elseif($_GET['id']=="44"){
    	print "<strong>�ͼ�����˹ѡ(ICU)</strong>";
	}elseif($_GET['id']=="45"){
    	print "<strong>�ͼ����¾����</strong>";
	}
	?>(<?=date("d/m/").(date("Y")+543).date(" H:i:s")?> )</td>
    </tr>
    <tr>
    <td width="95">��ͧ <? if($bedpri=="300.00"){ echo "���ѭ"; }else{ echo "�����"; }?></td><td width="107"><strong>��§
      <?=$bed?>
    </strong></td><td width="114"><?=$_GET['typefood'];?></td>
    </tr>
    <tr>
    <td colspan="2">����: <strong><?=$ptname?></strong></td><td>����: <?=$age?></td>
    </tr>
    <tr>
    <td colspan="3">
        <u><strong>
            <?
				if($ptname=="��� �ح���� �ǧʹ�"){
					echo "����û��� ����ҹ ZNa<2g/d,pro90g/d,choles<br />";
					echo "<200mg/d,satfat<10,totaalfat<30totalcal800kcal/d";
				}else{
					$newfood= wordwrap($food,50,"<br />\n");
					echo $newfood;
				}
            ?>
        </strong></u>
    </td>
    </tr>
    </table></td></tr>
    </table>
    </td>
    <?
		if($k%2==0){
			echo "</tr>";
			//$k=0;
		}
		
		if($k==10||$k==20||$k==30){
			?>
  </tr></table>
			<div style='page-break-after:always'></div>
            <table width="100%" align="center" border="0">
			<tr>
			<?
		}
	}
	?>
</table>
