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
        <h1>@{{ name  }} :: @{{ range }} :: <a :href="allLink">See All</a></h1>
        <table v-if="count > 0" class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="job in jobs">
                <td>@{{ job.id }}</td>
                <td>@{{ job.name }}</td>
            </tr>
            </tbody>
        </table>
        <div v-if="count == 0">
            No jobs to see here
        </div>
    </template>

@stop

@section('js')
    <script src="/js/vue.js"></script>
@stop

@section('end-js')
    <script type="text/javascript">
        Vue.component('jobs-list', {
            template: '#jobs-template',
            props: ['name', 'type'],
            data: function () {
                return {
                    jobs: BotQueue.jobs[this.type].jobs,
                    count: BotQueue.jobs[this.type].count
                }
            },
            computed: {
                start: function () {
                    return Math.min(this.count, 1);
                },
                end: function () {
                    return Math.min(10, this.count);
                },
                range: function () {
                    if (this.count == 0) return 'none';
                    return ''.concat(this.start, '-', this.end, ' of ', this.count);
                },
                allLink: function () {
                    return '/jobs/' + this.type;
                }
            }
        });
        var vm = new Vue({
            el: '#jobs'
        });
    </script>
@stop