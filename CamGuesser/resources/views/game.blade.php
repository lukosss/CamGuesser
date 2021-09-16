@extends('layouts.app')

@section('content')

        <div class="text-center mt-3">
            <iframe src="{{$generatedLevel->getUrl()}}?autoplay=1" width="860" height="480" allow="autoplay"></iframe>

            <div id="app">
                <game-component
                    :answers="{{  json_encode($generatedLevel->getAnswers()) }}"
                    :correct="{{  json_encode($generatedLevel->getDisplayedCameraCountry()) }}"
                ></game-component>
            </div>

@endsection
