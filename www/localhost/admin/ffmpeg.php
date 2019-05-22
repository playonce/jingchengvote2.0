<?php
require_once '../include.php';
@$id=$_REQUEST['id'];
@$wid=$_SESSION['wid'];
if(@$_SESSION['wid']==null)
    $wid=800;
@$heg=$_SESSION['heg'];
if (@$_SESSION['heg']==null)
    $heg=450;
header("content-type:text/html;charset=utf-8");

function foreachDir($dirname)
{
    if(!is_dir($dirname))
    {
        exit();
    }
    $handle1=opendir($dirname); //打开目录

    while (($file = readdir($handle1))!==false) //读取目录
    {
        if($file!="." && $file!='..')
        {
            if(is_dir($dirname.$file))
            {
                //foreachDir($dirname.$file); //如果注释号去掉，将会递归修改文件夹内的文件夹文件
            }
            else
            {
                $temp = substr($file, strrpos($file, '.')+1); //获取后缀格式
                if ($temp == "txt")
                {
                    $pos = strripos($file,'.'); //获取到文件名的位置
                    $filename = substr($file,0,$pos); //获取文件名
                    rename($dirname.'/'.$file,$dirname.'/'.$filename.'.bat'); //替换为bat后缀格式。
                }
            }
        }
    }
}



    $path = getcwd();
    @$pathadd = $path . "\\uploads";
    $mpVeo = uploadMpFile($pathadd);
    $vname=$mpVeo['0']['name'];
    @$from = $pathadd . "\\" . $vname;
    $to = $path . "\\uploads";
    $pathvName=pathinfo($vname);
    @$name=basename($from,"{$pathvName[extension]}");
    $name=$name."png";

    if(is_array($mpVeo)&&$mpVeo){
        $sql="insert into vote_album(pid,albumPath) VALUES({$id},'{$name}')";
        mysql_query($sql);
        }
    $str = "ffmpeg -i " . $from . " -y -f mjpeg -ss 3 -t 1 -s ".$wid."x".$heg." ".$to . "\\" . $name;
echo $str;

    @unlink("a.bat");
    $filename1 = $path . "\\a.txt";
    $handle = fopen($filename1, "w, ccs=gbk");
    $stra = "%~dp0 \r\n";
    $strs = fwrite($handle, $stra);
    $strs = fwrite($handle, $str);
    fclose($handle);
    foreachDir($path);
    $strb = $path . "\\a.bat";
    exec($strb, $out, $status);

if($id!=null&&is_array($mpVeo)&&$mpVeo) {
    thumb($path . "/uploads/" . $name, "../image_45/" . $name, 45, 50);
    thumb($path . "/uploads/" . $name, "../image_180/" . $name, 180, 200);
    echo "<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看作品品列表</a>";
}
?>

