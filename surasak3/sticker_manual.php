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
                    ชื่อ-สกุล <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ชื่อยา ..................................................................................
                </div>
                <div>
                    ข้อบ่งใช้ ..............................................................................
                </div>
                <div>
                    ฉีด IV IM SC ครั้งละ ................................&nbsp;&nbsp;push&nbsp;&nbsp;&nbsp;drip
                </div>
                <div>
                    drip in .......................................ทุก..........................ชั่วโมง
                </div>
                <div>
                    คำแนะนำเพิ่มเติม ...............................................................
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
                    ชื่อ-สกุล <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ชื่อยา ..................................................................................
                </div>
                <div>
                    ข้อบ่งใช้ ..............................................................................
                </div>
                <div>
                    รับประทานครั้งละ.......เม็ด&nbsp;&nbsp;วันละ.......ครั้ง&nbsp;&nbsp;ทุก.......ชั่วโมง
                </div>
                <div>
                    ก่อนอาหาร&nbsp;&nbsp;หลังอาหาร&nbsp;&nbsp;&nbsp;&nbsp;เช้า&nbsp;&nbsp;กลางวัน&nbsp;&nbsp;เย็น&nbsp;&nbsp;ก่อนนอน
                </div>
                <div>
                    คำแนะนำเพิ่มเติม ...............................................................
                </div>
                <table>
                    <tr>
                        <td>๐&nbsp;&nbsp;ทานติดต่อกันจนหมด</td>
                        <td>๐&nbsp;&nbsp;ทานยาหลังอาหารทันที</td>
                    </tr>
                    <tr>
                        <td>๐&nbsp;&nbsp;ยานี้อาจทำให้ง่วงนอน</td>
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
                    ชื่อ-สกุล <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ชื่อยา ..................................................................................
                </div>
                <div>
                    ข้อบ่งใช้ ..............................................................................
                </div>
                <div>
                    รับประทานครั้งละ.......ช้อนชา/ช้อนโต๊ะ/ซีซี&nbsp;&nbsp;&nbsp;&nbsp;จิบเวลาไอ
                </div>
                <div>
                    วันละ.......ครั้ง&nbsp;&nbsp;ทุก.......ชั่วโมง
                </div>
                <div>
                    ก่อนอาหาร&nbsp;&nbsp;หลังอาหาร&nbsp;&nbsp;&nbsp;&nbsp;เช้า&nbsp;&nbsp;กลางวัน&nbsp;&nbsp;เย็น&nbsp;&nbsp;ก่อนนอน
                </div>
                <div>
                    คำแนะนำเพิ่มเติม ...............................................................
                </div>
                <table>
                    <tr>
                        <td>๐&nbsp;&nbsp;ทานติดต่อกันจนหมด</td>
                        <td>๐&nbsp;&nbsp;ทานยาหลังอาหารทันที</td>
                    </tr>
                    <tr>
                        <td>๐&nbsp;&nbsp;ยานี้อาจทำให้ง่วงนอน</td>
                        <td>๐&nbsp;&nbsp;เขย่าขวดก่อนใช้</td>
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
                    ชื่อ-สกุล <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ชื่อยา ..................................................................................
                </div>
                <div>
                    ข้อบ่งใช้ ..............................................................................
                </div>
                <div>
                    หยอดตา/ป้ายตา/หยอดหู&nbsp;ครั้งละ.......หยด
                </div>
                <div>สองข้าง/ข้างขวา/ข้างซ้าย</div>
                <div>
                    วันละ.......ครั้ง&nbsp;&nbsp;ทุก.......ชั่วโมง
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
                    ชื่อ-สกุล <?=urldecode($name);?> HN <?=$hn;?>
                </div>
                <div>
                    ชื่อยา ..................................................................................
                </div>
                <div>
                    ข้อบ่งใช้ยาทา&nbsp;&nbsp;ผื่นคัน / เพิ่มความชุ่มชื่น / บรรเทาปวด
                </div>
                <div>
                    ทาวันละ.......ครั้ง&nbsp;&nbsp;ทุก.......ชั่วโมง
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
<div><h1 style="font-size: 32pt">Sticker ยา(Manual)</h1></div>
<div>
    <p><b>HN</b> : <?=$pt['hn'];?> <b>ชื่อ-สกุล</b> : <?=$pt['ptname'];?></p>
</div>
<form action="sticker_manual.php" method="post">
    <table class="chk_table">
        <tr>
            <td>เลือก</td>
            <td>ประเภท</td>
            <td>จำนวนสติกเกอร์</td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="inject" id="inject" value="1">
            </td>
            <td><label for="inject">ยาฉีด</label></td>
            <td>
                <input type="text" name="inject_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="tablet" id="tablet" value="1">
            </td>
            <td><label for="tablet">ยาเม็ด</label></td>
            <td>
                <input type="text" name="tablet_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="mixture" id="mixture" value="1">
            </td>
            <td><label for="mixture">ยาน้ำ</label></td>
            <td>
                <input type="text" name="mixture_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="drops" id="drops" value="1">
            </td>
            <td><label for="drops">ยาหยอด</label></td>
            <td>
                <input type="text" name="drops_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="cream" id="cream" value="1">
            </td>
            <td><label for="cream">ยาทา</label></td>
            <td>
                <input type="text" name="cream_amount" id="" value="1" size="3">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">
                <button type="submit">พิมพ์</button>
                <input type="hidden" name="page" value="print">
                <input type="hidden" name="hn" value="<?=$pt['hn'];?>">
                <input type="hidden" name="name" value="<?=urlencode($pt['ptname']);?>">
            </td>
        </tr>
    </table>
</form>