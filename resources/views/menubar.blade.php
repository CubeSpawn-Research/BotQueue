@if(!Auth::check())
	<a href="https://github.com/Hoektronics/BotQueue">
		<img style="position: absolute; top: 40px; right: 0; border: 0;"
		     src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67"
		     alt="Fork me on GitHub"
		     data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png">
	</a>
@endif

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
                    </ul>
                    <ul class="nav pull-right">
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
	                        <li>
	                            <a href="/login"
	                               style="padding-left: 17px; background: transparent url('/img/lock_icon.png') no-repeat 0 center;">Log
	                                in</a>
	                        </li>
	                        <li><a href="/register">Sign up</a></li>
	                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>