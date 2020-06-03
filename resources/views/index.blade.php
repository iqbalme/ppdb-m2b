<html>

<head>
    <title>PPDB Online MAN 2 Bulukumba</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- <script src="{{ asset('js/moment.min.js') }}"></script> -->

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <link rel="shortcut icon" href="{{ url('/public/uploads/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('/public/uploads/favicon.png') }}" type="image/x-icon">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-165860826-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-165860826-2');
    </script>
    <!-- End Google Analytics -->
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" src="{{ asset('css/ckeditor-style.css') }}" />
    <script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script>
</head>

<body>
    <div id="app">
        <app></app>
    </div>
</body>

</html>
