
<div>
    <a target=_top  href='../nindex.htm'>&lt;&lt; ไปเมนู</a> | <a href="rphos2m_2.php">รายงานยอดรวมตามช่วงเวลา</a>
</div>


<form method="POST" action="rphos2m.php">
<p><b>สมุดรายวันซื้อยาและเวชภัณฑ์(ร.พ.2)  ตามเดือน</b></p>
    <div>
        <p>
            <font face="Angsana New">&nbsp;&nbsp; &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;<? $m=date('m'); ?>
            <select size="1" name="rptmo">
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
            </select>&nbsp;&nbsp; &#3614;.&#3624;
            <?php 
            $Y=date("Y")+543;
            $date=date("Y")+543+5;
            $dates=range(2547,$date);

            echo "<select name='thiyr'>";
            foreach($dates as $i){
                ?>
                <option value='<?=$i-543?>' <? if($Y==$i){ echo "selected"; }?>><?=$i-543;?></option>
                <?php
            }
            echo "<select>";
            ?>
        </p>
    </div>
    <div>
        <p>
            <font face="Angsana New">&nbsp;&nbsp; ถึงเดือน &nbsp;<?php $m=date('m'); ?>
            <select size="1" name="rptmo_end">
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
            </select>&nbsp;&nbsp; &#3614;.&#3624;
            <?php 
            $Y=date("Y")+543;
            $date=date("Y")+543+5;
            $dates=range(2547,$date);

            echo "<select name='thiyr_end'>";
            foreach($dates as $i){
                ?>
                <option value='<?=$i-543?>' <? if($Y==$i){ echo "selected"; }?>><?=$i-543;?></option>
                <?php
            }
            echo "<select>";
            ?>
        </p>
    </div>

  <p>
  รหัสยา : <INPUT TYPE="text" NAME="drugcode">
  </p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1">
    </p>
</form>

