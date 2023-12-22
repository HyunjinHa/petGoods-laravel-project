<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('내 글 목록') }}
          </h2>
      </div>
  </x-slot>
  <div class="py-12">
      <div class="flex justify-between items-center">
          <h2 class="ml-20 font-semibold text-xl text-gray-800 leading-tight">
              {{ __('내 게시글 목록') }}
          </h2>
          <a href="/create_post" class="px-4 py-2 mr-20 bg-blue-500 text-white rounded hover:bg-blue-700 text-lg">게시글 등록</a>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <table class="table-auto w-full">
                <thead>
                  <tr>
                      <th class="px-10 py-2">제목</th>
                      <th class="px-3 py-2">작성일</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($posts as $post)
                      <tr>
                          <td class="border px-10 py-2">
                              <a href="/post/{{ $post->id }}">
                                  {{ $post->title }}
                              </a>
                          </td>
                          <td class="border px-3 py-2">{{ $post->created_at->format('Y-m-d H:i') }}</td>
                      </tr>
                  @endforeach
              </tbody>
              </table>
          </div>
      </div>
      <div class="flex justify-between items-center mt-10">
        <h2 class="ml-20 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('내 상품 목록') }}
        </h2>
        <a href="/create_product" class="px-4 py-2 mr-20 bg-blue-500 text-white rounded hover:bg-blue-700 text-lg">상품 등록</a>
      </div>
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