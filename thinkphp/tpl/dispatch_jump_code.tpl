<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=640px,user-scalable=no">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/login.min.css">
    <meta charset="utf-8"/>
    <style>
        body .main {
            width: 600px;
        }
        .success {
            text-align: center;
            font-size: 50px;
        }
        .layui-form-item{
            text-align: center;
        }
        .layui-form-item p {
            padding-bottom: 20px;
        }
        .success {
            text-shadow: 4px 4px 0.2em #f87, 0 0 0.2em #f87;
        }
    </style>
</head>
<body>
<div class="main">
    <form class="layui-form" action="{:url('doLogin')}">
        <div class="layui-form-item">
            <h1 style="color:#ccc">daoAdmin提示</h1>
        </div>
        <div class="layui-form-item">
            <p class="success"><?php echo(strip_tags($msg));?></p>
            <p class="detail"></p>
            <p class="jump">
                页面自动 <a id="href" style="color: #a6efa6;" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b>
            </p>
        </div>
        <div class="layui-form-item">
            <a style="color:#00dfb9" href='http://www.linkseo.cn' target="_blank">联派网络提供技术支持</a>
        </div>
    </form>
</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),
            href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>