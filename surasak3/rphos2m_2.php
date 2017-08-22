<?php
session_start();

function dump($txt = NULL){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

?>

<div>
<a target=_top  href='../nindex.htm'>&lt;&lt; ไปเมนู</a> | <a href="hos2m.php">สมุดรายวันซื้อยาและเวชภัณฑ์</a>
</div>

<form method="POST" action="rphos2m_2.php">
<p><b>รายงานยอดรวมตามช่วงเวลา</b></p>
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
    <input type="hidden" name="action" value="show">
</form>

<?php

$action = $_POST['action'];
if( $action === 'show' ){

    $yym = $_POST['thiyr'].'-'.$_POST['rptmo'];
    $yym_end = $_POST['thiyr_end'].'-'.$_POST['rptmo_end'];

    $txt_more = '';
    if( $yym_end != $yym ){
        $txt_more = 'ถึงเดือน '.$yym_end;
    }

    print "<font face='Angsana New'><b>รายงานยอดรวมตามช่วงเวลา เดือน $yym $txt_more (เรียงตามวันที่รับของ)</b>";
	// print "<a href='rphos2m_print.php?yym=$yym'>พิมพ์สมุดรายวันซื้อ</a>";
	
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>ลำดับคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใบสั่งซื้อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่รับของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบส่งของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>เลขที่ใบส่งของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>บริษัท</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการซื้อ</th>
  <!-- <th bgcolor=6495ED><font face='Angsana New'>LotNo</th> -->
  <th bgcolor=6495ED><font face='Angsana New'>จำนวน</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา/หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>รวมเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ร.พ.5</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");

    $date_more = "date LIKE '$yym%'";
    if( $yym_end != $yym ){
        $date_more = " ( date >= '$yym-01' AND date <= '$yym_end-31') ";
    }

    $query = "SELECT stkno,docno,getdate,date,billno,comname,drugcode,tradname,lotno,packamt,packing,packpri,SUM(price) AS price,stkbak,packamt 
    FROM combill 
    WHERE $date_more 
    AND drugcode like '".$_POST["drugcode"]."%' 
    GROUP BY drugcode
    ORDER BY getdate";
    // dump($query);
    
    // exit;

    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;

    while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname,$drugcode,$tradname,$lotno,$packamt,$packing,$packpri,$price,$stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <!--<td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n-->".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packamt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rphos5dg.php? Dgcode=$drugcode\">ร.พ.5</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<br>รวมมูลค่าซื้อยาและเวชภัณฑ์ทั้งสิ้น  $netprice บาท";
?>

</table>

<?php

}