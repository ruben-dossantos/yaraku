
<html>
<head>
    <title>Yaraku's Bookstore</title>
</head>
<link rel="stylesheet" type="text/css" href="{{url('bootstrap/css/bootstrap.min.css')}}">
<body>
<div class="container">
    <h1>Yaraku Books - Welcome {{$name}}</h1>
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

    {{{ isset($books) ? $books : '<-Default->' }}}

    <br><br>

    @if (isset($books))
        @forelse($books as $book)
            <li>{{ $book->title }}</li>
        @empty
            <p>No books</p>
        @endforelse
    @endif

    <br><br>

    @yield('content')

</div>
</body>
</html>