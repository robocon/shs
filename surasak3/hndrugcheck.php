<?php
session_start();

include 'includes/connect.php';
global $hn;
$ward_lists = array(
    42 => '�ͼ��������', 43 => '�ͼ������ٵ�', 44 => '�ͼ�����ICU', 45 => '�ͼ����¾����'
);

$action = $_POST['action'];
if( $action === 'print' ){

    $ids = $_POST['rows_id'];
    $hn = $_POST['hn'];
    $type = $_POST['type'];

    $type_txt = ( $type === 'admit' ) ? 'Admit' : 'D/C' ;
    
    $sql = "SELECT *, SUBSTRING(`bedcode`, 1, 2) AS `ward_code`
    FROM `ipcard` 
    WHERE `hn` = '$hn' 
    ORDER BY `row_id` DESC 
    LIMIT 1";
    $q = mysql_query($sql) or die( mysql_error() );
    $user = mysql_fetch_assoc($q);

    $ward_name = $ward_lists[$user['ward_code']];

    $wardExTest = preg_match('/45.+/', $user['bedcode']);
    if( $wardExTest > 0 ){
        
        // ������繪��3 ���������繪��2
        $wardR3Test = preg_match('/R3\d+|B\d+/', $user['bedcode']);
        $wardBxTest = preg_match('/B[0-9]+/', $user['bedcode']);
        $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
        $ward_name = $ward_name.' '.$exName;
    }


    $id_lists = "'".implode("','", $ids)."'";
    $sql = "SELECT a.`tradname`,a.`amount`,a.`date`,b.`detail1`,b.`detail2`,b.`detail3`
    FROM `drugrx` AS a 
    LEFT JOIN `drugslip` AS b ON b.`slcode` = a.`slcode` 
    WHERE a.`row_id` IN ($id_lists)";
    $q = mysql_query($sql) or die( mysql_error() );

    ?>
    <style type="text/css">
    *{
        font-family: 'TH SarabunPSK';
        font-size: 15pt;
    }
    body{
        padding: 2pt;
    }
    h3{
        font-size: 18pt;
        padding: 0;
        margin: 0;
    }
    @media print{
        .noPrint{
            display: none;
        }
    }
    .underline{
        border-bottom: 1px solid black;
        padding: 0 8px;
    }
    </style>
    <!--
    <h3 style="text-align: center;">Medication reconciliation(<?=$type_txt;?>)</h3>
    -->
    <h3 style="text-align: center;">������ͧ������ þ.��������ѡ�������� �ӻҧ</h3>
    <table>
        <tr>
            <td><b>����</b>: <span class="underline"><?=$user['ptname'];?></span></td>
            <td><b>HN</b>: <span class="underline"><?=$user['hn'];?></span></td>
            <td><b>AN</b>: <span class="underline"><?=$user['an'];?></span></td>
        </tr>
        <tr>
            <td><b>�ͼ�����</b>: <span class="underline"><?=$ward_name;?></span></td>
            <td><b>�ѹ���</b>: <span class="underline"><?=$user['date'];?></span></td>
            <td><b>Dx</b>: <span class="underline"><?=$user['diag'];?></span></td>
        </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse; width: 100%;">
        <tr>
            <th rowspan="2" width="2%">#</th>
            <th rowspan="2" width="25%">������</th>
            <th rowspan="2" width="40%">�����</th>
            <th rowspan="2">�ӹǹ</th>
            <th rowspan="2">�ѹ���</th>
            <th colspan="3"><?=$type_txt;?></th>
        </tr>
        <tr>
            <th>����</th>
            <th>Hold</th>
            <th>Off</th>
        </tr>
        <?php
        $i = 1;
        while( $item = mysql_fetch_assoc($q) ) {
            list($date, $time) = explode(' ', $item['date']);
            ?>
             <tr>
                <td><?=$i;?></td>
                <td><?=$item['tradname'];?></td>
                <td><?=$item['detail1'].$item['detail2'].$item['detail3'];?></td>
                <td align="right"><?=$item['amount'];?></td>
                <td><?=$date;?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            ++$i;
        }
        ?>
    </table>
    <table width="100%">
        <tr>
            <td width="50%">ᾷ��..................................................</td>
            <td width="50%">�ѹ���..................................................</td>
        </tr>
        <tr>
            <td width="50%">���Ѫ..................................................</td>
            <td width="50%">�ѹ���..................................................</td>
        </tr>
        <tr>
            <td width="50%">��Һ��..................................................</td>
            <td width="50%">�ѹ���..................................................</td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <tr>
                        <td valign="top">Note: </td>
                        <td>
                            ��Һ���ͼ����µ�Ǩ�ͺ��èѴ���������ͧ������㹿�������������º���¤ú��ǹ<br>
                            �����Ẻ������������ Dr's order D/C ��ѹ�������¡�Ѻ��ҹ�ء���<br>
                            ���ͷ� Med.reconcile �������ó��͹�����¡�Ѻ�ҹ+��ʵԡ����仵Դ OPD Card
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
    </table>
    <div class="noPrint">
        <button onclick="println()">������</button>
    </div>
    <script type="text/javascript">
        function println(){
            window.print();
        }
    </script>
    <?php
    exit;
}

?>

<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ������ҵ�� HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'>&larr;�����</a></p>
</form>

<form action="hndrugcheck.php" method="post" target="_blank">
    <div>
        <button type="submit" value="admit" onclick="add_type('admit')">������ Admit</button>
        <button type="submit" value="dc" onclick="add_type('dc')">������ D/C</button>
        <input type="hidden" name="type" id="type">
        <input type="hidden" name="hn" value="<?=$hn;?>">
        <input type="hidden" name="action" value="print">
    </div>
    <script type="text/javascript">
        function add_type(type){
            document.getElementById('type').value = type;
        }
    </script>
    <table>
        <thead>
            <tr>
                <th bgcolor=CD853F></th>
                <th bgcolor=CD853F>HN</th>
                <th bgcolor=CD853F>AN</th>
                <th bgcolor=CD853F>�ѹ�������</th>
                <th bgcolor=CD853F>drugcode</th>
                <th bgcolor=CD853F>������</th>
                <th bgcolor=CD853F>�Ը���</th>
                <th bgcolor=CD853F>�ӹǹ</th>
                <th bgcolor=CD853F>�Ҥ�</th>
                <th bgcolor=CD853F>part</th>
                <th bgcolor=CD853F>ᾷ��</th>
                <th bgcolor=CD853F>���Ѵ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if( !empty($hn) ){
                
                $query = "SELECT `row_id`,hn,an,date,drugcode,tradname, slcode,amount, price,part FROM drugrx WHERE hn = '$hn'  ORDER BY date DESC " ;
                $result = mysql_query($query) or die("Query failed");

                while (list ($row_id,$hn,$an,$date,$drugcode,$tradname,$slcode,$amount,$price,$part) = mysql_fetch_row ($result)) {

                    $sql = "Select doctor,idname From phardep where date = '$date'  ";
                    list($doctor1,$idname1)  = mysql_fetch_row(Mysql_Query($sql));

                    $sql1 = "SELECT * FROM `druglst` WHERE drugcode='$drugcode' and had='Y' ";
                    $result1 = mysql_query($sql1);
                    $num = mysql_num_rows($result1);
                    if( $num > 0 ){
                        $bg="#CC3333";
                    }else{
                        $bg="#F5DEB3";
                    }

                    ?>
                    <tr>
                        <td BGCOLOR="<?=$bg;?>">
                            <input type="checkbox" name="rows_id[]" id="row_<?=$row_id;?>" value="<?=$row_id;?>">
                        </td>
                        <td BGCOLOR="<?=$bg;?>"><label for="row_<?=$row_id;?>"><?=$hn;?></label></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$an;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$date;?></a></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$drugcode;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$tradname;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$slcode;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$amount;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$price;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$part;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$doctor1;?></td>
                        <td BGCOLOR="<?=$bg;?>"><?=$idname1;?></td>
                    </tr>
                    <?php
                }
                
                include("unconnect.inc");
            }
            ?>
        </tbody>
    </table>
</form>