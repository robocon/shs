<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

if( $action == false ){
    include 'chk_menu.php';
    ?>

    <h3>��¡�õ�Ǩ Lab</h3>
    <form action="chk_lab_order.php" method="post" enctype="multipart/form-data">
        <div>
            ������� : <input type="file" name="file">
            <div>
                <span style="color: red; font-size: 14px;">
                <b><u>���й� ��Т�ͤ�����ѧ</u></b><br>
                - ��سҵ�Ǩ�ͺ�����š�͹�����<br>
                - �к��ͧ�Ѻ੾����� .csv<br>
                </span>
            </div>
        </div>
        <div>
            <button type="submit">�����</button>
            <input type="hidden" name="action" value="import">
        </div>
        <div>
            <p><b>�ٻẺ�����š�͹���������к�</b></p>
            <table class="chk_table">
                <tr>
                    <td>Lab Number</td>
                    <td>HN</td>
                    <td>����-ʡ��</td>
                    <td>��</td>
                    <td>�ѹ�Դ( LIS �ͧ�Ѻ�繻� �.�. )</td>
                    <td>��¡�õ�Ǩ</td>
                </tr>
            </table>
            <br>
            <div>
                <table class="chk_table" style="font-size: 13px;">
                    <tr>
                        <th colspan="2" align="center">��͸Ժ��</th>
                    </tr>
                    <tr>
                        <td>Labnumber</td>
                        <td>�ٻẺ ��(�ͧ��ѡ)��͹�ѹ ����������� lab �� 180524301 �·�� <br>18 ��ͻ� <br>05 �����͹ <br>24 ����ѹ <br>301 �������lab���§�����</td>
                    </tr>
                    <tr>
                        <td>HN</td>
                        <td>���ʼ������Ѻ��ԡ��</td>
                    </tr>
                    <tr>
                        <td>����-ʡ��</td>
                        <td>�ٻẺ �ӹ�˹�Ҫ��ͪ��� ʡ�� �� ��¤� �ح��</td>
                    </tr>
                    <tr>
                        <td>��</td>
                        <td>M : �����, F : ���˭ԧ</td>
                    </tr>
                    <tr>
                        <td>�ѹ�Դ</td>
                        <td>���ٻẺ ��-��͹-�ѹ ��  1985-12-25 �繵�</td>
                    </tr>
                    <tr>
                        <td>��¡�õ�Ǩ</td>
                        <td>������¡�õ�Ǩ��蹴��� Comma(,) �� CBC,UA,BUN �繵�</td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <div>
        <div><b>������ҧ��èѴ������</b></div>
        <img src="images/sso-import-lab.PNG" alt="">
    </div>
    <?php

} else if ( $action === 'import' ) {

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    
    // @todo
    // - check condition

    if( $content !== false ){

        $items = explode("\r\n", $content);
        
        $i = 0;
        foreach ( $items as $key => $item ) {
            
            $msg = '�ѹ�֡�������������º����';

            if( $i > 0 && !empty($item) ){
                
                list($labnumber, $hn, $ptname, $sex, $dob, $year, $lab_lists) = explode(',', $item, 7);

                $clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�$year";

                $orderhead_sql = "INSERT INTO `orderhead` ( 
                    `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
                    `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
                    `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
                ) VALUES ( 
                    '', NOW(), '$labnumber', '$hn', 'OPD', 
                    '$ptname', '$sex', '$dob', '', '', 
                    '','', 'MD022 (����Һᾷ��)', 'R', '$clinicalinfo'
                );";
                $insert = $db->insert($orderhead_sql);
                if( $insert !== true ){
                    $msg = errorMsg('delete', $insert['id']);
                }

                $lab_lists = str_replace('"', '', $lab_lists);
                $lab_items = explode(',', $lab_lists);
                foreach( $lab_items as $lab_key => $lab_item ){

                    $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                    FROM `labcare` 
                    WHERE `code` = '$lab_item' 
                    LIMIT 1 ";
                    $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                    $num = mysql_num_rows($q);
                    if( $num > 0 ){
                        list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                    
                        $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                            `labnumber` , `labcode`, `labcode1` , `labname` 
                        ) VALUES ( 
                            '$labnumber', '$code', '$oldcode', '$detail'
                        );";
                        $insert = $db->insert($orderdetail_sql);
                        if( $insert !== true ){
                            $msg .= errorMsg('delete', $insert['id']);
                        }
                    }
                    

                }

            } 

            $i++;
        }

    }else{
        $msg = '��س������������١��ͧ';
    }

    redirect('chk_lab_order.php', $msg);
    exit;

}


