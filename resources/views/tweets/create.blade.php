<x-app-layout>
{{--    tweet create form --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">

    <form action="{{ route('tweets.store') }}" method="post">
        @csrf
        <div class="mb-4">
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Tweet something!"></textarea>
            @error('body')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded shadow-lg">Tweet</button>
        </div>
    </form>

    </div>

</x-app-layout>
