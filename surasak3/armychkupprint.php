<?
session_start();
if (isset($sIdname)){} else {die;} //for security
include("connect.inc");
////*runno ��Ǩ�آ�Ҿ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$nPrefix2="25".$nPrefix;
////*runno ��Ǩ�آ�Ҿ*/////////
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.frmsaraban{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.tet1 {		font-family: TH SarabunPSK;
	font-size: 18px;
}
.style3 {font-family: TH SarabunPSK; font-size: 18px; font-weight: bold; }
-->
</style>
<title>�����㺵�Ǩ�آ�Ҿ��Шӻ� 2560</title><form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<input name="act" type="hidden" value="show" />
<center>
<span class="style3">�����㺵�Ǩ�آ�Ҿ��Шӻ� <?=$nPrefix2;?></span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;��͡ HN : </span>
    <input name="hn" type="text" size="10" class="tet1" value="<?=$_GET["hn"];?>">
  &nbsp;&nbsp;
  <input name="ok" type="submit" class="frmsaraban" value="��ŧ">
  <br />
  <br />

<a href ="../nindex.htm" >&lt;&lt; �����</a>  || <a href ="armychkup_printall.php" target="_blank" >�����Ẻ�����</a>  || <a href ="armychkup_printfont.php" target="_blank" >��������˹�һ�</a>
</center>
</form>
<?
if($_POST["act"]=="show"){

	$select = "select * from armychkup where hn = '".$_POST['hn']."' order by row_id desc";
	//echo $select;
	$row = mysql_query($select);
	$num = mysql_num_rows($row);
	if($num>0){
?>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="128" height="25" align="center" bgcolor="#339999" class="style3"><span class="tet">�ѹ����Ǩ</span></td>
    <td width="117" align="center" bgcolor="#339999" class="style3">HN</td>
    <td width="481" align="center" bgcolor="#339999" class="style3"><span class="tet">����-ʡ��</span></td>
    <td width="251" align="center" bgcolor="#339999" class="style3">�ѧ�Ѵ</td>
    <td width="53" align="center" bgcolor="#339999" class="style3"><span class="tet">��</span></td>
    <td width="75" align="center" bgcolor="#339999" class="style3">�ŵ�Ǩ</td>
  </tr>
    <?
    
		$i=0;
		while($result = mysql_fetch_array($row)){
			if($i==1){
					$i=0;
					$bgcolor = "#FFFFA6";
				}else{
					$bgcolor = "#FFFFFF";
					$i=1;
				}
		?>
		<tr bgcolor=<?=$bgcolor?>><td><span class="tet">
		  <?=$result["registerdate"]?>
		</span></td>
		  <td><span class="tet">
		    <?=$result["hn"]?>
		  </span></td>
		  <td><span class="tet">
		  <?=$result["yot"]." ".$result["ptname"]?>
		  </span></td>
		  <td><span class="tet">
		    <?=$result["camp"]?>
		  </span></td>
		  <td align="center"><span class="tet">
		    <?=$result["yearchkup"]?>
		  </span></td>
		  <td align="center"><span class="tet"><a href="armychkup_print.php?id=<?=$result["row_id"]?>&chkyear=<?=$result["yearchkup"]?>" target="_blank">�����</a></span></td>
	    </tr>
		<?
		}
	}else{
		?>
        <meta content="1" http-equiv="refresh"  />
		<?
	}
	?>
</table>
<?
}
?>

