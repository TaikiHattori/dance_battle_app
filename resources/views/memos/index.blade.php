{{-- <div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
</div> --}}

<!-- resources/views/tweets/index.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
      {{ __('メモ一覧') }}
    </h2>
  </x-slot>

  <div class="py-12 px-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          @foreach ($memos as $memo)
          <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
            <p class="text-gray-800 dark:text-gray-300">メモ：{{ $memo->text }}</p>
            
            <a href="{{ route('memos.show', $memo) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

</x-app-layout>

