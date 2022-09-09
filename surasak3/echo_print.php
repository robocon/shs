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
    table, th, td, h3, p{
        margin: 0;
        padding: 0;
    }
    h3{
        font-weight: bold;
        font-size: 20px;
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
    }
</style>
<?php 
$id = $dbi->escape_string($_GET['id']);
$sql = "SELECT *,SUBSTRING(`date`,1,10) AS `short_date` FROM `echo_cardio` WHERE `id` = '$id' ";
$q = $dbi->query($sql);

if ($q->num_rows > 0) {
    


$a = $q->fetch_assoc();
list($mDate, $mTime) = explode(' ', $a['date']);
list($h,$i,$s) = explode(':', $mTime);
list($y,$m,$d) = ad_to_bc(explode('-', $mDate));
$th_date = $d.' '.$def_month_th[$m].' '.$y;
?>
<table width="100%">
    <tr style="border-bottom: 1px solid #000000;">
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td align="center" width="40%" style="border-right: 1px solid #000000; padding:4px;">
                        <table>
                            <tr>
                                <td><img src="images/LogoFSH.jpg" alt="" style="height:60px;">&nbsp;&nbsp;</td>
                                <td>
                                    <h3>โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3>
                                    <h3>ECHOCARDIOGRAPHY REPORT</h3>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top" width="60%" style="padding:4px;">
                        <table width="100%">
                            <tr>
                                <td>
                                    <b>ชื่อ</b> <?=$a['ptname'];?>&nbsp;&nbsp;&nbsp;<b>อายุ</b> <?=$a['age'];?>&nbsp;&nbsp;&nbsp;<b>Echo No.</b> <?=$a['echo_no'];?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>HN</b> <?=$a['hn'];?>&nbsp;&nbsp;&nbsp;<b>VN</b> <?=$a['vn'];?>&nbsp;&nbsp;&nbsp;<b>Request Date</b> <?=$th_date;?> <?=$h.':'.$i;?> น.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" width="50%" style="border-right: 1px solid #000000;">
            <table width="100%">
                <tr>
                    <td colspan="8"><u>MEASUREMENT</u></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right" width="10%">Ao&nbsp;</td>
                    <td align="right"><?=$a['ao'];?></td>
                    <td width="19%">&nbsp;mm. (20-32)</td>

                    <td>&nbsp;</td>
                    <td align="right" width="10%">LVEDV&nbsp;</td>
                    <td align="right"><?=$a['lvedv'];?></td>
                    <td width="19%">&nbsp;ml. (90-140)</td>
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
                    <td><?=$a['co'];?></td>
                    <td>L/min</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LVDd&nbsp;</td>
                    <td><?=$a['lvdd'];?></td>
                    <td>mm. (37-55)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">EF&nbsp;</td>
                    <td><?=$a['ed'];?></td>
                    <td>% (50-80)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LVDs&nbsp;</td>
                    <td><?=$a['lvds'];?></td>
                    <td>mm. (22-45)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">peak E&nbsp;</td>
                    <td><?=$a['peake'];?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">Pwd&nbsp;</td>
                    <td><?=$a['pwd'];?></td>
                    <td>mm. (7-11)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">peak A&nbsp;</td>
                    <td><?=$a['peaka'];?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">Pws&nbsp;</td>
                    <td><?=$a['pws'];?></td>
                    <td>mm. (11-17)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">E/A&nbsp;</td>
                    <td><?=$a['ea'];?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">FS&nbsp;</td>
                    <td><?=$a['fs'];?></td>
                    <td>% (25-44)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">DT&nbsp;</td>
                    <td><?=$a['dt'];?></td>
                    <td></td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td colspan="7"><u>DOPPLER</u></td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td align="right" width="16%">MS&nbsp;</td>
                    <td style="width:96px;"><?=$a['ms'];?></td>
                    <td>&nbsp;</td>

                    <td align="right" width="16%">MnGRAD&nbsp;</td>
                    <td style="width:96px;"><?=$a['ms_mngrad'];?></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MVA(PHT)&nbsp;</td>
                    <td><?=$a['ms_mvapht'];?></td>
                    <td>cm<sup>2</sup></td>

                    <td align="right">MVA(2-D)&nbsp;</td>
                    <td><?=$a['ms_mva2d'];?></td>
                    <td>cm<sup>2</sup></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MR&nbsp;</td>
                    <td><?=$a['ms_mr'];?></td>
                    <td>mmHg</td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>2.</td>
                    <td align="right">AS&nbsp;</td>
                    <td><?=$a['as'];?></td>
                    <td>&nbsp;</td>

                    <td align="right">PGRAD&nbsp;</td>
                    <td><?=$a['as_pgrad'];?></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MnGRAD&nbsp;</td>
                    <td><?=$a['as_mngrad'];?></td>
                    <td>mmHg</td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">AR&nbsp;</td>
                    <td><?=$a['as_ar'];?></td>
                    <td></td>
                    
                    <td align="right">AI PHT&nbsp;</td>
                    <td><?=$a['as_aipht'];?></td>
                    <td>ms.</td>
                </tr>

                <tr>
                    <td>3.</td>
                    <td align="right">PS&nbsp;</td>
                    <td><?=$a['ps'];?></td>
                    <td>&nbsp;</td>

                    <td align="right">PGRAD&nbsp;</td>
                    <td><?=$a['ps_pgrad'];?></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MnGRAD&nbsp;</td>
                    <td><?=$a['ps_mngrad'];?></td>
                    <td>mmHg</td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">PR&nbsp;</td>
                    <td><?=$a['ps_pr'];?></td>
                    <td>&nbsp;</td>
                    
                    <td align="right">PGRAD&nbsp;</td>
                    <td><?=$a['ps_pr_pgrad'];?></td>
                    <td>mmHg</td>
                </tr>
                
                <tr>
                    <td>4.</td>
                    <td align="right">TS&nbsp;</td>
                    <td><?=$a['ts'];?></td>
                    <td>&nbsp;</td>

                    <td align="right">MnGRAD&nbsp;</td>
                    <td><?=$a['ts_mngrad'];?></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">TVA(PHT)&nbsp;</td>
                    <td><?=$a['ts_tvapht'];?></td>
                    <td>cm<sup>2</sup></td>

                    <td align="right">TVA(2-D)&nbsp;</td>
                    <td><?=$a['ts_tva2d'];?></td>
                    <td>cm<sup>2</sup></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">TR&nbsp;</td>
                    <td><?=$a['ts_tr'];?></td>
                    <td>&nbsp;</td>
                    
                    <td align="right">RVSP&nbsp;</td>
                    <td><?=$a['ts_rvsp'];?></td>
                    <td>mmHg</td>
                </tr>
            </table>
        </td>
        <td valign="top" width="50%" style="padding-left: 4px;">
            <table width="100%">
                <tr>
                    <td><u>ECHOCARDIOGRAPHIC FINDING:</u></td>
                </tr>
                <tr>
                    <td><?=$a['cardio_finding'];?></td>
                </tr>
                <tr>
                    <td>DIAGNOSIS: <b><?=$a['diag'];?></b></td>
                </tr>
                <tr>
                    <td align="right">
                        <div style="text-align: center; width:240px;">
                            <p>Doctor: .............................................................</p>
                            <!-- <p>พญ. ณัชญ์ระวี บุรีคำ</p> -->
                            <p><?=$a['doctor'];?></p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script>
    window.onload = function(){
        window.print();
    }
</script>
<?php 
}else{
    ?><p>ไม่พบข้อมูล</p><?php
}