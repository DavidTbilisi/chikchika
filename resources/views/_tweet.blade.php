<?php // one tweet ?>
<div class="border bg-white border-gray-300 rounded-lg  mt-4">
    <div class="flex p-4">
        <div class="mr-2 flex-shrink-0">
            <a href="#">
                <img src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt="" class="rounded-full mr-2" width="50" height="50">
            </a>
        </div>
        <div>
            <h5 class="font-bold mb-4">
                <a href="#">
                    <a href="{{$tweet->id}}">Tweeted</a> by: {{ $tweet->user->name }}
                </a>
            </h5>
            <p class="text-sm">
                {{ $tweet->body }}
            </p>
        </div>
    </div>
    <div class="flex p-4 border-t border-gray-300">
        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                Likes: {{ $tweet->likes->count() ?: 0 }}
            </a>
        </div>
        {{-- if exists list replies --}}
        @if($tweet->replies)
{{-- list all replies --}}
            @foreach($tweet->replies as $reply)
                <div class="flex-1 flex items-center text-xs">
                    <a href="#">
                        {{ $reply->user->name }}: {{ $reply->body }}
                    </a>
                </div>
            @endforeach
        @endif


        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                {{-- replays --}}

                replies: {{ $tweet->replies ?: 0 }}

            </a>
        </div>
    </div>

</div>

