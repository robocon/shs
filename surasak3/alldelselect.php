<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$Conn = mysql_connect(HOST, USER, PASS) or die( mysql_error() );
mysql_select_db(DB, $Conn) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $Conn);

$today = "$d-$m-$yr";

$vn = sprintf("%s", $_POST['vn']);
if(empty($vn)){
    echo 'ไม่พบข้อมูล คลิก<a target=_self  href="allerase.php">ที่นี่</a>เพื่อย้อนกลับ';
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยกเลิกรายการ</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body class="container">
<?php 
print "<div>วันที่ <strong>$today</strong> เลือกคลิกรายการที่ต้องการยกเลิก หรือส่งข้อมูลเข้าบัญชีผู้ป่วยใน ";
print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='allerase.php'><<ไปเมนู</a></div>";
$today = "$yr-$m-$d";
?>
<style>
    body,
    td,
    th {
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th,td {
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #FDEDEC;
    }
</style>
<table align="center">
    <tr bgcolor="#EC7063">
        <th>#</th>
        <th>ยกเลิก</th>
        <th>เวลา</th>
        <th>ชื่อ</th>
        <th>HN</th>
        <th>VN</th>
        <th>AN</th>
        <th>รายการ</th>
        <th>ราคารวม</th>
        <th>เบิกได้</th>
        <th>เบิกไม่ได้</th>
        <th>จ่ายเงิน</th>
        <th>เจ้าหน้าที่</th>
    </tr>
    <?php
    $num = 0;
    
    if ($_SESSION["smenucode"] == "ADMXR") {
        $query = "SELECT date,ptname,hn,an,tvn,detail,price,sumyprice,sumnprice,paid,row_id,accno,idname FROM depart WHERE  date LIKE '$today%' and (tvn ='$vn' or an ='$vn') and doctor='MD199 ภาริดา เป็งวัน' ";
    } else {
        $query = "SELECT date,ptname,hn,an,tvn,detail,price,sumyprice,sumnprice,paid,row_id,accno,idname FROM depart WHERE  date LIKE '$today%' and (tvn ='$vn' or an ='$vn')";
    }
    
    $result = mysql_query($query, $Conn)or die("Query failed");

    while (list($date, $ptname, $hn, $an, $tvn, $detail, $price, $yprice, $nprice, $paid, $row_id, $accno, $idname) = mysql_fetch_row($result)) {
        $num++;
        $time = substr($date, 11);
        if ($nprice > 0) {
            $color = "#FC0303";
        } else {
            $color = "#000000";
        }

        $delLink = '<a href="labdetail.php?sDate='.$date.'&nRow_id='.$row_id.'&nAccno='.$accno.'" target="_blank">🚮</a>';

        print (" <tr style='color:$color;'>\n" .
            "  <td >$num</td>\n" .
            " <td >$delLink</td>".
            "  <td >$time</td>\n" .
            "  <td ><a href=\"javascript:void(0);\">$ptname</a></td>\n" .
            "  <td >$hn</td>\n" .
            "  <td >$tvn</td>\n" .
            "  <td >$an</td>\n" .
            "  <td >$detail</td>\n" .
            "  <td >$price</td>\n" .
            "  <td >$yprice</td>\n" .
            "  <td >$nprice</td>\n" .
            "  <td >$paid</td>\n" .
            "  <td >$idname</td>\n" .
            " </tr>\n");
    }
    ?>
</table>
<?php 
$match = preg_match("/\//", $vn, $matchs);
if($match!==false){
    $sql = "SELECT a.*, b.`ptname`,b.`hn` 
    FROM ( 
    SELECT *,SUBSTRING(`date`,11,9) AS `time` FROM ipacc 
    WHERE `an` = '$vn' 
    AND `depart` = 'WARD' 
    AND `date` LIKE '$today%' 
    AND `idno` = 0 
    ) AS a LEFT JOIN `ipcard` AS b ON a.an = b.an";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <hr>
        <h3>รายการในหอผู้ป่วย</h3>
        <table align="center">
            <tr bgcolor="#EC7063">
                <th >#</th>
                <th>เวลา</th>
                <th>ชื่อ</th>
                <th>HN</th>
                <th>VN</th>
                <th>AN</th>
                <th>รายการ</th>
                <th>ราคารวม</th>
                <th>เบิกได้</th>
                <th>เบิกไม่ได้</th>
                <th>จ่ายเงิน</th>
                <th>เจ้าหน้าที่</th>
            </tr>
        <?php
        $ii = 1;
        while ($a = $q->fetch_assoc()) { 
            ?>
            <tr>
                <td><?=$ii;?></td>
                <td><?=$a['time'];?></td>
                <td>
                <?php 
                if($a['officemon']==='ยกเลิก' OR $a['price'] < 0){
                    ?>
                    <?=$a['ptname'];?>
                    <?php
                }else{
                    ?>
                    <a href="javascript:void(0);" onclick="cancelItem('<?=$a['row_id'];?>')"><?=$a['ptname'];?></a>
                    <?php
                }
                ?>
                </td>
                <td><?=$a['hn'];?></td>
                <td>-</td>
                <td><?=$a['an'];?></td>
                <td><?=$a['detail'];?></td>
                <td><?=$a['price'];?></td>
                <td><?=$a['yprice'];?></td>
                <td><?=$a['nprice'];?></td>
                <td><?=$a['paid'];?></td>
                <td><?=$a['idname'];?></td>
            </tr>
            <?php
            $ii++;
        }
        ?>
        </table>
        <script>
            function cancelItem(id){
                onCancelItem(id);
            }

            async function onCancelItem(id){
                const { value: ipAddress } = await Swal.fire({
                    title: "ยืนยันการยกเลิกรายการ",
                    input: "password",
                    inputLabel: "กรุณาใส่รหัสผ่านของท่านเพื่อยืนยันการยกเลิกรายการดังกล่าว",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่รหัสผ่าน";
                        }else{
                            onCheckPassword(value).then((r)=>{
                                if(r.status===400){
                                    Swal.fire({title: "รหัสผ่านไม่ถูกต้อง ลืมเปลี่ยนภาษารึป่าว"});
                                }
                            });
                        }
                    }
                });
                if (ipAddress) {
                    onCancel(id).then((res)=>{
                        if(res.status==200){
                            Swal.fire("บันทึกข้อมูลเรียบร้อย").then((result)=>{ location.reload(); });
                        }
                    });
                }
            }

            async function onCancel(id){
                const response = await fetch('ipacc_cancel.php?id='+encodeURIComponent(id));
                if (!response.ok) {
                }
                const data = await response.json();
                return data;
            }

            async function onCheckPassword(password){
                const id = '<?=sprintf("%s", $_SESSION['sRowid']);?>';
                let data = [];
                data.push(encodeURIComponent('action') + "=" + encodeURIComponent('checkOldPass'));
                data.push(encodeURIComponent('id') + "=" + encodeURIComponent(id));
                data.push(encodeURIComponent('pass') + "=" + encodeURIComponent(password));
                let dataPost = data.join("&");

                let response = await fetch('chgpword.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: dataPost
                });
                const body = await response.json();
                return body;

                
            }
        </script>
        <?php
    }
}
?>
</body>
</html>