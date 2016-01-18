<template>
    <div class="container">

        <bq-menubar></bq-menubar>

        <section id="content" style="margin-top:60px">
            <!--
            @ifSection('title')
            <div class="page-header">
                <h1>@yield('title')</h1>
            </div>
            @endif
            -->

            <div class="row">
                <div class="span12">
                    <router-view></router-view>
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
                    Made by Zach Hoeken and Justin Nesselrotte. (<a v-link="{ path: '/about' }">about</a>)<br/>
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
</template>

<script>
    import MenuBar from './components/menu.vue'
    export default {
        components: {
            'bq-menubar': MenuBar
        }
    }
</script>