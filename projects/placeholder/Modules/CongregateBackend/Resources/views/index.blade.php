
@extends('backend_theme::layouts.two_columns_left')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('congregatebackend.name') !!}
    </p>
@endsection
