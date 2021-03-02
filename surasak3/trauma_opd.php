<?php 

include("connect.inc");

if(isset($_GET["action"]) && $_GET["action"] =="confirm_inj")
{
    //header("content-type: application/x-javascript; charset=TIS-620");
    
    $sql = "Select CONCAT(yot,' ',name,' ',surname) as full_name, ptright, dbirth From opcard where hn = '".$_GET["hn"]."' limit 1 ";
    list($ptname,$ptright, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));

    echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
    <TR>
    <TD>
    <table width=\"100%\" border=\"0\" align=\"center\">
    <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
    <td >ยืนยันการฉีดยา</td>
    </tr>
    <tr>
    <td >";

    if($ptname != "")
    {
        echo "HN : ".$_GET["hn"]."<BR>";
        echo "ชื่อ-สกุล : ".$ptname."<BR>";
        echo "สิทธิ์ : ".$ptright."<BR>";
    
        $sql = "CREATE TEMPORARY TABLE drugrx_now  Select  right(date,8) as time2, date,  slcode, tradname, drugcode, drug_inject_slip, drug_inject_amount, drug_inject_type, drug_inject_etc, row_id, amount From drugrx  where date like '".((date("Y")+543).date("-m-d"))."%' AND hn = '".$_GET["hn"]."' AND left(drugcode,1) in ('2','0')  AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9') AND drugcode not in ('2SYNV*@','2GOON','2HYRU') AND (an is null OR an = '' ) ";
        $result = Mysql_Query($sql) or die(Mysql_Error());

        $sql = "Select date ,  slcode, tradname, drugcode, drug_inject_slip, drug_inject_amount, drug_inject_type, drug_inject_etc, row_id, amount From drugrx_now group by drugcode, slcode Having sum(amount) > 0 ";
        //echo $sql;
    
        $result = Mysql_Query($sql) or die(Mysql_Error());
        while(list(   $date,  $slcode, $tradname, $drugcode, $drug_inject_slip, $drug_inject_amount, $drug_inject_type, $drug_inject_etc, $row_id, $amount) = Mysql_fetch_row($result))
        {
            
            $IV="";
            $IM="";
            $SC="";
            $drug_inject_slip = substr($drug_inject_slip,8);
            switch($drug_inject_slip)
            {
                case "IV": $IV="Selected"; break;
                case "IM": $IM="Selected"; break;
                case "V": $IV="Selected"; break;
                case "M": $IM="Selected"; break;
                case "SC": $SC="Selected"; break;
            }
            
            echo "<B>ยา </B>".$tradname;

            echo "&nbsp;&nbsp;<B>เข็มที่</B> 
                <SELECT NAME=\"number[]\">
                    <Option value=\"1\" >1</Option>
                    <Option value=\"2\" >2</Option>
                    <Option value=\"3\" >3</Option>
                    <Option value=\"4\" >4</Option>
                    <Option value=\"5\" >5</Option>
                </SELECT>";

            echo "&nbsp;&nbsp;<B>วิธีฉีด</B> 
                <SELECT NAME=\"type[]\">
                    <Option value=\"V\" ".$IV.">V</Option>
                    <Option value=\"M\" ".$IM.">M</Option>
                    <Option value=\"SC\" ".$SC.">SC</Option>
                    <Option value=\"NO\" >ไม่นับ</Option>
                </SELECT>";
            echo "<BR><BR>";

            $sql = "Select unit From druglst where drugcode = '".$drugcode."' limit 1 ";
            list($unit) = mysql_fetch_row(mysql_query($sql));

            echo "&nbsp;&nbsp;<B>จำนวนที่ฉีด</B> : ".$drug_inject_amount;
            echo "&nbsp;&nbsp;<B>ฉีดแบบ</B> : ".$drug_inject_type;
            echo "&nbsp;&nbsp;<B>จำนวนที่สั่ง</B> : ".$amount." ".$unit;
            echo "&nbsp;&nbsp;<B>อื่นๆ</B> : ".$drug_inject_etc;
            echo "<HR><BR><INPUT TYPE=\"hidden\" value=\"".$date."\" name=\"date[]\">";
            
            echo "<INPUT TYPE=\"hidden\" value=\"".$drugcode."\" name=\"drugcode[]\">";
            echo "<INPUT TYPE=\"hidden\" value=\"".$tradname."\" name=\"tradname[]\">";

        }

        echo "<INPUT TYPE=\"hidden\" value=\"".$_GET["hn"]."\" name=\"hn\">";
        echo "<INPUT TYPE=\"hidden\" value=\"".$ptname."\" name=\"ptname\">";
        echo "<INPUT TYPE=\"hidden\" value=\"".$dbirth."\" name=\"dbirth\">";
        echo "<INPUT TYPE=\"hidden\" value=\"".$ptright."\" name=\"ptright\">";

        if($_SESSION['smenucode']=="ADMMAINOPD")
        {
            ?>
            <label for="isOpd">
                <input type="checkbox" name="isOpd" id="isOpd" value="1" checked="checked"> OPDฉีดยา 
            </label>
            <?php
        }
        $submit_button = "<INPUT TYPE=\"submit\" value=\" ตกลง \" >";
    }
    else
    {
        echo "ไม่มีหมายเลข HN : ".$_GET["hn"]."";
        $submit_button = "";
    }

    echo "</td>
    </tr>
    <tr>
    <td >
    ".$submit_button."&nbsp;<INPUT TYPE=\"button\" value=\"ยกเลิก\" onclick=\"view_confirm_inj('reconfirm_inj',document.form_confirn_inject.hn.value);\">
    </td>
    </tr>
    </table>
    </TD>
    </TR>
    </TABLE>
    <INPUT TYPE=\"hidden\" name=\"hn\" value=\"".$_GET["hn"]."\">";
    exit();
}

if(isset($_GET["action"]) && $_GET["action"] =="confirm_ds")
{
    //header("content-type: application/x-javascript; charset=TIS-620");
    
    $sql = "Select CONCAT(yot,' ',name,' ',surname) as full_name, ptright, dbirth From opcard where hn = '".$_GET["hn"]."' limit 1 ";
    list($ptname,$ptright, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));

    echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
                <TR>
                    <TD>
                        <table width=\"100%\" border=\"0\" align=\"center\">
                      <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
                        <td >ยืนยันการทำแผล</td>
                      </tr>
                      <tr>
                        <td >";

                        if($ptname != "")
                        {
                            echo "HN : ".$_GET["hn"]."<BR>";
                            echo "ชื่อ-สกุล : ".$ptname."<BR>";
                            echo "สิทธิ์ : ".$ptright."<br>";
                            if($_SESSION['smenucode']=="ADMMAINOPD")
                            {
                                ?>
                                <label for="isOpd">
                                    <input type="checkbox" name="isOpd" id="isOpd" value="1" checked="checked"> OPDทำแผล
                                </label>
                                <br>
                                <?php
                            }
                            $submit_button = "<INPUT TYPE=\"submit\" value=\" ตกลง \" >";
                        }else{
                            echo "ไม่มีหมายเลข HN : ".$_GET["hn"]."";
                            $submit_button = "";
                        }

        echo "
                        </td>
                      </tr>
                      <tr>
                        <td >
                        ".$submit_button."&nbsp;<INPUT TYPE=\"button\" value=\"ยกเลิก\" onclick=\"view_confirm_ds('reconfirm_ds',document.form_confirn_ds.hn.value);\">
                        </td>
                      </tr>
                      </table>
                      </TD>
                </TR>
                </TABLE>
                <INPUT TYPE=\"hidden\" name=\"hn\" value=\"".$_GET["hn"]."\">
    ";
    exit();
}

if(isset($_GET["action"]) && $_GET["action"] =="reconfirm_inj")
{
    //header("content-type: application/x-javascript; charset=TIS-620");
    


    echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
                <TR>
                    <TD>
                        <table width=\"100%\" border=\"0\" align=\"center\">
                      <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
                        <td >ยืนยันการฉีดยา</td>
                      </tr>
                      <tr>
                        <td >
                            HN : <INPUT TYPE=\"text\" NAME=\"hn\" id=\"form_confirn_inject_hn\">
                        </td>
                      </tr>
                      <tr>
                        <td >
                        <INPUT TYPE=\"button\" value=\" ตกลง \" onclick=\"view_confirm_inj('confirm_inj',document.getElementById('form_confirn_inject_hn').value);\">
                        </td>
                      </tr>
                      </table>
                      </TD>
                </TR>
                </TABLE>
    ";
    exit();
}

if(isset($_GET["action"]) && $_GET["action"] =="reconfirm_ds")
{
    //header("content-type: application/x-javascript; charset=TIS-620");
    
    echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
                <TR>
                    <TD>
                        <table width=\"100%\" border=\"0\" align=\"center\">
                      <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
                        <td >ยืนยันการทำแผล</td>
                      </tr>
                      <tr>
                        <td >
                            HN : <INPUT TYPE=\"text\" NAME=\"hn\">
                        </td>
                      </tr>
                      <tr>
                        <td >
                        <INPUT TYPE=\"button\" value=\" ตกลง \" onclick=\"view_confirm_ds('confirm_ds',document.form_confirn_ds.hn.value);\">
                        </td>
                      </tr>
                      </table>
                      </TD>
                </TR>
                </TABLE>
    ";
    exit();
}

?>

<div>
    <ul>
        <li><a href="../nindex.htm">&lt;&lt;&nbsp;เมนู</a></li>
        <li><a href="confirn_ds.php">ยืนยันการทำแผล</a></li>
        <li><a href="confirn_inject.php">ยืนยันการฉีดยา</a></li>
        <li><a href="concisely_trun.php">รายงานสรุปยอดเวร</a></li>
    </ul>
</div>
<div style="width:80%; margin:0;padding:0;">

<FORM name="form_confirn_inject" METHOD=POST ACTION="confirn_inject2.php" onSubmit=" rediv('inj')" target="_blank">
    <DIV ID="Div_Confirm_inject">
        <TABLE  width="100%"  border="1" bordercolor="#3366FF">
            <TR>
                <TD>
                    <table width="100%" border="0" align="center">
                        <tr align="center" bgcolor="#3366FF" class="font_title">
                            <td >ยืนยันการฉีดยา</td>
                        </tr>
                        <tr>
                            <td >
                                HN : <INPUT TYPE="text" NAME="hn">
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <INPUT TYPE="button" value=" ตกลง " onClick="view_confirm_inj('confirm_inj',document.form_confirn_inject.hn.value);">
                            </td>
                        </tr>
                    </table>
                </TD>
            </TR>
        </TABLE>
    </Div>
</FORM>
<FORM name="form_confirn_ds" METHOD=POST ACTION="confirn_ds2.php" onSubmit=" rediv('ds')" target="_blank" >
    <Div ID="Div_Confirm_ds">
        <TABLE  width="100%"  border="1" bordercolor="#3366FF">
            <TR>
                <TD>
                    <table width="100%" border="0" align="center">
                        <tr align="center" bgcolor="#3366FF" class="font_title">
                            <td >ยืนยันการทำแผล</td>
                        </tr>
                        <tr>
                            <td >
                                HN : <INPUT TYPE="text" NAME="hn">
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <INPUT TYPE="button" value=" ตกลง " onClick="view_confirm_ds('confirm_ds',document.form_confirn_ds.hn.value);">
                            </td>
                        </tr>
                    </table>
                </TD>
            </TR>
        </TABLE>
    </DIV>
</FORM>
</div>
<script type="text/javascript">
function newXmlHttp(){
	var xmlhttp = false;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(e){
            xmlhttp = false;
        }
    }
    if(!xmlhttp && document.createElement){
        xmlhttp = new XMLHttpRequest();
    }
	return xmlhttp;
}

function view_confirm_inj(action,hn) {
    url = 'trauma_opd.php?action='+action+'&hn=' + hn;
    xmlhttp = newXmlHttp();
    xmlhttp.open("GET", url, false);
    xmlhttp.send(null);
    document.getElementById("Div_Confirm_inject").innerHTML = xmlhttp.responseText;
}

function view_confirm_ds(action,hn) {
    url = 'trauma_opd.php?action='+action+'&hn=' + hn;
    xmlhttp = newXmlHttp();
    xmlhttp.open("GET", url, false);
    xmlhttp.send(null);
    document.getElementById("Div_Confirm_ds").innerHTML = xmlhttp.responseText;
}

function rediv(xx){
	if(xx == "inj"){
		setTimeout("view_confirm_inj('reconfirm_inj','');",3000);
	}else if(xx == "ds"){
		setTimeout("view_confirm_ds('reconfirm_ds','');",3000);
	}

}

</script>