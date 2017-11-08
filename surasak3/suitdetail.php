<?
include("connect.inc");
if(isset($_GET['code'])&&isset($_GET['del'])){
	$sql = "delete from labsuit where suitcode = '".$_GET['code']."' ";
	$row = mysql_query($sql);
	
	$sql = "delete from labcare where code = '".$_GET['code']."' ";
	$row = mysql_query($sql);
	if($row){
		?>
		<script>
			window.opener.location.reload();
			window.open('','_self');
			self.close();
		</script>
		<?
	}
}
elseif(isset($_GET['code'])){
	$sql = "select * from labsuit where suitcode = '".$_GET['code']."' ";
	$row = mysql_query($sql);
?>
<style type="text/css">
<!--
.font3 {
	font-family: AngsanaUPC;
	font-size: 20px;
}
-->
</style>

<table width='70%' border='1'>
<tr>
    <td width="7%" align="center" class="font3"><strong>#</strong></td>
    <td width="18%" align="center" class="font3"><strong>รหัสสูตรLAB</strong></td>
    <td width="63%" align="center" class="font3"><strong>รายการ</strong></td>
    <td width="12%" align="center" class="font3"><strong>ราคา</strong></td>
  </tr>
<?
	while($rep = mysql_fetch_array($row)){
		$i++;
?>
  <tr>
  	<td align="center" class="font3">
  	  <span class="font3">
  	  <?=$i?>
    </span></td>
    <td class="font3">
      <span class="font3">
      <?=$rep['code']?>
    </span></td>
    <td class="font3">
      <span class="font3">
      <?=$rep['detail']?>
    </span></td>
    <td align="right" class="font3">
      <span class="font3">
      <?=$rep['price']?>
    </span></td>
  </tr>
<?
	}
?>
</table>

<span class="font3">
<?
}
?>
</span> 