<?php
require_once 'include.php';
$cid=$_REQUEST['cid'];
$sid=$_REQUEST['sid'];
if($cid==null||$sid==null){
    alertMes("不好意思，网站维护中!!!", "http://www.jxutcm.edu.cn/");
}
$sql="select * from vote_cate where id={$cid}";
$topname=fetchOne($sql);
$sql="select * from vote_suncate WHERE  id={$sid}";
$scates=fetchAll($sql);
$sql="select * from vote_suncate WHERE  id in(SELECT sunId FROM  vote_pro WHERE cId={$topname['id']})";
$sscates=fetchAll($sql);
if(!($scates && is_array($scates)))alertMes("不好意思，网站维护中!!!", "http://www.jxutcm.edu.cn/");

?>
    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>首页</title>
        <link type="text/css" rel="stylesheet" href="styles/reset.css">
        <link type="text/css" rel="stylesheet" href="styles/main.css">
        <!--[if IE 6]>
        <script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
        <script type="text/javascript" src="js/ie6Fixpng.js"></script>
        <![endif]-->
        <script type="text/javascript">
            function proIN(id) {
                window.location='pro.php?id='+id;
            }
            function  voteIN(id) {
                window.location='vote.php?id='+id;
            }

        </script>
        <script type="text/javascript" src="js/vedio.min.js"></script>
        <link href="styles/index.css" type="text/css" rel="stylesheet"/>

    </head>
    <body>
    <div id="mian">
        <div id="top">
            <div id="nav">
                <div id="nav_left"><ul>
                        <li><a href="index.php">主页</a></li><li><a href="voteMain.php">投票结果</a></li></ul></div>
                <div id="nav_right"><ul>
                        <?php if (is_array($sscates)) foreach ($sscates as $cate):?>
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
            <?php $sql="select * from vote_pro where sunId={$sid} ORDER BY pSn ASC ";$pro= fetchAll($sql);$i=0; if (is_array($pro)) foreach ($pro as $item):?>
                <?php if ($i%4==0):?>
                <div class="pro"><?php endif;?>

                    <div class="pro_p">
                            <div class="pro_main1">
                                <a href="<?php
                                $sql="select albumPath,Path from vote_album where pid={$item['id']} limit 1";
                                $proIg=fetchOne($sql);
                                $info = pathinfo("admin\\uploads\\" . $proIg['albumPath']);
                                $pIname = basename($proIg['albumPath'],".".$info['extension']);
                                if (file_exists("admin\\uploads\\".$pIname))
                                {
                                    if (file_exists("admin\\uploads\\".$pIname."\\index.html"))
                                        echo "admin\\uploads\\".$pIname."\\index.html";
                                    else if (file_exists("admin\\uploads\\".$pIname."\\Untitled-1.html"))
                                        echo "admin\\uploads\\".$pIname."\\Untitled-1.html";
                                    else if (file_exists("admin\\uploads\\".$pIname."\\main.html"))
                                        echo "admin\\uploads\\".$pIname."\\main.html";
                                }else if (file_exists("admin\\uploads\\".$pIname.".swf"))
                                    echo "admin\\uploads\\".$pIname.".swf";
                                else if (file_exists("admin\\uploads\\".$pIname.".mp4"))
                                    echo "admin\\uploads\\".$pIname.".mp4";
                                else if (file_exists("admin\\uploads\\".$proIg['albumPath']))
                                    echo "admin\\uploads\\".$proIg['albumPath'];
                                ?>"><div class="pro_img"><img src="image_180/<?php echo $proIg['albumPath'];?>" alt="" width="180px" height="200px" /></div></a>
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
                            <div class="btn">
                                <input type="button" value="查看" style="background-color: #fff;border: 1px solid #ccc; width: 50px; height: 30px;" onclick="proIN(<?php echo $item["id"]?>)">&nbsp;&nbsp;<input type="button" value="投票" style="background-color: #fff;border: 1px solid #ccc; width: 50px; height: 30px;" onclick="voteIN(<?php echo $item["id"]?>)">
                            </div>
                    </div>
                <?php if ($i%4==3):?></div><?php endif;?>
            <?php $i++;endforeach;?>
            <div style="height: 30px; width:auto;"></div>
        </div>
        <div id="bottom">
            <a href="admin/login.php">版权所有：精诚工作室</a>
        </div>
    </div>
    </body>
    </html>
