<?php
include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Untitled Document</title>
  <style type="text/css">
    tbody tr:nth-child(even) {
      background-color: #EAECEE;
      color: black;
    }

    .font1 {
      font-family: "TH SarabunPSK";
      font-size: 16pt;
    }

    .font2 {
      font-family: "TH SarabunPSK";
      font-size: 16pt;
    }

    a:link {
      color: blue;
      text-decoration: none;
    }

    a:hover {
      color: blue;
      background-color: #c3c3c3;
    }

    a:visited {
      background-color: #aafdcd;
      color: #148F77;
      /* border: 2px solid #229954; */
      /* padding: 10px 20px; */
      /* text-align: center; */
      /* display: inline-block; */
    }

    a:active {
      color: orange;
    }

    #ptrightNotify {
      font-family: "TH SarabunPSK";
      font-size: 20px;
      top: 2%;
      left: 50%;
      width: 600px;
      margin-top: 1em;
      margin-left: -50px;
      border: 1px solid #ccc;
      background-color: #f3f3f3;
      position: fixed;
    }

    #ptnotifyHeader {
      padding: 6px;
      background: #636363;
      text-align: right;
    }

    #ptrightClose {
      font-size: 24px;
      color: #17202A;
      text-decoration: none;
      background-color: #b8b8b8;
    }

    #ptnotifyContent {
      padding: 6px;
    }
    .sweetContainer{
      font-family: "TH SarabunPSK";
      text-align: left;
      font-size:16pt;
    }
    .sweetContainer p{
      margin: 0 0 8px 0;
    }
  </style>
</head>
<?php
$qToken = mysql_query("SELECT * FROM `runno_token` WHERE `id` = '1'") or die(mysql_error());;
$t = mysql_fetch_array($qToken);
$person_id = preg_replace('/\D/', '', $t['cid']);
$smctoken = $t['token'];
?>
<div id="ptrightNotify" style="display: none;">
  <div id="ptnotifyHeader">
    <a href="javascript:void(0);" id="ptrightClose" onclick="document.getElementById('ptrightNotify').style.display = 'none';">&nbsp;[ Close ]&nbsp;</a>
  </div>
  <div style="padding: 6px;" id="ptnotifyContent">กำลังตรวจสอบสิทธิจาก WebService สปสช กรุณารอสักครู่</div>
</div>
<script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>
<script type="text/javascript" src="js/nhso.js"></script>
<body>
  <?php
  $appd = $_GET['appd'];

  $query = "CREATE TEMPORARY TABLE appoint1 SELECT *, left( `doctor` , 5 ) AS codedoctor FROM appoint WHERE appdate = '$appd' ";
  $result = mysql_query($query) or die("Query failed,app");

  $query = "SELECT hn,ptname,apptime,came,row_id,age,doctor,depcode,officer,appdate_en FROM appoint WHERE appdate = '$appd' GROUP BY `hn` ORDER BY row_id ASC    ";
  $resultAppoint = mysql_query($query) or die("Query failed");
  ?>

  <h1 align="center" class="font2">ใบตรวจสอบสิทธิผู้ป่วยนัด วันที่ <?= $appd; ?></h1>
  <table border="1" cellspacing="0" cellpadding="2" style="border-collapse:collapse;" bordercolor="#000000" class="font1">
    <tr>
      <th align="center">ลำดับ</th>
      <th align="center">HN</th>
      <th align="center">IDCARD</th>
      <th align="center">ชื่อ-สกุล</th>
      <th align="center">สิทธิ์หลัก</th>
      <th align="center">สิทธิ์รอง</th>
      <th align="center">หมายเหตุ</th>
      <th align="center">ตรวจสอบสิทธิ</th>
    </tr>
    <?php
    $i = 1;
    while ($arr = mysql_fetch_array($resultAppoint)) {

      $sql = "Select ptright,ptright1,idcard,concat(yot,name,' ',surname)as ptname, hospcode
  From opcard 
  where hn = '" . $arr['hn'] . "' 
  limit 1 ";
      $result1 = mysql_query($sql);
      list($ptright, $ptright1, $idcard, $ptname, $hospcode) = mysql_fetch_row($result1);

      $test_match = preg_match('/^(\d+)/', $hospcode, $matchs);

      $timestamp = strtotime($arr['appdate_en']);

      //if(substr($ptright1,0,3)!='R03' & substr($ptright1,0,3)!='R07' & substr($ptright,0,3)!='R04' & substr($ptright1,0,3)!='R02'){
    ?>
      <tr>
        <td align="center"><?=$i;?></td>
        <td><?=$arr['hn'];?></td>
        <td><?= $idcard; ?></td>
        <td><?= $ptname; ?></td>
        <td><?= $ptright1; ?></td>
        <td><?= $ptright; ?></td>
        <td><?php echo ($test_match > 0) ? $matchs['0'] : ''; ?></td>
        <td><a data-time="<?=$arr['date'];?>" href="#?idcard=<?=$idcard;?>&timestamp=<?=$timestamp;?>" onclick="SRMCheckSit('<?= $idcard; ?>')">API สปสช</a></td>
      </tr>
    <?php
      $i++;
      //}

    }
    ?>
  </table>
  <p align="right" class="font1">ผู้ตรวจสอบ.............................................................................</p>
  <p align="right" class="font1">&nbsp;</p>

  <script type="text/javascript">
  function testCheckSit(idcard) {
    document.getElementById('ptnotifyContent').innerHTML = 'กำลังตรวจสอบสิทธิจาก WebService สปสช กรุณารอสักครู่';
    registerChecksit('ptnotifyContent', idcard, '<?= $person_id; ?>', '<?= $smctoken; ?>');
    document.getElementById('ptrightNotify').style.display = '';
  }

  function SRMCheckSit(idcard){
        loadSRM(idcard);
  }

  /* checkIpd */
  function checkIpd(link, ev, hn) {

    var newSm = new SmHttp();
    newSm.ajax(
      'templates/regis/checkIpd.php', {
        id: hn
      },
      function(res) {
        var txt = JSON.parse(res);
        if (txt.state === 400) {
          alert('สถานะของผู้ป่วยยังอยู่ ' + txt.msg + ' กรุณาติดต่อที่ Ward เพื่อ Discharge');
          SmPreventDefault(ev);
        } else {
          // window.open(link.href, '_blank');
        }
      },
      false // true is Syncronous and false is Assyncronous (Default by true)
    );

  }

  // ออกแบบไว้ก่อน 
  // document.getElementById('checkPt').addEventListener("click", function(eventHandler){
  //     document.getElementById('ptrightNotify').style.display = '';
  // });

  // document.getElementById('ptrightClose').addEventListener("click", function(eventHandler){
  //     document.getElementById('ptrightNotify').style.display = 'none';
  // });
</script>

</body>

</html>