@extends('layouts.base')

@section('search')
    @extends('search')
@endsection

@section('content')
    <div style="width: 50%">
        @if ( empty( $errorMessage ) )
            {!! $twitterGraph->container() !!}
        @endif
    </div>
@endsection
