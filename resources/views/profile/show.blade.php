<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
{{--                user profile --}}
                <div class="flex p-4">

                    <div>
                        <h4 class="font-bold">{{ucfirst($user->name)}}</h4>
                    </div>
{{--                    is profile public or private --}}
                    <div>
                        <h4 class="font-bold ml-5">({{$user->privacy}})</h4>
                    </div>

{{--                    Follow button if not self and not following --}}
                    @if($user->id != auth()->user()->id && !auth()->user()->isFollowingUser($user->id))
                        <div class="ml-5">
                            <form action="{{route("profile.follow", ["username"=>$user->name])}}" method="post">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Follow
                                </button>
                            </form>
                        </div>
                    @else
{{--                        Unfollow button if not self and following --}}
                        @if($user->id != auth()->user()->id && auth()->user()->isFollowingUser($user->id))
                            <div class="ml-5">
                                <form action="{{route("profile.unfollow", ["username"=>$user->name])}}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 shadow-lg ml-4 border font-bold py-2 px-4 rounded">
                                        Unfollow
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endif


                </div>

{{--                show followers and following --}}
                <div class="flex p-4">
                    <div class="flex-1 flex items-center text-xs">
                        <a href="#">
                            <span class="inline-flex items-center">
                                <b> {{ $user->isFollowedBy->count() ?: 0 }}</b>
                                <a href="{{route("profile.followers", ["username"=>$user->name])}}">Followers</a>
                            </span>
                        </a>
                    </div>
                    <div class="flex-1 flex items-center text-xs">
                        <a href="#">
                            <span class="inline-flex items-center">
                                <b> {{ $user->isFollowing->count() ?: 0 }}</b>
                                <a href="{{route("profile.following", ["username"=>$user->name])}}">Following</a>
                            </span>
                        </a>
                    </div>
                </div>

{{--                show tweets --}}
                <div class="flex p-4">
                    <div class="flex-1 flex items-center text-xs">
                        <a href="#">
                            <span class="inline-flex items-center">
                                <b> {{ $user->tweets->count() ?: 0 }}</b> Tweets
                            </span>
                        </a>
                    </div>
                </div>

{{--                show likes --}}
                <div class="flex p-4">
                    <div class="flex-1 flex items-center text-xs">
                        <a href="#">
                            <span class="inline-flex items-center">
                                <b> {{ $user->likes->count() ?: 0 }}</b> Likes
                            </span>
                        </a>
                    </div>
                </div>

{{--                show comments --}}
                <div class="flex p-4">
                    <div class="flex-1 flex items-center text-xs">
                        <a href="#">
                            <span class="inline-flex items-center">
                                <b> {{ $user->comments->count() ?: 0 }}</b> Comments
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
