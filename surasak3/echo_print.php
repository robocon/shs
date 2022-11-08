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
    body{
        padding: 8px;
    }
    
    table, th, td, h3, p{
        margin: 0;
        padding: 0;
    }
    h3{
        font-weight: bold;
        font-size: 20px;
    }
    .setUnderline{
        border-bottom: 1px solid #000000;
        line-height: 14px;
        min-height: 14px;
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
$sql = sprintf("SELECT *,SUBSTRING(`date`,1,10) AS `short_date` FROM `echo_cardio` WHERE `id` = '%s' ", $_GET['id']);
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
                                    <?php 
                                    $type = "<b>VN</b> ".$a['vn']."&nbsp;&nbsp;&nbsp;";
                                    if($a['type']=='IPD'){
                                        $type = "<b>AN</b> ".$a['vn']."&nbsp;&nbsp;&nbsp;";
                                    }
                                    ?>
                                    <b>HN</b> <?=$a['hn'];?>&nbsp;&nbsp;&nbsp;<?=$type;?><b>Request Date</b> <?=$th_date;?> <?=$h.':'.$i;?> น.
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
                    <td align="center"><div class="setUnderline"><?=$a['ao'];?></div></td>
                    <td width="19%">&nbsp;mm. (20-32)</td>

                    <td>&nbsp;</td>
                    <td align="right" width="10%">LVEDV&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['lvedv'];?></div></td>
                    <td width="19%">&nbsp;ml. (90-140)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LA&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['la'];?></div></td>
                    <td>mm. (18-40)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">LVESV&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['lvesv'];?></div></td>
                    <td>ml. (27-95)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">IVSd&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ivsd'];?></div></td>
                    <td>mm. (6-11)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">SV&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['sv'];?></div></td>
                    <td>ml. (50-100)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">IVSs&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ivss'];?></div></td>
                    <td>mm. (9-16)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">CO&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['co'];?></div></td>
                    <td>L/min</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LVDd&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['lvdd'];?></div></td>
                    <td>mm. (37-55)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">EF&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ef'];?></div></td>
                    <td>% (50-80)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">LVDs&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['lvds'];?></div></td>
                    <td>mm. (22-45)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">peak E&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['peake'];?></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">Pwd&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['pwd'];?></div></td>
                    <td>mm. (7-11)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">peak A&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['peaka'];?></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">Pws&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['pws'];?></div></td>
                    <td>mm. (11-17)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">E/A&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ea'];?></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">FS&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['fs'];?></div></td>
                    <td>% (25-44)</td>
                    
                    <td>&nbsp;</td>
                    <td align="right">DT&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['dt'];?></div></td>
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
                    <td style="width:96px;" align="center"><div class="setUnderline"><?=$a['ms'];?></div></td>
                    <td>&nbsp;</td>

                    <td align="right" width="16%">MnGRAD&nbsp;</td>
                    <td style="width:96px;" align="center"><div class="setUnderline"><?=$a['ms_mngrad'];?></div></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MVA(PHT)&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ms_mvapht'];?></div></td>
                    <td>cm<sup>2</sup></td>

                    <td align="right">MVA(2-D)&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ms_mva2d'];?></div></td>
                    <td>cm<sup>2</sup></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MR&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ms_mr'];?></div></td>
                    <td>mmHg</td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>2.</td>
                    <td align="right">AS&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['as'];?></div></td>
                    <td>&nbsp;</td>

                    <td align="right">PGRAD&nbsp;</td>
                    <td  align="center"><div class="setUnderline"><?=$a['as_pgrad'];?></div></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MnGRAD&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['as_mngrad'];?></div></td>
                    <td>mmHg</td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">AR&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['as_ar'];?></div></td>
                    <td></td>
                    
                    <td align="right">AI PHT&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['as_aipht'];?></div></td>
                    <td>ms.</td>
                </tr>

                <tr>
                    <td>3.</td>
                    <td align="right">PS&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ps'];?></div></td>
                    <td>&nbsp;</td>

                    <td align="right">PGRAD&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ps_pgrad'];?></div></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">MnGRAD&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ps_mngrad'];?></div></td>
                    <td>mmHg</td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">PR&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ps_pr'];?></div></td>
                    <td>&nbsp;</td>
                    
                    <td align="right">PGRAD&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ps_pr_pgrad'];?></div></td>
                    <td>mmHg</td>
                </tr>
                
                <tr>
                    <td>4.</td>
                    <td align="right">TS&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ts'];?></div></td>
                    <td>&nbsp;</td>

                    <td align="right">MnGRAD&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ts_mngrad'];?></div></td>
                    <td>mmHg</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">TVA(PHT)&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ts_tvapht'];?></div></td>
                    <td>cm<sup>2</sup></td>

                    <td align="right">TVA(2-D)&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ts_tva2d'];?></div></td>
                    <td>cm<sup>2</sup></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right">TR&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ts_tr'];?></div></td>
                    <td>&nbsp;</td>
                    
                    <td align="right">RVSP&nbsp;</td>
                    <td align="center"><div class="setUnderline"><?=$a['ts_rvsp'];?></div></td>
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
                    <td><?=nl2br($a['cardio_finding']);?></td>
                </tr>
                <tr>
                    <td><br>DIAGNOSIS: <b style="font-size: 20px;"><?=$a['diag'];?></b></td>
                </tr>
                <tr>
                    <td align="right">
                        <br>
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
    <?php 
    if(empty($_GET['print'])){
    ?>
    window.onload = function(){
        window.print();
    }
    <?php
    }
    ?>
    
</script>
<?php 
}else{
    ?><p>ไม่พบข้อมูล</p><?php
}