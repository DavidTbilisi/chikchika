<x-app-layout>
{{--    list following users --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">

        <div class="flex flex-col items-center">
            <div class="w-full max-w-2xl">
                <div class="bg-white border border-gray-300 rounded-lg">
                    <div class="flex p-4">
                        <div class="flex-1 flex items-center text-xs">
                            <a href="#">
                                <span class="inline-flex items-center">
                                    <b> {{ $user->isFollowing->count() ?: 0 }}</b> Following
                                </span>
                            </a>
                        </div>
                    </div>
                    @foreach($user->isFollowing as $following)
                        <div class="flex p-4">
                            <div class="flex-1 flex items-center text-xs">
                                <a href="{{route("username", ["username"=>$following->name])}}">
                                    <span class="inline-flex items-center">
                                        <b> {{$following->name}}</b>
                                    </span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
