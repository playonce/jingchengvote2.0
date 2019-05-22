<?php 
require_once '../include.php';
checkLogined();
@$keys=$_REQUEST['keys'];
if ($keys==null)
@$keys=$_SESSION['keys'];
$_SESSION['keys']=$keys;
@$keycates=$_REQUEST['keycates']?$_REQUEST['keycates']:1;
@$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
if($keys==null&&$keycates==null){
$where=$keywords?"where p.pName or p.pSn like '%{$keywords}%'":null;
}elseif($keys==0&&$keycates==1){
	$where="where p.cId=1";
}elseif($keys==null){
	$where=$keys?"where p.cId =1":null;
}elseif(!($keys==null)||$keys!=0){
	$where=$keycates?"where p.sunId ={$keys} and p.cId ={$keycates}":null;
}
//得到数据库中所有作品
$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,s.sName,p.sunId,p.cId from vote_pro p join vote_cate c on p.cId=c.id join vote_suncate s on p.sunId=s.id {$where} ORDER BY pSn ASC  ";
$totalRows=getResultNum($sql);
$pageSize=5;
$totalPage=ceil($totalRows/$pageSize);
@$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,s.sName,p.sunId,p.cId from vote_pro p join vote_cate c on p.cId=c.id join vote_suncate s on p.sunId=s.id  {$where} ORDER BY pSn ASC  limit {$offset},{$pageSize} ";
$rows=fetchAll($sql);
$sql="select id,cName from vote_cate";
$rcate=fetchAll($sql);
$sql="select id,sName from vote_suncate";
$rsc=fetchAll($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>作品列表</title>
<link rel="stylesheet" href="../styles/backstage.css">
</head>

<body>

<div class="details">
                    <div class="details_operation clearfix">

                        <div class="fr">
                            <div class="text">
                                <span>作品归类：</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option value="0" >-请选择-</option>
										<?php if (is_array($rcate)) foreach((array)$rcate as $rcate):?>
											<option value="<?php echo $rcate['id'];?>" <?php if($rcate['id']==$keycates){echo 'selected="selected"';}?>  ><?php echo $rcate['cName']; ?></option>
										<?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>作品分类：</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                    <option value="0" >-请选择-</option>
										<?php if (is_array($rsc)) foreach((array)$rsc as $rsc):?>
											<option value="<?php echo $rsc['id'];?>" <?php if($rsc['id']==$keys){echo 'selected="selected"';}?>  ><?php echo $rsc['sName']; ?></option>
										<?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>搜索</span>
                                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
                            </div>
                        </div>
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">编号</th>
                                <th width="20%">作品名称</th>
                                <th>作品图片</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (is_array($rows)) foreach((array)$rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input  type="checkbox" id="c<?php echo $row['id'];?>" class="check" value=<?php echo $row['pSn'];?>><label for="c1" class="label"><?php echo $row['pSn'];?></label></td>
                                
                                <td><?php echo $row['pName']; ?></td>
								<td>
					                        			<?php 
					                        			$proImgs=getAllImgByProId($row['id']);
					                        			if (is_array($proImgs))foreach((array)$proImgs as $img):
					                        			?>
                                                            <a href="
                                                       <?php
                                                                $info = pathinfo("uploads\\" . $img['albumPath']);
                                                                $pIname = basename($img['albumPath'],".".$info['extension']);
                                                                if (file_exists("uploads\\".$pIname))
                                                                {
                                                                    if (file_exists("uploads\\".$pIname."\\index.html"))
                                                                        echo "uploads\\".$pIname."\\index.html";
                                                                    else if (file_exists("uploads\\".$pIname."\\Untitled-1.html"))
                                                                        echo "uploads\\".$pIname."\\Untitled-1.html";
                                                                    else if (file_exists("uploads\\".$pIname."\\main.html"))
                                                                        echo "uploads\\".$pIname."\\main.html";
                                                                }else if (file_exists("uploads\\".$pIname.".avi"))
                                                                    echo "uploads\\".$pIname.".avi";
                                                                else if (file_exists("uploads\\".$pIname.".mp4"))
                                                                    echo "uploads\\".$pIname.".mp4";
                                                                else if (file_exists("uploads\\".$pIname.".flv"))
                                                                    echo "uploads\\".$pIname.".flv";
                                                                else if (file_exists("uploads\\".$pIname.".rm"))
                                                                    echo "uploads\\".$pIname.".rm";
                                                                else if (file_exists("uploads\\".$pIname.".rmvb"))
                                                                    echo "uploads\\".$pIname.".rmvb";
                                                                else if (file_exists("uploads\\".$pIname.".mpg"))
                                                                    echo "uploads\\".$pIname.".mpg";
                                                                else if (file_exists("uploads\\".$img['albumPath']))
                                                                    echo "uploads\\".$img['albumPath'];
                                                            ?>
                                                    ">
					                        			<img width="90" height="100" src="uploads/<?php echo $img['albumPath'];?>" alt=""/></a> &nbsp;&nbsp;
					                        			<?php endforeach;?>
					             </td>
					             <td>
					           
					             	

									<input type="button" value="清空文件" onclick="doImg('<?php echo $row['id'];?>','delImg')" class="btn"/>

					             </td>       
					                        		
					                        		
                                
                                
                            </tr>
                           <?php  endforeach;?>
						   <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="7"><?php echo showPage($page, $totalPage,"keywords={$keywords}&keys={$keys}");?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
 <script type="text/javascript">
 		function doImg(id,act){
			if(act=="delImg"){
				if(window.confirm("您确认要删除嘛？添加一次不易，且删且珍惜!")){
					window.location="doAdminAction.php?act="+act+"&id="+id;
				}
			}else {
				window.location="doAdminAction.php?act="+act+"&id="+id;
			}
			
 	 	}
		function deImg(pid){
			window.location="delOneImg.php?pid="+pid;
		}
		function search(){
			if(event.keyCode==13){
				var val=document.getElementById("search").value;
				window.location="listProImages.php?keywords="+val;
			}
		}
		
		function change(val){
			if(val=="0"){
					window.location="listProImages.php";
			}else {window.location="listProImages.php?keys="+val;
				}
		}
 </script>
</body>
</html>