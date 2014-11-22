{{ Form::open(['url' => 'books','method'=>'get']) }}
<div class="row">
    <div class="col-lg-6">
        <div class="input-group">
            {{ Form::text('search',Input::old('book'),['placeholder'=>'Search book...', 'class'=>'form-control']) }}
            <span class="input-group-btn">
                {{ Form::submit('Search',['class'=>'btn btn-info']) }}
            </span>
        </div>
    </div>
</div>
{{ Form::close() }}

<table class="table table-striped" width="100%">
    <thead>
    <th>#</th>
    <th>Title <a href="{{ url('books?orderBy=title') }} "> <span class="glyphicon glyphicon-chevron-down"></span> </a> </th>
    <th>Author <a href="{{ url('books?orderBy=author') }} "> <span class="glyphicon glyphicon-chevron-down"></span> </a> </th>
    <th>Options</th>
    </thead>
    <tbody>
    @if (isset($books))
    @forelse($books as $book)
    <tr>
        <td>{{ $book->id }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>
            <a href="{{ url ('books/'.$book->id.'/delete') }}"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
    </tr>
    @empty
    <tr><td colspan="4">No books</td></tr>
    @endforelse
    @endif

    </tbody>
</table>


<hr>

{{HTML::link('books/import-books','Import books from csv...')}}