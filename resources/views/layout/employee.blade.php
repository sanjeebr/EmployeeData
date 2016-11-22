<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <link href="https://fonts.googleapis.com/css?family=Hammersmith+One" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css?v=1.0')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=1.0')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    @yield('head')
</head>
<body>
    <div class="jumbotron door" id="home">

        <div class="mask"></div>
        <a href="" class="menu-toggle" id="nav-expander"><i class="fa fa-bars"></i></a>
        <!-- Offsite navigation -->
        <nav class="menu">
            <a href="#" class="close"><i class="fa fa-close"></i></a>
            <h3>Menu</h3>
            <ul class="nav">
                <li><a data-scroll href="#home">Home</a></li>
                <li><a data-scroll href="#services">Statistics</a></li>
                <li><a data-scroll href="#portfolio">User data</a></li>
            </ul>
        </nav>

        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @yield('content')

            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/app.js?v=1.0')}}"></script>
    @yield('bottom')
</body>
</html>