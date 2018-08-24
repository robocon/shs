<?php 
include 'bootstrap.php';

$db = Mysql::load();
$sql = "SELECT * FROM `opcardchk` 
WHERE `part` = 'ควอลิตี้61' 
ORDER BY `row` ASC";

$db->select($sql);
$items = $db->get_items();

$start_latest_id = 1312;

foreach( $items as $key => $arr ){ 
    

    $hn = $arr["HN"];
    $name = $arr["yot"].' '.$arr["name"].' '.$arr["surname"];

    $exam_no = $arr['exam_no'];

    if( $exam_no < 1301 ){
        continue;
    }
    
    $labno2 = "180823".$exam_no."01";

    
    if( preg_match('/โปรแกรมอายุ<35ปี/', $arr['course']) > 0 ){

        $stk_number = "180823".$exam_no."01";
        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name.' ('.$hn.')';?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$exam_no;?></font><br><font size="2">(CBC)</font></td>
                <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
            </tr>
        </table>
        <?php

        $stk_number = "180823".$exam_no."02";
        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name.' ('.$hn.')';?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$exam_no;?></font><br><font size="2">(Chem)</font></td>
                <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
            </tr>
        </table>
        <?php
        

    }

    if( preg_match('/โปรแกรมอายุ>35ปี/', $arr['course']) > 0 ){

        $stk_number = "180823".$exam_no."01";
        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name.' ('.$hn.')';?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$exam_no;?></font><br><font size="2">(CBC)</font></td>
                <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
            </tr>
        </table>
        <?php

        $stk_number = "180823".$exam_no."02";
        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name.' ('.$hn.')';?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$exam_no;?></font><br><font size="2">(Chem)</font></td>
                <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
            </tr>
        </table>
        <?php

        ++$start_latest_id;
        $stk_number = "180823".$start_latest_id."02";
        ?>
        <table style="font-family: Angsana New; text-align: center;" width="100%">
            <tr>
                <td colspan="2"><?=$name.' ('.$hn.')';?></td>
            </tr>
            <tr>
                <td><font size="5"><?=$start_latest_id;?></font><br><font size="2">(BS)</font></td>
                <td><img src = "barcode/labstk.php?cLabno=<?=$stk_number;?>"></td>
            </tr>
        </table>
        <?php

    }
    
    if( preg_match('/ไซลีน/', $arr['course']) > 0 ){


        for ($ii=0; $ii < 4; $ii++) { 

            ?>
            <table style="font-family: Angsana New; text-align: center;" width="100%">
                <tr>
                    <td><?=$name.' ('.$hn.')';?></td>
                </tr>
                <tr>
                    <td>OUT LAB</td>
                </tr>
                <tr>
                    <td><font size="5"><?=$exam_no;?></font></td>
                </tr>
            </table>
            <?php
            
        }
        
    }

// }

}
?>