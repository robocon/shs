<?php
?>
<form method="POST" action="den1day.php" >
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
สรุปจำนวนหัตถการของกองทันตกรรม ต่อวัน</b></font></font></p>
  <p><font face="Angsana New"><font size="3">
 (วันที่ 01,02,....30,31  ถ้าไม่มีวันที่ จะเป็นข้อมูลต่อเดือน)</font></font></p>
  <font face="Angsana New">วันที่&nbsp;&nbsp;<input type="text" name="appdate" size="2"><select size="1" name="appmo">
    <option selected>--เดือน--</option>
    <option value="01">มกราคม</option>
    <option value="02">กุมภาพันธ์</option>
    <option value="03">มีนาคม</option>
    <option value="04">เมษายน</option>
    <option value="05">พฤษภาคม</option>
    <option value="06">มิถุนายน</option>
    <option value="07">กรกฏาคม</option>
    <option value="08">สิงหาคม</option>
    <option value="09">กันยายน</option>
    <option value="10">ตุลาคม</option>
    <option value="11">พฤศจิกายน</option>
    <option value="12">ธันวาคม</option>
  </select><!--<select size="1" name="thiyr">
    <option>2548</option>
    <option>2549</option>
    <option>2550</option>
    <option selected>2551</option>
    <option>2552</option>
    <option>2553</option>
    <option>2554</option>
    <option>2555</option>

  </select>-->
  <select name="thiyr">
    <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
    <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
    <?php }?>
  </select>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="         &#3605;&#3585;&#3621;&#3591;       " name="B1">

<?php
    print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
?>