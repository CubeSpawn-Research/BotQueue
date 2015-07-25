
<section id="navbar">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <div class="pull-right">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#menu-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <a class="brand" style="margin-left:0" href="/">BotQueue</a>

                <div id="menu-bar" class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="{{ Area::active('dashboard') }}"><a href="/">Dashboard</a></li>
                        <li class="{{ Area::active('create') }} dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/upload">Create Job</a></li>
                                <li><a href="/bot/register">Register Bot</a></li>
                                <li><a href="/queue/create">Create Queue</a></li>
                            </ul>
                        </li>
                        <li class="{{ Area::active('bots') }}"><a href="/bots">Bots</a></li>
                        <li class="{{ Area::active('queues') }}"><a href="/queues">Queues</a></li>
                        <li class="{{ Area::active('jobs') }}"><a href="/jobs">Jobs</a></li>
                        <li class="{{ Area::active('app') }}"><a href="/apps">App</a></li>
                        <li class="{{ Area::active('slicers') }}"><a href="/slicers">Slicers</a></li>
                        <li class="{{ Area::active('stats') }}"><a href="/stats">Stats</a></li>
                        <li class="{{ Area::active('help') }}"><a href="/help">Help</a></li>
                        <? if (User::isAdmin()): ?>
                        <li class="{{ Area::active('admin') }} dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<b
                                        class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin">Admin Panel</a></li>
                                <li><a href="/bots/live">Live view</a></li>
                            </ul>
                        </li>
                        <? endif ?>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li>
                            <a href="/login"
                               style="padding-left: 17px; background: transparent url('/img/lock_icon.png') no-repeat 0 center;">Log
                                in</a>
                        </li>
                        <li><a href="/register">Sign up</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>