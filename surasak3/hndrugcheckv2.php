<?php 
include_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_REQUEST['action']);
if($action==='search'){
    $hn = sprintf("%s", $_REQUEST['hn']);
    $res = array();
    if(empty($hn)){
        $res = array('status'=>400,'message' => 'ไม่พบ HN');

    }else{

        $last = strtotime("-6 months");
        $date = (date('Y', $last)+543).date('-m-d', $last);
        $q = $dbi->query("SELECT `row_id` AS `id`,`date`,`hn`,`tvn` FROM `phardep` WHERE `hn` = '$hn' AND `date` >= '$date' ");
        $a_rows = $q->num_rows;
        if($a_rows==0){
            $res = array('status'=>400, 'message' => 'ไม่พบรายการ 6เดือนย้อนหลัง' );
        }else{
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = array('status'=>200,'count' => $a_rows,'items' => $items);
        }
    }
    echo json_encode($res);
    exit;

}elseif ($action==='showDrugrx') {
    
    $id = sprintf("%d", $_REQUEST['id']);
    $res = array();
    if(empty($id)){
        $res = array('status'=>400,'message' => 'ข้อมูลผิดพลาด');
    }else{
        $q = $dbi->query("SELECT * FROM `drugrx` WHERE `idno` = '$id' ");
        $a_rows = $q->num_rows;
        if($a_rows>0){
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = array('status'=>200,'count' => $a_rows,'items' => $items);
        }else{
            $res = array('status'=>400,'message' => 'ไม่พบข้อมูล');
        }
    }
    echo json_encode($res);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medication Reconciliation</title>
</head>
<body>
    <table style="width:50%;">
        <tr>
            <td>
                <p>ตรวจสอบยาเดิมในโรงพยาบาล</p>
                <div>
                    <form action="hndrugcheckv2.php" id="hnSearch" method="post">
                        HN: <input type="text" name="hn" id="hn">
                        <button type="submit">ตรวจสอบ</button>
                    </form>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Visit 6 เดือนล่าสุด
                <div id="findDate"></div>
            </td>
        </tr>
    </table>
    <form action="hndrugcheckv2.php" method="post" style="width:50%;">
        <table>
            <tr>
                <td>
                    <p>จำนวนรายการยาจากสถานพยาบาลอื่นของผู้ป่วย</p>
                    <input type="text" name="other" id="other"> รายการ
                </td>
            </tr>
            <tr>
                <td id="showFromSelected">
                    <table>
                        <tr>
                            <th>รายการยา/ความแรง</th>
                            <th>วิธีใช้</th>
                            <th>จำนวน</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <button type="submit">พิมพ์ใบ MR</button>
    </form>
    <script>
        document.getElementById("hnSearch").onsubmit = function(e){
            e.preventDefault();
            var hn = document.getElementById("hn").value;
            searchPhardep(hn);
            return false;
        }

        async function searchPhardep(hn){
            var res = await fetch("hndrugcheckv2.php?action=search&hn="+hn);
            var data = await res.json();
            if(data.status===400){
                document.getElementById("findDate").innerHTML = data.message;
            }else{
                var html = '';
                data.items.forEach(el => {
                    html += '<div><input type="radio" name="dateSelect" id="dateSelect" onclick="findDrugrx(\''+el.id+'\')"> '+el.date+'</div>';
                });
                document.getElementById("findDate").innerHTML = html;
            }
        }

        async function findDrugrx(id){
            var res = await fetch("hndrugcheckv2.php?action=showDrugrx&id="+id);
            var data = await res.json();
        }

    </script>
</body>
</html>