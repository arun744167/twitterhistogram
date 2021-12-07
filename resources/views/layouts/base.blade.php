<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> Twitter Histogram</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">

    </head>
    <body>
    <div class="ui container" >
        <h1> User Tweet's active by hours </h1>
        @yield('search')

        @if( !empty( $errorMessage ) )
            <div class="ui negative message"  >
                <span>{{ $errorMessage }}</span>
            </div>
        @endif

        @yield('content')
    </div>

     @if( empty( $errorMessage ))
         {!! $twitterGraph->script() !!}
     @endif
    </body>
</html>
