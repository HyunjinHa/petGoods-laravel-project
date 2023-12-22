<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('상품 등록') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="form-container">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-field mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">상품명</label>
                            <input id="title" type="text" name="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="form-field mb-6">
                            <label for="price" class="block text-sm font-medium text-gray-700">가격</label>
                            <input id="price" type="number" name="price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="form-field mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700">상품 설명</label>
                            <textarea id="content" name="content" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md h-80"></textarea>
                        </div>
                        <div class="form-field mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">이미지 업로드</label>
                            <input id="image" type="file" name="image" multiple class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">상품 등록</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

