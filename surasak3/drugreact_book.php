<?
   session_start();
if(!isset($_GET['cPage'])){
?>
<a href="dgadv.php?cHn=<?=$_SESSION['sHn']?>"><<<< ��Ѻ</a>
<table>
 <tr>
  <th bgcolor=6495ED>��úѭ</th>
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
    print "<a href='drugreact_book.php'><<<< ��Ѻ</a><table>";
    print "<tr>";
    print "<th bgcolor=6495ED>#</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
	print "<th bgcolor=6495ED><font face='Angsana New'>���͡</th>";
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
   <tr><td BGCOLOR=66CDAA colspan="4"><font face='Angsana New'>�ҡ���� : <input name='adv' type='text' ></td></tr>
   <tr><td BGCOLOR=66CDAA colspan="4"><font face='Angsana New'>��û����Թ : <input name='accept' type='text' ><br />
*��û����Թ :   (1=����͹, 2=��Ҩ���, 3=�Ҩ����, 4=ʧ��� )</td></tr>
   <tr><td BGCOLOR=66CDAA colspan="4"><font face='Angsana New'>�����§ҹ : <input name='repot' type='text' value="" ></td></tr>
   <tr><td colspan='4'><input name='okbtn' type='submit' value='           �׹�ѹ           '></td></tr>
   </table>
   </form>
   <?

    include("unconnect.inc");

    /*print "<font face='Angsana New'>*DDL   ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br>";
    print "<font face='Angsana New'>DDY   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�� <br>";
    print "<font face='Angsana New'>DDN   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����� <br>";
    print "<font face='Angsana New'>DPY   �ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br>";
    print "<font face='Angsana New'>DPN   �ػ�ó� ����ԡ����� <br>";
    print "<font face='Angsana New'>DSY   �Ǫ�ѳ�� ����ԡ��(�ԡ��੾��IPD�������� þ.,OPD �ԡ�����) <br>";
    print "<font face='Angsana New'>DSN   �Ǫ�ѳ�� ����ԡ�����";*/
}
?>
