<?php
session_start();

function dump($txt = NULL){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

?>

<div>
<a target=_top  href='../nindex.htm'>&lt;&lt; �����</a> | <a href="hos2m.php">��ش����ѹ����������Ǫ�ѳ��</a>
</div>

<form method="POST" action="rphos2m_2.php">
<p><b>��§ҹ�ʹ��������ǧ����</b></p>
    <div>
        <p>
            <font face="Angsana New">&nbsp;&nbsp; &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;<? $m=date('m'); ?>
            <select size="1" name="rptmo">
                <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
                <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
                <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
                <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
                <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
                <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
                <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
                <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
                <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
                <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
                <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
                <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
            </select>&nbsp;&nbsp; &#3614;.&#3624;
            <?php 
            $Y=date("Y")+543;
            $date=date("Y")+543+5;
            $dates=range(2547,$date);

            echo "<select name='thiyr'>";
            foreach($dates as $i){
                ?>
                <option value='<?=$i-543?>' <? if($Y==$i){ echo "selected"; }?>><?=$i-543;?></option>
                <?php
            }
            echo "<select>";
            ?>
        </p>
    </div>
    <div>
        <p>
            <font face="Angsana New">&nbsp;&nbsp; �֧��͹ &nbsp;<?php $m=date('m'); ?>
            <select size="1" name="rptmo_end">
                <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
                <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
                <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
                <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
                <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
                <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
                <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
                <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
                <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
                <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
                <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
                <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
            </select>&nbsp;&nbsp; &#3614;.&#3624;
            <?php 
            $Y=date("Y")+543;
            $date=date("Y")+543+5;
            $dates=range(2547,$date);

            echo "<select name='thiyr_end'>";
            foreach($dates as $i){
                ?>
                <option value='<?=$i-543?>' <? if($Y==$i){ echo "selected"; }?>><?=$i-543;?></option>
                <?php
            }
            echo "<select>";
            ?>
        </p>
    </div>

  <p>
  ������ : <INPUT TYPE="text" NAME="drugcode">
  </p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1">
    </p>
    <input type="hidden" name="action" value="show">
</form>

<?php

$action = $_POST['action'];
if( $action === 'show' ){

    $yym = $_POST['thiyr'].'-'.$_POST['rptmo'];
    $yym_end = $_POST['thiyr_end'].'-'.$_POST['rptmo_end'];

    $txt_more = '';
    if( $yym_end != $yym ){
        $txt_more = '�֧��͹ '.$yym_end;
    }

    print "<font face='Angsana New'><b>��§ҹ�ʹ��������ǧ���� ��͹ $yym $txt_more (���§����ѹ����Ѻ�ͧ)</b>";
	// print "<a href='rphos2m_print.php?yym=$yym'>�������ش����ѹ����</a>";
	
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӴѺ��ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>���觫���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����Ѻ�ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ�����觢ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ţ�����觢ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѷ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡�ë���</th>
  <!-- <th bgcolor=6495ED><font face='Angsana New'>LotNo</th> -->
  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�/˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�.�.5</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");

    $date_more = "date LIKE '$yym%'";
    if( $yym_end != $yym ){
        $date_more = " ( date >= '$yym-01' AND date <= '$yym_end-31') ";
    }

    $query = "SELECT stkno,docno,getdate,date,billno,comname,drugcode,tradname,lotno,packamt,packing,packpri,SUM(price) AS price,stkbak,packamt 
    FROM combill 
    WHERE $date_more 
    AND drugcode like '".$_POST["drugcode"]."%' 
    GROUP BY drugcode
    ORDER BY getdate";
    // dump($query);
    
    // exit;

    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;

    while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname,$drugcode,$tradname,$lotno,$packamt,$packing,$packpri,$price,$stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <!--<td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n-->".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packamt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rphos5dg.php? Dgcode=$drugcode\">�.�.5</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<br>�����Ť�ҫ���������Ǫ�ѳ�������  $netprice �ҷ";
?>

</table>

<?php

}