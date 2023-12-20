<x-app-layout>
  <x-slot name="header">
      <div class="flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('내 글 목록') }}
          </h2>
          <a href="/create_post" class="px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-700 text-lg">게시글 등록</a>
      </div>
  </x-slot>

  <div class="py-12">
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
  </div>
</x-app-layout>