<?
   session_start();
if(!isset($_GET['cPage'])){
?>
<a href="dgadv.php?cHn=<?=$_SESSION['sHn']?>"><<<< กลับ</a>
<table>
 <tr>
  <th bgcolor=6495ED>สารบัญ</th>
 </tr>
<?php
    include("connect.inc");

    $query = "SELECT title,page FROM content";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($title, $page) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target=_self  href=\"drugreact_book.php?cTitle=$title& cPage=$page\">$title</a></td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>
<?php
}
elseif(isset($_GET['cPage'])){
  include("connect.inc");
  	?>
	<form name='form11' method="post" action='drugreact_add.php'>
	<?
    print "<a href='drugreact_book.php'><<<< กลับ</a><table>";
    print "<tr>";
    print "<th bgcolor=6495ED>#</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
	print "<th bgcolor=6495ED><font face='Angsana New'>เลือก</th>";
    print "</tr>";

    $cPage=rtrim($cPage);
    $query = "SELECT drugcode,tradname FROM druglst WHERE bcode LIKE '$cPage%' ";
    $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode, $tradname) = mysql_fetch_row ($result)) {
        $num++;
		?>
       <tr>
           <td BGCOLOR=66CDAA><font face='Angsana New'><?=$num?></td>
           <td BGCOLOR=66CDAA><font face='Angsana New'><?=$drugcode?></td>
           <td BGCOLOR=66CDAA><font face='Angsana New'><?=$tradname?></td>
		   <td BGCOLOR=66CDAA><font face='Angsana New'>
           <input name='ch<?=$num?>'type='checkbox' value='1' checked></td>
		   <input name='drug<?=$num?>' type='hidden' value='<?=$drugcode?>'>
		   <input name='trad<?=$num?>' type='hidden' value='<?=$tradname?>'>
           </tr>
           </font>
           <?
	}
   ?>
   <input name='numm' type='hidden' value='<?=$num?>'>
   <tr><td BGCOLOR=66CDAA colspan="4"><font face='Angsana New'>อาการแพ้ : <input name='adv' type='text' ></td></tr>
   <tr><td BGCOLOR=66CDAA colspan="4"><font face='Angsana New'>การประเมิน : <input name='accept' type='text' ><br />
*การประเมิน :   (1=ใช่แน่นอน, 2=น่าจะใช่, 3=อาจจะใช่, 4=สงสัย )</td></tr>
   <tr><td BGCOLOR=66CDAA colspan="4"><font face='Angsana New'>ผู้รายงาน : <input name='repot' type='text' value="" ></td></tr>
   <tr><td colspan='4'><input name='okbtn' type='submit' value='           ยืนยัน           '></td></tr>
   </table>
   </form>
   <?

    include("unconnect.inc");

    /*print "<font face='Angsana New'>*DDL   ยาในบัญชียาหลักแห่งชาติ เบิกได้<br>";
    print "<font face='Angsana New'>DDY   ยานอกบัญชียาหลักแห่งชาติ เบิกได้ <br>";
    print "<font face='Angsana New'>DDN   ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้ <br>";
    print "<font face='Angsana New'>DPY   อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br>";
    print "<font face='Angsana New'>DPN   อุปกรณ์ ที่เบิกไม่ได้ <br>";
    print "<font face='Angsana New'>DSY   เวชภัณฑ์ ที่เบิกได้(เบิกได้เฉพาะIPDขณะอยู่ใน รพ.,OPD เบิกไม่ได้) <br>";
    print "<font face='Angsana New'>DSN   เวชภัณฑ์ ที่เบิกไม่ได้";*/
}
?>
