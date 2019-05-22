<?php 
/**
 * 添加分类的操作
 * @return string
 */
function addCate(){
	$arr=$_POST;
	if(insert("vote_cate",$arr)){
		$mes="分类添加成功!<br/><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";
	}else{
		$mes="分类添加失败！<br/><a href='addCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
	}
	return $mes;
}

function addSunCate(){
	$arr=$_POST;
	if(insert("vote_suncate",$arr)){
		$mes="子分类添加成功!<br/><a href='addSunCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";
	}else{
		$mes="子分类添加失败！<br/><a href='addSunCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
	}
	return $mes;
}

/**
 * 根据ID得到指定分类信息
 * @param int $id
 * @return array
 */
function getCateById($id){
	$sql="select id,cName from vote_cate where id={$id}";
	return fetchOne($sql);
}

function getSunCateById($id){
	$sql="select id,sName from vote_suncate where id={$id}";
	return fetchOne($sql);
}

/**
 * 修改分类的操作
 * @param string $where
 * @return string
 */
function editCate($where){
	$arr=$_POST;
	if(update("vote_cate", $arr,$where)){
		$mes="分类修改成功!<br/><a href='listCate.php'>查看分类</a>";
	}else{
		$mes="分类修改失败!<br/><a href='listCate.php'>重新修改</a>";
	}
	return $mes;
}

function editSunCate($where){
	$arr=$_POST;
	if(update("vote_suncate", $arr,$where)){
		$mes="分类修改成功!<br/><a href='listSunCate.php'>查看分类</a>";
	}else{
		$mes="分类修改失败!<br/><a href='listSunCate.php'>重新修改</a>";
	}
	return $mes;
}

/**
 *删除分类
 * @param string $where
 * @return string
 */
function delCate($id){
	$res=checkProExist($id);
	if(!$res){
		$where="id=".$id;
		if(deletedb("vote_cate",$where)){
			$mes="分类删除成功!<br/><a href='listCate.php'>查看分类</a>|<a href='addCate.php'>添加分类</a>";
		}else{
			$mes="删除失败！<br/><a href='listCate.php'>请重新操作</a>";
		}
		return $mes;
	}else{
		alertMes("不能删除分类，请先删除该分类下的作品", "listPro.php");
	}
}

function delsCate($id){
	$res=checkProExist($id);
	if(!$res){
		$where="id=".$id;
		if(deletedb("vote_suncate",$where)){
			$mes="分类删除成功!<br/><a href='listSunCate.php'>查看分类</a>|<a href='addSunCate.php'>添加分类</a>";
		}else{
			$mes="删除失败！<br/><a href='listSunCate.php'>请重新操作</a>";
		}
		return $mes;
	}else{
		alertMes("不能删除分类，请先删除该分类下的作品", "listPro.php");
	}
}

/**
 * 得到所有分类
 * @return array
 */
function getAllCate(){
	$sql="select id,cName from vote_cate";
	$rows=fetchAll($sql);
	return $rows;
}

function getAllSunCate(){
	$sql="select id,ckey,sName from vote_suncate";
	$rows=fetchAll($sql);
	return $rows;
}



