<?php 
include 'bootstrap.php'; 

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 16px;
    }
    h3{
        font-weight: bold;
        font-size: 20px;
        margin: 0;
        padding: 0;
    }
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        border: 1px solid black;
        font-size: 16pt;
        padding: 3px;
    }
</style>

<fieldset>
    <legend>ค้นหาตามวันที่</legend>
    <form action="echo_form_print.php" method="post">
        <?php 
        $date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
        ?>
        <div>
            เลือกวันที่ <input type="text" name="date" id="date" value="<?=$date;?>">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
</fieldset>

<?php 
$action = $_POST['action'];
if($action === "search"){

    $date = bc_to_ad($_POST['date']);
    $sql = "SELECT * FROM `echo_cardio` WHERE `date` LIKE '$date%' ";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        ?>
        <table class="chk_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>VN</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['vn'];?></td>
                    <td><a href="echo_print.php?id=<?=$a['id'];?>&hn=<?=$a['hn'];?>">พิมพ์</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <p>ไม่พบข้อมูลวันที่ดังกล่าว</p>
        <?php
    }



    $sql = "SELECT * FROM `echo_cardio` WHERE `thdatehn` = '' ";

}
?>

<table border="1">
    <tr>
        <td colspan="2">
            <table border="1" width="100%">
                <tr>
                    <td align="center" width="30%">
                        <br>
                        <h3>โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3>
                        <h3>ECHOCARDIOGRAPHY REPORT</h3>
                        <br>
                    </td>
                    <td valign="top" width="70%">
                        <table border="1" width="100%" >
                            <tr>
                                <td>
                                    ชื่อ นาย มุ้งมิ้ง กิงก่องแก้ว อายุ 99ปี 5เดือน 11 วัน Vido No. A297/57/M Echo No. EC5610401
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    HN 99-9999 VN 99 Request Date 26 ต.ค. 2556 09:21 น.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" width="40%">
            <table border="1" width="100%">
                <tr>
                    <td colspan="8"><u>MEASUREMENT</u></td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Ao</td>
                    <td>32.6</td>
                    <td>mm. (20-32)</td>
                    <td>9.</td>
                    <td>FS</td>
                    <td>-</td>
                    <td>% (25-44)</td>
                </tr>
            </table>
            <table border="1" width="100%">
                <tr>
                    <td colspan="7"><u>DOPPLER</u></td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>MS</td>
                    <td>NO</td>
                    <td>&nbsp;</td>
                    <td>MnGRAD</td>
                    <td>&nbsp;</td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>MVA(PHT)</td>
                    <td>&nbsp;</td>
                    <td>cm<sup>2</sup></td>
                    <td>MVA(2-D)</td>
                    <td>&nbsp;</td>
                    <td>cm<sup>2</sup></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>MR</td>
                    <td>TRIVIAL</td>
                    <td>mmHg</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </td>
        <td valign="top" width="60%">
            <table border="1" width="100%">
                <tr>
                    <td><u>ECHOCARDIOGRAPHIC FINDING:</u></td>
                </tr>
                <tr>
                    <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</td>
                </tr>
                <tr>
                    <td>DIAGNOSIS: <b>Good MV prosthetic value and LV function</b></td>
                </tr>
                <tr>
                    <td>
                        <p>Doctor: .........................</p>
                        <p>พญ. ณัชญ์ระวี บุรีคำ</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>