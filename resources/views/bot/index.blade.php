@extends('app')

@section('title', 'Bots')

@section('content')
        <table id="bots-list" class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Last Seen</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="bot in bots">
                <td>@{{ bot.name }}</td>
                <td><bq-bot-status :status="bot.status"></bq-bot-status></td>
                <td></td>
            </tr>
            </tbody>
        </table>
@stop

@section('end-js')
    <script src="/js/vue/bot_list.js"></script>
@stop