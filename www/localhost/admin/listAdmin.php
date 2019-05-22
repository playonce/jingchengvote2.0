<?php 
require_once '../include.php';
error_reporting(E_ALL ^ E_DEPRECATED);
$pageSize=10;
@$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$rows=getAdminByPage($page,$pageSize);

if(!$rows){
	alertMes("sorry,没有管理员,请添加!","addAdmin.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理员列表</title>
<link rel="stylesheet" href="../styles/backstage.css">
</head>

<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="25%">编号</th>
                                <th width="55%">管理员名称</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (is_array($rows))  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['username'];?></td>
                            </tr>
                            <?php endforeach;?>
                            <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="4"><?php echo showPage($page, $totalPage);?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
</body>
<script type="text/javascript">

	function addAdmin(){
		window.location="addAdmin.php";	
	}
	function editAdmin(id){
			window.location="editAdmin.php?id="+id;
	}
</script>
</html>