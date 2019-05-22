<?php
require_once '../include.php';
checkLogined();
@$pid=$_REQUEST['pid'];
$sql="select * from vote_album where pid={$pid}";
$rows=fetchAll($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>删除图片列表</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="返&nbsp;&nbsp;回" class="add"   onclick="back()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="40%">图片</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (is_array($rows))  foreach((array)$rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td>
					                <img width="100" height="100" src="uploads/<?php echo $row['albumPath'];?>" alt=""/> &nbsp;&nbsp;
					            </td>
                                <td align="center"><input type="button" value="删除" class="btn"  onclick="delOneImg(<?php echo $row['id'];?>)"></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
	function delOneImg(id){
		if(window.confirm("您确定要删除吗？删除之后不能恢复哦！！！")){
			window.location="doAdminAction.php?act=delOneImg&id="+id;
		}
	}
	function back(){
		window.location="listProImages.php";
	}
</script>
</body>
</html>