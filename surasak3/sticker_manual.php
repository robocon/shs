<?php 
include 'bootstrap.php';
$db = Mysql::load();

$page = input_post('page');
if ( $page ) {

    ?>
    <style>
    
    *{
        font-family: 'TH Sarabun New','TH SarabunPSK';
        font-size: 14pt;
    }
    body, .sticker_contain table tr td{
        margin: 0;
        padding: 0;
    }
    label{
        cursor: pointer;
    }
    .sticker_contain{
        width: 80mm; 
        height: 50mm; 
        
        padding: 2px;
    }
    .sticker_contain > div,
    .sticker_contain table tr td{
        line-height: 21px;
    }
    </style>
    <?php
    $hn = input_post('hn');
    $name = input_post('name');

    $inject = input_post('inject');
    if( $inject ){

        $injectInt = (int)input_post('inject_amount');
        
        for ($i=0; $i < $injectInt; $i++) { 
            ?>
            <div class="sticker_contain">
                <div>
                    ����-ʡ�� <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ������ ..................................................................................
                </div>
                <div>
                    ��ͺ��� ..............................................................................
                </div>
                <div>
                    �մ IV IM SC ������ ................................&nbsp;&nbsp;push&nbsp;&nbsp;&nbsp;drip
                </div>
                <div>
                    drip in .......................................�ء..........................�������
                </div>
                <div>
                    ���й�������� ...............................................................
                </div>
            </div>
            <div style='page-break-after: always'></div>
            <?php
        }

    }

    $tablet = input_post('tablet');
    if( $tablet ){
        $tabletInt = (int)input_post('tablet_amount');
        
        for ($i=0; $i < $tabletInt; $i++) { 
            ?>
            <div class="sticker_contain">
                <div>
                    ����-ʡ�� <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ������ ..................................................................................
                </div>
                <div>
                    ��ͺ��� ..............................................................................
                </div>
                <div>
                    �Ѻ��зҹ������.......���&nbsp;&nbsp;�ѹ��.......����&nbsp;&nbsp;�ء.......�������
                </div>
                <div>
                    ��͹�����&nbsp;&nbsp;��ѧ�����&nbsp;&nbsp;&nbsp;&nbsp;���&nbsp;&nbsp;��ҧ�ѹ&nbsp;&nbsp;���&nbsp;&nbsp;��͹�͹
                </div>
                <div>
                    ���й�������� ...............................................................
                </div>
                <table>
                    <tr>
                        <td>�&nbsp;&nbsp;�ҹ�Դ��͡ѹ�����</td>
                        <td>�&nbsp;&nbsp;�ҹ����ѧ����÷ѹ��</td>
                    </tr>
                    <tr>
                        <td>�&nbsp;&nbsp;�ҹ���Ҩ������ǧ�͹</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div style='page-break-after: always'></div>
            <?php
        }
    }

    $mixture = input_post('mixture');
    if( $mixture ){
        $mixtureInt = (int)input_post('mixture_amount');
        
        for ($i=0; $i < $mixtureInt; $i++) { 
            ?>
            <div class="sticker_contain">
                <div>
                    ����-ʡ�� <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ������ ..................................................................................
                </div>
                <div>
                    ��ͺ��� ..............................................................................
                </div>
                <div>
                    �Ѻ��зҹ������.......��͹��/��͹���/�ի�&nbsp;&nbsp;&nbsp;&nbsp;�Ժ������
                </div>
                <div>
                    �ѹ��.......����&nbsp;&nbsp;�ء.......�������
                </div>
                <div>
                    ��͹�����&nbsp;&nbsp;��ѧ�����&nbsp;&nbsp;&nbsp;&nbsp;���&nbsp;&nbsp;��ҧ�ѹ&nbsp;&nbsp;���&nbsp;&nbsp;��͹�͹
                </div>
                <div>
                    ���й�������� ...............................................................
                </div>
                <table>
                    <tr>
                        <td>�&nbsp;&nbsp;�ҹ�Դ��͡ѹ�����</td>
                        <td>�&nbsp;&nbsp;�ҹ����ѧ����÷ѹ��</td>
                    </tr>
                    <tr>
                        <td>�&nbsp;&nbsp;�ҹ���Ҩ������ǧ�͹</td>
                        <td>�&nbsp;&nbsp;���ҢǴ��͹��</td>
                    </tr>
                </table>
            </div>
            <div style='page-break-after: always'></div>
            <?php
        }
    }

    $drops = input_post('drops');
    if( $drops ){
        $dropsInt = (int)input_post('drops_amount');
        
        for ($i=0; $i < $dropsInt; $i++) { 
            ?>
            <div class="sticker_contain">
                <div>
                    ����-ʡ�� <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ������ ..................................................................................
                </div>
                <div>
                    ��ͺ��� ..............................................................................
                </div>
                <div>
                    ��ʹ��/���µ�/��ʹ��&nbsp;������.......�´
                </div>
                <div>�ͧ��ҧ/��ҧ���/��ҧ����</div>
                <div>
                    �ѹ��.......����&nbsp;&nbsp;�ء.......�������
                </div>
            </div>
            <div style='page-break-after: always'></div>
            <?php
        }
    }

    $cream = input_post('cream');
    if( $cream ){
        $creamInt = (int)input_post('cream_amount');
        
        for ($i=0; $i < $creamInt; $i++) { 
            ?>
            <div class="sticker_contain">
                <div>
                    ����-ʡ�� <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ������ ..................................................................................
                </div>
                <div>
                    ��ͺ����ҷ�&nbsp;&nbsp;��蹤ѹ / ��������������� / ����һǴ
                </div>
                <div>
                    ���ѹ��.......����&nbsp;&nbsp;�ء.......�������
                </div>
            </div>
            <div style='page-break-after: always'></div>
            <?php
        }
    }

    ?>
    <script>
        window.onload = function(){
			window.print();
		};
    </script>
    <?php
    exit;
}


$hn = input('hn');

$sql = "SELECT `hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ";
$db->select($sql);
$pt = $db->get_item();

?>
<style>
label{
    cursor: pointer;
}
*{
    font-family: 'TH Sarabun New','TH SarabunPSK';
    font-size: 18px;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th, .chk_table td{
    border: 1px solid black;
    font-size: 16pt;
    padding: 3px;
}
</style>
<div><h1 style="font-size: 32pt">Sticker ��(Manual)</h1></div>
<div>
    <p><b>HN</b> : <?=$pt['hn'];?> <b>����-ʡ��</b> : <?=$pt['ptname'];?></p>
</div>
<form action="sticker_manual.php" method="post">
    <table class="chk_table">
        <tr>
            <td>���͡</td>
            <td>������</td>
            <td>�ӹǹʵԡ����</td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="inject" id="inject" value="1">
            </td>
            <td><label for="inject">�ҩմ</label></td>
            <td>
                <input type="text" name="inject_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="tablet" id="tablet" value="1">
            </td>
            <td><label for="tablet">�����</label></td>
            <td>
                <input type="text" name="tablet_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="mixture" id="mixture" value="1">
            </td>
            <td><label for="mixture">�ҹ��</label></td>
            <td>
                <input type="text" name="mixture_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="drops" id="drops" value="1">
            </td>
            <td><label for="drops">����ʹ</label></td>
            <td>
                <input type="text" name="drops_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="cream" id="cream" value="1">
            </td>
            <td><label for="cream">�ҷ�</label></td>
            <td>
                <input type="text" name="cream_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">
                <button type="submit">�����</button>
                <input type="hidden" name="page" value="print">
                <input type="hidden" name="hn" value="<?=$pt['hn'];?>">
                <input type="hidden" name="name" value="<?=urlencode($pt['ptname']);?>">
            </td>
        </tr>
    </table>
</form>