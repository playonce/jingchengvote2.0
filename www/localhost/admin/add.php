<?php
require_once '../include.php';
if(@$_SESSION['adminId']==""&&@$_COOKIE['adminId']==""){
    alertMes("请先登陆","../admin/login.php");
}
@$id=$_REQUEST['id'];
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2017/4/11
 * Time: 23:17
 */
?>
<form action="ffmpeg.php?id=<?php echo $id;?>" method="post"  enctype="multipart/form-data">
    选择要上传的文件：<input type="file" name="ufile">
    <input type="submit" name="sub" value="上传压缩文件并解压">

</form>
