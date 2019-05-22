<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>精诚杯后台</title>
</head>
<body>
<center>
	<h3>系统信息</h3>
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<th>操作系统</th>
			<td><?php echo PHP_OS;?></td>
		</tr>
		<tr>
			<th>Apache版本</th>
			<td><?php echo apache_get_version();?></td>
		</tr>
		<tr>
			<th>PHP版本</th>
			<td><?php echo PHP_VERSION;?></td>
		</tr>
		<tr>
			<th>运行方式</th>
			<td><?php echo PHP_SAPI;?></td>
		</tr>
	</table>
	<h3>软件信息</h3>
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<th>系统名称</th>
			<td>精诚杯投票系统</td>
		</tr>
		<tr>
			<th>开发团队</th>
			<td>精诚工作室</td>
		</tr>
		<tr>
			<th>公司网址</th>
			<td><a href="http://jzjc.jxutcm.edu.cn/">http://jzjc.jxutcm.edu.cn</a></td>
		</tr>
	</table>
</center>

</body>
</html>