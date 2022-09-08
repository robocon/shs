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
    table, th, td {
        border-collapse: collapse;
        margin: 0;
        padding: 0;
    }
</style>
<?php 
$id = $dbi->escape_string($_GET['id']);
$sql = "SELECT *,SUBSTRING(`date`,1,10) AS `short_date` FROM `echo_cardio` WHERE `id` = '$id' ";
$q = $dbi->query($sql);
$a = $q->fetch_assoc();

list($mDate, $mTime) = explode(' ', $a['date']);
list($h,$i,$s) = explode(':', $mTime);
list($y,$m,$d) = ad_to_bc(explode('-', $mDate));
$th_date = $d.' '.$def_month_th[$m].' '.$y;
?>
<table border="1">
    <tr style="border-bottom: 1px solid #000000;">
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td align="center" width="30%" style="border-right: 1px solid #000000; padding:4px;">
                        <table>
                            <tr>
                                <td><img src="images/LogoFSH.jpg" alt="" style="width:50px;"></td>
                                <td>
                                    <h3>โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3>
                                    <h3>ECHOCARDIOGRAPHY REPORT</h3>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top" width="70%" style="padding:4px;">
                        <table width="100%">
                            <tr>
                                <td>
                                    <b>ชื่อ</b> <?=$a['ptname'];?> <b>อายุ</b> <?=$a['age'];?> <b>Echo No.</b> <?=$a['echo_no'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>HN</b> <?=$a['hn'];?> <b>VN</b> <?=$a['vn'];?> <b>Request Date</b> <?=$th_date;?> <?=$h.':'.$i;?> น.
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
                    <td>&nbsp;</td>
                    <td align="right" width="10%">Ao&nbsp;</td>
                    <td ><?=$a['ao'];?></td>
                    <td width="19%">mm. (20-32)</td>

                    <td>&nbsp;</td>
                    <td align="right" width="10%">LVEDV&nbsp;</td>
                    <td ><?=$a['lvedv'];?></td>
                    <td width="19%">ml. (90-140)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LA&nbsp;</td>
                    <td><?=$a['la'];?></td>
                    <td>mm. (18-40)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">LVESV&nbsp;</td>
                    <td><?=$a['lvesv'];?></td>
                    <td>ml. (27-95)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">IVSd&nbsp;</td>
                    <td><?=$a['ivsd'];?></td>
                    <td>mm. (6-11)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">SV&nbsp;</td>
                    <td><?=$a['sv'];?></td>
                    <td>ml. (50-100)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">IVSs&nbsp;</td>
                    <td><?=$a['ivss'];?></td>
                    <td>mm. (9-16)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">CO&nbsp;</td>
                    <td><input type="text" name="co" id="co" size="8" value="<?=$a['co'];?>"></td>
                    <td>L/min</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LVDd&nbsp;</td>
                    <td><input type="text" name="lvdd" id="lvdd" size="8" value="<?=$a['lvdd'];?>"></td>
                    <td>mm. (37-55)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">EF&nbsp;</td>
                    <td><input type="text" name="ed" id="ed" size="8" value="<?=$a['ed'];?>"></td>
                    <td>% (50-80)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LVDs&nbsp;</td>
                    <td><input type="text" name="lvds" id="lvds" size="8" value="<?=$a['lvds'];?>"></td>
                    <td>mm. (22-45)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">peak E&nbsp;</td>
                    <td><input type="text" name="peake" id="peake" size="8" value="<?=$a['peake'];?>"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">Pwd&nbsp;</td>
                    <td><input type="text" name="pwd" id="pwd" size="8" value="<?=$a['pwd'];?>"></td>
                    <td>mm. (7-11)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">peak A&nbsp;</td>
                    <td><input type="text" name="peaka" id="peaka" size="8" value="<?=$a['peaka'];?>"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">Pws&nbsp;</td>
                    <td><input type="text" name="pws" id="pws" size="8" value="<?=$a['pws'];?>"></td>
                    <td>mm. (11-17)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">E/A&nbsp;</td>
                    <td><input type="text" name="ea" id="ea" size="8" value="<?=$a['ea'];?>"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">FS&nbsp;</td>
                    <td><input type="text" name="fs" id="fs" size="8" value="<?=$a['fs'];?>"></td>
                    <td>% (25-44)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">DT&nbsp;</td>
                    <td><input type="text" name="dt" id="dt" size="8" value="<?=$a['dt'];?>"></td>
                    <td></td>
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