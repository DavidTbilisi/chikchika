<?php // one tweet ?>
<div class="border bg-white border-gray-300 rounded-lg  mt-4">
    <div class="flex p-4">
        <div class="mr-2 flex-shrink-0">
            <a href="#">
                <img src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt=""
                     class="rounded-full mr-2" width="50" height="50">
            </a>
        </div>
        <div>
            <h5 class="font-bold mb-4">
                <a href="tweets/{{$tweet->id}}">Chikchiked</a> by: <b><a href="user/{{$tweet->user->id}}"> {{ $tweet->user->name }}</a></b>
            </h5>
            <p class="text-sm">
                {{ $tweet->body }}
            </p>
        </div>
    </div>



    <div class="flex p-4 border-t border-gray-300">
{{--    like/unlike button --}}
        <form action="/tweets/{{$tweet->id}}/like" method="POST">
            @csrf
            <div class="flex items-center mr-4 {{$tweet->isLikedBy(Auth::user()->id) ? 'text-blue-500' : 'text-gray-500'}}">
                <button type="submit" class="text-xs mr-2">
                    {{$tweet->isLikedBy(Auth::user()->id) ? 'Liked' : 'Like'}}
                </button>
            </div>
        </form>

        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                ❤  {{ $tweet->likes->count() ?: 0 }}
            </a>
        </div>
        <div class="flex-1 flex items-center text-xs">
            <a href="#">
                💬 {{ $tweet->comments->count() ?: 0 }}
            </a>
        </div>

    </div>
    {{-- if exists list replies --}}
    @if($tweet->comments)
        @foreach($tweet->comments as $comment)
            <div class="flex p-4 border-t border-gray-300">
                <div class="flex-1 flex items-center text-xs">
                    <a href="#">
                        {{--                        inline image, commenter name, comment body, time--}}
                        <span class="inline-flex items-center">
                        <img src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt=""
                             class="rounded-full mr-2" width="50" height="50">
                        <b> {{ $comment->user->name }}</b> <span class="text-gray-400"> - {{ $comment->created_at->diffForHumans() }} - </span>
                        {{ $comment->body }}
                        </span>
                    </a>
                </div>
            </div>
        @endforeach
    @endif


</div>

