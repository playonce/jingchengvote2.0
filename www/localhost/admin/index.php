<?php 
require_once '../include.php';
checkLogined();
$cates=getAllSunCate();
$sql="select * from vote_cate where id=(select max(id) from vote_cate)";
$topname=fetchOne($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>精诚杯投票系统后台</title>
<link rel="stylesheet" href="../styles/backstage.css">
</head>

<body>
    <div class="head">
            <div class="logo fl"><a href="#"></a></div>
            <h3 class="head_text fr">精诚杯投票系统</h3>
    </div>
    <div class="operation_user clearfix">
        <div class="link fr">
            <b>欢迎您
			<?php 
				if(isset($_SESSION['adminName'])){
					echo $_SESSION['adminName'];
				}elseif(isset($_COOKIE['adminName'])){
					echo $_COOKIE['adminName'];
				}
            ?>
            </b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php" class="icon icon_i">首页</a><span></span><a href="doAdminAction.php?act=logout" class="icon icon_e">退出</a>
        </div>
    </div>
    <div class="content clearfix">
        <div class="main">
            <!--右侧内容-->
            <div class="cont">
                <div class="title">后台管理</div>
      	 		<!-- 嵌套网页开始 -->         
                <iframe src="main.php"  frameborder="0" name="mainFrame" width="100%" height="522"></iframe>
                <!-- 嵌套网页结束 -->   
            </div>
        </div>
        <!--左侧列表-->
        <div class="menu">
            <div class="cont">
                <div class="title">管理员</div>
                <ul class="mList">
                    <li>
                        <h3><span onclick="show('menu1','change1')" id="change1">+</span>作品管理</h3>
                        <dl id="menu1" style="display:none;">
                        	<dd><a href="addPro.php" target="mainFrame">添加作品</a></dd>
                            <?php if ($cates) foreach ($cates as $cate):?>
                            <dd><a href="listPro.php?cid=<?php echo $topname['id'];?>&sid=<?php echo $cate['id'];?>" target="mainFrame"><?php echo $cate['sName'];?>作品</a></dd>
                            <?php endforeach;?>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu2','change2')" id="change2">+</span>分类管理</h3>
                        <dl id="menu2" style="display:none;">
                        	<dd><a href="addCate.php" target="mainFrame">添加届数</a></dd>
							<dd><a href="listCate.php" target="mainFrame">届数列表</a></dd>
							<dd><a href="addSunCate.php" target="mainFrame">添加分类</a></dd>
							<dd><a href="listSunCate.php" target="mainFrame">分类列表</a></dd>

                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu5','change5')" id="change5">+</span>管理员管理</h3>
                        <dl id="menu5" style="display:none;">
                        	<dd><a href="addAdmin.php" target="mainFrame">添加管理员</a></dd>
                            <dd><a href="listAdmin.php" target="mainFrame">管理员列表</a></dd>
                        </dl>
                    </li>
                    
                         <li>
                        <h3><span onclick="show('menu6','change6')" id="change6">+</span>作品图片管理</h3>
                        <dl id="menu6" style="display:none;">
                            <dd><a href="listProImages.php?keycates=1&keys=0" target="mainFrame">作品图片列表</a></dd>
                        </dl>
                    </li>
					<li>
						<h3><span onclick="show('menu7','change7')" id="change7">+</span>个人操作</h3>
						<dl id="menu7" style="display:none;">
							<dd><a href="editAdmin?id=<?php echo $_SESSION['adminId'];?>)" target="mainFrame">个人操作</a></dd>
						</dl>
					</li>
                </ul>
            </div>
        </div>

    </div>
    <script type="text/javascript">
    	function show(num,change){
	    		var menu=document.getElementById(num);
	    		var change=document.getElementById(change);
	    		if(change.innerHTML=="+"){
	    				change.innerHTML="-";
	        	}else{
						change.innerHTML="+";
	            }
    		   if(menu.style.display=='none'){
    	             menu.style.display='';
    		    }else{
    		         menu.style.display='none';
    		    }
        }

    </script>
</body>
</html>