<?php 
include 'bootstrap.php';

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );
?>
<style>
@media print{

    #adminForm{
        display: none;
    }

}
</style>
<form action="stk_sol62.php" method="post" id="adminForm">

    <div>
        พิมพ์สติกเกอร์ตรวจสุขาภาพทหาร
    </div>
    <div>
        HN: <input type="text" name="hn" id="">
    </div>

    <div>
        <button type="submit">พิมพ์</button>
        <input type="hidden" name="action" value="print">
    </div>

</form>
<?php

$action = input_post('action');
if($action == 'print'){
    $hn = $_POST['hn'];
    $detail = "select *, substring(thidate,1,10) as date_now from condxofyear_so where hn = '".$hn."' order by row_id desc limit 1 ";
    $result = Mysql_Query($detail, $db2);
    $arrs = Mysql_fetch_assoc($result);

    $nPrefix = substr($arrs['yearcheck'], -2);
    ?>

    <table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
        <tr>
            <td>ผลการตรวจสุขภาพประจำปี <?=$nPrefix;?></td>
        </tr>
        <tr>
            <td>ชื่อ : <?php echo $arrs["ptname"];?> HN :<?php echo $arrs["hn"];?></td>
        </tr>
        <tr>
            <td>วันที่ตรวจ : <?php echo $arrs['date_now'];?></td>
        </tr>
        <tr>
            <td>ผลการตรวจ : 
            <?php 
            if($arrs["sum1"]==""){
                echo "";
            }else{ 
                echo $arrs["sum1"].",";
            }

            if($arrs["sum2"]==""){
                echo "";
            }else{ 
                echo $arrs["sum2"].",";
            }
            ?>
            </td>
        </tr>
        <?
        if($arrs['normal41']=="ผิดปกติ"|$arrs['normal42']=="ผิดปกติ"|$arrs['normal43']=="ผิดปกติ") $text41="ตับ";
        if($arrs['normal44']=="ผิดปกติ"|$arrs['normal45']=="ผิดปกติ") $text44="ไต";
        if($arrs['normal46']=="ผิดปกติ" || $arrs['normal48']=="ผิดปกติ" || $arrs['normal88']=="ผิดปกติ" || $arrs['normal89']=="ผิดปกติ") $text46="ไขมัน";
        if($arrs['normal47']=="ผิดปกติ") $text47="เบาหวาน";
        if($arrs['normal49']=="ผิดปกติ") $text49="URIC";
        if($arrs['normal81']=="ผิดปกติ") $text81="CBC";
        if($arrs['normal']=="ผิดปกติ") $text="UA";
        ?>
        <tr>
            <td>การวินิฉัยจากแพทย์: <?php echo $arrs["dx"];?></td>
        </tr>
        <? if($arrs["summary"]=="ผิดปกติ"){ ?>
            <tr>
                <td>Diag: <?=$arrs["diag"]?></td>
            </tr>
            <tr>
                <td>ความผิดปกติ: <?=$text41?> <?=$text44?> <?=$text46?> <?=$text47?> <?=$text49?> <?=$text81?> <?=$text?></td>
            </tr>
        <? } ?>
        <tr>
            <td>แพทย์ : <?php echo $arrs["doctor"];?></td>
        </tr>
    </table>
    <script language="javascript">
        window.print();
    </script>
    <?php

}