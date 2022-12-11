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
            <form action="/tweets/{{$tweet->id}}/comment" method="POST">
                @csrf
                <div class="flex items  border-b border-b-2 border-teal-500 py-2">
                    <input type="text" name="body" class="appearance" placeholder="Add a comment">
                    <button type="submit" class="rounded-lg shadow py-2 px-2">Add</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
