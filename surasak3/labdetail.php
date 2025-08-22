<?php
include dirname(__FILE__).'/bootstrap.php';
session_unregister("sVn");
session_unregister("sPtname");
session_unregister("cTrad");
session_unregister("cAmt");
session_unregister("sPharow");
session_register("dDate");

$sPtname = '';
$sPharow = $nRow_id;
$dDate = $sDate;

session_register("sPtname");
session_register("sPharow");
session_register("dDate");
session_register("sVn");

$dDate = $sDate;

$nRow_id = $_GET['nRow_id'];
$query = "SELECT * FROM depart WHERE row_id = '$nRow_id' ";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if (!($row = mysql_fetch_object($result)))
        continue;
}
$sDate = $row->date;
$sTime = substr($sDate, 11);
$sHn = $row->hn;
$sAn = $row->an;
$sPtname = $row->ptname;
$sDoctor = $row->doctor;
$_SESSION["sVn"] = $row->tvn;
$sPrice = $row->price;
$sSumyprice = $row->sumyprice;
$sSumnprice = $row->sumnprice;
$sPaid = $row->paid;
$sNetprice = $row->price;
$sDiag = $row->diag;
$cPaid = $sNetprice;
$departId = $row->row_id;
$departStatus = $row->status;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยกเลิกรายการ</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="container">
<style>
* {
    font-family: "TH SarabunPSK";
    font-size: 20px;
}
h3{
    font-size: 28px;
    margin:0;
}
.table thead tr th{
    background-color: #008080;
    color: #fff;
}
</style>
<div class="mt-2">
    <a class="btn btn-primary" href="javascript:history.back();">ย้อนกลับ</a>
</div>
<table>
    <tr>
        <td align="right"><b>วันเวลา: </b></td>
        <td><?=$sDate;?></td>
        <td align="right"><b>AN: </b></td>
        <td><?=$sAn;?></td>
    </tr>
    <tr>
        <td align="right"><b>ชื่อ-สกุล: </b></td>
        <td><?=$sPtname;?></td>
        <td align="right"><b>HN: </b></td>
        <td><?=$sHn;?></td>
    </tr>
    <tr>
        <td align="right"><b>โรค: </b></td>
        <td><?=$sDiag;?></td>
        <td align="right"><b>แพทย์: </b></td>
        <td><?=$sDoctor;?></td>
    </tr>
</table>
<table>
    <tr>
        <th bgcolor=#EC7063>รายการ</th>
        <th bgcolor=#EC7063>จำนวน</th>
        <th bgcolor=#EC7063>ราคา</th>
        <th bgcolor=#EC7063>เบิกได้</th>
        <th bgcolor=#EC7063>เบิกไม่ได้</th>
    </tr>
    <?php
    $query = "SELECT detail,amount,price,yprice,nprice,row_id FROM patdata WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)or die("Query failed");
    $d = substr($dDate, 8, 2);
    $m = substr($dDate, 5, 2);
    $y = substr($dDate, 0, 4);
    while (list($detail, $amount, $price, $yprice, $nprice, $row_id) = mysql_fetch_row($result)) {
        print(" <tr>\n" .
            "  <td BGCOLOR=F5DEB3>$detail</td>\n" .
            "  <td BGCOLOR=F5DEB3>$amount</td>\n" .
            "  <td BGCOLOR=F5DEB3>$price</td>\n" .
            "  <td BGCOLOR=F5DEB3>$yprice</td>\n" .
            "  <td BGCOLOR=F5DEB3>$nprice</td>\n" .
            " </tr>\n");
    }
    ?>
</table>
<div><b>รวมงิน</b> <?=$sNetprice;?>บาท</div>
<div style='margin-left:5px;color:red;font-size:16px;'>*** กรณียกเลิกข้ามวัน ให้ทำในช่วงเวลาหลังจากที่บันทึกข้อมูลของวันนั้นๆ เช่นวันที่ต้องการยกเลิกคีย์มาเวลา 08.00 น. ควรยกเลิกหลังเวลา 08.00 น. เป็นต้น ***</div>
<?php
if($departStatus==='Y' && $sPrice > 0){
    ?><a class="btn btn-primary" href="javascript:void(0);" onclick="checkConfirm();">ยืนยันการยกเลิก</a><?php
}else{
    ?><a class="btn btn-danger" href="javascript:void(0);">รายการนี้ถูกยกเลิกไปแล้ว</a><?php
}
?>
<script>
    // 
    // return confirm('คุณต้องการยกเลิกทุกรายการใช่หรือไม่?')
    function checkConfirm(){
        onCheckConfirm();
    }
    async function onCheckConfirm(){
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
                            Swal.fire({title: "ยืนยันรหัสผ่านไม่ถูกต้อง"});
                        }else{
                            window.location = 'labturn.php?row_id=<?=$departId;?>';
                        }
                    });
                }
            },
            confirmButtonText: "ยืนยันการยกเลิก",
            cancelButtonText: "ยกเลิก",
            allowOutsideClick: false
        });
        
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
        return false;
    }

    async function onCancel(id){
        const response = await fetch('ipacc_cancel.php?id='+encodeURIComponent(id));
        const data = await response.json();
        return data;
    }

</script>
</div>
</body>
</html>