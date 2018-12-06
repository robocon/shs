<?php 
include 'bootstrap.php';

$action = input_post('action');
if( empty($action) ){

    ?>
    <form action="sticker_new_sol62.php" method="post" enctype="multipart/form-data" id="formMain">
        <div>
        ‰ø≈Ïπ”‡¢È“ : <input type="file" name="file">
        </div>
        <div>
            <button type="submit">send</button>
            <input type="hidden" name="action" value="print">
        </div>
    </form>
    <?php

}elseif ( $action == 'print' ) {

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);

    $items = explode("\r\n", $content);

    $i = 0;
    foreach ($items as $key => $item) {

        list($number, $yot, $name, $surname, $part) = explode(',', $item);

        if( $number >= 169 && $number <= 191 ){
            // continue;
        

        for ($ix=0; $ix < 2; $ix++) { 
            ?>
            <table style="font-family: Angsana New; text-align: center; font-size: 16pt;" width="100%" valign="top">
                <tr style="line-height: 14px;">
                    <td style="font-size:18px;"><b><?=$number;?></b></td>
                </tr>
                <tr>
                    <td><?=$yot.$name.' '.$surname;?></td>
                </tr>
                <tr>
                    <td><b><?=$part;?></b></td>
                </tr>
            </table>
            <?php 
        }

        }

        // if( $i == 50 ){
        //     exit;
        // }

        $i++;

    }

    
        
}