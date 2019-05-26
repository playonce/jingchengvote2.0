<?php
require_once '../include.php';
checkLogined();
header("content-type:text/html;charset=utf-8");
$id=$_REQUEST['id'];
$mess;
if ($id==null){
    $mess=alertMes("错误！","listPro.php");
}
$sql="select * from vote_album where pid={$id}";
$result=mysql_query($sql);
if (mysql_num_rows($result)>0){

    filer($id);
}else $mess=alertMes("未添加图片！","listPro.php");
?>
<?php
if(@$mess){
    echo $mess;
}
?>
<form action="" method="post" enctype="multipart/form-data">
    选择要上传的文件：<input type="file" name="ufile">
    <input type="submit" name="sub" value="上传压缩文件并解压">

</form>
