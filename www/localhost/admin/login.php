<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登陆</title>
<link type="text/css" rel="stylesheet" href="../styles/reset.css">
<link type="text/css" rel="stylesheet" href="../styles/main.css">
</head>

<body>
<div class="headerBar">
	<div class="logoBar login_logo">
		<div class="comWidth">
			<div class="logo fl">
				<a href="#"><img src="images/logo.jpg" alt="精诚杯"></a>
			</div>
			<h3 class="welcome_title">欢迎登陆</h3>
		</div>
	</div>
</div>

<div class="loginBox">
	<div class="login_cont">
	<form action="doLogin.php" method="post">
			<ul class="login">
				<li class="l_tit">管理员帐号</li>
				<li class="mb_10"><input type="text"  name="username" placeholder="请输入管理员帐号"class="login_input user_icon"></li>
				<li class="l_tit">密码</li>
				<li class="mb_10"><input type="password"  name="password" class="login_input password_icon"></li>
				<li class="l_tit">验证码</li>
				<li class="mb_10"><input type="text"  name="verify" class="login_input password_icon"></li>
				<img src="getVerify.php" alt="" />
				<li class="autoLogin"><input type="checkbox" id="a1" class="checked" name="autoFlag" value="0"><label for="a1">自动登陆(一周内自动登陆)</label></li>
				<li><input type="submit"  class="login_btn" value="" ></li>
			</ul>
		</form>
	</div>
</div>

<div class="hr_25"></div>
<div class="footer">
	<p><a href="#">网站简介</a><i>|</i><a href="#">网站公告</a><i>|</i> <a href="#">招纳贤士</a><i>|</i><a href="#">联系我们</a><i>|</i>电话：</p>
	<p class="web"><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a></p>
</div>
</body>
</html>
