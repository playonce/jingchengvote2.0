<?php
require_once 'include.php';

$sql="select * from vote_cate where id=(select max(id) from vote_cate)";
$topname=fetchOne($sql);
$sql="select * from vote_suncate WHERE  id in(SELECT sunId FROM  vote_pro WHERE cId={$topname['id']})";
$scates=fetchAll($sql);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页</title>
<script type="text/javascript" src="js/vedio.min.js"></script>

    <link href="styles/index.css" type="text/css" rel="stylesheet"/>

</head>
<body>
<div id="mian">
    <div id="top">
        <div id="nav">
            <div id="nav_left">
                <ul>
                <li><a href="index.php">主页</a></li><li><a href="voteMain.php">投票结果</a></div></li></ul>
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
        <?php  if (is_array($scates)) foreach ($scates as $cate):?>
        <div class="pro">

            <div class="pro_cate">
            <a href="page.php?cid=<?php echo $topname['id'];?>&sid=<?php echo $cate['id'];?>" style="color: #676767">   <span style="float: right;">更多》</span><?php echo $cate['sName'];?></a>
            </div>
            <?php $sql="select * from vote_pro where sunId={$cate['id']} limit 4";$pro= fetchAll($sql); if(is_array($pro)) foreach ($pro as $item):?>
            <div class="pro_main">
                <a href="works/<?php echo $item['path'];
                ?>"><div class="pro_img"><img src="works/<?php echo $item['albumPath'];?>" alt="" width="180px" height="200px" /></div></a>
                <div class="pro_name">
                    <div class="pro_name_left">
                        <?php echo $item['pSn'];?>
                    </div>
                    <div class="pro_name_right">
                        <div class="pro_name_sd">学院：<?php echo $item['college'];?></div>
                        <div class="pro_name_n">姓名：<?php echo $item['aName'];?></div>
                    </div>
                </div>
            </div>
                <?php endforeach;?>
        </div>
        <?php endforeach;?>
        <div style="height: 30px; width:auto;"></div>
    </div>
    <div id="bottom">
            <a href="admin/login.php">版权所有：精诚工作室</a>
    </div>
</div>
</body>
</html>
