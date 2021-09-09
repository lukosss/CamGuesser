@extends('layouts.app')

@section('content')

        <div class="text-center">
            <iframe src="{{$url}}?autoplay=1" width="860" height="480" allow="autoplay"></iframe>
            <h1>Country: {{$displayedCameraCountry}}</h1>

            <div id="app">
                <game-component
                    v-bind:answers="{{  json_encode($answers) }}"
                    v-bind:correct="{{  json_encode($displayedCameraCountry) }}"

                ></game-component>
            </div>

@endsection
