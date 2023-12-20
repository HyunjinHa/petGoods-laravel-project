<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('상품 목록') }}
            </h2>
            <a href="/create_product" class="px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-700 text-lg">상품 등록</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($products as $product)
                    <div class="flex items-center mb-6">
                        <div class="w-32 h-32 overflow-hidden">
                            <a href="/product/{{ $product->id }}">
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-auto object-scale-down">
                            </a>
                        </div>
                        <div class="ml-4">
                            <a href="/product/{{ $product->id }}">
                                <h2 class="font-bold text-lg mb-2">{{ $product->title }}</h2>
                                <p class="text-red-500 font-semibold">{{ number_format($product->price, 0) }}원</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>




