<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('상품 상세') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col items-center p-6">
                    <div class="w-full sm:w-1/2 lg:w-1/3 overflow-hidden">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-auto object-scale-down">
                    </div>
                    <h2 class="font-bold text-lg mt-4">{{ $product->title }}</h2>
                    <p class="text-red-500 font-semibold mb-4">{{ number_format($product->price, 0) }}원</p>
                    <p>{{ $product->content }}</p>
                </div>
                <div class="flex p-6" style="float: right">
                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                        <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="text-black">수정</a>
                    </button>
                    <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">게시글 삭제</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
