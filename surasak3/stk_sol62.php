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
        �����ʵԡ�����Ǩ�آ��Ҿ����
    </div>
    <div>
        HN: <input type="text" name="hn" id="">
    </div>

    <div>
        <button type="submit">�����</button>
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
            <td>�š�õ�Ǩ�آ�Ҿ��Шӻ� <?=$nPrefix;?></td>
        </tr>
        <tr>
            <td>���� : <?php echo $arrs["ptname"];?> HN :<?php echo $arrs["hn"];?></td>
        </tr>
        <tr>
            <td>�ѹ����Ǩ : <?php echo $arrs['date_now'];?></td>
        </tr>
        <tr>
            <td>�š�õ�Ǩ : 
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
        if($arrs['normal41']=="�Դ����"|$arrs['normal42']=="�Դ����"|$arrs['normal43']=="�Դ����") $text41="�Ѻ";
        if($arrs['normal44']=="�Դ����"|$arrs['normal45']=="�Դ����") $text44="�";
        if($arrs['normal46']=="�Դ����" || $arrs['normal48']=="�Դ����" || $arrs['normal88']=="�Դ����" || $arrs['normal89']=="�Դ����") $text46="��ѹ";
        if($arrs['normal47']=="�Դ����") $text47="����ҹ";
        if($arrs['normal49']=="�Դ����") $text49="URIC";
        if($arrs['normal81']=="�Դ����") $text81="CBC";
        if($arrs['normal']=="�Դ����") $text="UA";
        ?>
        <tr>
            <td>����Թԩ�¨ҡᾷ��: <?php echo $arrs["dx"];?></td>
        </tr>
        <? if($arrs["summary"]=="�Դ����"){ ?>
            <tr>
                <td>Diag: <?=$arrs["diag"]?></td>
            </tr>
            <tr>
                <td>�����Դ����: <?=$text41?> <?=$text44?> <?=$text46?> <?=$text47?> <?=$text49?> <?=$text81?> <?=$text?></td>
            </tr>
        <? } ?>
        <tr>
            <td>ᾷ�� : <?php echo $arrs["doctor"];?></td>
        </tr>
    </table>
    <script language="javascript">
        window.print();
    </script>
    <?php

}