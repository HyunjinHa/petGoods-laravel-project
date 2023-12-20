<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('게시글 보기') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-6" style="float: right;">
                    <td class="border px-3 py-2">{{ $post->created_at->format('Y-m-d') }}</td>
                    <td class="border px-2 py-2">{{ $post->user->name }}</td>
                </div>
                <div class="flex flex-col items-center p-6">
                    <div class="w-full sm:w-1/4 lg:w-1/6 overflow-hidden flex justify-center">
                        <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" style="width: auto; height:200px; float: center;">
                    </div>
                    <h2 class="font-bold text-2xl mt-4">{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                </div>
                <div class="flex p-6" style="float: right">
                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                        <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="text-black">수정</a>
                    </button>
                    <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">게시글 삭제</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
