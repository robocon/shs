<form method="POST" action="preustk.php">
    <p><font face="Angsana New">&nbsp;</font>&nbsp;&nbsp;&nbsp; <b>&#3592;&#3656;&#3634;&#3618;&#3618;&#3634;&#3648;&#3623;&#3594;&#3616;&#3633;&#3603;&#3601;&#3660;&#3651;&#3627;&#3657;&#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;</b>&nbsp;&nbsp;</p>
    <p><font face="Angsana New">
    หน่วยเบิก
    <?php
    include("connect.inc");
    $q = mysql_query("SELECT `id`,`name` FROM `departments` WHERE `status` = 'y' ");
    ?>
    <select size="1" name="depcode">
        <?php while($item = mysql_fetch_assoc($q)){ ?>
        <option value="<?php echo $item['name'];?>"><?php echo $item['name'];?></option>
        <?php } ?>
    </select>
    </font></p>
    <p><font face="Angsana New">&#3648;&#3621;&#3586;&#3607;&#3637;&#3656;&#3651;&#3610;&#3648;&#3610;&#3636;&#3585;&nbsp;&nbsp;
    <input type="text" name="billno" size="12"></font></p>
    <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1"></font>
</form>

<?php


$sql = "Select * From bring Order by row_id DESC limit 10";
$result = Mysql_Query($sql) or die(Mysql_Error());

echo "เลขที่ใบเบิก : <Select id='bring_id' name='bring_id' >";

while($arr = Mysql_fetch_assoc($result)){
echo "<Option value='".$arr["row_id"]."'>".$arr["bring_no"]."</Option>";
}

echo "</Select>&nbsp;";

include("unconnect.inc");
?><INPUT TYPE="button" value="เรียกข้อมูล" Onclick="window.location.href='stkufrm2.php?id='+document.getElementById('bring_id').value;">

<BR>
<a target=_top  href="../nindex.htm">&lt;&lt; ไปเมนู</a></font></p>
