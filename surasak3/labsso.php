<?php
// session_start();
include 'bootstrap.php';
$db = Mysql::load();

// echo "Hello �١��ҧ ���.";

// echo "<br>";

// echo "<pre>";
// var_dump($GLOBALS);
// var_dump($_SESSION);
// echo "</pre>";

$sql = "SELECT a.*, b.`agey`
FROM `lab_pretest` AS a 
LEFT JOIN `opcardchk` AS b ON b.`HN` = a.`hn` 
WHERE b.`part` = '�١��ҧ61' 
AND a.`hn` = '$cHn' 
AND a.`checked` IS NULL OR a.`checked` = '' ";
$db->select($sql);
$item = $db->get_item();

echo "HN : $cHn, <b> VN:</b>$tvn, ����-ʡ�� : $cPtname<br> 
�Է�� : $cPtright, ���� : ".$item['agey']." �� <br> ";



/*
?>
<p>HN : 58-2733, VN:1  ��� ��ɳ��ѡ��� �ѹ���</p>
<p>�Է��: R07 ��Сѹ�ѧ��, (�١��ҧ þ.�����)</p>
<?php
*/
?>

<form method="POST" action="/sm3/surasak3/labseek.php"> <font face="Angsana New">
    <a target="_BLANK" href="codehlp.php">����</a>
    <div id="list" style="left: 9px; top: 121px; position: absolute;"></div>&nbsp;&nbsp;&nbsp;

    <input type="text" name="code" size="8" id="aLink" value="" onkeypress="searchSuggest(this.value,2,'code');">

    * <input type="text" name="amount" size="4" value="1">&nbsp;
    </font>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Angsana New">
    <input type="submit" value="��ŧ" name="B1" style="height:40px; width:110px; font-size:16px;"></font><p></p>

    <script type="text/javascript">
        document.getElementById('aLink').focus();

        function newXmlHttp(){
            var xmlhttp = false;

                try{
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }catch(e){
                try{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }catch(e){
                        xmlhttp = false;
                    }
                }

                if(!xmlhttp && document.createElement){
                    xmlhttp = new XMLHttpRequest();
                }
            return xmlhttp;
        }

        function searchSuggest(str,len,getto) {
	
            str = str+String.fromCharCode(event.keyCode);

            if(str.length >= len){

                url = 'labseek.php?action=code&search1=' + str+'&getto=' + getto;

                xmlhttp = newXmlHttp();
                xmlhttp.open("GET", url, false);
                xmlhttp.send(null);

                document.getElementById("list").innerHTML = xmlhttp.responseText;
            }
        }

    </script>

</form>

<?php

$sso_list = array();
if( !empty($item['cbc']) ){
    $sso_list[] = 'cbc';
}
if( !empty($item['ua']) ){
    $sso_list[] = 'ua';
}
if( !empty($item['bs']) ){
    $sso_list[] = 'bs';
}
if( !empty($item['cr']) ){
    $sso_list[] = 'cr';
}
if( !empty($item['chol']) ){
    $sso_list[] = 'chol';
}
if( !empty($item['hdl']) ){
    $sso_list[] = 'hdl';
}
if( !empty($item['hbsag']) ){
    $sso_list[] = 'hbsag';
}
if( !empty($item['fobt']) ){
    $sso_list[] = 'stocb';
}
if( !empty($item['cxr']) ){
    $sso_list[] = 'cxr';
}
sort($sso_list); // ���§����ѡ������

$shs_list = array('cbc','ua');
if( $item['agey'] >= 35 ){
    $shs_list = array('cbc','ua','bs','ldl','hdl','bun','cr','sgot','sgpt','alk');
}
sort($shs_list); // ���§����ѡ������

// �������¡�õ�Ǩ��ӫ�͹�Ѻ�ͧ ��� ��ź�͡�ҡ��¡��
foreach( $shs_list AS $key => $shs_item ){
    if( in_array($shs_item, $sso_list) === true ){
        unset($shs_list[$key]);
    }
}


?>

<form action="labsso_save.php" target="right" method="post">
    <?php
    if( count($sso_list) > 0 ){
        ?>
        <p style="margin-bottom: 0;"><b>��¡�õ�Ǩ����Է�Ի�Сѹ�ѧ��</b></p>
        <div>
            <table border="1">
                <tr>
                    <th>����</th>
                    <th>��¡��</th>
                    <th>�Ҥ�</th>
                    <th>���</th>
                </tr>
                <?php
                foreach ($sso_list as $key => $item) {
                    
                    $sql = "SELECT `code`,`detail`,`price` FROM `labcare` WHERE `code` LIKE '$item-sso'";
                    $db->select($sql);
                    $lab = $db->get_item();
                    ?>
                        <tr>
                            <td><?=$lab['code'];?></td>
                            <td><?=$lab['detail'];?></td>
                            <td><?=$lab['price'];?></td>
                            <td align="center">
                                <a href="javascript: void(0);">ź</a>
                                <input type="hidden" name="sso_list[]" value="<?=$lab['code'];?>">
                            </td>
                        </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }
    
    if( count($shs_list) > 0 ){
        ?>
        <p style="margin-bottom: 0;"><b>��¡�õ�Ǩ��� þ.�����</b></p>
        <div>
            <table border="1">
                <tr>
                    <th>����</th>
                    <th>��¡��</th>
                    <th>�Ҥ�</th>
                    <th>���</th>
                </tr>
                <?php
                foreach ($shs_list as $key => $item) {
                    
                    $sql = "SELECT `code`,`detail`,`price` FROM `labcare` WHERE `code` LIKE '$item'";
                    $db->select($sql);
                    $lab = $db->get_item();
                    ?>
                        <tr>
                            <td><?=$lab['code'];?></td>
                            <td><?=$lab['detail'];?></td>
                            <td><?=$lab['price'];?></td>
                            <td align="center">
                                <a href="javascript: void(0);">ź</a>
                                <input type="hidden" name="shs_list[]" value="<?=$lab['code'];?>">
                            </td>
                        </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }
    ?>
    <br>
    <div>
        <button type="submit" style="font-size: 16px; font-weight: bold; padding: 8px;">�ѹ�֡������</button>
        <br>
        <span style="color: red;">��سҵ�Ǩ�ͺ���������ա�͹�ӡ�úѹ�֡</span>
    </div>
</form>

