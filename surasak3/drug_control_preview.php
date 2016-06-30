<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
.font2 {
	font-family: AngsanaUPC;
	font-size:20px;
}
-->
</style>
<span class="font2">
<strong>รายการยาที่เบิก <br>
*ต้องการแก้ไขให้ปิดหน้าต่างนี้*</strong>
</span>
<form action="drugimport.php" method="post" name="form1" >
  <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" class="font2">
    <tr>
      <td width="4%" rowspan="2" align="center">ลำดับ</td>
      <td width="13%" rowspan="2" align="center">Drugcode</td>
      <td width="32%" rowspan="2" align="center">Tradname</td>
      <td width="6%" rowspan="2" align="center">Min</td>
      <td width="5%" rowspan="2" align="center">Max</td>
      <td width="6%" rowspan="2" align="center">ห้องจ่าย</td>
      <td width="5%" rowspan="2" align="center">คลัง</td>
      <td width="6%" rowspan="2" align="center">จ่ายยา</td>
      <td colspan="2" align="center">จำนวน</td>
      <td width="7%" rowspan="2" align="center">หมายเหตุ</td>
    </tr>
    <tr>
      <td width="8%" align="center">ขอเบิก</td>
      <td width="8%" align="center">จ่ายจริง</td>
    </tr>
    <?
      $cont = $_POST['sump'];
	  for($p=1;$p<=$cont;$p++){
		  if($_POST['import'.$p]!=""||$_POST['import'.$p]!=0){
			  $sel2 = "select * from druglst where drugcode= '".$_POST['drx'.$p]."'";
			  $row2 = mysql_query($sel2);
			  $result2 = mysql_fetch_array($row2);
			  $r++;
	  ?>
    <tr>
      <td align="center"><?=$r?></td>
      <td><input type="hidden" name="drx<?=$r?>" value="<?=$_POST['drx'.$p]?>" /><?=$_POST['drx'.$p]?></td>
      <td><?=$result2['tradname']?></td>
      <td align="center"><?=$result2['min']?></td>
      <td align="center"><?=$result2['max']?></td>
      <td align="center"><?=$result2['stock']?></td>
      <td align="center"><?=$result2['mainstk']?></td>
      <td align="center"><input name="rxdrug<?=$r?>" type="hidden" id='rxdrug<?=$r?>' value="<?=$_POST['rxdrug'.$p]?>"; /><?=$_POST['rxdrug'.$p]?></td>
      <td align="center"><input name="import<?=$r?>" type="hidden" id='import<?=$r?>' value="<?=$_POST['import'.$p]?>" /><?=$_POST['import'.$p]?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?
		  }
	  }
	?>
    <tr>
      <td colspan="11" align="center"><input type="hidden" name="sump" value="<?=$r?>" />        <input type="submit" name="save" id="save" value="ตกลง" /></td>
    </tr>
  </table>
</form>
