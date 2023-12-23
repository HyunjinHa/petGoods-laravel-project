<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('상품 상세') }}
        </h2>
    </x-slot>

    @if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
    @endif

    @if (session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-6">
                    <div class="w-1/2 sm:w-1/3 lg:w-1/2 overflow-hidden">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-auto object-scale-down">
                    </div>
                    <div class="pl-6">
                        <h2 class="font-bold text-lg mt-4">{{ $product->title }}</h2>
                        <p class="text-red-500 font-semibold mb-4">{{ number_format($product->price, 0) }}원</p>
                        <p>{{ $product->content }}</p>
                        @if ($product->request)
                        <h3 class="mt-2 mr-2 bg-blue-500 hover:bg-blue-700 text-black font-bold py-3 px-6 rounded">판매 완료된 상품입니다.</h3>
                        @else
                        <form action="{{ route('products.request', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-2 mr-2 bg-blue-500 hover:bg-blue-700 text-black font-bold py-3 px-6 rounded">구매 신청</button>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="flex p-6" style="float: right">
                    <button type="submit" class="mt-2 mr-2 bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                        <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="text-white">수정</a>
                    </button>
                    <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('상품을 삭제하시겠습니까?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">게시글 삭제</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

