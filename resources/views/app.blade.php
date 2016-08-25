<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Zach Hoeken / Justin Nesselrotte">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BotQueue</title>

    <link rel="icon" href="favicon.gif" type="image/gif">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    {{-- @include('google.analytics') --}}

</head>
<body>

@include('menubar')
<div class="container" role="main">

    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 alert alert-info">
            <strong>Hey You!</strong> If you run into any problems, please <a
                    href="https://github.com/Hoektronics/BotQueue/issues/new">report a bug</a>. Make sure to include the
            <strong>bumblebee/info.log</strong> file if it is client-related.
        </div>
    </div>

    <footer>
        <div class="row">
            <div class="col-md-6">
                <h3>Connect</h3>
                <a href="http://www.hoektronics.com">Blog</a><br/>
                <a href="https://twitter.com/hoeken">Twitter</a><br/>
                <a href="irc://irc.freenode.net/botqueue">Freenode #BotQueue</a><br/>
                <a href="https://groups.google.com/d/forum/botqueue">Google Group</a><br/>
            </div>
            <div class="col-md-6">
                <h3>Info</h3>
                Made by Zach Hoeken and Justin Nesselrotte. (<a href="/about">about</a>)<br/>
                Software licensed under the <a href="http://www.gnu.org/copyleft/gpl.html">GPL v3.0</a>. Code at <a
                        href="https://github.com/Hoektronics/BotQueue">GitHub</a>.<br/>
                &copy; <?= date("Y") ?> <a href="http://www.hoektronics.com">Hoektronics</a>. Powered by <a
                        href="http://www.botqueue.com">BotQueue</a>.<br/>
                Page generated in <?= round(microtime(true) - LARAVEL_START, 3) ?> seconds.
            </div>
        </div>
        <br/>
    </footer>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>