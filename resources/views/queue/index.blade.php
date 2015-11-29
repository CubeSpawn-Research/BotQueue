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

@section('end-js')
    <script src="/js/vue/queue_list.js"></script>
@stop