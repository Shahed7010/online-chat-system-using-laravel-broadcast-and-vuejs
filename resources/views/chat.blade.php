@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center bg-info p-2">This is a one time virtual chat Room</h1>
        <div class="row justify-content-center mb-5" id="app">
            <div class="col-md-5">
{{--                <h6 class="text-center bg-success p-1">Active Now: <span class="badge badge-primary">@{{ activeNow }}</span></h6>--}}
                <ul class="list-group " v-chat-scroll style="height: 350px; overflow-y: auto; background-color: #fefefe; border-top: 1px solid #1b4b72">
                    <chat-component v-for="(value,index) in chat.message"
                                    :key="index" :user="chat.user[index]"
                                    :color="chat.color[index]"
                                    :time="chat.time[index]"
                                    :active-users="activeUsers">
                        @{{ value }}
                    </chat-component>
                </ul>
                <span  class="badge badge-pill badge-primary mb-2 float-right">@{{typing}}</span>
                <input type="text"  class="form-control" placeholder="please write your message"
                       v-model='message' @keyup.enter='send'>
            </div>
            <div class="col-md-3 " style="background-color: #d6e9f8">
                <h5 class="text-center bg-info p-1">Active Users <span class="badge badge-primary">@{{ activeNow }}</span></h5>
                <ul class="list-group " v-chat-scroll style="height: 300px; overflow-y: auto">
                    <li v-for="(value,index) in activeUsers"
                                    :key="index" class="list-group-item">
                        @{{ value.name }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="fixed-bottom">
        <p class="bg-warning text-center p-1 ">Refreshig page will erase all Messages!!</p>
        </div>
    </div>
@endsection

