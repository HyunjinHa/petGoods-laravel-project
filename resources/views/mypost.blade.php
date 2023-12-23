<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('내 글 목록') }}
          </h2>
      </div>
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
            {{ __('판매 상품 목록') }}
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
                    @if ($product->request != '')
                    <button type="button" class="mt-2 mr-2 bg-green-500 hover:bg-green-700 text-black py-2 px-4 rounded font-bold text-lg" onclick="confirmRestoreOrDestroy(event, 'restoreForm', 'destroyForm')">
                        판매 수락
                    </button>
                    <form id="restoreForm" action="{{ route('product.restore', ['id' => $product->id]) }}" method="POST" style="display: none;">
                    @csrf
                    </form>

                    <form id="destroyForm" action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <script>
                    function confirmRestoreOrDestroy(event, restoreFormId, destroyFormId) {
                        event.preventDefault();
                        if (confirm("상품을 재등록하시겠습니까?")) {
                            // 확인 버튼을 눌렀을 때
                            document.getElementById(restoreFormId).submit();
                        } else {
                            // 취소 버튼을 눌렀을 때
                            document.getElementById(destroyFormId).submit();
                        }
                    }
                    </script>

                    @endif
                </div>
            @endforeach
        </div>
      </div>
      {{-- <div class="flex justify-between items-center mt-10">
        <h2 class="ml-20 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('구매 목록') }}
        </h2>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ($myProducts as $myProduct)
                <div class="flex items-center mb-6">
                    <div class="w-32 h-32 overflow-hidden">
                        <a href="/product/{{ $myProduct->id }}">
                            <img src="{{ asset('images/' . $myProduct->image) }}" alt="{{ $myProduct->title }}" class="w-full h-auto object-scale-down">
                        </a>
                    </div>
                    <div class="ml-4">
                        <a href="/product/{{ $myProduct->id }}">
                            <h2 class="font-bold text-lg mb-2">{{ $myProduct->title }}</h2>
                            <p class="text-red-500 font-semibold">{{ number_format($mtProduct->price, 0) }}원</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
      </div> --}}
  </div>
</x-app-layout>
