<?php 

function addAlbum($arr){
	insert("vote_album", $arr);
}

/**
 * 根据作品id得到作品图片
 * @param int $id
 * @return array
 */
function getProImgById($id){
	$sql="select albumPath,Path from vote_album where pid={$id} limit 1";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 根据作品id得到所有图片
 * @param int $id
 * @return array
 */
function getProImgsById($id){
	$sql="select albumPath,Path from vote_album where pid={$id} ";
	$rows=fetchAll($sql);
	return $rows;
}

