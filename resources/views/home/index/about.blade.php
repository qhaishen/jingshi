<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
	<title>关于我们</title>
	<link rel="stylesheet" href="/static/home/layui/css/layui.css" media="all">
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	
</head>
<body>
	<section style="min-height: 550px;">
		<div class="container">
			<div class="row">
				<div class="layui-tab layui-tab-brief col-md-6 offset-md-3 col-sm-12 col-xs-12" lay-filter="docDemoTabBrief">
				  <ul class="layui-tab-title text-center">
				    <li class="layui-this">关于我们</li>
				    <li>加入我们</li>
				  </ul>
				  <div class="layui-tab-content" >
				    <div class="layui-tab-item layui-show">
				    	{!! $config['about'] !!}
				    </div>
				    <div class="layui-tab-item">
				    	{!! $config['join'] !!}
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</section>

<script src="/static/home/layui/layui.js" charset="utf-8"></script>
<script>
layui.use('element', function(){
  var $ = layui.jquery
  ,element = layui.element; 
  
});
</script>
</body>
</html>