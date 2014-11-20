
<html>
<link rel="stylesheet" type="text/css" href="{{url('bootstrap/css/bootstrap.min.css')}}">
<body>
<div class="container">
    <h1>Yaraku Books</h1>
    <table class="table table-striped" width="100%">
        <thead>
        <th>#</th>
        <th>Title</th>
        <th>Author</th>
        <th>Options</th>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>cenas</td>
            <td>outro</td>
            <td><span class="glyphicon glyphicon-trash"></span></td>
        </tr>
        </tbody>
    </table>

    @yield('content')

</div>
</body>
</html>