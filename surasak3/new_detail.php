<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
<?
print"<a target=_self  href='newedit.php' class='forntsarabun'><-----��Ѻ</a>";
include("connect.inc");

	$query = "SELECT  row,depart,new,datetime,file FROM new   WHERE row='".$_GET['row']."' ";
    $result = mysql_query($query) or die("Query failed new");
	list ($row,$depart,$new,$datetime,$file) = mysql_fetch_row ($result);

?>

<table border="0" class="forntsarabun">
  <tr>
    <td valign="top" bgcolor="#00FFFF">��������´����</td>
    <td valign="top"><?=$new;?></td>
  </tr>
  <tr>
    <td bgcolor="#00FFFF">��С�Ȩҡ</td>
    <td><?=$depart;?></td>
  </tr>
  <tr>
    <td bgcolor="#00FFFF">�ѹ���</td>
    <td><?=$datetime;?></td>
  </tr>
  <? if($file!=""){ ?>		
  <tr>
  <td bgcolor="#00FFFF">��ǹ���Ŵ���</td>
    <td bgcolor="#00FFFF"><a  href='file_news/<?=$file?>'>
	<img src='Save Icon.jpg' width='32' height='32' alt='��ǹ���Ŵ���' border="0"/></a>
 <? } ?>
   </td>
  </tr>
</table>

<?
include("unconnect.inc"); 
?>