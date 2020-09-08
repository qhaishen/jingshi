<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>活动回顾</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
 
</head>

<body>
    <section class="cth">
        <div class="container">
            <div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12" style="padding:25px 10px 10px 10px;">
            		<h4>{{ $actives->title }}</h4>
              		<p style="color:#888;">{{ $actives->created_at }}</p>
               		<p style="font-size:14px;">{!! $actives->content !!}</p>
            	</div>
               
            </div>
        </div>
    </section>
</body>

</html>