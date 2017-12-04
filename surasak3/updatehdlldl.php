<?
session_start();
include("connect.inc");
$sql="select * from condxofyear_so where yearcheck='2560'";
//echo $sql;
$query=mysql_query($sql);
?>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#FFFFCC">ลำดับ</td>
    <td width="10%" align="center" bgcolor="#FFFFCC">HN</td>
    <td width="13%" align="center" bgcolor="#FFFFCC">ชื่อ - สกุล</td>
    <td width="7%" align="center" bgcolor="#FFFFCC"><p>LAB</p>    </td>
    <td width="7%" align="center" bgcolor="#FFFFCC">normalrange</td>
    <td width="7%" align="center" bgcolor="#FFFFCC">flag</td>
    <td width="7%" align="center" bgcolor="#FFFFCC">HDL</td>
    <td width="15%" align="center" bgcolor="#FFFFCC">STAT_HDL</td>
    <td width="20%" align="center" bgcolor="#FFFFCC">REASON_HDL</td>
    <td width="15%" align="center" bgcolor="#FFFFCC">HDLRANG</td>
    <td width="15%" align="center" bgcolor="#FFFFCC">HDLFLAG</td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
//echo $rows["age"];
$age=substr($rows["age"],0,2);
if($age > 34){
$i++;

$sql1="select autonumber from resulthead where hn='".$rows["hn"]."' and clinicalinfo='ตรวจสุขภาพประจำปี60' and profilecode='HDL' order by autonumber desc";
$query1=mysql_query($sql1);
list($autonumber)=mysql_fetch_array($query1);
//echo $autonumber;

$sql2="select * from resultdetail where autonumber='$autonumber'";
$query2=mysql_query($sql2);
$rows2=mysql_fetch_array($query2);
?>  
  <tr>
    <td><?=$i;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows2["result"];?></td>
    <td><?=$rows2["normalrange"];?></td>
    <td><?=$rows2["flag"];?></td>
    <td><?=$rows["hdl"];?></td>
    <td><?=$rows["stat_hdl"];?></td>    
    <td><?=$rows["reason_hdl"];?></td>
    <td><?=$rows["hdlrange"];?></td>
    <td><?=$rows["hdlflag"];?></td>
  </tr>
<?
	}
}
?>  
</table>


