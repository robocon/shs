<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}
-->
</style><title>�͡�����</title></head>

<body onLoad="window.print(); window.close();">
<?
 include("connect.inc");
$sql="select * from opcardchk where hn='$_POST[hn]'";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
$ptname=$rows["yot"]." ".$rows["name"]."&nbsp;&nbsp;&nbsp;".$rows["surname"];

$showdate="27-03-2558";
$showtime=date("H:i");


$change=$_POST["cash"]-800;
?>
<div style="margin-top:85px;"><strong>���� : <?=$ptname;?></strong>&nbsp;&nbsp;&nbsp;HN : <?=$hn;?>&nbsp;&nbsp;&nbsp;�ѹ��� <?=$showdate;?>&nbsp;&nbsp;���� <?=$showtime;?></div>


<div style="margin-top:70px;">��Һ�ԡ�õ�Ǩ�آ�Ҿ���Ǩ <span style="margin-left:295px;">800.00</span></div>

<div style="margin-top:400px; margin-left:370px;">0.00 <span style="margin-left:55px;">800.00</span></div>

<div style="margin-left: 40px;"><strong>** Ỵ���ºҷ��ǹ **</strong><span style="margin-left:245px;">800.00</span></div>
<div style="font-size:18px;">
<div style="margin-top:10px; margin-left: 250px;">ŧ����.........................................����Ѻ�Թ</div>
<? if($_POST["cash"]=="1000"){ ?>
<div style="margin-left: 5px;">���Ѻ �Թʴ (<?=$_POST["cash"];?>,<?=$change;?>)<span style="margin-left:150px;">(�ҧ �ǧ���&nbsp;&nbsp;&nbsp;�㨻ԧ)</span></div>
<? }else{?>
<div style="margin-left: 5px;">���Ѻ �Թʴ (<?=$_POST["cash"];?>,<?=$change;?>)<span style="margin-left:170px;">(�ҧ �ǧ���&nbsp;&nbsp;&nbsp;�㨻ԧ)</span></div>
<? }?>
<div style="margin-left: 295px;">���˹�ҷ�����Թ</div>
</div>
</body>
