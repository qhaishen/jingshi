<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>门诊位置</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/home/css/style.css">
 
</head>

<body>
    <section class="cth">
        <div class="container">
            <div class="row" style="padding: 25px 0;border-bottom: 1px solid #F5F5F5;">
                <h4>门店地址</h4>
            </div>
            <div class="row">
                @foreach ($lists as $vo)
                    <div class="col-md-6 offset-md-3 col-sm-12 col-xs-12 cth_list">
                        <a href="{{ $vo->link }}">
                            <span class="cth_title">{{ $vo->name }}</span>
                            <img src="{{ $vo->cover_img }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
 
</body>

</html>