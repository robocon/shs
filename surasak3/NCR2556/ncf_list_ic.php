<?php 
session_start();
if($_SESSION["statusncr"] !== 'admin'){ echo '�Է�������ҹ���١��ͧ'; exit; }
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<?php include 'menu.php';?>

<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<h1 class="forntsarabun" align="center">���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ <font color="#FF0000">੾�� IC , MR</font></h1>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
    <tr class="forntsarabun">
        <th align="center" bgcolor="#99CC99" colspan="2">������˵ء�ó��Ӥѭ</th>
    </tr>
    <tr class="forntsarabun">
        <th align="center" bgcolor="#99CC99">����ѹ���</th>
        <th align="center" bgcolor="#99CC99">����Ţ NCR</th>
    </tr>
    <tr>
        <td>
            <form name="f1" class="form-search" action="ncf_list_ic.php" method="post">
                <?php
                $months = array( 1 => '�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.',);
                
                $sql = "SELECT date_format(`nonconf_date`, '%Y') as `years` FROM `ncr2556` GROUP BY `years` ORDER BY `years` DESC";
                $q = mysql_query($sql);
                ?>
                <select id="year_select" name="set_year">
                    <option value="0" >���͡��</option>
                    <?php 
                    $default_year = isset($_POST['set_year']) ? $_POST['set_year'] : 0;
                    $i = 0;
                    while($item = mysql_fetch_assoc($q)){
                        $select = $default_year == $item['years'] ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?php echo $item['years'];?>" <?php echo $select;?>><?php echo $item['years'];?></option>
                        <?php
                    }
                    ?>
                </select>
                
                <select id="month_select" name="set_month">
                    <option value="0" >���͡��͹</option>
                    <?php 
                    $default_month = isset($_POST['set_month']) ? $_POST['set_month'] : 0 ;
                    foreach($months as $key => $month){
                        
                        $selected = ( $default_month == $key ) ? 'selected="selected"' : '' ;
                        ?>
                        <option value="<?php echo sprintf("%02d", $key);?>" <?php echo $selected;?> ><?php echo $month;?></option>
                        <?php
                    }
                    ?>
                </select>
                <div>
                    <button type="submit" class="forntsarabun">����</button>
                </div>
                
            </form>
        </td>
        <td>
            <form name="f1" class="form-search" action="ncf_list_ic.php" method="post">
                <span>�Ţ NCR: </span>
                <input type="text" name="ncr"  class="forntsarabun"/>
                <div>
                    <button type="submit" class="forntsarabun">����</button>
                </div>
            </form>
        </td>
    </tr>
</table>
<br>
<?php
include("connect.inc");	

$nonconf_date = '';
if( isset($_POST['set_year']) && $_POST['set_year'] != 0 ){
    $nonconf_date = $_POST['set_year'];
    
    if( isset($_POST['set_month']) && $_POST['set_month'] != 0 ){
        $nonconf_date .= '-'.$_POST['set_month'];
    }
}

if( $nonconf_date!='' ){

    $sql1 = "SELECT nonconf_id, ncr, `until`, nonconf_date, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,risk2,risk3,nonconf_dategroup ,`return` 
    FROM  ncr2556 
    WHERE nonconf_date LIKE '$nonconf_date%' 
    AND ( `risk2` = 1 OR `risk3` = 1 )  
    ORDER BY `until` ASC, ncr ASC";

}else if($_POST['ncr']!=''){
	
    $sql1 = "SELECT nonconf_id, ncr, `until`, nonconf_date, date_format(nonconf_date,'%d/%m/')as date1,date_format(nonconf_date,'%Y')as date2,  left(nonconf_time,5) as time ,risk2,risk3,nonconf_dategroup ,`return` 
    FROM  ncr2556 
    WHERE ncr='".$_POST['ncr']."' 
    AND ( `risk2` = 1 OR `risk3` = 1 ) 
    ORDER BY `until` ASC, ncr ASC";

}else{
	$nonconf_date = date('Y')+543;
    
	// Query Landing page
    $sql1="SELECT nonconf_id, ncr, until, nonconf_date, date_format(nonconf_date,'%d/%m/') as date1, date_format(nonconf_date,'%Y') as date2, left(nonconf_time,5) as time, risk2, risk3, nonconf_dategroup, `return` 
    FROM  ncr2556  	
    WHERE nonconf_date like '$nonconf_date%'
    AND ( `risk2` = 1 OR `risk3` = 1 ) 
    ORDER BY `until` ASC, ncr ASC";

}
    
	$query1 = mysql_query($sql1)or die (mysql_error());
	$row=mysql_num_rows($query1);
	/*if($row){*/

	// print "<div><font class='forntsarabun' >ʶԵԼ�����㹨�ṡ��� ᾷ�� $_POST[doctor]  $��Ш�$day  $dateshow </font></div><br>";
	?>
    <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
        <tr bgcolor="#0099FF">
            <td width="5%" align="center">�ӴѺ</td>
            <td width="35%" align="center">˹��§ҹ/���</td>
            <td align="center">�ѹ�����¹��§ҹ</td>
            <td align="center">�ѹ�����§ҹ��ԧ</td>
            <td align="center">����</td>
            <td align="center">NCR </td>
            <td align="center">ʶҹ��觡�Ѻ</td>
            <td align="center">��������§</td>
            <?php
            if($_SESSION["statusncr"]=='admin' && $_SESSION['Userncr'] == 'admin' ){
            ?>
            <td width="5%" align="center">���</td>
            <td width="5%" align="center">ź</td>
            <td width="5%" align="center">�����</td>
            <?php } ?>
        </tr>
        <?php
        $i=0;
        while($arr1=mysql_fetch_array($query1)){
        
            $sql="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
            $query=mysql_query($sql)or die (mysql_error());
            $arr=mysql_fetch_array($query);
                    
            $i++;
            if($i%2==0){
                $bg = "#CCCCCC";
            }else{
                $bg = "#FFFFFF";
            }
        
            if($arr1['risk2']=='1'){
                $risk="IC";
                $riskCount1++;
            }else if ($arr1['risk3']=='1'){
                $risk="MR";
                $riskCount2++;
            }else if ($arr1['risk2']=='1' and $arr1['risk3']=='1'){
                $risk="IC,MR";
                $riskCount3++;	
            }else{
                $risk="";
            }
            $dategroup=explode("-",$arr1['nonconf_dategroup']);
            
            if($arr1['return']==1){
                $arr1['return']="�ٹ��س�Ҿ";
            }else{
                $arr1['return']="";
            }


            // ��Ǩ�ͺ����觧ҹ�����Ҫ���������
            $check_nonconf = null;
            $convert_insert_date = strtotime($arr2['insert_date']);
            if($convert_insert_date != false){
                
                $first_of_month = strtotime(date('Y', $convert_insert_date).date('-m-01', $convert_insert_date));
                
                list($y, $m, $d) = explode('-', $arr2['nonconf_date']);
                $nonconf_ad = strtotime(($y-543)."-$m-$d");
                
                if($nonconf_ad < $first_of_month){
                    $check_nonconf = 'style="color: #FFFFFF; background-color: #FF3E3E; font-weight: bold;"';
                }
            }
        ?>
        <tr bgcolor="<?=$bg;?>" <?php echo $check_nonconf;?>>
            <td align="center"><?=$i?></td>
            <td><?=$arr['name']?></td>
            <td><?=$arr1['date1'].($arr1['date2'])?></td>
            <td><?=$dategroup[1].'-'.$dategroup[0]?></td>
            <td><?=$arr1['time']?></td>
            <td><?=$arr1['ncr']?></td>
            <td><?=$arr1['return']?></td>
            <td align="center"><?=$risk?></td>
            <?php
            if($_SESSION["statusncr"]=='admin' && $_SESSION['Userncr'] == 'admin' ){
            ?>
            <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?=$arr1['nonconf_id'];?>" target="_blank">���</a></td>
            <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź NCR : <?=$arr1['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?=$arr1['nonconf_id']?>','','width=400,height=500')}">ź</a></td>
            <td align="center"><a  href="ncf_print.php?ncr_id=<?=$arr1['nonconf_id'];?>" target="_blank">�����</a></td>
            <?php } ?>
        </tr>
        <?php
        } // While
    ?>
    </table>
    <?php
echo "<BR>IC =".$riskCount1;
echo "<BR>MR=".$riskCount2;
echo "<BR>��� =".$a=$riskCount1+$riskCount2;
/*}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<HR>

<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3" align="center">
  <tr class="forntsarabun">
    <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
    <td bgcolor="#FFFFCC" >���� </td>
  </tr>
  <tr class="forntsarabun">
    <td width="64"  align="right">���͡��</td>
    <td width="387" >
<!--      <select name="m_start" class="forntsarabun">
        <option value="">---������͡��͹---</option>
        <option value="01" <?//if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <?//if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <?//if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <?//if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <?//if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <?//if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <?//if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <?//if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <?//if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <?//if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <?//if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <?//if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
      </select>-->
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
  <!--  <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">--></td>
  </tr>
</table>
</form>
<?
include("connect.inc");
//if($_POST['submit']=="����"){
	if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
	}else{
	$date1=(date("Y")+543);
	}
?>
<h1 align="center" class="forntsarabun">��§ҹ��ػ������Ҵ����͹�ҧ����С�õԴ����</h1>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
    <p>��������§</p></td>
<td colspan="13" align="center" bgcolor="#00CCFF" class="forntsarabun">�� 
  <?=($date1)?></td>
</tr>
<tr>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">���</td>
</tr>
<tr>
  <td align="center" bgcolor="#FFFFFF" class="forntsarabun">IC</td>
 <? 
$sum1=0;
 	 for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
$selectsql = "SELECT COUNT(*)as count  FROM  ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and risk2 =1 "; 	
$result = mysql_query($selectsql);
$arr01 = mysql_fetch_array($result);	

		
	//	echo $selectsql;

  ?>
  <td align="center" bgcolor="#FFFFFF" class="forntsarabun"><?=$arr01['count'];?></td>
  <? 
  $sum1+=$arr01['count'];
  } 
  ?>
  <td align="center" bgcolor="#FFFFFF" class="forntsarabun"><?= $sum1;?></td>
</tr>

<tr>
  <td align="center" bgcolor="#FFFFFF" class="forntsarabun">MR</td>
 <? 
$sum2=0;
 	 for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
$selectsql = "SELECT COUNT(*)as count  FROM  ncr2556  WHERE nonconf_date  like '".$date1."-".$m."-%' and risk3 =1 "; 	
$result = mysql_query($selectsql);
$arr02 = mysql_fetch_array($result);	

		
	//	echo $selectsql;

  ?>
  <td align="center" bgcolor="#FFFFFF" class="forntsarabun"><?=$arr02['count'];?></td>
  <? 
  $sum2+=$arr02['count'];
  } 
  ?>
  <td align="center" bgcolor="#FFFFFF" class="forntsarabun"><?= $sum2;?></td>
</tr>
</tr>

  </table>


<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>