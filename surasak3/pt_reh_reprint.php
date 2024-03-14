<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พิมพ์ทะเบียนแรกรับย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="js/sweetalert2.all.min.js"></script>

    <link href="js/vanilla-calendar/vanilla-calendar.min.css" rel="stylesheet">
    <script src="js/vanilla-calendar/vanilla-calendar.min.js" defer></script>
    
</head>
<body>
    <?php 
    require_once 'pt_reh_menu.php';
    ?>
    <div class="container mt-4">
        <form action="pt_reh_reprint.php" method="post" class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="dateSelected" class="col-form-label">เลือกวันที่</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="dateSelected" name="dateSelected" class="form-control">
                    <div style="position:relative;">
                            <div style="position: absolute;">
                                <div id="calendar_start"></div>
                            </div>
                        </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                    <input type="hidden" name="page" value="search">
                </div>
            </div>
        </form>
        <script>
            // ESC ปิดปฏิทิน
            document.addEventListener("keydown", (event) => {
                if (event.isComposing || event.keyCode === 27) {
                    document.getElementById('calendar_start').style.display = 'none';
                }
            });
            
            // แสดงปฏิทิน
            document.getElementById('dateSelected').onclick=function(){ 
                document.getElementById('calendar_start').style.display = '';
                const calendar = new VanillaCalendar('#calendar_start',{
                    settings: {
                        lang: 'th',
                        iso8601: false,
                    },
                    actions: {
                        clickDay(event, self) {
                            document.getElementById('dateSelected').value = self.selectedDates[0];
                            document.getElementById('calendar_start').style.display = 'none';
                        },
                    },
                });
                calendar.init();
            }
        </script>
        
        <?php 
        $page = sprintf("%s", $_POST['page']);
        if($page==='search'){

            $dateSelect = sprintf("%s", $_POST['dateSelected']);
            $sql = "SELECT * FROM `pt_reh` WHERE `date` = '$dateSelect' ORDER BY `id` DESC ";
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                list($y,$m,$d) = explode('-', $dateSelect);
                ?>
                <h3>ข้อมูลวันที่ <?=$d.' '.$def_fullm_th[$m].' '.($y+543);?></h3>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>REH Number</th>
                        <th>จนท.</th>
                        <th></th>
                    </tr>
                    <?php 
                    $i = 1;
                    while($a = $q->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><a href="javascript:void(0);" onclick="openReprint('<?=$a['id'];?>')" title="สั่งปริ้น"><?=$a['hn'];?></a></td>
                            <td><?=$a['ptname'];?></td>
                            <td><a href="javascript:void(0);" onclick="openReprint('<?=$a['id'];?>')" title="สั่งปริ้น"><?=$a['reh_number'];?></a></td>
                            <td><?=$a['officer'];?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="แก้ไข"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="ลบ"><i class="bi bi-trash3"></i></a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
                <script>
                    function openReprint(id){
                        let target = 'target='+encodeURIComponent('pt_firstregis_reprint.php?id='+id);
                        window.open('<?=NOTIFY_HOST;?>/shspdf/printPdf.php?'+target, "rehPopup","width=600,height=400");
                    }
                </script>
                <?php
            }else{
                ?>
                <div class="alert alert-warning" role="alert">ไม่พบข้อมูล</div>
                <?php
            }
        } // end if page === search
        ?>
    </div>
</body>
</html>