<?php 
require 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้ป่วย SI และ HI</title>
<style type="text/css">
.w3-container{ font-family:"TH SarabunPSK"; 
font-size:18px;
}
</style>	
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <div class="w3-container">
        <h3 style="font-family:TH SarabunPSK;"><strong>รายชื่อผู้ป่วย OP self Isolation และ Home Isolation ในวันนี้</strong><span style="margin-left: 50px;"><input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" /></span></h3>
        <table class="w3-table-all w3-hoverable">
            <tr class="w3-teal">
                <th>VN</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>สิทธิ</th>
                <th>ประเภท</th>
				<th>กลุ่มอาการ</th>
				<th>สลากติดซองยา</th>
            </tr>
        <?php 
        $today = (date('Y')+543).date('-m-d');
		
        $sql = "SELECT hn,vn,ptname,ptright,opdtype,opdcolor FROM `opday` WHERE `thidate` LIKE '$today%' and (opdtype='SI' || opdtype='HI') ORDER BY `row_id` DESC";
        $q = $dbi->query($sql);
        while ($a = $q->fetch_assoc()) {
            $hn = $a['hn'];
            $vn = $a['vn'];
            $ptname = $a['ptname'];

			
			if($a["opdtype"]=="SI"){
				$type="OP self Isolation";
			}else if($a["opdtype"]=="HI"){
				$type="Home Isolation";	
			}else{
				$type="";	
			}


			
			if($a["opdcolor"]=="green"){
				$color="สีเขียว";
			}else if($a["opdcolor"]=="yellow"){
				$color="สีเหลือง";
			}else if($a["opdcolor"]=="red"){
				$color="สีแดง";	
			}else{
				$color="";	
			}
            ?>
            <tr>
                <td><?=$vn;?></a></td>
                <td><?=$hn;?></td>
                <td><?=$ptname;?></td>
                <td><?=$a['ptright'];?></td>
                <td><?=$type;?></td>
				<td><?=$color;?></td>
				<td><a href="print_slipdrug1.php?hn=<?php echo $hn;?>&type=<?=$a["opdtype"];?>&color=<?=$a["opdcolor"];?>" target="_blank">พิมพ์ข้อมูล</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
</body>
</html>