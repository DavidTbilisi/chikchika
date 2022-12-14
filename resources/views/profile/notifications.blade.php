<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
{{--                    notifications list --}}
        <div class="flex flex-col items-center">
                <div class="bg-white border border-gray-300 rounded-lg">
                    <div class="flex p-4">
                        <div class="flex-1 flex items-center text-xs">
                            <a href="#">
                                <span class="inline-flex items-center">
                                    <b> {{ $user->notifications->count() ?: 0 }}</b> Notifications
                                </span>
                            </a>
                        </div>
                    </div>
                    @foreach($user->notifications as $notification)
                        <div class="flex p-4">
                            <div class="flex-1 flex items-center text-xs">
                                <a href="{{route("username", ["username"=>$notification->data['user']['name']])}}">
                                    <span class="inline-flex items-center">
                                        <b> {{$notification->data['user']['name']}}</b>
                                    </span>
                                </a>
                                -
                                <span class="inline-flex items-center">
                                    <b> {{$notification->data['message']}}</b>
                                </span>

                                @if($notification->type == "App\Notifications\TweetCommented")
                                    <a href="{{route("tweets.show", ["tweet"=>$notification->data['tweet']['id']])}}">
                                        <span class="inline-flex items-center text-blue-900 ml-2">
                                             {{$notification->data['tweet']['body']}}
                                        </span>
                                    </a>
                                @endif

                                <span class="inline-flex items-center text-gray-500 ml-4">
                                    <b> {{$notification->created_at->diffForHumans()}}</b>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
</x-app-layout>
