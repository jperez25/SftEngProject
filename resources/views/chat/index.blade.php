@extends('layouts.chatLayout')

@section('content')

    <div class="container">
        <div class="column is-8 is-offset-2">
            <div class="panel">
                <div class="panel-heading">
                    List of all Friends
                </div>
                @if(sizeof($friends))
                    @forelse ($friends as $friend)
                        <a href="{{ route('chat.show', $friend->id) }}" class="panel-block" style="justify-content: space-between;">
                            <div>{{ $friend->name }}</div>
                            <onlineuser v-bind:friend="{{ $friend->id }}" v-bind:onlineusers="onlineUsers"></onlineuser>                            
                        </a>
                    @empty
                        <div class="panel-block">
                            You don't have any friends
                        </div>
                    @endforelse
                @else
                    <div class="panel-block">
                        You don't have any friends
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
