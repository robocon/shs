<?
include("connect.inc"); 

?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size: 16px;
}
-->
</style>

<form action="" method="post">
��¡�÷������Ť���ҡ����ش 20 �ѹ�Ѻ�á (�ҷ)
<!--<select name="year">
<option value="2556">2556</option>
<option value="2555">2555</option>
<option value="2554">2554</option>
<option value="2553">2553</option>
<option value="2552">2552</option>
<option value="2551">2551</option>
</select>--><br>
<input type="submit" value="��ŧ" name="search">
</form>

 <?
if(isset($_POST['search'])){

?>
<table width="80%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%" align="center"><span class="font1">�ӴѺ</span></td>
    <td width="10%" align="center"><span class="font1">������</span></td>
    <td width="25%" align="center"><span class="font1">���͡�ä��</span></td>
    <td width="26%" align="center"><span class="font1">�ӹǹ�������</span></td>
    <td width="10%" align="center"><span class="font1">��Ť�ҵ��˹���</span></td>
     <td width="10%" align="center"><span class="font1">��Ť�����</span></td>
  </tr>
  
 <?
  $sql = "SELECT drugcode,tradname,totalstk,salepri,(salepri*totalstk) as cal FROM druglst WHERE (part='DDY' or part = 'DDL') and drugcode like '1%'  order by cal desc limit 20";
  $rows = mysql_query($sql);
  while(list($dgcode,$tradname,$totalstk,$salepri,$cal) = mysql_fetch_array($rows)){
	  $k++;
  ?>
  <tr>
    <td align="center"><span class="font1"><?=$k?></span></td>
    <td align="center"><span class="font1"><?=$dgcode?></span></td>
    <td align="left"><span class="font1"><?=$tradname?></span></td>
    <td align="right"><span class="font1"><?=$totalstk?></span></td>
    <td align="right"><span class="font1"><?=$salepri?></span></td>
    <td align="right"><span class="font1"><?=$cal?></span></td>
  </tr>

<?
  }
?>
</table>
<?

}
?>

