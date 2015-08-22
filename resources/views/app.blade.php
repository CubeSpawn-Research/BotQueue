<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BotQueue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Zach Hoeken / Justin Nesselrotte">
    <link rel="icon" href="favicon.gif" type="image/gif">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="/bootstrap/2.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap/2.3.0/css/bootstrap-responsive.min.css" rel="stylesheet">
    @yield('css')

    <!-- Le jquery -->
    <script src="/js/jquery-1.11.0.min.js"></script>
    <script src="/js/jquery-ui-1.10.3/ui/minified/jquery-ui.min.js"></script>
    <script language="javascript" type="text/javascript" src="/js/jquery.imagesloaded.min.js"></script>
    <script language="javascript" type="text/javascript" src="/js/flot-0.7/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="/js/flot-0.7/jquery.flot.selection.js"></script>
    <script language="javascript" type="text/javascript" src="/js/jquery.flot.tooltip.min.js"></script>

    <!-- Backbone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js" type="text/javascript"></script>

    {{-- @include('google.analytics') --}}

</head>
<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="50">
<div class="container">

    @include('menubar')

    <section id="content" style="margin-top:60px">
        @ifSection('title')
            <div class="page-header">
                <h1>@yield('title')</h1>
            </div>
        @endif

        <div class="row">
            <div class="span12">
                @yield('content')
            </div>
        </div>

        <br/><br/>

        <div class="alert alert-info">
            <strong>Hey You!</strong> If you run into any problems, please <a
                    href="https://github.com/Hoektronics/BotQueue/issues/new">report a bug</a>. Make sure to include the
            <strong>bumblebee/info.log</strong> file if it is client-related.
        </div>

    </section>

    <footer>
        <div class="row">
            <div class="span6">
                <h3>Connect</h3>
                <a href="http://www.hoektronics.com">Blog</a><br/>
                <a href="https://twitter.com/hoeken">Twitter</a><br/>
                <a href="irc://irc.freenode.net/botqueue">Freenode #BotQueue</a><br/>
                <a href="https://groups.google.com/d/forum/botqueue">Google Group</a><br/>
            </div>
            <div class="span6">
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

<script src="/js/botqueue.js"></script>
<script src="/bootstrap/2.3.0/js/bootstrap.js"></script>
@yield('end-js')
</body>
</html>