<?php 

include 'bootstrap.php';

include 'dt_menu.php';
include 'dt_patient.php';


?>
<style>
    *{
        /* font-family: "TH SarabunPSK"; */
        /* font-size: 16px; */
    }
    h3{
        /* font-weight: bold; */
        /* font-size: 20px; */
        margin: 0;
        padding: 0;
    }

body,td,th {
	font-family: Angsana New;
	font-size: 22px;
}

.tb_head {background-color: #2E86C1; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_detail3 {background-color: #F9E79F;  }
.tb_menu {background-color: #FFFFC1;  }

.echo_table{
    border-collapse: collapse;
}
.echo_table tr,
.echo_table td{
    margin:0;
    padding:0;
}

</style>
<br>
<form action="echo.php" method="post">
    <table class="echo_table" width="100%">
        <tr>
            <td class="tb_head" colspan="2" style="text-shadow: black 0.1em 0.1em 0.2em; background-color: #309f55;">ECHOCARDIOGRAPHY</td>
        </tr>
        <!--
        <tr>
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td align="center" width="30%">
                            <br>
                            <h3>โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3>
                            <h3>ECHOCARDIOGRAPHY REPORT</h3>
                            <br>
                        </td>
                        <td valign="top" width="70%">
                            <table width="100%" >
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
        -->
        <tr>
            <td valign="top" width="50%">
                <table width="100%" class="echo_table" style="margin-top: 8px;">
                    <tr>
                        <td colspan="8">Echo No. <input type="text" name="" id=""></td>
                    </tr>
                    <tr>
                        <td colspan="8" class="tb_head" style="text-shadow: black 2px 2px 8px;"><u>MEASUREMENT</u></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">Ao&nbsp;</td>
                        <td style="width:96px;"><input type="text" name="ao" id="ao" size="8"></td>
                        <td>mm. (20-32)</td>

                        <td>&nbsp;</td>
                        <td align="right">LVEDV&nbsp;</td>
                        <td style="width:96px;"><input type="text" name="lvedv" id="lvedv" size="8"></td>
                        <td>ml. (90-140)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">LA&nbsp;</td>
                        <td><input type="text" name="la" id="la" size="8"></td>
                        <td>mm. (18-40)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">LVESV&nbsp;</td>
                        <td><input type="text" name="lvesv" id="lvesv" size="8"></td>
                        <td>ml. (27-95)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">IVSd&nbsp;</td>
                        <td><input type="text" name="ivsd" id="ivsd" size="8"></td>
                        <td>mm. (6-11)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">SV&nbsp;</td>
                        <td><input type="text" name="sv" id="sv" size="8"></td>
                        <td>ml. (50-100)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">IVSs&nbsp;</td>
                        <td><input type="text" name="ivss" id="ivss" size="8"></td>
                        <td>mm. (9-16)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">CO&nbsp;</td>
                        <td><input type="text" name="co" id="co" size="8"></td>
                        <td>L/min</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">LVDd&nbsp;</td>
                        <td><input type="text" name="lvdd" id="lvdd" size="8"></td>
                        <td>mm. (37-55)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">EF&nbsp;</td>
                        <td><input type="text" name="ed" id="ed" size="8"></td>
                        <td>% (50-80)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">LVDs&nbsp;</td>
                        <td><input type="text" name="lvds" id="lvds" size="8"></td>
                        <td>mm. (22-45)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">peak E&nbsp;</td>
                        <td><input type="text" name="peake" id="peake" size="8"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">Pwd&nbsp;</td>
                        <td><input type="text" name="pwd" id="pwd" size="8"></td>
                        <td>mm. (7-11)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">peak A&nbsp;</td>
                        <td><input type="text" name="peaka" id="peaka" size="8"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">Pws&nbsp;</td>
                        <td><input type="text" name="pws" id="pws" size="8"></td>
                        <td>mm. (11-17)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">E/A&nbsp;</td>
                        <td><input type="text" name="ea" id="ea" size="8"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">FS&nbsp;</td>
                        <td><input type="text" name="fs" id="fs" size="8"></td>
                        <td>% (25-44)</td>
                        
                        <td>&nbsp;</td>
                        <td align="right">DT&nbsp;</td>
                        <td><input type="text" name="dt" id="dt" size="8"></td>
                        <td></td>
                    </tr>
                </table>
                <table width="100%" class="echo_table" style="margin-top: 8px;">
                    <tr>
                        <td colspan="7" class="tb_head" style="text-shadow: black 2px 2px 8px;"><u>DOPPLER</u></td>
                    </tr>
                    <tr style="background-color: #D4EFDF;">
                        <td>1.</td>
                        <td align="right">MS&nbsp;</td>
                        <td style="width:96px;"><input type="text" name="ms" id="ms" size="8"></td>
                        <td>&nbsp;</td>

                        <td align="right">MnGRAD&nbsp;</td>
                        <td style="width:96px;"><input type="text" name="ms_mngrad" id="ms_mngrad" size="8"></td>
                        <td>mmHg</td>
                    </tr>
                    <tr style="background-color: #D4EFDF;">
                        <td>&nbsp;</td>
                        <td align="right">MVA(PHT)&nbsp;</td>
                        <td><input type="text" name="ms_mvapht" id="ms_mvapht" size="8"></td>
                        <td>cm<sup>2</sup></td>

                        <td align="right">MVA(2-D)&nbsp;</td>
                        <td><input type="text" name="ms_mva2d" id="ms_mva2d" size="8"></td>
                        <td>cm<sup>2</sup></td>
                    </tr>
                    <tr style="background-color: #D4EFDF;">
                        <td>&nbsp;</td>
                        <td align="right">MR&nbsp;</td>
                        <td><input type="text" name="ms_mr" id="ms_mr" size="8"></td>
                        <td>mmHg</td>

                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>2.</td>
                        <td align="right">AS&nbsp;</td>
                        <td><input type="text" name="as" id="as" size="8"></td>
                        <td>&nbsp;</td>

                        <td align="right">PGRAD&nbsp;</td>
                        <td><input type="text" name="as_pgrad" id="as_pgrad" size="8"></td>
                        <td>mmHg</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">MnGRAD&nbsp;</td>
                        <td><input type="text" name="as_mngrad" id="as_mngrad" size="8"></td>
                        <td>mmHg</td>

                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">AR&nbsp;</td>
                        <td><input type="text" name="as_ar" id="as_ar" size="8"></td>
                        <td></td>
                        
                        <td align="right">AI PHT&nbsp;</td>
                        <td><input type="text" name="as_aipht" id="as_aipht" size="8"></td>
                        <td>ms.</td>
                    </tr>

                    <tr style="background-color: #D4EFDF;">
                        <td>3.</td>
                        <td align="right">PS&nbsp;</td>
                        <td><input type="text" name="ps" id="ps" size="8"></td>
                        <td>&nbsp;</td>

                        <td align="right">PGRAD&nbsp;</td>
                        <td><input type="text" name="ps_pgrad" id="ps_pgrad" size="8"></td>
                        <td>mmHg</td>
                    </tr>
                    <tr style="background-color: #D4EFDF;">
                        <td>&nbsp;</td>
                        <td align="right">MnGRAD&nbsp;</td>
                        <td><input type="text" name="ps_mngrad" id="ps_mngrad" size="8"></td>
                        <td>mmHg</td>

                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr style="background-color: #D4EFDF;">
                        <td>&nbsp;</td>
                        <td align="right">PR&nbsp;</td>
                        <td><input type="text" name="ps_pr" id="ps_pr" size="8"></td>
                        <td>&nbsp;</td>
                        
                        <td align="right">PGRAD&nbsp;</td>
                        <td><input type="text" name="ps_pgrad" id="ps_pgrad" size="8"></td>
                        <td>mmHg</td>
                    </tr>
                    
                    <tr>
                        <td>4.</td>
                        <td align="right">TS&nbsp;</td>
                        <td><input type="text" name="ts" id="ts" size="8"></td>
                        <td>&nbsp;</td>

                        <td align="right">MnGRAD&nbsp;</td>
                        <td><input type="text" name="ts_mngrad" id="ts_mngrad" size="8"></td>
                        <td>mmHg</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">TVA(PHT)&nbsp;</td>
                        <td><input type="text" name="ts_tvapht" id="ts_tvapht" size="8"></td>
                        <td>cm<sup>2</sup></td>

                        <td align="right">TVA(2-D)&nbsp;</td>
                        <td><input type="text" name="ts_tva2d" id="ts_tva2d" size="8"></td>
                        <td>cm<sup>2</sup></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="right">TR&nbsp;</td>
                        <td><input type="text" name="ts_tr" id="ts_tr" size="8"></td>
                        <td>&nbsp;</td>
                        
                        <td align="right">RVSP&nbsp;</td>
                        <td><input type="text" name="ts_rvsp" id="ts_rvsp" size="8"></td>
                        <td>mmHg</td>
                    </tr>
                </table>
            </td>
            <td valign="top" width="50%">
                <table width="100%" class="echo_table" style="margin-top: 8px;">
                    <tr>
                        <td class="tb_head" style="text-shadow: black 2px 2px 8px;"><u>ECHOCARDIOGRAPHIC FINDING :</u></td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="cardio_finding" id="cardio_finding" cols="30" rows="10" style="width: 100%; margin-top:4px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="tb_head" style="text-shadow: black 2px 2px 8px;"><u>DIAGNOSIS :</u></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="diag" id="diag" style="width: 100%; padding: 4px; margin-top:4px;" value="Good MV prosthetic value and LV function">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <button type="submit" style="padding: 4px 12px;">บันทึก</button>
            </td>
        </tr>
    </table>
</form>