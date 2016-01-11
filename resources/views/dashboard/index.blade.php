@extends('layouts.app')

@section('content')
    <form action="/feeds/multi" method="post">
        {!! csrf_field() !!}
        <div class="panel panel-default">
            <div class="panel-heading">
                DASHBOARD
            </div>
            <div class="panel-nav">
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger disabled" data-multiple-action name="todo" value="delete">Delete</button>
                    <a href="{{ url('/feeds/create') }}" class="btn btn-default">Add feed</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">

                @if(\Auth::user()->feeds->count() == 0)

                    <p class="text-center have-none"><em>You are not monitoring any feeds yet. Why don't you <a href="{{ url('/feeds/create') }}">add</a> one now?</em></p>

                @else

                    <table class="table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Link</th>
                                <th>Type</th>
                                <th>Last checked</th>
                                <th>History</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\Auth::user()->feeds as $feed)
                            <tr>
                                <td><input type="checkbox" name="choice[]" value="{{ $feed->id }}" class="toCheck"></td>
                                <td>{{ $feed->link }}</td>
                                <td>{{ $feed->type }}</td>
                                <td>{{ $feed->last_checked_at->diffForHumans() }}</td>
                                <td><a href="">Show</a></td>
                                <td><i class="fa fa-close"></i></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif


            </div>

        </div>
    </form>


@endsection
