<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<p align="center" style="margin-top: 20px;"><strong>���͡�ѹ����ͧ����Ѿഷ�����ŵԴ C �Է�Ի�Сѹ�ѧ��</strong></p>
<div align="center">
<form method="POST" action="updatestat_sso.php">
<input type="hidden" name="act" value="show" />
	<strong>�����ҧ�ѹ��� : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>���͡��͹ : </strong><select size="1" name="month1" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>�ѹ�Ҥ�</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; <strong>�֧�ѹ���</strong> 
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>���͡��͹ : </strong><select size="1" name="month2" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>�ѹ�Ҥ�</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year2'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>       
       <input type="submit" value="�Ѿഷ������" name="B1"  class="txt" />
       &nbsp;&nbsp;
    <input type="button" value="�������ѡ" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
</form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>��§ҹ�����ŵԴ C �Է�Ի�Сѹ�ѧ��</strong></div>
<div align="center">����ҧ�ѹ��� <?=$showdate1;?> �֧�ѹ��� <?=$showdate2;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>DATE</strong></td>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>���ͼ�����</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>�ӹǹ�Թ</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>�ӹǹ�����ԡ</strong></td>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>Stat</strong></td>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>Station</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>DTTran</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>InvNo</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>IDCARD</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>ClaimAmt</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>CheckCode</strong></td>
  </tr>
<?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

$sql="select * from opacc where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and credit='��Сѹ�ѧ��'  order by date asc";
//echo $sql;
$query=mysql_query($sql);
$i=0;
$sumprice=0;
$sumpaidcscd=0;
while($rows=mysql_fetch_array($query)){
$i++;
$row_id=$rows["row_id"];

$sql1="select * from opcard where hn='$rows[hn]'";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
$ptname=$rows1["yot"]." ".$rows1["name"]."&nbsp;&nbsp;".$rows1["surname"];
$sumprice=$sumprice+$rows["price"];
$sumpaidcscd=$sumpaidcscd+$rows["paidcscd"];



                    if( $rows["price"] > $rows["paidcscd"] ){
                        $bg="#CC3333";
                    }else{
                        $bg="#F5DEB3";
                    }
					
                    if($rows["typesso"]=="C"){
                        $typesso="<div style='color:red;'><strong>�Դ C</strong></div>";
                    }else if($rows["typesso"]=="A"){
                        $typesso="<div style='color:blue;'><strong>�� C ��ҹ</strong></div>";
                    }else{
						$typesso="<div style='color:green;'><strong>��ҹ</strong></div>";
					}

$date=substr($rows["txdate"],0,10);
list($y,$m,$d)=explode("-",$date);
$yy=$y-543;
$date2="$yy$m$d";


$invbillno=str_replace(array("/"," "),'',$rows["billno"]);	
$invbillno=sprintf('%05d',$invbillno);
$invvn=sprintf('%03d',$rows["vn"]);

$invno=$date2.$invvn.$invbillno;  //��駤�� billtran.invno ��Ҵ�����ŵ�ͧ >=9 && <= 16


$sql2="select * from stat_sso where invno='$invno'";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);
$rows2=mysql_fetch_array($query2);
$stat_id=$rows2["row_id"];

if($num2 > 0){
$edit=mysql_query("update opacc set typesso='C' where row_id='$row_id';");
$edit1=mysql_query("update stat_sso set stat='A' where row_id='$stat_id';");
//echo $edit1."<br>";
}			
?>  
  <tr bgcolor="<?=$bg;?>">
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"]?></td>
    <td align="center"><?=$rows["vn"]?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td><?=$ptname;?></td>
    <td align="right"><?=$rows["price"]?></td>
    <td align="right"><?=$rows["paidcscd"]?></td>
    <td align="center"><?=$rows2["stat"]?></td>
    <td align="center"><?=$rows2["vn"]?></td>
    <td align="center"><?=$rows2["dttran"]?></td>
    <td><?=$rows2["invno"];?></td>
    <td><?=$rows1["idcard"];?></td>
    <td><?=$rows2["hn"];?></td>
    <td align="right"><?=$rows2["claimamt"];?></td>
    <td align="left"><?=$rows2["chkcode"];?></td>
  </tr>
<?
}
?>
</table>
<?
}
?>