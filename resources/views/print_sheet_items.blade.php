@extends('layout.mainlayout')

@section('content')
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                @if(count($sheet_items) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">title</th>
                        <th scope="col">size</th>
                        <th scope="col">status</th>
                        <th scope="col">sheet_url</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sheet_items as $items)
                            <tr>
                                <th scope="row">{{ $items->title }}</th>
                                <td>{{ $items->size }}</td>
                                <td>{{ $items->status }}</td>
                                <td>{{ $items->sheet_url }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h1>No record found</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
