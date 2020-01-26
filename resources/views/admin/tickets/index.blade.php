@extends('layouts.app')

@section('content')
    <div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Button
        </button>

        @foreach($ticket as $t)
            {{$t->comments}}
        @endforeach
    </div>
@endsection

