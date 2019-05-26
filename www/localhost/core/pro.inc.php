<?php 
/**
 * 添加作品
 * @return string
 */
function addPro(){
	$arr=$_POST;
	$arr['pubTime']=time();
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach($uploadFiles as $key=>$uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_45/".$uploadFile['name'],45,50);
			thumb($path."/".$uploadFile['name'],"../image_180/".$uploadFile['name'],180,200);
		}
	}
	$res=insert("vote_pro",$arr);
	$pid=getInsertId();
	if($res&&$pid){
		if (is_array($uploadFiles))foreach((array)$uploadFiles as $uploadFile){
			$arr1['pid']=$pid;
			$arr1['albumPath']=$uploadFile['name'];
			$arr1['Path']=$uploadFile['Path'];
			addAlbum($arr1);
		}
		$mes="<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看作品列表</a><a href='add.php?id={$pid}' >添加视频</a><a href='fileup.php?id={$pid}' >添加网页或FL动画</a>";
	}else{
        if (is_array($uploadFiles))foreach((array)$uploadFiles as $uploadFile){

			if(file_exists("../image_45/".$uploadFile['name'])){
				unlink("../image_45/".$uploadFile['name']);
			}
			if(file_exists("../image_180/".$uploadFile['name'])){
				unlink("../image_180/".$uploadFile['name']);
			}

		}
		$mes="<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
		
	}

	return $mes;
}
/**
 *编辑作品
 * @param int $id
 * @return string
 */
function editPro($id){
	$arr=$_POST;
	$path="./uploads";

	$uploadFiles=uploadFile($path);
	if(is_array($uploadFiles)&&$uploadFiles){
        foreach($uploadFiles as $key=>$uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_45/".$uploadFile['name'],45,50);
			thumb($path."/".$uploadFile['name'],"../image_180/".$uploadFile['name'],180,200);
		}
	}
	$where="id={$id}";
	$res=update("vote_pro",$arr,$where);
	$pid=$id;
	if($res&&$pid){
		if($uploadFiles&&is_array($uploadFiles)){
			foreach($uploadFiles as $uploadFile){
				$arr1['pid']=$pid;
				$arr1['albumPath']=$uploadFile['name'];
				addAlbum($arr1);
			}
		}
		$mes="<p>编辑成功!</p><a href='listPro.php' target='mainFrame'>查看作品列表</a><a href='add.php?id={$pid}' >添加视频</a><a href='fileup.php?id={$pid}' >添加网页或动画</a>";
	}else{
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach($uploadFiles as $uploadFile){
			if(file_exists("uploads/".$uploadFile['name'])){
				unlink("uploads/".$uploadFile['name']);
			}
			if(file_exists("../image_45/".$uploadFile['name'])){
				unlink("../image_45/".$uploadFile['name']);
			}
			if(file_exists("../image_180/".$uploadFile['name'])){
				unlink("../image_180/".$uploadFile['name']);
			}

		}
	}
		$mes="<p>编辑失败!</p><a href='listPro.php' target='mainFrame'>重新编辑</a>";
		
	}
	return $mes;
}

function delPro($id){
	$where="id={$id}";
	$res=delete("vote_pro",$where);
	$proImgs=getAllImgByProId($id);
	if($proImgs&&is_array($proImgs)){
		foreach($proImgs as $proImg){
			if(file_exists("uploads/".$proImg['albumPath'])){
				unlink("uploads/".$proImg['albumPath']);
                $info = pathinfo($proImg['albumPath']);
                $cname=basename($proImg['albumPath'],$info['extension']);
                if (file_exists("uploads/".$cname)){
                    rmdir("uploads/".$cname);
                }
                if(file_exists("uploads/".$cname."mp4")){
                    unlink("uploads/".$cname."mp4");
                }
                if(file_exists("uploads/".$proImg['albumPath'])){
                    unlink("uploads/".$proImg['albumPath']);
                }
                if(file_exists("../image_45/".$proImg['albumPath'])){
                    unlink("../image_45/".$proImg['albumPath']);
                }
                if(file_exists("../image_180/".$proImg['albumPath'])){
                    unlink("../image_180/".$proImg['albumPath']);
                }
                if(file_exists("uploads/".$cname.".swf")){
                    unlink("uploads/".$cname.".swf");
                }
			}



			
		}
	}
	$where1="pid={$id}";
	$res1=delete("vote_album",$where1);
	if($res&&$res1){
		$mes="删除成功!<br/><a href='listPro.php' target='mainFrame'>查看作品列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}




//清空文件
function delImg($id){
	$where="id={$id}";
	$proImgs=getAllImgByProId($id);
	if($proImgs&&is_array($proImgs)){
		foreach($proImgs as $proImg){
            if(file_exists("uploads/".$proImg['albumPath'])){
                unlink("uploads/".$proImg['albumPath']);
                $info = pathinfo($proImg['albumPath']);
                $cname=basename($proImg['albumPath'],$info['extension']);
                if (file_exists("uploads/".$cname)){
                    rmdir("uploads/".$cname);
                }
                if(file_exists("uploads/".$cname."mp4")){
                    unlink("uploads/".$cname."mp4");
                }
                if(file_exists("uploads/".$proImg['albumPath'])){
                    unlink("uploads/".$proImg['albumPath']);
                }
                if(file_exists("uploads/".$cname.".swf")){
                    unlink("uploads/".$cname.".swf");
                }
            }
			if(file_exists("../image_45/".$proImg['albumPath'])){
				unlink("../image_45/".$proImg['albumPath']);
			}
			if(file_exists("../image_180/".$proImg['albumPath'])){
				unlink("../image_180/".$proImg['albumPath']);
			}

			
		}
	}
	$where1="pid={$id}";
	$res1=delete("vote_album",$where1);
	if($res1){
		$mes="删除成功!<br/><a href='listPro.php' target='mainFrame'>查看作品列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}
/**
 * 得到作品的所有信息
 * @return array
 */
function getAllProByAdmin(){
	$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName from vote_pro as p join vote_cate c on p.cId=c.id ORDER BY pSn ASC ";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 *根据作品id得到作品图片
 * @param int $id
 * @return array
 */
function getAllImgByProId($id){
	$sql="select a.albumPath,a.Path from vote_album a where pid={$id}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 根据id得到作品的详细信息
 * @param int $id
 * @return array
 */
function getProById($id){
		$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,p.cId,p.sunId from vote_pro as p join vote_cate c on p.cId=c.id where p.id={$id} ORDER BY pSn ASC ";
		$row=fetchOne($sql);
		return $row;
}
/**
 * 检查分类下是否有产品
 * @param int $cid
 * @return array
 */
function checkProExist($cid){
	$sql="select * from vote_pro where cId={$cid} ORDER BY pSn ASC ";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 得到所有作品
 * @return array
 */
function getAllPros(){
	$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,p.cId,p.sunId from vote_pro as p join vote_cate c on p.cId=c.id  ORDER BY pSn ASC ";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 *根据cid得到4条产品
 * @param int $cid
 * @return Array
 */
function getProsByCid($cid){
	$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,p.cId from vote_pro as p join vote_cate c on p.cId=c.id where p.cId={$cid} ORDER BY pSn ASC  limit 4";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 得到下4条产品
 * @param int $cid
 * @return array
 */
function getSmallProsByCid($cid){
	$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,p.cId from vote_pro as p join vote_cate c on p.cId=c.id where p.cId={$cid} ORDER BY pSn ASC  limit 4,4";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 *得到作品ID和作品名称
 * @return array
 */
function getProInfo(){
	$sql="select id,pName from vote_pro order by id asc";
	$rows=fetchAll($sql);
	return $rows;
}

