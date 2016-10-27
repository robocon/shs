<?php
  print "โปรดเลือก เดือน ปี ที่จะดูผู้ป่วยใน ที่จำหน่าย<br>";
?>
<form method="POST" action="dciplst.php">
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; ผู้ป่วยในของเดือน&nbsp;<select size="1" name="mo">
<? $m=date('m'); ?>
    <option selected>--เลือก--</option>
 	   <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
    	<option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
  </select>&nbsp;&nbsp; พ.ศ.<input type="text" name="thiyr" size="4" value="<?=date("Y")+543;?>"></font></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
       &nbsp;&nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><< ยกเลิก</a></td>
</form>



