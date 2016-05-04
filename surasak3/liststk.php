<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">

.thumbnail{
position: relative;
z-index: 0;
}

.thumbnail:hover{
background-color: transparent;
z-index: 50;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: lightyellow;
padding: 5px;
left: -1000px;
border: 1px dashed gray;
visibility: hidden;
color: black;
text-decoration: none;
}

.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}

.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 0;
left: 60px; /*position where enlarged image should offset horizontally */

}

</style>
<body>
<table width="50%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
  <tr>
    <td colspan="2" align="center">เลือกรูปแบบ Sticker ติดเอกสาร</td>
  </tr>
  <tr>
<td align="center"><a href="ipbed1a.php?cAn=<?=$cAn;?>&cbedname=<?=$cbedname;?>" class="thumbnail">แบบที่ 1<span><img src="images/stk1.JPG" title="ตัวอย่าง"/><br />ตัวอย่างรูปแบบ 1</span></a></td>
    <td align="center"><a href="ipbed1a2.php?cAn=<?=$cAn;?>&cbedname=<?=$cbedname;?>" class="thumbnail">แบบที่ 2<span><img src="images/stk2.JPG" /  title="ตัวอย่าง"><br /> ตัวอย่างรูปแบบ 2</span></a></td>
  </tr>
</table>


</body>
</html>