<?php 
require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select id,username,password from vote_admin where id='{$id}'";
$row=fetchOne($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>修改管理员</title>
</head>
<body>
<h3>编辑管理员</h3>
<form action="doAdminAction.php?act=editAdmin&id=<?php echo $id;?>" method="post" >
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">管理员名称</td>
		<td><input type="text" name="username" id="username" value="<?php echo $row['username'];?>" readonly/></td>
	</tr>
	<tr>
		<td align="right">管理员密码</td>
		<td><input type="text" name="password" id="password"  placeholder="请输入新密码！" onfocus="check()"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="编辑管理员"/></td>
	</tr>

</table>
<script type="text/javascript">   
 
	function check(){  
		if(document.getElementById("password").length<8){
			document.getElementById("password").innerHTML ="密码过短!" 

		} 
	}  
</script>
</form>

</body>
</html>