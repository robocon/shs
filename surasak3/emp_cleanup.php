<?php

include 'bootstrap.php';

?>
<form action="emp_cleanup.php" method="post" enctype="multipart/form-data">

    <div>
        ������� : <input type="file" name="file">
    </div>
    <div>
        <button type="submit">�����</button>
        <input type="hidden" name="action" value="import">
    </div>
</form>
<?php
$action = input_post('action');
if( $action == 'import' ){

$db = Mysql::load();

$file = $_FILES['file'];
$content = file_get_contents($file['tmp_name']);
$msg = '��辺�����Ź���� ����������͡���ͺ���ѷ';

if( $content !== false ){

    $items = explode("\r\n", $content);

    $i = 0;

    $lab_num = 301;

    $date_birth = '';

    ?>
    <table border="1">
        <tr>
            <td>�ӴѺ</td>
            <td>HN</td>
            <td>�Ţ�ѵû�ЪҪ�</td>
            <td>���� ʡ��</td>
            <td>����</td>
            <td>�ѹ�Դ</td>
            <td>�����</td>
            <td>�ѹ����Ǩ��ԧ</td>
            <td>˹���</td>
        </tr>
    
    <?php
    
    foreach ($items as $key => $item) {
        
        ++$i;
        ++$last_id;

        list($pid, $hn, $fname, $lname, $age, $date, $branch ) = explode(',', $item);
        $yot = false;


        // dump($pid);
        // dump($hn);
        // dump($fname);
        // dump($lname);
        // dump($age);
        // dump($date);
        // dump($branch);

        $fname = trim($fname);
        $lname = trim($lname);

        $clean_fname = preg_replace('/\s+/', ' ', $fname);

        $match = preg_match('/(���|�ҧ|�.�.)/', $clean_fname, $matchs);
        
        if( $match > 0 ){
            $clean_fname = trim(str_replace($matchs[1], '', $clean_fname));
            $yot = $matchs[1];
        }


        

        $test_ex = explode(' ', $clean_fname);
        if( count($test_ex) > 1 ){
            $clean_fname = trim(str_replace($test_ex[1], '', $clean_fname));
            $lname = trim($test_ex[1]);
        }

        $sql = "SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn'";
        $db->select($sql);
        $idc = $db->get_item();
        ?>
        <tr>
            <td><?=$lab_num;?></td>
            <td><?=$hn;?></td>
            <td><?=$idc['idcard'];?></td>
            <td><?=$yot.$clean_fname.' '.$lname;?></td>
            <td><?=$age;?></td>
            <td></td>
            <td></td>
            <td><?=$date;?></td>
            <td><?=$branch;?></td>
        </tr>
        <?php
        $lab_num++;

        
    }
    ?>
    </table>
    <?php
    // $msg = '����Ң��������º����';
}

}