<html>
<head>
    @section('title')
    <title>{{$title}}</title>
    @show
    {{ HTML::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
</head>
<body>
<div class="container">

    <h1>Yaraku Books - Welcome {{$name}}</h1>

    @if(Session::has('success'))
    <div data-alert class="alert alert-success">
        {{Session::get('success')}}
        <a href="/books" class="close">&times;</a>
    </div>
    @endif
    {{$main}}

</div>
</body>
</html>
