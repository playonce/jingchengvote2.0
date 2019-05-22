<?php 
require_once '../include.php';
checkLogined();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加分类</title>
</head>
<body>
<h3>添加分类</h3>
<form action="doAdminAction.php?act=addSunCate" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">分类名称</td>

		<td><input type="text" name="sName" placeholder="请输入分类名称"/></td>
	</tr>
    <tr>
        <td align="right">分类类型：</td>
        <td><input type="radio" name="ckey" value="dw" />DW<input type="radio" name="ckey" value="ps" />PS<input type="radio" name="ckey" value="fl" />FL</td>
    </tr>
	<tr>
		<td colspan="2" align="center"><input type="submit"  value="添加分类"/></td>
	</tr>
</table>
</form>
</body>
</html>