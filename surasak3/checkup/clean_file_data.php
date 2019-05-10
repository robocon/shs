<?php 
include '../bootstrap.php';

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	return $ageY;
}

$action = input_post('action');
if( $action == 'import' ){
    $db = Mysql::load($shs_configs);
    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);

    ?>
    <table>
        <tr>
            <th>#</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    
    <?php
    foreach ( $items as $key => $item ) {

        list($id,$hn,$name,$idcard,$age) = explode(',', $item);



        // dump($id);
        // dump($hn);
        // dump($name);
        // dump($idcard);
        // dump($age);

        preg_match('/(นาง|น.ส.|นาย)\s?(.+)\s+(.+)/',$name, $matchs);
        // dump($matchs);

        $yot = $matchs['1'];
        $new_name = trim($matchs['2']);
        $new_surname = $matchs['3'];

        $new_ptname = $yot.$new_name.' '.$new_surname;
        // dump($new_ptname);

        $idcard = str_replace('-','',$idcard);

        if (empty( $age )) {

            $sql = "SELECT `dbirth` FROM `opcard` WHERE `hn` = '$hn' ";
            $db->select($sql);

            $opc = $db->get_item();

            $age = calcage($opc['dbirth']);
        }

        ?>
        <tr>
            <td><?=$id;?></td>
            <td><?=$hn;?></td>
            <td><?=$yot.$new_name;?></td>
            <td><?=$new_surname;?></td>
            <td><?=$idcard;?></td>
            <td><?=$age;?></td>
        </tr>
        <?php
        // echo "<hr>";
    }

    ?>
    </table>
    <?php
    exit;
}
?>

<form action="clean_file_data.php" method="post" enctype="multipart/form-data">
    <div>
        ไฟล์นำเข้า : <input type="file" name="file">
    </div>
    <div>
        <button type="submit">นำเข้า</button>
        <input type="hidden" name="action" value="import">
    </div>
</form>
