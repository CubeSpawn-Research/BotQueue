<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">BotQueue</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/upload">Create Job</a></li>
                        <li><a href="/bot/register">Register Bot</a></li>
                        <li><a href="/queue/create">Create Queue</a></li>
                    </ul>
                </li>
                <li><a href="/bots">Bots</a></li>
                <li><a href="/queues">Queues</a></li>
                <li><a href="/jobs">Jobs</a></li>
                <li><a href="/apps">App</a></li>
                <li><a href="/slicers">Slicers</a></li>
                <li><a href="/stats">Stats</a></li>
                <li><a href="/help">Help</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="divider-vertical"></li>
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown">Hello, {{ Auth::user()->username }}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/preferences">Preferences</a></li>
                            <li class="divider"></li>
                            <li><a href="/logout">Log Out</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/login">Log in</a></li>
                    <li><a href="/register">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>