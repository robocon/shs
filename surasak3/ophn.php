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
<style>
body {
	background-color: #FFFFF0;
    font-family: "TH SarabunPSK";
        font-size: 18px;
    }
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 18;
	}
</style>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script><body bgcolor="#60c4b8">
<div style="margin-left:50px; margin-top: 30px;">
<form method="post" action="ophn.php">
    <p style="font-size:24px;"><b>���Ҥ���ҡ&nbsp; HN</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="hn" type="text" class="txtsarabun" id="aLink"  size="50" height="40">
    </p>
    
    <p style="margin-left:100px;">
    <input name="B1" type="submit" class="txtsarabun" value="     ����     ">
    &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="     ¡��ԡ     ">
    </p>
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>

<table width="83%" border="0" cellpadding="10" cellspacing="4" bordercolor="#FFFFFF">
<tr>
        <th width="57" height="22" bgcolor=#009688><span class="style2">HN</span></th>
      <th bgcolor=#009688 width="47"><span class="style2">��</span></th>
      <th width="77" bgcolor=#009688><span class="style2">����</span></th>

      <th width="69" bgcolor=#009688><span class="style2">ʡ��</span></th>
      <th width="174" bgcolor=#009688><span class="style2">㺵��Ẻ����</span></th>
      <th width="98" bgcolor=#009688><span class="style2">�� þ.</span></th>
      <th width="130" bgcolor=#009688><span class="style2">��Ǩ�͹</span></th>
      <th width="81" bgcolor=#009688><span class="style2">㺵��</span></th>
<!-- <th bgcolor=6495ED>��ҹ͡</th>
        <th bgcolor=6495ED>������</th>
        <th bgcolor=6495ED>㺵�Ǩ�ä</th>-->       
        <th bgcolor=#009688 colspan="5"><span class="style2">㺵�Ǩ�ä</span></th>
        <th bgcolor=#009688><span class="style2">���Է��� �.����Թ</span></th>
      <th width="6" bgcolor="#009688">&nbsp;</th>
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
                    $color = "#208eb4";
                }else{
                    $color = "FF8C8C";
                }
            }else if(substr($ptright,0,3)=='R03'){
                $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    $color = "7dcf80";
                }else{
                    $color = "FF8C8C";
                }
            }else{
                $color = "#fdee6e";
            }

            if(!empty($idcard)){
                $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    echo"<FONT SIZE='' COLOR='#FF0033'>���������Է�Ի�Сѹ�ѧ��</FONT>";
                }else{
                    echo"";
                }
            }else{
                echo"<FONT SIZE='' COLOR='#FF0033'>������������Ţ��Шӵ�ǻ�ЪҪ�</FONT>";
                ?>
                <script type="text/javascript">
                alert('������������Ţ��Шӵ�ǻ�ЪҪ�');
                </script>
                <?php
            }

            if(!empty($hn)){
                $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
                if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                    echo"<FONT SIZE='' COLOR='#FF0033'>���������Է�Ԩ��µç</FONT>";
                }else{
                    echo"";
                }
            }else{
                echo"<FONT SIZE='' COLOR='#FF0033'>����������� HN</FONT>";
            }

            print (" <tr style='font-size: 18px;'>\n".
            "  <td BGCOLOR=".$color."><a target=_BLANK onclick=\"checkIpd(this, event, '$hn')\" href=\"opedit.php? cHn=$hn & cName=$name &cSurname=$surname\">$hn</a></td>\n".
            "  <td BGCOLOR=".$color.">$yot</td>\n".
            "  <td BGCOLOR=".$color.">$name</td>\n".
            "  <td BGCOLOR=".$color.">$surname</td>\n".
            "  <td BGCOLOR=".$color."><a target=_BLANK  href=\"opdcard_opregis.php?cHn=$hn\">$ptright</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">�� þ.</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">��Ǩ�Ѵ</a></td>\n".
            // "  <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">��Ǩ�͹</td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"opdprint2.php?cHn=$hn\">㺵��</a></td>\n".
            /*"  <td BGCOLOR=".$color."><a target= _BLANK href=\"edprint.php?cHn=$hn\">��ҹ͡</td>\n".
            "  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">�����¹Ѵ</td>\n".
            "  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint1.php?cHn=$hn\">㺵�Ǩ�ä</td>\n".*/
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointhdvn.php?cHn=$hn\">�</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointdenvn.php?cHn=$hn\">�ѹ</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointeyevn.php?cHn=$hn\">��</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointbgvn.php?cHn=$hn\">�ٵ�</a></td>\n".
            "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">��.�Ѵ</a></td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"gsb_chk.php\">��Ǩ�ͺ</a></td>\n".
            "<td bgcolor=\"$color\" align=\"center\">
            <button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"checkPtRight(this, event, '$idcard')\">��Ǩ�ͺ�Է��</button><br>
            <a target= _BLANK href=\"register_print_qrcode.php?hn=$hn\">����� QR Code</a>
            </td>".
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
            echo "<font color='#FF0000'>���</font>";
        }

        // ��Ǩ�ͺ�������¹ HN AN �͹��鹻�����
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
<div style="margin-top: 30px; font-size:18px; font-weight:bold;">
<FONT COLOR="#990000">***��͸Ժ��***</FONT> <BR>
    <FONT COLOR="#fdee6e">������ͧ ��� �ѧ�����ӡ�õ�Ǩ�Է�ԡ���ѡ��</FONT><BR>
    <FONT COLOR="#208eb4">�չ���Թ ��� ��Ǩ�ͺ���� ���Է�Ի�Сѹ�ѧ��</FONT><BR>
    <FONT COLOR="#7dcf80">������ ��� ��Ǩ�ͺ���� ���Է�Ԩ��µç</FONT><BR>
    <FONT COLOR="#FF0033">��ᴧ ��� ������Է��</FONT><BR>
</div>
<hr />

    <?php 

    $alert_msg = null;
    $hn = isset($_POST['hn']) ? $_POST['hn'] : null ;
    if($hn !== null){

        $query = mysql_query("select * from ipcard where hn='$hn' and ( dcdate='0000-00-00 00:00:00' AND bedcode <> '' ) ");
        if (mysql_num_rows($query) > 0) {
            $item = mysql_fetch_assoc($query);
            $alert_msg = "��������¹���ѧAdmit ������".$item['my_ward'];
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
        <h2><font color="#FF0000">����͹</font></h2>
        <h3>�ռ����� ����  <?= $_SESSION['name']?> <?=$_SESSION['surname'];?>  ��� ��к�����¹</h3>
        <h3>��سҵ�Ǩ�ͺ������</h3>
        <table>
            <tr>
                <th bgcolor=6495ED>HN</th>
                <th bgcolor=6495ED>��</th>
                <th bgcolor=6495ED>����</th>
                <th bgcolor=6495ED>ʡ��</th>
                <th bgcolor=6495ED>�Է��</th>
                <th bgcolor=6495ED>�� þ.</th>
                <th bgcolor=6495ED>��Ǩ�͹</th>
                <th bgcolor=6495ED>㺵��</th>
                <th bgcolor=6495ED>��ҹ͡</th>
                <th bgcolor=6495ED>������</th>
                <th bgcolor=6495ED>㺵�Ǩ�ä</th>
            </tr>
            <?
            while($dbarr= mysql_fetch_array($result_chkname)){

                print (" <tr>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\"  href=\"opedit.php?cHn=".$dbarr['hn']."&cName=".$dbarr['name']."&cSurname=".$dbarr['surname']."\">".$dbarr['hn']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['yot']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['name']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['surname']."</a></td>\n".
                "  <td BGCOLOR=".$color.">".$dbarr['ptright']."</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"hndaycheck.php?hn=".$dbarr['hn']."\">�� þ.</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"appdaycheck.php?hn=".$dbarr['hn']."\">��Ǩ�Ѵ</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"opdprint2.php?cHn=".$dbarr['hn']."\">㺵��</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"edprint.php?cHn=".$dbarr['hn']."\">��ҹ͡</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"rg_appoint.php?cHn=".$dbarr['hn']."\">�����¹Ѵ</a></td>\n".
                "  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"rg_appoint1.php?cHn=".$dbarr['hn']."\">㺵�Ǩ�ä</a></td>\n".
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

<style>
#ptrightNotify{top: 2%;left: 50%;width:600px;height:400px;margin-top: 1em;margin-left: -300px;border: 1px solid #ccc;background-color: #f3f3f3;position:fixed;}
#ptnotifyHeader{padding: 6px;background: #636363;text-align: right;}
#ptrightClose{font-size: 24px;color: #fff;text-decoration: none;}
#ptnotifyContent{padding: 6px;}
</style>
<div id="ptrightNotify" style="display: none;">
    <div id="ptnotifyHeader">
        <a href="javascript:void(0);" id="ptrightClose">Close</a>
    </div>
    <div style="padding: 6px;" id="ptnotifyContent">testcontent</div>
</div>

<script type="text/javascript">
    /* checkIpd */
    function checkIpd(link, ev, hn){
        
        var newSm = new SmHttp();
        newSm.ajax(
            'templates/regis/checkIpd.php',
            { id: hn },
            function(res){
                var txt = JSON.parse(res);
                if( txt.state === 400 ){
                    alert('ʶҹТͧ�������ѧ���� '+txt.msg+' ��سҵԴ��ͷ�� Ward ���� Discharge');
                    SmPreventDefault(ev);
                }else{
                    // window.open(link.href, '_blank');
                }
            },
            false // true is Syncronous and false is Assyncronous (Default by true)
        );
        
    }
    
    // �͡Ẻ����͹ 
    // document.getElementById('checkPt').addEventListener("click", function(eventHandler){
    //     document.getElementById('ptrightNotify').style.display = '';
    // });

    // document.getElementById('ptrightClose').addEventListener("click", function(eventHandler){
    //     document.getElementById('ptrightNotify').style.display = 'none';
    // });

</script>
</div>