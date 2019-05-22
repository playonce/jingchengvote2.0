<?php
function filer($id)
{
    $path = getcwd();//获取当前系统目录
    if (@$_POST['sub']) {
        $tname = $_FILES["ufile"]["tmp_name"];
        $fname = $_FILES["ufile"]["name"];
        @$pathNew = $path . "\\uploads";
        $fhname = pathinfo($fname);
        if (@$fhname['extension'] == "rar") {
        @move_uploaded_file($tname, $fname);
        $obj = new com("wscript.shell");//使用PHP预定义的Com组件加载Shell,加载wscript.shell用来执行dos命令的组件
        $obj->run("winrar x $path\\" . $fname . " " . $pathNew, 1, true);//所要执行的命令
        $sql = "select * from vote_album where pid={$id} limit 1";
        $cname = fetchOne($sql);
        $info = pathinfo("uploads\\" . $cname['albumPath']);
        $ccname = basename($cname['albumPath'],  ".".$info['extension']);
        $info = pathinfo($fname);
        $fcname = basename($fname, ".".$info['extension']);
        $scname=$fcname.".swf";
        if(file_exists("uploads\\".$scname))
            rename("uploads\\".$scname, "uploads\\".$ccname.".swf");
        else
        rename("uploads\\".$fcname, "uploads\\".$ccname);
        unlink($fname);//解压后删除已上传的压缩文件
        }else return;
    }
}
?>

