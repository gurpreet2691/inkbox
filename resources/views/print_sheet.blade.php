@extends('layout.mainlayout')

@section('content')
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <h1>All Filled Sheets</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Sheet_id</th>
                        <th scope="col">Type</th>
                        <th scope=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($sheets as $sheet)
                        <tr>
                            <th scope="row">{{ $sheet['id'] }}</th>
                            <td>{{ $sheet['type'] }}</td>
                            <td><a href="/api/print_sheet/{{ $sheet['id'] }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<b></b>
