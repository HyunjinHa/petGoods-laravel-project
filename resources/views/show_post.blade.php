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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">  
                    <textarea name="content" class="w-80 h-20 mr-2" placeholder="댓글을 입력하세요."></textarea> <!-- 오른쪽 여백 추가 -->
                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">댓글 작성</button>
                </form>
            </div>
            
            <!-- 댓글 목록 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($post->comments as $comment)
                    <div class="border-b border-gray-200 pb-4 mb-4 flex justify-between items-center"> <!-- Flexbox를 적용 -->
                        <div>
                            <h3 class="font-bold">{{ $comment->user->name }}</h3>
                            <p>{{ $comment->content }}</p>
                        </div>
                        <!-- 댓글 삭제 버튼 추가 -->
                        <form action="{{ route('comment.destroy', ['id' => $comment->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">댓글 삭제</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
