<?
include("connect.inc");
$query2 = "select prefix from runno where title = 'c_chekup'";
list($prefix)=mysql_fetch_array(mysql_query($query2));
?>
������ª��͵�Ǩ�آ�Ҿ����ѷ
<form method="POST" action="chkcom_year1.php">
  <p>�� <input type="text" name="year" size="12" value="<?=$prefix?>" >
    (�� 56)
    <br />
    <br />
    ����ѷ :
    <select name='company'>
      <option value=''>-- ���͡ --</option>
        <?
        $sql12 = "select * from chkcompany where status='Y' ";
		$rows12 =mysql_query($sql12);
		while($result12 = mysql_fetch_array($rows12)){
		?>
			<option value='<?=$result12['code']?>'><?=$result12['name']?></option>
		<?
		}
		?>
		
	</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	<br />
	<input type="submit" value="     ��ŧ     " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ����</a></p>
</form>
