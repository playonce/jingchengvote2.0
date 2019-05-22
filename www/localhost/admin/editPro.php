<?php 
require_once '../include.php';
checkLogined();
$rows=getAllCate();
$res=getAllSunCate();
if(!$rows){
	alertMes("没有相应分类，请先添加分类!!", "addCate.php");
}elseif(!$res){
	alertMes("没有相应子分类，请先添加子分类!!", "addSunCate.php");
}
@$id=$_REQUEST['id'];
$proInfo=getProById($id);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改作品</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);		
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
</head>
<body>
<h3>添加作品</h3>
<form action="doAdminAction.php?act=editPro&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    <tr>
        <td align="right">作者名称</td>
        <td><input type="text" name="aName"  value="<?php echo $proInfo['aName'];?>"/></td>
    </tr>
    <tr>
        <td align="right">所属学院</td>
        <td><input type="text" name="college"  value="<?php echo $proInfo['college'];?>"/></td>
    </tr>
	<tr>
		<td align="right">作品名称</td>
		<td><input type="text" name="pName"  value="<?php echo $proInfo['pName'];?>"/></td>
	</tr>
	<tr>
		<td align="right">作品分类</td>
		<td>
		<select name="cId">
			<?php if ($rows) foreach($rows as $row):?>
				<option value="<?php echo $row['id'];?>" <?php echo $row['id']==$proInfo['cId']?"selected='selected'":null;?>><?php echo $row['cName'];?></option>
			<?php endforeach;?>
		</select>
		<select name="sunId">
			<?php if (is_array($res)) foreach((array)$res as $res):?>
				<option value="<?php echo $res['id'];?>" <?php echo $res['id']==$proInfo['sunId']?"selected='selected'":null;?>><?php echo $res['sName'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">作品编号</td>
		<td><input type="text" name="pSn"  value="<?php echo $proInfo['pSn'];?>"/></td>
	</tr>
	<tr>
		<td align="right">作品描述</td>
		<td>
			<textarea name="pDesc" id="editor_id" style="width:100%;height:150px;"><?php echo $proInfo['pDesc'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">作品图像</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="编辑作品"/></td>
	</tr>
</table>
</form>
</body>
</html>