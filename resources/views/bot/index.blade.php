@extends('app')

@section('content')
    <div class="row">
        <h1 class="col-md-6">Bots</h1>
        <div class="pull-right">
            <a href="{{ url('/bot/register') }}" class="btn btn-lg btn-primary">Register New Bot</a>
        </div>
    </div>

    <div class="row">
        @if($bots->count() > 0)
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Last Seen</th>
                    </thead>
                    <tbody>
                    @foreach($bots as $bot)
                        <tr>
                            <td><a href="{{ url('bot', [$bot]) }}">{{ $bot->name }}</a></td>
                            <td>{{ $bot->status }}</td>
                            <td>Never</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="jumbotron">
                <p>You currently have no bots. Get started by registering a new bot by using the link above :)</p>
            </div>
        @endif
    </div>
@stop