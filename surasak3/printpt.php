<?
session_start();
if(isset($_GET['cPtname'])){
$cPtname=$_GET['cPtname'];
$cHn=$_GET['cHn'];
$cIdcard=$_GET['cIdcard'];
$cPtright1=$_GET['cPtright1'];
}
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size:26px;
}
-->
</style>

<span class="font1">㺵�Ǩ�ͺ�Է��<br />
���� :<?=$cPtname;?> <br />
<?=$cHn?>&nbsp;&nbsp;<strong>
<?=$cIdcard?>
</strong><br />
�Է�� : <?=$cPtright1?><br />
........................... ����Ǩ�ͺ
</span>
<script>
window.print() ;
</script>