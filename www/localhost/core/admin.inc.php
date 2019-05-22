<?php 
/**
 * 检查管理员是否存在
 * @param unknown_type $sql
 * @return Ambigous <multitype:, multitype:>
 */
function checkAdmin($sql){
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登陆.
 */
function checkLogined(){
	if(@$_SESSION['adminId']==""&&@$_COOKIE['adminId']==""){
		alertMes("请先登陆","login.php");
	}
}
/**
 * 添加管理员
 * @return string
 */
function addAdmin(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	if(insert("vote_admin",$arr)){
		$mes="添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
	}
	return $mes;
}

/**
 * 得到所有的管理员
 * @return array
 */
function getAllAdmin(){
	
	$sql="select id,username from vote_admin ";
	$rows=fetchAll($sql);
	return $rows;
}
function getAdminByPage($page,$pageSize=2){
	$sql="select * from vote_admin";
	global $totalRows;
	$totalRows=getResultNum($sql);
	global $totalPage;
	$totalPage=ceil($totalRows/$pageSize);
	if($page<1||$page==null||!is_numeric($page)){
		$page=1;
	}
	if($page>=$totalPage)$page=$totalPage;
	$offset=($page-1)*$pageSize;
	$sql="select id,username from vote_admin limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editAdmin($id){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	if(update("vote_admin", $arr,"id={$id}")){
		$mes="编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";
	}
	return $mes;
}

/**
 * 删除管理员的操作
 * @param int $id
 * @return string
 */
function delAdmin($id){
	if(deleteadmin("vote_admin","id={$id}")){
		$mes="删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
	}
	return $mes;
}

/**
 * 注销管理员
 */
function logout(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}
	if(isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
	}
	if(isset($_COOKIE['adminName'])){
		setcookie("adminName","",time()-1);
	}
	session_destroy();
	header("location:login.php");
}
