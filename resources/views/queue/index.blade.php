@extends('app')

@section('title', Auth::user()->username . "'s Queues");

@section('content')
    <div id="queues-list">
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Available</th>
                <th>Working</th>
                <th>Completed</th>
                <th>Failed</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="queue in queues">
                    <td>@{{ queue.name }}</td>
                    <td><span class="label">@{{ queue.available }}</span></td>
                    <td><span class="label label-info">@{{ queue.taken }}</span></td>
                    <td><span class="label label-success">@{{ queue.completed }}</span></td>
                    <td><span class="label label-important">@{{ queue.failed }}</span></td>
                    <td><span class="label label-inverse">@{{ queue.total }}</span></td>
                </tr>
                <tr>
                    <th>Total</th>
                    <th><span class="label">@{{ total.available }}</span></th>
                    <th><span class="label label-info">@{{ total.taken }}</span></th>
                    <th><span class="label label-success">@{{ total.completed }}</span></th>
                    <th><span class="label label-important">@{{ total.failed }}</span></th>
                    <th><span class="label label-inverse">@{{ total.total }}</span></th>
                </tr>
            </tbody>
        </table>
    </div>
@stop

@section('js')
    <script src="/js/vue.js"></script>
@stop

@section('end-js')
    <script type="text/javascript">
        Vue.config.debug = true;
        var vm = new Vue({
            el: '#queues-list',
            data: {
                queues: BotQueue.queues
            },
            computed: {
                total: function() {
                    var self = this;
                    var values = Object.keys(this.queues).map(function(key) { return self.queues[key] });
                    return values.reduce(function(previous, current) {
                        return {
                            'available': previous.available + parseInt(current.available),
                            'taken': previous.taken + parseInt(current.taken),
                            'completed': previous.completed + parseInt(current.completed),
                            'failed': previous.failed + parseInt(current.failed),
                            'total': previous.total + parseInt(current.total)
                        }
                    }, {'available': 0, 'taken': 0, 'completed': 0, 'failed':0, 'total': 0});
                }
            }
        });
    </script>
@stop