<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="index,follow"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.min.css') }}" media="all">
        <script src="https://kit.fontawesome.com/fbba33911d.js" crossorigin="anonymous"></script>

        <script>
            window.vars = window.vars || {};
            window.vars['csrf_token'] = '{{ csrf_token() }}';
        </script>
    </head>
    <body>
        @if (Auth::check())
            @include('_partials.modal.delete')
            @include('_partials.navigation')
        @endif

        @include('_partials.alerts')

        @include('_partials.breadcrumb')

        <div class="content pl-3 pr-3">
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <?php if (App::environment('local')): ?>
            <script src="{{ asset('js/jq.main.js') }}"></script>
        <?php else: ?>
            <script src="{{ asset('js/jq.main.min.js') }}"></script>
        <?php endif; ?>

        @stack('scripts')
    </body>
</html>
