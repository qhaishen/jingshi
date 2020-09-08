 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员权益</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <section style="padding-top:20px;min-height: 550px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-sm-12 col-xs-12">
                    <div>
                        {!! $users->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>