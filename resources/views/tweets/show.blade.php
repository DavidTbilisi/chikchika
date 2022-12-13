<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @include('_tweet')
        </div>
    </div>

{{--    form to add comment --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route("tweets.comment", ["tweet"=>$tweet->id])}}" method="POST">
                @csrf
                <div class="flex items  border-b border-b-2 border-teal-500 py-2">
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Comment something!"></textarea>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded shadow-lg">Comment</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
