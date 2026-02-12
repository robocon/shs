<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลสลากยา</title>
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
  #mainNav{
    background-color: #198754!important;
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
  <form name="form1" method="POST" action="rxadd.php">
    <h3 class="mt-2">เพิ่มข้อมูลทำสลากยา</h3>
    <p>&nbsp;&nbsp;<b>รหัสจ่ายยา</b>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" name="slipcode" id="slipcode" size="12"><button type="button" class="btn btn-secondary btn-sm ms-2" onclick="checkSlcode()">ตรวจสอบรหัส</button>
      รหัสต้องไม่เกิน 15 ตัวอักษร<br>
      <u>ตัวอย่าง</u> ann1*3 หมายถึง ann คือชื่อย่อแพทย์, 1*3 คือรับประทานครั้งละ 1 เม็ด 3 เวลา
    </p>
    <p>&nbsp;&nbsp; <b>รายการ 1</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
      <input name="detail1" type="text" id="detail1" placeholder="รับประทานครั้งละ 1 เม็ด" size="48">
      ตัวอย่าง. รับประทานครั้งละ 1 เม็ด
    </p>
    <p>&nbsp;&nbsp; <b>รายการ 2</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="detail2" type="text" id="detail2" placeholder="วันละ 3 ครั้ง หลังอาหาร" size="48">
      ตัวอย่าง. วันละ 3 ครั้ง หลังอาหาร
    </p>
    <p>&nbsp;&nbsp; <b>รายการ 3</b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
      <input name="detail3" type="text" id="detail3" placeholder="เช้า-กลางวัน-เย็น" size="48">
      ตัวอย่าง. เช้า-กลางวัน-เย็น
    </p>
    <p>&nbsp;&nbsp; <b>รายการ 4</b>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
      <input type="text" name="detail4" id="detail4" size="48">
    </p>
    <p>&nbsp;&nbsp; <b>จำนวนที่ต้องใช้ต่อวัน</b>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
      <input type="text" name="amount" id="amount" size="5">
    </p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;
      <input type="submit" value="ตกลง" onClick="JavaScript:return checksubmit();" name="B1">&nbsp;&nbsp;&nbsp;
      <input type="reset" value="ยกเลิก" name="B2">
    </p>
  </form>
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

  function checksubmit() {
    if (document.form1.slipcode.value == "") {
      alert("กรุณาระบุรหัสจ่ายยา");
      document.form1.slipcode.focus();
      return false;
    } else if (document.form1.detail1.value == "") {
      alert("กรุณาระบุรายการ1");
      document.form1.detail1.focus();
      return false;
    } else if (document.form1.detail2.value == "") {
      alert("กรุณาระบุรายการ2");
      document.form1.detail2.focus();
      return false;
    } else if (document.form1.detail3.value == "") {
      alert("กรุณาระบุรายการ3");
      document.form1.detail3.focus();
      return false;
    }
  }
    function checkSlcode(){
        const slipcode = document.getElementById('slipcode').value.trim();
        if(slipcode==''){
          Toast.fire({
              icon: "error",
              title: "กรุณากรอกรหัสจ่ายยา"
          });
          document.getElementById('slipcode').focus();
          return false;
        }
        onTest(slipcode).then((res)=>{
            if(res.status==200){
              Toast.fire({
                icon: "success",
                title: "รหัสใช้งานได้"
              });
            }else{
              Toast.fire({
                icon: "error",
                title: "รหัสซ้ำซ้อน"
              });
            }
        });
    }

    async function onTest(slipcode){
      const data = {
        'action': 'search',
        'slcode': slipcode
      }
      const response = await fetch('rxadd.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });
      const res = await response.json();
      return res;

    }
  </script>

</div>
</body>
</html>