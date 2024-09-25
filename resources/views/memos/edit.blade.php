<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
</div>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('メモ編集') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('memos.show', $memo) }}" class="text-blue-500 hover:text-blue-700 mr-2">詳細に戻る</a>
          <form method="POST" action="{{ route('memos.update', $memo) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label for="memo" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">メモ編集</label>
              <input type="text" name="memo" id="memo" value="{{ $memo->text }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              @error('memo')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">編集</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
