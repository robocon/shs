<?php
session_start();
session_unregister("cHn");
session_unregister("cPtname");
session_unregister("cPtright");
session_unregister("nVn");
session_unregister("cAge");
session_unregister("nRunno");
session_unregister("vAN");
session_unregister("thdatehn");
session_unregister("cNote");
session_unregister("Ptright1");
//    session_destroy();
?>

<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>

<form method="post" action="ophn.php">
    <p>ค้นหาคนไข้จาก&nbsp; HN</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="hn" size="12" id="aLink"></p>
    
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>

<table>
    <tr>
        <th height="22" bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED width="70">ยศ</th>
        <th bgcolor=6495ED>ชื่อ</th>

        <th bgcolor=6495ED>สกุล</th>
        <th bgcolor=6495ED>ใบต่อแบบใหม่</th>
        <th bgcolor=6495ED>มา รพ.</th>
        <th bgcolor=6495ED>ตรวจนอน</th>
        <th bgcolor=6495ED>ใบต่อ</th>
        <!-- <th bgcolor=6495ED>ใบยานอก</th>
        <th bgcolor=6495ED>ใบสั่งยา</th>
        <th bgcolor=6495ED>ใบตรวจโรค</th>-->
        <th bgcolor=6495ED colspan="5">ใบตรวจโรค</th>
        <th bgcolor="6495ED">&nbsp;</th>
    </tr>

    <?php
    If (!empty($hn)){
        include("connect.inc");
        global $hn;
        $query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '$hn'";
        $result = mysql_query($query)or die("Query failed");
        while (list ($hn,$yot,$name,$surname,$ptright,$ptright1,$idcard) = mysql_fetch_row ($result)) {

            if(substr($ptright,0,3)=='R07' && !empty($idcard)){
                $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    $color = "#CCFF00";
                }else{
                    $color = "FF8C8C";
                }
            }else if(substr($ptright,0,3)=='R03'){
                $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    $color = "99CC00";
                }else{
                    $color = "FF8C8C";
                }
            }else{
                $color = "66CDAA";
            }

            if(!empty($idcard)){
                $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิประกันสังคม</FONT>";
                }else{
                    echo"";
                }
            }else{
                echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มีเลขประจำตัวประชาชน</FONT>";
                ?>
                <script type="text/javascript">
                alert('ผู้ป่วยไม่มีเลขประจำตัวประชาชน');
                </script>
                <?php
            }

            if(!empty($hn)){
                $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิจ่ายตรง</FONT>";
                }else{
                    echo"";
                }
            }else{
                echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มี HN</FONT>";
            }

            print (" <tr>\n".
            "  <td BGCOLOR=".$color."><a target=_BLANK onclick=\"checkIpd(this, event, '$hn')\" href=\"opedit.php? cHn=$hn & cName=$name &cSurname=$surname\">$hn</a></td>\n".
            "  <td BGCOLOR=".$color.">$yot</td>\n".
            "  <td BGCOLOR=".$color.">$name</td>\n".
            "  <td BGCOLOR=".$color.">$surname</td>\n".
            "  <td BGCOLOR=".$color."><a target=_BLANK  href=\"opdcard_opregis.php?cHn=$hn\">$ptright</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">มา รพ.</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</a></td>\n".
            // "  <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน</td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"opdprint2.php?cHn=$hn\">ใบต่อ</a></td>\n".
            /*"  <td BGCOLOR=".$color."><a target= _BLANK href=\"edprint.php?cHn=$hn\">ใบยานอก</td>\n".
            "  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">ผู้ป่วยนัด</td>\n".
            "  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint1.php?cHn=$hn\">ใบตรวจโรค</td>\n".*/
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointhdvn.php?cHn=$hn\">ไต</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointdenvn.php?cHn=$hn\">ฟัน</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointeyevn.php?cHn=$hn\">ตา</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointbgvn.php?cHn=$hn\">สูติ</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">ผป.นัด</a></td>\n".
            "<td bgcolor=\"$color\" align=\"center\"><button type=\"button\" onclick=\"checkPtRight(this, event, '$idcard')\">ทดสอบตรวจสอบสิทธิ</button></td>".
            " </tr>\n");

            $_SESSION['hn'] = $hn;
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;

        }

        $sql1="SELECT  * FROM opcard
        where name='".$_SESSION['name']."' and surname='".$_SESSION['surname']."' and hn !='". $_SESSION['hn']."' ";
        $result1 = mysql_query($sql1);
        $rows1=mysql_num_rows($result1);
        if($rows1){
            echo "<font color='#FF0000'>ซ้ำ</font>";
        }

        // ตรวจสอบและเปลี่ยน HN AN ตอนขึ้นปีใหม่
        $sql = "Select left(prefix,2) From runno where title = 'HN' ";
        list($title_hn) = Mysql_fetch_row(Mysql_Query($sql));
        $year_now = substr(date("Y")+543,2);
        if($title_hn != $year_now){
            $sql = "Update runno set prefix = '".$year_now."-', runno = 0 where  title = 'HN' limit 1;";
            $result = mysql_Query($sql);
        }
        
        $sql = "Select left(prefix,2) From runno where title = 'AN' ";
        list($title_an) = Mysql_fetch_row(Mysql_Query($sql));
        $year_now = substr(date("Y")+543,2);
        if($title_an != $year_now){
            $sql = "Update runno set prefix = '".$year_now."/', runno = 0 where  title = 'AN' limit 1;";
            $result = mysql_Query($sql);
        }
        // END
        ?>
</table>

    <FONT SIZE="2" COLOR="#990000">***คำอธิบาย***</FONT> <BR>
    <FONT SIZE="" COLOR="66CDAA">สีเขียว คือ ยังไม่ได้ทำการตรวจสิทธิการรักษา</FONT><BR>
    <FONT SIZE="" COLOR="#CCFF00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิประกันสังคม</FONT><BR>
    <FONT SIZE="" COLOR="#99CC00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิจ่ายตรง</FONT><BR>
    <FONT SIZE="" COLOR="#FF0033">สีแดง คือ ไม่มีสิทธิ</FONT><BR>

    <hr />

    <?php 

    $alert_msg = null;
    $hn = isset($_POST['hn']) ? $_POST['hn'] : null ;
    if($hn !== null){

        $query = mysql_query("select * from ipcard where hn='$hn' and ( dcdate='0000-00-00 00:00:00' AND bedcode <> '' ) ");
        if (mysql_num_rows($query) > 0) {
            $item = mysql_fetch_assoc($query);
            $alert_msg = "ผู้ป่วยรายนี้ยังAdmit อยู่ที่".$item['my_ward'];
            echo "<script>alert('".$alert_msg."');</script>";
        }
        
    }

    if (!empty($alert_msg)) {
        ?>
        <h2 style="color: red;"><u>!!! <?=$alert_msg;?> !!!</u></h2>
        <?php
    }
    ?>
    <?php
    /////////////
    $sql_chkname="SELECT  * FROM opcard
    where name='".$_SESSION['name']."' and surname='".$_SESSION['surname']."' and hn !='". $_SESSION['hn']."'  limit 5";
    $result_chkname = mysql_query($sql_chkname);
    $rows=mysql_num_rows($result_chkname);

    if($rows){
        ?>
        <h2><font color="#FF0000">คำเตือน</font></h2>
        <h3>มีผู้ป่วย ขื่อ  <?= $_SESSION['name']?> <?=$_SESSION['surname'];?>  ซ้ำ ในระบบทะเบียน</h3>
        <h3>กรุณาตรวจสอบผู้ป่วย</h3>
        <table>
            <tr>
                <th bgcolor=6495ED>HN</th>
                <th bgcolor=6495ED>ยศ</th>
                <th bgcolor=6495ED>ชื่อ</th>
                <th bgcolor=6495ED>สกุล</th>
                <th bgcolor=6495ED>สิทธิ</th>
                <th bgcolor=6495ED>มา รพ.</th>
                <th bgcolor=6495ED>ตรวจนอน</th>
                <th bgcolor=6495ED>ใบต่อ</th>
                <th bgcolor=6495ED>ใบยานอก</th>
                <th bgcolor=6495ED>ใบสั่งยา</th>
                <th bgcolor=6495ED>ใบตรวจโรค</th>
            </tr>
            <?
            while($dbarr= mysql_fetch_array($result_chkname)){

                print (" <tr>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\"  href=\"opedit.php?cHn=".$dbarr['hn']."&cName=".$dbarr['name']."&cSurname=".$dbarr['surname']."\">".$dbarr['hn']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['yot']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['name']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['surname']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['ptright']."</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"hndaycheck.php?hn=".$dbarr['hn']."\">มา รพ.</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"appdaycheck.php?hn=".$dbarr['hn']."\">ตรวจนัด</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"opdprint2.php?cHn=".$dbarr['hn']."\">ใบต่อ</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"edprint.php?cHn=".$dbarr['hn']."\">ใบยานอก</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"rg_appoint.php?cHn=".$dbarr['hn']."\">ผู้ป่วยนัด</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"rg_appoint1.php?cHn=".$dbarr['hn']."\">ใบตรวจโรค</a></td>\n".
                " </tr>\n");
            }
            ?>
            </table>
            <?php 
        }
        session_unregister("hn");
        session_unregister("name");
        session_unregister("surname");

        include("unconnect.inc");
    } // End if not empty HN
?>

<script type="text/javascript">
    /* checkIpd */
    function checkIpd(link, ev, hn){
        // SmPreventDefault(ev);
        // var href = this.href;
        var newSm = new SmHttp();
        newSm.ajax(
            'templates/regis/checkIpd.php',
            { id: hn },
            function(res){
                var txt = JSON.parse(res);
                if( txt.state === 400 ){
                    alert('สถานะของผู้ป่วยยังอยู่ '+txt.msg+' กรุณาติดต่อที่ Ward เพื่อ Discharge');
                    SmPreventDefault(ev);
                }else{
                    // window.open(link.href, '_blank');
                }
            },
            false // true is Syncronous and false is Assyncronous (Default by true)
        );
        
    }

    /*
    ระบบเช็กสิทธออนไลน์ผ่าน ucAuthen4.x ถ้าใน IE มีปัญหาสามารถแก้ไขได้โดยเข้าไปที่
    Internet Options > Security > Internet > Custom level... 
    ที่เมนู Miscellaneous 
    1. Access data sources across domains เปิด Enable
    2. Allow META REFRESH เปิด Enable
    3. Allow scripting of Microsoft web browser control เปิด Enable
    */
    function checkPtRight(link, ev, hn){
        var newSm = new SmHttp();
        newSm.ajax(
            'http://192.168.143.126/index.php',
            { "hn": hn },
            function(res){
                var txt = JSON.parse(res);
                if (txt.ws_status === "NHSO-00003") {
                    alertTxt = txt.ws_status_desc+"\nกรุณาเปิดใช้งานโปรแกรม nhsoauthen4.x ก่อนการใช้งานตรวจสอบสิทธิออนไลน์";

                }else{
                
                    var subInScl, hMain, hMainOp, hSub, mainInScl, alertTxt = '';

                    if( txt.maininscl !== undefined ){
                        if( txt.maininscl_name !== undefined ){
                            alertTxt += "สิทธิหลักในการรับบริการ : "+txt.maininscl+" "+txt.maininscl_name+"\n";
                        }

                        if( txt.subinscl_name !== undefined){
                            alertTxt += "ประเภทสิทธิย่อย : "+txt.subinscl+" "+txt.subinscl_name+"\n";
                        }

                        if( txt.hmain_op_name !== undefined){
                            alertTxt += "หน่วยบริการประจำ : "+txt.hmain_op+" "+txt.hmain_op_name+"\n";
                        } 
                    
                        if( txt.hmain_name !== undefined){
                            alertTxt += "หน่วยบริการที่รับส่ง : "+txt.hmain+" "+txt.hmain_name+"\n";
                        } 

                        if( txt.hsub_name !== undefined){
                            alertTxt += "หน่วยบริการปฐมภูมิ : "+txt.hsub+" "+txt.hsub_name+"\n";
                        } 
                    }else if( txt.new_maininscl !== undefined ){
                        if( txt.new_maininscl_name !== undefined ){
                            alertTxt += "สิทธิหลักในการรับบริการ : "+txt.new_maininscl+" "+txt.new_maininscl_name+"\n";
                        }

                        if( txt.new_subinscl_name !== undefined){
                            alertTxt += "ประเภทสิทธิย่อย : "+txt.new_subinscl+" "+txt.new_subinscl_name+"\n";
                        }

                        if( txt.new_hmain_op_name !== undefined){
                            alertTxt += "หน่วยบริการประจำ : "+txt.new_hmain_op+" "+txt.new_hmain_op_name+"\n";
                        } 
                    
                        if( txt.new_hmain_name !== undefined){
                            alertTxt += "หน่วยบริการที่รับส่ง : "+txt.new_hmain+" "+txt.new_hmain_name+"\n";
                        } 

                        if( txt.new_hsub_name !== undefined){
                            alertTxt += "หน่วยบริการปฐมภูมิ : "+txt.new_hsub+" "+txt.new_hsub_name+"\n";
                        } 
                    }
                    

                }
                
                alert(alertTxt);
            },
            false // true is Syncronous and false is Assyncronous (Default by true)
        );
    }
</script>
