<?php
include_once dirname(__FILE__) . '/bootstrap.php';
if (empty($_SESSION['sOfficer'])) {
    include 'pageNotFound.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขจำนวนต่อวิธีใช้ยา 1 วัน</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="container">
<a target=_self href='../nindex.htm'><< ไปเมนู</a>
<h1>แก้ไขจำนวนต่อวิธีใช้ยา 1 วัน</h1>
<form name="formedit" method="post" action="<? $_SERVER['PHP_SELF'] ?>">
    <table>
        <tr>
            <th>รหัส</th>
            <th>จำนวนต่อ1วัน</th>
            <th>วิธีใช้</th>
            <th>วิธีใช้</th>
            <th>วิธีใช้</th>
            <th>วิธีใช้</th>
        </tr>
        <?php
        $query = "SELECT row_id,slcode,detail1,detail2,detail3,detail4,amount FROM drugslip where slcode!='' ORDER BY slcode ASC";
        $result = mysql_query($query) or die("Query failed");
        while (list($row, $slcode, $detail1, $detail2, $detail3, $detail4, $amount) = mysql_fetch_row($result)) {
            $k++;
            ?>
            <tr>
                <td><?= $slcode ?></td>
                <td>
                    <input name='ch<?=$k;?>' type='text' size='5' value='<?= $amount; ?>' onblur="saveItem(this.value)">
                    <input name='rowid<?=$k;?>' type='hidden' value='<?= $row ?>'>
                </td>
                <td><?= $detail1 ?></td>
                <td><?= $detail2 ?></td>
                <td><?= $detail3 ?></td>
                <td><?= $detail4 ?></td>
            </tr>
            <?php
        }
        echo "<input name='sum' type='hidden' value='$k'>";
        ?>
        <tr>
            <td BGCOLOR='#CCCC00' colspan='6'><input type='submit' value=' ตกลง ' name='ok' onclick='return confirm("ยืนยันการแก้ไขจำนวน?");'></td>
        </tr>
    </table>
</form>
<script>
    function saveItem(v){
        console.log(v);
    }
</script>
<?php
if (isset($_POST['ok'])) {
    for ($p = 1; $p < $_POST['sum']; $p++) {
        $sql = "update drugslip set amount = '" . $_POST['ch' . $p] . "' where row_id='" . $_POST['rowid' . $p] . "' ";
        mysql_query($sql);
    }
?>
    <script>
        window.location.href = 'slipcode_edit.php';
    </script>
<?php
}
?>
</div>
</body>
</html>