<style>
.font1{
	font-family:AngsanaUPC;
	font-size:24px;
}
</style>
<?php
include("connect.inc");
if(isset($_POST['save2'])){
	$sel = "select * from chkup_company where hn='".$_POST['hn']."' ";

	$rowsel = mysql_query($sel);
	$numrow= mysql_num_rows($rowsel);
	if($numrow==0){
		$query = "SELECT runno, prefix  FROM runno WHERE title = 'c_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nRunno=$row->runno;
		$nPrefix=$row->prefix;
		$nRunno++;
		$n_runno= $nPrefix."/".$nRunno;
		$query ="UPDATE runno SET runno = $nRunno WHERE title='c_chekup'";
		$result = mysql_query($query) or die("Query failed");
		$datenow=(date("Y")+543).date("-m-d H:i:s");
		$sql = "insert into chkup_company (thidate,hn,company,program,idno) values('".$datenow."','".$_POST['hn']."','".$_POST['company']."','".$_POST['program']."','".$n_runno."')";
		$result =mysql_query($sql);
		
	}else{
		$rep = mysql_fetch_array($rowsel);
		$sql = "update chkup_company set company ='".$_POST['company']."',program='".$_POST['program']."' where row_id='".$rep['row_id']."' ";
		$result =mysql_query($sql);
	}
	if($result){
		echo "บันทึกเรียบร้อยแล้ว";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=chkup_company.php\">";
	}

}elseif(isset($_POST['hn'])){
		echo "<a href ='chkup_company.php' >&lt;&lt; กลับ</a>";
		echo "<form name='form2' method='post' action='' class='font1'>";
		$sql = "select * from opcard where hn = '".$_POST['hn']."' ";
		$row = mysql_query($sql);
		$rep = mysql_fetch_array($row);
		echo "ชื่อ : ".$rep['yot']." ".$rep['name']." ".$rep['surname']."<br>";
		echo "HN : ".$rep['hn']."<br>";
		echo "ID : ".$rep['idcard']."<br>";
		
		$sel2 = "select * from chkup_company where hn='".$_POST['hn']."'  ";
		//and thidate like '".(date("Y")+543).date("-m-d")."%'
		$rowsel2 = mysql_query($sel2);
		$rep2 = mysql_fetch_array($rowsel2);
?>
		บริษัท : <select name='company'>
        <option value=''>-- เลือก --</option>
        <?
        $sql12 = "select * from chkcompany where status='Y' ";
		$rows12 =mysql_query($sql12);
		while($result12 = mysql_fetch_array($rows12)){
		?>
			<option value='<?=$result12['code']?> <?=$result12['name']?>' <? if($rep2['company']==$result12['code']." ".$result12['name']) echo "selected";?>><?=$result12['name']?></option>
		<?
		}
		?>
		
		</select><br>
<?		
		$sql3 = "select * from chkprogram where status='Y' ";
		$row3 = mysql_query($sql3);
		echo "โปรแกรม : <select name='program'>";
		echo "<option value=''>-- เลือก --</option>";
		while($rep3 = mysql_fetch_array($row3)){
			$exp = explode(" ",$rep3['name']);
			?>
			<option value='<?=$rep3['name']?>' <? if($rep2['program']==$rep3['name']) echo "selected";?>><?=$rep3['name']?></option>
            <?
		}
		echo "</select><br>";
		echo "<input type='hidden' value='$rep[hn]' name='hn'>";
		$sel = "select * from chkup_company where hn='".$_POST['hn']."'  ";
		//and thidate like '".(date("Y")+543).date("-m-d")."%'
		$rowsel = mysql_query($sel);
		$numrow= mysql_num_rows($rowsel);
		if($numrow>0){
			?>
			<input type='submit' name='save2' id='save2' value='ตกลง' onclick="return confirm('มีข้อมูลแล้วต้องการอัพเดท?');">
            <?
		}else{
			?>
            <input type='submit' name='save2' id='save2' value='ตกลง'>
			<?
		}
		
		echo "</form>";
}else{
?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
<strong>ลงทะเบียนตรวจสุขภาพบริษัท</strong><br>
<br>
<strong>HN :</strong>
<input type="text" name="hn" id="hn"><br><br>
<input type="submit" name="save" value="ตกลง">
</form>
<?
}
?>
