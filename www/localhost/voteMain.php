<?php
require_once 'include.php';

    $sql="select * from vote_cate where id=(select max(id) from vote_cate)";
    $topname=fetchOne($sql);
    $sql="select * from vote_suncate WHERE  id in(SELECT sunId FROM  vote_pro WHERE cId={$topname['id']}) ORDER BY pSn ASC ";
    $scates=fetchAll($sql);
    if(!($scates && is_array($scates)))alertMes("不好意思，网站维护中!!!", "http://www.jxutcm.edu.cn/");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>投票统计</title>


<!--详情-->
<link href="styles/index.css" type="text/css" rel="stylesheet"/>

</head>
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
        <?php if (is_array($scates)) foreach ($scates as $scate):
            $sql="select * from vote_pro where sunId={$scate['id']} ORDER BY pSn ASC ";
            $thisPro=fetchAll($sql);
            $sql="select max(pVote) as max from vote_pro WHERE sunId={$scate['id']}";
            $maxVote=fetchOne($sql);
            if ($maxVote['max']==0)$maxVote['max']=1;
            ?>
        <div class="cates">
            <table width="100%">
                <caption><?php echo  $scate['sName'];?></caption>
                <?php if (is_array($thisPro)) foreach ($thisPro as $pro):?>
                <tr>
                    <td width="5%" height="20px"><?php echo $pro['pSn'];?></td>
                    <td width="20%" height="20px"><?php echo $pro['pName'];?></td>
                    <td width="65%" height="20px"><div style="background-color:#fffae2;width: 100%;height: 20px;"> <div style="background-color: #1D7AD9;height:20px;width: <?php $tv=100*$pro['pVote']/$maxVote['max'];echo $tv;?>%;"></div> </div></td>
                    <td width="10%" height="20px"><?php echo $pro['pVote']?>票</td>
                </tr>
            <?php endforeach;?>
            </table>

        </div>
        <?php endforeach;?>
    </div>
    <div id="bottom">
        <a href="admin/login.php">版权所有：精诚工作室</a>
    </div>
</div>
</body>

</html>
