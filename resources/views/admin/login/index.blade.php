<!DOCTYPE html>
<!-- saved from url=(0079)https://www.17sucai.com/preview/2/2016-07-26/jQuery-VerificationCode/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>后台登录</title>
<meta name="author" content="DeathGhost">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" tppabs="css/style.css">
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src=" {{ asset('js/verificationNumbers.js') }}" tppabs="js/verificationNumbers.js"></script>
<script src=" {{ asset('js/Particleground.js') }}" tppabs="js/Particleground.js"></script>
<script>
$(document).ready(function() {
  //粒子背景特效
  /*$('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });*/
  //验证码
  createCode();
  //测试提交，对接程序删除即可
  $(".submit_btn").click(function(){
	  location.href="javascrpt:;";
	  });
});
</script>
</head>
<body><canvas class="pg-canvas" width="1536" height="706"></canvas>
<form method="post" action="{{ route('admin.login') }}">
    {{ csrf_field() }}
<dl class="admin_login">
 <dt>
  <strong>站点后台管理系统</strong>
  <em>Management System</em>
 </dt>
 <dd class="user_icon">
  <input type="text" name="username" placeholder="账号" class="login_txtbx">
 </dd>
 <dd class="pwd_icon">
  <input type="password" name="password" placeholder="密码" class="login_txtbx">
 </dd>
 {{--<dd class="val_icon">
  <div class="checkcode">
    <input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx">
    <canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
  </div>
  <input type="button" value="验证码核验" class="ver_btn" onclick="validate();">
 </dd>--}}
 <dd>
  <input type="submit" value="立即登陆" class="submit_btn">
 </dd>
 <dd>
  <p>© 2015-2016 jou 版权所有</p>
  <p>粤ICP备19102646号-1</p>
 </dd>
</dl>
</form>

</body></html>