<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>术后医嘱</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/home/css/style.css">
 
</head>

<body>
    <section id="tips">
        <div class="container">
            <div class="row">
                @foreach ($enjoins as $vo)
                    <div class="col-md-6 offset-md-3 col-sm-12 col-xs-12 tips">
                        <h4>{{ $vo->title }}</h4>
                        <div class="tips_content">{!! $vo->content !!}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
   
</body>

</html>