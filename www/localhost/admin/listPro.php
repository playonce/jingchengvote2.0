<?php 
require_once '../include.php';
checkLogined();
if(@$_REQUEST['cid']!=null)
$_SESSION['cid']=$_REQUEST['cid'];
if(@$_REQUEST['sid']!=null)
$_SESSION['sid']=$_REQUEST['sid'];
$cid=$_SESSION['cid'];
$sid=$_SESSION['sid'];
@$order=$_REQUEST['order']?$_REQUEST['order']:null;
@$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.pName or p.pSn like '%{$keywords}%'":null;
//得到数据库中所有作品
$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,s.sName from vote_pro p join vote_cate c on p.cId=c.id join vote_suncate s on p.sunId=s.id {$where} AND cId={$cid} AND sunId={$sid} ORDER BY pSn ASC ";
$totalRows=getResultNum($sql);
$pageSize=10;
$totalPage=ceil($totalRows/$pageSize);
@$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select p.id,p.aName,p.college,p.pName,p.pSn,p.pDesc,p.pubTime,c.cName,s.sName from vote_pro p join vote_cate c on p.cId=c.id join vote_suncate s on p.sunId=s.id  {$where} AND cId={$cid} AND sunId={$sid} limit {$offset},{$pageSize} ORDER BY pSn ASC ";
$rows=fetchAll($sql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>精诚杯后台</title>
<link rel="stylesheet" href="../styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>

</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()">
                        </div>

                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
								<th width="5%">编号</th>
                                <th width="20%">作品名称</th>
                                <th width="10%">作者</th>
                                <th width="10%">所属学院</th>
                                <th width="15%">作品分类</th>
                                <th width="20%">上传时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($rows) foreach((array)$rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><?php echo $row['pSn'];?></td>
								<td><?php echo $row['pName']; ?></td>
                                <td><?php echo $row['aName']; ?></td>
                                <td><?php echo $row['college']; ?></td>
                                <td><?php echo $row['cName'];?>&nbsp;->&nbsp;<?php echo $row['sName'];?></td>
                                 <td><?php echo date("Y-m-d H:i:s",$row['pubTime']);?></td>
                                <td align="center">
                                				<input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['pName'];?>')"><input type="button" value="修改" class="btn" onclick="editPro(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"onclick="delPro(<?php echo $row['id'];?>)">
					                            <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
					                        	<table class="table" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="20%" align="right">作者名称</td>
                                                        <td><?php echo $row['aName'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20%" align="right">所属学院</td>
                                                        <td><?php echo $row['college'];?></td>
                                                    </tr>
                                                    <tr>
					                        			<td width="20%" align="right">作品名称</td>
					                        			<td><?php echo $row['pName'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">作品类别</td>
					                        			<td><?php echo $row['cName'];?>&nbsp;->&nbsp;<?php echo $row['sName'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">作品编号</td>
					                        			<td><?php echo $row['pSn'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">作品图片</td>
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
					                        			<img width="100" height="100" src="uploads/<?php echo $img['albumPath'];?>" alt=""/></a> &nbsp;&nbsp;
					                        			<?php endforeach;?>
					                        			</td>
					                        		</tr>
					                        	</table>
					                        	<span style="display:block;width:80%; ">
					                        	作品描述<br/>
					                        	<?php echo $row['pDesc'];?>
					                        	</span>
					                        </div>
                                
                                </td>
                            </tr>
                           <?php  endforeach;?>
                           <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="7"><?php echo showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,//是否模式对话框
	      draggable:true,//是否允许拖拽
	      resizable:true,//是否允许拖动
	      title:"作品名称："+t,//对话框标题
	      show:"slide",
	      hide:"explode"
	});
}
	function addPro(){
		window.location='addPro.php';
	}
	function editPro(id){
		window.location='editPro.php?id='+id;
	}
	function delPro(id){
		if(window.confirm("您确认要删除嘛？添加一次不易，且删且珍惜!")){
			window.location="doAdminAction.php?act=delPro&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			var val=document.getElementById("search").value;
			window.location="listPro.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
</script>
</body>
</html>