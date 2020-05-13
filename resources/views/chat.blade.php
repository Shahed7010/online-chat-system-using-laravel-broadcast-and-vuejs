@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center bg-primary">This is a chat Room</h1>
        <div class="row justify-content-center" id="app">
            <div class="col-md-4">
                <h6 class="text-center bg-info">Active Now: <span class="badge badge-primary">@{{ activeNow }}</span></h6>
                <ul class="list-group " v-chat-scroll style="height: 300px; overflow-y: auto">
                    <chat-component v-for="(value,index) in chat.message"
                                    :key="index" :user="chat.user[index]"
                                    :color="chat.color[index]"
                                    :time="chat.time[index]">
                        @{{ value }}
                    </chat-component>
                </ul>
                <span  class="badge badge-pill badge-primary mb-2 float-right">@{{typing}}</span>
                <input type="text" class="form-control" placeholder="please write your message"
                       v-model='message' @keyup.enter='send'>
            </div>
        </div>
    </div>
@endsection
