<?php
require_once 'include.php';
@$id =@$_REQUEST['id'];
$cates=getAllcate();
$suncates=getAllSuncate();
if(!($cates && is_array($cates))||!($suncates && is_array($suncates))){
    alertMes("不好意思，网站维护中!!!", "http://www.jxutcm.edu.cn/");
}
$mess;
if($id==null) $mess=alertMes("错误！","index.php");
$sql="select * from vote_pro WHERE  id={$id} ORDER BY pSn ASC ";
$pro=fetchOne($sql);
$sql="select * from vote_album where pid={$id}";
$proImg=fetchOne($sql);
$sql="select * from vote_cate where id=(select max(id) from vote_cate)";
$topname=fetchOne($sql);
$sql="select * from vote_suncate WHERE  id in(SELECT sunId FROM  vote_pro WHERE cId={$topname['id']}) ORDER BY pSn ASC ";
$scates=fetchAll($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>作品详情</title>

    <script type="text/javascript" src="js/vedio.min.js"></script>
    <link href="styles/index.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
if(@$mess){
    echo $mess;
}
?>
<!--详情-->
<body>
<div id="mian">
    <div id="top">
        <div id="nav">
            <div id="nav_left"><ul>
                    <li><a href="index.php">主页</a></li><li><a href="voteMain.php">投票结果</a></li></ul></div>
            <div id="nav_right"><ul>
                    <?php if (is_array($scates)) foreach ($scates as $cate):?>
                        <li><a href="page.php?cid=<?php echo $topname['id'];?>&sid=<?php echo $cate['id'];?>"> <?php echo $cate['sName'];?></a></li>
                    <?php endforeach;?>
                </ul></div>
        </div>
        <!--标题背景图-->
        <div id="title">

        </div>
        <!--标题背景图-->
        <div id="brief">
            比赛项目：<br/>
            1、网页创意及设计赛<br/>
            2、视频制作（包含微电影及原创MV）、FLASH作品设计赛（包含电子相册）<br/>
            3、平面艺术作品设计赛<br/>
            注意事项：网页作品请点击图片查看页面！
        </div>
    </div>
    <div id="content">
        <div id="pro_c">
            <div style="height: 30px; width:auto;"></div>
        <div><?php
            $sql="select albumPath,Path from vote_album where pid={$id} limit 1";
            $proIg=fetchOne($sql);
            $info = pathinfo("admin\\uploads\\" . $proIg['albumPath']);
            $pIname = basename($proIg['albumPath'],".".$info['extension']);
            if (file_exists("admin\\uploads\\".$pIname)):?>
                <?php if (file_exists("admin\\uploads\\".$pIname."\\index.html")):?><a href="admin/uploads/<?php echo $pIname."\\index.html";?>"><img src="admin/uploads/<?php echo $proIg['albumPath'];?>" width="900px"> </a>
                <?php elseif (file_exists("admin\\uploads\\".$pIname."\\Untitled-1.html")):?><a href="admin/uploads/<?php echo $pIname."\\Untitled.html";?>"><img src="admin/uploads/<?php echo $proIg['albumPath'];?>" width="900px"> </a>
                <?php elseif (file_exists("admin\\uploads\\".$pIname."\\main.html")):?><a href="admin/uploads/<?php echo $pIname."\\Untitled.html";?>"><img src="admin/uploads/<?php echo $proIg['albumPath'];?>" width="900px"> </a>
                <?php endif;?>
            <?php elseif (file_exists("admin\\uploads\\".$pIname.".swf")):?>
                <embed src="admin/uploads/<?php echo $pIname.".swf";?>" hidden=no width="800" height="450"></embed>
            <?php elseif (file_exists("admin\\uploads\\".$pIname.".mp4")):?>
                <embed src="admin/uploads/<?php echo $pIname.".mp4";?>" hidden=no width="900" height="450"></embed>
            <?php elseif (file_exists("admin\\uploads\\".$proIg['albumPath'])):?>
            <img src="admin/uploads/<?php echo $proIg['albumPath'];?>" width="900px" />
            <?php endif;?>
            </div>
        <div>作者：<?php echo $pro['aName'];?></div>
        <div>所属学院：<?php echo $pro['college'];?></div>
        <div>作品名称：<?php echo $pro['pName'];?></div>
        <div>作品简介：<br/><?php echo $pro['pDesc'];?></div>
        <div>作品票数：<?php echo $pro['pVote'];?></div>

        <div style="height: 30px; width:auto;"></div>
        </div>
    </div>
    <div id="bottom">
        <a href="admin/login.php">版权所有：精诚工作室</a>
    </div>
</div>
</body>


<!--详情-->
</body>
</html>
