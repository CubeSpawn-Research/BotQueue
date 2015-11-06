@extends('app')

@section('title', str_plural(Auth::user()->name). ' jobs')

@section('content')

<div id="jobs">
    <div class="row">
        <div class="span6">
            <jobs-list name="Available" type="available"></jobs-list>
        </div>
        <div class="span6">
            <jobs-list name="Working" type="working"></jobs-list>
        </div>
    </div>
    <div class="row">
        <div class="span6">
            <jobs-list name="Completed" type="completed"></jobs-list>
        </div>
        <div class="span6">
            <jobs-list name="Failed" type="failed"></jobs-list>
        </div>
    </div>
</div>

    <template id="jobs-template">
        <h1>@{{ name  }} :: @{{ compute }} :: @{{ allLink }}</h1>
    </template>

@stop

@section('js')
    <script src="/js/vue.js"></script>
@stop

@section('end-js')
    <script type="text/javascript">
        Vue.config.debug = true;
        Vue.component('jobs-list', {
            template: '#jobs-template',
            props: ['name', 'type'],
            data: function() {
                return {
                    jobs: BotQueue.jobs[this.type].data,
                    total: BotQueue.jobs[this.type].total
                };
            },
            computed: {
                start: function() {
                    return Math.min(this.total, 1);
                },
                end: function() {
                    return Math.min(10, this.total);
                },
                compute: function() {
                    if(this.total == 0) return 'none';
                    return ''.concat(this.start, '-', this.end, ' of ', this.total);
                }
            }
        });
        var vm = new Vue({
            el: '#jobs'
        });
    </script>
@stop