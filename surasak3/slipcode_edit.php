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
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 16pt;
    }
    #theadTeal tr th{
        background-color: #198754;
        color: #ffffff;
    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary" id="mainNav" data-bs-theme="dark" style="background-color: #13795b!important; color: #ffffff;">
  <div class="container-fluid">
    <a class="navbar-brand" href="../nindex.htm">🏡</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="slipadd.php">เพิ่มข้อมูลวิธีใช้</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="dgslip.php">แก้ไขวิธีใช้</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="slipcode_edit.php">จำนวนต่อวัน</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<h3 class="mt-2 mb-2">แก้ไขจำนวนต่อวิธีใช้ยา 1 วัน</h3>
<form name="formedit" method="post" action="slipcode_edit.php">
    <table class="table table-hover table-sm table-striped mt-2" id="theadTeal">
        <thead class="sticky-top">
            <tr>
                <th>รหัส</th>
                <th>จำนวนต่อ1วัน</th>
                <th>วิธีใช้</th>
                <th>วิธีใช้</th>
                <th>วิธีใช้</th>
                <th>วิธีใช้</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT row_id,slcode,detail1,detail2,detail3,detail4,amount FROM drugslip where slcode!='' ORDER BY slcode ASC";
        $result = mysql_query($query) or die("Query failed");
        while (list($row, $slcode, $detail1, $detail2, $detail3, $detail4, $amount) = mysql_fetch_row($result)) {
            $k++;
            ?>
            <tr class="search-items" data-value="<?= $slcode; ?>">
                <td><?= $slcode ?></td>
                <td>
                    <input name='ch<?=$k;?>' type='text' size='5' value='<?= $amount; ?>' onblur="saveItem('<?= $row ?>',this.value)">
                    <input name='rowid<?=$k;?>' type='hidden' value='<?= $row ?>'>
                </td>
                <td><?= $detail1 ?></td>
                <td><?= $detail2 ?></td>
                <td><?= $detail3 ?></td>
                <td><?= $detail4 ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</form>
<div class="position-fixed top-50 end-0">
    <div class="p-2">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1">🔎</span>
            <input type="text" class="form-control" id="slip-search" placeholder="ค้นหาตามรหัส" onkeyup="searchItem(this.value)">
        </div>
    </div>
</div>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    
    function saveItem(id, amount){
        onSave(id, amount).then((res)=>{
            if(res.status==200){
                Toast.fire({
                    icon: "success",
                    title: "บันทึกข้อมูลเรียบร้อย"
                });
            }else if(res.status===400){
                Swal.fire({
                    icon:"error",
                    title: res.msg
                });
            }
        });
    }

    async function onSave(id, amount){
        const data = {
            "id": id,
            "amount": amount
        }
        let response = await fetch('slipcode_edit_save.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const content = await response.json();
        return content;
    }

    function searchItem(v){
        let items = document.getElementsByClassName('search-items');
        for (let index = 0; index < items.length; index++) {
            const el = items[index];
            const itemValue = el.getAttribute('data-value');
            if(itemValue.indexOf(v)>-1){
                el.style.display = '';
            }else{
                el.style.display = 'none';
            }
        }
    }
</script>
</div>
</body>
</html>