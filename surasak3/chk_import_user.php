<?php

include 'bootstrap.php';
$action = input('action');
$db = Mysql::load();

if( empty($action) ){
    include_once 'chk_menu.php';
    if( isset($_SESSION['x-msg']) ){
        ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
        unset($_SESSION['x-msg']);
    }
    ?>
    <h3>�������ª��ͼ���Ǩ�آ�Ҿ�������к��ç��Һ��</h3>
    <form action="chk_import_user.php" method="post" enctype="multipart/form-data">
        <div>
            <?php
            $sql = "SELECT `name`,`code` FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC";
            $db->select($sql);
            $items = $db->get_items();
            ?>
            ���͡����ѷ : 
            <select name="part" id="">
                <?php
                foreach ($items as $key => $item) {
                    ?><option value="<?=$item['code'];?>"><?=$item['name'];?></option><?php
                }
                ?>
            </select>
        </div>
        <div>
            ������� : <input type="file" name="file">
            <div><span style="color: red; font-size: 14px;">���й�<br>- ��سҵ�Ǩ�ͺ�����š�͹�����<br>- �к��ͧ�Ѻ��� .csv</span></div>
        </div>
        <div>
            <button type="submit">�����</button>
            <input type="hidden" name="action" value="import">
        </div>
        <div>
            <p><b>�ٻẺ�����š�͹���������к�</b></p>
            <table border="1">
                <tr>
                    <td>�ӴѺ</td>
                    <td>HN</td>
                    <td>�Ţ�ѵû�ЪҪ�</td>
                    <td>���� ʡ��</td>
                    <td>����</td>
                    <td>�ѹ�Դ</td>
                    <td>���������Ǩ �� �����1 �����2</td>
                    <td>�ѹ����Ǩ</td>
                </tr>
            </table>
            <p><b>������ҧ��</b></p>
            <table border="1">
                <tr>
                    <td>1</td>
                    <td>99-9990</td>
                    <td>1111111111111</td>
                    <td>��»�Сͺ �����</td>
                    <td>50</td>
                    <td>25/11/2510</td>
                    <td>1</td>
                    <td>10 ���Ҥ� 2560</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>99-9991</td>
                    <td>2222222222222</td>
                    <td>���⪵� ��ǧ</td>
                    <td>25</td>
                    <td>01/05/2535</td>
                    <td>1</td>
                    <td>10 ���Ҥ� 2560</td>
                </tr>
            </table>
        </div>
    </form>
    <?php
} else if ( $action === 'import' ) {
    $file = $_FILES['file'];
	$content = file_get_contents($file['tmp_name']);
	if( $content !== false ){
	
        $items = explode("\r\n", $content);

        $sql = "SELECT MAX(`row`) AS `lastrow` FROM `opcardchk` LIMIT 1";
		$db->select($sql);
		$chk = $db->get_item();
		$last_id = (int) $chk['lastrow'];

        $i = 0;
        $date_birth = '';
        $part = input_post('part');
        
        foreach ($items as $key => $item) {
            
            ++$i;
            ++$last_id;

            list($pid, $hn, $idcard, $fullname, $age, $date_birth, $course, $date_chkup ) = explode(',', $item);

            if( !empty($pid) ){

                $fullname = preg_replace('/\s+/', ' ', $fullname);
                list($name, $surname) = explode(' ',$fullname);
                $course = '����� '.$course;
    
                $sql = "INSERT INTO `opcardchk`
                (`HN`,
                `row`,
                `exam_no`,
                `pid`,
                `idcard`,
                `name`,
                `surname`,
                `dbirth`,
                `agey`,
                `part`,
                `branch`,
                `course`,
                `datechkup`,
                `active`)
                VALUES (
                '$hn',
                '$last_id',
                '',
                '$pid',
                '$idcard',
                '$name',
                '$surname',
                '$date_birth',
                '$age',
                '$part',
                '',
                '$course',
                '$date_chkup',
                'y');";

                // dump($sql);


                // dump($sql);
                $insert = $db->insert($sql);
                dump($insert);

            }
            
            // if( $i === 1 ){ exit; }
        }

        
    }
    redirect('Location: chk_import_user.php', '����Ң��������º����');
    exit;
}
?>
