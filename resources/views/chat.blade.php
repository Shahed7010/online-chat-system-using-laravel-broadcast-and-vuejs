@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center bg-info p-2">This is a one time virtual chat Room</h1>
        <div class="row justify-content-center" id="app">
            <div class="col-md-6">
                <h6 class="text-center bg-success pt-1">Active Now: <span class="badge badge-primary">@{{ activeNow }}</span></h6>
                <ul class="list-group " v-chat-scroll style="height: 300px; overflow-y: auto">
                    <chat-component v-for="(value,index) in chat.message"
                                    :key="index" :user="chat.user[index]"
                                    :color="chat.color[index]"
                                    :time="chat.time[index]">
                        @{{ value }}
                    </chat-component>
                </ul>
                <span  class="badge badge-pill badge-primary mb-2 float-right">@{{typing}}</span>
                <input type="text"  class="form-control" placeholder="please write your message"
                       v-model='message' @keyup.enter='send'>
            </div>
        </div>
        <div class="fixed-bottom">
        <p class="bg-warning text-center p-1 ">Refreshig page will erase all Messages!!</p>
        </div>
    </div>
@endsection
