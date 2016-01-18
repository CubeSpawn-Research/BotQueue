<template>
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
                            <li v-link-active><a v-link="{ path: '/', exact: true }">Dashboard</a></li>
                            <li :class="{ 'active': area == 'create' }" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a v-link="'/upload'">Create Job</a></li>
                                    <li><a v-link="'/bot/register'">Register Bot</a></li>
                                    <li><a v-link="'/queue/create'">Create Queue</a></li>
                                </ul>
                            </li>
                            <li v-link-active><a v-link="'/bots'">Bots</a></li>
                            <li v-link-active><a v-link="'/queues'">Queues</a></li>
                            <li v-link-active><a v-link="'/jobs'">Jobs</a></li>
                            <li v-link-active><a v-link="'/apps'">App</a></li>
                            <li v-link-active><a v-link="'/slicers'">Slicers</a></li>
                            <li v-link-active><a v-link="'/stats'">Stats</a></li>
                            <li v-link-active><a v-link="'/help'">Help</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li class="divider-vertical"></li>
                            <li>
                                <a v-link="'/login'" style="padding-left: 17px; background: transparent url('/img/lock_icon.png') no-repeat 0 center;">
                                    Log in
                                </a>
                            </li>
                            <li><a v-link="'/register'">Sign up</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>