
<?php
header("Content-Type:text/html; charset=utf-8");
$flash2jpeg = new COM("SunCN.Flash2Jpeg");
if ($flash2jpeg){
    $a=$flash2jpeg->Flash2Jpeg("123",120,90,"你好");
    if ($a){
        $show_message.="Creat smallPic error!";
    }else{
        $show_message.="Creat smallPic OK.";
    }
    $flash2jpeg->Release();
    $flash2jpeg = null;
}else{
    $show_message.="Creat Flash2Jpeg error!";
}
?>
