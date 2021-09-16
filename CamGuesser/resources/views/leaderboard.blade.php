@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-faded bg-faded">
        <div class="container-fluid">
            <a class="btn btn-outline-warning" href="/">Return to menu</a>
        </div>
    </nav>

    <div class="text-center mt-3">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Player Name</th>
                    <th scope="col">Score</th>
                    <th scope="col">Game Mode</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($leaderboard as $score)
                <tr>
                    <th scope="row">{{$score->player_name}}</th>
                    <td>{{$score->score}}</td>
                    <td>{{$score->game_mode}}</td>
                    <td>{{$score->created_at}}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>

@endsection
